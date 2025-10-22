<?php
session_start();
include "../lib/koneksi.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Service</title>
  <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
  <h1>📋 Data Service</h1>

  <div class="nav">
    <a href="../login/logout.php" class="btn-danger">🚪 Logout</a>
    <a href="add_banner.php">➕ Tambah Banner</a>
    <a href="add_service.php">➕ Tambah Service</a>
  </div>

  <!-- ======== DATA SERVICE ======== -->
  <h2 style="margin-top:40px;">🧾 Data Service</h2>
  <table>
    <tr><th>No</th><th>Gambar</th><th>Teks</th><th>Aksi</th></tr>
    <?php
    $no2 = 1;
    $service = mysqli_query($koneksi, "SELECT * FROM tb_serv ORDER BY id_serv DESC");
    if (mysqli_num_rows($service) > 0) {
        while ($s = mysqli_fetch_assoc($service)) {
            echo "
            <tr>
              <td>$no2</td>
              <td><img src='../upload/".htmlspecialchars($s['gambar'])."' width='120'></td>
              <td>".htmlspecialchars($s['teks'])."</td>
              <td>
                <a href='edit_service.php?id={$s['id_serv']}'>✏️ Edit</a>
                <a href='delete_service.php?id={$s['id_serv']}' class='btn-danger' onclick=\"return confirm('Hapus service ini?')\">🗑️ Hapus</a>
              </td>
            </tr>";
            $no2++;
        }
    } else {
        echo "<tr><td colspan='4' class='center'>Belum ada data service</td></tr>";
    }
    ?>
  </table>
</div>
</body>
</html>
