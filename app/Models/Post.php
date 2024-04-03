<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id'
    ];


    //Get the user that created the post
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    //Get commentaries of the post
    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }

    //Get likes of the post
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    //Check if the authenticated user gived like in a post
    public function checkLike(User $user)
    {   
        return $this->likes->contains('user_id',$user->id);
    }


}
