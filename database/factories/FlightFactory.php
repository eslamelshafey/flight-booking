<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'travel_date' => Carbon::now()->subMonth(6)->addDays(rand(1, 365)),
            'available_seats' => rand(30, 100),
            'price' => rand(100, 1000),
            'created_by'=>'1',
        ];
    }
}
