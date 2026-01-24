-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2026 at 09:19 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$tY4oN2IebxNKhiL..D4eWO61wiV45HVQgO0DQ8Y7j/9HGh6RrwR.K', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int NOT NULL,
  `rateType` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `pickupDate` date NOT NULL,
  `dropoffDate` date NOT NULL,
  `totalPayment` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `car_id`, `rateType`, `name`, `email`, `phone`, `pickupDate`, `dropoffDate`, `totalPayment`) VALUES
(23, 1, 'hour', 'ram', 'ram@gmail.com', '2147483647', '2024-10-25', '2024-10-26', 3600.00),
(24, 1, 'hour', 'pranav', 'pranav2021@gmail.com', '9497228125', '2025-02-07', '2025-02-08', 3600.00);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` int NOT NULL AUTO_INCREMENT,
  `car_name` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `price_per_hour` int DEFAULT NULL,
  `price_per_day` int DEFAULT NULL,
  `price_per_month` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `brand`, `price_per_hour`, `price_per_day`, `price_per_month`, `image_url`) VALUES
(1, 'City', 'Honda', 150, 1200, 30000, 'images_2/city.png'),
(2, 'Creta', 'Hyundai', 180, 1400, 35000, 'images_2/Creta.png'),
(3, 'Dzire', 'Maruti', 120, 1000, 25000, 'images_2/Dzire.png'),
(4, 'Lamborghini', 'Lamborghini', 5000, 50000, 1200000, 'images_2/lamborghini.png'),
(5, 'Nano', 'Tata', 50, 400, 10000, 'images_2/nano.png'),
(6, 'Swift', 'Maruti', 130, 1100, 27000, 'images_2/swift.png'),
(7, 'Tata Nexon', 'Tata', 200, 1500, 40000, 'images_2/Tata_Nexon.png'),
(8, 'Wagnor', 'Maruti', 110, 900, 23000, 'images_2/wagnor.png'),
(9, 'XUV700', 'Mahindra', 220, 1700, 45000, 'images_2/xuv700.png');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `license_number`, `email`, `phone`) VALUES
(1, 'Ameen Ahammed', 'asdfgh', 'abu@anu.com', '1112223334'),
(2, 'Ameen Ahammed', 'asdfgh', 'abu@anu.com', '1112223334'),
(3, 'Ameen Ahammed', 'asdfgh', 'admin2000@ad.com', '1112223334'),
(4, 'Pranav R', '98765', 'pranavrajeev2021@gmail.com', '9497228125');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `rating` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`, `rating`, `date`) VALUES
(1, 'Pranav R', 'pranav2021@gmail.com', 'feedback', 'Good', 3, '2024-09-29 05:22:27'),
(2, 'Pranav R', 'pranav2021@gmail.com', 'feedback', 'Excellent', 1, '2024-09-29 05:34:12'),
(3, 'Vaishnav R', 'vaishnav@gmail.com', 'feedback', 'Hello,I am Vaishnav R.Please say a hai to me......', 3, '2024-10-11 19:52:23'),
(5, 'Pranav R', 'pranavrajeev2021@gmail.com', 'feedback', 'Hello', 3, '2024-10-24 16:24:54'),
(6, 'Pranav R', 'pranavrajeev2021@gmail.com', 'feedback', 'Hello', 3, '2024-10-24 16:25:00'),
(7, 'Pranav R', 'pranavrajeev2021@gmail.com', 'feedback', 'Hello', 3, '2024-10-24 17:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `accountName` varchar(100) NOT NULL,
  `accountNumber` varchar(50) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `ifscCode` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `accountName`, `accountNumber`, `bankName`, `ifscCode`, `username`) VALUES
(11, 'Ameen Ahammed', '7654376543', 'Federal Bank', 'SBIN0001236', 'Ameen@123'),
(12, 'R Pranav', '9876543210', 'SBI', 'SBIN0001234', 'ram'),
(13, 'R Pranav', '9876543210', 'SBI', 'SBIN0001234', 'ram'),
(14, 'R Pranav', '9876543210', 'SBI', 'SBIN0001234', 'ram'),
(15, 'R Pranav', '9876543210', 'SBI', 'SBIN0001234', 'pranav');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(260) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `confirmpassword` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`userid`, `name`, `username`, `phonenumber`, `email`, `password`, `confirmpassword`, `role`) VALUES
(14, 'Arjun', 'Arjun123', '2147483647', 'arjun@gmail.com', '$2y$10$oT/PtrAk3l7EhlRiKlLAZ.CvGMxx/HocuCnL5/VUqABSe9YZiHanC', '', 'user'),
(13, 'Arun', 'Arun123', '2147483647', 'arun@gmail.com', '$2y$10$t447/wkKk4Yzfyq3bmU6L.QX/ro1sYXsVwccR06INy.2sf5XLQNfy', '', 'user'),
(11, 'Pranav', 'Pranav123', '2147483647', 'pranav2326@gmail.com', '$2y$10$v7Snw.GzuLOdgvRHt3mI5esG05veokNK6vzTumOscaNmh2634lWfy', '', 'user'),
(16, 'Arundathi', 'Arundathi@123', '9497228125', 'arundathi2021@gmail.com', '$2y$10$Qhi4nButqLV2YvQTJf683.PxEm7X85hsE28oa9ZU9aiHmxF21cJ2a', '', 'user'),
(9, 'ram', 'ram', '2147483647', 'ram@gmail.com', '$2y$10$zgrwUE8MlSMAJeF/ftIQOu0L6lYts2wfXIWWkCLLPZIOK0I90VTyy', '', 'user'),
(10, 'test', 'test@123', '2147483647', 'test@gmail.com', '$2y$10$LF4VPSqQ2MKckvlYHTVLrOBxY8TLmy6hdVglnP5aIhDOw6/jzfnkK', '', 'user'),
(15, 'Nikhil', 'nikhil123', '9497228125', 'nikhil@gmail.com', '$2y$10$xASPnzPIYegUgBm2IKr7BOweOavdtSVdGwHYsG3EqOZ7VHQfwsb5a', '', 'user'),
(17, 'Testing', 'test_123', '9497228125', 'test1@gmail.com', '$2y$10$bEYbG5XReVmVPTcB5QRQ9Or/PgYzpJjQQiCwPd7U5CT0kvPbAS4W2', '', 'user'),
(18, 'test1', 'test1_123', '9497228125', 'testing@gmail.com', '$2y$10$9V8eBB.ANRLtt52bi72.cu9qM1UELMex6vQhCFN4E6E23F/ywpLS6', '', 'user'),
(19, 'Pranav R', 'pranav', '9497228125', 'pranav2021@gmail.com', '$2y$10$emWZmG23jb5P0zopU1Y9oOuEJX79xOlJZRwDIW2I9qukJbdVdvLMG', '', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrands`
--

DROP TABLE IF EXISTS `tblbrands`;
CREATE TABLE IF NOT EXISTS `tblbrands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `BrandName` varchar(120) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbrands`
--

INSERT INTO `tblbrands` (`id`, `BrandName`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Maruti', '2017-06-18 16:24:34', '2017-06-19 06:42:23'),
(2, 'BMW', '2017-06-18 16:24:50', NULL),
(3, 'Audi', '2017-06-18 16:25:03', NULL),
(4, 'Nissan', '2017-06-18 16:25:13', NULL),
(5, 'Toyota', '2017-06-18 16:25:24', NULL),
(8, 'Hyundai', '2020-11-25 17:57:09', NULL),
(9, 'Swift', '2024-08-28 22:28:51', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
