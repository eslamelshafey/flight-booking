<?php

use App\Models\Flight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['throttle:10,1'])->group(function () {
    Auth::routes();
});

Route::group(['namespace'=>'App\\Http\\Controllers'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::group(['middleware'=>'auth'], function () {

        Route::group(['prefix'=>'booking', 'as'=>'booking.'], function () {
            Route::resource('/', 'BookingController')->parameter('', 'id');
        });

        // 'middleware'=>'role:admin'
        Route::group(['prefix'=>'flights', 'as'=>'flights.'], function () {
            Route::resource('/', 'FlightsController')->parameter('', 'flight');
            Route::post('/ajax-search', 'FlightsController@ajaxSearch')->name('.ajax-search');
        });
    
    });

});
