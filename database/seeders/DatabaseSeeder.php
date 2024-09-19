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

        // User::factory(10)->create();

        if(!User::find(1)) {
            User::create([
                'name'=>'test',
                'email'=>'test@test.com',
                'phone_number'=>'0123123123',
                'password'=>password_hash('asdasdasd', PASSWORD_BCRYPT),
            ]);
        }

        $this->call([
            FlightSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
