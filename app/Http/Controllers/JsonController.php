<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gauge;
use Illuminate\Support\Facades\Auth;

class JsonController extends Controller
{
    public function getAllGauges(){
        $gauges = Gauge::where("city","like","%NC")->get();
        return $gauges;
    }

    public function getAllGaugesWA(){
        $gauges = Gauge::where("city","like","%WA")->get();
        return $gauges;
    }
    public function getAllGaugesIL(){
        $gauges = Gauge::where("city","like","%IL")->get();
        return $gauges;
    }
    
    public function getAllGaugesMA(){
        $gauges = Gauge::where("city","like","%MA")->get();
        return $gauges;
    }

    public function getAllGaugesFR(){
        $gauges = Gauge::where("city","like","%France")->get();
        return $gauges;
    }
    public function getAllGaugesBD(){
        $gauges = Gauge::where("city","like","%BD")->get();
        return $gauges;
    }
    public function getAllGaugesNH(){
        $gauges = Gauge::where("city","like","%NH")->get();
        return $gauges;
    }
    public function reading_entry(){

            //load form view
            if(Auth::check()) {
                return view('readings.csv');
            }
            return redirect('login');
            
    }
    public function fileUpload(){
        echo " successful";
    }

}
