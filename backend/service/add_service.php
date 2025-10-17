<?php include "../lib/koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Service</title>
    <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
    <h1>Tambah Service</h1>
    <form method="post">
        <input type="text" name="nama" placeholder="Nama Service" required><br>
        <textarea name="deskripsi" placeholder="Deskripsi Service" required></textarea><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $desk = $_POST['deskripsi'];
    mysqli_query($koneksi, "INSERT INTO service (nama, deskripsi) VALUES ('$nama', '$desk')");
    header("Location: index.php");
}
?>
