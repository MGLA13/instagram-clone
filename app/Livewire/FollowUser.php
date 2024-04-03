<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowUser extends Component
{

    //Define attributes
    public $followers;
    public $currentUserInfo;
    public $userAuth = false;
    public $userProfile;
    public $followType;
    public $follow = true;
    public $routeFollowName = 'users.unfollow';


    //This method is called when the user click in the follow user button of the showed users
    public function followUser($id,$currentFollow = false)
    {  

       //Get current user showed in the view 
       $this->currentUserInfo = User::where('id',$id)->first();

       if($currentFollow){
            //When the authenticated user unfollow the user select
            $this->currentUserInfo->followers()->detach(auth()->user()->id);
       }else{
            //When the authenticated user begins follow the user select
            $this->currentUserInfo->followers()->attach(auth()->user()->id);
       }

       if($this->followType){
            //Get followers of the authenticated user
            $this->followers = $this->userProfile->createDataFollower($this->userProfile->followers,$this->followType);
       }else{
            //Get users followed by the authenticated user
            if($this->userProfile->followings->count()<1) return redirect()->route('posts.index',auth()->user()->username);
            $this->followers = $this->userProfile->createDataFollower($this->userProfile->followings,$this->followType);
       }

       //Reset attributes
       $this->resetAttributesValues();

    }

    //Check if the authenticated user follow the current user showed in the view
    public function checkFollow($followerId)
    {   
        //Get current user showed in the view
        $this->currentUserInfo = User::where('id',$followerId)->first();

        //Current user showed is the same that authenticated user 
        if ($this->currentUserInfo->id === auth()->user()->id):
            $this->userAuth = true;
        //Check follow of the authenticated user  
        elseif (!$this->currentUserInfo->checkFollow(auth()->user())):
            $this->follow = false;
            $this->routeFollowName = 'users.follow';
        endif;

    }

    //To reset values of some attributes
    public function resetAttributesValues()
    {
        $this->userAuth = false;
        $this->follow = true;
        $this->routeFollowName = 'users.unfollow';
    }


    //Render view of component
    public function render()
    {
        return view('livewire.follow-user');
    }
}
