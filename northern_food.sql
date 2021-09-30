-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2021 at 07:55 PM
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
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_admin`
--

INSERT INTO `nf_admin` (`id`, `username`, `password`, `email`) VALUES
(5, 'admin', 'admin', 'admin@admin.com'),
(6, 'heart', '1234', 'heart@heart.com'),
(8, 'test', '1234', 'test@test.com'),
(9, 'parn', '1234', 'parn@parn.com'),
(10, 'nattadear', '1235', 'nattadear@nattadear.com'),
(11, 'test', '1234', 'tset@tset.com'),
(12, 'qqqq', 'qqqq', 'qqq@qqq.q'),
(13, 'aaa', 'aaa', 'aaa@aaaa.aa');

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
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_food`
--

INSERT INTO `nf_food` (`food_id`, `food_name`, `food_desc`, `food_img`, `food_ingredients`, `food_spices`, `food_bg`, `type_id`) VALUES
(45, 'ไส้อั่ว', 'test', 'ไส้อั่ว.jpg', 'test', 'test', 'b514427b5aa74aca9a4830de4bfe8a67.jpg', 5),
(46, 'แกงโฮ๊ะ', 'test', 'แกงโฮ๊ะ.jpg', 'test', 'test', 'pic737-1.jpg', 6),
(47, 'จอผักกาด', 'asdasd', 'จอผักกาด.jpg', 'saasd', 'asdasd', 'SU06-copy.jpg', 2),
(48, 'แอ๊บหมู', 'asdfasdfsf', 'แอ๊บหมู.jpg', 'asdfas', 'dfasdf', '2b2701200c2254a052262f5dd83ef731.jpg', 5),
(49, 'แกงอ่อมหมู', 'asdasdf', 'แกงอ่อมหมู.jpg', 'dasdas', 'dasdasd', '3-2133.jpg', 2),
(50, 'แกงฮังเล', 'qweqwe', 'แกงฮังเล.jpg', 'qweqwe', 'qweqwe', '3-2133.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nf_food_res`
--

CREATE TABLE `nf_food_res` (
  `food_res_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_food_res`
--

INSERT INTO `nf_food_res` (`food_res_id`, `food_id`, `res_id`) VALUES
(4, 45, 2),
(5, 46, 2),
(6, 46, 3),
(7, 45, 3);

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
  `res_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nf_res`
--

INSERT INTO `nf_res` (`res_id`, `res_name`, `res_img`, `res_map`, `res_bg`, `res_desc`) VALUES
(2, 'กิ๋นลำกิ๋นดี', 'กิ๋นลำกิ๋นดี.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30204.720123692143!2d99.04799553955081!3d18.86088880000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a6264bfec6f%3A0xa10922cfdaf1d4fe!2zS2lubHVtIEtpbmRlZSBTYW5zYWkg4LiB4Li04LmL4LiZ4Lil4Liz4LiB4Li04LmL4LiZ4LiU4Li1IOC4quC4seC4meC4l-C4o-C4suC4og!5e0!3m2!1sth!2sth!4v1632755891836!5m2!1sth!2sth\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'pic737-1.jpg', 'asdasd'),
(3, 'ต๋องเต็มโต๊ะ', 'ต๋องเต็มโต๊ะ.jpg', 'test', '47378773_1089392507902659_2058510784828276736_o.jpg', 'test'),
(4, 'เฮือนม่วนใจ๋', 'เฮือนม่วนใจ๋.jpg', 'asdsadasdasdad', '2b2701200c2254a052262f5dd83ef731.jpg', 'gumairusus'),
(5, 'เฮือนสุนทรี เวชานนท์', 'เฮือนสุนทรี เวชานนท์.jpg', 'adasdasd', 'b514427b5aa74aca9a4830de4bfe8a67.jpg', 'sdfsdf');

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
(5, 'ย่าง'),
(6, 'ผัด'),
(7, 'ตุ๋น'),
(8, 'คั่ว');

-- --------------------------------------------------------

--
-- Table structure for table `nf_user`
--

CREATE TABLE `nf_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
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
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `nf_food_res`
--
ALTER TABLE `nf_food_res`
  ADD PRIMARY KEY (`food_res_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `res_id` (`res_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nf_food`
--
ALTER TABLE `nf_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `nf_food_res`
--
ALTER TABLE `nf_food_res`
  MODIFY `food_res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nf_res`
--
ALTER TABLE `nf_res`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nf_type`
--
ALTER TABLE `nf_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nf_user`
--
ALTER TABLE `nf_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nf_food`
--
ALTER TABLE `nf_food`
  ADD CONSTRAINT `nf_food_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `nf_type` (`type_id`);

--
-- Constraints for table `nf_food_res`
--
ALTER TABLE `nf_food_res`
  ADD CONSTRAINT `nf_food_res_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `nf_food` (`food_id`),
  ADD CONSTRAINT `nf_food_res_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `nf_res` (`res_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
