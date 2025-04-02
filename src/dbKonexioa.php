<?php
$servername = "172.16.237.120";
$username = "Erronka";
$password = "Erronka3";
$dbname = "erronka3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konexioak huts egin du: " . $conn->connect_error);
}
?>