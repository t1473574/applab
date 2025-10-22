<?php
session_start();
include '../lib/koneksi.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background: #f3f4f6;
    color: #1f1f1f;
    margin: 0;
}

.sidebar {
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #0b1d3a, #132c4f);
    position: fixed;
    left: 0;
    top: 0;
    padding: 30px 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 12px rgba(0,0,0,0.2);
    z-index: 100;
}

.sidebar h5 {
    font-family: 'Playfair Display', serif;
    color: #eab543;
    text-align: center;
    margin-bottom: 30px;
    font-size: 22px;
}

.sidebar a {
    color: #dcdcdc;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.sidebar a i {
    margin-right: 12px;
    width: 20px;
    text-align: center;
}

.sidebar a:hover,
.sidebar a.active {
    background: rgba(234, 181, 67, 0.15);
    color: #eab543;
}

.content {
    margin-left: 260px;
    padding: 50px;
    min-height: 100vh;
    background: #fefefe;
}

.content h3 {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    color: #0b1d3a;
    margin-bottom: 30px;
}

.table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
}

.table th {
    background-color: #0b1d3a;
    color: #eab543;
    padding: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    padding: 12px;
    vertical-align: middle;
}

.btn-primary {
    background-color: #0b1d3a;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
}

.btn-primary:hover {
    background-color: #eab543;
    color: #0b1d3a;
}

.btn-danger {
    background-color: #c0392b;
    border: none;
    border-radius: 8px;
}

.btn-danger:hover {
    background-color: #e74c3c;
}

.btn-warning {
    background-color: #f39c12;
    border: none;
    border-radius: 8px;
}

.btn-warning:hover {
    background-color: #e67e22;
}

input[type="text"], textarea, input[type="file"] {
    border-radius: 10px;
    border: 1px solid #ccc;
    padding: 12px;
}

footer {
    margin-top: 60px;
    text-align: center;
    color: #999;
}

</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h5 class="text-center mb-4">🏨 Admin Hotel</h5>
<a href="?page=dashboard" class="<?= (!isset($_GET['page']) || $_GET['page']=='dashboard') ? 'active' : '' ?>">
  <i class="fas fa-home"></i> Dashboard
</a>
<a href="?page=kategori" class="<?= ($_GET['page'] ?? '')=='kategori' ? 'active' : '' ?>">
  <i class="fas fa-list-ul"></i> Kategori Kamar
</a>
<a href="?page=kamar" class="<?= ($_GET['page'] ?? '')=='kamar' ? 'active' : '' ?>">
  <i class="fas fa-bed"></i> Kamar
</a>
<a href="?page=banner" class="<?= ($_GET['page'] ?? '')=='banner' ? 'active' : '' ?>">
  <i class="fas fa-image"></i> Banner
</a>
<a href="?page=service" class="<?= ($_GET['page'] ?? '')=='service' ? 'active' : '' ?>">
  <i class="fas fa-concierge-bell"></i> Service
</a>
<a href="logout.php" class="text-danger mt-auto">
  <i class="fas fa-sign-out-alt"></i> Logout
</a>


</div>

<!-- CONTENT -->
<div class="content">
<?php
$page = $_GET['page'] ?? 'dashboard';

switch ($page) {
    case 'dashboard':
        include 'dashboard.php';
        break;

    case 'kategori':
        include 'kateKamar/data.php';
        break;

    case 'kategori_add':
        include 'kateKamar/add.php';
        break;

    case 'kategori_edit':
        include 'kateKamar/edit.php';
        break;

    case 'kategori_delete':
        include 'kateKamar/delete.php';
        break;

    case 'kamar':
        include 'kamar/data.php';
        break;

    case 'kamar_add':
        include 'kamar/add.php';
        break;

    case 'kamar_edit':
        include 'kamar/edit.php';
        break;

    case 'kamar_delete':
        include 'kamar/del.php';
        break;

    case 'banner':
        include 'banner/data.php';
        break;

    case 'banner_add':
        include 'banner/add_banner.php';
        break;

    case 'banner_del':
        include 'banner/delete_banner.php';
        break;

    case 'banner_edit':
        include 'banner/edit_banner.php';
        break;

    case 'service':
        include 'service/data.php';
        break;

    case 'service_add':
        include 'service/add_service.php';
        break;

    case 'service_del':
        include 'service/delete_service.php';
        break;

    case 'service_edit':
        include 'service/edit_service.php';
        break;

    default:
        echo "<h4>Halaman tidak ditemukan 😅</h4>";
        break;
}
?>
</div>

</body>
</html>
