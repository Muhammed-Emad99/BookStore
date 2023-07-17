@extends("layouts.generalLayout")
@section("title")
    <title>Books</title>
@endsection
@section('content')
    @if (count($categories) > 0)
    <table class="table">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Books in this category</th>
        @if(Auth::user()->is_admin == 1)
            <th scope="col">Handle</th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($categories as $category)
            <tr class="text-center" style="line-height: 60px;">
                <td>{{$category->id}}</td>
                <td><a href="{{url('books/show',$category->id)}}" class="text-decoration-none">{{$category->name}}</a></td>
                <td>
                    @foreach($category->books as $book)
                        {{$book->name}} ,
                    @endforeach
                </td>
            @if(Auth::user()->is_admin == 1)
                <td>
                    <a href="{{url('books/edit',$category->id)}}" class="btn btn-sm btn-info">Edit</a>
                    <a href="{{url('books/delete',$category->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="d-flex justify-content-center">You don't have any category yet. </div>
    @endif

@endsection

