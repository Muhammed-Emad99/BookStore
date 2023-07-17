@extends("layouts.generalLayout")
@section("title")
    <title>Book Details</title>
@endsection
@section('content')
    @foreach($book as $data)
        <h4>{{$data->name}}</h4>
        <h6 class="text-muted">{{$data->description}}</h6>
        <img src="{{asset("images/".$data->img)}}" class="img" height="200">
        <a href="{{url('books/list')}}" class="btn"> <---- Go back</a>
    @endforeach
@endsection

