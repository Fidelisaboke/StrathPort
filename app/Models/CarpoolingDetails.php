<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpoolingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'carpool_request_id',
    ];



    /**
     * Define a one-to-one relationship between Carpool Request and Carpool Details
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carpoolRequest(){
        return $this->belongsTo(CarpoolRequest::class);
    }
}
