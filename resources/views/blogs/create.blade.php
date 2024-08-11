@extends('layouts.userPage')

@section('content')
<div class="container">
    <h2 style="text-align:center;color:rgb(0, 243, 231);"><b>Create Your Blog</b></h2>
    
    <!-- Displaying general error message -->
    @if($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Whoops!</strong> There were some problems with your input.asdas
    </div>
    @endif

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1" class="mb-2">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Blog Title">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control mt-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-4">
            <label for="exampleFormControlTextarea1" class="mb-2">Content <span style="font-size: 13px;color:rgb(99, 99, 99)">(Enter the Blog Content)</span></label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
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