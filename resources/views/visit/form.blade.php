@extends('layouts.master')

@inject('date', 'Carbon\Carbon')

@section('content')
<div class="container" id="content">
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="card-queue">
        <div class="body">
            <form class="form-horizontal" action="{{url("visit")}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">เลขบัตรประจำตัวประชาชน</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="card-id" name="card_id" placeholder="Card Id" value="{{ old('card_id') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Station</label>
                    <div class="col-sm-10">
                        <select name="station_id" id="station-id" class="form-control">
                            <option value="" disabled {{old('station_id') ? '' : 'selected'}}> Please Select Station</option>
                            @foreach ($stations as $station)
                                <option value="{{$station->station_id}}" {{ old('station_id') && old('station_id') == $station->station_id ? 'selected' : '' }}>{{$station->station_name_th}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') ? old('date') : $date->toDateString() }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection