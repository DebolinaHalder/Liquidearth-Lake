@extends('layouts.app')
gaugeselectmapbd.blade.php
<?php
/*
        if($gauge->timezone == "PDT"){
            $tz ="America/Los_Angeles";
        }
        else if($gauge->timezone == "MDT"){
            $tz="America/Denver";
        }
        else if($gauge->timezone == "CDT"){
            $tz="America/Chicago";
        }
         else if($gauge->timezone == "EDT"){
            $tz="America/New_York";
        }
        else{

        }

        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp);
*/

?>
@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">
            <b><a href="{{route('readings.gaugeselectmap')}}">Go TO Add Measurement (North Carolina)</a></b><br/>
            <b><a href="{{route('readings.gaugeselectmapwa')}}">Go TO Add Measurement (Washington)</a></b><br/>
            <b><a href="{{route('readings.gaugeselectmapil')}}">Go TO Add Measurement (Illinois)</a></b><br/>
            <b><a href="{{route('readings.gaugeselectmapil')}}">Go TO Add Measurement (Massachusetts)</a></b>
            <h2 class="text-left">Select a Bangladesh gauge</h2>
            <ul class="nav nav-pills">
                <li class="active"><a href="{{route('readings.gaugeselectmapbd')}}">Map View</a></li>
                <li><a href="{{route('readings.gaugeselectbd')}}">Table View</a></li>


            </ul>

            <br/>



            <div id="map"></div>








        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report Problem</h4>

                    <form action="/reading/problem" method="post">
                        <div class="modal-body">
                            <input type="hidden" id="modal_gauge_name" name="gauge_id" /><br/>
                            Date:<input type="date" id="modal_date" name="date" readonly/> &nbsp; &nbsp; &nbsp;
                            Time:<input type="text" id="modal_time" name="time" readonly/> <br/><br/>
                            <textarea class="form-control" rows="2" name="problem" placeholder="Submit the problem"></textarea>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        </div>
                        <div class="modal-footer">
                            <button name="submit" type="submit" class="left-block btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection

@section('css')
    <style>
        #map{
            height:700px;
            width:100%;
        }
    </style>

@endsection

@section('script')

    <script>
        var map;
        function initMap() {
                    var options = {zoom:8,
                center:{lat: 23.777176, lng:90.399452
}
            };
            map = new google.maps.Map(document.getElementById('map'),options);


        }

        function addMarker(lat,lng,label,id) {
            var coords = {lat: lat, lng: lng};
            var marker = new google.maps.Marker(
                {
                    position: coords,
                    map: map

                }
            );
            var infoWindow = new google.maps.InfoWindow({
                content: label
            });
            marker.addListener("mouseover",function () {
                infoWindow.open(map,marker);
            });
            marker.addListener("mouseout",function () {
                infoWindow.close();
            });


            marker.addListener('click', function() {
                var location="/reading/mapcreate/"+id;
                window.location.assign(location);
            });

        }



        $(function () {
            $.ajax({
                type:'GET',
                url:'/json/gaugesbd',
                success:function (gauges) {

                    for(var i=0;i<gauges.length;i++){
                        var label = gauges[i].gauge_id+":"+gauges[i].name;
                        addMarker(Number(gauges[i].latitude),Number(gauges[i].longitude),label,gauges[i].id);
                        console.log("success",label);
                    }

                }
            });

        });





        function fill_modal(){
            var gauge_name = $('#gauge_inc_id').val();
            var date=$('#date').val();
            var time=$('#time').val();

            $("#modal_gauge_name").val(gauge_name);
            $("#modal_date").val(date);
            $("#modal_time").val(time);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC05_d1NGXHspNEjhQhZdglRWMoBv4TUhY&callback=initMap"
            async defer>

    </script>

@endsection

