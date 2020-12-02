@extends('layouts.app')
@section('content')


        <div class="row">

            <ul class="nav nav-pills">
                <li><a href="{{route('gauges.scaleddetailsall',$gauge->id)}}">All Data</a></li>
                <li><a href="{{route('gauges.scaleddetailsoney',$gauge->id)}}">Last 1 Year</a></li>
                <li ><a href="{{route('gauges.scaleddetailssixm',$gauge->id)}}">Last 6 Months</a></li>
                <li class="active"><a href="{{route('gauges.scaleddetailsthreem',$gauge->id)}}">Last 3 Months</a></li>
                <li ><a href="{{route('gauges.scaleddetailsonem',$gauge->id)}}">Last Month</a></li>

            </ul>


        </div>

   

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h4><b>{{$gauge->name}} &nbsp&nbsp&nbsp Gauge ID: {{$gauge->gauge_id}}  </b></h4>

                </div>

            </div>
        </div>
        
         @if(!empty($readings_all))

        <div>

            <from>
                <input type="hidden" id="gauge_inc_id" value="{{$gauge->id}}">
                <input type="hidden" id="gauge_unit" value="{{$gauge->unit}}">
            </from>
            <canvas id="speedChart" width="400" height="170"></canvas>
        </div>

        <br/>
        <br/>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table class="table table-striped task-table">
                    <!-- Table Headings -->
                    <thead>

                    <th>Height</th>
                    <th>Date</th>
                    <th>Time</th>
                    @if(Auth::check())
                        <th>Is bubble level okay?</th>
                    @endif
                    <th>Notes</th>
                    @if(Auth::check())
                        <th>Action</th>
                    @endif


                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach($readings_all as $reading)
                        <tr>
                            <td class="table-text">
                                <div>{{$reading->height}}</div>
                            </td>
                            <td class="table-text">
                                <?php
                                $date = strtotime($reading->date);
                                $formatdate = date("m-d-Y", $date);
                                ?>
                                <div>{{$formatdate}}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$reading->time}}</div>
                            </td>
                            @if(Auth::check())
                                <td class="table-text">
                                    <div>{{$reading->is_bubble_level_okay}}</div>
                                </td>
                            @endif
                            <td class="table-text">
                                <div>{{$reading->notes}}</div>
                            </td>

                            @if(Auth::check())
                                <td>

                                    <a href="{{ route('readings.edit', $reading->id) }}" class="label label-warning">Edit</a>
                                    <a href="{{ route('readings.delete', $reading->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
         @else
            <div style="padding:0px;color: #ff0000;border: 0px solid rgba(33, 37, 41, 0.1);" align="left">
                <h1>There is no reading for three months</h1>
            </div>
        @endif
        </div>
        </div>
        </div>
        </div>

@endsection


@section('script')
    <script>
        var scale_size=10;
        var reading_date=[];
        var reading_height=[];
        var gauge_inc_id = $('#gauge_inc_id').val();
        var unit = $('#gauge_unit').val();
        function formatedate(date){
            return moment().format(date);
        }

        $.ajax({

            type:'GET',
            url:'/gauge/getjsondatathreem',
            data:'gauge_inc_id='+gauge_inc_id,
            success: function (data) {

                for (var i=0;i<data.length;++i)
                {
                    reading_date.push(formatedate(String(data[i].date)));
                    reading_height.push(data[i].height);

                }

                var start_date= formatedate(String(data[0].date));
                start_date= moment(start_date);
                var end_date = formatedate(String(data[data.length-1].date));
                end_date = moment(end_date);
                var modified_end_date;
                var diff_date_in_days=  end_date.diff(start_date, 'days');
                if(diff_date_in_days%scale_size==0){
                    modified_end_date=end_date;
                }
                else {
                    var num_steps_x_axis = parseInt(diff_date_in_days / scale_size);
                    modified_end_date = start_date.add((num_steps_x_axis + 1) * scale_size, 'days');
                }


                var speedCanvas = document.getElementById("speedChart");

                Chart.defaults.global.defaultFontFamily = "Lato";
                Chart.defaults.global.defaultFontSize = 18;




                var speedData = {
                    //labels: [formatedate("01/06/2018"),formatedate("01/08/2018"),formatedate("01/09/2018"),formatedate("01/18/2018")],
                    labels:reading_date,
                    datasets: [{
                        label: "Lake level",
                        // data: [0, 59, 75, 20, 20, 55, 40],
                        data:reading_height,
                        lineTension: 0.25,
                        fill:false,
                        borderColor: 'rgba(65,105,225,1)',
                        backgroundColor: 'transparent',
                        pointBorderColor: 'rgba(65,105,225,1)',
                        pointBackgroundColor: 'rgba(65,105,225,1)',
                        borderWidth:2,
                        borderDash: [0, 0],
                        pointRadius: 2,
                        pointHoverRadius: 4,
                        pointHitRadius: 30,
                        pointBorderWidth: 2,
                        pointStyle: 'rectRounded'
                    }]
                };

                var chartOptions = {
                    legend: {
                        display: false,
                        position: 'top',
                        labels: {
                            boxWidth: 80,
                            fontColor: 'black'
                        }
                    },
                    scales: {
                        xAxes: [{
                            type: "time",
                            time: {
                                unit: 'day',
                                unitStepSize:scale_size,
                                max:modified_end_date,
                                tooltipFormat: "MM/DD/YYYY",
                                displayFormats: {
                                    day: 'MM/DD/YYYY'
                                }
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                //color: "black",
                               // borderDash: [2, 5],
                            },
                            scaleLabel: {
                                display: true,
                                labelString: "Lake Height("+unit+")",
                                fontColor: "rgba(65,105,225,1)"
                            }
                        }]
                    }
                };

                var lineChart = new Chart(speedCanvas, {
                    type: 'line',
                    data: speedData,
                    options: chartOptions
                });


            }
        });
    </script>

@endsection


