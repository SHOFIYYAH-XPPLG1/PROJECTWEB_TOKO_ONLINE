<?php
session_start();
include 'config.php';

// Cek apakah customer sudah login
if (!isset($_SESSION['users_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data produk
$query = "SELECT * FROM products";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="customer.php">Home</a>
        <a href="cart.php">Keranjang</a>
        <a href="logout.php">Logout</a>
    </nav>
    <h1>Halaman Customer</h1>
    <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    
    <h2>Produk</h2>
    <table border="1">
        <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($data['name']); ?></td>
            <td>Rp <?php echo number_format($data['price'], 0, ',', '.'); ?></td>
            <td>
                <form action="create_order.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                    <input type="number" name="quantity" min="1" required>
                    <input type="submit" value="Beli">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>