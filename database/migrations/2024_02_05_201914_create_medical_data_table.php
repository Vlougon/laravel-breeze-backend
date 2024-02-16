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
        Schema::create('medical_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiary_id')->cascadeOnDelete();;
            $table->text('allergies')->nullable();
            $table->text('illnesses')->nullable();
            $table->text('morning_medication')->nullable();
            $table->text('afternoon_medication')->nullable();
            $table->text('night_medication')->nullable();
            $table->time('preferent_morning_calls_hour');
            $table->time('preferent_afternoon_calls_hour');
            $table->time('preferent_night_calls_hour');
            $table->enum('emergency_room_on_town', ["Yes", "No"]);
            $table->enum('firehouse_on_town', ["Yes", "No"]);
            $table->enum('police_station_on_town', ["Yes", "No"]);
            $table->enum('outpatient_clinic_on_town', ["Yes", "No"]);
            $table->enum('ambulance_on_town', ["Yes", "No"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_data');
    }
};
