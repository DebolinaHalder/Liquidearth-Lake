@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
    <div class="row">
        <div class="col-lg-12">

        <!-- Posts list -->
            @if(!empty($problems))
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Reported Problem List </h2>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <table class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                            <th>Gauge ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Problem</th>

                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach($problems as $problem)
                                <tr>
                                    <td class="table-text">
                                        <div>{{$problem->gauge_id}}</div>
                                    </td>
                                    <td class="table-text">
                                        <?php
                                        $date = strtotime($problem->date);
                                        $formatdate = date("m-d-Y", $date);
                                        ?>
                                        <div>{{$formatdate}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$problem->time}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{$problem->problem}}</div>
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