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
                        <th>card id</th>
                        <th>MNG</th>
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
                        <th>{{$patient->card_id}}</th>
                        <th>{{$patient->gender == 1 ? 'male' : 'female' }}</th>
                        <th>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="{{action('PatientController@edit', ['id' => $patient->patient_id])}}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="javascript:confirm('{{$patient->patient_id}}', 'hn {{$patient->hn}}')" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
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
    function confirm(id, msg) {
        bootbox.confirm({
            message: `you sure confirm delete ${msg} ?`,
            buttons: {
                confirm: {
                    label: 'Delete',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-default'
                }
            },
            callback: function (e) {
                if (e) {
                    $.ajax({
                        type: "DELETE",
                        url: `{{url('management/patient')}}/${id}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function( res ) {
                            if (!res.errors) {
                                location.reload();
                            }
                        }
                    });
                }
            }
        });
    }

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
