<?php
include "config.php";
include "header.php";

?>

<div class="container mt-2">
    <?php
    // Kategoriler ve kitap sayıları sorgusu
    $sql = "SELECT ka.kategori_ad, COUNT(ki.kitapad) AS kitapsayisi
            FROM kategori ka
            INNER JOIN kitaplar ki ON ki.kategori_id = ka.id
            GROUP BY ka.kategori_ad";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Eğer kitap sayısı 1'den fazla ise, kategoriyi ve kitapları göster
            if ($row["kitapsayisi"] > 0) {
                echo "<hr><h4 class='fw-bold mt-3'>" . $row['kategori_ad'] . " </h4><hr>";

                // Bu kategoriye ait kitapları sorgulamak için yeni bir SQL sorgusu
                $sql_kitaplar = "SELECT ki.kitapad, ki.fiyat
                                 FROM kitaplar ki
                                 INNER JOIN kategori ka ON ki.kategori_id = ka.id
                                 WHERE ka.kategori_ad = '" . $row['kategori_ad'] . "'";
                $result_kitaplar = $conn->query($sql_kitaplar);

                if ($result_kitaplar->num_rows > 0) {
                    echo " <div class='row mb-2'>
                                <div class='col-md-6'>
                                    <h6>Kitap Adı</h6>
                                </div>
                                <div class='col-md-6'>
                                    <h6>Fiyatı </h6>
                                </div>
                              </div>";
                    while ($kitap = $result_kitaplar->fetch_assoc()) {
                        echo "
                              <div class='row'>
                                <div class='col-md-6'>
                                    <h6> " . $kitap['kitapad'] . "</h6>
                                </div>
                                <div class='col-md-6'>
                                    <h6>" . $kitap['fiyat'] . ".00 TL</h6>
                                </div>
                              </div>";
                    }
                } else {
                    echo "<p>Bu kategoriye ait kitap bulunmamaktadır.</p>";
                }
            }
        }
    } else {
        echo "<p>Hiç kategori bulunmamaktadır.</p>";
    }
    
    $conn->close();
    ?>
</div>

</body>

</html>