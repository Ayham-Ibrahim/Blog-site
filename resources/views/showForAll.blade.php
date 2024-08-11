@extends('layouts.layout')

@section('content')
<div class="container">
        @if(Session::get('sucsses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('sucsses')}}
        </div>
        @endif
    <a href="{{ url('/') }}" class="go-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
        </svg> Home
    </a>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            <img src="{{ asset($blog->photo) }}" alt="Blog Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2 style="font-weight: bold">{{ $blog->title }}</h2>
            <h4 style="font-weight: bold;color:gray">{{ $blog->category->name }}</h4>
            <p>{{ $blog->content }}</p>
        </div>
    </div>

    @if(Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <!-- Comments Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Comments</h3>
            @auth
                <form action="{{ route('addComment', $blog) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" placeholder="Your comment here..." required></textarea>
                    </div>
                    <button type="submit" class="btn mt-2" style="background-color: aqua">Add Comment</button>
                </form>
            @endauth
            @guest
                <p>Please <a href="{{ route('login') }}">log in</a> to add a comment.</p>
            @endguest
            <hr>
            <!-- Display Comments -->
            @foreach($blog->comments->where('hidden', false) as $comment)
                <div class="mb-3">
                    <div style="display:flex;gap:20px; justify-content:flex-start;align-items:center;margin-bottom: 10px;">
                        <img src="{{ asset('/images.png') }}" alt="user Image" class="img-fluid" style="width:30px; height:30px;">
                        <p style="font-size:20px;margin-bottom: 0;">{{ $comment->content }}</p>
                    </div>
                        <small style="padding-left:20px;">by {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}</small>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
