-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 12:11 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jrurepo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `created_at`, `status`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'JRU', 'ADMIN', 'jru@gmail.com', '2022-11-19 23:31:48', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `dept_code` varchar(10) NOT NULL,
  `cat_code` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `file` varchar(100) NOT NULL,
  `availability` varchar(10) NOT NULL,
  `view_count` int(11) NOT NULL,
  `download_count` int(11) NOT NULL,
  `main_author_id` int(11) NOT NULL,
  `keyword` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `dept_code`, `cat_code`, `content`, `file`, `availability`, `view_count`, `download_count`, `main_author_id`, `keyword`, `created_at`, `updated_at`, `status`) VALUES
(1, 'VB.NET Tutorial', 'CSE', 'BSCpE', 'VB.Net is a simple, modern, object-oriented computer programming language developed by Microsoft to combine the power of .NET Framework and the common language runtime with the productivity benefits that are the hallmark of Visual Basic. This tutorial will teach you basic VB.Net programming and will also take you through various advanced concepts related to VB.Net programming language.', '12312312363845fee22235.txt', 'PUB', 0, 0, 1, 'vb', '2022-11-28 15:14:54', '2022-11-28 15:41:21', 'Y'),
(2, 'PHP Introduction', 'CSE', 'BSCpE', 'PHP is an acronym for \"PHP: Hypertext Preprocessor\"\r\nPHP is a widely-used, open source scripting language\r\nPHP scripts are executed on the server\r\nPHP is free to download and use', 'ATT63846031b6b87.png', 'PRIV', 0, 0, 1, 'php', '2022-11-28 15:16:01', '2022-11-28 15:35:53', 'Y'),
(3, 'A', 'AEP', 'BSPsy', 'A', 'ATT6384a97f751b3.png', 'PUB', 0, 0, 1, 'CA', '2022-11-28 20:28:47', '0000-00-00 00:00:00', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `article_access`
--

DROP TABLE IF EXISTS `article_access`;
CREATE TABLE IF NOT EXISTS `article_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article_access`
--

INSERT INTO `article_access` (`id`, `art_id`, `user_id`, `status`) VALUES
(2, 2, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `author_list`
--

DROP TABLE IF EXISTS `author_list`;
CREATE TABLE IF NOT EXISTS `author_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author_list`
--

INSERT INTO `author_list` (`id`, `art_id`, `user_id`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 2, 3),
(4, 2, 1),
(5, 3, 3),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_code` varchar(10) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_code` (`cat_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_code`, `cat_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'MEC', 'Major in Economics', 'admin', '2022-11-28 13:22:14', NULL, '2022-11-28 13:22:14', 'Y'),
(2, 'ME', 'Major in English', 'admin', '2022-11-28 13:22:26', NULL, '2022-11-28 13:22:26', 'Y'),
(3, 'MHIS', 'Major in History', 'admin', '2022-11-28 13:22:42', NULL, '2022-11-28 13:22:42', 'Y'),
(4, 'MSS', 'Major in Social Studies', 'admin', '2022-11-28 13:22:58', NULL, '2022-11-28 13:22:58', 'Y'),
(5, 'MAC', 'Major in Accounting', 'admin', '2022-11-28 13:23:04', NULL, '2022-11-28 13:23:04', 'Y'),
(6, 'MBF', 'Major in Banking and Finance', 'admin', '2022-11-28 13:23:13', NULL, '2022-11-28 13:23:13', 'Y'),
(7, 'MMNGNT', 'Major in Management', 'admin', '2022-11-28 13:23:23', 'admin', '2022-11-28 13:23:43', 'Y'),
(8, 'MMARK', 'Major in Marketing', 'admin', '2022-11-28 13:24:51', NULL, '2022-11-28 13:24:51', 'Y'),
(9, 'MSM', 'Major in Supply Management', 'admin', '2022-11-28 13:24:58', NULL, '2022-11-28 13:24:58', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

DROP TABLE IF EXISTS `citations`;
CREATE TABLE IF NOT EXISTS `citations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `link` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 1, 'jay', '2022-11-29 14:42:59'),
(2, 1, 1, 'da', '2022-11-29 14:43:30'),
(3, 1, 1, 'dada', '2022-11-29 14:44:07'),
(4, 1, 1, 'jean carla', '2022-11-29 14:44:24'),
(5, 1, 1, 'asd', '2022-11-29 14:44:59'),
(6, 1, 1, 'asd', '2022-11-29 14:45:14'),
(7, 1, 1, 'asd', '2022-11-29 14:48:19'),
(8, 1, 1, 'sample', '2022-11-29 14:48:50'),
(9, 1, 1, 'jay', '2022-11-29 19:30:01'),
(10, 2, 1, 'Sample eyy', '2022-11-30 06:57:09'),
(11, 1, 5, 'Galeng', '2022-11-30 07:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `dept_code`, `code`, `course`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'AEP', 'AB', 'Bachelor of Arts', 'admin', '2022-11-28 13:18:27', NULL, '2022-11-28 13:18:27', 'Y'),
(2, 'AEP', 'BSPsy', 'Bachelor of Science in Psychology', 'admin', '2022-11-28 13:18:42', NULL, '2022-11-28 13:18:42', 'Y'),
(3, 'BAA', 'BSA', 'Bachelor of Science in Accountancy', 'admin', '2022-11-28 13:18:56', NULL, '2022-11-28 13:18:56', 'Y'),
(4, 'BAA', 'BSBA', 'Bachelor of Science in Business Administration', 'admin', '2022-11-28 13:19:07', NULL, '2022-11-28 13:19:07', 'Y'),
(5, 'AEP', 'BSLgM', 'Bachelor of Science in Legal Management', 'admin', '2022-11-28 13:19:48', NULL, '2022-11-28 13:19:48', 'Y'),
(6, 'AEP', 'BSED', 'Bachelor of Secondary Education', 'admin', '2022-11-28 13:20:32', NULL, '2022-11-28 13:20:32', 'Y'),
(7, 'AEP', 'BEED', 'Bachelor of Elementary Education', 'admin', '2022-11-28 13:20:44', NULL, '2022-11-28 13:20:44', 'Y'),
(8, 'AEP', 'CTE', 'Certificate in Teaching Education', 'admin', '2022-11-28 13:20:51', NULL, '2022-11-28 13:20:51', 'Y'),
(9, 'CSE', 'BSCpE', 'Bachelor of Science in Computer Engineering', 'admin', '2022-11-28 14:53:56', NULL, '2022-11-28 14:53:56', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(20) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'AEP', 'PROGRAMS UNDER THE COLLEGE OF LIBERAL ARTS, EDUCATION, & PSYCHOLOGY', '2022-11-20 17:22:32', 'admin', '2022-11-20 20:07:22', 'admin', 'Y'),
(2, 'BAA', 'PROGRAMS UNDER THE COLLEGE OF BUSINESS ADMINISTRATION & ACCOUNTANCY', '2022-11-20 19:42:50', 'admin', '2022-11-21 21:52:53', 'admin', 'Y'),
(3, 'CSE', 'PROGRAMS UNDER THE COLLEGE OF COMPUTER STUDIES & ENGINEERING', '2022-11-20 19:54:13', 'admin', '0000-00-00 00:00:00', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `no_likes`
--

DROP TABLE IF EXISTS `no_likes`;
CREATE TABLE IF NOT EXISTS `no_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `no_likes`
--

INSERT INTO `no_likes` (`id`, `article_id`, `user_id`) VALUES
(16, 1, 1),
(17, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate_val` int(11) NOT NULL,
  `rate_base` int(11) NOT NULL DEFAULT 5,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `article_id`, `user_id`, `rate_val`, `rate_base`, `created_at`) VALUES
(1, 1, 1, 3, 5, '2022-11-29 20:41:47'),
(2, 2, 1, 5, 5, '2022-11-30 06:56:59'),
(3, 1, 5, 2, 5, '2022-11-30 07:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_uid` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reference_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `isconfig` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_uid`, `reference_id`, `user_role`, `first_name`, `last_name`, `email`, `gender`, `picture`, `course_code`, `department_code`, `contact_number`, `created_at`, `modified`, `isconfig`, `status`) VALUES
(1, '111421296961153927711', '21200', 'Student', 'Jay', 'Reyes', 'jjreyes055@gmail.com', 'U', 'https://lh3.googleusercontent.com/a/ALm5wu1kdjKs3qyeDzIhrR55nUuTjpX_l-Hbkc4MvaGy=s96-c', 'AB', 'AEP', '09555555555', '2022-11-19 14:45:32', '2022-11-22 21:19:15', 'Y', 'Y'),
(2, '113517220591565991884', '', 'Educator', 'Jeeg', 'Saw', 'jeegsaw04@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu0wZtXY7C_3Misd7JXs7sbCDR-8tyL2K63Z9WP0=s96-c', '1', '0', '', '2022-11-19 14:46:01', '0000-00-00 00:00:00', 'N', 'Y'),
(3, '105284222278475222344', '', 'Educator', 'Carl', 'Reyes', 'reyescarlarol08@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu2R_hWXWZUM8Af4HE1Sdnk79tV0cp_TQvcOze23=s96-c', 'AB', '0', '', '2022-11-19 14:46:58', '0000-00-00 00:00:00', 'N', 'Y'),
(5, '107933929736267994805', '20099', 'Student', 'Carl', 'Reyes', 'pchsradtechreyes@gmail.com', 'M', 'https://lh3.googleusercontent.com/a/ALm5wu17Xit6UhlyzdLWtsBcH5wbgCntsSy2IyggSPw5=s96-c', 'BSCpE', 'CSE', '091541843265', '2022-11-30 06:58:19', '2022-11-30 06:59:18', 'Y', 'Y');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
