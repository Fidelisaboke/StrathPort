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

    // One-to-Many relationship between Role and UserRole
    public function userRole(){
        return $this->belongsTo(UserRole::class);
    }
}
