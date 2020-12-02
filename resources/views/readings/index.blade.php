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
            @if(!empty($readings))
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>List of Gauge Readings </h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('readings.create') }}"> Add New</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <table class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                            <th>Gauge</th>
                            <th>Height</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Notes</th>

                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach($readings as $reading)
                                <tr>
                                    <td class="table-text">
                                        <div>{{$reading->gauge_id}}:{{$reading->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$reading->height}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$reading->date}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$reading->time}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$reading->notes}}</div>
                                    </td>



                                    <td>

                                        <a href="{{ route('readings.edit', $reading->id) }}" class="label label-warning">Edit</a>
                                        <a href="{{ route('readings.delete', $reading->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
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