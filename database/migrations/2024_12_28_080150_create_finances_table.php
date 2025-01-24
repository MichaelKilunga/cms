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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->date('date')->useCurrent();
            $table->decimal('worship_offering', 10, 2)->default(0);
            $table->decimal('tithe_offering', 10, 2)->default(0);
            $table->decimal('thanksgiving_offering', 10, 2)->default(0);
            $table->decimal('project_offering', 10, 2)->default(0);
            $table->decimal('special_offering', 10, 2)->default(0);
            $table->decimal('firstfruits_offering', 10, 2)->default(0);
            $table->decimal('children_offering', 10, 2)->default(0);
            $table->decimal('cds_dvd_tapes', 10, 2)->default(0);
            $table->decimal('books_and_stickers', 10, 2)->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('no action');
            $table->foreignId('church_id')->constrained('churches')->onDelete('no action');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('no action');
            $table->foreignId('service_id')->constrained('services')->onDelete('no action');
            // approved or  not approved status
            $table->boolean('status')->nullable();
            $table->string('approval_reason')->nullable();
            $table->string('approval_by')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
