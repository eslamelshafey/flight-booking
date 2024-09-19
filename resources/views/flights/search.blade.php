@extends('layouts.app')

@section('styles')
    @include('components.search.style')
@endsection

@section('content')
<div class="text-center">
    @include('components.search.index', [
        'departureCities'=>$departureCities,
        'arrivalCities'=>$arrivalCities,
    ])
</div>
@endsection
