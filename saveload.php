<?php
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_db_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $maxHealth = $_POST['maxHealth'];
  $currentHealth = $_POST['currentHealth'];
  $exp = $_POST['exp'];
  $level = $_POST['level'];

  $sql = "INSERT INTO GameData (maxHealth, currentHealth, exp, level)
  VALUES ('$maxHealth', '$currentHealth', '$exp', '$level')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $sql = "SELECT maxHealth, currentHealth, exp, level FROM GameData";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "maxHealth: " . $row["maxHealth"]. " - currentHealth: " . $row["currentHealth"]. " - exp: " . $row["exp"]. " - level: " . $row["level"]. "<br>";
    }
  } else {
    echo "0 results";
  }
}

$conn->close();
?>

