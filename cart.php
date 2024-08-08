<?php
session_start();
include 'action/connect.php';

$totalAll=0;
if (isset($_SESSION['Fname'])) {
// Xử lý khi người dùng thêm sản phẩm vào giỏ hàng
if(isset($_POST['productId'], $_POST['quantity'] )) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
  
    // Thêm sản phẩm vào giỏ hàng (biến Session)
    if(!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
    //Cập nhật số lượng
if(isset($_POST['update'])){
    $_SESSION['cart'][$productId] = $quantity;
}
//xoá khỏi giỏ hàng
if(isset($_POST['delete'])){
        if(isset($_SESSION['cart'][$productId])) {
             unset($_SESSION['cart'][$productId ]); } 

}
    // Chuyển hướng người dùng trực tiếp đến trang giỏ hàng
    header("Location: cart.php");
    exit;
}
function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}
// Hiển thị giỏ hàng
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
    <link href="css/cart.css" rel="stylesheet">
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
                <a href="index.php" class="navbar-brand p-0">
                    <h1 class="text-primary m-0">Badminton booking</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link    ">Trang chủ</a>
                    <a href="product.php" class="nav-item nav-link">Sản phẩm</a>
                        <a href="order.php" class="nav-item nav-link">Đơn hàng</a>
                        <a href="me.php" class="nav-item nav-link ">Trang cá nhân</a>
                       
                        <a href="cart.php" class="nav-link active">
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
        <h1 class="display-3 text-white mb-3 animated slideInDown">Giỏ hàng</h1>
        <nav aria-label="breadcrumb">
        </nav>
    </div>
</div>
</div>
<main id="cart" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
                    $query = "SELECT * FROM product WHERE IdPro = $productId";
                    $result = mysqli_query($conn, $query);

                    // Kiểm tra xem truy vấn có thành công không
                    if ($result) {
                        $product = mysqli_fetch_assoc($result);
                       
                        // Hiển thị thông tin sản phẩm
                        ?>
                       <div class="cart-item mb-3 shadow-sm">
    <div class="row align-items-center">
        <div class="col-4 col-md-3">
        <img src="admin/imgprd/<?php echo $product['ImgPro']; ?>" alt="Product Image" style="width: 70%; height: auto;">

        </div>
        <div class="col-8 col-md-6">
            <h5 class="mb-1"><?php echo $product['NamePro']; ?></h5>
            <p class="mb-1">
                <?php 
                if($product['SalePro']!=0){
            echo formatCurrency($product['PricePro']* ((100-$product['SalePro'])/100));
                 } else {
                    echo formatCurrency($product['PricePro']);
                 }
                 
                 ?>đ</p>
        </div>
        <div class="col-12 col-md-3">

<form method="post" action="cart.php">
    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
    <div class="input-group">
        <input type="number" name="quantity" value="<?php echo $quantity; ?>" class="form-control" min="1">
        <div class="input-group-append">
            <button type="submit" name="update" class="btn btn-sm btn-secondary">
                <i class="fas fa-sync-alt"></i> <!-- Sử dụng icon cập nhật -->
            </button>
            <button type="submit" name="delete" class="btn btn-sm btn-danger">
                <i class="fas fa-trash-alt"></i> <!-- Sử dụng icon xóa -->
            </button>
        </div>
    </div>
</form>
        </div>
    </div>
    <div class="row justify-content-end mt-3">
        <div class="col-auto">
            <p class="mb-0">Thành tiền: <?php 
            if($product['SalePro']!=0){
            $total = $product['PricePro'] * $quantity * ((100-$product['SalePro'])/100); 
            //Tính tổng tiền
            } else {
                $total = $product['PricePro'] * $quantity ;
            }
            $totalAll+=$total;
            echo formatCurrency($total); ?>đ</p>
           
        </div>
    </div>
</div>

                        <?php
                    } else {
                        // Xử lý lỗi truy vấn không thành công
                        echo "Error: " . mysqli_error($connection);
                    }
                }
            } else {
                echo "<p class='text-center'>Giỏ hàng của bạn đang trống</p>";
            }
            ?>
        </div>
    </div>

    <!-- Tổng thanh toán và nút thanh toán -->
    <div class="row justify-content-center mt-5">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tổng thanh toán</h5>
                <p class="card-text">Tổng số tiền của giỏ hàng: <?php echo formatCurrency($totalAll); ?></p>
                <button id="paymentButton" class="btn btn-lg btn-primary btn-block mt-3">Đặt ngay</button>
                <form action="confirm_pro.php" method="POST" id="paymentForm" style="display: none;">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" class="form-control" id="name" name="fname" placeholder="Nhập tên" value="<?php echo $_SESSION['Fname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="addr" placeholder="Nhập địa chỉ" value="<?php echo $_SESSION['Addr']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="tell" placeholder="Nhập số điện thoại" value="<?php echo $_SESSION['Tell']; ?>">
                    </div>
                    <input type="hidden" name="totalAll" value="<?php echo $totalAll ?>">
                    <div class="form-group">
                        <label for="paymentMethod">Phương thức thanh toán</label>
                        <select class="form-control" id="paymentMethod" name="paymentMethod"> 
                        <option value="0">Tiền mặt</option>
                        <option value="1">Qua ngân hàng</option>

                        </select>
                    </div>
                    <br>
                    <button type="submit" name='sell'class="btn btn-lg btn-primary btn-block mt-3">Đặt ngay</button> <!-- Thay đổi type từ button sang submit -->
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        <?php if ($totalAll == 0): ?>
            $("#paymentButton").hide(); // Ẩn button "Đặt ngay"
        <?php else: ?>
            $("#paymentButton").click(function() {
                $("#paymentButton").hide(); // Ẩn button "Đặt ngay"
                $("#paymentForm").show();
            });
        <?php endif; ?>
    });
</script>

</main>
        
<?php } else {
$_SESSION['redirect_after_login'] = $_SERVER['HTTP_REFERER']; // Lưu URL của trang trước đó để quay lại sau khi đăng nhập
header("Location: http://localhost/DATN/login.php");
    }?>
    <?php include 'footer.php';?>
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
</body>


</html>
