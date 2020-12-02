@extends('layouts.app')

<?php


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

@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Submit Your Measurement</h2>

            <br/>


            <form class="form-horizontal" action="/reading/mapstore" method="post">
                <input type="hidden" name="gauge_inc_id" id="gauge_inc_id" value="{{$gauge->id}}"/>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Gauge</label>
                    <div class="col-lg-4">
                        <input name="gauge_name" id="gauge_name" type="text" class="form-control" placeholder="Height" value ="{{$gauge->gauge_id}}:{{$gauge->name}}" required readonly>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Height</label>
                    <div class="col-lg-3">
                        <input name="height" type="number" step="any" class="form-control" placeholder="Height" required>
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
                        <input name="time" type="time" step="60" value="<?php echo $dt->format("H:i"); ?>" class="form-control" id="time" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Is bubble level okay?</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="is_bubble_level_okay" id="is_bubble_level_okay">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="I don't know">I don't know</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Notes</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="5" name="notes"></textarea>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <button name="submit" type="submit" class="left-block btn btn-primary">Submit</button> &nbsp &nbsp &nbsp
                <button type="button" class="btn btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="fill_modal()">Report Problem</button>
            </form>





        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report Problem</h4>

                    <form action="/reading/problem" method="post">
                        <div class="modal-body">
                            <input type="hidden" id="modal_gauge_name" name="gauge_id" /><br/>
                            Date:<input type="date" id="modal_date" name="date" readonly/> &nbsp; &nbsp; &nbsp;
                            Time:<input type="text" id="modal_time" name="time" readonly/> <br/><br/>
                            <textarea class="form-control" rows="2" name="problem" placeholder="Submit the problem"></textarea>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        </div>
                        <div class="modal-footer">
                            <button name="submit" type="submit" class="left-block btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection

@section('css')
    <style>
        #map{
            height:700px;
            width:100%;
        }
    </style>

@endsection

@section('script')

    <script>
        function fill_modal(){
            var gauge_name = $('#gauge_name').val();
            var date=$('#date').val();
            var time=$('#time').val();

            $("#modal_gauge_name").val(gauge_name);
            $("#modal_date").val(date);
            $("#modal_time").val(time);
        }
    </script>


@endsection

