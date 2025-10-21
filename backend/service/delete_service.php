<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tb_serv WHERE id_serv='$id'");
header("Location: data.php");
?>
