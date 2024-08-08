<?php
session_start();
include 'action/connect.php';

if (isset($_POST['book']) or isset($_POST['ImgYard'])) {
    $_SESSION['NameYard'] = $_POST['yard_name'];
    $_SESSION['IdYard'] = $_POST['yard_id'];
    $_SESSION['Price'] = $_POST['yard_price'];
    $_SESSION['AddYard'] = $_POST['add_yard'];
    $_SESSION['ImgYard'] = $_POST['img_yard'];
    $_SESSION['DesYard'] = $_POST['des_yard'];
    $select=$_POST['select'];
    $date=$_POST['date'];
    $time=$_POST['time'];
}
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .fixed-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Thêm padding dưới cho nội dung chi tiết */
        .article-content {
            margin-bottom: 80px;
            /* Đảm bảo khoảng cách dưới đủ để nút không che phủ nội dung */
        }

        .custom-btn-width {
            width: 400px;
            /* Điều chỉnh độ rộng mong muốn */
        }

        .horizontal-line {
            border-top: 10px solid #ccc;
            margin: 20px 0;
        }

            /* Đánh giá sao */
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

        /* Comment */
        .comment {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .comment .comment-header {
            margin-bottom: 5px;
        }

        .comment .comment-author {
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .comment .comment-content {
            margin: 0;
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
                        <a href="me.php" class="nav-item nav-link ">Trang cá nhân</a>
                       
                        <a href="cart.php" class="nav-link">
                         <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
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
    </div>
        </div>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-single gray-bg">
                            <article class="article">
                                <h2>
                                    <?php echo $_SESSION['NameYard'] ?>
                                </h2>
                                <div class="media">
                                    <div class="image-wrapper">
                                        <img src="admin/imgprd/<?php echo $_SESSION['ImgYard']; ?>" class="img-fluid"
                                            style="width: 600px; height: 300px;" alt="Image">
                                    </div>
                                </div>
                                <div class="horizontal-line"></div>
                                <div class="description">
                                    <h4>Mô tả sân</h4>
                                    <div class="article-content">
                                        <p>
                                            <?php echo $_SESSION['DesYard']; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <!-- Phần Bình luận -->
                                    <div class="comment-section">
                                        <h3>Bình luận</h3>
                                        <div class="previous-comments">
                                            <!-- Hiển thị các comment cũ -->
                                            <style>
.comment {
    border: none; /* Bỏ viền */
    background-color: #f2f2f2; /* Thêm nền */
    padding: 10px; /* Tăng khoảng cách giữa các phần tử bên trong */
}

.reply {
    background-color: #eaeaea; /* Màu nền phản hồi */
    padding: 10px; /* Khoảng cách phản hồi */
    margin-top: 10px; /* Khoảng cách từ phản hồi đến phần comment */
    margin-left: 20px; /* Khoảng cách từ phản hồi đến lề trái */
}
</style>
                                           <?php
$sql = "SELECT * FROM comment WHERE IdYard=" . $_SESSION['IdYard'];

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['Status'] == 0) {
            // Hiển thị comment nếu status = 0
            ?>
            <div class="comment border p-3 mb-3">
                <div class="comment-header d-flex justify-content-between align-items-center text-muted small mb-2">
                    <span class="comment-author">
                        <?php echo $row['Fname'] ?>
                    </span>
                    <span class="comment-date">
                        <?php echo date('d/m/Y', strtotime($row['TimeCmt'])) ?>
                    </span>
                </div>
                <div class="comment-body">
                    <p class="comment-content">
                        <?php echo $row['ContentCmt'] ?>
                    </p>
                </div>
            </div>
            <?php
        } elseif ($row['Status'] == 1) {
            // Lấy IdCmt của comment
            $IdCmt = $row['IdCmt'];
            // Truy vấn các comment có IdCmt trùng với IdCmt của comment hiện tại
            $sql_reply = "SELECT * FROM comment WHERE Reply = $IdCmt ORDER BY TimeCmt ASC";
            $result_reply = $conn->query($sql_reply);
            // Hiển thị comment và các trả lời tương ứng
            ?>
            <div class="comment border p-3 mb-3">
                <div class="comment-header d-flex justify-content-between align-items-center text-muted small mb-2">
                    <span class="comment-author">
                        <?php echo $row['Fname'] ?>
                    </span>
                    <span class="comment-date">
                        <?php echo date('d/m/Y', strtotime($row['TimeCmt'])) ?>
                    </span>
                </div>
                <div class="comment-body">
                    <p class="comment-content">
                        <?php echo $row['ContentCmt'] ?>
                    </p>
                </div>
            </div>
            <?php
            // Hiển thị các trả lời
            if ($result_reply->num_rows > 0) {
                while ($row_reply = $result_reply->fetch_assoc()) {
                    ?>
                    <div class="comment reply border p-3 mb-3 ml-4">
                        <div class="comment-header d-flex justify-content-between align-items-center text-muted small mb-2">
                    <span class="comment-author">
                      Chủ sân đã trả lời <?php echo $row['Fname'] ?> :
                    </span>
                    <span class="comment-date">
                        <?php echo date('d/m/Y', strtotime($row_reply['TimeCmt'])) ?>
                    </span>
              
                        </div>
                        <div class="comment-body">
                            <p class="comment-content">
                                <?php echo $row_reply['ContentCmt'] ?>
                            </p>
                        </div>
                    </div>
                    
</div>
                    <?php
                }
            }
        }
    }
}
?>


                                        </div>
                                      
                                    </div>
                                    <br>
                                    <br>
                                    <!-- Phần Đánh giá -->
                                    <div class="rating-section">
                                        <?php
                                        $sql = "SELECT SUM(NumVote) AS total_votes, COUNT(*) AS total_rows FROM vote WHERE IdYard = '" . $_SESSION['IdYard'] . "'";
                                        $result = $conn->query($sql);

                                        // Kiểm tra xem có dữ liệu trả về không
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $total_votes = $row['total_votes'];
                                            $total_rows = $row['total_rows'];
                                        } else {
                                            $total_votes = 0; // Đặt giá trị mặc định nếu không có dữ liệu
                                            $total_rows = 0;
                                        }

                                        $average_rating = $total_rows > 0 ? $total_votes / $total_rows : 0;
                                        ?>

                                        <h3>Đánh giá:
                                            <?php echo number_format($average_rating, 1);
                                            echo "/5" ?>
                                        </h3>
                                        
                                    </div>
                            </article>
                        </div>
                        <div class="fixed-bottom">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <form action="action/booking_action.php" method="post">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg btn-block custom-btn-width"
                                                name="book">Đặt ngay</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 order-md-last order-first">
                        <div class="sidebar">
                            <h5 class="text-center">Sân ở khu vực bạn chọn</h5>
                            <ul class="list-group">
    <?php 
   $sql3 = "SELECT *
   FROM yard
   WHERE AreaYard = '$select' 
   AND IdYard NOT IN (
       SELECT IdYard
       FROM booking
       WHERE Date = '$date'
           AND (Time = '$time' OR Time = 5)
   )
   AND IdYard <> '{$_SESSION['IdYard']}'
   LIMIT 4";


    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        while ($row3 = $result3->fetch_assoc()) {
            ?>
            <div class="yard-item">
                <form action="detail_yard.php" method="POST">
                    <div class="list-group">
                        <span class='list-group-item'>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <?php echo $row3["NameYard"]?><br>
                                    <small><?php echo $row3['AddYard']; ?></small>
                                </div>
                                <div>
                                    <input type="hidden" name="date" value="<?php echo $date; ?>">
                                    <input type="hidden" name="time" value="<?php echo $time; ?>">
                                    <input type="hidden" name="select" value="<?php echo $select; ?>">
                                    <input type="hidden" name="yard_price" value="<?php echo $row3['PriceYard']; ?>">
                                    <input type="hidden" name="yard_id" value="<?php echo $row3['IdYard']; ?>">
                                    <input type="hidden" name="yard_name" value="<?php echo $row3['NameYard']; ?>">
                                    <input type="hidden" name="add_yard" value="<?php echo $row3['AddYard']; ?>">
                                    <input type="hidden" name="img_yard" value="<?php echo $row3['ImgYard']; ?>">
                                    <input type="hidden" name="des_yard" value="<?php echo $row3['DesYard']; ?>">
                                    <button type="submit" name="book" class="btn btn-primary">Xem ngay</button>
                                </div>
                            </div>
                        </span>
                    </div>
                </form>
                <!-- Added display of AddYard -->
            </div>
            <?php
        }
    } else {
        echo "<p>No yards available for booking at the moment.</p>";
    }
    ?>
    <!-- Danh sách các sân tương tự -->
</ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </body>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="margin-bottom: 80px;"><i
                class="bi bi-arrow-up"></i></a>
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
    <script>
        // Lấy tất cả các phần tử label trong phần tử có lớp là "rating" và lưu chúng vào mảng labels
        const labels = document.querySelectorAll('.rating label');

        // Lấy tất cả các phần tử input trong phần tử có lớp là "rating" và lưu chúng vào mảng ratingInput
        const ratingInput = document.querySelectorAll('.rating input');

        // Lặp qua mỗi label trong mảng labels
        labels.forEach((label, index) => {
            // Thêm một trình xử lý sự kiện click cho mỗi label
            label.addEventListener('click', function () {
                // Lấy giá trị của radio button tương ứng với label được nhấp vào
                const ratingValue = parseInt(ratingInput[index].value);

                // Tắt tất cả các radio button và đổi màu của các label về màu xám
                ratingInput.forEach(input => {
                    input.checked = false;
                    input.nextElementSibling.style.color = '#ddd';
                });

                // Bật các radio button từ đầu đến vị trí của label được nhấp vào và đổi màu của các label tương ứng thành màu cam
                for (let i = 0; i <= index; i++) {
                    ratingInput[i].checked = true;
                    labels[i].style.color = '#ff9700';
                }
            });
        });

    </script>
    <!-- Đường dẫn đến thư viện CSS và JavaScript của jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">