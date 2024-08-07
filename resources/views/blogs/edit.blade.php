@extends('layouts.userPage')

@section('content')
<div class="container">
    <h2 style="text-align:center;color:rgb(0, 204, 204);"><b>Create Your Blog</b></h2>
    
    <!-- Displaying general error message -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1" class="mb-2">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" id="exampleFormControlInput1" placeholder="Enter Blog Title">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mt-4">
            <label for="exampleFormControlTextarea1" class="mb-2">Content <span style="font-size: 13px;color:rgb(99, 99, 99)">(Enter the Blog Content)</span></label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $blog->content }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @if($blog->photo)
        <img src="{{ asset($blog->photo) }}" alt="Current Blog Image" style="max-width: 200px; margin-top: 20px;" />
        @endif
        <div class="mb-3 mt-4">
            <label for="formFile" class="form-label">Choose The Blog Photo</label>
            <input class="form-control" type="file" id="formFile" name="photo">
            @error('photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Save</button>
        <a href="{{route('home')}}" class="btn btn-secondary" style="margin-top: 10px;">Cancel</a>
    </form>
</div>
@endsection