<?php
session_start();
include 'action/connect.php';
$_SESSION['IdPro']=$_GET['IdPro'];
function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}
//format về dạng có dấu . vd: 10000->10.000
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
    <style>
        /* Custom CSS */
        .comments-container {
            margin-top: 30px;
        }
        .comment {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .comment-author {
            font-weight: bold;
            color: #333;
        }
        .comment-date {
            font-size: 12px;
            color: #666;
        }
        .comment-content {
            margin-top: 5px;
        }
        /* sale */
        .product__panel-sale {
        position: absolute;
        background-color: #dc3545;
        color: #fff;
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 4px;
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
        /* ô qty */
        
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
                    <a href="product.php" class="nav-item nav-link active">Sản phẩm</a>
                        <a href="order.php" class="nav-item nav-link">Đơn hàng</a>
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Sản phẩm</h1>
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>
            </div>
        </div>
        <?php
      $sql = "SELECT * FROM product WHERE IdPro = " . $_SESSION['IdPro'];
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $salePro = $row['SalePro'];
        $pricePro = $row['PricePro'];
        $qty= $row['QtyPro'];
        $discountedPrice = $pricePro - ($pricePro * $salePro / 100);
    ?>
        
        <!-- Navbar & Hero End -->
        <div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="admin/imgprd/<?php echo $row['ImgPro']; ?>" alt="Product Image" class="img-fluid" style="width: 400px; height: auto;">
        </div>

        <div class="col-md-6">
            <h2 class="product-name"><?php echo $row['NamePro']; ?></h2>
            <?php if ($salePro != 0) { ?>
                <div class="product__panel-sale">
                    Sale <?php echo $salePro; ?>%
                </div>
                <br>
                <br>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="product__panel-price-old">Giá chỉ còn: <?php echo formatCurrency($discountedPrice) ?>đ</span>
                </div>
            <?php } else { ?>
                <h5 class="product__panel-price-old"><?php echo formatCurrency($pricePro) ?>đ</h5>
            <?php } ?>
            <div class="product-description mt-5">
            <div class="product-description mt-5">
    <h3>Mô Tả Sản Phẩm</h3>
    <?php
    $description = $row['DesPro'];
    $word_limit = 100;
    $words = explode(" ", $description);
    if (count($words) > $word_limit) {
        $short_description = implode(" ", array_slice($words, 0, $word_limit)). '...';
        $remaining_description = implode(" ", array_slice($words, $word_limit));
        echo '<p>' . $short_description .'<span id="remaining-description" style="display: none;">' . $remaining_description . '</span><a href="#" onclick="showRemainingDescription(); return false;" class="expand"> Xem thêm</a><a href="#" onclick="hideRemainingDescription(); return false;" class="collapse" style="display:none;"> Thu gọn</a></p>';
    } else {
        echo '<p>' . $description . '</p>';
    }
    ?>
</div>





            <div class="mt-3">
            <form method="post" action="cart.php">
    <input type="hidden" name="productId" value="<?php echo $row['IdPro']; ?>">
    <div class="form-group">
  <label for="quantity" class="form-label">Số lượng còn lại: <?php echo $qty; ?></label>
  <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="<?php echo $qty; ?>">
  <input type="hidden" name="qtymax" value="<?php echo $qty; ?>">
</div>
    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
</form>
            </div>
        </div>
    </div>

    <div class="row mt-5">
    <h3>Sản phẩm tương tự</h3>
    <div class="d-flex flex-nowrap overflow-auto">
        <?php
        $category = $row['IdCate']; // Lấy danh mục của sản phẩm hiện tại
        $similar_query = "SELECT * FROM product WHERE IdCate = '$category' AND IdPro != {$row['IdPro']} LIMIT 4";
        $similar_result = $conn->query($similar_query);

        if ($similar_result->num_rows > 0) {
            while ($similar_row = $similar_result->fetch_assoc()) {
                $image_path = "admin/imgprd/" . $similar_row['ImgPro'];
                
        ?>
                <div class="col-md-3 mb-1"> <!-- Sửa giá trị margin-bottom và col-md-4 -->
                    <div class="card product__panel-item">
                        <div class="position-relative">
                            <a href="detail.php?IdPro=<?php echo $similar_row['IdPro'] ?>">
                                <img src="<?php echo $image_path ?>" class="card-img-top" alt="<?php echo $similar_row['NamePro'] ?>" width="300" height="200">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title product__panel-heading">
                                <a href="detail.php?IdPro=<?php echo $similar_row['IdPro'] ?>" class="product__panel-link">
                                    <?php echo  $similar_row['NamePro']; ?>
                                </a>
                            </h5>
                            
                            <?php 
                            $discountedprice = $similar_row['PricePro'] - ($similar_row['PricePro'] *  $similar_row['SalePro'] / 100);
                            if ($salePro != 0) { ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product__panel-price-old"><del><?php echo formatCurrency($similar_row['PricePro']) ?>đ</del></span>
                                    <h5 class="text-danger"><?php echo formatCurrency($discountedprice) ?>đ</h5>
                                </div>
                            <?php } else { ?>
                                <h5 class="text-dark"><?php echo formatCurrency($similar_row['PricePro']) ?>đ</h5>
                            <?php } ?>
                            <div class="bestselling__product-btn-wrap mt-3">
                                <a href="detail.php?IdPro=<?php echo  $similar_row['IdPro'] ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<style>
    .product__panel-item {
        margin-bottom: 5px; /* Sửa giá trị margin-bottom thành 5px */
    }

    .card {
        max-width: 220px; /* Độ rộng tối đa của thẻ card */
    }
</style>

    


        <!-- Phần comment -->
        <h3 class="mt-5">Bình luận</h3>
         <!-- Hiển thị các comment cũ -->
         <?php
$sql = "SELECT * FROM commentpr where IdPro=".$_SESSION['IdPro'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<style>
.comment-container {
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    background-color: #f9f9f9;
}

.comment {
    margin-bottom: 10px;
}

.comment .comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #888;
    font-size: 14px;
}

.comment .comment-content {
    margin-top: 10px;
    font-size: 16px;
}

.reply {
    background-color: #eee;
    padding: 10px;
    margin-left: 30px;
    border-left: 2px solid #ccc;
}

.reply .comment-header {
    color: #666;
}

.reply .comment-content {
    font-size: 14px;
}
</style>

<?php
if ($row['Status'] == 0) {
    // Display the comment if status = 0
    ?>
    <div class="comment-container">
        <div class="comment">
            <div class="comment-header">
                <span class="comment-author"><?php echo $row['Fname'] ?></span>
                <span class="comment-date"><?php echo date('d/m/Y', strtotime($row['TimeCmt'])) ?></span>
            </div>
            <div class="comment-content"><?php echo $row['ContentCmt'] ?></div>
        </div>
    </div>
    <?php
} elseif ($row['Status'] == 1) {
    // Get the IdCmt of the comment
    $IdCmt = $row['IdCmt'];
    // Query the replies that have the same IdCmt as the current comment
    $sql_reply = "SELECT * FROM commentpr WHERE Reply = $IdCmt ORDER BY TimeCmt ASC";
    $result_reply = $conn->query($sql_reply);
    // Display the comment and its corresponding replies
    ?>
    <div class="comment-container">
        <div class="comment">
            <div class="comment-header">
                <span class="comment-author"><?php echo $row['Fname'] ?></span>
                <span class="comment-date"><?php echo date('d/m/Y', strtotime($row['TimeCmt'])) ?></span>
            </div>
            <div class="comment-content"><?php echo $row['ContentCmt'] ?></div>
        </div>
        <?php
        // Display the replies
        if ($result_reply->num_rows > 0) {
            while ($row_reply = $result_reply->fetch_assoc()) {
                ?>
                <div class="reply">
                    <div class="comment-header">
                        <span class="comment-author">Chủ shop đã trả lời <?php echo $row['Fname'] ?>:</span>
                        <span class="comment-date"><?php echo date('d/m/Y', strtotime($row_reply['TimeCmt'])) ?></span>
                    </div>
                    <div class="comment-content"><?php echo $row_reply['ContentCmt'] ?></div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
}
?>
<?php
    }
}
?>

        <div class="row mt-5">
        <form action="action/comment_action.php" method="post">
                                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                                <div class="d-flex flex-start w-100">
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control" id="textAreaExample"
                                                            name="content" rows="4" style="background: #fff;"
                                                            required></textarea>
                                                    </div>
                                                </div>
                                                <div class="float-end mt-2 pt-1">
                                                    <button type="submit" class="btn btn-primary" name="commentPr">Bình
                                                        luận</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <br>
                                    <br>
                                    <!-- Phần Đánh giá -->
                                    <div class="rating-section">
                                        <?php
                                        $sql = "SELECT SUM(NumVote) AS total_votes, COUNT(*) AS total_rows FROM votepr WHERE IdPro = '" . $_SESSION['IdPro'] . "'";
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
                                            <?php echo $average_rating;
                                            echo "/5" ?>
                                        </h3>
                                        <form action="action/rating_action.php" method="post"
                                            class="d-flex align-items-center">
                                            <div class="rating">
                                                <input type="radio" id="star5" name="rating" value="1" />
                                                <label for="star5" title="5 sao">☆</label>

                                                <input type="radio" id="star4" name="rating" value="2" />
                                                <label for="star4" title="4 sao">☆</label>

                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label for="star3" title="3 sao">☆</label>

                                                <input type="radio" id="star2" name="rating" value="4" />
                                                <label for="star2" title="2 sao">☆</label>

                                                <input type="radio" id="star1" name="rating" value="5" />
                                                <label for="star1" title="1 sao">☆</label>
                                            </div>
                                            <button type="submit" name='ratepr' class="btn btn-primary ml-2">Gửi đánh
                                                giá</button>
                                        </form>
    </div>
     <?php } ?>
                                    </div>
        </div>
        </div>
                <!--- footer -->
                <?php include 'footer.php'; ?>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
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
       //Xem thêm ở mô tả
    function showRemainingDescription() {
        var remainingDescriptionElement = document.getElementById('remaining-description');
        var showMoreLink = document.querySelector('.product-description .expand');
        var hideLink = document.querySelector('.product-description .collapse');
        remainingDescriptionElement.style.display = 'inline';
        showMoreLink.style.display = 'none';
        hideLink.style.display = 'inline';
    }

    function hideRemainingDescription() {
        var remainingDescriptionElement = document.getElementById('remaining-description');
        var showMoreLink = document.querySelector('.product-description .expand');
        var hideLink = document.querySelector('.product-description .collapse');
        remainingDescriptionElement.style.display = 'none';
        showMoreLink.style.display = 'inline';
        hideLink.style.display = 'none';
    }

    </script>
 
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