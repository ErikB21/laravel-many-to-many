@extends('layouts.app')

@section('title', 'Category')

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
            <h1 class="text-center py-3">Category</h1>
            <a class="btn btn-dark" href="{{route('admin.categories.create')}}"><i class="fa-solid fa-circle-plus pr-2 text-primary"></i>Nuova Categoria</a>
        </div>
        <table class="table m-auto table-dark pb-5">
            <thead class="">
                <tr class="text-primary">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.categories.show', ['category' => $category])}}">Dettagli</a>
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