<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'users_roles';

    /**
     * Define a one-to-many relationship between UserRole and User
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(){
        return $this->hasMany(User::class);
    }

    /**
     * Define a one-to-many relationship between UserRole and Role
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role(){
        return $this->hasMany(Role::class);
    }
}
