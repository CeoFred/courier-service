-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2019 at 01:05 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(20) NOT NULL,
  `shipper_first_name` varchar(200) NOT NULL,
  `shipper_last_name` varchar(200) NOT NULL,
  `shipper_address` varchar(200) NOT NULL,
  `shipper_country` varchar(200) NOT NULL,
  `shipper_number` varchar(200) NOT NULL,
  `shipper_email` varchar(200) NOT NULL,
  `receiver_first_name` varchar(200) NOT NULL,
  `receiver_last_name` varchar(200) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `receiver_number` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `receiver_country` varchar(200) NOT NULL,
  `no_of_pakages` int(20) DEFAULT NULL,
  `package_status` text,
  `package_destination` varchar(200) DEFAULT NULL,
  `package_carrier` varchar(200) DEFAULT 'FedEx',
  `shipment_mode` varchar(200) DEFAULT NULL,
  `package_weight` int(20) DEFAULT NULL,
  `package_reference_no` varchar(200) DEFAULT NULL,
  `items_specified` text,
  `payment_mode` varchar(200) DEFAULT NULL,
  `expected_delivery_date` varchar(200) DEFAULT NULL,
  `departure_time` varchar(200) DEFAULT NULL,
  `departure_date` varchar(255) DEFAULT NULL,
  `pick_up_date` varchar(200) DEFAULT NULL,
  `pick_up_time` varchar(200) DEFAULT NULL,
  `comments` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
