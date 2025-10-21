<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tb_banner WHERE id_banner='$id'");
header("Location: data.php");
?>
