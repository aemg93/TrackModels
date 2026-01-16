<?php

namespace App\Policies;

use App\Models\User;

class ModelPolicy
{
    public function viewAny(User $user): bool
    {
        // Admin y Super Admin pueden listar Modelos
        return $user->hasRole('Admin') || $user->hasRole('Super Admin');
    }

    public function view(User $user, User $model): bool
    {
        // Admin y Super Admin pueden ver perfiles de Modelos
        return $user->hasRole('Admin') || $user->hasRole('Super Admin');
    }

    public function create(User $user): bool
    {
        // Admin y Super Admin pueden crear Modelos
        return $user->hasRole('Admin') || $user->hasRole('Super Admin');
    }

    public function update(User $user, User $model): bool
    {
        // Admin y Super Admin pueden editar Modelos
        return $user->hasRole('Admin') || $user->hasRole('Super Admin');
    }

    public function delete(User $user, User $model): bool
    {
        // Solo Super Admin puede eliminar Modelos
        return $user->hasRole('Super Admin');
    }
}
