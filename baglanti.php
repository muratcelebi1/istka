<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istka";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, fname, lname FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
  echo "<tr><th style='border: 1px solid black; padding: 8px;'>ID</th><th style='border: 1px solid black; padding: 8px;'>Name</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td style='border: 1px solid black; padding: 8px;'>".$row["id"]."</td><td style='border: 1px solid black; padding: 8px;'>".$row["fname"]." ".$row["lname"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>
