<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkHour;

class WorkHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo: Modelo con id=3 trabajando en enero y febrero
        WorkHour::create([
            'user_id' => 3,
            'platform_id' => null,
            'hours' => 40,
            'period' => 'mes 01-2026',
        ]);

        WorkHour::create([
            'user_id' => 3,
            'platform_id' => null,
            'hours' => 35,
            'period' => 'mes 02-2026',
        ]);

        // Otro ejemplo: Modelo con id=4
        WorkHour::create([
            'user_id' => 4,
            'platform_id' => null,
            'hours' => 50,
            'period' => 'mes 01-2026',
        ]);
    }
}
