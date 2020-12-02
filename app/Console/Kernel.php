<?php

namespace App\Console;

use App\Gauge;
use App\GaugeReading;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */

    protected $commands = [
        //
    ];
    /*public function generateID(){
        echo "   here in gauge id   ";
        $gauges = \Illuminate\Support\Facades\DB::table('gauges')->orderBy('id', 'desc')->get();
        if(empty($gauges)) {

            return 1;
        }


        else {
            $id = $gauges[0]->id + 1;
            return $id;
        }

    }
    public function getBDData(){
        $client = new \GuzzleHttp\Client();
        $url="http://api.hmrcweb.com/sms_data.php?start_date=";
        // $current_date=date('Y-m-d');
        $current_date = '2017-05-02';
        $url.=$current_date;
        //$tomorrow = date('Y-m-d', strtotime($current_date . ' +1 day'));
        $tomorrow= date('Y-m-d');
        $url .= "&end_date=";
        $url.=$tomorrow;
        echo $url;
        $readings_3d = json_decode(file_get_contents($url), true);
        foreach ($readings_3d as $readings){
            foreach($readings as $reading){
                $gauge=\Illuminate\Support\Facades\DB::table('gauges')->where('name', $reading['station_name'])->first();
                if(empty($gauge)){
                    echo "here<br>";
                    $dt = new DateTime($reading['time']);
                    $gauges = \Illuminate\Support\Facades\DB::table('gauges')->orderBy('id', 'desc')->get();
                    if(empty($gauges)) {
                        $id = 1;
                    }
                    else {
                        $id = $gauges[0]->id + 1;
                    }
                    $input = ['gauge_id' => $id, 'name' => $reading['station_name'], 'city' => 'Dhaka,BD', 'latitude' => $reading['lat'],'longitude' => $reading['lon'],'timezone' => "GMT+6",'unit' =>"METER",'min_height' => 0,'max_height' => 100,'installation_date' =>$dt->format("Y-m-d"),'initial_reading'=>$reading['WL'],'notes'=>""];

                    Gauge::create($input);
                    $find = \Illuminate\Support\Facades\DB::table('gauges')->where('name', $reading['station_name'])->first();
                    $new_entry = ['gauge_inc_id' => $find->id, 'height' => $reading['WL'], 'date' => $dt->format("Y-m-d"), 'time' => $dt->format("H:i:s"),'entry_type'=>"bd_api"];
                    GaugeReading::create($new_entry);

                }
                else{
                    $dt = new DateTime($reading['time']);
                    $input = ['gauge_inc_id' => $gauge->id, 'height' => $reading['WL'], 'date' => $dt->format("Y-m-d"), 'time' => $dt->format("H:i:s"),'entry_type'=>"bd_api"];
                    GaugeReading::create($input);
                }
                echo $reading['station_name'];
            }

        }


        dd($readings);
        return;
    }*/
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $client = new \GuzzleHttp\Client();
            $url="http://api.hmrcweb.com/sms_data.php?start_date=";
            // $current_date=date('Y-m-d');
            $current_date = '2017-05-02';
            $url.=$current_date;
            //$tomorrow = date('Y-m-d', strtotime($current_date . ' +1 day'));
            $tomorrow= date('Y-m-d');
            $url .= "&end_date=";
            $url.=$tomorrow;
            echo $url;
            $readings_3d = json_decode(file_get_contents($url), true);
            foreach ($readings_3d as $readings){
                foreach($readings as $reading){
                    $gauge=\Illuminate\Support\Facades\DB::table('gauges')->where('name', $reading['station_name'])->first();
                    if(empty($gauge)){
                        echo "here<br>";
                        $dt = new DateTime($reading['time']);
                        $gauges = \Illuminate\Support\Facades\DB::table('gauges')->orderBy('id', 'desc')->get();
                        if(empty($gauges)) {
                            $id = 1;
                        }
                        else {
                            $id = $gauges[0]->id + 1;
                        }
                        $input = ['gauge_id' => $id, 'name' => $reading['station_name'], 'city' => 'Dhaka,BD', 'latitude' => $reading['lat'],'longitude' => $reading['lon'],'timezone' => "GMT+6",'unit' =>"METER",'min_height' => 0,'max_height' => 100,'installation_date' =>$dt->format("Y-m-d"),'initial_reading'=>$reading['WL'],'notes'=>""];

                        Gauge::create($input);
                        $find = \Illuminate\Support\Facades\DB::table('gauges')->where('name', $reading['station_name'])->first();
                        $new_entry = ['gauge_inc_id' => $find->id, 'height' => $reading['WL'], 'date' => $dt->format("Y-m-d"), 'time' => $dt->format("H:i:s"),'entry_type'=>"bd_api"];
                        GaugeReading::create($new_entry);

                    }
                    else{
                        $dt = new DateTime($reading['time']);
                        $input = ['gauge_inc_id' => $gauge->id, 'height' => $reading['WL'], 'date' => $dt->format("Y-m-d"), 'time' => $dt->format("H:i:s"),'entry_type'=>"bd_api"];
                        GaugeReading::create($input);
                    }
                    echo $reading['station_name'];
                }

            }


            dd($readings);
            return;
         })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

}
