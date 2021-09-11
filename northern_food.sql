-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2021 at 02:56 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `northern_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `nf_admin`
--

CREATE TABLE `nf_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_admin`
--

INSERT INTO `nf_admin` (`id`, `username`, `password`, `email`, `registered`) VALUES
(5, 'admin', 'admin', 'admin@admin.com', '2021-08-30 15:06:44'),
(6, 'heart', '1234', 'heart@heart.com', '2021-08-30 15:08:29'),
(8, 'test', '1234', 'test@test.com', '2021-08-30 15:14:30'),
(9, 'parn', '1234', 'parn@parn.com', '2021-09-08 18:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `nf_food`
--

CREATE TABLE `nf_food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_desc` text NOT NULL,
  `food_img` text NOT NULL,
  `food_ingredients` text NOT NULL,
  `food_spices` text NOT NULL,
  `food_bg` text NOT NULL,
  `food_rec` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nf_food_res`
--

CREATE TABLE `nf_food_res` (
  `food_res_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nf_food_type`
--

CREATE TABLE `nf_food_type` (
  `food_type_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nf_res`
--

CREATE TABLE `nf_res` (
  `res_id` int(11) NOT NULL,
  `res_name` varchar(100) NOT NULL,
  `res_img` text NOT NULL,
  `res_map` text NOT NULL,
  `res_bg` text NOT NULL,
  `res_desc` text NOT NULL,
  `res_rec` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_res`
--

INSERT INTO `nf_res` (`res_id`, `res_name`, `res_img`, `res_map`, `res_bg`, `res_desc`, `res_rec`) VALUES
(12, 'tset', '2312.jpg', 'rsfsfsDF', 'art_artwork_fantasy_artistic_original_abstract_abstraction_5184x3456.jpg', 'tsesdfsadfasf', '2021-09-09 16:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `nf_type`
--

CREATE TABLE `nf_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_type`
--

INSERT INTO `nf_type` (`type_id`, `type_name`) VALUES
(1, 'ปิ้ง'),
(2, 'ต้ม'),
(3, 'นึ่ง'),
(4, 'ทอด'),
(5, 'ย่าง');

-- --------------------------------------------------------

--
-- Table structure for table `nf_user`
--

CREATE TABLE `nf_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nf_admin`
--
ALTER TABLE `nf_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nf_food`
--
ALTER TABLE `nf_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `nf_food_res`
--
ALTER TABLE `nf_food_res`
  ADD PRIMARY KEY (`food_res_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `nf_food_type`
--
ALTER TABLE `nf_food_type`
  ADD PRIMARY KEY (`food_type_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `nf_res`
--
ALTER TABLE `nf_res`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `nf_type`
--
ALTER TABLE `nf_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `nf_user`
--
ALTER TABLE `nf_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nf_admin`
--
ALTER TABLE `nf_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nf_food`
--
ALTER TABLE `nf_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nf_food_res`
--
ALTER TABLE `nf_food_res`
  MODIFY `food_res_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nf_food_type`
--
ALTER TABLE `nf_food_type`
  MODIFY `food_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nf_res`
--
ALTER TABLE `nf_res`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nf_type`
--
ALTER TABLE `nf_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nf_user`
--
ALTER TABLE `nf_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nf_food_res`
--
ALTER TABLE `nf_food_res`
  ADD CONSTRAINT `nf_food_res_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `nf_food` (`food_id`),
  ADD CONSTRAINT `nf_food_res_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `nf_res` (`res_id`);

--
-- Constraints for table `nf_food_type`
--
ALTER TABLE `nf_food_type`
  ADD CONSTRAINT `nf_food_type_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `nf_food` (`food_id`),
  ADD CONSTRAINT `nf_food_type_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `nf_type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
