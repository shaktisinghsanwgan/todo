-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2019 at 11:15 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_23_175954_create_tasks_table', 1),
(4, '2019_12_23_180112_create_sub_tasks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_tasks`
--

CREATE TABLE `sub_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `sub_task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_task_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_task_timeline` datetime DEFAULT NULL,
  `sub_task_completed_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_tasks`
--

INSERT INTO `sub_tasks` (`id`, `task_id`, `sub_task_name`, `sub_task_description`, `sub_task_timeline`, `sub_task_completed_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'this is a new task defined', '<p>this is a new task</p>', '2019-10-10 10:10:00', '2019-12-12 12:25:00', '2019-12-24 15:32:13', '2019-12-25 02:36:04'),
(3, 1, 'this is third task', '<p>this is third task</p>', '2019-02-12 10:10:00', '2019-12-12 15:23:00', '2019-12-24 15:43:23', '2019-12-25 02:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task_assignee` int(11) DEFAULT NULL,
  `task_creator` int(11) DEFAULT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_line` datetime NOT NULL,
  `task_completed_at` datetime DEFAULT NULL,
  `task_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_status` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'incomplete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `task_assignee`, `task_creator`, `task_name`, `time_line`, `task_completed_at`, `task_description`, `task_status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'this is a new task detail', '2019-10-10 10:10:00', '2019-12-15 15:26:00', '<p>this is a new task</p>', 'complete', '2019-12-24 15:31:54', '2019-12-25 04:08:34'),
(5, 7, 1, 1, 'shakti', '2019-10-10 10:12:00', NULL, '<p>sadf</p>', 'incomplete', '2019-12-25 03:34:14', '2019-12-25 04:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
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

INSERT INTO `users` (`id`, `name`, `user_type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$K/ofUqfVD80B5XqMRbctSeYq39HLOm9ZUaKyhZCdf2zEDTxYMSBoS', 'XioPOuu2JekKgSaDaUTivOgTNn0xu6VZZe8lQGCifsqHYlDHw1rHtvrg4nDj', '2019-12-23 14:34:49', '2019-12-23 14:34:49'),
(2, 'Ram Mohan', 'colleagues', 'codespoc@gmail.com', NULL, '$2y$10$lY5AiQuXT3V/GwLTIogkn.ifgHAmsUW5uHrME3ZMI/nuDRijNkXE2', NULL, '2019-12-23 23:14:26', '2019-12-23 23:43:26'),
(7, 'ravi', 'colleagues', 'ravi@gmail.com', NULL, '$2y$10$IwLD6u7KzPgxUp9jalGFfOQKANvubnVtMuIe2mikhrV28il1oK.mW', NULL, '2019-12-25 00:46:22', '2019-12-25 00:51:15'),
(8, 'rahul', 'assignee', 'rahul@gmail.com', NULL, '$2y$10$fXQWmuVCYRDN5jVAAmHywe.DJOkjfQK6FB3zgKuoO0At8sW8VVGqm', NULL, '2019-12-25 03:44:22', '2019-12-25 03:44:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sub_tasks`
--
ALTER TABLE `sub_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_tasks`
--
ALTER TABLE `sub_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
