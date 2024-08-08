<?php
session_start();
include 'action/connect.php';

function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}
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
                <a href="admin.php" class="nav-link active">Quản lý người dùng</a>
            </li>
            <li class="nav-item">
                <a href="products.php" class="nav-link ">Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a href="orders.php" class="nav-link">Quản lý đơn hàng</a>
            </li>
            <li class="nav-item">
                <a href="category.php" class="nav-link">Quản lý loại hàng</a>
            </li>
            <li class="nav-item">
                <a href="cmt.php" class="nav-link">Quản lý bình luận</a>
            </li>
        </ul>
    </div>
<!-- user start -->
<div class="container">
    <h2>Bảng người dùng</h2>
    <div class="input-group mb-3">
    <form action="admin.php" method="POST" class="form-inline">
    <div class="form-group">
        <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Tìm kiếm...">
    </div>
    <button type="submit" name="find" class="btn btn-primary" style="margin-left: 20px;">Tìm kiếm</button>
</form>
<?php

include 'action/connect.php';
if(isset($_POST['find'])){
  $key=$_POST['searchInput'];
  $sql = "SELECT * FROM account WHERE User LIKE '%$key%' OR Fname LIKE '%$key%' OR Tell LIKE '%$key%'";

}
else{
  $sql="SELECT * FROM  account WHERE Permission <>0";
}
?>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Tên đăng nhập</th>
          <th>Họ và tên</th>
          <th>Số điện thoại</th>
          <th>Địa chỉ</th>
          <th>Vai trò</th>
          <th>Trạng thái</th>
        </tr>
      </thead>
      <tbody>
      <?php

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idacc=$row['IdAcc'];
?>
        <tr>
          <td><?php echo $row['User'] ?></td>
          <td><?php echo $row['Fname'] ?></td>
          <td><?php echo $row['Tell'] ?></td>
          <td><?php echo $row['AddrAcc'] ?></td>
          <td>
    <?php 
        if ($row['Permission'] == 0) {
            echo "Admin";
        } elseif ($row['Permission'] == 1) {
            echo "Người dùng";
        } elseif ($row['Permission'] == 2) {
            echo "Đối tác";
        } else {
            echo "Không xác định";
        }
    ?>
</td>
<form action ="admin.php"method="POST">
<input type=hidden name="IdAcc" value="<?php echo $row['IdAcc'] ?>">
<?php
if ($row['Status'] == 1) {
    echo '<td><button class="btn btn-danger" name="block">Khoá</button></td><br>';
} else {
    echo '<td><button class="btn btn-primary" name="unblock">Mở khoá</button></td>';
}
?>

        </tr>
      </form>
       <?php 
       }
    }
    else{
      echo 'Không tìm thấy người dùng';
    }?>
    <?php
    
    if(isset($_POST["block"])){
        $id = $_POST['IdAcc'];
    ?>
    <script>
        Swal.fire({
            title: "Xác nhận khoá",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Khoá",
            cancelButtonText: "Quay lại"
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu người dùng đã xác nhận huỷ, thực hiện cập nhật và hiển thị thông báo thành công
                Swal.fire({
                    title: "Thành công",
                    text: "Mở khoá thành công",
                    icon: "success"
                }).then(function () {
                    window.location.href = "http://localhost/DATN/admin/admin.php";
                });
                <?php 
                // Update the database to block the account
                $sql = "UPDATE account 
                        SET Status = 0 
                        WHERE IdAcc = $id";
                if (mysqli_query($conn, $sql)) {
                    // If the update was successful, you may perform additional actions here
                }
                ?>
            }
        });
    </script>
    <?php
}

if(isset($_POST["unblock"])){
    $id = $_POST['IdAcc'];
?>
<script>
    Swal.fire({
        title: "Mở khoá",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Mở khoá",
        cancelButtonText: "Quay lại"
    }).then((result) => {
        if (result.isConfirmed) {
            // Nếu người dùng đã xác nhận huỷ, thực hiện cập nhật và hiển thị thông báo thành công
            Swal.fire({
                title: "Thành công",
                text: "Mở khoá thành công",
                icon: "success"
            }).then(function () {
                window.location.href = "http://localhost/DATN/admin/admin.php";
            });
            <?php 
            // Update the database to block the account
            $sql = "UPDATE account 
                    SET Status = 1 
                    WHERE IdAcc = $id";
            if (mysqli_query($conn, $sql)) {
                // If the update was successful, you may perform additional actions here
            }
            ?>
        }
    });
</script>
<?php
}
    ?>
        <!-- Thêm các hàng dữ liệu khác tại đây -->
      </tbody>
    </table>
  </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>