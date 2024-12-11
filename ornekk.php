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

    $id = 5;

    // Güncelleme sorgusu
    $query = "UPDATE istka SET firstname='franks' WHERE id=:id";
    // $conn->exec($query);  update ,delete,inserti bu şekilde calıştırabiliyoruz.
    $stmt = $conn->prepare($query);

    // Parametreyi bağla ve sorguyu çalıştır
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $query = "SELECT * FROM istka WHERE id=:id";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Veriyi al
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Sonuçları yazdır
    if ($result) {
        echo "Güncellenen Veri: <br>";
        echo "ID: " . $result['id'] . "<br>";
        echo "Firstname: " . $result['firstname'] . "<br>";
        echo "Lastname: " . $result['lastname'] . "<br>";
        echo "Created At: " . $result['created_at'] . "<br>";
        echo var_dump($result);
    } else {
        echo "Veri bulunamadı.";
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;


?>