<?php
session_start();
include "../lib/koneksi.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($email === '') {
        $errors[] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if ($password === '') {
        $errors[] = "Password wajib diisi.";
    }

    if (empty($errors)) {
        // menyesuaikan nama tabel dan kolom: id_admin, email, pass
        $stmt = $mysqli->prepare("SELECT id_admin, email, pass FROM tb_admin WHERE email = ? LIMIT 1");

        if (!$stmt) {
            $errors[] = "Query error: " . $mysqli->error;
        } else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // verifikasi password
                if (password_verify($password, $row['pass'])) {
                    $_SESSION['admin_id'] = $row['id_admin'];
                    $_SESSION['admin_email'] = $row['email'];
                    header("Location: index.php");
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
<title>Login Admin Hotel</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500&display=swap');

:root {
  --gold: #D4AF37;
  --dark: #1B1B1B;
  --light: #f9f7f3;
  --error-bg: #FDECEC;
  --error-text: #B91C1C;
}

body {
  margin: 0;
  font-family: 'Poppins', sans-serif;
  height: 100vh;
  background: linear-gradient(to right, #3e3a32 30%, #2b2b2b);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  color: var(--light);
}

.bg-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
  filter: brightness(0.4);
  z-index: -1;
}

.card {
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(10px);
  padding: 40px 32px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.3);
  width: 360px;
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
  box-sizing: border-box;
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

.errors {
  background: var(--error-bg);
  color: var(--error-text);
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 12px;
  font-size: 14px;
  text-align: left;
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
  <h2>Hotel Admin Login</h2>
  <p class="subtitle">Masuk ke sistem reservasi & manajemen hotel</p>

  <?php if (!empty($errors)): ?>
  <div class="errors">
    <ul style="margin:0;padding-left:18px;">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <form method="post" action="">
    <label for="email">Email</label>
    <input id="email" class="input" type="email" name="email" required
           value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

    <label for="password">Password</label>
    <input id="password" class="input" type="password" name="password" required>

    <button type="submit" class="btn">Masuk</button>
  </form>

  <p class="footer-text">
    Belum punya akun? <a href="register.php">Daftar Sekarang</a>
  </p>
</div>
</body>
</html>
