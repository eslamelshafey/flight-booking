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

    <button class="btn btn-primary" type="submit">Search</button>
</form>
