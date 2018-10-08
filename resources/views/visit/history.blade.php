@extends('layouts.master')

@section('content')
<div class="container" id="content">

    <div class="row">
        <div class="col-xs-5" style="padding-right:10px">
            <div class="card-queue">
                <div class="body">
                    <div class="avatar" align="center">
                        <img src="https://image.flaticon.com/icons/png/512/146/146022.png" class="img-responsive" alt="Cinque Terre">
                    </div>
                    <div class="text">
                        <hr>
                        <div class="card-text">
                            <strong>Firstname And Lastname:</strong>
                            {{ $patient->firstname}} {{ $patient->lastname }}
                        </div>
                        <hr>
                        <div class="card-text">
                            <strong>HN:</strong>
                            {{ $patient->hn}}
                        </div>
                        <hr>
                        <div class="card-text">
                            <strong>Username:</strong>
                            {{ $patient->user->name}}
                        </div>
                        <hr>
                        <div class="card-text">
                            <strong>Email:</strong>
                            {{ $patient->user->email}}
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-7" style="padding-left:0px">
            <div class="btn-group btn-group-justified btn-tab-managt-queue">
                <a href="javascript:checkout()" class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-left"></span></a>
                <a href="#" class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>


            @foreach ($visits as $key => $visit)
            <div class="card-station">
                <div class="body">
                    <div class="row">
                        <div class="col-xs-5 left">
                            {{$key + 1}}
                        </div>
                        <div class="col-xs-5 center">
                            <div class="text">
                                <div class="card-text">
                                    <span class="glyphicon glyphicon-flag"></span> {{
                                    $visit->station->station_name_th }}</div>
                                <div class="card-text">
                                    <span class="glyphicon glyphicon-bookmark"></span>No. {{ $visit->visit_order }}</div>
                                <div class="card-text">
                                    <span class="glyphicon glyphicon-pushpin"></span> {{ $visit->reser == 1 ? 'จองล่วงหน้า' : 'ไม่จองล่วงหน้า'}}</div>
                                <div class="card-text">
                                    <span class="glyphicon glyphicon-time"> </span>  {{  date('d/m/Y', strtotime($visit->date)) }} </div>
                            </div>
                        </div>
                        <div class="col-xs-2 right">
                            <span class="glyphicon {{ $visit->finish == 1 ? 'glyphicon-ok-circle ' : 'glyphicon-option-horizontal'}} text-green"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@section('js')

@endsection