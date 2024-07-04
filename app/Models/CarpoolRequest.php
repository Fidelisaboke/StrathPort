<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'carpool_driver_id',
        'title',
        'description',
        'departure_date',
        'departure_time',
        'departure_location',
        'destination',
        'no_of_people',
        'status',
    ];

    /**
     * Get the carpool driver that owns the carpool request.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function carpoolDriver(){
        return $this->belongsTo(CarpoolDriver::class);
    }

    /**
     * Inverse one-to-one relationship between Carpool Request and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function carpoolingDetails(){
        return $this->hasOne(CarpoolingDetails::class);
    }

    /**
     * Get the user that owns the carpool request.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
