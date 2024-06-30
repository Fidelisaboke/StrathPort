<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'carpool_request_id',
        'available_space',
        'departure_date',
        'departure_time',
        'departure_location',
        'destination',
        'additional_notes'
    ];



    /**
     * Define a one-to-one relationship between Carpool Request and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function carpoolRequest(){
        return $this->hasOne(CarpoolRequest::class);
    }
}
