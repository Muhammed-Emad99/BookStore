@extends('layouts.generalLayout')
@section('title')
    <title>Login</title>
@endsection
@section('content')
    <h3>Login</h3>
    <form method="post" action="{{url('user/login')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
