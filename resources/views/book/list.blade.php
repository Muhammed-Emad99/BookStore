@extends("layouts.generalLayout")
@section("title")
    <title>Books</title>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Category Name</th>
        @if(Auth::user()->is_admin == 1)
                <th scope="col">Handle</th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($books as $book)
            <tr class="text-center" style="line-height: 60px;">
                <td>{{$book->id}}</td>
                <td><a href="{{url('books/show',$book->id)}}" class="text-decoration-none">{{$book->name}}</a></td>
                <td>{{$book->description}}</td>
                <td><img src="{{asset("images/".$book->img)}}" height="60" class="img rounded"></td>
                <td>
                    @foreach($book->categories as $category)
                        {{$category->name}} ,
                    @endforeach
                </td>
                @if(Auth::user()->is_admin == 1)
                    <td>
                        <a href="{{url('books/edit',$book->id)}}" class="btn btn-sm btn-info">Edit</a>
                        <a href="{{url('books/delete',$book->id)}}" class="btn btn-sm btn-danger">Delete</a>
                    </td>

                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

