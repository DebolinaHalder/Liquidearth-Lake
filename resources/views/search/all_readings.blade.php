@extends('layouts.app')


@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Search Gauge Readings</h2>



            <br/>
            <form class="form-horizontal" action="/search/showreadings" method="post">



                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Gauge</label>
                    <div class="col-lg-4">
                            <select class="form-control" name="gauge_inc_id" id="gauge_inc_id">

                                @foreach($gauges as $gauge)

                                    <option value="{{$gauge->id}}"> {{$gauge->gauge_id}}:{{$gauge->name}}</option>
                                @endforeach

                            </select>


                    </div>
                </div>


                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">From Date</label>
                    <div class="col-lg-4">
                        <input name="from_date" type="date" value="" class="form-control" id="date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">To Date</label>
                    <div class="col-lg-4">
                        <input name="to_date" type="date" value="" class="form-control" id="date" required>
                    </div>
                </div>




                <input type="hidden" name="_token" value="{{ csrf_token() }}">

&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp &nbsp &nbsp &nbsp &nbsp<button name="submit" type="submit" class="left-block btn btn-primary">Search</button>

            </form>




        </div>
    </div>




@endsection

@section('script')
    <script>
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

