<?php

namespace Database\Seeders;

use App\Models\SchoolDriver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 3 school drivers
        $schoolDrivers = [
            [
                'school_vehicle_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '+25412345678',
                'availability_status' => 'Available'
            ],
            [
                'school_vehicle_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'phone' => '+25412345679',
                'availability_status' => 'Unavailable'
            ],
            [
                'school_vehicle_id' => 3,
                'first_name' => 'Alice',
                'last_name' => 'Doe',
                'phone' => '+25412345680',
                'availability_status' => 'Unavailable'
            ],

        ];

        SchoolDriver::insert($schoolDrivers);
    }
}
