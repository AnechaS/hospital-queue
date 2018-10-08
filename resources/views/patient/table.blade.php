@extends('layouts.master')

@section('content')
<div class="container" id="content">
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

        $('#example_wrapper > .row .col-sm-6:first').html(`<a href="{{url("management/patient/create")}}" class="btn btn-default">Create</a>`);
    });
</script>
@endsection
