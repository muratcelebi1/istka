$("[id^='sil']").click(function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Emin misin?",
                text: "Veri silinecek!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Evet, sil!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var value = $(this).attr("value");
                    var name = $(this).attr("name");
                    var data = { [name]: value };
                    $.post("config.php", data, function(response) {
                        var res = JSON.parse(response);
                        if (res.message_type === "basarili") {
                            Swal.fire("Başarılı!", res.message, "success").then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                                else{
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire("Hata!", res.message, "error");
                        }
                    }).fail(function() {
                        Swal.fire("Hata!", "Bir hata oluştu. Lütfen tekrar deneyin.", "error");
                    });
                }
            });
        });
