<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('discounts', function (Blueprint $table) {
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

            // Razón del descuento/multa
            $table->string('reason')->nullable();

            // Periodo (ejemplo: mes 01-2026)
            $table->string('period')->nullable();

            // Número total de cuotas (si aplica)
            $table->unsignedInteger('installments')->nullable();

            // Cuota actual
            $table->unsignedInteger('current_installment')->nullable();

            // Monto restante por pagar
            $table->decimal('remaining_amount', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('discounts');
    }
};
