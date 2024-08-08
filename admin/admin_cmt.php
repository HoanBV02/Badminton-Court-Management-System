<?php
session_start();
include 'action/connect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/partner.css"> -->
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    flex-direction: row;
    height: 100vh;
}

.sidebar {
    width: 200px;
    background: #f0f0f0;
    padding: 20px;
    overflow-y: auto;
}

.content {
    flex-grow: 1;
    padding: 20px;
    display: none;
    overflow-y: auto;
}

.content.active {
    display: block;
}

canvas {
    margin-bottom: 20px;
}

.stats {
    display: flex;
    justify-content: space-between;
}

.stat {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Additional styling */
h2 {
    margin-top: 0;
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    margin-bottom: 10px;
}

ul li a {
    color: #333;
    text-decoration: none;
}

ul li a.active {
    font-weight: bold;
}

h1 {
    margin-top: 0;
}
/* Định dạng tiêu đề h1 */
h1 {
    color: #333;
    text-align: center;
}
.table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        /* Additional styling for the reply form */
        .reply-form {
            display: flex;
            align-items: center;
        }

        .reply-form input[type="text"] {
            flex-grow: 1;
            padding: 8px;
            margin-right: 8px;
        }

        .reply-form button {
            margin-right: 8px;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
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
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="http://localhost/DATN/admin/admin_partner.php" data-target="overviewContent">Tổng quan</a></li>
                <li><a href="http://localhost/DATN/admin/admin_yard.php" data-target="manageContentclass">Quản lý sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_invoice.php" data-target="invoiceContent">Quản lý thuê sân</a></li>
                <li><a href="http://localhost/DATN/admin/admin_cmt.php" data-target="invoiceContent" class="active">Quản lý bình luận</a></li>
                <a href='action/logout.php'>Đăng xuất</a>
            </ul>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sân</th>
                        <th>Nội dung cmt</th>
                        <th>Tên người dùng</th>
                        <th>Trả lời</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id = $_SESSION['Id'];
                    // Ensure $id is properly sanitized before use in the query to prevent SQL injection
                    $id = mysqli_real_escape_string($conn, $id);

                    $sql = "SELECT comment.*
                            FROM comment
                            JOIN yard ON comment.IdYard = yard.IdYard
                            WHERE yard.IdAcc = '$id'"; // Ensure $id is properly enclosed in quotes

                    $result = mysqli_query($conn, $sql);

                    // Check for errors in query execution
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }

                    // Display the comments in a table
                    while ($row = mysqli_fetch_assoc($result)) {
                        $commentId = $row['IdCmt']; // Get the comment ID
                        $idyd=$row['IdYard'];
                        $iduser=$row['IdAcc'];
                        $sql_yard="SELECT * FROM yard WHERE IdYard = '$idyd'";
                        $result_yard=mysqli_query($conn,$sql_yard);
                        $row_yard=mysqli_fetch_assoc($result_yard);
                        $sql_user="SELECT * FROM account WHERE IdAcc = '$iduser'";
                        $result_user=mysqli_query($conn,$sql_user);
                        $row_user=mysqli_fetch_assoc($result_user);
                     

                        ?>
                        <tr>
                            <td><?php echo $row_yard['NameYard']; ?></td>
                            <td><?php echo $row['ContentCmt']; ?></td>
                            <td><?php echo $row_user['User']; ?></td>
                            <td>
                                <?php if ($row['Status'] == 0) { ?>
                                    <span id="reply-button-<?php echo $commentId; ?>">
                                        <button type="button" class="btn btn-primary" onclick="showReplyForm(<?php echo $commentId; ?>)">Trả lời</button>
                                    </span>
                                    <span id="reply-form-<?php echo $commentId; ?>" style="display: none;">
                                        <form action="admin_cmt.php" method="POST">
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
if(isset($_POST['replybtn'])){
    $replyctn = $_POST['reply'];
$replyid = $_POST['idrep'];
$sql_reply = "INSERT INTO comment (ContentCmt, Reply, Status) 
VALUES ('$replyctn', '$replyid', 1)";
$sql_update = "UPDATE comment SET Status = 1 WHERE IdCmt = $replyid";
if (mysqli_query($conn, $sql_reply) && mysqli_query($conn, $sql_update)) {
    header("Location: http://localhost/DATN/admin/admin_cmt.php");
    exit(); // Ensure that no other output is sent
} else {
    echo "Error: " . mysqli_error($conn);
}
}
?>