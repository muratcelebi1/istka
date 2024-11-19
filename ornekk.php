<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istka";

try {
    // PDO bağlantısı kur
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!$conn) {
        die("Bağlantı hatası");
    }
    

    // // Geçerli tarih ve saati al
    // $currentDateTime = date('Y-m-d H:i:s');

    // // SQL sorgusu (tek bir sorgu ile insert işlemi)
    // $sql = "INSERT INTO istka (firstname, lastname, created_at) 
    //         VALUES (:firstname, :lastname, :created_at)";

    // // Sorguyu hazırlayın
    // $stmt = $conn->prepare($sql);

    // // Verileri bind et
    // $stmt->bindParam(':firstname', $firstname);
    // $stmt->bindParam(':lastname', $lastname);
    // $stmt->bindParam(':created_at', $currentDateTime);

    // // İlk veri ekle
    // $firstname = 'John';
    // $lastname = 'Doe';
    // $stmt->execute();

    // // İkinci veri ekle
    // $firstname = 'Mary';
    // $lastname = 'Moe';
    // $stmt->execute();

    // // Üçüncü veri ekle
    // $firstname = 'Julie';
    // $lastname = 'Dooley';
    // $stmt->execute();

    // // Başarılı mesajı
    // echo "New records created successfully";



} catch (PDOException $e) {
    // Hata mesajı
    echo "Error: " . $e->getMessage();
}

// Bağlantıyı kapat
$conn = null;
?>