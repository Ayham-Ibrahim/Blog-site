@extends('layouts.landpage')

@section('content')
<div class="container mt-4">
      <!-- Search Form -->
      <div class="row mb-4">
        <div class="col-md-9 m-auto">
            <form action="{{ route('blogs.search') }}" method="GET" class="form-inline" style="display:flex;gap:20px">
                <input type="text" name="query" class="form-control mr-2" placeholder="Search blogs" value="{{ request('query') }}">
                <button type="submit" class="btn" style="background-color: aqua;border-radius: 12px 0px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <!-- Blog Listings -->
    <div class="row row-sm mt-2">
        @foreach($blogs as $blog)
            <x-all-blog :blog="$blog"/>
        @endforeach
    </div>
    {{ $blogs->appends(['query' => request('query')])->links() }}
</div>
@endsection
