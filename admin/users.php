
<!DOCTYPE html>
<html>
<head>
  <title>Bảng người dùng</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
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
  $sql="SELECT * FROM  account";
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
    echo '<td><button class="btn btn-danger" name="block">Khoá</button></td>';
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
    $id=$_POST['IdAcc'];
   $sql = "UPDATE account 
   SET Status=0 
   WHERE IdAcc = $id";
   if (mysqli_query($conn, $sql)) { ?>
       <script>
                       Swal.fire({
                           title: "Cập nhật thành công",
                           icon: "success",
                           showCancelButton: false,
                           confirmButtonText: "OK"
                       }).then(function () {
                           window.location.href = 'http://localhost/DATN/admin/admin.php'; // Thay đổi URL của trang điều hướng tại đây
                       });
                   </script><?php }
}
if(isset($_POST["unblock"])){
  $id=$_POST['IdAcc'];
  $sql = "UPDATE account
  SET Status=1 
  WHERE IdAcc = $id";
  if (mysqli_query($conn, $sql)) { ?>
      <script>
                      Swal.fire({
                          title: "Cập nhật thành công",
                          icon: "success",
                          showCancelButton: false,
                          confirmButtonText: "OK"
                      }).then(function () {
                        window.location.href = 'http://localhost/DATN/admin/admin.php';  // Thay đổi URL của trang điều hướng tại đây
                      });
                  </script><?php }
}
    ?>
        <!-- Thêm các hàng dữ liệu khác tại đây -->
      </tbody>
    </table>
  </div>

 
</body>
</html>