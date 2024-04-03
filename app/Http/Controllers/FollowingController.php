<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowingController extends Controller
{

    public function __invoke(User $user)
    {   
        //Get users that the current user (displayed in the DOM) follow
        $followers = $user->createDataFollower($user->followings,false);

        $title = ($user->id === auth()->user()->id) ? 'You follow' : $user->username . ' follow ';

        //Render view            
        return view('profile.show-follow',[
            'user' => $user,
            'followers' => $followers,
            'title' => $title,
            'type' => false
        ]);
        
    }

}
