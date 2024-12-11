
function DeleteBook(uuid) {
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
                url: '/book/delete/' + uuid,
                type: 'DELETE',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response) {
                        Swal.fire({title: "Başarılı", text: "Kitap başarıyla silindi", icon: "success"})
                            .then(function () {
                                location.reload();
                            });
                    } else {
                        Swal.fire({title: "Başarısız", text: "Kitap silinirken bir hata oluştu", icon: "error"});
                    }

                }
            });
        }
    });
}

$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var title = button.data('title');  
    var category = button.data('category'); // 'category' verisi
    var image = button.data('image'); 
    var description = button.data('description'); 
    var uuid = button.data('uuid'); 

    var modal = $(this);
    modal.find('.modal-body #title').val(title);
    modal.find('.modal-body #category_id').val(category);
    modal.find('.modal-body #description').val(description);
    
    if (image) {
        modal.find('.modal-body #image-preview').html('<img src="'+image+'" alt="Image" class="img-fluid"  style="height: auto; width: 50%;">');
    }


    var actionUrl = '/book/update/' + uuid;
    modal.find('form').attr('action', actionUrl);
});