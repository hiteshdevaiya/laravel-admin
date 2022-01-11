-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 03:49 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_13_122218_create_application_modules_table', 2),
(5, '2020_03_13_122218_create_modules_table', 3),
(6, '2020_03_06_101430_create_user_role_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Module 1', '2020-09-14 18:30:00', '2021-11-12 11:36:13', NULL),
(2, 'Module 2', '2021-10-22 23:28:57', '2021-11-12 11:36:26', NULL),
(3, 'Module 3', '2021-10-22 23:29:15', '2021-11-12 11:36:36', NULL),
(4, 'Module 4', '2021-10-22 23:52:32', '2021-11-12 11:36:54', NULL),
(5, 'Module 5', '2021-10-26 21:09:58', '2021-11-12 11:37:04', NULL),
(6, 'Module 6', '2021-10-26 21:32:10', '2021-11-12 11:37:34', NULL),
(7, 'Module 7', '2021-10-30 09:41:42', '2021-11-12 11:37:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 1, '2021-10-26 21:41:02', '2021-11-12 11:38:13', NULL),
(2, 'Client', 1, '2021-10-30 01:29:03', '2021-11-12 11:38:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_access_modules`
--

CREATE TABLE `role_access_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `access` tinyint(1) NOT NULL DEFAULT 0,
  `create` tinyint(1) NOT NULL DEFAULT 0,
  `edit` tinyint(1) NOT NULL DEFAULT 0,
  `delete` tinyint(1) NOT NULL DEFAULT 0,
  `view` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_access_modules`
--

INSERT INTO `role_access_modules` (`id`, `role_id`, `module_id`, `access`, `create`, `edit`, `delete`, `view`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2021-10-30 09:32:56', '2021-11-12 11:40:18', NULL),
(2, 1, 7, 1, 1, 1, 1, 1, '2021-10-30 09:43:09', '2021-11-12 11:40:29', NULL),
(3, 2, 7, 1, 0, 0, 0, 0, '2021-10-30 10:00:06', '2021-10-30 10:00:06', NULL),
(4, 2, 1, 1, 1, 1, 1, 1, '2021-10-30 23:04:49', '2021-10-30 23:05:00', NULL),
(5, 1, 2, 1, 1, 1, 1, 1, '2021-11-12 11:40:03', '2021-11-12 11:40:18', NULL),
(6, 1, 3, 1, 1, 1, 1, 1, '2021-11-12 11:40:03', '2021-11-12 11:40:17', NULL),
(7, 1, 4, 1, 1, 1, 1, 1, '2021-11-12 11:40:04', '2021-11-12 11:40:16', NULL),
(8, 1, 5, 1, 1, 1, 1, 1, '2021-11-12 11:40:07', '2021-11-12 11:40:23', NULL),
(9, 1, 6, 1, 1, 1, 1, 1, '2021-11-12 11:40:24', '2021-11-12 11:40:30', NULL),
(10, 2, 2, 1, 1, 0, 0, 0, '2021-11-12 11:40:45', '2021-11-12 11:40:46', NULL),
(11, 2, 3, 1, 0, 0, 0, 1, '2021-11-12 11:40:48', '2021-11-12 11:40:49', NULL),
(12, 2, 5, 1, 0, 1, 0, 0, '2021-11-12 11:40:50', '2021-11-12 11:40:54', NULL),
(13, 2, 4, 1, 0, 1, 0, 0, '2021-11-12 11:40:51', '2021-11-12 11:40:55', NULL),
(14, 2, 6, 1, 1, 0, 0, 0, '2021-11-12 11:40:52', '2021-11-12 11:40:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GENERAL', '{\"system_name\":\"test\",\"system_mail\":\"test@gmail.com\",\"system_phone\":\"123456\",\"date_format\":\"d-m-Y\",\"address_1\":\"test 1\",\"address_2\":\"test2\",\"large_logo\":\"\",\"small_logo\":\"\"}', '2022-01-01 23:15:59', '2022-01-02 00:02:44', NULL),
(2, 'SMTP', '{\"mail_driver\":\"test\",\"mail_host\":\"mail.shotgun.org\",\"mail_port\":\"587\",\"mail_username\":\"test\",\"mail_password\":\"12345test\",\"mail_encryption\":\"tls\"}', '2022-01-01 23:20:23', '2022-01-01 23:20:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings_old`
--

CREATE TABLE `settings_old` (
  `id` int(11) NOT NULL,
  `system_name` varchar(255) DEFAULT NULL,
  `system_mail` varchar(255) DEFAULT NULL,
  `system_phone` varchar(255) DEFAULT NULL,
  `date_format` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `large_logo` varchar(255) DEFAULT NULL,
  `small_logo` varchar(255) DEFAULT NULL,
  `mail_driver` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_old`
--

INSERT INTO `settings_old` (`id`, `system_name`, `system_mail`, `system_phone`, `date_format`, `address_1`, `address_2`, `large_logo`, `small_logo`, `mail_driver`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'stockful', 'system@gmail.com', '12345644', 'd-m-Y', 'test 1', 'address line 2', NULL, NULL, 'test', 'mail.shotgun.org', '5987', 'test', '12345test', 'TLS', '2021-11-13 13:29:28', '2021-11-14 03:23:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `color`, `task_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'active', NULL, NULL, '2021-11-01 16:37:16', NULL, NULL),
(2, 'deactive', NULL, NULL, '2021-11-01 16:37:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HITESH RASHIKBHAI DEVAIYA', 'admin@gmail.com', NULL, '$2y$10$WDLXORMCJF4rt6GM2YgJ9uARzUvJEm1E1Wzb4ssYnDKGHvyGv7JtG', NULL, 1, 0, '2021-06-26 03:34:14', '2021-06-26 03:34:14', NULL),
(3, 'test', 'test@gmail.com', NULL, '123', NULL, 1, 0, '2021-11-10 13:16:35', '2021-11-14 01:51:59', NULL),
(4, 'test cliennt', 'testcliet@gmail.com', NULL, '123456', NULL, 2, 0, '2021-11-12 11:41:33', '2021-11-12 11:41:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_modules`
--

CREATE TABLE `user_access_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `access` tinyint(1) NOT NULL DEFAULT 0,
  `create` tinyint(1) NOT NULL DEFAULT 0,
  `edit` tinyint(1) NOT NULL DEFAULT 0,
  `delete` tinyint(1) NOT NULL DEFAULT 0,
  `view` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_access_modules`
--

INSERT INTO `user_access_modules` (`id`, `user_id`, `module_id`, `access`, `create`, `edit`, `delete`, `view`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 0, 0, 0, 0, '2021-10-31 02:00:49', '2021-10-31 02:00:49', NULL),
(2, 1, 3, 0, 0, 1, 0, 0, '2021-10-31 02:00:57', '2021-10-31 02:00:57', NULL),
(3, 1, 4, 0, 1, 0, 0, 0, '2021-10-31 02:09:35', '2021-10-31 02:09:35', NULL),
(4, 2, 1, 1, 1, 0, 0, 0, NULL, NULL, NULL),
(5, 2, 7, 1, 0, 0, 1, 0, NULL, NULL, NULL),
(6, 3, 1, 1, 1, 0, 0, 0, NULL, NULL, NULL),
(7, 3, 7, 1, 0, 0, 1, 0, NULL, NULL, NULL),
(8, 4, 7, 1, 1, 1, 1, 1, NULL, '2021-11-12 11:41:56', NULL),
(9, 4, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(10, 4, 2, 1, 1, 0, 0, 0, NULL, NULL, NULL),
(11, 4, 3, 1, 0, 0, 0, 1, NULL, NULL, NULL),
(12, 4, 5, 1, 0, 1, 0, 0, NULL, NULL, NULL),
(13, 4, 4, 1, 0, 1, 0, 0, NULL, NULL, NULL),
(14, 4, 6, 1, 1, 0, 0, 0, NULL, NULL, NULL),
(15, 3, 6, 0, 1, 0, 0, 0, '2021-11-12 11:42:04', '2021-11-12 11:42:04', NULL),
(16, 3, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(17, 3, 7, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(18, 3, 2, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(19, 3, 3, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(20, 3, 4, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(21, 3, 5, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(22, 3, 6, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(23, 3, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(24, 3, 7, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(25, 3, 2, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(26, 3, 3, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(27, 3, 4, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(28, 3, 5, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(29, 3, 6, 1, 1, 1, 1, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access_modules`
--
ALTER TABLE `role_access_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_old`
--
ALTER TABLE `settings_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_access_modules`
--
ALTER TABLE `user_access_modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_access_modules`
--
ALTER TABLE `role_access_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings_old`
--
ALTER TABLE `settings_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_access_modules`
--
ALTER TABLE `user_access_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
