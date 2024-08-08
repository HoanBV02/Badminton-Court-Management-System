<?php
session_start();
include 'action/connect.php';
$idp = $_SESSION['Id'];


function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/partner.css">
    <style>
        /* Định dạng chung */
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
            <li><a href="http://localhost/DATN/admin/admin_partner.php" data-target="overviewContent" class="active">Tổng quan</a></li>
                <li><a href="http://localhost/DATN/admin/admin_yard.php" data-target="manageContentclass" >Quản lý sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_invoice.php" data-target="invoiceContent" >Quản lý thuê sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_cmt.php" data-target="invoiceContent" >Quản lý bình luận</a></li>
                <a href='action/logout.php'>Đăng xuất</a>
            </ul>
        </div>
        <div class="content active" id="overviewContent">
            <h1>Tổng quan thu nhập trong tháng</h1>
            <canvas id="myChart"></canvas>

            <?php
            $currentMonth = date('n');
            $tong = 0;
            // Khởi tạo mảng chứa dữ liệu thu nhập theo tháng
            $incomeData = array();

            // Vòng lặp qua các tháng từ tháng 1 đến tháng hiện tại
            for ($month = 1; $month <= $currentMonth; $month++) {
                // Câu truy vấn SQL để tính tổng thu nhập cho tháng hiện tại
                $sql = "SELECT SUM(Price) AS TotalIncome FROM booking WHERE Status = 2 OR   Status = 3  AND MONTH(Date) = $month AND IdPartner = $idp";

                // Thực thi câu truy vấn
                $result = $conn->query($sql);

                // Lấy kết quả
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalIncome = (int)$row["TotalIncome"];

                    $tong += $totalIncome;
                } else {
                    $totalIncome = 0;
                }

                // Thêm dữ liệu thu nhập vào mảng
                $incomeData[] = $totalIncome;
            }

            // Chuyển đổi dữ liệu thu nhập thành chuỗi JSON
            $incomeJson = json_encode($incomeData);
            ?>

            <script>
                var incomeData = <?php echo $incomeJson; ?>;
                var labels = [];
                for (var month = 1; month <= incomeData.length; month++) {
                    labels.push("Tháng " + month);
                }

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Thu nhập',
                            data: incomeData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>


            <div class="stats">
                <div class="stat">
                    <h3>Tổng số tiền</h3>
                    <p> <?php
                        echo formatCurrency($tong);
                        ?>
                    </p>
                </div>
                <div class="stat">
                    <h4>Số lần thuê <br> tháng này</h4>
                    <?php
                    $sql1 = "SELECT IdPartner, COUNT(*)
                        FROM booking
                        WHERE MONTH(date) = $currentMonth AND YEAR(date) = YEAR(CURRENT_DATE())
                        GROUP BY IdPartner
                        ";
                    $result = $conn->query($sql1);

                    // Kiểm tra và hiển thị kết quả
                    if ($result->num_rows > 0) {
                        if($row = $result->fetch_assoc()) {
                            ?>
                            <p><?php echo $row["COUNT(*)"];  ?></p>
                </div>
            <?php }
            
            } else {
                echo 0;
            } ?>
            </div>
        </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    
</body>

</html>
