-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 06:28 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `email`, `password`, `fullname`, `created_at`) VALUES
(30001, 'admin@test.com', 'admin123', 'admin test', '2023-06-01 20:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `name`, `description`, `created_at`) VALUES
(18, 'Casio', 'G-Shock, Baby G', '2023-12-02 00:13:55'),
(21, 'D1 Milano', '', '2023-12-02 00:21:27'),
(23, 'Adidas Originals', '', '2023-12-02 00:22:19'),
(25, 'Bonia', '', '2024-01-01 15:02:15'),
(26, 'Seiko', '', '2024-01-01 15:02:25'),
(27, 'Hummer', '', '2024-01-01 15:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `email`, `password`, `fullname`, `created_at`) VALUES
(3, 'amin@gmail.com', '123', 'Amin', '2023-06-03 15:52:13'),
(8, 'haikal@rocketmail.com', 'haikal123', 'Haikal Uzaharin', '2023-12-06 13:06:22'),
(9, 'aliffaiman@mail.com', '321', 'Aliff Aiman', '2023-12-19 12:35:06'),
(10, 'izzatkz@mail.com', '321', 'Izzat KZ', '2023-12-19 15:17:38'),
(12, 'umarzir@gmail.com', '12345', 'Umar Raziq', '2024-01-29 13:58:35'),
(13, 'wabbu@mail.com', '4321', 'Wabbu Ali', '2024-02-02 11:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `destination_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `location` varchar(191) NOT NULL,
  `address` text NOT NULL,
  `postcode` int(5) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`destination_id`, `cust_id`, `location`, `address`, `postcode`, `city`, `state`) VALUES
(21, 3, 'Office', '1016, Jalan Sultan Ismail', 50250, 'Kampung Baru', 'Kuala Lumpur'),
(24, 3, 'Friend House', 'No 51, Jalan Padang Tembak', 31231, 'Batu Pahat', 'Johor'),
(25, 3, 'Home', 'No 8, Jalan Mayang 3/6', 43200, 'Cheras', 'Selangor'),
(26, 10, 'Home', 'No 17, Jalan Inang 4/9', 43200, 'Cheras', 'Selangor'),
(27, 8, 'Rumah', 'No 51, Jalan Padang Tembak, Belah Fatimah', 32200, 'Batu Pahat', 'Johor'),
(28, 9, 'Hostel', '111, Jalan Raja Abdullah', 50300, 'Kampung Baru', 'Kuala Lumpur'),
(29, 8, 'Office', '23, Jalan Samudra Batangan', 12231, 'Muar', 'Johor'),
(30, 10, 'Rumah Sewa', 'No 41, Lorong Pijah Waksi', 54100, 'Klang', 'Selangor'),
(31, 8, 'awdaw', 'awda', 3211, 'Kampung Baru', 'Kuala Lumpur'),
(32, 12, 'Home', 'No 41, Lorong Parit', 50000, 'Kampung Baru', 'Kuala Lumpur'),
(33, 13, 'home', 'No 51, Jalan Padang', 31231, 'Batu Pahat', 'Johor');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Payment Completed','Packing','Preparing To Ship','Picked Up By Courier','Delivered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Payment Completed',
  `tracking` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destination_id` int(11) NOT NULL,
  `payment_option` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `grand_total`, `created_at`, `status`, `tracking`, `destination_id`, `payment_option`) VALUES
(3, 8, 720.00, '2023-12-06 13:08:44', 'Preparing To Ship', '', 27, 'Online Banking'),
(4, 9, 531.00, '2023-12-19 12:42:32', 'Payment Completed', NULL, 28, 'Credit/Debit Card'),
(5, 9, 625.00, '2023-12-19 15:11:05', 'Preparing To Ship', 'wwasd122', 28, 'Cash On Delivery'),
(6, 10, 510.00, '2023-12-19 15:28:36', 'Picked Up By Courier', 'Shopee12312', 26, 'Credit/Debit Card'),
(7, 10, 500.00, '2023-12-19 15:31:05', 'Picked Up By Courier', 'Laz23142', 26, 'Online Banking'),
(8, 3, 510.00, '2024-01-09 12:56:54', 'Payment Completed', NULL, 25, 'Cash On Delivery'),
(9, 8, 1000.00, '2024-01-11 12:57:22', 'Payment Completed', NULL, 27, 'Credit/Debit Card'),
(10, 8, 615.00, '2024-01-11 22:05:26', 'Payment Completed', NULL, 29, 'Online Banking'),
(11, 8, 625.00, '2024-01-11 23:21:32', 'Payment Completed', NULL, 29, 'Credit/Debit Card'),
(12, 3, 615.00, '2024-01-13 16:35:29', 'Delivered', NULL, 24, 'Credit/Debit Card'),
(13, 3, 932.00, '2024-01-14 19:10:53', 'Preparing To Ship', NULL, 25, 'Credit/Debit Card'),
(14, 3, 483.00, '2024-01-14 19:13:20', 'Packing', NULL, 24, 'Credit/Debit Card'),
(15, 3, 1062.00, '2024-01-17 07:47:32', 'Payment Completed', NULL, 24, 'Credit/Debit Card'),
(18, 10, 625.00, '2024-01-17 08:53:45', 'Payment Completed', NULL, 26, 'Credit/Debit Card'),
(19, 8, 3560.00, '2024-01-18 11:31:47', 'Payment Completed', NULL, 29, 'Credit/Debit Card'),
(22, 3, 360.00, '2024-01-19 21:42:28', 'Payment Completed', NULL, 24, 'Credit/Debit Card'),
(23, 3, 339.00, '2024-01-19 22:11:25', 'Payment Completed', NULL, 24, 'Online Banking'),
(24, 3, 468.00, '2024-01-29 11:33:26', 'Payment Completed', NULL, 21, 'Cash On Delivery'),
(25, 12, 510.00, '2024-01-29 14:03:08', 'Payment Completed', NULL, 32, 'Credit/Debit Card'),
(26, 3, 615.00, '2024-01-29 14:13:17', 'Payment Completed', NULL, 24, 'Cash On Delivery'),
(28, 3, 678.00, '2024-02-01 13:23:14', 'Payment Completed', NULL, 24, 'Credit/Debit Card'),
(29, 3, 1683.00, '2024-02-01 13:33:19', 'Payment Completed', NULL, 24, 'Credit/Debit Card'),
(30, 8, 2232.00, '2024-02-01 19:21:51', 'Payment Completed', NULL, 27, 'Credit/Debit Card'),
(31, 8, 1446.00, '2024-02-01 23:49:05', 'Payment Completed', NULL, 29, 'Online Banking'),
(32, 8, 625.00, '2024-02-02 00:00:42', 'Payment Completed', NULL, 29, 'Credit/Debit Card'),
(33, 8, 453.00, '2024-02-02 00:21:19', 'Payment Completed', NULL, 29, 'Online Banking'),
(34, 13, 1994.00, '2024-02-02 11:25:57', 'Payment Completed', NULL, 33, 'Credit/Debit Card');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`) VALUES
(3, 22, 2),
(4, 15, 1),
(5, 17, 1),
(6, 19, 1),
(7, 20, 1),
(8, 19, 1),
(9, 20, 2),
(10, 16, 1),
(11, 17, 1),
(12, 16, 1),
(13, 31, 1),
(14, 32, 1),
(15, 15, 2),
(15, 18, 1),
(15, 30, 2),
(18, 17, 1),
(19, 15, 1),
(19, 28, 4),
(22, 22, 1),
(23, 18, 1),
(24, 27, 1),
(25, 19, 1),
(26, 16, 1),
(26, 28, 1),
(28, 18, 2),
(29, 16, 2),
(29, 23, 1),
(30, 16, 1),
(30, 33, 3),
(31, 19, 1),
(31, 27, 2),
(32, 17, 1),
(33, 23, 1),
(34, 15, 2),
(34, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `gender` enum('Men','Women') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `brand_id`, `name`, `description`, `price`, `image`, `created_at`, `gender`) VALUES
(15, 18, 'G-Shock Yellow', 'Made of carbon fiber-reinforced fine resin for a thinner, lighter watchcase that is as tough as ever. The simple design and rugged construction feature a black dial for a cool, polished look.', '531.00', '1701449415.png', '2023-12-02 00:19:22', 'Men'),
(16, 21, 'Polychrono Orange', 'The Polychrono combines the funny and irreverent identity of the Polycarbon with a quartz movement and fly-back function. Pop, fresh and witty. Spark the moment with this new iconic timepiece.', '615.00', '1706509307.png', '2023-12-02 00:25:00', 'Men'),
(17, 21, 'Carbonlite Sage', 'The Carbon Nylon: our first circular case shape. Monochromatism, innovative materials, and contrasting details are the common denominators of this transformation. REVOLUTION 2.0 Composite materials derived from Carbon Nylon and Fibre specifically engineered by D1 Milano.', '625.00', '1701448107.png', '2023-12-02 00:28:27', 'Men'),
(18, 18, 'G-Shock Black', 'This all-black classic matte model is just the thing to celebrate G-SHOCK\'s 35-year quest for ultimate toughness. The base model is this year\'s revival model, the DW-5900. This amazingly versatile neoclassic model is the perfect choice for street fashions, mode fashions, sports, and just about any other style imaginable.', '339.00', '1701450107.png', '2023-12-02 01:01:47', 'Men'),
(19, 21, 'Polycarbon Pink', 'The timeless design of the polycarbon merged with the world of street fashion in a combination of design and color. STREET AND YOUNG DETAILS A pop fuchsia color, inspired by the trendiest summer palettes, is combined with contrasting graphic details in a tone of lime green to give the watch a young and fresh look.', '510.00', '1701450661.png', '2023-12-02 01:11:01', 'Women'),
(20, 23, 'City Tech One', 'This adidas Originals watch mixes high resistance, strong character and cutting-edge functions. The City Tech One ana-digit watch is made for those who want to have the best that a watch can offer. Perfectly suited for an adventurous life, it features a shock-resistant resin case and a resin strap with a pin buckle for a snug fit.', '500.00', '1701451002.png', '2023-12-02 01:16:42', 'Men'),
(22, 23, 'Digital One GMT', 'Utilitarian design for the urban traveller that keeps on time anywhere in the world. The shock-resistant case of this adidas Originals Digital One GMT watch easily adapts to the lifestyle of the modern explorer, while World Time technology provides the time zone in 85 key cities around the world.', '360.00', '1701451156.png', '2023-12-02 01:19:16', 'Men'),
(23, 23, 'Digital Two', 'Adidas Originals DIGITAL TWO AOST22077 is an incredibly attractive Ladies watch. Case is made out of Stainless Steel while the dial colour is Black. The watch is shipped with an original box and a guarantee from the manufacturer.', '453.00', '1704100929.png', '2024-01-01 17:22:09', 'Men'),
(24, 25, 'Snow Flakes', 'Edgy enough to be cool but classic enough to be used every day is a stylish calling for this latest Bonia collection. The design of the collection is kept classic and elegant that you can\'t peel your eyes from it.', '438.00', '1705160632.png', '2024-01-13 23:43:52', 'Women'),
(26, 25, 'Rose Cristallo', 'An exquisite arm candy made for dressier occasions. Embellished with Sapphire crystals all over, the Zaffiro features the House\'s signature monogram print on its dial. Available in three opulent colours: Rose Gold, Sterling Silver, and Gold.', '470.00', '1705160825.png', '2024-01-13 23:47:05', 'Women'),
(27, 27, 'Earth Multi', 'Rugged yet sophisticated, HUMMER watches that are inspired by adventure, elegance, and power, a style that says \"I can go anywhere and do what I want”. Hummer watches are powered by a reliable and accurate Japanese quartz movement. The robust mineral glass crystal is standard throughout the collections.', '468.00', '1705160941.png', '2024-01-13 23:49:01', 'Men'),
(28, 27, 'Lux Automatic', '\"Command the Road\" Introducing the Hummer-Lux Limited Edition watch - the ultimate statement piece for bold and daring individuals. This automatic timepiece takes inspiration from the heavy-duty vehicle rims and boasts a prominent design that will turn heads wherever you go.', '890.00', '1705161046.png', '2024-01-13 23:50:46', 'Men'),
(29, 27, 'Silver Multi', 'Rugged yet sophisticated, HUMMER watches that are inspired by adventure, elegance, and power, a style that says \"I can go anywhere and do what I want”. The robust mineral glass crystal is standard throughout the collections. The cases are made using solid stainless steel and the watches are able to withstand water resistant up to 50 meters.', '594.00', '1705161119.png', '2024-01-13 23:51:59', 'Men'),
(30, 26, 'Street Fighter', 'Seiko 5 Sports proudly announces a collection designed in collaboration with Street Fighter V, a world-famous Player VS Player fighting game. The collection features six models inspired by the game\'s central characters well-liked throughout the series. This model represents the philosophy of Blanka, his distinctive style is depicted using a rugged design and a consistently green hue.', '1250.00', '1705161345.png', '2024-01-13 23:55:45', 'Men'),
(31, 26, 'Lukia Automatic', 'A ladies watch that brings a sparkle everyday, for women who want to show their individuality in their professional and personal life.', '932.00', '1705161429.png', '2024-01-13 23:57:09', 'Women'),
(32, 25, 'Scarlet Love', 'The two tones sunray dial sparks beautifully symbolizing a bright future of your relationship. This elegant women watch with 2 heart shapes at 6-H express your affection and love.', '483.00', '1705222701.png', '2024-01-14 16:58:21', 'Women'),
(33, 21, 'Thin Abiso', 'Enjoy this unique Ultra Thin 38mm, only 6.48mm thickness and featuring stainless steel bracelet, is something you don\'t want to take away. Silver/Rose Gold PVD case and bracelet paired with a matte black dial.', '539.00', '1706509274.png', '2024-01-29 14:21:14', 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `product_id`, `cust_id`, `rating`, `review`, `created_at`) VALUES
(19, 17, 3, 5, 'Good feels in hand. Suitable for everyday use', '2024-01-14 19:21:34'),
(21, 19, 3, 4, 'Too bright to my liking', '2024-01-14 19:22:33'),
(22, 31, 3, 5, 'Bought this for my wife for our 3rd year anniversary💞, she loves it.', '2024-01-14 19:23:36'),
(23, 32, 3, 4, 'Straps a little too small', '2024-01-14 19:24:04'),
(24, 17, 8, 5, 'Saya sukakan jam ini', '2024-01-14 19:25:20'),
(25, 16, 8, 5, '', '2024-01-14 19:25:36'),
(26, 20, 8, 5, 'Best kalau bawak bersukan', '2024-01-14 19:26:02'),
(27, 22, 8, 3, 'Colour a little too boring to me', '2024-01-14 19:27:08'),
(28, 17, 9, 4, 'Kurang gemar', '2024-01-14 19:28:18'),
(29, 15, 9, 5, '💞💞💞💞💞', '2024-01-14 19:28:46'),
(30, 19, 10, 5, 'Love it', '2024-01-14 19:46:25'),
(32, 19, 12, 5, 'i love the pink feel', '2024-01-29 14:09:49'),
(34, 15, 3, 3, 'Best\r\n', '2024-02-01 14:00:07'),
(35, 18, 3, 5, 'Added to my g-shock collection', '2024-02-01 14:02:15'),
(36, 23, 3, 4, 'Best', '2024-02-01 14:04:18'),
(37, 16, 3, 4, 'Sukanya\r\n', '2024-02-01 15:11:22'),
(38, 31, 13, 4, 'Bought for my madam', '2024-02-02 11:30:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`destination_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `fk_destination_id` (`destination_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30007;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destination`
--
ALTER TABLE `destination`
  ADD CONSTRAINT `destination_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_destination_id` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`destination_id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
