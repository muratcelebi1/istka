<?php
include "baglanti.php";
include "header.php";

?>
<style>
    .card {
        transition: transform 0.3s ease-in-out;
        border: none;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .card-body {
        padding: 1.5rem;
    }
    .btn{border: none;}
    .btn:hover {
        
        background-color: #001;
    }
</style>

<form action="kitapdetay.php" method="POST">
    <div class="container mt-5">
        <?php
        $sql = "SELECT ka.kategori_ad, COUNT(ki.kitapad) AS kitapsayisi
                FROM kategori ka
                INNER JOIN kitap ki ON ki.kategori_id = ka.id
                WHERE ka.kategori_durum = 1
                GROUP BY ka.kategori_ad";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["kitapsayisi"] > 0) {
                    echo "<hr><h4 class='fw-bold mt-3 text-center text-uppercase '>" . $row['kategori_ad'] . " </h4><hr>";

                    $sql_kitaplar = "SELECT ki.kitapad, ka.kategori_ad, fy.fiyat, fr.firma_ad, ki.id
                                    FROM kitap ki
                                    LEFT JOIN kategori ka ON ki.kategori_id = ka.id
                                    LEFT JOIN fiyat fy ON fy.kitap_id = ki.id
                                    LEFT JOIN firma fr ON fr.id = fy.firma_id
                                    WHERE ka.kategori_ad = '" . $row['kategori_ad'] . "'";
                    $result_kitaplar = $conn->query($sql_kitaplar);

                    if ($result_kitaplar->num_rows > 0) {
                        echo "<div class='row mb-4'>";
                        while ($kitap = $result_kitaplar->fetch_assoc()) {
                            echo "<div class='col-md-4 mb-4'>
                                     <button class='btn btn-outline-secondary w-100' name='kitap' value=". ($kitap['id']) . ">
                                    <div class='card shadow-sm rounded'>
                                        <div class='card-body bg-secondary-subtle'>
                                            <h5 class='card-title'>" . ($kitap['kitapad']) . "</h5>
                                            <p class='card-text'>" . (is_null($kitap["firma_ad"]) ? 'Firma bulunmamaktadır' : ($kitap["firma_ad"])) . "</p>
                                            <p class='card-text text-success'>" . (is_null($kitap["fiyat"]) ? 'Fiyat bulunmamaktadır' : ($kitap["fiyat"]) . '₺') . "</p>
                                        </div>
                                    </div>
                                    </button>
                                  </div>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p class='text-center text-muted'>Bu kategoriye ait kitap bulunmamaktadır.</p>";
                    }
                }
            }
        } else {
            echo "<p class='text-center text-muted'>Hiç kategori bulunmamaktadır.</p>";
        }
        $conn->close();
        ?>
    </div>
</form>


</body>
<?php include "footer.php"; ?>
</html>