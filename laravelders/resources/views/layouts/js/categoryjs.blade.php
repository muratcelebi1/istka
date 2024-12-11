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