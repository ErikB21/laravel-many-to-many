@extends('layouts.app')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

    <div class="container-fluid my_height px-0 d-flex flex-column justify-content-center align-items-center text-center">
        <h1 class="">Welcome {{Auth::user()->name}}</h1>
        <div class="d-flex flex-column justify-content-center align-items-start">
            <h3 class="">Your Administrative Area</h3>
            <a class="text-decoration-none text-dark" href="{{route('admin.posts.index')}}"><i class="fa-solid fa-signs-post"></i> See your posts</a>
            <a class="text-decoration-none text-dark" href="{{route('admin.categories.index')}}"><i class="fa-solid fa-paper-plane"></i> See your categories</a>
            <a class="text-decoration-none text-dark" href="{{route('admin.tags.index')}}" class="nav-link"><i class="fa-solid fa-tags"></i> Tags</a>
        </div>
    </div>

@endsection