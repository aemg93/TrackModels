<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();

            // Nombre único de la plataforma (ej: Instagram, OnlyFans, etc.)
            $table->string('name')->unique();

            // Tasa de tokens (ej: valor de cada token en dólares)
            $table->decimal('token_rate', 10, 2)->default(0);

            // Multiplicador para cálculos adicionales (ej: bonificaciones)
            $table->decimal('multiplier', 10, 2)->default(1);

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('platforms');
    }
};
