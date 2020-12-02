@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Posts list -->
                    @if(!empty($sms_infoes))
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Invalid Formatted Messages </h2>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <table class="table table-striped task-table">
                                    <!-- Table Headings -->
                                    <thead>
                                    <th>Mobile Number</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    </thead>

                                    <!-- Table Body -->
                                    <tbody>
                                    @foreach($sms_infoes as $sms_info)
                                        <tr>
                                            <td class="table-text">
                                                <div>{{$sms_info->msg_from}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$sms_info->from_city}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$sms_info->from_state}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$sms_info->from_zip}}</div>
                                            </td>
                                            <td class="table-text">
                                                <?php
                                                $date = strtotime($sms_info->date);
                                                $formatdate = date("m-d-Y", $date);
                                                ?>
                                                <div>{{$formatdate}}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{$sms_info->time}}</div>
                                            </td>

                                            <td class="table-text">
                                                <div>{{$sms_info->body}}</div>
                                            </td>
                                            <td class="table-text">
                                                @if($sms_info->is_format_valid==2)
                                                    <div>Added to Measurement</div>
                                                @else
                                                    <div>Not added</div>
                                                @endif

                                            </td>
                                            <td>
                                                @if($sms_info->is_format_valid==0)
                                                    <a href="{{ route('sms.invalid.showform', $sms_info->id) }}" class="label label-success">ADD MEASUREMENT</a>
                                                @endif

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