<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Gauge;
use App\GaugeReading;
use App\Sms_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class SmsController extends Controller
{
    public function show_invalid_messages(){
        if(Auth::check()) {

            $sms_infoes = DB::select("SELECT * FROM sms_informations WHERE is_format_valid=0 OR is_format_valid=2 ORDER BY date DESC, time DESC");
            return view("sms.invalid_messages", ['sms_infoes' => $sms_infoes]);
        }
        else{
            return redirect('login');
        }

    }

    public function invalid_messages_showform($id){
        if(Auth::check()) {
            $gauges = Gauge::orderBy('gauge_id', 'asc')->get();
            $sms_info = DB::table('sms_informations')->where('id', $id)->first();
            return view("sms.invalid_messages_showform", ['sms_info' => $sms_info, 'gauges' => $gauges]);
        }
        else{
            return redirect('login');
        }


    }
    public function invalid_messages_store(Request $request){

                $input = ['gauge_inc_id' => $request->gauge_inc_id, 'height' => $request->height, 'date' => $request->date, 'time' => $request->time, 'notes' => $request->notes, 'entry_type' => "invalid_sms", 'account_id' => $request->account_id,'phone_no' => $request->mobile];
                GaugeReading::create($input);
                $update_input = ['is_format_valid' => 2];
                Sms_information::find($request->account_id)->update($update_input);
                return redirect()->route('sms.invalid');


    }

     public function show_all_message(){
        if(Auth::check()) {
            $readings_with_sms = DB::Select("SELECT msg_from,body,gauge_id,name,height,precipi,gauge_readings.date,gauge_readings.time,is_bubble_level_okay,gauge_readings.notes FROM gauge_readings,sms_informations,gauges WHERE entry_type IS NOT NULL and gauge_readings.account_id=sms_informations.id and gauges.id=gauge_readings.gauge_inc_id ORDER BY date DESC,time DESC");
            return view("sms.show_all_message", ['readings_with_sms' => $readings_with_sms]);
        }
        else{
            return redirect('login');
        }
    }
    public function show_sms_response_form($phone){
        return view("sms.show_response_form",['phone'=>$phone]);

    }

    public function send_message(Request $request){
        $phone= $request->phone;
        $body = $request->body;
        $list_of_phone= explode(',',$phone);



        if(!empty($body)) {
            foreach ($list_of_phone as $single_phone) {
                $accountId = "AC44c8b6f93d47b3493275c26ad9ba1df6";
                $token = "6fc476fe2798a3de13623c7cb47a30bf";
                $fromNumber = $request->fromNumber;
                $twilio = new Twilio($accountId, $token, $fromNumber);
                $twilio->message($single_phone, $body);
            }
        }
        return redirect()->route('sms.showall');
    }
}

