<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Básicos
            'create super admin',
            'create admin',
            'create model',
            'edit model',
            'delete model',
            'view earnings',
            'manage platforms',
            'send notifications',

            // Perfil
            'view own profile',
            'edit own profile',
            'delete own profile',

            // WorkHours CRUD
            'view workhour',
            'create workhour',
            'edit workhour',
            'delete workhour',

            // WorkHours especiales (sesiones en vivo)
            'force start workhour',
            'force end workhour',
            'view active workhours',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin      = Role::firstOrCreate(['name' => 'Admin']);
        $modelo     = Role::firstOrCreate(['name' => 'Modelo']);

        // Super Admin → todos los permisos
        $superAdmin->syncPermissions(Permission::all());

        // Admin → permisos intermedios
        $admin->syncPermissions([
            'create model',
            'edit model',
            'delete model',
            'view earnings',
            'send notifications',
            'view workhour',
            'edit workhour',
            'delete workhour',
            'force start workhour',
            'force end workhour',
            'view active workhours',
        ]);

        // Modelo → permisos limitados
        $modelo->syncPermissions([
            'view earnings',
            'view own profile',
            'edit own profile',
            'delete own profile',
            'view workhour',
            'create workhour',
            'edit workhour',
            'delete workhour',
        ]);
    }
}
