@extends('layouts.app')
@section('content')
<div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
    <div class="row vertical-center-row">
        <h2 class="text-left">SMS List</h2>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>
                    <th>Mobile Number</th>
                    <th>Message Body </th>
                    <th>Gauge ID</th>
                    <th>Lake Name</th>
                    <th>Height</th>
                    <th>Precipi</th>
                    <th>Date</th>
                    <th>Time</th>
                    @if(Auth::check())
                        <th>Is bubble level okay?</th>
                    @endif
                    <th>Notes</th>
                    <th>Action</th>



                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach($readings_with_sms as $reading)
                        <tr>
                            <td class="table-text">
                                <div>{{$reading->msg_from}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->body}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->gauge_id}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->name}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->height}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->precipi}}</div>
                            </td>
                            <td class="table-text">
                                <?php
                                $date = strtotime($reading->date);
                                $formatdate = date("m-d-Y", $date);
                                ?>
                                <div>{{$formatdate}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->time}}</div>
                            </td>
                            @if(Auth::check())
                                <td class="table-text">
                                    <div>{{$reading->is_bubble_level_okay}}</div>
                                </td>
                            @endif
                            <td class="table-text">
                                <div>{{$reading->notes}}</div>
                            </td>

                            <td>

                                <a href="{{ route('sms.response', $reading->msg_from) }}" class="label label-warning">Response</a>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection