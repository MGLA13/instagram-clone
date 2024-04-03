@extends('layouts.app')

@section('title')
    Sign Up
@endsection


@section('content')

    <div class="md:flex md:justify-center md:gap-10 md:items-center mb-28 p-3">

        <div class="md:w-6/12 md:p-5">
            <img src="{{ asset('img/register.webp') }}" alt="Image user registrer">
        </div>

        <div class="md:w-4/12 bg-white dark:bg-neutral-700 p-6 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Name</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" type="text" id="name" name="name" placeholder="Your name" value="{{ old('name') }}">

                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" type="text" id="username" name="username" placeholder="Your username" value="{{ old('username') }}">

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">E-mail</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" type="text" id="email" name="email" placeholder="Your E-mail" value="{{ old('email') }}">

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" type="password" id="password" name="password" placeholder="Your password">
                
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirm password</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg" type="password" id="password_confirmation" name="password_confirmation" placeholder="Your password again">
                </div>

                <input type="submit" value="Sign up" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>  

            <a class="block text-center text-blue-600 text-sm font-bold cursor-pointer mt-8" href="{{ route('login') }}">Back to login</a>

        </div>
    </div>


@endsection