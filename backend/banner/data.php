<?php
include '../lib/koneksi.php';

// Ambil semua data dari tabel
$query = "SELECT * FROM tb_banner";
$result = mysqli_query($mysqli, $query);
?>

<div class="container">
    <h3 class="mb-4">Data Banner</h3>

    <a href="?page=banner_add" class="btn btn-primary mb-3">+ Tambah Data</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Teks</th>
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
                        echo "<td><img src='uploads/{$row['gambar']}' alt='Gambar' width='100'></td>";
                        echo "<td>" . htmlspecialchars($row['teks']) . "</td>";
                        echo "<td>
                            <a href='?page=kategori_edit&id={$row['id_banner']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='?page=kategori_delete&id={$row['id_banner']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                        </td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Belum ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
