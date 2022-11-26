-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 10:38 AM
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
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `dept_code` varchar(10) NOT NULL,
  `cat_code` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `file` varchar(100) NOT NULL,
  `availability` varchar(10) NOT NULL,
  `view_count` int NOT NULL,
  `main_author_id` int NOT NULL,
  `keyword` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `dept_code`, `cat_code`, `content`, `file`, `availability`, `view_count`, `main_author_id`, `keyword`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Article Sample', 'AEP', 'MT', 'Article Sample', '1', 'PUB', 10, 0, '', '2022-11-20 17:20:39', '2022-11-20 17:20:39', 'Y'),
(2, 'Article 2', 'BAA', 'MT', 'Article Sample 2', '1', 'PUB', 20, 0, '', '2022-11-20 17:21:20', '2022-11-20 17:21:20', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `author_list`
--

DROP TABLE IF EXISTS `author_list`;
CREATE TABLE `author_list` (
  `id` int NOT NULL,
  `art_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `author_list`
--

INSERT INTO `author_list` (`id`, `art_id`, `user_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int NOT NULL,
  `cat_code` varchar(10) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_code`, `cat_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'EGG', 'Engineering', 'admin', '2022-11-20 11:17:38', 'admin', '2022-11-21 21:14:09', 'Y'),
(2, 'MT', 'Mathematics', 'admin', '2022-11-20 11:17:38', '', '2022-11-20 12:00:33', 'Y'),
(5, 'HT', 'History', 'admin', '2022-11-20 04:57:23', '', '2022-11-20 12:00:33', 'Y'),
(6, 'CBA', 'COLLEGE OF BUSINESS ADMINISTRATION & ACCOUNTANCY (', 'admin', '2022-11-20 14:23:29', '', '2022-11-20 14:23:29', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

DROP TABLE IF EXISTS `citations`;
CREATE TABLE `citations` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `link` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int NOT NULL,
  `dept_code` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `dept_code`, `code`, `course`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'AEP', 'AB', 'Bachelor of Arts', 'admin', '2022-11-20 12:55:39', 'admin', '2022-11-20 15:17:28', 'Y'),
(5, 'BAA', 'BSA', 'Bachelor of Science in Accountancy', 'admin', '2022-11-20 19:43:37', 'admin', '2022-11-20 19:43:37', 'Y'),
(6, 'AEP', 'BSPsy', 'Bachelor of Science in Psychology', 'admin', '2022-11-20 20:22:12', '', '0000-00-00 00:00:00', 'Y'),
(7, 'AEP', 'AA', 'AA', 'admin', '2022-11-21 21:29:39', NULL, '2022-11-21 21:29:39', 'Y'),
(10, 'AEP', 'BB', 'BB', 'admin', '2022-11-21 21:30:19', NULL, '2022-11-21 21:30:19', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
CREATE TABLE `dislikes` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `article_id`, `user_id`, `created_at`) VALUES
(1, 1, 2, '2022-11-20 18:29:58'),
(2, 2, 3, '2022-11-20 18:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `no_likes`
--

DROP TABLE IF EXISTS `no_likes`;
CREATE TABLE `no_likes` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `no_likes`
--

INSERT INTO `no_likes` (`id`, `article_id`, `user_id`, `created_at`) VALUES
(1, 1, 3, '2022-11-20 17:24:09'),
(2, 1, 2, '2022-11-20 17:24:09'),
(3, 1, 2, '2022-11-20 18:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rate_val` int NOT NULL,
  `rate_base` int NOT NULL DEFAULT '5',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `article_id`, `user_id`, `rate_val`, `rate_base`, `created_at`) VALUES
(1, 1, 2, 3, 5, '2022-11-20 18:37:23'),
(2, 1, 2, 2, 5, '2022-11-20 18:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
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
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `isconfig` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_uid`, `reference_id`, `user_role`, `first_name`, `last_name`, `email`, `gender`, `picture`, `course_code`, `department_code`, `contact_number`, `created_at`, `modified`, `isconfig`, `status`) VALUES
(1, '111421296961153927711', '21200', 'Students', 'Jay', 'Reyes', 'jjreyes055@gmail.com', 'U', 'https://lh3.googleusercontent.com/a/ALm5wu1kdjKs3qyeDzIhrR55nUuTjpX_l-Hbkc4MvaGy=s96-c', 'AB', 'AEP', '09555555555', '2022-11-19 14:45:32', '2022-11-22 21:19:15', 'Y', 'Y'),
(2, '113517220591565991884', '', 'Educators', 'Jeeg', 'Saw', 'jeegsaw04@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu0wZtXY7C_3Misd7JXs7sbCDR-8tyL2K63Z9WP0=s96-c', '1', '0', '', '2022-11-19 14:46:01', '0000-00-00 00:00:00', 'N', 'Y'),
(3, '105284222278475222344', '', 'Educators', 'Carl', 'Reyes', 'reyescarlarol08@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ALm5wu2R_hWXWZUM8Af4HE1Sdnk79tV0cp_TQvcOze23=s96-c', '0', '0', '', '2022-11-19 14:46:58', '0000-00-00 00:00:00', 'N', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_list`
--
ALTER TABLE `author_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_code` (`cat_code`);

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_likes`
--
ALTER TABLE `no_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `author_list`
--
ALTER TABLE `author_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE `citations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `no_likes`
--
ALTER TABLE `no_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
