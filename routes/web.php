<?php


Route::get('/','HomeController@gen_Index')->name('genhome');

//Route::get('/gauge/', 'GaugeController@index')->name('gauges.index');

Route::get('/gauge/', 'GaugeController@scaling_table_view_without_date')->name('gauges.scalingtableviewwdate');


Route::get('/gauge/genview', 'GaugeController@admin_view')->name('gauges.adminview');
Route::get('/gauge/create', 'GaugeController@create')->name('gauges.create');
Route::post('/gauge/store', 'GaugeController@store')->name('gauges.store');
Route::get('/gauge/edit/{id}', 'GaugeController@edit')->name('gauges.edit');
Route::post('/gauge/update/{id}', 'GaugeController@update')->name('gauges.update');

//routes for csv data entry
Route::get('/reading/entry', 'JsonController@reading_entry')->name('reading.entry');
Route::post('/file/csv', 'JsonController@fileUpload')->name('file.upload.post');

Route::get('/gauge/details/{id}', 'GaugeController@details')->name('gauges.details');
Route::get('/gauge/detailsheightprec/{id}', 'GaugeController@details_height_precipi')->name('gauges.detailsheightprec');
Route::get('/gauge/detailsprec/{id}', 'GaugeController@details_precipi')->name('gauges.detailsprec');

Route::get('/gauge/delete/{id}', 'GaugeController@delete')->name('gauges.delete');


Route::get('/reading/', 'GaugeReadingController@index')->name('readings.index');
Route::get('/reading/create/{id}', 'GaugeReadingController@create')->name('readings.create');
Route::post('/reading/store', 'GaugeReadingController@store')->name('readings.store');
Route::get('/reading/edit/{id}', 'GaugeReadingController@edit')->name('readings.edit');
Route::post('/reading/update/{id}', 'GaugeReadingController@update')->name('readings.update');
Route::get('/reading/delete/{id}', 'GaugeReadingController@delete')->name('readings.delete');
Route::post('/reading/problem', 'GaugeReadingController@report_problem')->name('readings.problem');
Route::get('/reading/viewproblem', 'GaugeReadingController@view_problem')->name('readings.viewproblem');
Route::get('/reading/gaugeselect', 'GaugeReadingController@gauge_select')->name('readings.gaugeselect');
Route::get('/reading/gaugeselectmap', 'GaugeReadingController@gauge_select_map')->name('readings.gaugeselectmap');

/////routes for data download
Route::get('/reading/download', 'GaugeReadingController@download_nc')->name('readings.download');
Route::get('/reading/downloadwa', 'GaugeReadingController@download_wa')->name('readings.downloadwa');
Route::get('/reading/downloadil', 'GaugeReadingController@download_il')->name('readings.downloadil');
Route::get('/reading/downloadma', 'GaugeReadingController@download_ma')->name('readings.downloadma');
Route::get('/reading/downloadnh', 'GaugeReadingController@download_nh')->name('readings.downloadnh');
Route::get('/reading/downloadfr', 'GaugeReadingController@download_fr')->name('readings.downloadwa');
Route::get('/reading/downloadbd', 'GaugeReadingController@download_bd')->name('readings.downloadbd');
Route::get('/reading/downloadall', 'GaugeReadingController@download_all')->name('readings.downloadall');

Route::get('/reading/ajax/load', function () {
    return view('readings.loadtime_ajax');
});

Route::get('/reading/ajax/loadForMap', function () {
    return view('readings.loadtime_ajax_map');
});

Route::get('/gauge/mapview', 'GaugeController@map_view')->name('gauges.mapview');
Route::get('/reading/mapcreate/{id}', 'GaugeReadingController@map_create')->name('readings.mapcreate');
Route::post('/reading/mapstore', 'GaugeReadingController@map_store')->name('readings.mapstore');


Route::get('/json/gauges', 'JsonController@getAllGauges')->name('json.gauges');
Route::get('/home/load', 'HomeController@load_weather_data')->name('home.load');

Route::get('/search/readings', 'SearchController@search_readings')->name('search.readings');
Route::post('/search/showreadings', 'SearchController@show_readings')->name('search.showreadings');
Route::get('/search/showoptions', 'SearchController@show_search_options')->name('search.showoptions');
Route::get('/search/showdata', 'SearchController@show_search_data')->name('search.showdata');
Route::get('/search/exportdata', 'SearchController@export_data')->name('search.exportdata');





Route::match(array('GET', 'POST'), '/api/sms', function()
{
       //Start
    
    $LakeMapping = array("NC1004"=>"BTN2","NC1005"=>"STN2","NC1006" => "WHN2", 
    "NC1007"=>"JNN2", "NC1008"=>"SAN2","NC1015"=>"HPN2","NC1009" =>"ZZN2", "NC1050" => "DMN2", "NC1016"=>"HCN2", "NC1018"=>"WCN2","NC1012"=>"CFN2","NC1014"=>"GRN2","NC1034"=>"VCN2","NC1010"=>"MTN2","NC1001"=>"BPN2","NC1002"=>"MFN2","NC1017"=>"BAN2","NC1003"=>"PRN2","NC1011"=>"FDN2","NC1019"=>"PHN2",   "LVL2"=>"LYL2");
    
    //$LakeMapping = array("NC1004" => "BTN2");
    
    //End 
    $body=$_GET['Body'];
    $msg_service_id=$_GET['MessagingServiceSid'];
    $msg_id=$_GET['SmsSid'];
    $msg_from=$_GET['From'];
    $msg_status=$_GET['SmsStatus'];
    $from_city=$_GET['FromCity'];
    $from_state=$_GET['FromState'];
    $from_zip=$_GET['FromZip'];
    
    $gauge_id_reading = explode(' ',$_GET['Body']);
    // $gauge_id_reading = explode(' ',"NC001 12");

    if(sizeof($gauge_id_reading)>=2 && preg_match("/(\d+(\.\d+)?)/",$gauge_id_reading[1] )) {
        $gauge_id = $gauge_id_reading[0];
        $reading = $gauge_id_reading[1];
        
        if($reading[strlen($reading)-1]==".") {
            $reading = rtrim($reading, ".");
        }
        
        $is_format_valid=1;
        $note="";
        if(sizeof($gauge_id_reading)>2){
        	
        	for($i=2;$i<sizeof($gauge_id_reading);$i++){
        		$note.=$gauge_id_reading[$i];
        		$note.=" ";
        	
        	}
        }
    }
    else{
        $gauge_id="";
        $is_format_valid=0;
    }
    $tz_sms="America/New_York";
    $timestamp_sms = time();
    $dt_sms = new DateTime("now", new DateTimeZone($tz_sms)); //first argument "must" be a string
    $dt_sms->setTimestamp($timestamp_sms);
    
    $input=['msg_service_id' => $msg_service_id, 'msg_id' => $msg_id, 'msg_from' =>$msg_from, 'body'=>$body, 'msg_status'=>$msg_status,  'from_city'=>$from_city,'from_state'=> $from_state,'from_zip'=> $from_zip, 'is_format_valid'=>$is_format_valid, 'date' => $dt_sms->format("Y-m-d"), 'time' => $dt_sms->format("H:i:s") ];
    $Sms_information = \App\Sms_information::create($input);
    //$Sms_information_id = \App\Sms_information::orderBy('created_at','desc')->first();
    $Sms_information_id = $Sms_information->id;


    $gauge=\Illuminate\Support\Facades\DB::table('gauges')->where('gauge_id', $gauge_id)->first();
    if(!empty($gauge) && !empty($reading)) {
        if ($gauge->timezone == "PDT") {
            $tz = "America/Los_Angeles";
        } else if ($gauge->timezone == "MDT") {
            $tz = "America/Denver";
        } else if ($gauge->timezone == "CDT") {
            $tz = "America/Chicago";
        } else if ($gauge->timezone == "EDT") {
            $tz = "America/New_York";
        } else {

        }
        $last_reading= \App\GaugeReading::orderBy('date','desc')->orderBy('time','desc')->where('gauge_inc_id',$gauge->id)->first();
        
        $last_reading_height=$last_reading->height;
        //$last_reading_date= $last_reading->date;
        $last_reading_date = strtotime($last_reading->date);
        $format_last_reading_date = date("m-d-Y",  $last_reading_date);
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp);
        $input = ['gauge_inc_id' => $gauge->id, 'height' => $reading, 'date' => $dt->format("Y-m-d"), 'time' => $dt->format("H:i:s"),'entry_type'=>"sms",'account_id' => $Sms_information_id,'notes' => $note,'phone_no' =>$msg_from];
        App\GaugeReading::create($input);
        $xml="<Response><Message>Thank you for participating in our research project.  The last recorded level in this lake was ".$last_reading_height. " feet on ".  $format_last_reading_date. ". More information about this lake and our project can be found at www.locss.org</Message></Response>";
        //$xml = "<Response><Message>Thank you for your input.The last measurement was ".$last_reading_height." ". $format_last_reading_date. ".Please visit our official website www.liquidearthlake.website for further information.</Message></Response>";
    }
    
        //Start
    else if(array_key_exists(strtoupper($gauge_id),$LakeMapping)){
           $gauge=\Illuminate\Support\Facades\DB::table('gauges')->where('gauge_id', $LakeMapping[strtoupper($gauge_id)])->first();
           if ($gauge->timezone == "PDT") {
            $tz = "America/Los_Angeles";
            } else if ($gauge->timezone == "MDT") {
                $tz = "America/Denver";
            } else if ($gauge->timezone == "CDT") {
                $tz = "America/Chicago";
            } else if ($gauge->timezone == "EDT") {
                $tz = "America/New_York";
            } else {
    
            }
            $last_reading= \App\GaugeReading::orderBy('created_at','desc')->where('gauge_inc_id',$gauge->id)->first();
            
            $last_reading_height=$last_reading->height;
            //$last_reading_date= $last_reading->date;
            $last_reading_date = strtotime($last_reading->date);
            $format_last_reading_date = date("m-d-Y",  $last_reading_date);
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
            $dt->setTimestamp($timestamp);
            $input = ['gauge_inc_id' => $gauge->id, 'height' => $reading, 'date' => $dt->format("Y-m-d"), 'time' => $dt->format("H:i:s"),'entry_type'=>"sms",'account_id' => $Sms_information_id,'notes' => $note,'phone_no' =>$msg_from];
            App\GaugeReading::create($input);
            $xml="<Response><Message>Thank you for participating in our research project.  The last recorded level in this lake was ".$last_reading_height. " feet on ".  $format_last_reading_date. ". More information about this lake and our project can be found at  www.locss.org</Message></Response>";
    }
    
    //End
    else {
    	 \App\Sms_information::where('id',$Sms_information_id)->update(['is_format_valid' => 0]);
    	 $data = array('name'=>"Citizen Science",'body'=>$body,'msg_from'=>$msg_from,'from_city'=>$from_city,'from_state'=>$from_state,'from_zip'=>$from_zip);
            Mail::send(['text'=>'smserror'], $data, function($message) {
                $message->to('parkins@unc.edu', 'Admin')->subject
                ('Gauge problem');
                $message->from('testarman445@gmail.com','Citizen Science');
            });
        $xml = "<Response><Message>Thank you for participating in our research project.  More information about this lake and our project can be found at  www.locss.org</Message></Response>";
    }


    $response = Response::make($xml, 200);
    $response->header('Content-Type', 'text/xml');
    return $response;
});



Route::get('/sms/invalid', 'SmsController@show_invalid_messages')->name('sms.invalid');
Route::get('/sms/invalid/showform/{id}', 'SmsController@invalid_messages_showform')->name('sms.invalid.showform');
Route::post('/sms/invalid/store', 'SmsController@invalid_messages_store')->name('sms.invalid.store');
Route::get('/sms/showall', 'SmsController@show_all_message')->name('sms.showall');
Route::post('/sms/send', 'SmsController@send_message')->name('sms.send');
Route::get('/sms/response/{phone}', 'SmsController@show_sms_response_form')->name('sms.response');

//

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','Auth\LoginController@showLoginForm');


//Social Networking

Route::get('social/fbredirect', 'SocialAuthController@facebook_redirect');
Route::get('social/fbcallback', 'SocialAuthController@facebook_callback');
Route::get('social/twredirect', 'SocialAuthController@twitter_redirect');
Route::get('social/twcallback', 'SocialAuthController@twitter_callback');

//End Social Networking*************************

// Scaled chart with date
Route::get('/gauge/cdetails/{id}', 'GaugeController@correct_details')->name('gauges.cdetails');
Route::get('/gauge/ajaxshowchart', 'GaugeController@show_ajax_correct_chart')->name('gauges.ajaxshowchart');
Route::get('/gauge/getjsondata', 'GaugeController@get_json_height_date')->name('gauges.getjsondata');
Route::get('/gauge/scalingmapview', 'GaugeController@scaling_map_view')->name('gauges.scalingmapview');
// End Sclaed chart with date

// Sclaed Chart without date
Route::get('/gauge/scalingmapviewdate', 'GaugeController@scaling_map_view_without_date')->name('gauges.scalingmapviewwdate');
//Route::get('/gauge/scalingtableviewdate', 'GaugeController@scaling_table_view_without_date')->name('gauges.scalingtableviewwdate');

Route::get('/gauge/scaleddetailssixm/{id}', 'GaugeController@scaled_details_six_month')->name('gauges.scaleddetailssixm');
Route::get('/gauge/scaleddetailsonem/{id}', 'GaugeController@scaled_details_one_month')->name('gauges.scaleddetailsonem');
Route::get('/gauge/scaleddetailsthreem/{id}', 'GaugeController@scaled_details_three_month')->name('gauges.scaleddetailsthreem');
Route::get('/gauge/scaleddetailsoney/{id}', 'GaugeController@scaled_details_one_year')->name('gauges.scaleddetailsoney');
Route::get('/gauge/scaleddetailsall/{id}', 'GaugeController@scaled_details_all')->name('gauges.scaleddetailsall');


Route::get('/gauge/getjsondatasixm', 'GaugeController@get_json_height_date_last_six_month')->name('gauges.getjsondatasixm');
Route::get('/gauge/getjsondataonem', 'GaugeController@get_json_height_date_last_one_month')->name('gauges.getjsondataonem');
Route::get('/gauge/getjsondatathreem', 'GaugeController@get_json_height_date_last_three_month')->name('gauges.getjsondatathreem');
Route::get('/gauge/getjsondataoney', 'GaugeController@get_json_height_date_one_year')->name('gauges.getjsondataoney');
Route::get('/gauge/getjsondataall', 'GaugeController@get_json_height_date_all')->name('gauges.getjsondataall');

/// Start route for washington **********************************
Route::get('/reading/gaugeselectwa', 'GaugeReadingController@gauge_select_wa')->name('readings.gaugeselectwa');
Route::get('/reading/gaugeselectmapwa', 'GaugeReadingController@gauge_select_map_wa')->name('readings.gaugeselectmapwa');
Route::get('/json/gaugeswa', 'JsonController@getAllGaugesWA')->name('json.gaugeswa');
Route::get('/gauge/scalingmapviewdatewa', 'GaugeController@scaling_map_view_without_date_wa')->name('gauges.scalingmapviewwdatewa');  // Washington
Route::get('/gauge/scalingtableviewdatewa', 'GaugeController@scaling_table_view_without_date_wa')->name('gauges.scalingtableviewwdatewa');
Route::get('/gauge/viewallstates', 'GaugeController@view_all_states')->name('gauges.viewallstates');

/// End route for Washington ************************************

/// Start route for Illinois **********************************
Route::get('/reading/gaugeselectil', 'GaugeReadingController@gauge_select_il')->name('readings.gaugeselectil');
Route::get('/reading/gaugeselectmapil', 'GaugeReadingController@gauge_select_map_il')->name('readings.gaugeselectmapil');
Route::get('/json/gaugesil', 'JsonController@getAllGaugesIL')->name('json.gaugesil');
Route::get('/gauge/scalingmapviewdateil', 'GaugeController@scaling_map_view_without_date_il')->name('gauges.scalingmapviewwdateil');  // Washington
Route::get('/gauge/scalingtableviewdateil', 'GaugeController@scaling_table_view_without_date_il')->name('gauges.scalingtableviewwdateil');


/// End route for Illionois ************************************

/// Start route for Massachusetts **********************************
Route::get('/reading/gaugeselectma', 'GaugeReadingController@gauge_select_ma')->name('readings.gaugeselectma');
Route::get('/reading/gaugeselectmapma', 'GaugeReadingController@gauge_select_map_ma')->name('readings.gaugeselectmapma');
Route::get('/json/gaugesma', 'JsonController@getAllGaugesMA')->name('json.gaugesma');
Route::get('/gauge/scalingmapviewdatema', 'GaugeController@scaling_map_view_without_date_ma')->name('gauges.scalingmapviewwdatema');  // Washington
Route::get('/gauge/scalingtableviewdatema', 'GaugeController@scaling_table_view_without_date_ma')->name('gauges.scalingtableviewwdatema');


/// End route for Massachusetts ************************************

/// Start route for France **********************************
Route::get('/reading/gaugeselectfr', 'GaugeReadingController@gauge_select_fr')->name('readings.gaugeselectfr');
Route::get('/reading/gaugeselectmapfr', 'GaugeReadingController@gauge_select_map_fr')->name('readings.gaugeselectmapfr');
Route::get('/json/gaugesfr', 'JsonController@getAllGaugesFR')->name('json.gaugesfr');
Route::get('/gauge/scalingmapviewdatefr', 'GaugeController@scaling_map_view_without_date_fr')->name('gauges.scalingmapviewwdatefr');  // Washington
Route::get('/gauge/scalingtableviewdatefr', 'GaugeController@scaling_table_view_without_date_fr')->name('gauges.scalingtableviewwdatefr');


/// End route for France ************************************

//begin routes for bd
Route::get('/reading/gaugeselectbd', 'GaugeReadingController@gauge_select_bd')->name('readings.gaugeselectbd');
Route::get('/reading/gaugeselectmapbd', 'GaugeReadingController@gauge_select_map_bd')->name('readings.gaugeselectmapbd');
Route::get('/gauge/scalingtableviewdatebd', 'GaugeController@scaling_table_view_without_date_bd')->name('gauges.scalingtableviewwdatebd');
Route::get('/gauge/scalingmapviewdatebd', 'GaugeController@scaling_map_view_without_date_bd')->name('gauges.scalingmapviewwdatebd');
Route::get('/json/gaugesbd', 'JsonController@getAllGaugesBD')->name('json.gaugesbd');

//////get unit
//begin routes for new Hampshire
Route::get('/reading/gaugeselectnh', 'GaugeReadingController@gauge_select_nh')->name('readings.gaugeselectnh');
Route::get('/reading/gaugeselectmapnh', 'GaugeReadingController@gauge_select_map_nh')->name('readings.gaugeselectmapnh');
Route::get('/gauge/scalingtableviewdatenh', 'GaugeController@scaling_table_view_without_date_nh')->name('gauges.scalingtableviewdatenh');
Route::get('/gauge/scalingmapviewdatenh', 'GaugeController@scaling_map_view_without_date_nh')->name('gauges.scalingmapviewwdatenh');
Route::get('/json/gaugesnh', 'JsonController@getAllGaugesNH')->name('json.gaugesnh');

//gauges.scalingtableviewwdatein
Route::get('/gauge/scalingtableviewdatein', 'GaugeController@in')->name('gauges.scalingtableviewwdatein');