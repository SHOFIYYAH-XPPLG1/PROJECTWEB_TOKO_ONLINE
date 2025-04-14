<?php
session_start();
include 'config.php';

// Cek apakah customer sudah login
if (!isset($_SESSION['users_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data pesanan
$order_id = $_GET['id'];
$query = "SELECT o.*, p.price, p.name AS product_name FROM orders o JOIN products p ON o.product_id = p.product_id WHERE o.id='$order_id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

if (!$data) {
    echo "Pesanan tidak ditemukan.";
    exit();
}

$total = $data['quantity'] * $data['price'];

// Buat tautan WhatsApp
$whatsapp_number = '6285693743093'; // Ganti dengan nomor WhatsApp Anda
$message = urlencode("Saya ingin memesan " . htmlspecialchars($data['product_name']) . " sebanyak " . $data['quantity'] . " dengan total Rp " . number_format($total, 0, ',', '.'));
$whatsapp_link = "https://wa.me/$whatsapp_number?text=$message";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="customer.php">Home</a>
        <a href="cart.php">Keranjang</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h1>Checkout</h1>
    <p>Nama Produk: <?php echo htmlspecialchars($data['product_name']); ?></p>
    <p>Jumlah: <?php echo $data['quantity']; ?></p>
    <p>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></p>
    <p>Silakan lakukan pembayaran melalui WhatsApp:</p>
    <a href="<?php echo $whatsapp_link; ?>" target="_blank">Bayar Sekarang</a>
</body>
</html>