<?php
include "baglanti.php";
include "header.php";
$_SESSION["url"] = "firma";
?>

<div class="container mt-5">
    <h3>Firma ekle</h3>
    <form action="config.php" id="ekle" method="POST">
        <div class="mb-3">
            <label for="firma" class="form-label">Firma adı</label>
            <input type="text" class="form-control" id="firma" name="firmaad"
                placeholder="Firma adını giriniz">
        </div>

        <button type="submit" class="btn btn-primary" id="btn">Firma Ekle</button>
    </form>
</div>

<div class="container">
    <h3 class="text-center">Firmalar</h3>
        <table class="table table-striped table-bordered mt-4 text-center table-hover">
            <thead>
                <tr>
                    <th>Firma id</th>
                    <th>Firma Adı</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * from firma order by id ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr ><td >" . $row["id"] . "</td>
                    <td >" . $row["firma_ad"] . "</td>
                                      
                    <td>
                    <button class='btn btn-primary' data-id='" . $row['id'] . "' data-ad='" . $row["firma_ad"] . "'  id='guncel" . $row["id"] . "' data-bs-toggle='modal' data-bs-target='#myModal'>Güncelle</button>
                    <button class='btn btn-danger' name='firmasil' id='sil" . $row["id"] . "' value=" . $row["id"] . " >Sil</button></td>
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
                <h5 class="modal-title" id="editModalLabel">Firma Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" id="modalform" action="config.php">
                    <div class="mb-3">
                        <label for="fid" class="form-label">Firma ID</label>
                        <input type="text" class="form-control" id="fid" data-id="" name="guncelfirmaid" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="fad" class="form-label">Firma Adı</label>
                        <input type="text" class="form-control" id="fad" name="guncelfirmaad">
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
            if ($("#firma").val() == ""  || $("#firma").length >= 50) {
              mesaj();
            }
        });
        $("#modalform").on("submit", function(event) {
            if ($("#fad").val() == ""  || $("#fad").length >= 50) {
                mesaj();
            }
        });
        $("[id^='guncel']").click(function(event) { //modal kısmı veri aktarımı
            event.preventDefault();
            $("#fid").val($(this).attr("data-id"))
            $("#fad").val($(this).attr("data-ad"))
        })

    });
</script>
<script src="sil.js"></script> <!-- dinamik bir js yapısı  -->
<?php include "footer.php"; ?>

</html>