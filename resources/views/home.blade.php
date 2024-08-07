@extends('layouts.userPage')

@section('content')
<div class="container mt-4">
    @if(Session::get('sucsses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('sucsses')}}
        </div>
    @endif
    @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('message')}}
        </div>
    @endif
    @if(Session::get('del'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('del')}}
        </div>
    @endif
    @if(Session::get('restore'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('restore')}}
        </div>
    @endif
            <div class="row row-sm mt-2">
                @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                    <div class="card" style="margin-bottom: 20px">
                        <img class="card-img-top" src="{{ asset($blog->photo) }}" style="height: 300px;" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold">{{$blog->title}}</h5>
                        <p class="card-text">{{$blog->content}}</p>
                        <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('blogs.edit',$blog->id) }}" class="btn" style="background-color: aqua">edit</a>
                            <a href="{{ route('blogs.show',$blog->id) }}" class="btn btn-secondary">show</a>
                            <button type="submit" class="btn btn-danger">SoftDelete</button>
                        </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        {{ $blogs->links() }}
    </div>
@endsection
