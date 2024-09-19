@if($flights->isEmpty())
    <p>No flights found matching your search criteria.</p>
@else
    <h3>Available Flights:</h3>
    <ul class="list-group">
        @foreach($flights as $flight)
        <li class="list-group-item">
            Flight from {{ $flight->departure_city }} to {{ $flight->arrival_city }} on {{ $flight->travel_date }} - ${{ $flight->price }}
            <br>
            Available Seats: {{ $flight->available_seats }}
            <br>
            <a href="{{ route('flights.book', $flight->id) }}" class="btn btn-primary mt-2">Book Now</a>
        </li>
        @endforeach
    </ul>
    <div class="pagination-links">
        {{ $flights->links() }}
    </div>
@endif
