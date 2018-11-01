-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2018 at 10:09 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediamanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `lr_admin`
--

CREATE TABLE `lr_admin` (
  `admin_id` int(10) NOT NULL,
  `admin_firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin_lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin_phone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) NOT NULL,
  `admin_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `forget_password_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `author_id` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `pre_last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lr_admin`
--

INSERT INTO `lr_admin` (`admin_id`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_phone`, `image_id`, `admin_password`, `forget_password_token`, `status`, `author_id`, `last_login`, `pre_last_login`, `created`, `updated`) VALUES
(1, 'Gulshan', 'Sharma', 'gul2787@gmail.com', '+919803800340', 0, '$2y$10$ufdsbY5UkonxNDal6TqHKOO8yDrCZ.XMHizX0hXMk8ANMB7MWaY2.', '', 1, 5, '2018-03-20 10:42:39', '2018-03-20 10:25:59', '2016-09-20 00:00:00', '2018-03-20 07:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `lr_gallery`
--

CREATE TABLE `lr_gallery` (
  `gallery_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `feature_category` tinyint(1) NOT NULL DEFAULT '0',
  `featured_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `icon_id` int(11) DEFAULT NULL,
  `icon_hover_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `author_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lr_gallery_options`
--

CREATE TABLE `lr_gallery_options` (
  `gallery_option_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lr_routes`
--

CREATE TABLE `lr_routes` (
  `id` int(11) NOT NULL,
  `content_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lr_uploads`
--

CREATE TABLE `lr_uploads` (
  `id` int(11) NOT NULL,
  `mime_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_extension` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thumb_path` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_width` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lr_gallery`
--
ALTER TABLE `lr_gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `lr_gallery_options`
--
ALTER TABLE `lr_gallery_options`
  ADD PRIMARY KEY (`gallery_option_id`),
  ADD KEY `gallery_id` (`gallery_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `lr_uploads`
--
ALTER TABLE `lr_uploads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lr_gallery`
--
ALTER TABLE `lr_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lr_gallery_options`
--
ALTER TABLE `lr_gallery_options`
  MODIFY `gallery_option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lr_uploads`
--
ALTER TABLE `lr_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lr_gallery`
--
ALTER TABLE `lr_gallery`
  ADD CONSTRAINT `fk_lr_gallery_image_id` FOREIGN KEY (`image_id`) REFERENCES `lr_uploads` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `lr_gallery_options`
--
ALTER TABLE `lr_gallery_options`
  ADD CONSTRAINT `fk_lr_gallery_option_image_id` FOREIGN KEY (`image_id`) REFERENCES `lr_uploads` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
