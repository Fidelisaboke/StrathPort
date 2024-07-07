<?php

namespace Database\Seeders;

use App\Models\SchoolVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 3 school vehicles
        $schoolVehicles = [
            [
                'school_driver_id' => 1,
                'make' => 'Toyota',
                'model' => 'Hiace',
                'year' => '2021',
                'number_plate' => 'AAA 123B',
                'capacity' => 15,
                'availability_status' => 'Available',
            ],
            [
                'school_driver_id' => 2,
                'make' => 'Toyota',
                'model' => 'Prime',
                'year' => '2022',
                'number_plate' => 'BBB 123C',
                'capacity' => 50,
                'availability_status' => 'Available',
            ],
            [
                'school_driver_id' => 3,
                'make' => 'Toyota',
                'model' => 'Camry',
                'year' => '2023',
                'number_plate' => 'CCC 123D',
                'capacity' => 50,
                'availability_status' => 'Unavailable',
            ],
        ];

        SchoolVehicle::insert($schoolVehicles);

    }
}
