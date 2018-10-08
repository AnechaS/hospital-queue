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
            <form class="form-horizontal" action="{{url($action)}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Station</label>
                    <div class="col-sm-10">
                        <select name="station_id" id="station-id" class="form-control">
                            <option value="" disabled {{old('station_id') ? '' : 'selected'}}> Please Select Station</option>
                            @foreach ($stations as $station)
                                @php
                                    $inputStaionSelected =  (old('station_id') && old('station_id') == $station->station_id) || $visit->station_id == $station->station_id;
                                @endphp
                                <option value="{{$station->station_id}}" {{ $inputStaionSelected ? 'selected' : '' }}>{{$station->station_name_th}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date" value="{{ $visit->date or old('date') }}">
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