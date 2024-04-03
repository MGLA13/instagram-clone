<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ProfileController extends Controller
{

    //Render edit profile view
    public function index(User $user)
    {
        return view('profile.index');
    }


    public function store(Request $request)
    {
        //Generated a URL friendly "slug" from username
        $request->request->add(["username" => Str::slug($request->username)]);

        //Validate username
        $this->validate($request,[
            'username' => ['required',Rule::unique('users', 'username')->ignore(auth()->user()),'min:3','max:20','not_in:twitter,edit-profile']
        ]);

        //To add or change profile image of the user
        if($request->profile_image){
        
            $image = $request->file('profile_image');

            $imageName = Str::uuid() . "." . $image->extension();

            $manager = new ImageManager(new Driver());
            $serverImage = $manager::imagick()->read($image);
            $serverImage->resize(1000,1000);
    
            $imagenPath = public_path('profiles') . "/" . $imageName;
    
            $serverImage->save($imagenPath);
        }

        //Find user
        $usuario = User::find(auth()->user()->id);

        //Update data of user
        $usuario->username = $request->username;
        $usuario->profile_image = $imageName ?? auth()->user()->profile_image ?? '';
        //Save info
        $usuario->save();

        //Redirect to profile page of the user
        return redirect()->route('posts.index',$usuario->username);
    }
}
