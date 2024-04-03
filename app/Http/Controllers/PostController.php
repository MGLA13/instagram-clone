<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function index(User $user)
    {
        //Get posts of the authenticated user    
        $posts = Post::where('user_id',$user->id)->latest()->paginate(20);        

        //Render user profile view
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
        ]);

    }


    //Render view to create a new post
    public function create()
    {
       return view('posts.create');
    }


    //Create a new post
    public function store(Request $request)
    {
        
        //Validate data
        $this->validate($request,[
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        //Create the posts using the posts() relationship
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        //Redirect to profile page of the user
        return redirect()->route('posts.index',auth()->user()->username);

    }

    //Render view to show a post
    public function show(User $user,Post $post)
    {
        return view('posts.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    //Delete a post
    public function destroy(Post $post)
    {
       
        //Check $post with a policy
        $this->authorize('delete',$post); 
        $post->delete();

        //Delete image

        //Get url image
        $imagen_path = public_path('uploads/' . $post->image);
        
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        //Redirect to profile page of the user
        return redirect()->route('posts.index',auth()->user()->username);

    }

}
