-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2020 at 10:01 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `huddleup`
--

-- --------------------------------------------------------

--
-- Table structure for table `huddleup_alerts`
--

CREATE TABLE `huddleup_alerts` (
  `id` int(5) NOT NULL,
  `team_id` int(5) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huddleup_alerts`
--

INSERT INTO `huddleup_alerts` (`id`, `team_id`, `status`, `description`) VALUES
(1, 1, 3, 'NEw Alert From Team 1');

-- --------------------------------------------------------

--
-- Table structure for table `huddleup_comments`
--

CREATE TABLE `huddleup_comments` (
  `id` int(5) NOT NULL,
  `post_id` int(5) DEFAULT NULL,
  `commenter_id` int(5) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huddleup_comments`
--

INSERT INTO `huddleup_comments` (`id`, `post_id`, `commenter_id`, `description`) VALUES
(1, 1, 2, 'test'),
(2, NULL, 1, 'sdfsdf qe erw'),
(3, 1, 1, 'asd erwer'),
(4, 1, 1, 'hello'),
(5, 1, 1, 'cool'),
(6, 1, 1, 'hello'),
(7, 1, NULL, 'sure'),
(8, 1, NULL, 'hello'),
(9, 2, NULL, 'ah'),
(10, 2, NULL, 'oh yes'),
(11, 2, 1, 'hi'),
(12, 2, 1, 'cool'),
(13, 1, 1, 'nice'),
(14, 3, 1, 'sure'),
(15, 4, 1, 'oh yea');

-- --------------------------------------------------------

--
-- Table structure for table `huddleup_huddleups`
--

CREATE TABLE `huddleup_huddleups` (
  `id` int(5) NOT NULL,
  `team_id` int(5) DEFAULT NULL,
  `title` text,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huddleup_huddleups`
--

INSERT INTO `huddleup_huddleups` (`id`, `team_id`, `title`, `status`) VALUES
(1, 1, 'Yes yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `huddleup_posts`
--

CREATE TABLE `huddleup_posts` (
  `id` int(5) NOT NULL,
  `team_id` int(5) DEFAULT NULL,
  `description` text,
  `op_user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `huddleup_posts`
--

INSERT INTO `huddleup_posts` (`id`, `team_id`, `description`, `op_user_id`) VALUES
(1, 1, 'Hello', 1),
(2, 1, 'Hello', 1),
(3, 2, 'Hello', 1),
(4, 2, 'Hello', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(5) NOT NULL,
  `team_name` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`) VALUES
(1, 'Team 1'),
(2, 'Team 2');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(5) NOT NULL,
  `team_id` int(5) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'asdasd sdfsdf', 'mccano@protonmail.com', NULL, '$2y$10$b4IyKs/WQWSsnQSEX.eLtObIAENwhRUaZWSPZ2ZxCpu244kWNd/0m', NULL, '2020-08-02 02:12:44', '2020-08-02 02:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(5) NOT NULL,
  `full_name` text,
  `profile_pic` text,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `full_name`, `profile_pic`, `user_id`) VALUES
(1, 'Robert Perez', NULL, 1),
(2, 'Bear Grylles', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `huddleup_alerts`
--
ALTER TABLE `huddleup_alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `huddleup_comments`
--
ALTER TABLE `huddleup_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `huddleup_huddleups`
--
ALTER TABLE `huddleup_huddleups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `huddleup_posts`
--
ALTER TABLE `huddleup_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `huddleup_alerts`
--
ALTER TABLE `huddleup_alerts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `huddleup_comments`
--
ALTER TABLE `huddleup_comments`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `huddleup_huddleups`
--
ALTER TABLE `huddleup_huddleups`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `huddleup_posts`
--
ALTER TABLE `huddleup_posts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
