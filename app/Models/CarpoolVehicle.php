<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'carpool_driver_id',
        'model',
        'year',
        'number_plate',
        'capacity',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'vehicle_photo_url',
    ];

    /**
     * Inverse one-to-one relationship between Carpool Vehicle and Carpool Driver
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carpoolDriver(){
        return $this->belongsTo(CarpoolDriver::class);
    }
}
