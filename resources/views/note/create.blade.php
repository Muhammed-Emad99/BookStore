@extends('layouts.generalLayout')
@section('title')
    <title>Note | Create</title>
@endsection
@section('content')
    <h3>Create Note</h3>
    <form method="post" action="{{url('notes/save')}}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Note Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cont" class="form-label">Note Content</label>
            <input type="text" class="form-control" id="cont" name="cont" value="{{old('cont')}}">
            @error('cont')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            {{--            <label for="content" class="form-label">Content</label>--}}
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    @if(count(Auth::user()->notes) > 0)
    <table class="table">
        <thead>
        <tr class="text-center">
            <th scope="col">Name</th>
            <th scope="col">Content</th>
            <th scope="col">Name of User</th>
        @if(Auth::user()->is_admin == 1)
                <th scope="col">Handle</th>
            @endif
        </tr>
        </thead>
        <tbody>

            @foreach(\Auth::user()->notes as $note)
                <tr class="text-center" style="line-height: 60px;">
                    <td><a href="{{url('books/show',$note->name.$note->content)}}"
                           class="text-decoration-none">{{$note->name}}</a></td>
                    <td>{{$note->content}}</td>
                    <td>{{$note->User->name}}</td>
                @if(Auth::user()->is_admin == 1)
                        <td>
                            <a href="{{url('books/edit',$note->name.$note->content)}}"
                               class="btn btn-sm btn-info">Edit</a>
                            <a href="{{url('books/delete',$note->name.$note->content)}}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    @endif
                </tr>
            @endforeach

        </tbody>
    </table>
    @else
        <div class="d-flex justify-content-center mt-5">
            You don't have notes now.
        </div>
    @endif

@endsection
