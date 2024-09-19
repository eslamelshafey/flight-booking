<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightSearchTest extends TestCase
{

    public function test_flight_search_returns_correct_results()
    {
        $response = $this->get('/flights/search?departure_city=Cairo&arrival_city=Dubai&travel_date=2024-09-30');
        $response->assertStatus(200);
        $response->assertSee('Flights from Cairo to Dubai');
    } // end of test_flight_search_returns_correct_results

}
