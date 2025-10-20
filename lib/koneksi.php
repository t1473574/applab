<?php
// koneksi.php

$host = "localhost";
$user = "root"; // default user AppServ
$pass = "";     // password kosong (jika tidak diubah)
$db   = "applab"; // ganti dengan nama database kamu

// buat koneksi
$mysqli = new mysqli($host, $user, $pass, $db);

// cek koneksi
if ($mysqli->connect_errno) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}
?>
