@extends('layouts.app')

@section('title')
    Reset password
@endsection


@section('content')

     <div class="md:flex md:justify-center p-3 md:p-0 mb-56">

        @if (isset($tokenExpired))

           <div class="mb-36 mt-10"> 
            <h3 class="font-normal text-xl text-black dark:text-white">
                Password reset token has been expired, please back to
                <a class="font-bold underline cursor-pointer" href="{{ route('login') }}">login page</a>
                 and request forgotten password change
            </h3>
           </div> 
        
        @else
            <div class="md:w-1/2 bg-white dark:bg-neutral-700 shadow p-6">

                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
                @endif

                <form class="mt-10 md:mt-0" action="{{ route('reset',$token) }}" method="POST">
                    @csrf
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

                    <input type="submit" value="change my password" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                </form>
            </div>
        @endif

    </div>
    
@endsection