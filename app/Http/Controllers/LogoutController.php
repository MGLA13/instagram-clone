<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{

    public function store()
    {
        //Log out current session of user
        auth()->logout();

        //Redirect user to login page
        return redirect()->route('login');
    }
}
