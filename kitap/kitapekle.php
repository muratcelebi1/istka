<?php
 include "config.php";
 include "header.php";
 

?>
<body>
    
<div class="container mt-5">
        <h3>Kitap Bilgileri</h3>
        <form action="config.php" method="POST">
            <div class="mb-3">
                <label for="kitapadi" class="form-label">Kitap Adı</label>
                <input type="text" class="form-control" id="kitapadi" name="kitapad" placeholder="Kitap adını giriniz">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kitap Kategorisi</label>
                <select class="form-select" id="kategori" name="kitapkategori">
                <?php 
               $sql = "SELECT id, kategori_ad FROM kategori";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value=". $row["id"].">".$row["kategori_ad"]."</option>";
                }
              }
              $conn->close();
                ?>

                </select>
            </div>
            <div class="mb-3">
                <label for="kitapfiyati" class="form-label">Kitap Fiyati</label>
                <input type="text" class="form-control" id="kitapfiyati" name="kitapfiyat" placeholder="Kitap Fiyatı giriniz">
            </div>
            <button type="submit" class="btn btn-danger "> Kitap Ekle</button>
        </form>
    </div>
</body>
</html>