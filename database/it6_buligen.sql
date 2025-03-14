-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 09:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it6_buligen`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_active_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Reactive Student',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_delete_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Delete Student',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_delete_tutor` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Delete Tutor Student',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_enroll_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Enroll Student',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_inactive_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Deactivate Student',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_login_employee` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Login Employee',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_logout_employee` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Logout Employee',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_pay_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Student Payment',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_register_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Register Student',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_register_tutor` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Register tutor',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_update_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Update Student Information',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audit_update_tutor` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Update Tutor Information',NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `audtit_enroll_student` (IN `get_employee_id` INT(11), IN `get_position` VARCHAR(20))   BEGIN
	INSERT INTO tbl_audit_log
    (employee_id, position, description,timestamp)
    VALUE
    (get_employee_id,get_position,'Insert Student',NOW());
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_log`
--

CREATE TABLE `tbl_audit_log` (
  `audit_no` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `position` enum('administrator','admission','cashier','') NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_log`
--

INSERT INTO `tbl_audit_log` (`audit_no`, `employee_id`, `position`, `description`, `timestamp`) VALUES
(1, 1, 'administrator', 'Enroll Student', '2025-03-13 08:40:57'),
(2, 1, 'administrator', 'Reactive Student', '2025-03-13 09:09:55'),
(3, 1, 'administrator', 'Deactivate Student', '2025-03-13 09:13:20'),
(4, 1, 'administrator', 'Register Student', '2025-03-13 09:16:50'),
(5, 1, 'administrator', 'Enroll Student', '2025-03-13 09:17:13'),
(6, 1, 'administrator', 'Delete Student', '2025-03-13 09:19:49'),
(7, 3, 'cashier', 'Login Employee', '2025-03-13 09:34:15'),
(8, 3, 'cashier', 'Login Employee', '2025-03-13 09:35:36'),
(9, 2, 'admission', 'Login Employee', '2025-03-13 09:41:21'),
(10, 2, 'admission', 'Logout Employee', '2025-03-13 09:41:49'),
(11, 2, 'admission', 'Login Employee', '2025-03-13 09:41:56'),
(12, 2, 'admission', 'Logout Employee', '2025-03-13 09:41:58'),
(13, 2, 'admission', 'Login Employee', '2025-03-13 09:51:55'),
(14, 2, 'admission', 'Logout Employee', '2025-03-13 09:55:56'),
(15, 1, 'administrator', 'Login Employee', '2025-03-13 09:56:05'),
(16, 1, 'administrator', 'Student Payment', '2025-03-13 09:58:33'),
(17, 1, 'administrator', 'Student Payment', '2025-03-13 09:58:44'),
(18, 1, 'administrator', 'Student Payment', '2025-03-13 09:59:01'),
(19, 1, 'administrator', 'Update Student Information', '2025-03-13 10:20:37'),
(20, 1, 'administrator', 'Update Student Information', '2025-03-13 10:32:45'),
(21, 1, 'administrator', 'Delete Tutor Student', '2025-03-13 10:34:42'),
(22, 1, 'administrator', 'Update Student Information', '2025-03-13 10:37:36'),
(23, 1, 'administrator', 'Logout Employee', '2025-03-13 10:40:51'),
(24, 3, 'cashier', 'Login Employee', '2025-03-14 00:30:20'),
(25, 3, 'cashier', 'Deactivate Student', '2025-03-14 00:34:23'),
(26, 3, 'cashier', 'Reactive Student', '2025-03-14 00:34:59'),
(27, 3, 'cashier', 'Reactive Student', '2025-03-14 00:35:00'),
(28, 3, 'cashier', 'Update Student Information', '2025-03-14 00:36:39'),
(29, 3, 'cashier', 'Update Student Information', '2025-03-14 00:42:44'),
(30, 3, 'cashier', 'Update Student Information', '2025-03-14 00:44:57'),
(31, 3, 'cashier', 'Update Student Information', '2025-03-14 00:49:15'),
(32, 3, 'cashier', 'Enroll Student', '2025-03-14 00:51:16'),
(33, 3, 'cashier', 'Enroll Student', '2025-03-14 00:51:38'),
(34, 3, 'cashier', 'Enroll Student', '2025-03-14 00:51:53'),
(35, 3, 'cashier', 'Enroll Student', '2025-03-14 01:06:44'),
(36, 3, 'cashier', 'Delete Student', '2025-03-14 01:09:36'),
(37, 3, 'cashier', 'Student Payment', '2025-03-14 01:11:19'),
(38, 3, 'cashier', 'Register tutor', '2025-03-14 01:45:49'),
(39, 3, 'cashier', 'Deactivate Student', '2025-03-14 01:48:01'),
(40, 5, 'admission', 'Login Employee', '2025-03-14 03:44:39'),
(41, 5, 'admission', 'Register Student', '2025-03-14 03:49:25'),
(42, 5, 'admission', 'Enroll Student', '2025-03-14 03:49:53'),
(43, 5, 'admission', 'Enroll Student', '2025-03-14 03:50:06'),
(44, 5, 'admission', 'Enroll Student', '2025-03-14 03:51:07'),
(45, 5, 'admission', 'Update Student Information', '2025-03-14 03:51:26'),
(46, 5, 'admission', 'Update Student Information', '2025-03-14 04:42:20'),
(47, 5, 'admission', 'Update Student Information', '2025-03-14 04:48:53'),
(48, 5, 'admission', 'Update Student Information', '2025-03-14 05:13:50'),
(49, 5, 'admission', 'Deactivate Student', '2025-03-14 05:14:03'),
(50, 5, 'admission', 'Reactive Student', '2025-03-14 05:14:13'),
(51, 5, 'admission', 'Update Student Information', '2025-03-14 06:01:23'),
(52, 5, 'admission', 'Update Student Information', '2025-03-14 06:02:37'),
(53, 5, 'admission', 'Delete Tutor Student', '2025-03-14 06:04:37'),
(54, 5, 'admission', 'Enroll Student', '2025-03-14 06:37:54'),
(55, 5, 'admission', 'Enroll Student', '2025-03-14 06:38:05'),
(56, 5, 'admission', 'Enroll Student', '2025-03-14 06:38:25'),
(57, 5, 'admission', 'Enroll Student', '2025-03-14 06:39:02'),
(58, 5, 'admission', 'Enroll Student', '2025-03-14 06:40:33'),
(59, 5, 'admission', 'Enroll Student', '2025-03-14 06:40:46'),
(60, 5, 'admission', 'Enroll Student', '2025-03-14 06:42:16'),
(61, 5, 'admission', 'Enroll Student', '2025-03-14 06:42:36'),
(62, 5, 'admission', 'Update Student Information', '2025-03-14 07:19:52'),
(63, 5, 'admission', 'Student Payment', '2025-03-14 07:22:56'),
(64, 5, 'admission', 'Logout Employee', '2025-03-14 07:43:39'),
(65, 1, 'administrator', 'Login Employee', '2025-03-14 07:43:41'),
(66, 1, 'administrator', 'Update Student Information', '2025-03-14 07:44:34'),
(67, 1, 'administrator', 'Logout Employee', '2025-03-14 07:54:05'),
(68, 3, 'cashier', 'Login Employee', '2025-03-14 07:54:09'),
(69, 3, 'cashier', 'Register Student', '2025-03-14 07:54:34'),
(70, 3, 'cashier', 'Register tutor', '2025-03-14 07:58:44'),
(71, 3, 'cashier', 'Update Tutor Information', '2025-03-14 08:09:23'),
(72, 3, 'cashier', 'Logout Employee', '2025-03-14 08:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL,
  `employee_position` enum('Administrator','Cashier','Admission') NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `verify_pass` varchar(16) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `isactive` tinyint(4) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `employee_position`, `username`, `password`, `last_name`, `first_name`, `middle_name`, `verify_pass`, `date_created`, `isactive`, `access_time`) VALUES
(1, 'Administrator', 'jam04241', '$2y$10$.RfmVG9yII.hoc7x/VSreuLOqFSvwIFkEJUbJf1jPN4.NLcxQ8e/W', 'Magcalas', 'Josh Andrei', 'Mosqueda', '123', '2025-03-09 21:08:30', 1, '2025-03-13 06:45:27'),
(2, 'Admission', 'Inday123', '$2y$10$CRyWaHpS3VHwnlbm5R1qW.YTdIZ1rUcz1lINhTW5Ai/WeqJZlxQpO', 'Inday', 'Charlize Jane', 'Secret', '123', '2025-03-09 21:08:35', 1, '2025-03-13 06:45:27'),
(3, 'Cashier', 'lloyd123', '$2y$10$3WZrPj3QZy81tZihgQsAxe20oHGl5X1Ke4OTthNVZuRrePpHXurwi', 'Girozaga', 'John Lloyd', 'Secret', '123', '2025-03-09 21:08:39', 1, '2025-03-13 06:45:27'),
(4, 'Administrator', 'sherjay123', '$2y$10$GkpbDOCNHa.IXEWCEHr1m.5yTHGGhA4DEgpDtkZfFNFZgPkIX68ti', 'Pasayloon', 'Sherjay', 'Buhat', '123', '2025-03-10 16:19:28', 1, '2025-03-13 10:13:45'),
(5, 'Admission', 'gilger123', '$2y$10$cNGW1F7CxIH0594s6mIeBeoew6/QxJbm1ny4CWeLBsCsw5jDQ3WEm', 'Mantilla', 'Gilgre Gene', 'Gavia', '123', '2025-03-14 03:44:08', 0, '2025-03-14 03:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_no` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `pay` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) DEFAULT 0.00,
  `balance` decimal(10,2) DEFAULT 24850.00,
  `payment_method` enum('Cash','Gcash','Bank Transfer','Others') NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_no`, `student_id`, `pay`, `total`, `balance`, `payment_method`, `created_by`, `date_created`, `updated_by`, `date_updated`, `status`) VALUES
(1, 3, 0.00, 0.00, 24850.00, 'Cash', 0, '2025-03-13 03:04:24', 5, '2025-03-14 06:42:36', 1),
(2, 5, 0.00, 0.00, 24850.00, 'Gcash', 3, '2025-03-12 04:36:29', 5, '2025-03-14 06:42:16', 1),
(6, 9, 0.00, 0.00, 24850.00, 'Cash', 1, '2025-03-13 09:16:50', 3, '2025-03-14 06:40:46', 1),
(7, 10, 24850.00, 24850.00, 0.00, 'Bank Transfer', 5, '2025-03-14 03:49:25', 5, '2025-03-14 07:22:56', 1),
(8, 11, 0.00, 0.00, 24850.00, 'Cash', 3, '2025-03-14 07:54:34', 0, '2025-03-14 07:54:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `orig_receipt` int(11) NOT NULL,
  `trancation_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schoolyear`
--

CREATE TABLE `tbl_schoolyear` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fee_price` decimal(8,2) NOT NULL,
  `effective_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schoolyear`
--

INSERT INTO `tbl_schoolyear` (`id`, `name`, `fee_price`, `effective_year`, `end_year`, `timestamp`) VALUES
(1, 'Registration_Fee', 3000.00, '2025', '2026', '2025-03-09 00:26:26'),
(2, 'Books', 3050.00, '2025', '2026', '2025-03-09 00:26:32'),
(3, 'Tuition', 1700.00, '2025', '2026', '2025-03-09 00:26:39'),
(4, 'ID', 100.00, '2025', '2026', '2025-03-09 00:26:44'),
(5, 'School_kit', 1050.00, '2025', '2026', '2025-03-09 00:26:50'),
(6, 'PE_Uniform', 650.00, '2025', '2026', '2025-03-09 00:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_info`
--

CREATE TABLE `tbl_student_info` (
  `student_id` int(11) NOT NULL,
  `enroll_category` enum('Nursery','Kindergarten_1','Kindergarten_2') DEFAULT NULL,
  `schoolyear` varchar(10) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `street` text NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_code` int(4) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `parent1` varchar(50) DEFAULT NULL,
  `parent1_contact` int(12) DEFAULT NULL,
  `parent2` varchar(50) DEFAULT NULL,
  `parent2_contact` int(12) DEFAULT NULL,
  `emergency_fullname` varchar(50) NOT NULL,
  `emergency_relationship` enum('mother','father','guardian','others') NOT NULL,
  `emergency_address` text NOT NULL,
  `emergency_contact_no` int(12) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`student_id`, `enroll_category`, `schoolyear`, `last_name`, `first_name`, `middle_name`, `street`, `city`, `zip_code`, `birthdate`, `sex`, `parent1`, `parent1_contact`, `parent2`, `parent2_contact`, `emergency_fullname`, `emergency_relationship`, `emergency_address`, `emergency_contact_no`, `created_by`, `date_created`, `updated_by`, `date_updated`, `isactive`) VALUES
(1, 'Kindergarten_2', '2024-2025', 'Mantilla', 'Gilgre GENE', 'Sheesh', 'Bangkal', 'Davao City', 8000, '2025-03-23', 'Male', 'Daddy', 909090, 'Mommy', 9090, 'Maria Betsy M. Magcalas', 'mother', 'mintal', 987, NULL, '2025-03-12 11:29:17', 5, '2025-03-14 06:38:05', 1),
(2, 'Kindergarten_1', '2020-2021', 'Magcalas', 'Josh Andrei', 'Mosqueda', 'mintal', 'davao city', 8000, '2004-06-04', 'Male', 'Maria Betsy M. Magalas', 954364521, 'Jonas B. Magcalas', 954364521, 'Maria Betsy M. Magcalas', '', 'Maria Betsy M. Magcalas', 0, NULL, '2025-03-11 15:22:48', 5, '2025-03-14 06:37:54', 1),
(3, 'Kindergarten_1', '2025-2026', 'Inday', 'Charlize Jane ', 'oten', 'mintal', 'DAVAO CITY', 8000, '2025-03-30', 'Female', 'Papa Lloyd', 9876, 'mama John Lloyd', 987, 'Boss Stephen', 'others', 'Catalunan Grande', 9876, NULL, '2025-03-12 11:00:06', 5, '2025-03-14 06:42:36', 1),
(5, 'Nursery', '2025-2026', 'Obaob', 'Einstein', 'Mosqueda', 'sss', 'Davao city', 8000, '2025-03-12', 'Female', 'Dad', 123123, 'Mon', 98765, 'dad', '', 'mintal', 643, 3, '2025-03-12 06:44:34', 1, '2025-03-14 07:44:34', 1),
(9, 'Kindergarten_1', '2023-2024', 'Latog', 'Emerson', '', 'Boulevard', 'Davao City', 8000, '2025-03-24', 'Male', 'Emerson Daddy', 976525435, 'Emerson Mommy', 123123, 'Daddy Aldren', 'others', 'Tugbok Dist., Davao City, 8000', 97555623, 1, '2025-03-13 09:16:49', 5, '2025-03-14 06:40:46', 1),
(10, 'Kindergarten_2', '2023-2024', 'vsdfs', 'dfsdg', 'hgjghjgh', 'hgjghj', 'ghjhgj', 8000, '2025-03-19', 'Male', 'kuyjgtgr', 9876543, 'opoliyujtgref', 87654, 'ewrsgfd', 'father', 'asddsa', 87654, 5, '2025-03-14 03:49:24', 5, '2025-03-14 06:40:33', 1),
(11, NULL, NULL, 'sda', 'asd', 'asd', 'Bangkal', 'Davao City', 8000, '2025-03-28', 'Male', 'Daddy', 6543, 'Mommy', 654, 'Maria Betsy M. Magcalas', 'mother', 'mintal', 123123, 3, '2025-03-14 07:54:33', NULL, '2025-03-14 07:54:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_info`
--

CREATE TABLE `tbl_tutor_info` (
  `tutorial_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `school` text NOT NULL,
  `grade_level` enum('Nursery','Kindergarten 1','Kindergarten 2','Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6') NOT NULL,
  `time_arrival` time NOT NULL,
  `focus_subject` varchar(12) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `street` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `emergency_fullname` varchar(100) NOT NULL,
  `emergency_relationship` enum('Father','Mother','Guardian','Others') NOT NULL,
  `emergency_address` text NOT NULL,
  `emergency_contact_no` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `isactive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tutor_info`
--

INSERT INTO `tbl_tutor_info` (`tutorial_id`, `date_start`, `school`, `grade_level`, `time_arrival`, `focus_subject`, `last_name`, `first_name`, `middle_name`, `birthdate`, `sex`, `street`, `city`, `zip_code`, `emergency_fullname`, `emergency_relationship`, `emergency_address`, `emergency_contact_no`, `created_by`, `date_created`, `updated_by`, `date_updated`, `isactive`) VALUES
(3, '2025-03-14', 'Mintala', 'Nursery', '09:33:00', 'sda', 'das', 'asd', NULL, '0000-00-00', 'Male', 'das', 'asd', 334, 'asd', 'Mother', 'asd', 0, 3, '2025-03-14 01:36:46', 5, '2025-03-14 06:02:37', 1),
(4, '2025-03-27', 'Mintala', 'Grade 3', '09:33:00', 'sda', 'das', 'asd', 'sad', '2025-03-21', 'Female', 'das', 'asd', 334, 'asd', 'Mother', 'asd', 0, 3, '2025-03-14 01:42:52', 3, '2025-03-14 08:09:23', 1),
(6, '2025-03-29', 'das', 'Nursery', '03:59:00', 'asadassad', 'sadsaddas', 'asdsadsad', 'asdasd', '2025-04-05', 'Male', 'dasdas', 'sadassad', 8000, 'asdasdds', 'Mother', 'dasdasasda', 123123, 3, '2025-03-14 07:58:44', 0, '2025-03-14 07:58:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  ADD PRIMARY KEY (`audit_no`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_no`);

--
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_tutor_info`
--
ALTER TABLE `tbl_tutor_info`
  ADD PRIMARY KEY (`tutorial_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  MODIFY `audit_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_tutor_info`
--
ALTER TABLE `tbl_tutor_info`
  MODIFY `tutorial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
