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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('no action');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('no action');
            $table->foreignId('church_id')->constrained('churches')->onDelete('no action');
            $table->string('status')->default('active'); // e.g., active, inactive
            $table->text('description')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
