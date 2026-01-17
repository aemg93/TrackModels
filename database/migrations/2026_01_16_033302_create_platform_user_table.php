<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('platform_user', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios
            $table->foreignId('user_id')
                  ->constrained('users')   // referencia explícita a la tabla users
                  ->onDelete('cascade');

            // Relación con plataformas
            $table->foreignId('platform_id')
                  ->constrained('platforms') // referencia explícita a la tabla platforms
                  ->onDelete('cascade');

            // Credenciales específicas de la modelo en esa plataforma
            $table->string('platform_username')->nullable();
            $table->string('platform_password')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_user');
    }
};
