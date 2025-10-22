<?php
include '../lib/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teks = mysqli_real_escape_string($mysqli, $_POST['teks']);
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    // Direktori penyimpanan gambar
    $uploadDir = 'uploads/';

    // Pindahkan file jika ada gambar diunggah
    if (!empty($gambar)) {
        $uploadPath = $uploadDir . basename($gambar);
        move_uploaded_file($tmp, $uploadPath);
    } else {
        $gambar = ''; // Jika tidak ada gambar
    }

    // Simpan ke database
    $query = "INSERT INTO tb_kate (gambar, teks) VALUES ('$gambar', '$teks')";
    if (mysqli_query($mysqli, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='?page=kategori';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>

<div class="container">
    <h3 class="mb-4">Tambah Kategori Kamar</h3>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="teks" class="form-label">Teks</label>
            <textarea name="teks" id="teks" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="?page=kategori" class="btn btn-secondary">Kembali</a>
    </form>
</div>
