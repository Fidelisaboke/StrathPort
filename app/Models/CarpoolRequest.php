<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'carpool_driver_id',
        'departure_date',
        'departure_time',
        'departure_location',
        'destination',
        'no_of_people',
        'status',
    ];
}
