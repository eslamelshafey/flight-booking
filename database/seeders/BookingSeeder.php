<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Flight::count() > 0) {
            Booking::factory()->count(100)->create();
        } else {
            $this->command->info('No flights found, skipping booking seeding.');
        }
    }
}
