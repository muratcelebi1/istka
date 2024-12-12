<div class="row">
    <div class="col-md-12 mb-3">
        <form action="/category/create" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <select class="form-select" name="is_active" id="is_active" required>
                    <option value="active" selected>Active</option>
                    <option value="passive">Passive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Add Category</button>
        </form>
    </div>
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Create Time</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->name}}</td>
                    <td>{!! $category->is_active == 'active' ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-danger">Passive</span>' !!}
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick="DeleteCategory('{{$category->uuid}}')">Sil</button>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-uuid="{{$category->uuid}}"
                                data-name="{{$category->name}}" data-is_active="{{$category->is_active}}"
                        >Detay
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>