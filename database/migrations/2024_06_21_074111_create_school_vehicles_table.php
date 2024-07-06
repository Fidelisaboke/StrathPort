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
        Schema::create('school_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_driver_id')->nullable()->constrained('school_drivers')->nullOnDelete();
            $table->string('make');
            $table->string('model');
            $table->string('year');
            $table->string('number_plate');
            $table->integer('capacity')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_vehicles');
    }
};
