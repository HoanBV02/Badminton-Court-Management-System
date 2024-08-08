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
    <link href="css/me.css" rel="stylesheet">
    
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
                    <a href="product.php" class="nav-item nav-link">Sản phẩm</a>
                        <a href="order.php" class="nav-item nav-link">Đơn hàng</a>
                        <a href="me.php" class="nav-item nav-link active">Trang cá nhân</a>
                       
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
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Trang cá nhân</h1>
                    <nav aria-label="breadcrumb">

                    </nav>
                </div>
            </div>
        </div>
    </div>
        <!-- Navbar & Hero End -->


        <!-- Me Start -->
<?php
 if (isset($_SESSION['Fname'])) {?>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shopee-card">
                <div class="card-body">
                <form id="userInfoForm" action="action/me_action.php" method="POST">
    <div class="form-group">
        <label for="username">Tên đăng nhập</label>
        <input type="text" class="form-control" id="username" value="<?php echo $_SESSION['Uname'] ;?>" readonly>
    </div>
    <div class="form-group">
        <label for="fullname">Họ và tên</label>
        <input type="text" class="form-control" id="fullname" value="<?php echo $_SESSION['Fname'];?>">
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" class="form-control" id="address" value="<?php echo $_SESSION['Addr'];?>" readonly>
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <div class="input-group">
            <input type="password" class="form-control" id="phone" value="<?php echo $_SESSION['Tell'];?>" readonly>
            <div class="input-group-append">
                <span class="input-group-text eye-icon" id="togglePhoneVisibility">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <br>
    <button type="button" class="btn btn-primary" id="changePasswordBtn">Đổi mật khẩu</button>
</div>

<!-- Form đổi mật khẩu (ẩn ban đầu) -->
<div id="changePasswordForm" style="display: none;">
    <div class="form-group">
        <label for="oldPassword">Mật khẩu cũ:</label>
        <div class="input-group">
            <input type="password" class="form-control" id="oldPassword" name="oldPassword">
            <div class="input-group-append">
                <span class="input-group-text" id="toggleOldPasswordVisibility">
                    <i class="fas fa-eye-slash" id="oldPasswordToggle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="newPassword">Mật khẩu mới:</label>
        <div class="input-group">
            <input type="password" class="form-control" id="newPassword" name="newPassword">
            <div class="input-group-append">
                <span class="input-group-text" id="toggleNewPasswordVisibility">
                    <i class="fas fa-eye-slash" id="newPasswordToggle"></i>
                </span>
            </div>
        </div>
    </div>
    <br>
    <button type="submit" name="changepass" class="btn btn-primary">Lưu mật khẩu mới</button>
</div>


<!-- Nút "Đăng ký đối tác" -->
<br>
<div class="form-group">
    <button type="submit" name="partner" class="btn btn-success" id="registerPartnerBtn">Đăng ký đối tác</button>
</div>


</form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php } else {
    // Nếu chưa đăng nhập, hiển thị nút "Đăng nhập"
    $_SESSION['redirect_after_login'] = 'http://localhost/DATN/me.php'; // Lưu URL để quay lại sau khi đăng nhập
    header("Location: http://localhost/DATN/login.php");

}
?>
        <!-- Me End -->


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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
   <script>
    const phoneInput = document.getElementById('phone');
    const togglePhoneVisibility = document.getElementById('togglePhoneVisibility');

    togglePhoneVisibility.addEventListener('click', function() {
        if (phoneInput.type === 'password') {
            phoneInput.type = 'text';
            togglePhoneVisibility.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
        } else {
            phoneInput.type = 'password';
            togglePhoneVisibility.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
        }
    });
</script>
<script>
    // Lắng nghe sự kiện nhấp vào nút "Đổi mật khẩu"
    document.getElementById("changePasswordBtn").addEventListener("click", function() {
        // Ẩn nút "Đổi mật khẩu"
        this.style.display = "none";
        // Hiển thị form đổi mật khẩu
        document.getElementById("changePasswordForm").style.display = "block";
    });
</script>
<script>
document.getElementById('toggleOldPasswordVisibility').addEventListener('click', function() {
    togglePasswordVisibility('oldPassword', 'oldPasswordToggle');
});

document.getElementById('toggleNewPasswordVisibility').addEventListener('click', function() {
    togglePasswordVisibility('newPassword', 'newPasswordToggle');
});

function togglePasswordVisibility(inputId, toggleId) {
    var passwordInput = document.getElementById(inputId);
    var toggleIcon = document.getElementById(toggleId);
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}

</script>
</body>

</html>