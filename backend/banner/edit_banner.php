<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_banner WHERE id_banner='$id'"));

if (isset($_POST['update'])) {
    $teks = $_POST['teks'];
    $gambarLama = $data['gambar'];

    if ($_FILES['gambar']['name']) {
        $gambarBaru = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../upload/" . $gambarBaru);
    } else {
        $gambarBaru = $gambarLama;
    }

    mysqli_query($koneksi, "UPDATE tb_banner SET gambar='$gambarBaru', teks='$teks' WHERE id_banner='$id'");
    header("Location: data.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Banner</title>
  <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
  <h1>✏️ Edit Banner</h1>
  <form method="post" enctype="multipart/form-data">
    <label>Gambar Sekarang:</label><br>
    <img src="../upload/<?= htmlspecialchars($data['gambar']) ?>" width="200"><br><br>
    <input type="file" name="gambar">
    <label>Teks Banner:</label>
    <textarea name="teks" required><?= htmlspecialchars($data['teks']) ?></textarea>
    <button type="submit" name="update">Perbarui</button>
  </form>
</div>
</body>
</html>
