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
            <form class="form-horizontal" action="{{url($action)}}" method="post">
                {{ csrf_field() }}
                {{ method_field($method) }}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Name (TH)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name-th" name="name_th" placeholder="Name TH" value="{{ $station->station_name_th or old('name_th') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Name (EN)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name-en" name="name_en" placeholder="Name EN" value="{{ $station->station_name_en or old('name_en') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Discript</label>
                    <div class="col-sm-10">
                        <textarea name="descript" id="descript" rows="5" class="form-control">{{ $station->station_description or old('descript') }}</textarea>
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