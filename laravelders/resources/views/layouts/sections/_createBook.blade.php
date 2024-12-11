<div class="row">
    <div class="col-md-12 mb-3">
        <form action="/book/create" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile01" name="image">
              </div>
            <div class="mb-3">
                <label for="title" class="form-label">Name</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select" name="category_id" id="category_id" required>
                    <option value="">---Select----</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <span class="input-group-text">Açıklama</span>
                <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
              </div>

            <button type="submit" class="btn btn-success mt-2">Add Book</button>
        </form>
    </div>
</div>
<div class="row">
    @foreach($books as $book)
    <div class="col-md-4 mt-3">
        <div class="card" style="width: 18rem;">
            <div class="mx-auto mt-2" style="width: 100px; height: 150px;">
                <img src="{{$book->image}}" class="card-img-top rounded" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="card-body text-center"> 
                <small class="text-muted">{{$book->created_at->diffForHumans()}}</small><br>
                <a href="/book/{{$book->uuid}}" class="card-title mt-2 mb-1">{{$book->title}}</a>
                <a href="/category/{{$book->category->slug}}" class="d-block mb-3">{{$book->category->name}}</a>
                <div class="input-group mb-2">
                 <textarea class="form-control" aria-label="With textarea"
                  readonly style="height: 100px;">{{ strlen($book->description) > 90 ? substr($book->description, 0, 90) . '...' : $book->description }}</textarea>
                </div>
                
                <div class="d-flex justify-content-between"> 
                    <button class="btn btn-warning" onclick="DeleteBook('{{$book->uuid}}')">Sil</button>
                    <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-uuid="{{$book->uuid}}" data-category="{{$book->category_id}}"
                            data-title="{{$book->title}}" data-image="{{$book->image}}"
                            data-description="{{$book->description}}">
                        Detay
                    </button>
                </div>
            </div>
        </div>
    </div>
    
@endforeach

    
</div>