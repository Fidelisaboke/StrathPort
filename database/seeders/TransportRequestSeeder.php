<?php

namespace Database\Seeders;

use App\Models\TransportRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'title' => 'Club Competition',
                'description' => 'Transport request for a school event',
                'event_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'event_time' => '08:00',
                'event_location' => 'School Gymnasium',
                'no_of_people' => 20,
                'status' => 'Pending',
            ],
            [
                'user_id' => 2,
                'title' => 'Excursion',
                'description' => 'Transport request for a school trip to Central Park',
                'event_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'event_time' => '09:00',
                'event_location' => 'Central Park',
                'no_of_people' => 50,
                'status' => 'Approved',
            ],
            [
                'user_id' => 2,
                'title' => 'COP Activity',
                'description' => 'Transport request for a school event',
                'event_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'event_time' => '10:00',
                'event_location' => 'School Gymnasium',
                'no_of_people' => 50,
                'status' => 'Declined',
            ],
        ];

            TransportRequest::insert($transport_requests);
    }
}
