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
        Schema::create('carpool_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carpool_driver_id')->constrained('carpool_drivers')->cascadeOnDelete();
            $table->string('make');
            $table->string('model');
            $table->string('year');
            $table->string('number_plate');
            $table->integer('capacity')->unsigned();
            $table->string('vehicle_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpool_vehicles');
    }
};
