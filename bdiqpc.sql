-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 11:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS bdiqpc;
USE bdiqpc;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdiqpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `subject`, `message`, `admin_reply`, `created_at`, `is_read`) VALUES
(1, 9, 'ঐ শালা', 'মার খাবি ?', NULL, '2025-08-31 10:29:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `contest_type` enum('practice','mock') NOT NULL,
  `duration_minutes` int(11) DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`id`, `title`, `description`, `contest_type`, `duration_minutes`, `created_by`, `created_at`, `is_active`) VALUES
(1, 'Test-1', 'A test', 'mock', 5, 1, '2025-08-31 05:44:30', 1),
(2, 'BDIQPC - 2025 - 1', 'It is Try to them', 'mock', 1, 1, '2025-08-31 10:31:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `recipient_id` int(11) DEFAULT NULL COMMENT 'NULL means notice for all users',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL COMMENT '1-4',
  `marks` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `contest_id`, `question_text`, `option1`, `option2`, `option3`, `option4`, `correct_option`, `marks`) VALUES
(1, 1, 'Question 1', 'a', 'b', 'c', 'd', 1, 1),
(2, 1, 'Question 2', 'a', 'b', 'c', 'd', 2, 1),
(3, 2, 'Question 1', '1', '2', '3', '4', 1, 1),
(4, 2, 'Question 2', '1', '2', '3', '4', 2, 1),
(5, 2, 'Question 3', '1', '2', '3', '45', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remember_tokens`
--

INSERT INTO `remember_tokens` (`id`, `user_id`, `token`, `expires_at`) VALUES
(1, 2, '73491ff763601fc0bdff572227a905f750cc75f2c6cd6a0a1784c83398be3eab', '2025-09-27 11:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `banglaname` varchar(225) NOT NULL,
  `englishname` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `englishinstitute` varchar(255) NOT NULL,
  `banglainstitute` varchar(255) NOT NULL,
  `class` varchar(20) NOT NULL,
  `category` varchar(255) NOT NULL,
  `contest` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `transction` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `banglaname`, `englishname`, `password`, `email`, `full_name`, `phone`, `address`, `role`, `created_at`, `englishinstitute`, `banglainstitute`, `class`, `category`, `contest`, `gender`, `dob`, `transction`) VALUES
(1, '100000', '', '', '$2y$10$2ZGrSHo4FzPwDRJdM7tjDeGwzR45LoxOV4LgWy0Fxq926oDFddHK2', 'admin@example.com', 'Administrator', NULL, NULL, 'admin', '2025-08-28 09:52:19', '', '', '', '', '', '', NULL, ''),
(2, '100001', '', '', '$2y$10$2ZGrSHo4FzPwDRJdM7tjDeGwzR45LoxOV4LgWy0Fxq926oDFddHK2', 'krikelq@gmail.com', 'Krikel Tripura', '01606886646', 'Lama, Bandhorban, Chittagong, Bangladesh\r\nKhagrachari', 'user', '2025-08-28 09:53:13', '', '', '', '', '', '', NULL, ''),
(3, '100005', 'Krikel Tripura', 'Krikel Tripura', '$2y$10$wsbQcg.doxpoPI4txur2e.89lnHfyEpda40/EcpV3NXsnvQEFRxHq', 'krik@gmail.com', NULL, '01606886646', 'dhaka/dhaka/dohar', 'user', '2025-08-30 10:20:06', 'Quan', 'Quan', '6', 'Junior', 'programming', 'male', '1111-01-01', ''),
(4, '100006', 'Krikel Tripura', 'Krikel Tripura', '$2y$10$kWHD1msN57Dn09fwcSy7BuMzeXMMvecmW6k3hwj4BiylvLe0AQMsq', 'q@gmail.com', NULL, '01606886646', 'dhaka/dhaka/dhamrai', 'user', '2025-08-30 10:39:39', 'Quan', 'Quan', '9', 'Junior', 'programming', 'male', '1111-01-01', ''),
(5, '100007', 'আব্দুল কাদের জিলানী', 'Abdul Kader Jilani', '$2y$10$l1FgyFDR/BYHXbfHqLC9ZO6JLtBcEKXVclk6.J5e.08C4FdDvuiHG', 'abdulkaderq1774@gmail.com', NULL, '01739175589', 'dhaka,dhaka,savar', 'user', '2025-08-31 04:55:26', 'কোয়ান্টাম কোসমো স্কুল ও কলেজ', 'Quantum Cosmo School & College', '9', 'Junior', 'programming', 'male', '2011-06-08', ''),
(6, '100008', 'Krikel Tripura', 'Krikel Tripura', '$2y$10$q/yTxpbl4HABrCRECJQF4u2ZjHGn8TK3qNLncOGmm7SCIBhwbVSMe', 'q@q.com', NULL, '01606886646', 'dhaka,gazipur,kaliakair', 'user', '2025-08-31 09:39:09', 'Quantum Cosmo School & College', 'কোয়ান্টাম কোসমো স্কুল ও কলেজ', '11', 'Senior', 'programming', 'male', '2011-01-01', ''),
(7, '100009', 'asdf', 'asdf', '$2y$10$g1AQMv27/M4U..0/0EWWU.L3mbUdPELDKbFGSgtlQJcgiXHPgLRkC', 'aa@a.com', NULL, '01606886646', 'dhaka,dhaka,keraniganj', 'user', '2025-08-31 09:41:34', 'Quantum Cosmo School & College', 'কোয়ান্টাম কোসমো স্কুল ও কলেজ', '6', 'Junior', 'programming', 'male', '0001-01-01', ''),
(8, '100010', 'Krikel Tripura', 'Krikel Tripura', '$2y$10$Dzl29ANbZQWe2qteNOKzTuAYF.cIeeboTRQy.Qoel2nsJb6DCK1lq', 'lq@gmail.com', NULL, '01606886646', 'dhaka,dhaka,dohar', 'user', '2025-08-31 09:44:54', 'Quantum Cosmo School & College', 'কোয়ান্টাম কোসমো স্কুল ও কলেজ', '7', 'Junior', 'programming', 'male', '0111-01-11', '152542'),
(9, '100011', 'sdgvh', 'jksdgj', '$2y$10$PHnTiwvMjPW.z9i/MVW/WOJMj7PP7Ov2YydgL7NdIakg7r1dNlKti', 'b@b.com', NULL, '65456', 'dhaka,dhaka,dhamrai', 'user', '2025-08-31 10:27:48', 'jfhkjg', 'djh', '10', 'Junior', 'programming', 'female', '2000-12-12', '51564131'),
(10, '100012', 'Krikel Tripura', 'Krikel Tripura', '$2y$10$AW90BCiLGK43p79HcqUca.a/Pc5S6T6HZwqbwkHvF1xHbOf1pCfdi', 'elq@gmail.com', NULL, '01606886646', 'dhaka,dhaka,dohar', 'user', '2025-09-01 09:47:10', 'asdf', 'asdf', '6', 'Junior', 'programming', 'male', '0111-02-01', '55');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` int(11) DEFAULT NULL COMMENT '1-4',
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `attempt_id`, `question_id`, `selected_option`, `is_correct`) VALUES
(1, 1, 1, 4, 0),
(2, 1, 2, 2, 1),
(3, 2, 1, 3, 0),
(4, 2, 2, 3, 0),
(5, 3, 3, 1, 1),
(6, 3, 4, 2, 1),
(7, 3, 5, 1, 0),
(8, 4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_attempts`
--

CREATE TABLE `user_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `time_taken_seconds` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_attempts`
--

INSERT INTO `user_attempts` (`id`, `user_id`, `contest_id`, `start_time`, `end_time`, `score`, `time_taken_seconds`) VALUES
(1, 2, 1, '2025-08-31 10:24:58', '2025-08-31 10:25:06', 1, 8),
(2, 9, 1, '2025-08-31 10:28:50', '2025-08-31 10:28:54', 0, 4),
(3, 9, 2, '2025-08-31 10:34:06', '2025-08-31 10:35:40', 2, 94),
(4, 2, 2, '2025-08-31 10:36:14', '2025-08-31 10:37:14', 1, 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contest_id` (`contest_id`);

--
-- Indexes for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `user_attempts`
--
ALTER TABLE `user_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `contest_id` (`contest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_attempts`
--
ALTER TABLE `user_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contests`
--
ALTER TABLE `contests`
  ADD CONSTRAINT `contests_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notices_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD CONSTRAINT `remember_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `user_attempts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `user_attempts`
--
ALTER TABLE `user_attempts`
  ADD CONSTRAINT `user_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_attempts_ibfk_2` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
