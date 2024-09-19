@extends('layouts.app')

@section('content')
<div class="container">

    <div class="container mt-5">

        <div class="row">
        
            <div class="col-md-4">
                <a href='/flights' class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ __("Flights") }}</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href='/booking' class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ __("Booking") }}</h5>
                    </div>
                </a>
            </div>

        </div>

    </div>
    
@endsection
