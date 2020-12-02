@extends('layouts.app')


@section('content')

    <div class="container container-table">			<!-- Main div to hold all Data -->

        <!-- Login Form -->
        <div class="row vertical-center-row">

            <h2 class="text-left">Response Form</h2>



            <br/>
            <form class="form-horizontal" action="/sms/send" method="post">

                  <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">From Phone No</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="fromNumber" id="fromNumber">
                            <option value="+19196363745">North Carolina(919-636-3745) </option>
                            <option value="+12068232494">Washington(206-823-2494) </option>
                              <option value="+18473808640">Illinois(847-380-8640) </option>
                               <option value="+15082528882">Massachusetts(508-252-8882) </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">To Phone Number</label>
                    <div class="col-lg-4">
                        <input name="phone" type="text" value="{{$phone}}" class="form-control" id="from_date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="text-center control-label col-lg-1">Message body</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="5" name="body"></textarea>
                    </div>
                </div>




                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp &nbsp &nbsp &nbsp &nbsp
                <button type="submit" name="submit" class="left-block btn btn-primary">SEND</button> &nbsp &nbsp &nbsp

            </form>







        </div>
    </div>


@endsection