<?php
include '../lib/koneksi.php';

// Ambil data dari tabel tb_kate
$query = "SELECT * FROM tb_kate ORDER BY id_kate DESC";
$result = mysqli_query($mysqli, $query);
?>

<div class="container">
    <h3 class="mb-4">Data Kategori Kamar</h3>

    <a href="?page=kategori_add" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Kategori</th>
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
                        echo "<td><img src='uploads/{$row['gambar']}' width='100' alt='Gambar Kategori'></td>";
                        echo "<td>" . htmlspecialchars($row['teks']) . "</td>";
                        echo "<td>
                                <a href='?page=kategori_edit&id={$row['id_kate']}' class='btn btn-warning btn-sm'>
                                    <i class='fas fa-edit'></i>
                                </a>
                                <a href='?page=kategori_delete&id={$row['id_kate']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus kategori ini?');\">
                                    <i class='fas fa-trash'></i>
                                </a>
                              </td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Belum ada data kategori</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
