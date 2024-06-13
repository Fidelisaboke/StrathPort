<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'users_roles';

    /**
     * RELATIONSHIPS
     */

    // One-to-Many relationship between UserRole and User
    public function user(){
        return $this->hasMany(User::class);
    }

    // One-to-Many relationship between UserRole and Role
    public function role(){
        return $this->hasMany(Role::class);
    }
}
