<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('token_rate', 10, 2)->default(0); // tasa de tokens
            $table->decimal('multiplier', 10, 2)->default(1); // multiplicador
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('platforms');
    }
};
