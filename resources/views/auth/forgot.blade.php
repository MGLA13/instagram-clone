@extends('layouts.app')

@section('title')
    Forgot password
@endsection


@section('content')
    <div class="md:flex md:justify-center p-3 md:p-0 mb-56">
        <div class="md:w-1/2 bg-white dark:bg-neutral-700 shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('forgot') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">E-mail</label>
                    <input class="outline-none dark:bg-neutral-900 dark:text-white border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" type="email" id="email" name="email" placeholder="Your E-mail" value="{{ old('email') }}">

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <button class="bg-sky-600 hover:bg-sky-700 disabled:cursor-not-allowed disabled:opacity-50 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg button-send-email">
                    Send recovery email
                </button>
            </form>
        </div>
    </div>
    
@endsection