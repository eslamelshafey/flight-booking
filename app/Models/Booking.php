<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = ['flight_id', 'name', 'email', 'phone', 'created_by', 'booked_seats'];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
