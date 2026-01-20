<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bonus;

class BonusSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('Modelo')->get();

        foreach ($users as $user) {
            Bonus::create([
                'user_id'    => $user->id,
                'amount_usd' => 50,
                'reason'     => 'Bonificación primer lugar ganancias semanales',
                'period'     => 'semana 01-2026',
            ]);

            Bonus::create([
                'user_id'    => $user->id,
                'amount_usd' => 100,
                'reason'     => 'Bonificación por alcanzar meta semanal de 10.000 tokens',
                'period'     => 'semana 02-2026',
            ]);
        }
    }
}
