<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class ImageController extends Controller
{

    //To upload a image of a post
    public function store(Request $request)
    {

        //Get image file
        $image = $request->file('file');

        //Create image name
        $imageName = Str::uuid() . "." . $image->extension();

        //Create a new ImageManager object
        $manager = new ImageManager(new Driver());
        //Read the image
        $serverImage = $manager::imagick()->read($image);
        //Resize image
        $serverImage->resize(1000,1000);

        //Create the url of the image
        $imagenPath = public_path('uploads') . "/" . $imageName;

        //Saveimage
        $serverImage->save($imagenPath);

        //Return JSON with the image name
        return response()->json(['image' => $imageName]);

    }


}
