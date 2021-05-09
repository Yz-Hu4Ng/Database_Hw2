-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2021 at 04:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maskshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clerk`
--

CREATE TABLE `Clerk` (
  `clerk_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Manager`
--

CREATE TABLE `Manager` (
  `manager_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `order_id` varchar(100) NOT NULL,
  `order_create_time` varchar(100) NOT NULL,
  `order_finish_time` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Shop`
--

CREATE TABLE `Shop` (
  `shop_id` varchar(100) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `mask_count` varchar(100) NOT NULL,
  `mask_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `user_name`, `salt`, `password`, `phone`) VALUES
('19879210475', 'you', '8664', '934b535800b1cba8f96a5d72f72f1611', '123456789'),
('33840950938', 'hank', '9678', '8925d97efe9178c5ea838c971bb560d0f5145ae470fdf3da12abba0304d27ffa', '098814'),
('50435935895', 'hankie', '0000', 'b59c67bf196a4758191e42f76670ceba', '0987654321'),
('68911922826', 'yuui', '4039', '318aee3fed8c9d040d35a7fc1fa776fb31303833aa2de885354ddf3d44d8fb69', '1234465786'),
('82986639538', 'iu', '9260', '7fb693f108ac15154acc1b7cc9cf9f0939b3b8ec8951f08a74e9c06b670ef27d', '234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clerk`
--
ALTER TABLE `Clerk`
  ADD PRIMARY KEY (`clerk_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Manager`
--
ALTER TABLE `Manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `Shop`
--
ALTER TABLE `Shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Clerk`
--
ALTER TABLE `Clerk`
  ADD CONSTRAINT `Clerk_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `Shop` (`shop_id`),
  ADD CONSTRAINT `Clerk_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);

--
-- Constraints for table `Manager`
--
ALTER TABLE `Manager`
  ADD CONSTRAINT `Manager_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`),
  ADD CONSTRAINT `Manager_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `Shop` (`shop_id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `Shop` (`shop_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
