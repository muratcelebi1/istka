<?php
include "baglanti.php";
include "header.php";
$_SESSION["url"] = "fiyat";
?>

<body>
    <div class="container mt-5">
        <h3>Kitap Bilgileri</h3>
        <form id="ekle" action="config.php" method="POST">
            <div class="mb-3">
                <label for="kitap" class="form-label">Kitap Adı</label>
                <select class="form-select" id="kitap" name="fiyatkitap">
                    <?php
                    $sql = "SELECT ki.id,ki.kitapad FROM kategori ka 
                         inner join kitap ki on ki.kategori_id=ka.id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["id"] . ">" . $row["kitapad"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="firma" class="form-label">Kitap Firması</label>
                <select class="form-select" id="firma" name="fiyatfirma">
                    <?php
                    $sql = "SELECT id, firma_ad FROM firma";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["id"] . ">" . $row["firma_ad"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fiyati" class="form-label">Kitap Fiyati</label>
                <input type="number" class="form-control" id="fiyati" name="fiyat"
                    placeholder="Kitap Fiyatı giriniz">
            </div>
            <button type="submit" class="btn btn-success "> Fiyat Ekle</button>
        </form>
    </div>
    <div class="container">
        <h3 class="text-center">Kitaplar</h3>

        <table class="table table-striped table-bordered mt-4 text-center table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Kitap Adı</th>
                    <th>Kitap Firması</th>
                    <th>Kitap Fiyatı</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT f.id AS fiyat_id, ki.id AS kitap_id, ki.kitapad, fi.id AS firma_id, fi.firma_ad, 
                f.fiyat FROM fiyat f INNER JOIN kitap ki ON ki.id = f.kitap_id INNER JOIN firma fi ON fi.id = f.firma_id order by fiyat_id ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='col-md-5'><td>" . $row["fiyat_id"] . "</td>
                    <td>" . $row["kitapad"] . "</td>
                    <td>" . $row["firma_ad"] . "</td>
                    <td>" . $row["fiyat"] . ".00 ₺</td>
                    <td> <button class='btn btn-primary' data-id='" . $row['fiyat_id'] . "' data-kitapid='" . $row['kitap_id'] . "' 
                    data-firmaid='" . $row["firma_id"] . "' data-fiyat='" . $row["fiyat"] . "' 
                     id='guncel" . $row["fiyat_id"] . "' data-bs-toggle='modal' data-bs-target='#myModal'>Güncelle</button>
                      <button class='btn btn-danger' name='fiyatsil' id='sil" . $row["fiyat_id"] . "' value=" . $row["fiyat_id"] . " >Sil</button>
                    </td>
                    
                    </tr>";
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
                    <h5 class="modal-title" id="editModalLabel">Fiyat Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="modalform" action="config.php">
                        <div class="mb-3">
                            <label for="fid" class="form-label">Fiyat ID</label>
                            <input type="text" class="form-control" id="fid" name="guncelfiyatid" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kiad" class="form-label">Kitap Adı</label>
                            <select class="form-select" id="kiad" name="guncelfiyatkit">
                                <?php
                                $sql = "SELECT id, kitapad FROM kitap";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["id"] . "'>" . $row["kitapad"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kaad" class="form-label">Firma Adı</label>
                            <select class="form-select" id="kaad" name="guncelfiyatfir">
                                <?php
                                $sql = "SELECT id, firma_ad FROM firma";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["id"] . "'>" . $row["firma_ad"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ff" class="form-label">Fiyat</label>
                            <input type="number" class="form-control" id="ff" name="guncelfiyatf" >
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
            if (isNaN(Number($("#fiyati").val())) || Number($("#fiyati").val()) < 0  || $("#fiyati").val()=="") {
                mesaj();
            }
        });
        $("#modalform").on("submit", function(event) {
            if (isNaN(Number($("#ff").val())) || Number($("#ff").val()) < 0  || $("#ff").val()=="") {
                mesaj();
            }
        });
        $("[id^='guncel']").click(function(event) { //modal kısmı veri aktarımı
            event.preventDefault();
            $("#fid").val($(this).attr("data-id"))
            $("#kiad").val($(this).attr("data-kitapid"))
            $("#kaad").val($(this).attr("data-firmaid"))
            $("#ff").val($(this).attr("data-fiyat"))

        })
    });
</script>
<script src="sil.js"></script> <!-- dinamik bir js yapısı  -->
<?php include "footer.php";
$conn->close(); ?>
</html>