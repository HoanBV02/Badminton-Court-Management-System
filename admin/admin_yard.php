
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
                <li><a href="http://localhost/DATN/admin/admin_partner.php" data-target="overviewContent" >Tổng quan</a></li>
                <li><a href="http://localhost/DATN/admin/admin_yard.php" data-target="manageContentclass" class="active">Quản lý sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_invoice.php" data-target="invoiceContent" >Quản lý thuê sân</a></li>
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
    <div class="container">
            <form action="action/yard_action.php" method="POST">
                <table class="table">
                    <thead>
                        <tr>    
                            <th>Ảnh</th>
                            <th>Tên sân</th>
                            <th>Địa chỉ</th>
                            <th>Giá tiền</th>
                            <th>Số lượng sân</th>
                            <th>Mô tả</th>
                            <th>Đánh giá</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      $page = isset($_GET['page']) ? $_GET['page'] : 1;
                      $yardsPerPage = 5; // Number of yards to display per page
                      
                      // Calculate the starting point for the results
                      $startFrom = ($page - 1) * $yardsPerPage;
                      
                      $sqlCount = "SELECT COUNT(*) AS total FROM yard WHERE IdAcc=$idp";
                      $resultCount = $conn->query($sqlCount);
                      $rowCount = $resultCount->fetch_assoc();
                      $totalYards = $rowCount['total'];
                      $totalPages = ceil($totalYards / $yardsPerPage);
                      
                      $sql2 = "SELECT * FROM yard WHERE IdAcc=$idp LIMIT $startFrom, $yardsPerPage";
                      $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $idy=$row2['IdYard'];
                                
                                ?>
                                <tr>
                                    <td><?php echo $row2['ImgYard'] ?></td>
                                    <td><?php echo $row2['NameYard'] ?></td>
                                    <td><?php echo $row2['AddYard'] ?></td>
                                    <td><?php echo formatCurrency($row2['PriceYard']); 
                                    echo '<br>' ;?> 
                                    <?php echo formatCurrency($row2['PriceYards']) ?>
                                </td>
                                    <td><?php echo $row2['Qty'] ?></td>
                                    
                                    
                                    <td><?php echo substr($row2['DesYard'], 0, 100) ?></td>
                                    <?php
                                        $sql3 = "SELECT SUM(NumVote) AS total_votes, COUNT(*) AS total_rows FROM vote WHERE IdYard = $idy";
                                        $result3 = $conn->query($sql3);

                                        // Kiểm tra xem có dữ liệu trả về không
                                        if ($result3->num_rows > 0) {
                                            $row3 = $result3->fetch_assoc();
                                            $total_votes = $row3['total_votes'];
                                            $total_rows = $row3['total_rows'];
                                        } else {
                                            $total_votes = 0; // Đặt giá trị mặc định nếu không có dữ liệu
                                            $total_rows = 0;
                                        }

                                        $average_rating = $total_rows > 0 ? $total_votes / $total_rows : 0;
                                        ?>
                                    <td><?php echo $average_rating ?>/5</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-action" onclick="showEditForm(<?php echo $row2['IdYard'] ?>)">Sửa</button>
                                            <?php if($row2['Status'] == '1') {?>
                                            <button type="submit" name="block" class="btn btn-danger btn-action">Khoá</button>
                                            <?php }
                                            else{?>
                                                <button type="submit" name="unblock" class="btn btn-danger btn-action">Mở khoá</button>
                                           <?php }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="editForm<?php echo $row2['IdYard'] ?>" class="edit-row" style="display:none;">
                                    <td colspan="6">
                                        <form action="action/yard_action.php" method="POST" class="edit-form">
                                            <div class="form-group">
                                                <label for="edit_image">Ảnh:</label>
                                                <input type="file" id="edit_image" name="edit_image" accept="image/*">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_name">Tên:</label>
                                                <input type="text" id="edit_name" name="edit_name" value="<?php echo $row2['NameYard'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_address">Địa chỉ:</label>
                                                <input type="text" id="edit_address" name="edit_address" value="<?php echo $row2['AddYard'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_price">Giá tiền giờ thường:</label>
                                                <input type="text" id="edit_price" name="edit_price" value="<?php echo $row2['PriceYard'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_price">Giá tiền giờ vàng:</label>
                                                <input type="text" id="edit_prices" name="edit_prices" value="<?php echo $row2['PriceYards'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_qty">Số lượng:</label>
                                                <input type="number" id="edit_qty" name="edit_qty" value="<?php echo $row2['Qty'] ?>"min="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_description">Mô tả:</label>
                                                <textarea id="edit_description" name="edit_description"style="width: 100%; height: 200px;"><?php echo $row2['DesYard'] ?></textarea>
                                            </div>

                                            <input type="hidden" name="yard_id" value="<?php echo $row2['IdYard'] ?>">
                                            <input type="submit" name="save" value="Lưu" class="btn btn-primary">

                                        </form>
                                    </td>
                                </tr>


                        <?php
                            }
                        }
                        ?>
                         
                        <!-- Pagination Links -->

                    </tbody>
                </table>
                <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>
<input type="submit" name="add" value="Thêm sân" class="btn btn-primary">
<style>
    .pagination {
  display: flex;
  justify-content: center;
}

.pagination a {
  margin: 0 5px;
}
    </style>
            </form>

            <script>
              function showEditForm(formId) {
    var form = document.getElementById("editForm" + formId);
    form.style.display = "table-row";
}

            </script>
       

    </div>