<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/car/new', function () {
    return view('newCar');
});

Auth::routes();

Route::get('/', 'CarController@allCars');
Route::get('/car/{id}', 'CarController@particularCar');
//Route::get('/car/new', 'CarController@newCarForm');
Route::post('/car', 'CarController@newCar');
