-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2025 at 08:50 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_sdlc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:37:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"create-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:10:\"edit-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"delete-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"view-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"manage-projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"create-projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"edit-projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"delete-projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"view-projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"assign-projects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"manage-teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"create-teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:10:\"edit-teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:12:\"delete-teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:10:\"view-teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:19:\"assign-team-members\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:12:\"manage-tasks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"create-tasks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:10:\"edit-tasks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"delete-tasks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:10:\"view-tasks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"assign-tasks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:18:\"update-task-status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:14:\"manage-clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"create-clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"edit-clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:14:\"delete-clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"view-clients\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:12:\"view-reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:16:\"generate-reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:14:\"export-reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:15:\"manage-settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:13:\"view-settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"manage-phases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:11:\"view-phases\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:19:\"update-phase-status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"app-administrator\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:20:\"administrative-staff\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"developer-mentor\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:6:\"client\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:18:\"intern-third-party\";s:1:\"c\";s:3:\"web\";}}}', 1754121347);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_30_115632_create_permission_tables', 1),
(5, '2025_07_30_162211_add_approval_fields_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(72) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(72) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `category`, `display_name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage-users', NULL, 'manage-users', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(2, 'create-users', NULL, 'create-users', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(3, 'edit-users', NULL, 'edit-users', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(4, 'delete-users', NULL, 'delete-users', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(5, 'view-users', NULL, 'view-users', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(6, 'manage-projects', NULL, 'manage-projects', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(7, 'create-projects', NULL, 'create-projects', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(8, 'edit-projects', NULL, 'edit-projects', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(9, 'delete-projects', NULL, 'delete-projects', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(10, 'view-projects', NULL, 'view-projects', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(11, 'assign-projects', NULL, 'assign-projects', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(12, 'manage-teams', NULL, 'manage-teams', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(13, 'create-teams', NULL, 'create-teams', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(14, 'edit-teams', NULL, 'edit-teams', NULL, 'web', '2025-08-01 04:52:28', '2025-08-01 04:52:28'),
(15, 'delete-teams', NULL, 'delete-teams', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(16, 'view-teams', NULL, 'view-teams', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(17, 'assign-team-members', NULL, 'assign-team-members', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(18, 'manage-tasks', NULL, 'manage-tasks', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(19, 'create-tasks', NULL, 'create-tasks', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(20, 'edit-tasks', NULL, 'edit-tasks', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(21, 'delete-tasks', NULL, 'delete-tasks', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(22, 'view-tasks', NULL, 'view-tasks', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(23, 'assign-tasks', NULL, 'assign-tasks', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(24, 'update-task-status', NULL, 'update-task-status', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(25, 'manage-clients', NULL, 'manage-clients', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(26, 'create-clients', NULL, 'create-clients', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(27, 'edit-clients', NULL, 'edit-clients', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(28, 'delete-clients', NULL, 'delete-clients', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(29, 'view-clients', NULL, 'view-clients', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(30, 'view-reports', NULL, 'view-reports', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(31, 'generate-reports', NULL, 'generate-reports', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(32, 'export-reports', NULL, 'export-reports', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(33, 'manage-settings', NULL, 'manage-settings', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(34, 'view-settings', NULL, 'view-settings', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(35, 'manage-phases', NULL, 'manage-phases', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(36, 'view-phases', NULL, 'view-phases', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(37, 'update-phase-status', NULL, 'update-phase-status', NULL, 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(38, 'view-roles', 'role-management', 'عرض الأدوار', 'صلاحية عرض الأدوار في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(39, 'create-roles', 'role-management', 'إنشاء أدوار جديدة', 'صلاحية إنشاء أدوار جديدة في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(40, 'edit-roles', 'role-management', 'تعديل الأدوار', 'صلاحية تعديل الأدوار في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(41, 'delete-roles', 'role-management', 'حذف الأدوار', 'صلاحية حذف الأدوار في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(42, 'assign-role-permissions', 'role-management', 'تعيين صلاحيات للأدوار', 'صلاحية تعيين صلاحيات للأدوار في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(43, 'view-role-details', 'role-management', 'عرض تفاصيل الأدوار', 'صلاحية عرض تفاصيل الأدوار في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(44, 'manage-roles', 'role-management', 'إدارة الأدوار الكاملة', 'صلاحية إدارة الأدوار الكاملة في فئة إدارة الأدوار', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(45, 'view-permissions', 'permission-management', 'عرض الصلاحيات', 'صلاحية عرض الصلاحيات في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(46, 'create-permissions', 'permission-management', 'إنشاء صلاحيات جديدة', 'صلاحية إنشاء صلاحيات جديدة في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(47, 'edit-permissions', 'permission-management', 'تعديل الصلاحيات', 'صلاحية تعديل الصلاحيات في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(48, 'delete-permissions', 'permission-management', 'حذف الصلاحيات', 'صلاحية حذف الصلاحيات في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(49, 'view-permission-details', 'permission-management', 'عرض تفاصيل الصلاحيات', 'صلاحية عرض تفاصيل الصلاحيات في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(50, 'manage-permissions', 'permission-management', 'إدارة الصلاحيات الكاملة', 'صلاحية إدارة الصلاحيات الكاملة في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06'),
(51, 'bulk-assign-permissions', 'permission-management', 'تعيين صلاحيات بالجملة', 'صلاحية تعيين صلاحيات بالجملة في فئة إدارة الصلاحيات', 'web', '2025-08-01 20:22:06', '2025-08-01 20:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(72) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'app-administrator', 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(2, 'administrative-staff', 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(3, 'developer-mentor', 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(4, 'client', 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29'),
(5, 'intern-third-party', 'web', '2025-08-01 04:52:29', '2025-08-01 04:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(17, 3),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(22, 5),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(24, 3),
(24, 5),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(30, 4),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(34, 1),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(36, 3),
(36, 4),
(36, 5),
(37, 1),
(37, 2),
(37, 3),
(38, 1),
(38, 2),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(45, 1),
(45, 2),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(49, 2),
(50, 1),
(51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HAB8m7T9c1pnBPj5gNNPZH2CXfmx0UrTwYM7stkP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWmFHNjNQM25YNklIdmhPc2d1SGg3aEJGblpGNW9xOXhiUzc4WXR3dCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2Vycy9wZW5kaW5nLWNvdW50Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1754081438);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `registration_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'self',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_approved_by_foreign` (`approved_by`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_approved`, `is_active`, `approved_at`, `approved_by`, `registration_type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'أحمد محمد على السيد', 'admin@sdlc.com', '2025-08-01 04:52:30', 1, 1, '2025-08-01 16:42:10', 1, 'admin_created', '$2y$12$LiVEhEgIdvM8yjjh0VWLt.m4KfnjyxDBoWLG5vO4dL1CVKdqPkMUy', NULL, '2025-08-01 04:52:30', '2025-08-01 16:42:10'),
(2, 'موظف إداري', 'staff@sdlc.com', '2025-08-01 04:52:30', 0, 0, NULL, NULL, 'self', '$2y$12$kYcOnIOvPLKjQNY/wrQLyuBnWApmcCM01YGGA2y4O3ow0v0Bh2vwO', NULL, '2025-08-01 04:52:30', '2025-08-01 04:52:30'),
(3, 'مطور', 'developer@sdlc.com', '2025-08-01 04:52:30', 0, 0, NULL, NULL, 'self', '$2y$12$McKw.ec5jxXrvf3ZMNvrWOPBWNcEHvF1miUt9fdurJGqT4aoUEV.C', NULL, '2025-08-01 04:52:30', '2025-08-01 04:52:30'),
(4, 'عميل', 'client@sdlc.com', '2025-08-01 04:52:30', 0, 0, NULL, NULL, 'self', '$2y$12$eUsyzsOGTTNNcGtqfLYqrOZL8MjQcaNAGEmBnKefHGOwykWfzclhq', NULL, '2025-08-01 04:52:30', '2025-08-01 04:52:30'),
(5, 'متدرب', 'intern@sdlc.com', '2025-08-01 04:52:31', 0, 0, NULL, NULL, 'self', '$2y$12$lFNVA1tmLTcqetDYDyli0u5NS7G.zdKfmA0.lPvqpKgowiJTfvOGq', NULL, '2025-08-01 04:52:31', '2025-08-01 04:52:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
