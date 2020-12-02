@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif
                <!-- Posts list -->
                    @if(!empty($gauges))
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Gauges List </h2>
                                </div>

                            </div>
                        </div>

                        <ul class="nav nav-pills">
                            <li><a href="{{route('gauges.mapview')}}">Map View</a></li>
                            <li class="active"><a href="{{route('gauges.index')}}">Table View</a></li>


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
                                    <th>Initial Reading</th>
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
                                                <div>{{$gauge->initial_reading}}</div>
                                            </td>

                                            <td>
                                                <a href="{{ route('gauges.details', $gauge->id) }}" class="label label-success">View</a>

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