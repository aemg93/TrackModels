<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Platform;
use App\Models\Earning;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModelController extends Controller
{
    public function index()
    {
        $models = User::role('Modelo')
            ->with('platforms')
            ->paginate(10);

        return Inertia::render('Models/Index', [
            'models' => $models,
        ]);
    }

    public function create()
    {
        return Inertia::render('Models/Create', [
            'platforms' => Platform::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'stage_name'     => 'nullable|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users',
            'phone'          => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:255',
            'country'        => 'nullable|string|max:100',
            'city'           => 'nullable|string|max:100',
            'birth_date'     => 'nullable|date',
            'gender'         => 'nullable|in:male,female,other',
            'bio'            => 'nullable|string',
            'document_path'  => 'nullable|string|max:255',
            'avatar'         => 'nullable|string|max:255',
            'social_links'   => 'nullable|string|max:255',
            'active'         => 'boolean',
            'password'       => 'required|string|min:8',
            'platform_ids'   => 'array',
            'platform_ids.*' => 'exists:platforms,id',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['active']   = $data['active'] ?? true;

        $user = User::create($data);
        $user->assignRole('Modelo');
        $user->platforms()->sync($data['platform_ids'] ?? []);

        return redirect()->route('models.index')
                         ->with('success', 'Modelo creado correctamente');
    }

    /** Vista individual de un modelo */
    public function show(Request $request, User $model)
    {
        $model->load('platforms');
        $assignedPlatformIds = $model->platforms->pluck('id')->all();

        $earningsQuery = $model->earnings()->with('platform');

        // "todas" en modelo = solo plataformas asignadas
        if ($request->filled('platform_id') && $request->platform_id !== 'todas') {
            $earningsQuery->where('platform_id', $request->platform_id);
        } else {
            $earningsQuery->whereIn('platform_id', $assignedPlatformIds);
        }

        if ($request->filled('from')) {
            $earningsQuery->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $earningsQuery->whereDate('created_at', '<=', $request->to);
        }
        if ($request->filled('period')) {
            $earningsQuery->where('period', $request->period);
        }

        if (!$request->anyFilled(['platform_id','from','to','period'])) {
            $earningsQuery->where('period', now()->format('W-Y'));
        }

        $earnings = $earningsQuery->get();

        $earningsTotals = [
            'tokens' => (clone $earningsQuery)->sum('amount_tokens'),
            'usd'    => (clone $earningsQuery)->sum('amount_usd'),
            'cop'    => (clone $earningsQuery)->selectRaw('SUM(amount_usd * exchange_rate) as total_cop')->value('total_cop'),
        ];

        $bonusesQuery = $model->bonuses();
        if ($request->filled('period')) {
            $bonusesQuery->where('period', $request->period);
        } elseif (!$request->anyFilled(['platform_id','from','to','period'])) {
            $bonusesQuery->where('period', now()->format('W-Y'));
        }
        $bonuses = $bonusesQuery->get();
        $bonusesTotal = $bonuses->sum('amount_usd');

        $discountsQuery = $model->discounts();
        if ($request->filled('period')) {
            $discountsQuery->where('period', $request->period);
        } elseif (!$request->anyFilled(['platform_id','from','to','period'])) {
            $discountsQuery->where('period', now()->format('W-Y'));
        }
        $discounts = $discountsQuery->get();
        $discountsTotal = $discounts->sum('amount_usd');

        $netIncome = $earningsTotals['usd'] + $bonusesTotal - $discountsTotal;

        // Totales solo de las plataformas asignadas
        $totales = $model->platforms->map(function ($platform) use ($earnings) {
            $platformEarnings = $earnings->where('platform_id', $platform->id);
            return [
                'platform'     => $platform,
                'total_tokens' => $platformEarnings->sum('amount_tokens'),
                'total_usd'    => $platformEarnings->sum('amount_usd'),
                'total_cop'    => $platformEarnings->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
            ];
        });

        $totalGeneral = [
            'tokens' => $earningsTotals['tokens'],
            'usd'    => $earningsTotals['usd'],
            'cop'    => $earningsTotals['cop'],
        ];

        return Inertia::render('Models/Show', [
            'model'          => $model,
            'earnings'       => $earnings,
            'earningsTotals' => $earningsTotals,
            'bonuses'        => $bonuses,
            'bonusesTotal'   => $bonusesTotal,
            'discounts'      => $discounts,
            'discountsTotal' => $discountsTotal,
            'netIncome'      => $netIncome,
            'totales'        => $totales,
            'totalGeneral'   => $totalGeneral,
            'filters'        => $request->only(['platform_id', 'from', 'to', 'period']),
        ]);
    }

    /** Vista global de todos los modelos */
    public function indexGlobal(Request $request)
    {
        $earningsQuery = Earning::with('platform', 'user');

        // "todas" en global = todas las plataformas del sistema
        if ($request->filled('platform_id') && $request->platform_id !== 'todas') {
            $earningsQuery->where('platform_id', $request->platform_id);
        }

        if ($request->filled('from')) {
            $earningsQuery->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $earningsQuery->whereDate('created_at', '<=', $request->to);
        }
        if ($request->filled('period')) {
            $earningsQuery->where('period', $request->period);
        }

        if (!$request->anyFilled(['platform_id','from','to','period'])) {
            $earningsQuery->where('period', now()->format('W-Y'));
        }

        $earnings = $earningsQuery->get();
        $allPlatforms = Platform::all();

        $totales = $allPlatforms->map(function ($platform) use ($earnings) {
            $platformEarnings = $earnings->where('platform_id', $platform->id);
            return [
                'platform'     => $platform,
                'total_tokens' => $platformEarnings->sum('amount_tokens'),
                'total_usd'    => $platformEarnings->sum('amount_usd'),
                'total_cop'    => $platformEarnings->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
            ];
        });

        $totalGeneral = [
            'tokens' => $earnings->sum('amount_tokens'),
            'usd'    => $earnings->sum('amount_usd'),
            'cop'    => $earnings->sum(fn($e) => $e->amount_usd * $e->exchange_rate),
        ];

        return Inertia::render('Dashboard/Index', [
            'earnings'      => $earnings,
            'totales'       => $totales,
            'totalGeneral'  => $totalGeneral,
            'filters'       => $request->only(['platform_id', 'from', 'to', 'period']),
        ]);
    }

    public function edit(User $model)
    {
        return Inertia::render('Models/Edit', [
            'model'     => $model->load('platforms'),
            'platforms' => Platform::all(),
        ]);
    }

    public function update(Request $request, User $model)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'stage_name'     => 'nullable|string|max:255',
            'email'          => "required|string|email|max:255|unique:users,email,{$model->id}",
            'phone'          => 'required|string|max:20',
            'address'        => 'nullable|string|max:255',
            'country'        => 'nullable|string|max:100',
            'city'           => 'required|string|max:100',
            'birth_date'     => 'nullable|date',
            'gender'         => 'required|in:male,female,other',
            'bio'            => 'nullable|string',
            'document_path'  => 'nullable|string|max:255',
            'avatar'         => 'nullable|string|max:255',
            'social_links'   => 'nullable|string|max:255',
            'active'         => 'boolean',
            'password'       => 'nullable|string|min:8',
            'platform_ids'   => 'array',
            'platform_ids.*' => 'exists:platforms,id',
        ]);

        // Mantener valores si no se envían
        $data['active']   = $request->has('active') ? $data['active'] : $model->active;
        $data['password'] = $data['password'] ? bcrypt($data['password']) : $model->password;

        $model->update($data);
        $model->platforms()->sync($data['platform_ids'] ?? []);

        return redirect()->route('models.index')
                         ->with('success', 'Modelo actualizado correctamente');
    }

    public function destroy(User $model)
    {
        if (!auth()->user()->hasRole('Super Admin')) {
            abort(403, 'No autorizado');
        }

        $model->delete();

        return redirect()->route('models.index')
                         ->with('success', 'Modelo eliminado correctamente');
    }
}
