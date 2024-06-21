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
     * One-to-many relationship between Carpool Driver and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carpoolingDetails(){
        return $this->hasMany(CarpoolingDetails::class);
    }

    /**
     * One-to-one relationship between Carpool Driver and User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->hasOne(User::class);
    }
}
