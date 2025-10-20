<?php include "../lib/koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Banner</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Data Banner</h1>
    <a href="add_banner.php">Tambah Banner</a>
    <table>
        <tr><th>ID</th><th>Judul</th><th>Gambar</th><th>Aksi</th></tr>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM banner");
        while ($row = mysqli_fetch_array($query)) {
            echo "<tr>
                <td>{$row['id_banner']}</td>
                <td>{$row['judul']}</td>
                <td><img src='../upload/{$row['gambar']}' width='100'></td>
                <td>
                    <a href='edit_banner.php?id={$row['id_banner']}'>Edit</a>
                    <a href='delete_banner.php?id={$row['id_banner']}'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
