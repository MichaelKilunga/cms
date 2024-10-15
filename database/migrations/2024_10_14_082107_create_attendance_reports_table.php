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
        Schema::create('attendance_reports', function (Blueprint $table) {
            $table->id();
            $table->date('service_date');
            $table->string('service_name');
            $table->integer('total_attendance')->default(0);
            $table->integer('male')->default(0);
            $table->integer('female')->default(0);
            $table->integer('children')->default(0);
            $table->integer('baptisms')->default(0);
            $table->integer('new_births')->default(0);
            $table->integer('first_timers')->default(0);
            $table->integer('cars')->default(0);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_reports');
    }
};
