<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('service_category_id')->constrained('service_categories')->onDelete('cascade');
            $table->date('date');
            $table->string('message');
            $table->string('minister');
            $table->integer('women')->default(0);
            $table->integer('men')->default(0);
            $table->integer('children')->default(0);
            $table->integer('cars')->default(0);
            $table->integer('baptism_water')->default(0);
            $table->integer('baptism_spirit')->default(0);
            $table->integer('new_birth')->default(0);
            $table->integer('first_timers')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('church_id')->constrained('churches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
