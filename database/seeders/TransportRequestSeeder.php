<?php

namespace Database\Seeders;

use App\Models\TransportRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transport_requests = [
            [
                'user_id' => 2,
                'title' => 'Transport Request 1',
                'description' => 'Transport request for a school event',
                'event_date' => '2024-06-12',
                'event_time' => '08:00:00',
                'event_location' => 'School Gymnasium',
                'no_of_people' => 100,
                'status' => 'Pending',
            ],
            [
                'user_id' => 2,
                'title' => 'Trip to Central Park',
                'description' => 'Transport request for a school trip to Central Park',
                'event_date' => '2024-06-12',
                'event_time' => '09:00:00',
                'event_location' => 'Central Park',
                'no_of_people' => 50,
                'status' => 'Approved',
            ],
            [
                'user_id' => 2,
                'title' => 'Transport Request 3',
                'description' => 'Transport request for a school event',
                'event_date' => '2024-06-12',
                'event_time' => '10:00:00',
                'event_location' => 'School Gymnasium',
                'no_of_people' => 100,
                'status' => 'Declined',
            ],
        ];

            TransportRequest::insert($transport_requests);
    }
}
