-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2019 at 02:05 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itscient_babapayroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `its_attendence`
--

CREATE TABLE `its_attendence` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `in_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `out_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `leave_status` int(11) DEFAULT NULL COMMENT '1=present,0=absent,2=leave',
  `shift_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `late` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overtime` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `leave_type` int(11) DEFAULT NULL COMMENT ' 	''1''=>''Late'',''2''=>''Short'',''3''=>''Half'',''0''=>''Absent'' 	',
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_attendence`
--

INSERT INTO `its_attendence` (`id`, `org_id`, `emp_id`, `attendance_date`, `in_time`, `out_time`, `leave_status`, `shift_name`, `late`, `overtime`, `leave_type`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 13, '2019-07-16', '4:45 PM', '4:45 PM', 1, 'Day', '12:00 AM', '12:00 AM', NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-12 13:19:53', NULL),
(2, 1, 14, '2019-07-16', '9:00', '6:70', 1, 'Day', '00:00', '00:00', NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-12 13:19:54', NULL),
(11, 1, 13, '2019-07-16', '4:45 PM', '4:45 PM', 1, 'Day', '12:00 AM', '12:00 AM', NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-16 05:48:49', NULL),
(12, 1, 14, '2019-07-16', '9:00', '6:70', 1, 'Day', '00:00', '00:00', NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-16 05:48:49', NULL),
(15, 1, 13, '2019-07-17', '11:15 AM', '11:15 AM', 1, 'Day', NULL, NULL, NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-17 05:37:24', NULL),
(16, 1, 14, '2019-07-17', '11:15 AM', '11:15 AM', 1, 'Day', NULL, NULL, NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-17 05:37:24', NULL),
(17, 1, 15, '2019-07-17', '11:15 AM', '11:15 AM', 1, 'Day', NULL, NULL, NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-17 05:37:24', NULL),
(18, 1, 16, '2019-07-17', '11:15 AM', '11:15 AM', 1, 'Day', NULL, NULL, NULL, NULL, NULL, NULL, '::1', 1, NULL, '2019-07-17 05:37:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `its_blood_group`
--

CREATE TABLE `its_blood_group` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `blood_group` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_blood_group`
--

INSERT INTO `its_blood_group` (`id`, `org_id`, `blood_group`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 10, 'O+', 1, 1, NULL, NULL, NULL, NULL, NULL, '2019-07-09 11:42:29', '2019-07-09 16:42:29'),
(4, 11, 'Ab Positive', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02 17:26:28', '2019-07-03 07:31:11'),
(6, 11, 'A++', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 12:59:44', '2019-07-03 18:02:03'),
(8, 1, 'A', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:36:03', '2019-07-17 09:06:03'),
(9, 1, 'B', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:36:08', '2019-07-17 09:06:08'),
(10, 1, 'AB', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:36:19', '2019-07-17 09:06:19'),
(11, 1, 'O', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:36:28', '2019-07-17 09:06:28'),
(12, 1, 'O -', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:37:44', '2019-07-17 09:07:44'),
(13, 1, 'O +', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:38:01', '2019-07-17 09:08:01'),
(14, 1, 'A -', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:38:20', '2019-07-17 09:08:20'),
(15, 1, 'A +', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:38:32', '2019-07-17 09:08:32'),
(16, 1, 'B -', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:38:41', '2019-07-17 09:08:41'),
(17, 1, 'B +', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:38:56', '2019-07-17 09:08:56'),
(18, 1, 'AB -', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:39:12', '2019-07-17 09:09:12'),
(19, 1, 'AB +', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 14:39:26', '2019-07-17 09:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `its_cities`
--

CREATE TABLE `its_cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '1 ="Delete"',
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_cities`
--

INSERT INTO `its_cities` (`id`, `country_id`, `state_id`, `city`, `status`, `is_deleted`, `ip_address`, `modified_date`, `created_date`) VALUES
(1, 1, 1, 'noida', 1, 0, '', '2019-07-01 09:58:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `its_company_working_setting`
--

CREATE TABLE `its_company_working_setting` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `working_mode` int(11) NOT NULL COMMENT '''0''=>''flexible'',''1''=>''regular''',
  `salary_generation_mode` int(11) NOT NULL COMMENT '''0''=>''default'',''1''=>''month wise''',
  `weekly_off_day_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `relaxation_min` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  `relaxation_start_time` time DEFAULT NULL,
  `relaxation_end_time` time DEFAULT NULL,
  `work_hour` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_leave_min` int(11) DEFAULT NULL,
  `half_day_min` int(11) DEFAULT NULL,
  `full_day_min` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_countries`
--

CREATE TABLE `its_countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone_code` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '1 =''Delete''',
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_countries`
--

INSERT INTO `its_countries` (`id`, `code`, `country`, `phone_code`, `status`, `is_deleted`, `ip_address`, `modified_date`, `created_date`) VALUES
(1, '1', 'India', 91, 1, 0, '', '2019-07-01 10:03:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `its_deduction_head`
--

CREATE TABLE `its_deduction_head` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `org_location_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `deduction_head` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deduction_value` int(11) DEFAULT NULL,
  `value_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_deduction_head`
--

INSERT INTO `its_deduction_head` (`id`, `org_id`, `org_location_id`, `division_id`, `grade_id`, `department_id`, `designation_id`, `deduction_head`, `deduction_value`, `value_type`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(1, 1, NULL, NULL, NULL, 4, 1, 'Professional Tax', 2000, 1, 1, NULL, NULL, NULL, NULL, 1, 1, '2019-07-18', '2019-07-18 15:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `its_departments`
--

CREATE TABLE `its_departments` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depart_short_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_departments`
--

INSERT INTO `its_departments` (`id`, `org_id`, `department`, `depart_short_name`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(4, 1, 'IT', 'PHP', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:56:03', '2019-07-17 14:26:03'),
(5, 1, 'IT', 'Marketing', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:55:54', '2019-07-17 14:25:54'),
(7, 1, 'IT', 'Designer', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:59:00', '2019-07-17 14:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `its_designation`
--

CREATE TABLE `its_designation` (
  `id` int(11) NOT NULL,
  `download_id` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desig_short_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_designation`
--

INSERT INTO `its_designation` (`id`, `download_id`, `org_id`, `department_id`, `designation`, `desig_short_name`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(1, NULL, 1, 1, 'Sr. Php Developer', 'SRP', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-11 13:30:12', '2019-07-11 19:00:12'),
(2, NULL, 1, 3, 'Digital Marketing', 'DM', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 06:03:59', '2019-07-12 11:33:59'),
(3, NULL, 1, 2, 'Team Leader', 'TL', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12 06:04:18', '2019-07-12 11:34:18'),
(4, NULL, 1, 4, 'Php Developer', 'Laravel', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:59:32', '2019-07-17 14:29:32'),
(5, NULL, 1, 4, 'Digital Marketing', 'D Marketing', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:00:14', '2019-07-17 14:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `its_document`
--

CREATE TABLE `its_document` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `marksheet` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certificate` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary_slip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `resume` binary(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_document_checklist`
--

CREATE TABLE `its_document_checklist` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `branch_location_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `document_checklist` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(100) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_document_checklist_certificate`
--

CREATE TABLE `its_document_checklist_certificate` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `branch_location_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `document_checklist_cer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(100) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_document_details`
--

CREATE TABLE `its_document_details` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `document_org_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_email_branch_template`
--

CREATE TABLE `its_email_branch_template` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `form_name` int(11) NOT NULL,
  `subject` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `template` longtext COLLATE utf8_unicode_ci NOT NULL,
  `short_code` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_email_setting`
--

CREATE TABLE `its_email_setting` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `cc_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `network_email_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `smtp_ssl` int(11) NOT NULL COMMENT '''0'' No , ''1'' Yes ',
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_email_template`
--

CREATE TABLE `its_email_template` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '''0'' General,''1'' OPD, ''2 ''IPD, ''3'' Pathology,''4'' Expenses,''5''Medicine',
  `email_type` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `inherit_status` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `ip_address` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_employees`
--

CREATE TABLE `its_employees` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `reporting_id` int(11) DEFAULT NULL,
  `simulation_id` int(11) DEFAULT NULL,
  `emp_code_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `reg_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_type_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relation_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emer_contact_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emer_contact_person` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `official_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(100) COLLATE utf8_unicode_ci DEFAULT '0000-00-00',
  `is_department_head` int(11) DEFAULT NULL,
  `probation_period` int(11) DEFAULT NULL,
  `joining_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT '0000-00-00',
  `leave_applicable_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT '0000-00-00',
  `pan_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adhar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood_group_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `anniversary` varchar(100) COLLATE utf8_unicode_ci DEFAULT '0000-00-00',
  `age` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  `merital_status` int(11) DEFAULT NULL COMMENT '''1'' Single , ''2'' Married',
  `qualification_id` int(11) DEFAULT NULL,
  `relation_id` int(11) DEFAULT NULL,
  `rel_simulation_id` int(11) DEFAULT NULL,
  `fathers_simulation_id` int(11) DEFAULT NULL,
  `probation_period_duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_second` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_third` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary` float(15,2) DEFAULT NULL,
  `ctc` int(50) DEFAULT NULL,
  `account_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `esic_no` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `epf_no` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gratuity_no` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ifsc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '''0'' Inactive , ''1'' Active',
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anni_sms_year` year(4) DEFAULT NULL,
  `anni_email_send_year` year(4) DEFAULT NULL,
  `birth_sms_year` year(4) DEFAULT NULL,
  `birth_email_year` year(4) DEFAULT NULL,
  `mail_sms_status` tinyint(1) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_employees`
--

INSERT INTO `its_employees` (`id`, `org_id`, `department_id`, `designation_id`, `reporting_id`, `simulation_id`, `emp_code_id`, `shift_id`, `reg_no`, `emp_type_id`, `name`, `father_name`, `relation_type`, `contact_no`, `emer_contact_no`, `emer_contact_person`, `official_email`, `dob`, `is_department_head`, `probation_period`, `joining_date`, `leave_applicable_date`, `pan_no`, `adhar`, `blood_group_id`, `anniversary`, `age`, `sex`, `merital_status`, `qualification_id`, `relation_id`, `rel_simulation_id`, `fathers_simulation_id`, `probation_period_duration`, `email`, `address`, `address_second`, `address_third`, `current_address`, `city_id`, `state_id`, `country_id`, `postal_code`, `salary`, `ctc`, `account_number`, `esic_no`, `epf_no`, `gratuity_no`, `bank_name`, `ifsc`, `status`, `photo`, `anni_sms_year`, `anni_email_send_year`, `birth_sms_year`, `birth_email_year`, `mail_sms_status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `updated_at`, `created_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, 'ITS00007', NULL, 'ITR00007', NULL, 'RANVEER', 'Ram', NULL, '9758727788', '7409969352', 'Ram singh', 'amit.it@trendydeals.in', '17-07-2019', 0, NULL, '03-07-2019', '0000-00-00', '454554', '4545454', 'Choose Blood Group', '09-07-2019', NULL, '0', 2, NULL, NULL, NULL, NULL, NULL, 'amit.it@trendydeals.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, '545444454', '45454454', '454544445', '4545544', 'SBI', 'IFSC0000610', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '192.168.1.6', 1, NULL, '2019-07-22', '2019-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `its_employee_appraisel`
--

CREATE TABLE `its_employee_appraisel` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `appraisel_document` varchar(255) NOT NULL,
  `filled_appraisel_document` varchar(255) NOT NULL,
  `rm_filled_document` varchar(255) NOT NULL,
  `probation_form` varchar(255) NOT NULL,
  `document_status` int(11) NOT NULL,
  `probation_document_status` int(11) NOT NULL,
  `reporting_id` int(11) NOT NULL,
  `upload_date` date NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_employee_appraisel_salary`
--

CREATE TABLE `its_employee_appraisel_salary` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `increased_salary` varchar(11) NOT NULL,
  `decreased_salary` varchar(255) NOT NULL,
  `previous_salary` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `probation_document_status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_employee_code`
--

CREATE TABLE `its_employee_code` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `branch_location_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `prefix` varchar(100) DEFAULT NULL,
  `numeric_value` int(11) DEFAULT NULL,
  `status` int(100) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_employee_code`
--

INSERT INTO `its_employee_code` (`id`, `org_id`, `branch_location_id`, `division_id`, `grade_id`, `departments_id`, `prefix`, `numeric_value`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 10, 10, 10, 10, 10, 'Manager Prefix', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-10 05:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `its_employee_probation`
--

CREATE TABLE `its_employee_probation` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `probation_document` varchar(255) NOT NULL,
  `filled_probation_document` varchar(255) NOT NULL,
  `rm_filled_document` varchar(255) NOT NULL,
  `document_status` int(11) NOT NULL,
  `reporting_id` int(11) NOT NULL,
  `probation_period` int(11) NOT NULL,
  `probation_complete_date` date NOT NULL,
  `joining_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `upload_date` date NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_emp_calculated_salary`
--

CREATE TABLE `its_emp_calculated_salary` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `net_earning` varchar(100) NOT NULL,
  `leave_salary` varchar(100) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `total_leave` int(11) NOT NULL,
  `total_availed` int(11) NOT NULL,
  `lwp` varchar(100) NOT NULL,
  `net_employee_salary` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `bonus` varchar(100) NOT NULL,
  `incentive` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_emp_qualification`
--

CREATE TABLE `its_emp_qualification` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `emp_code` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  `board` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachedment` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_emp_qualification`
--

INSERT INTO `its_emp_qualification` (`id`, `org_id`, `emp_id`, `emp_code`, `qualification_id`, `board`, `year`, `desc`, `attachedment`, `created_by`, `ip_address`, `created_at`) VALUES
(9, 1, NULL, 'ITS00008', 26, 'saxas', '09-07-2019', 'xsaxsa', NULL, 1, '192.168.1.6', '2019-07-23'),
(16, 1, NULL, 'ITS00008', 24, 'up board', '08-07-2019', 'dddd', NULL, 1, '192.168.1.6', '2019-07-26'),
(17, 1, NULL, 'ITS00008', 26, 'sxsxssxss', '09-07-2019', 'xsxss', NULL, 1, '192.168.1.6', '2019-07-26'),
(18, 1, NULL, 'ITS00008', 27, 'xsxss', '15-07-2019', 'sxxs', NULL, 1, '192.168.1.6', '2019-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `its_emp_shift`
--

CREATE TABLE `its_emp_shift` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `shift` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_emp_type`
--

CREATE TABLE `its_emp_type` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `emp_type` varchar(100) DEFAULT NULL,
  `emp_type_short_name` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_emp_type`
--

INSERT INTO `its_emp_type` (`id`, `emp_id`, `org_id`, `emp_type`, `emp_type_short_name`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(8, NULL, 10, 'Day Sift', 'DS', 0, NULL, NULL, NULL, '::1', 10, 10, '2019-07-09 18:43:50', '2019-07-09 13:43:50'),
(9, NULL, 10, 'Night Shift', 'NS1', NULL, NULL, NULL, NULL, '192.168.1.5', 10, 10, '2019-07-04 17:07:34', '2019-07-04 12:07:00'),
(10, NULL, 10, 'Full Time', 'FT', 1, NULL, NULL, NULL, '192.168.1.5', 10, 10, '2019-07-04 17:12:10', '2019-07-04 12:07:20'),
(14, NULL, 1, 'Full Time', 'FT', 1, NULL, NULL, NULL, '::1', 1, 1, '2019-07-17 09:50:48', '2019-07-17 15:20:48'),
(15, NULL, 1, 'Part Time', 'PT', 1, NULL, NULL, NULL, '::1', 1, 1, '2019-07-17 09:51:08', '2019-07-17 15:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `its_emp_work_exp`
--

CREATE TABLE `its_emp_work_exp` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `emp_code` varchar(111) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `its_emp_work_exp`
--

INSERT INTO `its_emp_work_exp` (`id`, `org_id`, `emp_id`, `emp_code`, `qualification_id`, `company`, `title`, `from_date`, `end_date`, `desc`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `created_at`, `updated_at`) VALUES
(9, 1, NULL, 'ITS00008', NULL, 'Amazon', 'asdas', '08-07-2019', '16-07-2019', 'dsadsa', NULL, NULL, NULL, NULL, '::1', 1, '2019-07-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `its_full_and_final`
--

CREATE TABLE `its_full_and_final` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `resignation_date` date NOT NULL,
  `joining_date` date NOT NULL,
  `no_dues_form` blob NOT NULL,
  `rehiring` int(11) NOT NULL,
  `full_and_final_date` date NOT NULL,
  `last_working_day` date NOT NULL,
  `notice_by` int(11) NOT NULL COMMENT '1=>employee,2=>employer',
  `notice_period_value` int(11) NOT NULL,
  `notice_period_type` int(11) NOT NULL COMMENT '1=>days,2=>week, 3=>month',
  `service_period_value` int(11) NOT NULL,
  `service_period_type` int(11) NOT NULL COMMENT '1=>days,2=>week,3=>month, 4=>year',
  `ctc_value` int(11) NOT NULL,
  `ctc_type` int(11) NOT NULL COMMENT '1=>INR,2=>USD',
  `in_hand_value` int(11) NOT NULL,
  `in_hand_type` int(11) NOT NULL COMMENT '1=>INR,2=>USD',
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_holiday_master`
--

CREATE TABLE `its_holiday_master` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `holiday` varchar(100) DEFAULT NULL,
  `from_date` varchar(100) DEFAULT NULL,
  `end_date` varchar(100) DEFAULT NULL,
  `final_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_holiday_master`
--

INSERT INTO `its_holiday_master` (`id`, `org_id`, `holiday`, `from_date`, `end_date`, `final_date`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(1, 10, 'day  day shift', '2019-11-07', '2019-12-08', NULL, 0, NULL, NULL, NULL, '::1', 10, 10, '2019-07-09 19:29:28', '2019-07-09 19:29:28'),
(3, NULL, 'day shift', '2019-07-04', '2019-07-04', NULL, 1, NULL, NULL, NULL, '192.168.1.5', NULL, NULL, '2019-07-04 15:04:49', '2019-07-04 15:04:49'),
(4, 10, 'full Time', '2019-07-04', '2019-07-04', NULL, 1, NULL, NULL, NULL, '192.168.1.5', 10, 10, '2019-07-04 17:13:45', '2019-07-04 17:13:45'),
(5, 10, 'day shift', '2019-07-09', '2019-07-09', NULL, 1, NULL, NULL, NULL, '::1', 10, 10, '2019-07-09 19:30:19', '2019-07-09 19:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `its_hrd`
--

CREATE TABLE `its_hrd` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `hrd` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_hr_employee_document`
--

CREATE TABLE `its_hr_employee_document` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_org_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_income_head`
--

CREATE TABLE `its_income_head` (
  `id` int(11) NOT NULL,
  `org_id` int(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `income_head` varchar(200) DEFAULT NULL,
  `income_value` int(11) DEFAULT NULL,
  `value_type` int(11) DEFAULT NULL,
  `basic` int(11) DEFAULT NULL,
  `calculate_on` varchar(200) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_income_head`
--

INSERT INTO `its_income_head` (`id`, `org_id`, `department_id`, `designation_id`, `income_head`, `income_value`, `value_type`, `basic`, `calculate_on`, `status`, `created_date`, `modified_date`, `modified_by`, `created_by`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`) VALUES
(1, 1, 4, 1, 'Basic Salary', 65, 0, 1, '1', '1', '2019-07-18 15:13:27', '2019-07-18 15:13:27', 1, 1, NULL, NULL, NULL, '::1'),
(2, 1, 4, 1, 'House Rent Allowance', 15, 0, 1, '0', '1', '2019-07-18 15:13:40', '2019-07-18 15:13:40', 1, 1, NULL, NULL, NULL, '::1'),
(3, 1, 4, 1, 'PF (12% of basic)', 12, 0, 1, '0', '1', '2019-07-18 15:13:48', '2019-07-18 15:13:48', 1, 1, NULL, NULL, NULL, '::1'),
(4, 1, 4, 1, 'Medical insurance', 5, 1, 1, '0', '1', '2019-07-18 15:18:07', '2019-07-18 15:18:07', 1, 1, NULL, NULL, NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `its_interview_type`
--

CREATE TABLE `its_interview_type` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `interview_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_job_interview_list`
--

CREATE TABLE `its_job_interview_list` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `interviewer_name` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `round` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_job_interview_new_candidate`
--

CREATE TABLE `its_job_interview_new_candidate` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `interviewer_name` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `round` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_job_post`
--

CREATE TABLE `its_job_post` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `reporting_id` int(11) NOT NULL,
  `job_id` varchar(100) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `candidate_profile` varchar(255) NOT NULL,
  `job_posted_date` date DEFAULT '0000-00-00',
  `closer_date` date NOT NULL,
  `experience` int(11) NOT NULL,
  `recruitment` int(11) NOT NULL,
  `joining_date` date DEFAULT '0000-00-00',
  `no_of_vacancy` int(11) NOT NULL,
  `min_ctc` int(11) NOT NULL,
  `max_ctc` int(11) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `job_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_job_post_settings`
--

CREATE TABLE `its_job_post_settings` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `min_ctc_status` int(11) NOT NULL,
  `recruitment_status` int(11) NOT NULL,
  `max_ctc_status` int(11) NOT NULL,
  `internally_open` int(11) NOT NULL,
  `emp_name_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_job_schedule_new_candidate`
--

CREATE TABLE `its_job_schedule_new_candidate` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `interview_type` varchar(100) NOT NULL,
  `interview_date` date NOT NULL,
  `interview_time` time NOT NULL,
  `interview_name` varchar(100) NOT NULL,
  `interviewer_name` varchar(100) NOT NULL,
  `candidate_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `job_status` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_leave_application_mail`
--

CREATE TABLE `its_leave_application_mail` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_type` varchar(200) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `r_date` date NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `reporting_id` varchar(11) NOT NULL,
  `reporting_name` varchar(200) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `days` varchar(200) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sent` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `n_status` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_leave_details`
--

CREATE TABLE `its_leave_details` (
  `id` int(20) NOT NULL,
  `org_id` int(20) DEFAULT NULL,
  `emp_code` varchar(50) DEFAULT NULL,
  `applicable_date` date DEFAULT NULL,
  `leave_type` int(11) DEFAULT NULL,
  `no_of_leave` varchar(200) DEFAULT NULL,
  `duration` varchar(200) DEFAULT NULL,
  `carry_forword` varchar(200) DEFAULT NULL,
  `availed` int(11) DEFAULT NULL,
  `lapsed` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `ip_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_leave_details`
--

INSERT INTO `its_leave_details` (`id`, `org_id`, `emp_code`, `applicable_date`, `leave_type`, `no_of_leave`, `duration`, `carry_forword`, `availed`, `lapsed`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted_date`, `deleted_by`, `is_deleted`, `ip_address`) VALUES
(1, 1, 'ITS00008', NULL, 10, '1.5', '3', NULL, NULL, NULL, NULL, '2019-07-23 19:02:47', 1, NULL, NULL, NULL, NULL, NULL, '::1'),
(2, 1, 'ITS00008', NULL, 9, '1.5', '3', NULL, NULL, NULL, NULL, '2019-07-23 19:02:47', 1, NULL, NULL, NULL, NULL, NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `its_leave_master`
--

CREATE TABLE `its_leave_master` (
  `id` int(11) NOT NULL,
  `org_id` int(20) NOT NULL,
  `org_location_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `emp_type_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_type_day` varchar(200) NOT NULL,
  `leave_month` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_leave_type_duration`
--

CREATE TABLE `its_leave_type_duration` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `leave_type` varchar(200) DEFAULT NULL,
  `leave_duration` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_by` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_leave_type_duration`
--

INSERT INTO `its_leave_type_duration` (`id`, `org_id`, `leave_type`, `leave_duration`, `status`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted_date`, `deleted_by`, `is_deleted`, `ip_address`) VALUES
(3, 11, 'sick Leave', NULL, NULL, '2019-07-01 17:30:46', NULL, '2019-07-02 15:23:56', NULL, NULL, NULL, NULL, NULL),
(6, 11, 'Emergency Leave', NULL, NULL, '2019-07-02 15:24:20', NULL, '2019-07-02 15:24:37', NULL, NULL, NULL, NULL, NULL),
(7, 10, 'demos', NULL, 0, '2019-07-09 10:49:51', NULL, '2019-07-09 10:49:51', NULL, NULL, NULL, NULL, NULL),
(9, 1, 'Half Leave', NULL, 1, '2019-07-17 14:32:21', NULL, '2019-07-17 14:32:21', NULL, NULL, NULL, NULL, NULL),
(10, 1, 'Full Leave', NULL, 1, '2019-07-17 14:32:12', NULL, '2019-07-17 14:32:12', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `its_loan`
--

CREATE TABLE `its_loan` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `loan_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loan_amount` int(100) DEFAULT NULL,
  `no_of_installment` int(50) DEFAULT NULL,
  `paymet_start_date` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `installment_amount` int(100) DEFAULT NULL,
  `installment_date` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `loan_account_type` int(11) DEFAULT NULL COMMENT '1= salary acc, 0 = manual pay',
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_mail`
--

CREATE TABLE `its_mail` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `to` varchar(200) NOT NULL,
  `cc` varchar(400) NOT NULL,
  `regarding` varchar(200) NOT NULL,
  `reasons` text NOT NULL,
  `file_name` blob NOT NULL,
  `comment` text NOT NULL,
  `hr_comment` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `reporting_id` varchar(20) NOT NULL,
  `reporting_name` varchar(200) NOT NULL,
  `received` int(11) NOT NULL,
  `n_status` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_mandatory_field`
--

CREATE TABLE `its_mandatory_field` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL COMMENT '1=>company,2=>employee',
  `optional` int(11) NOT NULL COMMENT '''0'' Optional, ''1'' Compalsory',
  `required_field_name` varchar(150) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_mandatory_field_to_mandatory`
--

CREATE TABLE `its_mandatory_field_to_mandatory` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_migrations`
--

CREATE TABLE `its_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `its_new_candidate`
--

CREATE TABLE `its_new_candidate` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` varchar(255) NOT NULL,
  `reporting_id` int(11) NOT NULL,
  `job_unique_id` varchar(100) NOT NULL,
  `simulation_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country_code` int(11) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `gender` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `resume` blob NOT NULL,
  `experience` int(11) NOT NULL,
  `joining_date` date DEFAULT '0000-00-00',
  `current_ctc` int(11) NOT NULL,
  `expected_ctc` int(11) NOT NULL,
  `current_location` varchar(255) NOT NULL,
  `preferred_location` varchar(255) NOT NULL,
  `job_status` int(11) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `send_to_rm` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `notice_period` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_org`
--

CREATE TABLE `its_org` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `org_code` varchar(100) DEFAULT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `contact_person` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `org_type` int(11) DEFAULT 0 COMMENT '1=''Live'' , 0=''Demo''',
  `pf_no` bigint(11) DEFAULT NULL,
  `esic_no` bigint(11) DEFAULT NULL,
  `tax_no` bigint(11) DEFAULT NULL,
  `policy_no` bigint(11) NOT NULL,
  `gratuity_no` bigint(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0 COMMENT '1 = ''Delete''',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `login_status` int(11) DEFAULT 0 COMMENT '1=''Active'' ,0=''Inactive''',
  `status` int(11) DEFAULT 0 COMMENT '1=''Active'' , 0=''Inactive''',
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_org`
--

INSERT INTO `its_org` (`id`, `users_id`, `parent_id`, `org_code`, `org_name`, `contact_no`, `contact_person`, `email`, `address`, `website`, `city_id`, `state_id`, `country_id`, `zipcode`, `photo`, `org_type`, `pf_no`, `esic_no`, `tax_no`, `policy_no`, `gratuity_no`, `start_date`, `end_date`, `is_deleted`, `deleted_by`, `deleted_date`, `login_status`, `status`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_at`, `deleted_at`, `updated_at`) VALUES
(10, 18, NULL, 'ITS2132', 'Amazon1', '7409969352', NULL, 'dempalrajput@gmail.in', 'Jamna Khas, Amroha - 244501', 'http:/amazon.in', 1, 1, 1, 123456, '1562673802.jpg', 1, 1564961651, 1654161, 4654564, 4654654, 5498494, NULL, NULL, 0, NULL, NULL, 0, 0, '::1', NULL, NULL, '2019-07-10 06:39:52', '2019-07-10 17:09:52', NULL, '2019-07-10 17:09:52'),
(11, 19, NULL, 'ITS2132', 'Magic deal', '91445645466565', NULL, 'mantuphp@gmail.com', 'Noida', 'http://localhost/payroll/company', 1, 1, 1, 201301, '1562740858.jpg', 1, 666666, 33333, 7777, 8888, 999994, NULL, NULL, 0, 0, NULL, 1, 1, '::1', NULL, NULL, '2019-07-10 06:40:58', '2019-07-10 17:10:58', NULL, '2019-07-10 17:10:58'),
(12, 20, NULL, 'ITS2132', 'Flipkart', '7409969352', NULL, 'amit.it@trendydeals.in', 'Mohan Nagar, Noida -201502', 'https://www.flipkart.com/', 1, 1, 1, 123456, '1562231357.jpg', 1, 4444444, 555555, 111111, 22222, 3333333, NULL, NULL, 0, 0, NULL, 0, 1, '::1', NULL, NULL, '2019-07-04 10:19:49', '2019-07-04 20:49:51', NULL, '2019-07-04 20:49:51'),
(15, NULL, NULL, 'ITS2132', 'Paatham India', '9311959563', NULL, 'rakesh@paatham.in', '726 Ithum Tower', 'www.paatham.in', 1, 1, 1, 201301, '1562673823.jpg', 1, 4545822, 54556565656, 23145254, 2545254155, 25451252, NULL, NULL, 0, NULL, NULL, 1, 1, '::1', NULL, NULL, '2019-07-09 12:03:43', '2019-07-09 22:33:43', NULL, '2019-07-09 22:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `its_permission_action`
--

CREATE TABLE `its_permission_action` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `attribute` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '''0'' Inactive , ''1'' Active',
  `module_class` varchar(200) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_permission_section`
--

CREATE TABLE `its_permission_section` (
  `id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '''0'' Inactive, ''1'' Active',
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_permission_to_role`
--

CREATE TABLE `its_permission_to_role` (
  `id` int(11) NOT NULL,
  `users_role` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `attribute_val` int(11) NOT NULL,
  `permission_status` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_permission_to_users`
--

CREATE TABLE `its_permission_to_users` (
  `id` int(11) NOT NULL,
  `users_role` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `attribute_val` int(11) NOT NULL,
  `permission_status` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_qualification`
--

CREATE TABLE `its_qualification` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `quali_short_name` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_qualification`
--

INSERT INTO `its_qualification` (`id`, `org_id`, `qualification`, `quali_short_name`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(7, 9, 'Master of computer application', 'MCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02 10:12:24', '2019-06-28 17:40:30'),
(8, 9, 'Master of Science', 'M.SC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02 10:12:33', '2019-06-28 17:42:01'),
(9, 9, 'Bachelor of Arts', 'BA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02 10:12:46', '2019-06-28 17:42:52'),
(10, 10, 'Bachelor of Business Administrations', 'BBA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08 19:13:45', '2019-07-08 14:13:45'),
(11, 10, 'Bachelor of technology', 'M.Tech', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08 19:08:16', '2019-07-08 14:08:16'),
(13, 10, 'master in technology', 'M.tech', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-05 17:22:56', '2019-07-05 12:22:56'),
(18, 11, 'test', 'mcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 16:04:41', '2019-07-03 11:04:41'),
(21, 10, 'Master of computer application', 'MCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-05 17:23:30', '2019-07-05 12:23:30'),
(23, 10, 'sdda', 'sadsadasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08 19:14:00', '2019-07-08 14:14:00'),
(24, 1, 'High School', '10th', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:52:02', '2019-07-17 14:22:02'),
(25, 1, 'Intermeadiate', '12th', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:52:20', '2019-07-17 14:22:20'),
(26, 1, 'Graduation', 'BCA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:53:24', '2019-07-17 14:23:24'),
(27, 1, 'Graduation', 'BBA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:53:44', '2019-07-17 14:23:44'),
(28, 1, 'Diploma', 'Engineering', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:54:17', '2019-07-17 14:24:17'),
(29, 1, 'Degree', 'BTECH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 08:54:53', '2019-07-17 14:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `its_referral`
--

CREATE TABLE `its_referral` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `resume` blob NOT NULL,
  `relation` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 1,
  `remark` text NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_relation`
--

CREATE TABLE `its_relation` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `rel_short_name` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_relation`
--

INSERT INTO `its_relation` (`id`, `org_id`, `relation`, `rel_short_name`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(7, 11, 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 06:36:06', '2019-07-03 12:05:12'),
(9, 10, 'test', 'test1', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-09 16:21:36', '2019-07-09 11:21:36'),
(10, 1, 'Son', 'S', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:02:38', '2019-07-17 14:32:38'),
(11, 1, 'Father', 'F', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:02:55', '2019-07-17 14:32:55'),
(12, 1, 'Mother', 'M', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:03:08', '2019-07-17 14:33:08'),
(13, 1, 'Daughter', 'D', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:03:53', '2019-07-17 14:33:53'),
(14, 1, 'Brother', 'B', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:04:12', '2019-07-17 14:34:12'),
(15, 1, 'Wife', 'W', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:04:29', '2019-07-17 14:34:29'),
(16, 1, 'Husband', 'H', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:04:58', '2019-07-17 14:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `its_reporting`
--

CREATE TABLE `its_reporting` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `branch_location_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `reporting` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_reporting`
--

INSERT INTO `its_reporting` (`id`, `org_id`, `branch_location_id`, `division_id`, `grade_id`, `department_id`, `designation_id`, `reporting`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(1, 10, 10, 0, 0, 12, 12, 'Manager', 1, 11, 11, '0000-00-00 00:00:00', '', 0, 0, '2019-07-09 09:39:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `its_salary_deatils`
--

CREATE TABLE `its_salary_deatils` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `designation_id` int(100) DEFAULT NULL,
  `income_head_id` int(50) DEFAULT NULL,
  `income_head_value` int(100) DEFAULT NULL,
  `deduction_head_id` int(100) DEFAULT NULL,
  `deduction_head_value` int(100) DEFAULT NULL,
  `total_earning` int(100) DEFAULT NULL,
  `total_deduction` int(100) DEFAULT NULL,
  `net_payable` int(100) DEFAULT NULL,
  `earning_value` int(100) DEFAULT NULL,
  `earning_type` varchar(100) DEFAULT NULL,
  `deduction_type` varchar(100) DEFAULT NULL,
  `deduction_value` int(100) DEFAULT NULL,
  `per_month_salary` float DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_shift`
--

CREATE TABLE `its_shift` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) NOT NULL,
  `shift_name` varchar(50) DEFAULT NULL,
  `shift_time` time DEFAULT NULL,
  `shift_end` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_shift`
--

INSERT INTO `its_shift` (`id`, `org_id`, `department_id`, `designation_id`, `shift_name`, `shift_time`, `shift_end`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(1, 10, 2, 4, 'Night', '00:00:00', NULL, NULL, 11, 11, '2019-07-03 00:00:00', 'sdfdsfds', 10, 10, '2019-07-03 05:41:00', NULL),
(4, 10, 6, 6, 'Day shift', '15:15:00', '15:15:00', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 20:09:05', '2019-07-03 15:09:05'),
(5, 10, 7, 10, 'Day shift', '18:15:00', '19:15:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 20:09:29', '2019-07-03 15:09:29'),
(6, NULL, 6, 6, 'Day shift', '12:30:00', '11:45:00', 1, NULL, NULL, NULL, '192.168.1.5', NULL, NULL, '2019-07-04 15:19:23', '2019-07-04 10:19:23'),
(7, 10, 17, 19, 'night', '15:30:00', '12:15:00', 0, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-09 17:14:40', '2019-07-09 12:14:40'),
(8, 10, 6, 21, 'Day shift', '13:00:00', '13:00:00', 1, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-09 18:00:51', '2019-07-09 13:00:51'),
(9, NULL, 6, 17, 'Day shift', '11:30:00', '12:15:00', 1, NULL, NULL, NULL, '192.168.1.5', NULL, NULL, '2019-07-09 16:32:12', '2019-07-09 11:32:12'),
(11, 1, 6, 20, 'Dat shift', '17:25:00', '23:02:00', 1, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-11 05:15:07', '2019-07-11 10:45:07'),
(12, 1, 4, 1, 'Day Shift', '09:30:00', '18:30:00', 1, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-17 09:10:14', '2019-07-17 14:40:14'),
(13, 1, 4, 1, 'Night Shift', '19:00:00', '02:30:00', 1, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-17 09:10:54', '2019-07-17 14:40:54'),
(14, 1, 4, 2, 'Day Shift', '09:30:00', '06:30:00', 1, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-17 09:11:19', '2019-07-17 14:41:19'),
(15, 1, 4, 2, 'Night Shift', '19:00:00', '02:30:00', 1, NULL, NULL, NULL, '::1', NULL, NULL, '2019-07-17 09:11:41', '2019-07-17 14:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `its_simulation`
--

CREATE TABLE `its_simulation` (
  `id` int(11) NOT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '0=(female),1=(male)',
  `download_id` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `simulation` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_simulation`
--

INSERT INTO `its_simulation` (`id`, `gender`, `download_id`, `org_id`, `simulation`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(2, NULL, NULL, NULL, 'helllo', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-01 21:45:22', '2019-07-01 16:45:22'),
(9, 1, NULL, 11, 'test', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 06:08:39', '2019-07-03 11:36:06'),
(10, NULL, NULL, 11, 'test2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 16:46:06', '2019-07-03 11:46:06'),
(11, 1, NULL, 11, 'test 3', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-03 18:27:20', '2019-07-03 13:27:20'),
(12, 0, NULL, 10, 'test', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08 22:59:11', '2019-07-08 17:59:11'),
(13, 0, NULL, 10, 'test', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-09 15:22:02', '2019-07-09 10:22:02'),
(14, 1, NULL, 1, 'Development', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 09:01:36', '2019-07-17 14:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `its_sms_branch_template`
--

CREATE TABLE `its_sms_branch_template` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '''0'' General,''1'' Appointment, ''2 ''OPD, ''3'' Prescription,''4'' OPD Billing,''5''IPD ,''6''OT,''7'' Pathology,''8'' Medicine,''9''Expenses',
  `form_name` int(11) NOT NULL,
  `template` longtext NOT NULL,
  `short_code` text NOT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_sms_default_template`
--

CREATE TABLE `its_sms_default_template` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `template` longtext NOT NULL,
  `short_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_sms_setting_name`
--

CREATE TABLE `its_sms_setting_name` (
  `id` int(11) NOT NULL,
  `var_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_source`
--

CREATE TABLE `its_source` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `its_state`
--

CREATE TABLE `its_state` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '1 = ''delete''',
  `ip_address` varchar(20) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_state`
--

INSERT INTO `its_state` (`id`, `country_id`, `state`, `status`, `is_deleted`, `ip_address`, `modified_date`, `created_date`) VALUES
(1, 1, 'Uttar Pradesh', 1, 0, '', '2019-07-01 10:34:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `its_unique_ids`
--

CREATE TABLE `its_unique_ids` (
  `id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `emp_id` varchar(111) DEFAULT 'NULL',
  `job_id` varchar(111) DEFAULT 'NULL',
  `loan_id` varchar(111) DEFAULT NULL,
  `reg_no` varchar(111) DEFAULT 'NULL',
  `title` varchar(111) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_unique_ids`
--

INSERT INTO `its_unique_ids` (`id`, `org_id`, `emp_id`, `job_id`, `loan_id`, `reg_no`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'ITS00000', 'ITJ00000', 'ITL00000', 'ITR00000', NULL, NULL, 1, '2019-07-29 00:00:00', '2019-07-29 14:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `its_users`
--

CREATE TABLE `its_users` (
  `id` int(11) NOT NULL,
  `users_role` int(11) DEFAULT NULL,
  `users_type` int(11) DEFAULT NULL COMMENT '''1'' Employee',
  `parent_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `emp_code` varchar(111) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `username` varchar(111) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '''0'' Inactive , ''1'' Active',
  `is_deleted` int(11) DEFAULT 0 COMMENT '''1'' =>delete',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_date` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_users`
--

INSERT INTO `its_users` (`id`, `users_role`, `users_type`, `parent_id`, `emp_id`, `emp_code`, `org_id`, `designation_id`, `username`, `name`, `password`, `email`, `email_verified_at`, `remember_token`, `token_expire`, `status`, `is_deleted`, `deleted_by`, `deleted_date`, `ip_address`, `modified_date`, `created_at`, `updated_at`, `created_date`, `last_login`) VALUES
(1, 1, 0, 0, 0, NULL, NULL, NULL, 'admin', 'Amit Rajput', '$2a$08$TnLUue010iZQcUVL.b0bPeCaFvVqa221s0MmNopcnzeIg4q4jjxQa', 'amitrajput270@gmail.com', NULL, 'gKaUKXTc6hitK7pNZGgLInZFZMA83ZOlFvHmCerGoRdp4Xkzyi4NDo0Z7763', '0000-00-00 00:00:00', 0, 0, 0, '0000-00-00 00:00:00', '', '2019-07-29 11:23:54', '2019-06-28 09:57:00', '2019-06-28 09:57:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'amazon23', NULL, '$2y$10$hUIWsKbmqIRZyrFkpd1gPud7XDR54wxWCktrnw2SkuzXGXBZ6cH3.', 'dempalrajput@gmail.in', NULL, 'zSNGz7sq2Wnsl78iDVoWInk9roPu0JVAWzNvRIoiyoQFASwbxUGRCweGikz5', NULL, NULL, 1, 1, '2019-07-17 07:48:40', '::1', '2019-07-17 07:48:40', '2019-07-02 17:55:42', '2019-07-17 07:48:40', NULL, NULL),
(19, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'itscient', NULL, '$2y$10$8.KasY6j2vLgvHof/3xEMuj7YP8s.H.6VAargzDZztZH6Fxg.w5g6', 'amitrajput@gmail.com', NULL, 'smZpGMnym0YoboXJrNCNIxxqFpvxbrlgN5yNcVXSZ6bWgkFHDVJYEu6bx8JN', NULL, NULL, NULL, NULL, NULL, '::1', '2019-07-03 10:34:42', '2019-07-02 23:27:42', '2019-07-02 23:27:42', NULL, NULL),
(20, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'flipkart', NULL, '$2y$10$SGzk.1y6EUWnV1qADgR0l.S44qcWbddffdHPgvkhrrHkGSk8/ZM0G', 'amit.it@trendydeals.in', NULL, '$2y$10$CD/z83OoClnzkSrfc7zPG.EMjTWtdjbJjxO3YxVts4I.4iGqu4pAO', NULL, NULL, 0, NULL, NULL, '::1', '2019-07-03 12:00:08', '2019-07-03 22:30:10', '2019-07-03 22:30:10', NULL, NULL),
(21, 4, NULL, NULL, 1, 'ITS00007', 1, 1, 'ranveer', 'RANVEER', '$2y$10$5EmqbDMJuVLw8Q08.MjbYuuoEUqLIIHK5rSJ1oz2eW0D6c3AYk1Oi', 'amit.it@trendydeals.in', NULL, 'bkGP2zALSggTFAFVef35YBIuZ26FuJECRRLpr1K57Dd4um9PP4U701ysv97G', NULL, 1, 0, NULL, NULL, NULL, '2019-07-29 05:48:18', '2019-07-26 13:07:21', '2019-07-29 05:28:40', '2019-07-29 10:58:40', NULL),
(22, 4, NULL, NULL, 1, 'ITS00007', 1, 1, 'tyagi270', 'RANVEER', '$2y$10$qvBOu0076xqGiaIJcGx1bu.rrAzSmisik/uBuiu3AGAZVTc5aQ4lW', 'amit.it@trendydeals.in', NULL, 'RWDQTiAxE8PWYwDexTlmzwXe3y1HEnPwHp33lsNK2VuVZYhXuSnBOoNHrvau', NULL, 1, 0, NULL, NULL, NULL, '2019-07-29 08:16:13', '2019-07-29 05:15:58', '2019-07-29 08:16:13', '2019-07-29 13:46:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `its_users_role`
--

CREATE TABLE `its_users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `its_users_role`
--

INSERT INTO `its_users_role` (`id`, `role`, `status`, `ip_address`, `created_by`, `modified_by`, `modified_date`, `created_date`) VALUES
(1, 'Admin', 1, '192.168.1.240', 1, 1, '2018-01-30 12:22:10', '2018-01-30 00:00:00'),
(2, 'Company', 1, '', 1, 1, '2019-07-02 07:50:03', '2017-11-14 00:00:00'),
(3, 'HR', 1, '192.168.1.240', 1, 1, '2018-02-06 18:06:45', '2017-11-23 00:00:00'),
(4, 'Employee', 1, '192.168.1.240', 1, 1, '2018-02-06 18:06:50', '2017-11-14 00:00:00'),
(5, 'RM', 1, '192.168.1.240', 1, 1, '2018-03-14 13:55:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `its_website_setting`
--

CREATE TABLE `its_website_setting` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `var_name` varchar(255) NOT NULL,
  `var_title` varchar(255) NOT NULL,
  `setting_value` varchar(250) NOT NULL,
  `old_setting_value` varchar(250) NOT NULL,
  `status` int(11) NOT NULL COMMENT '''0'' Inactive , ''1'' Active',
  `is_deleted` int(11) NOT NULL,
  `deleted_by` int(11) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `its_attendence`
--
ALTER TABLE `its_attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_blood_group`
--
ALTER TABLE `its_blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_cities`
--
ALTER TABLE `its_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_company_working_setting`
--
ALTER TABLE `its_company_working_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_countries`
--
ALTER TABLE `its_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_deduction_head`
--
ALTER TABLE `its_deduction_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_departments`
--
ALTER TABLE `its_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_designation`
--
ALTER TABLE `its_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_document_checklist`
--
ALTER TABLE `its_document_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_document_checklist_certificate`
--
ALTER TABLE `its_document_checklist_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_document_details`
--
ALTER TABLE `its_document_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_email_branch_template`
--
ALTER TABLE `its_email_branch_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_email_setting`
--
ALTER TABLE `its_email_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_email_template`
--
ALTER TABLE `its_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_employees`
--
ALTER TABLE `its_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_employee_appraisel`
--
ALTER TABLE `its_employee_appraisel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_employee_appraisel_salary`
--
ALTER TABLE `its_employee_appraisel_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_employee_code`
--
ALTER TABLE `its_employee_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_employee_probation`
--
ALTER TABLE `its_employee_probation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_emp_calculated_salary`
--
ALTER TABLE `its_emp_calculated_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_emp_qualification`
--
ALTER TABLE `its_emp_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_emp_shift`
--
ALTER TABLE `its_emp_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_emp_type`
--
ALTER TABLE `its_emp_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_emp_work_exp`
--
ALTER TABLE `its_emp_work_exp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_full_and_final`
--
ALTER TABLE `its_full_and_final`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_holiday_master`
--
ALTER TABLE `its_holiday_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_hrd`
--
ALTER TABLE `its_hrd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_hr_employee_document`
--
ALTER TABLE `its_hr_employee_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_income_head`
--
ALTER TABLE `its_income_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_interview_type`
--
ALTER TABLE `its_interview_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_job_interview_list`
--
ALTER TABLE `its_job_interview_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_job_interview_new_candidate`
--
ALTER TABLE `its_job_interview_new_candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_job_post`
--
ALTER TABLE `its_job_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_job_post_settings`
--
ALTER TABLE `its_job_post_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_job_schedule_new_candidate`
--
ALTER TABLE `its_job_schedule_new_candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_leave_application_mail`
--
ALTER TABLE `its_leave_application_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_leave_details`
--
ALTER TABLE `its_leave_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_leave_master`
--
ALTER TABLE `its_leave_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_leave_type_duration`
--
ALTER TABLE `its_leave_type_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_mail`
--
ALTER TABLE `its_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_mandatory_field`
--
ALTER TABLE `its_mandatory_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_mandatory_field_to_mandatory`
--
ALTER TABLE `its_mandatory_field_to_mandatory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_migrations`
--
ALTER TABLE `its_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_new_candidate`
--
ALTER TABLE `its_new_candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_org`
--
ALTER TABLE `its_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_permission_action`
--
ALTER TABLE `its_permission_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_permission_section`
--
ALTER TABLE `its_permission_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_permission_to_role`
--
ALTER TABLE `its_permission_to_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_permission_to_users`
--
ALTER TABLE `its_permission_to_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_qualification`
--
ALTER TABLE `its_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_referral`
--
ALTER TABLE `its_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_relation`
--
ALTER TABLE `its_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_reporting`
--
ALTER TABLE `its_reporting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_salary_deatils`
--
ALTER TABLE `its_salary_deatils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_shift`
--
ALTER TABLE `its_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_simulation`
--
ALTER TABLE `its_simulation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_sms_branch_template`
--
ALTER TABLE `its_sms_branch_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_sms_default_template`
--
ALTER TABLE `its_sms_default_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_sms_setting_name`
--
ALTER TABLE `its_sms_setting_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_source`
--
ALTER TABLE `its_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_state`
--
ALTER TABLE `its_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_unique_ids`
--
ALTER TABLE `its_unique_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_users`
--
ALTER TABLE `its_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `its_users_role`
--
ALTER TABLE `its_users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `its_attendence`
--
ALTER TABLE `its_attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `its_blood_group`
--
ALTER TABLE `its_blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `its_cities`
--
ALTER TABLE `its_cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `its_company_working_setting`
--
ALTER TABLE `its_company_working_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_countries`
--
ALTER TABLE `its_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `its_deduction_head`
--
ALTER TABLE `its_deduction_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `its_departments`
--
ALTER TABLE `its_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `its_designation`
--
ALTER TABLE `its_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `its_document_checklist`
--
ALTER TABLE `its_document_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_document_checklist_certificate`
--
ALTER TABLE `its_document_checklist_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_document_details`
--
ALTER TABLE `its_document_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_email_branch_template`
--
ALTER TABLE `its_email_branch_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_email_setting`
--
ALTER TABLE `its_email_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_email_template`
--
ALTER TABLE `its_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_employees`
--
ALTER TABLE `its_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `its_employee_appraisel`
--
ALTER TABLE `its_employee_appraisel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_employee_appraisel_salary`
--
ALTER TABLE `its_employee_appraisel_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_employee_code`
--
ALTER TABLE `its_employee_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `its_employee_probation`
--
ALTER TABLE `its_employee_probation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_emp_calculated_salary`
--
ALTER TABLE `its_emp_calculated_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_emp_qualification`
--
ALTER TABLE `its_emp_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `its_emp_shift`
--
ALTER TABLE `its_emp_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_emp_type`
--
ALTER TABLE `its_emp_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `its_emp_work_exp`
--
ALTER TABLE `its_emp_work_exp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `its_full_and_final`
--
ALTER TABLE `its_full_and_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_holiday_master`
--
ALTER TABLE `its_holiday_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `its_hrd`
--
ALTER TABLE `its_hrd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_hr_employee_document`
--
ALTER TABLE `its_hr_employee_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_income_head`
--
ALTER TABLE `its_income_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `its_interview_type`
--
ALTER TABLE `its_interview_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_job_interview_list`
--
ALTER TABLE `its_job_interview_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_job_interview_new_candidate`
--
ALTER TABLE `its_job_interview_new_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_job_post`
--
ALTER TABLE `its_job_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_job_post_settings`
--
ALTER TABLE `its_job_post_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_job_schedule_new_candidate`
--
ALTER TABLE `its_job_schedule_new_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_leave_application_mail`
--
ALTER TABLE `its_leave_application_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_leave_details`
--
ALTER TABLE `its_leave_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `its_leave_master`
--
ALTER TABLE `its_leave_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_leave_type_duration`
--
ALTER TABLE `its_leave_type_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `its_mail`
--
ALTER TABLE `its_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_mandatory_field`
--
ALTER TABLE `its_mandatory_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_mandatory_field_to_mandatory`
--
ALTER TABLE `its_mandatory_field_to_mandatory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_migrations`
--
ALTER TABLE `its_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_new_candidate`
--
ALTER TABLE `its_new_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_org`
--
ALTER TABLE `its_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `its_permission_action`
--
ALTER TABLE `its_permission_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_permission_section`
--
ALTER TABLE `its_permission_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_permission_to_role`
--
ALTER TABLE `its_permission_to_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_permission_to_users`
--
ALTER TABLE `its_permission_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_qualification`
--
ALTER TABLE `its_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `its_referral`
--
ALTER TABLE `its_referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_relation`
--
ALTER TABLE `its_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `its_reporting`
--
ALTER TABLE `its_reporting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `its_salary_deatils`
--
ALTER TABLE `its_salary_deatils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_shift`
--
ALTER TABLE `its_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `its_simulation`
--
ALTER TABLE `its_simulation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `its_sms_branch_template`
--
ALTER TABLE `its_sms_branch_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_sms_default_template`
--
ALTER TABLE `its_sms_default_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_sms_setting_name`
--
ALTER TABLE `its_sms_setting_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_source`
--
ALTER TABLE `its_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `its_state`
--
ALTER TABLE `its_state`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `its_unique_ids`
--
ALTER TABLE `its_unique_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `its_users`
--
ALTER TABLE `its_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `its_users_role`
--
ALTER TABLE `its_users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
