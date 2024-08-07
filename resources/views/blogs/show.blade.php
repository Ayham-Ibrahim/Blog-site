@extends('layouts.userPage')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($blog->photo) }}" alt="blog Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->content }}</p>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Comments</h3>
            <hr>
            <!-- Display Comments -->
            @foreach($blog->comments as $comment)
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
