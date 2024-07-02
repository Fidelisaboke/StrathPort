<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* Create users and assign the roles*/

        // Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'user1@email.com',
            'password' => bcrypt('Password123*'),
            'phone' => '+254712345678',
            'email_verified_at' => time(),
        ]);

        $admin->assignRole('admin');

        // Student
        $student = User::create([
            'name' => 'Student One',
            'email' => 'user2@email.com',
            'password' => bcrypt('Password123*'),
            'phone' => '+254712345678',
            'email_verified_at' => time(),
        ]);

        $student->assignRole('student');

        // Staff
        $staff = User::create([
            'name' => 'Staff One',
            'email' => 'user3@email.com',
            'password' => bcrypt('Password123*'),
            'phone' => '+254712345678',
            'email_verified_at' => time(),
        ]);

        $staff->assignRole('staff');

        // Carpool Driver
        $carpoolDriver = User::create( [
            'name' => 'Carpool Driver',
            'email' => 'user4@email.com',
            'password' => bcrypt('Password123*'),
            'phone' => '+254712345678',
            'email_verified_at' => time(),
        ]);

        $carpoolDriver->assignRole('carpool_driver');

        // Another Carpool Driver
        $carpoolDriver = User::create( [
            'name' => 'Carpool Driver Two',
            'email' => 'user5@email.com',
            'password' => bcrypt('Password123*'),
            'phone' => '+254712345678',
            'email_verified_at' => time(),
        ]);

        $carpoolDriver->assignRole('carpool_driver');

    }
}
