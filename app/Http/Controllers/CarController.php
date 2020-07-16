<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;


class CarController extends Controller
{
    public function allCars(){
        $cars = Car::all();
        return view('allcars',['cars'=>$cars]);
    }
    public function particularCar($id){
        Car::find($id);

    }
    public function newCar(Request $request){
        $car = new Car;
        $car->model= request('model');
        $car->make= request('make');
        $car->produced_on= request('produced_on');
        $car->save();
        $request->session()->flash('form_status','Form submission was successful');

        return redirect('/');

    }
}
