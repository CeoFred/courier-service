-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2019 at 09:48 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, '15738927645dcfb29c679d6', 'Alfred', 'Johnson awah', 'Johnsonmessilo19@gmail.com', '$2y$10$4WFUTf3tHQkpvvPcmn6U8e5v5Lvj8Opi0Rki4J8XJ48zmdd3456w2', '2019-11-16 08:26:04');

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
  `no_of_pakages` varchar(20) DEFAULT NULL,
  `package_status` text DEFAULT NULL,
  `package_destination` varchar(200) DEFAULT NULL,
  `package_carrier` varchar(200) DEFAULT 'FedEx',
  `shipment_mode` varchar(200) DEFAULT NULL,
  `package_weight` varchar(20) DEFAULT NULL,
  `package_reference_no` varchar(200) DEFAULT NULL,
  `items_specified` text DEFAULT NULL,
  `payment_mode` varchar(200) DEFAULT NULL,
  `expected_delivery_date` varchar(200) DEFAULT NULL,
  `departure_time` varchar(200) DEFAULT NULL,
  `departure_date` varchar(255) DEFAULT NULL,
  `pick_up_date` varchar(200) DEFAULT NULL,
  `pick_up_time` varchar(200) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `tracking_id`, `shipper_first_name`, `shipper_last_name`, `shipper_address`, `shipper_country`, `shipper_number`, `shipper_email`, `receiver_first_name`, `receiver_last_name`, `receiver_address`, `receiver_number`, `receiver_email`, `receiver_country`, `no_of_pakages`, `package_status`, `package_destination`, `package_carrier`, `shipment_mode`, `package_weight`, `package_reference_no`, `items_specified`, `payment_mode`, `expected_delivery_date`, `departure_time`, `departure_date`, `pick_up_date`, `pick_up_time`, `comments`, `created_at`, `deleted_at`, `updated_at`, `admin_id`) VALUES
(1, '517528421416', 'Alfred', 'Johnson', 'No 10 miracle lane phase 6 trans ekulu, enugu', 'China', '+2348160583193', 'Johnsonmessilo19@gmail.com', 'Alfred', 'Johnson', 'No 10 miracle lane phase 6 trans ekulu, enugu', '+2348000002423', 'Johnsonmessilo19@gmail.com', 'Nigeria', 'ten', '1', 'Londo', 'fedex', 'Air', '50', '15738928435dcfb2eb17b21', 'GOL', 'Cash', '2019-11-07', '02:34', '2019-11-29', '2019-11-14', '04:34', 'ghkl;', '2019-11-16 08:26:36', NULL, '2019-11-16 08:38:10', '15738927645dcfb29c679d6');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
