-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 03:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visited` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `due_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposited_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_without_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_with_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_items`
--

CREATE TABLE `billing_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billing_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `doctor_id`, `date`, `patient_id`, `created_at`, `updated_at`, `status`, `reason`, `confirm`) VALUES
(1, 2, '2023-04-18 02:02:00', 3, '2023-04-14 01:55:18', '2023-04-16 19:19:52', 1, NULL, 0),
(2, 2, '2023-04-18 02:32:00', 3, '2023-04-16 06:07:39', '2023-04-16 06:52:29', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Eyes', '2023-04-14 01:27:39', '2023-04-14 01:27:39'),
(2, 'Dental', '2023-04-14 01:27:39', '2023-04-14 01:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `speciality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depart_id` bigint(20) UNSIGNED NOT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designiation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_patient_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_on` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_on`)),
  `available_from` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_from`)),
  `available_to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`available_to`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `speciality`, `qualification`, `blood_group`, `depart_id`, `weight`, `height`, `designiation`, `per_patient_time`, `available_on`, `available_from`, `available_to`, `created_at`, `updated_at`) VALUES
(1, 2, 'Aute facilis quis ip', 'Debitis est consect', 'A-', 2, 'Irure esse debitis', 'Officia iste dolor d', 'Voluptates culpa be', '30', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"]', '[\"00:18\",\"02:02\",\"08:02\",\"08:50\",\"06:14\",\"06:16\",\"00:01\"]', '[\"12:24\",\"11:49\",\"14:21\",\"23:25\",\"15:52\",\"17:38\",\"11:56\"]', '2023-04-14 01:42:02', '2023-04-16 06:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trade_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generic_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `trade_name`, `generic_name`, `note`, `category_id`, `created_at`, `updated_at`, `price`) VALUES
(3, 'Advil', 'Advil', NULL, 11, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(4, 'Protate', 'Protate', NULL, 11, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(5, 'Gaviscon', 'Gaviscon', NULL, 12, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(6, 'Milk of Magnesium', 'Milk of Magnesium', NULL, 12, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(7, 'Prozac', 'Prozac', NULL, 13, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(8, 'Lexapro', 'Lexapro', NULL, 13, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(9, 'Rythmol', 'Rythmol', NULL, 14, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(10, 'Temocarid', 'Temocarid', NULL, 14, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(11, 'Flagyl', 'Flagyl', NULL, 15, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(12, 'Cipro', 'Cipro', NULL, 15, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(13, 'Augmentin', 'Augmentin', NULL, 16, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(14, 'Levaquin', 'Levaquin', NULL, 16, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(15, 'Xarelto', 'Xarelto', NULL, 17, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(16, 'Pradaxa', 'Pradaxa', NULL, 17, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(17, 'Dusulepin', 'Dusulepin', NULL, 18, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(18, 'Escitalopram', 'Escitalopram', NULL, 18, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(19, 'Loperamide', 'Loperamide', NULL, 19, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(20, 'Kaopectate', 'Kaopectate', NULL, 19, '2023-05-02 08:28:18', '2023-05-02 08:28:18', '10.00'),
(21, 'Dexamethasone', 'Dexamethasone', NULL, 20, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(22, 'Dulasetron', 'Dulasetron', NULL, 20, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(23, 'Nystatin', 'Nystatin', NULL, 21, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(24, 'Amphothericin', 'Amphothericin', NULL, 21, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(25, 'Astelin', 'Astelin', NULL, 22, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(26, 'Claritin', 'Claritin', NULL, 22, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(27, 'Norvase', 'Norvase', NULL, 23, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(28, 'Sular', 'Sular', NULL, 23, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(29, 'Celeston', 'Celeston', NULL, 24, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(30, 'Decadron', 'Decadron', NULL, 24, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(31, 'Peramivir', 'Peramivir', NULL, 25, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(32, 'Normir', 'Normir', NULL, 25, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(33, 'Sodium picosulphate', 'Sodium picosulphate', NULL, 26, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(34, 'Midazolam', 'Midazolam', NULL, 27, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(35, 'Pentobarbital', 'Pentobarbital', NULL, 27, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(36, 'Xanax', 'Xanax', NULL, 28, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(37, 'Valcum', 'Valcum', NULL, 28, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(38, 'Sulfonylureas', 'Sulfonylureas', NULL, 29, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00'),
(39, 'Biguanides', 'Biguanides', NULL, 29, '2023-05-02 08:28:19', '2023-05-02 08:28:19', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `drug_type`
--

CREATE TABLE `drug_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drug_type`
--

INSERT INTO `drug_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(11, 'Analgesics', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(12, 'Antacids', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(13, 'Antionxiety Drugs', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(14, 'Antiarrhythmics', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(15, 'Antibacterial', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(16, 'Antibiotics', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(17, 'Anticoagulants', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(18, 'Antidepressants', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(19, 'Antidiarrheals', '2023-05-02 08:28:18', '2023-05-02 08:28:18'),
(20, 'Antiemetics', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(21, 'Antifungal', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(22, 'Antihistamines', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(23, 'Antihypertensive', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(24, 'Corticosteroid', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(25, 'Antiviral', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(26, 'Lexative', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(27, 'Sedatives', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(28, 'Tranquilizers', '2023-05-02 08:28:19', '2023-05-02 08:28:19'),
(29, 'Hypoglycemic', '2023-05-02 08:28:19', '2023-05-02 08:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historys`
--

CREATE TABLE `historys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_10_000506_create_drugs_table', 1),
(5, '2020_09_10_103451_create_prescriptions_table', 1),
(6, '2020_09_10_154523_create_prescription_drugs_table', 1),
(7, '2020_09_14_174033_create_patients_table', 1),
(8, '2020_09_16_095938_create_settings_table', 1),
(9, '2020_09_16_230135_create_tests_table', 1),
(10, '2020_09_16_230830_create_prescription_tests_table', 1),
(11, '2020_09_18_010549_create_appointments_table', 1),
(12, '2020_09_18_180127_create_doctors_table', 1),
(13, '2020_09_19_164615_create_billings_table', 1),
(14, '2020_09_19_180540_create_billing_items_table', 1),
(15, '2020_09_29_185732_create_documents_table', 1),
(16, '2021_11_22_232428_add_balance_to_billings_table', 1),
(17, '2021_11_23_132554_create_historys_table', 1),
(18, '2022_05_27_000537_add_reason_to_appointments_table', 1),
(19, '2022_06_12_123945_create_permission_tables', 1),
(20, '2022_06_13_132658_add_image_to_users_table', 1),
(21, '2023_04_11_041640_create_departments_table', 1),
(22, '2023_04_12_042024_create_schedules_table', 1),
(23, '2023_04_13_173230_create_bookings_table', 1),
(24, '2023_04_13_232706_add_new_status_to_bookings', 1),
(25, '2023_04_13_233132_add_new_reason_to_bookings', 1),
(26, '2023_04_16_110901_add_reason_to_bookings', 2),
(27, '2023_04_16_113450_add_new_visit_to_bookings', 3),
(28, '2023_04_20_230954_create_drug_type_table', 4),
(29, '2023_04_20_232604_create_sick_type_table', 5),
(30, '2023_04_21_191250_add_paid_to_prescriptions', 6),
(31, '2023_04_24_200310_create_stocks_table', 7),
(32, '2023_04_24_200730_create_stock_categories_table', 8),
(33, '2023_04_25_183831_request_furniture', 9),
(34, '2023_04_25_184925_add_qty_to_request_furniture', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(3, 'App\\User', 2),
(4, 'App\\User', 6),
(5, 'App\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('doctor@getdoctorino.com', '$2y$10$JlfrCvo0y/uESdBcxqe0o.7SKSCJEAu0lRtglGQCR9AP1QI59mUyC', '2023-04-27 18:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `birthday`, `phone`, `gender`, `blood`, `adress`, `weight`, `height`, `created_at`, `updated_at`) VALUES
(1, 3, '1981-12-22', '+1 (553) 588-2323', 'Female', 'O+', 'Cupiditate aut quae', '12', '21', '2023-04-14 01:43:13', '2023-04-14 01:43:13'),
(2, 4, '1980-10-03', '+1 (817) 706-4112', 'Male', 'A-', 'Dolorum aut eveniet', '20', '4', '2023-04-16 19:40:52', '2023-04-16 19:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add patient', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(2, 'view patient', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(3, 'edit patient', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(4, 'view all patients', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(5, 'delete patient', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(6, 'create health history', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(7, 'delete health history', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(8, 'add medical files', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(9, 'delete medical files', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(10, 'create appointment', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(11, 'view all appointments', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(12, 'delete appointment', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(13, 'edit appointment', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(14, 'create prescription', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(15, 'view prescription', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(16, 'view all prescriptions', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(17, 'edit prescription', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(18, 'delete prescription', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(19, 'print prescription', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(20, 'create drug', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(21, 'edit drug', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(22, 'view drug', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(23, 'delete drug', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(24, 'view all drugs', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(25, 'create diagnostic test', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(26, 'edit diagnostic test', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(27, 'view all diagnostic tests', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(28, 'delete diagnostic test', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(29, 'create invoice', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(30, 'edit invoice', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(31, 'view invoice', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(32, 'view all invoices', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(33, 'delete invoice', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(34, 'print invoice', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(35, 'manage settings', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(36, 'manage roles', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(38, 'view appointment', 'web', '2023-04-16 21:03:02', '2023-04-16 21:03:02'),
(39, 'view doctor', 'web', '2023-04-20 16:35:51', '2023-04-20 16:35:51'),
(40, 'edit doctor', 'web', '2023-04-20 16:35:51', '2023-04-20 16:35:51'),
(41, 'create doctor', 'web', '2023-04-20 16:35:51', '2023-04-20 16:35:51'),
(42, 'create stock', 'web', '2023-04-24 14:55:16', '2023-04-24 14:55:16'),
(43, 'edit stock', 'web', '2023-04-24 14:55:16', '2023-04-24 14:55:16'),
(44, 'view stock', 'web', '2023-04-24 14:55:16', '2023-04-24 14:55:16'),
(45, 'view all stock', 'web', '2023-04-24 14:55:16', '2023-04-24 14:55:16'),
(46, 'delete stock', 'web', '2023-04-24 14:55:16', '2023-04-24 14:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `reference` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `doctor_id`, `reference`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'p27769', '2023-04-23 05:25:54', '2023-04-23 05:25:54'),
(2, 3, 2, 'p91233', '2023-04-23 05:45:03', '2023-04-23 05:45:03'),
(3, 4, 2, 'p75960', '2023-04-24 13:50:06', '2023-04-24 13:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_drugs`
--

CREATE TABLE `prescription_drugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `drug_id` bigint(20) UNSIGNED NOT NULL,
  `sick_type_id` bigint(20) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strength` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drug_advice` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_tests`
--

CREATE TABLE `prescription_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescription_tests`
--

INSERT INTO `prescription_tests` (`id`, `prescription_id`, `test_id`, `description`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '454', '2023-04-24 13:30:35', '2023-04-24 13:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `request_furniture`
--

CREATE TABLE `request_furniture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `stock_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_furniture`
--

INSERT INTO `request_furniture` (`id`, `user_id`, `approved`, `stock_id`, `created_at`, `updated_at`, `qty`) VALUES
(1, 1, 0, 1, '2023-04-25 14:49:05', '2023-04-25 16:07:33', 12),
(2, 1, 0, 1, '2023-04-25 14:51:33', '2023-04-25 16:07:34', 12),
(3, 1, 1, 1, '2023-04-25 14:54:19', '2023-04-25 16:07:32', 12),
(4, 6, 1, 1, '2023-04-25 16:54:52', '2023-04-26 13:32:57', 34);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(2, 'Patient', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(3, 'Doctor', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(4, 'Pharmist', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38'),
(5, 'Supervisor', 'web', '2023-04-14 01:27:38', '2023-04-14 01:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 3),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 4),
(16, 1),
(16, 4),
(17, 1),
(17, 4),
(18, 1),
(19, 1),
(20, 1),
(20, 4),
(21, 1),
(21, 4),
(22, 1),
(22, 4),
(23, 1),
(24, 1),
(24, 4),
(25, 1),
(25, 4),
(26, 1),
(26, 4),
(27, 1),
(27, 4),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(38, 1),
(38, 2),
(38, 3),
(39, 1),
(39, 3),
(39, 4),
(41, 1),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_name`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'system_name', 'Doctorino Doctor Chamber', NULL, NULL),
(2, 'address', '150 Logts : Bloc 16 N° 02 OUED TARFA - Draria', NULL, NULL),
(3, 'phone', '+213 657 04 19 93', NULL, NULL),
(4, 'hospital_email', 'hospital.email@gmail.com', NULL, NULL),
(5, 'currency', '$', NULL, NULL),
(6, 'vat', '19', NULL, NULL),
(7, 'language', 'en', NULL, NULL),
(8, 'appointment_interval', '30', NULL, NULL),
(9, 'saturday_from', NULL, NULL, NULL),
(10, 'saturday_to', NULL, NULL, NULL),
(11, 'sunday_from', NULL, NULL, NULL),
(12, 'sunday_to', NULL, NULL, NULL),
(13, 'monday_from', '08:00', NULL, NULL),
(14, 'monday_to', '17:00', NULL, NULL),
(15, 'tuesday_from', '08:00', NULL, NULL),
(16, 'tuesday_to', '17:00', NULL, NULL),
(17, 'wednesday_from', '08:00', NULL, NULL),
(18, 'wednesday_to', '17:00', NULL, NULL),
(19, 'thursday_from', '08:00', NULL, NULL),
(20, 'thursday_to', '17:00', NULL, NULL),
(21, 'friday_from', '08:00', NULL, NULL),
(22, 'friday_to', '17:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sick_type`
--

CREATE TABLE `sick_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sick_type`
--

INSERT INTO `sick_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Heart', '2023-04-20 18:29:15', '2023-04-20 18:29:15'),
(2, 'Stomach', '2023-04-20 18:29:15', '2023-04-20 18:29:15'),
(3, 'Headache', '2023-04-20 18:29:15', '2023-04-20 18:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_category_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `stock_category_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'Lani Hunter Table', 1, 708, '2023-04-24 17:06:41', '2023-04-24 17:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `stock_categories`
--

CREATE TABLE `stock_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_categories`
--

INSERT INTO `stock_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tables', '2023-04-24 15:28:55', '2023-04-24 19:38:44'),
(2, 'Chairs', '2023-04-24 15:28:55', '2023-04-24 15:28:55'),
(3, 'Desk', '2023-04-24 15:28:55', '2023-04-24 15:28:55'),
(4, 'Pen', '2023-04-24 15:28:55', '2023-04-24 15:28:55'),
(5, 'Dustbin', '2023-04-24 15:28:55', '2023-04-24 15:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 100.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `comment`, `created_at`, `updated_at`, `price`) VALUES
(1, 'Sample Test', '123', '2023-04-23 05:40:23', '2023-04-23 05:40:23', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Female',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'patient',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `birthday`, `gender`, `address`, `email_verified_at`, `password`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Doctorino', 'doctor@getdoctorino.com', NULL, NULL, 'Female', NULL, NULL, '$2y$10$/12vdU/nNZEEmoXm1c/K8.s.8GLAHAPCIHQPDYcB6VZIQozpn9cqC', 'admin', NULL, NULL, '2023-04-14 01:27:39', '2023-04-14 01:27:39'),
(2, 'Oliver Lowe', 'xirahaxuxu@mailinator.com', '+1 (851) 684-5237', '1986-09-04', 'Male', 'Molestiae commodo in', NULL, '$2y$10$/12vdU/nNZEEmoXm1c/K8.s.8GLAHAPCIHQPDYcB6VZIQozpn9cqC', 'doctor', NULL, NULL, '2023-04-14 01:42:02', '2023-04-14 01:42:02'),
(3, 'Travis Spencer', 'zuhypuv@mailinator.com', NULL, NULL, 'Female', NULL, NULL, '$2y$10$/12vdU/nNZEEmoXm1c/K8.s.8GLAHAPCIHQPDYcB6VZIQozpn9cqC', 'patient', '', NULL, '2023-04-14 01:43:13', '2023-04-14 01:43:13'),
(4, 'Randall Whitehead', 'mapawydo@mailinator.com', NULL, NULL, 'Female', NULL, NULL, '$2y$10$/12vdU/nNZEEmoXm1c/K8.s.8GLAHAPCIHQPDYcB6VZIQozpn9cqC', 'patient', 'Pm2dY4OPnF2DASK-patient.jpg', NULL, '2023-04-16 19:40:52', '2023-04-16 19:40:52'),
(6, 'Pharmist1', 'pharmist@mail.com', '+1 (287) 121-9006', NULL, 'Female', NULL, NULL, '$2y$10$/12vdU/nNZEEmoXm1c/K8.s.8GLAHAPCIHQPDYcB6VZIQozpn9cqC', 'Pharmist', NULL, NULL, '2023-04-20 16:22:44', '2023-04-20 16:22:44'),
(7, 'Stock Supervisor', 'stocksupervisior@mail.com', '1234567890', NULL, 'Female', NULL, NULL, '$2y$10$/12vdU/nNZEEmoXm1c/K8.s.8GLAHAPCIHQPDYcB6VZIQozpn9cqC', 'Supervisor', NULL, NULL, '2023-04-24 14:31:24', '2023-04-24 14:31:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`);

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billings_user_id_foreign` (`user_id`);

--
-- Indexes for table `billing_items`
--
ALTER TABLE `billing_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_items_billing_id_foreign` (`billing_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_type`
--
ALTER TABLE `drug_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historys`
--
ALTER TABLE `historys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historys_user_id_foreign` (`user_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `prescription_drugs`
--
ALTER TABLE `prescription_drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_drugs_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_drugs_drug_id_foreign` (`drug_id`);

--
-- Indexes for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_tests_prescription_id_foreign` (`prescription_id`),
  ADD KEY `prescription_tests_test_id_foreign` (`test_id`);

--
-- Indexes for table `request_furniture`
--
ALTER TABLE `request_furniture`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sick_type`
--
ALTER TABLE `sick_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_categories`
--
ALTER TABLE `stock_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_items`
--
ALTER TABLE `billing_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `drug_type`
--
ALTER TABLE `drug_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historys`
--
ALTER TABLE `historys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescription_drugs`
--
ALTER TABLE `prescription_drugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_furniture`
--
ALTER TABLE `request_furniture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sick_type`
--
ALTER TABLE `sick_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_categories`
--
ALTER TABLE `stock_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `billings`
--
ALTER TABLE `billings`
  ADD CONSTRAINT `billings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `billing_items`
--
ALTER TABLE `billing_items`
  ADD CONSTRAINT `billing_items_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `historys`
--
ALTER TABLE `historys`
  ADD CONSTRAINT `historys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_drugs`
--
ALTER TABLE `prescription_drugs`
  ADD CONSTRAINT `prescription_drugs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_drugs_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD CONSTRAINT `prescription_tests_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescription_tests_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
