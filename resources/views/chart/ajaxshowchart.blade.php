<div>

    <from>
        <input type="hidden" id="gauge_inc_id" value="{{$gauge_inc_id}}">
        <input type="hidden" id="from_date" value="{{$from_date}}">
        <input type="hidden" id="to_date" value="{{$to_date}}">

    </from>
    <canvas id="speedChart" width="400" height="300"></canvas>
</div>





<script>
    var reading_date=[];
    var reading_height=[];
    var gauge_inc_id = $('#gauge_inc_id').val();
    var from_date =$('#from_date').val();
    var to_date= $('#to_date').val();
    function formatedate(date){
        return moment().format(date);
    }

    $.ajax({
        type:'GET',
        url:'/gauge/getjsondata',
        data:'gauge_inc_id='+gauge_inc_id+'&from_date='+ from_date+'&to_date='+to_date,
        success: function (data) {
            for (var i=0;i<data.length;++i)
            {
                reading_date.push(formatedate(String(data[i].date)));
                reading_height.push(data[i].height);

            }
            var speedCanvas = document.getElementById("speedChart");

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            function hoursEarlier(hours) {
                return moment().subtract(hours, 'h').toDate();
            };


            var speedData = {
                //labels: [formatedate("01/06/2018"),formatedate("01/08/2018"),formatedate("01/09/2018"),formatedate("01/18/2018")],
                labels:reading_date,
                datasets: [{
                    label: "Lake height",
                    // data: [0, 59, 75, 20, 20, 55, 40],
                    data:reading_height,
                    lineTension: 0.25,
                    fill:false,
                    borderColor: 'blue',
                    backgroundColor: 'transparent',
                    pointBorderColor: 'blue',
                    pointBackgroundColor: 'rgba(255,150,0,0.5)',
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
                    display: true,
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
                            unitStepSize: 30,

                            tooltipFormat: "MM/DD/YYYY",
                            displayFormats: {
                                day: 'MM/DD/YYYY'
                            }
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Average Lake Height in a day",
                            fontColor: "green"
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



