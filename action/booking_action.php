<?php
session_start();
include 'connect.php';

if (isset($_POST['book'])) {
    if (isset($_SESSION['Fname'])) {
        // lưu tên sân
        if (isset($_POST['yard_name'])) {
            $_SESSION['NameYard'] = $_POST['yard_name'];
            $_SESSION['IdYard'] = $_POST['yard_id'];
            $_SESSION['Price'] = $_POST['yard_price'];  
        }

        // Thêm các xử lý khác sau khi người dùng đăng nhập và nhấn nút "Đặt ngay" ở đây (ví dụ: thêm vào cơ sở dữ liệu, gửi email xác nhận, vv.)
        header("Location: http://localhost/DATN/bill.php"); // Chuyển hướng đến trang "bill.php"
        exit();
    } else {
        // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập và lưu lại đường dẫn hiện tại để quay lại sau khi đăng nhập thành công
        $_SESSION['redirect_after_login'] = 'http://localhost/DATN/bill.php'; // Lưu URL để quay lại sau khi đăng nhập
        header("Location: http://localhost/DATN/login.php");
        // lưu tên sân
        if (isset($_POST['yard_name'])) {
            $_SESSION['NameYard'] = $_POST['yard_name'];
            $_SESSION['IdYard'] = $_POST['yard_id'];
            $_SESSION['Price'] = $_POST['yard_price'];
        }
        exit();
    }
}
?>