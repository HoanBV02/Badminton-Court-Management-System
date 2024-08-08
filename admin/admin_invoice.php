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


<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
            <li><a href="http://localhost/DATN/admin/admin_partner.php" data-target="overviewContent">Tổng quan</a></li>
                <li><a href="http://localhost/DATN/admin/admin_yard.php" data-target="manageContentclass" >Quản lý sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_invoice.php" data-target="invoiceContent" class="active">Quản lý thuê sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_cmt.php" data-target="invoiceContent" >Quản lý bình luận</a></li>
                <a href='action/logout.php'>Đăng xuất</a>
            </ul>
        </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                body {
                    font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
                }
            </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Liên kết với tệp CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Liên kết với Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Liên kết với jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Liên kết với Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-4">
   
    <form action="admin_invoice.php" method="POST">
    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Lọc theo ngày</h4>
            <!-- Ô lọc theo ngày -->
            <input type="date" name="date" class="form-control" id="dateFilter">
        </div>
        <div class="col-md-12 mt-3">
            <!-- Nút Lọc -->
            <button class="btn btn-primary" name="filter">Lọc</button>
            <a href="admin_invoice.php" class="btn btn-info">Bỏ lọc</a>
        </div>
        </div>
      

    <div class="row mt-4">
        <div class="col-md-12">
            <!-- Bảng danh sách đặt sân -->
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Ngày</th>
                        <th>Địa chỉ</th>
                        <th>Thời gian</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if filter button is clicked
                    if(isset($_POST['filter'])){
                        $date=$_POST['date'];
                        $sql="SELECT * FROM booking WHERE IdPartner=$idp AND Date='$date'";
                    } else {
                        // If filter button is not clicked, retrieve all bookings
                        $sql="SELECT * FROM booking WHERE IdPartner=$idp ORDER BY Date DESC";
                    }
                    
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <!-- Dữ liệu danh sách đặt sân sẽ được thêm vào đây -->
                    <tr>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Tell'] ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['Date'])) ?></td>
                        <td><?php echo $row['AddYard'] ?></td>
                        <td><?php if ($row['Time'] == 1) {
                                    echo "5:00 - 8:00";
                                } else if ($row['Time'] == 2) {
                                    echo "8:00 - 12:00";
                                } else if ($row['Time'] == 3) {
                                    echo "12:00 - 16:00";
                                } else if ($row['Time'] == 4) {
                                    echo "16:00 - 20:00";
                                } else if ($row['Time'] == 5) {
                                    echo "Cả ngày";
                                } ?></td>
                        <td><?php echo formatCurrency($row['Price']) ?></td>
                        <form action="admin_invoice.php" method="POST">
                        <input type="hidden" name="bkid" value="<?php echo $row['IdBooking'] ?>">
                        <td>
                            <!-- Nút huỷ và thanh toán -->
                            <?php if($row['Status']==0){ ?>
                            <input type="submit" name="cancel"class="btn btn-danger" value="Huỷ"></button>
                            <input type="submit" name="pay"class="btn btn-success" value="Thanh toán"></button>
                            <?php } elseif ($row['Status'] == 1) { ?>
                                 <input type="submit" name="undo"class="btn btn-danger"value="Hoàn tác"></button>
                            <?php } elseif($row['Status']==2 || $row['Status']==3){ ?>
                                 <button class="btn btn-success">Đã thanh toán</button>
                            <?php } ?>
                        </td>
                        </form>
                    </tr>
                    <?php }} ?>
                    <!-- Các hàng dữ liệu khác -->
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>



<?php
if(isset($_POST['cancel'])){
    $idbk=$_POST['bkid'];
    ?>
    <script>
    Swal.fire({
        title: "Bạn có chắc muốn huỷ",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Huỷ",
        cancelButtonText: "Không"
    }).then((result) => {
        if (result.isConfirmed) {
            // Nếu người dùng đã xác nhận huỷ, thực hiện cập nhật và hiển thị thông báo thành công
            Swal.fire({
                title: "Đã huỷ",
                text: "Bạn huỷ thành công",
                icon: "success"
            }).then(function () {
            window.location.href = "http://localhost/DATN/admin/admin_invoice.php";
        });
            // Thực hiện cập nhật trong cơ sở dữ liệu
            <?php
            $sql1= "UPDATE booking SET Status=1 WHERE IdBooking='$idbk'";
            if (mysqli_query($conn, $sql1)) { ?>
                // Đoạn mã JavaScript được thực hiện sau khi cập nhật thành công
            <?php } ?>
        }
    });
    </script>
<?php
}

if(isset($_POST["pay"])){
    $idbk=$_POST['bkid'];
    ?>
    <script>
    Swal.fire({
        title: "Xác nhận thanh toán",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Thanh toán",
        cancelButtonText: "Không"
    }).then((result) => {
        if (result.isConfirmed) {
            // Nếu người dùng đã xác nhận huỷ, thực hiện cập nhật và hiển thị thông báo thành công
            Swal.fire({
                title: "Thành công",
                text: "Thanh toán thành công",
                icon: "success"
            }).then(function () {
            window.location.href = "http://localhost/DATN/admin/admin_invoice.php";
        });
            // Thực hiện cập nhật trong cơ sở dữ liệu
            <?php
            $sql1= "UPDATE booking SET Status=2 WHERE IdBooking='$idbk'";
            if (mysqli_query($conn, $sql1)) { ?>
                // Đoạn mã JavaScript được thực hiện sau khi cập nhật thành công
            <?php } ?>
        }
    });
    </script>
    <?php
}

if(isset($_POST["undo"])){
    $idbk=$_POST['bkid'];
    ?>
    <script>
    Swal.fire({
        title: "Xác nhận hoàn tác",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xác nhận",
        cancelButtonText: "Không"
    }).then((result) => {
        if (result.isConfirmed) {
            // Nếu người dùng đã xác nhận huỷ, thực hiện cập nhật và hiển thị thông báo thành công
            Swal.fire({
                title: "Thành công",
                text: "Hoàn tác thành công",
                icon: "success"
            }).then(function () {
            window.location.href = "http://localhost/DATN/admin/admin_invoice.php";
        });
            // Thực hiện cập nhật trong cơ sở dữ liệu
            <?php
            $sql1= "UPDATE booking SET Status=0 WHERE IdBooking='$idbk'";
            if (mysqli_query($conn, $sql1)) { ?>
                // Đoạn mã JavaScript được thực hiện sau khi cập nhật thành công
            <?php } ?>
        }
    });
    </script>
    <?php
}
?>
</body>
</html>


