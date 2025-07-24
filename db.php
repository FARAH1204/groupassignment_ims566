<?php
// db.php

$host = "localhost";
$user = "root";
$password = ""; // jika ada password, isikan di sini
$dbname = "internmatch2";

// Buat sambungan
$conn = new mysqli($host, $user, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
