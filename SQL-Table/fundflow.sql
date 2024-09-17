-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 08:57 AM
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
  `total_opex` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_capex` decimal(15,2) NOT NULL DEFAULT 0.00,
  `reference_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allocated_budget`
--

INSERT INTO `allocated_budget` (`id`, `budget_project_id`, `total_salary`, `total_facility_cost`, `total_material_cost`, `total_cost_overhead`, `total_financial_cost`, `total_capital_expenditure`, `allocated_budget`, `total_opex`, `total_capex`, `reference_code`, `created_at`, `updated_at`) VALUES
(10, 1, 50000.00, 15000.00, 5000.00, 300.00, 4000.00, 5000.00, 79300.00, 0.00, 0.00, 'BP091220240001', '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(11, 2, 309800.00, 396000.00, 5330.00, 100141.00, 30000.00, 60800.00, 902071.00, 0.00, 0.00, 'BP091220240002', '2024-09-17 02:05:55', '2024-09-17 02:05:55');

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
(11, 1, 60000.00, 15000.00, 5000.00, 300.00, 4000.00, 5000.00, 305000.00, 196287.00, 215700.00, 'BP091220240001', '2024-09-17 00:46:56', '2024-09-17 00:46:56'),
(12, 2, 309800.00, 396000.00, 5330.00, 100141.00, 30000.00, 60800.00, 1489257.00, 534339.26, 587186.00, 'BP091220240002', '2024-09-17 02:04:55', '2024-09-17 02:04:55');

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
  `approve_by` bigint(20) DEFAULT NULL,
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
  `status` varchar(255) DEFAULT 'Good',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_project`
--

INSERT INTO `budget_project` (`id`, `reference_code`, `start_date`, `end_date`, `project_id`, `unit_id`, `manager_id`, `approve_by`, `client_id`, `region`, `site_name`, `description`, `budget_type`, `country`, `month`, `approval_status`, `bal_under_over_budget`, `total_budget_allocated`, `total_dpm_expense`, `total_lpo_expense`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BP091220240001', '2024-09-12', '2024-11-12', 1, 2, 19, 19, 1, 'Dubai', 'abu hail, dubai', 'starting new', 'Auto Workshop', 'UAE', '2024-09-01', 'approve', NULL, 79300.00, NULL, NULL, 'Good', '2024-09-12 04:02:57', '2024-09-17 00:47:18'),
(2, 'BP091220240002', '2024-09-13', '2024-11-14', 1, 1, 19, 19, 1, 'Riyadh', 'abu hail, dubai', 'starting new', 'Fleet Management', 'KSA', '2024-09-01', 'approve', NULL, 902071.00, NULL, NULL, 'Good', '2024-09-12 06:37:30', '2024-09-17 02:05:55');

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
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `capital_expenditure`
--

INSERT INTO `capital_expenditure` (`id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(4, 1, '4.1', 'Capital Expenditure', 'DU CIVIL', '1', 'CAPEX', 'Capital Expense', 'Cable Detector', 'new', 5000.00, 0, 0, 5000.00, 5000.00, 'approved', '2024-09-13 04:21:38', '2024-09-13 04:21:38'),
(5, 2, '4.1', 'Capital Expenditure', 'DU CIVIL', '1', 'CAPEX', 'Cable Expenditure', 'Cable Detector', 'required', 10000.00, 0, 2, 20000.00, 10000.00, 'approved', '2024-09-17 01:56:55', '2024-09-17 01:59:53'),
(6, 2, '4.1', 'Capital Expenditure', 'DU CIVIL', '1', 'CAPEX', 'Capital Expenditure', 'Plate Compactor', 'required', 4500.00, 0, 2, 9000.00, 4500.00, 'approved', '2024-09-17 01:57:51', '2024-09-17 01:57:51'),
(7, 2, '4.1', 'Capital Expenditure', 'DU CIVIL', '1', 'CAPEX', 'Capital Expenditure', 'Generator 5 kva', 'required', 3900.00, 0, 2, 7800.00, 3900.00, 'approved', '2024-09-17 01:59:24', '2024-09-17 01:59:24'),
(8, 2, '4.1', 'Capital Expenditure', 'DU CIVIL', '1', 'CAPEX', 'Capital Expenditure', 'Jack Hammer', 'new', 7500.00, 0, 2, 15000.00, 7500.00, 'approved', '2024-09-17 02:00:31', '2024-09-17 02:00:31'),
(9, 2, '4.1', 'Capital Expenditure', 'DU CIVIL', '1', 'CAPEX', 'Capital Expenditure', 'Cable Pulling Rod 200m', 'required', 4500.00, 0, 2, 9000.00, 4500.00, 'approved', '2024-09-17 02:01:15', '2024-09-17 02:01:15');

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
(8, '2024-09-17', 'Initial Allocation', 'Salary', 'BP091220240001', 50000.00, 0.00, 50000.00, 50000.00, 1, '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(9, '2024-09-17', 'Initial Allocation', 'Facility', 'BP091220240001', 15000.00, 0.00, 15000.00, 15000.00, 1, '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(10, '2024-09-17', 'Initial Allocation', 'Material', 'BP091220240001', 5000.00, 0.00, 5000.00, 5000.00, 1, '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(11, '2024-09-17', 'Initial Allocation', 'Overhead', 'BP091220240001', 300.00, 0.00, 300.00, 300.00, 1, '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(12, '2024-09-17', 'Initial Allocation', 'Financial', 'BP091220240001', 4000.00, 0.00, 4000.00, 4000.00, 1, '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(13, '2024-09-17', 'Initial Allocation', 'Capital_expenditure', 'BP091220240001', 5000.00, 0.00, 5000.00, 5000.00, 1, '2024-09-17 00:47:18', '2024-09-17 00:47:18'),
(14, '2024-09-17', 'Initial Allocation', 'Salary', 'BP091220240002', 309800.00, 0.00, 309800.00, 309800.00, 2, '2024-09-17 02:05:55', '2024-09-17 02:05:55'),
(15, '2024-09-17', 'Initial Allocation', 'Facility', 'BP091220240002', 396000.00, 0.00, 396000.00, 396000.00, 2, '2024-09-17 02:05:55', '2024-09-17 02:05:55'),
(16, '2024-09-17', 'Initial Allocation', 'Material', 'BP091220240002', 5330.00, 0.00, 5330.00, 5330.00, 2, '2024-09-17 02:05:55', '2024-09-17 02:05:55'),
(17, '2024-09-17', 'Initial Allocation', 'Overhead', 'BP091220240002', 100141.00, 0.00, 100141.00, 100141.00, 2, '2024-09-17 02:05:55', '2024-09-17 02:05:55'),
(18, '2024-09-17', 'Initial Allocation', 'Financial', 'BP091220240002', 30000.00, 0.00, 30000.00, 30000.00, 2, '2024-09-17 02:05:55', '2024-09-17 02:05:55'),
(19, '2024-09-17', 'Initial Allocation', 'Capital_expenditure', 'BP091220240002', 60800.00, 0.00, 60800.00, 60800.00, 2, '2024-09-17 02:05:55', '2024-09-17 02:05:55');

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
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_overhead`
--

INSERT INTO `cost_overhead` (`id`, `in_direct_cost_id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2.4', 'overhead cost', 'annual contract', '3', 'OPEX', 'overhead', 'Annual Visa', 'new visa', 150.00, 2, 0, 300.00, 300.00, 'approved', '2024-09-13 03:27:36', '2024-09-13 03:28:21'),
(5, 2, 2, '2.4', 'overhead cost', 'DU CIVIL', '1', 'CAPEX', 'overhead', 'HO Cost', 'will cost in furute', 44829.00, 0, 0, 44829.00, 44829.00, 'approved', '2024-09-17 01:42:42', '2024-09-17 01:42:42'),
(6, 2, 2, '2.4', 'overhead cost', 'DU CIVIL', '1', 'CAPEX', 'overhead', 'Annual Benefit', 'new', 47655.00, 0, 0, 47655.00, 47655.00, 'approved', '2024-09-17 01:43:57', '2024-09-17 01:43:57'),
(7, 2, 2, '2.4', 'overhead cost', 'DU CIVIL', '1', 'CAPEX', 'overhead', 'Insurance Cost', 'new incur cost', 7159.00, 0, 0, 7159.00, 7159.00, 'approved', '2024-09-17 01:45:10', '2024-09-17 01:45:10'),
(8, 2, 2, '2.4', 'overhead cost', 'DU CIVIL', '1', 'CAPEX', 'Visa Renewal', 'Visa Renewal', 'incur cost', 498.00, 0, 0, 498.00, 498.00, 'approved', '2024-09-17 01:46:48', '2024-09-17 01:46:48');

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
(1, 1, NULL, '2024-09-12 04:03:55', '2024-09-12 04:03:55'),
(2, 2, NULL, '2024-09-17 01:06:09', '2024-09-17 01:06:09');

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
  `no_of_staff` int(11) DEFAULT NULL,
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_cost`
--

INSERT INTO `facility_cost` (`id`, `direct_cost_id`, `budget_project_id`, `sn`, `type`, `project`, `contract`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2.2', 'Facility Cost', '3', 'DU CIVIL', 'OPEX', 'Facilities', 'Accomodation', 'New Villa Sharjah', 5000.00, 1, 3, 15000.00, 5000.00, 'approved', '2024-09-13 02:46:14', '2024-09-13 03:05:46'),
(5, 2, 2, '2.2', 'Facility Cost', '1', 'DU CIVIL', 'OPEX', 'Facilities', 'Fuel', 'new', 4000.00, 11, 2, 88000.00, 4000.00, 'approved', '2024-09-17 01:26:26', '2024-09-17 01:26:26'),
(6, 2, 2, '2.2', 'Facility Cost', '1', 'DU CIVIL', 'OPEX', 'Facilities', 'SIM', 'new', 27000.00, 2, 2, 108000.00, 27000.00, 'approved', '2024-09-17 01:27:45', '2024-09-17 01:27:45'),
(7, 2, 2, '2.2', 'Facility Cost', '1', 'DU CIVIL', 'OPEX', 'Facilities', 'Accomodation', 'new', 10000.00, 10, 2, 200000.00, 10000.00, 'approved', '2024-09-17 01:29:34', '2024-09-17 01:29:34');

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
  `no_of_months` int(11) NOT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_cost`
--

INSERT INTO `financial_cost` (`id`, `in_direct_cost_id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_months`, `total_cost`, `average_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2.5', 'financial cost', 'DU CIVIL', '1', 'CAPEX', 'Financial Cost', '5% for Financial Cost', 'new cost', 1000.00, 4, 4000.00, 1000.00, 'approved', '2024-09-13 03:51:43', '2024-09-13 03:51:43'),
(5, 2, 2, '2.5', 'financial cost', 'DU CIVIL', '1', 'CAPEX', 'Financial Cost', 'Risk', 'incure financial cost', 5000.00, 2, 10000.00, 5000.00, 'approved', '2024-09-17 01:51:31', '2024-09-17 01:51:31'),
(6, 2, 2, '2.5', 'financial cost', 'DU CIVIL', '1', 'CAPEX', 'Financial Cost', 'will cost for setting off debts', 'incur financial cost', 10000.00, 2, 20000.00, 10000.00, 'approved', '2024-09-17 01:55:30', '2024-09-17 01:55:30');

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
(1, 1, NULL, '2024-09-12 04:35:46', '2024-09-12 04:35:46'),
(2, 2, NULL, '2024-09-17 01:42:42', '2024-09-17 01:42:42');

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
  `contract` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `average_cost` decimal(15,2) DEFAULT NULL,
  `total_budget` decimal(15,2) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_cost`
--

INSERT INTO `material_cost` (`id`, `direct_cost_id`, `budget_project_id`, `sn`, `type`, `project`, `po`, `expenses`, `contract`, `description`, `status`, `quantity`, `unit`, `unit_cost`, `total_cost`, `average_cost`, `total_budget`, `approval_status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2.3', 'Material', '3', 'OPEX', 'Material', 'DU CIVIL', '100 Meter Ethernet Cable', 'purchase new stack', 100.00, 'meters', 50.00, 5000.00, 50.00, NULL, 'approved', '2024-09-13 03:08:23', '2024-09-13 03:16:53'),
(5, 2, 2, '2.3', 'Material', '1', 'OPEX', 'Copper Wires', 'DU CIVIL', '500 meters of copper wiring for electrical work', 'new to purchase', 500.00, 'meters', 2.50, 1250.00, 2.50, NULL, 'approved', '2024-09-17 01:32:43', '2024-09-17 01:33:03'),
(6, 2, 2, '2.3', 'Material', '1', 'OPEX', 'Facilities', NULL, 'Concrete bags for foundation laying', 'new to purchase', 100.00, 'pieces', 6.80, 680.00, 6.80, NULL, 'approved', '2024-09-17 01:35:27', '2024-09-17 01:35:27'),
(7, 2, 2, '2.3', 'Material', '1', 'OPEX', 'Material', 'DU CIVIL', '20 pieces of 6-meter wooden beams for construction support', 'new to purchase', 200.00, 'pieces', 17.00, 3400.00, 17.00, NULL, 'approved', '2024-09-17 01:38:45', '2024-09-17 01:39:48');

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
(13, '2024_08_30_114158_create_material_cost_table', 1),
(14, '2024_08_31_104724_create_direct_cost_table', 1),
(15, '2024_08_31_104731_create_indirect_cost_table', 1),
(16, '2024_08_31_1121116_create_facility_costs_table', 1),
(17, '2024_08_31_115424_create_cost_overhead_table', 1),
(18, '2024_08_31_115903_create_financial_cost_table', 1),
(19, '2024_09_02_103513_create_capital_expenditure_table', 1),
(20, '2024_09_03_045117_create_project_budget_sequence_table', 1),
(21, '2024_09_03_072221_create_revenue_plans_table', 1),
(22, '2024_09_06_053630_create_purchase_order_sequence_table', 1),
(23, '2024_09_08_121209_create_purchase_order_items_table', 1),
(24, '2024_09_10_064229_create_budget_project_table', 1),
(25, '2024_09_10_064836_create_cash_flows_table', 1),
(26, '2024_09_12_070334_create_total_budget_allocated_table', 1),
(27, '2024_09_9_1114526_create_salaries_table', 1),
(28, '2024_10_12_070334_create_total_budget_allocated_table', 2),
(29, '2024_10_12_070335_create_total_budget_allocated_table', 3),
(30, '2024_09_03_072222_create_revenue_plans_table', 4),
(31, '2024_09_03_072223_create_revenue_plans_table', 5),
(32, '2024_09_02_103514_create_capital_expenditure_table', 6),
(33, '2024_10_12_070336_create_total_budget_allocated_table', 7),
(34, '2024_11_13_070336_create_total_budget_allocated_table', 8),
(35, '2024_11_14_070336_create_total_budget_allocated_table', 9),
(36, '2024_11_15_070336_create_total_budget_allocated_table', 10),
(37, '2024_09_14_070336_create_total_budget_allocated_table', 11),
(38, '2024_09_15_192731_create_approved_budget_table', 12),
(39, '2024_09_15_192732_create_approved_budget_table', 13),
(40, '2024_09_14_192841_create_allocated_budget_table', 14),
(41, '2024_09_16_064836_create_cash_flows_table', 15);

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
(3, 'WR-OLT', NULL, NULL, 'Active', '2024-09-07 02:03:35', '2024-09-07 02:03:35');

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
(1, '09122024', 2, '2024-09-12 04:02:57', '2024-09-12 06:37:30');

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
  `requested_by` bigint(20) UNSIGNED NOT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `prepared_by` bigint(20) DEFAULT NULL,
  `date` date NOT NULL,
  `payment_term` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `total_discount` decimal(10,2) DEFAULT NULL,
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

INSERT INTO `purchase_orders` (`id`, `po_number`, `supplier_name`, `description`, `supplier_address`, `project_id`, `requested_by`, `verified_by`, `prepared_by`, `date`, `payment_term`, `subtotal`, `vat`, `total_discount`, `total`, `budget_total`, `budget_utilization`, `budget_balance`, `current_request`, `status`, `is_verified`, `created_at`, `updated_at`) VALUES
(10, 'PO091620240012', 'Innovative', 'starting new Project', 'Abu Hail, UAE', 1, 19, NULL, 33, '2024-09-17', 'net90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Not Submitted', 0, '2024-09-16 08:22:23', '2024-09-16 08:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) DEFAULT 'Not Submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `po_number`, `items`, `total_amount`, `total_discount`, `total_vat`, `status`, `created_at`, `updated_at`) VALUES
(5, 9, 'PO091620240011', '[{\"item\":\"1\",\"description\":\"TV\",\"quantity\":2,\"unitPrice\":200,\"itemTotal\":400}]', 403.52, 12.00, 15.52, 'submitted', '2024-09-16 07:46:52', '2024-09-16 07:46:52');

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
(1, '09162024', 12, '2024-09-16 02:17:37', '2024-09-16 08:22:23');

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
(3, 1, 1, 'Revenue', '2', 'Civil Project', 'NOC Payment', 300000.00, 300000.00, 215700.00, 19413.00, 196287.00, 65.4290, 'approved', '2024-09-13 04:39:45', '2024-09-13 04:39:45'),
(4, 2, 1, 'Revenue', '1', 'DU CIVIL', 'Civil Project', 1088457.00, 1388457.00, 547186.00, 49246.74, 497939.26, 45.7473, 'approved', '2024-09-17 02:03:04', '2024-09-17 02:03:04'),
(5, 2, 1, 'Revenue', '1', 'DU CIVIL', 'NOC Payment', 40000.00, 1428457.00, 587186.00, 52846.74, 534339.26, 1335.8482, 'approved', '2024-09-17 02:04:35', '2024-09-17 02:04:35');

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
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `direct_cost_id`, `budget_project_id`, `sn`, `type`, `contract`, `project`, `po`, `expenses`, `description`, `status`, `cost_per_month`, `no_of_staff`, `no_of_months`, `total_cost`, `average_cost`, `approval_status`, `created_at`, `updated_at`) VALUES
(11, 1, 1, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'project manager salary', 'new hiring', 5000.00, 2, 6, 60000.00, 5000.00, 'approved', '2024-09-13 02:24:47', '2024-09-13 02:24:47'),
(13, 2, 2, '2.1', 'Salary', 'Du Civil', '1', 'OPEX', 'Salary', 'Client Manager', 'Existing Resource on Sharing', 4400.00, 1, 2, 8800.00, 4400.00, 'approved', '2024-09-17 01:06:09', '2024-09-17 01:14:03'),
(14, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'Sr. Client Relationship Manager', 'new hiring', 4000.00, 1, 2, 8000.00, 4000.00, 'approved', '2024-09-17 01:07:06', '2024-09-17 01:13:53'),
(15, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'Sr. Manager Operations', 'new hiring', 13500.00, 1, 2, 27000.00, 13500.00, 'approved', '2024-09-17 01:08:20', '2024-09-17 01:08:20'),
(16, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'project manager salary', 'new hiring', 4500.00, 5, 4, 90000.00, 4500.00, 'approved', '2024-09-17 01:15:24', '2024-09-17 01:15:24'),
(17, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'Document Controller', 'new hiring', 3000.00, 10, 2, 60000.00, 3000.00, 'approved', '2024-09-17 01:18:08', '2024-09-17 01:18:08'),
(18, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'HSE / QMS Coordinator', 'new hiring', 3000.00, 3, 2, 18000.00, 3000.00, 'approved', '2024-09-17 01:19:27', '2024-09-17 01:19:27'),
(19, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'Mason', 'new hiring', 3000.00, 1, 2, 6000.00, 3000.00, 'approved', '2024-09-17 01:20:39', '2024-09-17 01:20:39'),
(20, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'Helper', 'new hiring', 1200.00, 20, 2, 48000.00, 1200.00, 'approved', '2024-09-17 01:22:21', '2024-09-17 01:22:21'),
(21, 2, 2, '2.1', 'Salary', 'DU CIVIL', '1', 'OPEX', 'salary', 'Bus Driver', 'new hiring', 2200.00, 10, 2, 44000.00, 2200.00, 'approved', '2024-09-17 01:23:54', '2024-09-17 01:23:54');

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
(35, 'shahbaz', 'anjum', 'shahbaz@xadtech.com', NULL, 'admin', '0521077862', '$2y$10$UqThbHgSNWcA/PAvH6PYmuN163EairEOMoJ73xa47WUhieFG1D8eG', 'Finance Manager', '\"[\\\"Project Management\\\",\\\"Cash Flow Management\\\"]\"', '172499948757.jfif', '2024-08-30 02:36:34', '2024-09-15 08:45:26'),
(36, 'ahmed', 'shabbir', 'ahmed@xadtech.com', 'pak', 'Project Manager', '050521077862', '$2y$12$ZvcN2OHAhSUNjwe5uR0EGOw55Ix/94w5NwoRWhYprySNy4MRVhAU2', 'Project Manager', '\"[\\\"Project Management\\\"]\"', '', '2024-09-16 04:47:51', '2024-09-16 04:47:51');

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
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `approved_budget`
--
ALTER TABLE `approved_budget`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_project`
--
ALTER TABLE `budget_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cash_flows`
--
ALTER TABLE `cash_flows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cost_overhead`
--
ALTER TABLE `cost_overhead`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `direct_cost`
--
ALTER TABLE `direct_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facility_cost`
--
ALTER TABLE `facility_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_cost`
--
ALTER TABLE `financial_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indirect_cost`
--
ALTER TABLE `indirect_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `material_cost`
--
ALTER TABLE `material_cost`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_budget_sequence`
--
ALTER TABLE `project_budget_sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_order_sequence`
--
ALTER TABLE `purchase_order_sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `revenue_plans`
--
ALTER TABLE `revenue_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
