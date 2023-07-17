<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function list()
    {
        $categories = Category::get();
        return view('category.list', ['categories' => $categories]);
    }

    function create(){
        $books = Book::get();
        return view('category.create',['books' => $books]);
    }

    function save(Request $request){
        $validator = \Validator::make($request->all(),[
            'name' => ['bail','required','max:100','min:3']
        ]);

        if($validator->fails()) {
            return redirect('category/create')->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('category/list');
    }
}
