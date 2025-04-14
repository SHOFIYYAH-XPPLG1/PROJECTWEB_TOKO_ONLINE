<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username dan password cocok
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if ($data) {
        $_SESSION['role'] = $data['role'];
        $_SESSION['users_id'] = $data['users_id'];
        $_SESSION['username'] = $data['username'];

        if ($data['role'] == 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: customer.php');
        }
        exit();
    } else {
        echo '<h1>Login gagal. Username atau password salah.</h1>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="login.php">Login</a>
        <a href="index.php">Home</a>
    </nav>
    <h1>Login</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>