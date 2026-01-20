<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('platform_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['active', 'finished', 'forced'])->default('active');
            $table->string('started_by')->default('model');   // model, admin, superadmin
            $table->string('ended_by')->nullable();           // model, admin, superadmin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_hours');
    }
};
