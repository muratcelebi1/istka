<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <p><b>Bu category/create.blade.php</b></p>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Category Update</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script>
    @if(session('status'))
    Swal.fire({
        title: "{{session('status') == 'success' ? 'Başarılı' : 'Başarısız'}}",
        text: "{{session('message')}}",
        icon: "{{session('status')}}",
        confirmButtonText: 'Kapat'
    });
    @endif

    function DeleteCategory(uuid) {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu işlem geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/category/delete/' + uuid,
                    type: 'DELETE',
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        if (response) {
                            Swal.fire({title: "Başarılı", text: "Kategori başarıyla silindi", icon: "success"})
                                .then(function () {
                                    location.reload();
                                });
                        } else {
                            Swal.fire({title: "Başarısız", text: "Kategori silinirken bir hata oluştu", icon: "error"});
                        }

                    }
                });
            }
        });
    }

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var uuid = button.data('uuid');
        var name = button.data('name');
        var is_active = button.data('is_active');
        var modal = $(this);
        console.log(uuid)
        console.log(name)
        console.log(is_active)
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #is_active').val(is_active);

        var formAction = '/category/update/' + uuid;
        modal.find('form').attr('action', formAction);
    });
</script>
</body>
</html>
