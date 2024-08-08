<?php
session_start();

// Xử lý khi người dùng thêm sản phẩm vào giỏ hàng
if(isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Thêm sản phẩm vào giỏ hàng (biến Session)
    if(!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = 1;
    } else {
        $_SESSION['cart'][$productId]++;
    }

    // Chuyển hướng người dùng trực tiếp đến trang giỏ hàng
    header("Location: cart.php");
    exit;
}
?>