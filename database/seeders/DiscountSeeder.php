<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('Modelo')->get();

        foreach ($users as $user) {
            Discount::create([
                'user_id'    => $user->id,
                'amount_usd' => 30,
                'reason'     => 'Multa por incumplir reglamento interno',
                'period'     => 'mes 01-2026',
            ]);

            Discount::create([
                'user_id'    => $user->id,
                'amount_usd' => 20,
                'reason'     => 'Descuento por falta injustificada',
                'period'     => 'mes 02-2026',
            ]);

            // Compra fraccionada (ejemplo: juguete 1.000.000 COP ≈ 250 USD)
            $totalUsd = 250; $installments = 4; $perInstallment = $totalUsd / $installments;
            for ($i = 1; $i <= $installments; $i++) {
                Discount::create([
                    'user_id'    => $user->id,
                    'amount_usd' => $perInstallment,
                    'reason'     => "Compra de juguete - cuota {$i}/{$installments}",
                    'period'     => "mes 0{$i}-2026",
                    'installments' => $installments,
                    'current_installment' => $i,
                    'remaining_amount' => $totalUsd - ($perInstallment * $i),
                ]);
            }
        }
    }
}
