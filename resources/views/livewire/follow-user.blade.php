<div class="w-full md:w-2/6">
     @foreach ($this->followers as $follower)
        <div class="flex justify-between items-center mb-6 last-of-type:mb-0">
            <a href="{{ route('posts.index',$follower['username']) }}" class="flex gap-3 cursor-pointer items-center">
                <div class="w-20">
                    <img class="text-sm dark:text-white {{ $follower['image'] ? 'rounded-full' : '' }}" src="{{ $follower["image"] ? asset('profiles') . '/' . $follower["image"] : asset('img/user.svg') }}" alt="profile image">
                </div>
                <div class="flex-1">
                    <p class="font-normal dark:text-white" text-sm"> Name: <span class="text-gray-500"> {{ $follower["name"] }} </span></p>
                    <p class="font-normal dark:text-white" text-sm"> Username: <span class="text-gray-500"> {{ $follower["username"] }} </span></p>
                    <p class="font-normal dark:text-white" text-sm"> Follower from: <span class="text-gray-500">{{ date('m/d/Y', strtotime($follower["followerFrom"])) }} </span></p>
                </div>
            </a>

            {{$this->checkFollow($follower['id'])}}

            @if ($this->userAuth)
                <p class="bg-blue-400 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold">you</p>
            @else
                <button wire:click="followUser({{$follower['id']}},{{$this->follow}})" class="{{$this->follow ? 'bg-red-600' : 'bg-blue-600'}} text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                    {{ $this->follow ? 'unfollow' : 'follow'}}
                </button>    
            @endif
        </div>
        {{$this->resetAttributesValues()}}
    @endforeach
</div>
