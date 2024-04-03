<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>InstagramClone</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('img/fav.png') }}">
        @stack('styles')
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-gray-100 dark:bg-neutral-900">
        <header class="p-5 border-b dark:border-neutral-700 bg-white dark:bg-neutral-700 shadow">
            <div class="container mx-auto md:flex justify-between items-end">
                
                <a class="text-3xl font-black text-center block mb-6 md:mb-0 dark:text-white" href="{{ route('home') }}"> InstagramClone </a>
                
                @auth
                    <form action="{{ route('search') }}" class="flex gap-2 items-center mb-4 md:m-0" method="GET">
                        <input class="outline-none bg-transparent text-gray-500 dark:text-gray-300 border border-gray-500 p-1 h-9 
                         rounded-md" type="text" name="s" placeholder="Search users...">
                        <button class="outline-none flex justify-center items-center border border-gray-500 rounded-md p-1 cursor-pointer dark:text-gray-500 w-9 h-9">
                            <img src="{{ asset('img/search.svg') }}" alt="search">
                        </button>
                    </form>
                @endauth    

                <div class="flex flex-col items-center gap-3 md:gap-0 md:items-end">
                    <img id="dark-mode-button" class="w-14 md:w-8 cursor-pointer" src="{{ asset('img/theme-mode.svg')}}" alt="Change theme">
                    @if(!isset($loginUrl))
                        <div class="mobile-menu w-14 cursor-pointer md:hidden">
                            <img src="{{asset('img/barrs.svg')}}" alt="Menu">
                        </div>
                    @endif
                    @auth
                        <nav class="nav hidden md:flex flex-col gap-2 items-center md:flex-row md:items-center">
                            <a class="flex justify-center items-center gap-2 border dark:border-gray-500 px-2 text-gray-500 rounded text-sn uppercase font-bold cursor-pointer" href="{{ route('posts.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                New Post
                            </a>
                            <a class="font-bold text-gray-500 text-sm inline-block text-center" href="{{ route('posts.index',auth()->user()->username) }}">Hi, <span class="font-normal">{{ auth()->user()->username }} </span></a>
                            <form action=" {{ route('logout') }} " method="POST">
                                @csrf
                                <button type="submit" class="font-bold uppercase text-gray-500 text-sm text-center" href= {{ route('logout') }} >Sign out</button>
                            </form>
                        </nav>
                    @endauth

                    @guest
                        @if (!isset($loginUrl))
                            <nav class="nav hidden md:flex flex-col gap-2 items-center md:flex-row md:items-center">
                                <a class="font-bold uppercase text-gray-500 text-sm" href="{{ route('login') }}">Login</a>
                                <a class="font-bold uppercase text-gray-500 text-sm" href= {{ route('register') }} >Sign up</a>
                            </nav>
                        @endif
                    @endguest
                </div>
                
            </div>            
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10 dark:text-white">@yield('title')</h2>
            @yield('content')
        </main>

        <footer class="text-center p-5 text-gray-500 font-bold uppercase">
            instagramclone - All rights reserved {{ now()->year }}
        </footer>

        @livewireScripts
    </body>
</html>


