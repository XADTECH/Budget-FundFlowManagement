-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 07:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fundflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_details` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `balance_amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_project`
--

CREATE TABLE `budget_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_code` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `month` date NOT NULL,
  `approval_status` varchar(255) DEFAULT 'pending',
  `daily_payment_expense` decimal(15,2) DEFAULT NULL,
  `lpo_amount` decimal(15,2) DEFAULT NULL,
  `bal_under_over_budget` decimal(15,2) DEFAULT NULL,
  `total_budget_allocated` decimal(15,2) DEFAULT NULL,
  `total_dpm_expense` decimal(15,2) DEFAULT NULL,
  `total_lpo_expense` decimal(15,2) DEFAULT NULL,
  `total_budget` decimal(15,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Good',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_project`
--

INSERT INTO `budget_project` (`id`, `reference_code`, `start_date`, `end_date`, `project_id`, `unit_id`, `manager_id`, `client_id`, `region`, `site_name`, `month`, `approval_status`, `daily_payment_expense`, `lpo_amount`, `bal_under_over_budget`, `total_budget_allocated`, `total_dpm_expense`, `total_lpo_expense`, `total_budget`, `status`, `created_at`, `updated_at`, `description`) VALUES
(10, 'SEP2024-713h-OutSource-nabeel-Etisalat', '2024-08-29', '2024-08-30', 1, 1, 19, 1, 'Abu Dhabi', 'Stadium Abu Hail, UAE', '2024-09-07', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Good', '2024-08-29 06:16:44', '2024-08-29 06:16:44', 'starting new Project'),
(12, 'BP090320240001-WR-OLT-NotOutSource-nabeel-Etisalat', '2024-09-03', '2024-11-02', 2, 2, 19, 1, 'Dubai', 'abu hail, dubai', '2024-09-01', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Good', '2024-09-03 01:00:33', '2024-09-03 01:00:33', 'starting new'),
(13, 'BP090320240002-WR-OLT-OutSource-nabeel-DU', '2024-09-03', '2024-09-04', 2, 1, 19, 2, 'Dubai', NULL, '2024-09-04', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Good', '2024-09-03 01:05:18', '2024-09-03 01:05:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_clients`
--

CREATE TABLE `business_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clientname` varchar(255) NOT NULL,
  `clientdetail` varchar(255) DEFAULT NULL,
  `clientremark` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_clients`
--

INSERT INTO `business_clients` (`id`, `clientname`, `clientdetail`, `clientremark`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Etisalat', NULL, NULL, 'Active', '2024-08-29 01:40:28', '2024-08-29 01:40:28'),
(2, 'DU', NULL, NULL, 'Active', '2024-08-29 01:40:34', '2024-08-29 01:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `business_units`
--

CREATE TABLE `business_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(255) NOT NULL,
  `unitdetail` varchar(255) DEFAULT NULL,
  `unitremark` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_units`
--

INSERT INTO `business_units` (`id`, `source`, `unitdetail`, `unitremark`, `status`, `created_at`, `updated_at`) VALUES
(1, 'OutSource', NULL, NULL, 'Active', '2024-08-29 01:40:18', '2024-08-29 01:40:18'),
(2, 'none outsource', 'Not Entered', 'Not Entered', 'Active', '2024-08-29 01:40:21', '2024-09-03 01:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `capital_expenditure`
--

CREATE TABLE `capital_expenditure` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `sn` varchar(255) NOT NULL DEFAULT '4.1',
  `type` varchar(255) DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `capital_expenditure`
--

INSERT INTO `capital_expenditure` (`id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `created_at`, `updated_at`) VALUES
(1, 10, '4.1', 'Other', 'DU CIVIL', '1', 'CAPEX', 'Tools', '5.1 Cable Detector', 'new hiring', 2000.00, 1, 1, 2000.00, 2000.00, '2024-09-02 06:50:52', '2024-09-02 06:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `cost_overhead`
--

CREATE TABLE `cost_overhead` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `in_direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `sn` varchar(255) NOT NULL DEFAULT '2.4',
  `type` varchar(255) NOT NULL,
  `contract` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_overhead`
--

INSERT INTO `cost_overhead` (`id`, `in_direct_cost_id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2.4', 'Cost', 'DU CIVIL', '1', 'OPEX', 'overhead', '2.4.1 HO Cost', 'new hiring', 2000.00, 1, 1, 2000.00, 2000.00, '2024-09-01 12:07:51', '2024-09-01 12:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `direct_cost`
--

CREATE TABLE `direct_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direct_cost`
--

INSERT INTO `direct_cost` (`id`, `budget_project_id`, `total_cost`, `created_at`, `updated_at`) VALUES
(4, 10, NULL, '2024-08-31 05:24:29', '2024-08-31 05:24:29'),
(5, 11, NULL, '2024-09-03 00:32:56', '2024-09-03 00:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `facility_cost`
--

CREATE TABLE `facility_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `sn` varchar(255) NOT NULL DEFAULT '2.2',
  `type` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `contract` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_cost`
--

INSERT INTO `facility_cost` (`id`, `direct_cost_id`, `budget_project_id`, `sn`, `type`, `project`, `contract`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `created_at`, `updated_at`) VALUES
(2, 4, 10, '2.2', 'Cost', '1', 'DU CIVIL', 'CAPEX', 'Facilities', '4.1 Sedan', 'Contractor', 1000.00, 1, 1, 1000.00, 1000.00, '2024-09-01 04:26:21', '2024-09-01 04:26:21'),
(3, 4, 10, '2.2', 'Cost', '1', 'DU CIVIL', 'CAPEX', 'Facilities', '4.2 Double Cabin 4x4', 'Contractor', 1000.00, 1, 1, 1000.00, 1000.00, '2024-09-01 04:30:49', '2024-09-01 04:30:49');

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
-- Table structure for table `financial_cost`
--

CREATE TABLE `financial_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `in_direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `sn` varchar(255) NOT NULL DEFAULT '2.5',
  `type` varchar(255) NOT NULL,
  `contract` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_cost`
--

INSERT INTO `financial_cost` (`id`, `in_direct_cost_id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '2.5', 'Cost', 'DU CIVIL', '1', 'OPEX', 'Risk', '2.5.1 Risk', 'Contractor', 2000.00, 1, 1, 2000.00, 2000.00, '2024-09-01 12:28:20', '2024-09-01 12:28:20'),
(2, 1, 10, '2.5', 'Cost', 'DU CIVIL', '1', 'OPEX', 'Finance', 'starting new', '2.5.2 Finance cost', 1000.00, 1, 1, 1000.00, 1000.00, '2024-09-01 12:35:08', '2024-09-01 12:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `indirect_cost`
--

CREATE TABLE `indirect_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `indirect_cost`
--

INSERT INTO `indirect_cost` (`id`, `budget_project_id`, `total_cost`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, '2024-09-01 12:05:07', '2024-09-01 12:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `material_cost`
--

CREATE TABLE `material_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `sn` varchar(255) NOT NULL DEFAULT '2.3',
  `type` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `contract` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_cost`
--

INSERT INTO `material_cost` (`id`, `direct_cost_id`, `budget_project_id`, `sn`, `type`, `project`, `po`, `expenses`, `contract`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `created_at`, `updated_at`) VALUES
(1, 4, 10, '2.3', 'Cost', '1', 'OPEX', 'Material', 'DU CIVIL', '2.3.1 Consumed Material - PL', 'Contractor', 1000.00, 1, 1, 1000.00, 1000.00, '2024-09-01 04:37:21', '2024-09-01 04:37:21');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_08_19_061943_create_planned_cash_table', 1),
(7, '2024_08_19_062207_create_projects_table', 1),
(8, '2024_08_19_175130_create_planed_cash_opening_balances_table', 1),
(9, '2024_08_20_132501_bank', 1),
(10, '2024_08_26_083007_create_business_units_table', 1),
(11, '2024_08_26_111241_create_business_clients_table', 1),
(12, '2024_08_29_064229_create_budget_project_table', 2),
(13, '2024_08_30_104724_create_direct_cost_table', 3),
(14, '2024_08_30_104731_create_indirect_cost_table', 4),
(15, '2024_08_30_111452_create_salaries_table', 5),
(16, '2024_08_30_112111_create_facility_costs_table', 6),
(17, '2024_08_30_1114522_create_salaries_table', 7),
(18, '2024_08_30_1121111_create_facility_costs_table', 8),
(19, '2024_08_30_114154_create_material_cost_table', 9),
(20, '2024_08_30_115423_create_cost_overhead_table', 10),
(21, '2024_08_30_115902_create_financial_cost_table', 11),
(22, '2024_08_30_115424_create_cost_overhead_table', 12),
(23, '2024_08_31_1114522_create_salaries_table', 13),
(24, '2024_08_31_104724_create_direct_cost_table', 14),
(25, '2024_08_31_1114523_create_salaries_table', 15),
(26, '2024_08_31_1114524_create_salaries_table', 16),
(27, '2024_08_31_1114525_create_salaries_table', 17),
(28, '2024_08_31_1114526_create_salaries_table', 18),
(29, '2024_08_30_114155_create_material_cost_table', 19),
(30, '2024_08_30_114156_create_material_cost_table', 20),
(31, '2024_08_30_1121112_create_facility_costs_table', 21),
(32, '2024_08_31_115902_create_financial_cost_table', 22),
(33, '2024_08_31_115424_create_cost_overhead_table', 23),
(34, '2024_08_31_104731_create_indirect_cost_table', 24),
(35, '2024_09_02_072221_create_revenue_plans_table', 25),
(36, '2024_09_02_103513_create_capital_expenditure_table', 26),
(37, '2024_09_03_045117_create_project_budget_sequence_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `planned_cash`
--

CREATE TABLE `planned_cash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `planned_amount` decimal(15,2) DEFAULT NULL,
  `received_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planned_cash`
--

INSERT INTO `planned_cash` (`id`, `project_id`, `planned_amount`, `received_amount`, `created_at`, `updated_at`) VALUES
(1, '1', 1000.00, NULL, '2024-09-01 12:35:42', '2024-09-01 12:35:42'),
(2, '1', NULL, 500.00, '2024-09-01 12:36:00', '2024-09-01 12:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `planned_cash_opening_balances`
--

CREATE TABLE `planned_cash_opening_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planned_cash_opening_balances`
--

INSERT INTO `planned_cash_opening_balances` (`id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 100000.00, '2024-09-01 12:35:27', '2024-09-01 12:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `projectdetail` varchar(255) DEFAULT NULL,
  `projectremark` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `projectdetail`, `projectremark`, `status`, `created_at`, `updated_at`) VALUES
(1, '713h', NULL, NULL, 'Active', '2024-08-29 01:40:41', '2024-08-29 01:40:41'),
(2, 'WR-OLT', NULL, NULL, 'Active', '2024-08-29 01:40:50', '2024-08-29 01:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `project_budget_sequence`
--

CREATE TABLE `project_budget_sequence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_sequence` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_budget_sequence`
--

INSERT INTO `project_budget_sequence` (`id`, `date`, `last_sequence`, `created_at`, `updated_at`) VALUES
(1, '09032024', 2, '2024-09-03 01:00:33', '2024-09-03 01:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_plans`
--

CREATE TABLE `revenue_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `indirect_cost_id` bigint(20) UNSIGNED NOT NULL,
  `sn` int(11) NOT NULL DEFAULT 1,
  `type` varchar(255) NOT NULL,
  `project` varchar(255) DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `total_profit` decimal(15,2) DEFAULT NULL,
  `net_profit_before_tax` decimal(15,2) DEFAULT NULL,
  `tax` decimal(15,2) DEFAULT NULL,
  `net_profit_after_tax` decimal(15,2) DEFAULT NULL,
  `profit_percentage` decimal(5,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revenue_plans`
--

INSERT INTO `revenue_plans` (`id`, `budget_project_id`, `direct_cost_id`, `indirect_cost_id`, `sn`, `type`, `project`, `contract`, `description`, `amount`, `total_profit`, `net_profit_before_tax`, `tax`, `net_profit_after_tax`, `profit_percentage`, `status`, `created_at`, `updated_at`) VALUES
(7, 10, 4, 1, 1, 'Cost', '1', 'DU CIVIL', 'Civil Project', 200000.00, 200000.00, 179000.00, 16110.00, 162890.00, 81.45, NULL, '2024-09-02 05:02:32', '2024-09-02 05:02:32'),
(8, 10, 4, 1, 1, 'Cost', '1', 'DU CIVIL', 'NOC Payment', 100000.00, 300000.00, 279000.00, 25110.00, 253890.00, 253.89, NULL, '2024-09-02 05:03:12', '2024-09-02 05:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `sn` varchar(255) NOT NULL DEFAULT '2.1',
  `type` varchar(255) NOT NULL,
  `contract` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `direct_cost_id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `created_at`, `updated_at`) VALUES
(4, 4, 10, '2.1', 'Cost', 'DU CIVIL', '1', 'CAPEX', 'salary', 'starting new Project', 'Contractor', 2000.00, 1, 1, 2000.00, 2000.00, '2024-08-31 05:24:29', '2024-08-31 05:24:29'),
(5, 4, 10, '2.1', 'Cost', 'DU CIVIL', '1', 'CAPEX', 'salary', 'Project Manager', 'new hiring', 3000.00, 1, 1, 3000.00, 3000.00, '2024-08-31 05:25:28', '2024-08-31 05:25:28'),
(6, 4, 10, '2.1', 'Cost', 'DU CIVIL', '2', 'OPEX', 'salary', 'starting new', 'Contractor', 2000.00, 2, 2, 8000.00, 2000.00, '2024-08-31 05:29:15', '2024-08-31 05:29:15'),
(8, 5, 11, '2.1', 'Cost', 'DU CIVIL', '1', 'OPEX', 'salary', 'starting new', 'new hiring', 2000.00, 1, 1, 2000.00, 2000.00, '2024-09-03 00:32:56', '2024-09-03 00:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `organization_unit` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `nationality`, `organization_unit`, `phone_number`, `password`, `role`, `permissions`, `profile_image`, `created_at`, `updated_at`) VALUES
(19, 'nabeel', 'javed', 'nabeeljaved2029@gmail.com', 'pak', 'Project', '0521077862', '$2y$12$EHZmQeCwCQ8wmA5H53V1suAans/2WT0qtykRfvx4WzxgUf411dJKG', 'Project Manager', '\"[\\\"Project Management\\\"]\"', '172499948757.jfif', '2024-08-29 05:51:09', '2024-08-29 05:51:09'),
(33, 'xad', 'tech', 'admin@xadtech.com', 'pak', 'admin', '0521077862', '$2y$12$WHWpYX5rpA3oSZYQYx.T6emR.1A.C2XfICThPWxCEvzfSistqapBW', 'Admin', '\"[\\\"Project Management\\\",\\\"Cash Flow Management\\\",\\\"Bank Management\\\",\\\"User Management\\\"]\"', '172499948757.jfif', '2024-08-30 02:31:28', '2024-08-30 02:31:28'),
(35, 'razik', 'javed', 'nabeeljaved22@gmail.com', NULL, 'admin', '0521077862', '$2y$12$Skm0hB6QTWYhht0JaxGGK.qpSx9gTBY9yCb6heir6pi2IjEK0Qm6S', 'Client Manager', '\"[\\\"Project Management\\\",\\\"Cash Flow Management\\\"]\"', '172499948757.jfif', '2024-08-30 02:36:34', '2024-08-30 02:36:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget_project`
--
ALTER TABLE `budget_project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `budget_project_reference_code_unique` (`reference_code`);

--
-- Indexes for table `business_clients`
--
ALTER TABLE `business_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_units`
--
ALTER TABLE `business_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capital_expenditure`
--
ALTER TABLE `capital_expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_overhead`
--
ALTER TABLE `cost_overhead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `direct_cost`
--
ALTER TABLE `direct_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility_cost`
--
ALTER TABLE `facility_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_cost`
--
ALTER TABLE `financial_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indirect_cost`
--
ALTER TABLE `indirect_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_cost`
--
ALTER TABLE `material_cost`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `planned_cash`
--
ALTER TABLE `planned_cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planned_cash_opening_balances`
--
ALTER TABLE `planned_cash_opening_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_budget_sequence`
--
ALTER TABLE `project_budget_sequence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_budget_sequence_date_index` (`date`);

--
-- Indexes for table `revenue_plans`
--
ALTER TABLE `revenue_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_project`
--
ALTER TABLE `budget_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `business_clients`
--
ALTER TABLE `business_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_units`
--
ALTER TABLE `business_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `capital_expenditure`
--
ALTER TABLE `capital_expenditure`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cost_overhead`
--
ALTER TABLE `cost_overhead`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `direct_cost`
--
ALTER TABLE `direct_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facility_cost`
--
ALTER TABLE `facility_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_cost`
--
ALTER TABLE `financial_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `indirect_cost`
--
ALTER TABLE `indirect_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `material_cost`
--
ALTER TABLE `material_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planned_cash`
--
ALTER TABLE `planned_cash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `planned_cash_opening_balances`
--
ALTER TABLE `planned_cash_opening_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_budget_sequence`
--
ALTER TABLE `project_budget_sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `revenue_plans`
--
ALTER TABLE `revenue_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
