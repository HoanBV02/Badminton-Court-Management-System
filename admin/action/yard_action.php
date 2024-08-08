<!DOCTYPE html>
        <html>

        <head>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                body {
                    font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
                }
            </style>
        </head>

        <body>
<?php
session_start();
include 'connect.php';
if(isset($_POST['save'])){
    $img=$_POST['edit_image'];
    $name=$_POST['edit_name'];
    $addr=$_POST['edit_address'];
    $price=$_POST['edit_price'];
    $des=$_POST['edit_description'];
    $id=$_POST['yard_id'];
    $qty=$_POST['edit_qty'];
    $prices=$_POST['edit_prices'];
    if($img== ''){
    $sql = "UPDATE yard 
    SET NameYard = '$name', PriceYard = '$price',PriceYards = '$prices', AddYard = '$addr', DesYard = '$des' ,Qty='$qty'
    WHERE IdYard = $id";
    }
    else{
        $sql = "UPDATE yard 
        SET NameYard = '$name', ImgYard = '$img', PriceYard = '$price',PriceYards = '$prices', AddYard = '$addr', DesYard = '$des',Qty='$qty' 
        WHERE IdYard = $id";
    }
// Thực thi câu lệnh SQL
if (mysqli_query($conn, $sql)) { ?>
<script>
                Swal.fire({
                    title: "Cập nhật thành công",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "OK"
                }).then(function () {
                    window.history.back(); // Thay đổi URL của trang điều hướng tại đây
                });
            </script>
<?php }
}
if(isset($_POST["block"])){
     $id=$_POST['yard_id'];
    $sql = "UPDATE yard 
    SET Status=0 
    WHERE IdYard = $id";
    if (mysqli_query($conn, $sql)) { ?>
        <script>
                        Swal.fire({
                            title: "Cập nhật thành công",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK"
                        }).then(function () {
                            window.location.href = 'http://localhost/DATN/admin/admin_yard.php'; // Thay đổi URL của trang điều hướng tại đây
                        });
                    </script><?php }
}
if(isset($_POST["unblock"])){
    $id=$_POST['yard_id'];
   $sql = "UPDATE yard 
   SET Status=1 
   WHERE IdYard = $id";
   if (mysqli_query($conn, $sql)) { ?>
       <script>
                       Swal.fire({
                           title: "Cập nhật thành công",
                           icon: "success",
                           showCancelButton: false,
                           confirmButtonText: "OK"
                       }).then(function () {
                        window.location.href = 'http://localhost/DATN/admin/admin_yard.php';   // Thay đổi URL của trang điều hướng tại đây
                       });
                   </script><?php }
}
if(isset($_POST["add"])){?>
<form action='yard_action.php' method='POST'>
   <div class="form-group">
    <label for="image">Ảnh:</label>
    <input type="file" id="image" name="image" required>
</div>
<div class="form-group">
    <label for="name">Tên Sân:</label>
    <input type="text" id="name" name="name" required>
</div>
<div class="form-group">
<?php
        $sql = 'SELECT * FROM area';
        $result = $conn->query($sql);?>
    <label for="area">Chọn Khu Vực:</label>
    <select id="area" name="area" required>
        <option value="<?php echo $row['IdArea']; ?>">Chọn quận</option>
        <?php
        
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['IdArea'] . '">' . $row['NameArea'] . '</option>';
        }
        ?>
    </select>
</div>
<div class="form-group">
<label for="quantity">Số lượng ô</label>
<input type="number" id="quantity" name="quantity" min="1" max="100">
</div>
<div class="form-group">
    <label for="address">Địa Chỉ:</label>
    <input type="text" id="address" name="address" required>
</div>
<div class="form-group">
    <label for="description">Mô Tả:</label>
    <textarea id="description" name="description" required></textarea>
</div>
<div class="form-group">
    <label for="price">Giá:</label>
    <input type="text" id="price" name="price" required>
</div>
<div class="form-group">
    <label for="price">Giá giờ vàng:</label>
    <input type="text" id="price" name="prices" required>
</div>
<button type="submit" name="saveyd" class="btn btn-success">Lưu</button>
</form>
</div>

<style>
    /* CSS styles */
</style>
<style>
    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
    }

    textarea {
        height: 100px;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<?php }
if(isset($_POST['saveyd'])){
    $img = $_POST['image'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $addr = $_POST['address'];
    $des = $_POST['description'];
    $qty=$_POST['quantity'];
    $idp=$_SESSION['Id'];
    $priceS=$_POST['prices'];
    $sql = "INSERT INTO yard (NameYard, ImgYard, AreaYard, PriceYard,PriceYards,Qty, IdAcc, AddYard, DesYard) 
    VALUES ('$name', '$img', '$area', '$price','$priceS','$qty', '$idp', '$addr', '$des')";

// Thực thi câu lệnh SQL
if ($conn->query($sql) === TRUE) {?>
    <script>
                Swal.fire({
                    title: "Cập nhật thành công",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "OK"
                }).then(function () {
                    window.location.href = 'http://localhost/DATN/admin/admin_yard.php';// Thay đổi URL của trang điều hướng tại đây
                });
            </script>
<<?php 
}
}
?>