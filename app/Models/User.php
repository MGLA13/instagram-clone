<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    //Get user posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Get user likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Get followers of the user
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id')->withTimestamps();
    }

    //Get followings of the user
    public function followings()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','user_id')->withTimestamps();
    }

    //Check if the current user (showing in the DOM) is follow by the autheticated user
    public function checkFollow(User $user)
    {
        return $this->followers->contains($user->id);
    }


    //Create an array with the information about the followers of a user 
    public function createDataFollower($followers,$followType){

        $followersInfo = [];
        
        //Iterate followers
        foreach ($followers as $follower){
    
            if($followType){
                //Get the date from which the follower ($follower->id) follows the user ($this->id) 
                $date = $this->getDateFollower($this->id,$follower->id);
            }else{
                //Get the date from which the user ($this->id) follows other user ($follower->id) 
                $date = $this->getDateFollower($follower->id,$this->id);
            }
            
            //Create array with the info
            array_push($followersInfo,[
                'id' => $follower->id,
                'name' => $follower->name,
                'username' => $follower->username,
                'image' => $follower->profile_image,
                'followerFrom' => $date->created_at->toDateString()
            ]);

        }

        //sort array
        usort($followersInfo, function($a, $b) {
            return strtotime($b['followerFrom']) - strtotime($a['followerFrom']);
        });
        
        //Return final array modified
        return $followersInfo;
    }

    //Get follow date
    public function getDateFollower($user,$follower)
    {
        return Follower::select('created_at')
                          ->where('user_id', $user)
                          ->where('follower_id', $follower)
                          ->first();
    }

}
