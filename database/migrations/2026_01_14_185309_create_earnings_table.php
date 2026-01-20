<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->decimal('amount_tokens', 15, 2)->default(0);
            $table->decimal('amount_usd', 15, 2)->default(0);
            $table->decimal('exchange_rate', 15, 6)->default(1);
            $table->string('period')->nullable(); // semana, mes, etc.
            $table->timestamps();

            // Índice opcional para consultas rápidas por usuario/plataforma/periodo
            $table->index(['user_id', 'platform_id', 'period']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('earnings');
    }
};
