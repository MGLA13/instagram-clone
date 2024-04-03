<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Commentary;
use Illuminate\Http\Request;

class CommentaryController extends Controller
{

    //To create a new comment of a post
    public function store(Request $request,User $user,Post $post)
    {

        //validate date
        $this->validate($request,[
            'commentary' => 'required|max:255'
        ]);


        //Save comment
        Commentary::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'commentary' => $request->commentary
        ]);

        //Return to previous page with a message
        return back()->with('message','Commentary has been added successfully');

    }


}
