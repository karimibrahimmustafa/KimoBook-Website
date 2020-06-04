-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2020 at 03:12 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kimobook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comments_id_unique` (`id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments_user_foreign` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user`, `text`, `created_at`, `updated_at`) VALUES
(3, '4', '1', 'kimo ya gamed', '2020-01-26 18:02:02', '2020-01-26 18:02:02'),
(4, '3', '1', 'ايه القمر ده ', '2020-01-26 18:23:12', '2020-01-26 18:23:12'),
(6, '1', '1', 'عسل منور', '2020-01-26 18:25:27', '2020-01-26 18:25:27'),
(7, '1', '1', 'حلوة قوي', '2020-01-26 18:26:35', '2020-01-26 18:26:35'),
(8, '1', '1', 'ايه القمر ده', '2020-01-26 18:28:30', '2020-01-26 18:28:30'),
(11, '5', '1', 'اللهم قوي ايمانك', '2020-01-27 10:09:42', '2020-01-27 10:09:42'),
(12, '4', '1', 'عسل', '2020-01-27 10:11:44', '2020-01-27 10:11:44'),
(13, '14', '3', 'هي حصلت شاكوش كمان ', '2020-01-28 16:27:12', '2020-01-28 16:27:12'),
(14, '14', '1', 'مين المعلم شاكوش؟', '2020-01-28 16:27:47', '2020-01-28 16:27:47'),
(15, '12', '3', 'الأسطورة', '2020-01-29 10:18:07', '2020-01-29 10:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
CREATE TABLE IF NOT EXISTS `details` (
  `about` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `study` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `work` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `hobbies` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `mail` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `details_id_unique` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`about`, `id`, `address`, `study`, `work`, `hobbies`, `phone`, `state`, `date`, `mail`, `created_at`, `updated_at`) VALUES
('بسم الله الرحمن الرحيم ', '1', 'alexandria egypt', 'faculty of engineering ', 'مدرسة الحياة', 'الرياضة والسباحة', '01271397096', '0', '19 October, 1997', 1, '2019-11-16 12:35:30', '2020-01-28 13:29:31'),
('none', '2', 'none', 'none', 'none', 'none', 'none', '0', 'none', 0, '2019-11-16 12:36:30', '2019-11-16 12:36:30'),
('يا رب أحفظ أولادي', '3', 'اسكندرية', 'ليسانس أداب علم نفس', 'في المنزل', 'الرياضة', '01271398297', '2', '19 October, 1997', 1, '2019-11-16 12:37:30', '2020-01-28 14:00:37'),
('الثانية علي الخنساء', '4', 'ش12 المهندسين', 'مدرسة الخنساء', 'فراشة ودكتورة بعد الظهر', 'السباحة وركوب الخيل', '01214161518', '0', '14 September, 2006', 0, '2020-01-27 11:54:42', '2020-01-28 13:33:08'),
('none', '5', 'none', 'none', 'none', 'none', 'none', '0', 'none', 0, '2020-01-27 12:53:06', '2020-01-27 12:53:06'),
('العلم في الراس مش في الكراس', '6', 'اسكندرية', 'كلية الصيدلة جامعة اسكندرية', 'لا يوجد', 'كرة القدم والبلايستيشن', '033326798', '0', '13 March, 2000', 1, '2020-01-27 13:16:06', '2020-01-28 16:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keys` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upload/DefaultCover.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `likes_id_unique` (`id`),
  KEY `likes_post_id_foreign` (`post_id`),
  KEY `likes_user_foreign` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user`, `type`, `created_at`, `updated_at`) VALUES
(1, '5', '3', '2', '2020-01-26 19:23:29', '2020-01-26 19:23:29'),
(2, '4', '3', '2', '2020-01-26 19:48:54', '2020-01-26 19:50:03'),
(6, '4', '1', '2', '2020-01-26 20:06:07', '2020-01-26 20:06:07'),
(7, '5', '1', '2', '2020-01-26 20:08:32', '2020-01-26 20:08:32'),
(8, '1', '1', '2', '2020-01-26 20:08:44', '2020-01-26 20:08:44'),
(9, '3', '1', '2', '2020-01-27 10:03:03', '2020-01-27 10:03:03'),
(11, '2', '1', '2', '2020-01-27 10:09:02', '2020-01-27 10:09:05'),
(12, '8', '1', '2', '2020-01-27 14:01:51', '2020-01-27 14:01:51'),
(13, '15', '3', '2', '2020-01-28 14:09:25', '2020-01-28 14:09:25'),
(14, '16', '1', '2', '2020-01-28 14:20:24', '2020-01-28 14:20:24'),
(15, '15', '1', '2', '2020-01-28 14:20:28', '2020-01-28 14:20:28'),
(16, '14', '4', '2', '2020-01-28 16:25:08', '2020-01-28 16:25:08'),
(17, '14', '3', '3', '2020-01-28 16:25:49', '2020-01-28 16:25:49'),
(18, '14', '1', '4', '2020-01-28 16:27:36', '2020-01-28 16:27:36'),
(19, '17', '1', '2', '2020-01-28 16:55:31', '2020-01-28 16:55:31'),
(20, '12', '3', '2', '2020-01-29 09:54:40', '2020-01-29 09:54:40'),
(21, '10', '3', '2', '2020-01-29 12:37:47', '2020-01-29 12:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `from_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `messages_from_id_foreign` (`from_id`),
  KEY `messages_to_id_foreign` (`to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`from_id`, `to_id`, `image`, `text`, `read`, `created_at`, `updated_at`) VALUES
('1', '1', '0', 'amxtQ1RnU0xiRCtjV21ibzNFSm5GL0c1MU1MamcwM2RQSVg5MDFyZk5QUT0=', 1, '2020-01-28 14:33:12', '2020-01-28 15:26:09'),
('1', '3', '0', 'M2xJRFczcUVWTDYyRm54cHBjSUhtQWRiQ3lld250dDVocHE1ZjVLV2lGQk1YYlBXT1YwSFl4d1V6V3RVdGs1Y0NJTjdGOHNYR0ZWYWhlZ3NuSlFrOGFxNlh4cGNwL0NiMFhhZC9FY0xBYTA9', 1, '2020-01-28 14:37:42', '2020-01-28 16:24:22'),
('3', '1', '0', 'ZG5RbVdkeXpERFNMY2dLWjMrVmsvVUdiWjd6OXh1a1hqZENSZmxNL0pTTy9HMlV2dENSODR4OVNSZnAydHU3dEoxcGptakxyaThUOXRCcnBVRlNvSHc9PQ==', 1, '2020-01-28 14:43:54', '2020-01-29 11:44:11'),
('1', '3', '0', 'UFZVeFY1YmNtSDZHOXlMVXZ4V0lWa3dsNTdXYmROQjFUbThOM0JCTk4rWXU2TXpGd0tDRXNaMXFXakpwbHFFYzVMTXd2Vm13ZDJSY04rZ1ZtZ1ZRTlE9PQ==', 1, '2020-01-28 15:11:02', '2020-01-28 16:24:22'),
('1', '3', '0', 'Tk5TWlVGQTM1R3h4QTBWT3FFTXVQK3JDYm1ybkNoUHc2Rk45dFVnV1NwST0=', 1, '2020-01-28 15:43:48', '2020-01-28 16:24:22'),
('3', '1', '0', 'RXR0U1JKeEIxZmRSSnF1MjBtNkhMcVR3dHJPcHByV3RxbEJjU1ZvZEJuRT0=', 1, '2020-01-28 15:45:12', '2020-01-29 11:44:11'),
('1', '3', '0', 'OGVxdS94dFJQUy93aG1BYVhXZ09jUnJyaEMreGZJNTdBNFVlaVZkSWQ4ST0=', 1, '2020-01-28 15:47:52', '2020-01-28 16:24:22'),
('1', '3', '0', 'N1ozdmU5MEp4cG9tL05YblVQNCtlUT09', 1, '2020-01-28 16:14:33', '2020-01-28 16:24:22'),
('3', '1', '0', 'SGZhaHkrdXFxS1poSStWTTVxVTc3WEFoUmlPWG5nbCtHYmwzL0FBVWRlWT0=', 1, '2020-01-28 16:14:49', '2020-01-29 11:44:11'),
('1', '4', '0', 'SXE3dXdRRHZ3MUtkeEMzM3dkeFJxbjhFTG1wS3Z2bkhYNDFmcXdjSHJBQU82R01VeG5xb0hYVWhzVG0yT29Xcw==', 1, '2020-01-28 16:15:45', '2020-01-28 16:22:35'),
('4', '1', '0', 'bE83SmI2L1FkR3Fodmt5Z1RnYVhONFljZXZPNmZZSXVHR2ZJRXRyUWxEYjdlTExKUkZKZ2xnYkNDU0hvanVuUw==', 1, '2020-01-28 16:16:54', '2020-01-28 16:17:16'),
('3', '1', '0', 'RE5PUkJZcEtvZjcwOWxVdFR0dDRiQXFZT05LeUp4OTg4L3dveUN0bGpqaz0=', 1, '2020-01-28 16:20:03', '2020-01-29 11:44:11'),
('1', '3', '0', 'cjdNdnZ4bWRQLzEyZXlWV2dtbE0zNkFYVkYxcklHOWZGd0owTXV5RHg2OD0=', 1, '2020-01-28 16:23:05', '2020-01-28 16:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_09_133911_create_details', 1),
(4, '2019_08_10_132814_create-message', 1),
(5, '2019_08_13_133226_Create-posts', 1),
(6, '2019_08_13_144359_Create-like', 1),
(7, '2019_08_14_134240_create-notification', 1),
(8, '2019_08_14_134445_create-comment', 1),
(9, '2019_08_17_104528_create-pages', 1),
(10, '2019_08_20_133328_create_groups', 1),
(11, '2019_08_22_133504_create_product', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notifications_id_unique` (`id`),
  KEY `notifications_user_foreign` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user`, `type`, `text`, `post_id`, `from_id`, `read`, `created_at`, `updated_at`) VALUES
(1, '3', '3', '', '5', '1', 1, '2020-01-26 19:52:02', '2020-01-29 10:29:18'),
(2, '3', '2', '', '4', '1', 1, '2020-01-26 20:01:12', '2020-01-29 10:29:28'),
(3, '3', '6', '', '5', '1', 0, '2020-01-27 10:09:42', '2020-01-27 10:09:42'),
(4, '3', '6', '', '4', '1', 0, '2020-01-27 10:11:44', '2020-01-27 10:11:44'),
(5, '4', '2', '', '8', '1', 0, '2020-01-27 14:01:51', '2020-01-27 14:01:51'),
(6, '3', '2', '', '16', '1', 0, '2020-01-28 14:20:24', '2020-01-28 14:20:24'),
(7, '3', '2', '', '15', '1', 0, '2020-01-28 14:20:28', '2020-01-28 14:20:28'),
(8, '4', '3', '', '14', '3', 0, '2020-01-28 16:25:49', '2020-01-28 16:25:49'),
(9, '4', '6', '', '14', '3', 0, '2020-01-28 16:27:12', '2020-01-28 16:27:12'),
(10, '4', '4', '', '14', '1', 0, '2020-01-28 16:27:36', '2020-01-28 16:27:36'),
(11, '4', '6', '', '14', '1', 0, '2020-01-28 16:27:47', '2020-01-28 16:27:47'),
(12, '6', '2', '', '17', '1', 0, '2020-01-28 16:55:31', '2020-01-28 16:55:31'),
(13, '1', '2', '', '12', '3', 1, '2020-01-29 09:54:40', '2020-01-29 10:24:26'),
(14, '1', '6', '', '12', '3', 1, '2020-01-29 10:18:07', '2020-01-29 11:41:27'),
(15, '1', '2', '', '10', '3', 0, '2020-01-29 12:37:47', '2020-01-29 12:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_product_id_foreign` (`product_id`),
  KEY `offers_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keys` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upload/DefaultCover.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `admin`, `image`, `about`, `keys`, `cover`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Erza3 - ارزع', '1', 'upload\\\\pages\\\\1\\\\20479893_430762957324013_3663329712412003628_n.jpg', 'لو جاي تتفرج عشان مستني تحليل و تكتيك .. أحب أبشرك أنت في المكان الغلط .. عشان إحناه جايين نرزع !!', 'football,رزع,ارزع,كورة,رياضة', 'upload/DefaultCover.jpg', NULL, '2020-01-29 13:09:03', '2020-01-29 13:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `group_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shared` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL,
  `page` tinyint(1) NOT NULL DEFAULT '0',
  `group` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_id_unique` (`id`),
  KEY `posts_user_foreign` (`user`),
  KEY `posts_page_id_foreign` (`page_id`),
  KEY `posts_group_id_foreign` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `page_id`, `group_id`, `image`, `text`, `shared`, `read`, `page`, `group`, `created_at`, `updated_at`) VALUES
(1, '1', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\IMG_20190825_100553.jpg', 'kimo has updated his image', '0', 0, 0, 0, '2020-01-26 15:56:43', '2020-01-26 15:56:43'),
(2, '1', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\IMG_20190825_100553.jpg', 'kimo has updated his image', '0', 0, 0, 0, '2020-01-26 15:56:43', '2020-01-26 15:56:43'),
(3, '1', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\IMG_20190825_100227.jpg', 'kimo is here', '0', 0, 0, 0, '2020-01-26 17:24:03', '2020-01-26 17:24:03'),
(4, '3', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\IMG_20190825_100345.jpg', 'kimo ya kimo ya 7etet sokara', '0', 0, 0, 0, '2020-01-26 17:31:11', '2020-01-26 17:31:11'),
(5, '3', '0', '0', '', 'من كان يؤمن بالله واليوم الأخر فليقل خيرا او ليصمت', '0', 0, 0, 0, '2020-01-26 18:59:10', '2020-01-26 18:59:10'),
(8, '4', '0', '0', '', 'اشكر كل اللي وقف جنبي و خلاني اوصل للنجاح ده ', '0', 0, 0, 0, '2020-01-27 12:18:29', '2020-01-27 12:18:29'),
(9, '1', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\fc_barcelona_facebook_cover_hd_2015_16_by_selvedinfcb-d9chdre.png', 'kimo  has updated his cover', '0', 0, 0, 0, '2020-01-27 17:05:59', '2020-01-27 17:05:59'),
(10, '1', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\416x416.jpg', 'kimo  has updated his image', '0', 0, 0, 0, '2020-01-27 17:19:05', '2020-01-27 17:19:05'),
(11, '1', '0', '0', '', 'مبروك يا رودي يا روح قلبي علي النجاح ', '0', 0, 0, 0, '2020-01-27 17:21:33', '2020-01-27 17:21:33'),
(12, '1', '0', '0', 'upload\\\\kimokimo191098@gmail.com\\\\posts\\\\79198885_158163928776098_738346913027325952_o.jpg', 'Best player of the world😍😍🤩', '0', 0, 0, 0, '2020-01-28 10:49:35', '2020-01-28 10:49:35'),
(13, '4', '0', '0', 'upload\\\\kimokimo1910982@gmail.com\\\\posts\\\\images.jpg', 'rodaina has updated his cover', '0', 0, 0, 0, '2020-01-28 13:31:12', '2020-01-28 13:31:12'),
(14, '4', '0', '0', 'upload\\\\kimokimo1910982@gmail.com\\\\posts\\\\1-520-240x280.jpg', 'شاكوش المعلم😍😍', '0', 0, 0, 0, '2020-01-28 13:42:56', '2020-01-28 13:42:56'),
(15, '3', '0', '0', 'upload\\\\kimokimo191098@yahoo.com\\\\posts\\\\٢٠١٦٠٧٠٨_١٩٤٤٣٧.jpg', 'MAMA has updated his image', '0', 0, 0, 0, '2020-01-28 14:02:18', '2020-01-28 14:02:18'),
(16, '3', '0', '0', 'upload\\\\kimokimo191098@yahoo.com\\\\posts\\\\new_1423711309_437-1.jpg', 'MAMA has updated his cover', '0', 0, 0, 0, '2020-01-28 14:09:11', '2020-01-28 14:09:11'),
(17, '6', '0', '0', 'upload\\\\desha2000@gmail.com\\\\posts\\\\Real-madrid-is-my-life-fb-cover.jpg', 'Mostafa has updated his cover', '0', 0, 0, 0, '2020-01-28 16:32:00', '2020-01-28 16:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacts` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keys` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `runnig message`
--

DROP TABLE IF EXISTS `runnig message`;
CREATE TABLE IF NOT EXISTS `runnig message` (
  `from_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `runnig message_from_id_foreign` (`from_id`),
  KEY `runnig message_to_id_foreign` (`to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `runnig message`
--

INSERT INTO `runnig message` (`from_id`, `to_id`, `status`, `created_at`, `updated_at`) VALUES
('1', '3', '1', '2019-11-16 12:45:23', '2019-11-16 12:45:23'),
('1', '3', '1', '2019-11-16 13:32:02', '2019-11-16 13:32:02'),
('1', '1', '1', '2020-01-28 14:28:28', '2020-01-28 14:28:28'),
('1', '1', '1', '2020-01-28 14:29:35', '2020-01-28 14:29:35'),
('1', '1', '1', '2020-01-28 14:33:11', '2020-01-28 14:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `state_id_foreign` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'add,3,1', '2019-11-16 12:35:30', '2020-01-29 11:40:57'),
(3, 'add,1,3', '2019-11-16 12:37:30', '2020-01-29 12:22:38'),
(4, '0', '2020-01-27 11:54:42', '2020-01-27 11:54:42'),
(5, '0', '2020-01-27 12:53:06', '2020-01-27 12:53:06'),
(6, 'add,1,6', '2020-01-27 13:16:06', '2020-01-28 16:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upload/DefaultCover.jpg',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `cover`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kimo ', 'kimokimo191098@gmail.com', '$2y$10$8Z3ransb0fSM3sYA62Nd5OHjZHheshtHxTrSV7L7tUJCO3Z995tZe', 'upload\\\\kimokimo191098@gmail.com\\\\416x416.jpg', 'upload\\\\kimokimo191098@gmail.com\\\\fc_barcelona_facebook_cover_hd_2015_16_by_selvedinfcb-d9chdre.png', '0', NULL, '2019-11-16 12:35:30', '2020-01-27 17:19:05'),
(3, 'MAMA', 'kimokimo191098@yahoo.com', '$2y$10$eVZNk44XXIFwTCDRMD3qmOpB.3p4OmeAoQrt0f5L/NVInhdMRmYwq', 'upload\\\\kimokimo191098@yahoo.com\\\\٢٠١٦٠٧٠٨_١٩٤٤٣٧.jpg', 'upload\\\\kimokimo191098@yahoo.com\\\\new_1423711309_437-1.jpg', '0', NULL, '2019-11-16 12:37:30', '2020-01-28 14:09:11'),
(4, 'rodaina', 'kimokimo1910982@gmail.com', '$2y$10$ZVOtQNiiYSDqEhry3SdibuVFxgVHGYPytOUe6VV6D62/JihEYcA1y', 'upload\\\\kimokimo1910982@gmail.com\\\\IMG_20190825_100345.jpg', 'upload\\\\kimokimo1910982@gmail.com\\\\images.jpg', '0', NULL, '2020-01-27 11:54:42', '2020-01-28 13:31:12'),
(5, 'Ibrahim ', 'kimokimo1910983@gmail.com', '$2y$10$rWvQtPQ5rInAMs3rGiEgYuyvG1Wix3RvJyfGBnry78Oi80C40c52G', 'upload\\\\kimokimo1910983@gmail.com\\\\IMG_20190825_100159.jpg', 'upload/DefaultCover.jpg', '0', NULL, '2020-01-27 12:53:05', '2020-01-27 12:53:05'),
(6, 'Mostafa', 'desha2000@gmail.com', '$2y$10$P2mo2//IcQwCnsIppuZLnuFiDU5O6qZrVLOt68ePBcw5cA/gxEKga', 'upload\\\\desha2000@gmail.com\\\\IMG_20190825_100244.jpg', 'upload\\\\desha2000@gmail.com\\\\Real-madrid-is-my-life-fb-cover.jpg', '0', NULL, '2020-01-27 13:16:06', '2020-01-28 16:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `userwait`
--

DROP TABLE IF EXISTS `userwait`;
CREATE TABLE IF NOT EXISTS `userwait` (
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL,
  KEY `userwait_user1_id_foreign` (`user1_id`),
  KEY `userwait_user2_id_foreign` (`user2_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userwait`
--

INSERT INTO `userwait` (`user1_id`, `user2_id`) VALUES
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_follow`
--

DROP TABLE IF EXISTS `user_follow`;
CREATE TABLE IF NOT EXISTS `user_follow` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `user_follow_page_id_foreign` (`page_id`),
  KEY `user_follow_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `user_group_group_id_foreign` (`group_id`),
  KEY `user_group_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_group_add`
--

DROP TABLE IF EXISTS `user_group_add`;
CREATE TABLE IF NOT EXISTS `user_group_add` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `user_group_add_group_id_foreign` (`group_id`),
  KEY `user_group_add_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_page`
--

DROP TABLE IF EXISTS `user_page`;
CREATE TABLE IF NOT EXISTS `user_page` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `user_page_page_id_foreign` (`page_id`),
  KEY `user_page_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_user`
--

DROP TABLE IF EXISTS `user_user`;
CREATE TABLE IF NOT EXISTS `user_user` (
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL,
  KEY `user_user_user1_id_foreign` (`user1_id`),
  KEY `user_user_user2_id_foreign` (`user2_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_user`
--

INSERT INTO `user_user` (`user1_id`, `user2_id`) VALUES
(1, 3),
(3, 1),
(4, 1),
(1, 4),
(5, 1),
(1, 5),
(4, 3),
(3, 4),
(1, 6),
(6, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
