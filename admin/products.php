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
        .overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

#addForm {
  background-color: #fff;
  padding: 20px;
  z-index: 10000;
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
                <a href="products.php" class="nav-link active ">Quản lý sản phẩm</a>
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
<!-- product start -->
    <div class="container">
        <h2>Bảng sản phẩm</h2>
        <!-- Thêm biểu mẫu tìm kiếm -->
        <div class="input-group mb-3">
            <form action="products.php" id="searchForm" class="form-inline" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Tìm kiếm...">
                </div>
                <button type="submit" name="findpr" class="btn btn-primary" style="margin-left: 20px;">Tìm kiếm</button>
            </form>
        </div>
        <!-- Bảng sản phẩm -->
        <table class="table">
            <thead>
                
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giảm giá</th>
                    <th></th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <?php
                // Lấy dữ liệu từ CSDL và hiển thị trong bảng
                include 'action/connect.php'; // Kết nối CSDL
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 7;
$offset = ($page - 1) * $records_per_page;

                // Xử lý trường hợp khi tìm kiếm
                if (isset($_POST['findpr'])) {
                    $key = $_POST['searchInput'];
                    $sql = "SELECT * FROM product WHERE NamePro LIKE '%$key%' LIMIT $offset, $records_per_page";
                    $_SESSION['current_tab'] = 'products';
                } else {
                    $sql = "SELECT * FROM product LIMIT $offset, $records_per_page";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><img src="imgprd/<?php echo $row['ImgPro']; ?>" style="width: 100px;"></td>
                            <td><?php echo $row['NamePro']; ?></td>
                            <td><?php echo formatCurrency($row['PricePro']); ?></td>
                            <td><?php echo $row['QtyPro']; ?></td>
                            <td><?php echo $row['SalePro']; ?>%</td>
                            <td>
                            <!-- Display Edit Button -->
<!-- Display Edit Button -->
<td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-action" onclick="showEditForm(<?php echo $row['IdPro'] ?>)">Sửa</button>
                                            <form action="products.php" method="POST">
                                            <input type="hidden" name="productId" value="<?php echo $row['IdPro'] ?>">
                                            <?php if($row['Status'] == '1') {?>
                                            <button type="submit" name="block" class="btn btn-danger btn-action">Khoá</button>
                                            <?php }
                                            else{?>
                                                <button type="submit" name="unblock" class="btn btn-danger btn-action">Mở khoá</button>
                                           <?php }
                                            ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="editForm<?php echo $row['IdPro'] ?>" class="edit-row" style="display:none;">
                                    <td colspan="6">
                                        <form action="products.php" method="POST" class="edit-form">
                                            <div class="form-group">
                                                <label for="edit_image">Ảnh:</label>
                                                <input type="file" id="edit_image" name="ImgPro" accept="image/*">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_name">Tên:</label>
                                                <input type="text" id="edit_name" name="NamePro" value="<?php echo $row['NamePro'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_sale">Giảm giá:</label>
                                                <input type="text" id="edit_sale" name="SalePro" value="<?php echo $row['SalePro'] ?>%">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_qty">Số lượng</label>
                                                <input type="text" id="edit_qty" name="QtyPro" value="<?php echo $row['QtyPro'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_price">Giá:</label>
                                                <input type="text" id="edit_price" name="PricePro" value="<?php echo $row['PricePro'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_description">Mô tả:</label>
                                                <textarea id="edit_description" name="DesPro"><?php echo $row['DesPro'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label for="type">Loại:</label>
                                            <select name="type_edit" class="form-control" required>
                                                <?php 
                                                $sqlselect = 'SELECT * FROM category';
                                                $result3 = $conn->query($sqlselect);
                                                if ($result3->num_rows > 0) {
                                                    while ($rowsl = $result3->fetch_assoc()) {  
                                                ?>
                                                    <option value="<?php echo $rowsl['IdCate'] ?>"><?php echo $rowsl['NameCate'] ?></option>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </select>   
                                        </div>


                                            <input type="hidden" name="productId" value="<?php echo $row['IdPro'] ?>">
                                            <input type="submit" name="save" value="Lưu" class="btn btn-primary">
                                            <button type="button" onclick="closeEditForm(<?php echo $row['IdPro'] ?>)" class="btn btn-secondary">Đóng</button>
                                           
                                        </form>
                                    </td>
                                </tr>


                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <button id="addButton" class="btn btn-primary">Thêm sản phẩm</button>
                <div id="overlay" style="display: none;"></div>
  <form action="products.php" method="POST" id="addForm" style="display: none;">
    <div class="form-group">
      <label for="name">Tên:</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="price">Giá:</label>
      <input type="number" name="price" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="quantity">Số lượng:</label>
      <input type="number" name="quantity" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="image">Ảnh:</label>
      <input type="file" name="image" class="form-control-file" required>
    </div>
    <div class="form-group">
      <label for="discount">Giảm giá:</label>
      <input type="number" name="discount" class="form-control">
    </div>
    <div class="form-group">
      <label for="description">Mô tả:</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label for="type">Loại:</label>
      <select name="type" class="form-control" required>
      <?php 
      $sqlselect=   'SELECT * FROM category';
      $result3 = $conn->query($sqlselect);
      if ($result->num_rows > 0) {
        while ($rowsl = $result3->fetch_assoc()) {  
      ?>
   
        <option value="<?php echo $rowsl['IdCate'] ?>"><?php echo $rowsl['NameCate'] ?></option>
      
      <?php }
      }
    ?>
    </select>   
    </div>
   
    <button type="submit" name="add" class="btn btn-primary">Lưu</button>
  </form>

            </form>
            
            <div class="text-center" style="width: 100%; margin: auto;">
    <div class="pagination center-pagination" style="display: flex; justify-content: center;">
        <?php
        // Count total records
        if (isset($_POST['findpr'])) {
            $key = $_POST['searchInput'];
            $sql_total_records = "SELECT COUNT(*) AS total FROM product WHERE NamePro LIKE '%$key%'";
        } else {
            $sql_total_records = "SELECT COUNT(*) AS total FROM product";
        }

        $result_total_records = $conn->query($sql_total_records);
        $total_rows = $result_total_records->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $records_per_page);

        // Generate pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
            if (isset($_POST['findpr'])) {
                echo "<a href='?page=$i&searchInput=$key'>$i</a> ";
            } else {
                echo "<a href='?page=$i'>$i</a> ";
            }
        }
        ?>
    </div>
</div>
</div>
<script>
  document.getElementById("addButton").addEventListener("click", function() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("addForm").style.display = "block";
  });
</script>
            <script>
              function showEditForm(formId) {
    var form = document.getElementById("editForm" + formId);
    form.style.display = "table-row";
}
function closeEditForm(id) {
        document.getElementById('editForm' + id).style.display = 'none';
    }
            </script>
           

    </div>
<?php
   if(isset($_POST["save"])) {
    $productId = $_POST['productId'];
    $namePro = $_POST['NamePro'];
    $pricePro = $_POST['PricePro'];
    $desPro = $_POST['DesPro'];
    $qtyPro = $_POST['QtyPro'];
    $imgPro = $_POST['ImgPro'];
    $salePro = $_POST['SalePro'];
    $cate = $_POST['type_edit'];

    if ($imgPro == '') {
        $sqlupdate = "UPDATE product
                     SET NamePro = ?, PricePro = ?, DesPro = ?, QtyPro = ?, SalePro = ?, IdCate = ?
                     WHERE IdPro = ?";
    } else {
        $sqlupdate = "UPDATE product
                     SET NamePro = ?, PricePro = ?, DesPro = ?, ImgPro = ?, QtyPro = ?, SalePro = ?, IdCate = ?
                     WHERE IdPro = ?";
    }

    $stmt = $conn->prepare($sqlupdate);
    if($stmt) {
        if ($imgPro == '') {
            $stmt->bind_param("ssssisi", $namePro, $pricePro, $desPro, $qtyPro, $salePro, $cate, $productId);
        } else {
            $stmt->bind_param("sssssssi", $namePro, $pricePro, $desPro, $imgPro, $qtyPro, $salePro, $cate, $productId);
        }
        $stmt->execute();
        $stmt->close();
        ?>

        // Cập nhật thành công, thực hiện các hành động khác
        <script>
                Swal.fire({
                    title: 'Cập nhật thành công',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.history.back(); // Thay đổi URL của trang điều hướng tại đây
                });
              </script>";
    <?php } else {
        // Có lỗi xảy ra trong quá trình chuẩn bị câu lệnh SQL
        echo "Lỗi: " . $conn->error;
    }
}

if(isset($_POST["block"])){
    $id=$_POST['productId'];
   $sql = "UPDATE product 
   SET Status=0 
   WHERE IdPro = $id";
   if (mysqli_query($conn, $sql)) { ?>
       <script>
                       Swal.fire({
                           title: "Cập nhật thành công",
                           icon: "success",
                           showCancelButton: false,
                           confirmButtonText: "OK"
                       }).then(function () {
                           window.location.href = 'http://localhost/DATN/admin/products.php'; // Thay đổi URL của trang điều hướng tại đây
                       });
                   </script><?php }
}
if(isset($_POST["unblock"])){
    $id=$_POST['productId'];
  $sql = "UPDATE product 
  SET Status=1 
  WHERE IdPro = $id";
  if (mysqli_query($conn, $sql)) { ?>
      <script>
                      Swal.fire({
                          title: "Cập nhật thành công",
                          icon: "success",
                          showCancelButton: false,
                          confirmButtonText: "OK"
                      }).then(function () {
                       window.location.href = 'http://localhost/DATN/admin/products.php';   // Thay đổi URL của trang điều hướng tại đây
                      });
                  </script><?php }
}
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image']['name'];
    $img= $_POST['image'];
    $description = $_POST['description'];
    $category = $_POST['type'];
    $discount = $_POST['discount'];
    // Di chuyển tệp tin ảnh vào thư mục lưu trữ (nếu cần)
    // Thực thi truy vấn INSERT vào bảng "product"
    $sql = "INSERT INTO product (NamePro, PricePro, QtyPro, ImgPro, DesPro, Category, SalePro)
            VALUES ('$name', '$price', '$quantity', '$image', '$description', '$category', '$discount')";
    if ($conn->query($sql) === TRUE) {
        ?>
      <script>
                      Swal.fire({
                          title: "Thêm thành công",
                          icon: "success",
                          showCancelButton: false,
                          confirmButtonText: "OK"
                      }).then(function () {
                       window.location.href = 'http://localhost/DATN/admin/products.php';   // Thay đổi URL của trang điều hướng tại đây
                      });
                  </script><?php }
     else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

?>

