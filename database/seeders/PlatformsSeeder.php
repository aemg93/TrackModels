<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Borra todos los registros sin afectar las foreign keys
        Platform::query()->delete();

        // Inserta las plataformas base
        Platform::insert([
            [
                'name'       => 'Chaturbate',
                'multiplier' => 1,
                'token_rate' => 0.05,
            ],
            [
                'name'       => 'LoyalFans',
                'multiplier' => 1,
                'token_rate' => 0.10,
            ],
            [
                'name'       => 'Cam4',
                'multiplier' => 1,
                'token_rate' => 0.08,
            ],
        ]);
    }
}
