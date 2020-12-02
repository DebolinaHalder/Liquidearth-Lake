@extends('layouts.app')


@section('content')

    <div class="container container-table">
        <div class="row vertical-center-row">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
            @endif
                <b><a href="{{route('gauges.scalingmapviewwdate')}}">View North Carolina Gauges List</a></b><br/>
                 <b><a href="{{route('gauges.scalingmapviewwdatewa')}}">View Washington Gauges List</a></b><br/>
                 <b><a href="{{route('gauges.scalingmapviewwdateil')}}">View Illinois Gauges List</a></b>
        <!-- Posts list -->
            @if(!empty($gauges))
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Massachusetts Gauges List </h2>
                        </div>

                    </div>
                </div>

                <ul class="nav nav-pills">

                    <li  class="active"><a href="{{route('gauges.scalingmapviewwdatema')}}">Map View</a></li>
                    <li><a href="{{route('gauges.scalingtableviewwdatema')}}">Table View</a></li>


                </ul>

                <br/>
                <div id="map">

                </div>

            @endif
        </div>
    </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        #map{
            height:800px;
            width:100%;
        }
    </style>

@endsection

@section('script')
    <script>
        var map;
        function initMap() {
            var options = {zoom:8,
                center:{lat: 42.361145, lng:-71.057083
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
                var location="/gauge/scaleddetailssixm/"+id;
               // var location="/gauge/detailsheightprec/"+id;
                window.location.assign(location);
            });

        }



        $(function () {
            $.ajax({
                type:'GET',
                url:'/json/gaugesma',
                success:function (gauges) {

                    for(var i=0;i<gauges.length;i++){
                        var label = gauges[i].gauge_id+":"+gauges[i].name;
                        addMarker(Number(gauges[i].latitude),Number(gauges[i].longitude),label,gauges[i].id);
                        console.log("success",label);
                    }

                }
            });

        });

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC05_d1NGXHspNEjhQhZdglRWMoBv4TUhY&callback=initMap"
            async defer>

    </script>

@endsection