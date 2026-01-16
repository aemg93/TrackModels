<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModelController extends Controller
{
    /**
     * Listado de modelos
     */
    public function index()
    {
        $models = User::role('Modelo')
            ->with('platforms') // cargamos plataformas
            ->get();

        return Inertia::render('Models/Index', [
            'models' => $models,
        ]);
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return Inertia::render('Models/Create');
    }

    /**
     * Guardar nuevo modelo
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'active'   => 'boolean',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'active'   => $data['active'] ?? true,
        ]);

        $user->assignRole('Modelo');

        return redirect()->route('models.index')
                         ->with('success', 'Modelo creado correctamente');
    }

    /**
     * Mostrar detalles de un modelo
     */
    public function show(User $model)
    {
        return Inertia::render('Models/Show', [
            'model' => $model->load('platforms'),
        ]);
    }

    /**
     * Formulario de edición
     */
    public function edit(User $model)
    {
        return Inertia::render('Models/Edit', [
            'model' => $model->load('platforms'),
        ]);
    }

    /**
     * Actualizar modelo
     */
    public function update(Request $request, User $model)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $model->id,
            'password' => 'nullable|string|min:8',
            'active'   => 'required|boolean',
        ]);

        $model->name   = $data['name'];
        $model->email  = $data['email'];
        $model->active = $data['active'];

        if (!empty($data['password'])) {
            $model->password = bcrypt($data['password']);
        }

        $model->save();

        return redirect()->route('models.index')
                         ->with('success', 'Modelo actualizado correctamente');
    }

    /**
     * Eliminar modelo (solo Super Admin)
     */
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
