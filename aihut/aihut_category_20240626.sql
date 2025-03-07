-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 07:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neo_aihut`
--

-- --------------------------------------------------------

--
-- Table structure for table `aihut_category`
--

CREATE TABLE `aihut_category` (
  `id` int(11) NOT NULL,
  `cate_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aihut_category`
--

INSERT INTO `aihut_category` (`id`, `cate_name`, `description`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'News & Alerts', '<p><strong>No Cash Deposits Over 49 Thousand&nbsp;- Income Tax Notice</strong></p>\n', 1, '2019-03-29 00:00:00', '2022-06-04 00:00:00', NULL),
(7, 'Information', '<p>Mumbai Head Office - Staff Contact Details</p>\n\n<h2>&nbsp;</h2>\n', 1, '2019-03-29 00:00:00', '2019-10-07 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aihut_category`
--
ALTER TABLE `aihut_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aihut_category`
--
ALTER TABLE `aihut_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
