<?php
include "../lib/koneksi.php";

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Validasi dasar
    if ($email === '' || $password === '' || $confirm === '') {
        $errors[] = "Semua kolom wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    } elseif ($password !== $confirm) {
        $errors[] = "Password dan konfirmasi password tidak cocok.";
    }

    // Cek duplikat email
    if (empty($errors)) {
        $check = $mysqli->prepare("SELECT id_admin FROM tb_admin WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $errors[] = "Email sudah terdaftar, silakan gunakan email lain.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO tb_admin (email, pass) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hash);
            if ($stmt->execute()) {
                $success = "Registrasi berhasil! Silakan <a href='login.php'>login di sini</a>.";
            } else {
                $errors[] = "Terjadi kesalahan saat menyimpan data.";
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Registrasi Admin Hotel</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500&display=swap');

:root {
  --gold: #D4AF37;
  --dark: #1B1B1B;
  --light: #f9f7f3;
  --error-bg: #FDECEC;
  --error-text: #B91C1C;
  --success-bg: #E8F7E9;
  --success-text: #166534;
}

body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  height: 100vh;
  background: linear-gradient(to right, #3e3a32 30%, #2b2b2b);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--light);
}

.bg-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
  filter: brightness(0.45);
  z-index: -1;
}

.card {
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(10px);
  padding: 40px 32px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.3);
  width: 380px;
  text-align: center;
}

h2 {
  font-family: 'Playfair Display', serif;
  color: var(--gold);
  font-size: 28px;
  margin-bottom: 20px;
}

p.subtitle {
  color: #ddd;
  font-size: 14px;
  margin-bottom: 25px;
}

label {
  display: block;
  text-align: left;
  color: #eee;
  margin-top: 10px;
  font-size: 14px;
}

.input {
  width: 100%;
  padding: 10px 12px;
  margin-top: 6px;
  border: 1px solid rgba(255,255,255,0.3);
  border-radius: 8px;
  background: rgba(0,0,0,0.3);
  color: white;
  font-size: 14px;
}

.input:focus {
  outline: none;
  border-color: var(--gold);
}

.btn {
  width: 100%;
  background: var(--gold);
  color: var(--dark);
  border: none;
  padding: 12px;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  margin-top: 18px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn:hover {
  background: #c4a030;
  transform: translateY(-1px);
}

.errors, .success {
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 12px;
  font-size: 14px;
  text-align: left;
}

.errors {
  background: var(--error-bg);
  color: var(--error-text);
}

.success {
  background: var(--success-bg);
  color: var(--success-text);
}

.footer-text {
  font-size: 13px;
  margin-top: 18px;
  color: #ccc;
}

.footer-text a {
  color: var(--gold);
  text-decoration: none;
}

.footer-text a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>
<div class="bg-overlay"></div>

<div class="card">
  <h2>Registrasi Admin Hotel</h2>
  <p class="subtitle">Buat akun untuk mengelola sistem reservasi hotel</p>

  <?php if (!empty($errors)): ?>
  <div class="errors">
    <ul style="margin:0;padding-left:18px;">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <?php if ($success): ?>
  <div class="success"><?= $success ?></div>
  <?php endif; ?>

  <form method="post" action="">
    <label for="email">Email</label>
    <input id="email" class="input" type="email" name="email" required
           value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

    <label for="password">Password</label>
    <input id="password" class="input" type="password" name="password" required>

    <label for="confirm">Konfirmasi Password</label>
    <input id="confirm" class="input" type="password" name="confirm" required>

    <button type="submit" class="btn">Daftar Sekarang</button>
  </form>

  <p class="footer-text">
    Sudah punya akun? <a href="login.php">Login di sini</a>
  </p>
</div>
</body>
</html>
