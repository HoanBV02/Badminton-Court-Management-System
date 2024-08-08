<?php
                        if (isset($_POST['productId'])) {
                            $productIdToRemove = $_POST['productId'];
                        
                            // Loại bỏ sản phẩm khỏi giỏ hàng (session)
                            unset($_SESSION['cart'][$productIdToRemove]);
                        
                            // Chuyển hướng người dùng trở lại trang giỏ hàng
                            header("Location: http://localhost/DATN/cart.php");
                            exit;
                        }?>