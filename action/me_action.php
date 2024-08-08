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
        <body>
<?php
session_start();
include 'connect.php';
$idacc=$_SESSION['Id'];
$sql="SELECT * FROM account WHERE IdAcc = $idacc";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
if(isset($_POST['changepass'])){
    $oldpass=$_POST['oldPassword'];
    $newpass=$_POST['newPassword'];
    if($row["Pass"]== $oldpass){
        $sql1= "UPDATE account SET Pass=$newpass WHERE IdAcc=$idacc";
        if (mysqli_query($conn, $sql1)) {?>
            <script>
                Swal.fire({
                    title: "Đổi mật khẩu thành công",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "OK"
                }).then(function () {
                    window.location.href = "http://localhost/DATN/"; // Thay đổi URL của trang điều hướng tại đây
                });
            </script>
       

        </html>
<?php            
}}
else{?>
    <script>
    Swal.fire({
        title: "Bạn nhập sai mật khẩu hiện tại",
        icon: "error",
        showCancelButton: false,
        confirmButtonText: "OK"
    }).then(function () {
        window.history.back(); // Chuyển hướng người dùng về trang trước đó

    });
</script>
<?php }
}
if(isset($_POST['partner'])){
    $sql1= "UPDATE account SET Permission=2 WHERE IdAcc=$idacc";
    if (mysqli_query($conn, $sql1)) { ?>
        <script>
        Swal.fire({
            title: "Đăng kí thành công",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "OK"
        }).then(function () {
            window.location.href = "http://localhost/DATN/admin/admin_partner.php"; // Chuyển hướng người dùng về trang trước đó
    
        });
    </script>
    <?php
}
else{?>
    <script>
    Swal.fire({
        title: "Không thành công",
        icon: "error",
        showCancelButton: false,
        confirmButtonText: "OK"
    }).then(function () {
        window.history.back(); // Chuyển hướng người dùng về trang trước đó

    });
</script>
<?php }
}
?>
 </body>
 </html>