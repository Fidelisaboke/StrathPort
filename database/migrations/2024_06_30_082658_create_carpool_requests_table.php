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
        Schema::create('carpool_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carpool_driver_id')->references('id')->on('carpool_drivers');
            $table->string('title');
            $table->string('description');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->string('departure_location');
            $table->string('destination');
            $table->integer('no_of_people');
            $table->enum('status', ['Pending', 'Approved', 'Declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpool_requests');
    }
};
