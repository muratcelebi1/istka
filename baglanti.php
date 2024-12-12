<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istka";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}
echo "Database bağlanıldı";
$sql = "SELECT id, fname, lname FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<br> Görüntülenicek veri mevcut.<br>";
  echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
  echo "<tr><th style='border: 1px solid black; padding: 8px;'>ID</th><th style='border: 1px solid black; padding: 8px;'>Name</th></tr>";
 
  while($row = $result->fetch_assoc()) {
    echo "<tr><td style='border: 1px solid black; padding: 8px;'>".$row["id"]."</td><td style='border: 1px solid black; padding: 8px;'>".$row["fname"]." ".$row["lname"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 sonuç";
}
$conn->close();

?>
