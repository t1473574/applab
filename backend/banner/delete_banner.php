<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM banner WHERE id_banner='$id'");
header("Location: index.php");
?>
