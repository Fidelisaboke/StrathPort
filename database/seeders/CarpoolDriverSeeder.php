<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarpoolDriver;

class CarpoolDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carpool_drivers =[
            [
                'user_id' => 4,
                'carpool_vehicle_id' => 1,
                'first_name' => 'Bob',
                'last_name' => 'Doe',
                'availability_status' => 'Available'
            ],
            [
                'user_id' => 5,
                'carpool_vehicle_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'availability_status' => 'Unavailable'
            ]
        ];

        CarpoolDriver::insert($carpool_drivers);
    }
}

