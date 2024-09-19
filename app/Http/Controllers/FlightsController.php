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
        $cacheKey = null;
        if(request()->input('departure_city') || request()->input('arrival_city')) {
            $cacheKey = request()->input('departure_city') . request()->input('arrival_city');
            $cacheKey = str_replace(' ', '_', strtolower($cacheKey));
        }

        if($cacheKey) {
            $flights = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return Flight::search()->orderBy('id', "DESC")->paginate(10);
            });
        } else {
            $flights = collect();
        }

        // dd($flights);
        
        if(!$flights->count()) {
            $flights = Flight::search()->orderBy('id', "DESC")->paginate(10);
        }

        $cities = Cache::remember('cities', now()->addMinutes(20), function () {
            return Flight::select('arrival_city', 'departure_city')->get();
        });
        
        return view('flights.index', [
            'flights'=>$flights,
            'departureCities'=>$cities->pluck('departure_city'),
            'arrivalCities'=>$cities->pluck('arrival_city'),
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

}
