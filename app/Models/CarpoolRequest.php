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

    /**
     * Define one-to-one relationship between Carpool Driver and Carpool Request
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
     public function carpoolingDriver(){
        return $this->hasOne(CarpoolRequest::class);
    }

    /**
     * Inverse one-to-one relationship between Carpool Request and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carpoolingDetails(){
        return $this->belongsTo(CarpoolingDetails::class);
    }
}
