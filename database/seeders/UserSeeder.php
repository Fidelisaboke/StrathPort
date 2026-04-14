<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'user1@example.com', 'role' => 'admin'],
            ['name' => 'Student One', 'email' => 'user2@example.com', 'role' => 'student'],
            ['name' => 'Staff One', 'email' => 'user3@example.com', 'role' => 'staff'],
            ['name' => 'Carpool Driver', 'email' => 'user4@example.com', 'role' => 'carpool_driver'],
            ['name' => 'Carpool Driver Two', 'email' => 'user5@example.com', 'role' => 'carpool_driver'],
            ['name' => 'User One', 'email' => 'user6@example.com', 'role' => null],
        ];

        $this->command->info('--------------------------------------------------');
        $this->command->info('Seeding Users with Random Passwords:');
        $this->command->info('--------------------------------------------------');

        foreach ($users as $userData) {
            $password = Str::random(12);

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt($password),
                'phone' => '+254712345678',
                'account_status' => 'active',
                'email_verified_at' => now(),
            ]);

            if ($userData['role']) {
                $user->assignRole($userData['role']);
            }

            $this->command->info("User: {$userData['email']} | Password: {$password}");
        }

        $this->command->info('--------------------------------------------------');
    }
}
