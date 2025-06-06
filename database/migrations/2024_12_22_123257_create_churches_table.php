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
        Schema::create('churches', function (Blueprint $table) {
            $table->id();// Primary key
            $table->string('name');
            $table->string('logo')->nullable(); // Path to the logo image
            $table->string('motto')->nullable(); // Optional motto
            // add foreign key to the users table on delete set 'administrator_id' = 1
            $table->foreignId('administrator_id')->constrained('users')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('churches');
    }
};
