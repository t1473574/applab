<?php
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// (Opsional) hapus cookie session di browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Arahkan kembali ke halaman login
header("Location: login.php");
exit;
?>
