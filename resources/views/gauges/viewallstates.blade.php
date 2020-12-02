@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="row">
                <div class="col-lg-12">
                    <h3><b><a href="{{route('gauges.scalingtableviewwdate')}}">North Carolina Gauges List</a></b> <br/></h3>
                    <h3><b><a href="{{route('readings.gaugeselect')}}">Add Measurement (North Carolina)</a></b> <br/><br/></h3>
                    <h3><b><a href="{{route('gauges.scalingtableviewwdatewa')}}">Washington Gauges List</a></b>  <br/></h3>
                    <h3><b><a href="{{route('readings.gaugeselectwa')}}">Add Measurement (Washington)</a></b> <br/></h3>



                </div>
            </div>
        </div>
    </div>


@endsection