<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 1 Staff member to user id 3
        $staff = [
            [
                'user_id' => 3,
                'staff_school_id' => '2001',
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]
        ];

        Staff::insert($staff);
    }
}
