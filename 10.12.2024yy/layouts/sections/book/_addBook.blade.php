<div class="container">
    <p><b>Bu book/create.blade.php</b></p>
    @if($errors->any())
        <div class="alert alert-danger" style="background-color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-3">
            <form action="/book/create" method="post">
                @csrf
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

                <button type="submit" class="btn btn-success">Add Book</button>
            </form>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Create Time</th>
                        <th scope="col">Title</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Kategori Durumu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->created_at}}</td>
                            <td>{{$book->title}}</td>
                            <td><a href="/category/{{$book->category->slug}}">{{$book->category->name}}</a></td>
                            <td>{!! $book->category->is_active == 'active' ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-danger">Passive</span>' !!}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>