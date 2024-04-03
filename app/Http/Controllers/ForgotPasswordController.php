<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

    public function index()
    {
        //Render forgot password view
        return view('auth.forgot');

    }

    //Create a password reset request and send an email
    public function store(Request $request)
    {

        //Validate email and check exists in table users
        $this->validate($request,[
            "email" => "required|exists:users|email",
        ]);


        //Generate token
        $token = Str::random(64);

        //Calculate date expiration token
        $expiration = now()->addHour();

        //Delete if exists the previous token if the process not finish
        DB::table('password_reset_tokens')->where('email',$request->email)->delete();

        //Create the password reset request
         DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
            'expires_at' => $expiration
        ]);


        //get username to set info for sending email
        $username = User::where('email',$request->email)->pluck('username')->toArray();

        $username = array_shift($username);

        //Send email
        Mail::to($request->email)->send(new ForgotPassword($username,$token));

        //Redirect user
        return redirect()->route('login')->with('messagePassword', 'We have sent you an email with instructions to recover your password');
    }
}
