<?php
session_start();
include 'config.php';

$query = "SELECT * FROM products";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        /* Styling umum */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    text-align: center;
    padding: 20px;
}

/* Styling judul */
h2 {
    color: #333;
    margin-bottom: 20px;
}

/* Container untuk produk */
.product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

/* Styling card produk */
.product-card {
    background: white;
    padding: 15px;
    width: 250px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Styling gambar produk */
.product-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
}

/* Styling nama produk */
.product-card h3 {
    font-size: 18px;
    margin: 10px 0;
}

/* Styling harga */
.product-card p {
    font-size: 16px;
    font-weight: bold;
    color: #007bff;
}

/* Styling tombol aksi */
.product-card a {
    display: inline-block;
    text-decoration: none;
    background-color: #28a745;
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    transition: 0.3s;
}

.product-card a:hover {
    background-color: #218838;
}

    </style>
    <h2>Daftar Produk</h2>
    
    <div class="product-container">
    <?php while ($data = mysqli_fetch_array($result)) { ?>
        <div class="product-card">
            <img src="<?php echo $data['image']; ?>" alt="Produk">
            <h3><?php echo $data['name']; ?></h3>
            <p>Rp <?php echo number_format($data['price'], 0, ',', '.'); ?></p>
            <a href="product_detail.php?id=<?php echo $data['product_id']; ?>">Lihat Detail</a>
        </div>
    <?php } ?>
</div>
</body>
</html>