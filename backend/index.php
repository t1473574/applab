<?php
session_start();
include '../lib/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #2c3e50;
            color: #fff;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            padding-top: 30px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h5 {
            font-weight: bold;
            color: #f1c40f;
        }

        .sidebar a {
            color: #bdc3c7;
            display: block;
            padding: 12px 25px;
            text-decoration: none;
            transition: 0.3s;
            font-size: 15px;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #34495e;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #ffffff, #f3f4f6);
        }

        .navbar-brand {
            font-weight: bold;
        }

        .content h4 {
            margin-bottom: 20px;
        }

        .table th {
            background-color: #34495e;
            color: #fff;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h5 class="text-center mb-4"><i class="fa-solid fa-hotel"></i> Admin Hotel</h5>
    <a href="?page=dashboard" class="<?= (!isset($_GET['page']) || $_GET['page']=='dashboard') ? 'active' : '' ?>">
        <i class="fa-solid fa-chart-line"></i> Dashboard
    </a>
    <a href="?page=kategori" class="<?= ($_GET['page'] ?? '')=='kategori' ? 'active' : '' ?>">
        <i class="fa-solid fa-layer-group"></i> Kategori Kamar
    </a>
    <a href="?page=kamar" class="<?= ($_GET['page'] ?? '')=='kamar' ? 'active' : '' ?>">
        <i class="fa-solid fa-bed"></i> Kamar
    </a>
    <a href="?page=banner" class="<?= ($_GET['page'] ?? '')=='banner' ? 'active' : '' ?>">
        <i class="fa-solid fa-image"></i> Banner
    </a>
    <a href="?page=service" class="<?= ($_GET['page'] ?? '')=='service' ? 'active' : '' ?>">
        <i class="fa-solid fa-concierge-bell"></i> Service
    </a>
    <a href="login.php" class="text-danger">
        <i class="fa-solid fa-sign-out-alt"></i> Logout
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
