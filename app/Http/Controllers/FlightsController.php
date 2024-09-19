<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlightRequest;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FlightsController extends Controller
{
    public function index()
    {
        return view('flights.index', [
            'flights'=>Flight::orderBy('id', "DESC")->paginate(10)
        ]);
    }
    
    public function create()
    {
        return view('flights.create');
    }
    
    public function store(FlightRequest $request)
    {
        $data = $request->validated();
        
        $data['created_by'] = auth()->id();

        Flight::create($data);

        return redirect()->route('flights.index')->with('success', 'Flight created successfully.');
    }
    
    public function edit(Flight $flight)
    {
        return view('flights.edit', compact('flight'));
    }
    

    public function update(FlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());
        return redirect()->route('flights.index')->with('success', 'Flight updated successfully.');
    }
    
    public function destroy(Flight $flight)
    {
        $flight->delete();
        return redirect()->route('flights.index')->with('success', 'Flight deleted successfully.');
    }
    
    public function search(Request $request)
    {
        return view('flights.search-results', [
            'flights'=>Flight::search()->paginate(10),
        ]);
    } // end of search

    public function ajaxSearch(Request $request)
    {
        $cacheKey = 'flights_search_' . md5($request->departure_city . $request->arrival_city . $request->travel_date);
        $flights = Cache::remember($cacheKey, 15, function () use ($request) {
            return Flight::search()->paginate(10);
        });

        if(!$flights->count()) {
            $flights = Flight::search()->paginate(10);
        }

        return view('flights.components.search-results', compact('flights'))->render();
    } // end of ajaxSearch
}
