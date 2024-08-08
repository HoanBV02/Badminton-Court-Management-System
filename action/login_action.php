<?php
session_start();
include 'connect.php';

if (isset($_POST['login'])) {
    $u_name = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM account WHERE User ='$u_name' and Pass='$pass' and Status =1 ";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $_SESSION['Tell'] = $row['Tell'];
        $_SESSION['Fname'] = $row['Fname'];
        $id = $row['IdAcc'];
        $_SESSION['Id'] = $row['IdAcc'];
        $_SESSION['Addr'] = $row['AddrAcc'];
        $_SESSION['Uname'] = $u_name;
        if($row['Permission'] == 1){
            if (isset($_SESSION['redirect_after_login']) && !empty($_SESSION['redirect_after_login'])) {
                // Nếu có URL được lưu và không rỗng
                $redirectURL = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']); // Xóa URL sau khi sử dụng
                header("Location: $redirectURL"); // Chuyển hướng đến URL được lưu
                exit();
            } else {
                // Nếu không có URL được lưu, chuyển hướng đến trang index.php
                header("Location: http://localhost/DATN/index.php");
                exit();
            }
        }
        if ($row["Permission"]== 2) {
            header("Location: http://localhost/DATN/admin/admin_partner.php");
            exit();
        }
        if ($row["Permission"]== 0) {
            header("Location: http://localhost/DATN/admin/admin.php");
            exit();
        }
    } else {
        echo '<script>
        alert("Sai tài khoản hoặc mật khẩu. Vui lòng nhập lại.");
        window.history.back();
    </script>';
    }
}
?>