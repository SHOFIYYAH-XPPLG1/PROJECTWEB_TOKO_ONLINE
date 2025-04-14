<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit(); // Pastikan untuk menghentikan eksekusi script setelah redirect
}

// Ambil data pengguna dari session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Pengguna';

// Ambil jumlah item di keranjang
$user_id = $_SESSION['user_id'];
$cart_query = "SELECT COUNT(*) as total_items FROM cart WHERE user_id='$user_id'";
$cart_result = mysqli_query($koneksi, $cart_query);
$cart_data = mysqli_fetch_array($cart_result);
$total_items = $cart_data['total_items'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Dashboard</h2>
    <p>Selamat datang, <?php echo $_SESSION['username']; ?></p>
    <p><a href="cart.php">Keranjang (<?php echo $total_items; ?>)</a></p>
    <a href="products.php">Lihat Produk</a>
    <a href="logout.php">Logout</a>
    <a href="checkout.php">Checkout</a>
</body>
</html>