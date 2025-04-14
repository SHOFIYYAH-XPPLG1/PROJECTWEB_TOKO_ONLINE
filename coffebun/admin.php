<?php
session_start();
include 'config.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Ambil data pesanan
$query = "SELECT o.*, p.name AS product_name FROM orders o JOIN products p ON o.product_id = p.product_id";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="admin.php">Admin</a>
        <a href="customer.php">Customer</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h1>Halaman Admin</h1>
    <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    
    <h2>Daftar Pesanan</h2>
    <table border="1">
        <tr>
            <th>ID Pesanan</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
        <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo htmlspecialchars($data['product_name']); ?></td>
            <td><?php echo $data['quantity']; ?></td>
            <td><?php echo htmlspecialchars($data['status']); ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>