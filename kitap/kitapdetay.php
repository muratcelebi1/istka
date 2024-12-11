<?php
include "baglanti.php";
include "header.php";
?>
<div class="container mt-2">
    <div class="card mb-3" style="max-width: 90%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="gedik_logo.png" class="img-fluid rounded-start" >
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <?php  // kitap iceriği için
                    $sql_kitaplar = "SELECT DISTINCT *   
                from kitap ki
                left join kategori ka on ki.kategori_id = ka.id
                left join fiyat fy on fy.kitap_id = ki.id
                left join firma fr on fr.id = fy.firma_id
                    WHERE ki.id = '" . $_POST['kitap'] . "'";
                    $result_kitaplar = $conn->query($sql_kitaplar);
                    if ($result_kitaplar->num_rows > 0) {
                        $kitap = $result_kitaplar->fetch_assoc();
                            echo " 
                            <div class='row mt-2'>
                              <div class='col-md-5'>
                                    <h6>Kitap Adı:</h6>
                                </div>
                                <div class='col-md-7'>
                                    <p> " . $kitap['kitapad'] . "</p>
                                </div>
                                </div>
                                <div class='row mt-1'>
                                  <div class='col-md-5'>
                                    <h6>Kitap kategorisi:</h6>
                                   </div>
                                   <div class='col-md-7'>
                                    <p> " . $kitap['kategori_ad'] . "</p>
                                  </div>
                                </div>
                                 <div class='row mt-1'>
                                  <div class='col-md-5'>
                                    <h6>Kitap Yazarı:</h6>
                                   </div>
                                   <div class='col-md-7'>
                                    <p> " . $kitap['yazar'] . "</p>
                                  </div>
                                </div>
                                 <div class='row mt-1'>
                                  <div class='col-md-5'>
                                    <h6>Kitap Yayınevi:</h6>
                                   </div>
                                   <div class='col-md-7'>
                                    <p> " . $kitap['yayinevi'] . "</p>
                                  </div>
                                </div>
                            </div>";
                        
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
        <table class="table table-striped table-bordered mt-4 text-center table-hover">
            <thead>
                <tr>
                    <th>Firma Adı</th>
                    <th>Firma Kitap Fiyatı</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $sql_kitaplar = "SELECT fy.id as fiyat_id,fr.firma_ad,fy.fiyat
                  from kitap ki
                  left join kategori ka on ki.kategori_id = ka.id
                  left join fiyat fy on fy.kitap_id = ki.id
                  left join firma fr on fr.id = fy.firma_id
                      WHERE fy.kitap_id = '" . $_POST['kitap'] . "'";
                $result = $conn->query($sql_kitaplar);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='col-md-5'><td>" . $row["firma_ad"] . "</td>
                    <td>" . $row["fiyat"] . ".00 ₺</td>
                    <td><button class='btn btn-danger'  id='sepet".$row["fiyat_id"]."'>Sepete Ekle</button></td>
                    </tr>";
                    }
                } else {
                    echo "<tr class='col-md-5'><td colspan='5'>Firmalara ait kayıtlı satış fiyatı yok</td></tr>";
                }
                
                ?>
            </tbody>
        </table>
</div>
<script> 
$("[id^='sepet']").click(function(){ // Sadece görsel
    Swal.fire({
        icon: 'success',
        title: 'Başarılı!',
        text: 'Kitap sepete eklendi.',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        location.reload();
    });
});
</script>
</body>
<?php  $conn->close(); include "footer.php"; ?>

</html>