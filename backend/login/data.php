<?php
include "../lib/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Admin</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Data Admin</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM admin ORDER BY id_admin DESC");
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='3' style='text-align:center;'>Belum ada admin terdaftar</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
