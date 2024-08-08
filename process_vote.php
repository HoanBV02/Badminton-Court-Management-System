<!DOCTYPE html>
<html>
<head>
  <title>Trang Vote Sao và Bình luận</title>
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
  <style>
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    header {
      text-align: center;
      margin-bottom: 20px;
    }

    h1 {
      font-size: 24px;
    }

    .rating {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      margin: 20px auto;
    }

    .rating input {
      display: none;
    }

    .rating label {
      display: inline-block;
      font-size: 24px;
      color: #ddd;
      cursor: pointer;
      transition: 0.2s ease;
      margin: 0 5px;
    }

    .rating label:hover,
    .rating input:checked+label {
      color: #ff9700;
    }

    .btn-primary {
      margin-top: 10px;
      padding: 5px 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      transition: 0.2s ease;
    }

    .comment-section {
      margin-top: 20px;
    }

    textarea {
      width: 100%;
      height: 100px;
      padding: 5px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .comment-section {
  margin-top: 20px;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box; /* Ensure padding and border are included in width */
  transition: border-color 0.3s ease;
}

input[type="text"]:focus {
  border-color: #ff9700;
}
  </style>
</head>
<body>
    <?php
    session_start();
    include 'action/connect.php';
    if(isset($_POST['vote'])){
        $idacc = $_POST['iduser'];
$idyard = $_POST['idyd'];
$fname = $_SESSION['Fname'];

    }

    
    ?>
  <div class="container">
    <header>
      <h1>Trang Vote Sao và Bình luận</h1>
    </header>

    <form action="process_vote.php" method="post" class="d-flex align-items-center">
      <div class="rating">
        <input type="radio" id="star5" name="rating" value="1" />
        <label for="star5" title="5 sao">☆</label>

        <input type="radio" id="star4" name="rating" value="2" />
        <label for="star4" title="4 sao">☆</label>

        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3" title="3 sao">☆</label>

        <input type="radio" id="star2" name="rating" value="4" />
        <label for="star2" title="2 sao">☆</label>

        <input type="radio" id="star1" name="rating" value="5" />
        <label for="star1" title="1 sao">☆</label>
        
      </div>
      <div class="comment-section">
  <h2>Phản hồi:</h2>
  <input type="text" id="comment" name="comment" placeholder="Nhập phản hồi của bạn">
</div>

  </div>
  <input type="hidden" name="iduser" value="<?php echo $idacc; ?>">
      <input type="hidden" name="idyd" value="<?php echo $idyard; ?>">
      <input type="hidden" name="Fname" value="<?php echo $fname; ?>">
  <center><button type="submit" name='rate' class="btn btn-primary ml-2">Gửi đánh giá và phản hồi</button></center>
    </form>
  <script>
    const labels = document.querySelectorAll('.rating label');
    const ratingInput = document.querySelectorAll('.rating input');

    labels.forEach((label, index) => {
      label.addEventListener('click', function () {
        const ratingValue = parseInt(ratingInput[index].value);

        ratingInput.forEach(input => {
          input.checked = false;
          input.nextElementSibling.style.color = '#ddd';
        });

        for (let i = 0; i <= index; i++) {
          ratingInput[i].checked = true;
          labels[i].style.color = '#ff9700';
        }
      });
    });
  </script>
</body>
</html>
<?php
error_reporting(0);
if (isset($_POST['rate'])) {
    $idacc = $_POST['iduser'];
    $idyard = $_POST['idyd'];
    $fname = $_POST['Fname'];
    $rate=$_POST['rating'];
    $contentcmt=$_POST['comment'];
    if($rate===null && $contentcmt!=null){
        $sql = "INSERT INTO comment (ContentCmt,IdAcc,IdYard,Fname) VALUES ('$contentcmt','$idacc','$idyard','$fname')";
        $query = mysqli_query($conn, $sql);
        if ($query) { ?>
            <!-- Hiển thị thông báo thành công nếu đánh giá được thêm thành công -->
            <script>
                Swal.fire({
                    title: "Đã bình luận",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "OK"
                }).then(function () {
                    window.location.href = 'http://localhost/DATN'; // Thay đổi URL của trang điều hướng tại đây
                });
            </script>
        <?php 
    $sql_update="UPDATE booking SET Status =3 WHERE IdYard='$idyard'";
    $result_update = mysqli_query($conn, $sql_update);    
    }
    }
    if($rate!=null && $contentcmt==null){
        $sql_insert = "INSERT INTO vote (NumVote, IdAcc, IdYard) VALUES ('$rate', '$idacc', '$idyard')";
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert) { ?>
                    <!-- Hiển thị thông báo thành công nếu đánh giá được thêm thành công -->
                    <script>
                        Swal.fire({
                            title: "Đã đánh giá",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "OK"
                        }).then(function () {
                            window.location.href = 'http://localhost/DATN/'; // Thay đổi URL của trang điều hướng tại đây
                        });
                    </script>
                <?php
                $sql_update="UPDATE booking SET Status =3 WHERE IdYard='$idyard'";
                $result_update = mysqli_query($conn, $sql_update);    }
    }
    if($rate!=null && $contentcmt!=null){
        $sql = "INSERT INTO comment (ContentCmt,IdAcc,IdYard,Fname) VALUES ('$contentcmt','$idacc','$idyard','$fname')";
        $query = mysqli_query($conn, $sql);
        $sql_insert = "INSERT INTO vote (NumVote, IdAcc, IdYard) VALUES ('$rate', '$idacc', '$idyard')";
        $result_insert = mysqli_query($conn, $sql_insert);
        if ($result_insert &&  $query){
            ?>
            <!-- Hiển thị thông báo thành công nếu đánh giá được thêm thành công -->
            <script>
                Swal.fire({
                    title: "Đã bình luận và đánh giá",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonText: "OK"
                }).then(function () {
                    window.location.href = 'http://localhost/DATN/'; // Thay đổi URL của trang điều hướng tại đây
                });
            </script>
        <?php
        $sql_update="UPDATE booking SET Status =3 WHERE IdYard='$idyard'";
        $result_update = mysqli_query($conn, $sql_update);  

        }
    }
}

?>
