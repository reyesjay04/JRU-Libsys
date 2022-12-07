-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 12:34 AM
-- Server version: 8.0.19
-- PHP Version: 8.1.6

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
CREATE DATABASE IF NOT EXISTS `jrurepo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `jrurepo`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `created_at`, `status`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'JRU', 'ADMIN', 'jru@gmail.com', '2022-11-19 23:31:48', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(100) NOT NULL,
  `attachment` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `description`, `filename`, `attachment`, `created_at`) VALUES
(1, 'sample content', 'sample content', 'user3-128x128638dbe8697c2e.jpg', '../admin/uploads/user3-128x128638dbe8697c2e.jpg', '2022-12-05 17:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `dept_code` varchar(10) NOT NULL,
  `cat_code` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `file` varchar(100) NOT NULL,
  `availability` varchar(10) NOT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  `download_count` int NOT NULL DEFAULT '0',
  `main_author_id` int NOT NULL,
  `keyword` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `dept_code`, `cat_code`, `content`, `file`, `availability`, `view_count`, `download_count`, `main_author_id`, `keyword`, `created_at`, `updated_at`, `status`) VALUES
(1, 'VB.net', 'CSE', 'BSCpE', 'VB.Net is a simple, modern, object-oriented computer programming language developed by Microsoft to combine the power of .NET Framework and the common language runtime with the productivity benefits that are the hallmark of Visual Basic. This tutorial will teach you basic VB.Net programming and will also take you through various advanced concepts related to VB.Net programming language.', 'boxed-bg638da52e9c1a2.jpg', 'PUB', 88, 0, 5, 'vb', '2022-12-05 16:00:46', '2022-12-05 16:01:05', 'Y'),
(2, 'PHP', 'CSE', 'BSCpE', 'ca', 'avatar5638dc5afdc129.png', 'PUB', 68, 0, 1, 'php', '2022-12-05 18:19:27', '2022-12-05 18:19:35', 'Y'),
(3, 'Private Sample', 'AEP', 'BSED', 'Private Sample', 'avatar5638dc9881c8ed.png', 'PRIV', 36, 0, 1, 'Private Sample', '2022-12-05 18:35:52', '2022-12-05 18:36:46', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `article_access`
--

DROP TABLE IF EXISTS `article_access`;
CREATE TABLE IF NOT EXISTS `article_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `user_id` int NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article_access`
--

INSERT INTO `article_access` (`id`, `art_id`, `user_id`, `requested_at`, `status`) VALUES
(2, 3, 5, '2022-12-05 19:42:10', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `author_list`
--

DROP TABLE IF EXISTS `author_list`;
CREATE TABLE IF NOT EXISTS `author_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `author_list`
--

INSERT INTO `author_list` (`id`, `art_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 5),
(3, 2, 5),
(4, 2, 1),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_code` varchar(10) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_code` (`cat_code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `link` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(20) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'AEP', 'PROGRAMS UNDER THE COLLEGE OF LIBERAL ARTS, EDUCATION, & PSYCHOLOGY', '2022-11-20 17:22:32', 'admin', '2022-12-07 21:33:41', 'admin', 'Y'),
(2, 'BAA', 'PROGRAMS UNDER THE COLLEGE OF BUSINESS ADMINISTRATION & ACCOUNTANCY', '2022-11-20 19:42:50', 'admin', '2022-11-21 21:52:53', 'admin', 'Y'),
(3, 'CSE', 'PROGRAMS UNDER THE COLLEGE OF COMPUTER STUDIES & ENGINEERING', '2022-11-20 19:54:13', 'admin', '0000-00-00 00:00:00', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `article_id`, `user_id`) VALUES
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `to_user_id` int NOT NULL,
  `from_user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `to_user_id`, `from_user_id`, `created_at`, `status`) VALUES
(1, 'LIKE', 1, 5, '2022-12-06 21:56:58', 'Y'),
(2, 'LIKE', 5, 1, '2022-12-06 21:38:34', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `no_likes`
--

DROP TABLE IF EXISTS `no_likes`;
CREATE TABLE IF NOT EXISTS `no_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `no_likes`
--

INSERT INTO `no_likes` (`id`, `article_id`, `user_id`) VALUES
(5, 1, 1),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rate_val` int NOT NULL,
  `rate_base` int NOT NULL DEFAULT '5',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `article_id`, `user_id`, `rate_val`, `rate_base`, `created_at`) VALUES
(1, 1, 1, 2, 5, '2022-12-05 18:19:04'),
(2, 2, 1, 1, 5, '2022-12-05 18:19:44'),
(3, 3, 1, 3, 5, '2022-12-05 19:07:47'),
(4, 1, 5, 1, 5, '2022-12-05 19:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `save_list`
--

DROP TABLE IF EXISTS `save_list`;
CREATE TABLE IF NOT EXISTS `save_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `art_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `save_list`
--

INSERT INTO `save_list` (`id`, `art_id`, `user_id`, `created_at`) VALUES
(1, 1, 1, '2022-12-05 17:55:29'),
(2, 3, 1, '2022-12-05 19:10:12'),
(3, 3, 5, '2022-12-05 19:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oauth_uid` varchar(50) NOT NULL,
  `reference_id` varchar(50) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `course_code` varchar(100) NOT NULL,
  `department_code` varchar(10) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `isconfig` varchar(1) NOT NULL DEFAULT 'N',
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_uid`, `reference_id`, `user_role`, `first_name`, `last_name`, `email`, `gender`, `picture`, `course_code`, `department_code`, `contact_number`, `created_at`, `modified`, `isconfig`, `status`) VALUES
(1, '111421296961153927711', '21200', 'Student', 'Jay', 'Reyes', 'jjreyes055@gmail.com', 'M', 'https://lh3.googleusercontent.com/a/ALm5wu1kdjKs3qyeDzIhrR55nUuTjpX_l-Hbkc4MvaGy=s96-c', 'AB', 'AEP', '09555555555', '2022-11-19 14:45:32', '2022-11-22 21:19:15', 'Y', 'Y'),
(2, '113517220591565991884', '', 'Educator', 'Jeeg', 'Saw', 'jeegsaw04@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu0wZtXY7C_3Misd7JXs7sbCDR-8tyL2K63Z9WP0=s96-c', '1', '0', '', '2022-11-19 14:46:01', '0000-00-00 00:00:00', 'N', 'Y'),
(3, '105284222278475222344', '', 'Educator', 'Janine', 'Reyes', 'reyescarlarol08@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu2R_hWXWZUM8Af4HE1Sdnk79tV0cp_TQvcOze23=s96-c', 'AB', '0', '', '2022-11-19 14:46:58', '0000-00-00 00:00:00', 'N', 'Y'),
(5, '107933929736267994805', '20099', 'Student', 'Carl', 'Reyes', 'pchsradtechreyes@gmail.com', 'M', '../students/uploads/avatar04638d9a212dd12.png', 'BSCpE', 'CSE', '091541843265', '2022-11-30 06:58:19', '2022-11-30 06:59:18', 'Y', 'Y');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
