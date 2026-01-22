<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Platform;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModelController extends Controller
{
    /**
     * Listado de modelos
     */
    public function index()
    {
        $models = User::role('Modelo')->paginate(10);

        return Inertia::render('Models/Index', [
            'models' => $models,
        ]);
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return Inertia::render('Models/Create', [
            'platforms' => Platform::all(),
        ]);
    }

    /**
     * Guardar nuevo modelo
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'stage_name' => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'nullable|string|max:20',
            'password'   => 'required|string|min:8',
        ]);

        $model = User::create($validated);
        $model->assignRole('Modelo');

        if ($request->filled('platform_ids')) {
            $model->platforms()->sync($request->platform_ids);
        }

        return redirect()->route('models.index')->with('success', 'Modelo creado correctamente.');
    }

    /**
     * Formulario de edición
     */
    public function edit(User $model)
    {
        return Inertia::render('Models/Edit', [
            'model'     => $model->load('platforms'),
            'platforms' => Platform::all(),
        ]);
    }

    /**
     * Actualizar modelo
     */
    public function update(Request $request, User $model)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'stage_name' => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $model->id,
            'phone'      => 'nullable|string|max:20',
            'password'   => 'nullable|string|min:8',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $model->update($validated);

        if ($request->filled('platform_ids')) {
            $model->platforms()->sync($request->platform_ids);
        }

        return redirect()->route('models.index')->with('success', 'Modelo actualizado correctamente.');
    }

    /**
     * Eliminar modelo
     */
    public function destroy(User $model)
    {
        $model->delete();

        return redirect()->route('models.index')->with('success', 'Modelo eliminado correctamente.');
    }
}
