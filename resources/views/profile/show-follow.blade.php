@extends('layouts.app')


@section('title')
    {{$title}}
@endsection


@section('content')

    <div class="flex justify-center mb-28 min-h-96 p-3">
        <livewire:follow-user :followers="$followers" :userProfile="$user" :followType="$type"/>
    </div>
    
@endsection
