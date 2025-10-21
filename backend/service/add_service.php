<?php
include "../lib/koneksi.php";
if (isset($_POST['simpan'])) {
    $teks = $_POST['teks'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../upload/" . $gambar);

    mysqli_query($koneksi, "INSERT INTO tb_serv (gambar, teks) VALUES ('$gambar', '$teks')");
    header("Location: data.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Service</title>
  <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
  <h1>➕ Tambah Service</h1>
  <form method="post" enctype="multipart/form-data">
    <label>Gambar Service:</label>
    <input type="file" name="gambar" required>
    <label>Deskripsi:</label>
    <textarea name="teks" placeholder="Deskripsi service..." required></textarea>
    <button type="submit" name="simpan">Simpan</button>
  </form>
</div>
</body>
</html>
