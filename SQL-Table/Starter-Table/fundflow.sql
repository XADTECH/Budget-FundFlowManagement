-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 07:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `allocated_budget`
--

CREATE TABLE `allocated_budget` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `total_salary` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_facility_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_material_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_cost_overhead` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_financial_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_capital_expenditure` decimal(15,2) NOT NULL DEFAULT 0.00,
  `allocated_budget` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_dpm` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_lpo` decimal(15,2) NOT NULL DEFAULT 0.00,
  `reference_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allocated_budget`
--

INSERT INTO `allocated_budget` (`id`, `budget_project_id`, `total_salary`, `total_facility_cost`, `total_material_cost`, `total_cost_overhead`, `total_financial_cost`, `total_capital_expenditure`, `allocated_budget`, `total_dpm`, `total_lpo`, `reference_code`, `created_at`, `updated_at`) VALUES
(8, 5, 180000.00, 107000.00, 39000.00, 14000.00, 58000.00, 275000.00, 675000.00, 2000.00, 0.00, 'BP100320240003', '2024-10-10 07:58:57', '2024-10-10 08:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `approved_budget`
--

CREATE TABLE `approved_budget` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `total_salary` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_facility_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_material_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_cost_overhead` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_financial_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_capital_expenditure` decimal(15,2) NOT NULL DEFAULT 0.00,
  `approved_budget` decimal(15,2) NOT NULL DEFAULT 0.00,
  `expected_net_profit_after_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `expected_net_profit_before_tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `reference_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approved_budget`
--

INSERT INTO `approved_budget` (`id`, `budget_project_id`, `total_salary`, `total_facility_cost`, `total_material_cost`, `total_cost_overhead`, `total_financial_cost`, `total_capital_expenditure`, `approved_budget`, `expected_net_profit_after_tax`, `expected_net_profit_before_tax`, `reference_code`, `created_at`, `updated_at`) VALUES
(8, 5, 180000.00, 107000.00, 39200.00, 14922.10, 61572.00, 276100.00, 5276100.00, 3546548.37, 3897305.90, 'BP100320240003', '2024-10-10 07:57:36', '2024-10-10 07:57:36');

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
  `description` varchar(255) DEFAULT NULL,
  `budget_type` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `approval_status` varchar(255) DEFAULT 'pending',
  `bal_under_over_budget` decimal(15,2) DEFAULT NULL,
  `total_budget_allocated` decimal(15,2) DEFAULT NULL,
  `total_dpm_expense` decimal(15,2) DEFAULT NULL,
  `total_lpo_expense` decimal(15,2) DEFAULT NULL,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Good',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_project`
--

INSERT INTO `budget_project` (`id`, `reference_code`, `start_date`, `end_date`, `project_id`, `unit_id`, `manager_id`, `client_id`, `region`, `site_name`, `description`, `budget_type`, `country`, `month`, `approval_status`, `bal_under_over_budget`, `total_budget_allocated`, `total_dpm_expense`, `total_lpo_expense`, `approve_by`, `status`, `created_at`, `updated_at`) VALUES
(5, 'BP100320240003', '2024-10-03', '2024-11-03', 6, 2, 19, 1, 'Dubai', 'abu hail, dubai', 'starting new Project', 'Etisalat Managed Service', 'UAE', '2024-10-03', 'approve', NULL, 675000.00, NULL, NULL, 33, 'Good', '2024-10-03 07:18:04', '2024-10-10 07:58:57'),
(7, 'BP101020240002', '2024-10-10', '2024-11-10', 5, 3, 33, 3, 'Dubai', 'opal tower head office', 'Administration Expenses', 'Other', 'UAE', '2024-10-10', 'pending', NULL, 0.00, NULL, NULL, NULL, 'Good', '2024-10-10 08:25:29', '2024-10-10 08:46:23');

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
(2, 'DU', NULL, NULL, 'Active', '2024-08-29 01:40:34', '2024-08-29 01:40:34'),
(3, 'other', NULL, NULL, 'Active', '2024-10-01 02:35:10', '2024-10-01 02:35:10');

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
(2, 'none outsource', 'Not Entered', 'Not Entered', 'Active', '2024-08-29 01:40:21', '2024-09-03 01:04:29'),
(3, 'Other', NULL, NULL, 'Active', '2024-10-01 02:34:58', '2024-10-01 02:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `capital_expenditure`
--

CREATE TABLE `capital_expenditure` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `total_number` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `capital_expenditure`
--

INSERT INTO `capital_expenditure` (`id`, `budget_project_id`, `type`, `project`, `po`, `expenses`, `total_number`, `cost`, `description`, `status`, `total_cost`, `created_at`, `updated_at`) VALUES
(8, 5, 'Capital Expenditure', '1', 'CAPEX', 'Forklift', 1, 100000, 'Electric forklift for moving pallets and heavy items in warehouses.', 'warehouse purchase', 100000.00, '2024-10-03 08:53:29', '2024-10-03 08:53:29'),
(9, 5, 'Capital Expenditure', '1', 'CAPEX', 'Manual pallet jack for lifting and moving pallets in tight spaces.', 500, 5, 'Manual pallet jack for lifting and moving pallets in tight spaces.', 'in stock', 2500.00, '2024-10-03 08:54:45', '2024-10-03 08:54:45'),
(10, 5, 'Capital Expenditure', '1', 'CAPEX', 'Conveyor Belt', 2, 15000, 'Automated conveyor belt system for transporting goods within the facility.', 'warehouse machinery', 30000.00, '2024-10-03 08:56:00', '2024-10-03 08:56:00'),
(11, 5, 'Capital Expenditure', '1', 'CAPEX', '(WMS) Software', 1, 20000, 'Software solution for managing inventory and logistics operations.', 'required', 20000.00, '2024-10-03 08:57:41', '2024-10-03 08:57:41'),
(12, 5, 'Capital Expenditure', '1', 'CAPEX', 'Delivery Van', 4, 30000, 'Medium-sized delivery van for transporting goods to clients.', 'new aquire', 120000.00, '2024-10-03 08:58:44', '2024-10-03 08:58:44'),
(13, 5, 'Capital Expenditure', '1', 'CAPEX', 'Barcode Scanners', 12, 300, 'Handheld barcode scanners for tracking inventory in real-time.', 'required', 3600.00, '2024-10-03 09:00:47', '2024-10-03 09:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `cash_flows`
--

CREATE TABLE `cash_flows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `reference_code` varchar(255) NOT NULL,
  `cash_inflow` decimal(10,2) DEFAULT NULL,
  `cash_outflow` decimal(10,2) DEFAULT NULL,
  `committed_budget` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_flows`
--

INSERT INTO `cash_flows` (`id`, `date`, `description`, `category`, `reference_code`, `cash_inflow`, `cash_outflow`, `committed_budget`, `balance`, `budget_project_id`, `created_at`, `updated_at`) VALUES
(49, '2024-10-10', 'Initial Allocation', 'Salary', 'BP100320240003', 180000.00, 0.00, 180000.00, 180000.00, 5, '2024-10-10 07:58:57', '2024-10-10 07:58:57'),
(50, '2024-10-10', 'Initial Allocation', 'Facility', 'BP100320240003', 107000.00, 0.00, 107000.00, 107000.00, 5, '2024-10-10 07:58:57', '2024-10-10 07:58:57'),
(51, '2024-10-10', 'Initial Allocation', 'Material', 'BP100320240003', 39000.00, 0.00, 39000.00, 39000.00, 5, '2024-10-10 07:58:57', '2024-10-10 07:58:57'),
(52, '2024-10-10', 'Initial Allocation', 'Overhead', 'BP100320240003', 14000.00, 0.00, 14000.00, 14000.00, 5, '2024-10-10 07:58:57', '2024-10-10 07:58:57'),
(53, '2024-10-10', 'Initial Allocation', 'Financial', 'BP100320240003', 60000.00, 0.00, 60000.00, 58000.00, 5, '2024-10-10 07:58:57', '2024-10-10 08:07:42'),
(54, '2024-10-10', 'Initial Allocation', 'Capital Expenditure', 'BP100320240003', 275000.00, 0.00, 275000.00, 275000.00, 5, '2024-10-10 07:58:57', '2024-10-10 07:58:57'),
(55, '2024-10-10', 'Payment of Monthly Interest', 'Financial', 'DPM1728562062', 0.00, 2000.00, 60000.00, 58000.00, 5, '2024-10-10 08:07:42', '2024-10-10 08:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `cost_overhead`
--

CREATE TABLE `cost_overhead` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `in_direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_overhead`
--

INSERT INTO `cost_overhead` (`id`, `in_direct_cost_id`, `budget_project_id`, `type`, `project`, `po`, `expenses`, `amount`, `created_at`, `updated_at`) VALUES
(6, 2, 1, 'OverHead Cost', '1', 'OPEX', 'HO Cost', 1148.00, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(7, 2, 1, 'OverHead Cost', '1', 'OPEX', 'Annual Benefit', 0.30, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(8, 2, 1, 'OverHead Cost', '1', 'OPEX', 'Insurance Cost', 184.00, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(9, 2, 1, 'OverHead Cost', '1', 'OPEX', 'Visa Renewal', 416.00, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(10, 2, 1, 'OverHead Cost', '1', 'OPEX', 'Depreciation Tools', 10420.42, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(11, 3, 2, 'OverHead Cost', '2', 'OPEX', 'HO Cost', 189.42, '2024-10-01 08:56:17', '2024-10-01 08:58:04'),
(12, 3, 2, 'OverHead Cost', '2', 'OPEX', 'Annual Benefit', 0.05, '2024-10-01 08:56:17', '2024-10-02 12:22:04'),
(13, 3, 2, 'OverHead Cost', '2', 'OPEX', 'Insurance Cost', 30.36, '2024-10-01 08:56:17', '2024-10-01 08:58:04'),
(14, 3, 2, 'OverHead Cost', '2', 'OPEX', 'Visa Renewal', 68.64, '2024-10-01 08:56:17', '2024-10-01 08:58:04'),
(15, 3, 2, 'OverHead Cost', '2', 'OPEX', 'Depreciation Tools', 1.83, '2024-10-01 08:56:17', '2024-10-02 12:22:04'),
(21, 5, 5, 'OverHead Cost', '5', 'OPEX', 'HO Cost', 2244.34, '2024-10-03 07:20:51', '2024-10-03 07:43:04'),
(22, 5, 5, 'OverHead Cost', '5', 'OPEX', 'Annual Benefit', 0.59, '2024-10-03 07:20:51', '2024-10-09 03:09:38'),
(23, 5, 5, 'OverHead Cost', '5', 'OPEX', 'Insurance Cost', 359.72, '2024-10-03 07:20:51', '2024-10-03 07:43:04'),
(24, 5, 5, 'OverHead Cost', '5', 'OPEX', 'Visa Renewal', 813.28, '2024-10-03 07:20:51', '2024-10-03 07:43:04'),
(25, 5, 5, 'OverHead Cost', '5', 'OPEX', 'Depreciation Tools', 11504.17, '2024-10-03 07:20:51', '2024-10-09 03:09:38');

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
(5, 5, NULL, '2024-10-03 07:20:51', '2024-10-03 07:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `facility_cost`
--

CREATE TABLE `facility_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL DEFAULT 'OPEX',
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) DEFAULT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `percentage_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_cost`
--

INSERT INTO `facility_cost` (`id`, `direct_cost_id`, `budget_project_id`, `type`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `percentage_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Facility Cost', '1', 'OPEX', 'Fuel', 'using for fuel', 'new fuel adjustments', 1000.00, 5, 1, 5000.00, 1000.00, 0.20, 'approved', '2024-10-01 03:01:18', '2024-10-01 03:01:18'),
(2, 2, 1, 'Facility Cost', '1', 'OPEX', 'SIM', 'bought a new sim', 'new bought', 100.00, 10, 0, 1000.00, 100.00, 0.10, 'approved', '2024-10-01 03:02:53', '2024-10-01 03:02:53'),
(3, 2, 1, 'Facility Cost', '1', 'OPEX', 'Accommodation', 'Staff Accomodation', 'new villa purchased', 500.00, 10, 0, 5000.00, 500.00, 0.10, 'approved', '2024-10-01 03:03:59', '2024-10-01 03:03:59'),
(4, 2, 1, 'Facility Cost', '1', 'OPEX', 'WareHouse', 'WareHouse Maintenance', 'New WareHouse Decorated', 5000.00, 10, 0, 50000.00, 5000.00, 0.10, 'approved', '2024-10-01 03:07:13', '2024-10-01 03:07:13'),
(5, 2, 1, 'Facility Cost', '1', 'OPEX', '3 Tone (Double Cabin + Hiab Crane)', 'for all sites', 'new hiring', 3333.00, 2, 0, 6666.00, 3333.00, 0.50, 'approved', '2024-10-01 04:57:07', '2024-10-01 04:57:07'),
(6, 3, 2, 'Facility Cost', '1', 'OPEX', 'Travelling expense', 'this could be travelling expense', 'new cost', 2000.00, 0, 0, 2000.00, 2000.00, 1.00, 'approved', '2024-10-01 09:01:55', '2024-10-01 09:01:55'),
(7, 5, 5, 'Facility Cost', '1', 'OPEX', 'Accommodation', 'Villa For Labor Accomodation', 'villa for 10 people', 40000.00, 0, 1, 40000.00, 40000.00, 1.00, 'approved', '2024-10-03 07:44:08', '2024-10-03 07:46:02'),
(8, 5, 5, 'Facility Cost', '1', 'OPEX', 'SIM', 'Etisalat SIM For Staff', 'New Purchased', 100.00, 20, 1, 2000.00, 100.00, 0.05, 'approved', '2024-10-03 07:46:57', '2024-10-03 07:46:57'),
(9, 5, 5, 'Facility Cost', '1', 'OPEX', 'Fuel', 'Fuel for Whole Project', 'staff pick & drop', 15000.00, 0, 0, 15000.00, 15000.00, 1.00, 'approved', '2024-10-03 07:52:15', '2024-10-03 07:52:15'),
(10, 5, 5, 'Facility Cost', '1', 'OPEX', 'Warehouse Renovation', 'Total Renovation Cost', 'require for annual renovation', 30000.00, 0, 0, 30000.00, 30000.00, 1.00, 'approved', '2024-10-03 07:53:26', '2024-10-03 07:53:26'),
(11, 5, 5, 'Facility Cost', '1', 'OPEX', 'Labor Bus 48 Seater', 'total cost for labor bus', 'pridicted cost', 20000.00, 0, 0, 20000.00, 20000.00, 1.00, 'approved', '2024-10-03 07:56:14', '2024-10-03 07:56:14');

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
  `type` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_cost`
--

INSERT INTO `financial_cost` (`id`, `in_direct_cost_id`, `budget_project_id`, `type`, `po`, `project`, `expenses`, `percentage`, `total_cost`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 'Financial Cost', 'OPEX', '6', 'Risk', '0', 13508.30, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(4, 2, 1, 'Financial Cost', 'OPEX', '6', 'Financial Cost', '0', 2701.66, '2024-10-01 02:55:24', '2024-10-03 06:04:24'),
(5, 3, 2, 'Financial Cost', 'OPEX', '6', 'Risk', '0', 3075.00, '2024-10-01 08:56:17', '2024-10-02 12:22:04'),
(6, 3, 2, 'Financial Cost', 'OPEX', '6', 'Financial Cost', '0', 615.00, '2024-10-01 08:56:17', '2024-10-02 12:22:04'),
(9, 5, 5, 'Financial Cost', 'OPEX', '6', 'Risk', '0', 51310.00, '2024-10-03 07:20:51', '2024-10-09 03:09:38'),
(10, 5, 5, 'Financial Cost', 'OPEX', '6', 'Financial Cost', '0', 10262.00, '2024-10-03 07:20:51', '2024-10-09 03:09:38');

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
(5, 5, NULL, '2024-10-03 07:20:51', '2024-10-03 07:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `material_cost`
--

CREATE TABLE `material_cost` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL DEFAULT 'OPEX',
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `total_budget` decimal(15,2) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `percentage_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_cost`
--

INSERT INTO `material_cost` (`id`, `direct_cost_id`, `budget_project_id`, `type`, `project`, `po`, `expenses`, `description`, `status`, `quantity`, `unit`, `unit_cost`, `total_cost`, `average_cost`, `total_budget`, `approval_status`, `percentage_cost`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Material', '1', 'OPEX', 'wire', '100 Meter Ethernet Cable', 'new', 100.00, 'meters', 30.00, 3000.00, 30.00, NULL, 'approved', 0.01, '2024-10-01 03:06:04', '2024-10-01 03:06:04'),
(2, 2, 1, 'Material', '1', 'OPEX', 'cable', '100 Roll Cable', 'purchased', 200.00, 'rolls', 400.00, 80000.00, 400.00, NULL, 'approved', 0.01, '2024-10-01 03:07:56', '2024-10-01 03:07:56'),
(3, 2, 1, 'Material', '1', 'OPEX', 'cable', '100 meter cable', 'purchased', 200.00, 'meters', 50.00, 10000.00, 50.00, NULL, 'approved', 0.01, '2024-10-01 04:27:17', '2024-10-01 04:27:17'),
(4, 2, 1, 'Material', '1', 'OPEX', 'wire', '100 Roll Cable', 'new', 29.00, 'meters', 500.00, 14500.00, 500.00, NULL, 'approved', 0.03, '2024-10-01 04:58:22', '2024-10-01 04:58:22'),
(5, 3, 2, 'Material', '1', 'OPEX', 'cable', 'Drop Fibre Cable', 'new purchase from china', 300.00, 'rolls', 160.00, 48000.00, 160.00, NULL, 'approved', 0.00, '2024-10-01 09:06:34', '2024-10-01 09:06:34'),
(6, 5, 5, 'Material', '1', 'OPEX', 'Electrical Wires', 'High-quality copper cable for electrical wiring.', 'In Stock', 40.00, 'meters', 500.00, 20000.00, 500.00, NULL, 'approved', 0.03, '2024-10-03 08:07:45', '2024-10-03 08:11:11'),
(7, 5, 5, 'Material', '1', 'OPEX', 'Conductors', 'Insulated wire suitable for various electrical applications.', 'require purchase', 30.00, 'meters', 300.00, 9000.00, 300.00, NULL, 'approved', 0.03, '2024-10-03 08:09:16', '2024-10-03 08:12:32'),
(15, 5, 5, 'Material', '1', 'OPEX', 'Electrical Tape', 'Durable electrical tape for insulating and securing wires.', 'new purchase from china', 20.00, 'meters', 50.00, 1000.00, 50.00, NULL, 'approved', 0.05, '2024-10-03 08:30:35', '2024-10-03 08:30:35'),
(16, 5, 5, 'Material', '1', 'OPEX', 'PVC Pipes', 'Lightweight and durable PVC pipes for plumbing.', 'new purchase', 30.00, 'meters', 120.00, 3600.00, 120.00, NULL, 'approved', 0.03, '2024-10-03 08:31:50', '2024-10-03 08:31:50'),
(17, 5, 5, 'Material', '1', 'OPEX', 'Electrical Components', 'High-quality electrical switches suitable for residential and commercial use.', 'updated', 80.00, 'meters', 70.00, 5600.00, 70.00, NULL, 'approved', 0.01, '2024-10-03 08:34:47', '2024-10-03 08:34:47');

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
(6, '2024_01_03_120009_create_purchase_order_table', 1),
(7, '2024_08_19_061943_create_planned_cash_table', 1),
(8, '2024_08_19_062207_create_projects_table', 1),
(9, '2024_08_19_175130_create_planed_cash_opening_balances_table', 1),
(10, '2024_08_20_132501_bank', 1),
(11, '2024_08_26_083007_create_business_units_table', 1),
(12, '2024_08_26_111241_create_business_clients_table', 1),
(13, '2024_08_30_114160_create_material_cost_table', 1),
(14, '2024_08_31_104724_create_direct_cost_table', 1),
(15, '2024_08_31_104731_create_indirect_cost_table', 1),
(16, '2024_08_31_1121118_create_facility_costs_table', 1),
(17, '2024_08_31_115324_create_cost_overhead_table', 1),
(18, '2024_08_31_115905_create_financial_cost_table', 1),
(19, '2024_09_02_103517_create_capital_expenditure_table', 1),
(20, '2024_09_03_045117_create_project_budget_sequence_table', 1),
(21, '2024_09_03_072223_create_revenue_plans_table', 1),
(22, '2024_09_06_053630_create_purchase_order_sequence_table', 1),
(23, '2024_09_08_121209_create_purchase_order_items_table', 1),
(24, '2024_09_10_064229_create_budget_project_table', 1),
(25, '2024_09_14_192843_create_allocated_budget_table', 1),
(26, '2024_09_15_192732_create_approved_budget_table', 1),
(27, '2024_09_16_064836_create_cash_flows_table', 1),
(28, '2024_09_20_101531_create_petty_cash_table', 1),
(29, '2024_09_20_1015340_create_noc_payments_table', 1),
(30, '2024_09_9_1115629_create_salaries_table', 1),
(31, '2024_10_01_044603_create_supplier_prices_table', 1),
(32, '2024_10_02_085441_create_purchase_orders_item_table', 2),
(33, '2024_10_03_085441_create_purchase_orders_item_table', 3),
(34, '2024_10_03_085442_create_purchase_orders_item_table', 4),
(35, '2024_10_03_085447_create_purchase_orders_item_table', 5),
(36, '2024_10_03_085450_create_purchase_orders_item_table', 6),
(37, '2024_10_03_085451_create_purchase_orders_item_table', 7),
(38, '2024_10_03_085452_create_purchase_orders_item_table', 8),
(39, '2024_10_03_085453_create_purchase_orders_item_table', 9),
(40, '2024_10_03_085454_create_purchase_orders_item_table', 10),
(41, '2024_10_04_085454_create_purchase_orders_item_table', 11),
(42, '2024_10_05_085454_create_purchase_orders_item_table', 12),
(43, '2024_10_06_085454_create_purchase_orders_item_table', 13),
(44, '2024_10_06_085456_create_purchase_orders_item_table', 14),
(45, '2024_10_02_044615_create_supplier_prices_table', 15),
(46, '2024_10_06_085457_create_purchase_orders_item_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `noc_payments`
--

CREATE TABLE `noc_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `noc_payments`
--

INSERT INTO `noc_payments` (`id`, `project_id`, `description`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Amount for NOC Payment', 1000.00, '2024-10-01 03:05:36', '2024-10-01 03:05:36'),
(2, 2, 'Amount for NOC Payment', 3000.00, '2024-10-01 09:04:57', '2024-10-01 09:04:57'),
(3, 5, 'Amount for NOC Payment', 200000.00, '2024-10-03 08:02:28', '2024-10-03 08:02:28');

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
-- Table structure for table `petty_cash`
--

CREATE TABLE `petty_cash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petty_cash`
--

INSERT INTO `petty_cash` (`id`, `project_id`, `description`, `amount`, `created_at`, `updated_at`) VALUES
(2, 1, 'Amount for Petty Cash', 500.00, '2024-10-01 03:05:19', '2024-10-01 03:05:19'),
(3, 2, 'Amount for Petty Cash', 20000.00, '2024-10-01 09:04:32', '2024-10-01 09:04:32'),
(4, 5, 'Amount for Petty Cash', 200000.00, '2024-10-03 08:01:37', '2024-10-03 08:01:37'),
(5, 5, 'Amount for Petty Cash', 300000.00, '2024-10-03 08:01:58', '2024-10-03 08:01:58');

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
(1, '713h', NULL, NULL, 'Active', '2024-09-07 02:03:28', '2024-09-07 02:03:28'),
(2, '89UY', NULL, NULL, 'Active', '2024-09-07 02:03:32', '2024-09-07 02:03:32'),
(3, 'WR-OLT', NULL, NULL, 'Active', '2024-09-07 02:03:35', '2024-09-07 02:03:35'),
(4, 'ETI-MN', NULL, NULL, 'Active', '2024-09-17 07:16:43', '2024-09-17 07:16:43'),
(5, 'Admin Department', NULL, NULL, 'Active', '2024-10-01 02:34:41', '2024-10-01 02:34:41'),
(6, 'Logistics', NULL, NULL, 'Active', '2024-10-01 02:35:24', '2024-10-01 02:35:24');

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
(1, '10012024', 2, '2024-10-01 02:35:59', '2024-10-01 08:53:49'),
(2, '10032024', 3, '2024-10-03 06:10:54', '2024-10-03 07:18:04'),
(3, '10102024', 2, '2024-10-10 08:24:19', '2024-10-10 08:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `total_discount` decimal(10,2) DEFAULT NULL,
  `requested_by` bigint(20) UNSIGNED NOT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `prepared_by` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `payment_term` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `budget_total` decimal(10,2) DEFAULT NULL,
  `budget_utilization` decimal(10,2) DEFAULT NULL,
  `budget_balance` decimal(10,2) DEFAULT NULL,
  `current_request` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Not Submitted',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `supplier_name`, `description`, `supplier_address`, `project_id`, `total_discount`, `requested_by`, `verified_by`, `prepared_by`, `date`, `payment_term`, `subtotal`, `vat`, `total`, `budget_total`, `budget_utilization`, `budget_balance`, `current_request`, `status`, `is_verified`, `created_at`, `updated_at`) VALUES
(13, 'PO100920240009', 'MAA ALMADINA BUILDING MATERIAL', 'starting new', 'Business Bay, Dubai', 5, 4.00, 19, NULL, 38, '2024-10-09', 'online transaction', 221.88, 6.00, NULL, NULL, NULL, NULL, NULL, 'submitted', 1, '2024-10-09 04:14:10', '2024-10-09 04:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders_item`
--

CREATE TABLE `purchase_orders_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `allocated_budget_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `amount_requested` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance_budget` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_balance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `delivery_charges` decimal(8,2) NOT NULL DEFAULT 0.00,
  `budget_utilization` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders_item`
--

INSERT INTO `purchase_orders_item` (`id`, `purchase_order_id`, `po_number`, `items`, `project_id`, `allocated_budget_amount`, `amount_requested`, `total_vat`, `total_discount`, `balance_budget`, `total_balance`, `delivery_charges`, `budget_utilization`, `created_at`, `updated_at`) VALUES
(1, 13, 'PO100920240009', '[{\"item\":\"6\",\"description\":\"High-quality copper cable for electrical wiring.\",\"quantity\":10,\"unitPrice\":20,\"itemTotal\":200,\"discountValue\":2,\"vatValue\":3,\"totalAmount\":221.88,\"deliveryCharges\":20}]', NULL, 662000.00, 221.88, 6.00, 4.00, 662000.00, 661778.12, 20.00, 0.00, '2024-10-09 04:15:06', '2024-10-09 04:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_sequence`
--

CREATE TABLE `purchase_order_sequence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_sequence` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_sequence`
--

INSERT INTO `purchase_order_sequence` (`id`, `date`, `last_sequence`, `created_at`, `updated_at`) VALUES
(1, '10012024', 1, '2024-10-01 03:13:58', '2024-10-01 03:13:58'),
(2, '10022024', 7, '2024-10-02 00:38:54', '2024-10-02 09:08:23'),
(3, '10042024', 1, '2024-10-04 01:49:12', '2024-10-04 01:49:12'),
(4, '10092024', 9, '2024-10-09 03:19:29', '2024-10-09 04:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_plans`
--

CREATE TABLE `revenue_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
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
  `profit_percentage` decimal(8,4) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revenue_plans`
--

INSERT INTO `revenue_plans` (`id`, `budget_project_id`, `sn`, `type`, `project`, `contract`, `description`, `amount`, `total_profit`, `net_profit_before_tax`, `tax`, `net_profit_after_tax`, `profit_percentage`, `approval_status`, `created_at`, `updated_at`) VALUES
(7, 5, 1, 'Revenue', '1', NULL, 'NOC Payment', 1000000.00, 1000000.00, -102694.10, -9242.47, -93451.63, NULL, 'approved', '2024-10-03 09:20:59', '2024-10-03 09:20:59'),
(9, 5, 1, 'Revenue', '1', NULL, 'Civil Payment', 1000000.00, 2000000.00, 897305.90, 80757.53, 816548.37, NULL, 'approved', '2024-10-04 01:22:30', '2024-10-04 01:22:30'),
(10, 5, 1, 'Revenue', '1', NULL, 'Invoices', 3000000.00, 5000000.00, 3897305.90, 350757.53, 3546548.37, NULL, 'approved', '2024-10-04 01:24:41', '2024-10-04 01:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direct_cost_id` bigint(20) UNSIGNED NOT NULL,
  `budget_project_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL DEFAULT 'OPEX',
  `expenses` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `other_expense` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `visa_status` varchar(255) NOT NULL DEFAULT 'xad_visa',
  `cost_per_month` decimal(10,2) NOT NULL,
  `no_of_staff` int(11) NOT NULL,
  `overseeing_sites` int(11) NOT NULL DEFAULT 0,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `percentage_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `direct_cost_id`, `budget_project_id`, `type`, `project`, `po`, `expenses`, `description`, `other_expense`, `status`, `visa_status`, `cost_per_month`, `no_of_staff`, `overseeing_sites`, `no_of_months`, `total_cost`, `average_cost`, `percentage_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(14, 5, 5, 'Salary', '1', 'OPEX', 'Bus Driver', 'staff pick and drop', NULL, 'existing', 'Xad Visa', 3000.00, 2, 0, 1, 6000.00, 3000.00, 0.50, 'approved', '2024-10-03 07:20:51', '2024-10-03 07:20:51'),
(15, 5, 5, 'Salary', '1', 'OPEX', 'Project Manager', 'overseeing 5 sights', NULL, 'existing staff', 'Xad Visa', 3500.00, 5, 3, 1, 17500.00, 3500.00, 0.33, 'approved', '2024-10-03 07:21:47', '2024-10-03 07:21:47'),
(16, 5, 5, 'Salary', '1', 'OPEX', 'Sr. Client Relationship Manager', 'client manager for important sites', NULL, 'new hiring', 'Xad Visa', 4000.00, 5, 5, 1, 20000.00, 4000.00, 0.20, 'approved', '2024-10-03 07:28:22', '2024-10-03 07:28:22'),
(17, 5, 5, 'Salary', '1', 'OPEX', 'NOC Officer', 'Noc Officers For a Site', NULL, 'new hiring', 'Xad Visa', 3000.00, 10, 0, 1, 30000.00, 3000.00, 0.10, 'approved', '2024-10-03 07:29:50', '2024-10-03 07:29:50'),
(18, 5, 5, 'Salary', '1', 'OPEX', 'Helper', 'Helpers To Renovate the House', NULL, 'new hiring', 'Xad Visa', 2000.00, 9, 0, 1, 18000.00, 2000.00, 0.11, 'approved', '2024-10-03 07:31:01', '2024-10-03 07:31:01'),
(19, 5, 5, 'Salary', '1', 'OPEX', 'Sr. Civil Project Engineer', 'looking for sites in rural', NULL, 'existing staff', 'Xad Visa', 4500.00, 4, 10, 1, 18000.00, 4500.00, 0.10, 'approved', '2024-10-03 07:34:59', '2024-10-03 07:34:59'),
(20, 5, 5, 'Salary', '1', 'OPEX', 'HSE Engineer', 'Site Engineers', NULL, 'new hiring', 'Xad Visa', 2500.00, 8, 0, 1, 20000.00, 2500.00, 0.13, 'approved', '2024-10-03 07:37:28', '2024-10-03 07:37:28'),
(21, 5, 5, 'Salary', '1', 'OPEX', 'Surveyor', 'Surveyor from nepal', NULL, 'new hiring', 'Xad Visa', 2000.00, 1, 0, 1, 2000.00, 2000.00, 1.00, 'approved', '2024-10-03 07:38:28', '2024-10-03 07:38:28'),
(22, 5, 5, 'Salary', '1', 'OPEX', 'Foreman', 'site forman', NULL, 'new hiring', 'Xad Visa', 4000.00, 9, 0, 1, 36000.00, 4000.00, 0.11, 'approved', '2024-10-03 07:39:58', '2024-10-03 07:40:14'),
(23, 5, 5, 'Salary', '1', 'OPEX', 'Project Coordinator', 'will coordinate the entire project', NULL, 'existing staff', 'Xad Visa', 4000.00, 3, 0, 1, 12000.00, 4000.00, 0.33, 'approved', '2024-10-03 07:41:23', '2024-10-03 07:41:23'),
(25, 5, 5, 'Salary', '1', 'OPEX', 'Charge Hand', 'charge hand site supervision', NULL, 'new hiring', 'Xad Visa', 500.00, 1, 0, 1, 500.00, 500.00, 1.00, 'approved', '2024-10-03 07:43:03', '2024-10-03 07:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_prices`
--

CREATE TABLE `supplier_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_code` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_prices`
--

INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'XAD000001', '2023-05-18', 'Thinner', 'MAA ALMADINA BUILDING MATERIAL', 'BOT', '34', '32.98', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(2, 'XAD000002', '2022-01-27', 'Telescopic ladder 2.6m', 'Ali Asghar Hussani', 'PCS', '380', '368.6', 'GRN : 27-01-037 Project: DU SFAN Based On Purchase Orders :3504', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(3, 'XAD000002', '2022-08-04', 'Telescopic ladder 2.6m', 'Abazar Building Materail LLC Qusais', 'PCS', '450', '436.5', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(4, 'XAD000002', '2022-09-21', 'foam Spray', 'Smooth Solution building Materails Trading LLC', 'PCS', '375', '363.75', 'Request No : DU SFAN Sep-2022 ( 60 ) Based On Purchase Orders 634.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(5, 'XAD000002', '2022-10-19', 'Telescopic ladder 2.6m', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '334', '323.98', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(6, 'XAD000005', '2022-06-28', 'Cable Strips Black 135mm x 9mm', 'Noor Al Iman', 'PKT', '0.15', '0.1455', 'Huawei Mobile project Based On Purchase Orders 231.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(7, 'XAD000006', '2022-08-12', 'EC-Type Cable Marker (Ferol) A-Z', 'Abazar Building Materail LLC Qusais', 'SET', '104', '100.88', 'Based On Purchase Orders 405.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(8, 'XAD000006', '2022-08-29', 'EC-Type Cable Marker (Ferol) A-Z', 'Noor Al Iman', 'SET', '130', '126.1', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(9, 'XAD000006', '2022-12-12', 'EC-Type Cable Marker (Ferol) A-Z', 'Ali Asghar Hussani', 'SET', '125', '121.25', 'Request No : WR101H 106 Based On Purchase Orders 1373.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(10, 'XAD000007', '2022-10-22', 'EC-Type Cable Marker (Ferol) 0-9', 'Ali Asghar Hussani', 'PCS', '0.06', '0.0582', 'Requested By : Nikunj Patel Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 903.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(11, 'XAD000007', '2024-01-15', 'EC-Type Cable Marker (Ferol) 0-9', 'Noor Al Iman', 'PCS', '0.04', '0.0388', 'Consumeables Materia For Nokia TI Project Based On Purchase Orders 3860.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(12, 'XAD000009', '2023-11-24', 'Cable Clip Round 20mm white', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Box', '10', '9.7', 'Request No : Etisalat SmartHome-XAD-006-NE-November 2023 Based On Purchase Orders 3480.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(13, 'XAD000009', '2024-01-05', 'Cable Clip Round 20mm white', 'Ali Asghar Hussani', 'Box', '0.19', '0.1843', 'REQUEST NO 58 OSP LMP PROJECT Based On Purchase Orders 3771.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(14, 'XAD000010', '2023-07-17', 'Cable Clip Round 20mm black', 'Ali Asghar Hussani', 'PCS', '0.1', '0.097', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(15, 'XAD000011', '2022-11-02', 'Tool Box Tolsen', 'Smooth Solution building Materails Trading LLC', 'PCS', '75', '72.75', 'Request No : SmartHome Xad-001  Requested By : Bashir Subhani Based On Purchase Orders 996.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(16, 'XAD000011', '2023-03-07', 'Tool Box Tolsen', 'Securintec Information Technology LLC', 'PCS', '5', '4.85', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(17, 'XAD000011', '2023-03-08', 'Tool Box Tolsen', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '60', '58.2', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1847.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(18, 'XAD000011', '2023-09-20', 'Tool Box Tolsen', 'Ali Asghar Hussani', 'PCS', '62', '60.14', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(19, 'XAD000012', '2022-07-04', 'Drill Bit 6mm Steel', 'Noor Al Iman', 'PCS', '5', '4.85', 'Du Sfan Based On Purchase Orders 273.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(20, 'XAD000012', '2023-01-26', 'Drill Bit 6mm Steel', 'Ali Asghar Hussani', 'PCS', '2.25', '2.1825', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(21, 'XAD000012', '2023-03-08', 'Drill Bit 6mm Steel', 'Smooth Solution building Materails Trading LLC', 'PCS', '4', '3.88', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(22, 'XAD000012', '2023-10-02', 'Drill Bit 6mm Steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4.5', '4.365', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(23, 'XAD000013', '2022-08-23', 'Visual Fault Locator', 'Alpha Link Technologies LLC', 'PCS', '400', '388', 'MOD Based On Purchase Orders 173.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(24, 'XAD000013', '2023-01-24', 'Visual Fault Locator', 'Azlan Star Technologies LLC', 'PCS', '65', '63.05', 'Request No : AUH-23-09-Jan-2023 Based On Purchase Orders 1575.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(25, 'XAD000013', '2023-10-19', 'Visual Fault Locator', 'MITTCO Llc', 'PCS', '179.95', '174.5515', 'Request No : DU SFAN-230-240 Aug-2023 Based On Purchase Orders 3088.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(26, 'XAD000013', '2024-01-10', 'Visual Fault Locator', 'APKR Networking Zone', 'PCS', '50', '48.5', 'REQUEST NO 287 DU SFAN PROJECT. Based On Purchase Orders 3856.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(27, 'XAD000013', '2024-02-24', 'Visual Fault Locator', 'The Mark Infotech System Solutions LLC', 'PCS', '80', '77.6', 'Tools Required For DU-TCS Project  DXB REGION Based On Purchase Orders 4146.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(28, 'XAD000014', '2023-02-16', 'Foam Spray', 'Noor Al Iman', 'PCS', '10', '9.7', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(29, 'XAD000014', '2023-07-10', 'Foam Spray', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '10', '9.7', 'Requested By : Saad Rehman & Rizwan Ali Verified By     : Fiaz Ul Amin Prepared By  : Raja Zeeshan  Request No : XAD-0025-05-07-2023  Consumable Quality Material Required For NE Region SmartHome Project . Based On Purchase Orders 2695.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(30, 'XAD000014', '2023-12-07', 'Foam Spray', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Request Number 267 DU SFAN November-2023 Based On Purchase Orders 3460.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(31, 'XAD000014', '2024-02-15', 'Foam Spray', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4065.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(32, 'XAD000015', '2023-03-17', 'Cable Tie 300*4.8mm  Black', 'Wenzhou Zhechi', 'PKT', '3.09', '2.9973', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(33, 'XAD000015', '2023-05-19', 'Cable Tie 300*4.8mm  Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '6.5', '6.305', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(34, 'XAD000015', '2023-09-02', 'Cable Tie 300*4.8mm  Black', 'Ali Asghar Hussani', 'PKT', '5.55', '5.3835', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(35, 'XAD000016', '2022-09-01', 'Combination Plier 6\'\'', 'Azlan Star Technologies LLC', 'PCS', '18', '17.46', 'Project : FDH AAN  Requested By : Nikunj Patel Verified By :Mr Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 539.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(36, 'XAD000016', '2022-12-27', 'Combination Plier 6\'\'', 'Smooth Solution building Materails Trading LLC', 'PCS', '18', '17.46', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(37, 'XAD000016', '2023-12-16', 'Combination Plier 6\'\'', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(38, 'XAD000017', '2022-10-10', 'Cable Tie 150*4.8mm Black', 'Noor Al Iman', 'PKT', '3.5', '3.395', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(39, 'XAD000017', '2022-11-03', 'Cable Tie 150*4.8mm Black', 'Smooth Solution building Materails Trading LLC', 'PKT', '4', '3.88', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(40, 'XAD000017', '2023-03-08', 'Cable Tie 150*4.8mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '3', '2.91', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(41, 'XAD000017', '2023-03-17', 'Cable Tie 150*4.8mm Black', 'Wenzhou Zhechi', 'PKT', '1.54', '1.4938', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(42, 'XAD000017', '2023-10-27', 'Cable Tie 150*4.8mm Black', 'Ali Asghar Hussani', 'PKT', '2.5', '2.425', 'Request No : WR-101H - 293 - Oct - 2023 Based On Purchase Orders 3369.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(43, 'XAD000023', '2022-03-08', 'Cable Tie 100mm White', 'Wenzhou Zhechi', 'PKT', '0.76', '0.7372', 'Material purchase from China for DU SFAN Based On Purchase Orders 355.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(44, 'XAD000023', '2022-10-22', 'Cable Tie 100mm White', 'Ali Asghar Hussani', 'PKT', '2', '1.94', 'Requested By : Nikunj Patel Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 903.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(45, 'XAD000024', '2023-02-17', 'Labeling Cartridge Black & White 12mm', 'Azlan Star Technologies LLC', 'PCS', '13', '12.61', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1750.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(46, 'XAD000024', '2023-12-21', 'Labeling Cartridge Black & White 12mm', 'SKYMAX GENERAL TRADING FZE', 'PCS', '10', '9.7', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3400.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(47, 'XAD000024', '2024-01-10', 'Labeling Cartridge Black & White 12mm', 'APKR Networking Zone', 'PCS', '10', '9.7', 'REQUEST NO OSP LMP 2 JAN 24 Based On Purchase Orders 3844.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(48, 'XAD000025', '2022-03-28', 'Labeling Cartridge Black & White 9mm', 'Aimo Graphics CO', 'PCS', '6', '5.82', 'GRN : 28-03-022 Project: DU SFAN Based On Purchase Orders : 3565', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(49, 'XAD000025', '2023-02-08', 'Labeling Cartridge Black & White 9mm', 'Azlan Star Technologies LLC', 'PCS', '10.5', '10.185', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1689.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(50, 'XAD000025', '2023-12-21', 'Labeling Cartridge Black & White 9mm', 'SKYMAX GENERAL TRADING FZE', 'PCS', '9', '8.73', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3400.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(51, 'XAD000028', '2024-03-12', 'Rigger PPE bag (CAMP)', 'Fas Arabia llc', 'PCS', '220', '213.4', 'NOKIA PROJECT AUH REGION Based On Purchase Orders 4291.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(52, 'XAD000029', '2023-07-15', 'Socket Set 42 & 47 Pcs EIDG 1/4\'\'', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '80', '77.6', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2718.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(53, 'XAD000030', '2022-10-05', 'Hex Key Set Torx 9 Pcs', 'Noor Al Iman', 'SET', '20', '19.4', 'Request No : Xad-001 Requested By : Bashir Subhani Based On Purchase Orders 647.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(54, 'XAD000030', '2023-12-27', 'Hex Key Set Torx 9 Pcs', 'Ali Asghar Hussani', 'SET', '20', '19.4', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(55, 'XAD000031', '2023-08-14', 'WD 40 Spray', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '12.5', '12.125', 'Consumable Quality Material Required For Nokia Project . Based On Purchase Orders 2951.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(56, 'XAD000031', '2024-01-15', 'WD 40 Spray', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(57, 'XAD000034', '2022-05-12', 'Drill Machine H.D 800W Makita', 'Ali Asghar Hussani', 'PCS', '525', '509.25', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(58, 'XAD000036', '2023-02-14', 'Hacksaw Blade', 'Noor Al Iman', 'PCS', '3', '2.91', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1696.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(59, 'XAD000036', '2023-04-12', 'Hacksaw Blade', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.5', '2.425', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(60, 'XAD000036', '2023-12-27', 'Hacksaw Blade', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.5', '2.425', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(61, 'XAD000036', '2024-01-15', 'Hacksaw Blade', 'Ali Asghar Hussani', 'PCS', '2.5', '2.425', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(62, 'XAD000037', '2022-11-09', 'Long Nose Plier 6\'\'', 'Azlan Star Technologies LLC', 'PCS', '18', '17.46', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(63, 'XAD000037', '2023-01-25', 'Long Nose Plier 6\'\'', 'Noor Al Iman', 'PCS', '12', '11.64', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(64, 'XAD000037', '2023-11-13', 'Long Nose Plier 6\'\'', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No : DU TCS Nov-2023  Hand Tool Required For 7th New Technician For DU TCS Project . Based On Purchase Orders 3472.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(65, 'XAD000038', '2022-09-23', 'Screw Driver -', 'Azlan Star Technologies LLC', 'PCS', '8', '7.76', 'Request No : Du SFAN Sep 2022 ( 60 ) Requested By : Mufeed KK Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 628.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(66, 'XAD000038', '2022-10-10', 'Screw Driver -', 'Noor Al Iman', 'PCS', '6', '5.82', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(67, 'XAD000038', '2022-12-27', 'Screw Driver -', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(68, 'XAD000038', '2023-03-27', 'Screw Driver -', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '10', '9.7', 'Request No : XAD-HW-Jan-DXB-093 Based On Purchase Orders 1955.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(69, 'XAD000038', '2023-12-16', 'Screw Driver -', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(70, 'XAD000039', '2022-09-23', 'Screw Driver +', 'Azlan Star Technologies LLC', 'PCS', '8', '7.76', 'Request No : Du SFAN Sep 2022 ( 60 ) Requested By : Mufeed KK Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 628.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(71, 'XAD000039', '2022-10-10', 'Screw Driver +', 'Noor Al Iman', 'PCS', '6', '5.82', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(72, 'XAD000039', '2022-12-27', 'Screw Driver +', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(73, 'XAD000039', '2023-12-16', 'Screw Driver +', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(74, 'XAD000039', '2023-03-27', 'Screw Driver +', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '10', '9.7', 'Request No : XAD-HW-Jan-DXB-093 Based On Purchase Orders 1955.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(75, 'XAD000040', '2022-11-08', 'Hammer 160Z', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '16', '15.52', 'Request No : AAN-101H-OCT-009  Requested By ; Sufian Shaukat  Verified By     : SHamas Tabraiz & Imran Iqbal Based On Purchase Orders 994.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(76, 'XAD000040', '2023-08-03', 'Hammer 160Z', 'Al Moazam Stores LLC', 'PCS', '29.99', '29.0903', 'Request No : AAN-July-23-0066 . Based On Purchase Orders 2788.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(77, 'XAD000041', '2022-07-15', 'Measuring Tape', 'Noor Al Iman', 'PCS', '35', '33.95', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(78, 'XAD000041', '2023-05-24', 'Measuring Tape', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2311.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(79, 'XAD000042', '2022-11-02', 'Cable cutter 6\'\'', 'Smooth Solution building Materails Trading LLC', 'PCS', '18', '17.46', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1015.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(80, 'XAD000042', '2022-11-09', 'Cable cutter 6\'\'', 'Azlan Star Technologies LLC', 'PCS', '25', '24.25', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(81, 'XAD000042', '2022-11-25', 'Cable cutter 6\'\'', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '18', '17.46', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1289.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(82, 'XAD000042', '2022-12-29', 'Cable cutter 6\'\'', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Based On Purchase Orders 1449.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(83, 'XAD000042', '2024-02-22', 'Cable cutter 6\'\'', 'Noor Al Iman', 'PCS', '10', '9.7', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(84, 'XAD000043', '2023-03-11', 'Dewalt Cordless Rotary Hammer 18v (Drill Machine)', 'Smooth Solution building Materails Trading LLC', 'PCS', '930', '902.1', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1895.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(85, 'XAD000043', '2023-12-16', 'Dewalt Cordless Rotary Hammer 18v (Drill Machine)', 'Ali Asghar Hussani', 'PCS', '930', '902.1', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(86, 'XAD000044', '2022-04-27', 'Diagonal Cutter', 'Ali Asghar Hussani', 'PCS', '40', '38.8', 'ADWEA  INV #7599 Based On Purchase Orders 119.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(87, 'XAD000044', '2022-05-12', 'Diagonal Cutter', 'Ali Asghar Hussani', 'PCS', '40', '38.8', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(88, 'XAD000044', '2023-07-31', 'Diagonal Cutter', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(89, 'XAD000045', '2022-11-16', 'Wrench 10\'\'', 'Noor Al Iman', 'PCS', '15', '14.55', 'Huawei Based On Purchase Orders 1231.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(90, 'XAD000045', '2023-12-27', 'Wrench 10\'\'', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Carpentry Tool Request  Smart Home Project Based On Purchase Orders 3723.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(91, 'XAD000047', '2022-11-09', 'Crimping Tool', 'Azlan Star Technologies LLC', 'PKT', '65', '63.05', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(92, 'XAD000047', '2023-03-06', 'Crimping Tool', 'Noor Al Iman', 'PKT', '45', '43.65', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1854.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(93, 'XAD000047', '2023-12-27', 'Crimping Tool', 'Ali Asghar Hussani', 'PKT', '25', '24.25', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(94, 'XAD000047', '2024-02-24', 'Crimping Tool', 'The Mark Infotech System Solutions LLC', 'PKT', '15', '14.55', 'Tools Required For DU-TCS Project  DXB REGION Based On Purchase Orders 4146.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(95, 'XAD000049', '2023-01-28', 'Hacksaw Frame 12\'\'', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '3', '2.91', 'Request No : AUH-OLT-140 Based On Purchase Orders 1492.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(96, 'XAD000049', '2023-02-14', 'Hacksaw Frame 12\'\'', 'Noor Al Iman', 'PCS', '18', '17.46', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1696.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(97, 'XAD000049', '2023-05-29', 'Hacksaw Frame 12\'\'', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '20', '19.4', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2309.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(98, 'XAD000049', '2023-12-27', 'Hacksaw Frame 12\'\'', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(99, 'XAD000051', '2023-02-17', 'PVC Insulation Tape', 'Azlan Star Technologies LLC', 'PCS', '1', '0.97', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1750.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(100, 'XAD000051', '2023-04-05', 'PVC Insulation Tape', 'Noor Al Iman', 'PCS', '0.85', '0.8245', 'Request No : AAN-March-23-0027 Based On Purchase Orders 2033.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(101, 'XAD000051', '2024-02-10', 'PVC Insulation Tape', 'Cash', 'PCS', '1', '0.97', 'Materials Required For ICT Project Based On Purchase Orders 4067.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(102, 'XAD000051', '2024-02-15', 'PVC Insulation Tape', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1', '0.97', 'REQUEST NO : SMART HOME-AAN-002-FEB\'24  AAN REGION Based On Purchase Orders 4083.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(103, 'XAD000051', '2024-02-28', 'PVC Insulation Tape', 'Ali Asghar Hussani', 'PCS', '1', '0.97', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(104, 'XAD000053', '2023-02-07', 'Masking Tape 2\'\'', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2', '1.94', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1671.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(105, 'XAD000053', '2023-12-07', 'Masking Tape 2\'\'', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request Number 267 DU SFAN November-2023 Based On Purchase Orders 3460.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(106, 'XAD000053', '2024-02-10', 'Masking Tape 2\'\'', 'Cash', 'PCS', '3', '2.91', 'Materials Required For ICT Project Based On Purchase Orders 4067.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(107, 'XAD000053', '2024-02-22', 'Masking Tape 2\'\'', 'Noor Al Iman', 'PCS', '1.25', '1.2125', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(108, 'XAD000053', '2024-02-28', 'Masking Tape 2\'\'', 'Ali Asghar Hussani', 'PCS', '1.5', '1.455', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(109, 'XAD000054', '2022-07-15', 'Safety Eye Goggles', 'Noor Al Iman', 'PCS', '5', '4.85', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(110, 'XAD000054', '2023-02-14', 'Safety Eye Goggles', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4', '3.88', 'Request No : Adwea - 135 - Feb - 2023 Based On Purchase Orders 1665.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(111, 'XAD000054', '2023-03-15', 'Safety Eye Goggles', 'Al Moazam Stores LLC', 'PCS', '3', '2.91', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1857.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(112, 'XAD000054', '2023-09-02', 'Safety Eye Goggles', 'Ali Asghar Hussani', 'PCS', '3.25', '3.1525', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(113, 'XAD000060', '2022-02-26', 'Safety Shoes 42#', 'Noor Al Iman Elect & Hardware TR', 'PCS', '55', '53.35', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(114, 'XAD000060', '2022-12-24', 'Safety Shoes 42#', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '39', '37.83', 'Request No : Etihad Rail L&T -03 - DXB Based On Purchase Orders 1412.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(115, 'XAD000060', '2023-12-27', 'Safety Shoes 42#', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '48', '46.56', 'AUH OLT PROJECT REQUEST NO 0068 Based On Purchase Orders 3733.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(116, 'XAD000060', '2024-01-15', 'Safety Shoes 42#', 'Noor Al Iman', 'PCS', '40', '38.8', 'Consumeables Materia For Nokia TI Project Based On Purchase Orders 3860.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(117, 'XAD000060', '2024-02-28', 'Safety Shoes 42#', 'Ali Asghar Hussani', 'PCS', '35', '33.95', 'REQUEST NO : AAN-2024-108  AAN REGION Based On Purchase Orders 4156.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(118, 'XAD000061', '2023-05-29', 'Safety Shoes 40#', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '40', '38.8', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2309.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(119, 'XAD000062', '2022-10-19', 'Safety Shoes 44#', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '38', '36.86', 'Project : L&T Etihad Rail (KPO) Request No : L&T-01-DIC-DXB Requested By : Aqeel Butt Verified By : Sufiyan Shaukat & Imran Iqbal Based On Purchase Orders 821.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(120, 'XAD000062', '2024-01-11', 'Safety Shoes 44#', 'Ali Asghar Hussani', 'PCS', '50', '48.5', 'Safety Shoes Required For 101-H Project Based On Purchase Orders 3851.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(121, 'XAD000063', '2024-02-15', 'Safety Shoes 45#', 'Ali Asghar Hussani', 'PCS', '38', '36.86', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4065.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(122, 'XAD000063', '2023-12-27', 'Safety Shoes 45#', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '48', '46.56', 'AUH OLT PROJECT REQUEST NO 0068 Based On Purchase Orders 3733.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(123, 'XAD000064', '2023-04-03', 'Safety Shoes 46#', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '36', '34.92', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(124, 'XAD000065', '2023-05-08', 'Rosette Box ( Small ) - ABS Box', 'Cendhurr Telecom LLC', 'PCS', '9.5', '9.215', 'Request No : WR-101H-252-11-04-2023 Based On Purchase Orders 2286.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(125, 'XAD000065', '2023-10-27', 'Rosette Box ( Small ) - ABS Box', 'Frontier Innovation General Trading', 'PCS', '4.5', '4.365', 'Request No : WR-101H - 293 - Oct - 2023 Based On Purchase Orders 3368.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(126, 'XAD000066', '2022-08-12', 'Safety Vest', 'Smooth Solution building Materails Trading LLC', 'PCS', '4', '3.88', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(127, 'XAD000066', '2022-10-19', 'Safety Vest', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '5', '4.85', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(128, 'XAD000066', '2023-02-16', 'Safety Vest', 'Noor Al Iman', 'PCS', '4.5', '4.365', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(129, 'XAD000066', '2023-03-15', 'Safety Vest', 'Al Moazam Stores LLC', 'PCS', '4', '3.88', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1857.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(130, 'XAD000066', '2023-11-25', 'Safety Vest', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'Consumable & Tools Required For Nokia MN Project Nov-2023 Based On Purchase Orders 3518.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(131, 'XAD000066', '2023-12-27', 'Safety Vest', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '7.5', '7.275', 'AUH OLT PROJECT REQUEST NO 0068 Based On Purchase Orders 3733.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(132, 'XAD000067', '2022-09-08', 'Safety Shoes 43#', 'Noor Al Iman', 'PCS', '45', '43.65', 'Requested By : Nikunj Patel  Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 606.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(133, 'XAD000067', '2022-10-19', 'Safety Shoes 43#', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '38', '36.86', 'Requet No : DU SFAN-Sep 2022 (66 ) Requested By : Ahmad Iqbal  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 738.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(134, 'XAD000068', '2023-10-07', 'Cap with Etisalat & Xad Logo', 'Emporium Gulf', 'PCS', '10', '9.7', 'Request No : AAN-101H-0082 Based On Purchase Orders 3216.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(135, 'XAD000069', '2022-09-09', 'Alcohol Pads', 'Azlan Star Technologies LLC', 'Box', '18', '17.46', 'Request No 014/22 Requested By : Nikunj Patel  Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 610.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(136, 'XAD000069', '2024-02-28', 'Alcohol Pads', 'Ali Asghar Hussani', 'Box', '10', '9.7', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(137, 'XAD000071', '2022-08-12', 'Marker Strip Plastic MS 100', 'Abazar Building Materail LLC Qusais', 'PKT', '12', '11.64', 'Based On Purchase Orders 405.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(138, 'XAD000071', '2022-09-14', 'Marker Strip Plastic MS 100', 'Wenzhou Zhechi', 'PKT', '6.31', '6.1207', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(139, 'XAD000071', '2023-06-19', 'Marker Strip Plastic MS 100', 'Noor Al Iman', 'PKT', '12', '11.64', 'Request No : AAN-June-23-0053 - 02-06-2023 . Based On Purchase Orders 2484.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(140, 'XAD000071', '2024-02-15', 'Marker Strip Plastic MS 100', 'Ali Asghar Hussani', 'PKT', '12', '11.64', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4065.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(141, 'XAD000073', '2022-09-01', 'Warning Tape Red & White', 'Noor Al Iman', 'PCS', '15', '14.55', 'Project : FDH AAN  Requested By : Nikunj Verifed By : Mr Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 541.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(142, 'XAD000073', '2023-04-12', 'Warning Tape Red & White', 'Smooth Solution building Materails Trading LLC', 'PCS', '7', '6.79', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(143, 'XAD000073', '2023-10-18', 'Warning Tape Red & White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '7', '6.79', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3327.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(144, 'XAD000073', '2023-12-13', 'Warning Tape Red & White', 'Al Moazam Stores LLC', 'PCS', '7', '6.79', 'Request No : AAN-NOV-23-0098  FOR AAN 101-H Based On Purchase Orders 3552.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(145, 'XAD000073', '2024-01-09', 'Warning Tape Red & White', 'Ali Asghar Hussani', 'PCS', '7', '6.79', 'REQUEST NO OSP LMP 2 Based On Purchase Orders 3830.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(146, 'XAD000074', '2023-05-17', 'Umbrella', 'Smooth Solution building Materails Trading LLC', 'PCS', '88', '85.36', 'Request No : 190 Based On Purchase Orders 2352.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(147, 'XAD000074', '2023-07-31', 'Umbrella', 'Ali Asghar Hussani', 'PCS', '90', '87.3', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(148, 'XAD000075', '2023-05-18', 'Pulling Rod 6 x 200', 'Elfit Arabia', 'PCS', '1519', '1473.43', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2012. Based On Goods Receipt PO 970.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(149, 'XAD000076', '2022-04-13', 'Aluminium Ladder 4 Step / 5 Step', 'Ali Asghar Hussani', 'PCS', '135', '130.95', 'GRN : 13-04-020 Project : DU TCS Based On Purchase Orders 85.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(150, 'XAD000079', '2022-02-09', 'Uniform P. Shirt green Etisalat L', 'Emporium Gulf', 'PCS', '27', '26.19', 'PO     : 3511 Project: 101 H Etisalat Based On Purchase Orders 101. GRN  ;9-02-023', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(151, 'XAD000080', '2022-02-09', 'Uniform P. Shirt green Etisalat XL', 'Emporium Gulf', 'PCS', '27', '26.19', 'PO     : 3511 Project: 101 H Etisalat Based On Purchase Orders 101. GRN  ;9-02-023', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(152, 'XAD000082', '2022-02-09', 'Uniform P. Shirt green Etisalat XXL', 'Emporium Gulf', 'PCS', '27', '26.19', 'PO     : 3511 Project: 101 H Etisalat Based On Purchase Orders 101. GRN  ;9-02-023', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(153, 'XAD000083', '2022-04-27', 'Tone Tracer', 'Ali Asghar Hussani', 'PCS', '30', '29.1', 'ADWEA  INV #7599 Based On Purchase Orders 119.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(154, 'XAD000083', '2022-11-02', 'Tone Tracer', 'Smooth Solution building Materails Trading LLC', 'PCS', '85', '82.45', 'Request No : SmartHome Xad-001  Requested By : Bashir Subhani Based On Purchase Orders 996.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(155, 'XAD000083', '2022-11-18', 'Tone Tracer', 'Azlan Star Technologies LLC', 'PCS', '220', '213.4', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1291.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(156, 'XAD000083', '2024-02-24', 'Tone Tracer', 'The Mark Infotech System Solutions LLC', 'PCS', '65', '63.05', 'Tools Required For DU-TCS Project  DXB REGION Based On Purchase Orders 4146.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(157, 'XAD000084', '2022-06-04', 'Screw Driver + -', 'Noor Al Iman', 'PCS', '10', '9.7', 'Project : ADWEA Based On Purchase Orders 186.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(158, 'XAD000084', '2022-11-09', 'Screw Driver + -', 'Azlan Star Technologies LLC', 'PCS', '17', '16.49', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(159, 'XAD000085', '2022-03-31', 'Stanley Spirit Level 40cm x 16\"', 'Ali Asghar Hussani', 'PCS', '38', '36.86', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(160, 'XAD000086', '2022-03-05', 'AC Power Socket', 'Noor Al Iman Elect & Hardware TR', 'PCS', '55', '53.35', 'PO-3630 Based On Purchase Orders 8. GRN-02-03-006', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(161, 'XAD000086', '2022-10-25', 'AC Power Socket', 'Smooth Solution building Materails Trading LLC', 'PCS', '65', '63.05', 'Material For AAN 0105 Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 963.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(162, 'XAD000087', '2022-10-05', 'Screw Driver Set', 'Noor Al Iman', 'SET', '30', '29.1', 'Request No : Xad-001 Requested By : Bashir Subhani Based On Purchase Orders 647.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(163, 'XAD000087', '2023-04-28', 'Screw Driver Set', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'SET', '35', '33.95', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(164, 'XAD000087', '2023-12-27', 'Screw Driver Set', 'Ali Asghar Hussani', 'SET', '33', '32.01', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(165, 'XAD000088', '2023-11-06', 'Screw Driver T20', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Request No : Nokia-OCT-2023 . Based On Purchase Orders 3447.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(166, 'XAD000088', '2023-12-09', 'Screw Driver T20', 'Noor Al Iman', 'PCS', '10', '9.7', 'Consumables and Tools required by Nokia MN Project for month of Nov-23 Based On Purchase Orders 3521.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(167, 'XAD000090', '2023-03-30', 'FI 1 Tent 210*210*13', 'Ali Asghar Hussani', 'PCS', '120', '116.4', 'Request No : AAN-March-0024-10-03-2023 . Based On Purchase Orders 1972.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(168, 'XAD000091', '2023-06-22', 'Thread Rod 6 mm', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '2.25', '2.1825', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2476.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(169, 'XAD000093', '2022-03-29', 'AC Power Cable 4 Core', 'Noor Al Iman Elect & Hardware TR', 'MTR', '10', '9.7', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(170, 'XAD000093', '2023-01-17', 'AC Power Cable 4 Core', 'Noor Al Iman', 'MTR', '8', '7.76', 'Request No : XAD-HW-JAN-DXB-080 Based On Purchase Orders 1553.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(171, 'XAD000094', '2022-02-09', 'Flexible Pipe White 50mm', 'Ali Asghar Hussani', 'Roll', '22', '21.34', 'GRN : -9-02-017 Project: DU SFAN Based On Purchase Orders 105/3568', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(172, 'XAD000094', '2022-02-26', 'Flexible Pipe White 50mm', 'Noor Al Iman Elect & Hardware TR', 'Roll', '28', '27.16', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(173, 'XAD000094', '2023-02-16', 'Flexible Pipe White 50mm', 'Smooth Solution building Materails Trading LLC', 'Roll', '28', '27.16', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1672.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(174, 'XAD000094', '2024-02-28', 'Flexible Pipe White 50mm', 'Ali Asghar Hussani', 'Roll', '25', '24.25', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(175, 'XAD000095', '2022-03-29', 'Fiber Cleaver', 'Ali Asghar Hussani', 'PCS', '110', '106.7', 'GRN: 29-03-025 Projects:Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(176, 'XAD000095', '2022-04-09', 'Fiber Cleaver', 'Cash', 'PCS', '110', '106.7', 'GRN: 9-04-023 LPO 50/3774 Requested by: Rashid Ahmad Verified By : Sohail Abbas Prepared By : Wahab Aslam Based On Purchase Orders 50.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(177, 'XAD000095', '2022-09-09', 'Fiber Cleaver', 'Alpha Link Technologies LLC', 'PCS', '1100', '1067', 'New Fiber Cleaver FC-6S  Requested By : Sufian Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 589.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(178, 'XAD000095', '2022-11-18', 'Fiber Cleaver', 'Azlan Star Technologies LLC', 'PCS', '90', '87.3', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1291.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(179, 'XAD000095', '2023-07-12', 'Fiber Cleaver', 'The Mark Infotech System Solutions LLC', 'PCS', '85', '82.45', 'Request No : DU SFAN - 194 . Based On Purchase Orders 2711.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(180, 'XAD000096', '2022-10-05', 'Measuring Tape 5M', 'Noor Al Iman', 'PCS', '6', '5.82', 'Request No : Xad-001 Requested By : Bashir Subhani Based On Purchase Orders 647.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(181, 'XAD000096', '2023-03-07', 'Measuring Tape 5M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '22', '21.34', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1853.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(182, 'XAD000096', '2023-04-04', 'Measuring Tape 5M', 'OSIA Hypermarket', 'PCS', '13.99', '13.5703', 'Extension Lead & Measuring Tape Required For Sikandar Museum . Based On Purchase Orders 2208.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(183, 'XAD000096', '2023-12-27', 'Measuring Tape 5M', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(184, 'XAD000097', '2023-04-19', 'One Click Cleaner Pen', 'The Mark Infotech System Solutions LLC', 'PCS', '40', '38.8', 'Request No : DU SFAN-161-10-03-2023 Based On Purchase Orders 2127.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(185, 'XAD000097', '2023-10-19', 'One Click Cleaner Pen', 'MITTCO Llc', 'PCS', '157.46', '152.7362', 'Request No : DU SFAN-230-240 Aug-2023 Based On Purchase Orders 3088.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(186, 'XAD000098', '2022-07-29', 'Cable Stripper', 'Noor Al Iman', 'PCS', '30', '29.1', 'Huawei Mobile Project Based On Purchase Orders 383.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(187, 'XAD000098', '2022-11-19', 'Cable Stripper', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Based On Purchase Orders 1230.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(188, 'XAD000098', '2024-02-24', 'Cable Stripper', 'The Mark Infotech System Solutions LLC', 'PCS', '5', '4.85', 'Tools Required For DU-TCS Project  DXB REGION Based On Purchase Orders 4146.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(189, 'XAD000099', '2022-11-09', 'Punch Tool 314B', 'Azlan Star Technologies LLC', 'PCS', '35', '33.95', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(190, 'XAD000099', '2024-02-24', 'Punch Tool 314B', 'The Mark Infotech System Solutions LLC', 'PCS', '15', '14.55', 'Tools Required For DU-TCS Project  DXB REGION Based On Purchase Orders 4146.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(191, 'XAD000101', '2024-02-24', 'Krone Tool', 'The Mark Infotech System Solutions LLC', 'PCS', '10', '9.7', 'Tools Required For DU-TCS Project  DXB REGION Based On Purchase Orders 4146.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(192, 'XAD000105', '2024-01-27', 'DB Sala', 'Fas Arabia llc', 'PCS', '1250', '1212.5', 'DB Sala Required For Huawei KSA Project As It\'s Not Avb In KSA Market Based On Purchase Orders 3979.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(193, 'XAD000108', '2022-02-26', 'Double Tape 2\'\'', 'Noor Al Iman Elect & Hardware TR', 'PCS', '5', '4.85', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(194, 'XAD000108', '2023-05-10', 'Double Tape 2\'\'', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '7', '6.79', 'Request No: OSP-05 04-05-23 Based On Purchase Orders 2209.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(195, 'XAD000108', '2024-01-09', 'Double Tape 2\'\'', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'REQUEST NO 1 OSP LMP PROJECT Based On Purchase Orders 3816.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(196, 'XAD000108', '2024-02-22', 'Double Tape 2\'\'', 'Noor Al Iman', 'PCS', '6', '5.82', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(197, 'XAD000110', '2023-02-10', 'Butterfly Fisher', 'Ali Asghar Hussani', 'Box', '12', '11.64', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(198, 'XAD000110', '2023-12-27', 'Butterfly Fisher', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Box', '10', '9.7', 'Smart Home Request No 002 Smart Home Project Based On Purchase Orders 3706.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(199, 'XAD000111', '2023-01-24', 'Power Meter China', 'Azlan Star Technologies LLC', 'PCS', '115', '111.55', 'Request No : AUH-23-09-Jan-2023 Based On Purchase Orders 1575.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(200, 'XAD000111', '2023-11-13', 'Power Meter China', 'The Mark Infotech System Solutions LLC', 'PCS', '150', '145.5', 'Request No : DU TCS Nov-2023  Testing Tool Required For 7th New Technician For DU TCS Project . Based On Purchase Orders 3473.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(201, 'XAD000112', '2024-01-19', 'Impact Drill Machine', 'Securintec Information Technology LLC', 'PCS', '300', '291', 'Based On Purchase Orders 1994.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(202, 'XAD000113', '2022-05-28', 'Safety Shoes 41#', 'Ali Asghar Hussani', 'PCS', '40', '38.8', 'Project # LNT Based On Purchase Orders 139. INV# 7838', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(203, 'XAD000113', '2022-12-12', 'Safety Shoes 41#', 'Fas Arabia llc', 'PCS', '30', '29.1', 'Generated for specimen Based On Purchase Orders 1396.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(204, 'XAD000113', '2022-12-19', 'Safety Shoes 41#', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '41', '39.77', 'Request no : DU SFAN-88-Dec Based On Purchase Orders 1403.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(205, 'XAD000115', '2023-03-08', 'Safety Cone Red Small', 'Noor Al Iman', 'PKT', '19', '18.43', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1848.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(206, 'XAD000115', '2023-04-12', 'Safety Cone Red Small', 'Smooth Solution building Materails Trading LLC', 'PKT', '14', '13.58', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(207, 'XAD000115', '2023-07-31', 'Safety Cone Red Small', 'Ali Asghar Hussani', 'PKT', '13', '12.61', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(208, 'XAD000116', '2022-06-17', 'Wheel Barrow - Tyre', 'Ali Asghar Hussani', 'PCS', '65', '63.05', 'ADWEA Based On Purchase Orders 215.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(209, 'XAD000116', '2022-12-12', 'Wheel Barrow - Tyre', 'Fas Arabia llc', 'PCS', '45', '43.65', 'Generated for specimen Based On Purchase Orders 1396.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(210, 'XAD000116', '2023-06-08', 'Wheel Barrow - Tyre', 'Al Moazam Stores LLC', 'PCS', '40.24', '39.0328', 'Request No : AAN-May-23-0044 Based On Purchase Orders 2460.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(211, 'XAD000117', '2022-10-19', 'EC-Type Cable Marker (Ferol) A-Z Single Piece', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '4', '3.88', 'Request No : AAN-Oct-004 Requested By : Sufiyan Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 782.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(212, 'XAD000117', '2023-02-16', 'EC-Type Cable Marker (Ferol) A-Z Single Piece', 'Noor Al Iman', 'Roll', '91', '88.27', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(213, 'XAD000117', '2023-10-27', 'EC-Type Cable Marker (Ferol) A-Z Single Piece', 'Ali Asghar Hussani', 'Roll', '5', '4.85', 'Request No : WR-101H - 293 - Oct - 2023 Based On Purchase Orders 3369.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(214, 'XAD000118', '2022-10-19', 'EC-Type Cable Marker (Ferol) 0-9 Single Piece', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '52', '50.44', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(215, 'XAD000118', '2023-01-19', 'EC-Type Cable Marker (Ferol) 0-9 Single Piece', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'Request No : XAD-HW-JAN-DXB-080 Based On Purchase Orders 1552.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(216, 'XAD000119', '2023-10-27', 'Patch Cord 3M LC UPC-LC UPC Duplex', 'The Mark Infotech System Solutions LLC', 'PCS', '7.8', '7.566', 'Request No : XAD-HW-Oct-DCB-0098 - 27-Oct-2023 . Based On Purchase Orders 3365.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(217, 'XAD000119', '2023-11-06', 'Patch Cord 3M LC UPC-LC UPC Duplex', 'Auto Computer Trading LLC', 'PCS', '9', '8.73', 'Request No : XAD-HW-Sep-DXB-119 Based On Purchase Orders 3173.', '2024-10-09 03:56:56', '2024-10-09 03:56:56');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(218, 'XAD000119', '2023-12-28', 'Patch Cord 3M LC UPC-LC UPC Duplex', 'SKYMAX GENERAL TRADING FZE', 'PCS', '7.5', '7.275', 'REQUEST NO 56 OSP LMP PROJECT Based On Purchase Orders 3737. Based On Goods Receipt PO 2045.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(219, 'XAD000120', '2022-01-04', 'Knife Cutter', 'Noor Al Iman Elect & Hardware TR', 'PCS', '15', '14.55', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(220, 'XAD000120', '2022-10-16', 'Knife Cutter', 'Al Moazam Stores LLC', 'PCS', '5', '4.85', 'Request No : AAN OLT Sep 028  Requested By ; Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 642.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(221, 'XAD000120', '2022-12-12', 'Knife Cutter', 'Fas Arabia llc', 'PCS', '5', '4.85', 'Generated for specimen Based On Purchase Orders 1396.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(222, 'XAD000120', '2022-12-27', 'Knife Cutter', 'Smooth Solution building Materails Trading LLC', 'PCS', '19', '18.43', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(223, 'XAD000120', '2023-04-28', 'Knife Cutter', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '15', '14.55', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(224, 'XAD000120', '2023-12-27', 'Knife Cutter', 'Ali Asghar Hussani', 'PCS', '16', '15.52', 'REQUEST NO 0066 AUH OLT PROJECT Based On Purchase Orders 3709.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(225, 'XAD000120', '2024-02-22', 'Knife Cutter', 'Noor Al Iman', 'PCS', '18', '17.46', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(226, 'XAD001228', '2022-02-22', 'Cat5 - cat6 Boot', 'APKR Networking Zone', 'PKT', '10', '9.7', 'GRN    : 22-02-034 Project: Nokia OD Based On Purchase Orders 93/3609', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(227, 'XAD001228', '2022-03-29', 'Cat5 - cat6 Boot', 'Ali Asghar Hussani', 'PKT', '10', '9.7', 'GRN: 29-03-025 Projects:Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(228, 'XAD001228', '2022-08-11', 'Cat5 - cat6 Boot', 'Azlan Star Tech', 'PKT', '10', '9.7', 'Requested By : Sharafu Tk Based On Purchase Orders 430.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(229, 'XAD000123', '2022-01-04', 'Thimble lugs 50mm', 'Noor Al Iman Elect & Hardware TR', 'PKT', '225', '218.25', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(230, 'XAD000123', '2022-03-31', 'Thimble lugs 50mm', 'Ali Asghar Hussani', 'PKT', '100', '97', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(231, 'XAD000123', '2022-06-16', 'Thimble lugs 50mm', 'Noor Al Iman', 'PKT', '190', '184.3', 'Nokia Mobile Project Based On Purchase Orders 195.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(232, 'XAD000123', '2022-09-14', 'Thimble lugs 50mm', 'Wenzhou Zhechi', 'PKT', '65.69', '63.7193', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(233, 'XAD000123', '2022-12-12', 'Thimble lugs 50mm', 'Fas Arabia llc', 'PKT', '45', '43.65', 'Generated for specimen Based On Purchase Orders 1396.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(234, 'XAD000125', '2023-11-27', 'Power DB with Complete Fitting ( 3 Phase )', 'Noor Al Iman', 'PCS', '975', '945.75', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(235, 'XAD000127', '2023-02-11', '6U Rack 600x450', 'Azlan Star Technologies LLC', 'PCS', '150', '145.5', 'Based On Purchase Orders 1702.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(236, 'XAD000130', '2023-12-12', 'Pigtail 2.5m S/M  SC-APC', 'The Mark Infotech System Solutions LLC', 'PCS', '2.2', '2.134', 'REQUEST NO 54 OSP LMP Based On Purchase Orders 3631.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(237, 'XAD000130', '2024-01-08', 'Pigtail 2.5m S/M  SC-APC', 'SKYMAX GENERAL TRADING FZE', 'PCS', '1.5', '1.455', 'REQUEST No  OSP LMP 2 JAN 24 Based On Purchase Orders 3797.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(238, 'XAD000131', '2022-08-18', 'Woodl Nail 1.5\"', 'JOGA RAM GENERAL TRADING LLC', 'Box', '32', '31.04', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(239, 'XAD000131', '2022-12-08', 'Woodl Nail 1.5\"', 'Al Moazam Stores LLC', 'Box', '1.25', '1.2125', 'Request No : Sep-003 Requested By : Sufian Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 730.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(240, 'XAD000131', '2023-01-28', 'Woodl Nail 1.5\"', 'MAA ALMADINA BUILDING MATERIAL', 'Box', '20', '19.4', 'Request No : AUH-OLT-140 Based On Purchase Orders 1492.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(241, 'XAD000133', '2023-01-21', 'Nylone Rope 2mm', 'Noor Al Iman', 'Roll', '5', '4.85', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(242, 'XAD000133', '2023-02-03', 'Nylone Rope 2mm', 'Ali Asghar Hussani', 'Roll', '3.5', '3.395', 'Based On Purchase Orders 1639.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(243, 'XAD000135', '2022-10-28', 'Brush D-54', 'Frontier Innovation General Trading', 'PCS', '875', '848.75', 'Project : L&T Etihad Rail (KPO) Request No : L&T-01-DIC-DXB Requested By : Aqeel Butt Verified By : Sufiyan Shaukat & Imran Iqbal Based On Purchase Orders 851.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(244, 'XAD000140', '2022-01-18', 'SSD Crucial 1TB', 'Future City Computers', 'PCS', '270', '261.9', 'GRN :18-01-033 Project: Common  for Sufian Shoukat Based On Purchase Orders:3455', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(245, 'XAD000140', '2023-01-31', 'SSD Crucial 1TB', 'Ultra Stream Technologies LLC', 'PCS', '220', '213.4', 'SSD For Outsource Staff Mr Tariq Ahmed Khan DU SFAN. Based On Purchase Orders 1596.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(246, 'XAD000140', '2023-08-18', 'SSD Crucial 1TB', 'MAQSOOD & ABDUL HAFEEZ COMPUTERS TRADING LLC', 'PCS', '185', '179.45', 'New SSD & USB Required For Backup Purpose IT Department . Based On Purchase Orders 3028.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(247, 'XAD000140', '2023-09-08', 'SSD Crucial 1TB', 'The Mark Infotech System Solutions LLC', 'PCS', '249.49', '242.0053', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2001.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(248, 'XAD000140', '2023-09-26', 'SSD Crucial 1TB', 'SKYMAX GENERAL TRADING FZE', 'PCS', '170', '164.9', '2 1TB SSD Required For Muhammad Tanveer & Raja Zeeshan Laptop . Based On Purchase Orders 3272.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(249, 'XAD000140', '2023-12-16', 'SSD Crucial 1TB', 'AL Fajar Computer Trading LLC', 'PCS', '225', '218.25', 'Based On Purchase Orders 3658.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(250, 'XAD000141', '2022-11-01', 'Hammer 4LB', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Request No : ADWEA 89   Requested By : Jawad Malik & Screenath CK Verified By      : Wasiullah KHan Based On Purchase Orders 1006.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(251, 'XAD000141', '2022-12-12', 'Hammer 4LB', 'Fas Arabia llc', 'PCS', '15', '14.55', 'Generated for specimen Based On Purchase Orders 1396.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(252, 'XAD000141', '2023-03-15', 'Hammer 4LB', 'Al Moazam Stores LLC', 'PCS', '60', '58.2', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1857.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(253, 'XAD000142', '2022-10-13', 'Hammer 80Z', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 778.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(254, 'XAD000142', '2023-04-26', 'Hammer 80Z', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '40', '38.8', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2011.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(255, 'XAD0001420', '2023-06-07', 'Deep Profile Mass Fusion Flip Tray 288 Splice CT.', 'Superior Technologies', 'PCS', '115.52', '112.0544', 'Request No : DU SFAN -191 -  30 - May - 2023 . Based On Purchase Orders 2470.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(256, 'XAD0001421', '2023-12-29', '1/2/3G On/Off Switch ( 15A/220V ) Point Indoor', 'Eilaf Technical Services LLC', 'PCS', '300', '291', 'Smart Solution Installation At Director Mr. Midfa House . Based On Purchase Orders 2501.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(257, 'XAD0001422', '2023-12-29', 'Power Switch ( 40A/220V )', 'Eilaf Technical Services LLC', 'PCS', '337.5', '327.375', 'Smart Solution Installation At Director Mr. Midfa House . Based On Purchase Orders 2501.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(258, 'XAD0001423', '2023-12-29', '4 Key OTC', 'Eilaf Technical Services LLC', 'PCS', '400', '388', 'Smart Solution Installation At Director Mr. Midfa House . Based On Purchase Orders 2501.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(259, 'XAD0001424', '2023-12-29', 'Media Controller ( Surface Mount )', 'Eilaf Technical Services LLC', 'PCS', '420', '407.4', 'Smart Solution Installation At Director Mr. Midfa House . Based On Purchase Orders 2501.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(260, 'XAD0001425', '2023-12-29', 'HUB ( TGATE )', 'Eilaf Technical Services LLC', 'PCS', '900', '873', 'Smart Solution Installation At Director Mr. Midfa House . Based On Purchase Orders 2501.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(261, 'XAD0001426', '2023-06-17', 'Wireless Mic ( DSLR )', 'Virgin Megastore HQ', 'PCS', '714', '692.58', 'Camera Wireless Mic Required For DSLR . Based On Purchase Orders 2563.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(262, 'XAD0001429', '2023-07-15', 'ELCB Breaker 40 Amp 2 Pole', 'Noor Al Iman', 'PCS', '90', '87.3', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(263, 'XAD000143', '2023-12-23', 'Cleaning Brush Big', 'SM And Rahmani Building Materials Trading LLC', 'PCS', '7', '6.79', 'Material For ICT School Project Based On Purchase Orders 3716.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(264, 'XAD0001430', '2023-07-15', 'ELCB Breaker 63 Amp 2 Pole', 'Noor Al Iman', 'PCS', '130', '126.1', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(265, 'XAD0001432', '2023-07-15', 'Concrete Block 400 x 150 x 200 mm', 'Noor Al Iman', 'PCS', '105', '101.85', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(266, 'XAD0001432', '2023-09-09', 'Concrete Block 400 x 150 x 200 mm', 'Ali Asghar Hussani', 'PCS', '3.5', '3.395', 'Request No : DU SFAN - 245 - 06-09-2023 . Based On Purchase Orders 3119. Based On Goods Receipt PO 1293.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(267, 'XAD0001433', '2023-07-15', 'ELCB Breaker 63 Amp 4 Pole', 'Noor Al Iman', 'PCS', '120', '116.4', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(268, 'XAD0001435', '2023-07-17', 'Looping Bar Line 1 line', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(269, 'XAD0001436', '2023-07-17', 'Looping Bar Line 2 line', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(270, 'XAD0001437', '2023-07-17', 'Looping Bar Line 3 line', 'Ali Asghar Hussani', 'PCS', '35', '33.95', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(271, 'XAD000144', '2022-12-12', 'Shovel', 'Fas Arabia llc', 'PCS', '35', '33.95', 'Generated for specimen Based On Purchase Orders 1396.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(272, 'XAD000144', '2023-04-28', 'Shovel', 'Smooth Solution building Materails Trading LLC', 'PCS', '18', '17.46', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(273, 'XAD000144', '2023-05-18', 'Shovel', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '18', '17.46', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(274, 'XAD000144', '2023-05-29', 'Shovel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '15', '14.55', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2309.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(275, 'XAD000144', '2023-11-11', 'Shovel', 'Al Moazam Stores LLC', 'PCS', '25', '24.25', 'Request No : AAN-OLT-OCT-23-0094 & 0091 .  Consumable Civil Material Required For AAN-OLT Project Nov-2023 . Based On Purchase Orders 3416.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(276, 'XAD000144', '2023-12-21', 'Shovel', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'REQUEST NO 11 ICT SCHOOL PROJECT Based On Purchase Orders 3690.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(277, 'XAD000145', '2022-03-08', 'Paint Brush Perfect 2 Inches', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'PO_3649-OLT AAN Based On Purchase Orders 11. GRN-08-03-012', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(278, 'XAD000145', '2023-04-04', 'Paint Brush Perfect 2 Inches', 'Smooth Solution building Materails Trading LLC', 'PCS', '5', '4.85', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2006.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(279, 'XAD000148', '2023-05-17', 'Dry Powder Fire Extinguisher 2kg', 'Smooth Solution building Materails Trading LLC', 'PCS', '95', '92.15', 'Request No : 190 Based On Purchase Orders 2352.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(280, 'XAD000148', '2023-09-20', 'Dry Powder Fire Extinguisher 2kg', 'Ali Asghar Hussani', 'PCS', '40', '38.8', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(281, 'XAD000149', '2023-11-28', 'Rigger Helmet White', 'Ali Asghar Hussani', 'PCS', '90', '87.3', '.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(282, 'XAD000149', '2023-12-06', 'Rigger Helmet White', 'Fas Arabia llc', 'PCS', '230', '223.1', 'NOKIA MATERIAL REQUEST Based On Purchase Orders 3577.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(283, 'XAD000150', '2022-12-30', 'Safety Helmet white', 'Mills LTD', 'PCS', '20.84', '20.2148', 'Request No : XAD-SIRIUS-UK-004 Based On Purchase Orders 1427.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(284, 'XAD000150', '2023-03-07', 'Safety Helmet white', 'Securintec Information Technology LLC', 'PCS', '2.14', '2.0758', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(285, 'XAD000150', '2023-11-28', 'Safety Helmet white', 'Ali Asghar Hussani', 'PCS', '105', '101.85', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(286, 'XAD000150', '2023-12-12', 'Safety Helmet white', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '7.5', '7.275', 'DU CIVIL REQUEST NO 2 Based On Purchase Orders 3622.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(287, 'XAD000150', '2024-02-22', 'Safety Helmet white', 'Noor Al Iman', 'PCS', '8', '7.76', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(288, 'XAD000151', '2022-07-15', 'Simple Helmet Blue', 'Noor Al Iman', 'PCS', '10', '9.7', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(289, 'XAD000152', '2022-07-15', 'Simple Helmet Red', 'Noor Al Iman', 'PCS', '10', '9.7', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(290, 'XAD000153', '2022-07-23', 'Simple Helmet Yellow', 'Ali Asghar Hussani', 'PCS', '7', '6.79', 'Solar  Project Based On Purchase Orders 345.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(291, 'XAD000154', '2022-07-07', 'Safety Board Plastic yellow (work in Progress)', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Adwea Based On Purchase Orders 272.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(292, 'XAD000157', '2023-05-29', 'Road Side Caution Light Yellow', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '11', '10.67', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2309.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(293, 'XAD000157', '2024-02-24', 'Road Side Caution Light Yellow', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'REQUEST NO 307  DU SFAN PROJECT DXB REGION Based On Purchase Orders 4160.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(294, 'XAD000158', '2023-02-10', 'Disposeable Gloves Vinyl', 'Ali Asghar Hussani', 'Box', '20', '19.4', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(295, 'XAD000158', '2023-04-19', 'Disposeable Gloves Vinyl', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Box', '12', '11.64', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2129.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(296, 'XAD000159', '2023-01-23', 'Electrical Hand Gloves', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '28', '27.16', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(297, 'XAD000159', '2023-02-14', 'Electrical Hand Gloves', 'Noor Al Iman', 'PCS', '35', '33.95', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1696.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(298, 'XAD000159', '2023-10-02', 'Electrical Hand Gloves', 'Ali Asghar Hussani', 'PCS', '38', '36.86', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3111.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(299, 'XAD000160', '2023-02-20', 'Safety Cone 1M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '20', '19.4', 'Request No : WR 101H - 214 - Feb 2023. Based On Purchase Orders 1736.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(300, 'XAD000160', '2024-02-24', 'Safety Cone 1M', 'Ali Asghar Hussani', 'PCS', '18.5', '17.945', 'REQUEST NO 307  DU SFAN PROJECT DXB REGION Based On Purchase Orders 4160.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(301, 'XAD000162', '2022-03-28', 'DC Cable 35mm Black', 'Noor Al Iman Elect & Hardware TR', 'MTR', '16.5', '16.005', 'PO_3724-Huawei Based On Purchase Orders 54. GRN-28-03-023', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(302, 'XAD000162', '2022-11-08', 'DC Cable 35mm Black', 'Noor Al Iman', 'MTR', '17.5', '16.975', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(303, 'XAD000162', '2023-04-04', 'DC Cable 35mm Black', 'Smooth Solution building Materails Trading LLC', 'MTR', '14.34', '13.9098', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(304, 'XAD000162', '2023-10-27', 'DC Cable 35mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '16.9', '16.393', 'Request No : XAD-HW-OCT-DXB-098 . Based On Purchase Orders 3372.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(305, 'XAD000164', '2022-09-05', 'Uniform Polo Shirt Gray with Etisalat and Xad Logo M', 'MSK Corporate Services', 'PCS', '25', '24.25', 'Requested no 011/22 Based On Purchase Orders 609.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(306, 'XAD000165', '2022-04-09', 'Uniform Polo Shirt Gray with Etisalat and Xad Logo L', 'Emporium Gulf', 'PCS', '24', '23.28', 'PO_3726-101 WR Based On Purchase Orders 60. GRN-09-04-006', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(307, 'XAD000166', '2022-04-09', 'Uniform Polo Shirt Gray with Etisalat and Xad Logo XL', 'Emporium Gulf', 'PCS', '24', '23.28', 'PO_3726-101 WR Based On Purchase Orders 60. GRN-09-04-006', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(308, 'XAD000167', '2022-04-09', 'Uniform Polo Shirt Gray with Etisalat and Xad Logo XXL', 'Emporium Gulf', 'PCS', '24', '23.28', 'PO_3726-101 WR Based On Purchase Orders 60. GRN-09-04-006', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(309, 'XAD000168', '2023-06-22', 'Drop Fibre 4 Core ( Outdoor )', 'ZOOM LINE NETWORKS TECHNOLOGY', 'Roll', '295', '286.15', 'Request No : OSP - 13 - DXB-AUH-NE Date : 14-06-2023 . Based On Purchase Orders 2614.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(310, 'XAD000171', '2023-05-10', 'Patch Cord 10M LC-LC UPC', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '9.5', '9.215', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2268.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(311, 'XAD000171', '2023-05-17', 'Patch Cord 10M LC-LC UPC', 'The Mark Infotech System Solutions LLC', 'PCS', '17.5', '16.975', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2339.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(312, 'XAD000172', '2024-01-11', 'Main Hole key Big', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'REQUEST NO 287 DU SFAN PROJECT Based On Purchase Orders 3852.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(313, 'XAD000172', '2024-02-12', 'Main Hole key Big', 'Al Mathana Welding & Blacksmith Workshop', 'PCS', '55', '53.35', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4066.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(314, 'XAD000174', '2022-08-12', 'Marker Strip Plastic MS 135', 'Abazar Building Materail LLC Qusais', 'PKT', '14', '13.58', 'Based On Purchase Orders 405.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(315, 'XAD000174', '2022-09-14', 'Marker Strip Plastic MS 135', 'Wenzhou Zhechi', 'PKT', '7.27', '7.0519', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(316, 'XAD000174', '2023-06-19', 'Marker Strip Plastic MS 135', 'Noor Al Iman', 'PKT', '14', '13.58', 'Request No : AAN-June-23-0053 - 02-06-2023 . Based On Purchase Orders 2484.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(317, 'XAD000174', '2024-02-15', 'Marker Strip Plastic MS 135', 'Ali Asghar Hussani', 'PKT', '17', '16.49', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4065.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(318, 'XAD000178', '2022-09-03', 'LED Emergency Light', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '160', '155.2', 'Project : FDH AAN Requested By : Nikunj Patel Verified By : Mr Shamas Tabraiz Based On Purchase Orders 544.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(319, 'XAD000178', '2023-01-24', 'LED Emergency Light', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'Request No : DU SFAN - 93 - Jan - 2023 Based On Purchase Orders 1528.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(320, 'XAD000179', '2022-02-26', 'Cable Tie 150*4.8mm White', 'Noor Al Iman Elect & Hardware TR', 'PKT', '3', '2.91', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(321, 'XAD000179', '2022-03-08', 'Cable Tie 150*4.8mm White', 'Wenzhou Zhechi', 'PKT', '1.54', '1.4938', 'Material purchase from China for DU SFAN Based On Purchase Orders 355.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(322, 'XAD000179', '2022-05-28', 'Cable Tie 150*4.8mm White', 'Ali Asghar Hussani', 'PKT', '2.5', '2.425', 'ADWEA Based On Purchase Orders 141.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(323, 'XAD000179', '2022-11-25', 'Cable Tie 150*4.8mm White', 'Noor Al Iman', 'PKT', '2', '1.94', 'Request No : AAN-101H/018 Based On Purchase Orders 1324.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(324, 'XAD000180', '2022-06-28', 'Fiber Stripper', 'Cash', 'PCS', '25', '24.25', 'Huawei Mobile Project Based On Purchase Orders 238.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(325, 'XAD000180', '2022-09-09', 'Fiber Stripper', 'Alpha Link Technologies LLC', 'PCS', '190', '184.3', 'Project : AAN OLT Requested By \" Sufian Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 578.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(326, 'XAD000180', '2022-11-18', 'Fiber Stripper', 'Azlan Star Technologies LLC', 'PCS', '30', '29.1', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1291.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(327, 'XAD000180', '2023-05-04', 'Fiber Stripper', 'MITTCO Llc', 'PCS', '36.98', '35.8706', 'Request No : DU SFAN-161-10-4-2023 . Based On Purchase Orders 2118.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(328, 'XAD000180', '2023-07-12', 'Fiber Stripper', 'The Mark Infotech System Solutions LLC', 'PCS', '25', '24.25', 'Request No : DU SFAN - 194 . Based On Purchase Orders 2711.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(329, 'XAD000183', '2023-10-27', 'Rosette Box', 'Cendhurr Telecom LLC', 'PCS', '13', '12.61', 'Request No : OSP-LMP-47-16-10-2023 . Based On Purchase Orders 3319.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(330, 'XAD000183', '2024-01-19', 'Rosette Box', 'SKYMAX GENERAL TRADING FZE', 'PCS', '23', '22.31', 'Rosette Box For OSP LMP Project Based On Purchase Orders 3925.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(331, 'XAD000183', '2024-01-23', 'Rosette Box', 'Cash', 'PCS', '17', '16.49', 'OSP LMP PROJECT Based On Purchase Orders 3959.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(332, 'XAD000183', '2024-03-01', 'Rosette Box', 'AL Thanaa Trading Co LLC', 'PCS', '17', '16.49', 'REQUEST NO : OSP/LMP 07 - Feb, 24 Based On Purchase Orders 4122.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(333, 'XAD000185', '2023-12-20', 'Folding Table', 'Ali Asghar Hussani', 'PCS', '140', '135.8', 'REQUEST NO 283  DU SFAN PROJECT Based On Purchase Orders 3664.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(334, 'XAD000189', '2023-02-03', 'Combination Spanner 17mm', 'Ali Asghar Hussani', 'PCS', '7', '6.79', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(335, 'XAD000189', '2023-02-15', 'Combination Spanner 17mm', 'Noor Al Iman', 'PCS', '6.25', '6.0625', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(336, 'XAD000190', '2023-02-03', 'Combination Spanner 13mm', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(337, 'XAD000193', '2022-02-09', 'Channel Screw 0.75\"', 'Ali Asghar Hussani', 'PCS', '30', '29.1', 'GRN : -9-02-017 Project: DU SFAN Based On Purchase Orders 105/3568', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(338, 'XAD000193', '2022-02-26', 'Channel Screw 0.75\"', 'Noor Al Iman Elect & Hardware TR', 'PCS', '0.02', '0.0194', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(339, 'XAD000193', '2023-03-11', 'Channel Screw 0.75\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.4', '0.388', 'Request No : SmartHome-XAD-013-13-03-2023 . Based On Purchase Orders 2636.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(340, 'XAD000195', '2023-07-15', 'Compass', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '30', '29.1', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2718.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(341, 'XAD000197', '2022-11-26', 'Level meter', 'Ali Asghar Hussani', 'PCS', '35', '33.95', 'Request No : ADWEA-94-AUH Based On Purchase Orders 1281.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(342, 'XAD000197', '2023-03-08', 'Level meter', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '27', '26.19', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1847.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(343, 'XAD000197', '2023-03-27', 'Level meter', 'Noor Al Iman', 'PCS', '26', '25.22', 'Request No : XAD-HW-Jan-DXB-093 - 17-03-2023 Based On Purchase Orders 1956.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(344, 'XAD000197', '2023-04-28', 'Level meter', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '35', '33.95', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(345, 'XAD000198', '2022-12-27', 'Digital Clamp Meter ( Fluke )', 'Smooth Solution building Materails Trading LLC', 'PCS', '120', '116.4', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(346, 'XAD000198', '2023-02-25', 'Digital Clamp Meter ( Fluke )', 'Ali Asghar Hussani', 'PCS', '165', '160.05', 'Request No : XAD-HW-Jan-DXB-085 Based On Purchase Orders 1745.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(347, 'XAD000198', '2023-03-06', 'Digital Clamp Meter ( Fluke )', 'Noor Al Iman', 'PCS', '65', '63.05', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1854.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(348, 'XAD000198', '2023-04-28', 'Digital Clamp Meter ( Fluke )', 'Ali Asghar Hussani', 'PCS', '170', '164.9', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2185.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(349, 'XAD000200', '2022-09-14', 'PVC Glands 16mm', 'Wenzhou Zhechi', 'PCS', '0.12', '0.1164', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(350, 'XAD000200', '2023-09-20', 'PVC Glands 16mm', 'Ali Asghar Hussani', 'PCS', '0.65', '0.6305', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(351, 'XAD000202', '2022-01-03', 'Battery AA', 'Al Madina Hyper Market', 'PCS', '2.54', '2.4638', 'PO-3346 Based On Purchase Orders 1.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(352, 'XAD000202', '2022-07-25', 'Battery AA', 'Azlan Star Tech', 'PCS', '0.6', '0.582', 'Nokia Mobile Project Based On Purchase Orders 359.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(353, 'XAD000202', '2022-09-11', 'Battery AA', 'Ola Al Madina SuperMarket', 'PCS', '2.84', '2.7548', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK Verified By     : Anasr Abbas & Sharafu Tk Based On Purchase Orders 629.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(354, 'XAD000202', '2023-01-12', 'Battery AA', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.5', '1.455', 'Request No : DU SFAN - 93 - Jan - 2023 Based On Purchase Orders 1527.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(355, 'XAD000202', '2023-06-21', 'Battery AA', 'Cash', 'PCS', '3.33', '3.2301', 'Request No: OSP-05 04-05-2 Based On Purchase Orders 2210.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(356, 'XAD000202', '2023-12-12', 'Battery AA', 'Al Jamal Stationery LLC', 'PCS', '3.34', '3.2398', 'Request No : 55 Based On Purchase Orders 3618.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(357, 'XAD000202', '2024-02-28', 'Battery AA', 'Ali Asghar Hussani', 'PCS', '2.75', '2.6675', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(358, 'XAD000203', '2022-02-01', 'Battery AAA', 'MSK Corporate Services', 'PCS', '2.83', '2.7451', 'GRN    : 9-02-007 Project :  Nokia OD Based On Purchase Orders: 3551', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(359, 'XAD000203', '2022-07-25', 'Battery AAA', 'Azlan Star Tech', 'PCS', '0.75', '0.7275', 'Nokia Mobile Project Based On Purchase Orders 359.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(360, 'XAD000203', '2022-08-15', 'Battery AAA', 'Madina Markeet', 'PCS', '2.7', '2.619', 'Project : ADWEA  Requested By : Sreenath C K  Verified By : Wasiullah Khan & Badi ul rehman Based On Purchase Orders 466.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(361, 'XAD000203', '2022-08-25', 'Battery AAA', 'Azlan Star Technologies LLC', 'PCS', '3.5', '3.395', 'Project : Nokia Requested By : Muhammad talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 521.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(362, 'XAD000203', '2022-09-11', 'Battery AAA', 'Ola Al Madina SuperMarket', 'PCS', '2.78', '2.6966', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK Verified By     : Anasr Abbas & Sharafu Tk Based On Purchase Orders 629.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(363, 'XAD000203', '2022-12-27', 'Battery AAA', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.25', '2.1825', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(364, 'XAD000203', '2023-01-30', 'Battery AAA', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.5', '1.455', 'Request No : Adwea-113-Jan-2023. Based On Purchase Orders 1638.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(365, 'XAD000203', '2023-03-12', 'Battery AAA', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '2.86', '2.7742', 'Request No : ADWEA-134-02-2-2023  ( 83.5 Pkt , 12 Pcs In One Pkt ) Based On Purchase Orders 1698.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(366, 'XAD000203', '2023-03-21', 'Battery AAA', 'Al Madina Hyper Market', 'PCS', '3.33', '3.2301', 'Request No : ADWEA-134-02-2-2023  ( 80 PKT , 12 PC In One PKT ) Based On Purchase Orders 1786.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(367, 'XAD000203', '2023-06-21', 'Battery AAA', 'Cash', 'PCS', '3.33', '3.2301', 'Based On Purchase Orders 2527.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(368, 'XAD000203', '2024-01-04', 'Battery AAA', 'Al Jamal Stationery LLC', 'PCS', '3.33', '3.2301', 'HUAWEI PROJECT REQUEST 098 Based On Purchase Orders 3721.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(369, 'XAD000203', '2024-01-05', 'Battery AAA', 'Ali Asghar Hussani', 'PCS', '2.75', '2.6675', 'REQUEST NO 58 OSP LMP PROJECT Based On Purchase Orders 3771.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(370, 'XAD000204', '2023-02-10', 'Flag', 'M S K Corporate Services Provides EST', 'PCS', '55', '53.35', 'Based On Purchase Orders 1709.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(371, 'XAD000204', '2024-02-24', 'Flag', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'REQUEST NO 307  DU SFAN PROJECT DXB REGION Based On Purchase Orders 4160.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(372, 'XAD000205', '2023-01-24', 'Pocket Wind and Temperature Meter Kestrel', 'Ali Asghar Hussani', 'PCS', '350', '339.5', 'Based On Purchase Orders 1584.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(373, 'XAD000206', '2022-08-23', 'Uniform CoverAll', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '32', '31.04', 'Project : DU SFAN Requested By : Mufeed KK  Verified By : Ansar Abbas & Sharafu TK Based On Purchase Orders 504.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(374, 'XAD000206', '2023-12-13', 'Uniform CoverAll', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'REQUEST NO 270 DU SFAN Based On Purchase Orders 3643.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(375, 'XAD000208', '2022-10-07', 'Binocular', 'fujian freespace electronics trading fzco', 'PCS', '123.8', '120.086', 'Request No : Sep-DXB-068 Requested By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 837.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(376, 'XAD000208', '2023-07-15', 'Binocular', 'Cash', 'PCS', '100', '97', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2724.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(377, 'XAD000209', '2022-03-31', 'Walkie Talkie', 'Swin Lighting FZCO', 'PCS', '90', '87.3', 'GRN   : 31-03-030 Project: Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(378, 'XAD000209', '2023-06-30', 'Walkie Talkie', 'Cash', 'PCS', '120', '116.4', 'Walkie Talkie Required For Nokia Project Staff .  During the purchasing time suuplier give 20  discount to Mr. Naseer , that\'s why we revise the PO. Based On Purchase Orders 2523.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(379, 'XAD000210', '2022-10-13', 'Drill Bit 25mm concrete', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 778.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(380, 'XAD000210', '2023-03-06', 'Drill Bit 25mm concrete', 'Noor Al Iman', 'PCS', '30', '29.1', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1854.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(381, 'XAD000210', '2023-03-08', 'Drill Bit 25mm concrete', 'Smooth Solution building Materails Trading LLC', 'PCS', '23', '22.31', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(382, 'XAD000211', '2022-09-14', 'Steel Strip 19 X 89 X 0.4', 'Wenzhou Zhechi', 'PKT', '28.99', '28.1203', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(383, 'XAD000211', '2023-05-12', 'Steel Strip 19 X 89 X 0.4', 'Noor Al Iman', 'PKT', '55', '53.35', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2266.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(384, 'XAD000212', '2022-03-29', 'Bus Bar', 'Noor Al Iman Elect & Hardware TR', 'PCS', '85', '82.45', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(385, 'XAD000212', '2022-10-08', 'Bus Bar', 'Smooth Solution building Materails Trading LLC', 'PCS', '80', '77.6', 'Request No : DXB-Sep-067 Requested By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 731.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(386, 'XAD000212', '2023-11-27', 'Bus Bar', 'Noor Al Iman', 'PCS', '85', '82.45', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(387, 'XAD000213', '2022-06-17', 'Drill Bit 12mm Steel', 'Noor Al Iman', 'PCS', '12', '11.64', 'Adwea Project Based On Purchase Orders 211.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(388, 'XAD000213', '2023-01-26', 'Drill Bit 12mm Steel', 'Ali Asghar Hussani', 'PCS', '7.8', '7.566', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(389, 'XAD000213', '2023-03-08', 'Drill Bit 12mm Steel', 'Smooth Solution building Materails Trading LLC', 'PCS', '12', '11.64', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(390, 'XAD000213', '2023-10-02', 'Drill Bit 12mm Steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '8', '7.76', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(391, 'XAD000214', '2022-01-04', 'Grounding Tape Y/G', 'Noor Al Iman Elect & Hardware TR', 'PCS', '1', '0.97', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(392, 'XAD000214', '2023-03-18', 'Grounding Tape Y/G', 'Noor Al Iman', 'PCS', '1', '0.97', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(393, 'XAD000214', '2023-09-21', 'Grounding Tape Y/G', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.4', '1.358', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3189.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(394, 'XAD000214', '2024-01-15', 'Grounding Tape Y/G', 'Ali Asghar Hussani', 'PCS', '1.5', '1.455', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(395, 'XAD000215', '2023-02-17', 'Water Proof Switch Isolator 63A', 'Ali Asghar Hussani', 'PCS', '85', '82.45', 'Request No : XAD-HW-Jan-DXB-085 Based On Purchase Orders 1747.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(396, 'XAD000215', '2024-02-22', 'Water Proof Switch Isolator 63A', 'Noor Al Iman', 'PCS', '92', '89.24', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(397, 'XAD000217', '2022-09-21', 'Drill Machine H.D 2200W Makita', 'Smooth Solution building Materails Trading LLC', 'PCS', '590', '572.3', 'Request No : DU SFAN Sep-2022 ( 60 ) Based On Purchase Orders 634.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(398, 'XAD000218', '2022-05-12', 'Drill Machine 700W Makita', 'Ali Asghar Hussani', 'PCS', '650', '630.5', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(399, 'XAD000219', '2022-09-10', 'Thimble Lugs 10mm', 'Noor Al Iman', 'PKT', '45', '43.65', 'Request Sep DXB 064 Project : Huawei  Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 596.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(400, 'XAD000219', '2022-09-14', 'Thimble Lugs 10mm', 'Wenzhou Zhechi', 'PKT', '18.1', '17.557', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(401, 'XAD000219', '2023-06-14', 'Thimble Lugs 10mm', 'Ali Asghar Hussani', 'PKT', '30', '29.1', 'Request No : XAD-HW-June-DXB-105 Based On Purchase Orders 2536.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(402, 'XAD000220', '2022-01-04', 'Thimble Lugs 16mm', 'Noor Al Iman Elect & Hardware TR', 'PKT', '70', '67.9', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(403, 'XAD000220', '2022-09-14', 'Thimble Lugs 16mm', 'Wenzhou Zhechi', 'PKT', '32.7', '31.719', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(404, 'XAD000220', '2023-02-15', 'Thimble Lugs 16mm', 'Noor Al Iman', 'PKT', '35', '33.95', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(405, 'XAD000220', '2023-03-21', 'Thimble Lugs 16mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '35', '33.95', 'Based On Purchase Orders 1913.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(406, 'XAD000220', '2024-01-15', 'Thimble Lugs 16mm', 'Ali Asghar Hussani', 'PKT', '35', '33.95', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(407, 'XAD000221', '2022-09-10', 'Thimble lugs 25mm', 'Noor Al Iman', 'PKT', '70', '67.9', 'Request Sep DXB 064 Project : Huawei  Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 596.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(408, 'XAD000221', '2022-09-14', 'Thimble lugs 25mm', 'Wenzhou Zhechi', 'PKT', '47.29', '45.8713', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(409, 'XAD000222', '2022-08-29', 'Spiral 10mm White', 'Noor Al Iman', 'PCS', '10', '9.7', 'Project : Huawei requested By : Fazal Abbas  Verified By : Rasheed Ahmad & Sohail Abbas Based On Purchase Orders 551.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(410, 'XAD000222', '2024-01-15', 'Spiral 10mm White', 'Ali Asghar Hussani', 'PCS', '9', '8.73', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(411, 'XAD000223', '2023-12-21', 'Pick Axe', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'REQUEST NO 11 ICT SCHOOL PROJECT Based On Purchase Orders 3690.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(412, 'XAD000224', '2022-02-26', 'Spiral 6mm White', 'Noor Al Iman Elect & Hardware TR', 'PCS', '7', '6.79', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(413, 'XAD000224', '2022-08-12', 'Spiral 6mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(414, 'XAD000224', '2022-10-19', 'Spiral 6mm White', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '9.5', '9.215', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(415, 'XAD000224', '2022-12-24', 'Spiral 6mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '8', '7.76', 'Request  No : XAD-HW-DEC-DXB-078 Based On Purchase Orders 1445.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(416, 'XAD000224', '2023-11-27', 'Spiral 6mm White', 'Noor Al Iman', 'PCS', '2.75', '2.6675', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(417, 'XAD000224', '2023-12-06', 'Spiral 6mm White', 'The Mark Infotech System Solutions LLC', 'PCS', '10', '9.7', 'NOKIA Spliciling Materials Request Based On Purchase Orders 3576.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(418, 'XAD000224', '2024-02-28', 'Spiral 6mm White', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(419, 'XAD000225', '2022-01-04', 'I Lugs 35mm Red', 'Noor Al Iman Elect & Hardware TR', 'PKT', '65', '63.05', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(420, 'XAD000225', '2022-09-10', 'I Lugs 35mm Red', 'Noor Al Iman', 'PKT', '45', '43.65', 'Request Aug 064  Project : Huawei Requested By : JAwad Hussian Verified By : Sohail Abbas Based On Purchase Orders 584.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(421, 'XAD000225', '2022-09-14', 'I Lugs 35mm Red', 'Wenzhou Zhechi', 'PKT', '2.89', '2.8033', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(422, 'XAD000225', '2023-04-03', 'I Lugs 35mm Red', 'Ali Asghar Hussani', 'PKT', '20', '19.4', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(423, 'XAD000226', '2022-01-04', 'I Lugs 25mm Red', 'Noor Al Iman Elect & Hardware TR', 'PKT', '55', '53.35', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(424, 'XAD000226', '2022-03-31', 'I Lugs 25mm Red', 'Ali Asghar Hussani', 'PKT', '20', '19.4', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(425, 'XAD000226', '2022-09-10', 'I Lugs 25mm Red', 'Noor Al Iman', 'PKT', '35', '33.95', 'Request Aug 064  Project : Huawei Requested By : JAwad Hussian Verified By : Sohail Abbas Based On Purchase Orders 584.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(426, 'XAD000226', '2022-09-14', 'I Lugs 25mm Red', 'Wenzhou Zhechi', 'PKT', '5.06', '4.9082', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(427, 'XAD000227', '2022-01-04', 'I Lugs 16mm red', 'Noor Al Iman Elect & Hardware TR', 'PKT', '15', '14.55', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(428, 'XAD000227', '2022-09-14', 'I Lugs 16mm red', 'Wenzhou Zhechi', 'PKT', '2.48', '2.4056', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(429, 'XAD000227', '2023-03-18', 'I Lugs 16mm red', 'Noor Al Iman', 'PKT', '12', '11.64', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(430, 'XAD000227', '2024-01-15', 'I Lugs 16mm red', 'Ali Asghar Hussani', 'PKT', '12', '11.64', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(431, 'XAD000228', '2022-02-26', 'I Lugs 4mm', 'Noor Al Iman Elect & Hardware TR', 'PKT', '10', '9.7', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(432, 'XAD000228', '2022-09-10', 'I Lugs 4mm', 'Noor Al Iman', 'PKT', '5', '4.85', 'Request Sep DXB 064 Project : Huawei  Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 596.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(433, 'XAD000228', '2022-11-19', 'I Lugs 4mm', 'Ali Asghar Hussani', 'PKT', '5', '4.85', 'Based On Purchase Orders 1226.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(434, 'XAD000228', '2023-03-17', 'I Lugs 4mm', 'Wenzhou Zhechi', 'PKT', '1.59', '1.5423', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(435, 'XAD000228', '2023-05-19', 'I Lugs 4mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '6', '5.82', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(436, 'XAD000229', '2022-09-10', 'I Lugs 6mm Red', 'Noor Al Iman', 'PKT', '6', '5.82', 'Request Aug 064  Project : Huawei Requested By : JAwad Hussian Verified By : Sohail Abbas Based On Purchase Orders 584.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(437, 'XAD000229', '2022-09-14', 'I Lugs 6mm Red', 'Wenzhou Zhechi', 'PKT', '1.45', '1.4065', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(438, 'XAD000229', '2022-12-29', 'I Lugs 6mm Red', 'Ali Asghar Hussani', 'PKT', '5', '4.85', 'Request  No : XAD-HW-DEC-DXB-078 Based On Purchase Orders 1446.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(439, 'XAD000230', '2022-07-29', 'DC Cable 16mm Blue', 'Noor Al Iman', 'MTR', '11.5', '11.155', 'Huawei Mobile Project Based On Purchase Orders 383.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(440, 'XAD000230', '2022-10-08', 'DC Cable 16mm Blue', 'Smooth Solution building Materails Trading LLC', 'MTR', '8', '7.76', 'Request No : DXB-Sep-067 Requested By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 731.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(441, 'XAD000230', '2023-03-27', 'DC Cable 16mm Blue', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '8.5', '8.245', 'Request No : XAD-HW-Jan-DXB-093 Based On Purchase Orders 1955.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(442, 'XAD000231', '2022-10-10', 'I Lugs 4mm Yellow', 'Noor Al Iman', 'PCS', '0.05', '0.0485', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(443, 'XAD000232', '2022-08-29', 'PVC Bend 20mm Black', 'Noor Al Iman', 'PCS', '22', '21.34', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(444, 'XAD000232', '2022-10-19', 'PVC Bend 20mm Black', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '24.9', '24.153', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(445, 'XAD000232', '2022-11-19', 'PVC Bend 20mm Black', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Based On Purchase Orders 1226.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(446, 'XAD000232', '2023-10-04', 'PVC Bend 20mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.5', '1.455', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3086.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(447, 'XAD000233', '2022-09-14', 'Steel Cable Tie 4.6 X 300mm', 'Wenzhou Zhechi', 'PKT', '15.41', '14.9477', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(448, 'XAD000233', '2024-01-15', 'Steel Cable Tie 4.6 X 300mm', 'Ali Asghar Hussani', 'PKT', '22', '21.34', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(449, 'XAD000236', '2022-01-04', 'Silicone White', 'Noor Al Iman Elect & Hardware TR', 'PCS', '4', '3.88', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(450, 'XAD000236', '2023-03-18', 'Silicone White', 'Noor Al Iman', 'PCS', '3', '2.91', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(451, 'XAD000236', '2024-01-30', 'Silicone White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '5', '4.85', 'REQUEST NO : XAD-HW-JAN-DXB-100 Based On Purchase Orders 3983.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(452, 'XAD000236', '2024-02-15', 'Silicone White', 'Ali Asghar Hussani', 'PCS', '3.75', '3.6375', 'REQUEST NO : SMART HOME-AAN-002-FEB\'24  AAN REGION Based On Purchase Orders 4082.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(453, 'XAD001231', '2022-10-19', 'Safety Gloves Dotted', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '1.5', '1.455', 'Requet No : DU SFAN-Sep 2022 (66 ) Requested By : Ahmad Iqbal  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 738.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(454, 'XAD001231', '2022-11-08', 'Safety Gloves Dotted', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '2.5', '2.425', 'Request No : AAN-101H-OCT-009  Requested By ; Sufian Shaukat  Verified By     : SHamas Tabraiz & Imran Iqbal Based On Purchase Orders 994.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(455, 'XAD000238', '2022-02-10', 'Fix Bolt 6mm', 'Noor Al Iman', 'PCS', '0.45', '0.4365', 'GRN : 10-02-025 Project:DU SFAN WR Based On Purchase Orders:3579.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(456, 'XAD000238', '2023-09-09', 'Fix Bolt 6mm', 'Ali Asghar Hussani', 'PCS', '0.25', '0.2425', 'Request No : DU SFAN - 245 - 06-09-2023 . Based On Purchase Orders 3119. Based On Goods Receipt PO 1293.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(457, 'XAD000243', '2022-09-21', 'Cable Sleeve 12/6mm Yellow 100m', 'Smooth Solution building Materails Trading LLC', 'Roll', '65', '63.05', 'Request No : ADWEA 65 Requested By : Screenth Ck Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 637.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(458, 'XAD000244', '2022-09-14', 'PVC Glands 50mm', 'Wenzhou Zhechi', 'PCS', '1.17', '1.1349', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(459, 'XAD000244', '2022-10-17', 'PVC Glands 50mm', 'Ali Asghar Hussani', 'PCS', '1.6', '1.552', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 841.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(460, 'XAD000244', '2022-12-21', 'PVC Glands 50mm', 'Noor Al Iman', 'PCS', '5', '4.85', 'Request  No : XAD-HW-DEC-DXB-078 Based On Purchase Orders 1447.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(461, 'XAD000252', '2022-10-10', 'PVC Pipe 25mm Black', 'Noor Al Iman', 'PCS', '5', '4.85', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(462, 'XAD000252', '2023-02-14', 'PVC Pipe 25mm Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '3.6', '3.492', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(463, 'XAD000252', '2023-04-20', 'PVC Pipe 25mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4.25', '4.1225', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2158.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(464, 'XAD000252', '2024-01-09', 'PVC Pipe 25mm Black', 'Ali Asghar Hussani', 'PCS', '4.25', '4.1225', 'REQUEST NO OSP LMP 2 Based On Purchase Orders 3830.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(465, 'XAD000255', '2022-07-26', 'Poly Prime (900 square M) 20 Ltr', 'Ali Asghar Hussani', 'Drum', '490', '475.3', 'LNT Based On Purchase Orders 326.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(466, 'XAD000255', '2022-11-02', 'Poly Prime (900 square M) 20 Ltr', 'Saeed Al Zaabi General Trading LLC', 'Drum', '160', '155.2', 'Request No : L&T Ruwais 211  Requested By : Jahanzaib Anwar Verified By : Rafaqat Mehmood  Imran Iqbal Based On Purchase Orders 991.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(467, 'XAD000255', '2022-11-15', 'Poly Prime (900 square M) 20 Ltr', 'Henkel Polybit Industries LTD', 'Drum', '140', '135.8', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1134.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(468, 'XAD000256', '2022-08-12', 'PVC Trunking 100x100', 'Abazar Building Materail LLC Qusais', 'PCS', '30', '29.1', 'Based On Purchase Orders 405.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(469, 'XAD000256', '2022-09-30', 'PVC Trunking 100x100', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '26.5', '25.705', 'Request No : Sep-DXB-066 Requested By : Muhammad Bilal & Jawad Hussain  Verified By : Sohail Abbas Based On Purchase Orders 672.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(470, 'XAD000256', '2023-01-25', 'PVC Trunking 100x100', 'Noor Al Iman', 'PCS', '30', '29.1', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(471, 'XAD000256', '2023-01-28', 'PVC Trunking 100x100', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '30', '29.1', 'Request No : XAD-HW-JAN-DXB-082 Based On Purchase Orders 1617.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(472, 'XAD000256', '2023-05-16', 'PVC Trunking 100x100', 'Smooth Solution building Materails Trading LLC', 'PCS', '26', '25.22', 'Request No : XAD-HW-May-DXB-100 Based On Purchase Orders 2340.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(473, 'XAD000256', '2024-02-28', 'PVC Trunking 100x100', 'Ali Asghar Hussani', 'PCS', '26', '25.22', 'REQUEST NO : XAD-HW-JAN-DXB-100 Based On Purchase Orders 4186.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(474, 'XAD000257', '2023-02-01', 'Wheel Barrow ( Arbana Troly )', 'Al Moazam Stores LLC', 'PCS', '105', '101.85', 'Request No : AAN-Jan23-007 Based On Purchase Orders 1610.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(475, 'XAD000257', '2023-02-25', 'Wheel Barrow ( Arbana Troly )', 'Ali Asghar Hussani', 'PCS', '130', '126.1', 'Request No : AUH-OLT-0009-10-02-2023 Based On Purchase Orders 1744.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(476, 'XAD000257', '2023-03-15', 'Wheel Barrow ( Arbana Troly )', 'Al Moazam Stores LLC', 'PCS', '130', '126.1', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1857.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(477, 'XAD000257', '2023-05-18', 'Wheel Barrow ( Arbana Troly )', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '130', '126.1', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(478, 'XAD000259', '2023-03-14', 'Telephone Set', 'The Mark Infotech System Solutions LLC', 'PCS', '65', '63.05', 'Request No : DU TCS - 01-03-2023 . Based On Purchase Orders 1840.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(479, 'XAD000260', '2022-01-04', 'I Lugs 50mm Red', 'Noor Al Iman Elect & Hardware TR', 'PKT', '85', '82.45', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(480, 'XAD000260', '2022-03-31', 'I Lugs 50mm Red', 'Ali Asghar Hussani', 'PKT', '45', '43.65', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(481, 'XAD000260', '2022-09-14', 'I Lugs 50mm Red', 'Wenzhou Zhechi', 'PKT', '7.95', '7.7115', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(482, 'XAD000261', '2022-07-07', 'Extension Lead 25M', 'Ali Asghar Hussani', 'PCS', '82', '79.54', 'Adwea Based On Purchase Orders 272.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(483, 'XAD000261', '2023-04-24', 'Extension Lead 25M', 'Smooth Solution building Materails Trading LLC', 'PCS', '95', '92.15', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(484, 'XAD000261', '2023-12-16', 'Extension Lead 25M', 'Ali Asghar Hussani', 'PCS', '110', '106.7', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(485, 'XAD000262', '2023-06-13', 'Mini DB Box', 'Noor Al Iman', 'PCS', '375', '363.75', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2521.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(486, 'XAD000263', '2024-02-22', 'Switch Isolator 40A', 'Noor Al Iman', 'PCS', '73', '70.81', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(487, 'XAD000266', '2022-02-26', 'Drill Bit 20mm concrete', 'Noor Al Iman Elect & Hardware TR', 'PCS', '15', '14.55', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(488, 'XAD000269', '2022-09-09', 'Labeling Cartridge Black & Yellow 12mm', 'Aimo Graphics Company Limited', 'PCS', '4.4', '4.268', 'New Cartridge Order From China Hong Kong.For Xad All Projects. Based On Purchase Orders 618.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(489, 'XAD000269', '2022-11-17', 'Labeling Cartridge Black & Yellow 12mm', 'Azlan Star Technologies LLC', 'PCS', '13.5', '13.095', 'Based On Purchase Orders 1232.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(490, 'XAD000270', '2022-03-28', 'DC Cable 35mm Blue', 'Noor Al Iman Elect & Hardware TR', 'MTR', '16.5', '16.005', 'PO_3724-Huawei Based On Purchase Orders 54. GRN-28-03-023', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(491, 'XAD000270', '2023-04-04', 'DC Cable 35mm Blue', 'Smooth Solution building Materails Trading LLC', 'MTR', '14.34', '13.9098', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(492, 'XAD000270', '2023-10-27', 'DC Cable 35mm Blue', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '16.9', '16.393', 'Request No : XAD-HW-OCT-DXB-098 . Based On Purchase Orders 3372.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(493, 'XAD000271', '2022-09-09', 'Labeling Cartridge Black & Yellow 18mm', 'Aimo Graphics Company Limited', 'PCS', '7.34', '7.1198', 'New Cartridge Order From China Hong Kong.For Xad All Projects. Based On Purchase Orders 618.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(494, 'XAD000271', '2022-11-17', 'Labeling Cartridge Black & Yellow 18mm', 'Azlan Star Technologies LLC', 'PCS', '18', '17.46', 'Based On Purchase Orders 1232.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(495, 'XAD000272', '2023-05-18', 'Pulling Rod 9 * 200M', 'Elfit Arabia', 'PCS', '1666', '1616.02', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2012. Based On Goods Receipt PO 970.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(496, 'XAD000274', '2023-12-06', 'Kerstel 1000 Anemometer', 'Ali Asghar Hussani', 'PCS', '520', '504.4', 'NOKIA MATERIAL REQUEST Based On Purchase Orders 3578.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(497, 'XAD000275', '2022-03-31', 'Tool Bag', 'MSK Corporate Services', 'PCS', '55', '53.35', 'GRN : 31-03-032 Project : Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(498, 'XAD000275', '2022-09-21', 'Tool Bag', 'Smooth Solution building Materails Trading LLC', 'PCS', '75', '72.75', 'Request No : DU SFAN Sep-2022 ( 60 ) Based On Purchase Orders 634.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(499, 'XAD000275', '2023-10-02', 'Tool Bag', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '55', '53.35', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(500, 'XAD000275', '2023-12-16', 'Tool Bag', 'Ali Asghar Hussani', 'PCS', '55', '53.35', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(501, 'XAD000277', '2022-10-19', 'GI Conduit Pipe 20mm', 'JOGA RAM GENERAL TRADING LLC', 'Box', '24', '23.28', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(502, 'XAD000277', '2023-02-16', 'GI Conduit Pipe 20mm', 'Noor Al Iman', 'Box', '20', '19.4', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(503, 'XAD000277', '2023-11-06', 'GI Conduit Pipe 20mm', 'Ali Asghar Hussani', 'Box', '23', '22.31', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(504, 'XAD000278', '2022-07-28', 'GI Conduit Pipe 25mm', 'Imdaad', 'Box', '30', '29.1', 'Huawei Solar Requested by: Asim Waqas  Verified by   : Wasi Ullah Based On Purchase Orders 387.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(505, 'XAD000278', '2022-11-18', 'GI Conduit Pipe 25mm', 'JOGA RAM GENERAL TRADING LLC', 'Box', '30', '29.1', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1130.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(506, 'XAD000278', '2023-01-30', 'GI Conduit Pipe 25mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Box', '30', '29.1', 'Request No : SmartHome-XAD-006-Jan-2023. Based On Purchase Orders 1635.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(507, 'XAD000278', '2023-02-24', 'GI Conduit Pipe 25mm', 'Smooth Solution building Materails Trading LLC', 'Box', '35', '33.95', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1782.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(508, 'XAD000278', '2023-09-27', 'GI Conduit Pipe 25mm', 'Cash', 'Box', '15', '14.55', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(509, 'XAD000278', '2023-12-09', 'GI Conduit Pipe 25mm', 'Noor Al Iman', 'Box', '25', '24.25', 'Consumables and Tools required by Nokia MN Project for month of Nov-23 Based On Purchase Orders 3521.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(510, 'XAD000278', '2024-01-05', 'GI Conduit Pipe 25mm', 'Ali Asghar Hussani', 'Box', '26', '25.22', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(511, 'XAD000279', '2023-04-12', 'Cordless Tightener Stanley', 'Smooth Solution building Materails Trading LLC', 'PCS', '425', '412.25', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(512, 'XAD000279', '2023-12-16', 'Cordless Tightener Stanley', 'Ali Asghar Hussani', 'PCS', '430', '417.1', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(513, 'XAD000280', '2023-11-25', 'BRAIDED ROPE 16MM X200M', 'Ali Asghar Hussani', 'Roll', '1250', '1212.5', 'Consumable & Tools Required For Nokia MN Project Nov-2023 Based On Purchase Orders 3518.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(514, 'XAD000281', '2022-08-04', 'Heat Gun 2000W Stanley', 'Abazar Building Materail LLC Qusais', 'PCS', '125', '121.25', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(515, 'XAD000281', '2022-11-26', 'Heat Gun 2000W Stanley', 'Ali Asghar Hussani', 'PCS', '120', '116.4', 'Request No : ADWEA-94-AUH Based On Purchase Orders 1281.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(516, 'XAD000281', '2022-12-27', 'Heat Gun 2000W Stanley', 'Smooth Solution building Materails Trading LLC', 'PCS', '125', '121.25', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(517, 'XAD000283', '2022-08-18', 'Glue 500 ML', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '30', '29.1', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(518, 'XAD000284', '2022-03-29', 'MCB breaker 32A Single Pole', 'Noor Al Iman Elect & Hardware TR', 'PCS', '12', '11.64', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(519, 'XAD000284', '2022-12-24', 'MCB breaker 32A Single Pole', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '18', '17.46', 'Request  No : XAD-HW-DEC-DXB-078 Based On Purchase Orders 1445.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(520, 'XAD000284', '2023-05-24', 'MCB breaker 32A Single Pole', 'Smooth Solution building Materails Trading LLC', 'PCS', '9.25', '8.9725', 'Request No : XAD -HW - May - DXB-099 Based On Purchase Orders 2366.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(521, 'XAD000284', '2023-11-06', 'MCB breaker 32A Single Pole', 'Ali Asghar Hussani', 'PCS', '9', '8.73', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(522, 'XAD000284', '2023-11-27', 'MCB breaker 32A Single Pole', 'Noor Al Iman', 'PCS', '9', '8.73', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(523, 'XAD000285', '2022-01-04', 'Hex key Set', 'Noor Al Iman Elect & Hardware TR', 'SET', '25', '24.25', 'GRN : 04-01-08', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(524, 'XAD000285', '2023-09-20', 'Hex key Set', 'Ali Asghar Hussani', 'SET', '50', '48.5', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(525, 'XAD000285', '2023-10-02', 'Hex key Set', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'SET', '14', '13.58', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(526, 'XAD000286', '2022-02-01', 'Uniform Du Shirt L (GSM)', 'MSK Corporate Services', 'PCS', '21', '20.37', 'GRN    : 9-02-007 Project :  Nokia OD Based On Purchase Orders: 3551', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(527, 'XAD000286', '2023-09-27', 'Uniform Du Shirt L (GSM)', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3191.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(528, 'XAD000287', '2023-04-01', 'Heat Shrink Tube 60mm (Sleeve)', 'The Mark Infotech System Solutions LLC', 'PCS', '0.09', '0.0873', 'Request No : OSP-01-OSP-Waiter Project 27-03-2023 Based On Purchase Orders 2015.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(529, 'XAD000287', '2023-12-12', 'Heat Shrink Tube 60mm (Sleeve)', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.2', '0.194', 'OSP LMP Request No 54 Based On Purchase Orders 3620.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(530, 'XAD000287', '2024-01-11', 'Heat Shrink Tube 60mm (Sleeve)', 'APKR Networking Zone', 'PCS', '0.08', '0.0776', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(531, 'XAD000287', '2024-02-23', 'Heat Shrink Tube 60mm (Sleeve)', 'SKYMAX GENERAL TRADING FZE', 'PCS', '0.08', '0.0776', 'REQUEST NO : 304 DU SFAN PROJECT DXB REGION Based On Purchase Orders 4159.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(532, 'XAD000288', '2022-07-04', 'GI Conduit Pipe 40mm', 'Noor Al Iman', 'Box', '70', '67.9', 'Solar Project Based On Purchase Orders 291.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(533, 'XAD000289', '2023-04-26', 'Main Hole Key Small', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '18', '17.46', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2011.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(534, 'XAD000289', '2023-12-13', 'Main Hole Key Small', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'REQUEST NO 2 Based On Purchase Orders 3623.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(535, 'XAD000290', '2023-12-20', 'Folding Chair', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'REQUEST NO 283  DU SFAN PROJECT Based On Purchase Orders 3664.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(536, 'XAD000293', '2022-01-10', 'Cutting Disk 14\'\'', 'Ali Asghar Hussani', 'PCS', '11', '10.67', 'GRN : 10-01-016 Project: L&T Etihad Rail Based On Purchase Orders 3410.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(537, 'XAD000293', '2022-11-08', 'Cutting Disk 14\'\'', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '25', '24.25', 'Request No : AAN-101H-OCT-009  Requested By ; Sufian Shaukat  Verified By     : SHamas Tabraiz & Imran Iqbal Based On Purchase Orders 994.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(538, 'XAD000294', '2024-01-24', 'Full Body Harness', 'Fas Arabia llc', 'PCS', '850', '824.5', 'REQUEST NO HW-JAN-DXB-100 Based On Purchase Orders 3922.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(539, 'XAD000295', '2022-03-05', 'ODF 24 Port ( Patch Pannel Wall Mountain PVC', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'GRN      :28-03-016 Project: Huawei SS IBS Based On Purchase Orders: 3641', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(540, 'XAD000297', '2023-08-12', 'MULTI METER UT 50', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'Request No : Huawei-XAD-HW-Aug-DXB-117 . Based On Purchase Orders 2944.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(541, 'XAD000297', '2024-01-19', 'MULTI METER UT 50', 'Securintec Information Technology LLC', 'PCS', '70', '67.9', 'Based On Purchase Orders 1994.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(542, 'XAD000299', '2022-02-26', 'Cable Cutter 8\"', 'Noor Al Iman Elect & Hardware TR', 'PCS', '35', '33.95', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(543, 'XAD000299', '2022-08-12', 'Cable Cutter 8\"', 'Abazar Building Materail LLC Qusais', 'PCS', '22', '21.34', 'Based On Purchase Orders 405.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(544, 'XAD000299', '2023-04-03', 'Cable Cutter 8\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '18', '17.46', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(545, 'XAD000299', '2024-01-11', 'Cable Cutter 8\"', 'Ali Asghar Hussani', 'PCS', '28', '27.16', 'REQUEST NO 287 DU SFAN PROJECT Based On Purchase Orders 3852.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(546, 'XAD000299', '2024-02-22', 'Cable Cutter 8\"', 'Noor Al Iman', 'PCS', '15', '14.55', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(547, 'XAD000300', '2024-02-22', 'Power DB Label', 'Noor Al Iman', 'SET', '28', '27.16', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(548, 'XAD000302', '2022-09-30', 'Electric Socket Double 13A', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '11.5', '11.155', 'Request No : Sep-DXB-066 Requested By : Muhammad Bilal & Jawad Hussain  Verified By : Sohail Abbas Based On Purchase Orders 672.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(549, 'XAD000302', '2023-03-31', 'Electric Socket Double 13A', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(550, 'XAD000302', '2023-05-12', 'Electric Socket Double 13A', 'Noor Al Iman', 'PCS', '15', '14.55', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2266.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(551, 'XAD000302', '2023-12-27', 'Electric Socket Double 13A', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '13', '12.61', 'Smart Home Request No 002 Smart Home Project Based On Purchase Orders 3706.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(552, 'XAD000302', '2024-01-05', 'Electric Socket Double 13A', 'Ali Asghar Hussani', 'PCS', '8.75', '8.4875', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(553, 'XAD000303', '2022-10-19', 'Grounding Cable 35mm', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '15.75', '15.2775', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(554, 'XAD000303', '2023-02-03', 'Grounding Cable 35mm', 'Ali Asghar Hussani', 'MTR', '13', '12.61', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(555, 'XAD000303', '2023-10-27', 'Grounding Cable 35mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '17.8', '17.266', 'Request No : XAD-HW-OCT-DXB-098 . Based On Purchase Orders 3372.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(556, 'XAD000303', '2024-02-22', 'Grounding Cable 35mm', 'Noor Al Iman', 'MTR', '16.75', '16.2475', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(557, 'XAD000304', '2022-03-31', 'Grounding Cable 16mm', 'Noor Al Iman Elect & Hardware TR', 'MTR', '7.5', '7.275', 'GRN :   31-03-027 Project : Nokia TI & OD Based On Purchase Orders 3707', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(558, 'XAD000304', '2022-07-28', 'Grounding Cable 16mm', 'Imdaad', 'MTR', '15', '14.55', 'Huawei Solar Requested by: Asim Waqas  Verified by   : Wasi Ullah Based On Purchase Orders 387.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(559, 'XAD000304', '2022-10-19', 'Grounding Cable 16mm', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '6', '5.82', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(560, 'XAD000304', '2023-02-03', 'Grounding Cable 16mm', 'Ali Asghar Hussani', 'MTR', '7', '6.79', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(561, 'XAD000304', '2024-01-30', 'Grounding Cable 16mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '7.9', '7.663', 'REQUEST NO : XAD-HW-JAN-DXB-100 Based On Purchase Orders 3983.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(562, 'XAD000304', '2024-02-22', 'Grounding Cable 16mm', 'Noor Al Iman', 'MTR', '7.75', '7.5175', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(563, 'XAD000305', '2022-07-07', 'Extension Lead 10m', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'Adwea Based On Purchase Orders 272.', '2024-10-09 03:56:56', '2024-10-09 03:56:56'),
(564, 'XAD000305', '2022-08-29', 'Extension Lead 10m', 'Noor Al Iman', 'PCS', '55', '53.35', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(565, 'XAD000305', '2022-11-02', 'Extension Lead 10m', 'Smooth Solution building Materails Trading LLC', 'PCS', '40', '38.8', 'Request No : SmartHome Xad-001  Requested By : Bashir Subhani Based On Purchase Orders 996.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(566, 'XAD000307', '2023-02-14', 'Combination Plier 8\"', 'Noor Al Iman', 'PCS', '12', '11.64', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1696.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(567, 'XAD000307', '2023-04-26', 'Combination Plier 8\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '34', '32.98', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2011.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(568, 'XAD000307', '2023-05-24', 'Combination Plier 8\"', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2311.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(569, 'XAD000308', '2023-11-27', 'Power DB with Complete Fitting (5G-Small)', 'Noor Al Iman', 'PCS', '375', '363.75', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(570, 'XAD000309', '2022-09-14', 'I Lugs 25mm steel', 'Wenzhou Zhechi', 'PKT', '32.9', '31.913', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(571, 'XAD000309', '2022-11-08', 'I Lugs 25mm steel', 'Noor Al Iman', 'PKT', '75', '72.75', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(572, 'XAD000310', '2022-02-26', 'Fix Bolt 12mm', 'Noor Al Iman Elect & Hardware TR', 'PCS', '1.5', '1.455', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(573, 'XAD000311', '2022-05-20', 'Silicone Black', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'Project : Nokia OD Based On Purchase Orders 120.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(574, 'XAD000311', '2022-07-28', 'Silicone Black', 'Imdaad', 'PCS', '5', '4.85', 'Huawei Solar Requested by: Asim Waqas  Verified by   : Wasi Ullah Based On Purchase Orders 387.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(575, 'XAD000311', '2022-10-19', 'Silicone Black', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '7', '6.79', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(576, 'XAD000311', '2022-11-16', 'Silicone Black', 'Noor Al Iman', 'PCS', '4', '3.88', 'Huawei Based On Purchase Orders 1231.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(577, 'XAD000316', '2022-06-16', 'I Lugs 10mm steel', 'Noor Al Iman', 'PKT', '10', '9.7', 'Nokia Mobile Project Based On Purchase Orders 195.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(578, 'XAD000316', '2022-09-14', 'I Lugs 10mm steel', 'Wenzhou Zhechi', 'PKT', '16.02', '15.5394', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(579, 'XAD000317', '2023-07-15', 'DB Danger Sticker', 'Noor Al Iman', 'PCS', '5', '4.85', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(580, 'XAD000318', '2022-03-29', 'Fix Bolt 10mm', 'Noor Al Iman Elect & Hardware TR', 'PCS', '0.83', '0.8051', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(581, 'XAD000318', '2022-09-14', 'Fix Bolt 10mm', 'Wenzhou Zhechi', 'PCS', '0.36', '0.3492', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(582, 'XAD000318', '2024-01-15', 'Fix Bolt 10mm', 'Ali Asghar Hussani', 'PCS', '0.5', '0.485', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(583, 'XAD000320', '2022-11-19', 'Drill Machine H.D 800W Stanley', 'Ali Asghar Hussani', 'PCS', '480', '465.6', 'Based On Purchase Orders 1230.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(584, 'XAD000321', '2022-08-12', 'Grease 1 KG', 'Abazar Building Materail LLC Qusais', 'PCS', '7.5', '7.275', 'Based On Purchase Orders 405.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(585, 'XAD000321', '2023-07-17', 'Grease 1 KG', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(586, 'XAD000322', '2022-07-21', 'Stainless Steel Hole Saw 25mm', 'Noor Al Iman', 'PCS', '18', '17.46', 'Nokia Mobile  Project Based On Purchase Orders 352.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(587, 'XAD000322', '2022-11-03', 'Stainless Steel Hole Saw 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '12', '11.64', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(588, 'XAD000322', '2022-11-19', 'Stainless Steel Hole Saw 25mm', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Based On Purchase Orders 1230.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(589, 'XAD000322', '2023-01-23', 'Stainless Steel Hole Saw 25mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '22', '21.34', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(590, 'XAD000322', '2023-03-08', 'Stainless Steel Hole Saw 25mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '16', '15.52', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(591, 'XAD000323', '2022-11-25', 'Stainless Steel Hole Saw 32mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '16.5', '16.005', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1289.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(592, 'XAD000323', '2023-09-19', 'Stainless Steel Hole Saw 32mm', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No : Etisalat SmartHome-XAD-0043-NE-13-09-2023 . Based On Purchase Orders 3175.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(593, 'XAD000325', '2023-02-03', 'Combination Spanner 22mm', 'Ali Asghar Hussani', 'PCS', '9', '8.73', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(594, 'XAD000329', '2023-02-03', 'Combination Spanner 19mm', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(595, 'XAD000331', '2022-03-31', 'Combination Spanner 32mm', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(596, 'XAD000334', '2023-12-06', 'Pulley 1 Ton Green', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'NOKIA MATERIAL REQUEST Based On Purchase Orders 3578.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(597, 'XAD000335', '2022-03-31', 'Pulley 1.5 Ton Green', 'Ali Asghar Hussani', 'PCS', '60', '58.2', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(598, 'XAD000336', '2022-04-11', 'Pulley 2 Ton Green', 'Ali Asghar Hussani', 'PCS', '70', '67.9', 'PO-3742-Huawei - IBS 5G Based On Purchase Orders 57. GRN-07-04-003', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(599, 'XAD000343', '2022-08-12', 'Shuttering Clamp 4.5mm x 4ft', 'Al Moazam Stores LLC', 'PCS', '6', '5.82', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(600, 'XAD000344', '2023-03-21', 'JRC 12 Frame cover with Accessories', 'MITTCO Llc', 'PCS', '1400', '1358', 'Request No : WR-232-07-03-2023 . Based On Purchase Orders 1939.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(601, 'XAD000344', '2023-07-20', 'JRC 12 Frame cover with Accessories', 'Cendhurr Telecom LLC', 'PCS', '1345', '1304.65', 'Request No : AAN-July-23-0067 - 13-07-2023 . Based On Purchase Orders 2775.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(602, 'XAD000344', '2024-01-03', 'JRC 12 Frame cover with Accessories', 'Frontier Innovation General Trading', 'PCS', '1320', '1280.4', 'REQUEST NO 296 WR 101H PROJECT Based On Purchase Orders 3718.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(603, 'XAD000344', '2024-01-29', 'JRC 12 Frame cover with Accessories', 'Elfit Arabia', 'PCS', '1320', '1280.4', 'Request No AAN 2024 104 Based On Purchase Orders 3923.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(604, 'XAD000345', '2022-04-11', 'AC Power Cable 3 Core ( Armoured Black )', 'Noor Al Iman', 'MTR', '8', '7.76', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(605, 'XAD000346', '2022-03-29', 'GI Bolt 10 x 90Cm', 'Noor Al Iman Elect & Hardware TR', 'PCS', '0.4', '0.388', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(606, 'XAD000346', '2023-11-22', 'GI Bolt 10 x 90Cm', 'Ali Asghar Hussani', 'PCS', '0.42', '0.4074', 'Request No  : Huawei Mobile Project, XAD -HW -May - DXB-098 Based On Purchase Orders 3505.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(607, 'XAD000347', '2023-02-17', 'Patch Cord 3M SC APC-SC APC', 'Azlan Star Technologies LLC', 'PCS', '4.75', '4.6075', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1750.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(608, 'XAD000347', '2023-09-22', 'Patch Cord 3M SC APC-SC APC', 'Planet Structure Cabling System', 'PCS', '7.3', '7.081', 'Request No : OSP-LMP-22-AAN - 25-07-2023 . Based On Purchase Orders 2876.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(609, 'XAD000347', '2023-12-12', 'Patch Cord 3M SC APC-SC APC', 'The Mark Infotech System Solutions LLC', 'PCS', '7.8', '7.566', 'REQUEST NO 54 OSP LMP Based On Purchase Orders 3631.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(610, 'XAD000347', '2024-01-05', 'Patch Cord 3M SC APC-SC APC', 'Cash', 'PCS', '3.5', '3.395', 'OSP LMP PROJECT PPIGTAIL & PATCHCORD REQUIRED Based On Purchase Orders 3831.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(611, 'XAD000347', '2024-02-08', 'Patch Cord 3M SC APC-SC APC', 'APKR Networking Zone', 'PCS', '3.5', '3.395', 'REQUEST NO : OSP LMP 7 FEB 2024 Based On Purchase Orders 4058.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(612, 'XAD000347', '2024-02-28', 'Patch Cord 3M SC APC-SC APC', 'SKYMAX GENERAL TRADING FZE', 'PCS', '3.75', '3.6375', 'REQUEST NO 56 OSP LMP PROJECT Based On Purchase Orders 3737.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(613, 'XAD000348', '2022-04-09', 'Patch Cord 5M SC-SC', 'Cash', 'PKT', '45', '43.65', 'GRN: 9-04-023 LPO 50/3774 Requested by: Rashid Ahmad Verified By : Sohail Abbas Prepared By : Wahab Aslam Based On Purchase Orders 50.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(614, 'XAD000348', '2022-04-09', 'Patch Cord 5M SC-SC', 'Cash', 'PKT', '20', '19.4', 'GRN: 9-04-023 LPO 50/3774 Requested by: Rashid Ahmad Verified By : Sohail Abbas Prepared By : Wahab Aslam Based On Purchase Orders 50.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(615, 'XAD000349', '2022-09-21', 'Cordless Tightner Drill 18V Stanley', 'Smooth Solution building Materails Trading LLC', 'PCS', '660', '640.2', 'Request No : ADWEA 65 Requested By : Screenth Ck Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 637.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(616, 'XAD000349', '2023-02-14', 'Cordless Tightner Drill 18V Stanley', 'Ali Asghar Hussani', 'PCS', '425', '412.25', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1697.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(617, 'XAD000350', '2023-04-24', 'Cordless Grinder 18V  Makita', 'Smooth Solution building Materails Trading LLC', 'PCS', '1265', '1227.05', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(618, 'XAD000351', '2023-10-02', 'Drill Bit 3mm Steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1', '0.97', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(619, 'XAD000352', '2023-03-07', 'Screw Driver Torque 7 Pcs 10 to 27mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '28', '27.16', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1853.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(620, 'XAD000356', '2022-02-14', 'Nail wood  2.5\'\'', 'Ali Asghar Hussani', 'Box', '18', '17.46', 'GRN   : 14-02-032 Project : L&T Etihad Rail Based On Purchase Orders 94/3573', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(621, 'XAD000356', '2022-09-08', 'Nail wood  2.5\'\'', 'JOGA RAM GENERAL TRADING LLC', 'Box', '35', '33.95', 'Project : DXB Etihad Rail Requested By : Blessan Koshy Verified By : Imran Iqbal Based On Purchase Orders 560.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(622, 'XAD000356', '2024-01-11', 'Nail wood  2.5\'\'', 'MAA ALMADINA BUILDING MATERIAL', 'Box', '55', '53.35', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(623, 'XAD000356', '2024-02-08', 'Nail wood  2.5\'\'', 'Al Moazam Stores LLC', 'Box', '1.38', '1.3386', 'REQUEST NO : AAN-2024-107 Based On Purchase Orders 4053.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(624, 'XAD000360', '2022-03-28', 'Jotun Fenomastic Matt White ( 4 ltr )', 'Ali Asghar Hussani', 'GLN', '105', '101.85', 'GRN :28-03-020 Project :Huawei IBS 5G Based On Purchase Orders:3679', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(625, 'XAD000361', '2022-12-28', 'Bubble Sheet 6K', 'Noor Al Iman', 'Roll', '60', '58.2', 'Based On Purchase Orders 1450.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(626, 'XAD000361', '2023-08-14', 'Bubble Sheet 6K', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '50', '48.5', 'Consumable Quality Material Required For Nokia Project . Based On Purchase Orders 2951.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(627, 'XAD000361', '2024-01-15', 'Bubble Sheet 6K', 'Ali Asghar Hussani', 'Roll', '45', '43.65', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(628, 'XAD000362', '2022-11-19', 'Combination Spanner Set 25 Pcs', 'Ali Asghar Hussani', 'SET', '70', '67.9', 'Based On Purchase Orders 1230.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(629, 'XAD000364', '2023-08-03', 'Wood Cutting Saw', 'Al Moazam Stores LLC', 'PCS', '14.99', '14.5403', 'Request No : AAN-July-23-0066 . Based On Purchase Orders 2788.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(630, 'XAD000365', '2022-01-01', 'Nail wood  2\'\'', 'Ali Asghar Hussani', 'Box', '18', '17.46', 'GRN : 01-02-003 Project: L&T Etihad Rail Based On Purchase Orders: 3513', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(631, 'XAD000365', '2023-01-18', 'Nail wood  2\'\'', 'JOGA RAM GENERAL TRADING LLC', 'Box', '35', '33.95', 'Requested By : AAN-JAN23-004 Based On Purchase Orders 1548.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(632, 'XAD000365', '2023-11-11', 'Nail wood  2\'\'', 'Al Moazam Stores LLC', 'Box', '18', '17.46', 'Request No : AAN-OLT-OCT-23-0094 & 0091 .  Consumable Civil Material Required For AAN-OLT Project Nov-2023 . Based On Purchase Orders 3416.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(633, 'XAD000366', '2022-10-19', 'Spiral 8mm White', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '10.5', '10.185', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(634, 'XAD000366', '2022-12-24', 'Spiral 8mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '13', '12.61', 'Request  No : XAD-HW-DEC-DXB-078 Based On Purchase Orders 1445.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(635, 'XAD000366', '2023-02-16', 'Spiral 8mm White', 'Noor Al Iman', 'PCS', '3.25', '3.1525', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(636, 'XAD000366', '2024-02-28', 'Spiral 8mm White', 'Ali Asghar Hussani', 'PCS', '5.5', '5.335', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(637, 'XAD000368', '2022-03-29', '6U Cabinet 600*450', 'Ali Asghar Hussani', 'PCS', '125', '121.25', 'GRN: 29-03-025 Projects:Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(638, 'XAD000368', '2022-05-19', '6U Cabinet 600*450', 'APKR Networking Zone', 'PCS', '125', '121.25', 'Based On Purchase Orders 130. Nokia OD', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(639, 'XAD000369', '2022-03-05', 'ODF 24 Port ( Patch Pannel )', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'GRN      :28-03-016 Project: Huawei SS IBS Based On Purchase Orders: 3641', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(640, 'XAD000369', '2022-06-28', 'ODF 24 Port ( Patch Pannel )', 'Cash', 'PCS', '30', '29.1', 'Huawei Mobile Project Based On Purchase Orders 238.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(641, 'XAD000369', '2022-12-26', 'ODF 24 Port ( Patch Pannel )', 'APKR Networking Zone', 'PCS', '28', '27.16', 'Request No : XAD-HW-DEC-DXB-079 Based On Purchase Orders 1442.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(642, 'XAD000369', '2023-10-27', 'ODF 24 Port ( Patch Pannel )', 'The Mark Infotech System Solutions LLC', 'PCS', '31', '30.07', 'Request No : XAD-HW-Oct-DCB-0098 - 27-Oct-2023 . Based On Purchase Orders 3365.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(643, 'XAD000370', '2022-03-05', 'ODF 8 Port ( Patch Pannel )', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'GRN      :28-03-016 Project: Huawei SS IBS Based On Purchase Orders: 3641', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(644, 'XAD000370', '2022-07-25', 'ODF 8 Port ( Patch Pannel )', 'Azlan Star Tech', 'PCS', '15', '14.55', 'Nokia Mobile Project Based On Purchase Orders 359.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(645, 'XAD000370', '2023-10-27', 'ODF 8 Port ( Patch Pannel )', 'The Mark Infotech System Solutions LLC', 'PCS', '15', '14.55', 'Request No : XAD-HW-Oct-DCB-0098 - 27-Oct-2023 . Based On Purchase Orders 3365.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(646, 'XAD000370', '2024-01-11', 'ODF 8 Port ( Patch Pannel )', 'APKR Networking Zone', 'PCS', '10', '9.7', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(647, 'XAD000371', '2022-03-08', 'Cable Tie 300*4.8mm White', 'Wenzhou Zhechi', 'PKT', '3.09', '2.9973', 'Material purchase from China for DU SFAN Based On Purchase Orders 355.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(648, 'XAD000371', '2023-03-08', 'Cable Tie 300*4.8mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '7', '6.79', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(649, 'XAD000371', '2023-09-27', 'Cable Tie 300*4.8mm White', 'Cash', 'PKT', '5', '4.85', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(650, 'XAD000371', '2023-10-24', 'Cable Tie 300*4.8mm White', 'Ali Asghar Hussani', 'PKT', '7.5', '7.275', 'Request No : SmartHome-002 - 007 - NE - OCT Based On Purchase Orders 3351.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(651, 'XAD000373', '2023-07-14', 'Wrench 8\'\'', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2719.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(652, 'XAD000374', '2023-01-31', 'First Aid Kit', 'Ali Asghar Hussani', 'PCS', '38', '36.86', 'Request No : XAD-003-004-005-Jan-2023 Based On Purchase Orders 1571.', '2024-10-09 03:56:57', '2024-10-09 03:56:57');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(653, 'XAD000374', '2023-03-08', 'First Aid Kit', 'Noor Al Iman', 'PCS', '20', '19.4', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1848.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(654, 'XAD000374', '2023-12-12', 'First Aid Kit', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '40', '38.8', 'DU CIVIL REQUEST NO 2 Based On Purchase Orders 3622.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(655, 'XAD000375', '2022-02-05', 'Brother Labeling Printer', 'APKR Networking Zone', 'PCS', '210', '203.7', 'GRN : 05 02 010 Project : Nokia OD Based On Purchase Orders 133/3550', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(656, 'XAD000375', '2022-08-11', 'Brother Labeling Printer', 'Azlan Star Tech', 'PCS', '205', '198.85', 'Requested By : Sharafu Tk Based On Purchase Orders 430.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(657, 'XAD000375', '2023-05-03', 'Brother Labeling Printer', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '220', '213.4', 'Request Noi : AUH-OLT-0023 Based On Purchase Orders 2218.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(658, 'XAD000375', '2023-07-04', 'Brother Labeling Printer', 'Ali Asghar Hussani', 'PCS', '210', '203.7', 'Request No : DU SFAN-194 . Based On Purchase Orders 2643.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(659, 'XAD000376', '2023-02-17', 'Silicon Gun', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1688.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(660, 'XAD000376', '2022-11-28', 'Silicon Gun', 'Smooth Solution building Materails Trading LLC', 'PCS', '15', '14.55', 'Requiest No : ADWEA-101-AUH Based On Purchase Orders 1283.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(661, 'XAD000376', '2022-05-25', 'Silicon Gun', 'Noor Al Iman', 'PCS', '15', '14.55', 'Huawei Mobile Project Based On Purchase Orders 145.INV# 0848,0849,850', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(662, 'XAD000377', '2022-04-20', 'Paint Roller', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'GRN :01-02-002 Project: DU SFAN Based On Purchase Orders:3519', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(663, 'XAD000377', '2022-12-24', 'Paint Roller', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '5.5', '5.335', 'Request No : Etihad Rail L&T -03 - DXB Based On Purchase Orders 1412.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(664, 'XAD000378', '2022-03-31', 'Screw Driver T40', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(665, 'XAD000379', '2022-12-27', 'Pocket Size Tester', 'Smooth Solution building Materails Trading LLC', 'PCS', '4', '3.88', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(666, 'XAD000379', '2023-02-14', 'Pocket Size Tester', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1696.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(667, 'XAD000379', '2023-10-02', 'Pocket Size Tester', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '5', '4.85', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(668, 'XAD000379', '2023-12-27', 'Pocket Size Tester', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(669, 'XAD000380', '2023-07-31', 'WallBoard Saw 6\'\'', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(670, 'XAD000382', '2023-12-27', 'Sand paper', 'Ali Asghar Hussani', 'PCS', '1', '0.97', 'Carpentry Tool Request  Smart Home Project Based On Purchase Orders 3723.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(671, 'XAD000384', '2022-02-26', 'Thimble Presser (hydraulic)', 'Noor Al Iman Elect & Hardware TR', 'PCS', '40', '38.8', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(672, 'XAD000384', '2022-11-05', 'Thimble Presser (hydraulic)', 'Ali Asghar Hussani', 'PCS', '115', '111.55', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1081.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(673, 'XAD000385', '2022-11-02', 'Thimble Presser HX 50B', 'Smooth Solution building Materails Trading LLC', 'PCS', '85', '82.45', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1015.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(674, 'XAD000385', '2023-03-27', 'Thimble Presser HX 50B', 'Noor Al Iman', 'PCS', '75', '72.75', 'Request No : XAD-HW-Jan-DXB-093 - 17-03-2023 Based On Purchase Orders 1956.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(675, 'XAD000385', '2023-05-24', 'Thimble Presser HX 50B', 'Ali Asghar Hussani', 'PCS', '100', '97', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2311.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(676, 'XAD000386', '2022-02-09', 'Cable Tie 4.8x400mm White', 'Ali Asghar Hussani', 'PKT', '10', '9.7', 'GRN : -9-02-017 Project: DU SFAN Based On Purchase Orders 105/3568', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(677, 'XAD000386', '2022-02-26', 'Cable Tie 4.8x400mm White', 'Noor Al Iman Elect & Hardware TR', 'PKT', '18', '17.46', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(678, 'XAD000386', '2022-03-08', 'Cable Tie 4.8x400mm White', 'Wenzhou Zhechi', 'PKT', '4.19', '4.0643', 'Material purchase from China for DU SFAN Based On Purchase Orders 355.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(679, 'XAD000387', '2023-02-06', 'Uniform Dress Shirt ( Fire Retardent ) Royal Blue with logo Xad & Etisalat  - M', 'Emporium Gulf', 'PCS', '70', '67.9', 'Request No : Adwea-127-Jan-2023. Based On Purchase Orders 1677.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(680, 'XAD000388', '2023-11-14', 'Uniform Du Shirt M (GSM)', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : XAD-HW-OCT-DXB-098 .  DU Logo Full Sleeve Shirt\'s Required For Huawei Mobile Project. Based On Purchase Orders 3425.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(681, 'XAD000389', '2023-11-14', 'Uniform Du Shirt XL (GSM)', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : XAD-HW-OCT-DXB-098 .  DU Logo Full Sleeve Shirt\'s Required For Huawei Mobile Project. Based On Purchase Orders 3425.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(682, 'XAD000390', '2023-11-14', 'Uniform Du Shirt XXL (GSM)', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : XAD-HW-OCT-DXB-098 .  DU Logo Full Sleeve Shirt\'s Required For Huawei Mobile Project. Based On Purchase Orders 3425.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(683, 'XAD000391', '2023-11-14', 'Uniform Du Shirt XXXL(GSM)', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : XAD-HW-OCT-DXB-098 .  DU Logo Full Sleeve Shirt\'s Required For Huawei Mobile Project. Based On Purchase Orders 3425.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(684, 'XAD000392', '2023-11-14', 'Uniform Du Shirt  S (GSM)', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : XAD-HW-OCT-DXB-098 .  DU Logo Full Sleeve Shirt\'s Required For Huawei Mobile Project. Based On Purchase Orders 3425.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(685, 'XAD000393', '2023-02-17', 'Pigtail 1.5m S/M SC/APC', 'Azlan Star Technologies LLC', 'PCS', '2', '1.94', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1750.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(686, 'XAD000393', '2023-09-22', 'Pigtail 1.5m S/M SC/APC', 'Planet Structure Cabling System', 'PCS', '1.5', '1.455', 'Request No : OSP-LMP-22-AAN - 25-07-2023 . Based On Purchase Orders 2876.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(687, 'XAD000393', '2023-10-27', 'Pigtail 1.5m S/M SC/APC', 'The Mark Infotech System Solutions LLC', 'PCS', '2.2', '2.134', 'Requested By : Muhammad Qaiser Javed  Verified By     : Kamran Shahaeen & Saad Munir Prepared By  : Raja Zeeshan  Request No : XAD-OCT-001-23 . Based On Purchase Orders 3371.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(688, 'XAD000393', '2024-01-05', 'Pigtail 1.5m S/M SC/APC', 'Cash', 'PCS', '1.8', '1.746', 'OSP LMP PROJECT PPIGTAIL & PATCHCORD REQUIRED Based On Purchase Orders 3831.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(689, 'XAD000393', '2024-01-10', 'Pigtail 1.5m S/M SC/APC', 'SKYMAX GENERAL TRADING FZE', 'PCS', '1.5', '1.455', 'REQUEST NO OSP LMP 1-JAN 24 Based On Purchase Orders 3795.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(690, 'XAD000394', '2022-10-19', 'AC Power Cable 5 Core (10mm)', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '19.77', '19.1769', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(691, 'XAD000394', '2023-02-24', 'AC Power Cable 5 Core (10mm)', 'Noor Al Iman', 'MTR', '9', '8.73', 'Request No : XAD-HW-Jan-DXB-085 Based On Purchase Orders 1783.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(692, 'XAD000394', '2024-01-30', 'AC Power Cable 5 Core (10mm)', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '9.2', '8.924', 'REQUEST NO : XAD-HW-JAN-DXB-100 Based On Purchase Orders 3983.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(693, 'XAD000394', '2024-02-28', 'AC Power Cable 5 Core (10mm)', 'Ali Asghar Hussani', 'MTR', '6.75', '6.5475', 'REQUEST NO : XAD-HW-JAN-DXB-100 Based On Purchase Orders 4186.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(694, 'XAD000395', '2022-01-04', 'Flexible Pipe 20mm Black', 'Noor Al Iman Elect & Hardware TR', 'Roll', '15', '14.55', 'GRN : 04-01-08', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(695, 'XAD000395', '2023-05-19', 'Flexible Pipe 20mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '14', '13.58', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(696, 'XAD000395', '2023-11-11', 'Flexible Pipe 20mm Black', 'Ali Asghar Hussani', 'Roll', '11', '10.67', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(697, 'XAD000396', '2022-02-01', 'Flexible Pipe 20mm  White', 'Noor Al Iman', 'Roll', '15', '14.55', 'PO      :01-02-001 Project : Nokia TI Based On Purchase Orders:3509', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(698, 'XAD000396', '2023-03-31', 'Flexible Pipe 20mm  White', 'Smooth Solution building Materails Trading LLC', 'Roll', '13', '12.61', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(699, 'XAD000396', '2023-05-12', 'Flexible Pipe 20mm  White', 'Ali Asghar Hussani', 'Roll', '15', '14.55', 'Requested By : XAD-009 Based On Purchase Orders 2285.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(700, 'XAD000398', '2023-06-17', 'Draw Rope 6mm ppe grey 500 Mtr', 'Cendhurr Telecom LLC', 'Roll', '70', '67.9', 'Request No : AAN-May-23-0044 Based On Purchase Orders 2438.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(701, 'XAD000398', '2023-12-15', 'Draw Rope 6mm ppe grey 500 Mtr', 'Elfit Arabia', 'Roll', '70', '67.9', 'Request No 098 WR 101H Based On Purchase Orders 3654.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(702, 'XAD000398', '2024-03-01', 'Draw Rope 6mm ppe grey 500 Mtr', 'Frontier Innovation General Trading', 'Roll', '64.5', '62.565', 'REQUEST NO : 311  WESTERN REGION. Based On Purchase Orders 4151.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(703, 'XAD000399', '2022-08-12', 'Trunking 16x16', 'Abazar Building Materail LLC Qusais', 'PCS', '5', '4.85', 'Based On Purchase Orders 405.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(704, 'XAD000399', '2022-11-02', 'Trunking 16x16', 'Smooth Solution building Materails Trading LLC', 'PCS', '6', '5.82', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(705, 'XAD000399', '2023-01-23', 'Trunking 16x16', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '4.75', '4.6075', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(706, 'XAD000399', '2023-12-27', 'Trunking 16x16', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4.6', '4.462', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(707, 'XAD000399', '2024-02-15', 'Trunking 16x16', 'Ali Asghar Hussani', 'PCS', '4.25', '4.1225', 'REQUEST NO : SMART HOME-XAD-008-FEB\'24  AUH REGION Based On Purchase Orders 4084.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(708, 'XAD000400', '2023-12-21', 'Heat Shrink Tube 40mm (Sleeve)', 'SKYMAX GENERAL TRADING FZE', 'PCS', '0.1', '0.097', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3400.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(709, 'XAD000400', '2024-01-10', 'Heat Shrink Tube 40mm (Sleeve)', 'APKR Networking Zone', 'PCS', '0.08', '0.0776', 'REQUEST NO OSP LMP 2 JAN 24 Based On Purchase Orders 3844.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(710, 'XAD000400', '2024-02-23', 'Heat Shrink Tube 40mm (Sleeve)', 'SKYMAX GENERAL TRADING FZE', 'PCS', '0.08', '0.0776', 'REQUEST NO : 304 DU SFAN PROJECT DXB REGION Based On Purchase Orders 4159.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(711, 'XAD000401', '2022-01-10', 'Medium Duty Racks Levels 200 * 200 * 60', 'Ali Asghar Hussani', 'SET', '480', '465.6', 'GRN: 10-01-014 Project : DU TCS AUH Based On Purchase Orders.3431', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(712, 'XAD000408', '2023-07-19', 'Double Land Yard', 'Fas Arabia llc', 'PCS', '325', '315.25', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2722.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(713, 'XAD000409', '2024-01-24', 'Position Land Yard', 'Fas Arabia llc', 'PCS', '345', '334.65', 'REQUEST NO HW-JAN-DXB-100 Based On Purchase Orders 3922.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(714, 'XAD000410', '2022-10-17', 'AC Power Cable 3 Core (16mm)', 'Ali Asghar Hussani', 'MTR', '8.33', '8.0801', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 841.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(715, 'XAD000410', '2024-01-15', 'AC Power Cable 3 Core (16mm)', 'Noor Al Iman', 'MTR', '10.32', '10.0104', 'Consumeables Materia For Nokia TI Project Based On Purchase Orders 3860.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(716, 'XAD000411', '2022-05-20', 'AC Power Cable 3 Core 10 mm', 'Ali Asghar Hussani', 'MTR', '6.05', '5.8685', 'Project : Nokia OD Based On Purchase Orders 120.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(717, 'XAD000411', '2022-09-30', 'AC Power Cable 3 Core 10 mm', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '4', '3.88', 'Request No : Sep-DXB-066 Requested By : Muhammad Bilal & Jawad Hussain  Verified By : Sohail Abbas Based On Purchase Orders 672.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(718, 'XAD000411', '2023-02-24', 'AC Power Cable 3 Core 10 mm', 'Noor Al Iman', 'MTR', '6', '5.82', 'Request No : XAD-HW-Jan-DXB-085 Based On Purchase Orders 1783.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(719, 'XAD000411', '2024-01-30', 'AC Power Cable 3 Core 10 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '6.25', '6.0625', 'REQUEST NO : XAD-HW-JAN-DXB-100 Based On Purchase Orders 3983.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(720, 'XAD000412', '2023-06-13', 'Drill Bit 5mm concrete', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '14', '13.58', 'Request No : SmartHome-XAD-0015-06-06-2023 . Based On Purchase Orders 2519.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(721, 'XAD000414', '2023-03-29', 'Plantronics Blackwire C3220 USB-A Duo Headest', 'Future Talent Technologies LLC', 'PCS', '70', '67.9', 'IT Equipment Required For Account Department Based On Purchase Orders 2057.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(722, 'XAD000414', '2023-11-14', 'Plantronics Blackwire C3220 USB-A Duo Headest', 'Cash', 'PCS', '175', '169.75', 'Plantronics Blackwire C3220 USB-A Duo Headest for Sharjah Office Based On Purchase Orders 3516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(723, 'XAD000415', '2022-10-06', 'PVC Pipe 20mm Black', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 627.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(724, 'XAD000415', '2023-04-04', 'PVC Pipe 20mm Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '3', '2.91', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(725, 'XAD000415', '2023-10-04', 'PVC Pipe 20mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3.2', '3.104', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3086.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(726, 'XAD000415', '2024-01-11', 'PVC Pipe 20mm Black', 'Ali Asghar Hussani', 'PCS', '3.75', '3.6375', 'REQUEST NO 287 DU SFAN PROJECT Based On Purchase Orders 3852.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(727, 'XAD000416', '2022-08-04', 'Permanent Marker Black', 'Abazar Building Materail LLC Qusais', 'PCS', '1.5', '1.455', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(728, 'XAD000416', '2022-09-23', 'Permanent Marker Black', 'Azlan Star Technologies LLC', 'PCS', '1.67', '1.6199', 'Request No : Du SFAN Sep 2022 ( 60 ) Requested By : Mufeed KK Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 628.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(729, 'XAD000416', '2023-02-16', 'Permanent Marker Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '1', '0.97', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1672.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(730, 'XAD000416', '2023-02-18', 'Permanent Marker Black', 'M S K Corporate Services Provides EST', 'PCS', '1.25', '1.2125', 'New Tool , Client , Consumble Issuance & Return Book For Xad All Warehouses. Based On Purchase Orders 1761.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(731, 'XAD000416', '2023-04-05', 'Permanent Marker Black', 'Noor Al Iman', 'PCS', '0.83', '0.8051', 'Request No : AAN-March-23-0027 Based On Purchase Orders 2033.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(732, 'XAD000416', '2023-11-06', 'Permanent Marker Black', 'Ali Asghar Hussani', 'PCS', '1.25', '1.2125', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(733, 'XAD000416', '2023-12-27', 'Permanent Marker Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1', '0.97', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(734, 'XAD000419', '2023-05-24', 'ID Card Holder', 'M S K Corporate Services Provides EST', 'PCS', '2.5', '2.425', 'Request No : Adwea-188 Based On Purchase Orders 2353.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(735, 'XAD000421', '2023-01-24', 'Keyboard Wireless', 'Azlan Star Technologies LLC', 'PCS', '185', '179.45', 'Items Required for DXB store Based On Purchase Orders 1636.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(736, 'XAD000421', '2023-03-29', 'Keyboard Wireless', 'Future Talent Technologies LLC', 'PCS', '87', '84.39', 'IT Equipment Required For Account Department Based On Purchase Orders 2057.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(737, 'XAD000421', '2023-06-10', 'Keyboard Wireless', 'Ultra Stream Technologies LLC', 'PCS', '70', '67.9', 'Wireless Keyboard Required For AAN Warehouse . Based On Purchase Orders 2449.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(738, 'XAD000421', '2023-07-29', 'Keyboard Wireless', 'Power Plus Technologies LLC', 'PCS', '75', '72.75', 'Wirless Arabic Keyboard Required For Sadam HR Staff . Based On Purchase Orders 2831.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(739, 'XAD000421', '2023-08-02', 'Keyboard Wireless', 'AL Fajar Computer Trading LLC', 'PCS', '55', '53.35', 'Request No : XAD-AUH-01-01-Aug-2023 . Based On Purchase Orders 2884.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(740, 'XAD000422', '2022-09-11', 'Battery Getup 9V', 'Ola Al Madina SuperMarket', 'PCS', '14.28', '13.8516', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK Verified By     : Anasr Abbas & Sharafu Tk Based On Purchase Orders 629.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(741, 'XAD000422', '2023-11-13', 'Battery Getup 9V', 'Al Jamal Stationery LLC', 'PCS', '33', '32.01', 'Request No : Smarthome-003-Oct-23-AUH Region Based On Purchase Orders 3355.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(742, 'XAD000423', '2022-05-28', 'Rigger Climbing Helmet Yellow', 'Ali Asghar Hussani', 'PCS', '105', '101.85', 'Huawei Mobile Projet Based On Purchase Orders 162.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(743, 'XAD000423', '2023-12-06', 'Rigger Climbing Helmet Yellow', 'Fas Arabia llc', 'PCS', '230', '223.1', 'NOKIA MATERIAL REQUEST Based On Purchase Orders 3577. Based On Goods Receipt PO 1491.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(744, 'XAD000425', '2022-05-05', 'Laptop Bag', 'Comnet International', 'PCS', '12', '11.64', 'Project : Adwea INV# 7335 Based On Purchase Orders 107.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(745, 'XAD000425', '2023-01-20', 'Laptop Bag', 'Azlan Star Technologies LLC', 'PCS', '55', '53.35', 'Based On Purchase Orders 1585.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(746, 'XAD000425', '2023-12-06', 'Laptop Bag', 'The Mark Infotech System Solutions LLC', 'PCS', '25', '24.25', 'NOKIA Spliciling Materials Request Based On Purchase Orders 3576.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(747, 'XAD000427', '2022-05-20', 'AC Power Cable 5 core*16mm Black', 'Ali Asghar Hussani', 'MTR', '12.11', '11.7467', 'Project : Nokia OD Based On Purchase Orders 120.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(748, 'XAD000428', '2022-05-05', 'Wireless  Mouse', 'Comnet International', 'PCS', '15', '14.55', 'Project : Adwea INV# 7335 Based On Purchase Orders 107.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(749, 'XAD000428', '2022-08-24', 'Wireless  Mouse', 'Al Ravisha Computers Trading LLC', 'PCS', '28.57', '27.7129', 'IT Deparment Mr Raziq Based On Purchase Orders 532.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(750, 'XAD000428', '2022-11-02', 'Wireless  Mouse', 'The Mark Infotech System Solutions LLC', 'PCS', '28', '27.16', 'New Mouse M170 For Xad Common Internally Staff. Based On Purchase Orders 735.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(751, 'XAD000428', '2023-03-29', 'Wireless  Mouse', 'Future Talent Technologies LLC', 'PCS', '60', '58.2', 'IT Equipment Required For Account Department Based On Purchase Orders 2057.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(752, 'XAD000428', '2023-06-10', 'Wireless  Mouse', 'Ultra Stream Technologies LLC', 'PCS', '33', '32.01', 'Request No : DU SFAN-183  Laptop Required For OutSource Staff ( Mohammad Umer & Abdullah ) . Laptop Battery Required For Dell Latitude E5570 & Hp Pavilon AC 153NE . Mouse Required For Backoffice Staff . Based On Purchase Orders 2434.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(753, 'XAD000429', '2022-12-06', 'Laptop Battery', 'Azlan Star Technologies LLC', 'PCS', '210', '203.7', 'New Laptop Battery For Admin Staff Raja Zeeshan Laptop\'s. Based On Purchase Orders 1387.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(754, 'XAD000429', '2023-04-19', 'Laptop Battery', 'The Mark Infotech System Solutions LLC', 'PCS', '210', '203.7', 'Need to replace battery laptop thinkpad For Huawei Project .. Based On Purchase Orders 2164.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(755, 'XAD000429', '2023-06-10', 'Laptop Battery', 'Ultra Stream Technologies LLC', 'PCS', '120', '116.4', 'Request No : DU SFAN-183  Laptop Required For OutSource Staff ( Mohammad Umer & Abdullah ) . Laptop Battery Required For Dell Latitude E5570 & Hp Pavilon AC 153NE . Mouse Required For Backoffice Staff . Based On Purchase Orders 2434.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(756, 'XAD000429', '2023-10-16', 'Laptop Battery', 'Power Plus Technologies LLC', 'PCS', '150', '145.5', 'Request No : DU TCS-09-Oct-2023 . Dell Latitude E7440 Laptop Battery Required For David Tayong Technician DU TCS Project . Based On Purchase Orders 3321.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(757, 'XAD000429', '2023-12-09', 'Laptop Battery', 'AL Taqa Momtaza Technology LLC', 'PCS', '55', '53.35', 'Request No : 278 Based On Purchase Orders 3603.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(758, 'XAD000430', '2022-03-31', 'Laptop Charger Cable 3 pin', 'MSK Corporate Services', 'PCS', '3', '2.91', 'GRN : 31-03-032 Project : Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(759, 'XAD000430', '2023-02-20', 'Laptop Charger Cable 3 pin', 'Azlan Star Technologies LLC', 'PCS', '3', '2.91', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(760, 'XAD000430', '2023-04-04', 'Laptop Charger Cable 3 pin', 'AL Taqa Momtaza Technology LLC', 'PCS', '2', '1.94', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 2051.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(761, 'XAD000430', '2023-12-06', 'Laptop Charger Cable 3 pin', 'The Mark Infotech System Solutions LLC', 'PCS', '7', '6.79', 'NOKIA Spliciling Materials Request Based On Purchase Orders 3576.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(762, 'XAD000431', '2023-04-04', 'Laptop Charger', 'AL Taqa Momtaza Technology LLC', 'PCS', '13', '12.61', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 2051.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(763, 'XAD000431', '2023-07-12', 'Laptop Charger', 'The Mark Infotech System Solutions LLC', 'PCS', '28', '27.16', 'Request No : DU SFAN - 194 . Based On Purchase Orders 2711.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(764, 'XAD000432', '2022-04-11', 'Flexible Pipe 25mm Black', 'Noor Al Iman', 'Roll', '35', '33.95', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(765, 'XAD000432', '2022-08-12', 'Flexible Pipe 25mm Black', 'Smooth Solution building Materails Trading LLC', 'Roll', '45', '43.65', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(766, 'XAD000432', '2023-11-11', 'Flexible Pipe 25mm Black', 'Ali Asghar Hussani', 'Roll', '12', '11.64', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(767, 'XAD000434', '2023-08-18', 'Universal Serial Bus', 'MAQSOOD & ABDUL HAFEEZ COMPUTERS TRADING LLC', 'PCS', '14.29', '13.8613', 'New SSD & USB Required For Backup Purpose IT Department . Based On Purchase Orders 3028.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(768, 'XAD000434', '2023-11-13', 'Universal Serial Bus', 'The Mark Infotech System Solutions LLC', 'PCS', '13', '12.61', 'Request Number 267 DU SFAN November-2023 Based On Purchase Orders 3461.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(769, 'XAD000435', '2022-01-18', 'USB- Lan Adapter 3.0 1000m', 'Future City Computers', 'PCS', '15', '14.55', 'GRN :18-01-033 Project: Common  for Sufian Shoukat Based On Purchase Orders:3455', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(770, 'XAD000435', '2022-11-02', 'USB- Lan Adapter 3.0 1000m', 'The Mark Infotech System Solutions LLC', 'PCS', '22', '21.34', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1018.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(771, 'XAD000436', '2022-06-03', 'Roller - Climbing Carriage', 'Fas Arabia llc', 'PCS', '1400', '1358', 'Bahrain Project Based On Purchase Orders 183.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(772, 'XAD000436', '2022-11-28', 'Roller - Climbing Carriage', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1290.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(773, 'XAD000437', '2023-05-04', 'Single Cleaver Fujikura ( CT - 08 )', 'MITTCO Llc', 'PCS', '1505', '1459.85', 'Request No : DU SFAN-161-10-4-2023 . Based On Purchase Orders 2118.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(774, 'XAD000438', '2023-12-06', 'LASER DISTANCE METER MICRO LM100  (RIDGID BRAND)', 'Ali Asghar Hussani', 'PCS', '120', '116.4', 'NOKIA MATERIAL REQUEST Based On Purchase Orders 3578.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(775, 'XAD000442', '2022-06-17', 'MULTI METER DT4252 HIOKI', 'Ali Asghar Hussani', 'PCS', '480', '465.6', 'Nokia Based On Purchase Orders 205.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(776, 'XAD000442', '2023-07-15', 'MULTI METER DT4252 HIOKI', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '225', '218.25', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2718.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(777, 'XAD000444', '2023-11-06', 'PUNCHING TOOL (0 TO 9) 6MM 1/4\"', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'Request No : Nokia-OCT-2023 . Based On Purchase Orders 3447.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(778, 'XAD000445', '2023-07-14', 'PUNCHING TOOL (A TO Z) 6MM 1/4\"', 'Ali Asghar Hussani', 'PCS', '55', '53.35', 'Request No : XAD-KSA-HW-MN-11 Based On Purchase Orders 2719.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(779, 'XAD000448', '2023-01-30', 'Uniform T shirt with Du Logo-M', 'Cash', 'PCS', '22', '21.34', 'Based On Purchase Orders 1604.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(780, 'XAD000448', '2023-12-21', 'Uniform T shirt with Du Logo-M', 'Emporium Gulf', 'PCS', '23', '22.31', 'DU Civil Work Request No : 2 Based On Purchase Orders 3621.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(781, 'XAD000448', '2024-02-19', 'Uniform T shirt with Du Logo-M', 'Sahara Garments Embroidery', 'PCS', '18', '17.46', 'REQUEST NO : 298 Based On Purchase Orders 4062.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(782, 'XAD000449', '2022-03-31', 'SOCKET SET 24 PCS 1/2\"', 'Ali Asghar Hussani', 'PCS', '120', '116.4', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(783, 'XAD000449', '2022-05-26', 'SOCKET SET 24 PCS 1/2\"', 'Noor Al Iman', 'PCS', '120', '116.4', 'ADWEA Based On Purchase Orders 171.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(784, 'XAD000449', '2022-05-28', 'SOCKET SET 24 PCS 1/2\"', 'Ali Asghar Hussani', 'PCS', '120', '116.4', 'Huawei Mobile Project Based On Purchase Orders 144. INV#7837', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(785, 'XAD000449', '2023-04-12', 'SOCKET SET 24 PCS 1/2\"', 'Smooth Solution building Materails Trading LLC', 'PCS', '125', '121.25', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(786, 'XAD000450', '2023-07-12', 'Pulling Rod 14 x 300', 'Elfit Arabia', 'PCS', '3160', '3065.2', 'Based On Purchase Orders 2706.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(787, 'XAD000451', '2023-11-25', 'Tool Box Steel', 'Ali Asghar Hussani', 'PCS', '50', '48.5', 'Consumable & Tools Required For Nokia MN Project Nov-2023 Based On Purchase Orders 3518.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(788, 'XAD000452', '2023-12-20', 'Dymo - Metal Embossing  ( Labeling Machine )', 'Ali Asghar Hussani', 'PCS', '1380', '1338.6', 'REQUEST NO 283  DU SFAN PROJECT Based On Purchase Orders 3664.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(789, 'XAD000453', '2024-02-28', 'Dymo -Metal Cartrridge 12mm', 'Ali Asghar Hussani', 'PCS', '41.5', '40.255', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(790, 'XAD000454', '2022-06-03', 'WEBBING SLING', 'Fas Arabia llc', 'PCS', '36', '34.92', 'Bahrain Project Based On Purchase Orders 183.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(791, 'XAD000455', '2022-02-10', 'Cable tray channel 40x20 ( C Channel )', 'Noor Al Iman', 'PCS', '15', '14.55', 'GRN : 10-02-025 Project:DU SFAN WR Based On Purchase Orders:3579.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(792, 'XAD000455', '2023-04-20', 'Cable tray channel 40x20 ( C Channel )', 'Ali Asghar Hussani', 'PCS', '10.5', '10.185', 'Request No : DU SFAN-161-10-03-2023 Based On Purchase Orders 2126.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(793, 'XAD000455', '2023-06-22', 'Cable tray channel 40x20 ( C Channel )', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '10.25', '9.9425', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2476.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(794, 'XAD000456', '2022-06-17', 'Steel Cutter Dewalt', 'Ali Asghar Hussani', 'PCS', '585', '567.45', 'AUH OLT Based On Purchase Orders 201.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(795, 'XAD000457', '2022-02-10', 'Spring Nut 6mm for Cable Tray', 'Noor Al Iman', 'PCS', '0.3', '0.291', 'GRN : 10-02-025 Project:DU SFAN WR Based On Purchase Orders:3579.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(796, 'XAD000457', '2023-05-19', 'Spring Nut 6mm for Cable Tray', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.27', '0.2619', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(797, 'XAD000457', '2023-11-22', 'Spring Nut 6mm for Cable Tray', 'Ali Asghar Hussani', 'PCS', '0.3', '0.291', 'Request No  : Huawei Mobile Project, XAD -HW -May - DXB-098 Based On Purchase Orders 3505.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(798, 'XAD000458', '2022-05-28', 'Rigger PPE Bag', 'Ali Asghar Hussani', 'PCS', '143', '138.71', 'Huawei Mobile Projet Based On Purchase Orders 162.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(799, 'XAD000458', '2022-06-03', 'Rigger PPE Bag', 'Fas Arabia llc', 'PCS', '155', '150.35', 'Bahrain Project Based On Purchase Orders 183.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(800, 'XAD000460', '2022-02-26', 'Channel Cutter 10\"', 'Noor Al Iman Elect & Hardware TR', 'PCS', '30', '29.1', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(801, 'XAD000460', '2023-05-19', 'Channel Cutter 10\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '23.5', '22.795', 'Request No : DU SFAN - 161 Based On Purchase Orders 2356.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(802, 'XAD000464', '2023-05-18', 'Grinder Machine 4.5\"  Stanley', 'Ali Asghar Hussani', 'PCS', '2', '1.94', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2306. Based On Goods Receipt PO 948.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(803, 'XAD000464', '2024-01-19', 'Grinder Machine 4.5\"  Stanley', 'Securintec Information Technology LLC', 'PCS', '160', '155.2', 'Based On Purchase Orders 1994.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(804, 'XAD000465', '2023-12-13', 'Measuring Wheel MT-0180', 'Ali Asghar Hussani', 'PCS', '100', '97', 'REQUEST NO 2 Based On Purchase Orders 3623.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(805, 'XAD000467', '2024-01-19', 'Heat Gun Tolsen', 'Securintec Information Technology LLC', 'PCS', '80', '77.6', 'Based On Purchase Orders 1994.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(806, 'XAD000468', '2022-08-04', 'Trolly 150 Kg', 'Abazar Building Materail LLC Qusais', 'PCS', '140', '135.8', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(807, 'XAD000468', '2023-08-03', 'Trolly 150 Kg', 'Dinesh Aidasani General Trading LLC', 'PCS', '150', '145.5', 'Trolley Required For Head Office Opal Tower . Based On Purchase Orders 2900.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(808, 'XAD000470', '2024-01-24', 'Rope 18mm * 100M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1050', '1018.5', 'REQUEST NO HUAWEI JAN-DXB-100 Based On Purchase Orders 3930.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(809, 'XAD000474', '2023-02-03', 'Tie Cutter', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Based On Purchase Orders 1578.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(810, 'XAD000474', '2023-02-15', 'Tie Cutter', 'Noor Al Iman', 'PCS', '12', '11.64', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(811, 'XAD000474', '2024-01-13', 'Tie Cutter', 'Smooth Solution building Materails Trading LLC', 'PCS', '30', '29.1', 'DC Cable For DU SFAN Project Based On Purchase Orders 3669.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(812, 'XAD000475', '2022-11-16', 'Wrench 6\'\'', 'Noor Al Iman', 'PCS', '12', '11.64', 'Huawei Based On Purchase Orders 1231.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(813, 'XAD000476', '2023-06-14', 'XAD Safety Banner', 'Ali Asghar Hussani', 'PCS', '60', '58.2', 'Request No : Nokia - 01 - 23-05-2023 Based On Purchase Orders 2461.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(814, 'XAD000476', '2023-07-17', 'XAD Safety Banner', 'M S K Corporate Services Provides EST', 'PCS', '38', '36.86', 'Request No : XAD-HW-July-DXB-111-108 . Based On Purchase Orders 2749.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(815, 'XAD000477', '2022-03-31', 'Rigger CLIMBING HELMET BLUE', 'Ali Asghar Hussani', 'PCS', '105', '101.85', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(816, 'XAD000478', '2022-03-31', 'Screw Driver T25', 'Ali Asghar Hussani', 'PCS', '16', '15.52', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(817, 'XAD000478', '2023-12-09', 'Screw Driver T25', 'Noor Al Iman', 'PCS', '15', '14.55', 'Consumables and Tools required by Nokia MN Project for month of Nov-23 Based On Purchase Orders 3521.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(818, 'XAD000479', '2022-03-05', 'Cordless JigSaw Machine 18V Makita', 'Ali Asghar Hussani', 'PCS', '1880', '1823.6', 'PO-3619-Du SFAN Based On Purchase Orders 6. GRN-03-03-004', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(819, 'XAD000483', '2022-08-12', 'Spiral 4mm White', 'Smooth Solution building Materails Trading LLC', 'PKT', '3', '2.91', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(820, 'XAD000483', '2022-12-19', 'Spiral 4mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '7', '6.79', 'Request no : DU SFAN-88-Dec Based On Purchase Orders 1403.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(821, 'XAD000483', '2024-02-28', 'Spiral 4mm White', 'Ali Asghar Hussani', 'PKT', '3', '2.91', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(822, 'XAD000484', '2022-12-19', 'Aluminium Ladder 16 Step', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '340', '329.8', 'Request no : DU SFAN-88-Dec Based On Purchase Orders 1403.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(823, 'XAD000484', '2023-03-07', 'Aluminium Ladder 16 Step', 'Securintec Information Technology LLC', 'PCS', '170', '164.9', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(824, 'XAD000484', '2023-12-27', 'Aluminium Ladder 16 Step', 'Ali Asghar Hussani', 'PCS', '255', '247.35', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(825, 'XAD000485', '2022-06-24', 'Steel Cutter makita', 'Ali Asghar Hussani', 'PCS', '1100', '1067', 'Adwea Based On Purchase Orders 240.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(826, 'XAD000489', '2023-01-23', 'Velcro Tape 25mm x 25 M', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '99.5', '96.515', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(827, 'XAD000489', '2023-02-03', 'Velcro Tape 25mm x 25 M', 'Ali Asghar Hussani', 'Roll', '45', '43.65', 'Based On Purchase Orders 1639.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(828, 'XAD000492', '2022-10-17', 'Brother PT-D600VP Desktop Labelling Machine', 'APKR Networking Zone', 'PCS', '630', '611.1', 'Requet No : DU SFAN-Sep 2022 (66 ) Requested By : Ahmad Iqbal  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 737.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(829, 'XAD000492', '2023-04-05', 'Brother PT-D600VP Desktop Labelling Machine', 'Azlan Star Technologies LLC', 'PCS', '620', '601.4', 'Requested By : Mufeed KK Verified By : Badi Ur Rehman & Sharafu Thayyil  Prepared By : Raja Zeeshan  Request No : DU SFAN-142-143-22&25-03-2023 . Based On Purchase Orders 2025.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(830, 'XAD000492', '2023-07-19', 'Brother PT-D600VP Desktop Labelling Machine', 'Smooth Solution building Materails Trading LLC', 'PCS', '620', '601.4', 'Request No : DU SFAN-194 . Based On Purchase Orders 2642.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(831, 'XAD000492', '2024-02-28', 'Brother PT-D600VP Desktop Labelling Machine', 'Ali Asghar Hussani', 'PCS', '600', '582', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(832, 'XAD000493', '2023-12-27', 'Cable Cutter 10\"', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'REQUEST NO 0066 AUH OLT PROJECT Based On Purchase Orders 3709.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(833, 'XAD000495', '2023-01-31', 'Extension Lead 50M', 'Ali Asghar Hussani', 'PCS', '110', '106.7', 'Request No : XAD-003-004-005-Jan-2023 Based On Purchase Orders 1571.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(834, 'XAD000495', '2023-04-26', 'Extension Lead 50M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '280', '271.6', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2011.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(835, 'XAD000495', '2023-08-22', 'Extension Lead 50M', 'Ali Asghar Hussani', 'PCS', '105', '101.85', 'Request No : OSP-LMP--UAE - NE Region .  Tool Required For NE Region Existing Team OSP-LMP Project . Based On Purchase Orders 3034.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(836, 'XAD000497', '2022-10-06', 'CAUTION BOARD (Man At Work)', 'Noor Al Iman', 'PCS', '25', '24.25', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 627.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(837, 'XAD000497', '2022-11-02', 'CAUTION BOARD (Man At Work)', 'Smooth Solution building Materails Trading LLC', 'PCS', '25', '24.25', 'Request No : SmartHome Xad-001  Requested By : Bashir Subhani Based On Purchase Orders 996.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(838, 'XAD000497', '2023-02-03', 'CAUTION BOARD (Man At Work)', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Request No : Adwea-113-Jan-2023. Based On Purchase Orders 1637.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(839, 'XAD000497', '2023-12-12', 'CAUTION BOARD (Man At Work)', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '22', '21.34', 'DU CIVIL REQUEST NO 2 Based On Purchase Orders 3622.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(840, 'XAD000501', '2023-12-16', 'Combination Spanner 20mm', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(841, 'XAD000503', '2023-02-14', 'Combination Spanner Set 7 Pcs', 'Ali Asghar Hussani', 'SET', '155', '150.35', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1697.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(842, 'XAD000504', '2022-05-30', 'Spanner Set 9 Pcs', 'Noor Al Iman', 'SET', '90', '87.3', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(843, 'XAD000504', '2022-12-27', 'Spanner Set 9 Pcs', 'Smooth Solution building Materails Trading LLC', 'SET', '70', '67.9', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(844, 'XAD000504', '2023-02-03', 'Spanner Set 9 Pcs', 'Ali Asghar Hussani', 'SET', '160', '155.2', 'Request No : Adwea-113-Jan-2023. Based On Purchase Orders 1637.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(845, 'XAD000504', '2023-03-08', 'Spanner Set 9 Pcs', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'SET', '65', '63.05', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1847.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(846, 'XAD000505', '2022-06-17', 'Nail wood  3\'\'', 'Ali Asghar Hussani', 'Box', '20', '19.4', 'Etihad Rail Based On Purchase Orders 212.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(847, 'XAD000505', '2022-07-15', 'Nail wood  3\'\'', 'Noor Al Iman', 'Box', '22', '21.34', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(848, 'XAD000506', '2022-07-04', 'Drill Bit 10mm steel', 'Noor Al Iman', 'PCS', '10', '9.7', 'Du Sfan Based On Purchase Orders 273.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(849, 'XAD000506', '2023-01-26', 'Drill Bit 10mm steel', 'Ali Asghar Hussani', 'PCS', '6.7', '6.499', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(850, 'XAD000506', '2023-03-08', 'Drill Bit 10mm steel', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(851, 'XAD000506', '2023-04-03', 'Drill Bit 10mm steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '8', '7.76', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(852, 'XAD000507', '2022-06-16', 'Drill Bit 14mm concrete', 'Noor Al Iman', 'PCS', '8', '7.76', 'ADWEA Based On Purchase Orders 210.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(853, 'XAD000507', '2023-01-26', 'Drill Bit 14mm concrete', 'Ali Asghar Hussani', 'PCS', '9.3', '9.021', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(854, 'XAD000507', '2023-03-08', 'Drill Bit 14mm concrete', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(855, 'XAD000507', '2023-04-03', 'Drill Bit 14mm concrete', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '8.5', '8.245', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(856, 'XAD000507', '2023-07-17', 'Drill Bit 14mm concrete', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(857, 'XAD000508', '2022-06-16', 'Drill Bit 16mm concrete', 'Noor Al Iman', 'PCS', '10', '9.7', 'ADWEA Based On Purchase Orders 210.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(858, 'XAD000508', '2023-05-19', 'Drill Bit 16mm concrete', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '12', '11.64', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(859, 'XAD000508', '2023-07-14', 'Drill Bit 16mm concrete', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Requested By : Saad Rehman & Rizwan Ali Verified By     : Fiaz Ul Amin Prepared By  : Raja Zeeshan  Request No : XAD-0025-05-07-2023  Consumable Quality & Tool Required For NE Region SmartHome Project . Based On Purchase Orders 2699.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(860, 'XAD000510', '2022-07-04', 'Drill Bit 8mm Steel', 'Noor Al Iman', 'PCS', '8', '7.76', 'Du Sfan Based On Purchase Orders 273.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(861, 'XAD000510', '2023-01-26', 'Drill Bit 8mm Steel', 'Ali Asghar Hussani', 'PCS', '5.5', '5.335', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(862, 'XAD000510', '2023-03-08', 'Drill Bit 8mm Steel', 'Smooth Solution building Materails Trading LLC', 'PCS', '6', '5.82', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(863, 'XAD000510', '2023-10-02', 'Drill Bit 8mm Steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '6', '5.82', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(864, 'XAD000511', '2023-04-28', 'DRILL CHUCK WITH ADAPTER 13MM', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '25', '24.25', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(865, 'XAD000511', '2023-10-24', 'DRILL CHUCK WITH ADAPTER 13MM', 'Ali Asghar Hussani', 'PCS', '13', '12.61', 'Request No : SmartHome-Xad-006-Oct-AUH Based On Purchase Orders 3352.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(866, 'XAD000512', '2023-04-04', 'Extension Lead 5M', 'OSIA Hypermarket', 'PCS', '14.99', '14.5403', 'Extension Lead & Measuring Tape Required For Sikandar Museum . Based On Purchase Orders 2208.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(867, 'XAD000513', '2022-07-06', 'Uniform T shirt with Du Logo-L', 'Emporium Gulf', 'PCS', '22', '21.34', 'Du SFAN Based On Purchase Orders 297.', '2024-10-09 03:56:57', '2024-10-09 03:56:57');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(868, 'XAD000514', '2022-02-26', 'Cutting Disk 4.5\"', 'Noor Al Iman Elect & Hardware TR', 'PCS', '2.5', '2.425', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(869, 'XAD000514', '2022-08-23', 'Cutting Disk 4.5\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4.5', '4.365', 'Project : DU SFAN Requested By : Mufeed KK  Verified By : Ansar Abbas & Sharafu TK Based On Purchase Orders 504.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(870, 'XAD000514', '2023-04-04', 'Cutting Disk 4.5\"', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.3', '2.231', 'Request No : DU SFAN-143-25-03-2023 . Based On Purchase Orders 2018.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(871, 'XAD000514', '2023-12-27', 'Cutting Disk 4.5\"', 'Ali Asghar Hussani', 'PCS', '2', '1.94', 'Carpentry Tool Request  Smart Home Project Based On Purchase Orders 3723.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(872, 'XAD000515', '2022-09-16', 'PVC D-56 Coupler', 'Frontier Innovation General Trading', 'PCS', '4.5', '4.365', 'Request no : AAN Sep-001 JRC Etisalat Standard For AAN OLT Based On Purchase Orders 624.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(873, 'XAD000515', '2023-12-20', 'PVC D-56 Coupler', 'Power Plastic Factory LLC', 'PCS', '2.5', '2.425', 'Request No : AAN-DEC-23-099 Based On Purchase Orders 3649.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(874, 'XAD000516', '2022-10-06', 'JigSaw Blade B22', 'Noor Al Iman', 'PCS', '6', '5.82', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 627.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(875, 'XAD000516', '2022-11-17', 'JigSaw Blade B22', 'Al Moazam Stores LLC', 'PCS', '4', '3.88', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1131.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(876, 'XAD000516', '2023-04-20', 'JigSaw Blade B22', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'Request No : DU SFAN-161-10-03-2023 Based On Purchase Orders 2126.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(877, 'XAD000516', '2023-05-19', 'JigSaw Blade B22', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3.5', '3.395', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(878, 'XAD000517', '2022-07-21', 'I Lugs 16mm steel', 'Noor Al Iman', 'PKT', '50', '48.5', 'Nokia Mobile  Project Based On Purchase Orders 352.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(879, 'XAD000517', '2022-09-14', 'I Lugs 16mm steel', 'Wenzhou Zhechi', 'PKT', '22.32', '21.6504', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(880, 'XAD000519', '2022-09-14', 'I Lugs 35mm steel', 'Wenzhou Zhechi', 'PKT', '44.06', '42.7382', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(881, 'XAD000519', '2022-11-08', 'I Lugs 35mm steel', 'Noor Al Iman', 'PKT', '100', '97', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(882, 'XAD000519', '2023-04-04', 'I Lugs 35mm steel', 'Smooth Solution building Materails Trading LLC', 'PKT', '1.7', '1.649', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(883, 'XAD000520', '2022-05-25', 'I Lugs 50mm steel', 'Noor Al Iman', 'PKT', '2.5', '2.425', 'Huawei Mobile Project Based On Purchase Orders 145. INV# 0848,0849,850', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(884, 'XAD000520', '2022-09-14', 'I Lugs 50mm steel', 'Wenzhou Zhechi', 'PKT', '39.48', '38.2956', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(885, 'XAD000521', '2022-02-10', 'Silicone Fire rated white', 'Noor Al Iman', 'PCS', '28', '27.16', 'GRN : 10-02-025 Project:DU SFAN WR Based On Purchase Orders:3579.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(886, 'XAD000521', '2023-11-06', 'Silicone Fire rated white', 'Ali Asghar Hussani', 'PCS', '13', '12.61', 'Request No : Nokia-OCT-2023 . Based On Purchase Orders 3447.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(887, 'XAD000522', '2023-01-23', 'PVC Insulation Tape 3/4\'\' Mix Color', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '0.92', '0.8924', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(888, 'XAD000522', '2023-03-21', 'PVC Insulation Tape 3/4\'\' Mix Color', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1', '0.97', 'Based On Purchase Orders 1913.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(889, 'XAD000522', '2023-12-09', 'PVC Insulation Tape 3/4\'\' Mix Color', 'Noor Al Iman', 'PCS', '0.9', '0.873', 'Consumables and Tools required by Nokia MN Project for month of Nov-23 Based On Purchase Orders 3521.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(890, 'XAD000522', '2024-01-15', 'PVC Insulation Tape 3/4\'\' Mix Color', 'Ali Asghar Hussani', 'PCS', '1', '0.97', 'Consumeables Materials For NOKIA OD Project Based On Purchase Orders 3859.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(891, 'XAD000525', '2022-04-11', 'Silicon Fire Rated Red', 'Noor Al Iman', 'PCS', '28', '27.16', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(892, 'XAD000526', '2023-12-07', 'Cable Tray Jointer', 'Smooth Solution building Materails Trading LLC', 'PCS', '3', '2.91', 'Request Number 267 DU SFAN November-2023 Based On Purchase Orders 3460.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(893, 'XAD000528', '2022-08-31', 'Patch Cord 20M LC-LC UPC Duplex', 'Dawnergy Technologies Shanghai Co LTD', 'PCS', '15', '14.55', 'Patch Cord Order From China For Xad All Projects Based On Purchase Orders 565.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(894, 'XAD000528', '2022-12-29', 'Patch Cord 20M LC-LC UPC Duplex', 'Azlan Star Technologies LLC', 'PCS', '28', '27.16', 'Based On Purchase Orders 1451.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(895, 'XAD000528', '2023-05-10', 'Patch Cord 20M LC-LC UPC Duplex', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '12.5', '12.125', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2268.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(896, 'XAD000528', '2024-01-11', 'Patch Cord 20M LC-LC UPC Duplex', 'APKR Networking Zone', 'PCS', '25', '24.25', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(897, 'XAD000529', '2022-12-29', 'Patch Cord 30M LC-LC', 'Azlan Star Technologies LLC', 'PCS', '34', '32.98', 'Based On Purchase Orders 1451.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(898, 'XAD000529', '2023-05-10', 'Patch Cord 30M LC-LC', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '18', '17.46', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2268.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(899, 'XAD000529', '2024-01-11', 'Patch Cord 30M LC-LC', 'APKR Networking Zone', 'PCS', '32', '31.04', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(900, 'XAD000530', '2022-06-22', 'Gypsum Compound', 'Ali Asghar Hussani', 'KG', '45', '43.65', 'Huawei Mobile Project Based On Purchase Orders 239.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(901, 'XAD000530', '2022-08-04', 'Gypsum Compound', 'Abazar Building Materail LLC Qusais', 'KG', '3.75', '3.6375', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(902, 'XAD000530', '2022-11-08', 'Gypsum Compound', 'MAA ALMADINA BUILDING MATERIAL', 'KG', '26', '25.22', 'Request No : AAN-101H-OCT-009  Requested By ; Sufian Shaukat  Verified By     : SHamas Tabraiz & Imran Iqbal Based On Purchase Orders 994.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(903, 'XAD000530', '2022-11-17', 'Gypsum Compound', 'Al Moazam Stores LLC', 'KG', '38.1', '36.957', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1131.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(904, 'XAD000530', '2023-04-03', 'Gypsum Compound', 'Ali Asghar Hussani', 'KG', '15', '14.55', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(905, 'XAD000532', '2022-02-10', 'Roofing Bolt 6x25 with nut & Washer', 'Noor Al Iman', 'PCS', '0.2', '0.194', 'GRN : 10-02-025 Project:DU SFAN WR Based On Purchase Orders:3579.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(906, 'XAD000532', '2023-09-09', 'Roofing Bolt 6x25 with nut & Washer', 'Ali Asghar Hussani', 'PCS', '0.08', '0.0776', 'Request No : DU SFAN - 245 - 06-09-2023 . Based On Purchase Orders 3119. Based On Goods Receipt PO 1293.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(907, 'XAD000533', '2022-10-19', 'GI Conduit Pipe 32mm', 'JOGA RAM GENERAL TRADING LLC', 'Box', '48', '46.56', 'Request No : Sep DXB 067 Request By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 704.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(908, 'XAD000533', '2023-02-16', 'GI Conduit Pipe 32mm', 'Noor Al Iman', 'Box', '50', '48.5', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(909, 'XAD000533', '2023-11-22', 'GI Conduit Pipe 32mm', 'Ali Asghar Hussani', 'Box', '38', '36.86', 'Request No  : Huawei Mobile Project, XAD -HW -May - DXB-098 Based On Purchase Orders 3505.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(910, 'XAD000534', '2022-06-16', 'GI Trunking 50 x 50', 'Noor Al Iman', 'PCS', '15', '14.55', 'Nokia Mobile Project Based On Purchase Orders 195.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(911, 'XAD000534', '2022-08-12', 'GI Trunking 50 x 50', 'Abazar Building Materail LLC Qusais', 'PCS', '17', '16.49', 'Based On Purchase Orders 405.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(912, 'XAD000534', '2023-05-18', 'GI Trunking 50 x 50', 'Ali Asghar Hussani', 'PCS', '16', '15.52', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2335.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(913, 'XAD000535', '2023-05-24', 'Ratchet Screw driver 14 in1 (Tolsen)', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2311.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(914, 'XAD000536', '2023-05-19', 'GI Nut 6mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.03', '0.0291', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(915, 'XAD000537', '2022-08-29', 'Cable Ladder 3M With Support', 'Noor Al Iman', 'PCS', '165', '160.05', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(916, 'XAD000537', '2022-09-30', 'Cable Ladder 3M With Support', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '87', '84.39', 'Request No : Sep-DXB-066 Requested By : Muhammad Bilal & Jawad Hussain  Verified By : Sohail Abbas Based On Purchase Orders 672.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(917, 'XAD000539', '2022-03-29', 'Power DB with Complete Fitting ( Mini )', 'Noor Al Iman Elect & Hardware TR', 'PCS', '385', '373.45', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(918, 'XAD000540', '2023-04-26', 'Watch Screw Driver 6Pcs', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'SET', '58.13', '56.3861', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2011.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(919, 'XAD000541', '2022-03-29', 'MCB Breaker 63A 4pole', 'Noor Al Iman Elect & Hardware TR', 'PCS', '85', '82.45', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(920, 'XAD000542', '2022-10-17', 'ELCB Breaker 40A 4pole', 'Ali Asghar Hussani', 'PCS', '80', '77.6', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 841.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(921, 'XAD000542', '2023-11-27', 'ELCB Breaker 40A 4pole', 'Noor Al Iman', 'PCS', '105', '101.85', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(922, 'XAD000544', '2023-05-16', 'Washer 6mm GI', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.04', '0.0388', 'Request No : XAD-HW-May-DXB-100 Based On Purchase Orders 2340.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(923, 'XAD000544', '2023-05-19', 'Washer 6mm GI', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.04', '0.0388', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(924, 'XAD000544', '2023-11-06', 'Washer 6mm GI', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(925, 'XAD000544', '2024-02-22', 'Washer 6mm GI', 'Noor Al Iman', 'PCS', '0.02', '0.0194', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(926, 'XAD000545', '2022-10-17', 'PVC Glands 36mm', 'Ali Asghar Hussani', 'PCS', '1.5', '1.455', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 841.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(927, 'XAD000546', '2022-03-31', 'Fix Bolt 8mm', 'Ali Asghar Hussani', 'PCS', '0.67', '0.6499', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(928, 'XAD000546', '2022-06-16', 'Fix Bolt 8mm', 'Noor Al Iman', 'PCS', '25', '24.25', 'Nokia Mobile Project Based On Purchase Orders 195.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(929, 'XAD000546', '2023-05-08', 'Fix Bolt 8mm', 'Ali Asghar Hussani', 'PCS', '0.5', '0.485', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2267.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(930, 'XAD000547', '2022-10-08', 'DC Cable 25mm Blue', 'Smooth Solution building Materails Trading LLC', 'MTR', '14', '13.58', 'Request No : DXB-Sep-067 Requested By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 731.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(931, 'XAD000547', '2022-11-08', 'DC Cable 25mm Blue', 'Noor Al Iman', 'MTR', '12.5', '12.125', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(932, 'XAD000548', '2022-11-08', 'DC Cable 25mm Black', 'Noor Al Iman', 'MTR', '12.5', '12.125', 'Request No : Huawei-Sep-DXB-066 Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(933, 'XAD000548', '2022-10-08', 'DC Cable 25mm Black', 'Smooth Solution building Materails Trading LLC', 'MTR', '14', '13.58', 'Request No : DXB-Sep-067 Requested By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 731.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(934, 'XAD000549', '2022-04-27', 'PVC Glands 25mm', 'Noor Al Iman', 'PCS', '0.9', '0.873', 'Project Adwea Invice No: 0831 Based On Purchase Orders 96. GRN : 27-04-024', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(935, 'XAD000549', '2022-09-14', 'PVC Glands 25mm', 'Wenzhou Zhechi', 'PCS', '0.32', '0.3104', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(936, 'XAD000549', '2022-10-17', 'PVC Glands 25mm', 'Ali Asghar Hussani', 'PCS', '1.2', '1.164', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 841.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(937, 'XAD000550', '2022-07-04', 'Buffer Tube 6mm', 'Noor Al Iman', 'Roll', '15', '14.55', 'Du Sfan Based On Purchase Orders 273.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(938, 'XAD000550', '2023-05-19', 'Buffer Tube 6mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '90', '87.3', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(939, 'XAD000550', '2023-09-02', 'Buffer Tube 6mm', 'Ali Asghar Hussani', 'Roll', '175', '169.75', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(940, 'XAD000551', '2022-03-29', 'AC Power Cable 3 Core 1.5mm', 'Noor Al Iman Elect & Hardware TR', 'MTR', '7', '6.79', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(941, 'XAD000552', '2022-09-08', 'AC Power Cable 4 Core ( Aurmourd Black )', 'Noor Al Iman', 'MTR', '38', '36.86', 'New 5G Passive Stie AUH5638 Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Date : 06-Sep-2022 Based On Purchase Orders 605.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(942, 'XAD000552', '2022-10-25', 'AC Power Cable 4 Core ( Aurmourd Black )', 'Smooth Solution building Materails Trading LLC', 'MTR', '34', '32.98', 'Material For AAN 0105 Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 963.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(943, 'XAD000552', '2023-01-28', 'AC Power Cable 4 Core ( Aurmourd Black )', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '33', '32.01', 'Request No : XAD-HW-JAN-DXB-082 Based On Purchase Orders 1617.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(944, 'XAD000553', '2022-06-16', 'I Lugs 6mm steel', 'Noor Al Iman', 'PKT', '6', '5.82', 'Nokia Mobile Project Based On Purchase Orders 195.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(945, 'XAD000553', '2022-09-14', 'I Lugs 6mm steel', 'Wenzhou Zhechi', 'PKT', '14.87', '14.4239', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(946, 'XAD000555', '2023-02-17', 'Clear  Tap 2\"', 'Azlan Star Technologies LLC', 'PCS', '2.5', '2.425', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1750.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(947, 'XAD000555', '2023-03-09', 'Clear  Tap 2\"', 'Noor Al Iman', 'PCS', '2.5', '2.425', 'Packing Material Required For Dismantle Packing logistic Department . Based On Purchase Orders 1883.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(948, 'XAD000555', '2023-11-25', 'Clear  Tap 2\"', 'Ali Asghar Hussani', 'PCS', '1.5', '1.455', 'Consumable & Tools Required For Nokia MN Project Nov-2023 Based On Purchase Orders 3518.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(949, 'XAD000561', '2022-03-08', 'Cable Tie 2.5*200mm White', 'Wenzhou Zhechi', 'PKT', '2.02', '1.9594', 'Material purchase from China for DU SFAN Based On Purchase Orders 355.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(950, 'XAD000561', '2022-05-30', 'Cable Tie 2.5*200mm White', 'Noor Al Iman', 'PKT', '4', '3.88', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(951, 'XAD000561', '2022-06-24', 'Cable Tie 2.5*200mm White', 'Ali Asghar Hussani', 'PKT', '3.5', '3.395', 'Adwea Based On Purchase Orders 237.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(952, 'XAD000561', '2023-05-19', 'Cable Tie 2.5*200mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '3.5', '3.395', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(953, 'XAD000562', '2022-05-28', 'Cable Tray 200x50', 'Noor Al Iman', 'PCS', '85', '82.45', 'Project : DU SFAN Based On Purchase Orders 172. INV#0852', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(954, 'XAD000562', '2022-12-19', 'Cable Tray 200x50', 'Smooth Solution building Materails Trading LLC', 'PCS', '38', '36.86', 'Request No : DU SFAN - 88 - 5-Dec-2022 Based On Purchase Orders 1410.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(955, 'XAD000562', '2023-06-22', 'Cable Tray 200x50', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '37.5', '36.375', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2476.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(956, 'XAD000562', '2023-09-11', 'Cable Tray 200x50', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '78', '75.66', 'Request No : DU SFAN - 245 - 06-09-2023 . Based On Purchase Orders 3118.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(957, 'XAD000562', '2024-02-28', 'Cable Tray 200x50', 'Ali Asghar Hussani', 'PCS', '52', '50.44', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(958, 'XAD000563', '2023-04-17', 'CCTV Camera', 'ADS Sfcmuty Dtvicfs Trading LLC', 'PCS', '45', '43.65', 'Request No : XAD-ICT-001-17-04-2023 . Based On Purchase Orders 2206.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(959, 'XAD000563', '2023-09-09', 'CCTV Camera', 'Wide Vision Technology LLC', 'PCS', '84.97', '82.4209', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(960, 'XAD000563', '2023-09-27', 'CCTV Camera', 'Cash', 'PCS', '75', '72.75', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(961, 'XAD000563', '2023-12-12', 'CCTV Camera', 'Kansas Security Systems Trading LLC', 'PCS', '361.9', '351.043', 'CCTV Camera For Dr. Khalid Midfa House Based On Purchase Orders 3632.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(962, 'XAD000568', '2023-05-24', 'Torch Light', 'Ali Asghar Hussani', 'PCS', '29', '28.13', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2311.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(963, 'XAD000582', '2023-10-11', 'Joint Support 32\"', 'Frontier Innovation General Trading', 'PCS', '38', '36.86', 'Request No : WR-101H-288-18-09-2023 . Based On Purchase Orders 3178.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(964, 'XAD000584', '2024-01-11', 'Chiseal 12\" ', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Chisel For ICT School Project Based On Purchase Orders 3877.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(965, 'XAD000585', '2022-08-12', 'Safety Mesh/ Net 1M* 50M', 'Abazar Building Materail LLC Qusais', 'Roll', '70', '67.9', 'Based On Purchase Orders 405.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(966, 'XAD000585', '2022-10-19', 'Safety Mesh/ Net 1M* 50M', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '50', '48.5', 'Request No : AAN-Oct-004 Requested By : Sufiyan Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 782.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(967, 'XAD000585', '2023-02-20', 'Safety Mesh/ Net 1M* 50M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '35', '33.95', 'Request No : WR 101H - 214 - Feb 2023. Based On Purchase Orders 1736.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(968, 'XAD000585', '2023-04-04', 'Safety Mesh/ Net 1M* 50M', 'Smooth Solution building Materails Trading LLC', 'Roll', '43', '41.71', 'Request No : DU SFAN-143-25-03-2023 . Based On Purchase Orders 2018.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(969, 'XAD000585', '2023-11-11', 'Safety Mesh/ Net 1M* 50M', 'Ali Asghar Hussani', 'Roll', '36', '34.92', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(970, 'XAD000588', '2022-01-04', 'L Connector for GI Trunking', 'Noor Al Iman Elect & Hardware TR', 'PCS', '3', '2.91', 'GRN : 04-01-08', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(971, 'XAD000590', '2022-11-09', 'One Ten Tool', 'Azlan Star Technologies LLC', 'PCS', '60', '58.2', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(972, 'XAD000590', '2023-11-13', 'One Ten Tool', 'The Mark Infotech System Solutions LLC', 'PCS', '10', '9.7', 'Request No : DU TCS Nov-2023  Testing Tool Required For 7th New Technician For DU TCS Project . Based On Purchase Orders 3473.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(973, 'XAD000590', '2023-12-29', 'One Ten Tool', 'Cash', 'PCS', '10', '9.7', 'ONE TEN TOOL REQUIRED FOR DU TCS PROJECT Based On Purchase Orders 3755.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(974, 'XAD000591', '2022-11-18', 'Copper Rod', 'Noor Al Iman', 'PCS', '160', '155.2', 'Based On Purchase Orders 1227.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(975, 'XAD000592', '2023-04-19', 'Joint Support 40\"', 'Frontier Innovation General Trading', 'PCS', '46', '44.62', 'Request No : AAN-March-23-0027 Based On Purchase Orders 2035.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(976, 'XAD000593', '2022-02-25', 'Vaccum Cleaner', 'Al Madina Hyper Market', 'PCS', '328.57', '318.7129', 'PO_3525- Common Expense Based On Purchase Orders 63 GRN-25-02-038.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(977, 'XAD000593', '2022-05-12', 'Vaccum Cleaner', 'Ali Asghar Hussani', 'PCS', '380', '368.6', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(978, 'XAD000593', '2023-04-28', 'Vaccum Cleaner', 'Smooth Solution building Materails Trading LLC', 'PCS', '470', '455.9', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(979, 'XAD000594', '2022-01-10', 'Garden handle Rak', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'GRN : 10-01-016 Project: L&T Etihad Rail Based On Purchase Orders 3410.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(980, 'XAD000598', '2022-11-18', '1/2\" cable clamp ', 'Noor Al Iman', 'PCS', '0.65', '0.6305', 'Based On Purchase Orders 1227.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(981, 'XAD000602', '2024-02-26', 'Telephone Tester', 'APKR Networking Zone', 'PCS', '30', '29.1', 'Telephone Tester For DU TCS Project Based On Purchase Orders 4169.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(982, 'XAD000604', '2023-09-27', 'Moniter', 'Cash', 'PCS', '235', '227.95', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(983, 'XAD000605', '2022-05-25', 'Trunking 100x50', 'Noor Al Iman', 'PCS', '28', '27.16', 'Huawei Mobile Project Based On Purchase Orders 145. INV# 0848,0849,850', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(984, 'XAD000606', '2023-05-18', 'Furring Channel 3M', 'Ali Asghar Hussani', 'PCS', '7', '6.79', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2306. Based On Goods Receipt PO 948.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(985, 'XAD000607', '2023-01-25', 'Fisher 10mmx2.5\" for Coach Bolt', 'Noor Al Iman', 'PCS', '0.4', '0.388', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(986, 'XAD000607', '2023-06-14', 'Fisher 10mmx2.5\" for Coach Bolt', 'Ali Asghar Hussani', 'PCS', '0.6', '0.582', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2522.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(987, 'XAD000611', '2023-05-17', 'Patch Cord 5M LC UPC-LC UPC Simplex', 'The Mark Infotech System Solutions LLC', 'PCS', '9.8', '9.506', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2339.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(988, 'XAD000611', '2024-01-11', 'Patch Cord 5M LC UPC-LC UPC Simplex', 'APKR Networking Zone', 'PCS', '13', '12.61', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(989, 'XAD000614', '2022-09-10', 'I Lugs 10mm Red', 'Noor Al Iman', 'PKT', '7', '6.79', 'Request Aug 064  Project : Huawei Requested By : JAwad Hussian Verified By : Sohail Abbas Based On Purchase Orders 584.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(990, 'XAD000614', '2022-09-14', 'I Lugs 10mm Red', 'Wenzhou Zhechi', 'PKT', '1.73', '1.6781', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(991, 'XAD000614', '2022-09-30', 'I Lugs 10mm Red', 'JOGA RAM GENERAL TRADING LLC', 'PKT', '12', '11.64', 'Request No : Sep-DXB-066 Requested By : Muhammad Bilal & Jawad Hussain  Verified By : Sohail Abbas Based On Purchase Orders 672.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(992, 'XAD000615', '2023-10-27', 'Patch Cord 15M LC UPC-LC UPC DX', 'The Mark Infotech System Solutions LLC', 'PCS', '20', '19.4', 'Request No : XAD-HW-Oct-DCB-0098 - 27-Oct-2023 . Based On Purchase Orders 3365.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(993, 'XAD000615', '2024-01-11', 'Patch Cord 15M LC UPC-LC UPC DX', 'APKR Networking Zone', 'PCS', '20', '19.4', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(994, 'XAD000617', '2023-04-04', 'Extension Lead - PDU', 'Smooth Solution building Materails Trading LLC', 'PCS', '55', '53.35', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(995, 'XAD000617', '2023-09-09', 'Extension Lead - PDU', 'Wide Vision Technology LLC', 'PCS', '24.99', '24.2403', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(996, 'XAD000617', '2023-10-18', 'Extension Lead - PDU', 'Smooth Solution building Materails Trading LLC', 'PCS', '110', '106.7', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3328.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(997, 'XAD000618', '2023-05-10', 'Pigtail 1.5m S/M  LC-UPC', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.5', '2.425', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2268.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(998, 'XAD000618', '2023-10-27', 'Pigtail 1.5m S/M  LC-UPC', 'The Mark Infotech System Solutions LLC', 'PCS', '2.2', '2.134', 'Request No : XAD-HW-Oct-DCB-0098 - 27-Oct-2023 . Based On Purchase Orders 3365.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(999, 'XAD000618', '2023-11-06', 'Pigtail 1.5m S/M  LC-UPC', 'Auto Computer Trading LLC', 'PCS', '1.6', '1.552', 'Request No : XAD-HW-Sep-DXB-119 Based On Purchase Orders 3173.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1000, 'XAD000618', '2024-01-11', 'Pigtail 1.5m S/M  LC-UPC', 'APKR Networking Zone', 'PCS', '1.6', '1.552', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1001, 'XAD000621', '2023-12-06', 'Patch Cord 5M LC UPC-LC UPC Duplex', 'The Mark Infotech System Solutions LLC', 'PCS', '12', '11.64', 'NOKIA Spliciling Materials Request Based On Purchase Orders 3576.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1002, 'XAD000624', '2023-11-06', 'Patch Cord 5M LC APC- LC UPC Duplex', 'Auto Computer Trading LLC', 'PCS', '13', '12.61', 'Request No : XAD-HW-Sep-DXB-119 Based On Purchase Orders 3173.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1003, 'XAD000625', '2023-01-23', 'Electric Socket Single 13A', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '8', '7.76', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1004, 'XAD000625', '2023-03-31', 'Electric Socket Single 13A', 'Smooth Solution building Materails Trading LLC', 'PCS', '7', '6.79', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1005, 'XAD000625', '2023-04-18', 'Electric Socket Single 13A', 'Noor Al Iman', 'PCS', '7', '6.79', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2131.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1006, 'XAD000625', '2023-12-27', 'Electric Socket Single 13A', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '7.5', '7.275', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1007, 'XAD000625', '2024-02-15', 'Electric Socket Single 13A', 'Ali Asghar Hussani', 'PCS', '6.5', '6.305', 'REQUEST NO : SMART HOME-AAN-002-FEB\'24  AAN REGION Based On Purchase Orders 4082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1008, 'XAD000627', '2022-11-08', 'DC Cable 16mm Black', 'Noor Al Iman', 'MTR', '12.5', '12.125', 'Request No : Huawei-Sep-DXB-066 Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1009, 'XAD000627', '2022-10-08', 'DC Cable 16mm Black', 'Smooth Solution building Materails Trading LLC', 'MTR', '14', '13.58', 'Request No : DXB-Sep-067 Requested By : Fazal Abbas  Verified By : Sohail Abbas Based On Purchase Orders 731.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1010, 'XAD000628', '2022-12-29', 'Pigtail 1.5m S/M  LC-APC', 'Azlan Star Technologies LLC', 'PCS', '2.25', '2.1825', 'Based On Purchase Orders 1451.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1011, 'XAD000631', '2022-11-08', 'MCB breaker 63A Single Pole', 'Noor Al Iman', 'PCS', '20', '19.4', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1012, 'XAD000631', '2023-02-16', 'MCB breaker 63A Single Pole', 'Ali Asghar Hussani', 'PCS', '14.5', '14.065', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1706.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1013, 'XAD000633', '2022-03-31', 'Thimble Lugs 35mm', 'Ali Asghar Hussani', 'PKT', '65', '63.05', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1014, 'XAD000633', '2022-08-29', 'Thimble Lugs 35mm', 'Noor Al Iman', 'PKT', '80', '77.6', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1015, 'XAD000633', '2022-09-14', 'Thimble Lugs 35mm', 'Wenzhou Zhechi', 'PKT', '80.37', '77.9589', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1016, 'XAD000633', '2023-04-04', 'Thimble Lugs 35mm', 'Smooth Solution building Materails Trading LLC', 'PKT', '1.4', '1.358', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1017, 'XAD000634', '2022-07-07', 'AC power cable 2.5  3 core', 'Noor Al Iman', 'MTR', '4.84', '4.6948', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1018, 'XAD000634', '2023-04-12', 'AC power cable 2.5  3 core', 'Smooth Solution building Materails Trading LLC', 'MTR', '3.45', '3.3465', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1019, 'XAD000634', '2023-08-07', 'AC power cable 2.5  3 core', 'Ali Asghar Hussani', 'MTR', '3.45', '3.3465', 'Request No : Adwea-201-31-07-2023 . Based On Purchase Orders 2908.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1020, 'XAD000636', '2023-01-24', 'Safety Water Barrier 2M', 'Ali Asghar Hussani', 'PCS', '185', '179.45', 'Request No : AAN-JAN23-001 Based On Purchase Orders 1503.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1021, 'XAD000636', '2023-02-20', 'Safety Water Barrier 2M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '185', '179.45', 'Request No : WR 101H - 214 - Feb 2023. Based On Purchase Orders 1736.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1022, 'XAD000637', '2022-08-29', 'Neutral Cercuit Breaker', 'Noor Al Iman', 'PCS', '4', '3.88', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1023, 'XAD000639', '2023-01-30', 'Pulling Spring 25 M', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1024, 'XAD000639', '2023-03-08', 'Pulling Spring 25 M', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '11', '10.67', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1025, 'XAD000639', '2023-12-27', 'Pulling Spring 25 M', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1026, 'XAD000640', '2024-01-10', 'Tool Bag With Du Logo', 'Quality Advertising', 'PCS', '75', '72.75', 'Request No 283  DU SFAN Project Based On Purchase Orders 3670.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1027, 'XAD000641', '2022-07-16', 'Vibrator R020', 'Ali Asghar Hussani', 'PCS', '950', '921.5', 'AAN 101 Based On Purchase Orders 338.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1028, 'XAD000643', '2022-09-01', 'Cable Tie 600mm Black', 'Noor Al Iman', 'PKT', '45', '43.65', 'Project : FDH AAN  Requested By : Nikunj Verifed By : Mr Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 541.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1029, 'XAD000643', '2023-04-07', 'Cable Tie 600mm Black', 'Ali Asghar Hussani', 'PKT', '36', '34.92', 'Request No : AAN-March-23-0027 Based On Purchase Orders 2032.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1030, 'XAD000643', '2023-07-10', 'Cable Tie 600mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '33', '32.01', 'Request No : OSP-LMP-12 Based On Purchase Orders 2675.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1031, 'XAD000644', '2022-10-19', 'Waste Cloth Cotton', 'JOGA RAM GENERAL TRADING LLC', 'PKT', '22', '21.34', 'Requet No : DU SFAN-Sep 2022 (66 ) Requested By : Ahmad Iqbal  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 738.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1032, 'XAD000644', '2023-11-11', 'Waste Cloth Cotton', 'Ali Asghar Hussani', 'PKT', '15', '14.55', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1033, 'XAD000645', '2022-07-29', 'Knife Blade', 'Noor Al Iman', 'PCS', '1', '0.97', 'Huawei Mobile Project Based On Purchase Orders 383.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1034, 'XAD000645', '2022-11-25', 'Knife Blade', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.95', '0.9215', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1289.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1035, 'XAD000645', '2023-09-02', 'Knife Blade', 'Ali Asghar Hussani', 'PCS', '1', '0.97', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1036, 'XAD000645', '2024-02-22', 'Knife Blade', 'Noor Al Iman', 'PCS', '1', '0.97', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1037, 'XAD000646', '2023-04-28', 'Safety Water Proof Rubber Gloves', 'Smooth Solution building Materails Trading LLC', 'PCS', '6.5', '6.305', 'Based On Purchase Orders 2211.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1038, 'XAD000646', '2023-04-28', 'Safety Water Proof Rubber Gloves', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Request No : UK-AP23-001 Based On Purchase Orders 2193.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1039, 'XAD000650', '2022-08-04', 'Whitener  Marker', 'Abazar Building Materail LLC Qusais', 'PCS', '6.5', '6.305', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1040, 'XAD000650', '2024-01-11', 'Whitener  Marker', 'Ali Asghar Hussani', 'PCS', '2.5', '2.425', 'REQUEST NO 287 DU SFAN PROJECT Based On Purchase Orders 3852.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1041, 'XAD000652', '2022-01-01', 'Binding Wire 10kg', 'Ali Asghar Hussani', 'Roll', '60', '58.2', 'GRN : 01-02-003 Project: L&T Etihad Rail Based On Purchase Orders: 3513', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1042, 'XAD000652', '2022-08-18', 'Binding Wire 10kg', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '55', '53.35', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1043, 'XAD000652', '2022-11-02', 'Binding Wire 10kg', 'Saeed Al Zaabi General Trading LLC', 'Roll', '45', '43.65', 'Request No : L&T Ruwais 211  Requested By : Jahanzaib Anwar Verified By : Rafaqat Mehmood  Imran Iqbal Based On Purchase Orders 991.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1044, 'XAD000652', '2023-04-10', 'Binding Wire 10kg', 'MAA ALMADINA BUILDING MATERIAL', 'Roll', '45', '43.65', 'Request No: AUH-OLT-0020 Based On Purchase Orders 2098.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1045, 'XAD000652', '2024-01-11', 'Binding Wire 10kg', 'Al Moazam Stores LLC', 'Roll', '3.8', '3.686', 'REQUEST NO AAN JAN 24 102 Based On Purchase Orders 3841.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1046, 'XAD000653', '2023-01-17', 'PlyWood Sheet 6mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '70', '67.9', 'Request No : AUH-OLT-140 Based On Purchase Orders 1493.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1047, 'XAD000653', '2023-05-18', 'PlyWood Sheet 6mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '38', '36.86', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1048, 'XAD000653', '2023-12-13', 'PlyWood Sheet 6mm', 'Al Moazam Stores LLC', 'PCS', '35', '33.95', 'Request No : AAN-NOV-23-0098  FOR AAN 101-H Based On Purchase Orders 3552.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1049, 'XAD000654', '2022-06-17', 'Wood Bar  4*2', 'Ali Asghar Hussani', 'PCS', '27', '26.19', 'Etihad Rail Based On Purchase Orders 212.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1050, 'XAD000654', '2022-08-18', 'Wood Bar  4*2', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '34', '32.98', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1051, 'XAD000655', '2022-07-26', 'Wood Bar 4x4', 'Ali Asghar Hussani', 'PCS', '54', '52.38', 'LNT Based On Purchase Orders 326.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1052, 'XAD000655', '2022-08-18', 'Wood Bar 4x4', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '50', '48.5', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1053, 'XAD000655', '2023-09-12', 'Wood Bar 4x4', 'Al Moazam Stores LLC', 'PCS', '42.56', '41.2832', 'Request No : AAN-Aug-23-080 Based On Purchase Orders 3159.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1054, 'XAD000658', '2022-05-28', 'Polyethylene Construction Sheet', 'Noor Al Iman', 'Roll', '30', '29.1', 'Etihad Rail Based On Purchase Orders 137. INV#0851', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1055, 'XAD000658', '2022-07-16', 'Polyethylene Construction Sheet', 'Ali Asghar Hussani', 'Roll', '14', '13.58', 'Du sfan Based On Purchase Orders 274.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1056, 'XAD000659', '2023-02-17', 'MCB breaker LT 6A Single Pole', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1688.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1057, 'XAD000659', '2023-02-27', 'MCB breaker LT 6A Single Pole', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-153-156-155- 24-02-2023 Based On Purchase Orders 1793.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1058, 'XAD000660', '2022-07-29', 'Thread Rod 8mm', 'Noor Al Iman', 'PCS', '3.5', '3.395', 'Huawei Mobile Project Based On Purchase Orders 383.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1059, 'XAD000660', '2023-09-02', 'Thread Rod 8mm', 'Ali Asghar Hussani', 'PCS', '2.75', '2.6675', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1060, 'XAD000661', '2022-03-28', 'G.I Nut 8mm', 'Ali Asghar Hussani', 'KG', '8', '7.76', 'GRN :28-03-020 Project :Huawei IBS 5G Based On Purchase Orders:3679', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1061, 'XAD000661', '2022-06-28', 'G.I Nut 8mm', 'Noor Al Iman', 'KG', '10', '9.7', 'Huawei Mobile project Based On Purchase Orders 231.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1062, 'XAD000666', '2022-08-29', 'ELCB Breaker 25A 2 Pole', 'Noor Al Iman', 'PCS', '98', '95.06', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1063, 'XAD000667', '2022-06-28', 'MCB Breaker 32A 3Pole', 'Noor Al Iman', 'PCS', '55', '53.35', 'Huawei Mobile project Based On Purchase Orders 231.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1064, 'XAD000667', '2023-06-14', 'MCB Breaker 32A 3Pole', 'Ali Asghar Hussani', 'PCS', '38', '36.86', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2522. Based On Goods Receipt PO 1053.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1065, 'XAD000667', '2023-07-15', 'MCB Breaker 32A 3Pole', 'Noor Al Iman', 'PCS', '60', '58.2', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1066, 'XAD000668', '2023-02-17', 'MCB breaker Single Pole 10A', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Request No : XAD-HW-Jan-DXB-085 Based On Purchase Orders 1747.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1067, 'XAD000668', '2023-03-18', 'MCB breaker Single Pole 10A', 'Noor Al Iman', 'PCS', '10', '9.7', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1068, 'XAD000669', '2022-08-29', 'MCB breaker Single Pole 16A', 'Noor Al Iman', 'PCS', '10', '9.7', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1069, 'XAD000669', '2023-06-14', 'MCB breaker Single Pole 16A', 'Ali Asghar Hussani', 'PCS', '9', '8.73', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2522. Based On Goods Receipt PO 1053.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1070, 'XAD000671', '2023-05-24', 'MCB Breaker 40A 3pole', 'Smooth Solution building Materails Trading LLC', 'PCS', '46.5', '45.105', 'Request No : XAD -HW - May - DXB-099 Based On Purchase Orders 2366.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1071, 'XAD000671', '2023-07-15', 'MCB Breaker 40A 3pole', 'Noor Al Iman', 'PCS', '70', '67.9', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2730.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1072, 'XAD000671', '2023-09-20', 'MCB Breaker 40A 3pole', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1073, 'XAD000672', '2023-06-14', 'MCB Breaker 40A 4pole', 'Noor Al Iman', 'PCS', '72', '69.84', 'Request No : XAD-HW-June-May-DXB--105-099 Based On Purchase Orders 2412.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1074, 'XAD000674', '2023-01-28', 'Tie Rod 16mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '20', '19.4', 'Request No : Etihad Rail L&T-4-DXB-Jan-2023 Based On Purchase Orders 1588.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1075, 'XAD000676', '2023-01-28', 'Tie Rod Nut', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '4', '3.88', 'Request No : Etihad Rail L&T-4-DXB-Jan-2023 Based On Purchase Orders 1588.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1076, 'XAD000677', '2023-10-02', 'Drill Bit 22mm Steel (Hilti)', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '16', '15.52', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1077, 'XAD000678', '2022-01-10', 'PVC Bucket Black', 'Ali Asghar Hussani', 'PCS', '7', '6.79', 'GRN : 10-01-016 Project: L&T Etihad Rail Based On Purchase Orders 3410.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1078, 'XAD000679', '2023-03-14', 'Drum Empty', 'Smooth Solution building Materails Trading LLC', 'PCS', '120', '116.4', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1891.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1079, 'XAD000681', '2023-07-12', 'Adaptor LC APC DUPLX (Green)', 'The Mark Infotech System Solutions LLC', 'PCS', '0.78', '0.7566', 'Request No : OSP-LMP-13-AUH-DXB-NE Based On Purchase Orders 2628.', '2024-10-09 03:56:57', '2024-10-09 03:56:57');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1080, 'XAD000682', '2023-11-06', 'Adaptor LC UPC DUPLX (Blue)', 'Auto Computer Trading LLC', 'PCS', '0.9', '0.873', 'Request No : XAD-HW-Sep-DXB-119 Based On Purchase Orders 3173.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1081, 'XAD000682', '2023-12-06', 'Adaptor LC UPC DUPLX (Blue)', 'The Mark Infotech System Solutions LLC', 'PCS', '1.1', '1.067', 'NOKIA Spliciling Materials Request Based On Purchase Orders 3576.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1082, 'XAD000682', '2024-01-11', 'Adaptor LC UPC DUPLX (Blue)', 'APKR Networking Zone', 'PCS', '0.85', '0.8245', 'Consumeables Materials Request Nokia Project Based On Purchase Orders 3873.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1083, 'XAD000684', '2022-06-22', 'Temperature Gun', 'Ali Asghar Hussani', 'PCS', '70', '67.9', 'Huawei Mobile Project Based On Purchase Orders 239.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1084, 'XAD000685', '2022-06-04', 'Aluminium Ladder 2 Step / 3 Step', 'Noor Al Iman', 'PCS', '130', '126.1', 'Project : ADWEA Based On Purchase Orders 186.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1085, 'XAD000685', '2022-11-09', 'Aluminium Ladder 2 Step / 3 Step', 'Azlan Star Technologies LLC', 'PCS', '135', '130.95', 'Request No : DU TCS 09-022-11 Based On Purchase Orders 1203.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1086, 'XAD000685', '2023-11-13', 'Aluminium Ladder 2 Step / 3 Step', 'Ali Asghar Hussani', 'PCS', '340', '329.8', 'Request No : DU TCS Nov-2023  Hand Tool Required For 7th New Technician For DU TCS Project . Based On Purchase Orders 3472.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1087, 'XAD000686', '2022-10-21', 'Big DB Box', 'Noor Al Iman', 'PCS', '95', '92.15', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 842.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1088, 'XAD000686', '2022-10-25', 'Big DB Box', 'Smooth Solution building Materails Trading LLC', 'PCS', '260', '252.2', 'Material For AAN 0105 Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 963.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1089, 'XAD000687', '2022-10-27', 'Semi Static Rope 12.5mm x 200M', 'Fas Arabia llc', 'Roll', '2200', '2134', 'Request No : XAD -HW - Oct-DXB-070  Requested By : Fazal Abbas  Verified By      : Rasheed Ahmad & Sohail Abbas Based On Purchase Orders 1027.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1090, 'XAD000688', '2023-03-06', 'DRILL CHUCK', 'Noor Al Iman', 'PCS', '15', '14.55', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1854.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1091, 'XAD000688', '2023-03-08', 'DRILL CHUCK', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '24', '23.28', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1092, 'XAD000690', '2022-05-28', 'Cable Tray GI 100*50', 'Noor Al Iman', 'PCS', '40', '38.8', 'Project : DU SFAN Based On Purchase Orders 172. INV#0852', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1093, 'XAD000690', '2023-06-22', 'Cable Tray GI 100*50', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '27', '26.19', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2476.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1094, 'XAD000690', '2023-11-27', 'Cable Tray GI 100*50', 'Noor Al Iman', 'PCS', '25', '24.25', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1095, 'XAD000691', '2022-02-26', 'Cable Tray GI 250*50', 'Noor Al Iman Elect & Hardware TR', 'PCS', '89', '86.33', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1096, 'XAD000697', '2022-06-04', 'Fisher S 8', 'Noor Al Iman', 'Box', '2.5', '2.425', 'Adwea Based On Purchase Orders 185.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1097, 'XAD000698', '2023-05-10', 'Jublee Clip - Steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.5', '1.455', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2268.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1098, 'XAD000698', '2023-08-14', 'Jublee Clip - Steel', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'Consumable Qulaity Material Required For Nokia Mobile Project . Based On Purchase Orders 2953.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1099, 'XAD000699', '2022-04-11', 'PVC Trunking 50x50', 'Noor Al Iman', 'PCS', '35', '33.95', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1100, 'XAD000699', '2023-09-05', 'PVC Trunking 50x50', 'Ali Asghar Hussani', 'PCS', '11', '10.67', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3095. Based On Goods Receipt PO 1283.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1101, 'XAD000700', '2023-09-02', 'Draytek VPN router', 'Rukun Al Zahra Computers Trading LLC', 'PCS', '1450', '1406.5', 'Router Draytek Replacement Required For Sharjah Office .     The internet is not working properly; some times it\'s not sending or receiving mail due to an internet issue. It\'s slow and has more issues. Raziq suggests that we change the router. Based On P', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1102, 'XAD000704', '2022-09-05', 'DC Breaker Singal pole 125A', 'Telxpert Technologies LLC', 'PCS', '250', '242.5', 'Request Aug DXB 064  Project : Huawei Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 597.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1103, 'XAD000708', '2023-04-28', 'Long Chiesel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '18', '17.46', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1104, 'XAD000708', '2023-05-18', 'Long Chiesel', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '35', '33.95', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1105, 'XAD000709', '2022-05-28', 'Hole Saw 20mm', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'ADWEA Based On Purchase Orders 141.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1106, 'XAD000709', '2022-10-04', 'Hole Saw 20mm', 'Noor Al Iman', 'PCS', '15', '14.55', 'Request No : ADWEA 67 & 65 & 71 Requested By : Screenth CK  Verified By : Wasiullah Khan & Badiurreman Based On Purchase Orders 638.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1107, 'XAD000709', '2023-04-03', 'Hole Saw 20mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '10', '9.7', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1108, 'XAD000710', '2022-09-08', 'Ply Wood Cutter Makita', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '283', '274.51', 'Project : AAN OLT Requested By : Sufian Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 602.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1109, 'XAD000711', '2022-08-09', 'Warning Tape  Non-Detectable 250mm', 'kangaroo Plastic Miiddle East LLC', 'Roll', '325', '315.25', 'Project : Etihad Rail  Requested By : Rafaqat Mehmood  Prepared By : Raja M zeeshan Based On Purchase Orders 438.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1110, 'XAD000715', '2022-08-04', 'Scissor Beorol 20cm', 'Abazar Building Materail LLC Qusais', 'PCS', '15', '14.55', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1111, 'XAD000715', '2023-04-28', 'Scissor Beorol 20cm', 'Smooth Solution building Materails Trading LLC', 'PCS', '15', '14.55', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1112, 'XAD000715', '2023-12-27', 'Scissor Beorol 20cm', 'Ali Asghar Hussani', 'PCS', '13', '12.61', 'Carpentry Tool Request  Smart Home Project Based On Purchase Orders 3723.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1113, 'XAD000715', '2024-02-10', 'Scissor Beorol 20cm', 'Cash', 'PCS', '30', '29.1', 'Materials Required For ICT Project Based On Purchase Orders 4067.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1114, 'XAD000716', '2023-05-27', 'Cable Roller Heavy Duty', 'Elfit Arabia', 'PCS', '370', '358.9', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2313.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1115, 'XAD000716', '2023-12-27', 'Cable Roller Heavy Duty', 'Ali Asghar Hussani', 'PCS', '70', '67.9', 'REQUEST NO 0066 AUH OLT PROJECT Based On Purchase Orders 3709.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1116, 'XAD000720', '2022-09-14', 'PVC Glands 32mm', 'Wenzhou Zhechi', 'PCS', '0.41', '0.3977', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1117, 'XAD000721', '2023-11-06', 'Super Glue (Elfi)', 'Noor Al Iman', 'PCS', '1.8', '1.746', 'Request No : Nokia-OCT-2023 Based On Purchase Orders 3448.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1118, 'XAD000722', '2023-03-21', 'Safety Cone Medium', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '20', '19.4', 'Request No : AUH-OLT-0011 Based On Purchase Orders 1923.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1119, 'XAD000722', '2023-04-04', 'Safety Cone Medium', 'Smooth Solution building Materails Trading LLC', 'PCS', '15', '14.55', 'Request No : DU SFAN-143-25-03-2023 . Based On Purchase Orders 2018.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1120, 'XAD000722', '2023-12-20', 'Safety Cone Medium', 'Ali Asghar Hussani', 'PCS', '14', '13.58', 'REQUEST NO 283  DU SFAN PROJECT Based On Purchase Orders 3664.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1121, 'XAD000723', '2022-05-07', 'Wooden Safety Sign ( Danger )', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Based On Purchase Orders 108.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1122, 'XAD000724', '2022-04-09', 'Uniform T shirts with Du Logo-S', 'Emporium Gulf', 'PCS', '21', '20.37', 'PO-3735- Du SFAN Based On Purchase Orders 62. GRN-09-04-008', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1123, 'XAD000727', '2023-08-15', 'Uniform T shirts with Du Logo-XL', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : DU SFAN-225-29-07-2023 . Based On Purchase Orders 2911.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1124, 'XAD000728', '2023-08-15', 'Uniform T shirt with Du Logo-XXL', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : DU SFAN-225-29-07-2023 . Based On Purchase Orders 2911.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1125, 'XAD000729', '2023-08-15', 'Uniform T shirts with Du Logo-XXXL', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : DU SFAN-225-29-07-2023 . Based On Purchase Orders 2911.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1126, 'XAD000730', '2022-08-04', 'MCB breaker 125A Single Pole', 'Abazar Building Materail LLC Qusais', 'PCS', '150', '145.5', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1127, 'XAD000731', '2022-06-24', 'PVC Glands 12mm', 'Ali Asghar Hussani', 'PCS', '0.45', '0.4365', 'Adwea Based On Purchase Orders 237.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1128, 'XAD000731', '2022-07-07', 'PVC Glands 12mm', 'Noor Al Iman', 'PCS', '1', '0.97', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1129, 'XAD000731', '2022-09-14', 'PVC Glands 12mm', 'Wenzhou Zhechi', 'PCS', '0.1', '0.097', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1130, 'XAD000732', '2022-04-09', 'Aluminium Ladder 12 Step 3x4', 'Cash', 'PCS', '430', '417.1', 'GRN: 9-04-023 LPO 50/3774 Requested by: Rashid Ahmad Verified By : Sohail Abbas Prepared By : Wahab Aslam Based On Purchase Orders 50.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1131, 'XAD000732', '2022-11-25', 'Aluminium Ladder 12 Step 3x4', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '310', '300.7', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1289.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1132, 'XAD000732', '2023-04-28', 'Aluminium Ladder 12 Step 3x4', 'Smooth Solution building Materails Trading LLC', 'PCS', '235', '227.95', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1133, 'XAD000732', '2023-12-13', 'Aluminium Ladder 12 Step 3x4', 'Ali Asghar Hussani', 'PCS', '220', '213.4', 'REQUEST NO 5 Based On Purchase Orders 3642.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1134, 'XAD000733', '2022-04-11', 'MCB Breaker 20A 3Pole', 'Noor Al Iman', 'PCS', '10', '9.7', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1135, 'XAD000734', '2023-03-18', 'MCB Breaker 25A 3Pole', 'Noor Al Iman', 'PCS', '55', '53.35', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1136, 'XAD000736', '2022-11-08', 'MCB breaker 40A Single  Pole', 'Noor Al Iman', 'PCS', '12', '11.64', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1137, 'XAD000740', '2022-07-21', 'Stainless Steel Hole Saw 16mm', 'Noor Al Iman', 'PCS', '15', '14.55', 'Nokia Mobile  Project Based On Purchase Orders 352.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1138, 'XAD000741', '2022-07-15', 'Tarpoline Sheet 6*6', 'Noor Al Iman', 'Roll', '65', '63.05', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1139, 'XAD000741', '2023-09-12', 'Tarpoline Sheet 6*6', 'Al Moazam Stores LLC', 'Roll', '34.99', '33.9403', 'Request No : AAN-Aug-23-080 Based On Purchase Orders 3159.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1140, 'XAD000744', '2023-07-17', 'Drill Bit Steel 6mm', 'Ali Asghar Hussani', 'PCS', '3', '2.91', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1141, 'XAD000746', '2022-06-16', 'Drill Bit Steel 14mm Steel', 'Noor Al Iman', 'PCS', '18', '17.46', 'ADWEA Based On Purchase Orders 210.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1142, 'XAD000746', '2023-01-26', 'Drill Bit Steel 14mm Steel', 'Ali Asghar Hussani', 'PCS', '9', '8.73', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1143, 'XAD000746', '2023-03-08', 'Drill Bit Steel 14mm Steel', 'Smooth Solution building Materails Trading LLC', 'PCS', '15', '14.55', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1144, 'XAD000746', '2023-04-03', 'Drill Bit Steel 14mm Steel', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '20', '19.4', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1145, 'XAD000747', '2023-11-06', 'Screw Driver T15', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Request No : Nokia-OCT-2023 . Based On Purchase Orders 3447.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1146, 'XAD000747', '2023-12-09', 'Screw Driver T15', 'Noor Al Iman', 'PCS', '10', '9.7', 'Consumables and Tools required by Nokia MN Project for month of Nov-23 Based On Purchase Orders 3521.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1147, 'XAD000749', '2022-08-09', 'Warning Tape  Non-Detectable 150mm', 'kangaroo Plastic Miiddle East LLC', 'Roll', '250', '242.5', 'Project : Etihad Rail  Requested By : Rafaqat Mehmood  Prepared By : Raja M zeeshan Based On Purchase Orders 438.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1148, 'XAD000751', '2023-04-12', 'Cable Tie Base', 'Smooth Solution building Materails Trading LLC', 'PKT', '9', '8.73', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1149, 'XAD000752', '2024-02-22', 'Dummy for Power DB', 'Noor Al Iman', 'PCS', '4', '3.88', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1150, 'XAD000756', '2022-08-04', 'Gypsum Powder', 'Abazar Building Materail LLC Qusais', 'PKT', '15', '14.55', 'Project : Huawei OD Requested By : Jawad Hussain Verified By : Rashid Ahmad Based On Purchase Orders 404.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1151, 'XAD000756', '2023-07-31', 'Gypsum Powder', 'Ali Asghar Hussani', 'PKT', '12', '11.64', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1152, 'XAD000756', '2023-09-12', 'Gypsum Powder', 'Al Moazam Stores LLC', 'PKT', '10', '9.7', 'Request No : AAN-Aug-23-080 Based On Purchase Orders 3159.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1153, 'XAD000758', '2022-01-01', 'PlyWood Sheet 18mm', 'Ali Asghar Hussani', 'PCS', '120', '116.4', 'GRN : 01-02-003 Project: L&T Etihad Rail Based On Purchase Orders: 3513', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1154, 'XAD000758', '2023-01-18', 'PlyWood Sheet 18mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '85', '82.45', 'Requested By : AAN-JAN23-004 Based On Purchase Orders 1548.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1155, 'XAD000758', '2023-12-13', 'PlyWood Sheet 18mm', 'Al Moazam Stores LLC', 'PCS', '100', '97', 'Request No : AAN-NOV-23-0098  FOR AAN 101-H Based On Purchase Orders 3552.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1156, 'XAD000758', '2024-01-11', 'PlyWood Sheet 18mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '60', '58.2', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1157, 'XAD000759', '2022-02-14', 'Nail  wood 4\'\'', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'GRN   : 14-02-032 Project : L&T Etihad Rail Based On Purchase Orders 94/3573', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1158, 'XAD000759', '2022-07-15', 'Nail  wood 4\'\'', 'Noor Al Iman', 'PCS', '22', '21.34', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1159, 'XAD000762', '2023-01-28', 'Steel Rod 12mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '17', '16.49', 'Request No : AUH-OLT-140 Based On Purchase Orders 1492.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1160, 'XAD000763', '2022-03-08', 'Measuring Tape 7.5M', 'Ali Asghar Hussani', 'PCS', '9', '8.73', 'PO_3649-OLT AAN Based On Purchase Orders 11. GRN-08-03-012', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1161, 'XAD000764', '2023-12-21', 'Right Angle Scale', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'REQUEST NO 11 ICT SCHOOL PROJECT Based On Purchase Orders 3690.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1162, 'XAD000765', '2022-07-15', 'Water Cooler 5 Ltr', 'Noor Al Iman', 'PCS', '65', '63.05', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1163, 'XAD000765', '2023-09-20', 'Water Cooler 5 Ltr', 'Ali Asghar Hussani', 'PCS', '50', '48.5', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1164, 'XAD000769', '2022-03-31', 'DB Earth Bar', 'Noor Al Iman Elect & Hardware TR', 'PCS', '5', '4.85', 'GRN :   31-03-027 Project : Nokia TI & OD Based On Purchase Orders 3707', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1165, 'XAD000771', '2022-11-16', 'I lugs 2.5mm', 'Noor Al Iman', 'PKT', '4', '3.88', 'Huawei Based On Purchase Orders 1231.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1166, 'XAD000771', '2023-03-08', 'I lugs 2.5mm', 'Smooth Solution building Materails Trading LLC', 'PKT', '3', '2.91', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1167, 'XAD000771', '2023-03-17', 'I lugs 2.5mm', 'Wenzhou Zhechi', 'PKT', '1.02', '0.9894', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1168, 'XAD000771', '2023-03-30', 'I lugs 2.5mm', 'Ali Asghar Hussani', 'PKT', '3', '2.91', 'Request No : Adwea-168-18-03-2023 . Based On Purchase Orders 1991.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1169, 'XAD000771', '2023-04-03', 'I lugs 2.5mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '3', '2.91', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1170, 'XAD000772', '2024-01-29', 'Safety Vest with Du Logo', 'Emporium Gulf', 'PCS', '13', '12.61', 'Safety Vest Request From Huawei Proejct Based On Purchase Orders 3927.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1171, 'XAD000772', '2024-02-19', 'Safety Vest with Du Logo', 'Sahara Garments Embroidery', 'PCS', '9', '8.73', 'REQUEST NO : 298 Based On Purchase Orders 4062.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1172, 'XAD000774', '2022-04-08', 'Wall Mountain Pole ( with step clamp set)', 'AERO TRading LLC', 'PCS', '738', '715.86', 'PO-3745-Huawei Based On Purchase Orders 55. GRN-08-04-001', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1173, 'XAD000776', '2023-02-22', 'JRC 4 Frame cover with Accessories', 'Cendhurr Telecom LLC', 'PCS', '450', '436.5', 'Request No : AUH-OLT-0009-10-02-2023. Based On Purchase Orders 1742.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1174, 'XAD000776', '2024-01-03', 'JRC 4 Frame cover with Accessories', 'Frontier Innovation General Trading', 'PCS', '410', '397.7', 'REQUEST NO 296 WR 101H PROJECT Based On Purchase Orders 3718.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1175, 'XAD000776', '2024-02-23', 'JRC 4 Frame cover with Accessories', 'Elfit Arabia', 'PCS', '410', '397.7', 'REQUEST NO : AAN-2024-108  AAN REGION Based On Purchase Orders 4152.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1176, 'XAD000778', '2022-05-25', 'PVC Glands 21mm', 'Noor Al Iman', 'PCS', '1.5', '1.455', 'Huawei Mobile Project Based On Purchase Orders 145. INV# 0848,0849,850', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1177, 'XAD000778', '2022-09-14', 'PVC Glands 21mm', 'Wenzhou Zhechi', 'PCS', '0.21', '0.2037', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1178, 'XAD000778', '2022-11-05', 'PVC Glands 21mm', 'Ali Asghar Hussani', 'PCS', '0.6', '0.582', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1081.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1179, 'XAD000780', '2022-11-18', 'TP Link - TL-MR3020', 'Azlan Star Technologies LLC', 'PCS', '65', '63.05', 'Based On Purchase Orders 1267.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1180, 'XAD000780', '2023-12-05', 'TP Link - TL-MR3020', 'DSR Tech Computer Trading LLC', 'PCS', '58', '56.26', 'TP LINK DEVICE FOR HUAWEI KSA Based On Purchase Orders 3633.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1181, 'XAD000781', '2023-10-27', 'ODF 12 Port ( Patch Pannel )', 'The Mark Infotech System Solutions LLC', 'PCS', '28', '27.16', 'Request No : XAD-HW-Oct-DCB-0098 - 27-Oct-2023 . Based On Purchase Orders 3365.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1182, 'XAD000781', '2023-11-06', 'ODF 12 Port ( Patch Pannel )', 'Auto Computer Trading LLC', 'PCS', '29', '28.13', 'Request No : XAD-HW-Sep-DXB-119 Based On Purchase Orders 3173.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1183, 'XAD000782', '2022-12-29', 'Patch Cord 10M LC - LC UPC Duplex', 'Azlan Star Technologies LLC', 'PCS', '16', '15.52', 'Based On Purchase Orders 1451.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1184, 'XAD000782', '2023-12-06', 'Patch Cord 10M LC - LC UPC Duplex', 'The Mark Infotech System Solutions LLC', 'PCS', '18', '17.46', 'NOKIA Spliciling Materials Request Based On Purchase Orders 3576.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1185, 'XAD000785', '2022-04-09', 'Patch Cord 30M SC APC-LC UPC', 'Cash', 'PCS', '60', '58.2', 'GRN: 9-04-023 LPO 50/3774 Requested by: Rashid Ahmad Verified By : Sohail Abbas Prepared By : Wahab Aslam Based On Purchase Orders 50.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1186, 'XAD000787', '2023-02-09', 'PVC Duct Pipe D-54 X 6M', 'MITTCO Llc', 'PCS', '37.5', '36.375', 'Based On Purchase Orders 1682.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1187, 'XAD000787', '2024-02-03', 'PVC Duct Pipe D-54 X 6M', 'Frontier Innovation General Trading', 'PCS', '33.5', '32.495', 'WR 101H PROJECT Based On Purchase Orders 3766.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1188, 'XAD000787', '2024-02-19', 'PVC Duct Pipe D-54 X 6M', 'Power Plastic Factory LLC', 'PCS', '32.5', '31.525', 'REQUEST NO 310  WESTERN REGION Based On Purchase Orders 4093.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1189, 'XAD000790', '2023-08-14', 'Main Door Sticker', 'Noor Al Iman', 'PCS', '15', '14.55', 'Consumable Quality Material Required For Nokia Mobile Project . Based On Purchase Orders 2954.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1190, 'XAD000793', '2022-02-26', 'Cable Tie 250mm White', 'Noor Al Iman Elect & Hardware TR', 'PKT', '7', '6.79', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1191, 'XAD000793', '2022-03-08', 'Cable Tie 250mm White', 'Wenzhou Zhechi', 'PKT', '2.32', '2.2504', 'Material purchase from China for DU SFAN Based On Purchase Orders 355.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1192, 'XAD000793', '2023-12-27', 'Cable Tie 250mm White', 'Ali Asghar Hussani', 'PKT', '5', '4.85', 'Based On Purchase Orders 3736.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1193, 'XAD000794', '2024-01-09', 'Cable Tie 1000mm Black', 'Ali Asghar Hussani', 'PKT', '85', '82.45', 'REQUEST NO 1 OSP LMP PROJECT Based On Purchase Orders 3816.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1194, 'XAD000795', '2022-07-07', 'Cable Tie 1000mm Black', 'Noor Al Iman', 'PCS', '30', '29.1', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1195, 'XAD000797', '2023-02-16', 'Main breaker 63A 3Pole', 'Ali Asghar Hussani', 'PCS', '80', '77.6', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1706.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1196, 'XAD000797', '2023-05-24', 'Main breaker 63A 3Pole', 'Smooth Solution building Materails Trading LLC', 'PCS', '66.5', '64.505', 'Request No : XAD -HW - May - DXB-099 Based On Purchase Orders 2366.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1197, 'XAD000797', '2023-11-27', 'Main breaker 63A 3Pole', 'Noor Al Iman', 'PCS', '75', '72.75', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1198, 'XAD000798', '2023-05-24', 'RJ11 Connector', 'Smooth Solution building Materails Trading LLC', 'PKT', '200', '194', 'Request No : OSP-07-09-05-2023 . Based On Purchase Orders 2391.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1199, 'XAD000798', '2023-06-26', 'RJ11 Connector', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '105', '101.85', 'Request No : OSP-LMP-13-AUH-DXB-NE Based On Purchase Orders 2629.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1200, 'XAD000799', '2023-03-27', 'Chemical Bolt 10mm', 'Noor Al Iman', 'PCS', '7', '6.79', 'Request No : XAD-HW-Jan-DXB-093 - 17-03-2023 Based On Purchase Orders 1956.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1201, 'XAD000799', '2023-06-14', 'Chemical Bolt 10mm', 'Ali Asghar Hussani', 'PCS', '6.5', '6.305', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2522. Based On Goods Receipt PO 1053.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1202, 'XAD000806', '2023-11-27', 'Main breaker 40A 3 pole', 'Noor Al Iman', 'PCS', '65', '63.05', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1203, 'XAD000807', '2023-05-30', 'MCB breaker 63A 3 pole', 'Noor Al Iman', 'PCS', '63', '61.11', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2336.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1204, 'XAD000808', '2022-06-17', 'Fiber Connector LC-LC', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Nokia Based On Purchase Orders 205.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1205, 'XAD000809', '2024-02-22', 'GI Trunking 100 x 100', 'Noor Al Iman', 'PCS', '36', '34.92', 'REQUEST NO : XAD-HW-FEB-DXB-100 Based On Purchase Orders 4143.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1206, 'XAD000810', '2022-01-10', 'Rapid Clamp', 'Ali Asghar Hussani', 'PCS', '2', '1.94', 'GRN : 10-01-016 Project: L&T Etihad Rail Based On Purchase Orders 3410.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1207, 'XAD000812', '2022-01-06', 'Cleaver Blade Fujikura CB-07', 'Frontier Innovation General Trading', 'PCS', '450', '436.5', 'GRN : 06-01-017 Project: 101 H WR Based On Purchase Orders 3420', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1208, 'XAD000812', '2023-06-09', 'Cleaver Blade Fujikura CB-07', 'MITTCO Llc', 'PCS', '292.83', '284.0451', 'Request No : WR-101H-265. Based On Purchase Orders 2490.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1209, 'XAD000813', '2022-02-10', 'Uniform Dress Shirt ( Fire Retardent ) Royal Blue with logo Xad & Etisalat  - XXXL', 'Frontier Innovation General Trading', 'PCS', '58.9', '57.133', 'PO    : 3539 Project: 101H WR Based On Purchase Orders 110.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1210, 'XAD000814', '2022-01-15', 'Cleaver Blade China', 'APKR Networking Zone', 'PCS', '90', '87.3', 'GRN : 15-01-021 Project 101 WR Based On Purchase Orders : 3420', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1211, 'XAD000819', '2022-05-12', 'Level Hose ( Pipe) 6mm', 'Ali Asghar Hussani', 'MTR', '6', '5.82', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1212, 'XAD000820', '2022-01-26', 'Cable tray channel 41x41mm ( C Channel )', 'Noor Al Iman Elect & Hardware TR', 'PCS', '20', '19.4', 'GRN : 26-01-045', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1213, 'XAD000821', '2023-01-21', 'Flexible Pipe 25mm White', 'Noor Al Iman', 'Roll', '19', '18.43', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1214, 'XAD000821', '2023-02-16', 'Flexible Pipe 25mm White', 'Smooth Solution building Materails Trading LLC', 'Roll', '15', '14.55', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1672.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1215, 'XAD000821', '2023-06-26', 'Flexible Pipe 25mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '10', '9.7', 'Request No : OSP-LMP-13-AUH-DXB-NE Based On Purchase Orders 2629.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1216, 'XAD000821', '2024-01-09', 'Flexible Pipe 25mm White', 'Ali Asghar Hussani', 'Roll', '14', '13.58', 'REQUEST NO 1 OSP LMP PROJECT Based On Purchase Orders 3816.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1217, 'XAD000822', '2022-04-20', 'Gypsum Puring Saw', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'GRN :01-02-002 Project: DU SFAN Based On Purchase Orders:3519', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1218, 'XAD000823', '2022-04-20', 'Wall Scraper 4 \"', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'GRN :01-02-002 Project: DU SFAN Based On Purchase Orders:3519', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1219, 'XAD000824', '2022-04-20', 'Paint Refill', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'GRN :01-02-002 Project: DU SFAN Based On Purchase Orders:3519', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1220, 'XAD000825', '2022-01-01', 'Steel Rod 8mm (6 mtr)', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'GRN : 01-02-003 Project: L&T Etihad Rail Based On Purchase Orders: 3513', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1221, 'XAD000827', '2022-09-09', 'Electrode for Splicing Machine', 'Alpha Link Technologies LLC', 'PCS', '360', '349.2', 'Project : AAN OLT Requested By \" Sufian Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 578.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1222, 'XAD000827', '2024-01-08', 'Electrode for Splicing Machine', 'MITTCO Llc', 'PCS', '285.71', '277.1387', 'Electrode For 101-H Project  ELECTRODE 90R Based On Purchase Orders 3842.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1223, 'XAD000828', '2023-03-09', 'Stretch Films Wrapping Rolls', 'Noor Al Iman', 'Roll', '12.5', '12.125', 'Packing Material Required For Dismantle Packing logistic Department . Based On Purchase Orders 1883.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1224, 'XAD000828', '2023-05-17', 'Stretch Films Wrapping Rolls', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '15', '14.55', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2334.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1225, 'XAD000828', '2023-06-14', 'Stretch Films Wrapping Rolls', 'Ali Asghar Hussani', 'Roll', '9', '8.73', 'Request No : XAD-HW-June-DXB-105 Based On Purchase Orders 2536.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1226, 'XAD000829', '2022-08-09', 'Warning Tap With Etisalat logo', 'kangaroo Plastic Miiddle East LLC', 'Roll', '150', '145.5', 'Project : Etihad Rail  Requested By : Rafaqat Mehmood  Prepared By : Raja M zeeshan Based On Purchase Orders 438.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1227, 'XAD000829', '2023-12-15', 'Warning Tap With Etisalat logo', 'Elfit Arabia', 'Roll', '72', '69.84', 'Request No 098 WR 101H Based On Purchase Orders 3654.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1228, 'XAD000829', '2024-02-20', 'Warning Tap With Etisalat logo', 'Frontier Innovation General Trading', 'Roll', '69', '66.93', 'REQUEST NO 310 WR 101 H PROJECT Based On Purchase Orders 4089.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1229, 'XAD000831', '2023-01-28', 'White Cement', 'MAA ALMADINA BUILDING MATERIAL', 'Box', '25', '24.25', 'Request No : Etihad Rail L&T-4-DXB-Jan-2023 Based On Purchase Orders 1588.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1230, 'XAD000831', '2023-07-31', 'White Cement', 'Ali Asghar Hussani', 'Box', '1.5', '1.455', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1231, 'XAD000832', '2022-11-30', 'Uniform T shirt for Logistic Team- M', 'Emporium Gulf', 'PCS', '24', '23.28', 'New Shirt\'s For Warehouse Logistics Team  Requested By : Muhammad Shahab Verified By      : Wahab Aslam Based On Purchase Orders 1135.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1232, 'XAD000833', '2022-11-30', 'Uniform T shirt for Logistic Team- L', 'Emporium Gulf', 'PCS', '24', '23.28', 'New Shirt\'s For Warehouse Logistics Team  Requested By : Muhammad Shahab Verified By      : Wahab Aslam Based On Purchase Orders 1135.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1233, 'XAD000834', '2022-11-30', 'Uniform T shirt for Logistic Team- XL', 'Emporium Gulf', 'PKT', '24', '23.28', 'New Shirt\'s For Warehouse Logistics Team  Requested By : Muhammad Shahab Verified By      : Wahab Aslam Based On Purchase Orders 1135.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1234, 'XAD000835', '2022-11-30', 'Uniform T shirt for Logistic Team- XXL', 'Emporium Gulf', 'PKT', '24', '23.28', 'New Shirt\'s For Warehouse Logistics Team  Requested By : Muhammad Shahab Verified By      : Wahab Aslam Based On Purchase Orders 1135.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1235, 'XAD000836', '2022-05-13', 'I Lugs 8mm', 'Ali Asghar Hussani', 'PKT', '6', '5.82', 'Adwea Based On Purchase Orders 117.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1236, 'XAD000836', '2022-07-29', 'I Lugs 8mm', 'Noor Al Iman', 'PKT', '6', '5.82', 'Huawei Mobile Project Based On Purchase Orders 383.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1237, 'XAD000836', '2022-11-19', 'I Lugs 8mm', 'Ali Asghar Hussani', 'PKT', '6', '5.82', 'Based On Purchase Orders 1230.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1238, 'XAD000837', '2022-02-26', 'Cat 6 Orange cable', 'Noor Al Iman Elect & Hardware TR', 'MTR', '1.85', '1.7945', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1239, 'XAD000837', '2024-01-15', 'Cat 6 Orange cable', 'FIBER LINK COMPUTER TRADING LLC', 'MTR', '0.97', '0.9409', 'CAT 6 Cable For NOKIA Project Based On Purchase Orders 3862.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1240, 'XAD000838', '2022-11-02', 'Lugs Crimping Tool', 'Smooth Solution building Materails Trading LLC', 'PCS', '25', '24.25', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1015.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1241, 'XAD000838', '2023-02-14', 'Lugs Crimping Tool', 'Noor Al Iman', 'PCS', '45', '43.65', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1696.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1242, 'XAD000838', '2023-05-24', 'Lugs Crimping Tool', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2311.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1243, 'XAD000838', '2023-10-02', 'Lugs Crimping Tool', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '45', '43.65', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1244, 'XAD000839', '2022-02-26', 'Tightner Bit ( Screw Driver type )', 'Noor Al Iman Elect & Hardware TR', 'PCS', '2', '1.94', 'PO-3618-Du SFAN Based On Purchase Orders 4.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1245, 'XAD000839', '2022-11-28', 'Tightner Bit ( Screw Driver type )', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.5', '2.425', 'Requiest No : ADWEA-101-AUH Based On Purchase Orders 1283.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1246, 'XAD000839', '2023-01-23', 'Tightner Bit ( Screw Driver type )', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '3.5', '3.395', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1247, 'XAD000839', '2023-05-19', 'Tightner Bit ( Screw Driver type )', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.25', '2.1825', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1248, 'XAD000839', '2023-10-02', 'Tightner Bit ( Screw Driver type )', 'Ali Asghar Hussani', 'PCS', '2', '1.94', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3111.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1249, 'XAD000840', '2022-03-05', '24 Port Patch Panel empty (black)', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'GRN      :28-03-016 Project: Huawei SS IBS Based On Purchase Orders: 3641', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1250, 'XAD000840', '2023-02-11', '24 Port Patch Panel empty (black)', 'Azlan Star Technologies LLC', 'PCS', '28', '27.16', 'Based On Purchase Orders 1702.', '2024-10-09 03:56:57', '2024-10-09 03:56:57'),
(1251, 'XAD000841', '2023-01-11', 'Labeling Cartridge Black & White 12mm (China)', 'Aimo Graphics Company Limited', 'PCS', '3.3', '3.201', 'Labeling Cartridge Purchase From China For Adwea & DU SFAN Based On Purchase Orders 1185.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1252, 'XAD000842', '2022-03-23', 'ETI Fuse 100A', 'Noor Al Iman Elect & Hardware TR', 'PCS', '25', '24.25', 'GRN  :28-03-018 Project : Huawei IBS 5G Based On Purchase Orders:3678', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1253, 'XAD000843', '2022-03-23', 'ETI Fuse 63A', 'Noor Al Iman Elect & Hardware TR', 'PCS', '15', '14.55', 'GRN  :28-03-018 Project : Huawei IBS 5G Based On Purchase Orders:3678', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1254, 'XAD000845', '2022-08-18', 'Polythene  Sheet 500G', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '16', '15.52', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1255, 'XAD000845', '2023-05-24', 'Polythene  Sheet 500G', 'Ali Asghar Hussani', 'Roll', '15', '14.55', 'Request No : OSP-07-10-05-2023 . Based On Purchase Orders 2344.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1256, 'XAD000845', '2023-10-06', 'Polythene  Sheet 500G', 'Al Moazam Stores LLC', 'Roll', '15', '14.55', 'Request No : AAN-Sept-23-0083. Based On Purchase Orders 3213.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1257, 'XAD000845', '2023-10-18', 'Polythene  Sheet 500G', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '20', '19.4', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3327.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1258, 'XAD000846', '2022-06-22', 'Head Light Rechargeable', 'Ali Asghar Hussani', 'PCS', '30', '29.1', 'Huawei Mobile Project Based On Purchase Orders 239.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1259, 'XAD000846', '2022-07-29', 'Head Light Rechargeable', 'Noor Al Iman', 'PCS', '25', '24.25', 'Huawei Mobile Project Based On Purchase Orders 383.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1260, 'XAD000846', '2022-08-12', 'Head Light Rechargeable', 'Smooth Solution building Materails Trading LLC', 'PCS', '25', '24.25', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1261, 'XAD000846', '2023-04-01', 'Head Light Rechargeable', 'Ali Asghar Hussani', 'PCS', '30', '29.1', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2007.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1262, 'XAD000847', '2023-03-08', 'Clamp Meter Hioki', 'Noor Al Iman', 'PCS', '65', '63.05', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1848.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1263, 'XAD000847', '2023-07-31', 'Clamp Meter Hioki', 'Ali Asghar Hussani', 'PCS', '170', '164.9', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1264, 'XAD000848', '2023-03-18', 'Long Nose Plier 8\'\'', 'Noor Al Iman', 'PCS', '12', '11.64', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1265, 'XAD000848', '2023-03-29', 'Long Nose Plier 8\'\'', 'The Mark Infotech System Solutions LLC', 'PCS', '15', '14.55', 'Request No : DU TCS - 04-03-2023 .  Tool Required For New Field Staff For DU TCS Project . Based On Purchase Orders 1998.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1266, 'XAD000848', '2023-04-28', 'Long Nose Plier 8\'\'', 'Smooth Solution building Materails Trading LLC', 'PCS', '23', '22.31', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1267, 'XAD000848', '2023-12-27', 'Long Nose Plier 8\'\'', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1268, 'XAD000849', '2022-03-31', 'Bus Bar Bolt', 'Noor Al Iman Elect & Hardware TR', 'PCS', '0.5', '0.485', 'GRN :   31-03-027 Project : Nokia TI & OD Based On Purchase Orders 3707', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1269, 'XAD000850', '2022-04-01', 'Naylon Cable Puller 50Mtr', 'Ali Asghar Hussani', 'PCS', '75', '72.75', 'GRN  :  31-03-028 Project  :  DU SFAN Based On Purchase Orders 3712', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1270, 'XAD000851', '2022-06-04', 'Aluminium Ladder Multi 4x5', 'Noor Al Iman', 'PCS', '260', '252.2', 'Project : ADWEA Based On Purchase Orders 186.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1271, 'XAD000851', '2022-12-19', 'Aluminium Ladder Multi 4x5', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '410', '397.7', 'Request no : DU SFAN-88-Dec Based On Purchase Orders 1403.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1272, 'XAD000851', '2023-04-24', 'Aluminium Ladder Multi 4x5', 'Smooth Solution building Materails Trading LLC', 'PCS', '320', '310.4', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1273, 'XAD000851', '2023-12-16', 'Aluminium Ladder Multi 4x5', 'Ali Asghar Hussani', 'PCS', '320', '310.4', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1274, 'XAD000852', '2022-03-31', 'Backpack (Camp Hold)', 'Fas Arabia llc', 'PCS', '170', '164.9', 'GRN : 31-03-031 Project: Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1275, 'XAD000853', '2022-03-31', 'Wrench 18\'\'', 'Ali Asghar Hussani', 'PCS', '60', '58.2', 'GRN  :31-03-033 Project: Nokia TI & OD Based On Purchase Orders: 3684', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1276, 'XAD000854', '2022-04-04', 'Camera Huawei 360 Panarmic VR- 3D', 'Al Fayaz Gen Trading', 'PCS', '142.86', '138.5742', 'PO-3745- Huawei Mobile Project Based On Purchase Orders 56. GRN-02-04-002', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1277, 'XAD000855', '2022-04-08', 'Straight Section, W240*H100*L1000mm', 'Topwell Tech Shanghai', 'PCS', '69', '66.93', 'Prepared by Wahab Aslam LPO-3761 Based On Purchase Orders 1253.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1278, 'XAD000856', '2022-04-08', '240 Connector B kit', 'Topwell Tech Shanghai', 'SET', '47.35', '45.9295', 'Prepared by Wahab Aslam LPO-3761 Based On Purchase Orders 1253.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1279, 'XAD000857', '2022-04-08', '240 Horizontal Tee', 'Topwell Tech Shanghai', 'PCS', '56.43', '54.7371', 'Prepared by Wahab Aslam LPO-3761 Based On Purchase Orders 1253.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1280, 'XAD000858', '2022-04-08', '240 45° Up Elbow', 'Topwell Tech Shanghai', 'PCS', '57.43', '55.7071', 'Prepared by Wahab Aslam LPO-3761 Based On Purchase Orders 1253.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1281, 'XAD000859', '2022-04-08', '240 45° Down Elbow', 'Topwell Tech Shanghai', 'PCS', '56.5', '54.805', 'Prepared by Wahab Aslam LPO-3761 Based On Purchase Orders 1253.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1282, 'XAD000860', '2022-04-08', '240mm trumpet exit', 'Topwell Tech Shanghai', 'SET', '45.67', '44.2999', 'Prepared by Wahab Aslam LPO-3761 Based On Purchase Orders 1253.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1283, 'XAD000861', '2022-10-12', 'Beldon Cable Model 9740', 'AL Mazroui - ICAS L.L.C', 'MTR', '3.85', '3.7345', 'Request No ADWEA 76 Requested By : Screenath CK  Verified By : Wasiullah Khan Based On Purchase Orders 751.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1284, 'XAD000861', '2023-01-17', 'Beldon Cable Model 9740', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '5.16', '5.0052', 'Request No : Adwea-112-December Based On Purchase Orders 1485.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1285, 'XAD000862', '2022-04-11', 'Access Pannel 40x40', 'Ali Asghar Hussani', 'PCS', '42', '40.74', 'PO-3742-Huawei - IBS 5G Based On Purchase Orders 57. GRN-07-04-003', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1286, 'XAD000863', '2022-04-09', 'Uniform Polo Shirt Gray with Etisalat and Xad Logo S', 'Emporium Gulf', 'PCS', '24', '23.28', 'PO_3726-101 WR Based On Purchase Orders 60. GRN-09-04-006', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1287, 'XAD000864', '2022-04-09', 'Uniform Polo Shirt Gray with Etisalat and Xad Logo 3XL', 'Emporium Gulf', 'PCS', '24', '23.28', 'PO_3726-101 WR Based On Purchase Orders 60. GRN-09-04-006', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1288, 'XAD000865', '2023-06-13', 'Cleaver Blade CT50 Fujikura', 'MITTCO Llc', 'PCS', '291.67', '282.9199', 'Request No : AAN-June-23-0053 . Based On Purchase Orders 2491.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1289, 'XAD000866', '2022-03-29', 'Switch Isolator 45A', 'Noor Al Iman Elect & Hardware TR', 'PCS', '75', '72.75', 'PO_3739-Huawei IBS Based On Purchase Orders 64. GRN-29-03-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1290, 'XAD0008667', '2022-07-14', 'Beldon Cable Model 9729', 'AL Mazroui - ICAS L.L.C', 'Roll', '2560.9', '2484.073', 'Adwea Based On Purchase Orders 228.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1291, 'XAD0008668', '2022-05-05', 'Beldon Cable Model 3105A', 'AL Mazroui - ICAS L.L.C', 'Roll', '3530', '3424.1', 'Based On Purchase Orders 89. Project: ADWEA', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1292, 'XAD0008669', '2022-08-13', 'MCB breaker ABB 6A', 'Noor Al Iman', 'PCS', '12', '11.64', 'Based On Purchase Orders 463.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1293, 'XAD0008669', '2022-11-30', 'MCB breaker ABB 6A', 'Ali Asghar Hussani', 'PCS', '9.5', '9.215', 'Request No : ADWEA-105-Nov-2022 Based On Purchase Orders 1341.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1294, 'XAD0008669', '2023-03-07', 'MCB breaker ABB 6A', 'Securintec Information Technology LLC', 'PCS', '4', '3.88', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1295, 'XAD0008669', '2023-04-12', 'MCB breaker ABB 6A', 'Smooth Solution building Materails Trading LLC', 'PCS', '7.5', '7.275', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1296, 'XAD000867', '2023-02-14', 'PVC Bend 25mm Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '2', '1.94', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1297, 'XAD000867', '2023-03-02', 'PVC Bend 25mm Black', 'Noor Al Iman', 'PCS', '2.8', '2.716', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1298, 'XAD000867', '2023-04-20', 'PVC Bend 25mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.1', '2.037', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2158.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1299, 'XAD000867', '2024-01-09', 'PVC Bend 25mm Black', 'Ali Asghar Hussani', 'PCS', '3.5', '3.395', 'REQUEST NO OSP LMP 2 Based On Purchase Orders 3830.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1300, 'XAD0008670', '2022-04-11', 'I Lugs 1mm', 'Noor Al Iman', 'PKT', '5', '4.85', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1301, 'XAD0008671', '2022-10-10', 'I Lugs 1.5mm', 'Noor Al Iman', 'PKT', '3', '2.91', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1302, 'XAD0008671', '2023-03-08', 'I Lugs 1.5mm', 'Smooth Solution building Materails Trading LLC', 'PKT', '3.2', '3.104', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1303, 'XAD0008671', '2023-03-17', 'I Lugs 1.5mm', 'Wenzhou Zhechi', 'PKT', '1.22', '1.1834', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1304, 'XAD0008671', '2023-03-30', 'I Lugs 1.5mm', 'Ali Asghar Hussani', 'PKT', '2', '1.94', 'Request No : Adwea-168-18-03-2023 . Based On Purchase Orders 1991.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1305, 'XAD0008671', '2023-04-03', 'I Lugs 1.5mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '2.5', '2.425', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1306, 'XAD000868', '2023-02-14', 'PVC Coupler 25mm Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.25', '0.2425', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1307, 'XAD000868', '2023-03-02', 'PVC Coupler 25mm Black', 'Noor Al Iman', 'PCS', '0.6', '0.582', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1308, 'XAD000868', '2023-03-17', 'PVC Coupler 25mm Black', 'Wenzhou Zhechi', 'PCS', '0.12', '0.1164', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1309, 'XAD000868', '2023-04-20', 'PVC Coupler 25mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.4', '0.388', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2158.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1310, 'XAD000868', '2023-05-18', 'PVC Coupler 25mm Black', 'Ali Asghar Hussani', 'PCS', '0.4', '0.388', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2306. Based On Goods Receipt PO 948.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1311, 'XAD000869', '2023-02-10', 'Male and Female Adaptor 25mm black', 'Ali Asghar Hussani', 'PCS', '0.45', '0.4365', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1312, 'XAD000869', '2023-02-14', 'Male and Female Adaptor 25mm black', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.35', '0.3395', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1313, 'XAD000869', '2023-03-02', 'Male and Female Adaptor 25mm black', 'Noor Al Iman', 'PCS', '0.84', '0.8148', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1314, 'XAD000869', '2023-03-07', 'Male and Female Adaptor 25mm black', 'Securintec Information Technology LLC', 'PCS', '0.35', '0.3395', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1315, 'XAD000869', '2023-03-08', 'Male and Female Adaptor 25mm black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.55', '0.5335', 'Request No : SmartHome-Xad-008-009-010- Dubai - Al Ain - Abu Dhabi - 27-02-2023 Based On Purchase Orders 1861.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1316, 'XAD000869', '2023-03-17', 'Male and Female Adaptor 25mm black', 'Wenzhou Zhechi', 'PCS', '0.16', '0.1552', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1317, 'XAD000871', '2022-10-13', 'Junction Box4 ways (For 25mm) Black', 'Ali Asghar Hussani', 'PCS', '2.6', '2.522', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 778.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1318, 'XAD000871', '2023-02-14', 'Junction Box4 ways (For 25mm) Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1319, 'XAD000871', '2023-03-02', 'Junction Box4 ways (For 25mm) Black', 'Noor Al Iman', 'PCS', '3', '2.91', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1320, 'XAD000872', '2022-10-04', 'Trunking 50mm x 50mm end Cap', 'Noor Al Iman', 'PCS', '2', '1.94', 'Request No : ADWEA 67 & 65 & 71 Requested By : Screenth CK  Verified By : Wasiullah Khan & Badiurreman Based On Purchase Orders 638.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1321, 'XAD000872', '2023-01-26', 'Trunking 50mm x 50mm end Cap', 'Ali Asghar Hussani', 'PCS', '1.2', '1.164', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1322, 'XAD000873', '2022-04-11', 'Trunking 16mm x 25mm', 'Noor Al Iman', 'PCS', '18', '17.46', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1323, 'XAD000873', '2023-01-03', 'Trunking 16mm x 25mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '7.5', '7.275', 'Request No : AAN-101H-139 Based On Purchase Orders 1439.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1324, 'XAD000873', '2023-05-09', 'Trunking 16mm x 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '6.5', '6.305', 'Request No : OSP-07-09-05-2023 . Based On Purchase Orders 2294.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1325, 'XAD000873', '2023-06-21', 'Trunking 16mm x 25mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '5.2', '5.044', 'Request No : XAD-0013 Based On Purchase Orders 2580.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1326, 'XAD000873', '2023-09-27', 'Trunking 16mm x 25mm', 'Cash', 'PCS', '8', '7.76', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1327, 'XAD000873', '2024-01-09', 'Trunking 16mm x 25mm', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'REQUEST NO OSP LMP 2 Based On Purchase Orders 3830.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1328, 'XAD000874', '2022-04-11', 'Trunking 16mm x 25mm end Cap', 'Noor Al Iman', 'PCS', '0.6', '0.582', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1329, 'XAD000875', '2022-04-11', 'Saddle 25mm Black', 'Noor Al Iman', 'PCS', '45', '43.65', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1330, 'XAD000875', '2023-01-05', 'Saddle 25mm Black', 'Ali Asghar Hussani', 'PCS', '0.75', '0.7275', 'Request No : ADWEA-106-AUH Based On Purchase Orders 1382.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1331, 'XAD000875', '2023-02-14', 'Saddle 25mm Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.3', '0.291', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1332, 'XAD000875', '2023-03-17', 'Saddle 25mm Black', 'Wenzhou Zhechi', 'PCS', '0.14', '0.1358', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1333, 'XAD000876', '2023-03-02', 'Din Rail', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1334, 'XAD000876', '2023-03-30', 'Din Rail', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Request No : Adwea-168-18-03-2023 . Based On Purchase Orders 1991.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1335, 'XAD000876', '2023-04-12', 'Din Rail', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1336, 'XAD000877', '2022-07-07', 'Junction Box IP 65', 'Noor Al Iman', 'PCS', '15', '14.55', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1337, 'XAD000877', '2023-02-03', 'Junction Box IP 65', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1654.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1338, 'XAD000877', '2023-02-17', 'Junction Box IP 65', 'Ali Asghar Hussani', 'PCS', '7.5', '7.275', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1688.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1339, 'XAD000877', '2023-03-17', 'Junction Box IP 65', 'Wenzhou Zhechi', 'PCS', '4.56', '4.4232', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1340, 'XAD000878', '2022-08-29', 'Silicon Fire Sealent', 'Noor Al Iman', 'PCS', '336', '325.92', 'Project : Nokia  Requested By : Muhammad Talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 516.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1341, 'XAD000878', '2022-09-21', 'Silicon Fire Sealent', 'Smooth Solution building Materails Trading LLC', 'PCS', '50', '48.5', 'Request No : DU SFAN Sep-2022 ( 60 ) Based On Purchase Orders 634.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1342, 'XAD000878', '2023-09-20', 'Silicon Fire Sealent', 'Ali Asghar Hussani', 'PCS', '13', '12.61', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1343, 'XAD000879', '2022-04-11', 'Terminal-Lugs (8mm x 4mm)', 'Noor Al Iman', 'PKT', '25', '24.25', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1344, 'XAD000879', '2022-06-24', 'Terminal-Lugs (8mm x 4mm)', 'Ali Asghar Hussani', 'PKT', '1.3', '1.261', 'Adwea Based On Purchase Orders 237.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1345, 'XAD000880', '2022-04-11', 'Terminal-Lugs (8mm x 35mm)', 'Noor Al Iman', 'PKT', '90', '87.3', 'GRN : 11-04-015  Based On Purchase Orders 73.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1346, 'XAD000881', '2022-05-30', 'Terminal Blocks 6 mm', 'Noor Al Iman', 'PCS', '3.5', '3.395', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1347, 'XAD000881', '2023-03-17', 'Terminal Blocks 6 mm', 'Wenzhou Zhechi', 'PCS', '0.73', '0.7081', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1348, 'XAD000881', '2023-03-30', 'Terminal Blocks 6 mm', 'Ali Asghar Hussani', 'PCS', '0.9', '0.873', 'Request No : Adwea-170-21-03-2023 Based On Purchase Orders 1960.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1349, 'XAD000881', '2023-04-12', 'Terminal Blocks 6 mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.9', '0.873', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1350, 'XAD000882', '2022-05-30', 'End Stopper', 'Noor Al Iman', 'PCS', '4', '3.88', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1351, 'XAD000882', '2023-03-17', 'End Stopper', 'Wenzhou Zhechi', 'PCS', '0.11', '0.1067', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1352, 'XAD000882', '2023-03-30', 'End Stopper', 'Ali Asghar Hussani', 'PCS', '0.45', '0.4365', 'Request No : Adwea-170-21-03-2023 Based On Purchase Orders 1960.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1353, 'XAD000882', '2023-04-12', 'End Stopper', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.5', '0.485', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1354, 'XAD000885', '2022-09-16', 'Labeling Cartridge for Tube Printer ( Ink Ribbon )', 'Fas Arabia llc', 'PCS', '85', '82.45', 'Request No : ADWEA 65 Based On Purchase Orders 631.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1355, 'XAD000885', '2023-08-24', 'Labeling Cartridge for Tube Printer ( Ink Ribbon )', 'M S K Corporate Services Provides EST', 'PCS', '195', '189.15', 'Ribbon Cartridge Required For Card Printer Machine For OSP-LMP Project Staff Card Printing Purpose . Based On Purchase Orders 3054.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1356, 'XAD000887', '2022-09-16', 'PVC Tube White 6mm X 100M', 'Fas Arabia llc', 'Roll', '130', '126.1', 'Request No : ADWEA 65 Based On Purchase Orders 631.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1357, 'XAD000890', '2022-04-13', 'Flex sign with ring support 1.5m x 1.5m', 'MSK Corporate Services', 'PCS', '275', '266.75', 'GRN : 13-04-017 Project : Huawei Mobile Project Based On Purchase Orders:3782', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1358, 'XAD000892', '2023-12-27', 'Grinder Machine (Makita) 4.5\"', 'Ali Asghar Hussani', 'PCS', '240', '232.8', 'Carpentry Tool Request  Smart Home Project Based On Purchase Orders 3723.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1359, 'XAD000893', '2022-06-04', 'Drill Bit 8mm Concrete', 'Noor Al Iman', 'PCS', '8', '7.76', 'Project : ADWEA Based On Purchase Orders 186.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1360, 'XAD000893', '2023-03-08', 'Drill Bit 8mm Concrete', 'Smooth Solution building Materails Trading LLC', 'PCS', '5', '4.85', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1361, 'XAD000893', '2023-04-03', 'Drill Bit 8mm Concrete', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '6', '5.82', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1362, 'XAD000893', '2023-12-21', 'Drill Bit 8mm Concrete', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'REQUEST NO 11 ICT SCHOOL PROJECT Based On Purchase Orders 3690.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1363, 'XAD000894', '2022-06-17', 'Drill Bit 10mm concrete', 'Noor Al Iman', 'PCS', '7', '6.79', 'Adwea Project Based On Purchase Orders 211.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1364, 'XAD000894', '2023-09-02', 'Drill Bit 10mm concrete', 'Ali Asghar Hussani', 'PCS', '6', '5.82', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1365, 'XAD000895', '2022-12-27', 'Shock Resistant Face Shield', 'Smooth Solution building Materails Trading LLC', 'PCS', '25', '24.25', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1366, 'XAD000895', '2023-01-30', 'Shock Resistant Face Shield', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '25', '24.25', 'Request No : Adwea-113-Jan-2023. Based On Purchase Orders 1638.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1367, 'XAD000896', '2022-07-07', 'Hammer 2000G', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Adwea Based On Purchase Orders 272.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1368, 'XAD000897', '2022-12-27', 'Screw Driver - insulated 150mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1369, 'XAD000897', '2023-10-02', 'Screw Driver - insulated 150mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '10', '9.7', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1370, 'XAD000897', '2023-11-13', 'Screw Driver - insulated 150mm', 'Ali Asghar Hussani', 'PCS', '5', '4.85', 'Request No : DU TCS Nov-2023  Hand Tool Required For 7th New Technician For DU TCS Project . Based On Purchase Orders 3472.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1371, 'XAD000898', '2022-05-12', 'Screw Driver + insulated 150mm', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1372, 'XAD000899', '2022-06-17', 'Extension lead 20 mtr', 'Ali Asghar Hussani', 'PCS', '82', '79.54', 'ADWEA Based On Purchase Orders 215.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1373, 'XAD000901', '2022-05-07', 'Patch Cord 1M simplex SC UPC-LC UPC', 'Ali Asghar Hussani', 'PKT', '3', '2.91', 'Based On Purchase Orders 108.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1374, 'XAD000903', '2022-05-12', 'Pulling spring 15M', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Adwea Based On Purchase Orders 88.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1375, 'XAD000903', '2022-05-26', 'Pulling spring 15M', 'Noor Al Iman', 'PCS', '12', '11.64', 'ADWEA Based On Purchase Orders 171.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1376, 'XAD000905', '2023-01-21', 'PVC Pipe White 25 mm', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1377, 'XAD000905', '2023-02-14', 'PVC Pipe White 25 mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '3.9', '3.783', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1378, 'XAD000905', '2023-12-29', 'PVC Pipe White 25 mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '5.3', '5.141', 'REQUEST XAD 005 NE DEC 23 Based On Purchase Orders 3757.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1379, 'XAD000905', '2024-01-05', 'PVC Pipe White 25 mm', 'Ali Asghar Hussani', 'PCS', '4.75', '4.6075', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1380, 'XAD000905', '2024-02-15', 'PVC Pipe White 25 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4.6', '4.462', 'REQUEST NO : SMART HOME-AAN-002-FEB\'24  AAN REGION Based On Purchase Orders 4083.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1381, 'XAD000906', '2022-04-27', 'Junction Box White 3 way (For 25mm)', 'Noor Al Iman', 'PCS', '3.25', '3.1525', 'Project Adwea Invice No: 0831 Based On Purchase Orders 96. GRN : 27-04-024', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1382, 'XAD000906', '2023-02-09', 'Junction Box White 3 way (For 25mm)', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '5', '4.85', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1692.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1383, 'XAD000907', '2022-06-04', 'PVC Coupler 25mm white', 'Noor Al Iman', 'PCS', '32', '31.04', 'Adwea Based On Purchase Orders 185.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1384, 'XAD000907', '2023-03-13', 'PVC Coupler 25mm white', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.6', '0.582', 'Request No : SmartHome-XAD-013-10-03-2023 Based On Purchase Orders 1903.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1385, 'XAD000907', '2023-03-17', 'PVC Coupler 25mm white', 'Wenzhou Zhechi', 'PCS', '1.25', '1.2125', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1386, 'XAD000907', '2023-12-27', 'PVC Coupler 25mm white', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.4', '0.388', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1387, 'XAD000907', '2024-01-25', 'PVC Coupler 25mm white', 'Ali Asghar Hussani', 'PCS', '0.4', '0.388', 'REQUEST NO XAD 002 DEC 23 Based On Purchase Orders 3961.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1388, 'XAD000908', '2022-07-07', 'Saddle 25mm white', 'Noor Al Iman', 'PCS', '0.9', '0.873', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1389, 'XAD000908', '2023-02-10', 'Saddle 25mm white', 'Ali Asghar Hussani', 'PCS', '0.55', '0.5335', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1390, 'XAD000908', '2023-02-27', 'Saddle 25mm white', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.68', '0.6596', 'Request No : Adwea-153-156-155- 24-02-2023 Based On Purchase Orders 1793.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1391, 'XAD000908', '2023-03-17', 'Saddle 25mm white', 'Wenzhou Zhechi', 'PCS', '0.15', '0.1455', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1392, 'XAD000908', '2023-04-20', 'Saddle 25mm white', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.75', '0.7275', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2158.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1393, 'XAD000910', '2022-06-04', 'PVC Bend 25mm white', 'Noor Al Iman', 'PCS', '3.2', '3.104', 'Adwea Based On Purchase Orders 185.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1394, 'XAD000910', '2023-02-14', 'PVC Bend 25mm white', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.5', '2.425', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1395, 'XAD000910', '2024-01-05', 'PVC Bend 25mm white', 'Ali Asghar Hussani', 'PCS', '3', '2.91', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1396, 'XAD000910', '2024-02-15', 'PVC Bend 25mm white', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.45', '2.3765', 'REQUEST NO : SMART HOME-AAN-002-FEB\'24  AAN REGION Based On Purchase Orders 4083.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1397, 'XAD000911', '2023-01-31', 'Pulling spring 30 M', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'Request No : XAD-003-004-005-Jan-2023 Based On Purchase Orders 1571.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1398, 'XAD000911', '2023-04-24', 'Pulling spring 30 M', 'Smooth Solution building Materails Trading LLC', 'PCS', '16', '15.52', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1399, 'XAD000912', '2023-04-24', 'Bending spring 25 mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1400, 'XAD000912', '2023-04-28', 'Bending spring 25 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '12', '11.64', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1401, 'XAD000912', '2023-12-16', 'Bending spring 25 mm', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1402, 'XAD000913', '2022-04-11', 'Wago Connector', 'Noor Al Iman', 'PCS', '2.25', '2.1825', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1403, 'XAD000913', '2022-05-13', 'Wago Connector', 'Ali Asghar Hussani', 'PCS', '2.5', '2.425', 'Adwea Based On Purchase Orders 117.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1404, 'XAD000914', '2022-04-11', 'PVC Bend 20mm White', 'Noor Al Iman', 'PCS', '1', '0.97', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1405, 'XAD000914', '2023-03-31', 'PVC Bend 20mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.5', '2.425', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1406, 'XAD000914', '2023-10-03', 'PVC Bend 20mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.25', '2.1825', 'Request No : Etisalat - SmartHome - XAD-043 - 03-10-2023 . Based On Purchase Orders 3230.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1407, 'XAD000915', '2022-04-11', 'Flex Cable 15*3', 'Noor Al Iman', 'MTR', '4', '3.88', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1408, 'XAD000916', '2022-04-11', 'Signalling Cable 2 Core Beldon', 'Noor Al Iman', 'PCS', '6', '5.82', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1409, 'XAD000917', '2022-04-11', 'PVC Junction Box 100*100', 'Noor Al Iman', 'MTR', '10', '9.7', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1410, 'XAD000918', '2022-04-11', 'PVC Junction Box 150*150', 'Noor Al Iman', 'MTR', '10', '9.7', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1411, 'XAD000919', '2022-04-11', 'PVC Junction Box 225*225', 'Noor Al Iman', 'MTR', '15', '14.55', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1412, 'XAD000920', '2022-04-11', 'Terminal Connector 16mm', 'Noor Al Iman', 'PCS', '5', '4.85', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1413, 'XAD000921', '2022-04-11', 'Terminal Connector 10mm', 'Noor Al Iman', 'PCS', '5', '4.85', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1414, 'XAD000922', '2022-04-11', 'Railing End stopper', 'Noor Al Iman', 'PCS', '5', '4.85', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1415, 'XAD000924', '2022-07-07', 'Uniform Dress Shirt ( Fire Retardent ) Royal Blue with logo Xad & Etisalat  - L', 'Noor Al Iman', 'PCS', '3', '2.91', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1416, 'XAD000925', '2022-04-11', 'PG Gland 21mm', 'Noor Al Iman', 'PCS', '2.5', '2.425', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1417, 'XAD000926', '2022-05-28', 'Junction Box 2 way Black', 'Ali Asghar Hussani', 'PCS', '71.25', '69.1125', 'ADWEA Based On Purchase Orders 141.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1418, 'XAD000926', '2023-02-14', 'Junction Box 2 way Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.25', '1.2125', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1419, 'XAD000926', '2023-03-02', 'Junction Box 2 way Black', 'Noor Al Iman', 'PCS', '2.5', '2.425', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1420, 'XAD000926', '2023-03-17', 'Junction Box 2 way Black', 'Wenzhou Zhechi', 'PCS', '0.64', '0.6208', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1421, 'XAD000926', '2023-04-12', 'Junction Box 2 way Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.25', '1.2125', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1422, 'XAD000928', '2022-04-11', 'UY Connector', 'Noor Al Iman', 'PCS', '0.8', '0.776', 'Adwea Project Based On Purchase Orders 103. GRN : 11-04-025', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1423, 'XAD000928', '2022-07-07', 'UY Connector', 'Ali Asghar Hussani', 'PCS', '0.25', '0.2425', 'Adwea Based On Purchase Orders 290.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1424, 'XAD000929', '2022-05-30', 'Cable Tray GI 300 x 50 mm', 'Noor Al Iman', 'PCS', '32', '31.04', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1425, 'XAD000929', '2023-06-22', 'Cable Tray GI 300 x 50 mm', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '48.25', '46.8025', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2476.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1426, 'XAD000930', '2023-02-15', 'Hole Saw 25 mm', 'Noor Al Iman', 'PCS', '10', '9.7', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1427, 'XAD000930', '2023-03-08', 'Hole Saw 25 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '10', '9.7', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1428, 'XAD000930', '2023-08-12', 'Hole Saw 25 mm', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Request No : Huawei-XAD-HW-Aug-DXB-117 . Based On Purchase Orders 2944.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1429, 'XAD000932', '2022-05-13', 'Patch Cord 1M simplex SC APC-LC UPC', 'Ali Asghar Hussani', 'PKT', '3', '2.91', 'Adwea Based On Purchase Orders 117.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1430, 'XAD000933', '2022-05-13', 'Enclosure Box IP56', 'Ali Asghar Hussani', 'PCS', '16', '15.52', 'Adwea Based On Purchase Orders 117.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1431, 'XAD000934', '2022-10-10', 'Uniform Dress Shirt ( Fire Retardent ) Royal Blue with logo Xad & Etisalat  - S', 'Noor Al Iman', 'PCS', '0.57', '0.5529', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1432, 'XAD000934', '2022-11-03', 'Uniform Dress Shirt ( Fire Retardent ) Royal Blue with logo Xad & Etisalat  - S', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.77', '0.7469', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1433, 'XAD000935', '2023-12-27', 'Alcohol 500 ML', 'Ali Asghar Hussani', 'BOT', '10', '9.7', 'REQUEST NO 0066 AUH OLT PROJECT Based On Purchase Orders 3709.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1434, 'XAD000937', '2022-05-19', 'Buffer Tube 12mm', 'Noor Al Iman', 'Roll', '350', '339.5', 'DU SFAN Based On Purchase Orders 127.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1435, 'XAD000938', '2023-05-19', 'Buffer Tube 04 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '100', '97', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1436, 'XAD000938', '2023-12-20', 'Buffer Tube 04 mm', 'Ali Asghar Hussani', 'Roll', '127', '123.19', 'REQUEST NO 283  DU SFAN PROJECT Based On Purchase Orders 3664.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1437, 'XAD000939', '2023-03-02', 'PVC Adaptor 25 mm White', 'Noor Al Iman', 'PKT', '0.9', '0.873', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1438, 'XAD000939', '2023-03-08', 'PVC Adaptor 25 mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '0.65', '0.6305', 'Request No : SmartHome-Xad-008-009-010- Dubai - Al Ain - Abu Dhabi - 27-02-2023 Based On Purchase Orders 1861.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1439, 'XAD000939', '2023-03-17', 'PVC Adaptor 25 mm White', 'Wenzhou Zhechi', 'PKT', '0.16', '0.1552', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1440, 'XAD000939', '2023-04-12', 'PVC Adaptor 25 mm White', 'Smooth Solution building Materails Trading LLC', 'PKT', '0.5', '0.485', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1441, 'XAD000939', '2024-01-05', 'PVC Adaptor 25 mm White', 'Ali Asghar Hussani', 'PKT', '70', '67.9', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1442, 'XAD000940', '2022-06-24', 'Junction Box 2 way White', 'Ali Asghar Hussani', 'PCS', '3.35', '3.2495', 'Adwea Based On Purchase Orders 237.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1443, 'XAD000940', '2023-03-17', 'Junction Box 2 way White', 'Wenzhou Zhechi', 'PCS', '0.67', '0.6499', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1444, 'XAD000940', '2023-04-12', 'Junction Box 2 way White', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1445, 'XAD000940', '2023-06-13', 'Junction Box 2 way White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3.1', '3.007', 'Request No : SmartHome-XAD-0015-06-06-2023 . Based On Purchase Orders 2519.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1446, 'XAD000941', '2022-07-07', 'Junction Box 3 way White', 'Noor Al Iman', 'PCS', '3.55', '3.4435', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1447, 'XAD000941', '2023-02-14', 'Junction Box 3 way White', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.25', '2.1825', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1448, 'XAD000941', '2023-03-17', 'Junction Box 3 way White', 'Wenzhou Zhechi', 'PCS', '0.85', '0.8245', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1449, 'XAD000941', '2023-06-13', 'Junction Box 3 way White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3.4', '3.298', 'Request No : SmartHome-XAD-0015-06-06-2023 . Based On Purchase Orders 2519.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1450, 'XAD000941', '2024-01-05', 'Junction Box 3 way White', 'Ali Asghar Hussani', 'PCS', '3.5', '3.395', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1451, 'XAD000943', '2023-12-14', 'D 54 Duct Coupler', 'Power Plastic Factory LLC', 'PCS', '3', '2.91', 'Request No AUHOLT-0065 Based On Purchase Orders 3637.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1452, 'XAD000943', '2024-02-03', 'D 54 Duct Coupler', 'Frontier Innovation General Trading', 'PCS', '5', '4.85', 'WR 101H PROJECT Based On Purchase Orders 3766.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1453, 'XAD000944', '2022-05-28', 'Steel Rod  10 mm', 'Ali Asghar Hussani', 'PCS', '32', '31.04', 'Based On Purchase Orders 136. Inv # 7839', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1454, 'XAD000944', '2022-10-28', 'Steel Rod  10 mm', 'Utmost Building Materials LLC', 'PCS', '17.04', '16.5288', 'Request No : L&T Ruwais 211  Requested By : Jahanzaib Anwar Verified By : Rafaqat Mehmood  Imran Iqbal Based On Purchase Orders 1021.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1455, 'XAD000944', '2023-03-15', 'Steel Rod  10 mm', 'Frontier Innovation General Trading', 'PCS', '24', '23.28', 'Request No : AUH-OLT-0014 Based On Purchase Orders 2058.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1456, 'XAD000944', '2023-07-19', 'Steel Rod  10 mm', 'Al Moazam Stores LLC', 'PCS', '16.51', '16.0147', 'Request No : AAN-June-23-0061 . Based On Purchase Orders 2667.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1457, 'XAD000944', '2024-01-11', 'Steel Rod  10 mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '19.3', '18.721', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1458, 'XAD000945', '2022-05-28', 'Steel Rod  16 mm', 'Ali Asghar Hussani', 'PCS', '75', '72.75', 'Based On Purchase Orders 136. Inv # 7839', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1459, 'XAD000946', '2023-03-01', 'JRC 14 Frame cover with Accessories', 'Frontier Innovation General Trading', 'PCS', '1950', '1891.5', 'Request No : AAN-JAN23-0015-20-01-2023 Based On Purchase Orders 1779.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1460, 'XAD000946', '2023-03-07', 'JRC 14 Frame cover with Accessories', 'MITTCO Llc', 'PCS', '2000', '1940', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1859.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1461, 'XAD000946', '2023-12-14', 'JRC 14 Frame cover with Accessories', 'Elfit Arabia', 'PCS', '1950', '1891.5', 'Request No : AAN-DEC-23-099 Based On Purchase Orders 3648.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1462, 'XAD000947', '2023-03-02', 'Channel Screw 3mm', 'Noor Al Iman', 'Box', '17', '16.49', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1463, 'XAD000947', '2023-04-12', 'Channel Screw 3mm', 'Smooth Solution building Materails Trading LLC', 'Box', '26', '25.22', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1464, 'XAD000947', '2023-09-09', 'Channel Screw 3mm', 'Ali Asghar Hussani', 'Box', '23', '22.31', 'Request No : DU SFAN - 245 - 06-09-2023 . Based On Purchase Orders 3119. Based On Goods Receipt PO 1293.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1465, 'XAD000948', '2022-07-07', 'Wago Connector 2 way', 'Noor Al Iman', 'PCS', '2', '1.94', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1466, 'XAD000948', '2022-10-10', 'Wago Connector 2 way', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.25', '1.2125', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 776.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1467, 'XAD000948', '2022-10-13', 'Wago Connector 2 way', 'Ali Asghar Hussani', 'PCS', '1.9', '1.843', 'Request No : ADWEA 73 Requested By : Screenath CK  Verified By : Wasiullah Khan Based On Purchase Orders 687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1468, 'XAD000948', '2023-03-08', 'Wago Connector 2 way', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.82', '0.7954', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1469, 'XAD000948', '2023-03-17', 'Wago Connector 2 way', 'Wenzhou Zhechi', 'PCS', '0.17', '0.1649', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1470, 'XAD000949', '2022-07-07', 'Wago Connector 5 way', 'Noor Al Iman', 'PCS', '2.5', '2.425', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1471, 'XAD000949', '2022-10-10', 'Wago Connector 5 way', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.8', '1.746', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 776.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1472, 'XAD000949', '2022-10-13', 'Wago Connector 5 way', 'Ali Asghar Hussani', 'PCS', '2.2', '2.134', 'Request No : ADWEA 73 Requested By : Screenath CK  Verified By : Wasiullah Khan Based On Purchase Orders 687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1473, 'XAD000949', '2023-03-08', 'Wago Connector 5 way', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.5', '1.455', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1474, 'XAD000949', '2023-03-17', 'Wago Connector 5 way', 'Wenzhou Zhechi', 'PCS', '0.37', '0.3589', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1475, 'XAD000950', '2022-10-20', 'Beldon Cable 9841 NH', 'Smooth Solution building Materails Trading LLC', 'MTR', '8.52', '8.2644', 'Request No : ADWEA-86-OCT  Requested By : Screenath Ck & Jawad Malik Verified By     : Wasiullah Khan Based On Purchase Orders 937.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1476, 'XAD000950', '2023-01-12', 'Beldon Cable 9841 NH', 'Digital Stout Innovation & Trading FZE', 'MTR', '8.56', '8.3032', 'Request No : Adwea-107 Based On Purchase Orders 1397.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1477, 'XAD000950', '2023-01-27', 'Beldon Cable 9841 NH', 'AL Mazroui - ICAS L.L.C', 'MTR', '7.4', '7.178', 'Request No : Adwea-122-Jan-2023. Based On Purchase Orders 1589.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1478, 'XAD000951', '2022-05-24', 'PVC Tube White 8 mm', 'Fas Arabia llc', 'Roll', '185', '179.45', 'adwea Based On Purchase Orders 159.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1479, 'XAD000952', '2022-05-25', 'Patch cord 5M LC APC- LC APC', 'APKR Networking Zone', 'PCS', '15', '14.55', 'Huawei Mobile Project Based On Purchase Orders 167.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1480, 'XAD000953', '2022-05-26', 'Pulling spring 20M', 'Noor Al Iman', 'PCS', '15', '14.55', 'ADWEA Based On Purchase Orders 171.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1481, 'XAD000954', '2022-08-23', 'Source Meter - EXFO', 'Alpha Link Technologies LLC', 'PCS', '9950', '9651.5', 'MOD Based On Purchase Orders 173.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1482, 'XAD000955', '2022-08-23', 'Launch Fiber EXFO', 'Alpha Link Technologies LLC', 'PCS', '2950', '2861.5', 'MOD Based On Purchase Orders 173.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1483, 'XAD000956', '2023-01-26', 'Thimble Lugs 6*8', 'Ali Asghar Hussani', 'PCS', '0.33', '0.3201', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1484, 'XAD000956', '2023-03-02', 'Thimble Lugs 6*8', 'Noor Al Iman', 'PCS', '0.4', '0.388', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1485, 'XAD000957', '2022-06-04', 'Enclosure BOX HT 5', 'Noor Al Iman', 'PCS', '30', '29.1', 'Adwea Based On Purchase Orders 185.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1486, 'XAD000957', '2022-10-10', 'Enclosure BOX HT 5', 'Smooth Solution building Materails Trading LLC', 'PCS', '18', '17.46', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 776.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1487, 'XAD000957', '2023-01-26', 'Enclosure BOX HT 5', 'Ali Asghar Hussani', 'PCS', '16', '15.52', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1488, 'XAD000957', '2023-03-17', 'Enclosure BOX HT 5', 'Wenzhou Zhechi', 'PCS', '5.69', '5.5193', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1489, 'XAD000958', '2022-05-30', 'Wago Connector 4 Pole', 'Noor Al Iman', 'PCS', '2.5', '2.425', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1490, 'XAD000959', '2022-05-30', 'Wago Connector 2 Pole', 'Noor Al Iman', 'PCS', '2.25', '2.1825', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1491, 'XAD000959', '2023-04-03', 'Wago Connector 2 Pole', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.82', '0.7954', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1492, 'XAD000963', '2022-06-24', 'Cable Tie Black 200 mm', 'Ali Asghar Hussani', 'PKT', '3.5', '3.395', 'Adwea Based On Purchase Orders 237.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1493, 'XAD000963', '2022-05-30', 'Cable Tie Black 200 mm', 'Noor Al Iman', 'PKT', '4', '3.88', 'ADWEA Based On Purchase Orders 178.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1494, 'XAD000965', '2022-06-03', 'Semi Static Rope 12.5mm x 100M', 'Fas Arabia llc', 'Roll', '3000', '2910', 'Bahrain Project Based On Purchase Orders 183.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1495, 'XAD000966', '2022-11-03', 'Thimble Lugs 4*8', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.38', '0.3686', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1496, 'XAD000966', '2023-02-17', 'Thimble Lugs 4*8', 'Ali Asghar Hussani', 'PCS', '0.3', '0.291', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1688.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1497, 'XAD000966', '2023-03-02', 'Thimble Lugs 4*8', 'Noor Al Iman', 'PCS', '0.25', '0.2425', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1498, 'XAD000967', '2022-09-14', 'Thimble Lugs 4*6', 'Wenzhou Zhechi', 'PCS', '8.72', '8.4584', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1499, 'XAD000967', '2022-10-13', 'Thimble Lugs 4*6', 'Ali Asghar Hussani', 'PCS', '0.3', '0.291', 'Request No : ADWEA 73 Requested By : Screenath CK  Verified By : Wasiullah Khan Based On Purchase Orders 687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1500, 'XAD000968', '2022-06-04', 'Cable Tie 3.6*300 mm black', 'Noor Al Iman', 'PKT', '7', '6.79', 'Adwea Based On Purchase Orders 185.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1501, 'XAD000968', '2023-05-10', 'Cable Tie 3.6*300 mm black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '5.5', '5.335', 'Request No: OSP-05 04-05-23 Based On Purchase Orders 2209.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1502, 'XAD000968', '2023-10-27', 'Cable Tie 3.6*300 mm black', 'Ali Asghar Hussani', 'PKT', '5.5', '5.335', 'Request No : WR-101H - 293 - Oct - 2023 Based On Purchase Orders 3369.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1503, 'XAD000969', '2022-07-07', 'Wago Conector 3 way', 'Noor Al Iman', 'PCS', '2.25', '2.1825', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1504, 'XAD000969', '2022-10-10', 'Wago Conector 3 way', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 776.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1505, 'XAD000969', '2022-10-13', 'Wago Conector 3 way', 'Ali Asghar Hussani', 'PCS', '2.1', '2.037', 'Request No : ADWEA 73 Requested By : Screenath CK  Verified By : Wasiullah Khan Based On Purchase Orders 687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1506, 'XAD000969', '2023-03-08', 'Wago Conector 3 way', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.2', '1.164', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1507, 'XAD000969', '2023-03-17', 'Wago Conector 3 way', 'Wenzhou Zhechi', 'PCS', '0.24', '0.2328', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1508, 'XAD000970', '2023-01-23', 'Drill Bit 6 mm concrete', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '4.5', '4.365', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1509, 'XAD000970', '2023-03-06', 'Drill Bit 6 mm concrete', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1854.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1510, 'XAD000970', '2023-03-08', 'Drill Bit 6 mm concrete', 'Smooth Solution building Materails Trading LLC', 'PCS', '4.5', '4.365', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1844.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1511, 'XAD000970', '2023-10-02', 'Drill Bit 6 mm concrete', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4', '3.88', 'Request No : Adwea-294-AUH-04-09-2023 . Based On Purchase Orders 3112.', '2024-10-09 03:56:58', '2024-10-09 03:56:58');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1512, 'XAD000970', '2023-12-16', 'Drill Bit 6 mm concrete', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'Request No 6 ICT School Project Based On Purchase Orders 3656.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1513, 'XAD000971', '2022-10-15', 'D 54 Bend', 'Frontier Innovation General Trading', 'PCS', '21.5', '20.855', 'JRC Precast & Other All Material Is DU Standard  Request No : Sep-009 AUH DU SFAN Civil Liwa Requested By : Sufian Shaukat  Verified By : rafaqat Mehmood & Imran Iqbal Requested By : Sufian Shaukat  Verified By : rafaqat Mehmood & Imran Iqbal Based On Pu', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1514, 'XAD000971', '2024-01-10', 'D 54 Bend', 'Power Plastic Factory LLC', 'PCS', '12', '11.64', 'REQUEST NO AAN JAN 24 102 Based On Purchase Orders 3839.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1515, 'XAD000972', '2022-11-19', 'Fiber Connector 10 db', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Based On Purchase Orders 1226.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1516, 'XAD000972', '2023-02-11', 'Fiber Connector 10 db', 'Azlan Star Technologies LLC', 'PCS', '20', '19.4', 'Based On Purchase Orders 1702.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1517, 'XAD000973', '2022-06-16', 'Drill bit concrete 25 mm', 'Noor Al Iman', 'PCS', '35', '33.95', 'ADWEA Based On Purchase Orders 210.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1518, 'XAD000973', '2023-04-28', 'Drill bit concrete 25 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '20', '19.4', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2186.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1519, 'XAD000973', '2023-12-27', 'Drill bit concrete 25 mm', 'Ali Asghar Hussani', 'PCS', '19', '18.43', 'ETISALAT SMART HOME PROJECT Based On Purchase Orders 3714.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1520, 'XAD000975', '2022-06-16', 'Drill bit steel 16 mm', 'Noor Al Iman', 'PCS', '30', '29.1', 'ADWEA Based On Purchase Orders 210.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1521, 'XAD000975', '2023-04-03', 'Drill bit steel 16 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '22', '21.34', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1522, 'XAD000976', '2022-10-10', 'Cable Clip Round 10mm White', 'Noor Al Iman', 'PCS', '8', '7.76', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 779.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1523, 'XAD000976', '2023-01-05', 'Cable Clip Round 10mm White', 'Ali Asghar Hussani', 'PCS', '0.07', '0.0679', 'Request No : ADWEA-106-AUH Based On Purchase Orders 1382.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1524, 'XAD000976', '2023-01-30', 'Cable Clip Round 10mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.06', '0.0582', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1525, 'XAD000976', '2023-03-08', 'Cable Clip Round 10mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.05', '0.0485', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1526, 'XAD000976', '2023-03-17', 'Cable Clip Round 10mm White', 'Wenzhou Zhechi', 'PCS', '0.01', '0.0097', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1527, 'XAD000982', '2022-06-17', 'wood nail 2.5', 'Ali Asghar Hussani', 'PKT', '20', '19.4', 'Etihad Rail Based On Purchase Orders 212.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1528, 'XAD000982', '2022-07-15', 'wood nail 2.5', 'Noor Al Iman', 'PKT', '22', '21.34', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1529, 'XAD000982', '2022-10-19', 'wood nail 2.5', 'JOGA RAM GENERAL TRADING LLC', 'PKT', '2.2', '2.134', 'Project : L&T Etihad Rail (KPO) Request No : L&T-01-DIC-DXB Requested By : Aqeel Butt Verified By : Sufiyan Shaukat & Imran Iqbal Based On Purchase Orders 821.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1530, 'XAD000982', '2023-11-11', 'wood nail 2.5', 'Al Moazam Stores LLC', 'PKT', '18', '17.46', 'Request No : AAN-OLT-OCT-23-0094 & 0091 .  Consumable Civil Material Required For AAN-OLT Project Nov-2023 . Based On Purchase Orders 3416.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1531, 'XAD000983', '2022-11-30', 'Drill bit 12mm concrete', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Request No : ADWEA-105-Nov-2022 Based On Purchase Orders 1341.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1532, 'XAD000983', '2023-04-03', 'Drill bit 12mm concrete', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '6.5', '6.305', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1533, 'XAD000985', '2022-06-16', 'Ikea Tightner', 'IKEA TRading', 'PCS', '60', '58.2', 'adwea Based On Purchase Orders 184.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1534, 'XAD000985', '2024-01-19', 'Ikea Tightner', 'Securintec Information Technology LLC', 'PCS', '150', '145.5', 'Based On Purchase Orders 1994.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1535, 'XAD000986', '2022-06-28', 'Patch Cord LC APC-LC APC 3M Duplex', 'Cash', 'PCS', '10', '9.7', 'Huawei Mobile Project Based On Purchase Orders 238.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1536, 'XAD000986', '2022-08-31', 'Patch Cord LC APC-LC APC 3M Duplex', 'Dawnergy Technologies Shanghai Co LTD', 'PCS', '10', '9.7', 'Patch Cord Order From China For Xad All Projects Based On Purchase Orders 565.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1537, 'XAD000986', '2022-09-23', 'Patch Cord LC APC-LC APC 3M Duplex', 'Azlan Star Technologies LLC', 'PCS', '10', '9.7', 'Project : Huawei  Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 577.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1538, 'XAD000987', '2022-06-28', 'Patch Cord 5M LC APC-LC APC Duplex', 'Cash', 'PCS', '13', '12.61', 'Huawei Mobile Project Based On Purchase Orders 238.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1539, 'XAD000987', '2022-08-31', 'Patch Cord 5M LC APC-LC APC Duplex', 'Dawnergy Technologies Shanghai Co LTD', 'PCS', '11.01', '10.6797', 'Patch Cord Order From China For Xad All Projects Based On Purchase Orders 565.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1540, 'XAD000987', '2022-09-23', 'Patch Cord 5M LC APC-LC APC Duplex', 'Azlan Star Technologies LLC', 'PCS', '13', '12.61', 'Project : Huawei  Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 577.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1541, 'XAD000988', '2022-06-28', 'Patch Cord 10M LC APC-LC APC Duplex', 'Cash', 'PCS', '17', '16.49', 'Huawei Mobile Project Based On Purchase Orders 238.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1542, 'XAD000988', '2022-08-31', 'Patch Cord 10M LC APC-LC APC Duplex', 'Dawnergy Technologies Shanghai Co LTD', 'PCS', '13.02', '12.6294', 'Patch Cord Order From China For Xad All Projects Based On Purchase Orders 565.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1543, 'XAD000989', '2022-06-24', 'Cable / Metal detector', 'Ali Asghar Hussani', 'PCS', '470', '455.9', 'Adwea Based On Purchase Orders 240.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1544, 'XAD000991', '2022-06-24', 'Sleeve black 18 mm', 'Ali Asghar Hussani', 'Roll', '95', '92.15', 'Adwea Based On Purchase Orders 237.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1545, 'XAD000992', '2022-07-04', 'RJ11-RJ45 PCORDS 0.5 Meter', 'Cash', 'PCS', '1.5', '1.455', 'Du Tcs Based On Purchase Orders 245.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1546, 'XAD000994', '2022-06-23', 'Patch Cord SC/LC, Multimode, 01 Meter', 'Cash', 'PCS', '9', '8.73', 'Du Tcs Based On Purchase Orders 245.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1547, 'XAD000995', '2022-06-23', 'Patch cord 3M LC/APS-LC/APC Duplex', 'Cash', 'PCS', '9.5', '9.215', 'Du Tcs Based On Purchase Orders 245.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1548, 'XAD000996', '2022-05-13', 'Hole saw bit 25mm', 'Ali Asghar Hussani', 'PCS', '8', '7.76', 'Adwea Based On Purchase Orders 117.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1549, 'XAD000997', '2022-07-07', 'Aluminium Ladder 3M 12 Step (A Type)', 'Ali Asghar Hussani', 'PCS', '280', '271.6', 'Adwea Based On Purchase Orders 272.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1550, 'XAD000998', '2022-07-16', 'Pulling spring 4 mm', 'Ali Asghar Hussani', 'PCS', '75', '72.75', 'Du sfan Based On Purchase Orders 274.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1551, 'XAD000999', '2022-07-07', 'I lugs 0.5 mm', 'Noor Al Iman', 'PKT', '2.5', '2.425', 'Adwea Based On Purchase Orders 284.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1552, 'XAD001000', '2022-07-04', 'Fix Bolt 16 mm', 'Noor Al Iman', 'PCS', '3.5', '3.395', 'Solar Project Based On Purchase Orders 291.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1553, 'XAD001001', '2022-08-01', 'Alarm Cable outdoor (Jellyfilled)', 'Frontier Innovation General Trading', 'MTR', '8.6', '8.342', 'Project : Huawei Solar Requested By : Wasiullah Based On Purchase Orders 423.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1554, 'XAD001002', '2022-07-13', 'Cable Rod 14mm 500 Meter', 'Frontier Innovation General Trading', 'MTR', '6750', '6547.5', 'AAN 101 Based On Purchase Orders 304.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1555, 'XAD001003', '2022-07-05', 'DC Cable 16 mm red', 'Noor Al Iman', 'MTR', '11.5', '11.155', 'Solar Project Based On Purchase Orders 301.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1556, 'XAD001004', '2022-07-16', 'Exhaust Fan', 'Ali Asghar Hussani', 'PCS', '450', '436.5', 'Du Sfan Based On Purchase Orders 307.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1557, 'XAD001005', '2022-07-05', 'DC - DC Conveter', 'Cash', 'PCS', '205', '198.85', 'Adwea Based On Purchase Orders 310.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1558, 'XAD001006', '2022-07-23', 'Fiber Conector 5 DB', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Nokia Mobile Project Based On Purchase Orders 351.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1559, 'XAD001006', '2022-08-25', 'Fiber Conector 5 DB', 'Azlan Star Technologies LLC', 'PCS', '15', '14.55', 'Project : Nokia Requested By : Muhammad talha  Verified By : Zeeshan Mushtaq Based On Purchase Orders 521.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1560, 'XAD001007', '2022-07-21', 'SSD Kingston 500 GB', 'Azlan Star Tech', 'PCS', '175', '169.75', 'SSD Request for Mr. Zulfiqar from Mr. Razik Based On Purchase Orders 373.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1561, 'XAD001008', '2023-09-30', 'Camp Pulley', 'Fas Arabia llc', 'PCS', '215', '208.55', 'Rigger PPE Tool Requried For Nokia Project. Based On Purchase Orders 2528.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1562, 'XAD001009', '2022-11-05', 'PVC Glands 19 mm', 'Ali Asghar Hussani', 'PCS', '0.45', '0.4365', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1081.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1563, 'XAD001010', '2022-07-28', 'GI FLEXIBLE PIPE-50MM', 'Imdaad', 'PCS', '58', '56.26', 'Huawei Solar Requested by: Asim Waqas  Verified by   : Wasi Ullah Based On Purchase Orders 387.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1564, 'XAD001011', '2022-07-28', 'GI FLEXIBLE PIPE-35MM', 'Imdaad', 'PCS', '45', '43.65', 'Huawei Solar Requested by: Asim Waqas  Verified by   : Wasi Ullah Based On Purchase Orders 387.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1565, 'XAD001012', '2022-08-12', 'Paint Emulsion White Matt 800ml 4Ltr', 'Abazar Building Materail LLC Qusais', 'GLN', '20', '19.4', 'Based On Purchase Orders 405.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1566, 'XAD001012', '2022-10-15', 'Paint Emulsion White Matt 800ml 4Ltr', 'MAA ALMADINA BUILDING MATERIAL', 'GLN', '65', '63.05', 'Request No : L&T Ruwais 209 2-Oct-2022 Requested By : Jahanzaib Anwar Verified By     : Rafaqat Mehmood & Imran Iqbal Based On Purchase Orders 803.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1567, 'XAD001013', '2022-08-12', 'Trunking 25x38', 'Abazar Building Materail LLC Qusais', 'PCS', '12', '11.64', 'Based On Purchase Orders 405.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1568, 'XAD001013', '2023-03-08', 'Trunking 25x38', 'Smooth Solution building Materails Trading LLC', 'PCS', '8', '7.76', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1726.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1569, 'XAD001013', '2023-09-05', 'Trunking 25x38', 'Ali Asghar Hussani', 'PCS', '8.51', '8.2547', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3095.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1570, 'XAD001015', '2022-08-12', 'PVC Coupler 20mm Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.25', '0.2425', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1571, 'XAD001018', '2022-09-23', 'Patch Cord 20M LC APC-LC APC Duplex', 'Azlan Star Technologies LLC', 'PCS', '25', '24.25', 'Project : Huawei  Requested By : Jawad Hussain Verified By : Sohail Abbas Based On Purchase Orders 577.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1572, 'XAD001019', '2023-04-26', 'D 56 Duct  PVC 6 MTr length', 'Power Plastic Factory LLC', 'PCS', '13', '12.61', 'Request No : AAN-April-0036-13-04-2023 . Based On Purchase Orders 2160.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1573, 'XAD001020', '2023-01-23', 'Polyethylene  Sheet 1000G', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '27', '26.19', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1574, 'XAD001020', '2023-02-09', 'Polyethylene  Sheet 1000G', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '26', '25.22', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1692.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1575, 'XAD001020', '2023-12-23', 'Polyethylene  Sheet 1000G', 'SM And Rahmani Building Materials Trading LLC', 'Roll', '28', '27.16', 'Material For ICT School Project Based On Purchase Orders 3716.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1576, 'XAD001020', '2024-01-11', 'Polyethylene  Sheet 1000G', 'MAA ALMADINA BUILDING MATERIAL', 'Roll', '22', '21.34', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1577, 'XAD001020', '2024-01-11', 'Polyethylene  Sheet 1000G', 'Al Moazam Stores LLC', 'Roll', '24', '23.28', 'REQUEST NO AAN JAN 24 102 Based On Purchase Orders 3841.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1578, 'XAD001021', '2022-08-18', 'Flexible Sheet  18mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '52', '50.44', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1579, 'XAD001022', '2022-08-18', 'Roller 9\"', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '10', '9.7', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1580, 'XAD001023', '2022-08-18', 'Nail Puller Lever 36\" Chiesel ( Bharri )', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '6.5', '6.305', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1581, 'XAD001024', '2022-08-18', 'Locker Four Tier', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '36', '34.92', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1582, 'XAD001024', '2023-02-14', 'Locker Four Tier', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.03', '0.0291', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1583, 'XAD001024', '2023-02-23', 'Locker Four Tier', 'Cash', 'PCS', '120', '116.4', 'Based On Purchase Orders 4194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1584, 'XAD001024', '2023-04-27', 'Locker Four Tier', 'Great Wall Furnitures Trading LLC', 'PCS', '120', '116.4', 'New Locker Required For Xad Office Staff Room 10 Block 5A In Al Quoz System Camp . Based On Purchase Orders 2190.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1585, 'XAD001026', '2022-08-18', 'Gypsum Powder 20KG', 'JOGA RAM GENERAL TRADING LLC', 'PKT', '12', '11.64', 'Project : Etihad Rail L&T Requested By : Rafaqat Mehmood Zeeshan Based On Purchase Orders 436.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1586, 'XAD001027', '2022-08-13', 'Sunlyte ORS Sachets', 'Zam Zam Pharmacy', 'Box', '28.33', '27.4801', 'Project : Etihad Rail  Requested By : Rafaqat Mehmood  Based On Purchase Orders 437.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1587, 'XAD001027', '2023-10-24', 'Sunlyte ORS Sachets', 'Ali Asghar Hussani', 'Box', '13', '12.61', 'Request No : SmartHome-Xad-006-Oct-AUH Based On Purchase Orders 3352.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1588, 'XAD001028', '2022-08-12', 'GI pipe 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '16', '15.52', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1589, 'XAD001029', '2022-08-12', 'GI Saddle 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.5', '0.485', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1590, 'XAD001029', '2023-01-21', 'GI Saddle 25mm', 'Noor Al Iman', 'PCS', '0.42', '0.4074', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1591, 'XAD001029', '2023-01-30', 'GI Saddle 25mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.7', '0.679', 'Request No : SmartHome-XAD-006-Jan-2023. Based On Purchase Orders 1635.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1592, 'XAD001030', '2023-02-24', 'GI Coupler 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.6', '0.582', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1782.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1593, 'XAD001031', '2023-01-28', 'Thread Rod 10mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '5.5', '5.335', 'Request No : DU SFAN-104-Jan2023. Based On Purchase Orders 1646.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1594, 'XAD001031', '2023-04-04', 'Thread Rod 10mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '4.5', '4.365', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1595, 'XAD001031', '2023-06-22', 'Thread Rod 10mm', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '3.5', '3.395', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2476.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1596, 'XAD001032', '2023-04-03', 'Unifix 10mm', 'Ali Asghar Hussani', 'PCS', '0.25', '0.2425', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1597, 'XAD001032', '2023-05-19', 'Unifix 10mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.18', '0.1746', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1598, 'XAD001033', '2022-08-12', 'GI Nut 10mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.1', '0.097', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1599, 'XAD001033', '2023-04-03', 'GI Nut 10mm', 'Ali Asghar Hussani', 'PCS', '0.1', '0.097', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1600, 'XAD001033', '2023-05-19', 'GI Nut 10mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.1', '0.097', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1601, 'XAD001034', '2023-05-19', 'G.I Washer 10mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.05', '0.0485', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1602, 'XAD001035', '2023-10-04', 'Saddle 20mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.6', '0.582', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3086.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1603, 'XAD001036', '2022-08-12', 'Labeling Cartridge Black & Yellow 12mm ( Dymo )', 'Smooth Solution building Materails Trading LLC', 'PCS', '22.5', '21.825', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1604, 'XAD001036', '2022-09-09', 'Labeling Cartridge Black & Yellow 12mm ( Dymo )', 'Aimo Graphics Company Limited', 'PCS', '4.77', '4.6269', 'New Cartridge Order From China Hong Kong.For Xad All Projects. Based On Purchase Orders 618.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1605, 'XAD001037', '2022-08-12', 'Telescopic ladder 1.9x1.9m', 'Smooth Solution building Materails Trading LLC', 'PCS', '315', '305.55', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1606, 'XAD001038', '2022-08-13', 'Nail Wood 1\"', 'Noor Al Iman', 'Box', '40', '38.8', 'Based On Purchase Orders 463.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1607, 'XAD001038', '2023-12-13', 'Nail Wood 1\"', 'Al Moazam Stores LLC', 'Box', '1.13', '1.0961', 'Request No : AAN-NOV-23-0098  FOR AAN 101-H Based On Purchase Orders 3552.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1608, 'XAD001040', '2022-08-14', 'Ribbon Sleeve', 'Frontier Innovation General Trading', 'PCS', '0.45', '0.4365', 'Project : AAN 101H  Requested By : Mr Shamas  Based On Purchase Orders 449.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1609, 'XAD001041', '2022-08-12', 'Solvent Cemet 500ml', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Requested By : Sharafu Tk based on purchase Orders 451.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1610, 'XAD001042', '2023-02-24', 'GI Junction Adaptable Box', 'Smooth Solution building Materails Trading LLC', 'PCS', '20', '19.4', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1782.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1611, 'XAD001043', '2023-05-27', 'Jack for Cable Drum Shifting 10Ton/05Ton with Rod', 'Elfit Arabia', 'SET', '3960', '3841.2', 'Request No : DU SFAN-176 Based On Purchase Orders 2359.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1612, 'XAD001044', '2022-11-02', 'Water Stopper Polybit 10\"x10M', 'Saeed Al Zaabi General Trading LLC', 'PCS', '195', '189.15', 'Request No : L&T Ruwais 211  Requested By : Jahanzaib Anwar Verified By : Rafaqat Mehmood  Imran Iqbal Based On Purchase Orders 991.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1613, 'XAD001044', '2023-12-13', 'Water Stopper Polybit 10\"x10M', 'Al Moazam Stores LLC', 'PCS', '180', '174.6', 'Request No : AAN-NOV-23-0098  FOR AAN 101-H Based On Purchase Orders 3552.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1614, 'XAD001045', '2022-08-12', 'Bitustick Poltcoat 1.5x10M', 'Al Moazam Stores LLC', 'PCS', '109.02', '105.7494', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1615, 'XAD001046', '2022-08-12', 'Dermabit Roofing Felt 4250 Plain', 'Al Moazam Stores LLC', 'Roll', '113.02', '109.6294', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1616, 'XAD001047', '2023-11-11', 'Polycoat 15LTR', 'Al Moazam Stores LLC', 'Drum', '34', '32.98', 'Request No : AAN-OLT-OCT-23-0094 & 0091 .  Consumable Civil Material Required For AAN-OLT Project Nov-2023 . Based On Purchase Orders 3416.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1617, 'XAD001048', '2024-01-23', 'FC Majoon ( Rendroc ) Fosroc 20KG', 'Al Moazam Stores LLC', 'PKT', '38', '36.86', 'REQUEST NO : AAN 2024 104 Based On Purchase Orders 3929.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1618, 'XAD001049', '2022-10-15', 'Deformed Steel Bar 12M 10mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '45', '43.65', 'Request No : AUH-OCT-009 Requested By : Sufiyan Shaukat Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 811.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1619, 'XAD001049', '2024-01-23', 'Deformed Steel Bar 12M 10mm', 'Al Moazam Stores LLC', 'PCS', '18.15', '17.6055', 'REQUEST NO : AAN 2024 104 Based On Purchase Orders 3929.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1620, 'XAD001050', '2022-09-21', 'Junction Box 3 Way Black & Cover', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.6', '0.582', 'Request No : ADWEA 65 Requested By : Screenth Ck Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 637.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1621, 'XAD001050', '2023-01-05', 'Junction Box 3 Way Black & Cover', 'Ali Asghar Hussani', 'PCS', '0.52', '0.5044', 'Request No : ADWEA-106-AUH Based On Purchase Orders 1382.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1622, 'XAD001050', '2023-03-11', 'Junction Box 3 Way Black & Cover', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1', '0.97', 'Request No : SmartHome-XAD-013-13-03-2023 . Based On Purchase Orders 2636.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1623, 'XAD001051', '2022-08-12', 'Uniform Dress Shirt ( Fire Retardent ) Royal Blue with logo Xad & Etisalat  - XL', 'Al Moazam Stores LLC', 'PCS', '110.02', '106.7194', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1624, 'XAD001052', '2022-09-16', 'D-56 Bend 90 Degree', 'Frontier Innovation General Trading', 'PCS', '8', '7.76', 'Request no : AAN Sep-001 JRC Etisalat Standard For AAN OLT Based On Purchase Orders 624.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1625, 'XAD001052', '2023-04-26', 'D-56 Bend 90 Degree', 'Power Plastic Factory LLC', 'PCS', '4', '3.88', 'Request No : AAN-April-0036-13-04-2023 . Based On Purchase Orders 2160.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1626, 'XAD001053', '2022-10-06', 'GI Channel  41*21', 'Noor Al Iman', 'PCS', '18', '17.46', 'Request No : DU SFAN Sep 2022 ( 60 )  Requested By : Mufeed KK  Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 627.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1627, 'XAD001053', '2023-02-24', 'GI Channel  41*21', 'Smooth Solution building Materails Trading LLC', 'PCS', '12', '11.64', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1782.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1628, 'XAD001053', '2023-09-09', 'GI Channel  41*21', 'Ali Asghar Hussani', 'PCS', '10.5', '10.185', 'Request No : DU SFAN - 245 - 06-09-2023 . Based On Purchase Orders 3119. Based On Goods Receipt PO 1293.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1629, 'XAD001054', '2022-09-21', 'T-Handle Hex Key Allen Wrench Set ( 2mm to 10mm ) Hexagon', 'Smooth Solution building Materails Trading LLC', 'SET', '175', '169.75', 'Request No : ADWEA 65 Requested By : Screenth Ck Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 637.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1630, 'XAD001054', '2023-02-14', 'T-Handle Hex Key Allen Wrench Set ( 2mm to 10mm ) Hexagon', 'Ali Asghar Hussani', 'SET', '50', '48.5', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1697.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1631, 'XAD001054', '2023-04-26', 'T-Handle Hex Key Allen Wrench Set ( 2mm to 10mm ) Hexagon', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'SET', '29', '28.13', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2011.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1632, 'XAD001055', '2022-08-12', 'White Wood 3x3x13FT', 'Al Moazam Stores LLC', 'PCS', '200.03', '194.0291', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1633, 'XAD001055', '2022-09-23', 'White Wood 3x3x13FT', 'Azlan Star Technologies LLC', 'PCS', '15', '14.55', 'Request No : Du SFAN Sep 2022 ( 60 ) Requested By : Mufeed KK Verified By : Ansar Abbas & Sharafu Tk Based On Purchase Orders 628.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1634, 'XAD001056', '2022-08-12', 'Water Paint National 800 18LTR', 'Al Moazam Stores LLC', 'Drum', '58.01', '56.2697', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1635, 'XAD001056', '2023-07-04', 'Water Paint National 800 18LTR', 'JOGA RAM GENERAL TRADING LLC', 'Drum', '305', '295.85', 'Request No : AAN-May-23-0044 Based On Purchase Orders 2637.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1636, 'XAD001056', '2024-01-11', 'Water Paint National 800 18LTR', 'MAA ALMADINA BUILDING MATERIAL', 'Drum', '75', '72.75', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1637, 'XAD001057', '2022-08-12', 'Stucoo Putty Natioanl 20LTR', 'Al Moazam Stores LLC', 'Drum', '56.01', '54.3297', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1638, 'XAD001058', '2022-08-12', 'Oil Paint National 800 18LTR', 'Al Moazam Stores LLC', 'Drum', '235.03', '227.9791', 'Project : Etisalat AUH-OLT101H Reqyested By : Mr Shamas Requested By : Raja M Zeeshan Based On Purchase Orders 454.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1639, 'XAD001058', '2023-05-18', 'Oil Paint National 800 18LTR', 'MAA ALMADINA BUILDING MATERIAL', 'Drum', '60', '58.2', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1640, 'XAD001058', '2023-05-18', 'Oil Paint National 800 18LTR', 'Ali Asghar Hussani', 'Drum', '38', '36.86', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2306. Based On Goods Receipt PO 948.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1641, 'XAD001058', '2024-02-08', 'Oil Paint National 800 18LTR', 'Al Moazam Stores LLC', 'Drum', '190', '184.3', 'REQUEST NO : AAN-2024-107 Based On Purchase Orders 4053.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1642, 'XAD001059', '2023-10-04', 'Dry Concrete C30/20', 'Redco Bin Juma Ready Mix Factory LLC', 'Cu m', '220', '213.4', 'Request Noi : AUH-OLT-0023 Based On Purchase Orders 2219.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1643, 'XAD001060', '2023-02-15', 'Hole Saw 16mm', 'Noor Al Iman', 'PKT', '10', '9.7', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1644, 'XAD001060', '2023-03-21', 'Hole Saw 16mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '9', '8.73', 'Based On Purchase Orders 1913.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1645, 'XAD001062', '2022-11-02', 'Bitustick', 'Saeed Al Zaabi General Trading LLC', 'Roll', '28', '27.16', 'Request No : L&T Ruwais 211  Requested By : Jahanzaib Anwar Verified By : Rafaqat Mehmood  Imran Iqbal Based On Purchase Orders 991.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1646, 'XAD001062', '2022-11-15', 'Bitustick', 'Henkel Polybit Industries LTD', 'Roll', '115', '111.55', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1134.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1647, 'XAD001062', '2022-12-24', 'Bitustick', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '165', '160.05', 'Request No : Etihad Rail L&T -03 - DXB Based On Purchase Orders 1412.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1648, 'XAD001062', '2024-01-11', 'Bitustick', 'MAA ALMADINA BUILDING MATERIAL', 'Roll', '120', '116.4', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1649, 'XAD001062', '2024-01-18', 'Bitustick', 'Al Moazam Stores LLC', 'Roll', '110', '106.7', 'REQUEST NO AAN JAN 24 103 AAN 101-H PROJECT Based On Purchase Orders 3872.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1650, 'XAD001063', '2022-11-02', 'Bitustick Board 4m 1x10', 'Saeed Al Zaabi General Trading LLC', 'Roll', '120', '116.4', 'Request No : L&T Ruwais 211  Requested By : Jahanzaib Anwar Verified By : Rafaqat Mehmood  Imran Iqbal Based On Purchase Orders 991.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1651, 'XAD001063', '2022-11-15', 'Bitustick Board 4m 1x10', 'Henkel Polybit Industries LTD', 'Roll', '26', '25.22', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1134.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1652, 'XAD001063', '2023-02-02', 'Bitustick Board 4m 1x10', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '105', '101.85', 'Request No : WR-101H-228-Jan-2023 Based On Purchase Orders 1621.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1653, 'XAD001063', '2024-01-11', 'Bitustick Board 4m 1x10', 'MAA ALMADINA BUILDING MATERIAL', 'Roll', '118', '114.46', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1654, 'XAD001063', '2024-01-18', 'Bitustick Board 4m 1x10', 'Al Moazam Stores LLC', 'Roll', '112', '108.64', 'REQUEST NO AAN JAN 24 103 AAN 101-H PROJECT Based On Purchase Orders 3872.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1655, 'XAD001065', '2022-09-08', 'Water Bar', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '367', '355.99', 'Project : DXB Etihad Rail Requested By : Blessan Koshy Verified By : Imran Iqbal Based On Purchase Orders 560.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1656, 'XAD001066', '2022-10-16', 'Measuring Tape 50M', 'Al Moazam Stores LLC', 'PCS', '50', '48.5', 'Request No : AAN OLT Sep 028  Requested By ; Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 642.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1657, 'XAD001066', '2023-12-13', 'Measuring Tape 50M', 'Ali Asghar Hussani', 'PCS', '25', '24.25', 'REQUEST NO 2 Based On Purchase Orders 3623.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1658, 'XAD001067', '2022-11-08', 'Water Cooler 5 Gallon (18L)', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '80', '77.6', 'Request No : AAN-101H-OCT-009  Requested By ; Sufian Shaukat  Verified By     : SHamas Tabraiz & Imran Iqbal Based On Purchase Orders 994.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1659, 'XAD001067', '2023-11-06', 'Water Cooler 5 Gallon (18L)', 'Ali Asghar Hussani', 'PCS', '50', '48.5', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1660, 'XAD001068', '2023-10-18', 'Water White Paint', 'Smooth Solution building Materails Trading LLC', 'Drum', '15', '14.55', 'Request No : DU SFAN-252-DXB. Based On Purchase Orders 3328.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1661, 'XAD001068', '2024-01-11', 'Water White Paint', 'MAA ALMADINA BUILDING MATERIAL', 'Drum', '63', '61.11', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1662, 'XAD001069', '2022-12-24', 'Plaster of Paris Wall Putty Paint', 'JOGA RAM GENERAL TRADING LLC', 'Drum', '60', '58.2', 'Request No : Etihad Rail L&T -03 - DXB Based On Purchase Orders 1412.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1663, 'XAD001069', '2024-01-11', 'Plaster of Paris Wall Putty Paint', 'MAA ALMADINA BUILDING MATERIAL', 'Drum', '60', '58.2', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1664, 'XAD001072', '2022-08-26', 'Vehicle Handover Form Book', 'M S K Corporate Services Provides EST', 'PCS', '18.5', '17.945', 'Vehicle Books For Transport Department Based On Purchase Orders 501.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1665, 'XAD001073', '2022-08-26', 'Vehicle Checklist Form Book', 'M S K Corporate Services Provides EST', 'PCS', '22', '21.34', 'Vehicle Books For Transport Department Based On Purchase Orders 501.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1666, 'XAD001074', '2023-08-23', 'Vehicle Logbook XAD', 'M S K Corporate Services Provides EST', 'PCS', '10.5', '10.185', 'Request No : XAD-55-July-2023 Based On Purchase Orders 2878.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1667, 'XAD001076', '2023-05-24', 'Lanyard with Safety Clip', 'M S K Corporate Services Provides EST', 'PCS', '9.5', '9.215', 'Request No : Adwea-188 Based On Purchase Orders 2353.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1668, 'XAD001077', '2022-09-06', 'Safety Impact Gloves', 'Al Bahri Hardware & Safety Eqpt LLC', 'Pair', '18', '17.46', 'Project : DU SFAN  Requested by : Mufeed KK  Verified By : Ansar Abbas & Sharafu TK Based On Purchase Orders 505.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1669, 'XAD001077', '2023-12-12', 'Safety Impact Gloves', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Pair', '42', '40.74', 'REQUEST NO 269 Based On Purchase Orders 3624.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1670, 'XAD001078', '2023-12-27', 'Marker / Protection Post Etisalat', 'Bright Wave General Contracting LLC', 'PCS', '87', '84.39', 'Request No : AAN-OCT-23-0089-0090 . Based On Purchase Orders 3311.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1671, 'XAD001078', '2024-01-03', 'Marker / Protection Post Etisalat', 'Frontier Innovation General Trading', 'PCS', '87', '84.39', 'REQUEST NO WR301 101H PROJECT Based On Purchase Orders 3700.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1672, 'XAD001078', '2024-02-14', 'Marker / Protection Post Etisalat', 'Elfit Arabia', 'PCS', '83', '80.51', 'REQUEST NO 310  WR 101H PROJECT Based On Purchase Orders 4090.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1673, 'XAD001082', '2022-10-22', 'Hard Drive', 'Azlan Star Technologies LLC', 'PCS', '710', '688.7', 'Hard Disk & RAM For Razik It Derpartment Based On Purchase Orders 962.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1674, 'XAD001082', '2023-02-21', 'Hard Drive', 'Ultra Stream Technologies LLC', 'PCS', '225', '218.25', '2TB WD External HDD Required For HR & Accounts Departments Based On Purchase Orders 1758.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1675, 'XAD001082', '2023-07-27', 'Hard Drive', 'The Mark Infotech System Solutions LLC', 'PCS', '344', '333.68', '2 External HDDs Required For CEO & Documents Server Offsite Backup . Based On Purchase Orders 2824.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1676, 'XAD001082', '2023-09-09', 'Hard Drive', 'Wide Vision Technology LLC', 'PCS', '374.85', '363.6045', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1677, 'XAD001082', '2023-12-23', 'Hard Drive', 'SKYMAX GENERAL TRADING FZE', 'PCS', '355', '344.35', 'External Hard Disk For Backup Purpose Based On Purchase Orders 3676.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1678, 'XAD001083', '2022-09-03', 'Fiber Optic Central Cutter', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '60', '58.2', 'Project : FDH AAN Requested By : Nikunj Patel Verified By : Mr Shamas Tabraiz Based On Purchase Orders 544.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1679, 'XAD001084', '2023-02-15', 'Sign Board with Xad Technologies Logo', 'M S K Corporate Services Provides EST', 'PCS', '270', '261.9', 'Request No : WR 101H - 214 - Feb 2023. Based On Purchase Orders 1737.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1680, 'XAD001087', '2023-05-19', 'Letterheads in conquer paper', 'M S K Corporate Services Provides EST', 'PCS', '2.5', '2.425', 'Letter Head Required For XAD Car Rental . Based On Purchase Orders 2383.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1681, 'XAD001088', '2023-09-06', 'ELCB Breaker 100 Amp 4 Pole', 'Noor Al Iman', 'PCS', '230', '223.1', 'Request No : XAD -HW - SEP - DXB-098 Based On Purchase Orders 3114.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1682, 'XAD001089', '2022-10-04', 'I Lugs 6mm U Shape Insulated', 'Noor Al Iman', 'PCS', '20', '19.4', 'Request No : ADWEA 67 & 65 & 71 Requested By : Screenth CK  Verified By : Wasiullah Khan & Badiurreman Based On Purchase Orders 638.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1683, 'XAD001089', '2022-10-13', 'I Lugs 6mm U Shape Insulated', 'Ali Asghar Hussani', 'PCS', '0.2', '0.194', 'Request No : ADWEA 73 Requested By : Screenath CK  Verified By : Wasiullah Khan Based On Purchase Orders 687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1684, 'XAD001091', '2022-10-04', 'Locknut Fitting 25mm For GI Conduite', 'Noor Al Iman', 'PCS', '3.5', '3.395', 'Request No : ADWEA 67 & 65 & 71 Requested By : Screenth CK  Verified By : Wasiullah Khan & Badiurreman Based On Purchase Orders 638.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1685, 'XAD001092', '2023-01-26', 'Trunking 25X38mm end Cap', 'Ali Asghar Hussani', 'PCS', '1', '0.97', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1686, 'XAD001092', '2023-03-08', 'Trunking 25X38mm end Cap', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1726.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1687, 'XAD001093', '2022-10-04', 'I lugs 6x6mm U Shape Insulated', 'Noor Al Iman', 'PKT', '25', '24.25', 'Request No : ADWEA 67 & 65 & 71 Requested By : Screenth CK  Verified By : Wasiullah Khan & Badiurreman Based On Purchase Orders 638.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1688, 'XAD001093', '2022-10-10', 'I lugs 6x6mm U Shape Insulated', 'Smooth Solution building Materails Trading LLC', 'PKT', '18', '17.46', 'Request No : ADWEA 75  Requested By : Screenath CK  Verified By : Wasiullah Khan & Badiurrehman Based On Purchase Orders 776.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1689, 'XAD001094', '2022-09-23', 'Multi Meter Fluke Extra 110', 'Azlan Star Technologies LLC', 'PCS', '720', '698.4', 'Request No : XAD-001 Requested By : Bashir Subhani Based On Purchase Orders 650.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1690, 'XAD001094', '2022-11-16', 'Multi Meter Fluke Extra 110', 'Noor Al Iman', 'PCS', '185', '179.45', 'Huawei Based On Purchase Orders 1231.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1691, 'XAD001097', '2022-10-06', 'Drill Machine 800W H.R 2600 Makita', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '499', '484.03', 'Request No : XAD-001 Requested By : Bashir Subhani Based On Purchase Orders 678.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1692, 'XAD001097', '2023-12-21', 'Drill Machine 800W H.R 2600 Makita', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '750', '727.5', 'REQUEST NO 11 ICT SCHOOL PROJECT Based On Purchase Orders 3689.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1693, 'XAD001098', '2022-10-15', 'Warning Tap With DU logo', 'Frontier Innovation General Trading', 'Roll', '95', '92.15', 'JRC Precast & Other All Material Is DU Standard  Request No : Sep-009 AUH DU SFAN Civil Liwa Requested By : Sufian Shaukat  Verified By : rafaqat Mehmood & Imran Iqbal Requested By : Sufian Shaukat  Verified By : rafaqat Mehmood & Imran Iqbal Based On Pu', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1694, 'XAD001100', '2023-01-24', 'SSD Crucial 500 GB', 'Azlan Star Technologies LLC', 'PCS', '151', '146.47', 'New SSD Required For Ms Mona &  Emirati Staff Laptop. Based On Purchase Orders 1595.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1695, 'XAD001100', '2023-01-31', 'SSD Crucial 500 GB', 'Ultra Stream Technologies LLC', 'PCS', '145', '140.65', 'Requested By : Raziq Shah Verified By : Raja M Ali Prepared By : Raja Zeeshan  Hard Disk For IT Department Data Backups & SSD For Kamran Shaheen Laptop & Wahab Wajid Laptop . Based On Purchase Orders 1543.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1696, 'XAD001100', '2023-03-16', 'SSD Crucial 500 GB', 'The Mark Infotech System Solutions LLC', 'PCS', '140', '135.8', '3 New HardDisk SSD For Adwea & Common Faulty Laptop\'s . Based On Purchase Orders 1925.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1697, 'XAD001100', '2023-08-18', 'SSD Crucial 500 GB', 'MAQSOOD & ABDUL HAFEEZ COMPUTERS TRADING LLC', 'PCS', '114.29', '110.8613', 'New SSD & USB Required For Backup Purpose IT Department . Based On Purchase Orders 3028.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1698, 'XAD001101', '2022-09-23', '8GB DDR 4 Pullout', 'The Mark Infotech System Solutions LLC', 'PCS', '99.75', '96.7575', 'Laptop Repairing For Mr Rafaqat Mehmood WR 101H. Based On Purchase Orders 698.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1699, 'XAD001102', '2022-09-28', 'CH340 USB to RS485 Converter Module', 'Besomi Electronices', 'PCS', '14', '13.58', 'Request No : ADWEA 75 Requested By : Screenath CK & Jawad Malik Verified By : Wasiullah Khan Based On Purchase Orders 712.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1700, 'XAD001102', '2022-11-14', 'CH340 USB to RS485 Converter Module', 'Azlan Star Technologies LLC', 'PCS', '9', '8.73', 'Request no : ADWEA 99 November Based On Purchase Orders 1218.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1701, 'XAD001103', '2023-08-02', 'Wood Box ( Vehicle )', 'Muhammad Younas Nawab Techincal Service', 'PCS', '550', '533.5', 'Request No : XAD-HW-July-DXB-111  Wooden Box Required For Nissan Navara ( 21052 ) Huawei Project . Based On Purchase Orders 2746.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1702, 'XAD001103', '2024-02-03', 'Wood Box ( Vehicle )', 'SM And Rahmani Building Materials Trading LLC', 'PCS', '229.52', '222.6344', 'Wood Box Payment Required For Huawei Project Based On Purchase Orders 4027.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1703, 'XAD001104', '2022-10-21', 'Stamp As Per Design', 'M S K Corporate Services Provides EST', 'PCS', '110', '106.7', 'Stamp for Abu Dhabi office documents . Based On Purchase Orders 728.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1704, 'XAD001104', '2022-12-22', 'Stamp As Per Design', 'Crystal Time Awards Gifts Preparing LLC', 'PCS', '80', '77.6', 'Request No : XAD-SIRIUS-UK-007 Based On Purchase Orders 1430.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1705, 'XAD001105', '2022-11-08', 'Black Cement', 'MAA ALMADINA BUILDING MATERIAL', 'Bag', '12', '11.64', 'Request No : AAN-101H-OCT-009  Requested By ; Sufian Shaukat  Verified By     : SHamas Tabraiz & Imran Iqbal Based On Purchase Orders 994.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1706, 'XAD001105', '2023-11-11', 'Black Cement', 'Al Moazam Stores LLC', 'Bag', '13', '12.61', 'Request No : AAN-OLT-OCT-23-0094 & 0091 .  Consumable Civil Material Required For AAN-OLT Project Nov-2023 . Based On Purchase Orders 3416.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1707, 'XAD001106', '2023-02-18', 'Wall Mountain Pole ( With Copper Erester & Steo Clamp Set ) 3 Mtr', 'AERO TRading LLC', 'PCS', '1140', '1105.8', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1704.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1708, 'XAD001106', '2023-06-10', 'Wall Mountain Pole ( With Copper Erester & Steo Clamp Set ) 3 Mtr', 'GRACE STEEL FABRICATION & WELDING WORKSHOP EST', 'PCS', '1120', '1086.4', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2337.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1709, 'XAD001107', '2023-02-14', 'Distribution BOX HT-5 TSM ( EMKAY )', 'Smooth Solution building Materails Trading LLC', 'PCS', '7.5', '7.275', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1687.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1710, 'XAD001108', '2022-10-15', 'Water Stopper Polybit 250mmx15M', 'MAA ALMADINA BUILDING MATERIAL', 'Roll', '150', '145.5', 'Request No : L&T Ruwais 209 2-Oct-2022 Requested By : Jahanzaib Anwar Verified By     : Rafaqat Mehmood & Imran Iqbal Based On Purchase Orders 803.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1711, 'XAD001108', '2022-11-15', 'Water Stopper Polybit 250mmx15M', 'Henkel Polybit Industries LTD', 'Roll', '295', '286.15', 'Request No : AAN-Nov-009  Requested By : Sufian Shaukat Verified By      : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 1134.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1712, 'XAD001108', '2023-02-02', 'Water Stopper Polybit 250mmx15M', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '275', '266.75', 'Request No : AAN-Jan23-007 Based On Purchase Orders 1611.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1713, 'XAD001108', '2023-03-29', 'Water Stopper Polybit 250mmx15M', 'Al Moazam Stores LLC', 'Roll', '18', '17.46', 'Request No : AAN-March-0024-10-03-2023 . Based On Purchase Orders 1965.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1714, 'XAD001110', '2023-01-12', '120 Ohms Resister Quarter Watt', 'First Moon Electronics Trading', 'PCS', '0.08', '0.0776', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1483.', '2024-10-09 03:56:58', '2024-10-09 03:56:58');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1715, 'XAD001112', '2022-09-09', 'OTDR Exfo battery', 'Alpha Link Technologies LLC', 'PCS', '1590', '1542.3', 'New Battery For Exfo OTDR   Requested By : Sufian Shaukat  Verified By : Imran Iqbal Based On Purchase Orders 797.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1716, 'XAD001113', '2022-10-15', 'Bitumen Paint Black', 'MAA ALMADINA BUILDING MATERIAL', 'GLN', '25', '24.25', 'Request No : L&T Ruwais 209 2-Oct-2022 Requested By : Jahanzaib Anwar Verified By     : Rafaqat Mehmood & Imran Iqbal Based On Purchase Orders 803.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1717, 'XAD001113', '2023-05-01', 'Bitumen Paint Black', 'Al Moazam Stores LLC', 'GLN', '30', '29.1', 'Request No : AAN-April-0035-08-04-2023 . Based On Purchase Orders 2175.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1718, 'XAD001114', '2023-09-12', 'Wood Bar 3 x 3 \"', 'Al Moazam Stores LLC', 'PCS', '18.04', '17.4988', 'Request No : AAN-Aug-23-080 Based On Purchase Orders 3159.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1719, 'XAD001114', '2024-01-11', 'Wood Bar 3 x 3 \"', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '18.9', '18.333', 'Request No : AHUOLT-0057-Oct-23 Based On Purchase Orders 3422.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1720, 'XAD001115', '2023-02-09', 'GI Pipe 3 Inch 2M 2mm', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '35', '33.95', 'Request No : WR 101H - 234 - Feb-2023 . Based On Purchase Orders 1660.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1721, 'XAD001116', '2023-05-22', 'Optical Probe', 'Tespro Hongkong Technology Limited', 'PCS', '201.98', '195.9206', 'Optical Probe ( China ) For Data Communication Required For Adwea Project . Based On Purchase Orders 2364.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1722, 'XAD001117', '2022-10-17', 'PG Gland 9mm', 'Ali Asghar Hussani', 'PCS', '0.3', '0.291', 'Requested By : Muhammad Talha Verified By : Zeeshan Mushtaq Based On Purchase Orders 841.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1723, 'XAD001117', '2022-12-29', 'PG Gland 9mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.46', '0.4462', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1481.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1724, 'XAD001118', '2024-02-26', 'ID Card', 'M S K Corporate Services Provides EST', 'PCS', '0.64', '0.6208', 'PVC ID CARDS Based On Purchase Orders 4167.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1725, 'XAD001119', '2023-03-07', '500 V  / TCU  / PVC  / PVC [BSEN50288] 1 Pair X 0.81 mm2 (18 AWG ) VV-FR 1X2X18 AWG (Beldon)', 'Securintec Information Technology LLC', 'MTR', '1.4', '1.358', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1726, 'XAD001119', '2023-03-24', '500 V  / TCU  / PVC  / PVC [BSEN50288] 1 Pair X 0.81 mm2 (18 AWG ) VV-FR 1X2X18 AWG (Beldon)', 'TEKAB Co LLC', 'MTR', '1.57', '1.5229', 'Request No : Adwea-129-Jan-2023. Based On Purchase Orders 1608.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1727, 'XAD001120', '2022-12-23', '500 V  / TCU  / FPE / IS / OS / PVC [BSEN50288] 2 Pair X 0.22 mm2 ( 24 AWG ) OA8V-FR 2X2X24 AWG (Beldon)', 'TEKAB Co LLC', 'MTR', '4.57', '4.4329', 'TEKAB Brand Communication Cable For ADWEA Project.  Request No : ADWEA-AUH-80 Requested By : Jawad Malik & Screenath Ck Verified By : Wasiullah Khan Based On Purchase Orders 864.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1728, 'XAD001120', '2023-03-07', '500 V  / TCU  / FPE / IS / OS / PVC [BSEN50288] 2 Pair X 0.22 mm2 ( 24 AWG ) OA8V-FR 2X2X24 AWG (Beldon)', 'Securintec Information Technology LLC', 'MTR', '2', '1.94', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1729, 'XAD001121', '2023-06-21', '500 V  / TCU  / FPE / OS / OBRD / PVC [BS5308-2] 1 Pair X 0.35 mm2 ( 22 AWG ) OA7C4TV-FR-OR-UV 1X2X22 AWG (Beldon)', 'TEKAB Co LLC', 'MTR', '3.14', '3.0458', 'Request No : Adwea - 140 - 5th Batch For May . Based On Purchase Orders 1717.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1730, 'XAD001122', '2023-06-17', 'Cable Tie 700mm Black', 'Ali Asghar Hussani', 'PKT', '37', '35.89', 'Request No : AAN-June-23-0053 - 02-06-2023 . Based On Purchase Orders 2479.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1731, 'XAD001123', '2022-10-22', 'Cable Tie 950mm Black', 'Ali Asghar Hussani', 'PKT', '80', '77.6', 'Requested By : Nikunj Patel Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 903.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1732, 'XAD001123', '2023-05-03', 'Cable Tie 950mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '72', '69.84', 'Request Noi : AUH-OLT-0023 Based On Purchase Orders 2218.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1733, 'XAD001124', '2022-12-12', 'Masking Tape 1\'\'', 'Ali Asghar Hussani', 'PCS', '0.7', '0.679', 'Request No : AAN-101H/018 Based On Purchase Orders 1310.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1734, 'XAD001125', '2023-10-02', 'Tissue Box', 'Cash', 'Box', '2.25', '2.1825', 'Request No : AAN-Aug-23-0078 . Based On Purchase Orders 3081.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1735, 'XAD001125', '2023-11-24', 'Tissue Box', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Box', '2.25', '2.1825', 'Request No : Etisalat SmartHome-XAD-006-NE-November 2023 Based On Purchase Orders 3480.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1736, 'XAD001125', '2024-02-15', 'Tissue Box', 'Ali Asghar Hussani', 'Box', '2', '1.94', 'REQUEST NO : XAD-007-NE-FEB\'24  NE REGION Based On Purchase Orders 4085.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1737, 'XAD001126', '2022-10-22', 'Charcoal Fiuid Lighter (kerosene)', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Requested By : Nikunj Patel Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 903.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1738, 'XAD001128', '2022-10-22', 'Sign Board Wooden ( Etisalat Sign )', 'M S K Corporate Services Provides EST', 'PCS', '380', '368.6', 'Request No : AAN-101H -OCT-004 Requested By : Sufian Shaukat Verified By : Shamas Tabraiz & Imran iqbal Based On Purchase Orders 909.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1739, 'XAD001129', '2024-01-10', 'Sign Board Wooden ( Men At Work )', 'M S K Corporate Services Provides EST', 'PCS', '218.5', '211.945', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1740, 'XAD001130', '2024-01-10', 'Sign Board Wooden ( Deep Excavation )', 'M S K Corporate Services Provides EST', 'PCS', '270', '261.9', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1741, 'XAD001131', '2022-10-18', 'Flip Chart Pad ( Board , Marker , Duster )', 'M S K Corporate Services Provides EST', 'PCS', '480', '465.6', 'Flip Chart Board For AUH Training Room. Based On Purchase Orders 919.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1742, 'XAD001132', '2022-10-18', 'OTDR AFL Charger / Power Adapter ( FS200 )', 'MITTCO Llc', 'PCS', '200', '194', 'OTDR Power Adapter AFL Charger For (Sagheer Ahmad) DU SFAN Staff. Request No :  DU SFAN-Sep 20220-70  Requested By : Ahmad tqbal Verified By : Ansar Iqbal & Sharafu TK Based On Purchase Orders 920.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1743, 'XAD001133', '2022-10-20', '28-Port Gigabit Smart Managed Poe Switch DGS-1210-28MP', 'Instant Technology Dubai U.A.E', 'PCS', '1190', '1154.3', 'Dlink DGS-1210-28MP POE Network Switch For ADWEA Project. Based On Purchase Orders 930.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1744, 'XAD001134', '2023-01-17', 'Beldon Cable 79841 NH', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '7.4', '7.178', 'Request No : Adwea-112-December Based On Purchase Orders 1485.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1745, 'XAD001135', '2022-10-22', 'Ramcro 19841', 'Smooth Solution building Materails Trading LLC', 'MTR', '2.9', '2.813', 'Request No : ADWEA-86-OCT  Requested By : Screenath Ck & Jawad Malik Verified By     : Wasiullah Khan Based On Purchase Orders 945.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1746, 'XAD001137', '2022-11-10', 'Tool Issuance Form', 'M S K Corporate Services Provides EST', 'PCS', '20', '19.4', 'Tool & Consumable Issuance Book For Xad Warehouses. Based On Purchase Orders 955.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1747, 'XAD001138', '2022-11-24', 'RAM 32 GB', 'Azlan Star Technologies LLC', 'PCS', '137', '132.89', '16GB DDR4 RAM For CPU In Opal Office . Based On Purchase Orders 1312.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1748, 'XAD001138', '2023-01-31', 'RAM 32 GB', 'Ultra Stream Technologies LLC', 'PCS', '85', '82.45', 'Request No : DU SFAN-101-DXB  Ram Required For DU SFAN Coordinator Basharat Safdar . Based On Purchase Orders 1620.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1749, 'XAD001138', '2023-08-22', 'RAM 32 GB', 'Power Plus Technologies LLC', 'PCS', '255', '247.35', '32GB Crucial Ram DDR4 Required For Badi Urrehman , Arif , Hurais DU SFAN Project . Based On Purchase Orders 3030.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1750, 'XAD001138', '2023-09-26', 'RAM 32 GB', 'SKYMAX GENERAL TRADING FZE', 'PCS', '215', '208.55', 'Request No : XAD-4-Sep-2023-1  4TB HDD & Ram 32GB Required For EMS FLEET OwnCloud Purpose Data Sharing . Based On Purchase Orders 3271.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1751, 'XAD001139', '2022-12-27', 'Claw Hammer', 'Smooth Solution building Materails Trading LLC', 'PCS', '17', '16.49', 'Request No : Adwea-108-Dec Based On Purchase Orders 1406.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1752, 'XAD001139', '2023-03-08', 'Claw Hammer', 'Noor Al Iman', 'PCS', '10', '9.7', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1848.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1753, 'XAD001139', '2023-07-06', 'Claw Hammer', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'Requested No : OSP-LMP-15-DXB-AUH-NE Based On Purchase Orders 2630.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1754, 'XAD001141', '2023-06-23', 'Printer Toner & Cartridge Black', 'Evolve Technologies LLC', 'Pair', '265', '257.05', 'Printer Toner Replacement Model ( Pro Jet MFP M477fdw & Jet CP5225n ) For AUH Office . Based On Purchase Orders 2641.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1755, 'XAD001141', '2023-12-19', 'Printer Toner & Cartridge Black', 'Copier Range Trading EST', 'Pair', '155', '150.35', 'Request DEC 23 0099 AAN 101H Based On Purchase Orders 3650.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1756, 'XAD001142', '2023-06-14', 'Printer Toner & Cartridge Cyan', 'Evolve Technologies LLC', 'Pair', '220', '213.4', 'Printer Toner Canon C5240  Requried For AUH Warehosue . Based On Purchase Orders 2539.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1757, 'XAD001142', '2023-12-19', 'Printer Toner & Cartridge Cyan', 'Copier Range Trading EST', 'Pair', '95', '92.15', 'Request DEC 23 0099 AAN 101H Based On Purchase Orders 3650.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1758, 'XAD001143', '2023-12-19', 'Printer Toner & Cartridge Magenta', 'Copier Range Trading EST', 'Pair', '95', '92.15', 'Request DEC 23 0099 AAN 101H Based On Purchase Orders 3650.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1759, 'XAD001143', '2023-06-14', 'Printer Toner & Cartridge Magenta', 'Evolve Technologies LLC', 'Pair', '265', '257.05', 'Printer Toner Canon C5240  Requried For AUH Warehosue . Based On Purchase Orders 2539.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1760, 'XAD001144', '2023-08-22', 'Printer Toner & Cartridge Yellow', 'Evolve Technologies LLC', 'Pair', '525', '509.25', 'Printer Toner Required For Canon C5240 For AUH Warehouse . Based On Purchase Orders 3010.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1761, 'XAD001145', '2022-10-31', 'Buffer Tube 8mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '190', '184.3', 'Request No : DU SFAN-OCT-74  Requested By : Ahmad Iqbal Verified By      : Sharafu Tk & Imran Iqbal Based On Purchase Orders 1009.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1762, 'XAD001145', '2023-09-02', 'Buffer Tube 8mm', 'Ali Asghar Hussani', 'Roll', '180', '174.6', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1763, 'XAD001146', '2022-10-29', 'Dlink Cat 6 UTP Cable24AWG', 'Azlan Star Technologies LLC', 'Roll', '307', '297.79', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1012.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1764, 'XAD001146', '2023-04-17', 'Dlink Cat 6 UTP Cable24AWG', 'ADS Sfcmuty Dtvicfs Trading LLC', 'Roll', '201', '194.97', 'Request No : XAD-ICT-001-17-04-2023 . Based On Purchase Orders 2206.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1765, 'XAD001147', '2022-10-29', 'Dlink Cat 6 UTP Cable24AWG Blue', 'Azlan Star Technologies LLC', 'Roll', '310', '300.7', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1012.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1766, 'XAD001148', '2022-11-02', 'Electircal Cable 3Core 1.5mm White', 'Smooth Solution building Materails Trading LLC', 'Roll', '195', '189.15', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1767, 'XAD001148', '2023-03-07', 'Electircal Cable 3Core 1.5mm White', 'Securintec Information Technology LLC', 'Roll', '150', '145.5', 'Based On Purchase Orders 1819.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1768, 'XAD001149', '2022-11-02', 'Electircal Cable 3Core 2.5mm White', 'Smooth Solution building Materails Trading LLC', 'Roll', '320', '310.4', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1769, 'XAD001150', '2022-11-02', 'Weatherproof Electrical Junction box IP55', 'Smooth Solution building Materails Trading LLC', 'PCS', '25', '24.25', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1770, 'XAD001151', '2023-01-23', 'Single Port Data Outlet Socket With Module For RJ45', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '16', '15.52', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1771, 'XAD001151', '2023-02-09', 'Single Port Data Outlet Socket With Module For RJ45', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '8', '7.76', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1692.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1772, 'XAD001151', '2023-05-24', 'Single Port Data Outlet Socket With Module For RJ45', 'Smooth Solution building Materails Trading LLC', 'PCS', '5.5', '5.335', 'Request No : OSP-07-09-05-2023 . Based On Purchase Orders 2391.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1773, 'XAD001152', '2022-11-02', 'Dual Port Data Outlet Socket For RJ45', 'Smooth Solution building Materails Trading LLC', 'PCS', '32', '31.04', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1774, 'XAD001152', '2023-01-23', 'Dual Port Data Outlet Socket For RJ45', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '26', '25.22', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1775, 'XAD001152', '2023-01-30', 'Dual Port Data Outlet Socket For RJ45', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '20', '19.4', 'Request No : SmartHome-XAD-006-Jan-2023. Based On Purchase Orders 1635.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1776, 'XAD001153', '2022-11-02', 'GI Box 3*3', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1777, 'XAD001153', '2023-01-21', 'GI Box 3*3', 'Noor Al Iman', 'PCS', '2', '1.94', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1778, 'XAD001153', '2023-01-30', 'GI Box 3*3', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2', '1.94', 'Request No : SmartHome-XAD-006-Jan-2023. Based On Purchase Orders 1635.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1779, 'XAD001154', '2023-03-31', 'PVC Box 3*3', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1780, 'XAD001154', '2023-06-10', 'PVC Box 3*3', 'Noor Al Iman', 'PCS', '1.5', '1.455', 'Request No : SmartHome-XAD-013-13-03-2023 . Based On Purchase Orders 2042.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1781, 'XAD001154', '2023-12-27', 'PVC Box 3*3', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '1.5', '1.455', 'Smart Home Request No 002 Smart Home Project Based On Purchase Orders 3706.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1782, 'XAD001154', '2024-01-05', 'PVC Box 3*3', 'Ali Asghar Hussani', 'PCS', '1.75', '1.6975', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1783, 'XAD001155', '2023-01-12', 'DC Cable 4mm Blue', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '1.7', '1.649', 'Request No : DU SFAN - 93 - Jan - 2023 Based On Purchase Orders 1527.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1784, 'XAD001155', '2024-01-13', 'DC Cable 4mm Blue', 'Smooth Solution building Materails Trading LLC', 'MTR', '1.66', '1.6102', 'DC Cable For DU SFAN Project Based On Purchase Orders 3669.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1785, 'XAD001155', '2024-02-22', 'DC Cable 4mm Blue', 'Noor Al Iman', 'MTR', '1.66', '1.6102', 'REQUEST NO : 304  DU SFAN PROJECT DXB REGION Based On Purchase Orders 4149.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1786, 'XAD001156', '2023-12-07', 'DC Cable 4mm Black', 'Smooth Solution building Materails Trading LLC', 'MTR', '1.66', '1.6102', 'Request Number 267 DU SFAN November-2023 Based On Purchase Orders 3460.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1787, 'XAD001157', '2022-10-31', 'DC Cable 4mm Y/G', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '2.05', '1.9885', 'Request No : DU SFAN-OCT-2022 76 Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1014.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1788, 'XAD001157', '2023-07-05', 'DC Cable 4mm Y/G', 'Smooth Solution building Materails Trading LLC', 'MTR', '1.7', '1.649', 'Request No : DU SFAN-194 . Based On Purchase Orders 2642.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1789, 'XAD001157', '2024-02-22', 'DC Cable 4mm Y/G', 'Noor Al Iman', 'MTR', '1.66', '1.6102', 'DU SFAN PROJECT DXB REGION Based On Purchase Orders 4149.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1790, 'XAD001158', '2022-11-02', 'DC Fuse 16A', 'Smooth Solution building Materails Trading LLC', 'MTR', '12', '11.64', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1015.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1791, 'XAD001158', '2023-01-12', 'DC Fuse 16A', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '10', '9.7', 'Request No : DU SFAN - 93 - Jan - 2023 Based On Purchase Orders 1527.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1792, 'XAD001159', '2022-10-31', 'DC Breaker Single Pole 16A', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '16.5', '16.005', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1014. Based On Goods Receipt PO 387.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1793, 'XAD001160', '2023-03-30', 'I Lugs 4mm Blue', 'Ali Asghar Hussani', 'PKT', '4', '3.88', 'Request No : Adwea-168-18-03-2023 . Based On Purchase Orders 1991.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1794, 'XAD001160', '2023-04-03', 'I Lugs 4mm Blue', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '4', '3.88', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1795, 'XAD001161', '2022-11-16', 'I Lugs 4mm Black', 'Noor Al Iman', 'PKT', '5', '4.85', 'Huawei Based On Purchase Orders 1231.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1796, 'XAD001161', '2023-03-08', 'I Lugs 4mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '5', '4.85', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1797, 'XAD001162', '2022-10-31', 'Thimble Lugs Insulated 4mm Blue', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '30', '29.1', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1014. Based On Goods Receipt PO 387.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1798, 'XAD001163', '2022-10-31', 'Thimble Lugs Insulated 4mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '3000', '2910', 'Request No : DU SFAN-OCT-2022 76  Requested By : Mufeed kk  Verified By      : Ansar Abbas & Sharafu TK Based On Purchase Orders 1014. Based On Goods Receipt PO 387.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1799, 'XAD001165', '2023-02-20', 'Console Cable Rj45 to USB Male', 'Azlan Star Technologies LLC', 'PCS', '20', '19.4', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1800, 'XAD001165', '2024-02-15', 'Console Cable Rj45 to USB Male', 'The Mark Infotech System Solutions LLC', 'PCS', '20', '19.4', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4073.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1801, 'XAD001168', '2023-02-27', 'Junction Box 4 way White 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : Adwea-153-156-155- 24-02-2023 Based On Purchase Orders 1793.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1802, 'XAD001169', '2023-02-16', 'Velcro Tape 20mmx25 M', 'Smooth Solution building Materails Trading LLC', 'MTR', '2.2', '2.134', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1672.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1803, 'XAD001169', '2023-11-11', 'Velcro Tape 20mmx25 M', 'Ali Asghar Hussani', 'MTR', '45', '43.65', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1804, 'XAD001170', '2023-05-25', 'Uniform Polo Shirt Navy Blue with logo Xad Auto Mobile Services - M', 'Emporium Gulf', 'PCS', '26', '25.22', 'New Shirt\'s Required For XAD AutoMobile Workshop ( 04-15-2023 ) Based On Purchase Orders 2132.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1805, 'XAD001172', '2022-10-25', 'Uniform Polo Shirt Navy Blue with logo Xad Auto Mobile Services - XL', 'Emporium Gulf', 'PCS', '28', '27.16', 'New Shirts For Xad AutoMobile Workshop .  Requested By : Wahab Aslam Verified By      : Wahab Aslam Based On Purchase Orders 1053.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1806, 'XAD001173', '2022-10-25', 'Uniform Polo Shirt Navy Blue with logo Xad Auto Mobile Services - XXL', 'Emporium Gulf', 'PCS', '28', '27.16', 'New Shirts For Xad AutoMobile Workshop .  Requested By : Wahab Aslam Verified By      : Wahab Aslam Based On Purchase Orders 1053.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1807, 'XAD001174', '2022-10-25', 'Uniform Polo Shirt Navy Blue with logo Xad Auto Mobile Services - XXXL', 'Emporium Gulf', 'PCS', '28', '27.16', 'New Shirts For Xad AutoMobile Workshop .  Requested By : Wahab Aslam Verified By      : Wahab Aslam Based On Purchase Orders 1053.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1808, 'XAD001176', '2023-12-21', 'Uniform Polo Shirt Ash Grey with logo Xad SmartHome Etisalat - S', 'Emporium Gulf', 'PCS', '38', '36.86', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1809, 'XAD001177', '2023-06-23', 'Uniform Polo Shirt Ash Grey with logo Xad SmartHome Etisalat - M', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : SmartHome-XAD-0013- Based On Purchase Orders 2554.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1810, 'XAD001178', '2023-06-23', 'Uniform Polo Shirt Ash Grey with logo Xad SmartHome Etisalat - L', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : SmartHome-XAD-0013- Based On Purchase Orders 2554.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1811, 'XAD001179', '2023-06-23', 'Uniform Polo Shirt Ash Grey with logo Xad SmartHome Etisalat - XL', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : SmartHome-XAD-0013- Based On Purchase Orders 2554.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1812, 'XAD001180', '2023-06-23', 'Uniform Polo Shirt Ash Grey with logo Xad SmartHome Etisalat - XXL', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : SmartHome-XAD-0013- Based On Purchase Orders 2554.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1813, 'XAD001181', '2023-06-23', 'Uniform Polo Shirt Ash Grey with logo Xad SmartHome Etisalat - XXXL', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : SmartHome-XAD-0013- Based On Purchase Orders 2554.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1814, 'XAD001182', '2022-11-08', 'PVC Glands 13.5 mm', 'Noor Al Iman', 'PCS', '1', '0.97', 'Request No : Huawei-Sep-DXB-066  Requested By : Sohail Abbas Verified By      : Sohail Abbas Based On Purchase Orders 1082.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1815, 'XAD001182', '2023-02-14', 'PVC Glands 13.5 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.64', '0.6208', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1686.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1816, 'XAD001182', '2023-03-17', 'PVC Glands 13.5 mm', 'Wenzhou Zhechi', 'PCS', '0.19', '0.1843', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1817, 'XAD001183', '2022-11-03', 'Stainless Steel Hole Saw Bit 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '5', '4.85', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1818, 'XAD001184', '2022-11-03', 'Stainless Steel Hole Saw 20mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '10', '9.7', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1819, 'XAD001184', '2023-01-23', 'Stainless Steel Hole Saw 20mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '18.66', '18.1002', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1820, 'XAD001184', '2023-03-08', 'Stainless Steel Hole Saw 20mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '13', '12.61', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1821, 'XAD001185', '2022-11-03', 'Stainless Steel Hole Saw Bit 20mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '5', '4.85', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1822, 'XAD001186', '2022-11-03', 'Garbage Bag', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.05', '1.0185', 'Request No : ADWEA-95  Requested By : Jawad Malik & Screenath Ck  Verified By      : Wasiullah Khan Based On Purchase Orders 1084.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1823, 'XAD001188', '2022-11-30', 'Uniform T shirt for Logistic Team- S', 'Emporium Gulf', 'PCS', '24', '23.28', 'New Shirt\'s For Warehouse Logistics Team Requested By : Muhammad Shahab Verified By      : Wahab Aslam Based On Purchase Orders 1135.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1824, 'XAD001190', '2022-11-05', 'Uniform Polo Shirt White with logo Huawei FTTR  - L', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : Huawei-FTTR-Oct-2022 ( 78 )  Requested By : Mufeed KK  Verified by      : Ansar Abbas Based On Purchase Orders 1136.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1825, 'XAD001191', '2022-11-05', 'Uniform Polo Shirt White with logo Huawei FTTR  - M', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : Huawei-FTTR-Oct-2022 ( 78 )  Requested By : Mufeed KK  Verified by      : Ansar Abbas Based On Purchase Orders 1136.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1826, 'XAD001192', '2022-11-05', 'Uniform Polo Shirt White with logo Huawei FTTR  -XL', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : Huawei-FTTR-Oct-2022 ( 78 )  Requested By : Mufeed KK  Verified by      : Ansar Abbas Based On Purchase Orders 1136.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1827, 'XAD001193', '2022-11-05', 'Uniform Polo Shirt White with logo Huawei FTTR  - XXL', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : Huawei-FTTR-Oct-2022 ( 78 )  Requested By : Mufeed KK  Verified by      : Ansar Abbas Based On Purchase Orders 1136.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1828, 'XAD001196', '2023-07-15', 'Bunker Bed', 'Dream Land Furniture', 'SET', '261.57', '253.7229', 'Request No : WR-236-11-03-2023 . Based On Purchase Orders 1904.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1829, 'XAD001196', '2023-09-05', 'Bunker Bed', 'Great Wall Furnitures Trading LLC', 'SET', '198.79', '192.8263', 'New Staff Arrangement For DU SFAN Project DXB Accommodation 21-08-2023 . Based On Purchase Orders 3045.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1830, 'XAD001196', '2024-02-27', 'Bunker Bed', 'Cash', 'SET', '150', '145.5', 'New Bed, AC & Gas Stove For 5 New Room In Al Quoz System Camp. Based On Purchase Orders 1657. Based On Goods Receipt PO 2602.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1831, 'XAD001197', '2023-07-15', 'Mattress', 'Dream Land Furniture', 'PCS', '69.09', '67.0173', 'Request No : WR-236-11-03-2023 . Based On Purchase Orders 1904.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1832, 'XAD001197', '2023-09-05', 'Mattress', 'Great Wall Furnitures Trading LLC', 'PCS', '49.69', '48.1993', 'New Staff Arrangement For DU SFAN Project DXB Accommodation 21-08-2023 . Based On Purchase Orders 3045.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1833, 'XAD001197', '2024-02-16', 'Mattress', 'Ola Al Madina SuperMarket', 'PCS', '55.24', '53.5828', 'Mattress For 101H Project Staff(Purchase Due To Emergency Situation In AAN) Based On Purchase Orders 4111.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1834, 'XAD001197', '2024-02-16', 'Mattress', 'Cash', 'PCS', '60', '58.2', 'Materials Purchase In Emergency To Support Etisalat. Based On Purchase Orders 4112.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1835, 'XAD001198', '2023-09-05', 'Pillow', 'Great Wall Furnitures Trading LLC', 'PCS', '8.95', '8.6815', 'New Staff Arrangement For DU SFAN Project DXB Accommodation 21-08-2023 . Based On Purchase Orders 3045.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1836, 'XAD001198', '2023-11-14', 'Pillow', 'Cash', 'PCS', '16.01', '15.5297', 'Request No : Adwea - 206 - AUH -04-09-2023 Based On Purchase Orders 3108.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1837, 'XAD001198', '2024-02-16', 'Pillow', 'Ola Al Madina SuperMarket', 'PCS', '8.1', '7.857', 'Blanket , Pillow & Mattress For  101H Project Staff(Purchase Due To Emergency Situation In AAN) Based On Purchase Orders 4110.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1838, 'XAD001199', '2023-09-05', 'Blanket', 'Great Wall Furnitures Trading LLC', 'PCS', '29.82', '28.9254', 'New Staff Arrangement For DU SFAN Project DXB Accommodation 21-08-2023 . Based On Purchase Orders 3045.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1839, 'XAD001199', '2024-02-16', 'Blanket', 'Cash', 'PCS', '40', '38.8', 'Materials Purchase In Emergency To Support Etisalat. Based On Purchase Orders 4112.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1840, 'XAD001199', '2024-02-17', 'Blanket', 'Ola Al Madina SuperMarket', 'PCS', '33.33', '32.3301', 'Blankets Required For 101H Project Staff. Based On Purchase Orders 4108.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1841, 'XAD001200', '2022-10-21', 'NCR Book - Invoice & Vehicle Inspection', 'M S K Corporate Services Provides EST', 'PCS', '600', '582', 'NCR Books & Stickers For Xad AutoMobile Services Based On Purchase Orders 1191.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1842, 'XAD001201', '2022-10-21', 'Stickers Xad Auto Services', 'M S K Corporate Services Provides EST', 'PCS', '0.2', '0.194', 'NCR Books & Stickers For Xad AutoMobile Services Based On Purchase Orders 1191.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1843, 'XAD001202', '2022-11-14', 'Cat6 Lane Cable 3M', 'Azlan Star Technologies LLC', 'PCS', '4.5', '4.365', 'Request no : ADWEA 99 November Based On Purchase Orders 1218.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1844, 'XAD001203', '2022-11-14', 'Plastic Marking Box For Labeling', 'Azlan Star Technologies LLC', 'PCS', '0.16', '0.1552', 'Request no : ADWEA 99 November Based On Purchase Orders 1218.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1845, 'XAD001204', '2022-11-19', 'Drill bit concrete 35 mm', 'Ali Asghar Hussani', 'PCS', '40', '38.8', 'Based On Purchase Orders 1230.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1846, 'XAD001205', '2022-12-28', 'Screw Driver + insulated 200mm', 'Noor Al Iman', 'PCS', '12', '11.64', 'Based On Purchase Orders 1450.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1847, 'XAD001205', '2023-02-16', 'Screw Driver + insulated 200mm', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Based On Purchase Orders 1701.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1848, 'XAD001206', '2022-12-28', 'Screw Driver - insulated 200mm', 'Noor Al Iman', 'PCS', '12', '11.64', 'Based On Purchase Orders 1450.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1849, 'XAD001206', '2023-02-16', 'Screw Driver - insulated 200mm', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Based On Purchase Orders 1701.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1850, 'XAD001207', '2023-02-14', 'T-Handle Hex Key Allen Wrench Set ( 2mm to 10mm ) Star', 'Ali Asghar Hussani', 'SET', '35', '33.95', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1697.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1851, 'XAD001207', '2023-04-03', 'T-Handle Hex Key Allen Wrench Set ( 2mm to 10mm ) Star', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'SET', '29', '28.13', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1852, 'XAD001208', '2022-11-28', 'Wall Scraper 8 \"', 'Ali Asghar Hussani', 'PCS', '12', '11.64', 'Request No : DU SFAN-83-DXB Based On Purchase Orders 1290.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1853, 'XAD001209', '2023-12-21', 'Cap with Du Logo', 'Emporium Gulf', 'PCS', '10', '9.7', 'DU Civil Work Request No : 2 Based On Purchase Orders 3621.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1854, 'XAD001210', '2022-12-19', 'Rubber Sheet 6mmx10Mtr', 'Ali Asghar Hussani', 'Roll', '550', '533.5', 'Request No : ADWEA-101-Nov Based On Purchase Orders 1355.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1855, 'XAD001211', '2024-02-02', 'Business Card', 'M S K Corporate Services Provides EST', 'PCS', '0.22', '0.2134', 'REQUEST NO : 09 Based On Purchase Orders 4014.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1856, 'XAD001212', '2022-12-29', 'Gypsum Screw 1.5\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.05', '0.0485', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1481.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1857, 'XAD001212', '2023-03-31', 'Gypsum Screw 1.5\"', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.02', '0.0194', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1858, 'XAD001212', '2024-01-05', 'Gypsum Screw 1.5\"', 'Ali Asghar Hussani', 'PCS', '0.05', '0.0485', 'Smart Home Project Based On Purchase Orders 3769.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1859, 'XAD001213', '2023-01-26', 'Cable Sleeve 6mm Black', 'Ali Asghar Hussani', 'MTR', '0.45', '0.4365', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1860, 'XAD001214', '2023-01-26', 'Cable Sleeve 12/6mm Yellow 100m', 'Ali Asghar Hussani', 'MTR', '0.45', '0.4365', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1496.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1861, 'XAD001215', '2022-11-28', 'Power Cable 4mm 3 core Ducab', 'Smooth Solution building Materails Trading LLC', 'MTR', '5.65', '5.4805', 'Requiest No : ADWEA-101-AUH Based On Purchase Orders 1283.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1862, 'XAD001215', '2023-01-05', 'Power Cable 4mm 3 core Ducab', 'Ali Asghar Hussani', 'MTR', '5.6', '5.432', 'Request No : ADWEA-106-AUH Based On Purchase Orders 1382.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1863, 'XAD001215', '2023-04-12', 'Power Cable 4mm 3 core Ducab', 'Smooth Solution building Materails Trading LLC', 'MTR', '5.64', '5.4708', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1864, 'XAD001216', '2022-11-28', 'PG 7 Glands', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.5', '0.485', 'Requiest No : ADWEA-101-AUH Based On Purchase Orders 1283.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1865, 'XAD001216', '2023-03-17', 'PG 7 Glands', 'Wenzhou Zhechi', 'PCS', '0.09', '0.0873', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1866, 'XAD001216', '2023-04-03', 'PG 7 Glands', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.4', '0.388', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1867, 'XAD001217', '2023-01-30', 'Junction Box 2,3,4 Way Cover & screw', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.5', '0.485', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1868, 'XAD001219', '2023-01-05', 'Cable Clip Round 8mm White', 'Ali Asghar Hussani', 'PCS', '0.03', '0.0291', 'Request No : ADWEA-106-AUH Based On Purchase Orders 1382.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1869, 'XAD001219', '2023-01-23', 'Cable Clip Round 8mm White', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '0.05', '0.0485', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1870, 'XAD001219', '2023-01-30', 'Cable Clip Round 8mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.05', '0.0485', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1871, 'XAD001219', '2023-03-17', 'Cable Clip Round 8mm White', 'Wenzhou Zhechi', 'PCS', '0.08', '0.0776', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1872, 'XAD001219', '2023-04-19', 'Cable Clip Round 8mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.05', '0.0485', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2129.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1873, 'XAD001220', '2022-10-04', 'Cable Clip Round 6mm White', 'Ali Asghar Hussani', 'PCS', '0.06', '0.0582', 'Request No : ADWEA 71 Based On Purchase Orders 691.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1874, 'XAD001220', '2023-01-30', 'Cable Clip Round 6mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.04', '0.0388', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1875, 'XAD001220', '2023-03-08', 'Cable Clip Round 6mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.03', '0.0291', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1876, 'XAD001220', '2023-03-17', 'Cable Clip Round 6mm White', 'Wenzhou Zhechi', 'PCS', '0.06', '0.0582', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1877, 'XAD001221', '2022-11-30', 'Fisher S 6', 'Ali Asghar Hussani', 'PCS', '0.02', '0.0194', 'Request No : ADWEA-105-Nov-2022 Based On Purchase Orders 1341.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1878, 'XAD001221', '2023-04-19', 'Fisher S 6', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.03', '0.0291', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2129.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1879, 'XAD001221', '2023-07-17', 'Fisher S 6', 'Ali Asghar Hussani', 'PCS', '0.02', '0.0194', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1880, 'XAD001222', '2023-01-30', 'Junction Box 3 way Black', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.5', '2.425', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1881, 'XAD001222', '2023-03-02', 'Junction Box 3 way Black', 'Noor Al Iman', 'PCS', '2.75', '2.6675', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1882, 'XAD001222', '2023-03-17', 'Junction Box 3 way Black', 'Wenzhou Zhechi', 'PCS', '0.68', '0.6596', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1883, 'XAD001223', '2023-01-21', 'Gypsum Screw 1 Inches', 'Noor Al Iman', 'PCS', '0.04', '0.0388', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1884, 'XAD001223', '2023-02-10', 'Gypsum Screw 1 Inches', 'Ali Asghar Hussani', 'PCS', '0.02', '0.0194', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1885, 'XAD001223', '2023-03-07', 'Gypsum Screw 1 Inches', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.02', '0.0194', 'Request No : SmartHome-Xad-008-009-010- Dubai - Al Ain - Abu Dhabi - 27-02-2023 . Based On Purchase Orders 1851.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1886, 'XAD001224', '2022-09-14', 'Steel Cable Tie 4.6 X 150mm', 'Wenzhou Zhechi', 'PKT', '11.74', '11.3878', 'All Material Purchase From China for Xad All Projects. Invoice No : XAD2202 6-SEp-2022 Based On Purchase Orders 648.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1887, 'XAD001224', '2023-05-08', 'Steel Cable Tie 4.6 X 150mm', 'Ali Asghar Hussani', 'PKT', '15', '14.55', 'Consumable Material Required For Nokia Mobile Project For May 2023 .. Based On Purchase Orders 2267.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1888, 'XAD001225', '2023-02-16', 'Safety Shoes 39#', 'Noor Al Iman', 'Pair', '35', '33.95', 'Request No : XAD-HW-Jan-DXB-084 Based On Purchase Orders 1703.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1889, 'XAD001225', '2023-12-07', 'Safety Shoes 39#', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Pair', '38', '36.86', 'Smart Home Etisalat Safety Shoes Request Based On Purchase Orders 3594.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1890, 'XAD001225', '2024-02-15', 'Safety Shoes 39#', 'Ali Asghar Hussani', 'Pair', '38', '36.86', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4065.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1891, 'XAD001226', '2022-11-28', 'Cat 6 Cable Blue', 'Smooth Solution building Materails Trading LLC', 'MTR', '1.18', '1.1446', 'Requiest No : ADWEA-101-AUH Based On Purchase Orders 1283.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1892, 'XAD001226', '2023-02-11', 'Cat 6 Cable Blue', 'Azlan Star Technologies LLC', 'MTR', '1.1', '1.067', 'Based On Purchase Orders 1702.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1893, 'XAD001226', '2023-06-13', 'Cat 6 Cable Blue', 'The Mark Infotech System Solutions LLC', 'MTR', '0.5', '0.485', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2526.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1894, 'XAD001226', '2023-11-14', 'Cat 6 Cable Blue', 'FIBER LINK COMPUTER TRADING LLC', 'MTR', '0.96', '0.9312', 'Request No : Nokia-Nov-2023.   Cat6 Armoured Cable & Connector Required For Nokia Project . Based On Purchase Orders 3477.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1895, 'XAD001227', '2023-01-23', 'Rj45 Connector for Cat 6 Cable', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '0.45', '0.4365', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1896, 'XAD001227', '2023-02-11', 'Rj45 Connector for Cat 6 Cable', 'Azlan Star Technologies LLC', 'PCS', '0.35', '0.3395', 'Based On Purchase Orders 1702.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1897, 'XAD001227', '2023-03-31', 'Rj45 Connector for Cat 6 Cable', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.38', '0.3686', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1898, 'XAD001227', '2023-07-27', 'Rj45 Connector for Cat 6 Cable', 'The Mark Infotech System Solutions LLC', 'PCS', '0.1', '0.097', 'Request No : DU SFAN-213 . Based On Purchase Orders 2807.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1899, 'XAD001227', '2023-09-09', 'Rj45 Connector for Cat 6 Cable', 'Wide Vision Technology LLC', 'PCS', '0.2', '0.194', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1900, 'XAD001227', '2023-11-11', 'Rj45 Connector for Cat 6 Cable', 'Ali Asghar Hussani', 'PCS', '0.18', '0.1746', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1901, 'XAD001227', '2024-02-15', 'Rj45 Connector for Cat 6 Cable', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.18', '0.1746', 'REQUEST NO : XAD-007-NE-FEB\'24  NE REGION Based On Purchase Orders 4086.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1902, 'XAD001228', '2023-05-19', 'Cat5 - cat6 Boot', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.25', '0.2425', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1903, 'XAD001228', '2023-07-27', 'Cat5 - cat6 Boot', 'The Mark Infotech System Solutions LLC', 'PCS', '0.1', '0.097', 'Request No : DU SFAN-213 . Based On Purchase Orders 2807.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1904, 'XAD001228', '2023-11-11', 'Cat5 - cat6 Boot', 'Ali Asghar Hussani', 'PCS', '0.18', '0.1746', 'Request no 267 DUSFAN Nov-2023 Based On Purchase Orders 3459.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1905, 'XAD001229', '2023-01-25', 'Coach Bolt 10mmx2.5\"', 'Noor Al Iman', 'PCS', '0.75', '0.7275', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1906, 'XAD001229', '2023-06-14', 'Coach Bolt 10mmx2.5\"', 'Ali Asghar Hussani', 'PCS', '2', '1.94', 'Consumable Material Required For Nokia Mobile Project M/O June 2023 . Based On Purchase Orders 2522.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1907, 'XAD001230', '2023-02-11', 'Cat 6 Cable Black', 'Azlan Star Technologies LLC', 'MTR', '1.6', '1.552', 'Based On Purchase Orders 1702.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1908, 'XAD001230', '2024-01-18', 'Cat 6 Cable Black', 'FIBER LINK COMPUTER TRADING LLC', 'MTR', '2.22', '2.1534', 'Cat 6 Cable For Nokia OD Project Based On Purchase Orders 3919.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1909, 'XAD001231', '2022-12-28', 'Cat 6 Cable Black', 'Noor Al Iman', 'Pair', '1.25', '1.2125', 'Based On Purchase Orders 1450.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1910, 'XAD001231', '2022-12-30', 'Cat 6 Cable Black', 'Mills LTD', 'Pair', '6.97', '6.7609', 'Request No : XAD-SIRIUS-UK-004 Based On Purchase Orders 1427.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1911, 'XAD001231', '2023-03-17', 'Cat 6 Cable Black', 'Wenzhou Zhechi', 'Pair', '0.94', '0.9118', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922. Based On Goods Receipt PO 1194.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1912, 'XAD001231', '2023-04-12', 'Cat 6 Cable Black', 'Smooth Solution building Materails Trading LLC', 'Pair', '1', '0.97', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2041.', '2024-10-09 03:56:58', '2024-10-09 03:56:58'),
(1913, 'XAD001231', '2023-12-12', 'Cat 6 Cable Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Pair', '1.25', '1.2125', 'Request No : 55 Based On Purchase Orders 3617.', '2024-10-09 03:56:59', '2024-10-09 03:56:59');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(1914, 'XAD001231', '2024-02-28', 'Cat 6 Cable Black', 'Ali Asghar Hussani', 'Pair', '1', '0.97', 'REQUEST NO : AAN-2024-108  AAN REGION Based On Purchase Orders 4156.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1915, 'XAD001232', '2022-12-19', 'Masking Tape 3\"', 'Ali Asghar Hussani', 'PCS', '2.7', '2.619', 'Request No : WR 101H - 118 Based On Purchase Orders 1401.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1916, 'XAD001233', '2022-12-19', 'Cable Tray 150x50mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '45', '43.65', 'Request No : DU SFAN - 88 - 5-Dec-2022 Based On Purchase Orders 1410.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1917, 'XAD001233', '2023-11-04', 'Cable Tray 150x50mm', 'AVADH METAL & BUILDING MATERIAL TRADING LLC', 'PCS', '32.5', '31.525', 'Request No : XAD -Atlas - July - AUH-1 Based On Purchase Orders 2871.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1918, 'XAD001234', '2022-12-20', 'Step Manhole', 'MITTCO Llc', 'PCS', '13.5', '13.095', 'Request No : JRC DU Standard  Etihad Rail L&T -03 - DXB Based On Purchase Orders 1411.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1919, 'XAD001234', '2023-03-08', 'Step Manhole', 'Frontier Innovation General Trading', 'PCS', '27', '26.19', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1856.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1920, 'XAD001235', '2022-12-19', 'Tray Rubber 12mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '6', '5.82', 'Request no : DU SFAN-88-Dec Based On Purchase Orders 1403.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1921, 'XAD001238', '2022-12-20', 'Cable Barrier', 'MITTCO Llc', 'PCS', '23.5', '22.795', 'Request No : JRC DU Standard  Etihad Rail L&T -03 - DXB Based On Purchase Orders 1411.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1922, 'XAD001240', '2022-12-20', 'Anchor Iron', 'MITTCO Llc', 'PCS', '23.5', '22.795', 'Request No : JRC DU Standard Etihad Rail L&T -03 - DXB Based On Purchase Orders 1411.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1923, 'XAD001241', '2022-12-20', 'Dymo Labeling Machine Rhino 4200', 'Azlan Star Technologies LLC', 'PCS', '370', '358.9', 'Request No : XAD-SIRIUS-UK-004 Based On Purchase Orders 1426.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1924, 'XAD001242', '2022-12-30', 'Ear Defender', 'Mills LTD', 'PCS', '27.62', '26.7914', 'Request No : XAD-SIRIUS-UK-004 Based On Purchase Orders 1427.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1925, 'XAD001246', '2022-12-29', 'AC Power Cable 4 Core (16mm)', 'Ali Asghar Hussani', 'MTR', '9.23', '8.9531', 'Request  No : XAD-HW-DEC-DXB-078 Based On Purchase Orders 1446.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1926, 'XAD001247', '2022-12-29', 'AC Power Cable 5 Core (16mm)', 'Ali Asghar Hussani', 'MTR', '12.5', '12.125', 'Based On Purchase Orders 1449.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1927, 'XAD001247', '2023-12-04', 'AC Power Cable 5 Core (16mm)', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '14', '13.58', 'Consumable Material Grounding & AC Power Cable Required For Nokia Project. Nov-2023 Based On Purchase Orders 3563.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1928, 'XAD001247', '2024-01-15', 'AC Power Cable 5 Core (16mm)', 'Noor Al Iman', 'MTR', '15.76', '15.2872', 'Consumeables Materia For Nokia TI Project Based On Purchase Orders 3860.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1929, 'XAD001249', '2023-05-27', 'Steel Bell Mounth 100mm', 'Elfit Arabia', 'PCS', '185', '179.45', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2313.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1930, 'XAD001254', '2024-02-27', 'Gas Stove', 'Cash', 'PCS', '205.74', '199.5678', 'New Bed, AC & Gas Stove For 5 New Room In Al Quoz System Camp. Based On Purchase Orders 1657. Based On Goods Receipt PO 2602.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1931, 'XAD001255', '2023-11-14', 'Gas Cylinder', 'Cash', 'PCS', '345.22', '334.8634', 'Request No : Adwea - 206 - AUH -04-09-2023 Based On Purchase Orders 3108.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1932, 'XAD001261', '2023-03-08', 'Holesaw Arbor', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '6', '5.82', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1933, 'XAD001262', '2023-01-30', 'Hole saw bit 6mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '4.5', '4.365', 'Request No : Adwea-114-Dec-2022 Based On Purchase Orders 1482.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1934, 'XAD001262', '2023-02-14', 'Hole saw bit 6mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2', '1.94', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1686.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1935, 'XAD001265', '2023-01-31', 'QR Code Scanner', 'Ultra Stream Technologies LLC', 'PCS', '250', '242.5', 'Requested By : Muhammad Shahab Verified By : Raja M Ali & Razik Shah Prepared By : Raja Zeeshan  QR code for AUH store For Smart Meter Scanning. Based On Purchase Orders 1541.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1936, 'XAD001266', '2023-07-17', 'Hole Saw 32mm With Arbor', 'Ali Asghar Hussani', 'PCS', '22', '21.34', 'Request No : XAD-HW-June-DXB-108 Based On Purchase Orders 2731.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1937, 'XAD001267', '2023-01-23', 'Electrical Cable 3 Core .75mm', 'JOGA RAM GENERAL TRADING LLC', 'MTR', '1.23', '1.1931', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1938, 'XAD001267', '2024-01-02', 'Electrical Cable 3 Core .75mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'MTR', '1.3', '1.261', 'Smart Home Request No 002 Smart Home Project Based On Purchase Orders 3706.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1939, 'XAD001267', '2024-02-15', 'Electrical Cable 3 Core .75mm', 'Ali Asghar Hussani', 'MTR', '1.3', '1.261', 'REQUEST NO : XAD-007-NE-FEB\'24  NE REGION Based On Purchase Orders 4085.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1940, 'XAD001268', '2023-12-27', 'ELECTRICAL Socket Single Weather Proof 13 Amp', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '26', '25.22', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1941, 'XAD001268', '2024-02-15', 'ELECTRICAL Socket Single Weather Proof 13 Amp', 'Ali Asghar Hussani', 'PCS', '22', '21.34', 'REQUEST NO : XAD-007-NE-FEB\'24  NE REGION Based On Purchase Orders 4085.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1942, 'XAD001269', '2023-01-23', 'Plastic Cover For Shoe', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '0.01', '0.0097', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1943, 'XAD001269', '2023-02-10', 'Plastic Cover For Shoe', 'Ali Asghar Hussani', 'PCS', '0.25', '0.2425', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1944, 'XAD001269', '2023-04-19', 'Plastic Cover For Shoe', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.04', '0.0388', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2129.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1945, 'XAD001270', '2023-01-23', 'Cable Clip Round 25mm Black', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '0.08', '0.0776', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1946, 'XAD001270', '2023-06-13', 'Cable Clip Round 25mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.35', '0.3395', 'Request No : SmartHome-XAD-0015-06-06-2023 . Based On Purchase Orders 2519.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1947, 'XAD001270', '2023-09-27', 'Cable Clip Round 25mm Black', 'Cash', 'PCS', '0.25', '0.2425', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1948, 'XAD001271', '2024-01-13', 'Cable Clip Round 25mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.3', '0.291', 'Cable Clip For Smart Home Project Based On Purchase Orders 3900.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1949, 'XAD001271', '2024-01-14', 'Cable Clip Round 25mm White', 'Cash', 'PCS', '0.26', '0.2522', 'Spray Paint & Cable Clip For OSP LMP Project Based On Purchase Orders 3902.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1950, 'XAD001271', '2024-02-15', 'Cable Clip Round 25mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.22', '0.2134', 'REQUEST NO : SMART HOME-XAD-008-FEB\'24  AUH REGION Based On Purchase Orders 4081.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1951, 'XAD001271', '2024-02-28', 'Cable Clip Round 25mm White', 'Ali Asghar Hussani', 'PCS', '0.23', '0.2231', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1952, 'XAD001272', '2023-01-21', 'PVC Pipe White 20 mm', 'Noor Al Iman', 'PCS', '3.5', '3.395', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1953, 'XAD001272', '2023-03-31', 'PVC Pipe White 20 mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '3.75', '3.6375', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1954, 'XAD001272', '2023-10-03', 'PVC Pipe White 20 mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3.5', '3.395', 'Request No : Etisalat - SmartHome - XAD-043 - 03-10-2023 . Based On Purchase Orders 3230.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1955, 'XAD001273', '2023-01-21', 'PVC Box 4*4', 'Noor Al Iman', 'PCS', '5', '4.85', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1956, 'XAD001273', '2023-02-09', 'PVC Box 4*4', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3.5', '3.395', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1692.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1957, 'XAD001273', '2023-04-17', 'PVC Box 4*4', 'Madina Al Safia Computer Electric Access Tra LLC', 'PCS', '5', '4.85', 'Request No : XAD-ICT-001-17-04-2023 . Based On Purchase Orders 2207.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1958, 'XAD001273', '2023-09-27', 'PVC Box 4*4', 'Cash', 'PCS', '5', '4.85', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1959, 'XAD001274', '2023-01-21', 'Saddle 20mm white', 'Noor Al Iman', 'PCS', '0.55', '0.5335', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1960, 'XAD001274', '2023-02-10', 'Saddle 20mm white', 'Ali Asghar Hussani', 'PCS', '0.3', '0.291', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1691.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1961, 'XAD001274', '2023-03-31', 'Saddle 20mm white', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.55', '0.5335', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1962, 'XAD001274', '2023-10-03', 'Saddle 20mm white', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.45', '0.4365', 'Request No : Etisalat - SmartHome - XAD-043 - 03-10-2023 . Based On Purchase Orders 3230.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1963, 'XAD001275', '2023-04-19', 'Electrical Strip Connector', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2', '1.94', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2129.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1964, 'XAD001276', '2023-01-21', 'GI Saddle 20mm', 'Noor Al Iman', 'PCS', '0.3', '0.291', 'Request No : XAD-001-004-Jan-2023 Based On Purchase Orders 1570.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1965, 'XAD001277', '2023-02-15', 'GI Clip 25mm', 'Noor Al Iman', 'PCS', '0.42', '0.4074', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1966, 'XAD001278', '2023-12-27', 'ELECTRICAL Socket Double Weather Proof 13 Amp', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '35', '33.95', 'REQUEST NO XAD 005 NE DEC 23  SMART HOME PROJECT Based On Purchase Orders 3692.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1967, 'XAD001278', '2024-02-15', 'ELECTRICAL Socket Double Weather Proof 13 Amp', 'Ali Asghar Hussani', 'PCS', '28', '27.16', 'REQUEST NO : XAD-007-NE-FEB\'24  NE REGION Based On Purchase Orders 4085.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1968, 'XAD001282', '2023-07-12', 'Pulling Rod 14mm x 500M', 'Elfit Arabia', 'PCS', '4600', '4462', 'Request No : DU SFAN-189-29-05-2023 . Based On Purchase Orders 2477.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1969, 'XAD001283', '2023-01-25', 'Allen Key T 15', 'Noor Al Iman', 'PCS', '5', '4.85', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1970, 'XAD001283', '2023-09-20', 'Allen Key T 15', 'Ali Asghar Hussani', 'PCS', '18', '17.46', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1971, 'XAD001284', '2023-01-25', 'Allen Key T 20', 'Noor Al Iman', 'PCS', '6', '5.82', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1972, 'XAD001284', '2023-09-20', 'Allen Key T 20', 'Ali Asghar Hussani', 'PCS', '19', '18.43', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1973, 'XAD001285', '2023-01-25', 'Allen Key T 25', 'Noor Al Iman', 'PCS', '7', '6.79', 'Based On Purchase Orders 1579.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1974, 'XAD001285', '2023-09-20', 'Allen Key T 25', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Request No : Nokia Mobile - Sep - 2023 . Based On Purchase Orders 3187.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1975, 'XAD001286', '2023-03-18', 'Spray Permanent Black', 'Noor Al Iman', 'PCS', '5', '4.85', 'Consumable Material For Nokia-OD & IBS Project To The Month Of March . Based On Purchase Orders 1907.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1976, 'XAD001287', '2023-11-06', 'Spray Permanent Chrome', 'Noor Al Iman', 'PCS', '5', '4.85', 'Request No : Nokia-OCT-2023 Based On Purchase Orders 3448.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1977, 'XAD001288', '2023-01-28', 'Tie Rod Blade', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '6', '5.82', 'Request No : Etihad Rail L&T-4-DXB-Jan-2023 Based On Purchase Orders 1588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1978, 'XAD001289', '2023-01-05', 'Cable Clip Round 12mm White', 'Ali Asghar Hussani', 'PCS', '0.09', '0.0873', 'Request No : ADWEA-106-AUH Based On Purchase Orders 1382.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1979, 'XAD001289', '2023-03-08', 'Cable Clip Round 12mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.06', '0.0582', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1845.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1980, 'XAD001290', '2023-01-30', 'PVC Box 6x3 ( for Twin Socket )', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '6', '5.82', 'Request No : SmartHome-XAD-006-Jan-2023. Based On Purchase Orders 1635.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1981, 'XAD001290', '2023-03-31', 'PVC Box 6x3 ( for Twin Socket )', 'Smooth Solution building Materails Trading LLC', 'PCS', '2.25', '2.1825', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1982, 'XAD001290', '2023-06-10', 'PVC Box 6x3 ( for Twin Socket )', 'Noor Al Iman', 'PCS', '3', '2.91', 'Request No : SmartHome-XAD-013-13-03-2023 . Based On Purchase Orders 2042.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1983, 'XAD001291', '2023-02-03', 'Heat Shrink Tube 45mm', 'MITTCO Llc', 'PCS', '1.4', '1.358', 'Request No : AAN-Jan23-007 Based On Purchase Orders 1616.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1984, 'XAD001293', '2023-01-30', 'GI Female Adapter 25mm', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '2.75', '2.6675', 'Request No : SmartHome-XAD-006-Jan-2023. Based On Purchase Orders 1635.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1985, 'XAD001294', '2023-01-26', 'Tarpoline Sheet 18x24', 'Cash', 'PCS', '350', '339.5', 'Waterproof Tarpoline Sheet Required For Logistics 4 Ton Vehicle . Based On Purchase Orders 1642.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1986, 'XAD001297', '2023-02-06', 'Uniform Polo Shirt Navy Blue with logo Xad & Etisalat - XL', 'Emporium Gulf', 'PCS', '27', '26.19', 'Request No : Adwea-127-Jan-2023. Based On Purchase Orders 1677.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1987, 'XAD001298', '2023-02-06', 'Uniform Polo Shirt Navy Blue with logo Xad & Etisalat - L', 'Emporium Gulf', 'PCS', '27', '26.19', 'Request No : Adwea-127-Jan-2023. Based On Purchase Orders 1677.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1988, 'XAD001299', '2023-02-06', 'Uniform Polo Shirt Navy Blue with logo Xad & Etisalat - M', 'Emporium Gulf', 'PCS', '27', '26.19', 'Request No : Adwea-127-Jan-2023. Based On Purchase Orders 1677.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1989, 'XAD001300', '2023-02-06', 'Uniform Polo Shirt Navy Blue with logo Xad & Etisalat - S', 'Emporium Gulf', 'PCS', '27', '26.19', 'Request No : Adwea-127-Jan-2023. Based On Purchase Orders 1677.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1990, 'XAD001301', '2023-02-17', 'Thimble Lugs 12*16', 'Ali Asghar Hussani', 'PCS', '0.33', '0.3201', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1688.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1991, 'XAD001301', '2023-03-02', 'Thimble Lugs 12*16', 'Noor Al Iman', 'PCS', '0.35', '0.3395', 'Request No : Adwea-157-March-2023. Based On Purchase Orders 1846.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1992, 'XAD001302', '2023-02-17', 'Terminal Blocks 4 mm', 'Ali Asghar Hussani', 'PCS', '0.8', '0.776', 'Request No : Adwea-134-Feb-2023. Based On Purchase Orders 1688.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1993, 'XAD001303', '2023-02-09', 'Face Plate Single Port Data Outlet Socket For RJ45', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '3', '2.91', 'Request No : SmartHome- XAD-007-Feb-2023. Based On Purchase Orders 1692.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1994, 'XAD001306', '2023-02-14', 'Screw Driver + 75mm Normal', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1697.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1995, 'XAD001306', '2023-03-08', 'Screw Driver + 75mm Normal', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1848.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1996, 'XAD001307', '2023-04-03', 'Screw Driver - 75mm Normal', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '7', '6.79', 'Request No : Adwea-174-28-03-2023 . Based On Purchase Orders 2040.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1997, 'XAD001307', '2023-02-14', 'Screw Driver - 75mm Normal', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'Request No : ADWEA-136-Feb-2023. Based On Purchase Orders 1697.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1998, 'XAD001307', '2023-03-08', 'Screw Driver - 75mm Normal', 'Noor Al Iman', 'PCS', '4', '3.88', 'Request No : ADWEA-158-March-2023 . Based On Purchase Orders 1848.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(1999, 'XAD001308', '2023-02-15', 'Rubber Sleeve For Ladder', 'Noor Al Iman', 'MTR', '5', '4.85', 'Based On Purchase Orders 1700.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2000, 'XAD001309', '2023-02-10', 'Rollup Banner', 'M S K Corporate Services Provides EST', 'PCS', '220', '213.4', 'Based On Purchase Orders 1709.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2001, 'XAD001311', '2023-02-10', 'Office Signage with 4 Spencer fix', 'M S K Corporate Services Provides EST', 'PCS', '100', '97', 'Based On Purchase Orders 1709.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2002, 'XAD001312', '2023-02-10', 'Frame With Certificate', 'M S K Corporate Services Provides EST', 'PCS', '50', '48.5', 'Based On Purchase Orders 1709.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2003, 'XAD001313', '2023-02-10', 'Exit Signage With Print and Lamination', 'M S K Corporate Services Provides EST', 'PCS', '10', '9.7', 'Based On Purchase Orders 1709.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2004, 'XAD001315', '2023-03-23', 'JRC 12 Precast With Frame and Cover', 'Cendhurr Telecom LLC', 'SET', '3000', '2910', 'Request No : WR 101H - 214 - Feb 2023. Based On Purchase Orders 1732.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2005, 'XAD001315', '2024-01-03', 'JRC 12 Precast With Frame and Cover', 'Frontier Innovation General Trading', 'SET', '3000', '2910', 'REQUEST NO WR301 101H PROJECT Based On Purchase Orders 3700.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2006, 'XAD001316', '2023-03-23', 'JRC 04 Precast With Frame and Cover', 'Cendhurr Telecom LLC', 'SET', '1500', '1455', 'Request No : WR 101H - 214 - Feb 2023. Based On Purchase Orders 1732.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2007, 'XAD001316', '2024-01-03', 'JRC 04 Precast With Frame and Cover', 'Frontier Innovation General Trading', 'SET', '1520', '1474.4', 'REQUEST NO WR301 101H PROJECT Based On Purchase Orders 3700.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2008, 'XAD001317', '2023-04-03', 'Drop Fiber Black 2 Core', 'Cendhurr Telecom LLC', 'Drum', '300', '291', 'Request No : OSP-01-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2008.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2009, 'XAD001317', '2023-04-05', 'Drop Fiber Black 2 Core', 'Azlan Star Technologies LLC', 'Drum', '290', '281.3', 'Request No : OSP-01-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2056.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2010, 'XAD001317', '2023-06-20', 'Drop Fiber Black 2 Core', 'MITTCO Llc', 'Drum', '390', '378.3', 'Request No : OSP - 13 - DXB-AUH-NE Date : 14-06-2023 . Based On Purchase Orders 2595.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2011, 'XAD001317', '2023-12-12', 'Drop Fiber Black 2 Core', 'The Mark Infotech System Solutions LLC', 'Drum', '285', '276.45', 'Request No : 55 Based On Purchase Orders 3619.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2012, 'XAD001317', '2023-12-14', 'Drop Fiber Black 2 Core', 'The Mark Infotech System Solutions LLC', 'Drum', '395', '383.15', 'REQUEST NO 54 OSP LMP Based On Purchase Orders 3635.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2013, 'XAD001317', '2024-01-05', 'Drop Fiber Black 2 Core', 'FIBER LINK COMPUTER TRADING LLC', 'Drum', '290', '281.3', 'REQUEST NO OSP LMP 1-JAN 24  Drop Fibre For OSP LMP Project Based On Purchase Orders 3824.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2014, 'XAD001318', '2023-02-22', 'Marker Post Stricker ( White )', 'Famous Advertising', 'PCS', '85', '82.45', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1752.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2015, 'XAD001319', '2023-02-22', 'Marker Post Stricker ( Green )', 'Famous Advertising', 'PCS', '85', '82.45', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1752.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2016, 'XAD001320', '2023-02-22', 'Marker Psot Stricker ( Etisalat Logo )', 'Famous Advertising', 'PCS', '2.2', '2.134', 'Request No : WR 101H-222-11-02-2023. Based On Purchase Orders 1752.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2017, 'XAD001321', '2023-02-20', 'Console Cable USB Mini Male to USB Male', 'Azlan Star Technologies LLC', 'PCS', '22', '21.34', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2018, 'XAD001322', '2023-02-20', 'Flash Drive Sandisk 32GB USB', 'Azlan Star Technologies LLC', 'PCS', '32', '31.04', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2019, 'XAD001322', '2023-07-12', 'Flash Drive Sandisk 32GB USB', 'The Mark Infotech System Solutions LLC', 'PCS', '16', '15.52', 'Request No : DU SFAN - 194 . Based On Purchase Orders 2711.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2020, 'XAD001323', '2023-02-20', 'Rj45 Keystone Jack ( Angled Adaptor with Rj 45 Modular Jack )', 'Azlan Star Technologies LLC', 'PCS', '5', '4.85', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2021, 'XAD001324', '2023-02-20', 'Face Plate Dual Port Data Outlet Socket For RJ45', 'Azlan Star Technologies LLC', 'PCS', '3.5', '3.395', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2022, 'XAD001325', '2023-02-20', 'HardDisk 2TB', 'Azlan Star Technologies LLC', 'PCS', '530', '514.1', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1780.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2023, 'XAD001325', '2023-07-27', 'HardDisk 2TB', 'The Mark Infotech System Solutions LLC', 'PCS', '190', '184.3', '2 External HDDs Required For CEO & Documents Server Offsite Backup . Based On Purchase Orders 2824.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2024, 'XAD001325', '2023-09-27', 'HardDisk 2TB', 'Cash', 'PCS', '175', '169.75', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2025, 'XAD001326', '2023-02-24', 'GI Conduite Gland 25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.75', '1.6975', 'Request No : DU SFAN-114-20-Feb-2023 Based On Purchase Orders 1782.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2026, 'XAD001327', '2023-02-27', 'Junction Box 25mm White Cover', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.38', '0.3686', 'Request No : Adwea-153-156-155- 24-02-2023 Based On Purchase Orders 1793.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2027, 'XAD001328', '2023-03-13', 'GPS Receiver For PC and Laptops (BU-353-S4 Globalsat)', 'Cash', 'PCS', '144.7', '140.359', 'Request No : XAD-HW-FEB-DXB-087 Based On Purchase Orders 1796.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2028, 'XAD001329', '2023-03-03', 'DC to AC Power Inverter ( 500 Watt )', 'Cash', 'PCS', '90', '87.3', 'Request No : XAD-HW-FEB-DXB-087 Based On Purchase Orders 1796.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2029, 'XAD001329', '2023-05-17', 'DC to AC Power Inverter ( 500 Watt )', 'The Mark Infotech System Solutions LLC', 'PCS', '90', '87.3', 'Request No : Adwea-189-06-05-2023 . Based On Purchase Orders 2331.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2030, 'XAD001330', '2023-02-25', 'D-Link Router', 'Data Computer Technology LLC', 'PCS', '400', '388', 'New Router For DSO Office 24-02-2023. Based On Purchase Orders 1808.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2031, 'XAD001331', '2023-02-22', '4U Cabinet 530 x350', 'RealNet Technology Trading LLC', 'PCS', '95', '92.15', '4U Rack Cabinet For Baraka Site 23-02-2023 . Based On Purchase Orders 1809.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2032, 'XAD001331', '2023-09-27', '4U Cabinet 530 x350', 'Cash', 'PCS', '120', '116.4', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2033, 'XAD001332', '2023-05-29', 'Printer Toner Waste Tank', 'Copier Range Trading EST', 'PCS', '265', '257.05', 'Requested By : Raja M Ali Verified by : Wahab Aslam & Naseer Uddin Prepared By : Raja Zeeshan  Printer Toner/Cartridge & Waste Tank Replacement For DXB Warehouse Based On Purchase Orders 2427.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2034, 'XAD001334', '2023-04-19', 'Plug Socket 3 Pin', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '4.5', '4.365', 'Request No : SmartHome-014-015-016-AUH-AAN-NE Based On Purchase Orders 2129.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2035, 'XAD001335', '2023-03-07', 'Cordless Drill Machine Worksite 12v', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '240', '232.8', 'Request No : SmartHome-Xad-008-01-03-2023 . Based On Purchase Orders 1853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2036, 'XAD001336', '2023-03-15', 'Steel Nail 2.5\"', 'Al Moazam Stores LLC', 'PKT', '7', '6.79', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1857.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2037, 'XAD001337', '2023-03-08', 'AMPERE METER AC/DC400A', 'Smooth Solution building Materails Trading LLC', 'PCS', '165', '160.05', 'Request No : XAD-HW-Jan-DXB-089 Based On Purchase Orders 1871.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2038, 'XAD001338', '2023-03-08', 'Fire Blanket', 'Smooth Solution building Materails Trading LLC', 'PCS', '45', '43.65', 'Request No : XAD-HW-Jan-DXB-089 Based On Purchase Orders 1871.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2039, 'XAD001339', '2023-03-08', 'Emergency Spill Kit', 'Smooth Solution building Materails Trading LLC', 'PCS', '250', '242.5', 'Request No : XAD-HW-Jan-DXB-089 Based On Purchase Orders 1871.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2040, 'XAD001340', '2023-03-08', 'Room Temperature Scale ( Thermo Hygrometer )', 'Smooth Solution building Materails Trading LLC', 'PCS', '145', '140.65', 'Request No : XAD-HW-Jan-DXB-089 Based On Purchase Orders 1871.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2041, 'XAD001341', '2023-03-03', 'Printer ADF Unit', 'Copier Range Trading EST', 'PCS', '250', '242.5', 'Printer Hp 177 FW , Hp 1536 , Hp 477 Toner & ADF Unit Replacement 03-03-2023. Based On Purchase Orders 1886.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2042, 'XAD001342', '2023-03-29', 'Google Chrome Cast', 'The Mark Infotech System Solutions LLC', 'PCS', '30', '29.1', 'Request No : DU SFAN-121-03-03-2023 Based On Purchase Orders 1898. Based On Goods Receipt PO 725.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2043, 'XAD001343', '2023-03-17', 'Spray Permanent Silver', 'Wenzhou Zhechi', 'PKT', '0.84', '0.8148', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2044, 'XAD001344', '2023-03-17', 'U Thimble Lugs 4x8 mm', 'Wenzhou Zhechi', 'PKT', '0.84', '0.8148', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2045, 'XAD001345', '2023-03-17', 'Cable Tie 150*3.6mm White', 'Wenzhou Zhechi', 'PKT', '0.59', '0.5723', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2046, 'XAD001345', '2023-04-20', 'Cable Tie 150*3.6mm White', 'Ali Asghar Hussani', 'PKT', '250', '242.5', 'Request No : DU SFAN-161-10-03-2023 Based On Purchase Orders 2126.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2047, 'XAD001346', '2023-03-17', 'Cable Tie 150*3.6mm Black', 'Wenzhou Zhechi', 'PKT', '0.84', '0.8148', 'Consumable Material Purcahse From China For Adwea Project 17-03-2023 . Based On Purchase Orders 1922.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2048, 'XAD001346', '2023-05-10', 'Cable Tie 150*3.6mm Black', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PKT', '2.5', '2.425', 'Request No: OSP-05 04-05-23 Based On Purchase Orders 2209.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2049, 'XAD001346', '2023-05-24', 'Cable Tie 150*3.6mm Black', 'Ali Asghar Hussani', 'PKT', '2.5', '2.425', 'Request No : OSP-07-10-05-2023 . Based On Purchase Orders 2344.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2050, 'XAD001347', '2023-03-24', 'BarCode Labels', 'The Mark Infotech System Solutions LLC', 'Roll', '42', '40.74', 'Barcode Hardware for the New Project - Sikandar Museum 22-03-2023 . Based On Purchase Orders 1963.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2051, 'XAD001349', '2023-04-08', 'UV Protection Cap', 'Emporium Gulf', 'PCS', '14', '13.58', 'Request No : DU SFAN-132-18-March-2023 . Based On Purchase Orders 1996.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2052, 'XAD001350', '2023-04-04', 'Heat Shrink Tube 35mm Blue ( Sleeve )', 'Smooth Solution building Materails Trading LLC', 'MTR', '2', '1.94', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2053, 'XAD001351', '2023-04-04', 'Heat Shrink Tube 35mm Black (Sleeve )', 'Smooth Solution building Materails Trading LLC', 'MTR', '2', '1.94', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2054, 'XAD001352', '2023-04-04', 'Heat Shrink Tube 35mm Yellow ( Sleeve )', 'Smooth Solution building Materails Trading LLC', 'MTR', '2', '1.94', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 1999.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2055, 'XAD001353', '2023-04-03', 'Metric Socket Set 24 Pcs 8x32mm', 'Ali Asghar Hussani', 'SET', '120', '116.4', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2056, 'XAD001354', '2024-02-15', 'Pulling Spring 50M', 'Ali Asghar Hussani', 'PCS', '45', '43.65', 'REQUEST NO : 298  DU SFAN PROJECT DXB Based On Purchase Orders 4065.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2057, 'XAD001355', '2023-07-31', 'Paint White Jotun', 'Ali Asghar Hussani', 'GLN', '45', '43.65', 'Request No : DU SFAN-213 . Based On Purchase Orders 2806.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2058, 'XAD001356', '2023-04-03', 'Paint Half White Jotun', 'Ali Asghar Hussani', NULL, '55', '53.35', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2059, 'XAD001357', '2023-04-03', 'Dom nut 10mm', 'Ali Asghar Hussani', 'PCS', '0.4', '0.388', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2060, 'XAD001358', '2023-04-03', 'Safety Shoes 47#', 'Ali Asghar Hussani', 'Pair', '38', '36.86', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2000. Based On Goods Receipt PO 787.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2061, 'XAD001359', '2023-03-31', 'Trunking 25x25mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '4', '3.88', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2062, 'XAD001359', '2024-01-09', 'Trunking 25x25mm', 'Ali Asghar Hussani', 'PCS', '6.5', '6.305', 'REQUEST NO OSP LMP 2 Based On Purchase Orders 3830.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2063, 'XAD001360', '2023-04-04', 'Thimble Lugs 35mm U Shape', 'Smooth Solution building Materails Trading LLC', 'PCS', '1.5', '1.455', 'Request No : DU SFAN-132-18-03-2023 . Based On Purchase Orders 2006.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2064, 'XAD001361', '2023-04-28', 'Drill Machine Dewalt D25033C', 'Smooth Solution building Materails Trading LLC', 'PCS', '500', '485', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2065, 'XAD001362', '2023-03-31', 'PVC Coupler 20mm White', 'Smooth Solution building Materails Trading LLC', 'PCS', '0.35', '0.3395', 'Request No : OSP-01-DXB-AUH-NE-27-03-2023 . Based On Purchase Orders 2004.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2066, 'XAD001362', '2023-10-03', 'PVC Coupler 20mm White', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.35', '0.3395', 'Request No : Etisalat - SmartHome - XAD-043 - 03-10-2023 . Based On Purchase Orders 3230.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2067, 'XAD001363', '2023-04-28', 'Cable Cutter Proskit', 'Smooth Solution building Materails Trading LLC', 'PCS', '33', '32.01', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2010.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2068, 'XAD001364', '2023-05-18', 'Pulling Rod 11mm x 300M', 'Elfit Arabia', 'PCS', '2254', '2186.38', 'Request No : OSP-02-OSP-Waiter Project 27-03-2023 . Based On Purchase Orders 2012. Based On Goods Receipt PO 970.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2069, 'XAD001365', '2023-04-27', 'Optical Power Meter FHP2', 'MITTCO Llc', 'PCS', '523.2', '507.504', 'Request No : DU SFAN-143-25-03-2023 . Based On Purchase Orders 2014.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2070, 'XAD001366', '2023-10-19', 'Power Meter ( Grandway MT-500B With VFL )', 'MITTCO Llc', 'PCS', '269.93', '261.8321', 'Request No : DU SFAN-230-240 Aug-2023 Based On Purchase Orders 3088.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2071, 'XAD001367', '2024-01-09', 'Drop Fiber Black 1 Core OD', 'ZOOM LINE NETWORKS TECHNOLOGY', 'PCS', '290', '281.3', 'Request No : OSP-LMP-Oct-2024 . Based On Purchase Orders 3223.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2072, 'XAD001369', '2023-04-24', 'Bending Spring 20mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '1275', '1236.75', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2073, 'XAD001370', '2023-04-24', 'Cable Tray GI 400x50x1.2mm', 'Smooth Solution building Materails Trading LLC', 'PCS', '80', '77.6', 'Request No : DU SFAN-161-10-03-2023 . Based On Purchase Orders 2124.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2074, 'XAD001372', '2023-10-24', 'Tile Bit 6mm', 'Ali Asghar Hussani', 'PCS', '4', '3.88', 'Request No : Smarthome-003-Oct-23-AUH & NE Region . Based On Purchase Orders 3353.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2075, 'XAD001427', '2023-06-15', 'PIT Foldable Bracket', 'GRACE STEEL FABRICATION & WELDING WORKSHOP EST', 'SET', '1600', '1552', 'PIT Foldable Bracket Sample Required For Huawei Site . Based On Purchase Orders 2567.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2076, 'XAD001438', '2023-10-27', 'Remote Cable Tester (Rj45 & Rj11)', 'The Mark Infotech System Solutions LLC', 'PCS', '30', '29.1', 'Request No : Smarthome-003-Oct-23-AUH Region . Based On Purchase Orders 3354.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2077, 'XAD001439', '2023-10-03', 'Mono Pole Brackets with 10cm Flang By 2m Pipe', 'Al Mathana Welding & Blacksmith Workshop', 'SET', '640', '620.8', 'Request No : XAD-Atlas -Aug-AAN-03 Based On Purchase Orders 3052.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2078, 'XAD001440', '2023-10-03', 'Brackets On Existing Wall Mounts; 20cm Flang By 1.5m Pipe', 'Al Mathana Welding & Blacksmith Workshop', 'SET', '520', '504.4', 'Request No : XAD-Atlas -Aug-AAN-03 Based On Purchase Orders 3052.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2079, 'XAD001441', '2023-09-15', 'Gymas Tower Brackets', 'Al Mathana Welding & Blacksmith Workshop', NULL, '650', '630.5', 'Request No : XAD -Atlas - July - AUH-1 Based On Purchase Orders 2868.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2080, 'XAD001442', '2023-09-15', 'Pole Climbing Steps', 'Al Mathana Welding & Blacksmith Workshop', 'SET', '150', '145.5', 'Request No : XAD -Atlas - July - AUH-1 Based On Purchase Orders 3050.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2081, 'XAD001443', '2023-10-03', 'Angular Tower Bracket with 3\'\' by 1.5m', 'Al Mathana Welding & Blacksmith Workshop', 'SET', '730', '708.1', 'Request No : XAD-Atlas -Aug-AAN-03 Based On Purchase Orders 3052.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2082, 'XAD001444', '2023-10-03', '6M Wall Ladder (2M Segmented)', 'Al Mathana Welding & Blacksmith Workshop', 'SET', '180', '174.6', 'Request No : XAD-Atlas -Aug-AAN-03 Based On Purchase Orders 3052.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2083, 'XAD001445', '2023-09-15', '3\'\' Pipe Wall Mount', 'Al Mathana Welding & Blacksmith Workshop', 'SET', '1000', '970', 'Request No : XAD -Atlas - July - AUH-1 Based On Purchase Orders 2868.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2084, 'XAD001446', '2023-09-07', 'JRC 12 Accessories', 'Frontier Innovation General Trading', 'PCS', '160', '155.2', 'Request No : WR101H-283-07-08-2023 . Based On Purchase Orders 3079.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2085, 'XAD001447', '2023-08-15', 'Engine Oil - Adnoc Silver', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '46.17', '44.7849', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2086, 'XAD001447', '2024-01-03', 'Engine Oil - Adnoc Silver', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '46', '44.62', 'XAD AUTOS JAN 0001 24 Based On Purchase Orders 3973.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2087, 'XAD001448', '2023-08-15', 'Wiper Blade 14', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '9.47', '9.1859', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2088, 'XAD001448', '2023-12-19', 'Wiper Blade 14', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '6.2', '6.014', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2089, 'XAD001449', '2023-08-15', 'Wiper Blade 18', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '9.48', '9.1956', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2090, 'XAD001450', '2023-10-31', 'Wiper Blade 22', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '7.05', '6.8385', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2091, 'XAD001451', '2023-10-31', 'Wiper Blade 24', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '7.05', '6.8385', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2092, 'XAD001452', '2023-08-15', 'Bulb Single', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '1.42', '1.3774', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2093, 'XAD001452', '2023-12-19', 'Bulb Single', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '0.95', '0.9215', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2094, 'XAD001453', '2023-08-15', 'Bulb Double', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '2.37', '2.2989', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2095, 'XAD001453', '2023-10-31', 'Bulb Double', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '0.95', '0.9215', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2096, 'XAD001454', '2024-01-03', 'Bulb Caples', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '0.71', '0.6887', 'XAD AUTOS JAN 0001 24 Based On Purchase Orders 3973.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2097, 'XAD001455', '2023-08-15', 'Oil Filter Sunny', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '3.98', '3.8606', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2098, 'XAD001455', '2024-01-03', 'Oil Filter Sunny', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '4.25', '4.1225', 'XAD AUTOS JAN 0001 24 Based On Purchase Orders 3973.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2099, 'XAD001456', '2023-08-15', 'Air Filter Sunny Ind', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '11.37', '11.0289', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2100, 'XAD001456', '2023-12-19', 'Air Filter Sunny Ind', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '11.32', '10.9804', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2101, 'XAD001457', '2023-08-15', 'Air Filter Navara', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '23.68', '22.9696', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2102, 'XAD001457', '2023-12-19', 'Air Filter Navara', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '21.7', '21.049', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2103, 'XAD001459', '2023-12-19', 'Ac Filter Navara', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '9.52', '9.2344', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2104, 'XAD001460', '2024-01-03', 'Bulb H4 Philips', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '7.62', '7.3914', 'XAD AUTOS JAN 0001 24 Based On Purchase Orders 3973.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2105, 'XAD001461', '2023-08-15', 'Coolant', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '17.04', '16.5288', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2106, 'XAD001461', '2023-12-19', 'Coolant', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '4.29', '4.1613', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2107, 'XAD001462', '2023-08-15', 'BR Pad Sunny Ind MK', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '52.08', '50.5176', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2108, 'XAD001462', '2023-12-19', 'BR Pad Sunny Ind MK', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '50', '48.5', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2109, 'XAD001463', '2023-12-19', 'Brush Brake Oil', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '11.43', '11.0871', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2110, 'XAD001464', '2023-08-15', 'BR Pad Navara MK', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '85.23', '82.6731', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2111, 'XAD001464', '2023-12-19', 'BR Pad Navara MK', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '85', '82.45', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2112, 'XAD001465', '2023-10-31', 'Oil Filter Lancer', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '4.25', '4.1225', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2113, 'XAD001466', '2023-08-15', 'Air Filter Lancer', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '14.21', '13.7837', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2114, 'XAD001467', '2024-02-28', 'Oil Filter E1 Suzuki', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '4.2', '4.074', 'REQUEST NO : 0001-FEB\'24 Based On Purchase Orders 4136.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2115, 'XAD001468', '2023-12-19', 'Ac Filter Suzuki', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '10.48', '10.1656', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2116, 'XAD001469', '2023-08-15', 'Oil Filter Toyota', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '4.23', '4.1031', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2117, 'XAD001470', '2023-12-08', 'Ac Filter Nissan Sunny', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '9.52', '9.2344', 'Request No : XAD Autos - 001 - NOV-23 Based On Purchase Orders 3560.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2118, 'XAD001471', '2023-08-15', 'Air Filter Hiace', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '18.94', '18.3718', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2119, 'XAD001471', '2023-12-19', 'Air Filter Hiace', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '17.19', '16.6743', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2120, 'XAD001472', '2023-12-19', 'Air Filter Hilux(Pick UP)', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '19.05', '18.4785', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59');
INSERT INTO `supplier_prices` (`id`, `items_code`, `purchase_date`, `item_name`, `supplier_name`, `uom`, `price`, `discount`, `remarks`, `created_at`, `updated_at`) VALUES
(2121, 'XAD001474', '2023-08-15', 'Engine Decreser', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '11.93', '11.5721', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2122, 'XAD001475', '2023-08-15', 'Ac Delco ATF 1 Ltr', 'Hamdan Bin Al Seikh Juma Trading LLC', 'PCS', '13.92', '13.5024', 'Material Required For Xad AutoMobile Workshop Project . Based On Purchase Orders 2915.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2123, 'XAD001475', '2023-12-19', 'Ac Delco ATF 1 Ltr', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '14', '13.58', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2124, 'XAD001476', '2023-09-02', 'Buffer Tube 10mm', 'Ali Asghar Hussani', 'MTR', '1.95', '1.8915', 'Request No : DU SFAN-240-30-Aug-2023 . Based On Purchase Orders 3085.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2125, 'XAD001477', '2023-09-23', 'DC to AC Power Inverter ( 1000 Watt )', 'Auto Computer Trading LLC', 'PCS', '150', '145.5', 'Request No : HW-Sep-DXB-118 Based On Purchase Orders 3127.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2126, 'XAD001478', '2024-03-04', 'Heat Shrink Holder', 'Cendhurr Telecom LLC', 'PCS', '1.3', '1.261', 'Heat Shrink Holder For OSP LMP Project Based On Purchase Orders 4015.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2127, 'XAD001479', '2023-09-21', 'AC Filter Lancer', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '9.52', '9.2344', 'Request No : XAD-15-Sep-Aug-18-Sep-2023 . Based On Purchase Orders 3171.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2128, 'XAD001480', '2023-12-19', 'Battery 55 AMP Din', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '152.38', '147.8086', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2129, 'XAD001481', '2023-12-19', 'Battery 75 AMP Din', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '204.7', '198.559', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2130, 'XAD001482', '2023-12-08', 'Air Filter Ertiga Suzuki', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '52.39', '50.8183', 'Request No : XAD Autos - 001 - NOV-23 Based On Purchase Orders 3560.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2131, 'XAD001484', '2023-09-12', 'Lifting Belt 4 Mtr', 'Al Moazam Stores LLC', 'PCS', '64.97', '63.0209', 'Request No : AAN-Aug-23-080 Based On Purchase Orders 3159.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2132, 'XAD001489', '2024-03-13', 'Oil Filter Navara', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '4.28', '4.1516', 'REQUEST NO : XAD AUTOS-0002-FEB\'24 Based On Purchase Orders 4245.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2133, 'XAD001490', '2023-12-19', 'Oil Filter 3 Ton Mitsubishi Canter 13343', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '11.42', '11.0774', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2134, 'XAD001491', '2023-09-19', 'Stainless Steel Hole Saw 50mm', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'Request No : Etisalat SmartHome-XAD-0043-NE-13-09-2023 . Based On Purchase Orders 3175.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2135, 'XAD001492', '2023-10-11', 'Joint Support 925mm 2\" x 36\" ( For JRC 14 )', 'Frontier Innovation General Trading', 'PCS', '43', '41.71', 'Request No : WR-101H-288-18-09-2023 . Based On Purchase Orders 3178.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2136, 'XAD001493', '2023-09-19', 'Oil Filter 3 Ton Mitsubishi Canter 0001', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '19.04', '18.4688', 'Request No : XAD-15-Sep-Aug-18-Sep-2023 . Based On Purchase Orders 3186.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2137, 'XAD001494', '2023-12-19', 'Oil Fuso 3 Ton Mitsubishi Canter', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '55.29', '53.6313', 'Request No : XAD Autos - 0002 - Nov\'23 Based On Purchase Orders 3588.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2138, 'XAD001495', '2023-09-09', 'NVR DS -760BNI - K1', 'Wide Vision Technology LLC', 'PCS', '409.84', '397.5448', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2139, 'XAD001495', '2023-09-27', 'NVR DS -760BNI - K1', 'Cash', 'PCS', '220', '213.4', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2140, 'XAD001496', '2023-09-09', 'Dome Security Colour Camera, 2.8mm', 'Wide Vision Technology LLC', 'PCS', '149.94', '145.4418', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2141, 'XAD001497', '2023-09-09', 'POE SFP Switch', 'Wide Vision Technology LLC', 'PCS', '229.91', '223.0127', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2142, 'XAD001497', '2023-09-27', 'POE SFP Switch', 'Cash', 'PCS', '203', '196.91', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2143, 'XAD001498', '2023-09-09', 'Cat 6 Cable Grey', 'Wide Vision Technology LLC', 'MTR', '1.15', '1.1155', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2144, 'XAD001498', '2023-09-27', 'Cat 6 Cable Grey', 'Cash', 'MTR', '1.23', '1.1931', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2145, 'XAD001499', '2023-09-09', 'TP-Link Router', 'Wide Vision Technology LLC', 'PCS', '169.93', '164.8321', 'CCTV Camera Required For Sharjah Warehouse .  Requested By : Raja Zeeshan Verified By     : Raja Zeeshan Prepared By  : Raja Zeeshan Based On Purchase Orders 3193.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2146, 'XAD001499', '2023-09-27', 'TP-Link Router', 'Cash', 'PCS', '150', '145.5', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2147, 'XAD001501', '2023-10-06', 'Uniform Cotton Twill Shirt Grey/Red with Xad Automobile Logo M', 'Emporium Gulf', 'PCS', '49', '47.53', 'Request No : XAD-Autos-0017-XAD-Sep-2023 Based On Purchase Orders 3198.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2148, 'XAD001502', '2023-10-06', 'Uniform Cotton Twill Shirt Grey/Red with Xad Automobile Logo L', 'Emporium Gulf', 'PCS', '49', '47.53', 'Request No : XAD-Autos-0017-XAD-Sep-2023 Based On Purchase Orders 3198.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2149, 'XAD001503', '2023-10-06', 'Uniform Cotton Twill Shirt Grey/Red with Xad Automobile Logo XL', 'Emporium Gulf', 'PCS', '49', '47.53', 'Request No : XAD-Autos-0017-XAD-Sep-2023 Based On Purchase Orders 3198.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2150, 'XAD001504', '2023-10-06', 'Uniform Cotton Twill Shirt Grey/Red with Xad Automobile Logo XXL', 'Emporium Gulf', 'PCS', '49', '47.53', 'Request No : XAD-Autos-0017-XAD-Sep-2023 Based On Purchase Orders 3198.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2151, 'XAD001506', '2023-10-06', 'Uniform Poly Cotton Twill Cargo Pant Grey/Red with Xad AutoMobile log both Side Pockets', 'Emporium Gulf', 'PCS', '44', '42.68', 'Request No : XAD-Autos-0017-XAD-Sep-2023 Based On Purchase Orders 3198.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2152, 'XAD001509', '2023-09-27', 'UPS', 'Cash', 'PCS', '180', '174.6', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2153, 'XAD001510', '2023-09-27', 'DS-K4H258-LZ Value Series Magnetic Lock Bracket', 'Cash', 'PCS', '50', '48.5', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2154, 'XAD001511', '2023-09-27', 'DS-K4H258-LZ Value Series Magnetic Lock', 'Cash', 'PCS', '90', '87.3', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2155, 'XAD001512', '2023-09-27', 'Adapter 12V', 'Cash', 'PCS', '20', '19.4', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2156, 'XAD001513', '2023-09-27', 'Safety Barrier Pole', 'Cash', 'PCS', '74', '71.78', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2157, 'XAD001514', '2023-09-27', 'Fingerprint Terminal', 'Cash', 'PCS', '230', '223.1', 'CCTV Material Required For Mir Plastic Jabel Ali Site Dubai For ICT Project . Based On Purchase Orders 3204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2158, 'XAD001519', '2023-10-06', 'RAM 16 GB', 'Power Plus Technologies LLC', 'PCS', '175', '169.75', '16GB Ram Required For Umar Ahmed Lapotp For Xad Social Media Project . Based On Purchase Orders 3273.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2159, 'XAD001521', '2023-10-18', 'Uniform Winter Jacket & Trouser Two Layer Fabric ( Waterproof Micro & Fleece with Hooded Jacket ) With Xad Technologies LTD Logo M', 'Emporium Gulf', 'PCS', '120', '116.4', 'Request No : XAD-022-Oct-2023.  Uniform Hi Vis Required For UK Project . Based On Purchase Orders 3320.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2160, 'XAD001522', '2023-10-18', 'Uniform Winter Jacket & Trouser Two Layer Fabric ( Waterproof Micro & Fleece with Hooded Jacket ) With Xad Technologies LTD Logo L', 'Emporium Gulf', 'PCS', '120', '116.4', 'Request No : XAD-022-Oct-2023.  Uniform Hi Vis Required For UK Project . Based On Purchase Orders 3320.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2161, 'XAD001523', '2023-10-18', 'Uniform Winter Jacket & Trouser Two Layer Fabric ( Waterproof Micro & Fleece with Hooded Jacket ) With Xad Technologies LTD Logo XL', 'Emporium Gulf', 'PCS', '120', '116.4', 'Request No : XAD-022-Oct-2023.  Uniform Hi Vis Required For UK Project . Based On Purchase Orders 3320.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2162, 'XAD001526', '2023-10-16', 'SSD NVME 2TB', 'Power Plus Technologies LLC', 'PCS', '400', '388', 'Request No : DU SFAN-260 .  2TB SSD NVME Required For Ansar Abbas Laptop DU SFAN Project . Based On Purchase Orders 3322.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2163, 'XAD001528', '2023-10-18', 'Tablet Cover', 'Cash', 'PCS', '47.62', '46.1914', 'Request No : UK-1-18-10-2023 . Based On Purchase Orders 3337.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2164, 'XAD001529', '2023-10-18', 'Protector', 'Cash', 'PCS', '19.05', '18.4785', 'Request No : UK-1-18-10-2023 . Based On Purchase Orders 3337.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2165, 'XAD001531', '2024-03-13', 'Lower Arm Front Sunny', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '83', '80.51', 'REQUEST NO : XAD AUTOS-0002-FEB\'24 Based On Purchase Orders 4245.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2166, 'XAD001532', '2023-10-31', 'Axle Boot Sunny', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '14.5', '14.065', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2167, 'XAD001533', '2023-10-31', 'Engine Belt Sunny', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '42', '40.74', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2168, 'XAD001534', '2023-10-31', 'Engine Belt Navara', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '57', '55.29', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2169, 'XAD001535', '2023-10-31', 'Brake Shoe Sunny', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'Pair', '80', '77.6', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2170, 'XAD001536', '2023-10-31', 'Brake Shoe Navara', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'Pair', '190', '184.3', 'Request No : XAD-001-Oct-2023 Based On Purchase Orders 3367.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2171, 'XAD001537', '2024-02-15', 'Printer Toner Drum', 'Copier Range Trading EST', 'PCS', '380', '368.6', 'Printer Drum Replacement For DXB-WH Based On Purchase Orders 4096.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2172, 'XAD001538', '2023-11-06', 'Unifix 8mm', 'Ali Asghar Hussani', 'PCS', '0.15', '0.1455', 'Request No : XAD-HW-OCT-DXB-098 Based On Purchase Orders 3424.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2173, 'XAD001540', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 30\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2174, 'XAD001541', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 32\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2175, 'XAD001542', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 34\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2176, 'XAD001543', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 36\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2177, 'XAD001544', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 38\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2178, 'XAD001547', '2023-11-14', 'RJ45 Connector Shielded', 'FIBER LINK COMPUTER TRADING LLC', 'PCS', '2.1', '2.037', 'Request No : Nokia-Nov-2023.   Cat6 Armoured Cable & Connector Required For Nokia Project . Based On Purchase Orders 3477.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2179, 'XAD001548', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 28\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2180, 'XAD001549', '2024-01-03', 'Indicator Bulb', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '1', '0.97', 'XAD AUTOS JAN 0001 24 Based On Purchase Orders 3973.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2181, 'XAD001550', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 33\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2182, 'XAD001551', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 41\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2183, 'XAD001552', '2023-12-21', 'Uniform Polo Cargo Pent Grey with Etisalat and Xad Logo 29\"', 'Emporium Gulf', 'PCS', '46', '44.62', 'Etisalat & XAD Logo Shirt Required For Smart Home Project  Request No : XAD-002-NOV-23 Based On Purchase Orders 3562.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2184, 'XAD001554', '2024-01-03', 'AC Delco Cleaner Spray', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '18', '17.46', 'XAD AUTOS JAN 0001 24 Based On Purchase Orders 3973.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2185, 'XAD001562', '2023-12-06', 'Allen Key Set Star', 'Ali Asghar Hussani', 'PCS', '20', '19.4', 'NOKIA MATERIAL REQUEST Based On Purchase Orders 3578.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2186, 'XAD001567', '2024-02-28', 'Engine Oil - Adnoc Gold 5W-30', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '71.43', '69.2871', 'REQUEST NO : 0001-FEB\'24 Based On Purchase Orders 4136.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2187, 'XAD001569', '2024-03-06', 'Punching tool 2621 keystone jack (KUWES)', 'SKYMAX GENERAL TRADING FZE', 'PCS', '220', '213.4', 'Based On Purchase Orders 4253.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2188, 'XAD001570', '2023-12-20', 'Core Bit 51mm', 'Ali Asghar Hussani', 'PCS', '110', '106.7', 'REQUEST NO 9 ICT SCHOOL PROJECT Based On Purchase Orders 3691.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2189, 'XAD001571', '2023-12-20', 'Core Bit 102mm', 'Ali Asghar Hussani', 'PCS', '140', '135.8', 'REQUEST NO 9 ICT SCHOOL PROJECT Based On Purchase Orders 3691.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2190, 'XAD001572', '2023-12-22', 'Door Fit DT65 Glass Door Floor Machine', 'SM And Rahmani Building Materials Trading LLC', 'PCS', '550', '533.5', 'REQUEST NO XAD-001  SMART HOMES PROJECT Based On Purchase Orders 3712.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2191, 'XAD001573', '2023-12-23', 'Chisel 8\'\'', 'SM And Rahmani Building Materials Trading LLC', 'PCS', '10', '9.7', 'Material For ICT School Project Based On Purchase Orders 3716.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2192, 'XAD001574', '2023-12-23', 'Rubber Hammer 16 OZ', 'SM And Rahmani Building Materials Trading LLC', 'PCS', '12', '11.64', 'Material For ICT School Project Based On Purchase Orders 3716.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2193, 'XAD001574', '2024-02-10', 'Rubber Hammer 16 OZ', 'Cash', 'PCS', '20', '19.4', 'Materials Required For ICT Project Based On Purchase Orders 4067.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2194, 'XAD001575', '2024-01-10', 'Sign Board Wooden ( 100 )', 'M S K Corporate Services Provides EST', 'PCS', '218.5', '211.945', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2195, 'XAD001576', '2024-01-10', 'Sign Board Wooden ( 3rd Lane Closed 800m )', 'M S K Corporate Services Provides EST', 'PCS', '223.25', '216.5525', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2196, 'XAD001577', '2024-01-10', 'Sign Board Wooden ( 3rd Lane Closed 400m )', 'M S K Corporate Services Provides EST', 'PCS', '223.25', '216.5525', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2197, 'XAD001578', '2024-01-10', 'Sign Board Wooden ( 3rd Lane Closed 200m )', 'M S K Corporate Services Provides EST', 'PCS', '223.25', '216.5525', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2198, 'XAD001579', '2024-01-10', 'Sign Board Wooden ( 3rd Lane Ends 400m )', 'M S K Corporate Services Provides EST', 'PCS', '223.25', '216.5525', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2199, 'XAD001580', '2024-01-10', 'Sign Board Wooden ( 3rd Lane Ends 200m )', 'M S K Corporate Services Provides EST', 'PCS', '223.25', '216.5525', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2200, 'XAD001581', '2024-01-10', 'Sign Board Wooden ( Construction Vehicles Only )', 'M S K Corporate Services Provides EST', 'PCS', '237.5', '230.375', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2201, 'XAD001582', '2024-01-10', 'Sign Board Wooden ( Left Arrow )', 'M S K Corporate Services Provides EST', 'PCS', '218.5', '211.945', 'REQUEST NO 285 DU SFAN PROJECT Based On Purchase Orders 3853.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2202, 'XAD001591', '2024-01-14', 'Spray Paint Black', 'Cash', 'PCS', '6', '5.82', 'Spray Paint & Cable Clip For OSP LMP Project Based On Purchase Orders 3902.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2203, 'XAD001592', '2024-01-24', 'Rigger Climbing Helmet Orange', 'Fas Arabia llc', 'PCS', '230', '223.1', 'REQUEST NO HW-JAN-DXB-100 Based On Purchase Orders 3922.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2204, 'XAD001593', '2024-02-10', 'C14 To C15 Power Cable', 'FIBER LINK COMPUTER TRADING LLC', 'PCS', '18', '17.46', 'REQUEST No : 298 Based On Purchase Orders 4064.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2205, 'XAD001594', '2024-02-10', 'C14 To Universal Female Power Adapter', 'FIBER LINK COMPUTER TRADING LLC', 'PCS', '16', '15.52', 'REQUEST No : 298 Based On Purchase Orders 4064.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2206, 'XAD001595', '2024-02-10', 'Black Sand', 'Cash', 'Bag', '10', '9.7', 'Black Sand Required For ICT School Project Based On Purchase Orders 4068.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2207, 'XAD001596', '2024-02-28', 'AC Gas Cylinder', 'KHALID ALKHEMEIRI AUTO SPARE PARTS TRADING LLC', 'PCS', '465', '451.05', 'REQUEST NO : 0001-FEB\'24 Based On Purchase Orders 4136.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2208, 'XAD00184', '2023-09-07', 'JRC 4 accessories', 'Frontier Innovation General Trading', 'PCS', '60', '58.2', 'Request No : WR101H-283-07-08-2023 . Based On Purchase Orders 3079.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2209, 'XAD00677', '2022-09-08', 'Polythne Sheet', 'JOGA RAM GENERAL TRADING LLC', 'Roll', '26', '25.22', 'Project : DXB Etihad Rail Requested By : Blessan Koshy Verified By : Imran Iqbal Based On Purchase Orders 560.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2210, 'XAD00677', '2023-03-15', 'Polythne Sheet', 'Al Moazam Stores LLC', 'Roll', '22', '21.34', 'Request No : AAN-FEB-23-0020 Based On Purchase Orders 1857.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2211, 'XAD007', '2023-12-27', 'Measuring Tape 10M', 'Ali Asghar Hussani', 'PCS', '15', '14.55', 'Carpentry Tool Request  Smart Home Project Based On Purchase Orders 3723.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2212, 'XAD00D1371', '2024-01-10', 'Uniform Polo Shirt Black with Etisalat and Xad Logo S', 'Emporium Gulf', 'PCS', '23', '22.31', 'REQUEST NO 0068 AUH OLT PROJECT Based On Purchase Orders 3713.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2213, 'XAD00D1372', '2023-11-14', 'Uniform Polo Shirt Black with Etisalat and Xad Logo M', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : OSP-LMP-46-DXB,AUH,NE,AAN Region Oct-2023 . Based On Purchase Orders 3445.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2214, 'XAD00D1373', '2023-11-14', 'Uniform Polo Shirt Black with Etisalat and Xad Logo L', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : OSP-LMP-46-DXB,AUH,NE,AAN Region Oct-2023 . Based On Purchase Orders 3445.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2215, 'XAD00D1374', '2023-11-14', 'Uniform Polo Shirt Black with Etisalat and Xad Logo XL', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : OSP-LMP-46-DXB,AUH,NE,AAN Region Oct-2023 . Based On Purchase Orders 3445.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2216, 'XAD00D1375', '2023-11-14', 'Uniform Polo Shirt Black with Etisalat and Xad LogoXXL', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : OSP-LMP-46-DXB,AUH,NE,AAN Region Oct-2023 . Based On Purchase Orders 3445.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2217, 'XAD00D1376', '2023-11-14', 'Uniform Polo Shirt Black with Etisalat and Xad Logo 3XL', 'Emporium Gulf', 'PCS', '23', '22.31', 'Request No : OSP-LMP-46-DXB,AUH,NE,AAN Region Oct-2023 . Based On Purchase Orders 3445.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2218, 'XAD00D1377', '2023-05-01', 'Water Cooler 10 Gallon 35 Ltr', 'Al Moazam Stores LLC', 'PCS', '120', '116.4', 'Request No : AAN-April-0035-08-04-2023 . Based On Purchase Orders 2175.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2219, 'XAD00D1383', '2023-05-04', 'Uniform Polo Shirt White with logo Xad SmartHome Etisalat - M', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2187.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2220, 'XAD00D1384', '2023-05-04', 'Uniform Polo Shirt White with logo Xad SmartHome Etisalat - XL', 'Emporium Gulf', 'PCS', '33', '32.01', 'Request No : XAD-008-01-03-2023 . Based On Purchase Orders 2187.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2221, 'XAD00D1387', '2023-05-08', 'Cable Tie 7.6*450mm Black', 'Ali Asghar Hussani', 'PKT', '15', '14.55', 'Request No : WR-101H-252-11-04-2023 . Based On Purchase Orders 2204.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2222, 'XAD00D1388', '2023-04-17', 'CCTV Power Supply 12V', 'Madina Al Safia Computer Electric Access Tra LLC', 'PCS', '65', '63.05', 'Request No : XAD-ICT-001-17-04-2023 . Based On Purchase Orders 2207.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2223, 'XAD00D1389', '2023-04-17', 'Cat 6 Video Balun Ahd', 'Madina Al Safia Computer Electric Access Tra LLC', 'PCS', '8', '7.76', 'Request No : XAD-ICT-001-17-04-2023 . Based On Purchase Orders 2207.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2224, 'XAD00D1390', '2023-04-17', 'DC Male With Cable', 'Madina Al Safia Computer Electric Access Tra LLC', 'PCS', '0.5', '0.485', 'Request No : XAD-ICT-001-17-04-2023 . Based On Purchase Orders 2207.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2225, 'XAD00D1391', '2023-04-24', '4U Rack 600x450', 'Golden Sail Computer Co LLC', 'PCS', '100', '97', 'Request No : ICT - XAD-ICT-001 - 24-03-2023 . Based On Purchase Orders 2214.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2226, 'XAD00D1392', '2023-08-23', 'Vehicle Logbook Etisalat', 'M S K Corporate Services Provides EST', 'PCS', '10.5', '10.185', 'Request No : XAD-55-July-2023 Based On Purchase Orders 2878.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2227, 'XAD00D1393', '2023-05-05', 'Battery Energizer Rechargeable AAA', 'Ali Asghar Hussani', 'PCS', '16', '15.52', 'Based On Purchase Orders 2239.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2228, 'XAD00D1394', '2023-05-05', 'Charger Energizer', 'Ali Asghar Hussani', 'PCS', '60', '58.2', 'Based On Purchase Orders 2239.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2229, 'XAD00D1395', '2023-05-10', 'Enclosure Cabinet 800X600X300', 'Tool-Pusher Trading and Services FZE', 'PCS', '435', '421.95', 'Request No : WR-101H-250-07-04-2023 . Based On Purchase Orders 2260.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2230, 'XAD00D1396', '2023-10-03', 'Screw Driver Set  Insulated 7 PCS', 'Ali Asghar Hussani', 'PCS', '33', '32.01', 'Request No : Etisalat - SmartHome - XAD-001 - 03-10-2023 . Based On Purchase Orders 3229.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2231, 'XAD00D1397', '2023-12-27', 'Gypsum Screw 2\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.04', '0.0388', 'Smart Home Request No 002 Smart Home Project Based On Purchase Orders 3706.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2232, 'XAD00D1398', '2023-05-10', 'Ubiquiti USG', 'Cash', 'PCS', '1835', '1779.95', 'Rack & Internet Network Devices For DSO Office . Based On Purchase Orders 2292.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2233, 'XAD00D1399', '2023-05-10', 'Ubiquiti Unifi AP AC Pro', 'Cash', 'PCS', '480', '465.6', 'Rack & Internet Network Devices For DSO Office . Based On Purchase Orders 2292.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2234, 'XAD00D1400', '2023-05-10', 'Ubiquiti Network Switch 8 Ports', 'Cash', 'PCS', '495', '480.15', 'Rack & Internet Network Devices For DSO Office . Based On Purchase Orders 2292.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2235, 'XAD00D1401', '2023-05-17', 'Wireless Keyboard & Mouse', 'AL Fajar Computer Trading LLC', 'PCS', '85', '82.45', 'Request No : DU SFAN-171-03-05-2023 . Based On Purchase Orders 2302.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2236, 'XAD00D1402', '2023-05-19', 'Safety Mesh/ Net 65* 35M ( 36 Y )', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Roll', '36', '34.92', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2237, 'XAD00D1403', '2023-05-18', 'Ceiling Channel C Type', 'Ali Asghar Hussani', 'PCS', '3.75', '3.6375', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2306. Based On Goods Receipt PO 948.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2238, 'XAD00D1404', '2023-05-18', 'Ceiling Channel L Type', 'Ali Asghar Hussani', 'PCS', '3.75', '3.6375', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2306. Based On Goods Receipt PO 948.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2239, 'XAD00D1405', '2023-05-29', 'Cordless Tightener Emrald', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '260', '252.2', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2309.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2240, 'XAD00D1406', '2023-05-29', 'Ratchet Spanner Set Small 1/4\"', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '55', '53.35', 'Reuqest No : DU SFAN-176-08-05-2023. Based On Purchase Orders 2309.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2241, 'XAD00D1407', '2023-05-27', 'Suger Test Strips', 'Smooth Solution building Materails Trading LLC', 'Box', '125', '121.25', 'Suger Test Strips Required For Huawei Staff . Based On Purchase Orders 2458.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2242, 'XAD00D1408', '2023-05-20', 'USB to Type C Cable', 'The Mark Infotech System Solutions LLC', 'PCS', '8.5', '8.245', 'Request No : 190 Based On Purchase Orders 2357.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2243, 'XAD00D1411', '2023-05-18', 'White Board 3x9', 'MAA ALMADINA BUILDING MATERIAL', 'PCS', '23', '22.31', 'Request No : AUH-OLT-0026 Based On Purchase Orders 2329.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2244, 'XAD00D1412', '2023-05-18', 'Gas Monitor ( H2S )', 'Ali Asghar Hussani', 'PCS', '278', '269.66', 'Request No : WR-101H-WR-255-02-05-2023 . Based On Purchase Orders 2332.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2245, 'XAD00D1413', '2023-05-30', 'Cable Tray Support', 'Noor Al Iman', 'PCS', '25', '24.25', 'Requestr No : XAD-HW-May-DXB-099 Based On Purchase Orders 2336.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2246, 'XAD00D1414', '2023-07-27', 'Laptop Charger C Type', 'The Mark Infotech System Solutions LLC', 'PCS', '49.5', '48.015', 'Laptop Charger C Type Required For Etisalat Transport Department. Based On Purchase Orders 2825.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2247, 'XAD00D1414', '2023-11-25', 'Laptop Charger C Type', 'AL Taqa Momtaza Technology LLC', 'PCS', '45', '43.65', 'DU-TCS - 5 NOKIA - 5 ADMIN/LOGISTICS - 5 Based On Purchase Orders 3529.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2248, 'XAD00D1415', '2023-11-27', 'Main breaker 63A 4 pole', 'Noor Al Iman', 'PCS', '120', '116.4', 'Request No :Huawei Mobile Project, XAD - HW - May - DXB-098 Based On Purchase Orders 3504.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2249, 'XAD00D1416', '2023-05-23', 'Dp To HDMI Connector', 'The Mark Infotech System Solutions LLC', 'PCS', '33', '32.01', 'Request No : DU SFAN-121 . Based On Purchase Orders 2373.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2250, 'XAD00D1417', '2023-05-23', 'Wifi Dongal', 'The Mark Infotech System Solutions LLC', 'PCS', '27', '26.19', 'Request No : DU SFAN-121 . Based On Purchase Orders 2373.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2251, 'XAD00D1418', '2023-05-19', 'Lamination Pouch A4', 'M S K Corporate Services Provides EST', 'PCS', '0.5', '0.485', 'Based On Purchase Orders 2380.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2252, 'XAD00D1419', '2023-05-26', 'Check Suger Tester With Omranon Pressure Test Kit', 'Smooth Solution building Materails Trading LLC', 'SET', '350', '339.5', 'Sugar Test Kit and Blood Pressure Kit For Xad Common All Project . Based On Purchase Orders 2415.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2253, 'XADAST00014', '2022-08-23', 'Power Meter Exfo ( FLS300 )', 'Alpha Link Technologies LLC', 'PCS', '2600', '2522', 'MOD Based On Purchase Orders 173.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2254, 'XADAST00017', '2022-05-13', 'Tube Labeling Printer ( Canon-MK2600)', 'Fas Arabia llc', 'PCS', '3800', '3686', 'Adwea Based On Purchase Orders 111. Inv#78116', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2255, 'XADMIS0008', '2022-09-09', 'Alcohoal Bottle', 'Azlan Star Technologies LLC', 'BOT', '20', '19.4', 'Request No 014/22 Requested By : Nikunj Patel  Verified By : Shamas Tabraiz & Imran Iqbal Based On Purchase Orders 610.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2256, 'XADMIS0008', '2023-01-24', 'Alcohoal Bottle', 'Ali Asghar Hussani', 'BOT', '16', '15.52', 'Request No : DU SFAN - 93 - Jan - 2023 Based On Purchase Orders 1528.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2257, 'XADMIS0011', '2022-01-10', 'Face Mask', 'Ali Asghar Hussani', 'Box', '5', '4.85', 'GRN : 10-01-016 Project: L&T Etihad Rail Based On Purchase Orders 3410.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2258, 'XADMIS0011', '2022-11-02', 'Face Mask', 'Smooth Solution building Materails Trading LLC', 'Box', '10', '9.7', 'Request No : Xad-003  Requested By : Bashir Subhani Based On Purchase Orders 1013.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2259, 'XADMIS0011', '2023-01-23', 'Face Mask', 'JOGA RAM GENERAL TRADING LLC', 'Box', '3.5', '3.395', 'Request No : XAD-001-Jan-2023 Based On Purchase Orders 1569.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2260, 'XADMIS0012', '2023-02-28', 'A4 Copy Paper', 'Copier Range Trading EST', 'PKT', '67', '64.99', 'Box File Folder & A4 Paper For DSO Office 28-02-2023 . Based On Purchase Orders 1833.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2261, 'XADMIS0012', '2023-06-26', 'A4 Copy Paper', 'M S K Corporate Services Provides EST', 'PKT', '68', '65.96', 'Stationery Material Required For DXB Warehouse. Based On Purchase Orders 2631.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2262, 'XADMIS0014', '2023-02-18', 'NCR Book - Consumable Issuance Form', 'M S K Corporate Services Provides EST', 'PCS', '16', '15.52', 'New Tool , Client , Consumble Issuance & Return Book For Xad All Warehouses. Based On Purchase Orders 1761.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2263, 'XADMIS0015', '2023-02-18', 'NCR Book - Received Form', 'M S K Corporate Services Provides EST', 'PCS', '18.5', '17.945', 'New Tool , Client , Consumble Issuance & Return Book For Xad All Warehouses. Based On Purchase Orders 1761.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2264, 'XADMIS0016', '2022-04-09', 'BOX File Folder', 'Cash', 'PCS', '9', '8.73', 'GRN: 9-04-023 LPO 50/3774 Requested by: Rashid Ahmad Verified By : Sohail Abbas Prepared By : Wahab Aslam Based On Purchase Orders 50.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2265, 'XADMIS0016', '2023-02-07', 'BOX File Folder', 'M S K Corporate Services Provides EST', 'PCS', '12', '11.64', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1674.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2266, 'XADMIS0016', '2023-02-28', 'BOX File Folder', 'Copier Range Trading EST', 'PCS', '10', '9.7', 'Box File Folder & A4 Paper For DSO Office 28-02-2023 . Based On Purchase Orders 1833.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2267, 'XADMIS0016', '2024-01-11', 'BOX File Folder', 'Ali Asghar Hussani', 'PCS', '10', '9.7', 'REQUEST NO 287 DU SFAN PROJECT Based On Purchase Orders 3852.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2268, 'XADMIS0018', '2022-10-31', 'Ball Point, Stapler , Highlighter etc', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'Box', '2.34', '2.2698', 'Request No : DU SFAN-OCT-74  Requested By : Ahmad Iqbal Verified By      : Sharafu Tk & Imran Iqbal Based On Purchase Orders 1009.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2269, 'XADMIS0018', '2023-02-16', 'Ball Point, Stapler , Highlighter etc', 'Smooth Solution building Materails Trading LLC', 'Box', '0.75', '0.7275', 'Request No : DU SFAN-104-Jan-2023 Based On Purchase Orders 1672.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2270, 'XADMIS0018', '2023-08-04', 'Ball Point, Stapler , Highlighter etc', 'M S K Corporate Services Provides EST', 'Box', '175', '169.75', 'Request No : DU SFAN - 215 - 223 . Based On Purchase Orders 2859.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2271, 'XADMIS0018', '2024-02-28', 'Ball Point, Stapler , Highlighter etc', 'Ali Asghar Hussani', 'Box', '1.5', '1.455', 'REQUEST NO : 304   DU SFAN PROJECT DXB REGION Based On Purchase Orders 4147.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2272, 'XADMIS0022', '2022-01-10', 'Concrete Spacer 100mm', 'Ali Asghar Hussani', 'PCS', '1.5', '1.455', 'GRN : 10-01-016 Project: L&T Etihad Rail Based On Purchase Orders 3410.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2273, 'XADMIS0022', '2022-09-08', 'Concrete Spacer 100mm', 'JOGA RAM GENERAL TRADING LLC', 'PCS', '2.25', '2.1825', 'Project : DXB Etihad Rail Requested By : Blessan Koshy Verified By : Imran Iqbal Based On Purchase Orders 560.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2274, 'XADMIS0024', '2022-03-31', 'Folder Plastic Leaves ( Pouch )', 'MSK Corporate Services', 'PKT', '20', '19.4', 'GRN : 31-03-032 Project : Nokia TI & OD Based On Purchase Orders:3698', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2275, 'XADMIS0024', '2022-06-22', 'Folder Plastic Leaves ( Pouch )', 'Ali Asghar Hussani', 'PKT', '10', '9.7', 'Nokia Mobile Project Based On Purchase Orders 232.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2276, 'XADMIS0027', '2022-07-15', 'Line Dori Mix', 'Noor Al Iman', 'PCS', '3', '2.91', 'Etihad Rail Based On Purchase Orders 325.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2277, 'XADMIS0028', '2022-03-29', 'Report File A4 size', 'MSK Corporate Services', 'Box', '55', '53.35', 'GRN : 29-03-024 Project:Huawei OD Based On Purchase Orders :3662', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2278, 'XADMIS0030', '2023-05-19', 'A4 size Sticker', 'Imdad Al Saif Building & Cont.Mat.Trdg.Co.LLC', 'PCS', '0.4', '0.388', 'Request No : DU SFAN -175 - 08-05-2023 . Based On Purchase Orders 2305.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2279, 'XADMIS0030', '2023-07-17', 'A4 size Sticker', 'M S K Corporate Services Provides EST', 'PCS', '0.5', '0.485', 'Request No : XAD-HW-July-DXB-111-108 . Based On Purchase Orders 2749.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2280, 'XADMIS0033', '2022-04-04', 'Medical items for First Aid Kit', 'Zam Zam Pharmacy', 'PKT', '952.5', '923.925', 'GRN:   15-04-011 Project: Huawei EHS Based On Purchase Orders 3744.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2281, 'XADMIS0034', '2023-02-18', 'NCR Book - Tool Issuance Book', 'M S K Corporate Services Provides EST', 'PCS', '18.5', '17.945', 'New Tool , Client , Consumble Issuance & Return Book For Xad All Warehouses. Based On Purchase Orders 1761.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2282, 'XADMIS0035', '2023-02-18', 'NCR Book - Clinet Return Book', 'M S K Corporate Services Provides EST', 'PCS', '18.5', '17.945', 'New Tool , Client , Consumble Issuance & Return Book For Xad All Warehouses. Based On Purchase Orders 1761.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2283, 'XADMIS0036', '2023-02-23', 'Stampler Pin ( 26/ 6 )', 'M S K Corporate Services Provides EST', 'PKT', '10', '9.7', 'Stationary iteam (A4 papers box and shorthand books) for Xad Sharjah/Headoffice ( 25-02-2023 ) Based On Purchase Orders 1801.', '2024-10-09 03:56:59', '2024-10-09 03:56:59'),
(2284, 'XADMIS0037', '2023-02-23', 'A4 ShortHand Writing Book', 'M S K Corporate Services Provides EST', 'PCS', '5', '4.85', 'Stationary iteam (A4 papers box and shorthand books) for Xad Sharjah/Headoffice ( 25-02-2023 ) Based On Purchase Orders 1801.', '2024-10-09 03:56:59', '2024-10-09 03:56:59');

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
(19, 'nabeel', 'javed', 'nabeeljaved2029@gmail.com', 'pak', 'Project Manager', '0521077862', '$2y$12$EHZmQeCwCQ8wmA5H53V1suAans/2WT0qtykRfvx4WzxgUf411dJKG', 'Project Manager', '\"[\\\"Project Management\\\"]\"', '172499948757.jfif', '2024-08-29 05:51:09', '2024-08-29 05:51:09'),
(33, 'xad', 'tech', 'admin@xadtech.com', 'pak', 'admin', '0521077862', '$2y$12$WHWpYX5rpA3oSZYQYx.T6emR.1A.C2XfICThPWxCEvzfSistqapBW', 'Admin', '\"[\\\"Project Management\\\",\\\"Cash Flow Management\\\",\\\"Bank Management\\\",\\\"User Management\\\"]\"', '172499948757.jfif', '2024-08-30 02:31:28', '2024-08-30 02:31:28'),
(35, 'shahbaz', 'anjum', 'shahbaz@xadtech.com', NULL, 'admin', '0521077862', '$2y$10$wGzRSPSOc5KHdFrp33E0vuJl.WbHLREtMESmiHCg25jWJrIirMble', 'Finance Manager', '\"[\\\"Project Management\\\",\\\"Cash Flow Management\\\"]\"', '172499948757.jfif', '2024-08-30 02:36:34', '2024-10-09 01:41:49'),
(36, 'ahmed', 'shabbir', 'ahmed@xadtech.com', 'pak', 'Project Manager', '050521077862', '$2y$12$ZvcN2OHAhSUNjwe5uR0EGOw55Ix/94w5NwoRWhYprySNy4MRVhAU2', 'Project Manager', '\"[\\\"Project Management\\\"]\"', '', '2024-09-16 04:47:51', '2024-09-16 04:47:51'),
(37, 'Majid', 'aslam', 'majid@xadtech.com', 'Pak', 'Logistics', '050 050 050 050', '$2y$12$3N4uydfegGQhZLgrtxOD3eaZ.OSpvyF5obRo2yPWdeuITnsfeH3M.', 'Project Manager', '\"[\\\"Project Management\\\"]\"', '', '2024-10-01 02:29:20', '2024-10-02 02:07:13'),
(38, 'khalid', 'omar', 'ceo@xadtech.com', 'Pak', 'CEO', '0547014800', '$2y$10$Pm/cRim769BlglRAxuMNyOwfRzNyI7iLXIScPzD5QFSAjlJb2TWBq', 'Admin', NULL, '', '2024-10-09 01:54:19', '2024-10-09 02:54:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocated_budget`
--
ALTER TABLE `allocated_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_budget`
--
ALTER TABLE `approved_budget`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cash_flows`
--
ALTER TABLE `cash_flows`
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
-- Indexes for table `noc_payments`
--
ALTER TABLE `noc_payments`
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
-- Indexes for table `petty_cash`
--
ALTER TABLE `petty_cash`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders_item`
--
ALTER TABLE `purchase_orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_sequence`
--
ALTER TABLE `purchase_order_sequence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_sequence_date_index` (`date`);

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
-- Indexes for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
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
-- AUTO_INCREMENT for table `allocated_budget`
--
ALTER TABLE `allocated_budget`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `approved_budget`
--
ALTER TABLE `approved_budget`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_project`
--
ALTER TABLE `budget_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `business_clients`
--
ALTER TABLE `business_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_units`
--
ALTER TABLE `business_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `capital_expenditure`
--
ALTER TABLE `capital_expenditure`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cash_flows`
--
ALTER TABLE `cash_flows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `cost_overhead`
--
ALTER TABLE `cost_overhead`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `direct_cost`
--
ALTER TABLE `direct_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facility_cost`
--
ALTER TABLE `facility_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_cost`
--
ALTER TABLE `financial_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `indirect_cost`
--
ALTER TABLE `indirect_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `material_cost`
--
ALTER TABLE `material_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `noc_payments`
--
ALTER TABLE `noc_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petty_cash`
--
ALTER TABLE `petty_cash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `planned_cash`
--
ALTER TABLE `planned_cash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planned_cash_opening_balances`
--
ALTER TABLE `planned_cash_opening_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_budget_sequence`
--
ALTER TABLE `project_budget_sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_orders_item`
--
ALTER TABLE `purchase_orders_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_order_sequence`
--
ALTER TABLE `purchase_order_sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `revenue_plans`
--
ALTER TABLE `revenue_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2285;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
