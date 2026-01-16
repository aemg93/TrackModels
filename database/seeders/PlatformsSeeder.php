<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformsSeeder extends Seeder {
    public function run(): void {
        DB::table('platforms')->insert([
            ['name' => 'Chaturbate', 'token_rate' => 0.05, 'multiplier' => 1],
            ['name' => 'LoyalFans', 'token_rate' => 0.10, 'multiplier' => 1],
            ['name' => 'Cam4', 'token_rate' => 0.08, 'multiplier' => 1],
        ]);
    }
}
