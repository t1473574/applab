<?php
session_start();
include '../lib/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            background-color: #212529;
            color: #fff;
            position: fixed;
            width: 230px;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ccc;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 230px;
            padding: 20px;
        }
    </style>
</head>
<body class="bg-light">

<!-- SIDEBAR -->
<div class="sidebar">
    <h5 class="text-center mb-4">🏨 Admin Hotel</h5>
    <a href="?page=dashboard" class="<?= (!isset($_GET['page']) || $_GET['page']=='dashboard')?'active':'' ?>">Dashboard</a>
    <a href="?page=kategori" class="<?= ($_GET['page'] ?? '')=='kategori'?'active':'' ?>">Kategori Kamar</a>
    <a href="?page=kamar" class="<?= ($_GET['page'] ?? '')=='kamar'?'active':'' ?>">Kamar</a>
    <a href="?page=banner" class="<?= ($_GET['page'] ?? '')=='banner'?'active':'' ?>">Banner</a>
    <a href="?page=service" class="<?= ($_GET['page'] ?? '')=='service'?'active':'' ?>">Service</a>
    <a href="logout.php" class="text-danger">Logout</a>
</div>

<!-- CONTENT -->
<div class="content">
    <?php
    $page = $_GET['page'] ?? 'dashboard';

    switch ($page) {

        // ================= DASHBOARD =================
        case 'dashboard':
            echo "<h4 class='fw-semibold'>Hai, Admin 👋</h4>";
            echo "<p class='text-muted'>Selamat datang di panel pengelolaan hotel.</p>";

            $total_kamar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM kamar"))['total'];
            $total_kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM kategori_kamar"))['total'];
            $total_reservasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservasi"))['total'];
            $pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservasi WHERE status='Menunggu'"))['total'];

            echo "
            <div class='row g-3'>
                <div class='col-md-3'><div class='card border-0 shadow-sm text-center p-3'><h6>Kamar</h6><h3>{$total_kamar}</h3></div></div>
                <div class='col-md-3'><div class='card border-0 shadow-sm text-center p-3'><h6>Kategori</h6><h3>{$total_kategori}</h3></div></div>
                <div class='col-md-3'><div class='card border-0 shadow-sm text-center p-3'><h6>Reservasi</h6><h3>{$total_reservasi}</h3></div></div>
                <div class='col-md-3'><div class='card border-0 shadow-sm text-center p-3'><h6>Menunggu</h6><h3 class=\"text-warning\">{$pending}</h3></div></div>
            </div>
            ";

            echo "<div class='card mt-4 shadow-sm'>
                    <div class='card-header bg-white'><strong>Reservasi Terbaru</strong></div>
                    <div class='card-body'>
                        <table class='table table-hover table-sm'>
                            <thead><tr><th>No</th><th>Nama Tamu</th><th>Kamar</th><th>Tanggal</th><th>Status</th></tr></thead><tbody>";

            $no = 1;
            $data = mysqli_query($conn, "SELECT r.*, k.nomor_kamar 
                FROM reservasi r 
                LEFT JOIN kamar k ON r.id_kamar = k.id 
                ORDER BY r.id DESC LIMIT 5");
            if (mysqli_num_rows($data) > 0) {
                while ($d = mysqli_fetch_assoc($data)) {
                    $badge = ($d['status'] == 'Menunggu') ? 'bg-warning' : 'bg-success';
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$d['nama_tamu']}</td>
                            <td>{$d['nomor_kamar']}</td>
                            <td>{$d['tanggal_reservasi']}</td>
                            <td><span class='badge {$badge}'>{$d['status']}</span></td>
                          </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada reservasi</td></tr>";
            }

            echo "</tbody></table></div></div>";
        break;

        // ================= KATEGORI KAMAR =================
        case 'kategori':
            echo "<h4>Kategori Kamar</h4>";
            echo "<a href='#' class='btn btn-primary btn-sm mb-3'>+ Tambah Kategori</a>";
            $kategori = mysqli_query($conn, "SELECT * FROM kategori_kamar ORDER BY id DESC");
            echo "<table class='table table-bordered table-sm'><tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr>";
            $no = 1;
            while ($row = mysqli_fetch_assoc($kategori)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>
                            <a href='#' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='#' class='btn btn-danger btn-sm'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            echo "</table>";
        break;

        // ================= KAMAR =================
        case 'kamar':
            echo "<h4>Data Kamar</h4>";
            echo "<a href='#' class='btn btn-primary btn-sm mb-3'>+ Tambah Kamar</a>";
            $kamar = mysqli_query($conn, "SELECT k.*, kk.nama_kategori 
                    FROM kamar k 
                    LEFT JOIN kategori_kamar kk ON k.id_kategori = kk.id 
                    ORDER BY k.id DESC");
            echo "<table class='table table-bordered table-sm'><tr><th>No</th><th>Nomor</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>";
            $no = 1;
            while ($row = mysqli_fetch_assoc($kamar)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nomor_kamar']}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <a href='#' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='#' class='btn btn-danger btn-sm'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            echo "</table>";
        break;

        // ================= BANNER =================
        case 'banner':
            echo "<h4>Banner</h4>";
            echo "<a href='#' class='btn btn-primary btn-sm mb-3'>+ Tambah Banner</a>";
            echo "<table class='table table-bordered table-sm'>
                    <tr><th>No</th><th>Judul</th><th>Gambar</th><th>Aksi</th></tr>
                    <tr><td>1</td><td>Promo Akhir Tahun</td><td><img src='banner.jpg' width='80'></td>
                        <td><a href='#' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='#' class='btn btn-danger btn-sm'>Hapus</a></td></tr>
                  </table>";
        break;

        // ================= SERVICE =================
        case 'service':
            echo "<h4>Service Hotel</h4>";
            echo "<a href='#' class='btn btn-primary btn-sm mb-3'>+ Tambah Service</a>";
            echo "<table class='table table-bordered table-sm'>
                    <tr><th>No</th><th>Nama Layanan</th><th>Deskripsi</th><th>Aksi</th></tr>
                    <tr><td>1</td><td>Room Cleaning</td><td>Layanan kebersihan kamar harian</td>
                        <td><a href='#' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='#' class='btn btn-danger btn-sm'>Hapus</a></td></tr>
                  </table>";
        break;

        default:
            echo "<h4>Halaman tidak ditemukan</h4>";
        break;
    }
    ?>
</div>

</body>
</html>
