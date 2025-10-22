<?php
include '../lib/koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Ambil data dulu untuk mengetahui nama file gambar
    $querySelect = "SELECT gambar FROM tb_kate WHERE id_kate = '$id'";
    $resultSelect = mysqli_query($mysqli, $querySelect);
    
    if (mysqli_num_rows($resultSelect) > 0) {
        $data = mysqli_fetch_assoc($resultSelect);
        $gambar = $data['gambar'];

        // Hapus file gambar dari server
        if (!empty($gambar) && file_exists("uploads/$gambar")) {
            unlink("uploads/$gambar");
        }

        // Hapus data dari database
        $queryDelete = "DELETE FROM tb_kate WHERE id_kate = '$id'";
        if (mysqli_query($mysqli, $queryDelete)) {
            echo "<script>alert('Data berhasil dihapus'); window.location='?page=kategori';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data'); window.location='?page=kategori';</script>";
        }

    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='?page=kategori';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid'); window.location='?page=kategori';</script>";
}
?>
