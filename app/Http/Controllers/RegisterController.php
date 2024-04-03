<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    
    //Render register view
    public function index()
    {
        return view('auth.register',[
            'loginUrl' => true
        ]);
    }

    public function store(Request $request)
    {
        
        //Generated a URL friendly "slug" from username
        $request->request->add(["username" => Str::slug($request->username)]);

        //Validate data
        $this->validate($request,[
            "name" => "required|max:30",
            "username" => "required|unique:users|min:3|max:20",
            "email" => "required|unique:users|email|max:60",
            "password" => "required|confirmed|min:6"

        ]);

        //Create the new user  
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Authenticate user
        auth()->attempt($request->only('email','password'));

        //Redirect to profile page of user
        return redirect()->route('posts.index',auth()->user()->username);
    }
    
}
