<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//read all reviews of a car of some id
Route::get('reviews/{id}','ReviewsController@readAllWithId');
//read car details of a review of some id
Route::get('car_details/{id}','ReviewsController@getCarDetails');
//return all reviews of a given car in JSON format.
Route::get('getReviews/{id}','ReviewsController@getCarReviews');
