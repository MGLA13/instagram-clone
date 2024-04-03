
@extends('layouts.app')


@section('title')
    @auth
        {{($user->id === auth()->user()->id) ? 'My profile' : 'Profile: ' . $user->username}}
    @endauth     
    @guest
        Profile: {{ $user->username }}    
    @endguest
@endsection


@section('content')
    <div class="flex justify-center mb-28">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img 
                    class="{{ $user->profile_image ? 'rounded-full' : '' }}" 
                    src="{{ $user->profile_image ? asset('profiles') . '/' . $user->profile_image : asset('img/user.svg') }}" 
                    alt="User image"
                >       
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-500 text-2xl">{{ $user->username }}</p>
                    
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('profile.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>            
                        @endif                    
                    @endauth
                </div>
            
                @if ($user->followers->count() > 0)
                    <a href="{{ route('user.followers',$user->username) }}" class="text-gray-500 hover:text-gray-600 text-sm mb-3 cursor-pointer">
                        {{ $user->followers->count() }} <span class="font-normal">@choice('follower|followers', $user->followers->count())</span>
                    </a>
                @else
                     <p class="text-gray-500 hover:text-gray-600 text-sm mb-3">
                        Not followers yet
                    </p>
                @endif
                @if ( $user->followings->count() > 0)
                    <a href="{{ route('user.following',$user->username) }}" class="text-gray-500 hover:text-gray-600 text-sm mb-3 cursor-pointer">
                        {{ $user->followings->count() }} <span class="font-normal">Following</span>
                    </a>
                @else
                    <p class="text-gray-500 hover:text-gray-600 text-sm mb-3">
                        Not following anyone yet
                    </p>
                @endif
                <p class="text-gray-500 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }} <span class="font-normal">Posts</span>
                </p>
                
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if(!$user->checkFollow(auth()->user()))
                            <form action="{{ route('users.follow',$user) }}" method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Follow">
                            </form>
                        @else
                            <form action="{{ route('users.unfollow',$user) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Unfollow">
                            </form>
                        @endif    
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10 dark:text-white">
            @auth
                {{$user->id === auth()->user()->id ? "My " : ""}}    
            @endauth
            Activity
        </h2>
     
        <x-list-post :posts="$posts" />
    </section>

@endsection


