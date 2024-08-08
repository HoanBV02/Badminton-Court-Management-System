
                    $sql = "SELECT COUNT(*) AS Total
                    FROM booking
                    WHERE Date = '$date'
                        AND (Time = '$time' OR Time = 5)
                        AND Status <> 1
                        AND Status <> 2
                        AND IdYard = '$idy'";
            
                    // Thực thi câu truy vấn
                    $result = $conn->query($sql4);
            
                    // Kiểm tra và hiển thị kết quả
                    if ($result) {
                        $rowzz = $result->fetch_assoc(); // Sửa đổi tại đây
                        $total = $rowzz['Total'];
                    ?>