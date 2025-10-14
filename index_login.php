<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <!-- Link Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #4e73df, #224abe);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }

    .login-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 40px;
      width: 100%;
      max-width: 400px;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-login {
      border-radius: 10px;
      background-color: #4e73df;
      color: #fff;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-login:hover {
      background-color: #224abe;
    }

    .text-muted a {
      color: #4e73df;
      text-decoration: none;
    }

    .text-muted a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3 class="text-center mb-4">Selamat Datang 👋</h3>
    <form>
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input type="email" class="form-control" id="email" placeholder="Masukkan email kamu" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="remember">
          <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <a href="#" class="small text-muted">Lupa kata sandi?</a>
      </div>
      <button type="submit" class="btn btn-login w-100">Masuk</button>
    </form>
    <p class="text-center mt-4 text-muted">
      Belum punya akun? <a href="#">Daftar sekarang</a>
    </p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
