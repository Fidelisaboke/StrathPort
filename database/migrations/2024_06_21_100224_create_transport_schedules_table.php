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
        Schema::create('transport_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_request_id')->nullable()->references('id')->on('transport_requests')->nullOnDelete();
            $table->foreignId('school_vehicle_id')->nullable()->references('id')->on('school_vehicles')->nullOnDelete();
            $table->string('title');
            $table->string('description');
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->string('starting_point');
            $table->string('destination');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_schedules');
    }
};
