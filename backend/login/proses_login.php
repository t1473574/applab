<?php
session_start();
include "../lib/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_array($query);

if ($data) {
    $_SESSION['username'] = $data['username'];
    header("Location: ../dashboard.php");
} else {
    echo "<script>alert('Login gagal!'); window.location='index.php';</script>";
}
?>
