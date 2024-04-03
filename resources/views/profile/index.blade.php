@extends('layouts.app')


@section('title')
    Edit profile: {{ auth()->user()->username }}
@endsection



@section('content')
    <div class="md:flex md:justify-center p-3 md:p-0 mb-28">
        <div class="md:w-1/2 bg-white dark:bg-neutral-700 shadow p-6">
            <form class="mt-10 md:mt-0" enctype="multipart/form-data" action="{{ route('profile.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" type="text" id="username" name="username" placeholder="Your username" value="{{ old('username') }}">

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="profile_image" class="mb-2 block uppercase text-gray-500 font-bold">Profile photo</label>
                    <input class="border dark:bg-neutral-900 dark:text-gray-500 p-3 w-full rounded-lg" type="file" id="profile_image" name="profile_image" accept=".jpg, .jpeg, .png">
                </div>

                <input type="submit" value="Save changes" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>


@endsection






