<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * RELATIONSHIPS
     */

    /**
     * Inverse one-to-many relationship between
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRole(){
        return $this->belongsTo(UserRole::class);
    }
}
