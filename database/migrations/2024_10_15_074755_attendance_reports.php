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
        $table->string('message');  // Optional
        $table->string('minister'); // Optional
        $table->integer('total_attendance')->default(0);
        $table->integer('male')->default(0);
        $table->integer('female')->default(0);
        $table->integer('children')->default(0);
        $table->integer('baptism_water')->nullable();  // Make this nullable
        $table->integer('baptism_spirit')->nullable(); // Make this nullable
        $table->integer('new_births')->nullable();     // Make this nullable
        $table->integer('first_timers')->nullable();   // Make this nullable
        $table->integer('cars')->nullable();           // Make this nullable
        $table->integer('worship_offering')->nullable();
        $table->integer('tithe_offering')->nullable();
        $table->integer('thanksgiving_offering')->nullable();
        $table->integer('project_offering')->nullable();
        $table->integer('special_offering')->nullable();
        $table->integer('firstfruits_offering')->nullable();
        $table->integer('children_offering')->nullable();
        $table->integer('Cds_dvd_tapes')->nullable();
        $table->integer('books_and_stickers')->nullable();
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
