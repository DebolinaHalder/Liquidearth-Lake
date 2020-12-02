@extends('layouts.app')

<?php
/*
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
        else{

        }

        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp);
*/
$date = strtotime($reading->date);
$formatdate = date("Y-m-d", $date);
$time = strtotime($reading->time);
$formattime = date("H:i:s", $time);
?>
@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Edit Measurement</h2>
            <form class="form-horizontal" action="/reading/update/{{$reading->id}}" method="post">
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Gauge</label>
                    <div class="col-lg-4">
                        <input name="gauge_id_name" type="text" class="form-control"  value="{{$reading->gauge_id}}:{{$reading->name}}"  disabled>
                        <input type="hidden" name="gauge_inc_id" value="{{$reading->gauge_inc_id}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Height</label>
                    <div class="col-lg-3">
                        <input name="height" type="text" class="form-control" placeholder="Height" value="{{$reading->height}}" required>
                    </div>
                    <label for="inputPassword" class="text-center control-label col-lg-1">{{$reading->unit}}</label>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Precipitation</label>
                    <div class="col-lg-3">
                        <input name="precipi" type="text" class="form-control" placeholder="Height" value="{{$reading->precipi}}" required>
                    </div>
                    <label for="inputPassword" class="text-center control-label col-lg-1">inch</label>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Date</label>
                    <div class="col-lg-4">
                        <input name="date" type="date" value="{{$formatdate}}" class="form-control" id="date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Time</label>
                    <div class="col-lg-4">
                        <input name="time" type="time" value="{{$formattime}}" class="form-control" id="time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Is bubble level okay?</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="is_bubble_level_okay" id="is_bubble_level_okay">

                            <option value="Yes" @if($reading->is_bubble_level_okay == "Yes") selected @endif>Yes</option>
                            <option value="No" @if($reading->is_bubble_level_okay == "No") selected @endif>No</option>
                            <option value="I don't know" @if($reading->is_bubble_level_okay == "I don't know") selected @endif>I don't know</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Notes</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="5" name="notes" value="">{{$reading->notes}}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Phone No</label>
                    <div class="col-lg-4">
                        <input name="phone_no" type="text" class="form-control" placeholder="Phone No" value="{{$reading->phone_no}}">
                    </div>

                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp &nbsp &nbsp &nbsp &nbsp<button name="submit" type="submit" class="left-block btn btn-warning">Edit Measurement</button>
            </form>




        </div>
    </div>




@endsection

