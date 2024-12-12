<?php
include "baglanti.php";
include "header.php";
$_SESSION["url"] = "kategori";
?>
<div class="container mt-5">
    <h3>Kategori ekle</h3>
    <form id="ekle" action="config.php" method="POST">
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori adı</label>
            <input type="text" class="form-control" id="kategori" name="kategoriad"
                placeholder="Kategori adını giriniz">
        </div>

        <button type="submit" class="btn btn-primary" id="btn">Kategori Ekle</button>
    </form>
</div>
<div class="container">
    <h3 class="text-center">Kategoriler</h3>
    <table class="table table-striped table-bordered mt-4 text-center table-hover">
        <thead>
            <tr>
                <th>Kategori id</th>
                <th>Kategori Adı</th>
                <th>Kategori durumu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM kategori ka order by id ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='col-md-5'>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["kategori_ad"] . "</td>
                            <td><input type='checkbox' style='pointer-events: none; opacity: 1;' " . ($row['kategori_durum'] == '1' ? "checked" : "") . "></td>
                            <td>
                                <button class='btn btn-primary' data-id='" . $row['id'] . "' data-ad='" . $row["kategori_ad"] . "' data-durum='" . $row["kategori_durum"] . "' id='guncel" . $row["id"] . "' data-bs-toggle='modal' data-bs-target='#myModal'>Güncelle</button>
                                <button class='btn btn-danger' name='kategorisil' id='sil" . $row["id"] . "' value='" . $row["id"] . "' >Sil</button>
                            </td>
                          </tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>

</div>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Kategori Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" id="modalform" action="config.php">
                    <div class="mb-3">
                        <label for="kid" class="form-label">Kategori ID</label>
                        <input type="text" class="form-control" id="kid" data-id="" name="guncelkategoriid" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kad" class="form-label">Kategori Adı</label>
                        <input type="text" class="form-control" id="kad" name="guncelkategoriad">
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="kdup" class="form-label">Kategori Durum</label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="form-check" id="kdup" name="guncelkategoridurum" value="0">
                            <label for="kdup" class="form-label">Pasif</label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="form-check" id="kdua" name="guncelkategoridurum" value="1">
                            <label for="kdua" class="form-label">Aktif</label>
                        </div>

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
            if ($("#kategori").val() == ""  || $("#kategori").length >= 50) {
              mesaj();
            }
        });
        $("#modalform").on("submit", function(event) {
            if ($("#kad").val() == ""  || $("#kad").length >= 50) {
                mesaj();
            }
        });
        $("[id^='guncel']").click(function(event) { //modal kısmı veri aktarımı
            event.preventDefault();
            $("#kid").val($(this).attr("data-id"))
            $("#kad").val($(this).attr("data-ad"))
            if ($(this).attr("data-durum") == 1) {
                $("#kdua").prop("checked", true);
            } else {
                $("#kdup").prop("checked", true);
            }
        })



    });
</script>
<script src="sil.js"></script> <!-- dinamik bir js yapısı  -->
<?php include "footer.php"; ?>

</html>