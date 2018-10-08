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
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Username" value="{{ $user->name or old('name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email or old('email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>              
                <div class="form-group">
                    <label for="password-confirm" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password">
                    </div>
                </div>      
                <div class="form-group">
                    <label for="password-confirm" class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" name="role" id="role" class="form-control">
                            @php
                                $role = [ 3 =>'user', 2 => 'admin', 1 => 'super admin'];
                            @endphp

                            @foreach ($role as $key => $value)
                                <option value="{{$key}}" {{old('role') == $key || ( isset($user) && $user->role== $key) ? 'selected' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
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