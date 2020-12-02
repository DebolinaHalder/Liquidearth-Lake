<?php

namespace App\Http\Controllers;

use App\GaugeReading;
use ConsoleTVs\Charts\Builder\Database;
use Illuminate\Http\Request;

use App\Gauge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use ConsoleTVs\Charts\Facades\Charts;
use phpDocumentor\Reflection\Types\Null_;
use App\User;

class GaugeController extends Controller
{
    public function map_view(){

        $gauges = Gauge::orderBy('gauge_id', 'asc')->get();
        return view('gauges.mapview', ['gauges' => $gauges]);


    }


    public function index(){

        $gauges = Gauge::orderBy('name', 'asc')->get();
        return view('gauges.index', ['gauges' => $gauges]);


    }





    public function create(){

        //load form view
        if(Auth::check()) {
            return view('gauges.create');
        }
        return redirect('login');
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
        $this->validate($request, [
            'gauge_id' => 'required|unique:gauges|max:255',
        ]);

        $input = $request->all();
        Gauge::create($input);
        Session::flash('flash_message', 'A new Gauge is created!');

        //return redirect()->back();
        //return redirect('news');
        return redirect()->route('gauges.adminview');
    }

    public function details($id){
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} ORDER BY date DESC, time DESC");

        $readings = DB::select("SELECT date as date, avg(height) as height, avg(precipi) as precipi FROM gauge_readings where gauge_inc_id={$id}  GROUP BY date");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        $heights =array();
        $dates=array();
        $precipis= array();
        foreach($readings as $reading){
            $date = strtotime($reading->date);
            $formatdate = date("m-d-Y", $date);
            array_push($heights,$reading->height);
            array_push($dates,$formatdate);
            if(strcmp($reading->precipi , "NA")) {
                array_push($precipis, $reading->precipi);
            }
        }

        array_push($heights,Null);
        array_push($heights,2.5);
        array_push($heights,2.3);
        array_push($dates,"08/12/2017");
        array_push($dates,"testdate1");
        array_push($dates,"testdate2");

        $chart=Charts::create('line', 'chartjs')
            ->title('Lake level')
            ->elementLabel("Average Height (Feet)")
            ->labels($dates)
            ->values($heights)
            ->dimensions(1000,500)
            ->responsive(false);

        return view('gauges.details', ['chart' => $chart,'readings_all'=>$readings_all,'gauge'=>$gauge]);
    }
////////////////////////////////////////////////////
    public function correct_details($id){
        $gauge=DB::table('gauges')->where('id', $id)->first();
        return view('chart.showform',['gauge' =>$gauge]);

    }

    public function show_ajax_correct_chart(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $from_date= $_GET['from_date'];
        $to_date =$_GET['to_date'];

        return view('chart.ajaxshowchart',['gauge_inc_id'=>$gauge_inc_id,'from_date'=>$from_date,'to_date'=>$to_date]);
    }

    public function get_json_height_date(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $from_date= $_GET['from_date'];
        $to_date =$_GET['to_date'];
        $readings = DB::select("SELECT date as date, avg(height) as height FROM gauge_readings where gauge_inc_id={$gauge_inc_id}
        and date BETWEEN '{$from_date}' and '{$to_date}' GROUP BY date");
        return response()->json($readings, 200);

    }
    public function scaling_map_view(){

        $gauges = Gauge::orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapview', ['gauges' => $gauges]);


    }

    ////////////////////////////////////////////////////////////////////


    public function scaled_details_six_month($id){
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-6 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} and date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY date DESC, time DESC");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        return view ('chart.detailssixmonth',['gauge' =>$gauge,'readings_all'=>$readings_all]);
    }
    public function scaled_details_one_month($id){
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-1 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} and date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY date DESC, time DESC");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        return view ('chart.detailsonemonth',['gauge' =>$gauge,'readings_all'=>$readings_all]);
    }
    public function scaled_details_three_month($id){
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-3 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} and date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY date DESC, time DESC");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        return view ('chart.detailsthreemonth',['gauge' =>$gauge,'readings_all'=>$readings_all]);
    }
    public function scaled_details_one_year($id){
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-12 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} and date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY date DESC, time DESC");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        return view ('chart.detailsoneyear',['gauge' =>$gauge,'readings_all'=>$readings_all]);
    }
    public function scaled_details_all($id){
        $gauge=DB::table('gauges')->where('id', $id)->first();
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} ORDER BY date DESC, time DESC");
        return view ('chart.detailsall',['gauge' =>$gauge,'readings_all'=>$readings_all]);
    }

    public function get_json_height_date_last_six_month(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-6 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );

        $gauge = DB::table('gauges')->where('id', $gauge_inc_id)->first();
        $min_height= $gauge->min_height;
        $max_height=$gauge->max_height;

        $readings = DB::select("SELECT date as date, avg(height) as height FROM gauge_readings where gauge_inc_id={$gauge_inc_id}
        and date BETWEEN '{$from_date}' and '{$to_date}' and height BETWEEN {$min_height} AND {$max_height} GROUP BY date");
        return response()->json($readings, 200);

    }

    public function get_json_height_date_last_one_month(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-1 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );

        $gauge = DB::table('gauges')->where('id', $gauge_inc_id)->first();
        $min_height= $gauge->min_height;
        $max_height=$gauge->max_height;

        $readings = DB::select("SELECT date as date, avg(height) as height FROM gauge_readings where gauge_inc_id={$gauge_inc_id}
        and date BETWEEN '{$from_date}' and '{$to_date}' and height BETWEEN {$min_height} AND {$max_height} GROUP BY date");
        return response()->json($readings, 200);

    }

    public function get_json_height_date_last_three_month(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-3 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );

        $gauge = DB::table('gauges')->where('id', $gauge_inc_id)->first();
        $min_height= $gauge->min_height;
        $max_height=$gauge->max_height;

        $readings = DB::select("SELECT date as date, avg(height) as height FROM gauge_readings where gauge_inc_id={$gauge_inc_id}
        and date BETWEEN '{$from_date}' and '{$to_date}' and height BETWEEN {$min_height} AND {$max_height}  GROUP BY date");
        return response()->json($readings, 200);

    }

    public function get_json_height_date_one_year(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-12 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );

        $gauge = DB::table('gauges')->where('id', $gauge_inc_id)->first();
        $min_height= $gauge->min_height;
        $max_height=$gauge->max_height;

        $readings = DB::select("SELECT date as date, avg(height) as height FROM gauge_readings where gauge_inc_id={$gauge_inc_id}
        and date BETWEEN '{$from_date}' and '{$to_date}' and height BETWEEN {$min_height} AND {$max_height}  GROUP BY date");
        return response()->json($readings, 200);

    }

    public function get_json_height_date_all(){
        $gauge_inc_id = $_GET['gauge_inc_id'];
        $to_date = date('Y-m-d');
        $from_date = strtotime ( '-6 month' , strtotime ( $to_date ) ) ;
        $from_date = date ( 'Y-m-d' , $from_date );

        $gauge = DB::table('gauges')->where('id', $gauge_inc_id)->first();
        $min_height= $gauge->min_height;
        $max_height=$gauge->max_height;
        
        $readings = DB::select("SELECT date as date, avg(height) as height FROM gauge_readings where gauge_inc_id={$gauge_inc_id}  and height BETWEEN {$min_height} AND {$max_height}  GROUP BY date");
        return response()->json($readings, 200);

    }



    //////////////////////////////////////////////




    public function details_precipi($id){
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} ORDER BY date DESC, time DESC");

        $readings = DB::select("SELECT date as date, avg(height) as height, avg(precipi) as precipi FROM gauge_readings where gauge_inc_id={$id}  GROUP BY date");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        $heights =array();
        $dates=array();
        $precipis= array();

        foreach($readings as $reading){
            $date = strtotime($reading->date);
            $formatdate = date("m-d-Y", $date);
            array_push($heights,$reading->height);
            array_push($dates,$formatdate);
            if(strcmp($reading->precipi , "NA")) {
                array_push($precipis, $reading->precipi);
            }
        }

        $chart=Charts::create('line', 'chartjs')
            ->title('Rain Fall')
            ->elementLabel("daily precipitation (inches)")
            ->labels($dates)
            ->values($precipis)
            ->dimensions(1000,500)
            ->responsive(false);

        return view('gauges.details_precipi', ['chart' => $chart,'readings_all'=>$readings_all,'gauge'=>$gauge]);
    }

    public function details_height_precipi($id){
        $readings_all=DB::select("SELECT * FROM gauge_readings WHERE gauge_inc_id={$id} ORDER BY date DESC, time DESC");

        $readings = DB::select("SELECT date as date, avg(height) as height, avg(precipi) as precipi FROM gauge_readings where gauge_inc_id={$id}  GROUP BY date");
        $gauge=DB::table('gauges')->where('id', $id)->first();
        $heights =array();
        $dates=array();
        $precipis= array();
        foreach($readings as $reading){
            $date = strtotime($reading->date);
            $formatdate = date("m-d-Y", $date);
            array_push($heights,$reading->height);
            array_push($dates,$formatdate);
            if(strcmp($reading->precipi , "NA")) {
                array_push($precipis, $reading->precipi);
            }
        }

        $chart = Charts::multi('line', 'chartjs')
            ->title('Lake level')
            ->colors(['#0000ff', '#008000'])
            ->labels($dates)
            ->dataset('Average Height(Feet)',$heights)
            ->dataset('daily precipitation (inches)',$precipis);
        return view('gauges.details_height_precipi', ['chart' => $chart,'readings_all'=>$readings_all,'gauge'=>$gauge]);
    }

    public function edit($id){
        if(Auth::check()) {
            $gauge = DB::table('gauges')->where('id', $id)->first();
            return view('gauges.edit', ['gauge' => $gauge,]);
        }
        else{
            return redirect('login');
        }
    }

    public function admin_view(){
        if(Auth::check()) {
            $gauges = Gauge::orderBy('gauge_id', 'asc')->get();
            return view('gauges.adminview', ['gauges' => $gauges]);
        }
        else{
            return redirect('login');
        }
    }
    public function update($id,Request $request){
        if(Auth::check()) {
            $gauge = Gauge::findOrFail($id);
            $input = $request->all();
            Gauge::find($id)->update($input);

            //store status message
            Session::flash('flash_message', 'Gauge updated successfully!');
            return redirect()->route('gauges.adminview');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id)
    {
        // delete

        Gauge::find($id)->delete();
        Session::flash('flash_message', 'Successfully deleted the gauge!');
        return redirect()->route('gauges.adminview');
    }
	
	    ////////////////////////////////////////////////////////////////////
    public function scaling_map_view_without_date(){

        $gauges = Gauge::where("city","like","%NC")->orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapviewwithoutdate', ['gauges' => $gauges]);


    }

    public function scaling_table_view_without_date(){

        $gauges = Gauge::where("city","like","%NC")->orderBy('name', 'asc')->get();
		for($i = 0; $i < count($gauges); $i++){
            $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count(); 
			$gauges[$i]['number_of_readings'] = $number_of_readings;
        }
        return view('gauges.scalingtableviewwithoutdate', ['gauges' => $gauges]);


    }
	
	 // **************************Function for Washington start *************************************

    public function scaling_table_view_without_date_wa(){

        $gauges = Gauge::where("city","like","%WA")->orderBy('name', 'asc')->get();
		for($i = 0; $i < count($gauges); $i++){
            $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count(); 
            $gauges[$i]['number_of_readings'] = $number_of_readings;
        }
        return view('gauges.scalingtableviewwithoutdatewa', ['gauges' => $gauges]);


    }

    public function scaling_map_view_without_date_wa(){
        $gauges = Gauge::where("city","like","%WA")->orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapviewwithoutdatewa', ['gauges' => $gauges]);


    }

    public function view_all_states(){
        return view('gauges.viewallstates');
    }


    //###########################Function for Washington end #######################################
	
     // **************************Function for Illinois start *************************************

    public function scaling_table_view_without_date_il(){

        $gauges = Gauge::where("city","like","%IL")->orderBy('name', 'asc')->get();
        for($i = 0; $i < count($gauges); $i++){
            $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count(); 
            $gauges[$i]['number_of_readings'] = $number_of_readings;
        }
        return view('gauges.scalingtableviewwithoutdateil', ['gauges' => $gauges]);


    }

    public function scaling_map_view_without_date_il(){
        $gauges = Gauge::where("city","like","%IL")->orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapviewwithoutdateil', ['gauges' => $gauges]);


    }



    //###########################Function for Illinois end #######################################
	
	     // **************************Function for Massachusetts start *************************************

    public function scaling_table_view_without_date_ma(){

        $gauges = Gauge::where("city","like","%MA")->orderBy('name', 'asc')->get();
        for($i = 0; $i < count($gauges); $i++){
            $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count(); 
            $gauges[$i]['number_of_readings'] = $number_of_readings;
        }
        return view('gauges.scalingtableviewwithoutdatema', ['gauges' => $gauges]);


    }

    public function scaling_map_view_without_date_ma(){
        $gauges = Gauge::where("city","like","%MA")->orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapviewwithoutdatema', ['gauges' => $gauges]);


    }



    //###########################Function for Massachusetts end #######################################

    	
	     // **************************Function for France start *************************************

         public function scaling_table_view_without_date_fr(){

            $gauges = Gauge::where("city","like","%France")->orderBy('name', 'asc')->get();
            for($i = 0; $i < count($gauges); $i++){
                $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count(); 
                $gauges[$i]['number_of_readings'] = $number_of_readings;
            }
            return view('gauges.scalingtableviewwithoutdatefr', ['gauges' => $gauges]);
    
    
        }
    
        public function scaling_map_view_without_date_fr(){
            $gauges = Gauge::where("city","like","%France")->orderBy('gauge_id', 'asc')->get();
            return view('gauges.scalingmapviewwithoutdatefr', ['gauges' => $gauges]);
    
    
        }
        //************Function for BD starts
        public function scaling_table_view_without_date_bd(){
            $gauges = Gauge::where("city","like","%BD")->orderBy('gauge_id', 'asc')->get();
            for($i = 0; $i < count($gauges); $i++){
                $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count();
                $gauges[$i]['number_of_readings'] = $number_of_readings;
            }
            return view('gauges.scalingtableviewwithoutdatebd', ['gauges' => $gauges]);
        }
    public function in(){

    }
    public function scaling_map_view_without_date_bd(){
        $gauges = Gauge::where("city","like","%BD")->orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapviewwithoutdatebd', ['gauges' => $gauges]);


    }
    ///////////####### function for new hampshire
    public function scaling_table_view_without_date_nh(){
        $gauges = Gauge::where("city","like","%NH")->orderBy('gauge_id', 'asc')->get();
        for($i = 0; $i < count($gauges); $i++){
            $number_of_readings =  GaugeReading::where('gauge_inc_id','=',$gauges[$i]->id)->count();
            $gauges[$i]['number_of_readings'] = $number_of_readings;
        }
        return view('gauges.scalingtableviewwithoutdatenh', ['gauges' => $gauges]);
    }
    public function scaling_map_view_without_date_nh(){
        $gauges = Gauge::where("city","like","%NH")->orderBy('gauge_id', 'asc')->get();
        return view('gauges.scalingmapviewwithoutdatenh', ['gauges' => $gauges]);


    }


    
    
    
        //###########################Function for France end #######################################



}
