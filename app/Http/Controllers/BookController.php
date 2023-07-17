<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\Book;


//
class BookController extends Controller
{
    //
    function List()
    {
        $Books = Book::get();
        return view('book.list', ['books' => $Books]);
    }

    function show($id)
    {
        $book = Book::where('id', '=', $id)->get();
//        dd($book);
        return view('book.book', ['book' => $book, "author" => "master"]);
    }

    function search($char)
    {
        $Books = Book::where('name', 'like', $char . '%')
            ->orwhere('name', 'like', '%' . $char . '%')
            ->orwhere('name', 'like', '%' . $char)
            ->get();
        return view('book.list', ['books' => $Books]);
    }

    function create()
    {
        $categories = Category::get();
        return view('book.create',['categories' => $categories]);
    }

    function store(Request $request)
    {
        $validatedData = \Validator::make($request->all(), [
            'name' => ['bail', 'required', 'max:100', 'min:3'],
            'description' => ['bail', 'required', 'max:255', 'min:20'],
            'image' => ['bail', 'required', 'image', 'mimes:,jpg,png', 'max:2048']
        ]);
        if ($validatedData->fails()) {
            return redirect('books/create')->withErrors($validatedData)->withInput();
        }

        // upload image and move to folder images in public folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationFolder = public_path('/images');
            $name = $request->name."_".\Str::random(5).".".$image->getClientOriginalExtension();
            $image->move($destinationFolder, $name);
        }

        $book = new Book();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->img = $name;
        $book->save();
        $book->categories()->attach($request->categories);
        return redirect('books/list');
    }

    function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit', array('book' =>$book));
    }

    function update($id,Request $request){

        $book = Book::find($id);

        $validatedData = \Validator::make($request->all(), [
            'name' => ['bail', 'required', 'max:100', 'min:3'],
            'description' => ['bail', 'required', 'max:255', 'min:20'],
            'image' => ['bail', 'image', 'mimes:,jpg,png', 'max:2048']
        ]);
        if ($validatedData->fails()) {
            return redirect("books/edit/$request->id")->withErrors($validatedData)->withInput();
        }

        $book->name = $request->name;
        $book->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destination_path = public_path('/images');
            $name = $request->name . "_" . \Str::random(15) . "." . $image->getClientOriginalExtension();
            $image->move($destination_path, $name);
            if (isset($book->img)){
                unlink(asset("images/$book->img"));
                $book->img = $name;
            }
        }
        $book->save();
        return redirect('books/list');
    }

    function delete($id){
        $book = Book::find($id);
        if (isset($book->img)){
            unlink("images/$book->img");
        }
        $book->delete();
        return redirect('books/list');
    }
}
