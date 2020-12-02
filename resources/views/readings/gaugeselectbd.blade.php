@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif

                    <b><a href="{{route('readings.gaugeselect')}}">Go to Add Measurement (North Carolina)</a></b><br/>
                    <b><a href="{{route('readings.gaugeselectwa')}}">Go to Add Measurement (Washington)</a></b><br/>
                    <b><a href="{{route('readings.gaugeselectil')}}">Go to Add Measurement (Illinois)</a></b><br/>
                    <b><a href="{{route('readings.gaugeselectma')}}">Go to Add Measurement (Massachusetts)</a></b>
                    <!-- Posts list -->
                    @if(!empty($gauges))
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Select a Bangladesh Gauge </h2>
                                </div>

                            </div>
                        </div>

                        <ul class="nav nav-pills">
                            <li><a href="{{route('readings.gaugeselectmapbd')}}">Map View</a></li>
                            <li class="active"><a href="{{route('readings.gaugeselectbd')}}">Table View</a></li>


                        </ul>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <table class="table table-striped task-table">
                                    <!-- Table Headings -->
                                    <thead>
                                    <th>Gauge ID</th>
                                    <th>Lake</th>
                                    <th>City</th>

                                    </thead>

                                    <!-- Table Body -->
                                    <tbody>
                                    @foreach($gauges as $gauge)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{$gauge->gauge_id}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$gauge->name}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$gauge->city}}</div>
                                            </td>
                                            <td>
                                                <a href="{{ route('readings.create', $gauge->id) }}" class="label label-success">SELECT</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


