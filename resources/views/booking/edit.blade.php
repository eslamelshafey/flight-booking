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

    <h1>Edit Booking</h1>
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="flight_id">{{ __('Flight') }}</label>
            <select name="flight_id" id="flight_id" class="form-control" required>
                @foreach ($flights as $flight)
                    <option value="{{ $flight->id }}" {{ $flight->id == $booking->flight_id ? 'selected' : '' }}>
                        {{ $flight->departure_city }} to {{ $flight->arrival_city }} on {{ $flight->travel_date }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $booking->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $booking->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">{{ __('Phone Number') }}</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $booking->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="booked_seats">{{ __('Booked Seats') }}</label>
            <input type="text" name="booked_seats" id="booked_seats" class="form-control" value="{{ $booking->booked_seats }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection
