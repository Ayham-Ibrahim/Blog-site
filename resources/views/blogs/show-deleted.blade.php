@extends('layouts.userPage')

    @section('content')

    <div class="container">

        @if(Session::get('del'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{Session::get('del')}}
            </div>
        @endif
            <div class="row" style="margin-top:10px;">
                @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                    <div class="card" style="margin-bottom: 20px">
                        <img class="card-img-top" src="{{ asset($blog->photo) }}" style="height: 300px;" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold">{{$blog->title}}</h5>
                        <p class="card-text">{{$blog->content}}</p>
                        <form action="{{ route('forcedelete',$blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('restore',$blog->id) }}" class="btn btn-success">restore</a>
                            <button type="submit" class="btn btn-danger">Force Delete</button>
                        </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>


    @endsection
