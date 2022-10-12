@extends('layouts.app')

@section('title', 'Dettaglio Categoria')

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

        <h1 class="border-bottom">Dettagli Categoria: {{$category->name}}</h1>
        <div class="square p-3 bg-dark d-flex justify-content-center align-items-center flex-column">
            <ul class="list-unstyled pt-5 d-flex justify-content-center  flex-column">
                <li class="text-secondary py-1"><h4 class="text-white">Title: {{$category->name}}</h4></li>
            </ul>
            <table class="table m-auto table-dark pb-5">
                <thead class="">
                    <tr class="text-primary">
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category->posts as $posts)
                        <tr>
                            <th scope="row">{{$posts->id}}</th>
                            <td>{{$posts->title}}</td>
                            <td>{{$posts->slug}}</td>
                        </tr>
                    @empty
                        <tr>
                            <th>Nessun risultato trovato!</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{route('admin.categories.index')}}" class="btn btn-primary my-1">Back</a>
        </div>
    </div>




@endsection