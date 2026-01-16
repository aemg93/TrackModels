<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birth_date');
            $table->text('bio')->nullable();
            $table->string('document_path')->nullable(); // documento de identidad
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('models');
    }
};
