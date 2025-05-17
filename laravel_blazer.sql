-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 01:50 AM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_blazer`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulletins`
--

CREATE TABLE `bulletins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bulletins`
--

INSERT INTO `bulletins` (`id`, `title`, `content`, `image_path`, `user_id`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Test Bulletin (Visible to Students)', 'Hello Students Test\n', 'bulletin_images/8ZeBaOYqQCqI3dxdv2sXlVzqqe4w4Sl8ltCAgdQA.jpg', 3, 1, '2025-05-16 14:49:40', '2025-05-16 14:49:40', '2025-05-16 14:51:25'),
(2, 'Test Bulletin (Visible to Admins)', 'Hello Admins', 'bulletin_images/mVtCxPdL8icvaw3qjlD4vGzbdgWrOHgAmG0UI5y8.webp', 3, 0, NULL, '2025-05-16 14:50:09', '2025-05-16 15:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1747439425),
('laravel_cache_da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1747439425;', 1747439425);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `yearbook_platform_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_province` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `state_province`, `zip_code`, `created_at`, `updated_at`) VALUES
(1, 'Manila', 1, 'Metro Manila', '1000', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(2, 'Quezon City', 1, 'Metro Manila', '1100', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(3, 'Cebu City', 1, 'Cebu', '6000', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(4, 'Davao City', 1, 'Davao del Sur', '8000', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(5, 'Makati', 1, 'Metro Manila', '1200', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(6, 'Baguio', 1, 'Benguet', '2600', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(7, 'Iloilo City', 1, 'Iloilo', '5000', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(8, 'Cagayan de Oro', 1, 'Misamis Oriental', '9000', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(9, 'Zamboanga City', 1, 'Zamboanga del Sur', '7000', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(10, 'Taguig', 1, 'Metro Manila', '1630', '2025-05-16 14:46:52', '2025-05-16 14:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'College of Engineering', NULL, '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(2, 'College of Business Administration', NULL, '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(3, 'College of Arts and Sciences', NULL, '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(4, 'College of Education', NULL, '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(5, 'College of Computer Studies', NULL, '2025-05-16 14:43:41', '2025-05-16 14:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `phone_code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `phone_code`, `created_at`, `updated_at`) VALUES
(1, 'Philippines', 'PHL', '+63', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(2, 'United States', 'USA', '+1', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(3, 'United Kingdom', 'GBR', '+44', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(4, 'Australia', 'AUS', '+61', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(5, 'Canada', 'CAN', '+1', '2025-05-16 14:46:52', '2025-05-16 14:46:52'),
(6, 'Japan', 'JPN', '+81', '2025-05-16 14:46:52', '2025-05-16 14:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `college_id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bachelor of Science in Civil Engineering', 'BSCE', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(2, 1, 'Bachelor of Science in Mechanical Engineering', 'BSME', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(3, 1, 'Bachelor of Science in Electrical Engineering', 'BSEE', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(4, 2, 'Bachelor of Science in Business Administration', 'BSBA', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(5, 2, 'Bachelor of Science in Accounting', 'BSA', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(6, 3, 'Bachelor of Science in Psychology', 'BSP', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(7, 3, 'Bachelor of Arts in Communication', 'BAC', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(8, 4, 'Bachelor of Elementary Education', 'BEEd', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(9, 4, 'Bachelor of Secondary Education', 'BSEd', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(10, 5, 'Bachelor of Science in Computer Science', 'BSCS', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(11, 5, 'Bachelor of Science in Information Technology', 'BSIT', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(12, 5, 'Bachelor of Science in Information Systems', 'BSIS', '2025-05-16 14:43:41', '2025-05-16 14:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"4a4b7b00-14b5-45aa-a5d5-edf9816aac18\",\"displayName\":\"App\\\\Notifications\\\\StaffInvitationNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":2:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;O:44:\\\"Illuminate\\\\Notifications\\\\AnonymousNotifiable\\\":1:{s:6:\\\"routes\\\";a:1:{s:4:\\\"mail\\\";s:27:\\\"perusofrandilbert@gmail.com\\\";}}}s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;}s:12:\\\"notification\\\";O:45:\\\"App\\\\Notifications\\\\StaffInvitationNotification\\\":2:{s:13:\\\"\\u0000*\\u0000invitation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:26:\\\"App\\\\Models\\\\StaffInvitation\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"bba9917e-7af2-4ac5-9846-4afbdd23b253\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1747437273, 1747437273),
(2, 'default', '{\"uuid\":\"095ce00b-8928-4ca6-afa5-76067a4015cd\",\"displayName\":\"App\\\\Notifications\\\\StaffInvitationLinkNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":2:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;O:44:\\\"Illuminate\\\\Notifications\\\\AnonymousNotifiable\\\":1:{s:6:\\\"routes\\\";a:1:{s:4:\\\"mail\\\";s:27:\\\"perusofrandilbert@gmail.com\\\";}}}s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;}s:12:\\\"notification\\\";O:49:\\\"App\\\\Notifications\\\\StaffInvitationLinkNotification\\\":2:{s:13:\\\"\\u0000*\\u0000invitation\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:26:\\\"App\\\\Models\\\\StaffInvitation\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"15ac49ed-5396-452c-8d55-2961477c94e5\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1747437690, 1747437690);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `course_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Structural Engineering', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(2, 1, 'Geotechnical Engineering', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(3, 2, 'Thermodynamics', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(4, 2, 'Robotics and Automation', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(5, 3, 'Power Systems', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(6, 3, 'Telecommunications', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(7, 4, 'Marketing Management', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(8, 4, 'Financial Management', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(9, 5, 'General Accounting', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(10, 5, 'Public Accounting', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(11, 6, 'Clinical Psychology', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(12, 6, 'Industrial Psychology', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(13, 7, 'Mass Communication', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(14, 7, 'Public Relations', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(15, 8, 'Elementary Mathematics', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(16, 8, 'Special Education', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(17, 9, 'Mathematics', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(18, 9, 'English', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(19, 10, 'Artificial Intelligence', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(20, 10, 'Data Science', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(21, 11, 'Network Administration', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(22, 11, 'Web Development', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(23, 12, 'Enterprise Systems', '2025-05-16 14:43:41', '2025-05-16 14:43:41'),
(24, 12, 'Business Intelligence', '2025-05-16 14:43:41', '2025-05-16 14:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_07_09_000000_create_users_table', 1),
(2, '2023_07_09_000005_create_yearbook_platforms_table', 1),
(3, '2023_07_09_000010_create_carts_tables', 1),
(4, '2023_10_20_000001_create_yearbook_subscriptions_table', 1),
(5, '2023_10_20_000002_create_yearbook_stocks_table', 1),
(6, '2025_04_15_190413_create_sessions_table', 1),
(7, '2025_04_15_190826_create_jobs_table', 1),
(8, '2025_04_15_190835_create_failed_jobs_table', 4),
(9, '2025_04_15_190841_create_cache_table', 4),
(10, '2025_04_15_191327_create_personal_access_tokens_table', 4),
(11, '2025_04_15_193303_create_yearbook_profiles_table', 1),
(12, '2025_04_15_203422_create_role_names_table', 1),
(13, '2025_04_15_204608_create_staff_invitations_table', 1),
(14, '2025_04_15_204648_add_role_name_to_users_table', 1),
(15, '2025_04_15_223434_create_yearbook_photos_table', 1),
(16, '2025_04_15_231544_create_colleges_table', 1),
(17, '2025_04_15_231545_create_courses_table', 1),
(18, '2025_04_15_231545_create_majors_table', 1),
(19, '2025_04_15_232046_modify_academic_fields_in_yearbook_profiles_table', 1),
(20, '2025_04_21_102316_create_settings_table', 1),
(21, '2025_04_21_110536_add_major_id_to_yearbook_profiles_table', 1),
(22, '2025_04_23_025101_create_bulletins_table', 1),
(23, '2025_04_23_030654_add_image_path_to_bulletins_table', 1),
(24, '2025_04_24_025522_add_yearbook_platform_id_to_yearbook_profiles_table', 1),
(25, '2025_04_24_105832_add_payment_confirmer_to_yearbook_profiles_table', 1),
(26, '2025_04_24_123658_add_profile_fields_to_users_table', 1),
(27, '2025_04_24_135505_add_theme_and_image_to_yearbook_platforms_table', 1),
(28, '2025_05_12_021300_add_middle_name_to_yearbook_profiles_table', 1),
(29, '2025_05_12_025503_add_detailed_address_to_yearbook_profiles_table', 1),
(30, '2025_05_15_161959_add_middle_name_to_users', 4),
(31, '2025_05_15_162449_create_countries_table', 2),
(32, '2025_05_15_162509_create_cities_table', 2),
(33, '2025_05_16_000001_create_yearbook_stocks_manual_fix', 2),
(34, '2025_05_16_080000_create_core_tables_manual_fix', 2),
(35, '2025_05_16_090000_add_role_name_id_to_users_table', 2),
(36, '2025_05_16_121846_add_otp_verification_to_users_table', 2),
(37, '2025_05_16_141928_add_role_name_id_to_staff_invitations', 2),
(38, '2025_05_16_144635_add_otp_fields_to_staff_invitations_table', 2),
(39, '2025_05_16_173714_create_order_items_table', 3),
(40, '2025_05_16_195059_add_purchase_type_to_yearbook_subscriptions', 3),
(41, '2025_05_16_224000_add_cover_image_to_yearbook_platforms_table', 3),
(42, '2025_05_17_000000_mark_completed_migrations', 3),
(43, '2025_05_17_000001_create_personal_access_tokens_manual_fix', 3),
(44, '2025_05_18_000000_create_password_reset_tokens_table', 3),
(45, '2025_05_16_231306_add_invitation_url_to_staff_invitations', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','ready_for_claim','claimed') NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(255) DEFAULT NULL,
  `student_id_proof` varchar(255) DEFAULT NULL,
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `claimed_processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `claimed_at` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `total_amount`, `status`, `payment_proof`, `student_id_proof`, `processed_by`, `processed_at`, `claimed_processed_by`, `claimed_at`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 'ORD-noUZY86TK4', 1, 4600.00, 'claimed', 'payment-proofs/ljmQRAiD5uhz9feYRTJOvtiNO6C1myM2HGV95oGY.png', 'student-ids/rG7o8TBEpCt74BVuR9sm7qHhkzVcvTw3kc88Dh6I.png', 2, '2025-05-16 15:22:20', 2, '2025-05-16 15:37:30', 'Wala', '2025-05-16 15:20:48', '2025-05-16 15:37:30'),
(2, 'ORD-ClyZUU9QhN', 4, 4600.00, 'pending', 'payment-proofs/iJAjlHilIuaRWbxzpUlBnJUIh6xM8OQAz2ti6Bqy.png', 'student-ids/RosUqkW7vzIT8d3CEG558QMMKXYVvK5LMlmnnlls.png', NULL, NULL, NULL, NULL, NULL, '2025-05-16 15:40:56', '2025-05-16 15:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `yearbook_platform_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `yearbook_platform_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 2300.00, '2025-05-16 15:20:48', '2025-05-16 15:20:48'),
(2, 1, 1, 1, 2300.00, '2025-05-16 15:20:48', '2025-05-16 15:20:48'),
(3, 2, 1, 2, 2300.00, '2025-05-16 15:40:56', '2025-05-16 15:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_names`
--

CREATE TABLE `role_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_names`
--

INSERT INTO `role_names` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Editor in Chief', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(2, 'Associate Editor', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(3, 'Layout Editor', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(4, 'Photojournalist', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(5, 'Content Writer', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(6, 'Graphic Designer', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(7, 'Administrator', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(8, 'Staff Member', '2025-05-16 14:46:10', '2025-05-16 14:46:10'),
(9, 'Admin', '2025-05-16 14:46:42', '2025-05-16 14:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('F6rS0Pa5gQI1bynrZ5btCKVRTi6E0hONH7X5eotc', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaEJkaUtobjJrRUZZTFdONHZGaGVRSWVWM25zZVp3MXAxWkpPRkVjTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NzoibWVzc2FnZSI7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGl2ZXdpcmUvcHJldmlldy1maWxlL1dNdmlpb0ZrdnJTQnFwQ1NabVA5NzNiOG9VenR6WS1tZXRhYkdGeVoyVXRjR2x1YXkxcVlYQmhibVZ6WlMxemRYSjJhWFpoYkMxb2IzVnpaUzUzWldKdy0ud2VicD9leHBpcmVzPTE3NDc0NDM1OTkmc2lnbmF0dXJlPThjZWU0ZTQyOTZkYTZmNjJhMGYxOTJhZWFmZDRjODM5MGQ1ZTc3MjNiNjc2ZGQ4NmVmYTY0ZWFlYmJjNDc3MTkiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1747439366);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_invitations`
--

CREATE TABLE `staff_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_name_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` varchar(64) NOT NULL,
  `invitation_url` text DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `expires_at` timestamp NOT NULL,
  `registered_at` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `address_line` text DEFAULT NULL,
  `city_province` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `role_name` varchar(255) DEFAULT NULL,
  `role_name_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `middle_name`, `suffix`, `gender`, `birthdate`, `contact_number`, `address_line`, `city_province`, `username`, `email`, `email_verified_at`, `password`, `role`, `role_name`, `role_name_id`, `remember_token`, `otp_code`, `otp_expires_at`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 'Frandilbert', 'Peruso', 'Longno', NULL, NULL, NULL, NULL, NULL, NULL, 'Frandilbert', 'frandilbertperuso@gmail.com', NULL, '$2y$12$/oqJCWIoS1EzzKb8LXJ.kewVvByxdEUZIIDZTDdJSwcAc3JEuBNVS', 'student', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-16 14:44:54', '2025-05-16 14:45:11'),
(2, 'Super', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'superadmin', 'superadmin@example.com', '2025-05-16 14:46:36', '$2y$12$ptVsZ062VyQrveVXweWIV.wbLUEwwVzBp5ujUI8XkJ.OCSzq2/YcC', 'superadmin', 'Editor in Chief', 1, NULL, NULL, NULL, 0, '2025-05-16 14:46:36', '2025-05-16 14:46:36'),
(3, 'Regular', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'admin@example.com', '2025-05-16 14:46:43', '$2y$12$fXRr3PztudkhPTJ3W9QqJe9w2n3hlIF6wFaDMrGTfYO7bpEZBnwCq', 'admin', 'Admin', 9, NULL, NULL, NULL, 0, '2025-05-16 14:46:43', '2025-05-16 14:46:43'),
(4, 'Kyla Sophia', 'Caldoza', 'Cagatan', NULL, NULL, NULL, NULL, NULL, NULL, 'Kyla', 'kylacaldoza5@gmail.com', NULL, '$2y$12$FxryfsFhwdvlYKG3xgzR9ey5XQR1ht06YZ6HTxFJYlzw8f0ueQEqu', 'student', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-16 15:38:57', '2025-05-16 15:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `yearbook_photos`
--

CREATE TABLE `yearbook_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `original_filename` varchar(255) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearbook_photos`
--

INSERT INTO `yearbook_photos` (`id`, `user_id`, `path`, `original_filename`, `order`, `created_at`, `updated_at`) VALUES
(3, 1, 'yearbook_photos/user_1/0epsMaJX5naqRihdpdllAHDHAjZqIHKVMDevFGL9.jpg', 'unnamed.jpg', 1, '2025-05-16 15:34:13', '2025-05-16 15:34:13'),
(4, 4, 'yearbook_photos/user_4/6dLF4HAgD1spMu6htSyu4Y72Nt4A7ZS4E4XKNnTD.png', '20250502_2147_Frogs\' Winter Fable_simple_compose_01jt8kz6w9fkdt85d7e4q78zqb.png', 1, '2025-05-16 15:41:06', '2025-05-16 15:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `yearbook_platforms`
--

CREATE TABLE `yearbook_platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `theme_title` varchar(255) DEFAULT NULL,
  `background_image_path` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'setup',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearbook_platforms`
--

INSERT INTO `yearbook_platforms` (`id`, `year`, `name`, `theme_title`, `background_image_path`, `cover_image`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2023', 'Blazer 2023 Yearbook', 'Celebrating Excellence', NULL, NULL, 'archived', 0, '2025-05-16 14:43:25', '2025-05-16 14:43:25'),
(2, '2024', 'Blazer 2024 Yearbook', 'New Horizons', NULL, NULL, 'archived', 0, '2025-05-16 14:43:25', '2025-05-16 14:43:25'),
(3, '2025', 'Blazer 2025 Yearbook', 'Building Tomorrow', NULL, NULL, 'active', 1, '2025-05-16 14:43:25', '2025-05-16 14:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `yearbook_profiles`
--

CREATE TABLE `yearbook_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `college_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `yearbook_platform_id` bigint(20) UNSIGNED DEFAULT NULL,
  `major_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `year_and_section` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province_state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT 'Philippines',
  `contact_number` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `affiliation_1` varchar(255) DEFAULT NULL,
  `affiliation_2` varchar(255) DEFAULT NULL,
  `affiliation_3` varchar(255) DEFAULT NULL,
  `awards` text DEFAULT NULL,
  `mantra` text DEFAULT NULL,
  `active_contact_number_internal` varchar(255) DEFAULT NULL,
  `subscription_type` varchar(255) DEFAULT NULL,
  `jacket_size` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `profile_submitted` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_confirmed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearbook_profiles`
--

INSERT INTO `yearbook_profiles` (`id`, `user_id`, `college_id`, `course_id`, `yearbook_platform_id`, `major_id`, `nickname`, `middle_name`, `year_and_section`, `age`, `birth_date`, `address`, `street_address`, `city`, `province_state`, `zip_code`, `country`, `contact_number`, `mother_name`, `father_name`, `affiliation_1`, `affiliation_2`, `affiliation_3`, `awards`, `mantra`, `active_contact_number_internal`, `subscription_type`, `jacket_size`, `payment_status`, `profile_submitted`, `submitted_at`, `paid_at`, `payment_confirmed_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 10, 3, 20, 'PJ', 'Longno', '4C', 21, '2003-10-09', NULL, 'Sto Nino, San Jose Road, Zamboanga City, Zamboanga Del Sur, 7000', 'Zamboanga City', 'Zamboanga Del Sur', '7060', 'Philippines', '09123456789', 'Jonelyn', 'Paolo', 'Pogi', 'Pogi lang', 'Pogi talaga', 'Marami', 'Secret', NULL, 'full_package', '2XL', 'paid', 1, '2025-05-16 14:45:53', '2025-05-16 14:50:51', 3, NULL, '2025-05-16 14:45:25', '2025-05-16 14:50:51'),
(2, 4, NULL, NULL, 3, NULL, 'Kyla', 'Cagatan', '4C', 21, '2004-05-11', NULL, 'Sto Nino, San Jose Road, Zamboanga City, Zamboanga Del Sur, 7000', 'Zamboanga City', 'Zamboanga Del Sur', '7060', 'Philippines', '09123456785', 'Margie', 'Reynaldo', 'Gwapa', 'Gwapa lang', 'Gwapa jud', 'Daghan', 'Secret Pud', NULL, 'full_package', 'M', 'pending', 1, '2025-05-16 15:40:37', NULL, NULL, NULL, '2025-05-16 15:40:37', '2025-05-16 15:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `yearbook_stocks`
--

CREATE TABLE `yearbook_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `yearbook_platform_id` bigint(20) UNSIGNED NOT NULL,
  `initial_stock` int(11) NOT NULL DEFAULT 0,
  `available_stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearbook_stocks`
--

INSERT INTO `yearbook_stocks` (`id`, `yearbook_platform_id`, `initial_stock`, `available_stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 100, 100, 2300.00, '2025-05-16 14:43:31', '2025-05-16 14:43:31'),
(2, 2, 100, 100, 2300.00, '2025-05-16 14:43:31', '2025-05-16 14:43:31'),
(3, 3, 100, 100, 2300.00, '2025-05-16 14:43:31', '2025-05-16 14:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `yearbook_subscriptions`
--

CREATE TABLE `yearbook_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `yearbook_platform_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_type` varchar(255) DEFAULT NULL,
  `jacket_size` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_confirmed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `order_notes` text DEFAULT NULL,
  `shipping_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `purchase_type` varchar(255) DEFAULT 'current_subscription'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulletins`
--
ALTER TABLE `bulletins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bulletins_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_user_id_foreign` (`user_id`),
  ADD KEY `cart_items_yearbook_platform_id_foreign` (`yearbook_platform_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colleges_name_unique` (`name`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_college_id_name_unique` (`college_id`,`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `majors_course_id_name_unique` (`course_id`,`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_processed_by_foreign` (`processed_by`),
  ADD KEY `orders_claimed_processed_by_foreign` (`claimed_processed_by`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_yearbook_platform_id_foreign` (`yearbook_platform_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `role_names`
--
ALTER TABLE `role_names`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_names_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `staff_invitations`
--
ALTER TABLE `staff_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_invitations_email_unique` (`email`),
  ADD UNIQUE KEY `staff_invitations_token_unique` (`token`),
  ADD KEY `staff_invitations_role_name_id_foreign` (`role_name_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_birthdate_index` (`birthdate`),
  ADD KEY `users_role_name_id_foreign` (`role_name_id`);

--
-- Indexes for table `yearbook_photos`
--
ALTER TABLE `yearbook_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yearbook_photos_user_id_foreign` (`user_id`);

--
-- Indexes for table `yearbook_platforms`
--
ALTER TABLE `yearbook_platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yearbook_platforms_year_unique` (`year`),
  ADD KEY `yearbook_platforms_is_active_index` (`is_active`);

--
-- Indexes for table `yearbook_profiles`
--
ALTER TABLE `yearbook_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yearbook_profiles_user_id_unique` (`user_id`),
  ADD KEY `yearbook_profiles_college_id_foreign` (`college_id`),
  ADD KEY `yearbook_profiles_course_id_foreign` (`course_id`),
  ADD KEY `yearbook_profiles_major_id_foreign` (`major_id`),
  ADD KEY `yearbook_profiles_yearbook_platform_id_foreign` (`yearbook_platform_id`),
  ADD KEY `yearbook_profiles_payment_confirmed_by_foreign` (`payment_confirmed_by`);

--
-- Indexes for table `yearbook_stocks`
--
ALTER TABLE `yearbook_stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yearbook_stocks_yearbook_platform_id_unique` (`yearbook_platform_id`);

--
-- Indexes for table `yearbook_subscriptions`
--
ALTER TABLE `yearbook_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yearbook_subscriptions_user_id_yearbook_platform_id_unique` (`user_id`,`yearbook_platform_id`),
  ADD KEY `yearbook_subscriptions_yearbook_platform_id_foreign` (`yearbook_platform_id`),
  ADD KEY `yearbook_subscriptions_payment_confirmed_by_foreign` (`payment_confirmed_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulletins`
--
ALTER TABLE `bulletins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_names`
--
ALTER TABLE `role_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_invitations`
--
ALTER TABLE `staff_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yearbook_photos`
--
ALTER TABLE `yearbook_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yearbook_platforms`
--
ALTER TABLE `yearbook_platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yearbook_profiles`
--
ALTER TABLE `yearbook_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yearbook_stocks`
--
ALTER TABLE `yearbook_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yearbook_subscriptions`
--
ALTER TABLE `yearbook_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bulletins`
--
ALTER TABLE `bulletins`
  ADD CONSTRAINT `bulletins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_yearbook_platform_id_foreign` FOREIGN KEY (`yearbook_platform_id`) REFERENCES `yearbook_platforms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `majors_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_claimed_processed_by_foreign` FOREIGN KEY (`claimed_processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_yearbook_platform_id_foreign` FOREIGN KEY (`yearbook_platform_id`) REFERENCES `yearbook_platforms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_invitations`
--
ALTER TABLE `staff_invitations`
  ADD CONSTRAINT `staff_invitations_role_name_id_foreign` FOREIGN KEY (`role_name_id`) REFERENCES `role_names` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_name_id_foreign` FOREIGN KEY (`role_name_id`) REFERENCES `role_names` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `yearbook_photos`
--
ALTER TABLE `yearbook_photos`
  ADD CONSTRAINT `yearbook_photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `yearbook_profiles`
--
ALTER TABLE `yearbook_profiles`
  ADD CONSTRAINT `yearbook_profiles_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `yearbook_profiles_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `yearbook_profiles_major_id_foreign` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `yearbook_profiles_payment_confirmed_by_foreign` FOREIGN KEY (`payment_confirmed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `yearbook_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `yearbook_profiles_yearbook_platform_id_foreign` FOREIGN KEY (`yearbook_platform_id`) REFERENCES `yearbook_platforms` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `yearbook_stocks`
--
ALTER TABLE `yearbook_stocks`
  ADD CONSTRAINT `yearbook_stocks_yearbook_platform_id_foreign` FOREIGN KEY (`yearbook_platform_id`) REFERENCES `yearbook_platforms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `yearbook_subscriptions`
--
ALTER TABLE `yearbook_subscriptions`
  ADD CONSTRAINT `yearbook_subscriptions_payment_confirmed_by_foreign` FOREIGN KEY (`payment_confirmed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `yearbook_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `yearbook_subscriptions_yearbook_platform_id_foreign` FOREIGN KEY (`yearbook_platform_id`) REFERENCES `yearbook_platforms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
