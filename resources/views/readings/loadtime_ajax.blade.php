<?php


$gauge_id_name = explode(':',$_GET['name']);
$gauge=DB::table('gauges')->where('gauge_id', $gauge_id_name[0])->first();

if($gauge->timezone == "PDT"){
    $tz ="America/Los_Angeles";
}
else if($gauge->timezone == "MDT"){
    $tz="America/Denver";
}
else if($gauge->timezone == "CDT"){
    $tz="America/Chicago";
}
else if($gauge->timezone == "EDT"){
    $tz="America/New_York";
}
else if($gauge->timezone == "GMT+6"){
    $tz="Asia/Dhaka";
}
else{

}

$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp);
?>
<div id="loadtime">
        <div class="form-group">
            <label for="inputPassword" class="text-center control-label col-lg-1">Height</label>
            <div class="col-lg-3">
                <input name="height" type="text" class="form-control" placeholder="Height" required>
            </div>
            <label for="inputPassword" class="text-center control-label col-lg-1">{{$gauge->unit}}</label>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="text-center control-label col-lg-1">Date</label>
             <div class="col-lg-4">
                <input name="date" type="date" value="<?php echo $dt->format("Y-m-d"); ?>" class="form-control" id="date" required>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="text-center control-label col-lg-1">Time</label>
            <div class="col-lg-4">
                <input name="time" type="time" step="1" value="<?php echo $dt->format("H:i:s"); ?>" class="form-control" id="time" required>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="text-center control-label col-lg-1">Notes</label>
            <div class="col-lg-4">
                <textarea class="form-control" rows="5" name="notes"></textarea>
            </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp &nbsp &nbsp &nbsp &nbsp<button name="submit" type="submit" class="left-block btn btn-primary">Submit</button> &nbsp &nbsp &nbsp
    <button type="button" class="btn btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="fill_modal()">Report Problem</button>
</div>

