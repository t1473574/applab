<?php
session_start();
include '../lib/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            background-color: #212529;
            color: #fff;
            position: fixed;
            width: 230px;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ccc;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 230px;
            padding: 20px; 
        }
    </style>
</head>
<body class="bg-light">

<!-- SIDEBAR -->
<div class="sidebar">
    <h5 class="text-center mb-4">🏨 Admin Hotel</h5>
    <a href="?page=dashboard" class="<?= (!isset($_GET['page']) || $_GET['page']=='dashboard') ? 'active' : '' ?>">Dashboard</a>
    <a href="?page=kategori" class="<?= ($_GET['page'] ?? '')=='kategori' ? 'active' : '' ?>">Kategori Kamar</a>
    <a href="?page=kamar" class="<?= ($_GET['page'] ?? '')=='kamar' ? 'active' : '' ?>">Kamar</a>
    <a href="?page=banner" class="<?= ($_GET['page'] ?? '')=='banner' ? 'active' : '' ?>">Banner</a>
    <a href="?page=service" class="<?= ($_GET['page'] ?? '')=='service' ? 'active' : '' ?>">Service</a>

  <?php if (isset($_SESSION['admin_id'])): ?>
    <!-- Kalau SUDAH login -->
    <a href="logout.php" class="text-danger">Logout</a>
  <?php else: ?>
    <!-- Kalau BELUM login -->
    <a href="login.php" class="text-danger">Login</a>
  <?php endif; ?>

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
        include 'kate_kamar/data.php';
        break;

    case 'kategori_add':
        include 'kate_kamar/add.php';
        break;

    case 'kategori_edit':
        include 'kate_kamar/edit.php';
        break;

    case 'kategori_delete':
        include 'kate_kamar/delete.php';
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
