<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'event_location',
        'no_of_people',
        'status',
    ];

    /**
     * Get the user that owns the transport request.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transport schedule for the transport request.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transportSchedule()
    {
        return $this->hasOne(TransportSchedule::class);
    }
}
