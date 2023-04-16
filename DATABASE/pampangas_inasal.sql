-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 12:14 PM
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
-- Database: `pampangas_inasal`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_description` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `location` varchar(500) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `branch_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_description`, `contact_number`, `location`, `city`, `province`, `postal_code`, `branch_status`) VALUES
(1, 'Main Branch', '09123456789', 'Sample1', 'Lucena City', 'Quezon Province', '1234', 1),
(3, 'Lucena Branch', '09123456789', 'Brgy. Gulang-Gulang', 'Lucena City', 'Quezon Province', '4301', 1),
(4, 'Sariaya Branch', '09123456789', 'Sample 1', 'Lucena City', 'Quezon Province', '4301', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch_status`
--

CREATE TABLE `branch_status` (
  `status_id` int(11) NOT NULL,
  `status_description` varchar(100) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch_status`
--

INSERT INTO `branch_status` (`status_id`, `status_description`, `remarks`) VALUES
(1, 'Open', '...'),
(2, 'Closed', '...');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_description`, `remarks`) VALUES
(1, 'Unli Rice', '...'),
(2, 'Rice Meal', '...'),
(3, 'Ala Carte', ''),
(4, 'Party Bilao', ''),
(5, '1.5 Drinks', ''),
(6, 'Mismo Drinks', ''),
(7, 'Grilled Liempo', ''),
(8, 'Grilled BBQ', ''),
(9, 'Pork Sisig', ''),
(10, 'King Size Hotdog', ''),
(11, 'Dessert', '...'),
(12, 'Drinks', '');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `type` enum('Electric','Water','Rent','Payroll','Miscellaneous') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `branch_id`, `type`, `amount`, `date`, `remarks`) VALUES
(1, 3, 'Payroll', '1000.00', '2023-04-13 18:34:04', 'No remarks here!'),
(3, 3, 'Rent', '2131.00', '2023-04-13 23:39:40', '21raw'),
(4, 1, 'Rent', '1000.00', '2023-04-15 19:52:33', '...'),
(5, 4, 'Water', '1000.00', '2023-04-16 12:03:29', '...');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category_id`, `price`) VALUES
(1, 'Leg and Thigh', 1, '135.00'),
(2, 'Breast and Wings', 1, '135.00'),
(4, 'Leg and Thigh', 2, '125.00'),
(5, 'Breast and Wings', 2, '125.00'),
(6, 'Leg and Thigh', 3, '105.00'),
(7, 'Breast and Wings', 3, '105.00'),
(8, '5 Legs 5 Wings', 4, '1020.00'),
(9, 'Coke', 5, '90.00'),
(10, 'Mountain Dew', 5, '90.00'),
(11, 'Royal', 5, '90.00'),
(12, 'Sprite', 5, '90.00'),
(13, 'Coke', 6, '20.00'),
(14, 'Mountain Dew', 6, '20.00'),
(15, 'Royal', 6, '20.00'),
(16, 'Sprite', 6, '20.00'),
(17, 'C2', 12, '35.00'),
(18, 'Pineapple', 12, '40.00'),
(19, 'Mineral Water', 12, '20.00'),
(20, 'Banana con Yelo', 11, '79.00'),
(21, 'Mais con Yelo', 11, '59.00'),
(22, 'Halo Halo', 11, '89.00'),
(23, 'Leche Flan Whole', 11, '150.00'),
(24, 'Leche Flan Solo', 11, '80.00'),
(25, 'Unli Rice Liempo', 7, '139.00'),
(26, 'Rice Meal Liempo', 7, '129.00'),
(27, 'Ala Carte Liempo', 7, '120.00'),
(28, 'Unli Rice BBQ', 8, '125.00'),
(29, 'Rice Meal BBQ', 8, '115.00'),
(30, 'BBQ on Stick', 8, '50.00'),
(31, 'Rice Meal Sisig', 9, '130.00'),
(32, 'Sisig Only', 9, '150.00'),
(33, 'Rice Meal Hotdog', 10, '60.00'),
(34, 'Hotdog on Stick', 10, '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `invoice_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal_amount` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`invoice_id`, `invoice_number`, `invoice_date`, `product_id`, `category_id`, `quantity`, `price`, `subtotal_amount`, `discount`, `user_id`, `branch_id`) VALUES
(1, 'INV-20230413211647-2352', '2023-04-13 00:00:00', 7, 3, 2, '105.00', '210.00', 0, 14, 1),
(2, 'INV-20230413211647-2352', '2023-04-13 00:00:00', 15, 6, 2, '20.00', '40.00', 0, 14, 1),
(3, 'INV-20230413211917-9072', '2023-04-13 00:00:00', 5, 2, 1, '125.00', '125.00', 0, 14, 1),
(4, 'INV-20230413213109-2107', '2023-04-13 00:00:00', 8, 4, 2, '1020.00', '2040.00', 0, 14, 1),
(5, 'INV-20230413213109-2107', '2023-04-13 00:00:00', 19, 12, 2, '20.00', '40.00', 0, 14, 1),
(8, 'INV-20230413213939-9159', '2023-04-13 00:00:00', 26, 7, 2, '129.00', '258.00', 0, 14, 1),
(9, 'INV-20230413214132-4034', '2023-04-13 00:00:00', 8, 4, 1, '1020.00', '1020.00', 0, 14, 1),
(10, 'INV-20230413214415-3506', '2023-04-13 00:00:00', 7, 3, 1, '105.00', '105.00', 0, 14, 1),
(11, 'INV-20230413214632-5924', '2023-04-13 00:00:00', 33, 10, 1, '60.00', '60.00', 0, 14, 1),
(12, 'INV-20230413214741-7140', '2023-03-16 00:00:00', 26, 7, 1, '129.00', '129.00', 0, 14, 1),
(13, 'INV-20230413214759-7054', '2023-04-13 00:00:00', 19, 12, 2, '20.00', '40.00', 0, 14, 1),
(14, 'INV-20230413223525-7277', '2023-04-13 00:00:00', 11, 5, 2, '90.00', '180.00', 0, 14, 1),
(15, 'INV-20230414050748-9065', '2023-04-14 00:00:00', 15, 6, 2, '20.00', '40.00', 0, 29, 3),
(16, 'INV-20230414050748-9065', '2023-04-14 00:00:00', 6, 3, 1, '105.00', '105.00', 0, 29, 3),
(17, 'INV-20230414052931-8430', '2023-04-14 00:00:00', 8, 4, 2, '1020.00', '2040.00', 0, 29, 3),
(18, 'INV-20230414052931-8430', '2023-04-14 00:00:00', 11, 5, 4, '90.00', '0.00', 0, 29, 3),
(19, 'INV-20230414052931-8430', '2023-04-14 00:00:00', 22, 11, 10, '89.00', '890.00', 0, 29, 3),
(20, 'INV-20230414054333-4565', '2023-04-14 00:00:00', 29, 8, 2, '115.00', '230.00', 0, 14, 1),
(21, 'INV-20230414054333-4565', '2023-04-14 00:00:00', 2, 1, 2, '135.00', '270.00', 0, 14, 1),
(22, 'INV-20230414054333-4565', '2023-04-14 00:00:00', 10, 5, 1, '90.00', '90.00', 0, 14, 1),
(23, 'INV-20230414054333-4565', '2023-04-14 00:00:00', 23, 11, 1, '150.00', '150.00', 0, 14, 1),
(24, 'INV-20230415194349-1182', '2023-04-15 00:00:00', 10, 5, 3, '90.00', '270.00', 0, 14, 1),
(25, 'INV-20230416091150-2453', '2023-03-16 00:00:00', 7, 3, 2, '105.00', '210.00', 0, 31, 3),
(26, 'INV-20230416091150-2453', '2023-03-16 00:00:00', 26, 7, 2, '129.00', '258.00', 0, 31, 3),
(27, 'INV-20230416091150-2453', '2023-03-16 00:00:00', 8, 4, 1, '1020.00', '1020.00', 0, 31, 3),
(28, 'INV-20230416091150-2453', '2023-03-16 00:00:00', 23, 11, 2, '150.00', '300.00', 0, 31, 3),
(29, 'INV-20230416091150-2453', '2023-04-16 00:00:00', 10, 5, 1, '90.00', '90.00', 0, 31, 3),
(30, 'INV-20230416102949-5868', '2023-05-18 00:00:00', 30, 8, 8, '50.00', '400.00', 0, 31, 3),
(31, 'INV-20230416103031-3844', '2023-05-21 00:00:00', 8, 4, 3, '1020.00', '3060.00', 0, 14, 1),
(32, 'INV-20230416103106-9703', '2023-06-19 00:00:00', 33, 10, 5, '60.00', '300.00', 0, 14, 1),
(33, 'INV-20230416103106-9703', '2023-06-19 00:00:00', 5, 2, 5, '125.00', '625.00', 0, 14, 1),
(34, 'INV-20230416103233-5756', '2023-06-29 00:00:00', 8, 4, 7, '1020.00', '7140.00', 0, 31, 3),
(35, 'INV-20230416110550-9802', '2023-04-16 00:00:00', 26, 7, 3, '129.00', '387.00', 0, 34, 4),
(36, 'INV-20230416110632-2435', '2023-03-16 00:00:00', 31, 9, 6, '130.00', '780.00', 0, 34, 4),
(37, 'INV-20230416110632-2435', '2023-03-16 00:00:00', 14, 6, 6, '20.00', '120.00', 0, 34, 4),
(38, 'INV-20230416112038-6926', '2023-05-19 00:00:00', 8, 4, 2, '1020.00', '2040.00', 0, 33, 4),
(39, 'INV-20230416112057-7487', '2023-06-26 00:00:00', 34, 10, 4, '40.00', '160.00', 0, 33, 4),
(40, 'INV-20230416120231-1043', '2023-04-16 00:00:00', 8, 4, 4, '1020.00', '4080.00', 0, 31, 3),
(41, 'INV-20230416120231-1043', '2023-04-16 00:00:00', 10, 5, 2, '90.00', '180.00', 0, 31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_description` varchar(100) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_description`, `remarks`) VALUES
(1, 'Open', ''),
(2, 'Paid', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role` enum('superadmin','admin','cashier','accountant') NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `birthdate` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `first_name`, `middle_name`, `last_name`, `sex`, `birthdate`, `phone_number`, `street_address`, `barangay`, `city`, `province`, `country`, `zipcode`, `username`, `email`, `password`, `branch_id`) VALUES
(7, 'admin', 'Admin', 'A', 'Staff', 'male', '2023-03-01', '09123456789', 'Metro Gaisano-Pacific Mall Compound, ML Tagarao St.', '3', 'Lucena City', 'Quezon Province', 'Philippines', '4301', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(14, 'superadmin', 'Super', 'A', 'Admin', 'male', '2023-03-01', '09123456789', 'Metro Gaisano-Pacific Mall Compound, ML Tagarao St.', '3', 'Lucena City', 'Quezon Province', 'Philippines', '4301', 'superadmin', 'user@gmail.com', '17c4520f6cfd1ab53d8745e84681eb49', 1),
(26, 'accountant', 'Account', 'A', 'Staff', 'female', '2023-04-13', '09123456789', 'sample', 'sample', 'Lucena City', 'Quezon Province', 'sample', '1234', 'accountant', 'accountant@gmail.com', '56f97f482ef25e2f440df4a424e2ab1e', 1),
(31, 'cashier', 'Cashier', 'A', 'Staff', 'female', '2023-04-14', '09123456789', 'Manila', 'Sample', 'Lucena City', 'Quezon Province', 'Philippines', '1005', 'cashier', 'cashier@gmail.com', '6ac2470ed8ccf204fd5ff89b32a355cf', 3),
(32, 'admin', 'Lucena', 'A', 'Branch', 'male', '1998-11-21', '09123456789', 'Frank St.', 'Gulang-Gulang', 'Lucena City', 'Quezon Province', 'Philippines', '4301', 'lucenabranch', 'lucena.branch@gmail.com', '89e01e3f0fcf719d6ce37f22a08677d6', 3),
(33, 'admin', 'Sariaya', 'A', 'Admin', 'female', '2001-08-25', '09123456789', 'Habito St.', 'Isabang', 'Lucena City', 'Quezon Province', 'Philippines', '4301', 'sariayaadmin', 'sariaya.branch@gmail.com', '916dc1810f8bba8f111ca86b70817dde', 4),
(34, 'cashier', 'Sariaya', 'B', 'Cashier', 'male', '2000-12-12', '09123456789', 'Manila', 'Barangay 10', 'Lucena City', 'Quezon Province', 'Philippines', '1005', 'sariayacashier', 'sariaya.cashier@gmail.com', '916dc1810f8bba8f111ca86b70817dde', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `branch_status`
--
ALTER TABLE `branch_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch_status`
--
ALTER TABLE `branch_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
