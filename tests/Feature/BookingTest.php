<?php

namespace Tests\Feature;

use App\Models\Flight;
use App\Models\User;
use Tests\TestCase;

class BookingTest extends TestCase
{
    public function test_user_can_book_a_flight()
    {
        $flight = Flight::factory()->create(['available_seats' => 10]);
    
        $this->actingAs(User::factory()->create())
        ->post('/bookings', [
            'flight_id' => $flight->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ])
        ->assertRedirect('/bookings/success');
    } // end of test_user_can_book_a_flight
}
