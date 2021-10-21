-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 06:45 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cts_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangay_list`
--

CREATE TABLE `barangay_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `city_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangay_list`
--

INSERT INTO `barangay_list` (`id`, `code`, `name`, `description`, `city_id`) VALUES
(1, '23', 'Mambulac', 'Sample', 3);

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `state_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `code`, `name`, `description`, `state_id`) VALUES
(1, '01', 'Bacolod', '6100', 4),
(2, '02', 'Talisay', '6115', 4),
(3, '03', 'Silay', '6116', 4),
(5, '07', 'Iloilo', '12345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `establishment`
--

CREATE TABLE `establishment` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city_id` int(30) DEFAULT NULL,
  `zone_id` int(30) DEFAULT NULL,
  `image_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `establishment`
--

INSERT INTO `establishment` (`id`, `code`, `name`, `address`, `city_id`, `zone_id`, `image_path`) VALUES
(1, '01032386416334554', 'Sample Mall', 'Sample Address', 3, 1, 'uploads/1614299580_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `email` text DEFAULT NULL,
  `firstname` text DEFAULT NULL,
  `lastname` text DEFAULT NULL,
  `middlename` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `city_id` int(30) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `image_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `code`, `email`, `firstname`, `lastname`, `middlename`, `address`, `zone_id`, `city_id`, `contact`, `image_path`) VALUES
(2, '0103236915284361', 'mwilliams@sample.com', 'Mike', 'Williams', 'D', 'Sample Address', 1, 3, '09125265498', 'uploads/1614241320_ava.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `code`, `name`, `description`) VALUES
(1, '06', 'Iloilo', 'Region 6'),
(4, '01', 'Negros Occidental', 'Region 6');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Covid Tacking System - QR Code'),
(2, 'address', 'Philippines'),
(3, 'contact', '+1234567890'),
(4, 'email', 'info@sample.com'),
(5, 'fb_page', 'https://www.facebook.com/myPageName'),
(6, 'short_name', 'CTS-QR'),
(9, 'logo', 'uploads/1614224160_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(30) NOT NULL,
  `person_id` int(30) NOT NULL,
  `establishment_id` int(30) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `person_id`, `establishment_id`, `date_added`) VALUES
(1, 2, 1, '2021-02-26 11:21:15'),
(2, 2, 1, '2021-02-26 11:22:17'),
(3, 2, 1, '2021-02-26 11:24:43'),
(4, 2, 1, '2021-02-26 11:25:03'),
(5, 2, 1, '2021-02-26 11:26:41'),
(6, 2, 1, '2021-02-26 11:30:36'),
(7, 2, 1, '2021-02-26 11:32:17'),
(8, 2, 1, '2021-02-26 11:32:56'),
(9, 2, 1, '2021-02-26 11:37:09'),
(10, 2, 1, '2021-02-26 13:42:16'),
(11, 2, 1, '2021-02-26 13:42:49'),
(12, 2, 1, '2021-02-26 13:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1614302940_avatar.jpg', NULL, '2021-01-20 14:02:37', '2021-02-26 10:23:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangay_list`
--
ALTER TABLE `barangay_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `establishment`
--
ALTER TABLE `establishment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangay_list`
--
ALTER TABLE `barangay_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `establishment`
--
ALTER TABLE `establishment`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
