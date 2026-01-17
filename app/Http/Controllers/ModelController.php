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
        $models = User::role('Modelo')
            ->with('platforms')
            ->paginate(10);

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
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'stage_name'    => 'nullable|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'country'       => 'nullable|string|max:100',
            'city'          => 'nullable|string|max:100',
            'birth_date'    => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'bio'           => 'nullable|string',
            'document_path' => 'nullable|string|max:255',
            'avatar'        => 'nullable|string|max:255',
            'social_links'  => 'nullable|string|max:255',
            'active'        => 'boolean',
            'earnings'      => 'nullable|numeric|min:0',
            'password'      => 'required|string|min:8',
            'platform_ids'  => 'array',
            'platform_ids.*'=> 'exists:platforms,id',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['active']   = $data['active'] ?? true;
        $data['earnings'] = $data['earnings'] ?? 0;

        $user = User::create($data);
        $user->assignRole('Modelo');

        $user->platforms()->sync($data['platform_ids'] ?? []);

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
            'model'     => $model->load('platforms'),
            'platforms' => Platform::all(),
        ]);
    }

    /**
     * Actualizar modelo
     */
    public function update(Request $request, User $model)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'stage_name'    => 'nullable|string|max:255',
            'email'         => "required|string|email|max:255|unique:users,email,{$model->id}",
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'country'       => 'nullable|string|max:100',
            'city'          => 'nullable|string|max:100',
            'birth_date'    => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'bio'           => 'nullable|string',
            'document_path' => 'nullable|string|max:255',
            'avatar'        => 'nullable|string|max:255',
            'social_links'  => 'nullable|string|max:255',
            'active'        => 'boolean',
            'earnings'      => 'nullable|numeric|min:0',
            'password'      => 'nullable|string|min:8',
            'platform_ids'  => 'array',
            'platform_ids.*'=> 'exists:platforms,id',
        ]);

        $data['active']   = $request->has('active') ? $data['active'] : $model->active;
        $data['earnings'] = $data['earnings'] ?? $model->earnings;
        $data['password'] = $data['password'] ? bcrypt($data['password']) : $model->password;

        $model->update($data);
        $model->platforms()->sync($data['platform_ids'] ?? []);

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
