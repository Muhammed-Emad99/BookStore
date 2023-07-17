<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(){
        return view('user.register');
    }

    function save(Request $request){

        $validator =  \Validator::make($request->all(),
            [
                'name'=> 'bail|required|max:100|min:3',
                'email'=> 'bail|required|email|max:100',
                'password'=> 'bail|required|max:150',
            ]);

        if ($validator->fails()) {
            return redirect('user/register')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('user/loginForm');
    }

    function loginForm(){
        return view('user.login');
    }

    function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('books/list');
        }
        else{
            return redirect('user/login');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('user/loginForm');
    }
}
