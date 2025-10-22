<?php
include '../lib/koneksi.php';

// Proses simpan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kamar = $_POST['nama_kamar'];
    $id_kate = $_POST['id_kate'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $status = $_POST['status'];
    $gambar = '';

    // Proses upload gambar
    if ($_FILES['gambar']['name'] != '') {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $filename = 'kamar_' . time() . '.' . $ext;
        $upload_path = 'uploads/' . $filename;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_path)) {
            $gambar = $filename;
        } else {
            echo "<div class='alert alert-danger'>Upload gambar gagal.</div>";
        }
    }

    // Simpan ke database
    $query = "INSERT INTO tb_kamar (nama_kamar, id_kate, harga, fasilitas, status, gambar)
              VALUES ('$nama_kamar', '$id_kate', '$harga', '$fasilitas', '$status', '$gambar')";

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo "<script>alert('Data berhasil ditambahkan!'); location.href='?page=kamar';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan data: " . mysqli_error($mysqli) . "</div>";
    }
}
?>

<div class="container">
    <h3 class="mb-4">Tambah Kamar</h3>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama Kamar</label>
            <input type="text" name="nama_kamar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori Kamar</label>
            <select name="id_kate" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php
                $kate = mysqli_query($mysqli, "SELECT * FROM tb_kate ORDER BY teks ASC");
                while ($row = mysqli_fetch_assoc($kate)) {
                    echo "<option value='{$row['id_kate']}'>{$row['teks']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fasilitas</label>
            <textarea name="fasilitas" class="form-control" rows="4" placeholder="Pisahkan dengan koma" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Terisi">Terisi</option>
                <option value="Booking">Booking</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" accept="image/*" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="?page=kamar" class="btn btn-secondary">Kembali</a>
    </form>
</div>
