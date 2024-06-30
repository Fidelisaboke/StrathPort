<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'vehicle_year',
        'number_plate',
        'capacity',
    ];

    /**
     * Inverse one-to-one relationship between School Driver and School Vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolDriver(){
        return $this->belongsTo(SchoolDriver::class);
    }
}
