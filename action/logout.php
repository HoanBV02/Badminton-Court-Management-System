<?php
session_start();
// Hủy tất cả các phiên làm việc
session_destroy();
header("Location:http://localhost/DATN/index.php");
?>
