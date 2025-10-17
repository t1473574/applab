<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM service WHERE id_service='$id'");
header("Location: index.php");
?>
