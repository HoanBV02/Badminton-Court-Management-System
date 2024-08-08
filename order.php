<?php 
session_start();
include 'action/connect.php';
                    ?>
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
    <link href="css/style.css" rel="stylesheet">
    <link href="css/order.css" rel="stylesheet">
    <style>
        .hero-header {
            background: linear-gradient(rgba(15, 23, 43, .9), rgba(15, 23, 43, .9)), url(img/banner.jpg);
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
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
                    <h1 class="text-primary m-0">Badminton booking</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                    <a href="index.php" class="nav-item nav-link    ">Trang chủ</a>
                    <a href="product.php" class="nav-item nav-link ">Sản phẩm</a>
                        <a href="order.php" class="nav-item nav-link active">Đơn hàng</a>
                        <a href="me.php" class="nav-item nav-link ">Trang cá nhân</a>
                       
                        <a href="cart.php" class="nav-link">
                         <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <?php
                   

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
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Đơn hàng</h1>
                    <nav aria-label="breadcrumb">

                    </nav>
                </div>
            </div>
        </div>
    </div>
        <!-- Navbar & Hero End -->

        <!-- Order Start -->
        <body>
         
        <div class="container">
    <div class="text-center">
        <div class="option-text-wrapper" id="productOptionWrapper">
            <span class="option-text active" id="productOption" data-option="product">Sản phẩm</span>
        </div>
        <div class="option-text-wrapper" id="courtOptionWrapper">
            <span class="option-text" id="courtOption" data-option="court">Sân cầu lông</span>
        </div>
    </div>

    <!-- Phần hiển thị giao diện sản phẩm -->
    <div id="productInterface" class="text-center mt-4 interface" style="display: block;"> 
        <div class="container">
            <?php if (isset($_SESSION['Fname'])) {?>  
                <h2>Danh sách đơn hàng đã đặt</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Địa chỉ nhận</th>
                            <th>Phương thức thanh toán</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $idacc = $_SESSION['Id'];
                        function formatCurrency($number)
                        {
                            return number_format($number, 0, ',', '.');
                        }
                        //format về dạng có dấu . vd: 10000->10.000

                        $sql = "SELECT * FROM orders WHERE IdAcc=$idacc ORDER BY Status, date DESC";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $idorder = $row["IdOrder"];
                                $idpro= $row["IdPro"];
                                
                        ?>
                                <tr>
                                    <td><a href="http://localhost/DATN/detail.php?IdPro=<?php echo $idpro; ?>" style="color: black;"><?php echo $row['NamePro']; ?></a></td>
                                    <td><a href="http://localhost/DATN/detail.php?IdPro=<?php echo $idpro; ?>" style="color: black;"><?php echo $row['QtyPro']; ?></a></td>
                                    <td><a href="http://localhost/DATN/detail.php?IdPro=<?php echo $idpro; ?>" style="color: black;"><?php echo formatCurrency($row['Total']); ?></a></td>
                                    <td><a href="http://localhost/DATN/detail.php?IdPro=<?php echo $idpro; ?>" style="color: black;"><?php echo $row['Addr']; ?></a></td>
                                   <td>
                                    <?php if ($row['Pay'] == 0) { 
                                        echo "Thanh toán khi nhận hàng";
                                    }
                                    if($row['Pay'] == 1){
                                        echo "Đã thanh toán";
                                    }
                                        ?>
                                   </td>
                                    <td>
                                        <?php if ($row['Status'] == 0) { ?>
                                            <form action="action/cancel_action.php" method="post">
                                                <input type="hidden" name="idorder" value="<?php echo $idorder; ?>"> <!-- Thêm input hidden để chứa giá trị IdPro -->
                                                <button name="cancel" type="submit" class="btn-cancel">
                                                    Huỷ đơn hàng
                                                </button>
                                            </form>
                                        <?php } else {
                                            echo "Đã huỷ";
                                         ?>
                                    </td>
                                </tr>
                                <?php } ?>
                        <?php }
                        } else {
                            echo "<tr><td colspan='5'>Bạn không có đơn hàng nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else {
                echo "<h2>Bạn phải đăng nhập trước</h2>";
            }?>
        </div>
    </div>

    <!-- Phần hiển thị  sân -->
    <div id="courtInterface" class="text-center mt-4 interface" style="display: none;">
    <?php if (isset($_SESSION['Fname'])) {?>  
        <h3>Các sân đã đặt</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Địa chỉ sân</th>
                    <th>Thời gian</th>
                    <th>Ngày</th>
                    <th>Số điện thoại chủ sân</th>
                    <th>Giá tiền</th>
                    <th></th>
                </tr>
            </thead>
            <?php
$idacc = $_SESSION['Id'];
$sql2 = "SELECT * FROM booking WHERE IdAcc = $idacc ORDER BY Date DESC";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $time = $row2['Time'];
?>
        <tr>
           
            <td><?php echo $row2['AddYard']; ?></td>
            <td><?php
                if ($time == 1) {
                    echo "5:00 - 8:00";
                } else if ($time == 2) {
                    echo "8:00 - 12:00";
                } else if ($time == 3) {
                    echo "12:00 - 16:00";
                } else if ($time == 4) {
                    echo "16:00 - 20:00";
                } else if ($time == 5) {
                    echo "Cả ngày";
                } ?></td>
            <td><?php echo date("d/m/Y", strtotime($row2['Date'])); ?></td>
            <td><?php echo $row2['TellPartner']; ?></td>
            <td><?php echo formatCurrency($row2['Price']); ?></td>
            <td>
                <?php if ($row2['Status'] == 0) { ?>
                    <form action="action/cancel_action.php" method="post">
                        <input type="hidden" name="idbk" value="<?php echo $row2['IdBooking']; ?>"> <!-- Thêm input hidden để chứa giá trị IdPro -->
                        <button name="cancelbk" type="submit" class="btn-cancel">
                            Huỷ đơn hàng
                        </button>
                    </form>
                <?php } else if ($row2['Status'] == 1) {
                    echo "Đã huỷ";
                } else if ($row2['Status'] == 2) {
                    ?>
<form action ="process_vote.php" method="POST">
    <input type="hidden" name="iduser" value="<?php echo $idacc?>">
    <input type="hidden" name="idyd" value="<?php echo $row2['IdYard']?>">
    <input type="submit" name= "vote" value ="Đánh giá">
</form>                
                   
                <?php } 
                 else if ($row2['Status'] == 3) {
                    echo "Đã đánh giá";}?>
                
            </td>
        </tr>
<?php }
} else {
    echo "<tr><td colspan='6'>Bạn không có đơn hàng nào</td></tr>";
}
?>

        </table>
        <?php } else {
                echo "<h2>Bạn phải đăng nhập trước</h2>";
            }?>
    </div>
        </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<style>
    .rating {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
                margin: 20px auto;
            }

            .rating input {
                display: none;
            }

            .rating label {
                display: inline-block;
                font-size: 24px;
                color: #ddd;
                cursor: pointer;
                transition: 0.2s ease;
                margin: 0 5px;
            }

            .rating label:hover,
            .rating input:checked+label {
                color: #ff9700;
            }

            .btn-primary {
                margin-top: 10px;
                padding: 5px 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                cursor: pointer;
                transition: 0.2s ease;
            }
</style>
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

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
    // Lắng nghe sự kiện khi lựa chọn thay đổi
    $('.option-text').click(function() {
        var option = $(this).data('option');
        $('.option-text').removeClass('active');
        $(this).addClass('active');
        if (option === 'product') {
            $('#productInterface').show();
            $('#courtInterface').hide();
        } else if (option === 'court') {
            $('#productInterface').hide();
            $('#courtInterface').show();
        }
    });
</script>

          


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

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <script>
    // Lắng nghe sự kiện khi lựa chọn thay đổi
    $('.option-text').click(function() {
      var option = $(this).data('option');
      $('.option-text').removeClass('active');
      $(this).addClass('active');
      if (option === 'product') {
        $('#productInterface').show();
        $('#courtInterface').hide();
      }
      else if (option === 'court') {
        $('#productInterface').hide();
        $('#courtInterface').show();
      }
    });
  </script>
</body>

</html>
