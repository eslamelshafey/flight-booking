@extends('layouts.app')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Book a Flight</h1>
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="flight_id">Flight</label>
            <select name="flight_id" id="flight_id" class="form-control" required>
                @foreach ($flights as $flight)
                    <option {{ $flightId == $flight->id ? 'selected' : '' }} value="{{ $flight->id }}">{{ $flight->departure_city }} to {{ $flight->arrival_city }} on {{ $flight->travel_date }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input value="{{ old('name') }}" type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input value="{{ old('phone') }}" type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="booked_seats">Booked Seats</label>
            <input value="{{ old('booked_seats') }}" type="number" name="booked_seats" id="booked_seats" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Flight</button>
    </form>
</div>
@endsection
