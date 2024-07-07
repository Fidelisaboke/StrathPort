<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'availability_status'
    ];

    /**
     * Get the full name of the carpool driver
     */
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Define a one-to-one relationship between Carpool Driver and User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Define one-to-one relationship between Carpool Driver and Carpool Vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carpoolVehicle(){
        return $this->hasOne(CarpoolVehicle::class);
    }

    /**
     * Inverse one-to-one relationship between Carpool Driver and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carpoolRequest(){
        return $this->hasOne(CarpoolRequest::class);
    }
}
