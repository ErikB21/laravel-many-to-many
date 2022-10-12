@extends('layouts.app')

@section('title', 'Dettaglio Post')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection

@section('content')

    <div class="container-fluid px-0 pt-5 d-flex my_bg_2 justify-content-center align-items-center flex-column">
        @if (session('warning'))
            <div class="container">
                <div class="alert alert-warning">
                    <i class="fa-solid fa-bolt"></i> {{ session('warning') }}
                </div>
            </div>
        @endif

        <h1 class="border-bottom">Dettagli Post {{$post->id}}</h1>
        <div class="square p-3 bg-dark d-flex justify-content-center align-items-center flex-column">
            <ul class="list-unstyled pt-5 d-flex justify-content-center  flex-column">
                <li class="text-secondary py-1"><strong class="text-white">Title:</strong> {{$post->title}}</li>
                <li class="py-1 text-secondary"><strong class="text-white">Slug:</strong> {{$post->slug}}</li>
                <li class="py-1 text-secondary"><strong class="text-white">Description:</strong> {{$post->description}}</li>
                <li class="d-flex py-3 ">
                    <a class="btn btn-warning mx-2" href="{{route('admin.posts.edit', ['post' => $post])}}">Edit</a>
                    <form action="{{route('admin.posts.destroy', ['post' => $post])}}" onsubmit="return confirm('Sei sicuro di voler cancellare questo post?')" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mx-2" type="submit">Delete</button>
                    </form>
                    <a class="btn btn-primary mx-2" href="{{route('admin.posts.index')}}">Back</a>
                </li>
            </ul>
        </div>
    </div>




@endsection