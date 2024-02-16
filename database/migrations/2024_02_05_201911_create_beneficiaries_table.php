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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 35);
            $table->string('first_surname', 35);
            $table->string('second_surname', 35)->nullable();
            $table->date('birth_date');
            $table->string('dni', 9);
            $table->string('social_security_number', 12);
            $table->text('rutine')->nullable();
            $table->enum('gender', ["Male","Female","Other"]);
            $table->enum('marital_status', ["Single","Engaged","Married","Divorced","Uncoupled","Widower"]);
            $table->enum('beneficiary_type', ["Above65","65-45","44-30","29-19","18-12","Below12"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
