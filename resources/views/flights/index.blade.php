@extends('layouts.app')

@section('styles')

<style>
    .form-group{
        display: inline-block;
    }
</style>

@endsection

@section('content')
<div class="container">
    <h1>Flights</h1>
    <a href="{{ route('flights.create') }}" class="btn btn-primary">Add New Flight</a>

    <form action="{{ route('flights.index') }}" id="flight-search-form">
        <div class="form-group">
            <label for="departure_city">Departure City:</label>
            <select class="form-select" id="departure_city" name="departure_city">
                <option value="">Select Departure City</option>
                @foreach($departureCities as $departureCity)
                    <option {{ request()->input('departure_city') == $departureCity ? 'selected' : '' }} value="{{ $departureCity }}">{{ $departureCity }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="arrival_city">Arrival City:</label>
            <select class="form-select" id="arrival_city" name="arrival_city">
                <option value="">Select Arrival City</option>
                @foreach($arrivalCities as $arrivalCity)
                    <option {{ request()->input('arrival_city') == $arrivalCity ? 'selected' : '' }} value="{{ $arrivalCity }}">{{ $arrivalCity }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
        </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
        </div>

        <button type="submit">Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Departure City</th>
                <th>Arrival City</th>
                <th>Travel Date</th>
                <th>Available Seats</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flights as $flight)
            <tr>
                <td>{{ $flight->id }}</td>
                <td>{{ $flight->departure_city }}</td>
                <td>{{ $flight->arrival_city }}</td>
                <td>{{ $flight->travel_date }}</td>
                <td>{{ $flight->available_seats }}</td>
                <td>{{ $flight->price }}</td>
                <td>
                    <a href="{{ route('flights.edit', $flight->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @if ($flight->available_seats > 0 && Carbon\Carbon::parse($flight->travel_date)->isFuture())
                        <a href="{{ route('booking.create') }}?flight_id={{ $flight->id }}" class="btn btn-warning btn-sm">Book a flight</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $flights->links() }}
</div>
@endsection
