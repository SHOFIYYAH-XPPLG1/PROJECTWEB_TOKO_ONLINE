<?php
session_start();
include 'config.php';

// Cek apakah customer sudah login
if (!isset($_SESSION['users_id'])) {
    header('Location: login.php');
    exit();
}

// Proses pembuatan pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['users_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Insert pesanan ke database
    $query = "INSERT INTO orders (users_id, product_id, quantity, status) VALUES ('$user_id', '$product_id', '$quantity', 'pending')";
    mysqli_query($koneksi, $query);

    // Redirect ke halaman customer
    header('Location: customer.php');
    exit();
}
?>