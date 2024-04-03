<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{

    //The authenticated user ($request->user()) begins follow other user (User $user)
    public function store(Request $request, User $user)
    {
        $user->followers()->attach($request->user()->id);
   
        //Return to previous page
        return back();
    }

    //The authenticated user ($request->user()) unfollow other user (User $user)
    public function destroy(Request $request, User $user)
    {
        $user->followers()->detach($request->user()->id);

        //Return to previous page        
        return back();
    }

}
