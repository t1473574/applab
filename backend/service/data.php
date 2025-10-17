<?php
include "../lib/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Service</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Data Service</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Service</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM service ORDER BY id_service DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['deskripsi']}</td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='3' style='text-align:center;'>Belum ada data service</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
