<?php
session_start();
include "../lib/koneksi.php";
if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Banner & Service Hotel</title>
  <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
  <h1>📋 Data Banner & Service Hotel</h1>

  <div class="nav">
    <a href="../dashboard.php">🏠 Dashboard</a>
    <a href="add_banner.php">➕ Tambah Banner</a>
    <a href="add_service.php">➕ Tambah Service</a>
    <a href="../login/logout.php" class="btn-danger">🚪 Logout</a>
  </div>

  <!-- ==================== DATA BANNER ==================== -->
  <h2>📸 Data Banner</h2>
  <table>
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $banner = mysqli_query($conn, "SELECT * FROM banner ORDER BY id_banner DESC");
    if (mysqli_num_rows($banner) > 0) {
        while ($r = mysqli_fetch_assoc($banner)) {
            echo "
            <tr>
              <td>$no</td>
              <td>".htmlspecialchars($r['judul'])."</td>
              <td><img src='../upload/".htmlspecialchars($r['gambar'])."' width='120'></td>
              <td>
                <a href='edit_banner.php?id={$r['id_banner']}'>✏️ Edit</a>
                <a href='delete_banner.php?id={$r['id_banner']}' class='btn-danger' onclick=\"return confirm('Hapus banner ini?')\">🗑️ Hapus</a>
              </td>
            </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='4' class='center'>Belum ada data banner</td></tr>";
    }
    ?>
  </table>

  <!-- ==================== DATA SERVICE ==================== -->
  <h2 style="margin-top:40px;">🧾 Data Service</h2>
  <table>
    <tr>
      <th>No</th>
      <th>Nama Service</th>
      <th>Deskripsi</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no2 = 1;
    $service = mysqli_query($conn, "SELECT * FROM service ORDER BY id_service DESC");
    if (mysqli_num_rows($service) > 0) {
        while ($s = mysqli_fetch_assoc($service)) {
            echo "
            <tr>
              <td>$no2</td>
              <td>".htmlspecialchars($s['nama'])."</td>
              <td>".htmlspecialchars($s['deskripsi'])."</td>
              <td>
                <a href='edit_service.php?id={$s['id_service']}'>✏️ Edit</a>
                <a href='delete_service.php?id={$s['id_service']}' class='btn-danger' onclick=\"return confirm('Hapus service ini?')\">🗑️ Hapus</a>
              </td>
            </tr>";
            $no2++;
        }
    } else {
        echo "<tr><td colspan='4' class='center'>Belum ada data service</td></tr>";
    }
    ?>
  </table>

  <footer>
    <p>© 2025 Backend Hotel — Estetik & Responsif</p>
  </footer>
</div>
</body>
</html>
