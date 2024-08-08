<!  CTYPE html>
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
include 'action/connect.php';
if (isset($_POST['sell'])) {
    
$fname = $_POST['fname'];
$addr = $_POST['addr'];
$tell = $_POST['tell'];
$paymentMethod = $_POST['paymentMethod'];
$idacc=$_SESSION['Id'];
$_SESSION['fname'] = $fname;
$_SESSION['addr'] = $addr;
$_SESSION['tell'] = $tell;
$_SESSION['paymentMethod'] = $paymentMethod;
if($paymentMethod==0){
    // Thêm thông tin người dùng vào cơ sở dữ liệu
    $a=0;
    // Thêm thông tin đơn hàng vào cơ sở dữ liệu
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        
        $a+=1;

        // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
        $query = "SELECT * FROM product WHERE IdPro = $productId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $product = mysqli_fetch_assoc($result);
            $price = $product['PricePro'];
            $namepro= $product['NamePro'];
            $total = $price * $quantity;
           
            
            // Thêm thông tin đơn hàng vào cơ sở dữ liệu
            $sql = "INSERT INTO orders (IdPro,IdAcc,Fname, Tell  , Addr, NamePro, QtyPro,Total) VALUES ('$productId','$idacc','$fname', '$tell','$addr','$namepro', '$quantity', '$total')";
            mysqli_query($conn, $sql);
        }
    }
    // Xóa giỏ hàng sau khi đặt hàng thành công
    $_SESSION['cart'] = [];

    // Chuyển hướng người dùng đến trang xác nhận đặt hàng hoặc trang khác
    
   

?>
    <script>
        Swal.fire({
            title: "Đặt hàng thành công",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "OK"
        }).then(function () {
            window.location.href = "http://localhost/DATN"; // Thay đổi URL của trang điều hướng tại đây
        });
    </script>
<?php }
if($paymentMethod==1){
    $totalAll=$_POST['totalAll'];
    
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // Thực hiện POST
        $result = curl_exec($ch);
        // Đóng kết nối
        curl_close($ch);
        return $result;
    }

    // Thông tin cần thiết cho yêu cầu thanh toán Momo
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo";
    $amount = $totalAll; // Số tiền cần thanh toán
    $orderId = time() . "";
    $redirectUrl = "http://localhost/DATN/confirm_pro.php";
    $ipnUrl = "http://localhost/DATN/confirm_pro.php";
    $extraData = "";
    $requestId = time() . "";
    $requestType = "payWithATM";
    $extraData = ($extraData ? $extraData : "");

    // Tạo chữ ký (HMAC SHA256 signature)
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    // Tạo dữ liệu yêu cầu
    $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    );

    // Thực hiện yêu cầu thanh toán qua Momo
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true); // Giải mã JSON

    // Chuyển hướng đến trang thanh toán Momo
    header('Location: ' . $jsonResult['payUrl']);
    $sql = "INSERT INTO orders (IdPro,IdAcc,Fname, Tell, Addr, NamePro, QtyPro, Total, Pay) VALUES ('$productId','$idacc','$fname', '$tell','$addr','$namepro', '$quantity', '$total', 1)";
    mysqli_query($conn, $sql);

    // Chuyển hướng người dùng đến trang xác nhận thanh toán hoặc trang khác
    ?>

    <script>
        Swal.fire({
            title: "Thanh toán qua Momo thành công",
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "OK"
        }).then(function () {
            window.location.href = "http://localhost/DATN/order.php"; // Thay đổi URL của trang điều hướng tại đây
        });
    </script>
    <?php

}
}
else {
    // Xử lý khi không có thông tin từ form được gửi đi
    $fname = $_SESSION['fname'];
    $addr = $_SESSION['addr'];
    $tell = $_SESSION['tell'];
    $paymentMethod = $_SESSION['paymentMethod'];
    $idacc = $_SESSION['Id'];

    // Thêm thông tin đơn hàng vào cơ sở dữ liệu
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        // Kiểm tra xem số lượng có lớn hơn 0 không
        if ($quantity > 0) {
            $query = "SELECT * FROM product WHERE IdPro = $productId";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $product = mysqli_fetch_assoc($result);
                $price = $product['PricePro'];
                $namepro = $product['NamePro'];
                $total = $price * $quantity;

                $sql = "INSERT INTO orders (IdPro, IdAcc, Fname, Tell, Addr, NamePro, QtyPro, Total, Pay) VALUES ('$productId', '$idacc', '$fname', '$tell', '$addr', '$namepro', '$quantity', '$total', 1) ";
                mysqli_query($conn, $sql);
            
        }
        }
    }

    // Xóa giỏ hàng sau khi đặt hàng thành công
    $_SESSION['cart'] = [];

    // Chuyển hướng người dùng đến trang xác nhận đặt hàng hoặc trang khác
    ?>
    <script>
        window.location.href = "http://localhost/DATN/order.php"; // Thay đổi URL của trang điều hướng tại đây
    </script>
    <?php
}
?>

</body>
</html>