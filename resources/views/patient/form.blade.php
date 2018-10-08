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
                    <label for="inputEmail3" class="col-sm-2 control-label">Firstname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" value="{{ $patient->firstname or old('firstname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Lastname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" value="{{ $patient->lastname or old('lastname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">HN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="hn" name="hn" placeholder="HN" value="{{ $patient->hn or old('hn') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Dob</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Dob" value="{{ $patient->dob or old('dob') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                        <select name="gender" class="form-control" id="gender">
                            @php
                                $genders = ['male', 'femele'];
                            @endphp

                            @foreach ($genders as $key => $gender)
                                <option value="{{$key}}" >{{$gender}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Card Id</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cardid" name="card_id" placeholder="cardid" value="{{ $patient->card_id or old('card_id') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $patient->user->email or old('email') }}">
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