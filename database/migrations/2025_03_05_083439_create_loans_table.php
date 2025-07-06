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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email');
            $table->string('phone_number');
            $table->bigInteger('loan_id'); 
            $table->string('loan_type');
            $table->string('bank_name');
            $table->string('applied_from_account')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->rememberToken(); 
            $table->timestamps(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
