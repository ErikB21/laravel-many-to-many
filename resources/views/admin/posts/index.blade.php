@extends('layouts.app')

@section('title', 'Post')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="container-fluid pt-4 px-0 my_bg">
        
        @if (session('success'))
            <div class="container">
                <div class="alert alert-success">
                    <i class="fa-solid  fa-circle-check"></i> {{ session('success') }} 
                </div>
            </div>
        @elseif (session('danger'))
            <div class="container">
                <div class="alert alert-danger">
                    <i class="fa-regular fa-trash-can"></i> {{ session('danger') }} 
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center px-2 my_title">
            <h1 class="text-center py-3">Post</h1>
            <a class="btn btn-dark" href="{{route('admin.posts.create')}}"><i class="fa-solid fa-circle-plus pr-2 text-primary"></i>New Post</a>
        </div>
        <table class="table m-auto table-dark pb-5">
            <thead class="">
                <tr class="text-primary">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>{{($post->category)?$post->category->name:'null'}}</td>
                        @foreach ($post->tags as $tag)
                            <td>{{$tag->name}}</td>
                        @endforeach
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.posts.show', ['post' => $post])}}">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th>Nessun risultato trovato!</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection