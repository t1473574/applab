<?php
$host = "localhost";
$user = "root"; // default user AppServ
$pass = "tia12345";     // password kosong (jika tidak diubah)
$db   = "db_hotel"; // ganti dengan nama database kamu
// buat koneksi
$mysqli = new mysqli($host, $user, $pass, $db);

// cek koneksi
if ($mysqli->connect_errno) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
?>

