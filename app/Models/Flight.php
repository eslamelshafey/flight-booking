<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = ['departure_city', 'arrival_city', 'travel_date', 'available_seats', 'price', 'created_by'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvaliableSeats($query) {
        return $query->where('available_seats', '>', '0')->whereDate('travel_date', '>', Carbon::now());
    } // end of avaliableSeatsScope

    static function search() {
    
        $fillables = (new Flight)->getFillable();

        $q = Flight::query();

        foreach($fillables as $fillable) {
            
            if(!in_array($fillable, ['travel_date']) && !request()->input($fillable)) continue;

            $q->where($fillable, 'LIKE', '%'.request()->input($fillable).'%');

        }

        if(request()->input('start_date') && request()->input('end_date')) {
            $q->whereBetween('travel_date', [request()->input("start_date"), request()->input("end_date")]);
        }

        return $q->where('available_seats', '>', 0);
    
    } // end of search
}
