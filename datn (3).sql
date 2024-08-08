-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 09, 2024 lúc 12:53 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `IdAcc` int(11) NOT NULL,
  `User` varchar(255) DEFAULT NULL,
  `Pass` varchar(255) DEFAULT NULL,
  `Fname` varchar(255) DEFAULT NULL,
  `Tell` varchar(255) DEFAULT NULL,
  `AddrAcc` varchar(1000) NOT NULL,
  `Permission` int(1) DEFAULT 1,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`IdAcc`, `User`, `Pass`, `Fname`, `Tell`, `AddrAcc`, `Permission`, `Status`) VALUES
(1, 'user1', '1', 'John Doe', '123456789', '', 1, 1),
(2, 'user2', 'pass2', 'Jane Smith', '987654321', '', 1, 1),
(3, 'admin', 'admin', 'Mike Johnson', '01216293123', '', 0, 1),
(4, 'duong', '1', 'Duong', '0386862132', '', 2, 1),
(5, 'user0', '1', 'Dương', '0365489212', '', 2, 1),
(6, 'jun', '1', 'Duong 2k2', '0386862132', 'Thanh Hoá', 1, 1),
(7, 'test', '1', 'Lê Văn Dương', '0386862132', 'Thanh Hoá', 2, 1),
(8, 'cean', '1', 'Lê Văn Dương', '0386862132', 'Thanh Hoá', 1, 1);

--
-- Bẫy `account`
--
DELIMITER $$
CREATE TRIGGER `update_yard_status` AFTER UPDATE ON `account` FOR EACH ROW BEGIN
    UPDATE yard 
    SET Status = NEW.Status 
    WHERE IdAcc = NEW.IdAcc;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `area`
--

CREATE TABLE `area` (
  `IdArea` int(11) NOT NULL,
  `NameArea` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `area`
--

INSERT INTO `area` (`IdArea`, `NameArea`) VALUES
(1, 'Ba Đình'),
(2, 'Hoàn Kiếm'),
(3, 'Hai Bà Trưng'),
(4, 'Đống Đa'),
(5, 'Tây Hồ'),
(6, 'Cầu Giấy'),
(7, 'Thanh Xuân'),
(8, 'Hoàng Mai'),
(9, 'Long Biên'),
(10, 'Nam Từ Liêm'),
(11, 'Bắc Từ Liêm'),
(12, 'Hà Đông'),
(13, 'Sơn Tây'),
(14, 'Ba Vì'),
(15, 'Phúc Thọ'),
(16, 'Đan Phượng'),
(17, 'Hoài Đức'),
(18, 'Thanh Trì'),
(19, 'Gia Lâm'),
(20, 'Đông Anh'),
(21, 'Sóc Sơn'),
(22, 'Huyện Mê Linh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `IdBooking` int(11) NOT NULL,
  `IdAcc` int(11) NOT NULL,
  `IdPartner` int(11) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Tell` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Time` int(11) NOT NULL,
  `IdYard` int(11) NOT NULL,
  `Area` int(11) NOT NULL,
  `AddYard` varchar(1000) NOT NULL,
  `TellPartner` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`IdBooking`, `IdAcc`, `IdPartner`, `Name`, `Tell`, `Date`, `Time`, `IdYard`, `Area`, `AddYard`, `TellPartner`, `Price`, `Status`) VALUES
(27, 1, 5, 'John Doe', '123456789', '2024-02-26', 1, 1, 22, 'Địa chỉ 1', '0365489212', 100000, 2),
(28, 1, 5, 'John Doe', '123456789', '2024-02-26', 1, 1, 22, 'Địa chỉ 1', '0365489212', 100000, 2),
(29, 1, 5, 'John Doe', '123456789', '2024-02-26', 2, 3, 1, 'Địa chỉ 3', '0365489212', 200000, 1),
(30, 1, 4, 'John Doe', '123456789', '2024-02-26', 2, 3, 1, 'Địa chỉ 3', '0365489212', 200000, 0),
(31, 1, 5, 'John Doe', '123456789', '2024-02-26', 2, 7, 22, 'Địa chỉ 7', '0365489212', 200000, 1),
(32, 1, 5, 'John Doe', '123456789', '2024-02-26', 2, 6, 22, 'Địa chỉ 6', '0365489212', 200000, 1),
(33, 1, 4, 'John Doe', '123456789', '2024-02-25', 3, 5, 1, 'Địa chỉ 5', '0365489212', 180000, 0),
(34, 1, 4, 'Duong', '0386862132', '2024-02-29', 3, 3, 1, 'Địa chỉ 3', '0365489212', 180000, 0),
(35, 1, 4, 'John Doe', '123456789', '2024-02-26', 2, 5, 1, 'Địa chỉ 5', '0365489212', 180000, 0),
(36, 1, 5, 'John Doe', '123456789', '2024-02-25', 3, 6, 22, 'Địa chỉ 6', '0365489212', 200000, 1),
(37, 1, 4, 'Duong', '0386862132', '2024-02-25', 2, 2, 22, 'Địa chỉ 2', '0365489212', 150000, 0),
(38, 1, 4, 'Duong', '0386862132', '2024-02-26', 2, 1, 22, 'Địa chỉ 1', '0365489212', 100000, 0),
(39, 1, 5, 'John Doe', '123456789', '2024-02-27', 3, 1, 22, 'Địa chỉ 1', '0365489212', 100000, 1),
(42, 1, 4, 'John Doe', '123456789', '2024-02-29', 3, 1, 22, 'Địa chỉ 1', '0365489212', 100000, 0),
(54, 6, 5, 'Duong 2k2', '0386862132', '2024-03-10', 2, 1, 22, 'Nguyễn Trãi', '0365489212', 100000, 2),
(55, 6, 5, 'Duong 2k2', '0386862132', '2024-03-11', 5, 3, 1, 'Địa chỉ 3', '0365489212', 800000, 2),
(56, 6, 5, 'Duong 2k2', '0386862132', '2024-03-10', 3, 3, 1, 'Địa chỉ 3', '0365489212', 200000, 2),
(57, 6, 4, 'Duong 2k2', '0386862132', '2024-03-24', 2, 15, 3, 'Địa chỉ G', '0386862132', 215000, 1),
(58, 6, 5, 'Duong 2k2', '0386862132', '2024-04-06', 2, 18, 1, 'Địa chỉ J', '0365489212', 118000, 2),
(59, 6, 5, 'Duong 2k2', '0386862132', '2024-04-05', 3, 45, 3, '55 Giải Phóng', '0365489212', 200000, 2),
(60, 5, 5, 'Dương', '0365489212', '2024-04-05', 3, 46, 3, '55 Giải Phóng', '0365489212', 150000, 2),
(61, 6, 5, 'Duong 2k2', '0386862132', '2024-04-13', 2, 45, 3, '55 Giải Phóng', '0365489212', 200000, 2),
(62, 6, 5, 'Duong 2k2', '0386862132', '2024-04-14', 4, 3, 9, 'Địa chỉ 3', '0365489212', 143000, 2),
(63, 6, 4, 'Duong 2k2', '0386862132', '2024-04-08', 2, 1, 6, 'Nguyễn Trãi', '0386862132', 171000, 0),
(64, 6, 4, 'Duong 2k2', '0386862132', '2024-04-08', 2, 1, 6, 'Nguyễn Trãi', '0386862132', 171000, 0),
(65, 6, 5, 'Duong 2k2', '0386862132', '2024-04-14', 3, 31, 2, 'Địa chỉ W', '0365489212', 236000, 0),
(66, 6, 5, 'Duong 2k2', '0386862132', '2024-04-14', 3, 31, 2, 'Địa chỉ W', '0365489212', 236000, 0);

--
-- Bẫy `booking`
--
DELIMITER $$
CREATE TRIGGER `update_qtybooking_trigger` AFTER UPDATE ON `booking` FOR EACH ROW BEGIN
    DECLARE _IdYard INT;

    -- Lấy IdYard của hàng mới được cập nhật nếu Status được cập nhật lên 2
    IF NEW.Status = 2 THEN
        SET _IdYard = NEW.IdYard;

        -- Kiểm tra xem _IdYard có giá trị không
        IF _IdYard IS NOT NULL THEN
            -- Cập nhật QtyBooking trong bảng yard
            UPDATE yard
            SET QtyBooking = QtyBooking + 1
            WHERE IdYard = _IdYard;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `IdCate` int(11) NOT NULL,
  `NameCate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`IdCate`, `NameCate`) VALUES
(1, 'Vợt cầu lông'),
(2, 'Quấn tay cầm'),
(3, 'Quả cầu lông'),
(4, 'Dây căng vợt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `IdCmt` int(11) NOT NULL,
  `ContentCmt` varchar(300) NOT NULL,
  `IdAcc` int(11) NOT NULL,
  `IdYard` int(11) NOT NULL,
  `Fname` varchar(200) NOT NULL,
  `TimeCmt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`IdCmt`, `ContentCmt`, `IdAcc`, `IdYard`, `Fname`, `TimeCmt`) VALUES
(4, 'Bình luận 1', 1, 6, 'John Doe', '2024-02-29 02:33:35'),
(5, 'Bình luận 2', 1, 6, 'John Doe', '2024-02-29 02:33:35'),
(6, 'Bình luận 3', 1, 6, 'John Doe', '2024-02-29 02:33:35'),
(7, 'ahihi', 1, 3, 'John Doe', '2024-02-29 02:59:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `commentpr`
--

CREATE TABLE `commentpr` (
  `IdCmt` int(11) NOT NULL,
  `IdPro` int(11) NOT NULL,
  `IdAcc` int(11) NOT NULL,
  `ContentCmt` varchar(1000) NOT NULL,
  `Fname` varchar(1000) NOT NULL,
  `TimeCmt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `commentpr`
--

INSERT INTO `commentpr` (`IdCmt`, `IdPro`, `IdAcc`, `ContentCmt`, `Fname`, `TimeCmt`) VALUES
(1, 0, 1, 'sản phẩm tuyệt vời', 'John Doe', '2024-02-29 03:08:20'),
(2, 3, 1, 'sản phẩm tuyệt vời', 'John Doe', '2024-02-29 03:09:39'),
(3, 2, 1, 'vợt xịn', 'John Doe', '2024-03-01 02:06:35'),
(4, 2, 1, 'sản phẩm đẹp', 'John Doe', '2024-03-01 02:06:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `IdOrder` int(11) NOT NULL,
  `IdAcc` int(11) NOT NULL,
  `IdPro` int(11) NOT NULL,
  `Fname` varchar(300) NOT NULL,
  `Tell` varchar(200) NOT NULL,
  `Addr` varchar(1000) NOT NULL,
  `NamePro` varchar(300) NOT NULL,
  `QtyPro` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Pay` tinyint(1) NOT NULL DEFAULT 0,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`IdOrder`, `IdAcc`, `IdPro`, `Fname`, `Tell`, `Addr`, `NamePro`, `QtyPro`, `Total`, `Pay`, `Status`, `date`) VALUES
(1, 6, 3, 'Lê Văn Dương', '0386862132', 'Thanh Hoá', 'Product 3', 1, 783000, 0, 1, '2024-03-09'),
(2, 6, 7, 'Lê Văn Dương', '0386862132', 'Thanh Hoá', 'Product 7', 10, 8090000, 0, 1, '2024-03-09'),
(3, 1, 0, 'John Doe', '01216293123', '', 'Product 2', 3, 768000, 0, 0, '2024-03-09'),
(4, 1, 0, 'John Doe', '01216293123', '', 'Product 6', 3, 2382000, 0, 1, '2024-03-09'),
(5, 6, 6, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'Găng tay', 5, 3970000, 0, 1, '2024-03-09'),
(6, 6, 8, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'Product 8', 8, 6096000, 0, 1, '2024-03-09'),
(7, 6, 6, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'Găng tay', 4, 3176000, 0, 1, '2024-03-09'),
(8, 6, 5, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'Product 5', 7, 2009000, 0, 1, '2024-03-09'),
(9, 6, 2, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông 1', 3, 360000, 0, 1, '2024-03-14'),
(10, 6, 2, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông 1', 10, 1200000, 0, 1, '2024-03-19'),
(11, 6, 2, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông 1', 39, 4680000, 0, 1, '2024-03-19'),
(12, 1, 2, 'John Doe', '123456789', '', 'vợt cầu lông 1', 1, 120000, 0, 1, '2024-04-05'),
(13, 1, 6, 'John Doe', '123456789', '', 'vợt cầu lông 3', 1, 110000, 0, 0, '2024-04-05'),
(14, 1, 1, 'John Doe', '123456789', '', 'vợt cầu lông yonex', 1, 190000, 0, 0, '2024-04-05'),
(15, 6, 1, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông yonex', 1, 190000, 0, 1, '2024-04-05'),
(16, 6, 2, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông 1', 3, 360000, 0, 1, '2024-04-05'),
(17, 6, 2, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông 1', 1, 120000, 0, 0, '2024-04-05'),
(49, 6, 2, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'vợt cầu lông 1', 1, 120000, 1, 0, '2024-04-08'),
(50, 6, 3, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'quả cầu lông yonex', 2, 280000, 1, 0, '2024-04-08'),
(51, 6, 4, 'Duong 2k2', '0386862132', 'Thanh Hoá', 'quả cầu lông 1', 3, 780000, 1, 0, '2024-04-08');

--
-- Bẫy `orders`
--
DELIMITER $$
CREATE TRIGGER `delete_zero_total` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
    IF NEW.Total = 0 THEN
        DELETE FROM orders WHERE IdPro = NEW.IdPro AND IdAcc = NEW.IdAcc;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
    DECLARE productQty INT;
    
    -- Lấy số lượng sản phẩm mới được thêm vào từ bảng 'orders'
    DECLARE newProductId INT;
    DECLARE newProductQty INT;
    
    SET newProductId = NEW.IdPro;
    SET newProductQty = NEW.QtyPro;
    
    -- Lấy số lượng sản phẩm hiện có từ bảng 'product'
    SELECT QtyPro INTO productQty
    FROM product
    WHERE IdPro = newProductId;
    
    -- Trừ số lượng sản phẩm mới từ sản phẩm trong bảng 'product'
    IF productQty IS NOT NULL THEN
        UPDATE product 
        SET QtyPro = QtyPro - newProductQty
        WHERE IdPro = newProductId;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_after_status_change` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
    DECLARE updatedQty INT;
    DECLARE productId INT;

    -- Check if the Status has been updated to 1
    IF NEW.Status = 1 AND OLD.Status != 1 THEN
        -- Lấy số lượng sản phẩm mới được thêm vào từ bảng 'orders'
        SET updatedQty = NEW.QtyPro;

        -- Lấy IdPro của sản phẩm từ dòng được cập nhật trong bảng 'orders'
        SET productId = NEW.IdPro;

        -- Cộng số lượng sản phẩm mới với số lượng sản phẩm trong bảng 'product'
        UPDATE product 
        SET QtyPro = QtyPro + updatedQty
        WHERE IdPro = productId;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `IdPro` int(11) NOT NULL,
  `NamePro` varchar(200) NOT NULL,
  `PricePro` int(11) NOT NULL,
  `QtyPro` int(11) NOT NULL,
  `DateAdd` date NOT NULL DEFAULT current_timestamp(),
  `ImgPro` varchar(1000) NOT NULL,
  `SalePro` int(11) NOT NULL,
  `DesPro` varchar(10000) NOT NULL,
  `IdCate` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`IdPro`, `NamePro`, `PricePro`, `QtyPro`, `DateAdd`, `ImgPro`, `SalePro`, `DesPro`, `IdCate`, `Status`) VALUES
(1, 'vợt cầu lông yonex', 190000, 76, '2022-01-01', 'sp1.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(2, 'vợt cầu lông 1', 120000, 41, '2022-02-01', 'sp1.jpg', 10, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(3, 'quả cầu lông yonex', 140000, 792, '2022-03-01', 'sp7.jpg', 20, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(4, 'quả cầu lông 1', 260000, 117, '2022-04-01', 'sp7.jpg', 10, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(5, 'quấn vợt cầu lông 2', 160000, 89, '2022-05-01', 'sp5.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(6, 'vợt cầu lông 3', 110000, 69, '2022-06-01', 'sp3.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(7, 'quả cầu lông 1', 170000, 110, '2022-07-01', 'sp7.jpg', 20, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(8, 'vợt cầu lông 2', 220000, 60, '2022-08-01', 'sp2.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(9, 'vợt cầu lông 3', 300000, 100, '2022-09-01', 'sp3.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(10, 'quả cầu lông 2', 130000, 80, '2022-10-01', 'sp8.jpg', 15, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(25, 'quấn vợt cầu lông 1', 270000, 50, '2024-03-09', 'sp4.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(26, 'quấn vợt cầu lông 3', 250000, 100, '2024-03-09', 'sp6.jpg', 20, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(27, 'quả cầu lông 2', 130000, 200, '2024-03-09', 'sp8.jpg', 10, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(28, 'quấn vợt cầu lông 1', 210000, 30, '2024-03-09', 'sp4.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(29, 'quấn vợt cầu lông 3', 150000, 80, '2024-03-09', 'sp6.jpg', 15, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(30, 'quả cầu lông 1', 220000, 150, '2024-03-09', 'sp7.jpg', 15, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(31, 'quấn vợt cầu lông 3', 150000, 25, '2024-03-09', 'sp6.jpg', 15, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(32, 'vợt cầu lông 1', 190000, 70, '2024-03-09', 'sp1.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(33, 'quấn vợt cầu lông 1', 220000, 120, '2024-03-09', 'sp4.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(34, 'quấn vợt cầu lông 3', 220000, 40, '2024-03-09', 'sp6.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(35, 'vợt cầu lông 1', 120000, 60, '2024-03-09', 'sp1.jpg', 10, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(36, 'quấn vợt cầu lông 2', 260000, 90, '2024-03-09', 'sp5.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(37, 'quấn vợt cầu lông 1', 220000, 20, '2024-03-09', 'sp4.jpg', 10, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(38, 'vợt cầu lông 2', 230000, 50, '2024-03-09', 'sp2.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(39, 'vợt cầu lông 1', 180000, 30, '2024-03-09', 'sp1.jpg', 15, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(40, 'quấn vợt cầu lông 2', 130000, 100, '2024-03-09', 'sp5.jpg', 15, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(41, 'quấn vợt cầu lông 2', 220000, 150, '2024-03-09', 'sp5.jpg', 15, 'Chất liệu chất lượng: Dây quấn tay được làm từ cao su hoặc nhựa tổng hợp chất lượng cao, giúp tạo cảm giác mềm mại, đàn hồi và bền bỉ. Chất liệu này còn giúp giảm rung động và áp lực khi tay tiếp xúc với vợt, mang lại sự thoải mái và ổn định trong suốt quá trình chơi.\r\n\r\nThấm hút mồ hôi: Dây quấn tay có khả năng thấm hút mồ hôi tốt, giúp giữ cho bàn tay luôn khô ráo và không trượt trên tay cầm vợt. Điều này đảm bảo sự ổn định và độ chính xác trong các động tác đánh, ngăn ngừa việc trượt vợt do đôi tay ướt.\r\n\r\nĐộ ma sát và kiểm soát: Dây quấn tay thường có kết cấu gai nhỏ hoặc vân nổi, tăng độ ma sát giữa tay và vợt. Điều này giúp người chơi có thể nắm vợt chắc chắn hơn, tăng khả năng kiểm soát và định hướng cầu một cách chính xác.\r\n\r\nGiảm mỏi tay và cổ tay: Dây quấn tay cầm vợt cầu lông giúp giảm mỏi tay và cổ tay khi chơi trong thời gian dài. Chất liệu mềm mại và đàn hồi giảm thiểu căng thẳng và giúp tăng cường sự linh hoạt trong các động tác đánh.\r\n\r\nĐa dạng màu sắc và kiểu dáng: Dây quấn tay cầm vợt cầu lông có sự đa dạng về màu sắc và kiểu dáng, giúp người chơi lựa chọn theo phong cách cá nhân. Có nhiều màu sắc sặc sỡ và họa tiết độc đáo để tạo điểm nhấn cho vợt của bạn.', 2, 1),
(42, 'vợt cầu lông 1', 210000, 40, '2024-03-09', 'sp1.jpg', 20, 'Đầu tiên, vợt cầu lông mang lại kiểm soát và độ chính xác cao. Thiết kế cân bằng và hình dáng của vợt giúp người chơi dễ dàng điều chỉnh góc đánh và tạo ra những cú đánh chính xác và mạnh mẽ. Điều này rất quan trọng trong việc định hướng và đánh cầu vào điểm yếu của đối thủ.\r\n\r\nThứ hai, vợt cầu lông mang lại sức mạnh và tốc độ. Với khung vợt nhẹ và cứng, vợt cầu lông giúp tạo ra lực đánh mạnh mẽ và tốc độ nhanh. Điều này cho phép người chơi đánh cầu xa và đưa đối thủ vào thế khó. Sức mạnh và tốc độ của vợt cũng giúp người chơi tạo ra những cú đánh bất ngờ và khó đoán, làm khó cho đối thủ đáp trả.\r\n\r\nThứ ba, vợt cầu lông mang lại độ linh hoạt cao. Với vợt cầu lông, người chơi có thể thực hiện các động tác xoay cổ tay, lướt cầu và đánh trái bóng một cách dễ dàng. Điều này giúp người chơi thể hiện kỹ thuật và chiến thuật linh hoạt trong trận đấu. Độ linh hoạt của vợt cũng giúp người chơi dễ dàng thích nghi với các tình huống khác nhau trong trận đấu.\r\n\r\nThứ tư, vợt cầu lông đảm bảo sự ổn định trong quá trình chơi. Với khung vợt cứng và kỹ thuật gia cố, vợt cầu lông giảm thiểu rung động và mất kiểm soát trong quá trình đánh cầu. Điều này giúp người chơi có thể kiểm soát và đánh cầu một cách chính xác, đồng thời giảm nguy cơ chấn thương.\r\n\r\nCuối cùng, vợt cầu lông còn có độ bền cao và đáng tin cậy. Vợt được làm từ các vật liệu chất lượng cao như graphite, carbon, và composite, giúp tăng tính bền bỉ và độ đàn hồi của vợt. Điều này đảm bảo rằng vợt có thể chịu được áp lực và sử dụng lâu dài mà không bị hư hỏng.', 1, 1),
(43, 'quả cầu lông 2', 260000, 80, '2024-03-09', 'sp8.jpg', 15, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1),
(44, 'quả cầu lông 3', 190000, 200, '2024-03-09', 'sp9.jpg', 15, 'Quả cầu lông là một vật tròn nhỏ được sử dụng trong môn thể thao cầu lông. Với đường kính khoảng 5-6 cm, quả cầu lông thường được làm từ vật liệu nhẹ như nylon hoặc lông chim. Đây là một phần quan trọng trong trò chơi cầu lông và mang đến nhiều đặc điểm đáng chú ý.\r\n\r\nQuả cầu lông có trọng lượng nhẹ, giúp cho việc di chuyển và đánh cầu trở nên nhanh chóng và linh hoạt. Trọng lượng nhẹ cũng tạo điều kiện thuận lợi cho người chơi thực hiện các cú đánh xoay cổ tay và lướt cầu một cách dễ dàng.', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote`
--

CREATE TABLE `vote` (
  `IdVote` int(11) NOT NULL,
  `NumVote` int(11) NOT NULL,
  `IdAcc` int(11) NOT NULL,
  `IdYard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vote`
--

INSERT INTO `vote` (`IdVote`, `NumVote`, `IdAcc`, `IdYard`) VALUES
(1, 4, 1, 6),
(2, 5, 4, 6),
(3, 5, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votepr`
--

CREATE TABLE `votepr` (
  `IdVote` int(11) NOT NULL,
  `IdPro` int(11) NOT NULL,
  `IdAcc` int(11) NOT NULL,
  `NumVote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `votepr`
--

INSERT INTO `votepr` (`IdVote`, `IdPro`, `IdAcc`, `NumVote`) VALUES
(1, 3, 1, 3),
(3, 2, 4, 5),
(5, 2, 1, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yard`
--

CREATE TABLE `yard` (
  `IdYard` int(11) NOT NULL,
  `NameYard` varchar(300) NOT NULL,
  `ImgYard` varchar(1000) NOT NULL,
  `AreaYard` int(11) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT 1,
  `PriceYard` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `QtyBooking` int(11) NOT NULL,
  `IdAcc` int(11) NOT NULL COMMENT 'Đây là IdPartner\r\n',
  `AddYard` varchar(1000) NOT NULL,
  `DesYard` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `yard`
--

INSERT INTO `yard` (`IdYard`, `NameYard`, `ImgYard`, `AreaYard`, `Status`, `PriceYard`, `Qty`, `QtyBooking`, `IdAcc`, `AddYard`, `DesYard`) VALUES
(1, 'Sân Huce', 'y8.jpg', 6, 1, 171000, 2, 10, 4, 'Nguyễn Trãi', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(2, 'Sân Mỹ Đình', 'y2.jpg', 5, 1, 191000, 5, 1, 4, 'Nam Từ Liêm', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(3, 'Sân C', 'y5.jpg', 9, 1, 143000, 3, 3, 5, 'Địa chỉ 3', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(4, 'Sân D', 'y7.jpg', 7, 1, 243000, 2, 2, 5, 'Địa chỉ 4', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(5, 'Sân Bách Khoa', 'y3.jpg', 8, 1, 285000, 4, 2, 5, 'Địa chỉ 5', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(6, 'Sân F', 'y1.jpg', 8, 1, 195000, 4, 1, 4, 'Địa chỉ 6', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(7, 'Sân G', 'y1.jpg', 6, 1, 222000, 5, 2, 5, 'Địa chỉ 7', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(8, 'Sân thử', 'b2.jpg', 7, 1, 227000, 4, 2, 5, 'đường Hùng Vương', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(9, 'Sân cầu lông A', 'y5.jpg', 4, 1, 168000, 4, 1, 4, 'Địa chỉ A', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(10, 'Sân cầu lông B', 'y3.jpg', 9, 1, 260000, 2, 1, 4, 'Địa chỉ B', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(11, 'Sân cầu lông C', 'y2.jpg', 3, 1, 297000, 3, 1, 4, 'Địa chỉ C', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(12, 'Sân cầu lông D', 'y2.jpg', 10, 1, 204000, 4, 2, 5, 'Địa chỉ D', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(13, 'Sân cầu lông E', 'y6.jpg', 7, 1, 231000, 3, 1, 4, 'Địa chỉ E', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(14, 'Sân cầu lông F', 'y8.jpg', 5, 1, 241000, 3, 2, 5, 'Địa chỉ F', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(15, 'Sân cầu lông G', 'y4.jpg', 3, 1, 215000, 3, 1, 4, 'Địa chỉ G', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(16, 'Sân cầu lông H', 'y1.jpg', 10, 1, 252000, 2, 1, 4, 'Địa chỉ H', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(17, 'Sân cầu lông I', 'y2.jpg', 10, 1, 115000, 5, 2, 5, 'Địa chỉ I', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(18, 'Sân cầu lông J', 'y7.jpg', 1, 1, 118000, 4, 2, 5, 'Địa chỉ J', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(19, 'Sân cầu lông K', 'y5.jpg', 3, 1, 145000, 5, 1, 4, 'Địa chỉ K', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(20, 'Sân cầu lông L', 'y6.jpg', 1, 1, 272000, 4, 2, 5, 'Địa chỉ L', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(21, 'Sân cầu lông M', 'y7.jpg', 4, 1, 225000, 4, 2, 5, 'Địa chỉ M', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(22, 'Sân cầu lông N', 'y4.jpg', 10, 1, 210000, 4, 1, 4, 'Địa chỉ N', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(23, 'Sân cầu lông O', 'y4.jpg', 6, 1, 276000, 4, 2, 5, 'Địa chỉ O', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(24, 'Sân cầu lông P', 'y1.jpg', 10, 1, 249000, 3, 2, 5, 'Địa chỉ P', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(25, 'Sân cầu lông Q', 'y8.jpg', 10, 1, 118000, 2, 2, 5, 'Địa chỉ Q', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(26, 'Sân cầu lông R', 'y5.jpg', 1, 1, 142000, 5, 1, 4, 'Địa chỉ R', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(27, 'Sân cầu lông S', 'y8.jpg', 3, 1, 258000, 3, 1, 4, 'Địa chỉ S', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(28, 'Sân cầu lông T', 'y6.jpg', 1, 1, 165000, 2, 2, 5, 'Địa chỉ T', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(29, 'Sân cầu lông U', 'y2.jpg', 8, 1, 150000, 5, 2, 5, 'Địa chỉ U', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(30, 'Sân cầu lông V', 'y6.jpg', 5, 1, 157000, 3, 2, 5, 'Địa chỉ V', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(31, 'Sân cầu lông W', 'y5.jpg', 2, 1, 236000, 5, 2, 5, 'Địa chỉ W', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(32, 'Sân cầu lông X', 'y6.jpg', 4, 1, 207000, 4, 2, 5, 'Địa chỉ X', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(33, 'Sân cầu lông Y', 'y2.jpg', 4, 1, 228000, 5, 2, 5, 'Địa chỉ Y', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(34, 'Sân cầu lông Z', 'y5.jpg', 7, 1, 218000, 3, 1, 4, 'Địa chỉ Z', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(35, 'Sân cầu lông AA', 'y7.jpg', 3, 1, 108000, 3, 2, 5, 'Địa chỉ AA', ' Sân cầu lông của chúng tôi mang đến cho bạn trải nghiệm chơi cầu lông không thể nào quên. Với thiết kế hiện đại và tiện nghi, mỗi chi tiết đều được chăm chút để tối ưu hóa hiệu suất và sự thoải mái. Mặt sân được phủ một lớp vật liệu đặc biệt, giảm thiểu trơn trượt và tăng cường độ bám, giúp bạn di chuyển linh hoạt và an toàn. Khán đài rộng lớn với ghế ngồi thoải mái, cho phép khán giả theo dõi mỗi trận đấu một cách rõ ràng và không bị cản trở tầm nhìn.'),
(36, 'Sân cầu lông BB', 'y4.jpg', 5, 1, 188000, 2, 2, 5, 'Địa chỉ BB', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(37, 'Sân cầu lông CC', 'y8.jpg', 3, 1, 116000, 2, 1, 4, 'Địa chỉ CC', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(38, 'Sân cầu lông DD', 'y6.jpg', 9, 1, 118000, 2, 2, 5, 'Địa chỉ DD', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(39, 'Sân cầu lông EE', 'y1.jpg', 6, 1, 139000, 3, 1, 4, 'Địa chỉ EE', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(40, 'Sân cầu lông FF', 'y4.jpg', 4, 1, 243000, 4, 1, 4, 'Địa chỉ FF', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(41, 'Sân cầu lông GG', 'y7.jpg', 2, 1, 299000, 4, 2, 5, 'Địa chỉ GG', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(42, 'Sân cầu lông HH', 'y4.jpg', 8, 1, 267000, 4, 2, 5, 'Địa chỉ HH', 'Khi bước vào không gian của sân cầu lông chúng tôi, bạn sẽ ngay lập tức cảm nhận được sự chuyên nghiệp và tận tâm. Sân cầu lông được thiết kế theo tiêu chuẩn quốc tế, với kích thước chuẩn xác đến từng centimet, đảm bảo không gian chơi lý tưởng cho mọi trận đấu. Mặt sân được làm từ vật liệu cao cấp, có độ bền cao và khả năng phản xạ tốt, giúp mỗi cú đánh của bạn trở nên chính xác và mạnh mẽ hơn. Hệ thống chiếu sáng được thiết kế tỉ mỉ, với ánh sáng đều và không gây chói mắt, tạo điều kiện tốt nhất cho việc quan sát và phản ứng nhanh nhẹn trong suốt trận đấu.\r\n\r\nChúng tôi không chỉ chú trọng đến chất lượng sân cầu lông mà còn đến trải nghiệm tổng thể của khách hàng. Phòng thay đồ rộng rãi, sạch sẽ với tủ đồ cá nhân, nhà vệ sinh hiện đại, và khu vực chờ thoải mái đều được bố trí khoa học, giúp bạn chuẩn bị và hồi phục sau mỗi trận đấu một cách tốt nhất. '),
(43, 'Sân cầu lông II', 'y2.jpg', 3, 1, 137000, 3, 2, 5, 'Địa chỉ II', 'Sân cầu lông của chúng tôi được xây dựng và bảo trì theo các tiêu chuẩn quốc tế nghiêm ngặt, đảm bảo môi trường chơi cầu lông chất lượng cao cho mọi người. Từ hệ thống lưới cầu lông không co giãn đến các dấu vạch sân được vẽ rõ ràng, mọi yếu tố đều được kiểm soát chặt chẽ để đáp ứng nhu cầu của các vận động viên và giải đấu cầu lông hàng đầu. Ngoài ra, chúng tôi còn cung cấp các loại cầu và vợt chất lượng cao, đảm bảo bạn luôn có trang thiết bị tốt nhất khi bước vào sân.'),
(44, 'Sân test ', 'y6.jpg', 2, 1, 200000, 3, 1, 7, 'Đương Lê Lợi', 'Sân đẹp lắm'),
(45, 'Sân A', 'y7.jpg', 3, 1, 200000, 2, 2, 5, '55 Giải Phóng', 'Sân của HUCE'),
(46, 'Sân B', 'y5.jpg', 3, 1, 150000, 4, 2, 5, '55 Giải Phóng', 'Sân thứ 2 HUCE'),
(47, 'Sân C', 'y4.jpg', 3, 1, 100000, 4, 2, 5, '55 Giải Phóng', 'Sân thứ 3 HUCE'),
(48, 'Đại học Xây Dựng', 'y1.jpg', 3, 1, 200000, 5, 0, 5, '55 Giải Phóng', 'Sân của kí túc xá ĐHXD');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`IdAcc`);

--
-- Chỉ mục cho bảng `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`IdArea`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`IdBooking`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCate`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`IdCmt`);

--
-- Chỉ mục cho bảng `commentpr`
--
ALTER TABLE `commentpr`
  ADD PRIMARY KEY (`IdCmt`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`IdOrder`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`IdPro`);

--
-- Chỉ mục cho bảng `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`IdVote`);

--
-- Chỉ mục cho bảng `votepr`
--
ALTER TABLE `votepr`
  ADD PRIMARY KEY (`IdVote`);

--
-- Chỉ mục cho bảng `yard`
--
ALTER TABLE `yard`
  ADD PRIMARY KEY (`IdYard`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `IdAcc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `area`
--
ALTER TABLE `area`
  MODIFY `IdArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `IdBooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `IdCate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `IdCmt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `commentpr`
--
ALTER TABLE `commentpr`
  MODIFY `IdCmt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `IdOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `IdPro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `vote`
--
ALTER TABLE `vote`
  MODIFY `IdVote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `votepr`
--
ALTER TABLE `votepr`
  MODIFY `IdVote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `yard`
--
ALTER TABLE `yard`
  MODIFY `IdYard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
