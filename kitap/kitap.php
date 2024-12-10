<?php
include "baglanti.php";
include "header.php";
$_SESSION["url"] = "kitap";
?>

<body>
    <div class="container mt-5">
        <h3>Kitap Bilgileri</h3>
        <form id="ekle" action="config.php" method="POST">
            <div class="mb-3">
                <label for="kitapadi" class="form-label">Kitap Adı</label>
                <input type="text" class="form-control" id="kitapadi" name="kitapad" placeholder="Kitap adını giriniz">
            </div>
            <div class="mb-3">
                <label for="kitapyazari" class="form-label">Kitap Yazarı</label>
                <input type="text" class="form-control" id="kitapyazari" name="kitapyazar" placeholder="Kitap yazar adını giriniz">
            </div>
            <div class="mb-3">
                <label for="kitapyayini" class="form-label">Kitap Yayınevi</label>
                <input type="text" class="form-control" id="kitapyayini" name="kitapyayin" placeholder="Kitap yayınevini giriniz">
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kitap Kategorisi</label>
                <select class="form-select" id="kategori" name="kitapkategori">
                    <?php
                    $sql = "SELECT id, kategori_ad FROM kategori order by id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["id"] . ">" . $row["kategori_ad"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success "> Kitap Ekle</button>
        </form>
    </div>
    <div class="container">
        <h3 class="text-center">Kitaplar</h3>
        <table class="table table-striped table-bordered mt-4 text-center table-hover">
            <thead>
                <tr>
                    <th>Kitap id</th>
                    <th>Kitap Adı</th>
                    <th>Kitap Kategorisi</th>
                    <th>Kitap Yazar Adı</th>
                    <th>Kitap Yayınevi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * from kategori ka 
                         inner join kitap ki on ki.kategori_id=ka.id order by  ki.id ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='col-md-5'><td>" . $row["id"] . "</td>
                    <td>" . $row["kitapad"] . "</td>
                    <td>" . $row["kategori_ad"] . "</td>
                    <td>" . $row["yazar"] . "</td>
                    <td>" . $row["yayinevi"] . "</td>
                    <td>
                    <button class='btn btn-primary' data-id='" . $row['id'] . "' data-kitapad='" . $row['kitapad'] . "' 
                    data-kategoriid='" . $row["kategori_id"] . "' data-yazar='" . $row["yazar"] . "' data-yayinevi='" . $row["yayinevi"] . "'
                     id='guncel" . $row["id"] . "' data-bs-toggle='modal' data-bs-target='#myModal'>Güncelle</button>
                     <button class='btn btn-danger' name='kitapsil' id='sil" . $row["id"] . "' value=" . $row["id"] . " >Sil</button></td>
                    </td></tr>";
                    }
                }
              
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Kitap Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" id="modalform" action="config.php">
                    <div class="mb-3">
                        <label for="kid" class="form-label">Kitap ID</label>
                        <input type="text" class="form-control" id="kid" data-id="" name="guncelkitapid" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kad" class="form-label">Kitap Adı</label>
                        <input type="text" class="form-control" id="kad" name="guncelkitapad">
                    </div>
                    <div class="mb-3">
                <label for="kkid" class="form-label">Kitap Kategorisi</label>
                <select class="form-select" id="kkid" name="guncelkitapkat">
                    <?php
                    $sql = "SELECT id, kategori_ad FROM kategori order by id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["id"] . ">" . $row["kategori_ad"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
                    <div class="mb-3">
                        <label for="kyaz" class="form-label">Yazar</label>
                        <input type="text" class="form-control" id="kyaz" name="guncelkitapyaz">
                    </div>
                    <div class="mb-3">
                        <label for="kyay" class="form-label">Yayinevi</label>
                        <input type="text" class="form-control" id="kyay" name="guncelkitapyay">
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary col-5">Güncelle</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Çıkış</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
<script>
    $(document).ready(function() {
        $("#ekle").on("submit", function(event) {
            if ($("#kitapadi").val() == ""  || $("#kitapadi").length >= 50 ||
            $("#kitapyayini").val() == ""  || $("#kitapyayini").length >= 50 ||
            $("#kitapyazari").val() == ""  || $("#kitapyazari").length >= 50){
              mesaj();
            }
        });
        $("#modalform").on("submit", function(event) {
            if ($("#kad").val() == ""  || $("#kad").length >= 50 ||
            $("#kyay").val() == ""  || $("#kad").length >= 50 ||
            $("#kyaz").val() == ""  || $("#kyaz").length >= 50){
              mesaj();
            }
        });
        $("[id^='guncel']").click(function(event) { //modal kısmı veri aktarımı
            event.preventDefault();
            $("#kid").val($(this).attr("data-id"))
            $("#kad").val($(this).attr("data-kitapad"))
            $("#kkid").val($(this).attr("data-kategoriid"))
            $("#kyaz").val($(this).attr("data-yazar"))
            $("#kyay").val($(this).attr("data-yayinevi"))
           
        })


    });
</script>
<script src="sil.js"></script> <!-- dinamik bir js yapısı  -->
<?php include "footer.php";   $conn->close(); ?>
</html>