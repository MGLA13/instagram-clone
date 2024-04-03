@extends('layouts.app')


@section('title')
    Search Results for: {{ $searchParameterValue }}
@endsection



@section('content')
     <div class="flex justify-center mb-56 mt-16 p-3">

        @if ($users->count() > 0)
            <div class="flex flex-col">
                @foreach ($users as $user)
                    <div class="flex flex-col md:flex-row md:justify-between items-center gap-4 md:gap-16 mb-10 last-of-type:mb-0">
                        <div class="flex gap-3 items-center">
                            <div class="w-20">
                                <img class="text-sm dark:text-white {{ $user->profile_image ? 'rounded-full' : '' }}" src="{{ $user->profile_image ? asset('profiles') . '/' . $user->profile_image : asset('img/user.svg') }}" alt="profile image">
                            </div>
                            <div class="flex-1">
                                <p class="font-normal dark:text-white" text-sm"> Name: <span class="text-gray-500"> {{ $user->name }} </span></p>
                                <p class="font-normal dark:text-white" text-sm"> Username: <span class="text-gray-500"> {{ $user->username }} </span></p>
                            </div>
                        </div>
                        <a href="{{ route('posts.index',$user->username) }}" class="bg-blue-600 text-white text-center w-3/4 md:w-auto uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">{{$user->id === auth()->user()->id ? 'you' : 'view profile'}}</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mb-36 mt-10"> 
                <h3 class="font-normal text-xl text-black dark:text-white">
                    Not users found       
                </h3>
            </div>  
        @endif
    </div>

@endsection