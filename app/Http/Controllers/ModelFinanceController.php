<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class ModelFinanceController extends Controller
{
    /**
     * Mostrar resumen financiero de un modelo específico
     */
    public function show(Request $request, User $model)
    {
        $model->load('platforms');
        $assignedPlatformIds = $model->platforms->pluck('id')->all();

        $earningsQuery = $model->earnings()->with('platform');

        // Filtro por plataforma
        if ($request->filled('platform_id') && $request->platform_id !== 'todas') {
            $earningsQuery->where('platform_id', $request->platform_id);
        } else {
            $earningsQuery->whereIn('platform_id', $assignedPlatformIds);
        }

        // Filtro por fechas
        if ($request->filled('from')) {
            $earningsQuery->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $earningsQuery->whereDate('created_at', '<=', $request->to);
        }

        $earnings = $earningsQuery->get();

        // Agrupación por plataforma + periodo
        $groupBy = $request->input('groupBy', 'day'); // valores: day, week, month
        $groupedEarnings = $earnings->groupBy(function ($earning) use ($groupBy) {
            $date = Carbon::parse($earning->created_at);
            $period = match ($groupBy) {
                'week' => 'semana ' . $date->weekOfYear . '-' . $date->year,
                'month' => 'mes ' . str_pad($date->month, 2, '0', STR_PAD_LEFT) . '-' . $date->year,
                default => $date->toDateString(),
            };
            return $earning->platform_id . '-' . $period; // 👈 clave compuesta
        })->map(function ($items, $key) {
            $first = $items->first();
            $parts = explode('-', $key, 2);
            return [
                'period'      => $parts[1],
                'tokens'      => $items->sum('amount_tokens'),
                'usd'         => $items->sum('amount_usd'),
                'cop'         => $items->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
                'platform_id' => $first->platform_id,
                'platform'    => $first->platform, // 👈 incluir relación completa
            ];
        })->values();

        // Totales de ganancias
        $earningsTotals = [
            'tokens' => $earnings->sum('amount_tokens'),
            'usd'    => $earnings->sum('amount_usd'),
            'cop'    => $earnings->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
        ];

        // Bonificaciones con filtros
        $bonusesQuery = $model->bonuses();
        if ($request->filled('from')) {
            $bonusesQuery->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $bonusesQuery->whereDate('created_at', '<=', $request->to);
        }
        $bonuses = $bonusesQuery->get();
        $bonusesTotal = $bonuses->sum('amount_usd');

        // Descuentos con filtros
        $discountsQuery = $model->discounts();
        if ($request->filled('from')) {
            $discountsQuery->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $discountsQuery->whereDate('created_at', '<=', $request->to);
        }
        $discounts = $discountsQuery->get();
        $discountsTotal = $discounts->sum('amount_usd');

        // Ganancia neta
        $netIncome = $earningsTotals['usd'] + $bonusesTotal - $discountsTotal;

        // Totales por plataforma
        $totales = $model->platforms->map(function ($platform) use ($earnings) {
            $platformEarnings = $earnings->where('platform_id', $platform->id);
            return [
                'platform'     => $platform,
                'total_tokens' => $platformEarnings->sum('amount_tokens'),
                'total_usd'    => $platformEarnings->sum('amount_usd'),
                'total_cop'    => $platformEarnings->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
            ];
        });

        // Totales generales
        $totalGeneral = [
            'tokens' => $earningsTotals['tokens'],
            'usd'    => $earningsTotals['usd'],
            'cop'    => $earningsTotals['cop'],
        ];

        return Inertia::render('Models/Show', [
            'model'          => $model,
            'earnings'       => $groupedEarnings, // ahora agrupados por plataforma + periodo
            'earningsTotals' => $earningsTotals,
            'bonuses'        => $bonuses,
            'bonusesTotal'   => $bonusesTotal,
            'discounts'      => $discounts,
            'discountsTotal' => $discountsTotal,
            'netIncome'      => $netIncome,
            'totales'        => $totales,
            'totalGeneral'   => $totalGeneral,
            'filters'        => $request->only(['platform_id','from','to','groupBy']),
        ]);
    }
}
