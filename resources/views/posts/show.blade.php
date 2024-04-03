@extends('layouts.app')


@section('title')
    {{$post->title}}
@endsection


@section('content')
    <div class="container mx-auto md:flex mb-28">

        <div class="md:w-1/2 p-3">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="post image {{$post->title}}">
        
            <div>
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>

            <div>

                <p class="font-bold dark:text-white">{{$post->user->username}}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-8 pl-3 break-words dark:text-white">
                    {{ $post->description }}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy',$post) }}" method="POST">
                        @method('DELETE')
                        @csrf    
                        <input type="submit" value="Delete post" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
                    </form>
                @endif    
            @endauth

        </div>


        <div class="md:w-1/2 p-5">

            <div class="shadow bg-white dark:bg-neutral-700 rounded-lg p-5 mb-5">
                
                @auth
                    <p class="text-xl font-bold text-center mb-4 dark:text-white">Add a new commentary</p>

                    @if (session('message'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('message') }}
                        </div>    
                    @endif

                    <form action="{{ route('commentaries.store',['user' => $user->username,'post' => $post->id]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="commentary" class="mb-2 block uppercase text-gray-500 font-bold">Commentary</label>
                            <textarea class="outline-none dark:bg-neutral-900 dark:text-white whitespace-normal border w-full h-64 p-3 rounded-lg @error('commentary') border-red-500 @enderror" id="commentary" name="commentary">
                                {{ old('commentary') }}
                            </textarea>    

                            @error('commentary')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Add commentary" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                    </form>
                @endauth
                
                
                <div class="mt-10 bg-white dark:bg-neutral-900 rounded-lg shadow mb-5 max-h-96 overflow-y-auto">
                    @if ($post->commentaries->count())
                        @foreach ($post->commentaries as $commentary)
                            
                            <div class="p-5 border-gray-300 border-b rounded-lg">
                                <a class="text-xl font-bold dark:text-white" href="{{ route('posts.index',$commentary->user->username) }}">
                                    {{$commentary->user->username}}
                                </a>
                                <p class="text-base dark:text-white">{{ $commentary->commentary }}</p>
                                <p class="text-sm text-gray-500">{{ $commentary->created_at->diffForHumans() }}</p> 
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center dark:text-white">Without commentaries</p>
                    @endif

                
                </div>
            </div>
        </div>
    </div>

@endsection