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

    <script>
        Swal.fire({
            title: "Bạn đã đánh giá rồi",
            icon: "swarning",
            showCancelButton: false,
            confirmButtonText: "OK"
        }).then(function () {
            window.location.href = "http://localhost/DATN/detail_yard.php"; // Thay đổi URL của trang điều hướng tại đây
        });
    </script>
</body>

</html>