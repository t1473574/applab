<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin Hotel</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
<div class="container">
    <h1>Login Admin</h1>
    <form action="proses_login.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
