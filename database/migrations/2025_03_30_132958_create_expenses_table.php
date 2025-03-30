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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();            
            $table->date('request_date')->useCurrent();
            $table->date('required_before')->nullable();
            $table->string('purpose')->nullable();
            $table->string('item')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            // FOREIGN KEYS
            $table->foreignId('requested_by')->constrained('users')->onDelete('no action');
            $table->foreignId('church_id')->constrained('churches')->onDelete('no action');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('no action');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('no action');
            // approved or not approved status
            $table->boolean('status')->nullable();
            $table->string('approval_reason')->nullable();
            $table->string('approved_by')->nullable()->constrained('users')->onDelete('no action');;  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
