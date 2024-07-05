<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_request_id',
        'title',
        'description',
        'schedule_date',
        'schedule_time',
        'starting_point',
        'destination',
    ];

    /**
     * Get the transport request that owns the transport schedule.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportRequest()
    {
        return $this->belongsTo(TransportRequest::class);
    }
}
