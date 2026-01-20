<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Relación opcional con plataformas
            $table->foreignId('platform_id')
                  ->nullable()
                  ->constrained()
                  ->onDelete('cascade');

            // Monto en USD
            $table->decimal('amount_usd', 15, 2)->default(0);

            // Razón del bono
            $table->string('reason')->nullable();

            // Periodo (ejemplo: semana 01-2026)
            $table->string('period')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bonuses');
    }
};
