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
    background: #f4f7fa;
    color: #1e1e2f;
    margin: 0;
}

.sidebar {
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #0f1c4d, #1e3c72);
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
    color: #ffffff;
    text-align: center;
    margin-bottom: 30px;
    font-size: 22px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding-bottom: 15px;
}

.sidebar a {
    color: #cfd8ff;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
    font-weight: 500;
}

.sidebar a i {
    margin-right: 12px;
    width: 20px;
    text-align: center;
    font-size: 16px;
}

.sidebar a:hover,
.sidebar a.active {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    transform: scale(1.02);
}

.sidebar a.text-danger {
    color: #ff4d4d !important;
    margin-top: auto;
}

.content {
    margin-left: 260px;
    padding: 50px;
    min-height: 100vh;
    background: #f9fbfe;
}

.content h3 {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    color: #1e3c72;
    margin-bottom: 30px;
}

.table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
}

.table th {
    background-color: #1e3c72;
    color: #ffffff;
    padding: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    padding: 12px;
    vertical-align: middle;
}

.btn-primary {
    background-color: #1e3c72;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.2s ease;
}

.btn-primary:hover {
    background-color: #3f5ea5;
    color: #fff;
}

.btn-danger {
    background-color: #e74c3c;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    transition: background-color 0.2s ease;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-warning {
    background-color: #f39c12;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    transition: background-color 0.2s ease;
}

.btn-warning:hover {
    background-color: #e67e22;
}

input[type="text"], textarea, input[type="file"], select {
    border-radius: 10px;
    border: 1px solid #ccc;
    padding: 12px;
    width: 100%;
    margin-bottom: 15px;
}

footer {
    margin-top: 60px;
    text-align: center;
    color: #999;
    font-size: 14px;
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
