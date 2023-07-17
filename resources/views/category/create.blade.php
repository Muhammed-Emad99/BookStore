@extends('layouts.generalLayout')
@section('title')
    <title>Category | Create</title>
@endsection
@section('content')
    <h3>Create Category</h3>
    <form method="post" action="{{url('category/save')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

{{--        <div class="mb-3">--}}
{{--            <label for="image" class="form-label">Book Categoty</label>--}}
{{--            <select type="file" class="form-control" id="category" name="category" value="{{old('category')}}" >--}}
{{--                <option value="">----</option>--}}
{{--                @foreach($books as $book)--}}
{{--                    <option value="{{$book->id}}">{{$book->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

        <button type="submit" class="btn btn-primary">Create</button>
    </form>


@endsection
