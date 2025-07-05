-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2025 at 08:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memberdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cm`
--

CREATE TABLE `admin_cm` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `pass` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `by` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_cm`
--

INSERT INTO `admin_cm` (`id`, `username`, `name`, `pass`, `by`) VALUES
(1, 'admin', 'admin', '@dmin', 'Nawee');

-- --------------------------------------------------------

--
-- Table structure for table `event_cm`
--

CREATE TABLE `event_cm` (
  `id` int NOT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phonenum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guests` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(255) DEFAULT 'กำลังรอดำเนินการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_cm`
--

INSERT INTO `event_cm` (`id`, `event`, `username`, `phonenum`, `guests`, `date`, `time`, `status`) VALUES
(10, 'Meeting', 'potato015', '096 810 8480', '10', '2025-05-29', '13:00 AM -18:00 PM', 'กำลังรอดำเนินการ'),
(11, 'Private-Meeting', 'BabaYaga', '096 810 8480', '20', '2025-06-01', 'ทั้งวัน', 'กำลังรอดำเนินการ'),
(12, 'Meeting', 'potato015', '999 999 9999', '4', '2025-06-12', 'ทั้งวัน', 'กำลังรอดำเนินการ'),
(13, 'Shooting Studios', 'potato015', '096 810 8480', '10', '2025-06-12', '13:00 AM -18:00 PM', 'กำลังรอดำเนินการ'),
(14, 'Pre-Wedding', 'potato015', '999 999 9999', '40', '2025-06-14', 'ทั้งวัน', 'กำลังรอดำเนินการ'),
(15, 'Private-Meeting', 'potato015', '096 810 8480', '10', '2025-07-02', '13:00 AM -18:00 PM', 'กำลังรอดำเนินการ'),
(16, 'Shooting photo Studios no.2', 'potato015', '096 810 8480', '50', '2025-06-19', '1:00 PM - 6:00 PM', 'กำลังรอดำเนินการ');

-- --------------------------------------------------------

--
-- Table structure for table `member_cm`
--

CREATE TABLE `member_cm` (
  `id` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phonenum` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_cm`
--

INSERT INTO `member_cm` (`id`, `firstname`, `surname`, `phonenum`, `username`, `pass`, `email`) VALUES
(12, 'Tanadon', 'Lerakiattivanis', 968108480, 'potato015', '$2y$10$KBY016VZjDYYRuDudgizjOJbEuvgasCP2KL3PaIrg2pr.hyOzUQy6', 'protae1589@gmail.com'),
(13, 'Peter', 'Griffin', 666999666, 'PeterGriffin', '$2y$10$/b/8AvVaL2tibIYD4hMtXu.TuqXSX8IW8LLXLFcgwguBk6han2MJ6', 'peter@gmail.com'),
(14, 'John', 'Wick', 99999999, 'BabaYaga', '$2y$10$.owHTOLab7OzkbccJ.ZSteRhbNRp8wFC7cODx1YLIyHS2qgf24qcO', 'John@gmail.com'),
(15, 'Tanadon', 'Lerakiattivanis', 968108480, 'potato9549', '$2y$10$1INJTjKUGvKAEWpXRgMOSOuN.1W8/ltEZhJwDxLwcsEo0NQt5hM82', 'protae1589@gmail.com'),
(17, 'ธนดล', 'ลีลาเกียรติวณิช', 968108480, 'โปเต้9549', '$2y$10$F1x5svowldEawI5Pxwo86e4Ul5G.H7YY8gkhqvd9XrZJXxXgq48m6', 'protae1589@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `menu_cm`
--

CREATE TABLE `menu_cm` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `menu_group` varchar(255) NOT NULL,
  `menu_type` varchar(255) NOT NULL,
  `drink_type` varchar(255) DEFAULT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_cm`
--

INSERT INTO `menu_cm` (`id`, `image`, `name`, `price`, `menu_group`, `menu_type`, `drink_type`, `is_closed`) VALUES
(6, 'img_6821c24e1655b7.10178600.jpg', 'Oreo Milk', '150', 'Drink', 'Milk', 'Smoothie', 0),
(7, 'img_6821c27509fe40.97944084.jpg', 'Topical', '135', 'Drink', 'Milk', 'Smoothie', 0),
(9, 'img_6821c523425234.41386754.jpg', 'Iced Late', '100', 'Drink', 'Coffee', 'Iced', 0),
(10, 'img_6821c56c7dfc45.39835489.jpg', 'Iced Cappuccino', '100', 'Drink', 'Coffee', 'Iced', 0),
(11, 'img_6821c5d266f126.96502033.jpg', 'H Late', '95', 'Drink', 'Coffee', 'Hot', 0),
(12, 'img_6821c5fb67f970.20865332.jpg', 'H Cappuccino', '95', 'Drink', 'Coffee', 'Hot', 0),
(14, 'img_6821c68f5f69d6.02148857.jpg', 'H Mocha', '110', 'Drink', 'Coffee', 'Hot', 0),
(19, 'img_6823262c37bf42.35608628.jpg', 'Hawaiian Pizza', '290', 'Food', 'Pizza', NULL, 0),
(24, 'img_6825ac62766ab6.17851728.jpg', 'Chicky', '185', 'Dessert', 'Cake', NULL, 0),
(25, 'img_6825ac80b089f7.02340855.jpg', 'Mini Black Cat', '225', 'Dessert', 'Cake', NULL, 0),
(26, 'img_6825aca5959934.02438193.jpg', 'Puppy', '185', 'Dessert', 'Cake', NULL, 1),
(27, 'img_6825acc1e1b811.72437595.jpg', 'Panda Set', '245', 'Dessert', 'Cake', NULL, 1),
(28, 'img_6825acd00254f8.07447561.jpg', 'Teddy Set', '245', 'Dessert', 'Cake', NULL, 0),
(29, 'img_6825ad9454c1b6.37401499.jpg', 'Rib-Eye Steak', '495', 'Food', 'Main', NULL, 0),
(30, 'img_6825add40777a6.07574646.jpg', 'Kurobuta-Tenderloin Steak', '345', 'Food', 'Main', NULL, 0),
(31, 'img_6825ae153c38a1.48872887.jpg', 'Grilled Chicken Breast Steak', '295', 'Food', 'Main', NULL, 0),
(32, 'img_6825aea59aac69.18418183.jpg', 'Cafe Latte Frappe', '120', 'Drink', 'Coffee', 'Smoothie', 0),
(33, 'img_6825b9a2f31ce3.48097974.jpg', 'Chocolate Frappe', '135', 'Drink', 'Milk', 'Smoothie', 0),
(34, 'img_6825b9ebcf66b1.81923751.jpg', 'Thaitea Milk Frappe', '120', 'Drink', 'Milk', 'Smoothie', 0),
(35, 'img_6825ba1e8b10e8.61964758.jpg', 'Caramel Milk Frappe', '135', 'Drink', 'Milk', 'Smoothie', 0),
(36, 'img_6825ba4cbc1be1.11016837.jpg', 'H Chocolate Mellow', '95', 'Drink', 'Milk', 'Hot', 0),
(37, 'img_6825baa6c59c76.26904229.jpg', 'TH!NK Signature Chocolate Frappe', '195', 'Drink', 'Milk', 'Smoothie', 0),
(38, 'img_6825bae1d1f456.04937642.jpg', 'Mint Chocolate Milk', '145', 'Drink', 'Milk', 'Iced', 0),
(39, 'img_6825bb1bd355e2.37650625.jpg', 'Chocolate Orange Bomb', '185', 'Drink', 'Milk', 'Iced', 0),
(40, 'img_6825c613e93f08.63485351.jpg', 'Lemon Iced Tea', '145', 'Drink', 'Tea', 'Iced', 0),
(41, 'img_6825c87196dc56.78306768.jpg', 'Thai Tea Milk', '95', 'Drink', 'Tea', 'Iced', 0),
(42, 'img_6825c89b542263.85303065.jpg', 'Thai Tea Milk Frappe', '120', 'Drink', 'Tea', 'Smoothie', 0),
(43, 'img_6825c8f48a0dd1.59522512.jpg', 'Greentea Milk Frappe', '150', 'Drink', 'Tea', 'Smoothie', 0),
(44, 'img_6825c91fc955d5.65621533.jpg', 'Macha Greentea Latte', '115', 'Drink', 'Tea', 'Iced', 0),
(45, 'img_6825c954018f93.33104727.jpg', 'Exotic White Tea', '150', 'Drink', 'Tea', 'Iced', 0),
(46, 'img_6825c9f5d21030.71594678.jpg', 'Macha Greentea (No Milk)', '135', 'Drink', 'Tea', 'Iced', 0),
(47, 'img_6825ca2990f678.56672785.jpg', 'Paradise Yusu', '145', 'Drink', 'Fruit', 'Iced', 0),
(48, 'img_6825ca78e5ed09.91914511.jpg', 'Passion Fruit Soda', '105', 'Drink', 'Fruit', 'Iced', 0),
(49, 'img_6825cab6817143.27550526.jpg', ' Apple Peach Soda', '145', 'Drink', 'Fruit', 'Iced', 0),
(50, 'img_6825cb10105127.27986852.jpg', 'Apple Smoothie', '145', 'Drink', 'Fruit', 'Smoothie', 0),
(51, 'img_6825cb48c90867.86720372.jpg', 'Strawberry Smoothie', '120', 'Drink', 'Fruit', 'Smoothie', 0),
(52, 'img_6825cb72385d12.68119711.jpg', 'Lychee Smoothie', '120', 'Drink', 'Fruit', 'Smoothie', 0),
(53, 'img_6825cca7d38da9.10991276.jpg', 'Chocolate Ferrero Toast', '250', 'Recommend', 'Best Sale', NULL, 0),
(55, 'img_68261d7c17aa07.17573173.jpg', 'Kaki Strawberry', '245', 'Dessert', 'Kaki', NULL, 0),
(59, 'img_682eb2e909b941.46683299.jpg', 'Grilled Salmon Fillets Steak', '495', 'Food', 'Main', NULL, 0),
(60, 'img_682ebda27030d1.43891172.jpg', 'Chocolate Orange Bomb', '185', 'Recommend', 'New', NULL, 0),
(61, 'img_682ed498f1f489.93815720.jpg', 'Four Cheeses Pizza', '260', 'Food', 'Pizza', NULL, 0),
(62, 'img_682ed4bd14c639.91490682.jpg', 'Four Cheeses Pizza', '260', 'Recommend', 'New', NULL, 0),
(63, 'img_682ed599369b55.88733209.jpg', 'Smoked Salmon Spaghetti', '295', 'Food', 'Pasta', NULL, 0),
(64, 'img_682ed5dd039e23.47534373.jpg', 'Tuna & Mushroom Pesto Spagehtti', '195', 'Food', 'Pasta', NULL, 0),
(65, 'img_682ed5ff7b09b9.33488878.jpg', 'Chocolate Ferrero Toast', '250', 'Dessert', 'Toast', NULL, 0),
(66, 'img_682ed639ce8995.32244540.jpg', 'Chocolate Kaki', '189', 'Recommend', 'New', NULL, 0),
(67, 'img_682ed64601b3d7.98296978.jpg', 'Chocolate Kaki', '189', 'Dessert', 'Kaki', NULL, 0),
(68, 'img_682ed8211f0026.52243275.jpg', 'Bacon & Chicken Burger', '265', 'Food', 'Burger', NULL, 0),
(69, 'img_682ed8470a9e77.30961329.jpg', 'Hawaiian Kurobuta Burger', '295', 'Food', 'Burger', NULL, 0),
(70, 'img_682ed88b7cf296.41580634.jpg', 'Caramel Popcorn Toast', '245', 'Dessert', 'Toast', NULL, 0),
(71, 'img_682ed8a6b580e2.27976691.jpg', 'Cheeses Toast', '215', 'Dessert', 'Toast', NULL, 0),
(72, 'img_682ed937612338.83592303.jpg', 'Strawberry Chocolate Crepe', '225', 'Dessert', 'Crepe', NULL, 0),
(73, 'img_682ed95f9ca623.54797701.jpg', 'Banoffee Crepe', '215', 'Dessert', 'Crepe', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `order_details` text,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `table_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `order_details`, `total`, `status`, `created_at`, `table_id`) VALUES
(92, 'PukNv', 'Four Cheeses Pizza (Food) *1 - 260 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nTuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\n', 750.00, 'Completed', '2025-06-11 12:32:22', '3'),
(98, 'PukNv', 'Tuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nFour Cheeses Pizza (Food) *2 - 520 ฿\n', 1010.00, 'Completed', '2025-06-11 12:57:45', '5'),
(99, 'PukNv', 'Four Cheeses Pizza (Food) *2 - 520 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nHawaiian Pizza (Food) *1 - 290 ฿\n', 1105.00, 'Completed', '2025-06-17 13:22:47', '10'),
(100, 'PukNv', 'Four Cheeses Pizza (Food) *2 - 520 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nHawaiian Pizza (Food) *1 - 290 ฿\n', 1105.00, 'Completed', '2025-06-17 13:22:47', '10'),
(101, 'PukNv', 'Hawaiian Pizza (Food) *1 - 290 ฿\nFour Cheeses Pizza (Food) *1 - 260 ฿\nSmoked Salmon Spaghetti (Food) *2 - 590 ฿\nTuna & Mushroom Pesto Spagehtti (Food) *2 - 390 ฿\n', 1530.00, 'Completed', '2025-06-17 13:23:05', '10'),
(103, 'PukNv', 'Tuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nFour Cheeses Pizza (Food) *1 - 260 ฿\n', 750.00, 'Completed', '2025-06-17 15:01:34', '10'),
(104, 'PukNv', 'Tuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\nBacon & Chicken Burger (Food) *1 - 265 ฿\nHawaiian Kurobuta Burger (Food) *1 - 295 ฿\n', 755.00, 'Completed', '2025-06-17 15:03:46', '10'),
(105, 'PukNv', 'Chocolate Orange Bomb (Drink) *2 - 370 ฿\nThaitea Milk Frappe (Drink) *1 - 120 ฿\nChocolate Frappe (Drink) *1 - 135 ฿\n', 625.00, 'Completed', '2025-06-17 15:34:54', ''),
(107, 'PukNv', 'Smoked Salmon Spaghetti (Food) *1 - 295 ฿\nFour Cheeses Pizza (Food) *1 - 260 ฿\nTuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\n', 750.00, 'Pending', '2025-06-17 16:35:03', ''),
(108, 'admin', 'Hawaiian Kurobuta Burger (Food) *1 - 295 ฿\nCaramel Popcorn Toast (Dessert) *1 - 245 ฿\nCheeses Toast (Dessert) *1 - 215 ฿\n', 755.00, 'Accepted', '2025-06-17 16:35:16', ''),
(109, 'admin', 'Hawaiian Kurobuta Burger (Food) *1 - 295 ฿\nCaramel Popcorn Toast (Dessert) *1 - 245 ฿\nCheeses Toast (Dessert) *1 - 215 ฿\n', 755.00, 'Accepted', '2025-06-17 16:35:23', ''),
(110, 'admin', 'Caramel Popcorn Toast (Dessert) *1 - 245 ฿\nHawaiian Kurobuta Burger (Food) *1 - 295 ฿\nCheeses Toast (Dessert) *1 - 215 ฿\n', 755.00, 'Accepted', '2025-06-17 16:48:39', ''),
(111, 'admin', 'Hawaiian Kurobuta Burger (Food) *1 - 295 ฿\nCaramel Popcorn Toast (Dessert) *1 - 245 ฿\nCheeses Toast (Dessert) *1 - 215 ฿\n', 755.00, 'Accepted', '2025-06-17 16:49:09', '12'),
(112, 'admin', 'H Cappuccino (Drink) *1 - 95 ฿\nH Late (Drink) *1 - 95 ฿\n', 190.00, 'Accepted', '2025-06-17 16:52:12', '20'),
(114, 'admin', 'Puppy (Dessert) *4 - 740 ฿\n', 740.00, 'Pending', '2025-06-17 16:53:32', '12'),
(115, 'admin', 'Panda Set (Dessert) *4 - 980 ฿\n', 980.00, 'Pending', '2025-06-17 16:53:37', '32'),
(116, 'admin', 'Caramel Popcorn Toast (Dessert) *1 - 245 ฿\nCheeses Toast (Dessert) *1 - 215 ฿\nChocolate Ferrero Toast (Dessert) *1 - 250 ฿\n', 710.00, 'Pending', '2025-06-17 16:53:47', '20'),
(117, 'PukNv', 'Tuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nFour Cheeses Pizza (Food) *1 - 260 ฿\n', 750.00, 'Pending', '2025-06-18 13:26:57', '3'),
(118, 'admin', 'Cheeses Toast (Dessert) *1 - 215 ฿\nCaramel Popcorn Toast (Dessert) *1 - 245 ฿\nHawaiian Kurobuta Burger (Food) *1 - 295 ฿\n', 755.00, 'Completed', '2025-06-18 13:27:23', '32'),
(119, 'admin', 'Hawaiian Kurobuta Burger (Food) *1 - 295 ฿\nCaramel Popcorn Toast (Dessert) *1 - 245 ฿\nCheeses Toast (Dessert) *1 - 215 ฿\n', 755.00, 'Accepted', '2025-06-18 13:29:22', '33'),
(120, 'admin', 'Tuna & Mushroom Pesto Spagehtti (Food) *1 - 195 ฿\nSmoked Salmon Spaghetti (Food) *1 - 295 ฿\nGrilled Chicken Breast Steak (Food) *1 - 295 ฿\nGrilled Salmon Fillets Steak (Food) *1 - 495 ฿\nRib-Eye Steak (Food) *1 - 495 ฿\n', 1775.00, 'Completed', '2025-06-18 16:03:58', '30'),
(121, 'PukNv', 'Hawaiian Kurobuta Burger (Food) *1 - 295 ฿\nBacon & Chicken Burger (Food) *1 - 265 ฿\nPuppy (Dessert) *2 - 370 ฿\nMini Black Cat (Dessert) *2 - 450 ฿\n', 1380.00, 'Completed', '2025-06-18 16:04:47', ''),
(122, 'PukNv', 'H Late (Drink) *1 - 95 ฿\nPassion Fruit Soda (Drink) *1 - 105 ฿\nParadise Yusu (Drink) *1 - 145 ฿\nStrawberry Smoothie (Drink) *1 - 120 ฿\nApple Smoothie (Drink) *1 - 145 ฿\n', 610.00, 'Completed', '2025-06-18 16:07:00', ''),
(124, 'potato015', 'Bacon & Chicken Burger (Food) *1 - 265 ฿\nHawaiian Kurobuta Burger (Food) *1 - 295 ฿\n', 560.00, 'Completed', '2025-06-19 15:08:05', ''),
(125, 'potato015', 'Four Cheeses Pizza (Food) *1 - 260 ฿\n', 260.00, 'Accepted', '2025-06-19 15:28:58', ''),
(126, 'potato015', 'Bacon & Chicken Burger (Food) *1 - 265 ฿\n', 265.00, 'Cancelled', '2025-06-19 15:29:31', ''),
(127, 'potato015', 'Smoked Salmon Spaghetti (Food) *1 - 295 ฿\nBacon & Chicken Burger (Food) *1 - 265 ฿\n', 560.00, 'Cancelled', '2025-06-19 15:34:15', ''),
(128, 'potato015', 'Cafe Latte Frappe (Drink) *1 - 120 ฿\n', 120.00, 'Accepted', '2025-06-20 14:24:50', ''),
(129, 'potato015', 'H Mocha (Drink) *1 - 110 ฿\nH Cappuccino (Drink) *1 - 95 ฿\n', 205.00, 'Pending', '2025-06-20 14:32:21', ''),
(130, 'potato015', 'Iced Cappuccino (Drink) *1 - 100 ฿\n', 100.00, 'Accepted', '2025-06-20 14:40:19', ''),
(131, 'potato015', 'H Chocolate Mellow (Drink) *1 - 95 ฿\n', 95.00, 'Completed', '2025-06-20 14:48:03', ''),
(132, 'potato015', 'Smoked Salmon Spaghetti (Food) *1 - 295 ฿\nH Cappuccino (Drink) *1 - 95 ฿\n', 390.00, 'Completed', '2025-06-20 15:07:38', ''),
(133, 'potato015', 'Smoked Salmon Spaghetti (Food) *1 - 295 ฿\n', 295.00, 'Pending', '2025-06-23 12:32:04', ''),
(134, 'potato015', 'Four Cheeses Pizza (Food) *1 [kuy] - 260 ฿\nMini Black Cat (Dessert) *1 [here] - 225 ฿\n', 485.00, 'Completed', '2025-06-23 12:32:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_cm`
--

CREATE TABLE `table_cm` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phonenum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `seats` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(255) DEFAULT 'กำลังรอดำเนินการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `table_cm`
--

INSERT INTO `table_cm` (`id`, `username`, `phonenum`, `seats`, `date`, `time`, `status`) VALUES
(13, 'potato015', '096 810 8480', '4', '2025-05-28', '16:00 PM -18:00 PM', 'กำลังรอดำเนินการ'),
(15, 'potato015', '096 810 8480', '8+', '2025-05-30', '19:00 PM -21:00 PM', 'กำลังรอดำเนินการ'),
(16, 'potato015', '096 810 8480', '4', '2025-06-12', '6:00 AM - 11:00 AM', 'กำลังรอดำเนินการ'),
(17, 'PeterGriffin', '999 999 9999', '4', '2025-06-12', '12:00 PM - 3:00 PM', 'กำลังรอดำเนินการ'),
(18, 'PeterGriffin', '999 999 9999', '8+', '2025-06-27', '10:00 AM - 11:00 AM', 'กำลังรอดำเนินการ'),
(19, 'BabaYaga', '999 999 9999', '8+', '2025-06-27', '7:00 PM - 9:00 PM', 'กำลังรอดำเนินการ'),
(20, 'BabaYaga', '999 999 9999', '4-8', '2025-06-16', '12:00 PM - 3:00 PM', 'กำลังรอดำเนินการ'),
(21, 'BabaYaga', '999 999 9999', '4', '2025-06-21', '4:00 PM - 6:00 PM', 'กำลังรอดำเนินการ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cm`
--
ALTER TABLE `admin_cm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_cm`
--
ALTER TABLE `event_cm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_cm`
--
ALTER TABLE `member_cm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_cm`
--
ALTER TABLE `menu_cm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_cm`
--
ALTER TABLE `table_cm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_cm`
--
ALTER TABLE `event_cm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member_cm`
--
ALTER TABLE `member_cm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu_cm`
--
ALTER TABLE `menu_cm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `table_cm`
--
ALTER TABLE `table_cm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
