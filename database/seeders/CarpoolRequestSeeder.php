<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarpoolRequest;
use Carbon\Carbon;

class CarpoolRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carpool_requests =[
            [
                'user_id' => 2,
                'carpool_driver_id' => 1,
                'title' => 'Carpool Request 1',
                'description' => 'Carpool Request 1 Description',
                'departure_date' => Carbon::now()->toDateString(),
                'departure_time' => Carbon::now()->addHours(2)->format('H:i'),
                'departure_location' => 'Departure Location 1',
                'destination' => 'Destination 1',
                'no_of_people' => 3,
                'status' => 'Approved'
            ],
            [
                'user_id' => 2,
                'carpool_driver_id' => 1,
                'title' => 'Carpool Request 2',
                'description' => 'Carpool Request 2 Description',
                'departure_date' => Carbon::now()->addDays(1)->toDateString(),
                'departure_time' => Carbon::now()->addDays(1)->addHours(2)->format('H:i'),
                'departure_location' => 'Departure Location 2',
                'destination' => 'Destination 2',
                'no_of_people' => 3,
                'status' => 'Approved'
            ],
            [
                'user_id' => 3,
                'carpool_driver_id' => 1,
                'title' => 'Carpool Request 3',
                'description' => 'Carpool Request 3 Description',
                'departure_date' => Carbon::now()->addDays(2)->toDateString(),
                'departure_time' => Carbon::now()->addDays(2)->addHours(2)->format('H:i'),
                'departure_location' => 'Departure Location 3',
                'destination' => 'Destination 3',
                'no_of_people' => 3,
                'status' => 'Approved'
            ],
            [
                'user_id' => 3,
                'carpool_driver_id' => 2,
                'title' => 'Carpool Request 4',
                'description' => 'Carpool Request 4 Description',
                'departure_date' => Carbon::now()->addDays(3)->toDateString(),
                'departure_time' => Carbon::now()->addDays(3)->addHours(2)->format('H:i'),
                'departure_location' => 'Departure Location 4',
                'destination' => 'Destination 4',
                'no_of_people' => 3,
                'status' => 'Pending'
            ],
            [
                'user_id' => 4,
                'carpool_driver_id' => 2,
                'title' => 'Carpool Request 5',
                'description' => 'Carpool Request 5 Description',
                'departure_date' => Carbon::now()->addDays(4)->toDateString(),
                'departure_time' => Carbon::now()->addDays(4)->addHours(2)->format('H:i'),
                'departure_location' => 'Departure Location 5',
                'destination' => 'Destination 5',
                'no_of_people' => 3,
                'status' => 'Declined'
            ]
        ];

        CarpoolRequest::insert($carpool_requests);
    }
}
