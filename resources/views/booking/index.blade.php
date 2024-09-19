@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bookings</h1>

    <a href="{{ route('booking.create') }}" class="btn btn-primary">Book A New Flight</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Flight</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Booked Seats</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->flight->departure_city }} to {{ $booking->flight->arrival_city }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->email }}</td>
                <td>{{ $booking->phone_number }}</td>
                <td>{{ $booking->booked_seats }}</td>
                <td>
                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('booking.show', $booking->id) }}">Invoice</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bookings->links() }}
</div>
@endsection
