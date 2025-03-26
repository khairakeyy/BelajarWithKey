<?php
$host = "localhost";
$user = "root";  // Ganti jika pakai user lain
$password = "";  // Ganti sesuai konfigurasi MySQL-mu
$database = "db_bioskop";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
