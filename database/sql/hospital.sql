-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 05:42 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
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
(3, '2018_10_03_141011_create_patients_table', 1),
(4, '2018_10_03_142801_create_stations_table', 1),
(5, '2018_10_03_143426_create_visits_table', 1);

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
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `card_id` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `firstname`, `lastname`, `hn`, `dob`, `age`, `gender`, `card_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'อลัน', 'วอคเกอร์', '001', '1995-09-19', 23, 1, '0000000000001', 1, '2018-10-05 17:00:00', '2018-10-05 17:00:00'),
(4, 'macus', 'adom', '777', '1994-01-01', 24, 0, '0000000000002', 2, '2018-10-07 19:51:27', '2018-10-07 19:51:27'),
(5, 'gun', 'rose', '07-15-224', '2018-10-08', 0, 0, '0000000000003', 3, '2018-10-08 15:03:34', '2018-10-08 15:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `station_id` int(10) UNSIGNED NOT NULL,
  `station_name_th` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `station_name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `station_description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`station_id`, `station_name_th`, `station_name_en`, `station_description`, `created_at`, `updated_at`) VALUES
(2, 'ห้องตรวจอายุรกรรม', NULL, NULL, NULL, NULL),
(3, 'ห้องตรวจกุมาร(เด็ก)', NULL, NULL, NULL, NULL),
(4, 'ห้องตรวจศัลยกรรม', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'root', 'root@gmail.com', '$2y$10$ZJIPhSCvgIEyHR7WDMDEs.0zP1GRsmFN.GplU.df1KFOteqip12ma', 1, 'UgsHZAQfJGynAs2yhV0CBRzwTUZsiKUoRTdoBJ6uom9OFWv4L3ogGyTGXNfE', '2018-10-02 17:00:00', '2018-10-02 17:00:00'),
(2, 'user1', 'user1@gmail.com', '$2y$10$1sDIZ9dwNDEDxF5qbB0awu7uQxTK3fdXufPentgHMUr6MQCY32pA.', 3, NULL, '2018-10-07 19:15:46', '2018-10-07 19:24:31'),
(3, 'user2', 'user2@gmail.com', '$2y$10$TPQ1Gp9.bozEXuTHxMkVj.E9ZhDnO2t7EU63mDgFtvVOBKziCWdlK', 3, NULL, '2018-10-08 15:01:36', '2018-10-08 15:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(10) UNSIGNED NOT NULL,
  `visit_order` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `station_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `finish` int(11) NOT NULL,
  `reser` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visit_id`, `visit_order`, `user_id`, `station_id`, `created_at`, `updated_at`, `finish`, `reser`, `date`) VALUES
(6, 1, 1, 2, '2018-10-06 20:07:54', '2018-10-07 00:15:01', 1, 0, '2018-10-07'),
(13, 2, 1, 2, '2018-10-07 00:22:56', '2018-10-07 00:30:27', 1, 0, '2018-10-07'),
(14, 3, 1, 2, '2018-10-07 00:31:31', '2018-10-07 00:32:03', 1, 0, '2018-10-07'),
(18, 1, 2, 2, '2018-10-08 14:48:52', '2018-10-08 14:50:25', 1, 0, '2018-10-08'),
(19, 1, 2, 4, '2018-10-08 14:50:52', '2018-10-08 14:54:34', 1, 0, '2018-10-08'),
(20, 2, 1, 4, '2018-10-08 14:51:33', '2018-10-08 14:51:33', 0, 0, '2018-10-08'),
(21, 3, 2, 4, '2018-10-08 15:05:41', '2018-10-08 15:05:41', 0, 0, '2018-10-08');

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
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `patients_user_id_foreign` (`user_id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `visits_user_id_foreign` (`user_id`),
  ADD KEY `visits_station_id_foreign` (`station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `station_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`station_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
