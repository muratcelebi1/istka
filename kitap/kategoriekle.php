<?php
include "config.php";
include "header.php";

if (isset($_SESSION["message"])) {
    if ($_SESSION["message"] == "basarili") {
        echo "<script>Swal.fire({
            title: 'Başarılı!',
            text: 'Kategori başarıyla eklendi.',
            icon: 'success'
        });</script>";
    } elseif ($_SESSION["message"] == "basarisiz") {
        echo "<script>Swal.fire({
            title: 'Hata',
            text: 'Kategori eklenirken bir hata oluştu.',
            icon: 'error'
        });</script>";
    }

    unset($_SESSION["message"]);
}
?>

<div class="container mt-5">
    <h3>Kategori ekle</h3>
    <form action="config.php" method="POST">
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori adı</label>
            <input type="text" class="form-control" id="kategori" name="kategoriad"
                placeholder="Kategori adını giriniz">
        </div>

        <button type="submit" class="btn btn-primary" id="btn">Kategori Ekle</button>
    </form>
</div>

</body>

<script>
$(document).ready(function() {
    $("form").on("submit", function(event) {
        if ($("#kategori").val() == "") {
            Swal.fire({
                title: "Hata",
                text: "Alanları Boş Bırakmayınız",
                icon: "error"
            });
            event.preventDefault();
            return;
        }
    });
});
</script>

</html>