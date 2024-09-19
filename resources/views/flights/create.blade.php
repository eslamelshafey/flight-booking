@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Flight</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        
    <form action="{{ route('flights.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="departure_city">{{ __('Departure City') }}</label>
            <input type="text" value="{{ old('departure_city') }}" name="departure_city" id="departure_city" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="arrival_city">{{ __('Arrival City') }}</label>
            <input type="text" value="{{ old('arrival_city') }}" name="arrival_city" id="arrival_city" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="available_seats">{{ __('Available Seats') }}</label>
            <input type="number" value="{{ old('available_seats') }}" name="available_seats" id="available_seats" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="number" value="{{ old('price') }}" name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="travel_date">{{ __('Travel Date') }}</label>
            <input type="date" value="{{ old('travel_date') }}" name="travel_date" id="travel_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Flight') }}</button>
    </form>
</div>
@endsection
