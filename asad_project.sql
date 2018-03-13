-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2018 at 12:40 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asad_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(3) NOT NULL,
  `parent` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `class` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent`, `name`, `class`, `url`) VALUES
(1, 0, 'System Settings', 'icon icon-cogs', ''),
(2, 0, 'Frontend Settings', 'icon icon-desktop', ''),
(3, 1, 'Edit Smtp', '', 'Admin/edit_smtp_config/1'),
(4, 1, 'Edit Company Info', '', 'Admin/edit_company_info/1'),
(5, 0, 'Category', 'icon icon-cube', ''),
(6, 5, 'Add Category', '', 'Admin/add_category'),
(7, 5, 'Manage Categories', '', 'Admin/manage_categories'),
(8, 0, 'Sub Category', 'icon icon-cube', ''),
(9, 8, 'Add Sub Category', '', 'Admin/add_sub_category'),
(10, 8, 'Manage Sub Categories', '', 'Admin/manage_sub_categories');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`, `date_time`) VALUES
(1, 'Computer', 'icon fa fa-desktop', '2018-03-13 00:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `website` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`id`, `name`, `email`, `contact`, `address`, `website`, `logo`, `date_time`) VALUES
(1, 'Ecommerce', 'admin@technologicx.com', '+923152156845', 'AnonymousZ', 'https://technologicx.com', '24ff461c59a6500144ec73b406fda359.png', '2018-01-19 11:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `address_1` longtext NOT NULL,
  `address_2` longtext NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` varchar(30) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `contact_no`, `password`, `hash`, `address_1`, `address_2`, `country`, `city`, `state`, `zip_code`, `date_time`, `status`) VALUES
(9, 'Syed', 'asad', 'cyberasad09@gmail.com', '03152156845', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-07 23:43:42', 'Pending'),
(18, 'syed', 'asad', 'cyberasad09@gmail.com', '23232323', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 00:16:47', 'Pending'),
(19, 'saadi', 'linu', 'smasad612@gmail.com', '232323232', 'fca7eb1a8150b15149a6fad6a76355bc', '739aff016ff5079de4396eef1a6419aa', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 00:23:07', 'Pending'),
(20, 'saadi', 'linux', 'cyberasad09@gmail.com', '023232', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 19:34:47', 'Pending'),
(21, 'saadi', 'linux', 'cyberasad09@gmail.com', '087989', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 19:49:21', 'Pending'),
(22, 'syed', 'asad', 'cyberasad09@gmail.com', '092320923', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 19:52:47', 'Pending'),
(23, 'saadi', 'linux', 'cyberasad09@gmail.com', '09090', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 19:56:13', 'Pending'),
(24, 'saadi', 'asad', 'cyberasad09@gmail.com', '2323', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 20:05:53', 'Pending'),
(25, 'saadi', 'linux', 'cyberasad09@gmail.com', '23232', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 20:07:55', 'Pending'),
(26, 'saadi', 'linux', 'cyberasad09@gmail.com', '1232323', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 20:18:47', 'Pending'),
(27, 'fuck', 'u', 'cyberasad09@gmail.com', '232323', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 20:28:59', 'Pending'),
(28, 'saadi', 'linux', 'cyberasad09@gmail.com', '121212', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 20:33:47', 'Pending'),
(29, 'syed', 'asad', 'cyberasad09@gmail.com', '03152156845', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 22:57:13', 'Pending'),
(30, 'saadi', 'linux', 'cyberasad09@gmail.com', '0997979', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:13:25', 'Pending'),
(31, 'syed', 'asad', 'cyberasad09@gmail.com', '2323232', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:21:59', 'Pending'),
(32, 'Saadi', 'linux', 'cyberasad09@gmail.com', '2232323', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:24:19', 'Pending'),
(33, 'saadi', 'linux', 'cyberasad09@gmail.com', '09090909', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:27:21', 'Pending'),
(34, 'saadi', 'linux', 'cyberasad09@gmail.com', '23232323', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:31:36', 'Pending'),
(35, 'saadi', 'linux', 'cyberasad09@gmail.com', '23232', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:36:32', 'Pending'),
(36, 'saad', 'linux', 'cyberasad09@gmail.com', '23232', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-10 23:58:55', 'Pending'),
(37, 'saaad', 'linux', 'cyberasad09@gmail.com', '4342334', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-11 00:07:37', 'Pending'),
(38, 'saaad', 'linux', 'cyberasad09@gmail.com', '4342334', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-11 00:09:04', 'Pending'),
(39, 'saadi', 'sasad', 'cyberasad09@gmail.com', '23232', 'fca7eb1a8150b15149a6fad6a76355bc', '759842169b85538c84e0f944de1b4fd0', 'house no 810', 'house no 810', 'pakistan', 'karachi', 'sindh', '021', '2018-03-11 00:10:26', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(1) NOT NULL,
  `host` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(3) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sent_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sent_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `reply_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `reply_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `host`, `port`, `email`, `password`, `sent_email`, `sent_title`, `reply_email`, `reply_title`) VALUES
(1, 'mail.technologicx.com', 465, 'admin@technologicx.com', 'saadi123*', 'admin@technologicx.com', 'Ecommerce', 'admin@technologicx.com', 'Ecommerce');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
  `sub_title` varchar(30) NOT NULL,
  `quote` text NOT NULL,
  `link` text NOT NULL,
  `status` enum('Disable','Enable') NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `title`, `sub_title`, `quote`, `link`, `status`, `date_time`) VALUES
(8, '47d180baab3cbf7743a0711423a21ca3.jpg', 'NEW COLLECTIONS', 'SPRING 2018', 'LOREM IPSUM DESUM', '#', 'Enable', '2018-02-23 08:13:16'),
(9, '45fa746e0b6c5ac33b8a299d09e3478c.jpg', 'WOMEN COLLECTIONS', 'FALL 2017', 'LOREM IPSUM DESUM123', '#', 'Enable', '2018-02-23 08:14:20'),
(10, '2a62256a93013e5317f82f8113f956e1.jpg', 'LATEST ELECTRONICS', 'TOP BRAND', 'WORLD BEST SELLING ELECTRONICS', '#', 'Enable', '2018-02-23 08:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google_plus` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `facebook`, `twitter`, `google_plus`, `linkedin`, `date_time`) VALUES
(1, 'facebook.com/technologicx', 'twitter.com/technologicx', 'twitter.com/technologicx', 'twitter.com/technologicx', '2018-02-23 14:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `cat_id`, `date_time`) VALUES
(1, 'Desktop PC\'s', 1, '2018-03-13 00:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `name`, `status`) VALUES
(1, 'theme1', 'Inactive'),
(2, 'theme2', 'Active'),
(3, 'theme3', 'Inactive'),
(4, 'theme4', 'Inactive'),
(5, 'theme5', 'Inactive'),
(6, 'theme6', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(2) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `status` enum('pending','approved') NOT NULL,
  `ip` varchar(20) NOT NULL,
  `browser` text NOT NULL,
  `operating_system` varchar(20) NOT NULL,
  `device` varchar(20) NOT NULL,
  `location` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `hash`, `status`, `ip`, `browser`, `operating_system`, `device`, `location`, `date_time`, `image`) VALUES
(29, 'saadi', 'cyberasad09@gmail.com', 'fca7eb1a8150b15149a6fad6a76355bc', 1, '', 'approved', '::1', 'Firefox', 'Windows 10', 'Computer', '', '2017-08-21 19:32:35', 'avatar1.png'),
(30, 'adnan', 'adnanrafi784@gmail.com', '5f92666713758deba6e9880d8c0fd73c', 1, 'e8555537f6031e44c5c6937a3d62956a', 'approved', '127.0.0.1', 'Chrome', 'Windows 7', 'Computer', '', '2017-08-27 07:40:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` varchar(11) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `detail` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_at` datetime DEFAULT NULL,
  `banned_at` datetime DEFAULT NULL,
  `status` enum('Pending','Approved','banned') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_information`
--
ALTER TABLE `company_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_information`
--
ALTER TABLE `company_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
