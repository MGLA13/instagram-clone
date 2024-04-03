    <div class="mx-4 md:mx-0 {{$posts->count() ? 'mb-28' : 'mb-96'}}">
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show',['user' => $post->user->username,'post' => $post->id]) }}">
                            <img src="{{asset('uploads') . '/' . $post->image}}" alt="post image {{$post->titulo}}">
                        </a>
                        @if ($showInfo)
                            <div class="mb-5 mt-2">
                                <p class="font-bold text-lg dark:text-white">{{$post->title}}</p>
                                <p class="pl-1 font-light dark:text-gray-500">{{$post->user->username}}</p>
                                <p class="pl-1 text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
    
            <div class="my-10">
                {{$posts->links('pagination::tailwind')}}
            </div>
        @else
            <p class="text-gray-500 dark:text-white uppercase text-sm text-center font-bold">{{$showInfo ? 'follow someone to see their posts' : 'without posts yet'}}</p>
        @endif

    </div>


