<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <meta name="description" content="@yield('page_description')">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])




</head>

<body>
    @include('layouts.menu')
    <div class="container mt-3">

        @if($errors->any())
            <div class="alert alert-danger" style="background-color:red">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        @if(session('status'))
            Swal.fire({
                title: "{{session('status') == 'success' ? 'Başarılı' : 'Başarısız'}}",
                text: "{{session('message')}}",
                icon: "{{session('status')}}",
                confirmButtonText: 'Kapat'
            });
        @endif

        @yield('js')
    </script>
</body>

</html>