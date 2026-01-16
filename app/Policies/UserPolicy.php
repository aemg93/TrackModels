<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determina si el usuario autenticado puede crear otro usuario
     *
     * @param User $user El usuario autenticado
     * @param string $roleToCreate El rol del usuario que se quiere crear
     * @return bool
     */
    public function create(User $user, string $roleToCreate): bool
    {
        if ($roleToCreate === 'Super Admin') {
            return $user->hasRole('Super Admin') && $user->can('create super admin');
        }

        if ($roleToCreate === 'Admin') {
            return $user->hasRole('Super Admin') && $user->can('create admin');
        }

        if ($roleToCreate === 'Modelo') {
            return $user->hasAnyRole(['Super Admin', 'Admin']) && $user->can('create model');
        }

        return false;
    }
}
