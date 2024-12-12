
<div class="card mt-4">
    <div class="card-header">
        <h5>Yorumlar</h5>
    </div>
    <div class="card-body">
        @foreach ($book->comments as $comment)
            <div class="mb-3">
                <h6><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></h6>
                <p>{{ $comment->comment }}</p>
                <hr>
            </div>
            
        @endforeach


        <h6>Yorum Yap</h6>
        <form action="{{ route('comment', ['uuid' => $book->uuid, 'id' => $book->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea class="form-control" name="comment" rows="3" placeholder="Yorumunuzu yazın..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="bookid" value="{{$book->id}}">Yorum Gönder</button>
        </form>
    </div>
</div>