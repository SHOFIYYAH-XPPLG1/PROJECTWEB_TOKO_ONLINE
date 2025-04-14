<?php
session_start();
include 'config.php';

// Cek apakah customer sudah login
if (!isset($_SESSION['users_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data pesanan customer
$user_id = $_SESSION['users_id'];
$query = "SELECT o.*, p.name AS product_name FROM orders o JOIN products p ON o.product_id = p.product_id WHERE o.users_id='$user_id' AND o.status='pending'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="customer.php">Home</a>
        <a href="cart.php">Keranjang</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h1>Keranjang Belanja</h1>
    <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    
    <h2>Daftar Pesanan</h2>
    <table border="1">
        <tr>
            <th>ID Pesanan</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo htmlspecialchars($data['product_name']); ?></td>
            <td><?php echo $data['quantity']; ?></td>
            <td><a href="checkout.php?id=<?php echo $data['id']; ?>">Bayar</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>