<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'latihan_php';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();
?>