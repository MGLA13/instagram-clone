@extends('layouts.app')

@section('title')
    Posts from your following
@endsection

@section('content')
    <x-list-post :posts="$posts" :showInfo="$showInfo"/>
@endsection