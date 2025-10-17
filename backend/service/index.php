<?php
session_start();
include "../lib/koneksi.php";

// Jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Service - Admin Hotel</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Manajemen Service Hotel</h1>
    <a href="../dashboard.php">🏠 Kembali ke Dashboard</a> |
    <a href="add_service.php">➕ Tambah Service</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Service</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM service ORDER BY id_service DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>
                            <a href='edit_service.php?id={$row['id_service']}'>✏️ Edit</a>
                            <a href='delete_service.php?id={$row['id_service']}' onclick=\"return confirm('Hapus service ini?')\">🗑️ Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>Belum ada data service.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
