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
        <style>
            .hero-header {
                background: linear-gradient(rgba(15, 23, 43, .9), rgba(15, 23, 43, .9)), url(img/banner.jpg);
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
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
                       <a href="index.php" class="nav-item nav-link   active ">Trang chủ</a>
                    <a href="product.php" class="nav-item nav-link">Sản phẩm</a>
                        <a href="order.php" class="nav-item nav-link">Đơn hàng</a>
                        <a href="me.php" class="nav-item nav-link ">Trang cá nhân</a>
                       
                        <a href="cart.php" class="nav-link">
                         <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <?php
                    session_start();
                    include 'action/connect.php';

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
   
      
        <?php
function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}

        if (isset($_POST['find'])) {
            // Lấy thông tin từ các trường trong form
            $_SESSION['date'] = $_POST['datetime'];
            $_SESSION['time'] = $_POST['time'];
            $_SESSION['select'] = $_POST['select'];
            $date = $_SESSION['date'];
            $time = $_SESSION['time'];
            $select = $_SESSION['select'];

            $sql3 = "SELECT *
            FROM yard
            WHERE AreaYard = '$select'
                AND Qty > (
                    SELECT COUNT(*)
                    FROM booking
                    WHERE Date = '$date'
                        AND (Time = '$time' OR Time = 5)
                        AND Status <>1
                        AND Status <>2
                )
                AND Status=1
                AND Qty>0
            ORDER BY QtyBooking DESC;";
    
            $result3 = mysqli_query($conn, $sql3);
            $numRows3 = mysqli_num_rows($result3);

            if ($numRows3 == 0) { ?>
                <div class="alert alert-warning text-center">
                    <strong>Không có sân phù hợp.</strong>
                </div>
            <?php } 
            else {
               
                while ($row3 = mysqli_fetch_array($result3)) {
                    $Idyd=$row3['IdYard'];
                    $sql4 = "SELECT COUNT(*) AS Total
                    FROM booking
                    WHERE Date = '$date'
                        AND (Time = '$time' OR Time = 5)
                        AND Status <> 1
                        AND Status <> 2
                        AND IdYard = '$Idyd'";
            
                    // Thực thi câu truy vấn
                    $result4 = $conn->query($sql4);
            
                    // Kiểm tra và hiển thị kết quả
                    if ($result4) {
                        $row4 = $result4->fetch_assoc(); // Sửa đổi tại đây
                        $total = $row4['Total'];
                    ?>
                    <form action="detail_yard.php" method="POST">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-link" name="ImgYard">
                                            <img src="admin/imgprd/<?php echo $row3['ImgYard']; ?>" class="img-fluid" alt="Image"
                                                style="width: 200px; height: 150px;">
                                        </button>

                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title" name="NameYard">
                                            <?php
                                            echo $row3['NameYard'];
                                            ?>
                                        </h5>

                                        <p class="card-text">
                                            <?php echo $row3['AddYard']; ?>
                                        </p>
                                        <p class="card-text">Giá sân 1 ca:
                                            
                                            <?php
                                            if($time==2||$time==3){ 
                                            echo formatCurrency($row3['PriceYard']);
                                            echo ' vnđ';}
                                            
                                            if($time==1||$time==4){
                                                echo formatCurrency($row3['PriceYards']);
                                                echo ' vnđ';}
                                            
                                            ?>
                                        
                                        </p>
                                        <p> Số lượt đặt sân:
                                        <?php echo $row3['QtyBooking']; ?>
                                        </p>
                                        <p> Số ô sân còn trống:
                                        <?php echo $row3['Qty']-$total; ?>
                                        </p>
                                        <input type="hidden" name="date" value="<?php echo $date; ?>">
                                        <input type="hidden" name="time" value="<?php echo $time; ?>">
                                        <input type="hidden" name="select" value="<?php echo $select; ?>">
                                        <input type="hidden" name="yard_price" value="<?php 
                                        if($time==2||$time==3)
                                             {echo $row3['PriceYard'];}
                                        else{
                                            echo $row3['PriceYards'];
                                        } ?>">
                                        <input type="hidden" name="yard_id" value="<?php echo $row3['IdYard']; ?>">
                                        <input type="hidden" name="yard_name" value="<?php echo $row3['NameYard']; ?>">
                                        <input type="hidden" name="add_yard" value="<?php echo $row3['AddYard']; ?>">
                                        <input type="hidden" name="img_yard" value="<?php echo $row3['ImgYard']; ?>">
                                        <input type="hidden" name="des_yard" value="<?php echo $row3['DesYard']; ?>">

                                        <input type="submit" class="btn btn-primary" name="book" value="Đặt ngay">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }
            }
        }}
        ?>

</div>
        <!-- Footer Start -->
        <?php include 'footer.php'; ?>

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