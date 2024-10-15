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
        Schema::create('quarterly_reports', function (Blueprint $table) {
            $table->id();
            $table->string('quarter');  // E.g., Q1, Q2, etc.
            $table->integer('year');
            $table->decimal('total_income', 12, 2)->default(0);
            $table->integer('total_attendance')->default(0);
            $table->decimal('worship_offering', 12, 2)->default(0);
            $table->decimal('tithe', 12, 2)->default(0);
            $table->decimal('thanksgiving', 12, 2)->default(0);
            $table->decimal('project_funds', 12, 2)->default(0);
            $table->decimal('special_offering', 12, 2)->default(0);
            $table->decimal('first_fruits', 12, 2)->default(0);
            $table->decimal('children_offering', 12, 2)->default(0);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quarterly_reports');
    }
};
