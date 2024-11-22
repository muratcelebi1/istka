<?php
 include "header.php";

?>
   <div class="container mt-5">
        <h3>Kategori ekle</h3>
        <form action="config.php" method="POST">
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori adı</label>
                <input type="text" class="form-control" id="kategori" name="kategoriad" placeholder="Kategori adını giriniz">
            </div>
            
            <button type="submit" class="btn btn-success ">Kategori Ekle</button>
        </form>
    </div>

</body>
</html>