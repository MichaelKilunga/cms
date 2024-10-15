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
        Schema::create('disbursement_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('total_income', 12, 2)->default(0);
            $table->decimal('project_fund', 12, 2)->default(0);
            $table->decimal('tithe_fund', 12, 2)->default(0);
            $table->decimal('social_welfare_fund', 12, 2)->default(0);
            $table->decimal('housing_fund', 12, 2)->default(0);
            $table->decimal('children_ministry_fund', 12, 2)->default(0);
            $table->decimal('petty_cash', 12, 2)->default(0);
            $table->decimal('general_expenditure', 12, 2)->default(0);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursement_reports');
    }
};
