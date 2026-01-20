<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkHourController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * Ruta raíz → dashboard de Super Admin
 */
Route::get('/', [SuperAdminController::class, 'index'])
    ->middleware(['auth', 'role:Super Admin'])
    ->name('superadmin.index');

Route::middleware('auth')->group(function () {
    // Dashboard genérico → evita error de Ziggy
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return redirect()->route('superadmin.index');
        } elseif ($user->hasRole('Admin')) {
            return redirect()->route('admin.index');
        } elseif ($user->hasRole('Modelo')) {
            return redirect()->route('models.index');
        }

        return Inertia::render('Dashboard'); // fallback genérico
    })->name('dashboard');

    /**
     * Perfil protegido con permisos
     */
    Route::middleware(['permission:view own profile'])
        ->get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::middleware(['permission:edit own profile'])
        ->patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::middleware(['permission:delete own profile'])
        ->delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /**
     * Super Admin
     */
    Route::middleware('role:Super Admin')->group(function () {
        Route::resource('superadmin', SuperAdminController::class);

        // CRUD de usuarios completo
        Route::resource('users', UserController::class);

        // Ruta para actualizar credenciales en plataformas
        Route::post('/users/{user}/platforms/{platform}/update',
            [UserController::class, 'updatePlatformCredentials'])
            ->name('users.platforms.update');

        // Nueva sección Administradores (Super Admin + Admin)
        Route::get('/administradores', [AdminController::class, 'index'])->name('administradores.index');
    });

    /**
     * Admin y Super Admin → acceso a modelos
     */
    Route::middleware('role:Admin|Super Admin')->group(function () {
        Route::resource('models', ModelController::class)->except(['destroy']);
    });

    // Solo Super Admin puede eliminar modelos
    Route::middleware('role:Super Admin')->group(function () {
        Route::delete('/models/{model}', [ModelController::class, 'destroy'])->name('models.destroy');
    });

    /**
     * Admin y Super Admin → acceso al dashboard de Admin
     */
    Route::middleware('role:Admin|Super Admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    });

    /**
     * Modelo, Admin y Super Admin → acceso al dashboard de Modelos
     */
    Route::middleware('role:Modelo|Admin|Super Admin')->group(function () {
        Route::get('/models', [ModelController::class, 'index'])->name('models.index');
    });

    /**
     * WorkHours → CRUD protegido con permisos
     */
    Route::middleware(['permission:view workhour'])->get('/workhours', [WorkHourController::class, 'index'])->name('workhours.index');
    Route::middleware(['permission:view workhour'])->get('/workhours/{workhour}', [WorkHourController::class, 'show'])->name('workhours.show');
    Route::middleware(['permission:create workhour'])->post('/workhours', [WorkHourController::class, 'store'])->name('workhours.store');
    Route::middleware(['permission:edit workhour'])->patch('/workhours/{workhour}', [WorkHourController::class, 'update'])->name('workhours.update');
    Route::middleware(['permission:delete workhour'])->delete('/workhours/{workhour}', [WorkHourController::class, 'destroy'])->name('workhours.destroy');
});

require __DIR__.'/auth.php';
