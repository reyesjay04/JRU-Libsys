-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 10:26 AM
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
CREATE DATABASE IF NOT EXISTS `jrurepo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jrurepo`;

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
  `cat_code` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `file` varchar(100) NOT NULL,
  `availability` varchar(10) NOT NULL,
  `view_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `cat_code`, `content`, `file`, `availability`, `view_count`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Article Sample', 'MT', 'Article Sample', '1', 'PUB', 10, '2022-11-20 17:20:39', '2022-11-20 17:20:39', 'Y'),
(2, 'Article 2', 'MT', 'Article Sample 2', '1', 'PUB', 10, '2022-11-20 17:21:20', '2022-11-20 17:21:20', 'N');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author_list`
--

INSERT INTO `author_list` (`id`, `art_id`, `user_id`) VALUES
(1, 1, 2),
(2, 1, 3);

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
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_code` (`cat_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_code`, `cat_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'EGG', 'Engineering', 'admin', '2022-11-20 11:17:38', 'admin', '2022-11-20 15:09:54', 'Y'),
(2, 'MT', 'Mathematics', 'admin', '2022-11-20 11:17:38', '', '2022-11-20 12:00:33', 'Y'),
(4, 'ST', 'Science and Technology', 'admin', '2022-11-20 04:57:10', '', '2022-11-20 12:00:33', 'Y'),
(5, 'HT', 'History', 'admin', '2022-11-20 04:57:23', '', '2022-11-20 12:00:33', 'Y'),
(6, 'CBA', 'COLLEGE OF BUSINESS ADMINISTRATION & ACCOUNTANCY (', 'admin', '2022-11-20 14:23:29', '', '2022-11-20 14:23:29', 'Y'),
(7, 'SP', 'Sample', 'admin', '2022-11-20 15:02:42', '', '2022-11-20 15:02:42', 'Y'),
(8, 'SP2', 'SP2', 'admin', '2022-11-20 15:03:47', '', '2022-11-20 15:03:47', 'Y');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `dept_id`, `code`, `course`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 1, 'IT', 'IT', 'admin', '2022-11-20 12:55:39', 'admin', '2022-11-20 15:17:28', 'Y');

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
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `code`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'AEP', 'PROGRAMS UNDER THE COLLEGE OF LIBERAL ARTS, EDUCATION, & PSYCHOLOGY', '2022-11-20 17:22:32', '2', '2022-11-20 17:22:32', '2', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `no_likes`
--

DROP TABLE IF EXISTS `no_likes`;
CREATE TABLE IF NOT EXISTS `no_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `no_likes`
--

INSERT INTO `no_likes` (`id`, `article_id`, `user_id`, `created_at`) VALUES
(1, 1, 1, '2022-11-20 17:24:09'),
(2, 1, 2, '2022-11-20 17:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate_val` int(11) NOT NULL,
  `rate_base` int(1) NOT NULL DEFAULT 5,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reference_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_uid`, `reference_id`, `user_role`, `first_name`, `last_name`, `email`, `gender`, `picture`, `course_id`, `department_id`, `created_at`, `modified`, `status`) VALUES
(1, '111421296961153927711', '', 'Students', 'Jay', 'Reyes', 'jjreyes055@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu1kdjKs3qyeDzIhrR55nUuTjpX_l-Hbkc4MvaGy=s96-c', '1', 0, '2022-11-19 14:45:32', '0000-00-00 00:00:00', 'Y'),
(2, '113517220591565991884', '', 'Educators', 'Jeeg', 'Saw', 'jeegsaw04@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu0wZtXY7C_3Misd7JXs7sbCDR-8tyL2K63Z9WP0=s96-c', '1', 0, '2022-11-19 14:46:01', '0000-00-00 00:00:00', 'Y'),
(3, '105284222278475222344', '', 'Educators', 'Carl', 'Reyes', 'reyescarlarol08@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu2R_hWXWZUM8Af4HE1Sdnk79tV0cp_TQvcOze23=s96-c', '0', 0, '2022-11-19 14:46:58', '0000-00-00 00:00:00', 'Y');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
