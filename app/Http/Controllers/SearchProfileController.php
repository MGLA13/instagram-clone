<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchProfileController extends Controller
{
    public function __invoke(request $request)
    {   

        //Validate request
        $this->validate($request,[
            "s" => 'string',
        ]);

        //Sanitize 's' parameter
        $searchValue =  htmlspecialchars($request->s);

        //Get results (if exists) by 's' parameter
        $users = User::where('name','like','%' . $searchValue . '%')
                        ->orWhere('username','like','%' . $searchValue . '%')->get();

        //Return profiles list view 
        return view('profile.profiles',[
            'users' => $users,
            'searchParameterValue' => $searchValue  
        ]);
    }
}
