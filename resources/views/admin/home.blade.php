@extends('layouts.app')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

    <div class="container-fluid my_height px-0 d-flex flex-column justify-content-center align-items-center text-center">
        <h1 class="">Benvenuto {{Auth::user()->name}}</h1>
        <h3 class="">La tua area Amministrativa</h3>
        <a class="text-decoration-none text-dark" href="{{route('admin.posts.index')}}"><i class="fa-solid fa-signs-post"></i> Vedi i tuoi post</a>
        <a class="text-decoration-none text-dark" href="{{route('admin.categories.index')}}"><i class="fa-solid fa-paper-plane"></i> Vedi le tue categorie</a>
    </div>

@endsection