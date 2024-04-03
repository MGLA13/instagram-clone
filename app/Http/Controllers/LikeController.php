<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    //Add a like 
    public function store(Request $request,Post $post)
    {
        
        //Create a new like of a post 
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        //Return to previous page
        return back();

    }


    //Delete a like of a post
    public function destroy(Request $request, Post $post)
    {

        $request->user()->likes()->where('post_id',$post->id)->delete();
        
        return back();
    
    }
    
}
