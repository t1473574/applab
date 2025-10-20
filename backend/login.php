<?php
// login.php
session_start();
require_once 'db.php';

$errors = [];
// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil & bersihkan input
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // validasi sederhana
    if ($email === '') {
        $errors[] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if ($password === '') {
        $errors[] = "Password wajib diisi.";
    }

    if (empty($errors)) {
        // prepared statement: ambil user berdasarkan email
        $stmt = $mysqli->prepare("SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1");
        if (!$stmt) {
            $errors[] = "Query error: " . $mysqli->error;
        } else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                // verifikasi password
                if (password_verify($password, $row['password'])) {
                    // sukses login
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    // redirect ke dashboard atau halaman lain
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $errors[] = "Email atau password salah.";
                }
            } else {
                $errors[] = "Email atau password salah.";
            }
            $stmt->close();
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>
  <style>
    body{font-family:Arial, sans-serif; background:#f2f2f2; display:flex; align-items:center; justify-content:center; height:100vh; margin:0;}
    .card{background:#fff; padding:24px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.08); width:320px;}
    h2{margin:0 0 16px;}
    .input{width:100%; padding:8px 10px; margin:8px 0; box-sizing:border-box;}
    .btn{width:100%; padding:10px; margin-top:8px; cursor:pointer;}
    .errors{background:#ffe6e6; color:#900; padding:8px; border-radius:4px; margin-bottom:8px;}
  </style>
</head>
<body>
  <div class="card">
    <h2>Login</h2>

    <?php if (!empty($errors)): ?>
      <div class="errors">
        <ul style="margin:0;padding-left:18px;">
          <?php foreach ($errors as $e): ?>
            <li><?=htmlspecialchars($e)?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="">
      <label for="email">Email</label><br>
      <input id="email" class="input" type="email" name="email" required value="<?=isset($email) ? htmlspecialchars($email) : ''?>">

      <label for="password">Password</label><br>
      <input id="password" class="input" type="password" name="password" required>

      <button type="submit" class="btn">Login</button>
    </form>

    <p style="font-size:13px;margin-top:12px;color:#555;">
      Belum punya akun? <a href="register.php">Daftar</a> (opsional)
    </p>
  </div>
</body>
</html>
