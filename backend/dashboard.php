<?php
session_start();
include '.../lib/koneksi.php';
include '.../cek_login.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">🏨 Admin Hotel</a>
        <div>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">Dashboard</h3>

    <?php
    // Ambil data ringkasan
    $total_kamar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM kamar"))['total'];
    $total_kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM kategori_kamar"))['total'];
    $total_reservasi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservasi"))['total'];
    $pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservasi WHERE status='Menunggu'"))['total'];
    ?>

    <!-- Card Statistik -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white text-center">
                <div class="card-body">
                    <h5>Total Kamar</h5>
                    <h2><?= $total_kamar ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white text-center">
                <div class="card-body">
                    <h5>Kategori Kamar</h5>
                    <h2><?= $total_kategori ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-white text-center">
                <div class="card-body">
                    <h5>Total Reservasi</h5>
                    <h2><?= $total_reservasi ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-danger text-white text-center">
                <div class="card-body">
                    <h5>Menunggu Persetujuan</h5>
                    <h2><?= $pending ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Data reservasi terbaru -->
    <div class="card mt-5 shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Reservasi Terbaru</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tamu</th>
                        <th>Kamar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($conn, "SELECT r.*, k.nomor_kamar 
                        FROM reservasi r 
                        LEFT JOIN kamar k ON r.id_kamar = k.id 
                        ORDER BY r.id DESC LIMIT 5");
                    if (mysqli_num_rows($data) > 0) {
                        while ($d = mysqli_fetch_assoc($data)) {
                            echo "
                            <tr>
                                <td>{$no}</td>
                                <td>{$d['nama_tamu']}</td>
                                <td>{$d['nomor_kamar']}</td>
                                <td>{$d['tanggal_reservasi']}</td>
                                <td><span class='badge bg-" . 
                                    ($d['status'] == 'Menunggu' ? 'warning' : 'success') . "'>{$d['status']}</span></td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada reservasi</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
