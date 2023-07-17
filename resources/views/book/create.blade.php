@extends("layouts.generalLayout")

@section("title")
    <title>Books | Create</title>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
@endpush
@section("content")
    <form method="post" action="{{url('books/store')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Book Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Book Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Book Image</label>
            <input type="file" class="form-control" id="image" name="image" value="{{old('image')}}">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label d-block">Book Category </label>
            @foreach($categories as $category)
                <label for="{{$category->id}}" class="form-check-label form-label">{{$category->name}}</label>
                <input type="checkbox" id="{{$category->id}}" class="form-check-inline" name="categories[]" value="{{$category->id}}">
            @endforeach
{{--            <select type="file" class="form-control" id="category[]" name="category" multiple>--}}
{{--                <option value="">----</option>--}}
{{--                @foreach($categories as $category)--}}
{{--                    <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
@endsection

@push('js')
    $('select[multiple]').multiselect()
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
@endpush
