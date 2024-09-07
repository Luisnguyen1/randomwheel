<?php 
// $servername = "localhost";
// $username = "hdad8728ce_data";
// $password = "admin1234";
// $dbname = "hdad8728ce_data";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hdad8728ce_data";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection error: " . $conn->connect_error);
}
?>