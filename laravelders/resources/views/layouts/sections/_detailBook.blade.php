<div class="container mt-2">
    <div class="card mb-3" style="max-width: 90%; margin: 0 auto;">
        <div class="row g-0">
            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <img src="{{$book->image}}" class="img-fluid">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title">{{$book->title}}</h3>
                    <hr>
                    <h6 class="card-subtitle text-muted">{{$book->category->name}}</h6>
                    <p class="card-text mt-3">{{$book->description}}</p>
                    <p class="card-text">
                        <small class="text-body-secondary">
                           {{$book->created_at->diffForHumans()}}
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@include('layouts.sections._bookComments')
</div>
