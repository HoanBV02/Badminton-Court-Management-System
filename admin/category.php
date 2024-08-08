<?php
session_start();
include 'action/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #f8f9fa; /* Set a light background color */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff; /* Set a white background color for the container */
            border-radius: 10px; /* Add a border radius for a rounded appearance */
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1); /* Add a subtle shadow effect */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logout-button {
            background-color: #bfb5d3;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px; /* Add a border radius for a rounded button */
        }

        .logout-button:hover {
            background-color: #bfb5d3;
        }


        .nav-link {
            color: #333; /* Set the color of nav links */
        }

        .nav-link:hover {
            color: #8C8CAB

; /* Change the color of nav links on hover */
        }

        /* Highlight the active menu item */
        .active {
            background-color: #b8b8ff;
            color: #fff;
            border-radius: 5px;
            padding: 8px 16px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="admin.php"><h1>Admin</h1></a>
            <a href="action/logout.php" class="logout-button">Đăng xuất</a>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a href="admin.php" class="nav-link ">Quản lý người dùng</a>
            </li>
            <li class="nav-item">
                <a href="products.php" class="nav-link ">Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a href="orders.php" class="nav-link ">Quản lý đơn hàng</a>
            </li>
            <li class="nav-item">
                <a href="category.php" class="nav-link active">Quản lý loại hàng</a>
            </li>
            <li class="nav-item">
                <a href="cmt.php" class="nav-link">Quản lý bình luận</a>
            </li>
        </ul>
    </div>
    <div class="container">
    <h2>Loại hàng</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã loại hàng</th>
                    <th>Tên loại hàng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Truy vấn cơ sở dữ liệu để lấy thông tin đơn hàng
                $sql_orders = "SELECT * FROM category";
                $result_orders = $conn->query($sql_orders);
                if ($result_orders->num_rows > 0) {
                    while ($row = $result_orders->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["IdCate"] . "</td>";
                        echo "<td>" . $row["NameCate"] . "</td>";
                        echo "<td>"; // Thêm một cột mới cho trạng thái và button
                        echo '<form action="category.php" method="post">';
                        echo '<input type="hidden" name="id" value="' . $row["IdCate"] . '">'; // Thêm một trường ẩn để chứa ID của danh mục
                        if ($row["Status"] == 1) {
                            echo '<button type="submit" name="lock" class="btn btn-danger">Khóa</button>';
                        } else {
                            echo '<button type="submit" name="unlock" class="btn btn-success">Mở khoá</button>';
                        }
                        echo '</form>';
                        echo "</td>";
                        echo "</tr>";
                        
                        
                    }
                } else {
                    echo "<tr><td colspan='2'>Không có loại nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Category Form -->
<div class="container" id="addCategoryContainer" style="display: none;">
    <h2>Thêm loại hàng</h2>
    <form method="POST" action="category.php">
        <div class="form-group">
            <label for="cateName">Tên loại hàng:</label>
            <input type="text" class="form-control" id="cateName" name="cateName" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>

<!-- Add New Button -->
<div class="container" id="addNewContainer">
    <button type="button" class="btn btn-primary" id="addNewBtn">Thêm mới</button>
</div>

<!-- JavaScript/jQuery code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show the add category form and hide the add new button when the add new button is clicked
        $("#addNewBtn").click(function() {
            $("#addCategoryContainer").show();
            $("#addNewContainer").hide();
        });
    });
</script>
</body>
</html>
<?php
if (isset($_POST["cateName"])) {
    $cateName = $_POST["cateName"];

    // Insert the new category into the database
    $sql_insert = "INSERT INTO category (NameCate) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);
    if ($stmt) {
        $stmt->bind_param("s", $cateName);
        $stmt->execute();
        $stmt->close();
?>
        <script>
                Swal.fire({
                    title: 'Thêm thành công',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.history.back(); // Thay đổi URL của trang điều hướng tại đây
                });
              </script>";
  <?php  } else {
        // Handle the error if the SQL statement preparation fails
        echo "Lỗi: " . $conn->error;
    }
}
?>
<?php
if(isset($_POST["lock"])){
    $id=$_POST['id'];
$sql_lock="UPDATE category SET Status = 0 WHERE IdCate = $id";
$sql_lock_product = "UPDATE product SET Status = 0 WHERE IdCate = $id";

if ($conn->query($sql_lock) === TRUE && $conn->query($sql_lock_product)) {
?>

<script>
                Swal.fire({
                    title: 'Khoá thành công',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.location.href = 'http://localhost/DATN/admin/category.php'; // Thay đổi URL của trang điều hướng tại đây
                });
              </script>";
<?php
}
}
if(isset($_POST["unlock"])){
    $id=$_POST['id'];
$sql_unlock="UPDATE category SET Status = 1 WHERE IdCate = $id";
$sql_unlock_product = "UPDATE product SET Status = 1 WHERE IdCate = $id";
if ($conn->query($sql_unlock) === TRUE && $conn->query($sql_unlock_product) ) {
?>

<script>
                Swal.fire({
                    title: 'Mở khoá thành công',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.location.href = 'http://localhost/DATN/admin/category.php'; // Thay đổi URL của trang điều hướng tại đây
                });
              </script>";
<?php
}
}
?>