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
                <a href="orders.php" class="nav-link active">Quản lý đơn hàng</a>
            </li>
            <li class="nav-item">
                <a href="category.php" class="nav-link">Quản lý loại hàng</a>
            </li>
            <li class="nav-item">
                <a href="cmt.php" class="nav-link">Quản lý bình luận</a>
            </li>
        </ul>
    </div>
        <!-- Biểu đồ -->
       <center> <div class="chart-container" style="width: 600px; height: 300px;">
    <canvas id="orderChart"></canvas>
    <canvas id="cancelledChart"></canvas>
</div></center>
        <?php
$currentMonth = date('n');
$tong = 0;
// Khởi tạo mảng chứa dữ liệu thu nhập theo tháng
$orderData = array();
$cancelledData = array(); // Mảng chứa dữ liệu tỉ lệ huỷ đơn

// Vòng lặp qua các tháng từ tháng 1 đến tháng hiện tại
for ($month = 1; $month <= $currentMonth; $month++) {
    // Câu truy vấn SQL để tính tổng đơn hàng cho tháng hiện tại
    $sql = "SELECT SUM(total) AS TotalOrder FROM orders WHERE MONTH(date) = $month AND Status = 0";

    // Thực thi câu truy vấn
    $result = $conn->query($sql);

    // Lấy kết quả
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalOrder = (int)$row["TotalOrder"];

        $tong += $totalOrder;
    } else {
        $totalOrder = 0;
    }

    // Thêm dữ liệu đơn hàng vào mảng
    $orderData[] = $totalOrder;

    // Câu truy vấn SQL để tính tỉ lệ huỷ đơn cho tháng hiện tại
    $sql_cancelled = "SELECT COUNT(*) AS CancelledOrders FROM orders WHERE MONTH(date) = $month AND Status = 1";

    // Thực thi câu truy vấn
    $result_cancelled = $conn->query($sql_cancelled);

    // Lấy kết quả
    if ($result_cancelled->num_rows > 0) {
        $row_cancelled = $result_cancelled->fetch_assoc();
        $cancelledOrders = (int)$row_cancelled["CancelledOrders"];
    } else {
        $cancelledOrders = 0;
    }

    // Thêm dữ liệu tỉ lệ huỷ đơn vào mảng
    $cancelledData[] = $cancelledOrders;
}

// Chuyển đổi dữ liệu đơn hàng thành chuỗi JSON
$orderJson = json_encode($orderData);
$cancelledJson = json_encode($cancelledData);
?>
        <!-- Danh sách đơn hàng -->
        <center><h2>Danh sách đơn hàng</h2></center>
<div class="container">
    <form action="orders.php" method="GET">
        <div class="form-group">
            <input type="text" class="form-control" id="search-input" name="keyword" placeholder="Tìm kiếm">
        </div>
        <button type="submit" name="find" class="btn btn-primary" id="search-button">Tìm kiếm</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Truy vấn cơ sở dữ liệu để lấy thông tin đơn hàng
                if (isset($_GET['find'])) {
                    $key = $_GET['keyword'];
                    $sql = "SELECT * FROM orders WHERE Fname LIKE '%$key%' OR Tell LIKE '%$key%' OR Addr LIKE '%$key%' OR NamePro LIKE '%$key%'";
                } else {
                    $sql = "SELECT * FROM orders";
                }
                $result_orders = $conn->query($sql);
                if ($result_orders->num_rows > 0) {
                    while ($row = $result_orders->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Fname"] . "</td>";
                        echo "<td>" . $row["Tell"] . "</td>";
                        echo "<td>" . $row["Addr"] . "</td>";
                        echo "<td>" . $row["NamePro"] . "</td>";
                        echo "<td>" . $row["QtyPro"] . "</td>";
                        echo "<td>" . $row["Total"] . "</td>";
                        echo "<td>" . ($row["Status"] == 1 ? "Hủy" : "Hoàn thành") . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có đơn hàng nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
    <script>
        // JavaScript code for the charts
        var orderData = <?php echo $orderJson; ?>;
    var cancelledData = <?php echo $cancelledJson; ?>;
    var orderLabels = [];
    for (var month = 1; month <= orderData.length; month++) {
        orderLabels.push("Tháng " + month);
    }

    var ctx_order = document.getElementById('orderChart').getContext('2d');
    var orderChart = new Chart(ctx_order, {
        type: 'line', // Sử dụng biểu đồ đường
        data: {
            labels: orderLabels,
            datasets: [{
                label: 'Doanh thu',
                data: orderData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Số đơn huỷ',
                data: cancelledData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            layout: {
                padding: {
                    left: 50,
                    right: 50,
                    top: 0,
                    bottom: 0
                }
            }
        }
    });
    </script>
</body>
</html>