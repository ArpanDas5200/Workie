-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2023 at 12:44 PM
-- Server version: 5.7.40
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`) VALUES
(1, 'admin@gmail.com', 'admin123', 'admin'),
(2, 'test@gmail.com', 'test123', 'test'),
(3, 'kukume@mailinator.com', 'Pa$$w0rd!', 'Orli Mills'),
(4, 'viqeje@mailinator.com', 'Pa$$w0rd!', 'Gregory Hunter'),
(5, 'rinupewa@mailinator.com', 'Pa$$w0rd!', 'Adrian Moses'),
(6, 'admin@gmail.com', '69', 'Hashim Wong'),
(7, 'jefygufat@mailinator.com', 'Pa$$w0rd!', 'Flavia Booth'),
(8, 'tope@mailinator.com', 'Pa$$w0rd!', 'Ebony Butler'),
(9, 'pywejorud@mailinator.com', 'Pa$$w0rd!', 'Donna Foley'),
(10, 'rebesufa@mailinator.com', 'Pa$$w0rd!', 'Leo Moss'),
(11, 'lazyzemyh@mailinator.com', 'Pa$$w0rd!', 'Carlos Maynard');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `parent_id` bigint(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `parent_id`, `category_description`) VALUES
(1, 'Mens', 0, 'Clothes'),
(2, 'Formal', 5, 'Formal wear'),
(3, 'Informal', 1, 'Informal wear'),
(4, 'Suits', 2, 'Full Suits, tuxedo'),
(5, 'Plaza', 8, 'asdq3wq'),
(6, 'Female', 0, 'formal'),
(7, 'tuex', 5, 'asdasdqwer'),
(8, 'casula', 0, 'cas'),
(9, 'Shoes', 0, 'Casual');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `mini_value` int(255) NOT NULL,
  `discount` int(30) NOT NULL,
  `expiry` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `mini_value`, `discount`, `expiry`) VALUES
(1, 'PROMO90', 5000, 30, '2023-05-11'),
(2, 'YIPEEE500', 20000, 8, '2023-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(6) NOT NULL,
  `status` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postcode` bigint(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `otp`, `status`, `phone_no`, `address`, `state`, `postcode`, `country`) VALUES
(37, 'Maia', 'Jacobson', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 439109, 'unverified', '+1 (949) 208-1552', 'Molestiae aliquam cu', 'Nemo iste odit offic', 64, 'Temporibus consequat'),
(40, 'Rhiannon', 'Guzman', 'zoxedywa@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, '', '+1 (555) 257-4966', 'Libero voluptatem do', 'Voluptate aperiam pa', 80, 'Incididunt optio nu'),
(45, 'Brent', 'Perry', 'molepit@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, '', '+1 (882) 627-5908', 'Aut ab temporibus pl', 'Nisi aut quas ipsam ', 62, 'Pariatur Doloremque'),
(46, 'Scarlet', 'Cardenas', 'fiviqa@mailinator.com', '202cb962ac59075b964b07152d234b70', 0, '', '+1 (341) 385-3228', 'Sunt sapiente eum s', 'Fugiat fugit nesciu', 46, 'Aspernatur aspernatu'),
(44, 'Mikayla', 'Navarro', 'test2@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '+1 (739) 871-3447', 'Consequatur est lab', 'Facere nesciunt con', 86, 'Totam aspernatur mol'),
(47, 'Roth', 'Snow', 'laqipako@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 'unverified', '+1 (842) 626-5874', 'Sed enim itaque arch', 'Voluptas at nulla cu', 49, 'Tempore voluptate u'),
(48, 'Sybil', 'Guthrie', 'xekevez@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 'unverified', '+1 (426) 165-6782', 'Repudiandae perferen', 'Ut explicabo Atque ', 1, 'Quos hic et fugit v'),
(49, 'Otto', 'Whitley', 'warynuke@mailinator.com', '3ef815416f775098fe977004015c6193', 882593, 'verified', '+1 (101) 705-1318', 'Tempora dolor blandi', 'Repellendus Omnis v', 27, 'Consequuntur non odi'),
(50, 'Kadeem', 'Buck', 'testing11@gmail.com', 'a35f136b956748931017dc92a5c70420', 0, 'unverified', '9654632816', 'lpnikaspfcioapovja[pokcf[sc[apdvposvpjasopk[apjvhopisj[apkpk[', 'Gujarat', 315009, 'India'),
(54, 'Raya', 'Burton', 'arpandas.dds@gmail.com', '202cb962ac59075b964b07152d234b70', 851920, 'verified', '+1 (233) 963-6139', 'Et dolore aut quis m', 'Facere duis vitae de', 63, 'Consequuntur ratione'),
(52, 'Tad', 'Howell', 'kamotipo@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 'unverified', '+1 (812) 806-7425', 'Aperiam asperiores m', 'Et labore voluptatem', 26, 'Provident labore qu'),
(53, 'Wyatt', 'Flores', 'a1dmin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 184840, 'verified', '+1 (847) 433-5459', 'Non libero hic molli', 'Dolor ab numquam sun', 5, 'Quis culpa hic nihi'),
(55, 'Ankush', 'Mahaskar', 'ankushtest@gmail.com', '25f9e794323b453885f5181f1b624d0b', 0, 'unverified', '7894561230', 'Pariatur Amet proi', 'Amet nulla ullamco ', 585252, 'Commodi ex incidunt');

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

DROP TABLE IF EXISTS `email_verification`;
CREATE TABLE IF NOT EXISTS `email_verification` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(6) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_verification`
--

INSERT INTO `email_verification` (`email`, `password`, `otp`, `status`) VALUES
('arpandas.dds@gmail.com', '202cb962ac59075b964b07152d234b70', 877965, 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(255) NOT NULL AUTO_INCREMENT,
  `customer_id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `order` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `signature_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `add_on` datetime NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customer_id`, `order_id`, `order`, `quantity`, `payment_id`, `signature_id`, `status`, `add_on`) VALUES
(18, 50, 'order_LlArem8WJNcgQy', '64', '4', 'pay_LlAt3LajeDt6oi', 'f9f0f06f9701c5446ee5b1f44773add10d4431c53e8fde08d8b17fade5c0703b', 'incomplete', '2023-05-03 17:02:48'),
(16, 44, 'order_Ll9CZbUQDToxEr', '64', '26', 'pay_Ll9CdedYuValKg', 'cde91f7021795a30b6c058103612640f5e83fb5acd6f2937612e5ba41fee9f28', 'incomplete', '2023-05-03 15:23:43'),
(20, 44, 'order_Lny0UIzHJRO1uv', '68, 64', '2, 1', 'pay_Lny1866qhcjyJ5', 'f99bf8e8d6af4d9013b7d8aedad2f9c227dcc5f0068cad614e01ac1223c5c5bc', 'incomplete', '2023-05-10 18:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `product_parent` varchar(255) NOT NULL,
  `product_parent_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `inventory` bigint(255) NOT NULL,
  `price` bigint(224) NOT NULL,
  `discount` bigint(225) DEFAULT NULL,
  `finalprice` bigint(255) NOT NULL,
  `deliverycharges` bigint(100) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_parent`, `product_parent_id`, `name`, `description`, `image`, `slug`, `inventory`, `price`, `discount`, `finalprice`, `deliverycharges`, `tags`, `created_at`, `modified_at`) VALUES
(59, 'Formal', 2, 'Chester Bradshaw', 'Hic nesciunt tempor', 'formalshoes(6).jpg & shoes(6).jpg', 'hic-nesciunt-tempor', 57, 208, 1, 206, 36, 'Quam est natus lorem', '2023-04-24 11:56:43', '2023-04-26 10:09:39'),
(64, 'Shoes', 9, 'Vivien Howe', 'In voluptatem praes', 'shoes(6).jpg', 'vivien-howe', 5, 925917, 98, 18518, 288, 'Molestiae possimus ', '2023-04-29 09:46:03', '2023-05-10 18:24:15'),
(65, 'Suits', 4, 'Bruce Mcfarland', 'Doloribus ducimus a', 'casualsuit(6).jpg', 'bruce-mcfarland', 10, 88956, 52, 42699, 22, 'Ut ipsum qui ea veri', '2023-04-29 09:59:04', '2023-05-03 11:44:13'),
(60, 'casula', 8, 'Angelica Morales', 'Nisi cillum voluptat', 'pants.jpg & formalshoes(6).jpg & casualshoes(7).jpg & shoes(6).jpg', 'angelica-morales', 0, 1828, 14, 1572, 0, 'Sapiente nemo iure m,adqwbarbhet,wefvarweh', '2023-04-26 09:59:01', '2023-04-28 17:02:02'),
(63, 'Informal', 3, 'Timothy Rodriguez', 'Vitae ut omnis aperi', 'pants.jpg & formalshoes(6).jpg & casualshoes(7).jpg', 'timothy-rodriguez', 97, 863, 21, 682, 100, 'Autem aut inventore ', '2023-04-29 09:42:49', '2023-05-03 18:03:29'),
(62, 'Formal', 2, 'Frances Simmons', 'Quia quos provident', 'shoes(6).jpg & suits(6).jpg', 'frances-simmons', 0, 355, 22, 277, 52, 'Veritatis recusandae', '2023-04-29 09:38:09', '2023-05-03 11:26:45'),
(66, 'Shoes', 9, 'Henry Phillips', 'Vitae Nam aut et eiu', 'formalshoes(6).jpg', 'henry-phillips', 56, 424, 0, 424, 0, 'Id elit modi praese', '2023-05-01 12:26:57', '2023-05-03 11:44:13'),
(67, 'Plaza', 5, 'Lacey Underwood', 'Ut expedita unde ver', 'pants.jpg', 'lacey-underwood', 87, 644, 62, 245, 75, 'Aliquid quia et volu', '2023-05-10 13:57:56', '2023-05-10 13:57:56'),
(68, 'Female', 6, 'Joseph Lamb', 'Debitis et est enim ', 'pants.jpg', 'joseph-lamb', 90, 183, 68, 59, 100, 'Nam ipsam cupiditate', '2023-05-10 13:58:55', '2023-05-10 18:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_visits`
--

DROP TABLE IF EXISTS `product_visits`;
CREATE TABLE IF NOT EXISTS `product_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(255) NOT NULL,
  `visit_count` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_visits`
--

INSERT INTO `product_visits` (`id`, `product_id`, `visit_count`) VALUES
(11, 60, 1),
(12, 61, 1),
(13, 62, 1),
(14, 63, 1),
(15, 64, 1),
(16, 59, 0),
(17, 65, 1),
(18, 66, 0),
(19, 67, 0),
(20, 68, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone_no`) VALUES
(30, 'Jimmy', 'Mason', 'xyzdev@gmail.com', 1234567890),
(31, 'Jimmy', 'Byers', 'developer.designer18@gmail.com', 3216549870),
(32, 'Jimmy', 'Byers', 'developer.designer18@gmail.com', 3216549870),
(33, 'Jinal', 'Mason', 'test@gmail.com', 2654897130),
(34, 'Jinal', 'Mason', 'test@gmail.com', 2654897130),
(35, 'Dennis', 'test', 'a@gmail.com', 7896541230),
(36, 'Jiya', 'Wall', 'jayadds16@gmail.com', 1232435353),
(37, 'Jimmy', 'Purohit', 'jayadds16@gmail.com', 1597532145),
(38, 'Jimmy', 'Mason', 'xyzdev@gmail.com', 7894561230),
(39, 'asdasd', 'asdasd', 'admin@gmail.com', 1236547890),
(40, 'asdasd', 'asdasd', 'admin@gmail.com', 1236547890),
(41, 'Nimisha', 'Wall', 'test@gmail.com', 1234567890),
(42, 'Daisy', 'putin', 'daisy@gmail.com', 1234567890),
(43, 'Kylie', 'Melyssa', 'jato@mailinator.com', 68);

-- --------------------------------------------------------

--
-- Table structure for table `user_visits`
--

DROP TABLE IF EXISTS `user_visits`;
CREATE TABLE IF NOT EXISTS `user_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` text NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `visit_count` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_visits`
--

INSERT INTO `user_visits` (`id`, `user_ip`, `product_id`, `visit_count`) VALUES
(7, '::1', 58, 25),
(6, '::1', 55, 20),
(8, '::1', 59, 28),
(9, '::1', 54, 5),
(10, '::1', 56, 12),
(11, '::1', 57, 7),
(12, '::1', 61, 11),
(13, '::1', 60, 1),
(14, '::1', 62, 2),
(15, '::1', 63, 2),
(16, '::1', 64, 1),
(17, '::1', 65, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
