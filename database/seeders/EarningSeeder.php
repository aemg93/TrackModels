<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Platform;
use App\Models\Earning;

class EarningSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('Modelo')->get();
        $platforms = Platform::all();

        foreach ($users as $user) {
            foreach ($platforms as $platform) {
                // Generar varios registros por usuario/plataforma
                for ($i = 1; $i <= 5; $i++) {
                    // Periodos aleatorios: semana o mes
                    $periodType = rand(0, 1) ? 'semana' : 'mes';
                    $period = $periodType . ' ' . str_pad($i, 2, '0', STR_PAD_LEFT) . '-2026';

                    // Tasa de cambio variable (ejemplo: COP/USD)
                    $exchangeRate = [3900, 4000, 4050, 4100][array_rand([3900, 4000, 4050, 4100])];

                    Earning::create([
                        'user_id'       => $user->id,
                        'platform_id'   => $platform->id,
                        'amount_tokens' => rand(500, 2000),
                        'amount_usd'    => rand(100, 500),
                        'exchange_rate' => $exchangeRate,
                        'period'        => $period,
                    ]);
                }
            }
        }
    }
}
