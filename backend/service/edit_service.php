<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM service WHERE id_service='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Service</title>
    <link rel="stylesheet" href="../aset/style.css">
</head>
<body>
<div class="container">
    <h1>Edit Service</h1>
    <form method="post">
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br>
        <textarea name="deskripsi" required><?= $data['deskripsi']; ?></textarea><br>
        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $desk = $_POST['deskripsi'];
    mysqli_query($koneksi, "UPDATE service SET nama='$nama', deskripsi='$desk' WHERE id_service='$id'");
    header("Location: index.php");
}
?>
