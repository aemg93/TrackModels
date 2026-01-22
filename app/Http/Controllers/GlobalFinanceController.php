<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Earning;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GlobalFinanceController extends Controller
{
    /**
     * Mostrar resumen financiero global
     */
    public function index(Request $request)
    {
        $earningsQuery = Earning::with(['platform', 'user'])
            ->when($request->filled('platform_id') && $request->platform_id !== 'todas', fn($q) => $q->where('platform_id', $request->platform_id))
            ->when($request->filled('from'), fn($q) => $q->whereDate('created_at', '>=', $request->from))
            ->when($request->filled('to'), fn($q) => $q->whereDate('created_at', '<=', $request->to));

        $earnings = $earningsQuery->get();
        $allPlatforms = Platform::all();

        // Totales por plataforma
        $totales = $allPlatforms->map(fn($platform) => [
            'platform'     => $platform,
            'total_tokens' => $earnings->where('platform_id', $platform->id)->sum('amount_tokens'),
            'total_usd'    => $earnings->where('platform_id', $platform->id)->sum('amount_usd'),
            'total_cop'    => $earnings->where('platform_id', $platform->id)->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
        ]);

        // Totales generales
        $totalGeneral = [
            'tokens' => $earnings->sum('amount_tokens'),
            'usd'    => $earnings->sum('amount_usd'),
            'cop'    => $earnings->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
        ];

        return Inertia::render('Dashboard/Index', [
            'earnings'      => $earnings,
            'totales'       => $totales,
            'totalGeneral'  => $totalGeneral,
            'filters'       => $request->only(['platform_id', 'from', 'to']),
        ]);
    }
}
