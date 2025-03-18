<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Erronka3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error);
}
?>