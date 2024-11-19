<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->string('location')->nullable();
        $table->string('occupation')->nullable();
        $table->string('dini_dhehebu')->nullable();
        $table->string('spiritual_status')->nullable();
        $table->text('description')->nullable();
        $table->foreignId('branch_id')->constrained()->onDelete('cascade');
        $table->string('age_group')->nullable(); // Assuming you want to add this
        $table->foreignId('added_by')->constrained('users')->onDelete('cascade'); // Added by foreign key
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
