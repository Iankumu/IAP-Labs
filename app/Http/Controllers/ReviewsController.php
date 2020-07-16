<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Resources\ReviewsResource;
use App\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
   public function readAllWithId($id){
       $response=Reviews::find($id);

       return new ReviewsResource($response);
   }

   public function getCarDetails($id){
//            $array = array();
            $car_id = DB::table('reviews')->select('car_id')->where('id',$id)->first();

           $newCarID = $car_id->car_id;

            $make = $this->carmake($newCarID);
            $model = $this->carmodel($newCarID);
            $produced = $this->carproduced_on($newCarID);
            $result = [$make,$model,$produced];
            return new ReviewsResource($result);


   }
   public function carmake($car_id){
       $result = DB::table('cars')->select('make')->where('id', $car_id)->first();
       return $result->make;
   }
    public function carmodel($car_id){
        $result = DB::table('cars')->select('model')->where('id', $car_id)->first();
        return $result->model;
    }
    public function carproduced_on($car_id){
        $result = DB::table('cars')->select('produced_on')->where('id', $car_id)->first();
        return $result->produced_on;
    }

    public function getCarReviews($id){
        $result = DB::table('reviews')->where('car_id', $id)->first();
        $array=(array)$result;
        return new ReviewsResource($array);

    }
}
