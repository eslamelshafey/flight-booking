<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index', [
            'bookings'=>Booking::orderBy('id', "DESC")->paginate(10),
        ]);
    }

    public function create()
    {
        return view('booking.create', [
            'flights'=>Flight::orderBy('id', 'DESC')->select('departure_city', 'arrival_city', 'travel_date', 'id')->AvaliableSeats()->get(),
            'flightId'=>request()->input('flight_id'),
        ]);
    }

    public function store(BookingRequest $request)
    {
        $flight = Flight::avaliableSeats()->findOrFail($request->input('flight_id'));

        if ($flight->available_seats <= 0) {
            return back()->withErrors(['msg' => 'Flight is fully booked!']);
        }

        $data = $request->validated();
        $data = array_merge($data, [
            'created_by' => auth()->id(),
            'flight_id' => $flight->id,
        ]);

        try {
        \DB::beginTransaction();

            $booking = Booking::create($data);
    
            $flight->available_seats -= $booking->booked_seats;
    
            $flight->save();

            Mail::to($booking->email)->queue(new BookingConfirmation($booking));
    
            \DB::commit();

            return redirect()->route('booking.show', $booking->id);
    
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['msg' => 'Booking failed! Please try again.']);
        }
    } // end of store

    public function update(BookingRequest $request, Booking $booking)
    {
        $flight = Flight::findOrFail($booking->flight_id);
        $oldSeats = $booking->booked_seats;
        $newSeats = $request->booked_seats ?? 1;
    
        if (($flight->available_seats + $oldSeats) < $newSeats) {
            return redirect()->back()->withErrors(['error' => 'The flight is fully booked']);
        }

        $booking->update($request->validated());
    
        $flight->available_seats = $flight->available_seats + $oldSeats - $newSeats;
        $flight->save();
    
        return redirect()->route('booking.index')->with('success', 'Booking updated successfully');
    } // end of update

    public function destroy(Booking $booking)
    {
        $flight = Flight::find($booking->flight_id);
    
        $flight->available_seats += $booking->booked_seats;
        $flight->save();
    
        $booking->delete();
    
        return redirect()->route('booking.index')->with('success', 'You have undo your booking action');
    } // end of destroy

    public function show($id) {
        $booking = Booking::where([
            ['created_by', auth()->id()],
            ['id', $id],
        ])->with('flight')->first();

        if($booking) {
            return view('booking.show')->with('booking', $booking);
        }

        return abort(404);
    } // end of show
}
