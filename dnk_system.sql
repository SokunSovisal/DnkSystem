-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2019 at 05:00 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnk_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `agreements`
--

CREATE TABLE `agreements` (
  `id` int(10) UNSIGNED NOT NULL,
  `agr_files` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agr_description` text COLLATE utf8_unicode_ci NOT NULL,
  `agr_company_id` int(10) UNSIGNED NOT NULL,
  `agr_created_by` int(10) UNSIGNED NOT NULL,
  `agr_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_datetime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_description` text COLLATE utf8_unicode_ci,
  `app_status` int(11) NOT NULL DEFAULT '0',
  `app_services_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_company_id` int(10) UNSIGNED NOT NULL,
  `app_user_id` int(10) UNSIGNED NOT NULL,
  `app_created_by` int(10) UNSIGNED NOT NULL,
  `app_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `app_datetime`, `app_description`, `app_status`, `app_services_id`, `app_company_id`, `app_user_id`, `app_created_by`, `app_updated_by`, `created_at`, `updated_at`) VALUES
(3, '2018-12-19 14:50:38', NULL, 2, 'a:1:{i:0;s:2:\"59\";}', 2, 5, 5, 5, '2018-12-19 06:58:46', '2019-01-28 03:20:32'),
(4, '2019-01-30 15:10:12', 'wswd', 2, 'a:3:{i:0;s:2:\"78\";i:1;s:2:\"25\";i:2;s:2:\"44\";}', 2, 5, 5, 5, '2019-01-28 08:11:42', '2019-01-30 08:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `br_date` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `br_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `br_total` double(8,2) DEFAULT NULL,
  `br_description` text COLLATE utf8_unicode_ci,
  `br_paid_status` int(11) NOT NULL DEFAULT '0',
  `br_company_id` int(10) UNSIGNED NOT NULL,
  `br_created_by` int(10) UNSIGNED NOT NULL,
  `br_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `br_date`, `br_number`, `br_total`, `br_description`, `br_paid_status`, `br_company_id`, `br_created_by`, `br_updated_by`, `created_at`, `updated_at`) VALUES
(1, '2019-01-19', '000302', 2944.00, NULL, 0, 3, 5, 5, '2019-01-19 06:44:54', '2019-01-19 06:44:54'),
(2, '2019-02-07', '000109', 1000.00, NULL, 0, 3, 5, 5, '2019-01-19 06:45:23', '2019-01-19 06:45:23'),
(3, '2019-01-19', '000324', 900.00, NULL, 0, 3, 5, 5, '2019-01-19 06:45:50', '2019-01-19 06:45:50'),
(4, '2019-01-30', '768452', 1500.00, NULL, 1, 6, 5, 5, '2019-01-30 09:49:02', '2019-01-28 08:08:29'),
(5, '2019-03-01', '0423143', 1200.00, NULL, 1, 3, 5, 5, '2019-01-28 02:40:45', '2019-01-28 02:41:50'),
(6, '2020-04-15', '098983', 2100.00, NULL, 0, 3, 5, 5, '2019-01-28 04:00:16', '2019-01-28 04:00:16'),
(7, '2020-08-06', '02348972394', 3100.00, NULL, 0, 3, 5, 5, '2019-01-28 04:00:46', '2019-01-28 04:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `ch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ch_description` text COLLATE utf8_unicode_ci,
  `ch_service_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `com_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_email` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_tax_size` int(11) NOT NULL,
  `com_type` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `com_vat_id` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_description` text COLLATE utf8_unicode_ci,
  `com_cus_status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `com_addr_map` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_addr_house` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_addr_street` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_addr_group` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_addr_village` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_addr_commune` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_cp_name` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_cp_phone` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_cp_email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `com_cp_gender` int(11) DEFAULT NULL,
  `com_cp_description` text COLLATE utf8_unicode_ci,
  `com_district_id` int(5) DEFAULT NULL,
  `com_province_id` int(5) DEFAULT NULL,
  `com_objective_id` int(10) UNSIGNED NOT NULL,
  `com_created_by` int(10) UNSIGNED NOT NULL,
  `com_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `com_name`, `com_name_en`, `com_phone`, `com_email`, `com_tax_size`, `com_type`, `com_vat_id`, `com_logo`, `com_description`, `com_cus_status`, `com_addr_map`, `com_addr_house`, `com_addr_street`, `com_addr_group`, `com_addr_village`, `com_addr_commune`, `com_cp_name`, `com_cp_phone`, `com_cp_email`, `com_cp_gender`, `com_cp_description`, `com_district_id`, `com_province_id`, `com_objective_id`, `com_created_by`, `com_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Unknown', '', NULL, NULL, 2, '1', NULL, 'default_company.png', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'Unkown', '0', NULL, 1, NULL, 96, 12, 3, 5, 5, '2018-12-17 19:09:31', '2018-12-19 07:51:50'),
(2, 'ដេលី ឡាយសាយអិនស៍', 'Daily Life science Co., Ltd', '012 235 537', NULL, 2, '1', 'K009-103015175', 'default_company.png', NULL, '0', NULL, '៨A', '៣៧១', NULL, 'ត្រពាំងឈូក', 'ទឹកថ្លា', 'Ms. Daily life', '012 235 537', 'dailylife@gmail.com', 2, NULL, 103, 12, 2, 5, 5, '2018-12-17 00:54:53', '2018-12-17 00:54:53'),
(3, 'ឌីអ.ទាប ពុយ ហ្វាម៉ា', 'Dr Tep Puy Pharma', '012 227 177', 'tp_pharma@yahoo.com', 2, '3', 'K007-109006038', 'default_company.png', NULL, '0', NULL, '០៨A', 'លំ(៣៩៦)', NULL, '០២', 'ស្ទឹងមានជ័យ', 'Mr. Teppuy', '012 227 177', 'tp_pharma@yahoo.com', 1, NULL, 101, 12, 1, 5, 5, '2018-12-17 00:50:32', '2019-01-17 02:46:56'),
(6, 'Testing1', 'Testing2', NULL, NULL, 1, '2', NULL, '1548830061_6.png', NULL, '0', 'https://www.google.com/maps/place/11%C2%B034\'33.6%22N+104%C2%B055\'23.1%22E/@11.576005,104.92308,16z/data=!4m5!3m4!1s0x0:0x0!8m2!3d11.576005!4d104.92308', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 5, 5, '2019-01-16 02:16:10', '2019-01-30 06:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `dist_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dist_code` int(11) DEFAULT NULL,
  `dist_description` text COLLATE utf8_unicode_ci,
  `dist_province_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `dist_name`, `dist_code`, `dist_description`, `dist_province_id`, `created_at`, `updated_at`) VALUES
(1, 'មង្គលបូរី', 102, 'Mungkul Borey', 1, '2018-12-06 23:17:27', '2018-12-06 16:17:27'),
(2, 'ភ្នំស្រុក', 103, 'Phnum Srok', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(3, 'ព្រះនេត្រព្រះ', 104, 'Preah Netr Preah', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(4, 'អូរជ្រៅ', 105, 'Ou Chrov', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(5, 'សិរីសោភ័ណ', 106, 'Serey Sophorn', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(6, 'ថ្មពួក', 107, 'Thma Puok', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(7, 'ស្វាយចេក', 108, 'Svay Chek', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(8, 'ម៉ាឡៃ', 109, 'Malai', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(9, 'បាណន់', 201, 'Banan', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(10, 'ថ្មគោល', 202, 'Thmor Koul', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(11, 'បវេល', 204, 'Bavel', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(12, 'ឯកភ្នំ', 205, 'Aek Phnum', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(13, 'មោងឫស្សី', 206, 'Maung Russey', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(14, 'រុក្ខគីរី', 214, 'Rukhakiri', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(15, 'រតនមណ្ឌល', 207, 'Ratanak Mondul', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(16, 'សង្កែ', 208, 'Sangke', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(17, 'សំឡូត', 209, 'Samlaut', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(18, 'សំពៅលូន', 210, 'Sampov Loun', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(19, 'ភ្នំព្រឹក', 211, 'Phnum Proek', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(20, 'កំរៀង', 212, 'Kamreang', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(21, 'គាស់ក្រឡ', 213, 'Koas Krala', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(22, 'បាត់ដំបង', 203, 'Battambang', 2, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(23, 'ប៉ោយប៉ែត', 110, 'Poipet', 1, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(24, 'កំពង់ចាម', 304, 'Kampong Cham', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(25, 'បាធាយ​', 301, 'Batheay', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(26, 'ចំការលើ​', 302, 'Chamkar Leu', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(27, 'ជើងព្រៃ​', 303, 'Cheung Prey', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(28, 'កំពង់សៀម​', 305, 'Kampong Siem', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(29, 'កងមាស​', 306, 'Kang Meas', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(30, 'កោះសូទិន​', 307, 'Kaoh Soutin', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(31, 'ព្រៃឈរ​', 308, 'Prey Chhor', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(32, 'ស្រីសន្ធរ​', 309, 'Srey Santhor', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(33, 'ស្ទឹងត្រង់', 310, 'Stueng Trang', 3, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(34, 'បរិបូណ៌', 401, 'Baribour', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(35, 'ជលគីរី', 402, 'Chol Kiri', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(36, 'កំពង់ឆ្នាំង', 403, 'Kampong Chhnang', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(37, 'កំពង់លែង', 404, 'Kampong Leaeng', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(38, 'កំពង់ត្រឡាច', 405, 'Kampong Tralach', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(39, 'រលាប្អៀរ', 406, 'Rolea B\'ier', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(40, 'សាមគ្គីមានជ័យ', 407, 'Sameakki Mean Chey', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(41, 'ទឹកផុស', 408, 'Tuek Phos', 4, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(42, 'បរសេដ្ឋ', 501, 'Borsedth', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(43, 'ច្បារមន', 502, 'Chbar Mon', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(44, 'គងពិសី', 503, 'Kong Pisei', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(45, 'ឱរ៉ាល់', 504, 'Aoral', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(46, 'ឧដុង្គ', 505, 'Odongk', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(47, 'ភ្នំស្រួច', 506, 'Phnum Sruoch', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(48, 'សំរោងទង', 507, 'Samraong Tong', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(49, 'ថ្ពង', 508, 'Thpong', 5, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(50, 'បារាយណ៍', 601, 'Baray', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(51, 'កំពង់ស្វាយ', 602, 'Kampong Svay', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(52, 'ស្ទឹងសែន', 603, 'Stueng Saen', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(53, 'ប្រាសាទបល្ល័ង្ក', 604, 'Prasat Balang', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(54, 'ប្រាសាទសំបូរ', 605, 'Prasat Sambour', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(55, 'សណ្ដាន់', 606, 'Sandan', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(56, 'សន្ទុក', 607, 'Santuk', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(57, 'ស្ទោង', 608, 'Stoung', 6, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(58, 'អង្គរជ័យ', 0, 'Angkor Chey', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(59, 'បន្ទាយមាស', 0, 'Bantay Meas', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(60, 'ឈូក', 0, 'Chouk', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(61, 'ជុំគីរី', 0, 'Chum Kiri', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(62, 'ដងទង់', 0, 'Dong Tung', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(63, 'កំពង់ត្រាច', 0, 'Kampong Trach', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(64, 'កំពត', 0, 'Kampot', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(65, 'ទឹកឈូ', 0, 'Tuek Chu', 7, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(66, 'កណ្ដាលស្ទឹង', 801, 'Kandal Stueng', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(67, 'កៀនស្វាយ', 802, 'Kien Svay', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(68, 'ខ្សាច់កណ្តាល', 803, 'Khsach Kandal', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(69, 'កោះធំ', 804, 'Kaoh Thum', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(70, 'លើកដែក', 805, 'Leuk Daek', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(71, 'ល្វាឯម', 806, 'Lvea Aem', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(72, 'មុខកំពូល', 807, 'Mukh Kampul', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(73, 'អង្គស្នួល', 808, 'Angk Snuol', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(74, 'ពញាឮ', 809, 'Ponhea Lueu', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(75, 'ស្អាង', 810, 'S\'ang', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(76, 'តាខ្មៅ', 811, 'Ta Khmau', 8, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(77, 'បទុមសាគរ', 901, 'Botum Sakor', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(78, 'គីរីសាគរ', 902, 'Kiri Sakor', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(79, 'កោះកុង', 903, 'Koh Kong', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(80, 'ស្មាច់មានជ័យ', 904, 'Smach Mean Chey', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(81, 'មណ្ឌលសីមា', 905, 'Mondol Seima', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(82, 'ស្រែអំបិល', 906, 'Srae Ambel', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(83, 'ថ្មបាំង', 907, 'Thmo Bang', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(84, 'កំពង់សិលា', 908, 'Kampong Seila', 9, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(85, 'ឆ្លូង​', 1001, 'Chhloung', 10, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(86, 'ក្រចេះ', 1002, 'Kratie', 10, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(87, 'ព្រែកប្រសព្វ', 1003, 'Preaek Prasab', 10, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(88, 'សំបូរ', 1004, 'Sambour', 10, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(89, 'ស្នួល', 1005, 'Snuol', 10, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(90, 'ចិត្របុរី', 1006, 'Chet Borei', 10, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(91, 'ស្រុកកែវសីមា', 1101, 'Kaev Seima', 11, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(92, 'ស្រុកកោះញែក', 1102, 'Kaoh Nheaek', 11, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(93, 'ស្រុកអូររាំង', 1103, 'Ou Reang', 11, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(94, 'ស្រុកពេជ្រាដា', 1104, 'Pech Chreada', 11, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(95, 'សែនមនោរម្យ', 1105, 'Senmonorom', 11, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(96, 'ចំការមន', 0, 'Chamkar Mon', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(97, 'ដូនពេញ', 0, 'Doun Penh', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(98, '៧មករា', 0, '7 Meakkakra', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(99, 'ទួលគោក', 0, 'Tuol Kouk', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(100, 'ដង្កោ', 0, 'Dangkao', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(101, 'មានជ័យ', 0, 'Mean Chey', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(102, 'ឫស្សីកែវ', 0, 'Russey Keo', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(103, 'សែនសុខ', 0, 'Sen Sok', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(104, 'ពោធិ៍សែនជ័យ', 0, 'Pur SenChey', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(105, 'ជ្រោយចង្វារ', 0, 'Chraoy Chongvar', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(106, 'ព្រែកព្នៅ', 0, 'Praek Pnov', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(107, 'ច្បារអំពៅ', 0, 'Chbar Ampov', 12, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(108, 'ជ័យសែន', 1301, 'Chey Saen', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(109, 'ឆែប', 1302, 'Chhaeb', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(110, 'ជាំក្សាន្ត', 1303, 'Choam Khsant', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(111, 'គូលែន', 1304, 'Kuleaen', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(112, 'វៀង', 1305, 'Rovieng', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(113, 'សង្គមថ្មី', 1306, 'Sangkom Thmei', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(114, 'ត្បែងមានជ័យ', 1307, 'Tbaeng Mean chey', 13, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(115, 'ព្រៃវែង​', 1401, 'Prey Veng', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(116, 'កំចាយមារ​', 1402, 'Kamchay Mea', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(117, 'កំពង់ត្របែក', 1403, 'Kampong Trobek', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(118, 'កញ្ច្រៀច​', 1404, 'Kachreach', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(119, 'មេសាង​', 1405, 'Mesang', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(120, 'ពាមជរ​', 1406, 'Peamchor', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(121, 'ពាមរ​', 1407, 'Peamr', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(122, 'ពារាំង​', 1408, 'Peareang', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(123, 'ព្រះស្ដេច​', 1409, 'Prehsdach', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(124, 'ស្វាយអន្ទរ​', 1410, 'Svay Ontor', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(125, 'បាភ្នំ​', 1411, 'Baphnum', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(126, 'ស៊ីធរកណ្ដាល​', 1412, 'Sithor Kandal', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(127, 'កំពង់លាវ', 1413, 'Kampong Leav', 14, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(128, 'បាកាន', 1501, 'Bakan', 15, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(129, 'កណ្តៀង', 1502, 'Kandeang', 15, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(130, 'ក្រគរ', 1503, 'Krokor', 15, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(131, 'ភ្នំក្រវាញ', 1504, 'Phnum Kravanh', 15, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(132, 'ពោធិ៍សាត់', 1505, 'Pursat', 15, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(133, 'វាលវែង', 1506, 'Veal Veaeng', 15, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(134, 'អណ្តូងមាស​', 1601, 'Andoung Meas', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(135, 'បានលុង', 1602, 'Ban Lung', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(136, 'បរកែវ', 1603, 'Bar Kaev', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(137, 'កូនមុំ', 1604, 'Koun Mom', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(138, 'លំផាត់', 1605, 'Lumphat', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(139, 'អូរជុំ', 1606, 'Ou Chum', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(140, 'អូរយ៉ាដាវ', 1607, 'Ou Ya Dav', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(141, 'តាវែង', 1608, 'Ta Veaeng', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(142, 'វើនសៃ', 1609, 'Veun Sai', 16, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(143, 'អង្គរជុំ', 1701, 'Angkor Chum', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(144, 'អង្គរធំ', 1702, 'Angkor Thum', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(145, 'បន្ទាយស្រី', 1703, 'Banteay Srei', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(146, 'ជីក្រែង', 1704, 'Chi Kraeng', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(147, 'ក្រឡាញ់', 1706, 'Kralanh', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(148, 'ពួក', 1707, 'Puok', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(149, 'ប្រាសាទបាគង', 1709, 'Prasat Bakong', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(150, 'សៀមរាប', 1710, 'Siem Reab', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(151, 'សូទ្រនិគម', 1711, 'Soutr Nikom', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(152, 'ស្រីស្នំ', 1712, 'Srei Snam', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(153, 'ស្វាយលើ', 1713, 'Svay Leu', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(154, 'វ៉ារិន', 1714, 'Varin', 17, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(155, 'មិត្តភាព', 1801, 'Mittakpheap', 18, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(156, 'ព្រៃនប់', 1802, 'Prey Nob', 18, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(157, 'ស្ទឹងហាវ', 1803, 'Stueng Hav', 18, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(158, 'កំពង់សីលា', 1804, 'Kampong Seila', 18, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(159, 'សេសាន', 1901, 'Sesan', 19, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(160, 'សៀមបូក', 1902, 'Siem Bouk', 19, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(161, 'សៀមប៉ាង', 1903, 'Siem Pang', 19, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(162, 'ស្ទឹងត្រែង', 1904, 'Stueng Traeng', 19, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(163, 'ថាឡាបរិវ៉ាត់', 1905, 'Thala Barivat', 19, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(164, 'ចន្រ្ទា​', 2001, 'Chanthrea', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(165, 'កំពង់រោទិ៍', 2002, 'Kampong Rou', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(166, 'រំដួល', 2003, 'Romdoul', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(167, 'រមាសហែក', 2004, 'Romeas Haek', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(168, 'ស្វាយជ្រំ', 2005, 'Svay Chrom', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(169, 'ស្វាយរៀង', 2006, 'Svay Rieng', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(170, 'ស្វាយទាប', 2007, 'Svay Theab', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(171, 'បាវិត', 2008, 'Bavet', 20, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(172, 'អង្គរបូរី​', 2101, 'Angkor Borei', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(173, 'បាទី', 2102, 'Bati', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(174, 'បូរីជលសារ', 2103, 'Borei Cholsar', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(175, 'គិរីវង់', 2104, 'Kiri Vong', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(176, 'កោះអណ្តែត', 2105, 'Kaoh Andaet', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(177, 'ព្រៃកប្បាស', 2106, 'Prey Kabbas', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(178, 'សំរោង', 2107, 'Samraong', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(179, 'ដូនកែវ', 2108, 'Doun Kaev', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(180, 'ត្រាំកក់', 2109, 'Tram Kak', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(181, 'ទ្រាំង', 2110, 'Treang', 21, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(182, 'ដំណាក់ចង្អើរ', 2201, 'Damnak Chang\'aeur', 23, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(183, 'កែប', 2202, 'Kep', 23, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(184, 'ប៉ៃលិន​', 2301, 'Pailin', 24, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(185, 'សាលា​​ក្រៅ', 2302, 'Salakrao', 24, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(186, 'អន្លង់វែង', 2201, 'Anlong Veng', 22, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(187, 'បន្ទាយអំពិល', 2202, 'Banteay Ampil', 22, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(188, 'ចុងកាល់', 2203, 'Chong Kal', 22, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(189, 'សំរោង', 2204, 'Samraong', 22, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(190, 'ត្រពាំងប្រាសាទ', 2205, 'Trapeang Prasat', 22, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(191, 'ដំបែ', 0, 'Dambe', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(192, 'ក្រូចឆ្មារ', 0, 'Krochhma', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(193, 'មេមត់', 0, 'Memut', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(194, 'អូររាំងឪ', 0, 'Orangov', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(195, 'ពញាក្រែក', 0, 'Punhea Krek', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(196, 'ត្បូងឃ្មុំ', 0, 'Tboung Khmum', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00'),
(197, 'សួង', 0, 'Soung', 25, '2018-12-06 22:12:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `f_description` text COLLATE utf8_unicode_ci,
  `f_fc_id` int(10) UNSIGNED NOT NULL,
  `f_company_id` int(10) UNSIGNED NOT NULL,
  `f_created_by` int(10) UNSIGNED NOT NULL,
  `f_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `f_name`, `f_description`, `f_fc_id`, `f_company_id`, `f_created_by`, `f_updated_by`, `created_at`, `updated_at`) VALUES
(1, '1545980656_Testing.jpg', NULL, 1, 2, 5, 5, '2018-12-28 07:04:16', '2018-12-28 07:04:16'),
(2, '1545980676_123123.pdf', NULL, 1, 2, 5, 5, '2018-12-28 07:04:36', '2018-12-28 07:04:36'),
(3, '1548389894_123.jpg', '123', 3, 2, 5, 5, '2019-01-25 04:18:15', '2019-01-25 04:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `file_categories`
--

CREATE TABLE `file_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `fc_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fc_description` text COLLATE utf8_unicode_ci,
  `fc_created_by` int(10) UNSIGNED NOT NULL,
  `fc_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_categories`
--

INSERT INTO `file_categories` (`id`, `fc_name`, `fc_description`, `fc_created_by`, `fc_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Agreements', 'Agreements', 5, 5, '2018-12-26 02:28:42', '2018-12-26 02:28:42'),
(2, 'Document from GDT', 'Document from GDT', 5, 5, '2018-12-26 02:28:59', '2018-12-26 02:28:59'),
(3, 'Documents From MoC', 'Documents From MoC', 5, 5, '2018-12-26 02:29:15', '2018-12-26 02:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `inv_date` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `inv_number` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `inv_total` float NOT NULL DEFAULT '0',
  `inv_com_phone` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_com_address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_vat_status` int(11) NOT NULL DEFAULT '1',
  `inv_quote_refer` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inv_description` text COLLATE utf8_unicode_ci,
  `inv_paid_status` tinyint(1) NOT NULL DEFAULT '0',
  `inv_company_id` int(10) UNSIGNED NOT NULL,
  `inv_created_by` int(10) UNSIGNED NOT NULL,
  `inv_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `inv_date`, `inv_number`, `inv_total`, `inv_com_phone`, `inv_com_address`, `inv_vat_status`, `inv_quote_refer`, `inv_description`, `inv_paid_status`, `inv_company_id`, `inv_created_by`, `inv_updated_by`, `created_at`, `updated_at`) VALUES
(3, '2019-02-01', '000001', 1650, '012 235 537', 'ផ្ទះ៨A, ផ្លូវ៣៧១, ភូមិត្រពាំងឈូក, ឃុំទឹកថ្លា, ខណ្ឌសែនសុខ, ខេត្តភ្នំពេញ', 1, '1', NULL, 0, 2, 5, 5, '2019-01-12 03:15:18', '2019-01-19 05:09:01'),
(4, '2019-01-30', '000002', 700, '012 235 537', 'ផ្ទះ៨A, ផ្លូវ៣៧១, ភូមិត្រពាំងឈូក, ឃុំទឹកថ្លា, ខណ្ឌសែនសុខ, ខេត្តភ្នំពេញ', 1, NULL, NULL, 0, 2, 5, 5, '2019-01-18 03:03:19', '2019-01-19 01:50:14'),
(5, '2019-03-01', '000003', 1200, '012 235 537', 'ផ្ទះ៨A, ផ្លូវ៣៧១, ភូមិត្រពាំងឈូក, ឃុំទឹកថ្លា, ខណ្ឌសែនសុខ, ខេត្តភ្នំពេញ', 1, NULL, NULL, 0, 2, 5, 5, '2019-01-18 03:22:15', '2019-01-18 09:27:38'),
(6, '2019-04-01', '000004', 450, '012 235 537', 'ផ្ទះ៨A, ផ្លូវ៣៧១, ភូមិត្រពាំងឈូក, ឃុំទឹកថ្លា, ខណ្ឌសែនសុខ, ខេត្តភ្នំពេញ', 1, NULL, NULL, 1, 2, 5, 5, '2019-01-18 03:26:06', '2019-01-19 05:09:17'),
(7, '2019-01-21', '000005', 2050, '012 227 177', 'ផ្ទះ០៨A, ផ្លូវលំ(៣៩៦), ភូមិ០២, ឃុំស្ទឹងមានជ័យ, ខណ្ឌមានជ័យ, ខេត្តភ្នំពេញ', 2, NULL, NULL, 0, 3, 5, 5, '2019-01-21 02:37:57', '2019-01-21 02:38:21'),
(8, '2019-01-21', '000006', 1200, '012 227 177', 'ផ្ទះ០៨A, ផ្លូវលំ(៣៩៦), ភូមិ០២, ឃុំស្ទឹងមានជ័យ, ខណ្ឌមានជ័យ, ខេត្តភ្នំពេញ', 2, NULL, NULL, 0, 3, 5, 5, '2019-01-21 02:42:01', '2019-01-21 02:42:42'),
(9, '2019-01-30', '000007', 8400, '012 235 537', 'ផ្ទះ៨A, ផ្លូវ៣៧១, ភូមិត្រពាំងឈូក, ឃុំទឹកថ្លា, ខណ្ឌសែនសុខ, ខេត្តភ្នំពេញ', 1, NULL, '<p>qwerqwerqwer</p>', 0, 2, 5, 5, '2019-01-30 08:30:28', '2019-01-30 08:33:35'),
(10, '2020-10-16', '000008', 2250, '012 235 537', 'ផ្ទះ៨A, ផ្លូវ៣៧១, ភូមិត្រពាំងឈូក, ឃុំទឹកថ្លា, ខណ្ឌសែនសុខ, ខេត្តភ្នំពេញ', 1, NULL, NULL, 0, 2, 5, 5, '2019-01-30 04:02:58', '2019-01-30 04:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `invd_price` double(8,2) NOT NULL,
  `invd_qty` int(11) NOT NULL,
  `invd_description` text COLLATE utf8_unicode_ci,
  `invd_invoice_id` int(10) UNSIGNED NOT NULL,
  `invd_service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invd_price`, `invd_qty`, `invd_description`, `invd_invoice_id`, `invd_service_id`, `created_at`, `updated_at`) VALUES
(13, 450.00, 1, NULL, 3, 78, '2019-01-12 03:15:37', '2019-01-12 03:15:37'),
(14, 1200.00, 1, NULL, 3, 25, '2019-01-12 03:15:46', '2019-01-12 03:15:46'),
(17, 700.00, 1, NULL, 4, 27, '2019-01-18 03:04:05', '2019-01-18 03:04:05'),
(18, 1200.00, 1, NULL, 5, 25, '2019-01-18 03:22:30', '2019-01-18 03:22:30'),
(19, 450.00, 1, NULL, 6, 78, '2019-01-18 03:26:26', '2019-01-18 03:26:26'),
(20, 1200.00, 1, '<p>123</p>', 7, 30, '2019-01-21 02:38:10', '2019-01-21 02:38:10'),
(21, 850.00, 1, '<p>123</p>', 7, 26, '2019-01-21 02:38:21', '2019-01-21 02:38:21'),
(22, 450.00, 1, NULL, 8, 78, '2019-01-21 02:42:23', '2019-01-21 02:42:23'),
(23, 750.00, 1, NULL, 8, 94, '2019-01-21 02:42:42', '2019-01-21 02:42:42'),
(24, 450.00, 2, '<ul>\n	<li>asdfasdfasdf</li>\n	<li>rtu</li>\n	<li>e5yr</li>\n</ul>', 9, 78, '2019-01-30 08:31:08', '2019-01-30 08:31:08'),
(25, 7500.00, 1, '<ul>\n	<li>qewrwer</li>\n	<li>5eyrw</li>\n	<li>5ryweq</li>\n</ul>', 9, 36, '2019-01-30 08:31:20', '2019-01-30 08:31:20'),
(26, 450.00, 5, NULL, 10, 78, '2019-01-30 04:03:10', '2019-01-30 04:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `mainservices`
--

CREATE TABLE `mainservices` (
  `id` int(10) UNSIGNED NOT NULL,
  `ms_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ms_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mainservices`
--

INSERT INTO `mainservices` (`id`, `ms_name`, `ms_description`, `created_at`, `updated_at`) VALUES
(1, 'MoC', 'ក្រសួងពាណិជ្ជកម្ម', '2018-09-17 14:09:26', '2018-09-28 11:28:32'),
(2, 'GDT', 'អគ្គនាយកដ្ឋានពន្ធដារ', '2018-09-17 14:09:26', '2018-09-28 11:28:48'),
(3, 'MoC and GDT', 'Service Package', '2018-09-24 16:25:41', '2018-09-28 11:26:42'),
(4, 'MoEF', '', '2018-09-25 18:12:59', '2018-09-28 11:27:37'),
(5, 'MoLM', '', '2018-09-28 11:28:04', '2018-09-28 11:28:04'),
(6, 'MoLVT', '', '2018-09-28 11:29:15', '2018-09-28 11:29:15'),
(7, 'MoPT', '', '2018-09-28 11:29:37', '2018-09-28 11:29:37'),
(8, 'MoH', '', '2018-09-28 11:29:51', '2018-09-28 11:29:51'),
(9, 'MoHI', 'សិប្បកម្ម និង ឧស្សាហកម្ម', '2018-09-28 11:30:33', '2018-09-28 11:30:33'),
(10, 'MoT', 'Tourist', '2018-10-30 21:13:53', '2018-10-30 21:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_12_18_094551_create_user_roles_table', 1),
(2, '2018_12_18_094612_create_users_table', 1),
(3, '2018_12_18_094656_create_provinces_table', 1),
(4, '2018_12_18_094734_create_districts_table', 1),
(5, '2018_12_18_094804_create_objectives_table', 1),
(6, '2018_12_18_094827_create_mainservices_table', 1),
(7, '2018_12_18_094846_create_services_table', 1),
(8, '2018_12_18_094906_create_companies_table', 1),
(9, '2018_12_18_094934_create_appointments_table', 1),
(10, '2018_12_18_094955_create_quotations_table', 1),
(11, '2018_12_18_095010_create_quotation_services_table', 1),
(12, '2018_12_21_104755_create_agreements_table', 2),
(13, '2018_12_24_155244_create_file_categories_table', 3),
(14, '2018_12_24_155255_create_files_table', 3),
(17, '2019_01_03_074843_create_invoices_table', 4),
(18, '2019_01_03_081713_create_invoice_detail_table', 4),
(19, '2019_01_11_081213_create_invoice_detail_table', 5),
(20, '2019_01_11_081220_create_recipts_table', 5),
(23, '2019_01_11_081428_create_invoice_details_table', 6),
(29, '2019_01_11_085639_create_receipts_table', 7),
(34, '2019_01_16_102552_create_bills_table', 8),
(35, '2019_01_16_113453_create_payment_transitions_table', 8),
(36, '2019_01_24_102733_create_staffs_table', 9),
(39, '2019_01_25_090703_create_modules_table', 11),
(41, '2019_01_24_111139_create_permissions_table', 12),
(44, '2019_01_31_140921_create_checklist_table', 13),
(45, '2019_01_31_140948_create_process_table', 13),
(46, '2019_01_31_141054_create_transactions_table', 13),
(47, '2019_01_31_141118_create_transaction_checklist_table', 13),
(48, '2019_01_31_141134_create_transaction_process_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `m_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `m_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `m_name`, `m_url`) VALUES
(2, 'ការណាត់ជួប', 'appointments'),
(3, 'សម្រង់តម្លៃ', 'quotations'),
(4, 'វិក្កយបត្រចំណូល', 'invoices'),
(5, 'ប័ណ្ណទទួលប្រាក់', 'receipts'),
(6, 'វិក្កយបត្រចំណាយ', 'billsreceived'),
(7, 'ការទូទាត់ប្រាក់', 'accountpayables'),
(8, 'ប្រាក់មិនទាន់ទទួល', 'ARReport'),
(9, 'ប្រាក់មិនទាន់ទទួល', 'APReport'),
(10, 'របាយការណ៍ចំណូល', 'incomereport'),
(11, 'របាយការណ៍ចំណាយ', 'expensereport'),
(12, 'របាយការណ៍ចំណេញ-ខាត', 'profitloss'),
(13, 'សកម្មភាពអាជីវកម្ម', 'objectives'),
(14, 'ក្រុមហ៊ុន', 'companies'),
(15, 'ប្រភេទឯកសារ', 'filecategories'),
(16, 'ឯកសារ', 'files'),
(17, 'សេវាកម្មធំៗ', 'mainservices'),
(18, 'បុគ្គលិក', 'staffs'),
(19, 'អ្នកប្រើប្រាស់', 'users'),
(20, 'ឋានៈអ្នកប្រើប្រាស់', 'roles'),
(21, 'សិទ្ធិអ្នកប្រើប្រាស់', 'permissions'),
(22, 'ខេត្ត', 'provinces'),
(23, 'ស្រុក', 'districts'),
(24, 'សេវាកម្ម', 'services'),
(25, 'ឯកសារតម្រូវ', 'checklist'),
(26, 'ដំណើរការការងារ', 'process'),
(27, 'ដំណើរការគម្រោង', 'projectprocess');

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE `objectives` (
  `id` int(10) UNSIGNED NOT NULL,
  `obj_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `obj_description` text COLLATE utf8_unicode_ci,
  `obj_created_by` int(10) UNSIGNED NOT NULL,
  `obj_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objectives`
--

INSERT INTO `objectives` (`id`, `obj_name`, `obj_description`, `obj_created_by`, `obj_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'អាហរ័ណ នីហរ័ណ (ថ្នាំពេទ្យ)', 'អាហរ័ណ នីហរ័ណ (ថ្នាំពេទ្យ)', 5, 5, '2018-12-17 00:46:29', '2018-12-17 00:46:29'),
(2, 'អាហរ័ណ នីហរ័ណ (ឱសថ និងបរិក្ខាពេទ្យ)', 'អាហរ័ណ នីហរ័ណ (ឱសថ និងបរិក្ខាពេទ្យ)', 5, 5, '2018-12-17 00:51:56', '2018-12-17 00:51:56'),
(3, 'Unknown', 'Unknown', 5, 5, '2018-12-17 19:08:16', '2018-12-19 07:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transitions`
--

CREATE TABLE `payment_transitions` (
  `id` int(10) UNSIGNED NOT NULL,
  `pt_date` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `pt_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pt_amount` double(8,2) DEFAULT NULL,
  `pt_description` text COLLATE utf8_unicode_ci,
  `pt_bill_id` int(10) UNSIGNED NOT NULL,
  `pt_created_by` int(10) UNSIGNED NOT NULL,
  `pt_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_transitions`
--

INSERT INTO `payment_transitions` (`id`, `pt_date`, `pt_number`, `pt_amount`, `pt_description`, `pt_bill_id`, `pt_created_by`, `pt_updated_by`, `created_at`, `updated_at`) VALUES
(1, '2019-01-19', NULL, 100.00, NULL, 3, 5, 5, '2019-01-19 06:56:01', '2019-01-19 06:56:01'),
(2, '2019-01-19', NULL, 150.00, NULL, 3, 5, 5, '2019-01-19 06:57:10', '2019-01-19 06:57:10'),
(3, '2019-01-19', NULL, 505.00, NULL, 2, 5, 5, '2019-01-19 07:00:13', '2019-01-19 07:00:13'),
(4, '2019-02-07', NULL, 444.00, NULL, 1, 5, 5, '2019-01-19 07:03:04', '2019-01-19 07:03:04'),
(5, '2019-01-30', NULL, 1000.00, NULL, 4, 5, 5, '2019-01-30 09:49:26', '2019-01-30 09:49:26'),
(6, '2019-01-28', NULL, 850.00, NULL, 5, 5, 5, '2019-01-28 02:41:01', '2019-01-28 02:41:01'),
(7, '2019-03-01', NULL, 350.00, NULL, 5, 5, 5, '2019-01-28 02:41:50', '2019-01-28 02:41:50'),
(8, '2019-01-28', NULL, 95.00, NULL, 2, 5, 5, '2019-01-28 03:25:07', '2019-01-28 03:25:07'),
(9, '2019-01-28', NULL, 500.00, NULL, 4, 5, 5, '2019-01-28 08:08:29', '2019-01-28 08:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `p_view` int(11) NOT NULL DEFAULT '0',
  `p_create` int(11) NOT NULL DEFAULT '0',
  `p_edit` int(11) NOT NULL DEFAULT '0',
  `p_delete` int(11) NOT NULL DEFAULT '0',
  `p_module_id` int(10) UNSIGNED NOT NULL,
  `p_role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `p_view`, `p_create`, `p_edit`, `p_delete`, `p_module_id`, `p_role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 21, 12, NULL, NULL),
(68, 1, 1, 1, 1, 2, 12, '2019-01-31 04:52:12', '2019-01-31 06:37:43'),
(69, 1, 1, 1, 1, 3, 12, '2019-01-31 04:52:22', '2019-01-31 04:52:25'),
(70, 1, 1, 1, 1, 4, 12, '2019-01-31 04:52:25', '2019-01-31 04:52:39'),
(71, 1, 1, 1, 1, 5, 12, '2019-01-31 04:52:26', '2019-01-31 04:52:40'),
(72, 1, 1, 1, 1, 6, 12, '2019-01-31 04:52:26', '2019-01-31 04:52:41'),
(73, 1, 1, 1, 1, 7, 12, '2019-01-31 04:52:27', '2019-01-31 04:52:42'),
(74, 1, 1, 1, 1, 8, 12, '2019-01-31 04:52:27', '2019-01-31 04:52:42'),
(75, 1, 1, 1, 1, 9, 12, '2019-01-31 04:52:29', '2019-01-31 04:52:43'),
(76, 1, 1, 1, 1, 10, 12, '2019-01-31 04:52:29', '2019-01-31 04:52:43'),
(77, 1, 1, 1, 1, 11, 12, '2019-01-31 04:52:30', '2019-01-31 04:52:44'),
(78, 1, 1, 1, 1, 12, 12, '2019-01-31 04:52:47', '2019-01-31 04:53:04'),
(79, 1, 1, 1, 1, 13, 12, '2019-01-31 04:52:48', '2019-01-31 04:53:04'),
(80, 1, 1, 1, 1, 14, 12, '2019-01-31 04:52:48', '2019-01-31 04:53:05'),
(81, 1, 1, 1, 1, 15, 12, '2019-01-31 04:52:49', '2019-01-31 04:53:05'),
(82, 1, 1, 1, 1, 16, 12, '2019-01-31 04:52:49', '2019-01-31 04:53:06'),
(83, 1, 1, 1, 1, 17, 12, '2019-01-31 04:52:50', '2019-01-31 04:53:06'),
(84, 1, 1, 1, 1, 18, 12, '2019-01-31 04:52:50', '2019-01-31 04:53:07'),
(85, 1, 1, 1, 1, 19, 12, '2019-01-31 04:52:52', '2019-01-31 04:53:07'),
(86, 1, 1, 1, 1, 20, 12, '2019-01-31 04:52:52', '2019-01-31 04:53:08'),
(87, 1, 1, 1, 1, 22, 12, '2019-01-31 04:53:10', '2019-01-31 04:53:16'),
(88, 1, 1, 1, 1, 23, 12, '2019-01-31 04:53:11', '2019-01-31 04:53:16'),
(89, 1, 1, 1, 1, 24, 12, '2019-01-31 04:53:11', '2019-01-31 04:53:17'),
(90, 1, 1, 1, 1, 2, 13, '2019-01-31 06:37:24', '2019-01-31 06:37:52'),
(91, 0, 0, 0, 0, 3, 13, '2019-01-31 06:37:55', '2019-01-31 06:37:55'),
(92, 1, 1, 1, 1, 25, 12, '2019-02-05 01:24:47', '2019-02-05 01:24:51'),
(93, 1, 1, 1, 1, 26, 12, '2019-02-05 01:24:48', '2019-02-05 01:24:51'),
(94, 1, 1, 1, 1, 27, 12, '2019-02-05 04:14:39', '2019-02-05 04:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(10) UNSIGNED NOT NULL,
  `pr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pr_description` text COLLATE utf8_unicode_ci,
  `pr_service_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `pr_name`, `pr_description`, `pr_service_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'សាល្បង ១១១', '123123', 78, 5, 5, '2019-02-06 02:05:40', '2019-02-06 02:05:40'),
(2, 'Testing 222', 'qweqwe', 78, 5, 5, '2019-02-06 02:05:54', '2019-02-06 02:05:54'),
(3, 'asdf', 'asdf', 78, 5, 5, '2019-02-06 05:12:05', '2019-02-06 05:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `pro_name` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `pro_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `pro_name`, `pro_description`, `created_at`, `updated_at`) VALUES
(1, 'បន្ទាយមានជ័យ', 'Banteay Meanchey', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(2, 'បាត់ដំបង', 'Battambang', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(3, 'កំពង់ចាម', 'Kampong Cham', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(4, 'កំពង់ឆ្នាំង', 'Kampong Chhnang', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(5, 'កំពង់ស្ពឺ', 'Kampong Speu', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(6, 'កំពង់ធំ', 'Kampong Thom', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(7, 'កំពត', 'Kampot', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(8, 'កណ្ដាល', 'Kandal', '2018-12-06 22:14:06', '2018-12-06 15:14:06'),
(9, 'កោះកុង', 'Koh Kong', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(10, 'ក្រចេះ', 'Kratie', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(11, 'មណ្ឌលគិរី', 'Mondul Kiri', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(12, 'ភ្នំពេញ', 'Phnom Penh', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(13, 'ព្រះវិហារ', 'Preah Vihear', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(14, 'ព្រៃវែង', 'Prey Veng', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(15, 'ពោធិ៍សាត់', 'Pursat', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(16, 'រតនគិរី', 'Ratanak', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(17, 'សៀមរាប', 'Siemreap', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(18, 'ព្រះសីហនុ', 'Preah Sihanouk', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(19, 'ស្ទឹងត្រែង', 'Stung Treng', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(20, 'ស្វាយរៀង', 'Svay Rieng', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(21, 'តាកែវ', 'Takeo', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(22, 'ឧត្ដរមានជ័យ', 'Oddar Meanchey', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(23, 'កែប', 'Kep', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(24, 'ប៉ៃលិន', 'Pailin', '2018-12-06 22:13:25', '0000-00-00 00:00:00'),
(25, 'ត្បូងឃ្មុំ', 'Tboung Khmum', '2018-12-06 22:13:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `quote_number` int(11) NOT NULL,
  `quote_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quote_purpose` text COLLATE utf8_unicode_ci NOT NULL,
  `quote_cp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quote_cp_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quote_cp_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quote_term` text COLLATE utf8_unicode_ci,
  `quote_status` int(11) NOT NULL DEFAULT '1',
  `quote_company_id` int(10) UNSIGNED NOT NULL,
  `quote_created_by` int(10) UNSIGNED NOT NULL,
  `quote_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `quote_number`, `quote_date`, `quote_purpose`, `quote_cp_name`, `quote_cp_phone`, `quote_cp_email`, `quote_term`, `quote_status`, `quote_company_id`, `quote_created_by`, `quote_updated_by`, `created_at`, `updated_at`) VALUES
(1, 180001, '2018-12-18', 'Processing document for company changing office location with Ministry of Commerce and General Department of Taxation.', 'Ms. Daily life', '012 235 537', 'dailylife@gmail.com', '<div>Term &amp; Condition:</div>\r\n\r\n<ul>\r\n	<li>We need payment while agreed or contact signed.</li>\r\n	<li>After complete document with our check list provided, we need 10 week to complete.</li>\r\n</ul>\r\n\r\n<p>Thank you very much for your interesting our service today. We are looking forward to serve you. This price that we have quoted is valid till 28/December/2018</p>', 1, 2, 5, 5, '2018-12-17 22:52:03', '2018-12-19 09:02:31'),
(2, 180002, '2019-01-30', 'asdfas asdfasdf e2dfe2ffgfgfgfgfgfgfgfgf fgfgfgf fgfgfgfg', 'Ms. Daily life', '012 235 537', 'dailylife@gmail.com', '<div>Term &amp; Condition:</div>\r\n\r\n<ul>\r\n	<li>We need payment while agreed or contact signed.</li>\r\n	<li>After complete document with our check list provided, we need 10 week to complete.</li>\r\n</ul>\r\n\r\n<p>Thank you very much for your interesting our service today. We are looking forward to serve you. This price that we have quoted is valid till 09/February/2019</p>', 2, 2, 5, 5, '2019-01-30 08:18:00', '2019-01-30 08:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_services`
--

CREATE TABLE `quotation_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `qs_price` double(8,2) NOT NULL,
  `qs_qty` int(11) NOT NULL,
  `qs_description` text COLLATE utf8_unicode_ci,
  `qs_quote_id` int(10) UNSIGNED NOT NULL,
  `qs_service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quotation_services`
--

INSERT INTO `quotation_services` (`id`, `qs_price`, `qs_qty`, `qs_description`, `qs_quote_id`, `qs_service_id`, `created_at`, `updated_at`) VALUES
(1, 100.00, 1, NULL, 1, 61, '2019-01-03 08:47:09', '2019-01-03 08:47:09'),
(2, 1200.00, 1, NULL, 1, 25, '2019-01-03 08:47:14', '2019-01-03 08:49:00'),
(3, 450.00, 2, '<ul>\n	<li>sAD</li>\n	<li>asdfj</li>\n	<li>asdfjkh</li>\n</ul>', 2, 78, '2019-01-30 08:26:05', '2019-01-30 08:27:26'),
(4, 7500.00, 1, NULL, 2, 36, '2019-01-30 08:26:41', '2019-01-30 08:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `rec_date` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `rec_number` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `rec_received_amount` double(8,2) NOT NULL,
  `rec_description` text COLLATE utf8_unicode_ci,
  `rec_inv_id` int(10) UNSIGNED NOT NULL,
  `rec_created_by` int(10) UNSIGNED NOT NULL,
  `rec_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `rec_date`, `rec_number`, `rec_received_amount`, `rec_description`, `rec_inv_id`, `rec_created_by`, `rec_updated_by`, `created_at`, `updated_at`) VALUES
(3, '2019-01-12', '000001', 1000.00, '123123123', 3, 5, 5, '2019-01-12 03:19:18', '2019-01-12 07:06:16'),
(4, '2019-01-12', '000002', 400.00, 'qwe', 3, 5, 5, '2019-01-12 03:19:31', '2019-01-12 03:20:55'),
(5, '2019-01-19', '000003', 500.00, NULL, 4, 5, 5, '2019-01-19 01:48:09', '2019-01-19 01:48:09'),
(6, '2019-01-19', '000004', 150.00, NULL, 5, 5, 5, '2019-01-19 01:48:54', '2019-01-19 01:48:54'),
(7, '2019-01-19', '000005', 200.00, NULL, 5, 5, 5, '2019-01-19 01:49:29', '2019-01-19 01:49:29'),
(8, '2019-01-19', '000006', 450.00, NULL, 6, 5, 5, '2019-01-19 05:09:17', '2019-01-19 05:09:17'),
(9, '2019-01-30', '000007', 8000.00, NULL, 9, 5, 5, '2019-01-30 09:46:19', '2019-01-30 09:46:19'),
(10, '2019-01-29', '000008', 1255.00, NULL, 7, 5, 5, '2019-01-29 03:00:15', '2019-01-29 03:00:15'),
(11, '2019-01-30', '000009', 300.00, NULL, 9, 5, 5, '2019-01-30 07:10:00', '2019-01-30 07:11:20'),
(12, '2019-01-31', '000010', 250.00, NULL, 10, 5, 5, '2019-01-31 04:30:34', '2019-01-31 04:30:34'),
(13, '2019-01-31', '000011', 1000.00, NULL, 10, 5, 5, '2019-01-31 04:31:00', '2019-01-31 04:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `s_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `s_price` double(8,2) NOT NULL,
  `s_description` text COLLATE utf8_unicode_ci,
  `s_alert` int(11) NOT NULL DEFAULT '0',
  `s_ms_id` int(10) UNSIGNED NOT NULL,
  `s_created_by` int(10) UNSIGNED NOT NULL,
  `s_updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `s_name`, `s_price`, `s_description`, `s_alert`, `s_ms_id`, `s_created_by`, `s_updated_by`, `created_at`, `updated_at`) VALUES
(12, 'Company Reserve Name', 50.00, '', 0, 1, 5, 5, '2018-09-28 11:32:08', '2018-09-28 11:32:08'),
(13, 'Register proprietorship only at MoC', 400.00, '', 0, 1, 5, 5, '2018-09-28 11:50:56', '2018-09-28 11:50:56'),
(14, 'Register new company co.,ltd only MoC', 750.00, '', 0, 1, 5, 5, '2018-09-28 11:59:43', '2018-09-28 11:59:43'),
(15, 'Re-register existing company via online system', 100.00, '', 0, 1, 5, 5, '2018-09-28 12:05:29', '2018-09-28 12:05:29'),
(16, 'Submit company annual declaration at MoC', 50.00, '', 0, 1, 5, 5, '2018-09-28 12:09:39', '2018-09-28 12:09:39'),
(17, 'Renew Validity of DoC certificate', 180.00, '', 0, 1, 5, 5, '2018-09-28 12:16:08', '2018-09-28 12:16:08'),
(18, 'Register TM for local address', 430.00, '', 0, 1, 5, 5, '2018-09-28 12:35:23', '2018-09-28 12:35:23'),
(19, 'Register TM for oversea address', 530.00, '', 0, 1, 5, 5, '2018-09-28 12:36:20', '2018-09-28 12:36:20'),
(20, 'Register TM transfer to new owner', 530.00, '', 0, 1, 5, 5, '2018-09-28 12:42:00', '2018-09-28 12:42:00'),
(21, 'Register exclusive right for max 2 year', 550.00, '', 0, 1, 5, 5, '2018-09-28 12:42:47', '2018-09-28 12:42:47'),
(22, 'Register new company small tax payer per package', 800.00, '', 0, 3, 5, 5, '2018-09-28 12:50:19', '2018-09-28 12:50:19'),
(23, 'Register new company medium tax payer per package', 1700.00, '', 0, 3, 5, 5, '2018-09-28 12:52:21', '2018-09-28 12:59:00'),
(24, 'Register new company big tax payer per package', 2150.00, '', 0, 3, 5, 5, '2018-09-28 12:58:23', '2018-09-28 12:59:14'),
(25, 'Change company address different tax branch', 1200.00, '', 0, 3, 5, 5, '2018-09-28 13:02:18', '2018-09-28 13:02:18'),
(26, 'Changing company address withing tax branch', 850.00, '', 0, 3, 5, 5, '2018-09-28 13:03:53', '2018-09-28 21:56:59'),
(27, 'Company capital top up both MoC and GDT', 700.00, '', 0, 3, 5, 5, '2018-09-28 22:00:29', '2018-09-28 23:12:22'),
(28, 'Change Company Name both MoC and GDT', 850.00, '', 0, 3, 5, 5, '2018-09-28 22:02:12', '2018-09-28 23:13:34'),
(29, 'Change or Adding Business objective both MoC and GDT', 1000.00, '', 0, 3, 5, 5, '2018-09-28 22:04:16', '2018-09-28 23:14:23'),
(30, 'Chage President ( chief company) both MoC and GDT', 1200.00, '', 0, 3, 5, 5, '2018-09-28 22:07:31', '2018-09-28 23:15:48'),
(31, 'Delite Company both MoC and GDT', 3000.00, '', 0, 3, 5, 5, '2018-09-28 22:10:50', '2018-09-28 23:16:51'),
(32, 'Create Company branch within Tax branch or warehouse include medium patent', 700.00, '', 0, 3, 5, 5, '2018-09-28 22:13:23', '2018-09-28 23:23:08'),
(33, 'Create Company branch difference Tax branch or warehouse include medium patent', 1000.00, '', 0, 3, 5, 5, '2018-09-28 23:26:58', '2018-09-28 23:26:58'),
(34, 'Change shareholder both MoC and GDT', 1200.00, 'not include stamp tax duty', 0, 3, 5, 5, '2018-09-28 23:36:39', '2018-09-28 23:36:39'),
(35, 'Construction license T3 with our engineering', 3000.00, 'with 03 Engineering from us', 0, 5, 5, 5, '2018-09-28 23:41:27', '2018-09-28 23:41:27'),
(36, 'Change Construction license from T3 to T2', 7500.00, '', 0, 5, 5, 5, '2018-09-28 23:43:22', '2018-09-28 23:43:22'),
(37, 'License for Property agent', 2000.00, '', 0, 4, 5, 5, '2018-09-28 23:46:22', '2018-09-28 23:46:22'),
(38, 'License for Property evaluation agent', 2000.00, '', 0, 4, 5, 5, '2018-09-28 23:47:54', '2018-09-28 23:47:54'),
(39, 'License for property management agent', 2000.00, '', 0, 4, 5, 5, '2018-09-28 23:49:25', '2018-09-28 23:49:25'),
(40, 'Renew license for property agent', 1500.00, '', 0, 4, 5, 5, '2018-09-28 23:51:01', '2018-09-28 23:51:01'),
(41, 'Renew license for property evaluation agent', 1500.00, '', 0, 4, 5, 5, '2018-09-28 23:55:05', '2018-09-28 23:55:05'),
(42, 'Renew license for property management agent', 1500.00, '', 0, 4, 5, 5, '2018-09-28 23:56:14', '2018-09-28 23:56:14'),
(43, 'License for pawn (mobile asset)', 3000.00, '', 0, 4, 5, 5, '2018-09-28 23:58:30', '2018-09-28 23:58:30'),
(44, 'License for Pawn Company ( property)', 3000.00, '', 0, 4, 5, 5, '2018-09-28 23:59:27', '2018-09-28 23:59:27'),
(45, 'Register company with department or Ministry 1st', 200.00, '', 0, 6, 5, 5, '2018-09-29 00:04:54', '2018-09-29 00:04:54'),
(46, 'quota normal staff 1 expatriate via 10 locals', 105.00, '', 0, 6, 5, 5, '2018-09-29 00:06:51', '2018-09-29 00:06:51'),
(47, 'Over quota 1 person ( 3rd)', 65.00, '', 0, 6, 5, 5, '2018-09-29 00:07:35', '2018-09-29 00:07:35'),
(48, 'Expatriate work permit include medical check up', 275.00, '', 0, 6, 5, 5, '2018-09-29 00:09:21', '2018-09-29 00:09:21'),
(49, 'Penalty work permit per one year', 100.00, '', 0, 6, 5, 5, '2018-09-29 00:10:11', '2018-09-29 00:10:11'),
(50, 'Register work permit all process', 580.00, '', 0, 6, 5, 5, '2018-09-29 00:11:36', '2018-09-29 00:11:36'),
(51, 'Register new patent small tax payer', 400.00, '', 0, 2, 5, 5, '2018-09-29 00:13:15', '2018-09-29 00:13:15'),
(52, 'Register new patent medium tax payer', 950.00, 'បុត្រសម្ពន្ធ័ ឬ ការិយាល័យតំណាង', 0, 2, 5, 5, '2018-09-29 00:15:38', '2018-09-29 00:15:38'),
(53, 'Register new patent big tax payer', 1400.00, '', 0, 2, 5, 5, '2018-09-29 00:17:47', '2018-09-29 00:17:47'),
(54, 'Renew patent for small tax payer', 180.00, '', 0, 2, 5, 5, '2018-09-29 00:21:03', '2018-09-29 00:21:03'),
(55, 'Renew patent for medium tax payer', 380.00, '', 0, 2, 5, 5, '2018-09-29 00:23:04', '2018-09-29 00:23:04'),
(56, 'Renew patent for large tax payer L2', 1330.00, '', 0, 2, 5, 5, '2018-09-29 00:24:18', '2018-09-29 00:24:18'),
(57, 'Register patent large tax payer L1', 1330.00, '', 0, 2, 5, 5, '2018-09-29 00:30:40', '2018-10-30 19:30:39'),
(58, 'Monthly declaration for small tax payer in AV less 50 transaction', 50.00, NULL, 0, 2, 5, 5, '2018-09-29 00:34:50', '2018-12-17 00:43:20'),
(59, '** Monthly declaration for small tax payer in AV. 100 transaction', 100.00, '', 0, 2, 5, 5, '2018-09-29 00:37:01', '2018-10-30 22:16:56'),
(60, 'Monthly declaration for medium tax payer no transaction', 50.00, NULL, 0, 2, 5, 5, '2018-09-29 00:40:03', '2018-12-17 00:43:14'),
(61, '* Monthly declaration for medium tax payer in AV. 100 transaction', 100.00, '', 0, 2, 5, 5, '2018-09-29 00:42:30', '2018-10-30 22:17:16'),
(62, 'Monthly declaration for medium tax payer in AV. 200 transaction', 150.00, NULL, 0, 2, 5, 5, '2018-09-29 00:43:55', '2018-12-17 00:42:47'),
(63, 'Monthly declaration for medium tax payer in AV. 300 transaction', 200.00, NULL, 0, 2, 5, 5, '2018-09-29 00:44:58', '2018-12-17 00:42:53'),
(64, 'Monthly declaration for medium tax payer in AV. 400 transaction', 250.00, NULL, 0, 2, 5, 5, '2018-09-29 00:45:58', '2018-12-17 00:43:01'),
(65, 'Monthly declaration for medium tax payer in AV. 500 transaction', 300.00, NULL, 0, 2, 5, 5, '2018-09-29 00:46:49', '2018-12-17 00:43:08'),
(66, 'Monthly bookkeeping for no transaction', 50.00, '', 0, 2, 5, 5, '2018-09-29 00:50:03', '2018-09-29 00:50:03'),
(67, 'Monthly bookkeeping for with AV. 100 transaction', 100.00, '', 0, 2, 5, 5, '2018-09-29 00:51:33', '2018-09-29 00:51:33'),
(68, 'Monthly bookkeeping for with AV. 200 transaction', 150.00, '', 0, 2, 5, 5, '2018-09-29 00:52:28', '2018-09-29 00:52:28'),
(69, 'Monthly bookkeeping for with AV. 300 transaction', 200.00, '', 0, 2, 5, 5, '2018-09-29 00:53:42', '2018-09-29 00:53:42'),
(70, 'Monthly bookkeeping for with AV. 400 transaction', 250.00, '', 0, 2, 5, 5, '2018-09-29 00:54:26', '2018-09-29 00:54:26'),
(71, 'Monthly bookkeeping for with AV. 500 transaction', 300.00, '', 0, 2, 5, 5, '2018-09-29 00:55:07', '2018-09-29 00:55:07'),
(72, 'ToP for transaction in AV. less then 100', 250.00, '', 0, 2, 5, 5, '2018-09-29 00:56:48', '2018-09-29 00:56:48'),
(73, 'ToP for transaction in AV. from 100 to 200', 300.00, '', 0, 2, 5, 5, '2018-09-29 00:58:07', '2018-09-29 00:58:07'),
(74, 'ToP for transaction in AV. from 200 to 300', 350.00, '', 0, 2, 5, 5, '2018-09-29 00:59:01', '2018-09-29 00:59:01'),
(75, 'ToP for transaction in AV. less 500', 400.00, '', 0, 2, 5, 5, '2018-09-29 00:59:48', '2018-09-29 00:59:48'),
(76, 'License for transportation', 940.00, '', 0, 7, 5, 5, '2018-09-29 01:05:05', '2018-09-29 01:05:05'),
(77, 'Renew license transportation', 750.00, '', 0, 7, 5, 5, '2018-09-29 01:06:03', '2018-09-29 01:06:03'),
(78, 'Add new patent medium tax payer', 450.00, '', 0, 2, 5, 5, '2018-09-29 01:42:19', '2018-09-29 01:42:19'),
(79, 'Register Medicine company', 2000.00, '', 0, 8, 5, 5, '2018-10-30 20:07:09', '2018-10-30 20:07:09'),
(80, 'Register cosmetic company to MOH', 1500.00, 'no need pharmacist representative', 0, 8, 5, 5, '2018-10-30 20:23:27', '2018-10-30 20:23:27'),
(81, 'Register Factory with MoH', 2000.00, 'valid for 5 years', 0, 8, 5, 5, '2018-10-30 20:24:48', '2018-10-30 20:24:48'),
(82, 'Register medicine with 1 formula', 1200.00, 'valid for 5 years', 0, 8, 5, 5, '2018-10-30 20:26:00', '2018-10-30 20:26:00'),
(83, 'Register cosmetic product with moh ', 200.00, 'valid for 5 years', 0, 8, 5, 5, '2018-10-30 20:28:53', '2018-10-30 20:28:53'),
(85, 'Register license for hotel under 100 rooms', 1500.00, '', 0, 10, 5, 5, '2018-10-30 21:17:34', '2018-10-30 21:17:34'),
(86, 'Register license for ticketing', 0.00, '', 0, 10, 5, 5, '2018-10-30 21:19:43', '2018-10-30 21:19:43'),
(87, 'License tour in burn', 0.00, '', 0, 10, 5, 5, '2018-10-30 21:20:45', '2018-10-30 21:20:45'),
(88, 'License tour out burn', 0.00, '', 0, 10, 5, 5, '2018-10-30 21:22:01', '2018-10-30 21:22:01'),
(89, 'License for restaurant', 0.00, '', 0, 10, 5, 5, '2018-10-30 21:23:20', '2018-10-30 21:23:20'),
(90, 'License massage and spar', 0.00, '', 0, 10, 5, 5, '2018-10-30 21:24:29', '2018-10-30 21:24:29'),
(91, 'Prepare document for auditing', 500.00, '', 0, 2, 5, 5, '2018-10-30 21:46:30', '2018-10-30 21:46:30'),
(92, 'Representative of the owner for technical deal with auditor ', 250.00, '', 0, 2, 5, 5, '2018-10-30 21:48:02', '2018-10-30 21:48:02'),
(93, 'Others', 0.00, '', 0, 1, 5, 5, '2018-10-30 22:01:30', '2018-10-30 22:01:30'),
(94, 'Change shareholder', 750.00, 'need to confirm', 0, 3, 5, 5, '2018-10-30 22:28:12', '2018-10-30 22:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `st_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `st_email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_phone` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_salary` double(8,2) DEFAULT NULL,
  `st_gender` int(11) NOT NULL DEFAULT '1',
  `st_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `st_created_by` int(10) UNSIGNED NOT NULL,
  `st_updated_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `st_name`, `st_email`, `st_image`, `st_phone`, `st_position`, `st_salary`, `st_gender`, `st_description`, `created_at`, `updated_at`, `st_created_by`, `st_updated_by`) VALUES
(1, 'សុគន្ធសុវិសាល', 'sovisalsokun@gmail.com', NULL, '098 794 286', 'IT OFFICER', 100.00, 1, NULL, '2019-01-30 09:31:30', '2019-01-30 09:40:57', 5, 5),
(2, 'ស្រស់ សុភារ័ត្ន', 'phearoth@dnkservice.com', NULL, '0', 'Operation Assistant', 200.00, 1, '123', '2019-01-30 09:43:27', '2019-01-28 01:33:48', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `tr_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_date_alert` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_date_count` int(11) NOT NULL,
  `tr_invoice_id` int(11) DEFAULT NULL,
  `tr_description` text COLLATE utf8_unicode_ci,
  `tr_company_id` int(10) UNSIGNED NOT NULL,
  `tr_service_id` int(10) UNSIGNED NOT NULL,
  `tr_verify_by` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `tr_start_date`, `tr_date_alert`, `tr_date_count`, `tr_invoice_id`, `tr_description`, `tr_company_id`, `tr_service_id`, `tr_verify_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2019-02-05', '2019-02-28', 0, 3, '123', 2, 78, 5, 5, 5, '2019-02-05 09:28:38', '2019-02-05 09:53:35'),
(3, '2019-02-01', '2019-02-28', 35, 10, 'qwe11', 2, 78, 5, 5, 5, '2019-02-07 01:52:34', '2019-02-07 01:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_checklists`
--

CREATE TABLE `transaction_checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `tch_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tch_date_alert` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tch_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tch_description` text COLLATE utf8_unicode_ci,
  `tch_checklist_id` int(10) UNSIGNED NOT NULL,
  `tch_transaction_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_process`
--

CREATE TABLE `transaction_process` (
  `id` int(10) UNSIGNED NOT NULL,
  `tp_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tp_description` text COLLATE utf8_unicode_ci,
  `tp_process_id` int(10) UNSIGNED NOT NULL,
  `tp_transaction_id` int(10) UNSIGNED NOT NULL,
  `tp_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_process`
--

INSERT INTO `transaction_process` (`id`, `tp_start_date`, `tp_description`, `tp_process_id`, `tp_transaction_id`, `tp_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, '2019-02-01', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, 1, 1, 5, 5, '2019-02-06 04:22:46', '2019-02-07 09:26:53'),
(7, '2019-02-06', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 2, 1, 0, 5, 5, '2019-02-06 05:08:24', '2019-02-07 09:27:13'),
(8, '2019-02-06', '<p>Hello</p>', 3, 1, 0, 5, 5, '2019-02-06 09:59:11', '2019-02-07 00:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default_user.png',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role_id` int(10) UNSIGNED NOT NULL DEFAULT '14'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `phone`, `gender`, `status`, `description`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_role_id`) VALUES
(5, 'Sokun Sovisal', 'vs@gl.com', '1544517697_5.jpg', '098794286', 1, 1, 'Sovisal', NULL, '$2y$10$/SasYs5RiuoMpe0ywx3ZHOgUNgJD/BGyuK0dLusAi90cpVMmJiLJe', 'kD68on6lOjJLqdrBpMmu12YYyWnkCQjBuLdHHgb8swNljQLXMyyMq3QnsQH8', '2018-12-10 18:38:46', '2019-01-25 04:01:40', 12),
(7, 'sovisal', 'sovisal@gmail.com', 'default_user.png', '09', 1, 1, NULL, NULL, '$2y$10$Cyz13bhe9qVQ9PP5tTzji.jOxTGmScruFie5re5JuzbEUiJBkP3tu', NULL, '2019-01-25 05:21:03', '2019-01-28 05:20:13', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `ur_name` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `ur_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `ur_name`, `ur_description`, `created_at`, `updated_at`) VALUES
(12, 'Power Administrator', 'Power Administrator', '2019-01-25 04:01:29', '2019-01-25 04:01:29'),
(13, 'Administrator', 'Administrator', '2019-01-25 04:27:08', '2019-01-25 04:27:08'),
(14, 'User', 'User', '2019-01-25 04:27:15', '2019-01-25 04:27:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agreements`
--
ALTER TABLE `agreements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agreements_agr_company_id_foreign` (`agr_company_id`),
  ADD KEY `agreements_agr_created_by_foreign` (`agr_created_by`),
  ADD KEY `agreements_agr_updated_by_foreign` (`agr_updated_by`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_app_company_id_foreign` (`app_company_id`),
  ADD KEY `appointments_app_users_id_foreign` (`app_user_id`),
  ADD KEY `appointments_app_created_by_foreign` (`app_created_by`),
  ADD KEY `appointments_app_updated_by_foreign` (`app_updated_by`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_br_company_id_foreign` (`br_company_id`),
  ADD KEY `bills_br_created_by_foreign` (`br_created_by`),
  ADD KEY `bills_br_updated_by_foreign` (`br_updated_by`);

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_ch_service_id_foreign` (`ch_service_id`),
  ADD KEY `checklist_created_by_foreign` (`created_by`),
  ADD KEY `checklist_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_com_name_unique` (`com_name`),
  ADD KEY `companies_com_objective_id_foreign` (`com_objective_id`),
  ADD KEY `companies_com_created_by_foreign` (`com_created_by`),
  ADD KEY `companies_com_updated_by_foreign` (`com_updated_by`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_dist_province_id_foreign` (`dist_province_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_fc_company_id_foreign` (`f_company_id`),
  ADD KEY `files_f_fc_id_foreign` (`f_fc_id`),
  ADD KEY `files_f_created_by_foreign` (`f_created_by`),
  ADD KEY `files_f_updated_by_foreign` (`f_updated_by`);

--
-- Indexes for table `file_categories`
--
ALTER TABLE `file_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_categories_fc_created_by_foreign` (`fc_created_by`),
  ADD KEY `file_categories_fc_updated_by_foreign` (`fc_updated_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_inv_number_unique` (`inv_number`),
  ADD KEY `invoices_inv_company_id_foreign` (`inv_company_id`),
  ADD KEY `invoices_inv_created_by_foreign` (`inv_created_by`),
  ADD KEY `invoices_inv_updated_by_foreign` (`inv_updated_by`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invd_invoice_id_foreign` (`invd_invoice_id`),
  ADD KEY `invoice_details_invd_service_id_foreign` (`invd_service_id`);

--
-- Indexes for table `mainservices`
--
ALTER TABLE `mainservices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mainservices_ms_name_unique` (`ms_name`);

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
-- Indexes for table `objectives`
--
ALTER TABLE `objectives`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `objectives_obj_name_unique` (`obj_name`),
  ADD KEY `objectives_obj_created_by_foreign` (`obj_created_by`),
  ADD KEY `objectives_obj_updated_by_foreign` (`obj_updated_by`);

--
-- Indexes for table `payment_transitions`
--
ALTER TABLE `payment_transitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_transitions_pt_bill_id_foreign` (`pt_bill_id`),
  ADD KEY `payment_transitions_pt_created_by_foreign` (`pt_created_by`),
  ADD KEY `payment_transitions_pt_updated_by_foreign` (`pt_updated_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_p_module_id_foreign` (`p_module_id`),
  ADD KEY `permissions_p_role_id_foreign` (`p_role_id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `process_pr_service_id_foreign` (`pr_service_id`),
  ADD KEY `process_created_by_foreign` (`created_by`),
  ADD KEY `process_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quotations_quote_number_unique` (`quote_number`),
  ADD KEY `quotations_quote_company_id_foreign` (`quote_company_id`),
  ADD KEY `quotations_quote_created_by_foreign` (`quote_created_by`),
  ADD KEY `quotations_quote_updated_by_foreign` (`quote_updated_by`);

--
-- Indexes for table `quotation_services`
--
ALTER TABLE `quotation_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_services_qs_quote_id_foreign` (`qs_quote_id`),
  ADD KEY `quotation_services_qs_service_id_foreign` (`qs_service_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipts_rec_number_unique` (`rec_number`),
  ADD KEY `receipts_rec_inv_id_foreign` (`rec_inv_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_s_name_unique` (`s_name`),
  ADD KEY `services_s_ms_id_foreign` (`s_ms_id`),
  ADD KEY `services_s_created_by_foreign` (`s_created_by`),
  ADD KEY `services_s_updated_by_foreign` (`s_updated_by`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffs_st_created_by_foreign` (`st_created_by`),
  ADD KEY `staffs_st_updated_by_foreign` (`st_updated_by`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_tr_company_id_foreign` (`tr_company_id`),
  ADD KEY `transactions_tr_service_id_foreign` (`tr_service_id`),
  ADD KEY `transactions_tr_verify_by_foreign` (`tr_verify_by`),
  ADD KEY `transactions_created_by_foreign` (`created_by`),
  ADD KEY `transactions_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `transaction_checklists`
--
ALTER TABLE `transaction_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_checklist_tch_checklist_id_foreign` (`tch_checklist_id`),
  ADD KEY `transaction_checklist_tch_transaction_id_foreign` (`tch_transaction_id`),
  ADD KEY `transaction_checklist_created_by_foreign` (`created_by`),
  ADD KEY `transaction_checklist_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `transaction_process`
--
ALTER TABLE `transaction_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_process_tp_process_id_foreign` (`tp_process_id`),
  ADD KEY `transaction_process_tp_transaction_id_foreign` (`tp_transaction_id`),
  ADD KEY `transaction_process_created_by_foreign` (`created_by`),
  ADD KEY `transaction_process_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_role_id_foreign` (`user_role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agreements`
--
ALTER TABLE `agreements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file_categories`
--
ALTER TABLE `file_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mainservices`
--
ALTER TABLE `mainservices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `objectives`
--
ALTER TABLE `objectives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_transitions`
--
ALTER TABLE `payment_transitions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotation_services`
--
ALTER TABLE `quotation_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_checklists`
--
ALTER TABLE `transaction_checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_process`
--
ALTER TABLE `transaction_process`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreements`
--
ALTER TABLE `agreements`
  ADD CONSTRAINT `agreements_agr_company_id_foreign` FOREIGN KEY (`agr_company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `agreements_agr_created_by_foreign` FOREIGN KEY (`agr_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `agreements_agr_updated_by_foreign` FOREIGN KEY (`agr_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_app_company_id_foreign` FOREIGN KEY (`app_company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointments_app_created_by_foreign` FOREIGN KEY (`app_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointments_app_updated_by_foreign` FOREIGN KEY (`app_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointments_app_users_id_foreign` FOREIGN KEY (`app_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_br_company_id_foreign` FOREIGN KEY (`br_company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bills_br_created_by_foreign` FOREIGN KEY (`br_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bills_br_updated_by_foreign` FOREIGN KEY (`br_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `checklists`
--
ALTER TABLE `checklists`
  ADD CONSTRAINT `checklist_ch_service_id_foreign` FOREIGN KEY (`ch_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `checklist_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `checklist_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_com_created_by_foreign` FOREIGN KEY (`com_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `companies_com_objective_id_foreign` FOREIGN KEY (`com_objective_id`) REFERENCES `objectives` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `companies_com_updated_by_foreign` FOREIGN KEY (`com_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_dist_province_id_foreign` FOREIGN KEY (`dist_province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_f_created_by_foreign` FOREIGN KEY (`f_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `files_f_fc_id_foreign` FOREIGN KEY (`f_fc_id`) REFERENCES `file_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `files_f_updated_by_foreign` FOREIGN KEY (`f_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `files_fc_company_id_foreign` FOREIGN KEY (`f_company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `file_categories`
--
ALTER TABLE `file_categories`
  ADD CONSTRAINT `file_categories_fc_created_by_foreign` FOREIGN KEY (`fc_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `file_categories_fc_updated_by_foreign` FOREIGN KEY (`fc_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_inv_company_id_foreign` FOREIGN KEY (`inv_company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoices_inv_created_by_foreign` FOREIGN KEY (`inv_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoices_inv_updated_by_foreign` FOREIGN KEY (`inv_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_invd_invoice_id_foreign` FOREIGN KEY (`invd_invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoice_details_invd_service_id_foreign` FOREIGN KEY (`invd_service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `objectives`
--
ALTER TABLE `objectives`
  ADD CONSTRAINT `objectives_obj_created_by_foreign` FOREIGN KEY (`obj_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `objectives_obj_updated_by_foreign` FOREIGN KEY (`obj_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_transitions`
--
ALTER TABLE `payment_transitions`
  ADD CONSTRAINT `payment_transitions_pt_bill_id_foreign` FOREIGN KEY (`pt_bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `payment_transitions_pt_created_by_foreign` FOREIGN KEY (`pt_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payment_transitions_pt_updated_by_foreign` FOREIGN KEY (`pt_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_p_module_id_foreign` FOREIGN KEY (`p_module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `permissions_p_role_id_foreign` FOREIGN KEY (`p_role_id`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `process`
--
ALTER TABLE `process`
  ADD CONSTRAINT `process_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `process_pr_service_id_foreign` FOREIGN KEY (`pr_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `process_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_quote_company_id_foreign` FOREIGN KEY (`quote_company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quotations_quote_created_by_foreign` FOREIGN KEY (`quote_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `quotations_quote_updated_by_foreign` FOREIGN KEY (`quote_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quotation_services`
--
ALTER TABLE `quotation_services`
  ADD CONSTRAINT `quotation_services_qs_quote_id_foreign` FOREIGN KEY (`qs_quote_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quotation_services_qs_service_id_foreign` FOREIGN KEY (`qs_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_rec_inv_id_foreign` FOREIGN KEY (`rec_inv_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_s_created_by_foreign` FOREIGN KEY (`s_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `services_s_ms_id_foreign` FOREIGN KEY (`s_ms_id`) REFERENCES `mainservices` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `services_s_updated_by_foreign` FOREIGN KEY (`s_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `staffs_st_created_by_foreign` FOREIGN KEY (`st_created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `staffs_st_updated_by_foreign` FOREIGN KEY (`st_updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transactions_tr_company_id_foreign` FOREIGN KEY (`tr_company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transactions_tr_service_id_foreign` FOREIGN KEY (`tr_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transactions_tr_verify_by_foreign` FOREIGN KEY (`tr_verify_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transactions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_checklists`
--
ALTER TABLE `transaction_checklists`
  ADD CONSTRAINT `transaction_checklist_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_checklist_tch_checklist_id_foreign` FOREIGN KEY (`tch_checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_checklist_tch_transaction_id_foreign` FOREIGN KEY (`tch_transaction_id`) REFERENCES `process` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_checklist_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_process`
--
ALTER TABLE `transaction_process`
  ADD CONSTRAINT `transaction_process_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_process_tp_process_id_foreign` FOREIGN KEY (`tp_process_id`) REFERENCES `process` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_process_tp_transaction_id_foreign` FOREIGN KEY (`tp_transaction_id`) REFERENCES `process` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_process_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_role_id_foreign` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
