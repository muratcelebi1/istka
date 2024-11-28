<?php
include "config.php";
include "header.php";
?>
<div class="container mt-4">
    <h2 class="text-center">Kitaplar</h2>
    <table class="table table-striped table-bordered mt-4 text-center table-hover">
        <thead >
            <tr>
                <th>Kitap Adı</th>
                <th>Kategori Adı</th>
            </tr>
        </thead>
        <tbody>
        <?php 
               $sql = "SELECT ki.kitapad , ka.kategori_ad FROM kategori ka 
               inner join kitap ki on ki.kategori_id = ka.id";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='col-md-5'><td>".$row["kitapad"]."</td><td>".$row["kategori_ad"]."</td> </tr>";
                }
              }
              $conn->close();
                ?>
        </tbody>
    </table>
</div>
 </body>
 <?php include "footer.php"; ?>
</html>