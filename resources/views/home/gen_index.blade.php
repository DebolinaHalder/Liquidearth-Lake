@extends('layouts.app')

@section('homepage')




<div style="left:0; right:-15px; width:100%;padding:10px;overflow-x:hidden;" align="center">
    <h1 align="center"> Welcome to the LiquidEarth Lake Citizen Science Data Portal</h1>

        <div class="row">
            <div class="col-md-6">
                 <img src="{{asset('image/nc_lake_25.jpg')}}" class="img-responsive" />
            </div>
            <div class="col-md-6">
                <img src="{{asset('image/nc_lake_6.jpg')}}" class="img-responsive" />
            </div>
        </div>

</div>


<div id="footer" style="bottom: 0;width: 100%;height:auto;background-color:#F8F9F9;padding:10px;">

        <div class="row">

            <div class="col-md-3">
                <center>
                    <img src="{{asset('image/tntech1.png')}}" width="200" height="90"  >

                </center>
            </div>
            <div class="col-md-3">
                <center>
                    <img src="{{asset('image/chapel_hill1.png')}}" width="280" height="89"  >

                </center>
            </div>
            <div class="col-md-3">
                <center>
                    <img src="{{asset('image/uni_washington.png')}}" width="200" height="89"  >

                </center>
            </div>
            <div class="col-md-3">
                <center>
                    <img src="http://lakelevel.web.unc.edu/files/2017/06/NASA_logo.svg_.png" height="90" width="100"  >

                </center>
            </div>


    </div>
</div>
<!--

        <div style="background-color:#F8F9F9;position: absolute; left: 0; width: 100%;bottom: 0; overflow: hidden;">

                <footer class="content-info" role="contentinfo">
                    <div class="footer-container container">
                        <div class="row">
                            <section class="widget text-16 widget_text col-md-3 col-sm-4">
                                <p><img class="" src="{{asset('public/image/tntech1.png')}}" alt="" width="1" height="90%" align="left"/></p>

                            </section>
                            <section class="widget text-17 widget_text col-md-3 col-sm-2">
                                <p><img class="" src="{{asset('public/image/chapel_hill1.png')}}" alt="" width="280" height="89" align="center"/></p>


                            </section>

                            <section class="widget text-17 widget_text col-md-3 col-sm-2">
                                <p><img class="" src="{{asset('public/image/uni_washington.png')}}" alt="" width="200" height="89" align="right"/></p>


                            </section>

                            <section class="widget text-17 widget_text col-md-3 col-sm-4">
                                <p><img class="" src="http://lakelevel.web.unc.edu/files/2017/06/NASA_logo.svg_.png" alt="" width="108" height="90" align="right"/></p>

                            </section>
                        </div>
                    </div>
                </footer>

        </div>

        -->





@endsection