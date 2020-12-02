

@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif
                    <b><a href="{{route('gauges.scalingtableviewwdate')}}">View North Carolina Gauges List</a></b><br/>
                    <b><a href="{{route('gauges.scalingtableviewwdatewa')}}">View Washington Gauges List</a></b><br/>
                    <b><a href="{{route('gauges.scalingtableviewwdateil')}}">View Illinois Gauges List</a></b><br/>
                    <b><a href="{{route('gauges.scalingtableviewwdatema')}}">View massachusetts Gauges List</a></b>
                    <!-- Posts list -->
                    @if(!empty($gauges))
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>New Hampshire Gauges List </h2>
                                </div>

                            </div>
                        </div>

                        <ul class="nav nav-pills">
                            <li><a href="{{route('gauges.scalingmapviewwdatenh')}}">Map View</a></li>
                            <li class="active"><a href="{{route('gauges.scalingtableviewwdatenh')}}">Table View</a></li>


                        </ul>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <table class="table table-striped task-table">
                                    <!-- Table Headings -->
                                    <thead>
                                    <th>Gauge ID</th>
                                    <th>Lake</th>
                                    <th>City</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Number of Readings</th>
                                    <th>Action</th>
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
                                            <td class="table-text">
                                                <div>{{$gauge->latitude}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$gauge->longitude}}</div>
                                            </td>

                                            <td class="table-text">
                                                <div>{{$gauge->number_of_readings}}</div>
                                            </td>

                                            <td>
                                            <!-- without rain data <a href="{{ route('gauges.detailsheightprec', $gauge->id) }}" class="label label-success">View</a> -->
                                                <a href="{{ route('gauges.scaleddetailssixm', $gauge->id) }}" class="label label-success">View</a>

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