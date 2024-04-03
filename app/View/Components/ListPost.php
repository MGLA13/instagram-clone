<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListPost extends Component
{
    //Define attributes
    public $posts;
    public $showInfo;

    public function __construct($posts, $showInfo = false)
    {
        $this->posts = $posts;
        $this->showInfo = $showInfo;
    }

    /**
     * Get the view / contents that represent the component.
     */

    //Render view of component
    public function render(): View|Closure|string
    {
        return view('components.list-post');
    }
}
