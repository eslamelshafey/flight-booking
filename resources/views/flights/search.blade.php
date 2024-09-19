@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Flights</h1>

    <form id="flight-search-form">
        @csrf
        <div class="form-group">
            <label for="departure_city">Departure City:</label>
            <input type="text" id="departure_city" name="departure_city" class="form-control">
        </div>
        <div class="form-group">
            <label for="arrival_city">Arrival City:</label>
            <input type="text" id="arrival_city" name="arrival_city" class="form-control">
        </div>
        <div class="form-group">
            <label for="travel_date">Travel Date:</label>
            <input type="date" id="travel_date" name="travel_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div id="search-results"></div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#flight-search-form').on('submit', function (e) {
        e.preventDefault();

        var departureCity = $('#departure_city').val();
        var arrivalCity = $('#arrival_city').val();
        var travelDate = $('#travel_date').val();

        $.ajax({
            url: "{{ route('flights.ajax-search') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                departure_city: departureCity,
                arrival_city: arrivalCity,
                travel_date: travelDate
            },
            success: function (response) {
                $('#search-results').html(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
