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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->integer('duration');
            $table->enum('call_type', ["rutinary", "emergency"]);
            $table->enum('call_kind', ["incoming", "outgoing"]);
            $table->enum('turn', ["morning", "afternoon", "night"]);
            $table->boolean('answered_call');
            $table->text('observations');
            $table->text('description')->nullable();
            $table->boolean('contacted_112')->default(false);
            $table->foreignId('user_id')->cascadeOnDelete();
            $table->foreignId('beneficiary_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
