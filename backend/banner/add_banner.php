<?php
include "../lib/koneksi.php";
if (isset($_POST['simpan'])) {
    $teks = $_POST['teks'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../upload/" . $gambar);

    mysqli_query($koneksi, "INSERT INTO tb_banner (gambar, teks) VALUES ('$gambar', '$teks')");
    header("Location: data.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Banner</title>
  <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
  <h1>➕ Tambah Banner</h1>
  <form method="post" enctype="multipart/form-data">
    <label>Gambar Banner:</label>
    <input type="file" name="gambar" required>
    <label>Teks Banner:</label>
    <textarea name="teks" placeholder="Teks banner..." required></textarea>
    <button type="submit" name="simpan">Simpan</button>
  </form>
</div>
</body>
</html>
