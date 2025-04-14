<?php
$host = "localhost";
$user = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "coffe_bun";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>