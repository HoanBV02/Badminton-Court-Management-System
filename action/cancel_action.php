<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/partner.css">
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

    if (isset($_POST['cancel'])) {
        $idorder = $_POST['idorder'];
        ?>
        <script>
            Swal.fire({
                title: "Xác nhận huỷ",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xác nhận",
                cancelButtonText: "Không"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng đã xác nhận huỷ, thực hiện cập nhật và hiển thị thông báo thành công
                    Swal.fire({
                        title: "Thành công",
                        text: "Huỷ thành công",
                        icon: "success"
                    }).then(function () {
                        window.location.href = "http://localhost/DATN/order.php";
                    });
                    // Perform cancellation action here
                    // For example, update the status in the database
                    <?php
                    $sql = "UPDATE orders SET Status = 1 WHERE IdOrder = '$idorder'";
                    $conn->query($sql);
                    ?>
                }
            });
        </script>
    <?php
    }

    if (isset($_POST['cancelbk'])) {
        $idbk = $_POST['idbk'];
        $sql1 = "UPDATE booking SET Status = 1 WHERE IdBooking = '$idbk'";
        $result1 = $conn->query($sql1);
        if ($result1) {
            // Nếu cập nhật thành công, chuyển hướng đến trang order.php
            ?>
            <script>
                Swal.fire({
                    title: "Thành công",
                    text: "Huỷ thành công",
                    icon: "success"
                }).then(function () {
                    window.location.href = "http://localhost/DATN/order.php";
                });
            </script>
        <?php
        } else {
            // Xử lý lỗi nếu cần
            echo "Đã xảy ra lỗi khi hủy đơn hàng: " . $conn->error;
        }
    }
    ?>

</body>

</html>
