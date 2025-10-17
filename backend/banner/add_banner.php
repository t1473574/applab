<?php include "../lib/koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Banner</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Tambah Banner</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul Banner" required><br>
        <input type="file" name="gambar" required><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../upload/" . $gambar);
    mysqli_query($conn, "INSERT INTO banner (judul, gambar) VALUES ('$judul', '$gambar')");
    header("Location: index.php");
}
?>
