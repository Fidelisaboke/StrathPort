<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'availability_status',
    ];

    /**
     * Get full name of the driver
     */
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Define a one-to-one relationship between School Driver and School Vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schoolVehicles(){
        return $this->hasMany(SchoolVehicle::class);
    }
}
