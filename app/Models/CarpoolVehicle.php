<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'vehicle_year',
        'number_plate',
        'capacity',
    ];
}
