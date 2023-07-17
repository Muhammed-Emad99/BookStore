@extends('layouts.generalLayout')
@section('title')
    <title>Register</title>
@endsection
@section('content')
    <h3>Register</h3>
    <form method="post" action="{{url('user/save')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

{{--        <div class="mb-3">--}}
{{--            <label for="name" class="form-label">Admin</label>--}}

{{--            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">--}}
{{--            @error('name')--}}
{{--            <div class="text-danger">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
