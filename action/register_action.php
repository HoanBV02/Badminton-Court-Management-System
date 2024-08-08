
<!DOCTYPE html>
        <html>

        <head>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                body {
                    font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
                }
            </style>
        </head>
        <body><?php
session_start();
include 'connect.php';
$u_name = $_POST['username'];
$pass = $_POST['password'];
$fname = $_POST['fname'];
$phoneNumber = $_POST['phoneNumber'];
$addr= $_POST['addr'];
$checkUsernameQuery = "SELECT * FROM account WHERE User = '$u_name'";
$checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
if (!$checkUsernameResult) {
    $_SESSION['message'] = "Lỗi trong quá trình kiểm tra tên đăng nhập: " . mysqli_error($conn);
} elseif (mysqli_num_rows($checkUsernameResult) > 0) {?>
    <script>
    Swal.fire({
        title: "Tên tài khoản đã tồn tại",
        icon: "error",
        showCancelButton: false,
        confirmButtonText: "OK"
    }).then(function () {
        window.history.back(); // Chuyển hướng người dùng về trang trước đó

    });
</script>
<?php }
elseif(!preg_match('/^0\d{9}$/', $phoneNumber)){ ?>
  <script>
    Swal.fire({
        title: "Tên tài khoản đã tồn tại",
        icon: "error",
        showCancelButton: false,
        confirmButtonText: "OK"
    }).then(function () {
        window.history.back(); // Chuyển hướng người dùng về trang trước đó

    });
</script>
 
<?php }
else{
    $sql = "INSERT INTO account (User, Pass, FName, Tell,AddrAcc) VALUES ('$u_name', '$pass', '$fname', '$phoneNumber','$addr')";
if ($conn->query($sql) === TRUE) {
       $sql1="SELECT * FROM account WHERE User = '$u_name'";
       $query = mysqli_query($conn, $sql1);
       $row = mysqli_fetch_array($query);
       if ($row) {
           $id=$row['IdAcc'];
           header("Location:http://localhost/DATN/login.php");
       }
        
        
}
}
?></body>
        </html>