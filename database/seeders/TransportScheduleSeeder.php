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
                'description' => 'Commute to Town',
                'schedule_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'schedule_time' => '08:00:00',
                'starting_point' => 'School',
                'destination' => 'Town'
            ],
            [
                'description' => 'Commute to School',
                'schedule_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'schedule_time' => '16:00:00',
                'starting_point' => 'Town',
                'destination' => 'School'
            ],
            [
                'description' => 'Commute to Town',
                'schedule_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'schedule_time' => '18:00:00',
                'starting_point' => 'School',
                'destination' => 'Town'
            ],
            [
                'description' => 'Commute to School',
                'schedule_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'schedule_time' => '22:00:00',
                'starting_point' => 'Town',
                'destination' => 'School'
            ],
            [
                'description' => 'Commute to Town',
                'schedule_date' => Carbon::now()->addDays(9)->format('Y-m-d'),
                'schedule_time' => '08:00:00',
                'starting_point' => 'School',
                'destination' => 'Town'
            ],
            [
                'description' => 'Commute to School',
                'schedule_date' => Carbon::now()->addDays(9)->format('Y-m-d'),
                'schedule_time' => '16:00:00',
                'starting_point' => 'Town',
                'destination' => 'School'
            ]

        ];

        TransportSchedule::insert($transport_schedules);
    }
}
