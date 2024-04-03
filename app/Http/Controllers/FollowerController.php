<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowerController extends Controller
{
    
    public function __invoke(User $user)
    {
        //Get followers of the current user displayed in the DOM
        $followers = $user->createDataFollower($user->followers,true);

        $title = ($user->id === auth()->user()->id) ? 'Your followers' : 'Followers of ' . $user->username;
        
        //Render view
        return view('profile.show-follow',[
            'user' => $user,
            'followers' => $followers,
            'title' => $title,
            'type' => true
        ]);
        
    }

}
