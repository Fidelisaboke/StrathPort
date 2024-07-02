<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 1 Student member to user id 2
        $students = [
            [
                'user_id' => 2,
                'student_school_id' => '1001',
                'first_name' => 'Jane',
                'last_name' => 'Doe',
            ]
        ];

        Student::insert($students);
    }
}
