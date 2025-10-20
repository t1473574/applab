<?php
include "../lib/koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM banner WHERE id_banner='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Banner</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Edit Banner</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="judul" value="<?= $data['judul']; ?>" required><br>
        <img src="../upload/<?= $data['gambar']; ?>" width="150"><br>
        <input type="file" name="gambar"><br>
        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../upload/" . $gambar);
        mysqli_query($conn, "UPDATE banner SET judul='$judul', gambar='$gambar' WHERE id_banner='$id'");
    } else {
        mysqli_query($conn, "UPDATE banner SET judul='$judul' WHERE id_banner='$id'");
    }
    header("Location: index.php");
}
?>
