@extends('layouts.master')

@section('content')
<div class="container" id="content">
    <div class="row">
        @foreach ($stations as $station)
        <div class="col-xs-4">
            <div class="circle-tile pointer" onclick="location.href='{{ url('queue') . '/' . $station->station_id }}'">
                <a href="#">
                    <div class="circle-tile-heading dark-blue">
                        <div class="fa">{{$station->visitTodayCount()}}</div>
                    </div>
                </a>
                <div class="circle-tile-content dark-blue">
                    <div class="circle-tile-description text-faded">
                        Department
                    </div>
                    <div class="circle-tile-number text-faded">
                        {{ $station->station_name_th }}
                        <span id="sparklineA"></span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card-x">
        <div class="body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>hn</th>
                        <th>Age</th>
                        <th>dob</th>
                        <th>gender</th>
                        <th>card id</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $key => $patient)
                    <tr>
                        <th>{{$key+1}}</th>
                        <th>{{$patient->firstname}}</th>
                        <th>{{$patient->lastname}}</th>
                        <th>{{$patient->hn}}</th>
                        <th>{{$patient->age}}</th>
                        <th>{{$patient->dob}}</th>
                        <th>{{$patient->gender == 1 ? 'male' : 'female' }}</th>
                        <th>{{$patient->card_id}}</th>
                        <th>
                            <div class="btn-group" role="group">
                                <a href="{{url("/visit/history/{$patient->user_id}")}}" class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-arrow-right"></span>
                                </a>
                            </div>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    @section('js')
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthChange": false,
            "bInfo": false,
            "pageLength": 15,
            //  "searching": false
            // "ordering": false,
            language: {
                // "search": "Filter records:",
                search: "_INPUT_",
                searchPlaceholder: "Search ..."
            }

        });
    });
</script>
@endsection
