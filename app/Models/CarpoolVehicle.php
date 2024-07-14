<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'carpool_driver_id',
        'make',
        'model',
        'year',
        'number_plate',
        'capacity',
        'vehicle_photo_path',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'vehicle_photo_url',
        'full_name',
    ];

    /**
     * Get the vehicle photo URL within carpool_vehicles directory in storage
     */
    public function getVehiclePhotoUrlAttribute(){
        return $this->vehicle_photo_path ? asset("storage/{$this->vehicle_photo_path}") : null;
    }

    /**
     * Get the full name of the vehicle (make + model)
     */
    public function getFullNameAttribute(){
        return "{$this->make} {$this->model}";
    }

    /**
     * Inverse one-to-one relationship between Carpool Vehicle and Carpool Driver
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carpoolDriver(){
        return $this->belongsTo(CarpoolDriver::class);
    }
}
