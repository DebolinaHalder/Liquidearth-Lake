<!DOCTYPE html>
<html lang="en">
<head>
    <title>Liquid Earth Lake</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   
    </script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js">

    </script>
    <script src = "https://cdn.jsdelivr.net/momentjs/2.13.0/moment.min.js">

    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    {!! Charts::assets() !!}

    <div class="container">

        @yield('css')
    </div>


</head>

<body>

<!--
<!-- Navigation Bar -->
<nav role="navigation" class="navbar navbar-collapse navbar-light fixed-top" style="border-bottom: 1px solid rgba(33, 37, 41, 0.1);
  background-color: #F8F9F9;
  font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  transition: all 0.2s;">





    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-md-offset-2">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle Navigation Part</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <!-- <a href="{{route('genhome')}}"> -->
                    <img style="float:left;" src="{{asset('public/image/earth.png')}}" width="80" height="80" alt="">
                    <h4 style="margin-bottom:0;"><b>LiquidEarth Lake: Citizen Science Data Portal</b></h4>
                    <p style="line-height:110%;"><em>Tennessee Technological University<br/>
                        </em></p>
               <!--  </a> -->
            </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
    <!--
           <li class="nav-item"><a href="{{route('gauges.scalingmapviewwdate')}}">Scaled Data View</a></li>
           -->



        <!-- <li class="nav-item"><a href="{{route('genhome')}}">Home</a></li>
         <li class="nav-item"><a href="{{route('gauges.mapview')}}">View Lake Data With Precipi</a></li> -->

   <li class="dropdown"><a href="{{route('gauges.scalingtableviewwdate')}}" data-toggle="dropdown" class="dropdown-toggle">View Lake Data<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('gauges.scalingtableviewwdate')}}">View  NC Lake Data</a></li>
                <li><a href="{{route('gauges.scalingtableviewwdatewa')}}">View WA Lake Data</a></li>
                  <li><a href="{{route('gauges.scalingtableviewwdateil')}}">View IL Lake Data</a></li>
                     <li><a href="{{route('gauges.scalingtableviewwdatema')}}">View MA Lake Data</a></li>
                     <li><a href="{{route('gauges.scalingtableviewwdatefr')}}">View France Lake Data</a></li>
                <li><a href="{{route('gauges.scalingtableviewwdatebd')}}">View Bangladesh Lake Data</a></li>
                <li><a href="{{route('gauges.scalingtableviewwdatein')}}">View Indian Lake Data</a></li>
                 <!-- <li><a href="{{route('gauges.scalingtableviewdatenh')}}">View New Hampshire Lake Data</a></li> -->
                

            </ul>
        </li>

        <li class="dropdown"><a href="{{route('readings.gaugeselect')}}" data-toggle="dropdown" class="dropdown-toggle">Add Measurement<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('readings.gaugeselect')}}">Add Measurement (NC)</a></li>
                <li><a href="{{route('readings.gaugeselectwa')}}">Add Measurement (WA)</a></li>
                   <li><a href="{{route('readings.gaugeselectil')}}">Add Measurement (IL)</a></li>
                     <li><a href="{{route('readings.gaugeselectma')}}">Add Measurement (MA)</a></li>
                     <li><a href="{{route('readings.gaugeselectfr')}}">Add Measurement (France)</a></li>
                <li><a href="{{route('readings.gaugeselectbd')}}">Add Measurement (Bangladesh)</a></li>
                <li><a href="{{route('readings.gaugeselectnh')}}">Add Measurement (New Hampshire)</a></li>
                     

            </ul>
        </li>
        <li class="dropdown"><a href="{{route('readings.download')}}" data-toggle="dropdown" class="dropdown-toggle">Add Measurement<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('readings.download')}}">Download NC lake data</a></li>
                <li><a href="{{route('readings.downloadwa')}}">Download WA lake data</a></li>
                <li><a href="{{route('readings.downloadil')}}">Download IL lake data</a></li>
                <li><a href="{{route('readings.downloadma')}}">Download MA lake data</a></li>
                
                <li><a href="{{route('readings.downloadnh')}}">Download NN lake data</a></li>
                <li><a href="{{route('readings.downloadfr')}}">Download France lake data</a></li>
                <li><a href="{{route('readings.downloadbd')}}">Download Bangladesh lake data</a></li>
                <li><a href="{{route('readings.downloadall')}}">Download All lake data</a></li>
                     

            </ul>
        </li>
        

       <!--  <li class="nav-item-active"><a href="{{route('readings.gaugeselect')}}">Add Measurement</a></li> -->
<li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @if (!Auth::check())
                            <li><a href="{{route('login')}}">Login</a></li>
                        @endif
                        <li><a href="{{route('gauges.create')}}">Add Gauge</a></li>
                        <li><a href="{{route('gauges.adminview')}}">Edit Gauge</a></li>
                        <li><a href="{{route('readings.viewproblem')}}">Reported Gauge Problems</a></li>
                        <li><a href="{{route('sms.invalid')}}">View Invalid Formatted Messages</a></li>
                        <li><a href="{{route('sms.showall')}}">SMS Response</a></li>
                        <li><a href="{{route('search.showoptions')}}">View and Export data</a></li>
                        <li><a href="{{route('reading.entry')}}">Enter reading with csv</a></li>
                       <!--  <li><a href="{{route('gauges.scalingmapview')}}">Scaled Map View</a></li> -->
                         @if(Auth::check())
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                         @endif
                    </ul>
                </li>


        </ul>

    </div>


</nav>

<div>
   @yield('homepage')

</div>


<div class="container">

    @yield('content')
</div>




</body>

<div class="container">

    @yield('script')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script src="js/script.js"></script>

</html>