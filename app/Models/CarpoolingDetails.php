<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'carpool_driver_id',
        'available_space',
        'departure_time',
        'departure_location',
        'destination',
        'additional_notes'
    ];

    /**
     * Inverse one-to-many relationship between Carpool Driver and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carpoolingDriver(){
        return $this->belongsTo(CarpoolingDetails::class);
    }
}
