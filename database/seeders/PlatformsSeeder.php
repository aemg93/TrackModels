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

        // Inserta las plataformas base (10 en total)
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
            [
                'name'       => 'Stripchat',
                'multiplier' => 1,
                'token_rate' => 0.06,
            ],
            [
                'name'       => 'MyFreeCams',
                'multiplier' => 1,
                'token_rate' => 0.05,
            ],
            [
                'name'       => 'BongaCams',
                'multiplier' => 1,
                'token_rate' => 0.04,
            ],
            [
                'name'       => 'LiveJasmin',
                'multiplier' => 1,
                'token_rate' => 0.12,
            ],
            [
                'name'       => 'OnlyFans',
                'multiplier' => 1,
                'token_rate' => 0.20,
            ],
            [
                'name'       => 'Fansly',
                'multiplier' => 1,
                'token_rate' => 0.15,
            ],
            [
                'name'       => 'JustForFans',
                'multiplier' => 1,
                'token_rate' => 0.18,
            ],
        ]);
    }
}
