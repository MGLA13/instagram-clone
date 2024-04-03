<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    //Render login view
    public function index()
    {
        return view('auth.login',[
            'loginUrl' => true
        ]);
    }


    public function store(Request $request)
    {

        //Validate user data
        $this->validate($request,[

            "email" => "required|email",
            "password" => "required"

        ]);

        //Try authenticate user
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            
            //return to previous if the authenticate failed 
            return back()->with('userNotFound','user not found');
        }

        //Redirect user
        return redirect()->route('posts.index',auth()->user()->username);
       
    }

}
