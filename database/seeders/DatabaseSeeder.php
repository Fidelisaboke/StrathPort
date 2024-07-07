<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            StaffSeeder::class,
            CarpoolDriverSeeder::class,
            CarpoolVehicleSeeder::class,
            SchoolDriverSeeder::class,
            SchoolVehicleSeeder::class,
            TransportRequestSeeder::class,
            TransportScheduleSeeder::class,
            CarpoolRequestSeeder::class,
            CarpoolingDetailsSeeder::class,
        ]);
    }
}
