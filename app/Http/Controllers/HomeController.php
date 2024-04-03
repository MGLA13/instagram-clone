<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{

    public function __invoke()
    {

        //Get users that the authenticated user follow
        $ids = auth()->user()->followings->pluck('id')->toArray();

        //Get posts of the users 
        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(20);

        //Render home view
        return view("home",[
            'posts' => $posts,
            'showInfo' => true
        ]);

    }

}
