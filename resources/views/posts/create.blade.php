@extends('layouts.app')


@section('title')
    Create a new post
@endsection



@section('content')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
@endpush

    <div class="md:flex md-items-center mb-28 px-5">

        <div class="md:w-1/2 md:px-10">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 dark:border-white w-full h-96 rounded flex justify-center items-center dark:bg-neutral-700 dark:text-white">
                @csrf
            </form>

        </div>

        <div class="md:w-1/2 p-10 bg-white dark:bg-neutral-700 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-5">
                        <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Title</label>
                        <input class="outline-none border p-3 w-full rounded-lg dark:bg-neutral-900 dark:text-white @error('title') border-red-500 @enderror" type="text" id="titulo" name="title" placeholder="Your title" value="{{ old('title') }}">

                        @error('title')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Description</label>
                        <textarea class="outline-none whitespace-normal border w-full h-64 p-3 rounded-lg dark:bg-neutral-900 dark:text-white @error('description') border-red-500 @enderror" id="descripcion" name="description">
                            {{ old('description') }}
                        </textarea>    

                        @error('description')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <input type="hidden" name="image" value="{{ old('image') }}">

                        @error('image')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="submit" value="Create post" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>        
        </div>

    </div>


@endsection


