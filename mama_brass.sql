-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2017 at 10:23 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mama_brass`
--

-- --------------------------------------------------------

--
-- Table structure for table `ezl_account`
--

CREATE TABLE `ezl_account` (
  `account_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `description_type` enum('Sale','Pay','Return') NOT NULL,
  `amount` float NOT NULL,
  `account_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ezl_account`
--

INSERT INTO `ezl_account` (`account_id`, `customer_id`, `account_no`, `description_type`, `amount`, `account_date`, `created_on`, `user_id`) VALUES
(1, 1, 'R001', 'Sale', 1000, '2017-08-02', '2017-08-10 06:52:00', 1),
(2, 1, 'R0032', 'Pay', 500, '2017-08-06', '2017-08-10 06:52:46', 1),
(3, 1, 'R0036', 'Return', 200, '2017-08-10', '2017-08-10 06:53:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ezl_customer`
--

CREATE TABLE `ezl_customer` (
  `customer_id` int(11) NOT NULL,
  `company_name` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tel_no` varchar(30) NOT NULL,
  `mob_no` varchar(15) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ezl_customer`
--

INSERT INTO `ezl_customer` (`customer_id`, `company_name`, `address`, `tel_no`, `mob_no`, `contact_person`, `created_on`, `updated_on`, `user_id`) VALUES
(1, 'Ezeelive Technologies Pvt Ltd', '302, Datta Business Park, Evershine, Vasai East', '', '9822117730', 'Rajeev Sharma', '2017-08-09 23:44:11', '2017-08-09 23:47:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ezl_user`
--

CREATE TABLE `ezl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `title` enum('Mr.','Mrs.','Ms.','Dr.','Prof.') NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `profile_image` varchar(50) NOT NULL,
  `auth_key` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_parent` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ezl_user`
--

INSERT INTO `ezl_user` (`user_id`, `username`, `password`, `title`, `name`, `address`, `contact_no`, `email`, `status`, `profile_image`, `auth_key`, `created_at`, `updated_at`, `is_parent`) VALUES
(1, 'admin', '123456', 'Mr.', 'Rajeev Sharma', 'Evershine City Vasai East', '9822117730', 'rajeev@ezeelive.com', 1, 'photo.jpg', NULL, '2017-07-26 00:00:00', '2017-08-01 06:52:24', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ezl_account`
--
ALTER TABLE `ezl_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ezl_customer`
--
ALTER TABLE `ezl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `ezl_user`
--
ALTER TABLE `ezl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ezl_account`
--
ALTER TABLE `ezl_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ezl_customer`
--
ALTER TABLE `ezl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ezl_user`
--
ALTER TABLE `ezl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
