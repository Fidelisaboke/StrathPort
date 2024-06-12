<?php

namespace Database\Seeders;

use App\Models\TransportSchedule;
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
                'schedule_date' => '2024-06-12',
                'schedule_time' => '08:00:00',
                'starting_point' => 'School',
                'destination' => 'Town'
            ],
            [
                'description' => 'Commute to School',
                'schedule_date' => '2024-06-12',
                'schedule_time' => '16:00:00',
                'starting_point' => 'Town',
                'destination' => 'School'
            ],
            [
                'description' => 'Commute to Town',
                'schedule_date' => '2024-06-13',
                'schedule_time' => '08:00:00',
                'starting_point' => 'School',
                'destination' => 'Town'
            ],
            [
                'description' => 'Commute to School',
                'schedule_date' => '2024-06-13',
                'schedule_time' => '16:00:00',
                'starting_point' => 'Town',
                'destination' => 'School'
            ],
            [
                'description' => 'Mt. Kenya Trip',
                'schedule_date' => '2024-06-14',
                'schedule_time' => '06:00:00',
                'starting_point' => 'School',
                'destination' => 'Central Kenya'
            ]

        ];

        TransportSchedule::insert($transport_schedules);
    }
}
