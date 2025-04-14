<?php
session_start();
include 'config.php';

if (!isset($_GET['id'])) {
    header('location: products.php');
}

$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE product_id='$product_id'";
$product_result = mysqli_query($koneksi, $query);
$product = mysqli_fetch_array($product_result);

// Menangani penambahan ke keranjang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['users_id'];
    $quantity = $_POST['quantity'];

    $cart_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
    mysqli_query($koneksi, $cart_query);
    echo "Produk telah ditambahkan ke keranjang!";
}

// Menangani komentar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $user_id = $_SESSION['users_id'];
    $comment = $_POST['comment'];

    $comment_query = "INSERT INTO comments (product_id, user_id, comment) VALUES ('$product_id', '$user_id', '$comment')";
    mysqli_query($koneksi, $comment_query);
}

// Mengambil komentar
$comments_query = "SELECT c.comment, u.username FROM comments c JOIN users u ON c.user_id = u.users_id WHERE c.product_id='$product_id'";
$comments_result = mysqli_query($koneksi, $comments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2><?php echo $product['name']; ?></h2>
    <p>Harga: <?php echo $product['price']; ?></p>
    <img src="<?php echo $product['image']; ?>" width="200" height="200"><br>

    <form method="POST" action="">
        <input type="number" name="quantity" value="1" min="1" required>
        <button type="submit" name="add_to_cart">Tambah ke Keranjang</button>
    </form>

    <h3>Komentar</h3>
    <form method="POST" action="">
        <textarea name="comment" placeholder="Tulis komentar..." required></textarea><br>
        <button type="submit">Kirim Komentar</button>
    </form>

    <h4>Daftar Komentar:</h4>
    <ul>
        <?php while ($comment = mysqli_fetch_array($comments_result)) { ?>
            <li><strong><?php echo $comment['username']; ?>:</strong> <?php echo $comment['comment']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>