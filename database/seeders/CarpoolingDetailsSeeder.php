<?php

namespace Database\Seeders;

use App\Models\CarpoolingDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarpoolingDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add 3 carpooling details
        $carpoolingDetails = [
            [
                'carpool_request_id' => 1,
            ],
            [
                'carpool_request_id' => 2,
            ],
            [
                'carpool_request_id' => 3,
            ]
        ];

        CarpoolingDetails::insert($carpoolingDetails);
    }
}
