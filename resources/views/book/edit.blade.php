@extends('layouts.generalLayout')
@section('title')
    <title>Edit Book</title>
@endsection
@section('content')
    <form method="post" action="{{url('books/update',$book->id)}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Book Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$book->name}}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Book Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{$book->description}}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Book Image</label>
            <img src="{{asset("images/".$book->img)}}" height="200">
            {{$book->img}}
            <input type="file" class="form-control" id="image" name="image" value="">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Edit Book</button>
    </form>

@endsection

