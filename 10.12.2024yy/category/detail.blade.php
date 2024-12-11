<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$category->name}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <p><b>Bu category/detail.blade.php</b></p>
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
        <h2>{{$category->name}}</h2>
        <hr>
        <h4>Kitaplar</h4>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                @foreach($category->books as $book)
                    <tr>
                        <td>{{$book->title}}</td>
                    </tr>
                @endforeach
                </thead>
            </table>
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
</script>
</body>
</html>
