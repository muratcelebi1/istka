<?php
include "baglanti.php";

// ekleme ve güncelleme fonksiyonu
function islem($sql, $param, $type, $url, $true, $false)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($type, ...$param);
    if ($stmt->execute()) {
        $_SESSION["message"] = $true;
        $_SESSION["message_type"] = "basarili";
        header("Location: $url");
    } else {
        $_SESSION["message"] = $false;
        $_SESSION["message_type"] = "basarisiz";
    }
    $stmt->close();
    exit;
}

// silme fonksiyonu (ajax kullanıldığı için ayrı)
function sil($sql, $param, $type, $true, $false)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($type, ...$param);
    if ($stmt->execute()) {
        echo json_encode(["message_type" => "basarili", "message" => $true]);
    } else {
        echo json_encode(["message_type" => "basarisiz", "message" => $false]);
    }
    $stmt->close();
    exit;
}

function hata(){
    $_SESSION["message"] = "Geçersiz veri türü gönderildi.";
    $_SESSION["message_type"] = "basarisiz";
    header("Location:". $_SESSION["url"]);
    exit;
}
function hatajson(){
    echo json_encode([
        "message_type" => "basarisiz",
        "message" => "Geçersiz veri türü gönderildi"
    ]);
    exit;
}

// Kategori işlemleri
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kategoriad"])) {
        if (empty(trim($_POST["kategoriad"]))) {
          hata();
        }
        $true = "Kategori başarıyla eklendi!";
        $false = "Kategori eklenirken bir hata oluştu!";
        $sql = "INSERT INTO kategori (kategori_ad) VALUES (?)";
        $kategoriad = [$_POST["kategoriad"]];
        islem($sql, $kategoriad, "s", $_SESSION["url"], $true, $false);
    }  
    else if (isset($_POST["guncelkategoriad"], $_POST["guncelkategoridurum"], $_POST["guncelkategoriid"])) {
        if (empty(trim($_POST["guncelkategoriad"])) || !ctype_digit($_POST["guncelkategoridurum"]) || !ctype_digit($_POST["guncelkategoriid"])) {
            hata();
        }
        $true = "Kategori başarıyla güncellendi!";
        $false = "Kategori güncellenirken bir hata oluştu!";
        $sql = "UPDATE kategori SET kategori_ad = ?, kategori_durum = ? WHERE id = ?";
        $params = [$_POST["guncelkategoriad"], $_POST["guncelkategoridurum"], $_POST["guncelkategoriid"]];
        islem($sql, $params, "sii", $_SESSION["url"], $true, $false);
    }
    else if (isset($_POST["kategorisil"])) {
        if (!ctype_digit($_POST["kategorisil"])) {
            hatajson();
        }
        $sql = "SELECT * FROM kitap  WHERE kategori_id=" . $_POST["kategorisil"];
        $result = $conn->query($sql);
        if ($result->num_rows < 1) {
        $true = "Kategori başarıyla silindi!";
        $false = "Kategori silinirken bir hata oluştu!";
        $sql = "DELETE FROM kategori WHERE id = ? ";
        $params = [$_POST["kategorisil"]];
        sil($sql, $params, "i", $true, $false);}
        else {
            echo json_encode(["message_type" => "basarisiz",
            "message" => "Kategoriye ait kayıtlı Kitaplar mevcut<hr>.<br>Kategori silinemez"]);
            exit;
        }
    }


    // kitap işlemleri
    else if (isset($_POST["kitapad"],$_POST["kitapyazar"],$_POST["kitapyayin"],$_POST["kitapkategori"])) {
        if (empty(trim($_POST["kitapad"])) || empty(trim($_POST["kitapyazar"])) || empty(trim($_POST["kitapyayin"])) || !ctype_digit($_POST["kitapkategori"])) {
            hata();
        }
        $true = "Kitap başarıyla Eklendi!";
        $false = "Kitap eklenirken bir hata oluştu!";
        $sql = "INSERT INTO kitap (kitapad,kategori_id,yazar,yayinevi) VALUES (?,?,?,?)";
        $params = [$_POST["kitapad"], $_POST["kitapkategori"], $_POST["kitapyazar"], $_POST["kitapyayin"]];
        islem($sql, $params, "siss", $_SESSION["url"], $true, $false);
    } else if (isset($_POST["kitapsil"])) {
        if (!ctype_digit($_POST["guncelkategoriid"])) {
            hatajson();
        }
        $true = "Kitap başarıyla silindi!";
        $false = "Kitap silinirken bir hata oluştu!";
        $sql = "DELETE FROM kitap WHERE id = ?";
        $params = [$_POST["kitapsil"]];
        sil($sql, $params, "i", $true, $false);
    } else if (isset($_POST["guncelkitapad"])) {
        if (empty(trim($_POST["guncelkitapad"])) || empty(trim($_POST["guncelkitapyaz"])) || empty(trim($_POST["guncelkitapyay"])) || !ctype_digit($_POST["guncelkitapkat"]) || !ctype_digit($_POST["guncelkitapid"])) {
            hata();
        }
        $true = "Kitap başarıyla güncellendi!";
        $false = "Kitap güncellenirken bir hata oluştu!";
        $sql = "UPDATE kitap SET kitapad = ?, kategori_id = ?, yazar= ? , yayinevi= ? WHERE id = ?";
        $params = [$_POST["guncelkitapad"], $_POST["guncelkitapkat"], $_POST["guncelkitapyaz"], $_POST["guncelkitapyay"], $_POST["guncelkitapid"]];
        islem($sql, $params, "sissi", $_SESSION["url"], $true, $false);
    }



    // firma işlemleri
    else if (isset($_POST["firmaad"])) {
        if (empty(trim($_POST["firmaad"])) ) {
            hata();
          }
        $true = "Firma başarıyla Eklendi!";
        $false = "Firma eklenirken bir hata oluştu!";
        $sql = "INSERT INTO firma (firma_ad) VALUES (?)";
        $params = [$_POST["firmaad"]];
        islem($sql, $params, "s", $_SESSION["url"], $true, $false);
    } else if (isset($_POST["guncelfirmaad"],$_POST["guncelfirmaid"])) {
        if (empty(trim($_POST["guncelfirmaad"])) || !ctype_digit($_POST["guncelfirmaid"])) {
            hata();
        }
        $true = "Firma başarıyla güncellendi!";
        $false = "Firma güncellenirken bir hata oluştu!";
        $sql = "UPDATE firma SET firma_ad = ? WHERE id = ?";
        $params = [$_POST["guncelfirmaad"], $_POST["guncelfirmaid"]];
        islem($sql, $params, "si", $_SESSION["url"], $true, $false);
    } else if (isset($_POST["firmasil"])) {
        if (!ctype_digit($_POST["firmasil"])) {
           hatajson();
        }
        $sql = "SELECT * FROM fiyat  WHERE firma_id=" . $_POST["firmasil"];
        $result = $conn->query($sql);
        if ($result->num_rows < 1) {
            $true = "Firma başarıyla silindi!";
            $false = "Firma silinirken bir hata oluştu!";
            $sql = "DELETE FROM firma WHERE id = ?";
            $params = [$_POST["firmasil"]];
            sil($sql, $params, "i", $true, $false);
        }
        else {
            echo json_encode(["message_type" => "basarisiz",
            "message" => "Firmaya ait kayıtlı Kitap fiyat bilgisi mevcut<hr>.<br>Firma silinemez"]);
            exit;
        }
    }



    // fiyat işlemleri \\ 
    else if (isset($_POST["fiyat"],$_POST["fiyatfirma"],$_POST["fiyatkitap"])) {
        if (!ctype_digit($_POST["fiyatfirma"]) || !ctype_digit($_POST["fiyatkitap"]) || !ctype_digit($_POST["fiyat"])) {
            hata();
        }
        $sql = "SELECT * FROM fiyat 
        WHERE firma_id=" . $_POST["fiyatfirma"] . " AND kitap_id=" . $_POST["fiyatkitap"];
        $result = $conn->query($sql);
        if ($result->num_rows != 1) {
            $true = "Fiyat başarıyla Eklendi!";
            $false = "Fiyat eklenirken bir hata oluştu!";
            $sql = "INSERT INTO fiyat (kitap_id,firma_id,fiyat) VALUES (?,?,?)";
            $params = [$_POST["fiyatkitap"], $_POST["fiyatfirma"], $_POST["fiyat"]];
            islem($sql, $params, "iii", $_SESSION["url"], $true, $false);
        } else {
            header("Location:" . $_SESSION["url"]);
            $_SESSION["message"] = "Firmaya ait kitap fiyat bilgisi mevcut";
            $_SESSION["message_type"] = "basarisiz";
        }
    } else if (isset($_POST["guncelfiyatid"],$_POST["guncelfiyatfir"],$_POST["guncelfiyatkit"],$_POST["guncelfiyatf"])) {
        if (!ctype_digit($_POST["guncelfiyatfir"]) || !ctype_digit($_POST["guncalfiyatkit"]) || !ctype_digit($_POST["guncelfiyatid"])|| !ctype_digit($_POST["guncelfiyatf"])) {
            hata();
        }
        $sql = "SELECT * FROM fiyat 
        WHERE firma_id=" . $_POST["guncelfiyatfir"] . " AND kitap_id=" . $_POST["guncelfiyatkit"] . " AND id != " . $_POST["guncelfiyatid"];
        $result = $conn->query($sql);
        if ($result->num_rows != 1) {
            $true = "Fiyat başarıyla güncellendi!";
            $false = "Fiyat güncellenirken bir hata oluştu!";
            $sql = "UPDATE fiyat SET kitap_id = ?,firma_id = ?,fiyat = ? WHERE id = ?";
            $params = [$_POST["guncelfiyatkit"], $_POST["guncelfiyatfir"], $_POST["guncelfiyatf"], $_POST["guncelfiyatid"]];
            islem($sql, $params, "iiii", $_SESSION["url"], $true, $false);
        } else {
            header("Location:" . $_SESSION["url"]);
            $_SESSION["message"] = "Firmaya ait kitap fiyat bilgisi mevcut";
            $_SESSION["message_type"] = "basarisiz";
        }
    } else if (isset($_POST["fiyatsil"])) {
        if (!ctype_digit($_POST["fiyatsil"])) {
            hatajson();
         }
        $true = "Fiyat başarıyla silindi!";
        $false = "Fiyat silinirken bir hata oluştu!";
        $sql = "DELETE FROM fiyat WHERE id = ?";
        $params = [$_POST["fiyatsil"]];
        sil($sql, $params, "i", $true, $false);
    }



    //Gerekli veri gelmiyorsa çalışıcak kısım
    else {
        $_SESSION["message"] = "Veri gönderimi Hatalı";
        $_SESSION["message_type"] = "basarisiz";
        header("Location:" . $_SESSION["url"]);
    }
}
