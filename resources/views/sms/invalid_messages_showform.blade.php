@extends('layouts.app')

<?php


$date = strtotime($sms_info->date);
$formatdate = date("Y-m-d", $date);
$time = strtotime($sms_info->time);
$formattime = date("H:i", $time);
?>

@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Submit Your Measurement for Invalid Message</h2>



            <br/>
            <form class="form-horizontal" action="/sms/invalid/store" method="post">


                <input type="hidden" name="account_id" value="{{$sms_info->id}}">
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Phone</label>
                    <div class="col-lg-4">
                        <input name="mobile" type="text"  class="form-control" placeholder="Phone" value="{{$sms_info->msg_from}}"required>
                    </div>

                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Message</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="3" name="message">{{$sms_info->body}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Gauge</label>
                    <div class="col-lg-4">
                        <select name="gauge_inc_id" class="form-control">
                            @foreach($gauges as $gauge)
                                <option value="{{$gauge->id}}">{{$gauge->gauge_id}}:{{$gauge->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Height</label>
                    <div class="col-lg-4">
                        <input name="height" type="number" step="any" class="form-control" placeholder="Height" required>
                    </div>

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
                        <input name="time" type="time" step="60" value="{{$formattime}}" class="form-control" id="time" required>
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
                &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp<button name="submit" type="submit" class="left-block btn btn-primary">Submit</button>


            </form>




        </div>
    </div>



@endsection



