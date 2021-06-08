-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2021 at 08:44 AM
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

--
-- Dumping data for table `Clerk`
--

INSERT INTO `Clerk` (`clerk_id`, `user_id`, `shop_id`) VALUES
('33840950938', '33840950938', '13414121'),
('41035280604', '41035280604', '13414121'),
('52707503863', '52707503863', '13414121');

-- --------------------------------------------------------

--
-- Table structure for table `Manager`
--

CREATE TABLE `Manager` (
  `manager_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Manager`
--

INSERT INTO `Manager` (`manager_id`, `user_id`, `shop_id`) VALUES
('2871490', '41035280604', '53368425'),
('3728788', '71832848378', '13414121'),
('3780602', '52707503863', '9136931'),
('8671996', '87284863638', '47924473');

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
  `shop_id` varchar(100) NOT NULL,
  `order_num` varchar(100) NOT NULL,
  `order_price` varchar(100) NOT NULL,
  `order_finisher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`order_id`, `order_create_time`, `order_finish_time`, `order_status`, `user_id`, `shop_id`, `order_num`, `order_price`, `order_finisher`) VALUES
('2574678834', '2021-06-05 19:15:30', '2021-06-05 19:15:54', 'Cancelled', '87284863638', '9136931', '23', '100', 'newbie'),
('3459243986', '2021-06-05 19:15:17', '2021-06-05 19:15:42', 'Cancelled', '87284863638', '53368425', '22', '120', 'newbie'),
('401601605', '2021-06-05 19:45:22', '2021-06-05 19:45:39', 'Cancelled', '87284863638', '13414121', '41', '100', 'newbie'),
('4729347299', '2021-06-05 19:50:54', '2021-06-05 19:51:48', 'Cancelled', '87284863638', '13414121', '79', '100', 'newbie'),
('5410421578', '2021-06-05 19:47:54', '2021-06-05 19:48:11', 'Cancelled', '87284863638', '13414121', '23', '100', 'newbie'),
('6513081748', '2021-06-05 19:48:46', '2021-06-05 19:48:55', 'Cancelled', '87284863638', '13414121', '98', '100', 'newbie'),
('7769027117', '2021-06-05 19:27:14', '2021-06-05 19:44:33', 'Cancelled', '87284863638', '13414121', '34', '100', 'newbie'),
('893067018', '2021-06-05 19:16:14', '2021-06-05 19:42:57', 'Cancelled', '87284863638', '9136931', '66', '100', 'newbie');

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

--
-- Dumping data for table `Shop`
--

INSERT INTO `Shop` (`shop_id`, `shop_name`, `city`, `mask_count`, `mask_price`) VALUES
('13414121', 'yzshop', 'Taipei', '279', '100'),
('47924473', 'newbie\'sshop', 'Taipei', '2000', '35'),
('53368425', 'yz2shop', 'Taipei', '13745', '120'),
('9136931', 'yz3shop', 'Taipei', '9455', '100');

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
('41035280604', 'yz1', '2201', '0b88fd35c9a5c524c2972ffe3b8de81e9f069633e3c64a89daea75dd31b45439', '2'),
('50435935895', 'hankie', '0000', 'b59c67bf196a4758191e42f76670ceba', '0987654321'),
('52707503863', 'yz2', '6419', 'f33b306389fcf1fc5917ca95164c072ab25ccf484a72a12df58bccb42e9f3a0b', '1'),
('67046955920', 'nosty', '4268', '55bd9b94c3ac6b9a2c8d77c461fb513b81c84d0c16f6027cf929b9960da58d1c', '1233455'),
('68911922826', 'yuui', '4039', '318aee3fed8c9d040d35a7fc1fa776fb31303833aa2de885354ddf3d44d8fb69', '1234465786'),
('71832848378', 'yz', '9609', '36b71b96f89830d460ecb606adf12678a9dc7bebd283d3a96a9e55ac697f3e35', '1'),
('82986639538', 'iu', '9260', '7fb693f108ac15154acc1b7cc9cf9f0939b3b8ec8951f08a74e9c06b670ef27d', '234'),
('87284863638', 'newbie', '2899', 'fade916d799992c8c78a7618b14afb31cb84ea0bfd481d62766d00f8a0e34ab5', '098765772'),
('87453154867', 'signal2', '9454', 'ae4ed2e2fdce1568924b979ec0c0999c6374c6c50856cc978344817b31c72fec', '0234897611');

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
