-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2015 at 03:56 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryname`, `activate`, `time_created`, `time_updated`) VALUES
(1, 'Khoa hoc', 0, '2015-08-03 09:20:45', '2015-08-08 15:13:51'),
(2, 'Giao duc', 1, '2015-08-03 09:32:45', '2015-08-08 15:07:08'),
(3, 'Van hoc', 0, '2015-08-03 09:33:02', '2015-08-08 15:07:50'),
(4, 'Truyen tranh', 1, '2015-08-03 09:33:11', '2015-08-03 09:33:11'),
(5, 'Ngon ngu', 1, '2015-08-03 09:33:26', '2015-08-03 09:33:26'),
(7, 'Xa hoi', 1, '2015-08-03 09:40:59', '2015-08-03 09:40:59'),
(8, 'Van hoa', 0, '2015-08-03 09:41:11', '2015-08-03 09:41:11'),
(10, 'Triet hoc', 1, '2015-08-03 10:20:17', '2015-08-03 10:20:17'),
(11, 'Kinh Phat', 1, '2015-08-06 04:33:37', '2015-08-06 04:33:37'),
(12, 'Xa luan', 1, '2015-08-06 04:35:38', '2015-08-06 04:35:38'),
(16, 'Bao chi', 1, '2015-08-08 15:28:32', '2015-08-08 15:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `productname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) NOT NULL,
  `description` mediumblob NOT NULL,
  `category_id` int(6) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productname` (`productname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productname`, `price`, `description`, `category_id`, `activate`, `time_created`, `time_updated`, `image`) VALUES
(13, 'Toan hoc', 1234, 0x6d6f616d6f616d6f61, 2, 0, '2015-08-03 07:21:04', '2015-08-09 08:00:07', 'Toan hoc'),
(18, 'Tieng Viet', 1212, 0x34323334323334, 8, 1, '2015-08-03 08:37:39', '2015-08-09 07:46:28', 'Tieng Viet'),
(19, 'Vat Ly', 24234, 0x617366646673617366736166, 2, 1, '2015-08-03 08:43:22', '2015-08-09 07:00:38', 'Vat Ly'),
(20, 'Hoa Hoc', 4645, 0x71717171717171717171717171717171717171717171717171717171717171717171717171717171717171717171717171717171, 2, 0, '2015-08-03 08:43:44', '2015-08-09 07:57:19', 'Hoa Hoc'),
(23, 'Cong Nghe', 32312, 0x6861792070686574, 1, 1, '2015-08-06 04:34:52', '2015-08-09 07:46:51', 'Cong Nghe'),
(25, 'Doremon', 2342, 0x6d656f206d617920646f72656d6f6e, 4, 0, '2015-08-06 09:02:14', '2015-08-06 09:48:43', 'Doremon'),
(29, 'Bao Lao Dong', 423423, 0x3265657277657277657277726577, 16, 1, '2015-08-07 10:20:03', '2015-08-09 07:47:03', 'Bao Lao Dong'),
(31, 'Cong dan', 0, 0x66736466736466, 0, 0, '2015-08-09 02:26:38', '2015-08-09 02:26:38', 'Cong dan'),
(50, 'Dan tri', 4342, 0x3233343234323334, 16, 1, '2015-08-09 03:10:02', '2015-08-09 07:47:11', 'Dan tri'),
(57, 'Tu Tuong', 4242, 0x6d6f6e206e6179206368616e2063686574, 10, 0, '2015-08-09 07:48:52', '2015-08-09 07:48:52', 'Tu Tuong'),
(59, 'The duc', 42342, 0x6162637a7973667364, 2, 0, '2015-08-09 07:50:32', '2015-08-09 07:50:32', 'The duc'),
(61, 'Duong loi', 6456, 0x667366736166736673676766666467, 10, 0, '2015-08-09 07:51:14', '2015-08-09 07:51:14', 'Duong loi'),
(63, 'Tieng Anh', 4242, 0x77727772777277, 2, 0, '2015-08-09 07:51:48', '2015-08-09 07:51:48', 'Tieng Anh'),
(65, 'Sinh hoc', 2342, 0x666764666773667364, 2, 0, '2015-08-09 07:52:26', '2015-08-09 07:52:26', 'Sinh hoc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `time_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=453 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `activate`, `time_created`, `time_updated`, `image`) VALUES
(252, 'HoangThao', 'thaoxau@gmail.com', '123456789', 1, '2015-07-31 03:43:52', '2015-08-09 04:27:01', 'HoangThao'),
(253, 'Boo_Uet', 'chuquynhtrang.dhcn@gmail.com', '01112014', 1, '2015-07-31 03:45:22', '2015-08-09 07:35:04', 'Boo_Uet'),
(254, 'Mai_Hoa', 'maihoa@gmail.com', '12345678', 0, '2015-07-31 03:45:46', '2015-08-08 03:55:00', 'Mai_Hoa'),
(255, 'Nguyen_Hong', 'nguyenhong@gmail.com', '12345678', 0, '2015-07-31 04:12:13', '2015-08-08 05:00:35', 'Nguyen_Hong'),
(425, 'Banh_Quy', 'banhquy@gmail.com', '123456789', 1, '2015-08-05 07:43:33', '2015-08-09 02:53:33', 'Banh_Quy'),
(426, 'Lim_Lovely', 'linh7995@gmail.com', '12345678', 1, '2015-08-05 07:43:59', '2015-08-06 09:39:47', 'Lim_Lovely'),
(427, 'TrangBoo', 'boobeo@gmail.com', '12345678', 0, '2015-08-05 07:44:36', '2015-08-05 07:44:36', 'TrangBoo'),
(428, 'SangNguyen', 'sangnguyen@gmail.com', '12345678', 1, '2015-08-05 07:45:25', '2015-08-05 07:45:25', 'SangNguyen'),
(430, 'BooVitBau', 'shinkool_hn@yahoo.com.vn', '1342342332', 0, '2015-08-05 08:58:08', '2015-08-06 08:45:39', 'BooVitBau'),
(431, 'Duc_Minh', 'minhtran@gmail.com', '12345678', 0, '2015-08-06 01:56:58', '2015-08-06 09:14:22', 'Duc_Minh'),
(432, 'Van_Hoang', 'vuvananh@gmail.com', '12345678', 0, '2015-08-06 01:57:41', '2015-08-08 05:00:52', 'Van_Hoang'),
(433, 'Thao_Minh', 'minhthao@gmail.com', '11111111', 1, '2015-08-06 02:01:04', '2015-08-06 02:01:04', 'Thao_Minh'),
(434, 'Khanh_Linh', 'linh7995@gmail.com', '12345678', 1, '2015-08-06 02:01:28', '2015-08-06 09:43:23', 'Khanh_Linh'),
(435, 'Canh_Hoang', 'chutrang@gmai.com', '12345678', 0, '2015-08-06 02:02:02', '2015-08-06 09:36:21', 'Canh_Hoang'),
(436, 'Son_Nguyen', 'sonnguyen@gmail.com', '12345678', 1, '2015-08-06 02:02:50', '2015-08-06 09:34:55', 'Son_Nguyen'),
(438, 'YenNguyen', 'yennguyen@gmail.com', '12345678', 0, '2015-08-06 02:22:40', '2015-08-06 02:22:40', 'YenNguyen'),
(439, 'Bao_Binh', 'boobeo@gmail.com', '12345678', 1, '2015-08-06 02:34:17', '2015-08-06 07:24:48', 'Bao_Binh'),
(440, 'Giang_Quynh', 'giang@gmail.com', '12345678', 0, '2015-08-06 02:34:38', '2015-08-06 06:14:28', 'Giang_Quynh'),
(441, 'Thang_Nguyen', 'thaopham@gmail.com', '12345678', 1, '2015-08-06 02:35:06', '2015-08-06 02:35:06', 'Thang_Nguyen'),
(442, 'Dinh_Quang', 'quang@gmail.com', '12345678', 0, '2015-08-06 02:35:34', '2015-08-06 02:35:34', 'Dinh_Quang'),
(443, 'Bac_Truong', 'bactruong@gmail.com', '12345678', 0, '2015-08-06 02:36:17', '2015-08-06 02:36:17', 'Bac_Truong'),
(444, 'Vinh_Hoa', 'vuvananh@gmail.com', '12345678', 1, '2015-08-06 03:08:39', '2015-08-06 03:08:39', 'Vinh_Hoa'),
(445, 'ThuyNguyen', 'thuy@gmail.com', '12345678', 0, '2015-08-06 03:14:49', '2015-08-06 03:14:49', 'ThuyNguyen'),
(448, 'Binh_Duong', 'boodangyeu@gmail.com', '12345678', 1, '2015-08-06 03:16:27', '2015-08-06 03:16:27', 'Binh_Duong'),
(451, 'Quan_Gia', 'quangia@gmail.com', '12345678', 0, '2015-08-06 06:54:06', '2015-08-06 06:54:06', 'Quan_Gia'),
(452, 'Tham_Thi', 'thaopham@gmail.com', '12345678', 0, '2015-08-08 15:21:37', '2015-08-08 15:21:37', 'Tham_Thi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
