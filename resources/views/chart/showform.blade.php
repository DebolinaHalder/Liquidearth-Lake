@extends('layouts.app')

@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Gauge ID: {{$gauge->gauge_id}} </h2>
                        <h2>Lake: {{$gauge->name}}</h2>

                    </div>

                </div>
            </div>
            <form class="form-horizontal" action="" method="">

                <input type="hidden" name="gauge_inc_id" id="gauge_inc_id" value="{{$gauge->id}}">
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">From</label>
                    <div class="col-lg-4">
                        <input name="from_date" type="date"  class="form-control" id="from_date" value="2017-01-01" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">To</label>
                    <div class="col-lg-4">
                        <input name="to_date" type="date" value="" class="form-control" id="to_date" required>
                    </div>
                </div>


                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="button" onclick="show_readings()" class="left-block btn btn-primary">SUBMIT</button> &nbsp &nbsp &nbsp

            </form>



            <div id="showdata">

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
                    url:'/gauge/ajaxshowchart',
                    data:'gauge_inc_id='+gauge_inc_id+'&from_date='+ from_date+'&to_date='+to_date,
                    success:function(data){
                        $("#showdata").html(data);
                    }
                });
            }

        }



        function getMessage(){
            $.ajax({
                type:'GET',
                url:'/reading/ajax/load',
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

