<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Listado de usuarios (solo visible para Super Admin / Admin)
     */
    public function index()
    {
        $users = User::with(['roles','platforms'])->paginate(10);

        return inertia('SuperAdmin/Index', [ 
            'users' => $users,
        ]);
    }

    /**
     * Crear un nuevo usuario con rol asignado
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
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
            'role'          => 'required|string|in:Super Admin,Admin,Modelo',
        ]);

        $this->authorize('create', [User::class, $validated['role']]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['active']   = $validated['active'] ?? true;
        $validated['earnings'] = $validated['earnings'] ?? 0;

        $user = User::create($validated);
        $user->assignRole($validated['role']);

        return redirect()->route('users.index')
                         ->with('success', "Usuario con rol {$validated['role']} creado correctamente");
    }

    /**
     * Mostrar un usuario específico
     */
    public function show(User $user)
    {
        return inertia('SuperAdmin/Show', [
            'user' => $user->load(['roles','platforms']),
        ]);
    }

    /**
     * Actualizar un usuario existente
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'stage_name'    => 'nullable|string|max:255',
            'email'         => "required|string|email|max:255|unique:users,email,{$user->id}",
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
            'role'          => 'required|string|in:Super Admin,Admin,Modelo',
        ]);

        // Mantener valores previos si no se envían
        $validated['active']   = $request->has('active') ? $validated['active'] : $user->active;
        $validated['earnings'] = $validated['earnings'] ?? $user->earnings;
        $validated['password'] = $validated['password'] ? bcrypt($validated['password']) : $user->password;

        $user->update($validated);
        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')->with('success', "Usuario actualizado correctamente");
    }

    /**
     * Eliminar un usuario
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }

    /**
     * Actualizar credenciales de un usuario en una plataforma
     */
    public function updatePlatformCredentials(Request $request, User $user, Platform $platform)
    {
        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        $user->platforms()->updateExistingPivot($platform->id, [
            'username' => $validated['username'],
            'password' => $validated['password'],
        ]);

        return redirect()->back()->with('success', 'Credenciales actualizadas correctamente');
    }
}
