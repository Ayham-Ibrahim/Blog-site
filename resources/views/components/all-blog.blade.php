<div class="col-md-6 col-lg-6 col-xl-4 col-sm-6" data-aos="fade-right">
    <div class="card" style="margin-bottom: 20px">
        <img class="card-img-top" src="{{ asset($blog->photo) }}" style="height: 300px;" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title" style="font-weight: bold">{{ $blog->title }}</h5>
            <h6 class="card-title" style="font-weight: bold;color:gray">{{ $blog->category->name }}</h6>
            <p class="card-text">{{ $blog->content }}</p>
            <a href="{{ route('showForAll', $blog->id) }}" class="btn btn-secondary">Read More ...</a>
        </div>
    </div>
</div>