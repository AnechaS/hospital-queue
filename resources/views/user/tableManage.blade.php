@extends('layouts.master')

@section('content')
<div class="container" id="content">
    <div class="card-x">
        <div class="body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>username</th>
                        <th>email</th>
                        <th>role</th>
                        <th>MNG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <th>{{$key+1}}</th>
                        <th>{{$user->name}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$user->role}}</th>      
                        <th>
                            <div class="btn-group btn-group-xs" role="group">
                                <a href="{{action('UserController@edit', ['id' => $user->user_id])}}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="javascript:confirm('{{$user->user_id}}', 'name {{$user->name}}')" class="btn btn-danger">
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
                        url: `{{url('management/user')}}/${id}`,
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

        $('#example_wrapper > .row .col-sm-6:first').html(`<a href="{{action('UserController@create')}}" class="btn btn-default">Create</a>`);

    });
</script>
@endsection