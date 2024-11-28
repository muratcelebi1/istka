<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Uygulaması</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script> 
        function mesaj() {
            Swal.fire({
                    title: "Hata",
                    text: "Gerekli alanları boş bıraktınız veya Gereğinden fazla karakter girdiniz.",
                    icon: "error"
                });
                event.preventDefault();
                return;
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index">Kitap Uygulaması</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="kitaplar">Kitaplar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kitap">Kitap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="firma">Firma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fiyat">Fiyat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
if (isset($_SESSION["message_type"])) {
    if ($_SESSION["message_type"] == "basarili") {
        echo "<script>Swal.fire({
            title: 'Başarılı!',
            text:'".$_SESSION["message"]."',
            icon: 'success'
        });</script>";
    } elseif ($_SESSION["message_type"] == "basarisiz") {
        echo "<script>Swal.fire({
            title: 'Hata',
            text: '".$_SESSION["message"]."',
            icon: 'error'
        });</script>";
    }

    unset($_SESSION["message"]);
    unset($_SESSION["message_type"]);
}
?>