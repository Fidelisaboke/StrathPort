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
        'year',
        'number_plate',
        'capacity',
        'availability_status'
    ];

    /**
     * Get the full name of the school vehicle
     */
    public function getFullNameAttribute(){
        return $this->make . ' ' . $this->model;
    }

    /**
     * Inverse one-to-one relationship between School Driver and School Vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolDriver(){
        return $this->belongsTo(SchoolDriver::class);
    }

    /**
     * One-to-many relationship between School Vehicle and Transport Schedule
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transportSchedules(){
        return $this->hasMany(TransportSchedule::class);
    }
}
