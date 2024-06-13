<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_school_id',
        'first_name',
        'last_name',
    ];

    /**
     * RELATIONSHIPS
     */

     // One-to-One relationship between Student and User
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
