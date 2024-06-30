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
                'make' => 'Toyota',
                'model' => 'Corolla',
                'year' => '2019',
                'number_plate' => 'KBC 123X',
                'capacity' => 4
            ],
            [
                'make' => 'Toyota',
                'model' => 'Vitz',
                'year' => '2018',
                'number_plate' => 'KBD 123X',
                'capacity' => 4
            ],
            [
                'make' => 'Toyota',
                'model' => 'Fielder',
                'year' => '2017',
                'number_plate' => 'KBE 123X',
                'capacity' => 4
            ],
        ];

        CarpoolVehicle::insert($carpool_vehicles);
    }
}
