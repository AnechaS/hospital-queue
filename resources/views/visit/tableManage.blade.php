@extends('layouts.master')

@section('content')
<div class="container" id="content">
    <div class="card-x">
        <div class="body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>date</th>
                        <th>station</th>
                        <th>patient</th>
                        <th>reser</th>
                        <th>order</th>
                        <th>MNG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $key => $visit)
                    <tr>
                        <th>{{$key+1}}</th>
                        <th>{{$visit->date}}</th>
                        <th>{{$visit->station->station_name_th}}</th>
                        <th>{{$visit->user->patient->hn}}</th>      
                        <th>{{$visit->reser ? 'จอง' : 'ไม่จอง'}}</th>      
                        <th>{{$visit->visit_order}}</th>
                        <th>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="{{action('VisitController@edit', ['id' => $visit->visit_id])}}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="javascript:confirm('{{$visit->visit_id}}', 'station {{$visit->station->station_name_th}}  hn {{$visit->user->patient->hn}}')" class="btn btn-danger">
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
                        url: `{{url('management/visit')}}/${id}`,
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

        $('#example_wrapper > .row .col-sm-6:first').html(`<a href="{{action('VisitController@create')}}" class="btn btn-default">Create</a>`);

    });
</script>
@endsection