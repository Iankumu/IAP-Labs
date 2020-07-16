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
        //checks and validates the form
        $this->validate($request,[
            'model'=>'required|unique',
            'make'=>'required|unique',
            'produced_on'=>'required|unique'
        ]);

        $car = new Car;
        $car->model= request('model');
        $car->make= request('make');
        $car->produced_on= request('produced_on');
        $car->save();

        return redirect('/')->with('success','Form submission was successful');

    }
}
