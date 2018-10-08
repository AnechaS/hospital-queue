@extends('layouts.master')

@section('content')

<div class="container" id="content">

    <div class="circle-tile">
        <a href="#">
            <div class="circle-tile-heading dark-blue">
                <div class="fa">{{ $visitCount }}</div>
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

    @if ($today)
        <div class="btn-group btn-group-justified btn-tab-managt-queue">
            <a href="javascript:checkout()" class="btn btn-lg btn-default">
                <span class="glyphicon glyphicon-share-alt"></span> Checkout</a>
            <a href="#" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-retweet"></span> Change</a>
            <a href="javascript:remove()" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-trash"></span> Delate</a>
        </div>
    @endif

    <div class="queue-input-group">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon pointer" onclick="location.href='{{url('visit/create')}}'">
                        Create Visit
                    </span>
                    <span class="input-group-addon boder-partition"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" class="form-control" id="search" placeholder="Search...">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="input-group-addon boder-partition pointer" onclick="datepicker(true)">today</span>
                    <input type="date" name="date" id="date" class="form-control date-picker" value="{{$date}}">
                    <span class="input-group-addon pointer" onclick="datepicker()">send</span>
                </div>
            </div>
        </div>
    </div>

    @foreach ($visits as $visit)
    <div class="card-queue" data-vid="{{$visit->visit_id}}" data-hn="{{$visit->patient->hn}}" data-uid="{{$visit->user_id}}">
            <div class="body">
                <div class="row">
                    <div class="col-xs-5 left">
                        {{ $visit->patient->hn}}
                    </div>
                    <div class="col-xs-7 right">
                        <div class="text">
                            <div class="card-text">
                                <span class="glyphicon glyphicon-heart-empty"></span> {{ $visit->patient->firstname }} {{ $visit->patient->lastname }}</div>
                            <div class="card-text">
                                <span class="glyphicon glyphicon-user"></span> {{ $visit->user->name }}</div>
                            <div class="card-text">
                                <span class="glyphicon glyphicon-star-empty"></span>No. {{ $visit->visit_order }}</div>
                            <div class="card-text">
                                <span class="glyphicon glyphicon-calendar"></span>
                                {{  date('d/m/Y', strtotime($visit->date)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection

@section('js')
<script>
    var delay = 200;
    var clicks = 0;
    var timer = null;

    $('.card-queue').on('click', function() {
        var _ = $(this);

        clicks++;

        if(clicks === 1) {
            
            timer = setTimeout(function() {
                _.toggleClass('active');
                $('.card-queue.active').not(_).removeClass('active');
                clicks = 0;
            }, delay);

        } else {
            clearTimeout(timer);
            
            location.href = `{{url('visit/history')}}/${_.data('uid')}`;
            clicks = 0;
        }

    });

    function datepicker(boo = false) {
        var date = !boo ? $('.date-picker').val() : '';
        location.href='{{$url}}/' + date;
    }

    function checkout() {
        var item = $('.card-queue.active');
        if(item.length) {
            bootbox.confirm({
                message: `you sure confirm checkout visit hn ${item.data('hn')} ?`,
                buttons: {
                    confirm: {
                        label: 'Checkout',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (e) {
                    if (e) {                                                                     
                        $.ajax({
                            type: "PUT",
                            url: "{{url('visit/checkout')}}",
                            data: { 
                                id: item.data('vid')
                            },
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
   
    }

    function remove() {
        var item = $('.card-queue.active');

        if(item.length) {
            bootbox.confirm({
                message: `you sure confirm delete visit hn ${item.data('hn')} ?`,
                buttons: {
                    confirm: {
                        label: 'Delete',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (e) {
                    if (e) {
                  
                        $.ajax({
                            type: "DELETE",
                            url: `{{url('visit')}}/${item.data('vid')}`,
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
   
    }
</script>
@endsection