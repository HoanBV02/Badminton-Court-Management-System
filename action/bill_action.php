<?php
session_start();
include 'connect.php';
if (isset($_POST["confirm"])) {
    $name = $_SESSION['Fname'];//tên
    $tell = $_SESSION['Tell'];//sđt người dùng
    $date = $_SESSION['date'];//ngày đặt
    $time = $_SESSION['time'];//thời gian đặt
    $idyard = $_SESSION['IdYard'];//Id sân
    $select = $_SESSION['select'];//area
    $price = $_SESSION['Price'];//giá
    $tellp= $_SESSION['TellP'];//sdt chủ sân
$addyard= $_SESSION['AddYard'];
$idacc=$_SESSION['Id'];
$idaccp=$_SESSION['IdP'];
    // Chuẩn bị câu lệnh INSERT
    $sql = "INSERT INTO booking (IdAcc,IdPartner, Name, Tell, Date, Time, IdYard, Area, AddYard, TellPartner, Price) VALUES ('$idacc','$idaccp', '$name', '$tell', '$date', '$time', '$idyard', '$select', '$addyard', '$tellp', '$price')";


    // Thực thi câu lệnh INSERT
    if (mysqli_query($conn, $sql)) { ?>
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

            <script>
                Swal.fire({
                    title: "Đặt thành công",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "OK"
                }).then(function () {
                    window.location.href = "http://localhost/DATN/"; // Thay đổi URL của trang điều hướng tại đây
                });
            </script>
        </body>

        </html>

        <?php exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>