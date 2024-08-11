@extends('layouts.userPage')

@section('content')
<div class="container">
 
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($blog->photo) }}" alt="blog Image" class="img-fluid">
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
            <hr>
            <!-- Display Comments -->
            @foreach($blog->comments as $comment)
                <div class="mb-3">
                    <div style="display:flex;gap:20px; justify-content:flex-start;align-items:center;margin-bottom: 10px;">
                        <img src="{{ asset('/images.png') }}" alt="user Image" class="img-fluid" style="width:30px; height:30px;">
                        <p style="font-size:20px;margin-bottom: 0;">{{ $comment->content }}</p>
                    </div>
                        <small style="padding-left:20px;">by {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}</small>

                        @if(Auth::id() === $blog->user_id)
                        <!-- Buttons for the blog owner -->
                        <div style="margin-top: 10px; padding-left: 20px;">
                            <!-- Delete Comment Button -->
                            <form action="{{ route('comments.delete', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                            <!-- Hide Comment Button -->
                            <form action="{{ route('comments.hide', ['blog' => $blog->id, 'id' => $comment->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm">
                                    {{ $comment->hidden ? 'Unhide' : 'Hide' }}
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
