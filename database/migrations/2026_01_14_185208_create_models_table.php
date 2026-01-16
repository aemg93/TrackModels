<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('models', function (Blueprint $table) {
            $table->id();

            // Relación con users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Información básica
            $table->string('first_name');
            $table->string('last_name');
            $table->string('stage_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->text('bio')->nullable();
            $table->string('document_path')->nullable(); // documento de identidad
            $table->string('social_links')->nullable();  // redes sociales

            // Estado y métricas
            $table->boolean('active')->default(true);
            $table->decimal('earnings', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('models');
    }
};
