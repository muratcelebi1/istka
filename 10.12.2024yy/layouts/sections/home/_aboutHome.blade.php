<p><b>Bu welcome.blade.php</b></p>
@if($errors->any())
    <div class="alert alert-danger" style="background-color:red">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif