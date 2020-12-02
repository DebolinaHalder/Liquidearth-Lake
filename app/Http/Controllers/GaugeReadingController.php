<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Gauge;
use App\GaugeReading;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class GaugeReadingController extends Controller
{
    public function index(){

        //$readings = GaugeReading::orderBy('created_at','desc')->get();
        $readings=DB::select("SELECT * FROM gauges, gauge_readings WHERE gauges.id=gauge_readings.gauge_inc_id");
        return view('readings.index', ['readings' => $readings]);
    }
    public function create($id){
        //load form view
        $gauge = Gauge::findOrFail($id);
        //print_r($gauge);
        return view('readings.create',['gauge' => $gauge]);
    }

    //for google map
    public function map_create($id){
        //load form view
        $gauge = Gauge::findOrFail($id);
        return view('readings.mapcreate',['gauge' => $gauge]);
    }
    public function map_store(Request $request)
    {
        $input = $request->all();
        GaugeReading::create($input);

        if(strcmp($input['is_bubble_level_okay'],"No") == 0 ){

            $gauge_id_name = explode(':',$input['gauge_name']);
            $input_problem=['gauge_id'=>$gauge_id_name[0],'date'=>$input['date'],'time'=>$input['time'],'problem'=>"Bubble level is not okay"];
            Problem::create($input_problem);
            $data = array('name'=>"Citizen Science",'gauge_id'=>$gauge_id_name[0],'date'=>$input['date'],'time'=>$input['time'],'problem'=>"Bubble level is not okay");
            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to('armanbd7@gmail.com', 'Admin')->subject
                ('Gauge problem');
                $message->from('testarman445@gmail.com','Citizen Science');
            });


        }
        Session::flash('flash_message', 'The measurement is added successfully');
        return redirect()->route('gauges.scaleddetailssixm',$input['gauge_inc_id']);
    }


    public function store(Request $request)
    {
        /*$this->validate($request, array(
                'title' => 'required',
                'slug' => 'required',
                'short_description' => 'required',
                'full_content' => 'required',
            )
        );*/
        $request = $request->all();
        $input = json_encode($request);
        //dd($input);
        $data = array('name'=>'abcd');
        Mail::send(['text'=>'debug'], $data, function($message) {
            $message->to('debolinahalder.buet@gmail.com', 'Admin')->subject
            ('Gauge problem');
            $message->from('testarman445@gmail.com','Citizen Science');
        });
        //return redirect()->route('readings.gaugeselect');
        $reading = json_decode($input, true);

        //dd($reading);
        //$dt = new DateTime($reading['time']);
        $input = ['gauge_inc_id' => $reading['gauge_inc_id'], 'height' => $reading['height'], 'date' => $reading['date'], 'time' => $reading['time'], 'entry_type'=>"bd_api"];
        GaugeReading::create($input);

        /*GaugeReading::create($input);

        if(strcmp($input['is_bubble_level_okay'],"No") == 0 ){

            $gauge_id_name = explode(':',$input['gauge_name']);
            $input_problem=['gauge_id'=>$gauge_id_name[0],'date'=>$input['date'],'time'=>$input['time'],'problem'=>"Bubble level is not okay"];
            Problem::create($input_problem);
            $data = array('name'=>"Citizen Science",'gauge_id'=>$gauge_id_name[0],'date'=>$input['date'],'time'=>$input['time'],'problem'=>"Bubble level is not okay");
            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to('armanbd7@gmail.com', 'Admin')->subject
                ('Gauge problem');
                $message->from('testarman445@gmail.com','Citizen Science');
            });


        }

        Session::flash('flash_message', 'The measurement is added successfully');

        //return redirect()->back();
        //return redirect('news');*/
        return redirect()->route('gauges.scaleddetailssixm',$input['gauge_inc_id']);
    }
    //

    public function report_problem(Request $request){
        $input=$request->all();
        $gauge_id_name = explode(':',$input['gauge_id']);
        $input['gauge_id']=$gauge_id_name[0];
        print_r($input);
        Problem::create($input);

        $data = array('name'=>"Citizen Science",'gauge_id'=>$gauge_id_name[0],'date'=>$input['date'],'time'=>$input['time'],'problem'=>$input['problem']);

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('armanbd7@gmail.com', 'Admin')->subject
            ('Gauge problem');
            $message->from('testarman445@gmail.com','Citizen Science');
        });
        return redirect()->route('readings.gaugeselect');

    }

    public function edit($id){
        //$reading=DB::select("SELECT * FROM gauges, gauge_readings where gauges.id=gauge_inc_id and gauge_readings.id={$id}");
        if(Auth::check()) {
            $reading = DB::table('gauges')
                ->join('gauge_readings', 'gauge_readings.gauge_inc_id', '=', 'gauges.id')
                ->where('gauge_readings.id', '=', $id)
                ->first();
            // print_r($reading);
            return view('readings.edit', ['reading' => $reading,]);
        }
        else{
            return redirect('login');
        }
    }

    public function update($id,Request $request){


        $reading = GaugeReading::findOrFail($id);
        $input = $request->all();
        //print_r($input);

        GaugeReading::find($id)->update($input);

        //store status message
        Session::flash('flash_message', 'Measurement updated successfully!');
        return redirect()->route('gauges.scaleddetailssixm',$reading->gauge_inc_id);
    }

    public function delete($id)
    {
        $reading = GaugeReading::findOrFail($id);
        // delete
        GaugeReading::find($id)->delete();
        Session::flash('flash_message', 'Successfully deleted the Measurement!');
        return redirect()->route('gauges.scaleddetailssixm',$reading->gauge_inc_id);
    }

    public function view_problem(){
        if(Auth::check()) {
            $problems = Problem::orderBy('created_at', 'desc')->get();
            return view('readings.problem', ['problems' => $problems]);
        }
        else{
            return redirect('login');
        }

    }
    public function gauge_select(){
        $gauges = Gauge::where("city","like","%NC")->orderBy('name', 'asc')->get();
        return view('readings.gaugeselect',['gauges' => $gauges]);
    }
    public function gauge_select_map(){
        $gauges = Gauge::where("city","like","%NC")->orderBy('gauge_id', 'asc')->get();
        return view('readings.gaugeselectmap',['gauges' => $gauges]);
    }
    
        /////*****************************************Start Washington*****************************
    public function gauge_select_wa(){
        $gauges = Gauge::where("city","like","%WA")->orderBy('name', 'asc')->get();
        return view('readings.gaugeselectwa',['gauges' => $gauges]);
    }
    public function gauge_select_map_wa(){
        $gauges = Gauge::where("city","like","%WA")->orderBy('gauge_id', 'asc')->get();
        return view('readings.gaugeselectmapwa',['gauges' => $gauges]);
    }

    ///   ####################################### End Washington ##############################
             /////*****************************************Start Illinois*****************************
    public function gauge_select_il(){
        $gauges = Gauge::where("city","like","%IL")->orderBy('name', 'asc')->get();
        return view('readings.gaugeselectil',['gauges' => $gauges]);
    }
    public function gauge_select_map_il(){
        $gauges = Gauge::where("city","like","%IL")->orderBy('gauge_id', 'asc')->get();
        return view('readings.gaugeselectmapil',['gauges' => $gauges]);
    }

    ///   ####################################### End Illionis ##############################
    
                /////*****************************************Start Massachusetts*****************************
    public function gauge_select_ma(){
        $gauges = Gauge::where("city","like","%MA")->orderBy('name', 'asc')->get();
        return view('readings.gaugeselectma',['gauges' => $gauges]);
    }
    public function gauge_select_map_ma(){
        $gauges = Gauge::where("city","like","%MA")->orderBy('gauge_id', 'asc')->get();
        return view('readings.gaugeselectmapma',['gauges' => $gauges]);
    }

    ///   ####################################### End Massachusetts ##############################

            /////*****************************************Start Massachusetts*****************************
            public function gauge_select_fr(){
                $gauges = Gauge::where("city","like","%France")->orderBy('name', 'asc')->get();
                return view('readings.gaugeselectfr',['gauges' => $gauges]);
            }
            public function gauge_select_map_fr(){
                $gauges = Gauge::where("city","like","%France")->orderBy('gauge_id', 'asc')->get();
                return view('readings.gaugeselectmapfr',['gauges' => $gauges]);
            }
        
            ///   ####################################### End Massachusetts ##############################
    /// ##############################start bd ##########################################
            public function gauge_select_bd(){
                $gauges = Gauge::where("city","like","%BD")->orderBy('name', 'asc')->get();
                return view('readings.gaugeselectbd',['gauges' => $gauges]);
            }
    public function gauge_select_map_bd(){
        $gauges = Gauge::where("city","like","%BD")->orderBy('gauge_id', 'asc')->get();
        return view('readings.gaugeselectmapbd',['gauges' => $gauges]);
    }
    ////// ###### Function for new hampshire
    public function gauge_select_nh(){
        $gauges = Gauge::where("city","like","%NH")->orderBy('name', 'asc')->get();
        return view('readings.gaugeselectnh',['gauges' => $gauges]);
    }
    public function gauge_select_map_nh(){
        $gauges = Gauge::where("city","like","%NH")->orderBy('gauge_id', 'asc')->get();
        return view('readings.gaugeselectmapnh',['gauges' => $gauges]);
    }
    public function download(){
        return view('readings.download');
    }
}
