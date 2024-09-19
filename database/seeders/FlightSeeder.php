<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FlightSeeder extends Seeder
{
    public function run()
    {
        Flight::factory()->count(50)->create();
    }
}

