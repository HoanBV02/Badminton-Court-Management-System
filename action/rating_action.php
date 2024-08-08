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

    // Kiểm tra nếu có dữ liệu rate được gửi từ form
    if (isset($_POST['rate'])) {
        if (isset($_SESSION['Fname'])) {
            // Lấy các giá trị từ session và form
            $idacc = $_SESSION['Id'];
            $idyard = $_SESSION['IdYard'];
            $rate = $_POST['rating'];

            // Kiểm tra xem người dùng đã đánh giá chưa
            $sql = "SELECT * FROM vote WHERE IdAcc = '$idacc' AND IdYard = '$idyard'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Nếu đã đánh giá, hiển thị thông báo lỗi
                ?>
                <script>
                    Swal.fire({
                        title: 'Bạn đã đánh giá rồi',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then(function () {
                        window.location.href = 'http://localhost/DATN/detail_yard.php';
                    });
                </script>
            <?php } else {
                // Nếu chưa đánh giá, thêm đánh giá vào cơ sở dữ liệu
                $sql_insert = "INSERT INTO vote (NumVote, IdAcc, IdYard) VALUES ('$rate', '$idacc', '$idyard')";
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert) { ?>
                    <!-- Hiển thị thông báo thành công nếu đánh giá được thêm thành công -->
                    <script>
                        Swal.fire({
                            title: "Đã đánh giá",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK"
                        }).then(function () {
                            window.location.href = 'http://localhost/DATN/detail_yard.php'; // Thay đổi URL của trang điều hướng tại đây
                        });
                    </script>
                <?php } else { ?>
                    <!-- Hiển thị thông báo lỗi nếu có lỗi khi thêm đánh giá vào cơ sở dữ liệu -->
                    <script>
                        Swal.fire({
                            title: "Lỗi",
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonText: "OK"
                        }).then(function () {
                            window.location.href = 'http://localhost/DATN/detail_yard.php'; // Thay đổi URL của trang điều hướng tại đây
                        });
                    </script>
                <?php }
            }
        } else {
            // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            $_SESSION['redirect_after_login'] = 'http://localhost/DATN/detail_yard.php';
            header("Location: http://localhost/DATN/login.php");
        }
    }
//    Vote product
if (isset($_POST['ratepr'])) {
    if (isset($_SESSION['Fname'])) {
        // Lấy các giá trị từ session và form
        $idacc = $_SESSION['Id'];
        $idpro = $_SESSION['IdPro'];
        $rate = $_POST['rating'];

        // Kiểm tra xem người dùng đã đánh giá chưa
        $sql = "SELECT * FROM votepr WHERE IdAcc = '$idacc' AND IdPro = '$idpro'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Nếu đã đánh giá, hiển thị thông báo lỗi
            ?>
            <script>
                Swal.fire({
                    title: 'Bạn đã đánh giá rồi',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.location.href = 'http://localhost/DATN/detail.php?IdPro=<?php echo $idpro ;?>';
                });
            </script>
        <?php } else {
            // Nếu chưa đánh giá, thêm đánh giá vào cơ sở dữ liệu
            $sql_insert = "INSERT INTO votepr (NumVote, IdAcc, IdPro) VALUES ('$rate', '$idacc', '$idpro')";
            $result_insert = mysqli_query($conn, $sql_insert);

            if ($result_insert) { ?>
                <!-- Hiển thị thông báo thành công nếu đánh giá được thêm thành công -->
                <script>
                    Swal.fire({
                        title: "Đã đánh giá",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonText: "OK"
                    }).then(function () {
                        window.location.href = "http://localhost/DATN/detail.php?IdPro=<?php echo $idpro ;?>"; // Thay đổi URL của trang điều hướng tại đây
                    });
                </script>
            <?php } else { ?>
                <!-- Hiển thị thông báo lỗi nếu có lỗi khi thêm đánh giá vào cơ sở dữ liệu -->
                <script>
                    Swal.fire({
                        title: "Lỗi",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonText: "OK"
                    }).then(function () {
                        window.location.href = "http://localhost/DATN/detail.php?IdPro=<?php echo $idpro ;?>"; // Thay đổi URL của trang điều hướng tại đây
                    });
                </script>
            <?php }
        }
    } else {
        // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
        $_SESSION['redirect_after_login'] = "http://localhost/DATN/detail.php?IdPro=".$_SESSION['IdPro'];
                header("Location: http://localhost/DATN/login.php");
    }
}
    ?>
</body>