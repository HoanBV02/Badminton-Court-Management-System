<?php
session_start();
include 'action/connect.php';

function formatCurrency($number)
{
    return number_format($number, 0, ',', '.');
}
?>
<script>
        function showReplyForm(commentId) {
            var formId = "reply-form-" + commentId;
            var replyForm = document.getElementById(formId);
            replyForm.style.display = "block";

            // Hide the "Reply" button
            var replyButton = document.getElementById("reply-button-" + commentId);
            replyButton.style.display = "none";
        }

        function hideReplyForm(commentId) {
            var formId = "reply-form-" + commentId;
            var replyForm = document.getElementById(formId);
            replyForm.style.display = "none";

            // Show the "Reply" button
            var replyButton = document.getElementById("reply-button-" + commentId);
            replyButton.style.display = "inline-block";
        }
    </script>
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
                <a href="admin.php" class="nav-link">Quản lý người dùng</a>
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
                <a href="cmt.php" class="nav-link active">Quản lý bình luận</a>
            </li>
        </ul>
    </div>
    <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Nội dung bình luận</th>
                        <th>Tên người dùng</th>
                        <th>Trả lời</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM commentpr WHERE IdPro<>0";

                    $result = mysqli_query($conn, $sql);

                    // Display the comments in a table
                    while ($row = mysqli_fetch_assoc($result)) {
                        $commentId = $row['IdCmt']; // Get the comment ID
                        $idpr=$row['IdPro'];
                        $iduser=$row['IdAcc'];
                        $sql_prd="SELECT * FROM product WHERE IdPro = '$idpr'";
                        $result_prd=mysqli_query($conn,$sql_prd);
                        $row_prd=mysqli_fetch_assoc($result_prd);
                        $sql_user="SELECT * FROM account WHERE IdAcc = '$iduser'";
                        $result_user=mysqli_query($conn,$sql_user);
                        $row_user=mysqli_fetch_assoc($result_user);
                     

                        ?>
                        <tr>
                            <td><?php echo $row_prd['NamePro']; ?></td>
                            <td><?php echo $row['ContentCmt']; ?></td>
                            <td><?php echo $row_user['User']; ?></td>
                            <td>
                                <?php if ($row['Status'] == 0) { ?>
                                    <span id="reply-button-<?php echo $commentId; ?>">
                                        <button type="button" class="btn btn-primary" onclick="showReplyForm(<?php echo $commentId; ?>)">Trả lời</button>
                                    </span>
                                    <span id="reply-form-<?php echo $commentId; ?>" style="display: none;">
                                        <form action="cmt.php" method="POST">
                                            <input type="hidden" name="idrep" value="<?php echo $commentId ?>">
                                            <input type="text" name="reply" placeholder="Nhập nội dung trả lời">
                                            <button type="submit" name="replybtn" class="btn btn-primary">Gửi</button>
                                            <button type="button" class="btn btn-secondary" onclick="hideReplyForm(<?php echo $commentId; ?>)">Đóng</button>
                                        </form>
                                    </span>
                                <?php } elseif ($row['Status'] == 1) { ?>
                                    Đã trả lời
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['replybtn'])) {
    $replyctn = $_POST['reply'];
    $replyid = $_POST['idrep'];
    $sql_reply = "INSERT INTO commentpr (ContentCmt, Reply, Status) VALUES ('$replyctn', '$replyid', 1)";
    $sql_update = "UPDATE commentpr SET Status = 1 WHERE IdCmt = $replyid";
    
    if (mysqli_query($conn, $sql_reply) && mysqli_query($conn, $sql_update)) {
        echo '<script>window.location.href = "http://localhost/DATN/admin/cmt.php";</script>';
        exit(); // Ensure that no other output is sent
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>