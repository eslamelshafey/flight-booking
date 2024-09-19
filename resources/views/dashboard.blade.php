@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href='/flights' class="card">{{ __("Flights") }}</a>
            <a href='/booking' class="card">{{ __("Booking") }}</a>
        </div>
    </div>
</div>
@endsection
