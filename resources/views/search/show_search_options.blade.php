@extends('layouts.app')

<?php

$tz="America/New_York";
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp);


?>

@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Search Readings</h2>



            <br/>
            <form class="form-horizontal" action="" method="">

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Gauge</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="gauge_inc_id" id="gauge_inc_id">
                            <option selected>ALL</option>
                            @foreach($gauges as $gauge)

                                <option value="{{$gauge->id}}">{{$gauge->gauge_id}}:{{$gauge->name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">From</label>
                    <div class="col-lg-4">
                        <input name="from_date" type="date"  class="form-control" id="from_date" value="2017-01-01" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">To</label>
                    <div class="col-lg-4">
                        <input name="to_date" type="date" value="<?php echo $dt->format("Y-m-d"); ?>" class="form-control" id="to_date" required>
                    </div>
                </div>


                <input type="hidden" name="_token" value="{{ csrf_token() }}">

&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp &nbsp &nbsp &nbsp &nbsp<button type="button" onclick="show_readings()" class="left-block btn btn-primary">SEARCH</button> &nbsp &nbsp &nbsp
                <button type="button" onclick="export_data()" class="btn btn-primary">Export</button>
            </form>



            <div id="showdata">

            </div>

            <div id="exportdata">

            </div>




        </div>
    </div>


@endsection

@section('script')
    <script>
        function show_readings(){
            var gauge_inc_id = $('#gauge_inc_id').val();
            var from_date =$('#from_date').val();
            var to_date= $('#to_date').val();

            if (from_date !="" && to_date !="") {

                $.ajax({
                    type:'GET',
                    url:'/search/showdata',
                    data:'gauge_inc_id='+gauge_inc_id+'&from_date='+ from_date+'&to_date='+to_date,
                    success:function(data){
                        $("#showdata").html(data);
                    }
                });
            }

        }

        function export_data(){
            var gauge_inc_id = $('#gauge_inc_id').val();
            var from_date =$('#from_date').val();
            var to_date= $('#to_date').val();

            if (from_date !="" && to_date !="") {

                var location='/search/exportdata?'+'gauge_inc_id='+gauge_inc_id+'&from_date='+ from_date+'&to_date='+to_date;
                // var location="/gauge/detailsheightprec/"+id;
                window.location.assign(location);


            }

        }


        function getMessage(){
            $.ajax({
                type:'GET',
                url:'/rading/ajax/load',
                data:'gauge_inc_id',
                success:function(data){
                    $("#loadTime").html(data.msg);
                }
            });
        }
        function changeTimezone(){
            var gauge_name = $('#gauge_inc_id').find(":selected").text();

            $.ajax({
                type:'GET',
                url:'/reading/ajax/load',
                data:'name='+gauge_name,
                success:function(data){
                    $("#loadtime").html(data);
                }
            });
        }

        function fill_modal(){
            var gauge_name = $('#gauge_name').val();
            var date=$('#date').val();
            var time=$('#time').val();

            $("#modal_gauge_name").val(gauge_name);
            $("#modal_date").val(date);
            $("#modal_time").val(time);
        }
    </script>

@endsection

