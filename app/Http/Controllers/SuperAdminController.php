<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminController extends Controller
{
    public function index()
    {
        return Inertia::render('SuperAdmin/Index', [
            'users' => User::role('Super Admin')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('SuperAdmin/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'last_name'=> 'nullable|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role'     => 'required|string',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'last_name'=> $data['last_name'] ?? null,
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('superadmin.index')
                         ->with('success', 'Usuario creado correctamente');
    }

    public function show(User $superadmin)
    {
        return Inertia::render('SuperAdmin/Show', [
            'user' => $superadmin,
        ]);
    }

    public function edit(User $superadmin)
    {
        return Inertia::render('SuperAdmin/Edit', [
            'user' => $superadmin,
        ]);
    }

    public function update(Request $request, User $superadmin)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'last_name'=> 'nullable|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $superadmin->id,
            'password' => 'nullable|string|min:8',
            'role'     => 'required|string',
        ]);

        $superadmin->update([
            'name'     => $data['name'],
            'last_name'=> $data['last_name'] ?? $superadmin->last_name,
            'email'    => $data['email'],
            'password' => !empty($data['password'])
                ? bcrypt($data['password'])
                : $superadmin->password,
        ]);

        $superadmin->syncRoles([$data['role']]);

        return redirect()->route('superadmin.index')
                         ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $superadmin)
    {
        $superadmin->delete();

        return redirect()->route('superadmin.index')
                         ->with('success', 'Usuario eliminado correctamente');
    }
}
