-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2022 at 05:08 PM
-- Server version: 5.7.39-0ubuntu0.18.04.2
-- PHP Version: 7.2.24-0ubuntu0.18.04.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adventures_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `image`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'profile_image/1662136507.png', 'We are adventure tourism company based in Oman', '2022-09-02 16:35:07', '2022-09-02 16:35:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activity`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Drinks', 1, '2021-07-01 23:45:13', '2021-07-01 23:45:13', NULL),
(3, 'Snacks', 1, '2021-07-01 23:45:13', '2021-07-01 23:45:13', NULL),
(4, 'Sand bashing', 1, '2021-07-01 23:45:13', '2021-07-01 23:45:13', NULL),
(5, 'Climbing', 1, '2021-07-01 23:45:13', '2021-07-01 23:45:13', NULL),
(6, 'Swimming', 1, '2021-07-01 23:45:13', '2021-07-01 23:45:13', NULL),
(7, 'Learning', 1, '2021-10-19 13:31:33', '2021-10-19 13:31:33', NULL),
(8, 'Cooking', 1, '2021-10-19 13:32:01', '2021-10-19 13:32:01', NULL),
(9, 'Camping', 1, '2021-10-19 13:32:15', '2021-10-19 13:32:15', NULL),
(10, 'Abseiling', 1, '2021-10-19 13:33:08', '2021-10-19 13:33:08', NULL),
(11, 'Hiking', 1, '2021-10-19 13:33:32', '2021-10-19 13:33:32', NULL),
(12, 'Timekeeping', 1, '2021-10-19 13:34:32', '2021-10-19 13:34:32', NULL),
(13, 'Gears', 1, '2021-10-19 13:34:45', '2021-10-19 13:34:45', NULL),
(14, 'Airport Pick and Drop', 1, '2022-09-16 16:15:39', '2022-09-16 16:15:39', NULL),
(16, 'Rowing', 1, '2022-09-16 16:30:37', '2022-09-16 16:30:37', NULL),
(17, 'Paintball', 1, '2022-09-16 16:30:58', '2022-09-16 16:30:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aimed`
--

CREATE TABLE `aimed` (
  `id` int(11) NOT NULL,
  `AimedName` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aimed`
--

INSERT INTO `aimed` (`id`, `AimedName`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 'Youngsters', '2022-06-05 17:22:02', '2022-06-05 17:22:02', NULL),
(12, 'Adults', '2022-06-05 17:22:27', '2022-06-05 17:22:27', NULL),
(13, 'Ladies', '2022-06-05 17:22:45', '2022-06-05 17:22:45', NULL),
(14, 'Gents', '2022-06-05 17:23:11', '2022-06-05 17:23:11', NULL),
(15, 'Mixed Gender', '2022-06-05 17:23:58', '2022-06-05 17:23:58', NULL),
(16, 'Everyone', '2022-06-05 17:24:42', '2022-06-05 17:24:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reach_for` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `become_partner`
--

CREATE TABLE `become_partner` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_bin,
  `location` text CHARACTER SET utf8 COLLATE utf8_bin,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `license` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cr_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cr_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cr_copy` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `debit_card` int(11) DEFAULT '0',
  `visa_card` int(11) DEFAULT '0',
  `payon_arrival` enum('1','0') CHARACTER SET latin1 DEFAULT '0' COMMENT '''1'' Active , ''0'' Inactive',
  `paypal` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `bankname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `account_holdername` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `is_online` blob,
  `is_approved` enum('1','0') NOT NULL DEFAULT '0' COMMENT '''1'' Approve, ''0'' Unapprove',
  `packages_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `is_wiretransfer` enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `is_free_used` enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `become_partner`
--

INSERT INTO `become_partner` (`id`, `user_id`, `company_name`, `address`, `location`, `description`, `license`, `cr_name`, `cr_number`, `cr_copy`, `debit_card`, `visa_card`, `payon_arrival`, `paypal`, `bankname`, `account_holdername`, `account_number`, `is_online`, `is_approved`, `packages_id`, `start_date`, `end_date`, `is_wiretransfer`, `is_free_used`, `created_at`, `updated_at`) VALUES
(1, 17, 'Universal-Skills', 'Alowaidat, MohdAlsahi building 1st floor #1', 'Khalil Oman', 'AdventuresClub affiliates to Universal-skills, we provide best adventure tourism and aggregate various services.', 'Yes', 'AdventuresClub', '52738383bdhjs', 'file63241c643c8e0-66b2f2f8-9be5-4a07-afcd-f0a2cdfa44b2IMG-20220914-WA0046.jpg', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 1, '2022-09-14 23:06:33', '2022-09-20 23:06:33', '', '1', '2022-09-14 23:06:08', '2022-09-14 17:36:08'),
(2, 20, 'b', 'h', 'Unnamed Road Bareilly Akhriarpur Nawadia 262406 In', 'jsusu', 'No', NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0x31, '1', 0, NULL, NULL, '0', '0', '2022-09-18 03:04:03', '2022-09-17 21:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `adult` tinyint(4) NOT NULL,
  `kids` tinyint(4) NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `unit_amount` decimal(8,2) UNSIGNED NOT NULL,
  `total_amount` decimal(8,2) UNSIGNED NOT NULL,
  `discounted_amount` decimal(8,2) UNSIGNED NOT NULL,
  `future_plan` tinyint(4) NOT NULL,
  `booking_date` date NOT NULL,
  `currency` int(11) NOT NULL,
  `coupon_applied` tinyint(4) NOT NULL,
  `status` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Requested,1=Accepted,2=PaymentDone,3=decline(Provider cancle),4= Completed, 5 dropped(User cancle) ,6 =Conform',
  `updated_by` int(11) NOT NULL,
  `cancelled_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `payment_channel` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `service_id`, `provider_id`, `adult`, `kids`, `message`, `unit_amount`, `total_amount`, `discounted_amount`, `future_plan`, `booking_date`, `currency`, `coupon_applied`, `status`, `updated_by`, `cancelled_reason`, `payment_status`, `payment_channel`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 17, 2, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '30.00', '0.00', 1, '2022-09-15', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-14 23:22:51', NULL),
(7, 20, 3, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '50.00', '50.00', '0.00', 1, '2022-10-28', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-14 23:39:44', NULL),
(9, 20, 1, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '30.00', '0.00', 1, '2022-09-12', 2, 0, '2', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-14 23:40:43', NULL),
(11, 20, 3, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '50.00', '50.00', '0.00', 1, '2022-09-30', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-14 23:57:48', NULL),
(13, 20, 2, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '30.00', '0.00', 1, '2022-10-22', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-14 23:59:55', NULL),
(15, 20, 2, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '30.00', '0.00', 1, '2022-09-25', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-15 00:12:00', NULL),
(16, 20, 3, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '50.00', '50.00', '0.00', 1, '2022-10-28', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-15 00:31:41', NULL),
(17, 17, 1, 17, 3, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '90.00', '0.00', 1, '2022-09-17', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-16 00:40:56', NULL),
(18, 17, 1, 17, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '30.00', '0.00', 1, '2022-09-17', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-16 11:42:59', NULL),
(19, 17, 2, 17, 2, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '30.00', '40.00', '20.00', 1, '2022-09-17', 2, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-16 11:44:32', NULL),
(20, 17, 5, 17, 1, 0, 'currency issue', '4000.00', '4000.00', '0.00', 1, '2022-09-18', 1, 0, '2', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-17 00:31:07', NULL),
(21, 17, 5, 17, 1, 0, 'keep it as requested only (Dont accept)', '4000.00', '4000.00', '0.00', 1, '2022-09-18', 1, 0, '1', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-17 12:51:24', NULL),
(22, 17, 3, 17, 1, 0, 'pay', '50.00', '50.00', '0.00', 1, '2022-09-19', 2, 0, '2', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-18 15:50:17', NULL),
(23, 17, 3, 17, 1, 0, 'pay', '50.00', '50.00', '0.00', 1, '2022-09-20', 2, 0, '2', 17, NULL, NULL, 'PayOnArrival', NULL, '2022-09-19 00:29:53', NULL),
(27, 17, 1, 17, 1, 0, 'gg', '30.00', '30.00', '0.00', 1, '2022-09-23', 2, 0, '0', 0, NULL, NULL, NULL, NULL, '2022-09-20 08:46:43', NULL),
(28, 17, 2, 17, 1, 0, 'bbj', '30.00', '30.00', '0.00', 1, '2022-09-25', 2, 0, '0', 0, NULL, NULL, NULL, NULL, '2022-09-20 09:12:37', NULL),
(29, 17, 2, 17, 1, 0, 'v', '30.00', '30.00', '0.00', 1, '2022-09-22', 2, 0, '0', 0, NULL, NULL, NULL, NULL, '2022-09-20 09:17:45', NULL),
(30, 17, 11, 17, 1, 0, 'bb', '30.00', '30.00', '0.00', 1, '2022-09-25', 1, 0, '1', 17, NULL, NULL, NULL, NULL, '2022-09-21 02:53:02', NULL),
(31, 17, 2, 17, 1, 0, 'test', '30.00', '30.00', '0.00', 1, '2022-09-22', 2, 0, '0', 0, NULL, NULL, NULL, NULL, '2022-09-21 15:57:20', NULL),
(32, 17, 11, 17, 1, 0, 'India from Oman', '30.00', '30.00', '0.00', 1, '2022-09-22', 1, 0, '1', 17, NULL, NULL, NULL, NULL, '2022-09-21 15:58:03', NULL),
(33, 17, 2, 17, 5, 1, 'heyeye', '30.00', '180.00', '0.00', 1, '2022-09-22', 2, 0, '1', 17, NULL, NULL, NULL, NULL, '2022-09-21 16:02:32', NULL),
(34, 17, 5, 17, 1, 1, 'hnyny', '4000.00', '8000.00', '0.00', 1, '2022-09-30', 1, 0, '1', 17, NULL, NULL, NULL, NULL, '2022-09-21 22:14:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `region_id`, `city`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Delhi', '2022-04-26 14:18:59', '2022-04-26 14:18:59', NULL),
(2, 1, 23, 'Alhamra', '2022-04-26 20:58:59', '2022-04-26 20:58:59', NULL),
(3, 2, 23, 'Nizwa', '2022-04-26 20:59:13', '2022-04-26 20:59:13', NULL),
(4, 2, 23, 'Jabal Akhdar', '2022-04-26 20:59:32', '2022-04-26 20:59:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contactuspurposes`
--

CREATE TABLE `contactuspurposes` (
  `Id` int(11) NOT NULL,
  `contactuspurposeName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactuspurposes`
--

INSERT INTO `contactuspurposes` (`Id`, `contactuspurposeName`, `created_at`, `updated_at`) VALUES
(6, 'Add Activity type', '2022-05-16 22:59:55', '2022-05-16 22:59:55'),
(7, 'Add a country', '2022-05-16 23:00:09', '2022-05-16 23:00:09'),
(8, 'Partnership program', '2022-05-16 23:00:47', '2022-05-16 23:00:47'),
(9, 'Corporate deals', '2022-05-16 23:01:01', '2022-05-16 23:01:01'),
(10, 'Report a bug', '2022-05-16 23:01:29', '2022-05-16 23:01:29'),
(11, 'Claimes', '2022-05-16 23:01:55', '2022-05-16 23:01:55'),
(13, 'Appreciation', '2022-09-02 22:16:58', '2022-09-02 22:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobile_code` varchar(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobile_number` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `purpose` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_purpose`
--

CREATE TABLE `contact_us_purpose` (
  `id` int(10) UNSIGNED NOT NULL,
  `purpose` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us_purpose`
--

INSERT INTO `contact_us_purpose` (`id`, `purpose`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Enquiry', 1, '2021-07-14 10:14:22', '2021-07-14 10:14:22', NULL),
(2, 'Testing', 1, '2021-07-14 10:14:22', '2021-07-14 10:14:22', NULL),
(3, 'Question', 1, '2021-07-14 10:14:22', '2021-07-14 10:14:22', NULL),
(4, 'Money deduction', 1, '2021-07-14 10:14:22', '2021-07-14 10:14:22', NULL),
(5, 'Timing', 1, '2021-07-14 10:14:22', '2021-07-14 10:14:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `short_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `code` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `currency` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin,
  `flag` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `short_name`, `code`, `currency`, `description`, `flag`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'India', 'Indian', '+91', 'INR', 'INDIA', 'uploads/flag/20220504190958-WhatsApp Image 2022-05-04 at 5.39.19 PM.jpeg', '1', 1, '2020-07-18 07:44:16', '2020-07-18 07:44:16', NULL),
(2, 'Oman', 'Omani', '+968', 'OMR', 'Oman', 'uploads/flag/20220504185416-WhatsApp Image 2022-05-04 at 5.22.35 PM.jpeg', '1', 1, '2021-07-19 05:09:31', '2021-07-19 05:09:31', NULL),
(18, 'Pakistan', 'Pakistani', '+92', 'PKR', NULL, 'uploads/flag/20220504190642-WhatsApp Image 2022-05-04 at 5.32.19 PM.jpeg', '1', 1, '2022-04-26 02:40:33', '2022-04-26 02:40:33', NULL),
(19, 'Iran', 'Iranian', '+98', 'IRR', NULL, 'uploads/flag/20220504190431-WhatsApp Image 2022-05-04 at 5.31.50 PM.jpeg', '1', 1, '2022-04-26 09:56:13', '2022-04-26 09:56:13', NULL),
(20, 'UAE', 'EMRT', '+971', 'AED', NULL, 'uploads/flag/20220525160527-UAE.png', '1', 1, '2022-05-25 05:05:27', '2022-05-25 05:05:27', NULL),
(21, 'JAPAN', 'JAPANISES', '+81', 'JAP', NULL, 'uploads/flag/20220527221816-japan.png', '1', 1, '2022-05-27 11:18:16', '2022-05-27 11:18:16', NULL),
(22, 'KSA', 'SAUDI', '+966', 'SAR', NULL, 'uploads/flag/20220618010047-saudi.png', '1', 1, '2022-06-17 14:00:47', '2022-06-17 14:00:47', NULL),
(23, 'PHILIPPINES', 'Filipina', '+63', 'PHP', NULL, 'uploads/flag/20220902221234-PHP.png', '1', 1, '2022-06-19 16:27:04', '2022-06-19 16:27:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dependency`
--

CREATE TABLE `dependency` (
  `id` int(11) NOT NULL,
  `dependency_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dependency`
--

INSERT INTO `dependency` (`id`, `dependency_name`, `updated_at`, `created_at`, `deleted_at`) VALUES
(5, 'Weather Condistions', '2022-08-11 18:37:18', '2022-04-12 12:39:17', NULL),
(6, 'Health Conditions', '2022-08-11 18:37:18', '2022-04-12 12:39:57', NULL),
(7, 'Adventure Licence', '2022-08-11 18:37:18', '2022-04-12 12:41:14', NULL),
(8, 'Lockdowns', '2022-08-11 18:37:18', '2022-04-12 12:41:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `durations`
--

CREATE TABLE `durations` (
  `id` int(10) UNSIGNED NOT NULL,
  `duration` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `minutes` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `durations`
--

INSERT INTO `durations` (`id`, `duration`, `minutes`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, '15 Minutes', 0, 1, '2021-10-19 13:23:23', '2021-10-19 13:23:23', NULL),
(14, '30 Minutes', 0, 1, '2021-10-19 13:23:34', '2021-10-19 13:23:34', NULL),
(15, '45 Minutes', 0, 1, '2021-10-19 13:23:53', '2021-10-19 13:23:53', NULL),
(16, '1 Hour', 0, 1, '2021-10-19 13:24:10', '2021-10-19 13:24:10', NULL),
(17, '2 Hours', 0, 1, '2021-10-19 13:24:36', '2021-10-19 13:24:36', NULL),
(18, '3 Hours', 0, 1, '2021-10-19 13:24:53', '2021-10-19 13:24:53', NULL),
(19, '4 Hours', 0, 1, '2021-10-19 13:25:02', '2021-10-19 13:25:02', NULL),
(20, '5 Hours', 0, 1, '2021-10-19 13:25:10', '2021-10-19 13:25:10', NULL),
(21, '6 Hours', 0, 1, '2021-10-19 13:25:26', '2021-10-19 13:25:26', NULL),
(23, '7 Hours', 0, 1, '2022-04-12 23:23:46', '2022-04-12 23:23:46', NULL),
(24, '8 Hours', 0, 1, '2022-04-12 23:24:03', '2022-04-12 23:24:03', NULL),
(25, '9 Hours', 0, 1, '2022-04-12 23:24:18', '2022-04-12 23:24:18', NULL),
(26, '10 Hours', 0, 1, '2022-04-12 23:24:30', '2022-04-12 23:24:30', NULL),
(27, '11 Hours', 0, 1, '2022-04-12 23:24:43', '2022-04-12 23:24:43', NULL),
(28, '12 Hours', 0, 1, '2022-04-12 23:25:19', '2022-04-12 23:25:19', NULL),
(29, '13 Hours', 0, 1, '2022-04-12 23:25:32', '2022-04-12 23:25:32', NULL),
(30, '14 Hours', 0, 1, '2022-04-12 23:25:46', '2022-04-12 23:25:46', NULL),
(31, '15 Hours', 0, 1, '2022-04-12 23:26:11', '2022-04-12 23:26:11', NULL),
(32, '16 Hours', 0, 1, '2022-04-12 23:26:22', '2022-04-12 23:26:22', NULL),
(33, '17 Hours', 0, 1, '2022-04-12 23:26:34', '2022-04-12 23:26:34', NULL),
(34, '18 Hours', 0, 1, '2022-04-12 23:26:45', '2022-04-12 23:26:45', NULL),
(35, '19 Hours', 0, 1, '2022-04-12 23:26:56', '2022-04-12 23:26:56', NULL),
(36, '20 Hours', 0, 1, '2022-04-12 23:27:10', '2022-04-12 23:27:10', NULL),
(37, '21 Hours', 0, 1, '2022-04-12 23:27:21', '2022-04-12 23:27:21', NULL),
(38, '22 Hours', 0, 1, '2022-04-12 23:27:39', '2022-04-12 23:27:39', NULL),
(39, '23 Hours', 0, 1, '2022-04-12 23:28:01', '2022-04-12 23:28:01', NULL),
(41, '1 Day', 0, 1, '2022-04-12 23:28:30', '2022-04-12 23:28:30', NULL),
(42, '2 Days', 0, 1, '2022-04-12 23:28:41', '2022-04-12 23:28:41', NULL),
(43, '3 days', 0, 1, '2022-04-12 23:28:55', '2022-04-12 23:28:55', NULL),
(44, '4 Days', 0, 1, '2022-04-12 23:29:15', '2022-04-12 23:29:15', NULL),
(45, '5 Days', 0, 1, '2022-04-12 23:29:37', '2022-04-12 23:29:37', NULL),
(46, '6 Days', 0, 1, '2022-04-12 23:29:50', '2022-04-12 23:29:50', NULL),
(48, '7 Days', 0, 1, '2022-04-12 23:31:35', '2022-04-12 23:31:35', NULL),
(49, '8 Days', 0, 1, '2022-04-12 23:31:46', '2022-04-12 23:31:46', NULL),
(50, '9 days', 0, 1, '2022-04-12 23:31:56', '2022-04-12 23:31:56', NULL),
(51, '10 Days', 0, 1, '2022-04-12 23:32:05', '2022-04-12 23:32:05', NULL),
(52, '11 days', 0, 1, '2022-04-12 23:32:16', '2022-04-12 23:32:16', NULL),
(53, '12 days', 0, 1, '2022-04-12 23:32:27', '2022-04-12 23:32:27', NULL),
(54, '13 Days', 0, 1, '2022-04-12 23:32:37', '2022-04-12 23:32:37', NULL),
(55, '14 days', 0, 1, '2022-04-12 23:32:53', '2022-04-12 23:32:53', NULL),
(56, '15 Days', 0, 1, '2022-04-12 23:33:39', '2022-04-12 23:33:39', NULL),
(57, '16 days', 0, 1, '2022-04-12 23:33:51', '2022-04-12 23:33:51', NULL),
(58, '17 days', 0, 1, '2022-04-12 23:34:02', '2022-04-12 23:34:02', NULL),
(59, '18 Days', 0, 1, '2022-04-12 23:34:18', '2022-04-12 23:34:18', NULL),
(60, '19 Days', 0, 1, '2022-04-12 23:34:32', '2022-04-12 23:34:32', NULL),
(61, '20 days', 0, 1, '2022-04-12 23:34:46', '2022-04-12 23:34:46', NULL),
(62, '21 Days', 0, 1, '2022-04-12 23:34:56', '2022-04-12 23:34:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 17, 2, '2022-09-18 18:26:30', '2022-09-18 12:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `get_all_paymentmode`
--

CREATE TABLE `get_all_paymentmode` (
  `id` int(11) NOT NULL,
  `payment_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `payment_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `get_all_paymentmode`
--

INSERT INTO `get_all_paymentmode` (`id`, `payment_name`, `payment_image`, `created_at`, `updated_at`) VALUES
(1, 'Visa card', 'oman_debitCards.png', '2022-03-31 15:39:02', '2022-08-11 18:37:18'),
(2, 'Pay on arrival', 'oman_debitCards.png', '2022-03-31 15:39:02', '2022-08-11 18:37:18'),
(4, 'PayPal', 'oman_debitCards.png', '2022-03-31 15:39:02', '2022-08-11 18:37:18'),
(5, 'Wire Transfer', 'oman_debitCards.png', '2022-04-24 21:57:03', '2022-08-11 18:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `health_conditions`
--

CREATE TABLE `health_conditions` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_conditions`
--

INSERT INTO `health_conditions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Good condition', '2021-09-01 22:47:38', '2021-09-01 22:47:38'),
(4, 'Bone weakness', '2021-09-05 07:05:45', '2021-09-05 07:05:45'),
(6, 'Breath weakness', '2021-09-22 21:46:23', '2021-09-22 21:46:23'),
(7, 'Muscles issues', '2021-09-22 21:46:44', '2021-09-22 21:46:44'),
(8, 'Backbone issues', '2021-09-22 21:47:04', '2021-09-22 21:47:04'),
(9, 'Joints issues', '2021-09-22 21:47:24', '2021-09-22 21:47:24'),
(10, 'Ligament issues', '2021-09-22 21:49:44', '2021-09-22 21:49:44'),
(11, 'Not good conditions', '2021-09-22 21:49:44', '2021-09-22 21:49:44'),
(12, 'High blood pressure', '2021-09-22 21:50:20', '2021-09-22 21:50:20'),
(13, 'Low blood pressure', '2021-09-22 21:50:20', '2021-09-22 21:50:20'),
(14, 'High diabetes', '2021-09-22 21:50:42', '2021-09-22 21:50:42'),
(16, 'Low diabetes', '2022-04-12 23:46:55', '2022-04-12 23:46:55'),
(17, 'Asthma', '2022-04-12 23:47:21', '2022-04-12 23:47:21'),
(18, 'Dizziness', '2022-04-12 23:48:12', '2022-04-12 23:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `heights`
--

CREATE TABLE `heights` (
  `Id` int(11) NOT NULL,
  `heightName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `heights`
--

INSERT INTO `heights` (`Id`, `heightName`, `deleted_at`, `created_at`, `updated_at`) VALUES
(29, '100 - 105 CM', NULL, '2022-05-04 17:23:24', '2022-05-04 17:23:24'),
(31, '105 - 110 CM', NULL, '2022-05-04 17:24:21', '2022-05-04 17:24:21'),
(32, '110 - 115 CM', NULL, '2022-05-04 17:24:42', '2022-05-04 17:24:42'),
(33, '115 - 120 CM', NULL, '2022-05-04 17:24:59', '2022-05-04 17:24:59'),
(34, '120 - 125 CM', NULL, '2022-05-04 17:25:19', '2022-05-04 17:25:19'),
(35, '125 - 130 CM', NULL, '2022-05-04 17:25:35', '2022-05-04 17:25:35'),
(36, '130 - 135 CM', NULL, '2022-05-04 17:25:51', '2022-05-04 17:25:51'),
(37, '135 - 140 CM', NULL, '2022-05-04 17:26:11', '2022-05-04 17:26:11'),
(38, '140 - 145 CM', NULL, '2022-05-04 17:26:28', '2022-05-04 17:26:28'),
(39, '145 - 150 CM', NULL, '2022-05-04 17:26:43', '2022-05-04 17:26:43'),
(40, '150 - 155 CM', NULL, '2022-05-04 17:27:17', '2022-05-04 17:27:17'),
(41, '155 - 160 CM', NULL, '2022-05-04 17:27:36', '2022-05-04 17:27:36'),
(42, '160 - 165 CM', NULL, '2022-05-04 17:27:51', '2022-05-04 17:27:51'),
(43, '165 - 170 CM', NULL, '2022-05-04 17:28:12', '2022-05-04 17:28:12'),
(44, '170 - 175 CM', NULL, '2022-05-04 17:29:12', '2022-05-04 17:29:12'),
(45, '175 - 180 CM', NULL, '2022-05-04 17:29:30', '2022-05-04 17:29:30'),
(46, '180 - 185 CM', NULL, '2022-05-04 17:30:06', '2022-05-04 17:30:06'),
(47, '185 - 190 CM', NULL, '2022-05-04 17:30:24', '2022-05-04 17:30:24'),
(48, '190 - 195 CM', NULL, '2022-05-04 17:30:51', '2022-05-04 17:30:51'),
(50, '195 - 200 CM', NULL, '2022-05-04 18:11:11', '2022-05-04 18:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `description`, `status`, `updated_at`, `created_at`) VALUES
(1, 'hn', 'Hindi', 'Hindi', '1', '2020-07-18 07:44:16', '2020-07-18 07:44:16'),
(2, 'en', 'English', 'English', '1', '2020-07-18 07:44:16', '2020-07-18 07:44:16'),
(3, 'fr', 'French', 'French', '1', '2020-07-18 07:44:16', '2020-07-18 07:44:16'),
(4, 'zh-hans', 'Chinese', 'Chinese', '1', '2020-07-18 07:44:16', '2020-07-18 07:44:16'),
(5, 'ar', 'Arabic', 'Arabic', '1', '2020-07-18 07:44:16', '2020-07-18 07:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `location_reviews`
--

CREATE TABLE `location_reviews` (
  `id` int(11) NOT NULL,
  `location_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rating` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rating_description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `message` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_approved` enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `is_read` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `notification_type` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '0 Account 1 Service , 2  Request',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `raed_at` date DEFAULT NULL,
  `send_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `user_id`, `title`, `message`, `is_approved`, `is_read`, `notification_type`, `created_at`, `raed_at`, `send_at`, `updated_at`) VALUES
(1, 1, 17, 'Register', 'You registered successfully', '0', '1', '0', '2022-09-14 17:35:14', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(2, 1, 17, 'Your request has been approved', 'Now you may proceed to buy subscription package & will be able to provide your service.', '1', '1', '0', '2022-09-14 17:36:20', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(3, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-14 17:39:28', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(4, 1, 17, 'Activities', 'Your Service: paragliding course has been approved.', '0', '1', '1', '2022-09-14 17:46:04', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(5, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 17:46:27', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(6, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-14 17:46:27', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(7, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-14 17:49:05', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(8, 1, 17, 'Activities', 'Your Service: Archery has been approved.', '0', '1', '1', '2022-09-14 17:49:27', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(9, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-14 17:51:41', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(10, 1, 17, 'Activities', 'Your Service: cycling has been approved.', '0', '1', '1', '2022-09-14 17:52:01', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(11, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 17:52:51', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(12, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-14 17:52:51', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(13, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 17:53:22', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(14, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-14 17:53:22', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(15, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 17:53:56', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(16, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-14 17:53:56', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(17, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 17:54:33', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(18, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-14 17:54:33', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(19, 1, 20, 'Register', 'You registered successfully', '0', '0', '0', '2022-09-14 18:07:28', NULL, NULL, '2022-09-14 18:07:28'),
(20, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:08:58', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(21, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:08:58', NULL, NULL, '2022-09-14 18:08:58'),
(22, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:09:44', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(23, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:09:44', NULL, NULL, '2022-09-14 18:09:44'),
(24, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:10:07', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(25, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:10:07', NULL, NULL, '2022-09-14 18:10:07'),
(26, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:10:43', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(27, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:10:43', NULL, NULL, '2022-09-14 18:10:43'),
(28, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:16:50', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(29, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:16:50', NULL, NULL, '2022-09-14 18:16:50'),
(30, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:27:48', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(31, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:27:48', NULL, NULL, '2022-09-14 18:27:48'),
(32, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:28:14', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(33, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:28:14', NULL, NULL, '2022-09-14 18:28:14'),
(34, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:29:55', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(35, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:29:55', NULL, NULL, '2022-09-14 18:29:55'),
(36, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:30:19', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(37, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:30:19', NULL, NULL, '2022-09-14 18:30:19'),
(38, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-14 18:41:31', NULL, NULL, '2022-09-14 18:41:31'),
(39, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 18:42:00', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(40, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 18:42:00', NULL, NULL, '2022-09-14 18:42:00'),
(41, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-14 19:01:05', NULL, NULL, '2022-09-14 19:01:05'),
(42, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-14 19:01:41', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(43, 1, 20, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-14 19:01:41', NULL, NULL, '2022-09-14 19:01:41'),
(44, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-14 19:25:27', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(45, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-15 03:26:00', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(46, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-15 03:28:18', NULL, NULL, '2022-09-15 03:28:18'),
(47, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-15 08:50:05', NULL, NULL, '2022-09-15 08:50:05'),
(48, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-15 17:28:07', NULL, NULL, '2022-09-15 17:28:07'),
(49, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-15 17:48:45', NULL, NULL, '2022-09-15 17:48:45'),
(50, 1, 20, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-15 17:53:43', NULL, NULL, '2022-09-15 17:53:43'),
(51, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-15 18:34:07', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(52, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-15 18:59:27', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(53, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-15 19:10:56', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(54, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-15 19:10:56', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(55, 1, 17, 'Booking accepted', ' Pankaj request #16 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:11:10', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(56, 1, 20, 'Booking accepted', 'Your booking #16 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-15 19:11:10', NULL, NULL, '2022-09-15 19:11:10'),
(57, 1, 17, 'Booking accepted', ' AdventuresClub request #2 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:11:24', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(58, 1, 17, 'Booking accepted', 'Your booking #2 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-15 19:11:24', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(59, 1, 17, 'Booking declined', 'Booking request#3 for AdventuresClub has been declined by you.', '0', '1', '2', '2022-09-15 19:11:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(60, 1, 17, 'Booking decline', 'Your request #3 has been declined by provider, please clarify on chat.', '0', '1', '2', '2022-09-15 19:11:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(61, 1, 17, 'Booking accepted', ' AdventuresClub request #5 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:11:40', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(62, 1, 17, 'Booking accepted', 'Your booking #5 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-15 19:11:40', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(63, 1, 17, 'Booking declined', 'Booking request#6 for Pankaj has been declined by you.', '0', '1', '2', '2022-09-15 19:11:46', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(64, 1, 20, 'Booking decline', 'Your request #6 has been declined by provider, please clarify on chat.', '0', '0', '2', '2022-09-15 19:11:46', NULL, NULL, '2022-09-15 19:11:46'),
(65, 1, 17, 'Booking accepted', ' Pankaj request #7 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:11:52', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(66, 1, 20, 'Booking accepted', 'Your booking #7 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-15 19:11:52', NULL, NULL, '2022-09-15 19:11:52'),
(67, 1, 17, 'Booking declined', 'Booking request#8 for Pankaj has been declined by you.', '0', '1', '2', '2022-09-15 19:12:20', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(68, 1, 20, 'Booking decline', 'Your request #8 has been declined by provider, please clarify on chat.', '0', '0', '2', '2022-09-15 19:12:20', NULL, NULL, '2022-09-15 19:12:20'),
(69, 1, 17, 'Booking accepted', ' Pankaj request #9 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:12:28', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(70, 1, 20, 'Booking accepted', 'Your booking #9 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-15 19:12:28', NULL, NULL, '2022-09-15 19:12:28'),
(71, 1, 17, 'Booking declined', 'Booking request#10 for Pankaj has been declined by you.', '0', '1', '2', '2022-09-15 19:12:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(72, 1, 20, 'Booking decline', 'Your request #10 has been declined by provider, please clarify on chat.', '0', '0', '2', '2022-09-15 19:12:32', NULL, NULL, '2022-09-15 19:12:32'),
(73, 1, 17, 'Booking accepted', ' Pankaj request #11 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:12:36', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(74, 1, 20, 'Booking accepted', 'Your booking #11 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-15 19:12:36', NULL, NULL, '2022-09-15 19:12:36'),
(75, 1, 17, 'Booking declined', 'Booking request#12 for Pankaj has been declined by you.', '0', '1', '2', '2022-09-15 19:12:41', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(76, 1, 20, 'Booking decline', 'Your request #12 has been declined by provider, please clarify on chat.', '0', '0', '2', '2022-09-15 19:12:41', NULL, NULL, '2022-09-15 19:12:41'),
(77, 1, 17, 'Booking accepted', ' Pankaj request #13 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:12:44', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(78, 1, 20, 'Booking accepted', 'Your booking #13 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-15 19:12:44', NULL, NULL, '2022-09-15 19:12:44'),
(79, 1, 17, 'Booking declined', 'Booking request#14 for Pankaj has been declined by you.', '0', '1', '2', '2022-09-15 19:12:48', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(80, 1, 20, 'Booking decline', 'Your request #14 has been declined by provider, please clarify on chat.', '0', '0', '2', '2022-09-15 19:12:48', NULL, NULL, '2022-09-15 19:12:48'),
(81, 1, 17, 'Booking accepted', ' Pankaj request #15 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-15 19:12:55', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(82, 1, 20, 'Booking accepted', 'Your booking #15 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-15 19:12:55', NULL, NULL, '2022-09-15 19:12:55'),
(83, 1, 17, 'Booking', ' AdventuresClubrequest has been accepted, check payment status on service participants section.AdventuresClub attempted payment by provided payment methods, please confirm the registration.', '0', '1', '2', '2022-09-15 19:18:10', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(84, 1, 17, 'Booking Payment Done', 'Your booking # 5 paragliding course Payment has been completed', '0', '1', '2', '2022-09-15 19:18:10', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(85, 1, 17, 'Booking', ' Pankajrequest has been accepted, check payment status on service participants section.Pankaj attempted payment by provided payment methods, please confirm the registration.', '0', '1', '2', '2022-09-15 19:27:02', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(86, 1, 20, 'Booking Payment Done', 'Your booking # 9 paragliding course Payment has been completed', '0', '0', '2', '2022-09-15 19:27:02', NULL, NULL, '2022-09-15 19:27:02'),
(87, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-16 06:12:59', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(88, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-16 06:12:59', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(89, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-16 06:14:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(90, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-16 06:14:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(91, 1, 17, 'Booking accepted', ' AdventuresClub request #19 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-16 06:31:52', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(92, 1, 17, 'Booking accepted', 'Your booking #19 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-16 06:31:52', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(93, 1, 17, 'Booking accepted', ' AdventuresClub request #17 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-16 06:32:18', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(94, 1, 17, 'Booking accepted', 'Your booking #17 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-16 06:32:18', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(95, 1, 17, 'Booking accepted', ' AdventuresClub request #18 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-16 06:32:39', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(96, 1, 17, 'Booking accepted', 'Your booking #18 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-16 06:32:39', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(97, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-16 14:42:45', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(98, 1, 17, 'Activities', 'Your Service: test has been approved.', '0', '1', '1', '2022-09-16 14:43:40', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(99, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-16 18:59:52', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(100, 1, 17, 'Activities', 'Your Service: payment gateway has been approved.', '0', '1', '1', '2022-09-16 19:00:30', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(101, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-16 19:01:07', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(102, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-16 19:01:07', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(103, 1, 17, 'Booking accepted', ' AdventuresClub request #20 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-16 19:01:22', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(104, 1, 17, 'Booking accepted', 'Your booking #20 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-16 19:01:22', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(105, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-17 07:21:24', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(106, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-17 07:21:24', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(107, 1, 17, 'Booking', ' AdventuresClubrequest has been accepted, check payment status on service participants section.AdventuresClub attempted payment by provided payment methods, please confirm the registration.', '0', '1', '2', '2022-09-17 07:21:38', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(108, 1, 17, 'Booking Payment Done', 'Your booking # 20 payment gateway Payment has been completed', '0', '1', '2', '2022-09-17 07:21:38', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(109, 1, 17, 'Booking accepted', ' AdventuresClub request #21 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-17 07:56:41', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(110, 1, 17, 'Booking accepted', 'Your booking #21 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-17 07:56:41', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(111, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-17 21:34:42', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(112, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-17 21:40:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(113, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-17 22:21:12', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(114, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-17 22:40:08', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(115, 1, 17, 'Activities', 'Your Service: vg has been approved.', '0', '1', '1', '2022-09-17 23:04:19', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(116, 1, 17, 'Activities', 'Your Service: ggg has been approved.', '0', '1', '1', '2022-09-17 23:35:04', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(117, 1, 17, 'Activities', 'Your Service: ggg has been approved.', '0', '1', '1', '2022-09-17 23:36:05', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(118, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-18 03:16:21', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(119, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-18 07:41:12', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(120, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-18 07:43:17', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(121, 1, 20, 'Your request has been approved', 'Now you may proceed to buy subscription package & will be able to provide your service.', '1', '0', '0', '2022-09-18 08:11:16', NULL, NULL, '2022-09-18 08:11:16'),
(122, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-18 10:20:17', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(123, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-18 10:20:17', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(124, 1, 17, 'Booking accepted', ' AdventuresClub request #22 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-18 10:20:24', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(125, 1, 17, 'Booking accepted', 'Your booking #22 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-18 10:20:24', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(126, 1, 17, 'Booking', ' AdventuresClubrequest has been accepted, check payment status on service participants section.AdventuresClub attempted payment by provided payment methods, please confirm the registration.', '0', '1', '2', '2022-09-18 10:20:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(127, 1, 17, 'Booking Payment Done', 'Your booking # 22 cycling Payment has been completed', '0', '1', '2', '2022-09-18 10:20:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(128, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-18 18:41:38', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(129, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-18 18:59:53', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(130, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-18 18:59:53', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(131, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-19 04:49:58', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(132, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-19 04:49:58', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(133, 1, 17, 'Booking dropped', ' AdventuresClub has dropped booking request# 24 of activity payment gateway', '0', '1', '2', '2022-09-19 14:35:06', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(134, 1, 17, 'Booking dropped', 'Your request 24 of activity payment gateway has been dropped by you, please inform the provider for convenience.', '0', '1', '2', '2022-09-19 14:35:06', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(135, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-19 14:35:48', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(136, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-19 14:35:48', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(137, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-19 14:37:20', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(138, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-19 14:37:20', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(139, 1, 17, 'Booking declined', 'Booking request#26 for AdventuresClub has been declined by you.', '0', '1', '2', '2022-09-19 14:38:28', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(140, 1, 17, 'Booking decline', 'Your request #26 has been declined by provider, please clarify on chat.', '0', '1', '2', '2022-09-19 14:38:28', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(141, 1, 17, 'Booking declined', 'Booking request#25 for AdventuresClub has been declined by you.', '0', '1', '2', '2022-09-19 14:38:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(142, 1, 17, 'Booking decline', 'Your request #25 has been declined by provider, please clarify on chat.', '0', '1', '2', '2022-09-19 14:38:32', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(143, 1, 17, 'Activities', 'Your activity has been created successfully ', '0', '1', '1', '2022-09-19 17:15:20', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(144, 1, 17, 'Your request has be approved', 'Now you may proceed to buy your subscription package & will be able to provide your services.', '1', '1', '0', '2022-09-19 17:16:22', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(145, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-19 20:21:35', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(146, 1, 17, 'Booking accepted', ' AdventuresClub request #23 has been accepted by you, plesse check payment status on service participants section.', '0', '1', '2', '2022-09-19 20:24:38', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(147, 1, 17, 'Booking accepted', 'Your booking #23 has been accepted, please make payment via provided channels', '0', '1', '2', '2022-09-19 20:24:38', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(148, 1, 17, 'Booking', ' AdventuresClubrequest has been accepted, check payment status on service participants section.AdventuresClub attempted payment by provided payment methods, please confirm the registration.', '0', '1', '2', '2022-09-19 20:25:01', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(149, 1, 17, 'Booking Payment Done', 'Your booking # 23 cycling Payment has been completed', '0', '1', '2', '2022-09-19 20:25:01', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(150, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-20 03:10:06', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(151, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-20 03:16:43', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(152, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-20 03:16:43', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(153, 1, 17, 'Login', 'You logged in successfully', '0', '1', '0', '2022-09-20 03:40:41', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(154, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-20 03:42:37', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(155, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-20 03:42:37', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(156, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '1', '2', '2022-09-20 03:47:45', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(157, 1, 17, 'Booking', 'Your booking has been submitted', '0', '1', '2', '2022-09-20 03:47:45', '2022-09-20', NULL, '2022-09-20 13:12:26'),
(158, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '0', '2', '2022-09-20 21:23:02', NULL, NULL, '2022-09-20 21:23:02'),
(159, 1, 17, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-20 21:23:02', NULL, NULL, '2022-09-20 21:23:02'),
(160, 1, 17, 'Booking accepted', ' AdventuresClub request #30 has been accepted by you, plesse check payment status on service participants section.', '0', '0', '2', '2022-09-20 21:23:12', NULL, NULL, '2022-09-20 21:23:12'),
(161, 1, 17, 'Booking accepted', 'Your booking #30 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-20 21:23:12', NULL, NULL, '2022-09-20 21:23:12'),
(162, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 02:38:23', NULL, NULL, '2022-09-21 02:38:23'),
(163, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 04:32:26', NULL, NULL, '2022-09-21 04:32:26'),
(164, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 06:09:05', NULL, NULL, '2022-09-21 06:09:05'),
(165, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '0', '2', '2022-09-21 10:27:20', NULL, NULL, '2022-09-21 10:27:20'),
(166, 1, 17, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-21 10:27:20', NULL, NULL, '2022-09-21 10:27:20'),
(167, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '0', '2', '2022-09-21 10:28:03', NULL, NULL, '2022-09-21 10:28:03'),
(168, 1, 17, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-21 10:28:03', NULL, NULL, '2022-09-21 10:28:03'),
(169, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '0', '2', '2022-09-21 10:32:32', NULL, NULL, '2022-09-21 10:32:32'),
(170, 1, 17, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-21 10:32:32', NULL, NULL, '2022-09-21 10:32:32'),
(171, 1, 17, 'Booking accepted', ' AdventuresClub request #33 has been accepted by you, plesse check payment status on service participants section.', '0', '0', '2', '2022-09-21 10:33:19', NULL, NULL, '2022-09-21 10:33:19'),
(172, 1, 17, 'Booking accepted', 'Your booking #33 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-21 10:33:19', NULL, NULL, '2022-09-21 10:33:19'),
(173, 1, 17, 'Booking', 'Booking request shared by a client, please validation health conditions and details before approving/declining the request!', '0', '0', '2', '2022-09-21 16:44:47', NULL, NULL, '2022-09-21 16:44:47'),
(174, 1, 17, 'Booking', 'Your booking has been submitted', '0', '0', '2', '2022-09-21 16:44:47', NULL, NULL, '2022-09-21 16:44:47'),
(175, 1, 17, 'Booking accepted', ' AdventuresClub request #34 has been accepted by you, plesse check payment status on service participants section.', '0', '0', '2', '2022-09-21 16:45:00', NULL, NULL, '2022-09-21 16:45:00'),
(176, 1, 17, 'Booking accepted', 'Your booking #34 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-21 16:45:00', NULL, NULL, '2022-09-21 16:45:00'),
(177, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 18:06:38', NULL, NULL, '2022-09-21 18:06:38'),
(178, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 18:12:22', NULL, NULL, '2022-09-21 18:12:22'),
(179, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 18:14:16', NULL, NULL, '2022-09-21 18:14:16'),
(180, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 19:18:59', NULL, NULL, '2022-09-21 19:18:59'),
(181, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-21 19:30:25', NULL, NULL, '2022-09-21 19:30:25'),
(182, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-22 13:40:34', NULL, NULL, '2022-09-22 13:40:34'),
(183, 1, 17, 'Booking accepted', ' AdventuresClub request #32 has been accepted by you, plesse check payment status on service participants section.', '0', '0', '2', '2022-09-22 13:40:59', NULL, NULL, '2022-09-22 13:40:59'),
(184, 1, 17, 'Booking accepted', 'Your booking #32 has been accepted, please make payment via provided channels', '0', '0', '2', '2022-09-22 13:40:59', NULL, NULL, '2022-09-22 13:40:59'),
(185, 1, 17, 'Login', 'You logged in successfully', '0', '0', '0', '2022-09-24 11:03:00', NULL, NULL, '2022-09-24 11:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `otp_on` tinyint(3) UNSIGNED DEFAULT '1' COMMENT '1=Mobile,2=Email',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=SignUp,2=Forgot Password,3=Login,4=ChnageMobileNumber',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mobile_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `otp` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1=Verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `user_id`, `otp_on`, `type`, `email`, `mobile_code`, `mobile`, `otp`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(3, 21, 1, 1, NULL, '+968', 96123588, 6995, '2022-09-15 00:29:37', '2022-09-15 00:30:13', NULL, 0),
(12, 22, 1, 1, NULL, '+968', 96123588, 9300, '2022-09-16 00:25:52', '2022-09-16 00:25:52', NULL, 0),
(13, 23, 1, 2, NULL, '++968', 96123588, 2415, '2022-09-21 09:59:10', '2022-09-22 10:23:43', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `symbol` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `duration` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `offer_cost` decimal(10,2) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `symbol`, `duration`, `cost`, `offer_cost`, `days`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Startup', '$', '1 Week', '0.00', '0.00', 7, 1, '2021-07-30 16:05:39', '2021-10-09 01:02:12', NULL),
(2, 'Advanced', '$', '3 Months', '100.00', '50.00', 90, 1, '2021-07-30 16:07:16', '2022-04-02 16:39:53', NULL),
(3, 'Platinum', '$', '6 Months', '150.00', '100.00', 180, 1, '2021-07-30 16:07:37', '2022-04-02 16:39:50', NULL),
(4, 'Diamond', '$', '12 Months', '200.00', '150.00', 360, 1, '2021-07-30 16:08:01', '2022-04-02 16:39:46', NULL),
(25, 'Golden ( 3 Months )', '$', '90', '150.00', '100.00', NULL, 1, '2022-05-06 16:58:43', '2022-05-16 22:57:09', '2022-05-16 22:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `package_detail`
--

CREATE TABLE `package_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `detail_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Exclude,1=Include'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package_detail`
--

INSERT INTO `package_detail` (`id`, `package_id`, `title`, `detail_type`) VALUES
(1, 1, 'This is first includes', 1),
(2, 1, 'This is first excludes', 0),
(3, 2, 'This is first includes', 1),
(4, 2, 'This is first excludes', 0),
(5, 3, 'This is first includes', 1),
(6, 3, 'This is first excludes', 0),
(7, 4, 'This is first includes', 1),
(8, 4, 'This is first excludes', 0),
(88, 25, 'AAA', 1),
(89, 25, 'BBB', 1),
(90, 25, 'CCC', 1),
(91, 25, 'DDD', 1),
(92, 25, '123', 0),
(93, 25, '456', 0),
(94, 25, '789', 0),
(95, 25, '210', 0),
(96, 26, '10$ from actual cost 15%', 1),
(97, 26, 'Quality guidance and support', 1),
(98, 26, 'Marketing plan', 1),
(99, 26, '15% income cost', 0),
(100, 26, 'Insurrence cost', 0),
(101, 27, 'MMMMM', 1),
(102, 27, 'BBBBBBBBBB', 1),
(103, 27, 'BBBBBBBBBBBB', 0),
(104, 27, 'PPPPPPPPP', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(0, 'admin@gmail.com', 'PXj9VCLOjHrHjWcAaw4sSkqOax5V9CzGJsPd87jrivMVHC8HN4rF3xzFWkz4s00r', '2022-09-16 16:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `payment_method` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `transaction_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `transaction_date` datetime NOT NULL,
  `account_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '1=Success,2=Failed',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `PersonID` int(11) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT 'Dubai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`PersonID`, `LastName`, `FirstName`, `Address`, `City`) VALUES
(NULL, NULL, NULL, NULL, 'Dubai'),
(NULL, NULL, NULL, NULL, 'Lahore');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1 Cybersecurity should underpin digital payment infrastructures...', 'As we come close to a year of being separated from our colleagues, friends, family, and conductingboth our professional and personal lives through our laptop and phone screens - its a good time totake a step back and re-evaluate the p', '2022-05-17 12:06:42', '2022-05-17 12:06:42', NULL),
(2, 'Tapping into the data boom with DBaaS', 'MultiCloud is here to stay and is slowly becoming inevitable for many organizations. At the same time, it is important to go beyond the hype of the buzzword and understand where it can help,andwhere it cannot. One of the common benef', '2022-05-17 12:06:42', '2022-05-17 12:06:42', NULL),
(3, 'IoT Security: Is Blockchain the way to go?', 'The first-generation blockchain has demonstrated immense value being a secure and cost effective way for recording and maintaining history of transactions for asset tracking purposes. What makes Blockchain secure is the fact that it is a', '2022-05-17 12:06:42', '2022-05-17 12:06:42', NULL),
(4, 'As we increase our tech-dependence, be vigilant about protecting data', 'Like much of the world, Indias enterprises saw a significant advancement in technology use over the past year, and the digital transformation of enterprises is expected to maintain its momentum.The business opportunities presented by', '2022-05-17 12:06:42', '2022-05-17 12:06:42', NULL),
(5, 'Recommended yoga adventure travel programs:', 'Is there anything like being within arms reach of a lion to prickle your senses and make you feel alive? Take a walk on the wild side. Channel your inner Indiana Jones with an adventure travel program unlike anything you’ve ever done before. Safari travelers can expect plenty of hair-raising, tail-spinning sights in unlikely destinations.', '2022-05-17 12:06:42', '2022-05-17 12:06:42', NULL),
(6, 'Recommended summer camp programs:', 'That one time at band camp” became a cliche for a reason: because summer camp is the ultimate source of absurd and wonderful adventures – the kind you can embarrass your grandchildren with for decades to come. Count on plenty of crafting with natural materials, group hiking, and schmoozing with co-eds on your summer camp adventure travel program. The campfire songs and s’mores at the end of each night are just the icing on the cake.', '2022-05-17 12:06:42', '2022-05-17 12:06:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(40, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 03:10:48'),
(41, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 03:10:48'),
(42, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 03:10:48'),
(43, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-23 05:17:37'),
(44, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 05:17:37'),
(45, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 05:17:37'),
(46, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 05:17:37'),
(47, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:00'),
(48, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:00'),
(49, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:00'),
(50, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:00'),
(51, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:54'),
(52, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:54'),
(53, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:54'),
(54, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 05:22:54'),
(55, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-23 05:28:41'),
(56, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 05:28:41'),
(57, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 05:28:41'),
(58, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 05:28:41'),
(59, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-23 06:09:30'),
(60, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 06:09:30'),
(61, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 06:09:30'),
(62, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 06:09:30'),
(63, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-23 23:25:59'),
(64, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-23 23:25:59'),
(65, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-23 23:25:59'),
(66, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-23 23:25:59'),
(67, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:35:56'),
(68, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:35:56'),
(69, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:35:56'),
(70, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:35:56'),
(71, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:37:31'),
(72, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:37:51'),
(73, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:38:05'),
(74, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:38:18'),
(75, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:39:05'),
(76, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:39:25'),
(77, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:40:59'),
(78, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:00'),
(79, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:08'),
(80, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:08'),
(81, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:17'),
(82, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:17'),
(83, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:17'),
(84, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:17'),
(85, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:37'),
(86, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:37'),
(87, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:37'),
(88, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:37'),
(89, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:46'),
(90, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:46'),
(91, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:46'),
(92, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:50:46'),
(93, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:51:01'),
(94, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:51:01'),
(95, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:51:01'),
(96, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:51:01'),
(97, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:53:01'),
(98, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:53:31'),
(99, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:53:56'),
(100, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:53:56'),
(101, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:53:56'),
(102, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:53:56'),
(103, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:55:01'),
(104, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:55:01'),
(105, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:55:01'),
(106, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:55:01'),
(107, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:01'),
(108, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:01'),
(109, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:01'),
(110, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:01'),
(111, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:07'),
(112, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:07'),
(113, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:07'),
(114, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:07'),
(115, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:29'),
(116, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:56:52'),
(117, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:57:02'),
(118, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:57:17'),
(119, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 05:57:48'),
(120, 'hello', '1', '2022-08-11 18:37:19', '2020-09-24 06:05:17'),
(121, 'test1', '1', '2022-08-11 18:37:19', '2020-09-24 06:09:28'),
(122, 'hhb', '1', '2022-08-11 18:37:19', '2020-09-24 06:13:19'),
(123, 'ff', '1', '2022-08-11 18:37:19', '2020-09-24 06:20:21'),
(124, 'prg-2', '1', '2022-08-11 18:37:19', '2020-09-24 23:35:50'),
(125, 'prg-1', '1', '2022-08-11 18:37:19', '2020-09-24 23:35:50'),
(126, 'prg-3', '1', '2022-08-11 18:37:19', '2020-09-24 23:35:50'),
(127, 'prg-4', '1', '2022-08-11 18:37:19', '2020-09-24 23:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE `promocode` (
  `id` int(11) NOT NULL,
  `promocode_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '''0''=>InActive,''1''=>Active',
  `discount_type` blob,
  `discount_amount` int(11) NOT NULL,
  `redeemed_count` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promocode`
--

INSERT INTO `promocode` (`id`, `promocode_name`, `code`, `status`, `discount_type`, `discount_amount`, `redeemed_count`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tester', 'OmanAdventuresClub', '1', '', 20, 2, '2022-05-17', '2022-05-24', 'OmanAdventuresClub', '2022-05-17 14:24:25', '2022-08-11 18:37:19', NULL),
(2, '20% for Oman', 'OmanAdventuresClub1', '1', '', 20, 1, '2022-05-16', '2022-05-23', '20%', '2022-05-17 14:26:02', '2022-08-11 18:37:19', NULL),
(3, 'OAC123', 'AdventuresClub123', '1', '', 10, 2, '2022-06-18', '2022-06-30', 'something', '2022-06-18 00:50:54', '2022-08-11 18:37:19', NULL),
(4, 'HHH5ytry', 'fgfgfgrtyrtyrty', '1', 0x41, 5654, 54654, '2022-09-15', '2022-09-23', '56546546', '2022-09-11 09:37:17', '2022-09-11 09:37:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocode_users`
--

CREATE TABLE `promocode_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `promocode_id` int(10) UNSIGNED NOT NULL,
  `promocode` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `disc_type` enum('1','2') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '1=>Amount, 2=>Percentage',
  `disc_amt` decimal(16,2) NOT NULL,
  `service_amt_befor_disc` decimal(16,2) NOT NULL,
  `service_amt_after_disc` decimal(16,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_reports`
--

CREATE TABLE `question_reports` (
  `id` int(11) NOT NULL,
  `username` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `emailid` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `country` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `purpose` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `question` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_reports`
--

INSERT INTO `question_reports` (`id`, `username`, `emailid`, `mobile`, `country`, `purpose`, `question`) VALUES
(1, 'ADMIN', 'admin@gmail.com', 9988448455, 'india', 'testing purpose only', 'how was your first advanture tour.');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `region` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `country_id`, `region`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Central India', 1, '2021-07-06 00:40:00', '2021-07-06 00:40:00', NULL),
(2, 1, 'Nagpur', 1, '2022-04-01 21:38:18', '2022-04-01 21:38:18', NULL),
(3, 1, 'East India', 1, '2021-07-06 00:40:00', '2021-07-06 00:40:00', NULL),
(4, 1, 'North India', 1, '2021-07-06 00:40:00', '2021-07-06 00:40:00', NULL),
(12, 1, 'Bareilly', 1, '2021-08-29 00:43:21', '2021-08-29 00:43:21', NULL),
(13, 1, 'Dehradun', 1, '2021-09-21 22:58:22', '2021-09-21 22:58:22', NULL),
(16, 1, 'Noida', 1, '2021-09-25 15:53:01', '2021-09-25 15:53:01', NULL),
(17, 1, 'U.P', 1, '2021-09-25 16:13:03', '2021-09-25 16:13:03', NULL),
(18, 1, 'MP', 1, '2021-09-25 16:14:03', '2021-09-25 16:14:03', NULL),
(20, 2, 'Muscat', 1, '2022-04-24 02:43:05', '2022-04-24 02:43:05', '2022-04-27 02:50:22'),
(21, 2, 'Dhofar', 1, '2022-04-24 02:43:24', '2022-04-24 02:43:24', NULL),
(22, 2, 'Sharqiyah', 1, '2022-04-24 02:43:37', '2022-04-24 02:43:37', NULL),
(23, 2, 'Dakhliyah', 1, '2022-04-24 02:43:49', '2022-04-24 02:43:49', '2022-09-02 22:13:19'),
(24, 2, 'Dakhliya', 1, '2022-09-02 22:13:29', '2022-09-02 22:13:29', NULL),
(25, 2, 'Al batinah North', 1, '2022-09-16 16:13:22', '2022-09-16 16:13:22', NULL),
(26, 2, 'Al batinah South', 1, '2022-09-16 16:13:34', '2022-09-16 16:13:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(400) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Manage Partner Requests'),
(2, 'Manage Activity Requests'),
(3, 'Manage and view Partner requests'),
(4, 'Manage Promocodes add, delete, and view'),
(5, 'View Transactions'),
(6, 'Manage Announcements Add, Edit and Delete'),
(7, 'Manage Country Add, Edit and Delete'),
(9, 'Manage Locations Add, Edit and Delete'),
(10, 'Manage Admin Add, Edit and Delete'),
(11, 'Manage Chat Allow and Decline Client Chat Access'),
(12, 'Manage Administration Add, Edit and Delete');

-- --------------------------------------------------------

--
-- Table structure for table `role_assignments`
--

CREATE TABLE `role_assignments` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_assignments`
--

INSERT INTO `role_assignments` (`id`, `country_id`, `role_id`, `sort`) VALUES
(1, 2, 1, 0),
(2, 2, 2, 0),
(3, 2, 3, 0),
(4, 2, 4, 0),
(5, 2, 5, 0),
(6, 2, 6, 0),
(7, 2, 7, 0),
(8, 2, 9, 0),
(9, 2, 10, 0),
(10, 2, 11, 0),
(11, 2, 12, 0),
(12, 1, 1, 0),
(13, 1, 2, 0),
(14, 1, 3, 0),
(15, 1, 4, 0),
(16, 1, 5, 0),
(17, 1, 6, 0),
(18, 1, 7, 0),
(19, 1, 9, 0),
(20, 1, 10, 0),
(21, 1, 11, 0),
(22, 1, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner` int(10) UNSIGNED NOT NULL,
  `adventure_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `country` int(10) UNSIGNED NOT NULL,
  `region` int(10) UNSIGNED NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `service_sector` int(10) UNSIGNED NOT NULL,
  `service_category` int(10) UNSIGNED NOT NULL,
  `service_type` int(10) UNSIGNED NOT NULL,
  `service_level` int(10) UNSIGNED NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL,
  `available_seats` tinyint(3) UNSIGNED NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `write_information` text CHARACTER SET utf8 COLLATE utf8_bin,
  `service_plan` tinyint(1) DEFAULT NULL,
  `sfor_id` int(11) DEFAULT NULL,
  `availability` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `geo_location` text CHARACTER SET utf8 COLLATE utf8_bin,
  `specific_address` text CHARACTER SET utf8 COLLATE utf8_bin,
  `cost_inc` decimal(10,2) NOT NULL,
  `cost_exc` decimal(10,2) NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `points` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `pre_requisites` text CHARACTER SET utf8 COLLATE utf8_bin,
  `minimum_requirements` text CHARACTER SET utf8 COLLATE utf8_bin,
  `terms_conditions` text CHARACTER SET utf8 COLLATE utf8_bin,
  `recommended` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '0=Pending,1=Accept,2=Decline',
  `image` varchar(200) NOT NULL,
  `descreption` text CHARACTER SET utf8 COLLATE utf8_bin,
  `favourite_image` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `owner`, `adventure_name`, `country`, `region`, `city_id`, `service_sector`, `service_category`, `service_type`, `service_level`, `duration`, `available_seats`, `start_date`, `end_date`, `latitude`, `longitude`, `write_information`, `service_plan`, `sfor_id`, `availability`, `geo_location`, `specific_address`, `cost_inc`, `cost_exc`, `currency`, `points`, `pre_requisites`, `minimum_requirements`, `terms_conditions`, `recommended`, `status`, `image`, `descreption`, `favourite_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 17, 'paragliding course', 2, 21, NULL, 44, 30, 9, 16, 15, 3, NULL, NULL, '23.6016433459862', '58.3460098877549', 'https://www.twilio.com/console\n\nAdventuresclub.net@gmail.com\n\nAdventurer9894(*($', 1, NULL, NULL, 'Muscat Oman', 'myscat', '30.00', '25.00', '2', 0, 'test', 'test', 'test', 1, '0', '', 'https://www.twilio.com/console\n\nAdventuresclub.net@gmail.com\n\nAdventurer9894(*($', '', '2022-09-14 23:09:28', '2022-09-14 23:16:04', NULL),
(2, 17, 'Archery', 2, 21, NULL, 45, 28, 15, 17, 18, 5, '2022-09-14 00:00:00', '2022-09-15 00:00:00', '23.5827016', '58.2655769', 'test body', 2, NULL, NULL, 'Sultan Qaboos Street  Matrah  Oman', 'mct', '30.00', '20.00', '2', 0, 'test', 'test', 'test', 1, '1', '', 'test body', '', '2022-09-14 23:19:05', '2022-09-14 23:19:27', NULL),
(3, 17, 'cycling', 2, 22, NULL, 45, 36, 9, 17, 14, 3, NULL, NULL, '23.614441', '58.244579', 'body', 1, NULL, NULL, 'J67V+QRG  Seeb  Oman', 'road', '50.00', '40.00', '2', 0, 'test', 'test', 'test', 1, '1', '', 'body', '', '2022-09-14 23:21:41', '2022-09-14 23:22:01', NULL),
(4, 17, 'test', 2, 26, NULL, 44, 29, 16, 17, 18, 5, '2022-09-16 00:00:00', '2022-09-18 00:00:00', '24.3896529451667', '56.6995288431644', 'يارب اصرف عنا الهموم و الأحزان و انعم علينا بالرضا و الاطمئنان و الأمان و ارزقنا راحة البال و القلب و العقل و النفس و وفقنا لكل ما تحب وترضى واصرف عنا كل ما تكره وأرزقنا الرزق الحلال من حيث لا نحتسب و', 2, NULL, NULL, 'Sohar Oman', 'Sohar plaza', '50.00', '40.00', '2', 0, 'يارب اصرف عنا الهموم و الأحزان و انعم علينا بالرضا و الاطمئنان و الأمان و ارزقنا راحة البال و القلب و العقل و النفس و وفقنا لكل ما تحب وترضى واصرف عنا كل ما تكره وأرزقنا الرزق الحلال من حيث لا نحتسب و', 'يارب اصرف عنا الهموم و الأحزان و انعم علينا بالرضا و الاطمئنان و الأمان و ارزقنا راحة البال و القلب و العقل و النفس و وفقنا لكل ما تحب وترضى واصرف عنا كل ما تكره وأرزقنا الرزق الحلال من حيث لا نحتسب و', 'يارب اصرف عنا الهموم و الأحزان و انعم علينا بالرضا و الاطمئنان و الأمان و ارزقنا راحة البال و القلب و العقل و النفس و وفقنا لكل ما تحب وترضى واصرف عنا كل ما تكره وأرزقنا الرزق الحلال من حيث لا نحتسب و', 1, '1', '', 'يارب اصرف عنا الهموم و الأحزان و انعم علينا بالرضا و الاطمئنان و الأمان و ارزقنا راحة البال و القلب و العقل و النفس و وفقنا لكل ما تحب وترضى واصرف عنا كل ما تكره وأرزقنا الرزق الحلال من حيث لا نحتسب و', '', '2022-09-16 20:12:45', '2022-09-16 20:13:40', NULL),
(5, 17, 'payment_gateway_test3', 1, 12, NULL, 44, 28, 1, 15, 13, 45, NULL, NULL, '23.913735122148', '57.2337749227881', 'test app', 1, NULL, NULL, 'Khalil Oman', 'see side', '4000.00', '3000.00', '1', 0, 'request', 'terms', 'pre condition', 1, '1', '', 'test', '', '2022-09-17 00:29:52', '2022-09-24 17:06:43', NULL),
(6, 17, 'ggg', 2, 25, NULL, 44, 28, 1, 15, 13, 255, NULL, NULL, '28.5694421', '79.6012456', 'fff', 1, NULL, NULL, 'Unnamed Road Bareilly Akhriarpur Nawadia 262406 In', 'hy', '22.00', '55.00', '2', 0, 'fr', 'cc', 'ff', 1, '1', '', 'fff', '', '2022-09-18 03:51:12', '2022-09-18 05:05:04', NULL),
(7, 17, 'vg', 2, 25, NULL, 44, 28, 1, 15, 13, 98, NULL, NULL, '28.5694421', '79.6012456', 'vv', 1, NULL, NULL, 'Unnamed Road Bareilly Akhriarpur Nawadia 262406 In', 'bh', '52.00', '55.00', '2', 0, 'gg', 'gg', 'gg', 1, '1', '', 'vv', '', '2022-09-18 04:10:08', '2022-09-18 04:34:19', NULL),
(8, 17, 'test edit adventure', 2, 24, NULL, 44, 28, 1, 15, 13, 55, NULL, NULL, '28.4535892', '79.3193821', 'vhhhh ds', 1, NULL, NULL, 'National Highway 530 Bareilly Fatehganj Pashchimi', 'hh', '22.00', '22.00', '2', 0, 'gg', 'vg', 'gg', 1, '1', '', 'vhhhh', '', '2022-09-18 13:11:12', '2022-09-20 08:42:48', NULL),
(9, 17, 'testt', 2, 25, NULL, 44, 28, 1, 15, 13, 25, '2022-09-20 00:00:00', '2022-10-30 00:00:00', '28.4580064', '79.3011229', 'vhg', 2, NULL, NULL, 'F852+6C5 Bareilly Fatehganj Pashchimi 243501 India', 'hhy', '225.00', '225.00', '2', 0, 'ghh', 'gg', 'bbh', 1, '1', '', 'vhg', '', '2022-09-18 13:13:17', '2022-09-18 13:13:17', NULL),
(11, 17, 'check dates', 1, 1, NULL, 45, 29, 9, 17, 14, 5, NULL, NULL, '23.5930066', '58.1425342', 'test', 1, NULL, NULL, 'H4VV+623  Seeb  Oman', 'alkhudh6', '30.00', '20.00', '1', 0, 'test', 'test', 'test', 1, '1', '', 'test', '', '2022-09-19 22:45:20', '2022-09-19 22:45:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_activities`
--

CREATE TABLE `service_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `activity_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_activities`
--

INSERT INTO `service_activities` (`id`, `service_id`, `activity_id`) VALUES
(1, 1, '1'),
(2, 1, '3'),
(3, 1, '5'),
(4, 1, '7'),
(5, 1, '8'),
(6, 2, '3'),
(7, 2, '5'),
(8, 3, '2'),
(9, 3, '3'),
(10, 3, '5'),
(11, 3, '6'),
(12, 3, '7'),
(13, 4, '2'),
(14, 4, '16'),
(15, 4, '17'),
(16, 5, '5'),
(17, 5, '7'),
(21, 11, '5');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `category`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Land', 'yoga.jpg', 1, '2021-06-30 09:57:47', '2022-03-30 20:02:01', '2022-03-30 20:02:01'),
(2, 'Sea', 'trekking.jpg', 1, '2021-06-30 09:57:47', '2021-10-19 13:28:16', '2021-10-19 13:28:16'),
(3, 'Sky', 'cycling.jpg', 1, '2021-06-30 09:57:47', '2021-10-19 13:28:20', '2021-10-19 13:28:20'),
(4, 'Mountain', 'canoeing.jpg', 1, '2021-06-30 09:57:47', '2021-10-19 12:56:50', '2021-10-19 12:56:50'),
(5, 'Sand', 'kayaking.jpeg', 1, '2021-06-30 09:57:47', '2021-08-05 11:06:17', '2021-08-05 11:06:17'),
(6, 'Lake', 'rock-climbing.jpg', 1, '2021-06-30 09:57:47', '2021-07-31 12:41:10', '2021-07-31 12:41:10'),
(11, 'Tour', 'rock-climbing.jpg', 1, '2021-10-19 13:28:37', '2022-07-16 22:41:30', '2022-07-16 22:41:30'),
(12, 'Training', 'rock-climbing.jpg', 1, '2021-10-19 13:28:50', '2022-07-16 22:41:36', '2022-07-16 22:41:36'),
(17, 'Air', '', 1, '2022-07-16 22:28:42', '2022-07-16 22:41:41', '2022-07-16 22:41:41'),
(18, 'Sand', '', 1, '2022-07-16 22:28:59', '2022-07-16 22:41:45', '2022-07-16 22:41:45'),
(19, 'Water', '', 1, '2022-07-16 22:29:12', '2022-07-16 22:41:50', '2022-07-16 22:41:50'),
(20, 'River', '', 1, '2022-07-16 22:29:31', '2022-07-16 22:41:54', '2022-07-16 22:41:54'),
(21, 'Air Activity', '', 1, '2022-07-16 22:42:12', '2022-07-16 22:59:46', '2022-07-16 22:59:46'),
(22, 'Water Activity', '', 1, '2022-07-16 22:43:34', '2022-07-16 23:00:12', '2022-07-16 23:00:12'),
(23, 'Land Activity', '', 1, '2022-07-16 22:44:07', '2022-07-16 23:00:18', '2022-07-16 23:00:18'),
(24, 'Accommodation', '', 1, '2022-07-16 22:44:26', '2022-07-16 23:01:32', '2022-07-16 23:01:32'),
(25, 'Transportation', '', 1, '2022-07-16 22:44:42', '2022-07-16 23:01:36', '2022-07-16 23:01:36'),
(26, 'Package', '', 1, '2022-07-16 22:44:55', '2022-07-16 23:01:40', '2022-07-16 23:01:40'),
(27, 'Air', '', 1, '2022-07-16 23:00:02', '2022-07-16 23:00:23', '2022-07-16 23:00:23'),
(28, 'Land', '', 1, '2022-07-16 23:00:45', '2022-07-16 23:00:45', NULL),
(29, 'Water', '', 1, '2022-07-16 23:01:04', '2022-07-16 23:01:04', NULL),
(30, 'Air', '', 1, '2022-07-16 23:01:24', '2022-07-16 23:01:24', NULL),
(31, 'Accommodation', '', 1, '2022-07-16 23:01:57', '2022-07-16 23:03:03', '2022-07-16 23:03:03'),
(32, 'Transportation', '', 1, '2022-07-16 23:02:13', '2022-07-16 23:03:25', '2022-07-16 23:03:25'),
(33, 'Package', '', 1, '2022-07-16 23:02:28', '2022-07-16 23:03:30', '2022-07-16 23:03:30'),
(34, 'Stay', '', 1, '2022-07-16 23:03:18', '2022-07-20 16:44:56', '2022-07-20 16:44:56'),
(35, 'Transport', '', 1, '2022-07-16 23:03:56', '2022-07-20 16:44:50', '2022-07-20 16:44:50'),
(36, 'Package', '', 1, '2022-07-16 23:04:11', '2022-07-16 23:04:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_dependencies`
--

CREATE TABLE `service_dependencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `dependency_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_dependencies`
--

INSERT INTO `service_dependencies` (`id`, `service_id`, `dependency_id`) VALUES
(1, 1, '5'),
(2, 1, '6'),
(3, 2, '5'),
(4, 2, '6'),
(5, 3, '5'),
(6, 3, '6'),
(7, 4, '5'),
(8, 4, '6'),
(9, 5, '6'),
(10, 5, '7'),
(11, 6, '5'),
(12, 6, '8'),
(13, 7, '6'),
(14, 8, '7'),
(15, 9, '5'),
(19, 11, '6');

-- --------------------------------------------------------

--
-- Table structure for table `service_for`
--

CREATE TABLE `service_for` (
  `id` int(10) UNSIGNED NOT NULL,
  `sfor` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_images`
--

CREATE TABLE `service_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `image_url` varchar(255) NOT NULL,
  `thumbnail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_images`
--

INSERT INTO `service_images` (`id`, `service_id`, `is_default`, `image_url`, `thumbnail`) VALUES
(1, 1, 1, 'services/services-0-1663177168.jpg', 'services/services-0-1663177168.jpg'),
(2, 1, 0, 'services/services-1-1663177168.jpg', 'services/services-1-1663177168.jpg'),
(3, 2, 1, 'services/services-0-1663177745.jpg', 'services/services-0-1663177745.jpg'),
(4, 2, 0, 'services/services-1-1663177745.jpg', 'services/services-1-1663177745.jpg'),
(5, 3, 1, 'services/services-0-1663177901.jpg', 'services/services-0-1663177901.jpg'),
(6, 3, 0, 'services/services-1-1663177901.jpg', 'services/services-1-1663177901.jpg'),
(7, 4, 1, 'services/services-0-1663339365.jpg', 'services/services-0-1663339365.jpg'),
(8, 4, 0, 'services/services-1-1663339365.jpg', 'services/services-1-1663339365.jpg'),
(9, 5, 1, 'services/services-0-1663354792.jpg', 'services/services-0-1663354792.jpg'),
(10, 5, 0, 'services/services-1-1663354792.jpg', 'services/services-1-1663354792.jpg'),
(11, 6, 1, 'services/services-0-1663453272.jpg', 'services/services-0-1663453272.jpg'),
(12, 6, 0, 'services/services-1-1663453272.jpg', 'services/services-1-1663453272.jpg'),
(13, 7, 1, 'services/services-0-1663454408.jpg', 'services/services-0-1663454408.jpg'),
(14, 7, 0, 'services/services-1-1663454408.jpg', 'services/services-1-1663454408.jpg'),
(15, 8, 1, 'services/services-0-1663486872.jpg', 'services/services-0-1663486872.jpg'),
(16, 8, 0, 'services/services-1-1663486872.jpg', 'services/services-1-1663486872.jpg'),
(17, 9, 1, 'services/services-0-1663486997.jpg', 'services/services-0-1663486997.jpg'),
(18, 9, 0, 'services/services-1-1663486997.jpg', 'services/services-1-1663486997.jpg'),
(19, 11, 1, 'services/services-0-1663607720.jpg', 'services/services-0-1663607720.jpg'),
(20, 11, 0, 'services/services-1-1663607720.jpg', 'services/services-1-1663607720.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_levels`
--

CREATE TABLE `service_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_levels`
--

INSERT INTO `service_levels` (`id`, `level`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'Beginner', 1, '2022-05-06 21:34:31', '2022-05-06 21:34:31', NULL),
(16, 'Intermediate', 1, '2022-05-06 21:35:24', '2022-05-06 21:35:24', NULL),
(17, 'Advanced', 1, '2022-05-06 21:35:49', '2022-05-06 21:35:49', NULL),
(18, 'tester', 1, '2022-05-24 22:03:49', '2022-05-24 22:04:08', '2022-05-24 22:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `service_likes`
--

CREATE TABLE `service_likes` (
  `id` int(11) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_like` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_offers`
--

CREATE TABLE `service_offers` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount_type` enum('A','P') DEFAULT NULL COMMENT '''A''=>''Amount'', ''P''=>''Percentage''',
  `discount_amount` int(11) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '0' COMMENT '''0''=>''Inactive'',''1''=>''Active''',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_offers`
--

INSERT INTO `service_offers` (`id`, `service_id`, `country_id`, `name`, `start_date`, `end_date`, `discount_type`, `discount_amount`, `banner`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, '2', 'uiuyiuyi', '2022-09-23', '2022-09-30', 'A', 56, 'offer_image/1663605759.jpeg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', '1', '2022-09-19 22:12:39', '2022-09-19 16:42:39', NULL),
(2, 5, '1', 'ghgfh', '2022-09-30', '2022-10-29', 'A', 54, 'offer_image/1663606378.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', '1', '2022-09-19 22:22:58', '2022-09-19 16:52:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_plan`
--

CREATE TABLE `service_plan` (
  `id` int(11) NOT NULL,
  `plan` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_plan`
--

INSERT INTO `service_plan` (`id`, `plan`, `title`) VALUES
(1, 'Month', 'Every particular weekdays'),
(2, 'Calender', 'Every particular calender date');

-- --------------------------------------------------------

--
-- Table structure for table `service_plan_day_date`
--

CREATE TABLE `service_plan_day_date` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `day` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_plan_day_date`
--

INSERT INTO `service_plan_day_date` (`id`, `service_id`, `day`, `date`) VALUES
(1, 1, 1, NULL),
(2, 1, 3, NULL),
(3, 1, 5, NULL),
(4, 1, 7, NULL),
(5, 2, NULL, '1970-01-01'),
(6, 3, 1, NULL),
(7, 3, 3, NULL),
(8, 3, 5, NULL),
(9, 3, 7, NULL),
(10, 4, NULL, '1970-01-01'),
(11, 5, NULL, '1970-01-01'),
(12, 6, 2, NULL),
(13, 6, 4, NULL),
(14, 7, 4, NULL),
(15, 7, 6, NULL),
(16, 8, 4, NULL),
(17, 9, NULL, '1970-01-01'),
(21, 11, 2, NULL),
(22, 11, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_programs`
--

CREATE TABLE `service_programs` (
  `id` int(11) NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `start_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_programs`
--

INSERT INTO `service_programs` (`id`, `service_id`, `title`, `description`, `start_datetime`, `end_datetime`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'test', 'https://instagram.com/makera_dobaa?igshid=YmMyMTA2M2Y=', '2022-09-14 06:00:00', '2022-09-14 08:00:00', '1', '2022-09-14 17:39:28', '2022-09-14 17:39:28', NULL),
(2, 2, 'test', 'test', '2022-09-14 06:00:00', '2022-09-14 07:00:00', '1', '2022-09-14 17:49:05', '2022-09-14 17:49:05', NULL),
(3, 3, 'test', 'test', '2022-09-14 06:00:00', '2022-09-14 08:00:00', '1', '2022-09-14 17:51:41', '2022-09-14 17:51:41', NULL),
(4, 4, 'tester', 'يارب اصرف عنا الهموم و الأحزان و انعم علينا بالرضا و الاطمئنان و الأمان و ارزقنا راحة البال و القلب و العقل و النفس و وفقنا لكل ما تحب وترضى واصرف عنا كل ما تكره وأرزقنا الرزق الحلال من حيث لا نحتسب واغفر لنا ولوالدينا ولجميع المسلمين وإجمعنا في جنتك.\n‏آمين.\n‏    ?صبحكم الله بالخير?', '2022-09-16 07:00:00', '2022-09-16 09:00:00', '1', '2022-09-16 14:42:45', '2022-09-16 14:42:45', NULL),
(5, 5, 'test', 'hsgs', '2022-09-16 06:00:00', '2022-09-16 10:00:00', '1', '2022-09-16 18:59:52', '2022-09-16 18:59:52', NULL),
(6, 6, 'hg', 'bh', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '2022-09-17 22:21:12', '2022-09-17 22:21:12', NULL),
(7, 7, 'hh', 'gg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '2022-09-17 22:40:08', '2022-09-17 22:40:08', NULL),
(8, 7, 'gg', 'gh', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '2022-09-17 22:40:08', '2022-09-17 22:40:08', NULL),
(9, 8, 'bhhh', 'hhy', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '2022-09-18 07:41:12', '2022-09-18 07:41:12', NULL),
(10, 9, 'hh', 'bbh', '2022-09-25 03:15:00', '2022-09-25 10:50:00', '1', '2022-09-18 07:43:17', '2022-09-18 07:43:17', NULL),
(13, 11, 'test', 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '2022-09-19 17:15:20', '2022-09-19 17:15:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_reviews`
--

CREATE TABLE `service_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `star` tinyint(3) UNSIGNED NOT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_reviews`
--

INSERT INTO `service_reviews` (`id`, `service_id`, `user_id`, `star`, `remark`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 20, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2022-09-18 00:00:00', '2022-09-18 00:00:00', NULL),
(2, 1, 20, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2022-09-18 00:00:00', '2022-09-18 00:00:00', NULL),
(3, 2, 17, 4, 'my text goes here', 1, '2022-09-19 04:47:54', '2022-09-19 04:47:54', NULL),
(4, 5, 17, 4, 'my text goes here', 1, '2022-09-19 04:54:56', '2022-09-19 04:54:56', NULL),
(5, 5, 17, 2, 'my text goes here', 1, '2022-09-19 04:56:28', '2022-09-19 04:56:28', NULL),
(6, 5, 17, 5, 'tester as 5', 1, '2022-09-19 14:39:09', '2022-09-19 14:39:09', NULL),
(7, 2, 17, 1, 'tester as 1', 1, '2022-09-19 14:40:44', '2022-09-19 14:40:44', NULL),
(8, 5, 17, 2, 'test as 2vfor now!', 1, '2022-09-19 14:42:27', '2022-09-19 14:42:27', NULL),
(9, 5, 17, 1, 'rated as 1', 1, '2022-09-19 14:43:53', '2022-09-19 14:43:53', NULL),
(10, 2, 17, 1, 'tester of tester', 1, '2022-09-19 20:25:56', '2022-09-19 20:25:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_sectors`
--

CREATE TABLE `service_sectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `sector` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_sectors`
--

INSERT INTO `service_sectors` (`id`, `sector`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(35, 'Air Activity', 1, '2022-05-24 23:04:48', '2022-07-16 22:45:30', '2022-07-16 22:45:30'),
(36, 'Land Activity', 1, '2022-05-24 23:05:05', '2022-07-16 22:45:25', '2022-07-16 22:45:25'),
(37, 'Water Activity', 1, '2022-05-24 23:05:15', '2022-07-16 22:45:21', '2022-07-16 22:45:21'),
(38, 'Package', 1, '2022-05-24 23:05:32', '2022-07-16 22:45:17', '2022-07-16 22:45:17'),
(39, 'Transportation', 1, '2022-05-24 23:05:44', '2022-07-16 22:45:13', '2022-07-16 22:45:13'),
(40, 'Accomodation', 1, '2022-05-24 23:05:54', '2022-07-16 22:45:09', '2022-07-16 22:45:09'),
(41, 'Build check', 1, '2022-06-18 00:53:47', '2022-06-18 00:54:31', '2022-06-18 00:54:31'),
(42, 'Land Activity', 1, '2022-07-16 22:42:40', '2022-07-16 22:45:05', '2022-07-16 22:45:05'),
(43, 'Water Activity', 1, '2022-07-16 22:43:04', '2022-07-16 22:43:21', '2022-07-16 22:43:21'),
(44, 'Training', 1, '2022-07-16 22:45:45', '2022-07-16 22:45:45', NULL),
(45, 'Tour', 1, '2022-07-16 22:45:59', '2022-07-16 22:45:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_service_for`
--

CREATE TABLE `service_service_for` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `sfor_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_service_for`
--

INSERT INTO `service_service_for` (`id`, `service_id`, `sfor_id`) VALUES
(1, 1, '11'),
(2, 1, '14'),
(3, 2, '11'),
(4, 2, '12'),
(5, 3, '11'),
(6, 3, '14'),
(7, 3, '15'),
(8, 4, '11'),
(9, 4, '13'),
(10, 5, '11'),
(11, 5, '13'),
(12, 6, '11'),
(13, 6, '14'),
(14, 7, '13'),
(15, 8, '14'),
(16, 9, '12'),
(17, 9, '14'),
(18, 10, '1'),
(19, 11, '12');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hiking', 1, '2021-06-30 10:08:25', '2021-06-30 10:18:35', NULL),
(2, 'Skiing', 1, '2021-06-30 10:08:25', '2021-10-19 13:07:53', '2021-10-19 13:07:53'),
(3, 'Parachuting', 1, '2021-06-30 10:08:25', '2021-10-19 13:08:01', '2021-10-19 13:08:01'),
(4, 'Scuba diving', 1, '2021-06-30 10:08:25', '2021-08-05 11:06:29', '2021-08-05 11:06:29'),
(5, 'Zorbing', 1, '2021-06-30 10:08:25', '2021-07-31 12:41:21', '2021-07-31 12:41:21'),
(9, 'Paragliding', 1, '2021-10-19 13:08:22', '2021-10-19 13:08:22', NULL),
(10, 'Paramotor', 1, '2021-10-19 13:08:35', '2021-10-19 13:08:35', NULL),
(11, 'Scuba Diving', 1, '2021-10-19 13:08:53', '2021-10-19 13:08:53', NULL),
(12, 'Canyoning', 1, '2021-10-19 13:09:02', '2021-10-19 13:09:02', NULL),
(13, 'Kitesurfing', 1, '2021-10-19 13:09:39', '2021-10-19 13:09:39', NULL),
(14, 'Drifting', 1, '2021-10-19 13:10:00', '2021-10-19 13:10:00', NULL),
(15, 'Caving', 1, '2021-10-19 13:12:12', '2021-10-19 13:12:12', NULL),
(16, 'Climbing', 1, '2021-10-19 13:12:37', '2021-10-19 13:12:37', NULL),
(17, 'Cycling', 1, '2021-10-19 13:13:14', '2021-10-19 13:13:14', NULL),
(18, 'Freediving', 1, '2021-10-19 13:14:26', '2021-10-19 13:14:26', NULL),
(19, 'Camping', 1, '2021-10-19 13:14:42', '2021-10-19 13:17:53', '2021-10-19 13:17:53'),
(20, 'Hang Gliding', 1, '2021-10-19 13:15:01', '2021-10-19 13:15:01', NULL),
(21, 'Highlining / Slacklining', 1, '2021-10-19 13:15:35', '2022-05-24 21:51:26', '2022-05-24 21:51:26'),
(22, 'Horse Riding', 1, '2021-10-19 13:16:03', '2021-10-19 13:16:03', NULL),
(23, 'Overlanding (Camping)', 1, '2021-10-19 13:17:40', '2022-05-24 21:51:54', '2022-05-24 21:51:54'),
(24, 'Sand boarding', 1, '2021-10-19 13:18:59', '2021-10-19 13:18:59', NULL),
(25, 'Sailing', 1, '2021-10-19 13:19:32', '2021-10-19 13:19:32', NULL),
(26, 'Skydiving', 1, '2021-10-19 13:19:50', '2021-10-19 13:19:50', NULL),
(27, 'test', 1, '2022-03-31 20:58:07', '2022-04-04 14:50:19', '2022-04-04 14:50:19'),
(28, 'Hiking', 1, '2022-04-04 14:50:53', '2022-04-04 14:50:53', NULL),
(29, 'Helicopter tours', 1, '2022-04-12 23:13:31', '2022-04-12 23:13:31', NULL),
(30, 'Bungee Jumping', 1, '2022-04-12 23:13:57', '2022-04-12 23:13:57', NULL),
(31, 'Hot Air Ballooning', 1, '2022-04-12 23:14:19', '2022-04-12 23:14:19', NULL),
(32, 'Microlight flying', 1, '2022-04-12 23:14:48', '2022-04-12 23:14:48', NULL),
(33, 'Parasailing', 1, '2022-04-12 23:15:17', '2022-04-12 23:15:17', NULL),
(34, 'Scenic Flights', 1, '2022-04-12 23:15:51', '2022-04-12 23:15:51', NULL),
(35, 'tester', 1, '2022-04-27 02:45:16', '2022-04-27 02:45:23', '2022-04-27 02:45:23'),
(36, 'Camping', 1, '2022-05-24 21:51:06', '2022-05-24 21:51:06', NULL),
(37, 'Highlining', 1, '2022-05-24 21:51:37', '2022-05-24 21:51:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `amount` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `type`, `amount`) VALUES
(1, '1 Week', 'Free'),
(2, 'Monthly', '$5.00'),
(3, 'Quaterly', '$25.00'),
(4, 'Yearly', '$45.00');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan_history`
--

CREATE TABLE `subscription_plan_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `order_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `payment_status` blob,
  `payment_amount` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription_plan_history`
--

INSERT INTO `subscription_plan_history` (`id`, `user_id`, `package_id`, `order_id`, `payment_type`, `payment_status`, `payment_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 2, '305092022152742ada', '0', '', '120.00', '2022-09-05 16:59:14', '2022-09-05 16:59:14', NULL),
(2, 3, 3, '307092022135226af0', '0', 0x42616e6b4d7573636174, '150.00', '2022-09-07 15:23:09', '2022-09-07 15:23:09', NULL),
(3, 3, 2, '308092022204403afe', '0', 0x42616e6b4d7573636174, '100.00', '2022-09-08 20:53:27', '2022-09-08 20:53:27', NULL),
(4, 4, 1, '408092022225331a8b', '0', 0x46726565, '0', '2022-09-09 00:23:32', '2022-09-09 00:23:32', NULL),
(5, 5, 1, '508092022230711aa3', '0', 0x46726565, '0', '2022-09-09 00:37:12', '2022-09-09 00:37:12', NULL),
(6, 6, 1, '608092022231136af5', '0', 0x46726565, '0', '2022-09-09 00:41:37', '2022-09-09 00:41:37', NULL),
(7, 7, 1, '709092022021706a4f', '0', 0x46726565, '0', '2022-09-09 02:17:07', '2022-09-09 02:17:07', NULL),
(8, 7, 2, '709092022022041a71', '0', 0x42616e6b4d7573636174, '100.00', '2022-09-09 02:21:02', '2022-09-09 02:21:02', NULL),
(9, 8, 1, '809092022022529ae0', '0', 0x46726565, '0', '2022-09-09 02:25:30', '2022-09-09 02:25:30', NULL),
(10, 10, 1, '1009092022023650ab5', '0', 0x46726565, '0', '2022-09-09 02:36:51', '2022-09-09 02:36:51', NULL),
(11, 10, 2, '1009092022200907a4b', '0', 0x42616e6b4d7573636174, '100.00', '2022-09-09 20:09:20', '2022-09-09 20:09:20', NULL),
(12, 12, 1, '1209092022195915a7e', '0', 0x46726565, '0', '2022-09-09 21:29:15', '2022-09-09 21:29:15', NULL),
(13, 6, 2, '611092022143512af8', '0', 0x42616e6b4d7573636174, '100.00', '2022-09-11 14:37:07', '2022-09-11 14:37:07', NULL),
(14, 6, 2, '611092022143746a5a', '0', 0x42616e6b4d7573636174, '100.00', '2022-09-11 14:38:57', '2022-09-11 14:38:57', NULL),
(15, 6, 2, '611092022144235ade', '0', 0x42616e6b4d7573636174, '100.00', '2022-09-11 14:43:16', '2022-09-11 14:43:16', NULL),
(16, 17, 1, '1714092022213631a7e', '0', 0x46726565, '0', '2022-09-14 23:06:33', '2022-09-14 23:06:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1. Ownership of responsibilities is more valued than talent and skills: Hitesh Singla, Square Yards...', 'Hitesh Singla, Co-founder, and CIO, Square Yards, dishes on his digital transformation journey with the company and shares his early career path with technology.1', '2022-05-17 12:07:03', '2022-05-17 12:07:03', NULL),
(2, 'Achieve your goals, never quit and be humble: Ravinder Arora', 'Ravinder Arora, Global CISO Infogain, has had an extraordinary career. Coming from the small town of Haryana, and ended up becoming the most prestigious CISO of the country, his journey has been only of dreams.', '2022-05-17 12:07:03', '2022-05-17 12:07:03', NULL),
(3, 'Change is a step towards opportunity: Gautam Garg, PepsiCo', 'Gautam Garg, Sr Director & CIO at PepsiCo, speaks on his 21 years journey at the company and shares his future goals for the upcoming years.', '2022-05-17 12:07:03', '2022-05-17 12:07:03', NULL),
(4, 'I am very happily unsatisfied: upGrad’s Rohit Dhar', 'Change is not welcoming unless you share the vision & rationale with a positive impact, feels Rohit Dhar, President - Product, Data, Design, Technology & Content (PDTC) of upGrad.', '2022-05-17 12:07:03', '2022-05-17 12:07:03', NULL),
(5, 'Recommended summer camp programs:', '“That one time at band camp” became a cliche for a reason: because summer camp is the ultimate source of absurd and wonderful adventures – the kind you can embarrass your grandchildren with for decades to come. Count on plenty of crafting with natural materials, group hiking, and schmoozing with co-eds on your summer camp adventure travel program. The campfire songs and s’mores at the end of each night are just the icing on the cake.', '2022-05-17 12:07:03', '2022-05-17 12:07:03', NULL),
(6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '2022-05-17 12:07:03', '2022-05-17 12:07:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `order_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 Bokking releated data 1 subscrion releated data',
  `transaction_id` varchar(255) DEFAULT NULL,
  `type` varchar(100) NOT NULL COMMENT 'User type',
  `transaction_type` varchar(200) NOT NULL COMMENT 'Booking or subscription',
  `method` varchar(100) NOT NULL COMMENT 'Oman Debit Card/Wire Transfer ',
  `status` varchar(100) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_type`, `transaction_id`, `type`, `transaction_type`, `method`, `status`, `price`, `create_at`, `updated_at`) VALUES
(1, '3', '1', '305092022152742ada', 'Subsreption', 'Booking', 'WireTransfer', 'success', '120.00', '2022-09-05 11:29:14', '2022-09-05 11:29:14'),
(4, '3', '1', '306092022010956a04', 'Subsreption', 'Booking', 'WireTransfer', 'success', '30.00', '2022-09-05 19:40:05', '2022-09-05 19:40:05'),
(7, '3', '1', '306092022074936aa8', 'Subsreption', 'Booking', 'WireTransfer', 'success', '60.00', '2022-09-06 03:49:40', '2022-09-06 03:49:40'),
(9, '3', '0', '306092022075038aa2', 'Booking', 'Booking', 'WireTransfer', 'success', '60.00', '2022-09-06 03:50:42', '2022-09-06 03:50:42'),
(10, '3', '1', '307092022135226af0', 'Subsreption', 'User buy Platinum', 'BankMuscat', 'success', '150.00', '2022-09-07 09:53:09', '2022-09-07 09:53:09'),
(11, '3', '0', '308092022125931a7a', 'Booking', 'Booking', 'BankMuscat', 'success', '120.00', '2022-09-08 09:00:09', '2022-09-08 09:00:09'),
(12, '3', '0', '308092022130018af2', 'Booking', 'Booking', 'BankMuscat', 'success', '120.00', '2022-09-08 09:00:34', '2022-09-08 09:00:34'),
(13, '3', '0', '308092022130528a6c', 'Booking', 'Booking', 'BankMuscat', 'success', '30.00', '2022-09-08 09:05:37', '2022-09-08 09:05:37'),
(14, '3', '1', '308092022154027aa6', 'Subsreption', 'Booking', 'BankMuscat', 'success', '90.00', '2022-09-08 10:10:48', '2022-09-08 10:10:48'),
(15, '3', '0', '308092022203620a9a', 'Booking', 'Booking', 'BankMuscat', 'success', '30.00', '2022-09-08 15:06:56', '2022-09-08 15:06:56'),
(16, '3', '0', '308092022203807a16', 'Booking', 'Booking', 'BankMuscat', 'success', '30.00', '2022-09-08 15:10:41', '2022-09-08 15:10:41'),
(18, '3', '0', '308092022201947af6', 'Booking', 'Booking', 'BankMuscat', 'success', '30.00', '2022-09-08 16:19:54', '2022-09-08 16:19:54'),
(19, '4', '1', '408092022225331a8b', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-08 18:53:32', '2022-09-08 18:53:32'),
(20, '5', '1', '508092022230711aa3', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-08 19:07:12', '2022-09-08 19:07:12'),
(21, '6', '1', '608092022231136af5', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-08 19:11:37', '2022-09-08 19:11:37'),
(22, '7', '1', '709092022021706a4f', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-08 20:47:07', '2022-09-08 20:47:07'),
(23, '7', '1', '709092022022041a71', 'Subsreption', 'User buy Advanced', 'BankMuscat', 'success', '100.00', '2022-09-08 20:51:02', '2022-09-08 20:51:02'),
(24, '8', '1', '809092022022529ae0', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-08 20:55:30', '2022-09-08 20:55:30'),
(25, '10', '1', '1009092022023650ab5', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-08 21:06:51', '2022-09-08 21:06:51'),
(26, '6', '0', '609092022094814ac6', 'Booking', 'Booking', 'PayOnArrival', 'success', '150.00', '2022-09-09 05:49:57', '2022-09-09 05:49:57'),
(27, '6', '0', '609092022094814ac6', 'Booking', 'Booking', 'PayOnArrival', 'success', '150.00', '2022-09-09 05:49:57', '2022-09-09 05:49:57'),
(28, '6', '0', '609092022144612acf', 'Booking', 'Booking', 'PayOnArrival', 'success', '50.00', '2022-09-09 10:46:38', '2022-09-09 10:46:38'),
(29, '6', '0', '609092022144612acf', 'Booking', 'Booking', 'PayOnArrival', 'success', '50.00', '2022-09-09 10:46:40', '2022-09-09 10:46:40'),
(30, '10', '0', '1009092022200803aef', 'Booking', 'Booking', 'PayOnArrival', 'success', '22.00', '2022-09-09 14:38:08', '2022-09-09 14:38:08'),
(31, '10', '0', '1009092022200803aef', 'Booking', 'Booking', 'PayOnArrival', 'success', '22.00', '2022-09-09 14:38:08', '2022-09-09 14:38:08'),
(32, '10', '1', '1009092022200907a4b', 'Subsreption', 'User buy Advanced', 'BankMuscat', 'success', '100.00', '2022-09-09 14:39:20', '2022-09-09 14:39:20'),
(33, '6', '0', '609092022191747aac', 'Booking', 'Booking', 'BankMuscat', 'success', '100.00', '2022-09-09 15:17:56', '2022-09-09 15:17:56'),
(34, '12', '1', '1209092022195915a7e', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-09 15:59:15', '2022-09-09 15:59:15'),
(35, '6', '0', '611092022114033a2e', 'Booking', 'Booking', 'PayOnArrival', 'success', '80.00', '2022-09-11 07:40:38', '2022-09-11 07:40:38'),
(36, '6', '0', '611092022114033a2e', 'Booking', 'Booking', 'PayOnArrival', 'success', '80.00', '2022-09-11 07:40:38', '2022-09-11 07:40:38'),
(37, '6', '1', '611092022143512af8', 'Subsreption', 'User buy Advanced', 'BankMuscat', 'success', '100.00', '2022-09-11 09:07:07', '2022-09-11 09:07:07'),
(38, '6', '1', '611092022143746a5a', 'Subsreption', 'User buy Advanced', 'BankMuscat', 'success', '100.00', '2022-09-11 09:08:57', '2022-09-11 09:08:57'),
(39, '6', '0', '611092022144022ab3', 'Booking', 'Booking', 'BankMuscat', 'success', '30.00', '2022-09-11 09:12:04', '2022-09-11 09:12:04'),
(40, '6', '1', '611092022144235ade', 'Subsreption', 'User buy Advanced', 'BankMuscat', 'success', '100.00', '2022-09-11 09:13:16', '2022-09-11 09:13:16'),
(41, '6', '0', '611092022160458a76', 'Booking', 'Booking', 'BankMuscat', 'success', '80.00', '2022-09-11 12:05:21', '2022-09-11 12:05:21'),
(42, '6', '0', '611092022230105ad4', 'Booking', 'Booking', 'PayOnArrival', 'success', '80.00', '2022-09-11 19:01:09', '2022-09-11 19:01:09'),
(43, '6', '0', '611092022230105ad4', 'Booking', 'Booking', 'PayOnArrival', 'success', '80.00', '2022-09-11 19:01:10', '2022-09-11 19:01:10'),
(44, '6', '0', '612092022143608a49', 'Booking', 'Booking', 'PayOnArrival', 'success', '45.00', '2022-09-12 10:36:15', '2022-09-12 10:36:15'),
(45, '6', '0', '612092022143608a49', 'Booking', 'Booking', 'PayOnArrival', 'success', '45.00', '2022-09-12 10:36:15', '2022-09-12 10:36:15'),
(46, '6', '0', '612092022145354a56', 'Booking', 'Booking', 'PayOnArrival', 'success', '30.00', '2022-09-12 10:54:33', '2022-09-12 10:54:33'),
(47, '6', '0', '612092022145354a56', 'Booking', 'Booking', 'PayOnArrival', 'success', '30.00', '2022-09-12 10:54:34', '2022-09-12 10:54:34'),
(48, '6', '0', '612092022150454a71', 'Booking', 'Booking', 'PayOnArrival', 'success', '22.00', '2022-09-12 11:04:56', '2022-09-12 11:04:56'),
(49, '6', '0', '612092022150454a71', 'Booking', 'Booking', 'PayOnArrival', 'success', '22.00', '2022-09-12 11:04:57', '2022-09-12 11:04:57'),
(50, '17', '1', '1714092022213631a7e', 'Subsreption', 'User buy Startup', 'Free', 'success', '0', '2022-09-14 17:36:33', '2022-09-14 17:36:33'),
(51, '17', '0', '1717092022112136a51', 'Booking', 'Booking', 'PayOnArrival', 'success', '4000.00', '2022-09-17 07:21:38', '2022-09-17 07:21:38'),
(52, '17', '0', '1717092022112136a51', 'Booking', 'Booking', 'PayOnArrival', 'success', '4000.00', '2022-09-17 07:21:38', '2022-09-17 07:21:38'),
(53, '17', '0', '1718092022142030af6', 'Booking', 'Booking', 'PayOnArrival', 'success', '50.00', '2022-09-18 10:20:32', '2022-09-18 10:20:32'),
(54, '17', '0', '1718092022142030af6', 'Booking', 'Booking', 'PayOnArrival', 'success', '50.00', '2022-09-18 10:20:33', '2022-09-18 10:20:33'),
(55, '17', '0', '1720092022002459aee', 'Booking', 'Booking', 'PayOnArrival', 'success', '50.00', '2022-09-19 20:25:01', '2022-09-19 20:25:01'),
(56, '17', '0', '1720092022002459aee', 'Booking', 'Booking', 'PayOnArrival', 'success', '50.00', '2022-09-19 20:25:02', '2022-09-19 20:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `users_role` enum('1','2','3') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '3' COMMENT '''1''=>''Admin'',''2''=>''Vendor'',''3''=>''Customer''',
  `profile_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `height` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `weight` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `region_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `city_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `now_in` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mobile_verified_at` datetime DEFAULT NULL,
  `dob` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'male',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `nationality_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT '1',
  `app_notification` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `points` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `health_conditions` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `health_conditions_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `mobile_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '1' COMMENT '''0'' Inactive , ''1'' Active, ''2'' Decline',
  `added_from` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1=APP,0=WEB',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `device_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_role`, `profile_image`, `name`, `height`, `weight`, `password`, `email`, `country_id`, `region_id`, `city_id`, `now_in`, `mobile`, `mobile_verified_at`, `dob`, `gender`, `language_id`, `nationality_id`, `currency_id`, `app_notification`, `points`, `health_conditions`, `health_conditions_id`, `email_verified_at`, `mobile_code`, `remember_token`, `status`, `added_from`, `created_at`, `updated_at`, `deleted_at`, `username`, `first_name`, `last_name`, `device_id`) VALUES
(1, '1', '20220405000947-Screenshot_20220226-162200_Samsung Internet.png', 'Admin', NULL, NULL, '$2y$10$rB2GIm4PGt6CNEePoWE40ev/xFZOa1uCJ3dcdGu7PffZnhj4lbuU2', 'admin@gmail.com', 1, NULL, '1', NULL, '9020202020', NULL, '1993-05-04', 'male', 1, '1', 1, '1', '0', '1,4,6,7,8,9,10,11,12,13,14', NULL, '2021-06-17 12:34:39', '+968', 'sOiWRK8c1tGOjrs4N4Mi4aBox3UKxbeLw2FqCqJHajn6VpveC0NCPaNTLqDy', '1', 0, NULL, '2022-04-03 09:31:18', NULL, NULL, NULL, NULL, ''),
(17, '2', 'profile_image/8f12bd82-2f41-45af-b349-e0e615c51815IMG-20210424-WA0035.jpg', 'AdventuresClub', '175 - 180 CM', '58 - 60 KG', '$2y$10$m4IC67n3nqx59a.wPV0kY.pu3qDA3llbB3BlMwmJhRXCMQjsbI1IC', 'info@adventuresclub.net', 2, NULL, NULL, NULL, '96000891', '2022-09-14 23:05:10', '1952-09-20', 'male', 1, '1', 1, NULL, '0', '17,8,6,18', NULL, NULL, '+968', NULL, '1', 1, '2022-09-14 22:34:42', '2022-09-24 16:33:00', NULL, NULL, NULL, NULL, '50dcd20daa55d153'),
(20, '2', 'profile_image/no-image.png', 'Pankaj', '100 - 105 CM', '26 - 28 KG', '$2y$10$IFRMyUwf/8nwc4J7NWHYpeg4/1nNUnNg5XQuQtZQ2eIKvZ/2HW106', 'test@test.com', 2, NULL, NULL, NULL, '8630920347', '2022-09-14 23:37:13', '1952-09-27', 'male', 1, '1', 1, NULL, '0', '10', NULL, NULL, '+91', NULL, '1', 1, '2022-09-14 23:36:25', '2022-09-15 23:23:28', NULL, NULL, NULL, NULL, '50dcd20daa55d153'),
(23, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96123588', NULL, '', 'male', 1, NULL, 1, NULL, '0', '', NULL, NULL, '+968', NULL, '1', 1, '2022-09-21 09:59:10', '2022-09-21 09:59:10', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_details`
--

CREATE TABLE `vendors_details` (
  `vendor_details_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `company_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `geo_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `license_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '''0''=>''No'',''1''=>''Yes''',
  `cr_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cr_number` int(11) NOT NULL,
  `cr_copy` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `payment_mode` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_package`
--

CREATE TABLE `vendor_package` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visited_location`
--

CREATE TABLE `visited_location` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `destination_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `destination_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `geo_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `destination_address` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dest_mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dest_website` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dest_description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_approved` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '0 requested ,1 approved 2 decline',
  `latitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visited_location`
--

INSERT INTO `visited_location` (`id`, `user_id`, `destination_image`, `destination_name`, `destination_type`, `geo_location`, `destination_address`, `dest_mobile`, `dest_website`, `dest_description`, `is_approved`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 17, 'destination_image/destination_image1663268805.jpg', 'Meshaig', 'Paramotor', 'Oman', 'Mashaiq', '96123588', 'universal-skills.com', 'badaralsahi@gmail.not', '0', '23.820317914994', '57.1692694723606', '2022-09-15 19:06:45', '2022-09-15 19:06:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `amount_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT '1=Cash,2=Points,3=Bonus',
  `credit_amt` decimal(8,2) DEFAULT '0.00' COMMENT 'added amount',
  `debit_amt` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT 'deducted amount',
  `current_amt` decimal(8,2) NOT NULL DEFAULT '0.00',
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `weekdays`
--

CREATE TABLE `weekdays` (
  `id` int(10) UNSIGNED NOT NULL,
  `day` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekdays`
--

INSERT INTO `weekdays` (`id`, `day`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday'),
(6, 'Friday'),
(7, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `Id` int(11) NOT NULL,
  `weightName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`Id`, `weightName`, `deleted_at`, `created_at`, `updated_at`) VALUES
(30, '26 - 28 KG', NULL, '2022-05-04 18:13:21', '2022-05-04 18:13:21'),
(31, '28 - 30 KG', NULL, '2022-05-04 18:13:42', '2022-05-04 18:13:42'),
(32, '30 - 32 KG', NULL, '2022-05-04 18:13:59', '2022-05-04 18:13:59'),
(33, '32 - 34 KG', NULL, '2022-05-04 18:14:28', '2022-05-04 18:14:28'),
(34, '34 - 36 KG', NULL, '2022-05-04 18:14:50', '2022-05-04 18:14:50'),
(35, '36 - 38 KG', NULL, '2022-05-04 18:15:07', '2022-05-04 18:15:07'),
(36, '38 - 40 KG', NULL, '2022-05-04 18:15:27', '2022-05-04 18:15:27'),
(37, '40 - 42 KG', NULL, '2022-05-04 18:15:45', '2022-05-04 18:15:45'),
(38, '42 - 44 KG', NULL, '2022-05-04 18:16:04', '2022-05-04 18:16:04'),
(39, '44 - 46 KG', NULL, '2022-05-04 18:16:21', '2022-05-04 18:16:21'),
(40, '46 - 48 KG', NULL, '2022-05-04 18:16:42', '2022-05-04 18:16:42'),
(41, '48 - 50 KG', NULL, '2022-05-04 18:16:57', '2022-05-04 18:16:57'),
(42, '50 - 52 KG', NULL, '2022-05-04 18:17:52', '2022-05-04 18:17:52'),
(43, '52 - 54 KG', NULL, '2022-05-04 18:18:09', '2022-05-04 18:18:09'),
(45, '54 - 56 KG', NULL, '2022-05-04 18:19:04', '2022-05-04 18:19:04'),
(46, '56 - 58 KG', NULL, '2022-05-04 18:19:22', '2022-05-04 18:19:22'),
(47, '58 - 60 KG', NULL, '2022-05-04 18:19:56', '2022-05-04 18:19:56'),
(48, '60 - 62 KG', NULL, '2022-05-04 18:20:20', '2022-05-04 18:20:20'),
(49, '62 - 64 KG', NULL, '2022-05-04 18:20:38', '2022-05-04 18:20:38'),
(50, '64 - 66 KG', NULL, '2022-05-04 18:21:22', '2022-05-04 18:21:22'),
(51, '66 - 68 KG', NULL, '2022-05-04 18:21:45', '2022-05-04 18:21:45'),
(52, '68 - 70 KG', NULL, '2022-05-04 18:22:03', '2022-05-04 18:22:03'),
(53, '70 - 72 KG', NULL, '2022-05-04 18:22:55', '2022-05-04 18:22:55'),
(54, '72 - 74 KG', NULL, '2022-05-04 18:23:11', '2022-05-04 18:23:11'),
(55, '74 - 76 KG', NULL, '2022-05-04 18:23:33', '2022-05-04 18:23:33'),
(56, '76 - 78 KG', NULL, '2022-05-04 18:24:10', '2022-05-04 18:24:10'),
(57, '78 - 80 KG', NULL, '2022-05-04 18:24:27', '2022-05-04 18:24:27'),
(58, '80 - 82 KG', NULL, '2022-05-04 18:24:41', '2022-05-04 18:24:41'),
(59, '82 - 84 KG', NULL, '2022-05-04 18:24:57', '2022-05-04 18:24:57'),
(60, '84 - 86 KG', NULL, '2022-05-04 18:25:54', '2022-05-04 18:25:54'),
(61, '86 - 88 KG', NULL, '2022-05-04 18:26:08', '2022-05-04 18:26:08'),
(62, '88 - 90 KG', NULL, '2022-05-04 18:26:29', '2022-05-04 18:26:29'),
(63, '90 - 92 KG', NULL, '2022-05-04 18:26:43', '2022-05-04 18:26:43'),
(64, '92 - 94 KG', NULL, '2022-05-04 18:27:00', '2022-05-04 18:27:00'),
(65, '94 - 96 KG', NULL, '2022-05-04 18:27:24', '2022-05-04 18:27:24'),
(66, '96 - 98 KG', NULL, '2022-05-04 18:27:39', '2022-05-04 18:27:39'),
(67, '98 - 100 KG', NULL, '2022-05-04 18:27:58', '2022-05-04 18:27:58'),
(68, '100 - 102 KG', NULL, '2022-05-04 18:28:41', '2022-05-04 18:28:41'),
(69, '102 - 104 KG', NULL, '2022-05-04 18:28:56', '2022-05-04 18:28:56'),
(70, '104 - 106 KG', NULL, '2022-05-04 18:29:12', '2022-05-04 18:29:12'),
(71, '106 - 108 KG', NULL, '2022-05-04 18:29:27', '2022-05-04 18:29:27'),
(72, '108 - 110 KG', NULL, '2022-05-04 18:29:45', '2022-05-04 18:29:45'),
(73, '110 - 112 KG', NULL, '2022-05-04 18:30:02', '2022-05-04 18:30:02'),
(74, '112 - 114 KG', NULL, '2022-05-04 18:30:38', '2022-05-04 18:30:38'),
(75, '114 - 116 KG', NULL, '2022-05-04 18:30:54', '2022-05-04 18:30:54'),
(76, '116 - 118 KG', NULL, '2022-05-04 18:33:35', '2022-05-04 18:33:35'),
(77, '118 - 120 KG', NULL, '2022-05-04 18:34:04', '2022-05-04 18:34:04'),
(78, 'Above 120 KG', NULL, '2022-05-04 18:34:23', '2022-05-04 18:34:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aimed`
--
ALTER TABLE `aimed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `become_partner`
--
ALTER TABLE `become_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactuspurposes`
--
ALTER TABLE `contactuspurposes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_purpose`
--
ALTER TABLE `contact_us_purpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dependency`
--
ALTER TABLE `dependency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `durations`
--
ALTER TABLE `durations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_all_paymentmode`
--
ALTER TABLE `get_all_paymentmode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_conditions`
--
ALTER TABLE `health_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heights`
--
ALTER TABLE `heights`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_reviews`
--
ALTER TABLE `location_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_detail`
--
ALTER TABLE `package_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocode_users`
--
ALTER TABLE `promocode_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_reports`
--
ALTER TABLE `question_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_assignments`
--
ALTER TABLE `role_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_activities`
--
ALTER TABLE `service_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_dependencies`
--
ALTER TABLE `service_dependencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_for`
--
ALTER TABLE `service_for`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_images`
--
ALTER TABLE `service_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_levels`
--
ALTER TABLE `service_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_likes`
--
ALTER TABLE `service_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_offers`
--
ALTER TABLE `service_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_plan`
--
ALTER TABLE `service_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_plan_day_date`
--
ALTER TABLE `service_plan_day_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_programs`
--
ALTER TABLE `service_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_reviews`
--
ALTER TABLE `service_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_sectors`
--
ALTER TABLE `service_sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_service_for`
--
ALTER TABLE `service_service_for`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plan_history`
--
ALTER TABLE `subscription_plan_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_details`
--
ALTER TABLE `vendors_details`
  ADD PRIMARY KEY (`vendor_details_id`);

--
-- Indexes for table `vendor_package`
--
ALTER TABLE `vendor_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visited_location`
--
ALTER TABLE `visited_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekdays`
--
ALTER TABLE `weekdays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `aimed`
--
ALTER TABLE `aimed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `become_partner`
--
ALTER TABLE `become_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contactuspurposes`
--
ALTER TABLE `contactuspurposes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_us_purpose`
--
ALTER TABLE `contact_us_purpose`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `dependency`
--
ALTER TABLE `dependency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `durations`
--
ALTER TABLE `durations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `get_all_paymentmode`
--
ALTER TABLE `get_all_paymentmode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `health_conditions`
--
ALTER TABLE `health_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `heights`
--
ALTER TABLE `heights`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `location_reviews`
--
ALTER TABLE `location_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `package_detail`
--
ALTER TABLE `package_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `promocode_users`
--
ALTER TABLE `promocode_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question_reports`
--
ALTER TABLE `question_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `role_assignments`
--
ALTER TABLE `role_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `service_activities`
--
ALTER TABLE `service_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `service_dependencies`
--
ALTER TABLE `service_dependencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `service_for`
--
ALTER TABLE `service_for`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_images`
--
ALTER TABLE `service_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `service_levels`
--
ALTER TABLE `service_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `service_likes`
--
ALTER TABLE `service_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_offers`
--
ALTER TABLE `service_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service_plan`
--
ALTER TABLE `service_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service_plan_day_date`
--
ALTER TABLE `service_plan_day_date`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `service_programs`
--
ALTER TABLE `service_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `service_reviews`
--
ALTER TABLE `service_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `service_sectors`
--
ALTER TABLE `service_sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `service_service_for`
--
ALTER TABLE `service_service_for`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subscription_plan_history`
--
ALTER TABLE `subscription_plan_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `vendors_details`
--
ALTER TABLE `vendors_details`
  MODIFY `vendor_details_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor_package`
--
ALTER TABLE `vendor_package`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visited_location`
--
ALTER TABLE `visited_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `weekdays`
--
ALTER TABLE `weekdays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
