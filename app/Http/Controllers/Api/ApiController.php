<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    function list()
    {
        $books = Book::with('categories')->select('id', 'name')->get();
        return response()->json(array('books' => $books));
    }

    function categories()
    {
        $categories = Category::with('books')->get();
        return response()->json(array('categories' => $categories));
    }

    function users(){
        $users = User::with('notes')->get();
        return response()->json(array('users' => $users));
    }
    function register(Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
                'name' => 'bail|required|max:100|min:3',
                'email' => ['bail', 'required', 'email', 'max:100', 'unique:users'],
                'is_admin' => 'bail|required|boolean',
                'password' => 'bail|required|max:150',
            ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin;
        //generate the access token
        $user->access_token = \Str::random(100);
        $user->save();
        return response()->json(['user' => $user, 'password' => $user->password]);
    }

    function login(Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
                'email' => ['bail', 'required', 'email',],
                'password' => 'bail|required',
            ]);
        if ($validator->fails()) {
            $error = $validator->messages();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (!isset(Auth::user()->access_token)) {
                return 'You need to register';
            }
            return response()->json(['user' => Auth::user()]);
        } else {
            return 'this email does not exist';
        }
    }
}


