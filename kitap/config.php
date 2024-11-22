<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitaplar";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kategoriad"])) {
    $kategoriad = $_POST["kategoriad"];
    $sql = "INSERT INTO kategori (kategori_ad) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kategoriad);
    if ($stmt->execute()) {
        echo "Yeni kategori başarıyla eklendi!";
    } else {
        echo "Hata: " . $stmt->error;
    }
    $stmt->close();
};

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kitapad"])) {
    $kitapad = $_POST["kitapad"];
    $kitapkategori = $_POST["kitapkategori"];
    $kitapfiyat = $_POST["kitapfiyat"];
    $sql = "INSERT INTO kitaplar (kitapad,kategori_id,fiyat) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $kitapad, $kitapkategori, $kitapfiyat);
    if ($stmt->execute()) {
        return header("Location: kitapekle.php");
    } else {
        echo "Hata: " . $stmt->error;
    }
    $stmt->close();
};
