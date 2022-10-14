@extends('layouts.app')

@section('title', 'Create a Post')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css')}}">
@endsection

@section('content')

    <div class="container-fluid px-0 my_width_form">
        <div class="sec_bg">
            <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group mb-3">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option {{(old('category_id')==$category->id)?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <label for="tags">Tag</label>
                <div class="mb-3 d-flex align-items-center justify-content-start flex-wrap">
                    @forelse ($tags as $tag)
                        <div id="tags" class="form-group @error('tags') is-invalid @enderror form-check pr-2">
                            <input {{(in_array($tag->id, old('tags', [])))?'checked':''}} class="form-check-input" type="checkbox" name="tags[]" id="tag_{{$tag->id}}" value="{{$tag->id}}">
                            <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                        </div>
                    @empty
                        <div>No Tags Found!</div>
                    @endforelse
                    @error('tags')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover">Image</label>
                    <input id="cover" type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" alt="">
                    @error('image')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                
                

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input required type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea required class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description')}}</textarea>
                </div>
                @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>


@endsection