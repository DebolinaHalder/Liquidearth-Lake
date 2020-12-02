@extends('layouts.app')
<?php
$date = strtotime($gauge->installation_date);
$formatdate = date("Y-m-d", $date);
?>
@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Edit Gauge</h2>
            <form class="form-horizontal" action="{{ route('gauges.update', $gauge->id) }}" method="post">
                <div class="form-group">
                    <label for="inputEmail" class="control-label col-lg-1">ID</label>
                    <div class="col-lg-4">
                        <input name="gauge_id" type="text" class="form-control" placeholder="ID" value="{{$gauge->gauge_id}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Name</label>
                    <div class="col-lg-4">
                        <input name="name" type="text" class="form-control" placeholder="Name" value="{{$gauge->name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">City</label>
                    <div class="col-lg-4">
                        <input name="city" type="text" class="form-control" placeholder="City" value="{{$gauge->city}}"required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Latitude</label>
                    <div class="col-lg-4">
                        <input name="latitude" type="number" step="any" class="form-control" placeholder="Latitude" value="{{$gauge->latitude}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Longitude</label>
                    <div class="col-lg-4">
                        <input name="longitude" type="number" step="any" class="form-control" placeholder="Longitude" value="{{$gauge->longitude}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Timezone</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="timezone">

                            <option value="PDT">Pacific Daylight Time(PDT)</option>
                            <option value="MDT">Mountain Daylight Time(MDT)</option>
                            <option value="CDT">Central Daylight Time(CDT)</option>
                            <option value="EDT" selected>Eastern Daylight Time(EDT)</option>
                            <option value="GMT+6" selected>Bangladesh Standard Time</option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Unit</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="unit">

                            <option value="FEET">FEET</option>
                            <option value="METER">METER</option>


                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Minimum height</label>
                    <div class="col-lg-4">
                        <input name="min_height" type="number" value="{{$gauge->min_height}}" step="any" class="form-control" placeholder="Minimum Height" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Maximum height</label>
                    <div class="col-lg-4">
                        <input name="max_height" type="number" step="any" value="{{$gauge->max_height}}" class="form-control" placeholder="Maximum Height" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Installation Date</label>
                    <div class="col-lg-4">
                        <input name="installation_date" type="date" value="{{$formatdate}}" class="form-control" placeholder="Installation Date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Initial Reading</label>
                    <div class="col-lg-4">
                        <input name="initial_reading" type="number" step="any" class="form-control" value="{{$gauge->initial_reading}}" placeholder="Initial Reading" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Notes</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="5" name="notes">{{$gauge->notes}}</textarea>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<button name="submit" type="submit" class="left-block btn btn-primary">Edit Gauge</button>
            </form>
        </div>
    </div>

@endsection