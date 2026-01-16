<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Listado de admins
     */
    public function index()
    {
        $admins = User::role('Admin')->with('platforms')->paginate(10);

        return Inertia::render('Admin/Index', [
            'admins' => $admins,
        ]);
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    /**
     * Guardar nuevo admin
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
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['active']   = $data['active'] ?? true;
        $data['earnings'] = $data['earnings'] ?? 0;

        $user = User::create($data);
        $user->assignRole('Admin');

        return redirect()->route('admins.index')->with('success', 'Admin creado correctamente');
    }

    /**
     * Mostrar detalles de un admin
     */
    public function show(User $admin)
    {
        return Inertia::render('Admin/Show', [
            'admin' => $admin->load('platforms'),
        ]);
    }

    /**
     * Formulario de edición
     */
    public function edit(User $admin)
    {
        return Inertia::render('Admin/Edit', [
            'admin' => $admin->load('platforms'),
        ]);
    }

    /**
     * Actualizar admin
     */
    public function update(Request $request, User $admin)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'stage_name'    => 'nullable|string|max:255',
            'email'         => "required|string|email|max:255|unique:users,email,{$admin->id}",
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
        ]);

        $data['active']   = $request->has('active') ? $data['active'] : $admin->active;
        $data['earnings'] = $data['earnings'] ?? $admin->earnings;
        $data['password'] = $data['password'] ? bcrypt($data['password']) : $admin->password;

        $admin->update($data);

        return redirect()->route('admins.index')->with('success', 'Admin actualizado correctamente');
    }

    /**
     * Eliminar admin (solo Super Admin debería poder)
     */
    public function destroy(User $admin)
    {
        if (!auth()->user()->hasRole('Super Admin')) {
            abort(403, 'No autorizado');
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin eliminado correctamente');
    }
}
