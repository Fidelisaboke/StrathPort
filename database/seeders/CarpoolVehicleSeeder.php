<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarpoolVehicle;

class CarpoolVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carpool_vehicles =[
            [
                'carpool_driver_id' => 1,
                'make' => 'Toyota',
                'model' => 'Corolla',
                'year' => '2019',
                'number_plate' => 'AAA 123X',
                'capacity' => 4
            ],
            [
                'carpool_driver_id' => 2,
                'make' => 'Toyota',
                'model' => 'Vitz',
                'year' => '2018',
                'number_plate' => 'BBB 234Y',
                'capacity' => 4
            ],
        ];

        CarpoolVehicle::insert($carpool_vehicles);
    }
}
