<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // 📌 Crear permisos básicos
        $permissions = [
            'create super admin',
            'create admin',
            'create model',
            'edit model',
            'delete model',
            'view earnings',
            'manage platforms',
            'send notifications',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 📌 Crear roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin      = Role::firstOrCreate(['name' => 'Admin']);
        $modelo     = Role::firstOrCreate(['name' => 'Modelo']);

        // 📌 Asignar permisos a roles
        $superAdmin->syncPermissions(Permission::all()); // todos los permisos
        $admin->syncPermissions([
            'create model',
            'edit model',
            'delete model',
            'view earnings',
            'send notifications',
        ]);
        $modelo->syncPermissions(['view earnings']); // solo ver ganancias

        // 📌 Crear usuarios de prueba
        $userSuperAdmin = User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name'     => 'Super Admin',
                'password' => bcrypt('password123'),
                'active'   => true,
            ]
        );
        $userSuperAdmin->syncRoles(['Super Admin']);

        $userAdmin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'password' => bcrypt('password123'),
                'active'   => true,
            ]
        );
        $userAdmin->syncRoles(['Admin']);

        $userModel = User::updateOrCreate(
            ['email' => 'model@example.com'],
            [
                'name'     => 'Modelo Prueba',
                'password' => bcrypt('password123'),
                'active'   => true,
            ]
        );
        $userModel->syncRoles(['Modelo']);
    }
}
