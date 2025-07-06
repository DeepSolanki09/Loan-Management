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
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id')->unique(); 
            $table->string('bank_name');
            $table->string('loan_type');
            $table->text('interest_rate');
            $table->text('loan_tenure');
            $table->string('bank_logo')->nullable(); // Allow nullable for image
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
