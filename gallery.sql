-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 06:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(5) NOT NULL,
  `comment_photo_id` int(5) NOT NULL,
  `comment_author` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `comment_body` text COLLATE utf8_vietnamese_ci NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_photo_id`, `comment_author`, `comment_body`, `comment_date`) VALUES
(1, 2, 'anonymous', 'Good', '2021-07-05 06:05:28'),
(3, 2, 'anonymous', 'f', '2021-07-05 06:09:39'),
(5, 2, 'anonymous', 'hay', '2021-07-05 06:11:36'),
(6, 2, 'anonymous', 's', '2021-07-05 06:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(5) NOT NULL,
  `photo_user_id` int(5) NOT NULL DEFAULT 1,
  `photo_title` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `photo_caption` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `photo_alt` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `photo_desc` text COLLATE utf8_vietnamese_ci NOT NULL,
  `photo_fname` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `photo_ftype` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `photo_fsize` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_user_id`, `photo_title`, `photo_caption`, `photo_alt`, `photo_desc`, `photo_fname`, `photo_ftype`, `photo_fsize`) VALUES
(2, 1, 'Edwin Diaz Car', 'Best Carr', 'Supercar', '<p>Welcome to my gara.</p>', 'images-43 copy.jpg', 'image/jpeg', 27955),
(3, 1, 'Jonas Car', 'Super Beutiful Car', 'HyperCar', 'You can drive it if trying enough!', 'images_2.jpg', 'image/jpeg', 18578),
(4, 1, 'Supercar Honda', 'Super Vjppro Car', 'Supercar', '<p>yeahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>', 'images-7.jpg', 'image/jpeg', 24140),
(5, 1, 'Edwin PHP Master Course', 'Super Vjppro Car', 'ddd', '<p>yoooooooooooooooooooooooooooooooooooooooooo</p>', 'images-3.jpg', 'image/jpeg', 18096),
(6, 8, 'Cyber Security Course', 'Super Beautiful Car', 'Hahaha', '<p>Lorem ipsum. Yeahhhhhhhhhhhhhhhh</p>', 'images-1.jpg', 'image/jpeg', 28947),
(7, 2, '', '', '', '', 'images-50.jpg', 'image/jpeg', 21652),
(9, 2, '', '', '', '', 'images-44 copy.jpg', 'image/jpeg', 29486);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_firstname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_lastname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_photo` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_photo`) VALUES
(1, 'robo', 'robotext', 'robo', 'text', 'images-3.jpg'),
(2, 'vincenzo', 'conmeono', 'vincenzo', 'cassano', 'images-1.jpg'),
(3, 'paolo', 'paolo', 'paolo', 'cassano', 'image-1.jpg'),
(4, 'tinikun', 'tinikun', 'tini', 'kun', 'image-1.jpg'),
(8, '', '', '', 'b', 'images_2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_photo_id` (`comment_photo_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
