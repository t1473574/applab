<?php
include "../lib/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Banner</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Data Banner</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Banner</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM banner ORDER BY id_banner DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>{$row['judul']}</td>
                        <td><img src='../upload/{$row['gambar']}' width='120' style='border-radius:10px;'></td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='3' style='text-align:center;'>Belum ada banner</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
