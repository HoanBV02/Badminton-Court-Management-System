<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Badminton booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->

        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="http://localhost/DATN/" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"></i>Badminton booking</h1>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                       <a href="index.php" class="nav-item nav-link  active  ">Trang chủ</a>
                    <a href="product.php" class="nav-item nav-link">Sản phẩm</a>
                        <a href="order.php" class="nav-item nav-link">Đơn hàng</a>
                        <a href="me.php" class="nav-item nav-link">Trang cá nhân</a>
                        <a href="cart.php" class="nav-link">
                         <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <?php
                    session_start();
                    include 'action/connect.php';
                    function formatCurrency($number)
                    {
                        return number_format($number, 0, ',', '.');
                    }
                    // Kiểm tra xem người dùng đã đăng nhập chưa
                    if (isset($_SESSION['Fname'])) {
                        // Nếu đã đăng nhập, hiển thị "Xin chào [tên người dùng]"
                        echo '<a href="action/logout.php" class="btn btn-primary py-2 px-4">Xin chào ' . $_SESSION['Fname'] . ' <br><span class="small">Đăng xuất </span></a>';
                    } else {
                        // Nếu chưa đăng nhập, hiển thị nút "Đăng nhập"
                        echo '<a href="login.php" class="btn btn-primary py-2 px-4">Đăng nhập</a>';

                    }

                    ?>

                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Sân cầu lông<br>Chất lượng cao</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Dịch vụ cho thuê sân cầu lông chất
                                lượng cao - Đặt sân cầu lông trực tuyến</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
       
        <div class="container">
            <h1>Hoá đơn</h1>
            <form action="action/bill_action.php" method="post">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Tên người thuê:</td>
                            <td contenteditable="true">
                                <?php echo $_SESSION['Fname'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td contenteditable="true">
                                <?php echo $_SESSION['Tell'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày thuê:</td>
                            <td>
                                <?php echo date("d/m/Y", strtotime($_SESSION['date'])); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Vị trí sân:</td>
                            <td>
                                <?php echo $_SESSION['AddYard'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại chủ sân: </td>
                            <td>
                                <?php
                                $sql = "SELECT account.IdAcc, account.Tell FROM yard JOIN account ON yard.IdAcc = account.IdAcc WHERE yard.IdYard = '" . $_SESSION['IdYard'] . "'";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $tell = $row['Tell'];
                                    // Sử dụng biến $tell ở đây cho mục đích tiếp theo
                                    echo $tell;
                                    $_SESSION['TellP']=$tell; 
                                    $_SESSION['IdP']=$row['IdAcc'];  
                                } else {
                                    echo "Không tìm thấy số điện thoại.";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Thời gian thuê:</td>
                            <td>
                                <?php
                                if ($_SESSION['time'] == 1) {
                                    echo "5:00 - 8:00";
                                } else if ($_SESSION['time'] == 2) {
                                    echo "8:00 - 12:00";
                                } else if ($_SESSION['time'] == 3) {
                                    echo "12:00 - 16:00";
                                } else if ($_SESSION['time'] == 4) {
                                    echo "16:00 - 20:00";
                                } else if ($_SESSION['time'] == 5) {
                                    echo "Cả ngày";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tổng tiền:</td>
                            <td>
                                <?php
                                if ($_SESSION['time'] == 5) {
                                    $_SESSION['Price'] = $_SESSION['Price'] * 4;
                                    echo formatCurrency($_SESSION['Price']);
                                } else {
                                    echo  formatCurrency($_SESSION['Price']);
                                    echo ' vnđ';
                                }
                                ?>
                            </td>
                        </tr>
                        <!-- Thêm các dòng khác tại đây nếu cần -->
                    </tbody>
                </table>
                <div class="sticky-button">
                    <button type="submit" name="confirm" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>



        <!-- Reservation Start -->

        <?php include 'footer.php';
        ?>


        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Đường dẫn đến thư viện CSS của DatePicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <script src="js/main.js"></script>



    <!-- Đường dẫn đến thư viện CSS và JavaScript của jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">




</body>

</html>