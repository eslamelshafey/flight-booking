@extends('layouts.app')

@section('styles')
    @include('components.search.style')
@endsection

@section('content')
<div class="container">
    <h1>Flights</h1>
    <a href="{{ route('flights.create') }}" class="btn btn-primary">Add New Flight</a>

    @include('components.search.index', [
        'departureCities'=>$departureCities,
        'arrivalCities'=>$arrivalCities,
    ])

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
