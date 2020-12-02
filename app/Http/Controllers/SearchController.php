<?php

namespace App\Http\Controllers;

use App\Gauge;
use App\GaugeReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
     public function search_readings(){
         $gauges = Gauge::orderBy('gauge_id', 'asc')->get();
         return view("search.all_readings",['gauges' => $gauges]);

     }
     public function show_readings(Request $request){
         $input = $request->all();
         $readings_by_date = DB::select("SELECT * FROM gauges, gauge_readings WHERE gauges.id=gauge_readings.gauge_inc_id");
         return view("search.show_readings",['readings_by_date'=>$readings_by_date

         ]);
     }

     public function show_search_options(){
         if(Auth::check()) {
             $gauges = Gauge::orderBy('gauge_id', 'asc')->get();
             return view("search.show_search_options", ['gauges' => $gauges]);
         }

        else{
             return redirect('login');
         }

     }

     public function show_search_data(){
         $gauge_inc_id = $_GET['gauge_inc_id'];
         $from_date= $_GET['from_date'];
         $to_date =$_GET['to_date'];
      

         $reverse_from_date = date("d-m-Y", strtotime($from_date));
         $reverse_to_date= date("d-m-Y", strtotime($to_date));
         if($gauge_inc_id=="ALL") {
             $readings_without_sms = DB::Select("SELECT gauge_id, name, gauge_readings.id,height,precipi,date, time, is_bubble_level_okay,gauge_readings.notes FROM gauge_readings,gauges WHERE entry_type IS NULL and gauges.id=gauge_readings.gauge_inc_id and date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY gauges.gauge_id");

         }
         else{
             $readings_without_sms = DB::Select("SELECT gauge_id, name, gauge_readings.id,height,precipi,date, time, is_bubble_level_okay,gauge_readings.notes FROM gauge_readings,gauges WHERE entry_type IS NULL and gauges.id=gauge_readings.gauge_inc_id and gauge_inc_id = $gauge_inc_id and date BETWEEN '{$from_date}' and '{$to_date}'");

         }
         if($gauge_inc_id=="ALL") {
             $readings_with_sms = DB::Select("SELECT msg_from,body,gauge_id,name,height,precipi,gauge_readings.date,gauge_readings.time,is_bubble_level_okay,gauge_readings.notes FROM gauge_readings,sms_informations,gauges WHERE entry_type IS NOT NULL and gauge_readings.account_id=sms_informations.id and gauges.id=gauge_readings.gauge_inc_id and gauge_readings.date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY gauges.gauge_id");

         }
         else{
             $readings_with_sms = DB::Select("SELECT * FROM gauge_readings,sms_informations,gauges WHERE entry_type IS NOT NULL and gauge_inc_id = $gauge_inc_id and gauges.id=gauge_readings.gauge_inc_id and  gauge_readings.account_id=sms_informations.id and gauge_readings.date BETWEEN '{$from_date}' and '{$to_date}'");

         }
                return view("search.ajax_show_data",['readings_without_sms'=>$readings_without_sms,'readings_with_sms'=>$readings_with_sms]);
     }

     public function export_data(){
         $gauge_inc_id = $_GET['gauge_inc_id'];
         $from_date= $_GET['from_date'];
         $to_date =$_GET['to_date'];

         if($gauge_inc_id=="ALL") {
             $data = DB::Select("SELECT  gauges.gauge_id, gauges.name, gauge_readings.date,gauge_readings.time, gauge_readings.height, gauge_readings.is_bubble_level_okay,gauge_readings.notes, gauge_readings.phone_no from gauge_readings, gauges WHERE gauge_readings.gauge_inc_id=gauges.id and gauge_readings.date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY gauges.gauge_id");
         }
         else{
             $data = DB::Select("SELECT  gauges.gauge_id, gauges.name, gauge_readings.date,gauge_readings.time, gauge_readings.height, gauge_readings.is_bubble_level_okay,gauge_readings.notes, gauge_readings.phone_no from gauge_readings, gauges WHERE gauge_readings.gauge_inc_id=gauges.id and gauge_readings.gauge_inc_id=$gauge_inc_id and gauge_readings.date BETWEEN '{$from_date}' and '{$to_date}' ORDER BY gauges.gauge_id");
         }

         return \Maatwebsite\Excel\Facades\Excel::create('readings', function($excel) use ($data) {
             $data= json_decode( json_encode($data), true);
             $excel->sheet('mySheet', function($sheet) use ($data)
             {
                 $sheet->fromArray($data);
             });
         })->download("csv");
     }
}
