-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 04:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `undanganku`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_func_category_id` bigint(20) UNSIGNED NOT NULL,
  `bank_master_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_func_category_id`, `bank_master_id`, `user_id`, `number`, `name`, `currency_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '12345678', 'Yusuf Rahmanto', 1, 'Y', '2021-11-28 04:22:30', '2021-11-28 04:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `bank_func_categories`
--

CREATE TABLE `bank_func_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_func_categories`
--

INSERT INTO `bank_func_categories` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'PAYMENT', 'Untuk payment', '2021-11-28 04:20:11', '2021-11-28 04:20:12'),
(2, 'DONATION', 'Untuk donasi user', '2021-11-28 04:20:26', '2021-11-28 04:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `bank_masters`
--

CREATE TABLE `bank_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_masters`
--

INSERT INTO `bank_masters` (`id`, `code`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'Bank Central Asia', 'bank_bca_icon.svg', '2021-11-28 04:18:05', '2021-11-28 04:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `brides`
--

CREATE TABLE `brides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brides`
--

INSERT INTO `brides` (`id`, `user_id`, `gender`, `name`, `nickname`, `photo`, `about`, `father`, `mother`, `created_at`, `updated_at`) VALUES
(3, 1, 'L', '', '', NULL, NULL, '', '', '2021-11-28 05:17:54', '2021-11-28 05:17:54'),
(4, 1, 'P', '', '', NULL, NULL, '', '', '2021-11-28 05:17:54', '2021-11-28 05:17:54'),
(5, 8, 'L', '', '', NULL, NULL, '', '', '2021-12-26 10:00:16', '2021-12-26 10:00:16'),
(6, 8, 'P', '', '', NULL, NULL, '', '', '2021-12-26 10:00:16', '2021-12-26 10:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IDR', 'Indonesia Rupiah', '2021-11-28 04:19:10', '2021-11-28 04:19:10'),
(2, 'USD', 'US Dollar', '2021-11-28 04:19:50', '2021-11-28 04:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `event_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `template_category_id`, `event_type_id`, `user_id`, `startdate`, `enddate`, `place`, `address`, `map`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, '2022-01-21 22:28:25', '2022-01-21 22:28:27', 'jakarta', 'kalibata', NULL, '2021-11-28 05:17:37', '2021-11-28 05:17:37'),
(4, 1, 2, 7, NULL, NULL, '', '', NULL, '2021-11-28 05:17:37', '2021-11-28 05:17:37'),
(7, 1, 1, 4, '2022-05-26 14:46:28', '2022-05-26 14:46:28', 'jakarta', 'kalibata', NULL, '2022-05-26 07:46:36', '2022-05-26 07:46:36'),
(8, 1, 2, 1, NULL, NULL, '', '', NULL, '2022-05-26 11:27:09', '2022-05-26 11:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `template_category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Akad', '2021-11-28 04:23:13', '2021-11-28 04:23:14'),
(2, 1, 'Resepsi', '2021-11-28 04:23:25', '2021-11-28 04:23:25');

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
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ulasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `greetings`
--

CREATE TABLE `greetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `greeting` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presence` int(11) NOT NULL DEFAULT 0,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `user_id`, `template_category_id`, `name`, `phone`, `presence`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 'Bintang', '+6281513947715', 0, 'Y', '2022-01-21 14:21:39', '2022-06-01 13:29:49'),
(6, 1, 1, 'BBBBBB', '+62882246668782', 0, 'Y', '2022-01-21 15:16:55', '2022-01-21 15:20:39'),
(7, 1, 1, 'CCC', '+628224448782', 0, 'Y', '2022-01-21 15:19:17', '2022-01-21 15:20:20'),
(8, 4, 1, 'Opal', '+6282246668782', 0, 'Y', '2022-05-26 07:47:03', '2022-05-26 07:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `guest_presences`
--

CREATE TABLE `guest_presences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `presence` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_type_id` bigint(20) UNSIGNED NOT NULL,
  `bank_account_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired` datetime DEFAULT NULL,
  `amount` double(12,2) NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `template_category_id`, `invoice_type_id`, `bank_account_id`, `code`, `expired`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'INV2111-0001', '2021-11-29 11:46:13', 0.00, 'Y', '2021-11-28 04:46:21', '2021-11-28 04:46:22'),
(3, 4, 1, 1, 1, 'INV2111-0002', '2021-12-12 11:48:43', 0.00, 'Y', '2021-11-28 04:48:43', '2021-11-28 04:48:43'),
(5, 6, 1, 1, 1, 'INV2112-0001', '2022-01-02 00:38:09', 0.00, 'Y', '2021-12-18 17:38:09', '2021-12-18 17:38:09'),
(6, 7, 1, 1, 1, 'INV2112-0002', '2022-01-02 01:13:47', 0.00, 'Y', '2021-12-18 18:13:47', '2021-12-18 18:13:47'),
(7, 8, 1, 1, 1, 'INV2112-0003', '2022-01-09 16:55:12', 0.00, 'Y', '2021-12-26 09:55:13', '2021-12-26 09:55:13'),
(8, 1, 1, 2, 1, 'INV2112-0004', '2022-01-25 17:26:44', 120000.00, 'Y', '2021-12-26 10:20:12', '2021-12-26 10:26:44'),
(9, 1, 1, 3, 1, 'INV2112-0005', '2023-01-09 17:21:04', 250000.00, 'Y', '2021-12-26 10:21:04', '2021-12-26 10:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_levels`
--

CREATE TABLE `invoice_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_levels`
--

INSERT INTO `invoice_levels` (`id`, `level`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bronze', 'Bronze.png', '2021-11-28 04:24:12', '2021-11-28 04:24:13'),
(2, 2, 'Silver', 'Silver.png', '2021-11-28 04:24:54', '2021-11-28 04:24:55'),
(3, 3, 'Gold', 'Gold.png', '2021-11-28 04:25:07', '2021-11-28 04:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(12,2) NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_confirmed` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `invoice_id`, `date`, `amount`, `attachment`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(1, 8, '2021-12-26 17:25:37', 120000.00, 'INV2112-0004_1640514337886-attachment.png', 'Y', '2021-12-26 10:25:37', '2021-12-26 10:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_types`
--

CREATE TABLE `invoice_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_level_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(12,2) NOT NULL,
  `expired_day` bigint(20) NOT NULL,
  `highlight` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_types`
--

INSERT INTO `invoice_types` (`id`, `template_category_id`, `invoice_level_id`, `name`, `amount`, `expired_day`, `highlight`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Bronze', 0.00, 14, 'N', '2021-11-28 04:25:49', '2021-11-28 04:25:50'),
(2, 1, 2, 'Silver', 120000.00, 30, 'Y', '2021-11-28 04:26:09', '2021-11-28 04:26:10'),
(3, 1, 3, 'Gold', 250000.00, 90, 'N', '2021-11-28 04:26:27', '2021-11-28 04:26:28');

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
(4, '2021_06_26_082340_create_permission_tables', 1),
(5, '2021_07_21_131949_add_field_to_users_table', 1),
(6, '2021_07_21_133005_create_template_table', 1),
(7, '2021_07_22_014129_create_feedbacks_table', 1),
(8, '2021_07_22_015633_create_musics_table', 1),
(9, '2021_07_22_020625_create_visitors_table', 1),
(10, '2021_07_22_022234_create_invoice_types_table', 1),
(11, '2021_07_22_023408_create_invoices_table', 1),
(12, '2021_07_22_030753_create_guests_table', 1),
(13, '2021_07_22_033018_create_greetings_table', 1),
(14, '2021_07_22_034611_create_weddings_table', 1),
(15, '2021_07_22_035835_create_galleries_table', 1),
(16, '2021_07_22_040750_create_stories_table', 1),
(17, '2021_07_22_042122_create_brides_table', 1),
(18, '2021_07_22_050156_create_event_table', 1),
(19, '2021_08_03_144744_add_status_to_feedbacks_table', 1),
(20, '2021_08_03_151938_drop_date_to_feedbacks_table', 1),
(21, '2021_08_06_080340_add_field_to_musics_table', 1),
(22, '2021_08_06_085055_change_field_to_weddings_table', 1),
(23, '2021_08_12_025240_add_field_to_templates_table', 1),
(24, '2021_09_23_120521_add_field_to_event_types_table', 2),
(25, '2021_09_23_124913_add_field_to_invoice_types_table', 2),
(26, '2021_09_25_043418_add_field_to_events_table', 2),
(27, '2021_09_25_043952_add_field_to_stories_table', 2),
(28, '2021_09_25_044326_add_field_to_galleries_table', 2),
(39, '2021_11_07_100352_add_field_to_template_users_table', 3),
(40, '2021_11_07_115035_add_field_to_visitors_table', 3),
(41, '2021_11_14_041142_create_rules_table', 3),
(42, '2021_11_14_043107_create_guest_presences_table', 3),
(43, '2021_11_14_121949_add_field_highlight_to_invoice_types_table', 3),
(44, '2021_11_15_161005_add_field_countable_to_rules_table', 3),
(45, '2021_11_18_065454_create_bank_masters_table', 3),
(46, '2021_11_20_150437_add_field_bank_account_id_to_invoices_table', 3),
(47, '2021_11_22_232420_create_invoice_levels_table', 3),
(48, '2021_11_24_163655_create_invoice_payments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `musics`
--

CREATE TABLE `musics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `musics`
--

INSERT INTO `musics` (`id`, `template_category_id`, `role_id`, `user_id`, `image`, `name`, `artist`, `description`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, 'One Love', 'ucupp', 'music', 'One-Love-Emotional-Piano-Strings.mp3', '2021-11-28 04:29:02', '2021-11-28 04:29:03'),
(2, 1, 1, 1, NULL, 'Reaching the Sky', 'ucup', 'music', 'ReachingtheSkyLongVersion-320bit.mp3', '2021-11-28 04:30:40', '2021-11-28 04:30:41');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-11-28 04:27:03', '2021-11-28 04:27:04'),
(2, 'User', 'web', '2021-11-28 04:27:11', '2021-11-28 04:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countable` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `template_category_id`, `code`, `name`, `countable`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'GMAPS', 'Google Maps', 'N', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'MAXGALLERY', 'Gallery', 'Y', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'CUSTOMMUSIC', 'Custom Music', 'N', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'MAXSTORY', 'Cerita Cinta', 'Y', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'MAXGUESTS', 'Tamu', 'Y', 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rule_values`
--

CREATE TABLE `rule_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `rule_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_type_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rule_values`
--

INSERT INTO `rule_values` (`id`, `template_category_id`, `rule_id`, `invoice_type_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, 2, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 1, 3, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 2, 1, '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 2, 2, '20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 2, 3, '50', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 3, 1, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 3, 2, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 3, 3, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 4, 1, '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 4, 2, '50', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 4, 3, '50', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 5, 1, '10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 5, 2, '500', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 5, 3, '~', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template_category_id`, `invoice_type_id`, `name`, `photo`, `view`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Sweety', 'sweety.jpg', 'wedding.sweety.index', '2021-11-28 04:33:23', '2021-11-28 04:33:24'),
(2, 1, 1, 'Bright', 'bright.jpg', 'wedding.bright.index', '2021-11-28 04:34:15', '2021-11-28 04:34:16'),
(3, 1, 2, 'Real Wedding', 'real_wedding.jpg', 'wedding.real_wedding.index', '2021-11-28 04:34:50', '2021-11-28 04:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `template_categories`
--

CREATE TABLE `template_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_categories`
--

INSERT INTO `template_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Wedding', '2021-11-06 08:46:25', '2021-11-06 08:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `template_users`
--

CREATE TABLE `template_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message_guest` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_users`
--

INSERT INTO `template_users` (`id`, `user_id`, `template_category_id`, `user_url`, `status`, `created_at`, `updated_at`, `message_guest`) VALUES
(1, 1, 1, 'admin', 'Y', '2021-11-28 04:35:44', '2022-06-01 13:59:50', '<i style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Assalamu\'alaikum Warahmatullahi Wabarakaatuh</i><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><span style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Tanpa mengurangi rasa hormat, izinkan kami mengundang Bapak/Ibu/Saudara/i {nama} untuk hadir serta memberikan do\'a restu pada acara pernikahan kami.</span><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><span style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Untuk detail acara, lokasi, dan ucapan bisa klik link dibawah ini:</span><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><span style=\"font-family: Roboto, sans-serif; font-size: 16px;\">{link}</span><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><span style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i {nama} berkenan hadir.</span><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><span style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Do\'a restu Anda merupakan hadiah terindah bagi kami.</span><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><span style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Atas kehadiran dan do\'a restu yang telah diberikan, kami ucapkan terima kasih.</span><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><br style=\"font-family: Roboto, sans-serif; font-size: 16px;\"><i style=\"font-family: Roboto, sans-serif; font-size: 16px;\">Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</i>'),
(2, 4, 1, 'yusuf', 'Y', '2021-11-28 04:48:43', '2022-05-26 07:47:29', 'Assalamu\'alaikum Warahmatullahi Wabarakaatuh\r\n\r\nTanpa mengurangi rasa hormat, izinkan kami mengundang Bapak/Ibu/Saudara/i {nama} untuk hadir serta memberikan do\'a restu pada acara pernikahan kami.\r\n\r\nUntuk detail acara, lokasi, dan ucapan bisa klik link dibawah ini:\r\n{link}\r\n\r\nMerupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i {nama} berkenan hadir.\r\n\r\nDo\'a restu Anda merupakan hadiah terindah bagi kami.\r\n\r\nAtas kehadiran dan do\'a restu yang telah diberikan, kami ucapkan terima kasih.\r\n\r\nWassalamu\'alaikum Warahmatullahi Wabarakatuh.'),
(4, 6, 1, 'okem', 'Y', '2021-12-18 17:38:09', '2021-12-18 17:38:09', NULL),
(5, 7, 1, 'budi', 'Y', '2021-12-18 18:13:47', '2021-12-18 18:13:47', NULL),
(6, 8, 1, 'deni', 'Y', '2021-12-26 09:55:13', '2021-12-26 09:55:13', NULL);

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
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2021-11-28 04:21:22', '$2y$10$NA4DjXecTSwKQnXb55RF9Ox7QQg35OATBZP.LsSbQam8wNlEPuxbm', 'UhJ8S2d31pvBYnZZT6lSmjo34aeQdc0WEWCyGAYI0tb7JHFZQNRFye2QjvlB', NULL, 'Y', '2021-11-28 04:22:04', '2021-11-28 04:22:04'),
(4, 'Yusuf Rahmanto', 'yusufrahmanto99@gmail.com', '2021-11-28 04:49:04', '$2y$10$Bh1n.LnMPtAdV67ndPFEQe9DDaY38wXzq0JdymOBwzmvDXey2UhhO', 'iBRHBIaX2x3n9DJQ13d4fS2J0aBPTBEtyjrORyoIdXWys7b7Zn8EIoskzRr2', NULL, 'Y', '2021-11-28 04:48:43', '2021-12-26 10:06:37'),
(6, 'Okem', 'okem@gmail.com', '2021-12-18 18:11:42', '$2y$10$ouBFHna4ILFwgW7brhGbDOYKxJ1dDIkSbAqe/7ze7viaFEKnWCcPm', NULL, NULL, 'Y', '2021-12-18 17:38:09', '2021-12-18 18:11:42'),
(7, 'budi', 'budi@gmail.com', NULL, '$2y$10$sRyZQl8GEz8f9WEj7R4xR.1VL4F2j4bfmBdsnvx5fL6AH/yipSVw2', NULL, NULL, 'Y', '2021-12-18 18:13:47', '2021-12-18 18:13:47'),
(8, 'deni', 'deni@gmail.com', '2021-12-26 09:59:43', '$2y$10$fpTj9FG55ahQfF48CYCmtuZLET6ABKpTt85Odws0ES3bJ4m23DecS', 'AkK0LOQvcWDFXeqDjTyUmgdb5SXNTSTUepMFXiRXz3LOmv3XXkDALJd4HNVU', NULL, 'Y', '2021-12-26 09:55:12', '2021-12-26 10:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_category_id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user_id`, `template_category_id`, `guest_id`, `name`, `fullname`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:51:01', '2022-05-22 08:51:01', '2022-05-22 08:51:01'),
(2, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:51:08', '2022-05-22 08:51:08', '2022-05-22 08:51:08'),
(3, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:51:56', '2022-05-22 08:52:02', '2022-05-22 08:52:02'),
(4, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:52:25', '2022-05-22 08:52:25', '2022-05-22 08:52:25'),
(5, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:52:28', '2022-05-22 08:52:28', '2022-05-22 08:52:28'),
(6, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:52:39', '2022-05-22 08:52:39', '2022-05-22 08:52:39'),
(7, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:52:43', '2022-05-22 08:52:43', '2022-05-22 08:52:43'),
(8, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:53:13', '2022-05-22 08:53:13', '2022-05-22 08:53:13'),
(9, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:53:27', '2022-05-22 08:53:27', '2022-05-22 08:53:27'),
(10, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:54:07', '2022-05-22 08:54:10', '2022-05-22 08:54:10'),
(11, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:54:13', '2022-05-22 08:54:13', '2022-05-22 08:54:13'),
(12, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:54:20', '2022-05-22 08:54:20', '2022-05-22 08:54:20'),
(13, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:54:35', '2022-05-22 08:54:35', '2022-05-22 08:54:35'),
(14, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:54:43', '2022-05-22 08:54:43', '2022-05-22 08:54:43'),
(15, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:55:00', '2022-05-22 08:55:00', '2022-05-22 08:55:00'),
(16, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:55:08', '2022-05-22 08:55:08', '2022-05-22 08:55:08'),
(17, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:55:25', '2022-05-22 08:55:25', '2022-05-22 08:55:25'),
(18, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:55:33', '2022-05-22 08:55:35', '2022-05-22 08:55:35'),
(19, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:56:13', '2022-05-22 08:56:16', '2022-05-22 08:56:16'),
(20, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:56:23', '2022-05-22 08:56:23', '2022-05-22 08:56:23'),
(21, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:56:40', '2022-05-22 08:56:40', '2022-05-22 08:56:40'),
(22, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:56:48', '2022-05-22 08:56:48', '2022-05-22 08:56:48'),
(23, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:57:05', '2022-05-22 08:57:05', '2022-05-22 08:57:05'),
(24, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:57:13', '2022-05-22 08:57:13', '2022-05-22 08:57:13'),
(25, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:57:38', '2022-05-22 08:57:41', '2022-05-22 08:57:41'),
(26, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:58:07', '2022-05-22 08:58:07', '2022-05-22 08:58:07'),
(27, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:58:20', '2022-05-22 08:58:20', '2022-05-22 08:58:20'),
(28, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:58:28', '2022-05-22 08:58:28', '2022-05-22 08:58:28'),
(29, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:58:45', '2022-05-22 08:58:45', '2022-05-22 08:58:45'),
(30, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:58:53', '2022-05-22 08:58:53', '2022-05-22 08:58:53'),
(31, 1, 1, NULL, 'unknown', '-', '2022-05-22 15:59:17', '2022-05-22 08:59:17', '2022-05-22 08:59:17'),
(32, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:00:10', '2022-05-22 09:00:10', '2022-05-22 09:00:10'),
(33, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:04:10', '2022-05-22 09:04:10', '2022-05-22 09:04:10'),
(34, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:06:07', '2022-05-22 09:06:07', '2022-05-22 09:06:07'),
(35, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:10:07', '2022-05-22 09:10:07', '2022-05-22 09:10:07'),
(36, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:12:07', '2022-05-22 09:12:07', '2022-05-22 09:12:07'),
(37, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:16:07', '2022-05-22 09:16:07', '2022-05-22 09:16:07'),
(38, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:18:11', '2022-05-22 09:18:11', '2022-05-22 09:18:11'),
(39, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:22:11', '2022-05-22 09:22:11', '2022-05-22 09:22:11'),
(40, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:24:11', '2022-05-22 09:24:11', '2022-05-22 09:24:11'),
(41, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:28:07', '2022-05-22 09:28:07', '2022-05-22 09:28:07'),
(42, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:30:07', '2022-05-22 09:30:07', '2022-05-22 09:30:07'),
(43, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:30:35', '2022-05-22 09:30:35', '2022-05-22 09:30:35'),
(44, 1, 1, NULL, 'unknown', '-', '2022-05-22 16:30:42', '2022-05-22 09:30:42', '2022-05-22 09:30:42'),
(45, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:34:45', '2022-05-22 09:34:45', '2022-05-22 09:34:45'),
(46, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:34:51', '2022-05-22 09:34:51', '2022-05-22 09:34:51'),
(47, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:34:58', '2022-05-22 09:34:58', '2022-05-22 09:34:58'),
(48, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:35:01', '2022-05-22 09:35:01', '2022-05-22 09:35:01'),
(49, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:35:11', '2022-05-22 09:35:11', '2022-05-22 09:35:11'),
(50, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:35:15', '2022-05-22 09:35:15', '2022-05-22 09:35:15'),
(51, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:35:18', '2022-05-22 09:35:18', '2022-05-22 09:35:18'),
(52, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:35:26', '2022-05-22 09:35:26', '2022-05-22 09:35:26'),
(53, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:35:39', '2022-05-22 09:35:47', '2022-05-22 09:35:47'),
(54, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:36:05', '2022-05-22 09:36:05', '2022-05-22 09:36:05'),
(55, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:36:21', '2022-05-22 09:36:21', '2022-05-22 09:36:21'),
(56, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:36:29', '2022-05-22 09:36:29', '2022-05-22 09:36:29'),
(57, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:36:45', '2022-05-22 09:36:45', '2022-05-22 09:36:45'),
(58, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:36:53', '2022-05-22 09:36:53', '2022-05-22 09:36:53'),
(59, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:37:10', '2022-05-22 09:37:10', '2022-05-22 09:37:10'),
(60, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:37:18', '2022-05-22 09:37:18', '2022-05-22 09:37:18'),
(61, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:37:37', '2022-05-22 09:37:39', '2022-05-22 09:37:39'),
(62, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:38:00', '2022-05-22 09:38:03', '2022-05-22 09:38:03'),
(63, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:38:25', '2022-05-22 09:38:25', '2022-05-22 09:38:25'),
(64, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:38:33', '2022-05-22 09:38:33', '2022-05-22 09:38:33'),
(65, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:38:50', '2022-05-22 09:38:50', '2022-05-22 09:38:50'),
(66, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:38:58', '2022-05-22 09:38:58', '2022-05-22 09:38:58'),
(67, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:39:20', '2022-05-22 09:39:20', '2022-05-22 09:39:20'),
(68, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:39:28', '2022-05-22 09:39:28', '2022-05-22 09:39:28'),
(69, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:39:59', '2022-05-22 09:40:02', '2022-05-22 09:40:02'),
(70, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:40:30', '2022-05-22 09:40:30', '2022-05-22 09:40:30'),
(71, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:40:38', '2022-05-22 09:40:38', '2022-05-22 09:40:38'),
(72, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:41:05', '2022-05-22 09:41:05', '2022-05-22 09:41:05'),
(73, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:41:13', '2022-05-22 09:41:13', '2022-05-22 09:41:13'),
(74, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:45:25', '2022-05-22 09:45:25', '2022-05-22 09:45:25'),
(75, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:47:14', '2022-05-22 09:47:14', '2022-05-22 09:47:14'),
(76, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:51:13', '2022-05-22 09:51:16', '2022-05-22 09:51:16'),
(77, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:53:07', '2022-05-22 09:53:07', '2022-05-22 09:53:07'),
(78, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:57:09', '2022-05-22 09:57:09', '2022-05-22 09:57:09'),
(79, 1, 1, 5, 'Test', 'Test', '2022-05-22 16:59:07', '2022-05-22 09:59:07', '2022-05-22 09:59:07'),
(80, 1, 1, 5, 'Test', 'Test', '2022-05-22 17:03:07', '2022-05-22 10:03:07', '2022-05-22 10:03:07'),
(81, 1, 1, 5, 'Test', 'Test', '2022-05-22 17:05:07', '2022-05-22 10:05:07', '2022-05-22 10:05:07'),
(82, 1, 1, 5, 'Test', 'Test', '2022-05-22 17:09:07', '2022-05-22 10:09:07', '2022-05-22 10:09:07'),
(83, 1, 1, 5, 'Test', 'Test', '2022-05-22 17:11:08', '2022-05-22 10:11:08', '2022-05-22 10:11:08'),
(84, 1, 1, 5, 'Test', 'Test', '2022-05-22 18:44:31', '2022-05-22 11:44:31', '2022-05-22 11:44:31'),
(85, 1, 1, 5, 'Test', 'Test', '2022-05-22 18:46:07', '2022-05-22 11:46:07', '2022-05-22 11:46:07'),
(86, 1, 1, 5, 'Test', 'Test', '2022-05-22 18:50:07', '2022-05-22 11:50:07', '2022-05-22 11:50:07'),
(87, 1, 1, 5, 'Test', 'Test', '2022-05-22 18:52:06', '2022-05-22 11:52:06', '2022-05-22 11:52:06'),
(88, 1, 1, 5, 'Test', 'Test', '2022-05-22 18:56:07', '2022-05-22 11:56:07', '2022-05-22 11:56:07'),
(89, 1, 1, 5, 'Test', 'Test', '2022-05-22 18:58:06', '2022-05-22 11:58:06', '2022-05-22 11:58:06'),
(90, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:02:06', '2022-05-22 12:02:06', '2022-05-22 12:02:06'),
(91, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:04:06', '2022-05-22 12:04:06', '2022-05-22 12:04:06'),
(92, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:08:06', '2022-05-22 12:08:06', '2022-05-22 12:08:06'),
(93, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:10:06', '2022-05-22 12:10:06', '2022-05-22 12:10:06'),
(94, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:14:06', '2022-05-22 12:14:06', '2022-05-22 12:14:06'),
(95, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:16:06', '2022-05-22 12:16:06', '2022-05-22 12:16:06'),
(96, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:20:06', '2022-05-22 12:20:06', '2022-05-22 12:20:06'),
(97, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:22:06', '2022-05-22 12:22:06', '2022-05-22 12:22:06'),
(98, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:26:06', '2022-05-22 12:26:06', '2022-05-22 12:26:06'),
(99, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:28:06', '2022-05-22 12:28:06', '2022-05-22 12:28:06'),
(100, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:36:29', '2022-05-22 12:36:30', '2022-05-22 12:36:30'),
(101, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:38:06', '2022-05-22 12:38:06', '2022-05-22 12:38:06'),
(102, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:42:06', '2022-05-22 12:42:06', '2022-05-22 12:42:06'),
(103, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:44:06', '2022-05-22 12:44:06', '2022-05-22 12:44:06'),
(104, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:48:06', '2022-05-22 12:48:06', '2022-05-22 12:48:06'),
(105, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:50:06', '2022-05-22 12:50:06', '2022-05-22 12:50:06'),
(106, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:54:06', '2022-05-22 12:54:06', '2022-05-22 12:54:06'),
(107, 1, 1, 5, 'Test', 'Test', '2022-05-22 19:56:06', '2022-05-22 12:56:06', '2022-05-22 12:56:06'),
(108, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:00:06', '2022-05-22 13:00:06', '2022-05-22 13:00:06'),
(109, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:02:06', '2022-05-22 13:02:06', '2022-05-22 13:02:06'),
(110, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:06:06', '2022-05-22 13:06:06', '2022-05-22 13:06:06'),
(111, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:08:06', '2022-05-22 13:08:06', '2022-05-22 13:08:06'),
(112, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:12:12', '2022-05-22 13:12:12', '2022-05-22 13:12:12'),
(113, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:14:06', '2022-05-22 13:14:06', '2022-05-22 13:14:06'),
(114, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:18:06', '2022-05-22 13:18:06', '2022-05-22 13:18:06'),
(115, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:20:06', '2022-05-22 13:20:06', '2022-05-22 13:20:06'),
(116, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:24:06', '2022-05-22 13:24:06', '2022-05-22 13:24:06'),
(117, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:26:06', '2022-05-22 13:26:06', '2022-05-22 13:26:06'),
(118, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:30:06', '2022-05-22 13:30:06', '2022-05-22 13:30:06'),
(119, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:32:06', '2022-05-22 13:32:06', '2022-05-22 13:32:06'),
(120, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:36:06', '2022-05-22 13:36:06', '2022-05-22 13:36:06'),
(121, 1, 1, 5, 'Test', 'Test', '2022-05-22 20:38:06', '2022-05-22 13:38:06', '2022-05-22 13:38:06'),
(122, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:16:41', '2022-05-22 15:16:41', '2022-05-22 15:16:41'),
(123, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:18:06', '2022-05-22 15:18:06', '2022-05-22 15:18:06'),
(124, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:22:06', '2022-05-22 15:22:06', '2022-05-22 15:22:06'),
(125, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:24:06', '2022-05-22 15:24:06', '2022-05-22 15:24:06'),
(126, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:28:06', '2022-05-22 15:28:06', '2022-05-22 15:28:06'),
(127, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:30:06', '2022-05-22 15:30:06', '2022-05-22 15:30:06'),
(128, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:34:06', '2022-05-22 15:34:06', '2022-05-22 15:34:06'),
(129, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:36:06', '2022-05-22 15:36:06', '2022-05-22 15:36:06'),
(130, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:40:06', '2022-05-22 15:40:06', '2022-05-22 15:40:06'),
(131, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:42:06', '2022-05-22 15:42:06', '2022-05-22 15:42:06'),
(132, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:46:06', '2022-05-22 15:46:06', '2022-05-22 15:46:06'),
(133, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:48:06', '2022-05-22 15:48:06', '2022-05-22 15:48:06'),
(134, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:52:17', '2022-05-22 15:52:20', '2022-05-22 15:52:20'),
(135, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:54:08', '2022-05-22 15:54:11', '2022-05-22 15:54:11'),
(136, 1, 1, 5, 'Test', 'Test', '2022-05-22 22:58:06', '2022-05-22 15:58:06', '2022-05-22 15:58:06'),
(137, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:00:06', '2022-05-22 16:00:06', '2022-05-22 16:00:06'),
(138, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:04:06', '2022-05-22 16:04:06', '2022-05-22 16:04:06'),
(139, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:06:06', '2022-05-22 16:06:06', '2022-05-22 16:06:06'),
(140, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:10:06', '2022-05-22 16:10:06', '2022-05-22 16:10:06'),
(141, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:12:06', '2022-05-22 16:12:06', '2022-05-22 16:12:06'),
(142, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:16:06', '2022-05-22 16:16:06', '2022-05-22 16:16:06'),
(143, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:18:06', '2022-05-22 16:18:06', '2022-05-22 16:18:06'),
(144, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:22:06', '2022-05-22 16:22:06', '2022-05-22 16:22:06'),
(145, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:24:06', '2022-05-22 16:24:06', '2022-05-22 16:24:06'),
(146, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:28:06', '2022-05-22 16:28:06', '2022-05-22 16:28:06'),
(147, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:30:07', '2022-05-22 16:30:07', '2022-05-22 16:30:07'),
(148, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:34:06', '2022-05-22 16:34:06', '2022-05-22 16:34:06'),
(149, 1, 1, 5, 'Test', 'Test', '2022-05-22 23:36:06', '2022-05-22 16:36:06', '2022-05-22 16:36:06'),
(150, 1, 1, NULL, 'unknown', '-', '2022-05-28 14:22:14', '2022-05-28 07:22:14', '2022-05-28 07:22:14'),
(151, 1, 1, NULL, 'unknown', '-', '2022-05-28 14:22:22', '2022-05-28 07:22:22', '2022-05-28 07:22:22'),
(152, 1, 1, NULL, 'unknown', '-', '2022-05-28 14:22:41', '2022-05-28 07:22:41', '2022-05-28 07:22:41'),
(153, 1, 1, NULL, 'unknown', '-', '2022-05-28 14:23:08', '2022-05-28 07:23:08', '2022-05-28 07:23:08'),
(154, 1, 1, NULL, 'unknown', '-', '2022-06-01 18:00:36', '2022-06-01 11:00:36', '2022-06-01 11:00:36'),
(155, 1, 1, NULL, 'unknown', '-', '2022-06-01 19:59:39', '2022-06-01 12:59:39', '2022-06-01 12:59:39'),
(156, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:00:05', '2022-06-01 13:00:05', '2022-06-01 13:00:05'),
(157, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:00:10', '2022-06-01 13:00:10', '2022-06-01 13:00:10'),
(158, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:00:21', '2022-06-01 13:00:21', '2022-06-01 13:00:21'),
(159, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:00:27', '2022-06-01 13:00:27', '2022-06-01 13:00:27'),
(160, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:00:45', '2022-06-01 13:00:45', '2022-06-01 13:00:45'),
(161, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:00:52', '2022-06-01 13:00:52', '2022-06-01 13:00:52'),
(162, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:05', '2022-06-01 13:01:05', '2022-06-01 13:01:05'),
(163, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:12', '2022-06-01 13:01:12', '2022-06-01 13:01:12'),
(164, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:26', '2022-06-01 13:01:26', '2022-06-01 13:01:26'),
(165, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:32', '2022-06-01 13:01:32', '2022-06-01 13:01:32'),
(166, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:41', '2022-06-01 13:01:41', '2022-06-01 13:01:41'),
(167, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:46', '2022-06-01 13:01:46', '2022-06-01 13:01:46'),
(168, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:01:48', '2022-06-01 13:01:48', '2022-06-01 13:01:48'),
(169, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:02:03', '2022-06-01 13:02:03', '2022-06-01 13:02:03'),
(170, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:02:10', '2022-06-01 13:02:10', '2022-06-01 13:02:10'),
(171, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:02:24', '2022-06-01 13:02:24', '2022-06-01 13:02:24'),
(172, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:02:30', '2022-06-01 13:02:30', '2022-06-01 13:02:30'),
(173, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:03:49', '2022-06-01 13:03:49', '2022-06-01 13:03:49'),
(174, 1, 1, NULL, 'unknown', '-', '2022-06-01 20:09:33', '2022-06-01 13:09:33', '2022-06-01 13:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `weddings`
--

CREATE TABLE `weddings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED NOT NULL,
  `photo_sampul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weddings`
--

INSERT INTO `weddings` (`id`, `user_id`, `template_id`, `photo_sampul`, `music_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, 1, '2021-11-28 04:36:41', '2022-06-01 12:59:37'),
(2, 4, 1, NULL, 1, '2021-11-28 04:48:43', '2021-11-28 04:48:43'),
(4, 6, 1, NULL, 1, '2021-12-18 17:38:09', '2021-12-18 17:38:09'),
(5, 7, 1, NULL, 1, '2021-12-18 18:13:47', '2021-12-18 18:13:47'),
(6, 8, 1, NULL, 1, '2021-12-26 09:55:13', '2021-12-26 09:55:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_bank_func_category_id_foreign` (`bank_func_category_id`),
  ADD KEY `bank_accounts_bank_master_id_foreign` (`bank_master_id`),
  ADD KEY `bank_accounts_user_id_foreign` (`user_id`),
  ADD KEY `bank_accounts_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `bank_func_categories`
--
ALTER TABLE `bank_func_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_func_categories_name_unique` (`name`);

--
-- Indexes for table `bank_masters`
--
ALTER TABLE `bank_masters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_masters_code_unique` (`code`);

--
-- Indexes for table `brides`
--
ALTER TABLE `brides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brides_user_id_foreign` (`user_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_event_type_id_foreign` (`event_type_id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_types_name_unique` (`name`),
  ADD KEY `event_types_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_user_id_foreign` (`user_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_user_id_foreign` (`user_id`),
  ADD KEY `galleries_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `greetings`
--
ALTER TABLE `greetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `greetings_guest_id_foreign` (`guest_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guests_user_id_foreign` (`user_id`),
  ADD KEY `guests_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `guest_presences`
--
ALTER TABLE `guest_presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guest_presences_guest_id_foreign` (`guest_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_code_unique` (`code`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_template_category_id_foreign` (`template_category_id`),
  ADD KEY `invoices_invoice_type_id_foreign` (`invoice_type_id`),
  ADD KEY `invoices_bank_account_id_foreign` (`bank_account_id`);

--
-- Indexes for table `invoice_levels`
--
ALTER TABLE `invoice_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_levels_name_unique` (`name`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_payments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `invoice_types`
--
ALTER TABLE `invoice_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_types_template_category_id_foreign` (`template_category_id`),
  ADD KEY `invoice_types_invoice_level_id_foreign` (`invoice_level_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musics_template_category_id_foreign` (`template_category_id`),
  ADD KEY `musics_role_id_foreign` (`role_id`),
  ADD KEY `musics_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rules_code_unique` (`code`),
  ADD KEY `rules_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `rule_values`
--
ALTER TABLE `rule_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rule_values_template_category_id_foreign` (`template_category_id`),
  ADD KEY `rule_values_rule_id_foreign` (`rule_id`),
  ADD KEY `rule_values_invoice_type_id_foreign` (`invoice_type_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_user_id_foreign` (`user_id`),
  ADD KEY `stories_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `templates_view_unique` (`view`),
  ADD KEY `templates_template_category_id_foreign` (`template_category_id`),
  ADD KEY `templates_invoice_type_id_foreign` (`invoice_type_id`);

--
-- Indexes for table `template_categories`
--
ALTER TABLE `template_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_categories_name_unique` (`name`);

--
-- Indexes for table `template_users`
--
ALTER TABLE `template_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_users_user_url_unique` (`user_url`),
  ADD KEY `template_users_user_id_foreign` (`user_id`),
  ADD KEY `template_users_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_user_id_foreign` (`user_id`),
  ADD KEY `visitors_template_category_id_foreign` (`template_category_id`);

--
-- Indexes for table `weddings`
--
ALTER TABLE `weddings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `weddings_user_id_unique` (`user_id`),
  ADD KEY `weddings_template_id_foreign` (`template_id`),
  ADD KEY `weddings_music_id_foreign` (`music_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_func_categories`
--
ALTER TABLE `bank_func_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_masters`
--
ALTER TABLE `bank_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brides`
--
ALTER TABLE `brides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `greetings`
--
ALTER TABLE `greetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guest_presences`
--
ALTER TABLE `guest_presences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_levels`
--
ALTER TABLE `invoice_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_types`
--
ALTER TABLE `invoice_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `musics`
--
ALTER TABLE `musics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rule_values`
--
ALTER TABLE `rule_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template_categories`
--
ALTER TABLE `template_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_users`
--
ALTER TABLE `template_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `weddings`
--
ALTER TABLE `weddings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_bank_func_category_id_foreign` FOREIGN KEY (`bank_func_category_id`) REFERENCES `bank_func_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bank_accounts_bank_master_id_foreign` FOREIGN KEY (`bank_master_id`) REFERENCES `bank_masters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bank_accounts_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brides`
--
ALTER TABLE `brides`
  ADD CONSTRAINT `brides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_event_type_id_foreign` FOREIGN KEY (`event_type_id`) REFERENCES `event_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_types`
--
ALTER TABLE `event_types`
  ADD CONSTRAINT `event_types_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `galleries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `greetings`
--
ALTER TABLE `greetings`
  ADD CONSTRAINT `greetings_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guest_presences`
--
ALTER TABLE `guest_presences`
  ADD CONSTRAINT `guest_presences_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_invoice_type_id_foreign` FOREIGN KEY (`invoice_type_id`) REFERENCES `invoice_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD CONSTRAINT `invoice_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_types`
--
ALTER TABLE `invoice_types`
  ADD CONSTRAINT `invoice_types_invoice_level_id_foreign` FOREIGN KEY (`invoice_level_id`) REFERENCES `invoice_levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_types_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `musics`
--
ALTER TABLE `musics`
  ADD CONSTRAINT `musics_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `musics_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `musics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rule_values`
--
ALTER TABLE `rule_values`
  ADD CONSTRAINT `rule_values_invoice_type_id_foreign` FOREIGN KEY (`invoice_type_id`) REFERENCES `invoice_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rule_values_rule_id_foreign` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rule_values_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_invoice_type_id_foreign` FOREIGN KEY (`invoice_type_id`) REFERENCES `invoice_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `templates_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `template_users`
--
ALTER TABLE `template_users`
  ADD CONSTRAINT `template_users_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `template_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_template_category_id_foreign` FOREIGN KEY (`template_category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visitors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weddings`
--
ALTER TABLE `weddings`
  ADD CONSTRAINT `weddings_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `weddings_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `weddings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
