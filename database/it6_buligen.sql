-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 11:35 AM
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
(21, 1, 'administrator', 'Delete Tutor Student', '2025-03-13 10:34:42');

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
(4, 'Administrator', 'sherjay123', '$2y$10$GkpbDOCNHa.IXEWCEHr1m.5yTHGGhA4DEgpDtkZfFNFZgPkIX68ti', 'Pasayloon', 'Sherjay', 'Buhat', '123', '2025-03-10 16:19:28', 1, '2025-03-13 10:13:45');

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
(1, 3, 1000.00, 1524.00, 3476.00, 'Cash', 0, '2025-03-13 03:04:24', 1, '2025-03-13 03:11:48', 1),
(2, 5, 200.00, 500.00, 24350.00, 'Gcash', 3, '2025-03-12 04:36:29', 1, '2025-03-13 09:59:01', 1),
(3, 6, 0.00, 0.00, 24850.00, '', 1, '2025-03-12 11:26:24', 0, '2025-03-12 11:26:24', 1),
(5, 8, 0.00, 0.00, 24850.00, 'Cash', 1, '2025-03-13 04:16:36', 0, '2025-03-13 04:16:36', 1),
(6, 9, 0.00, 0.00, 24850.00, 'Cash', 1, '2025-03-13 09:16:50', 0, '2025-03-13 09:16:50', 1);

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
(1, 'Nursery', '2025-2026', 'Mantilla', 'Gilgre GENE', 'Sheesh', 'Bangkal', 'Davao City', 8000, '2025-03-23', 'Male', 'Daddy', 909090, 'Mommy', 9090, 'Maria Betsy M. Magcalas', 'mother', 'mintal', 987, NULL, '2025-03-12 11:29:17', 1, '2025-03-13 10:22:17', 1),
(2, 'Kindergarten_1', '2023-2024', 'Magcalas', 'Josh Andrei', 'Mosqueda', 'mintal', 'davao city', 8000, '2004-06-04', 'Male', 'Maria Betsy M. Magalas', 954364521, 'Jonas B. Magcalas', 954364521, 'Maria Betsy M. Magcalas', '', 'Maria Betsy M. Magcalas', 0, NULL, '2025-03-11 15:22:48', 1, '2025-03-13 10:32:45', 1),
(3, 'Kindergarten_2', '2025-2026', 'Inday', 'Charlize Jane ', '', 'mintal', 'DAVAO CITY', 8000, '2025-03-30', 'Female', 'Papa Lloyd', 9876, 'mama John Lloyd', 987, 'Boss Stephen', 'others', 'Catalunan Grande', 9876, NULL, '2025-03-12 11:00:06', 3, '2025-03-12 11:00:06', 1),
(5, 'Nursery', '', 'Obaob', 'Einstein', '', 'Sasa', 'Davao city', 8000, '2025-03-12', 'Female', 'Dad', 123123, 'Mon', 765, 'dad', '', 'mintal', 643, 3, '2025-03-12 06:44:34', 1, '2025-03-13 10:22:08', 1),
(6, 'Kindergarten_2', '2025-2026', 'Magcalas', 'Andrea Isabella', '', 'Mintal', 'Davao City', 8000, '2025-03-21', 'Male', 'jonas', 234453, 'maria', 3456456, 'Josh Andrei M. magcalas', 'guardian', 'Mintal', 2147483647, 1, '2025-03-12 13:45:00', 1, '2025-03-12 13:48:44', 0),
(9, 'Kindergarten_1', '2023-2024', 'Bert', 'aS', '', 'ghg', 'Davao City', 8000, '2025-03-13', 'Female', 'fghhfg', 6757, 'fghhfgghf', 85768654, 'Maria Betsy M. Magcalas', '', 'mintal', 123123, 1, '2025-03-13 09:16:49', NULL, '2025-03-13 09:17:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tutor_info`
--

CREATE TABLE `tbl_tutor_info` (
  `tutorial_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `school` text NOT NULL,
  `grade_level` enum('Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6') NOT NULL,
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
  MODIFY `audit_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_tutor_info`
--
ALTER TABLE `tbl_tutor_info`
  MODIFY `tutorial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
