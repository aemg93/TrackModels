<?php

namespace App\Http\Controllers;

use App\Models\WorkHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkHourController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view workhour')->only(['index', 'show', 'activeSessions']);
        $this->middleware('permission:create workhour')->only(['startSession', 'forceStartSession']);
        $this->middleware('permission:edit workhour')->only(['endSession', 'forceEndSession']);
        $this->middleware('permission:delete workhour')->only(['destroy']);
    }

    /**
     * Listar todas las sesiones
     */
    public function index()
    {
        return response()->json(
            WorkHour::with(['user', 'platform'])->paginate(10)
        );
    }

    /**
     * Mostrar una sesión específica
     */
    public function show(WorkHour $workHour)
    {
        return response()->json($workHour->load(['user', 'platform']));
    }

    /**
     * Modelo inicia sesión
     */
    public function startSession(Request $request)
    {
        $workHour = WorkHour::create([
            'user_id' => Auth::id(),
            'platform_id' => $request->platform_id,
            'start_time' => now(),
            'status' => 'active',
            'started_by' => 'model',
        ]);

        return response()->json([
            'message' => 'Sesión iniciada correctamente',
            'data' => $workHour
        ], 201);
    }

    /**
     * Modelo finaliza sesión
     */
    public function endSession(WorkHour $workHour)
    {
        $workHour->update([
            'end_time' => now(),
            'status' => 'finished',
            'ended_by' => 'model',
        ]);

        return response()->json([
            'message' => 'Sesión finalizada correctamente',
            'data' => $workHour
        ]);
    }

    /**
     * Admin/SuperAdmin fuerza inicio de sesión
     */
    public function forceStartSession(Request $request)
    {
        $workHour = WorkHour::create([
            'user_id' => $request->user_id,
            'platform_id' => $request->platform_id,
            'start_time' => now(),
            'status' => 'active',
            'started_by' => Auth::user()->hasRole('Super Admin') ? 'superadmin' : 'admin',
        ]);

        return response()->json([
            'message' => 'Sesión iniciada por administrador',
            'data' => $workHour
        ], 201);
    }

    /**
     * Admin/SuperAdmin fuerza fin de sesión
     */
    public function forceEndSession(WorkHour $workHour)
    {
        $workHour->update([
            'end_time' => now(),
            'status' => 'forced',
            'ended_by' => Auth::user()->hasRole('Super Admin') ? 'superadmin' : 'admin',
        ]);

        return response()->json([
            'message' => 'Sesión finalizada por administrador',
            'data' => $workHour
        ]);
    }

    /**
     * Ver sesiones activas (para Admin/SuperAdmin)
     */
    public function activeSessions()
    {
        $sessions = WorkHour::where('status', 'active')
            ->with(['user', 'platform'])
            ->get();

        return response()->json($sessions);
    }

    /**
     * Eliminar registro de sesión
     */
    public function destroy(WorkHour $workHour)
    {
        $workHour->delete();

        return response()->json([
            'message' => 'Registro eliminado correctamente'
        ]);
    }
}
