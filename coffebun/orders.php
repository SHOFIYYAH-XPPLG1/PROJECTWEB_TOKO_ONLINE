<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('location: login.php');
}

include 'config.php';

$query = "SELECT * FROM orders";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Kelola Pesanan</h2>
    <table border="1">
        <tr>
            <th>ID Pesanan</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['product_id']; ?></td>
            <td><?php echo $data['quantity']; ?></td>
            <td><?php echo $data['status']; ?></td>
            <td>
                <a href="edit_order.php?id=<?php echo $data['id']; ?>">Edit</a>
                <a href="delete_order.php?id=<?php echo $data['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>