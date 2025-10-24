<?php
include '../lib/koneksi.php';

// Hitung jumlah kategori kamar
$qKate = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM tb_kate");
$kate = mysqli_fetch_assoc($qKate)['total'];

// Hitung jumlah kamar
$qKamar = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM tb_kamar");
$kamar = mysqli_fetch_assoc($qKamar)['total'];

// Hitung kamar tersedia
$qTersedia = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM tb_kamar WHERE status = 'Tersedia'");
$tersedia = mysqli_fetch_assoc($qTersedia)['total'];

// Hitung kamar sedang dibooking
$qBooking = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM tb_kamar WHERE status = 'Booking'");
$booking = mysqli_fetch_assoc($qBooking)['total'];
?>

<div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>

    <div class="row g-3">
        <!-- Card Total Kategori -->
        <div class="col-md-3">
            <div class="card text-bg-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-list fa-2x mb-2"></i>
                    <h5 class="card-title">Kategori Kamar</h5>
                    <h3><?= $kate ?></h3>
                </div>
            </div>
        </div>

        <!-- Card Total Kamar -->
        <div class="col-md-3">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-bed fa-2x mb-2"></i>
                    <h5 class="card-title">Total Kamar</h5>
                    <h3><?= $kamar ?></h3>
                </div>
            </div>
        </div>

        <!-- Card Tersedia -->
        <div class="col-md-3">
            <div class="card text-bg-info shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-door-open fa-2x mb-2"></i>
                    <h5 class="card-title">Kamar Tersedia</h5>
                    <h3><?= $tersedia ?></h3>
                </div>
            </div>
        </div>

        <!-- Card Booking -->
        <div class="col-md-3">
            <div class="card text-bg-warning shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-clock fa-2x mb-2"></i>
                    <h5 class="card-title">Sedang Booking</h5>
                    <h3><?= $booking ?></h3>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <!-- Tabel ringkasan kamar -->
    <h4 class="mb-3"><i class="fas fa-bed"></i> Data Kamar Terbaru</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Kamar</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qKamarData = mysqli_query($mysqli, "
                    SELECT k.*, kate.teks 
                    FROM tb_kamar k 
                    JOIN tb_kate kate ON k.id_kate = kate.id_kate 
                    ORDER BY k.id_kamar DESC 
                    LIMIT 5
                ");
                $no = 1;
                if (mysqli_num_rows($qKamarData) > 0) {
                    while ($row = mysqli_fetch_assoc($qKamarData)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td><img src='uploads/{$row['gambar']}' width='80' class='rounded'></td>";
                        echo "<td>" . htmlspecialchars($row['nama_kamar']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['teks']) . "</td>";
                        echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td><span class='badge bg-" . 
                            ($row['status'] == 'Tersedia' ? 'success' : ($row['status'] == 'Booking' ? 'warning' : 'secondary')) . "'>" . 
                            $row['status'] . "</span></td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Belum ada data kamar</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
