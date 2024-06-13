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
                'name' => 'User One',
                'email' => 'user1@email.com',
                'password' => bcrypt('Password123*')
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@email.com',
                'password' => bcrypt('Password123*')
            ],
            [
                'name' => 'User Three',
                'email' => 'user3@email.com',
                'password' => bcrypt('Password123*')
            ]
        ];

        User::insert($users);
    }
}
