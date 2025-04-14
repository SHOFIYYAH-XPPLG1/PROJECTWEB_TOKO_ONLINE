<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($koneksi, $query);
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Daftar</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>