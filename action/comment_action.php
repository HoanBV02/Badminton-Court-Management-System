<?php
session_start();
include 'connect.php';
// Kiểm tra nếu có dữ liệu comment được gửi từ form
if (isset($_POST['comment'])) {
    if (isset($_SESSION['Fname'])) {
        // Lưu comment vào cơ sở dữ liệu hoặc xử lý comment theo nhu cầu
        $idacc = $_SESSION['Id'];
        $idyard = $_SESSION['IdYard'];
        $contentcmt = $_POST['content'];
        $fname = $_SESSION['Fname'];
        $sql = "INSERT INTO comment (ContentCmt,IdAcc,IdYard,Fname) VALUES ('$contentcmt','$idacc','$idyard','$fname')";
        $query = mysqli_query($conn, $sql);
        // Chuyển hướng người dùng về trang mới comment và tải lại
        header("Location: http://localhost/DATN/detail_yard.php");
        exit();
    } else {
        $_SESSION['redirect_after_login'] = 'http://localhost/DATN/detail_yard.php'; // Lưu URL để quay lại sau khi đăng nhập
        header("Location: http://localhost/DATN/login.php");

    }

}
if(isset($_POST["commentPr"])) {
    if (isset($_SESSION['Fname'])) {
$idacc = $_SESSION["Id"];
$idpro= $_SESSION["IdPro"];
$contentcmt= $_POST["content"];
$fname = $_SESSION["Fname"];
$sql = "INSERT INTO commentpr (ContentCmt,IdAcc,IdPro,Fname) VALUES ('$contentcmt','$idacc','$idpro','$fname')";
$query = mysqli_query($conn, $sql);
// Chuyển hướng người dùng về trang mới comment và tải lại
header("Location: http://localhost/DATN/detail.php?IdPro=$idpro");
exit();}
else {
    $_SESSION['redirect_after_login'] = "http://localhost/DATN/detail.php?IdPro=".$_SESSION['IdPro']; // Lưu URL để quay lại sau khi đăng nhập
    header("Location: http://localhost/DATN/login.php");

}}


?>