<?php
include '../lib/koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Ambil data lama
    $query = "SELECT * FROM tb_kate WHERE id_kate = '$id'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Handle form submit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teks = mysqli_real_escape_string($mysqli, $_POST['teks']);
            $gambarBaru = $_FILES['gambar']['name'];
            $tmp = $_FILES['gambar']['tmp_name'];
            $gambarLama = $data['gambar'];

            if (!empty($gambarBaru)) {
                // Ganti gambar lama
                $uploadPath = 'uploads/' . basename($gambarBaru);

                if (move_uploaded_file($tmp, $uploadPath)) {
                    // Hapus gambar lama
                    if (!empty($gambarLama) && file_exists("uploads/$gambarLama")) {
                        unlink("uploads/$gambarLama");
                    }
                    $gambarFinal = $gambarBaru;
                } else {
                    $gambarFinal = $gambarLama; // gagal upload, pakai lama
                }
            } else {
                $gambarFinal = $gambarLama; // tidak ada upload baru
            }

            // Update data
            $queryUpdate = "UPDATE tb_kate SET gambar = '$gambarFinal', teks = '$teks' WHERE id_kate = '$id'";
            if (mysqli_query($mysqli, $queryUpdate)) {
                echo "<script>alert('Data berhasil diperbarui'); window.location='?page=kategori';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data');</script>";
            }
        }
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='?page=kategori';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak valid'); window.location='?page=kategori';</script>";
    exit;
}
?>

<div class="container">
    <h3 class="mb-4">Edit Kategori Kamar</h3>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Sekarang</label><br>
            <img src="uploads/<?php echo $data['gambar']; ?>" alt="Gambar" width="150">
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label for="teks" class="form-label">Teks</label>
            <textarea name="teks" id="teks" class="form-control" rows="4" required><?php echo htmlspecialchars($data['teks']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="?page=kategori" class="btn btn-secondary">Kembali</a>
    </form>
</div>
