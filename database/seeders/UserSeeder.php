<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('password123'),
                'active'   => true,
            ]
        );
        $superAdmin->syncRoles(['Super Admin']);

       
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password123'),
                'active'   => true,
            ]
        );
        $admin->syncRoles(['Admin']);

        $modelo = User::updateOrCreate(
            ['email' => 'model@example.com'],
            [
                'name'     => 'Modelo Prueba',
                'password' => Hash::make('password123'),
                'active'   => true,
            ]
        );
        $modelo->syncRoles(['Modelo']);
    }
}
