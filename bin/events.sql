-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 03:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcirepositori`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(225) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#007bff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `title`, `image`, `start_date`, `end_date`, `location`, `description`, `color`) VALUES
(11, 'Workshop Subdir Advanced Analytics and Growth Marketing', 'Farewell Party', 'WhatsApp_Image_2024-12-03_at_16_36_00.jpeg', '2024-12-04 12:00:00', '2024-12-04 14:00:00', 'Telkomsel Smart Office, Lt. 10, Holding Room', 'Trend on Human Capital on 2024 Onwards – Optimize organization effectiveness through adjusted operating model and enhance right-size organization with lean structure & agile way of working to maximize the company effectiveness and redesign the skill & capability map on digital aspects and value-added functions for talent fulfillment.', '#007bff'),
(12, 'Workshop Subdir Advanced Analytics and Growth Marketing', 'Workshop AAGM', 'WhatsApp_Image_2024-12-03_at_16_36_001.jpeg', '2024-12-04 14:00:00', '2024-12-04 17:00:00', 'Telkomsel Smart Office, Lt. 10, Holding Room', 'Trend on Human Capital on 2024 Onwards – Optimize organization effectiveness through adjusted operating model and enhance right-size organization with lean structure & agile way of working to maximize the company effectiveness and redesign the skill & capability map on digital aspects and value-added functions for talent fulfillment.', '#ffd500'),
(13, 'Workshop Subdir Advanced Analytics and Growth Marketing', 'Workshop Subdir Advanced Analytics and Growth Marketing', 'WhatsApp_Image_2024-12-03_at_16_36_09.jpeg', '2024-12-05 06:30:00', '2024-12-05 16:00:00', 'Meeting Point Parking Area Jungleland', 'Trekking Sentul Curug Cibingbin & Makan Siang Bersama', '#e100ff'),
(14, 'Makan Siang Bareng', 'Makan Siang Bareng (MAKSIBAR)', 'lunch.jpg', '2024-12-11 12:00:00', '2024-12-11 13:30:00', 'Lantai 15 ', 'Agenda Makan Siang Bareng', '#d13333');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
