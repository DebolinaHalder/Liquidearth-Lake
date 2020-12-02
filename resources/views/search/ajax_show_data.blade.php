

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<table class="table table-striped task-table">
<!-- Table Headings -->
<thead>
<th>Gauge ID</th>
<th>Lake Name</th>
<th>Height</th>
<th>Precipi</th>
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
    @foreach($readings_without_sms as $reading)
        <tr>
            <td class="table-text">
                <div>{{$reading->gauge_id}}</div>
            </td>
            <td class="table-text">
                <div>{{$reading->name}}</div>
            </td>
            <td class="table-text">
                <div>{{$reading->height}}</div>
            </td>
            <td class="table-text">
                <div>{{$reading->precipi}}</div>
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

<br/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="table table-striped task-table">
            <!-- Table Headings -->
            <thead>
            <th>Mobile Number</th>
            <th>Message Body </th>
            <th>Gauge ID</th>
            <th>Lake Name</th>
            <th>Height</th>
            <th>Precipi</th>
            <th>Date</th>
            <th>Time</th>
            @if(Auth::check())
                <th>Is bubble level okay?</th>
            @endif
            <th>Notes</th>



            </thead>

            <!-- Table Body -->
            <tbody>
            @foreach($readings_with_sms as $reading)
                <tr>
                    <td class="table-text">
                        <div>{{$reading->msg_from}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$reading->body}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$reading->gauge_id}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$reading->name}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$reading->height}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$reading->precipi}}</div>
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

                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>





