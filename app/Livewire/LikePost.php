<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    //Define attributes
    public $post;
    public $isLiked;
    public $likesCount;

    public function mount()
    {
        //Check if the authenticated user gived like to the post
        $this->isLiked = $this->post->checkLike(auth()->user());

        //Get total likes of the post
        $this->likesCount = $this->post->likes()->count();

    }

    //This method is called when the user click in the like button
    public function like()
    {
        if($this->post->checkLike(auth()->user())){
            //Delete like
            $this->post->likes()->where('post_id',$this->post->id)->delete();    
            $this->isLiked = false;
        }else{
            //Create like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
        }

        $this->likesCount = $this->post->likes()->count();

    }

    //Render view of component
    public function render()
    {
        return view('livewire.like-post');
    }
}
