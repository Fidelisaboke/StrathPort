<?php

namespace Database\Seeders;

use App\Models\TransportSchedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transport_schedules = [
            [
                'school_vehicle_id' => 1,
                'title' => 'Excursion',
                'description' => 'Excursion to Nairobi National Park',
                'schedule_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'schedule_time' => '08:00',
                'starting_point' => 'School',
                'destination' => 'Nairobi National Park',
                'no_of_people' => 30,
                'status' => 'Completed',
            ],
            [
                'school_vehicle_id' => 2,
                'title' => 'Daily Commute',
                'description' => 'Commute to Town',
                'schedule_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'schedule_time' => '08:00',
                'starting_point' => 'School',
                'destination' => 'Town',
                'no_of_people' => 40,
                'status' => 'Cancelled',
            ],
            [
                'school_vehicle_id' => 3,
                'title' => 'Daily Commute',
                'description' => 'Commute to School',
                'schedule_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'schedule_time' => '16:00',
                'starting_point' => 'Town',
                'destination' => 'School',
                'no_of_people' => 40,
                'status' => 'In Progress'
            ],
        ];

        TransportSchedule::insert($transport_schedules);
    }
}
