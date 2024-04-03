<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    
    //Render reset password view
    public function index($token)
    {   

        //Get valid token
        $tokenData = DB::table('password_reset_tokens')->where('token',$token)->first();

        //redirect if the token does not exist
        if(!$tokenData) return redirect()->route('login'); 


        //Get token expiration date 
        $expirationDateTime = $tokenData->expires_at;

        //Compare dates to check if token has been expired
        if(now()->greaterThan($expirationDateTime)){
            DB::table('password_reset_tokens')->where('token',$token)->delete();
            $viewData = ['tokenExpired' => true];
        }else{    
            $viewData = ['token' => $token];
        }
        return view('auth.reset',$viewData);
    }


    public function store(Request $request,$token)
    {

        //Validate email and check exists in table users and validate same passwords
        $this->validate($request,[
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        //Get valid token
        $tokenData = DB::table('password_reset_tokens')->where('token',$token)->first();

        if(!$tokenData) return back()->with('message','Something went wrong, try again please');


        //Get the register with the password reset request
        $validUpdatePassword = DB::table('password_reset_tokens')
                                    ->where([
                                        'email' => $request->email,
                                        'token' => $token
                                    ])
                                    ->first();

        if(!$validUpdatePassword) return back()->with('message','Password reset request was not found, please verify your details and try again');
        
        //Find user
        $user = User::where('email',$request->email)->first();
        
        //Update password and save or update
        $user->password = $request->password;
        $user->save();

        //Delete password reset request 
        DB::table('password_reset_tokens')->where('email',$request->email)->delete();
        
        //Redirect to login
        return redirect()->route('login')->with('messagePassword', 'Password has been changed successfully');;
    }
}
