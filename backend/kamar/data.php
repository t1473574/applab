<?php
include '../lib/koneksi.php';

// Join dengan kategori kamar
$query = "SELECT k.*, kate.teks
          FROM tb_kamar k
          JOIN tb_kate kate ON k.id_kate = kate.id_kate
          ORDER BY k.id_kamar DESC";

$result = mysqli_query($mysqli, $query);
?>

<div class="container">
    <h3 class="mb-4">Data Kamar</h3>

    <a href="?page=kamar_add" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Kamar
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Kamar</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Fasilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td><img src='uploads/{$row['gambar']}' width='100' alt='Gambar Kamar'></td>";
                        echo "<td>" . htmlspecialchars($row['nama_kamar']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['teks']) . "</td>";
                        echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td><span class='badge bg-" . 
                            ($row['status'] == 'Tersedia' ? 'success' : ($row['status'] == 'Booking' ? 'warning' : 'secondary')) . "'>" . $row['status'] . "</span></td>";
                        echo "<td>" . nl2br(htmlspecialchars($row['fasilitas'])) . "</td>";
                        echo "<td>
                                <a href='?page=kamar_edit&id={$row['id_kamar']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
                                <a href='?page=kamar_delete&id={$row['id_kamar']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus kamar ini?');\"><i class='fas fa-trash'></i></a>
                              </td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Belum ada data kamar</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
