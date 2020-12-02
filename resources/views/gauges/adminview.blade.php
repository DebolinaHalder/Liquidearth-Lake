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
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('gauges.create') }}"> Add New</a>
                        </div>
                    </div>
                </div>
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
                            <th>Timezone</th>
                            <th>Unit</th>
                            <th>Min Height</th>
                            <th>Max Height</th>
                            <th>Installation Date</th>
                            <th>Initial Reading</th>
                            <th>Notes</th>
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
                                        <div>{{$gauge->timezone}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$gauge->unit}}</div>
                                    </td>
                                        <td class="table-text">
                                        <div>{{$gauge->min_height}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$gauge->max_height}}</div>
                                    </td>
                                    <td class="table-text">
                                        <?php
                                        $date = strtotime($gauge->installation_date);
                                        $formatdate = date("m-d-Y", $date);
                                        ?>
                                        <div>{{$formatdate}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$gauge->initial_reading}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$gauge->notes}}</div>
                                    </td>


                                    <td>
                                        <a href="{{ route('gauges.details', $gauge->id) }}" class="label label-success">View</a>
                                        <a href="{{ route('gauges.edit', $gauge->id) }}" class="label label-warning">Edit</a>
                                        <a href="{{ route('gauges.delete', $gauge->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
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