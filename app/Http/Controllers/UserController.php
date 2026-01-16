<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // 👈 Importar el trait

class UserController extends Controller
{
    use AuthorizesRequests; // 👈 Usar el trait

    /**
     * Crear un nuevo usuario con rol asignado
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role'     => 'required|string|in:Super Admin,Admin,Modelo',
        ]);

        $roleToCreate = $request->input('role');

        $this->authorize('create', [User::class, $roleToCreate]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($roleToCreate);

        return response()->json([
            'message' => "Usuario con rol {$roleToCreate} creado correctamente",
            'user'    => $user,
        ]);
    }
}
