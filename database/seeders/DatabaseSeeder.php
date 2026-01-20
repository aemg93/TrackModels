<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 📌 Ejecutar primero los seeders de roles y plataformas
      $this->call([ 
                    RolesSeeder::class,
                    UserSeeder::class,
                    PlatformsSeeder::class,
                    EarningSeeder::class,
                    BonusSeeder::class,
                    DiscountSeeder::class,
                 ]);

        // ✅ Ya no creamos usuarios aquí porque RolesSeeder se encarga
        // de crear Super Admin, Admin y Modelo con sus roles asignados.
    }
}
