<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Book Update</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- <div class="input-group mb-3">
                        <input type="file" class="form-control" id="image" name="image">
                    </div> --}}
                    
                    <div id="image-preview" style="max-height: 300px; overflow: hidden; text-align: center;">
                    </div>
                
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option value="">---Select----</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <span class="input-group-text">Description</span>
                        <textarea class="form-control" aria-label="With textarea" name="description" id="description"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>