<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Index', [
            'admins' => User::role('Admin')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole('Admin');

        return redirect()->route('admins.index')->with('success', 'Admin creado correctamente');
    }

    public function show(User $admin)
    {
        return Inertia::render('Admin/Show', ['admin' => $admin]);
    }

    public function edit(User $admin)
    {
        return Inertia::render('Admin/Edit', ['admin' => $admin]);
    }

    public function update(Request $request, User $admin)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8',
        ]);

        $admin->update([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => !empty($data['password']) ? bcrypt($data['password']) : $admin->password,
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin actualizado correctamente');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin eliminado correctamente');
    }
}
