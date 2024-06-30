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
        // Used for testing. Emails are not real.
        $users =[
            [
                'name' => 'Driver One',
                'email' => 'user1@email.com',
                'password' => bcrypt('Password123*'),
                'phone' => '+254712345678'
            ],
            [
                'name' => 'Driver Two',
                'email' => 'user2@email.com',
                'password' => bcrypt('Password123*'),
                'phone' => '+254712345678'
            ],
        ];

        User::insert($users);
    }
}
