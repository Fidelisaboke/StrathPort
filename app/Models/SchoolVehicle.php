<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_driver_id',
        'make',
        'model',
        'vehicle_year',
        'number_plate',
        'capacity',
    ];

    /**
     * Define a one-to-one relationship between School Driver and School Vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schoolDriver(){
        return $this->hasOne(SchoolDriver::class);
    }
}
