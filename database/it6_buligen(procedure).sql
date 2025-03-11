-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2025 at 03:07 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_payment` (IN `get_student_id` INT(11))   BEGIN
	SELECT * 
    FROM 
		tbl_payment 
    WHERE
		student_id = get_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_payment_success` ()   BEGIN
	SELECT
		student_id, pay, total, balance
    FROM
		tbl_payment
	WHERE
		balance = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_schoolyear` (IN `get_name` VARCHAR(12), IN `get_fee_price` DECIMAL(11,2), IN `get_effective_year` YEAR(4), IN `get_end_year` YEAR(4))   BEGIN
    INSERT INTO tbl_schoolyear (
        name, fee_price, effective_year, end_year, timestamp
    ) 
    VALUES (
        get_name, get_fee_price, get_effective_year, get_end_year, NOW()
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_student_enrollment` (IN `get_isactive` INT, IN `get_student_id` INT)   BEGIN
	SELECT
		    enroll_category,
        schoolyear,
        last_name,
        first_name, 
        middle_name,
        sex,
        emergency_fullname,
        emergency_relationship,
        emergency_address,
        emergency_contact_no
    FROM 
		tbl_student_info
	WHERE
		isactive = get_isactive
	AND
		student_id = get_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_student_info` (IN `get_isactive` INT, IN `get_student_id` INT)   BEGIN
	SELECT 
		enroll_category, 
        schoolyear,
        isactive,
        last_name,
        first_name, 
        middle_name,
        address, 
        birthdate, 
        sex,
        parent1,
        parent1_contact,
        parent2,
        parent2_contact,
        emergency_fullname,
        emergency_relationship,
        emergency_address,
        emergency_contact_no
    FROM 
		tbl_student_info
	WHERE
		isactive = get_isactive
	AND
		student_id= get_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_student_registration` (IN `get_isactive` INT, IN `get_student_id` INT)   BEGIN
	SELECT 
		enroll_category, 
        schoolyear,
        isactive,
        last_name,
        first_name, 
        middle_name,
        address, 
        birthdate, 
        sex,
        parent1,
        parent1_contact,
        parent2,
        parent2_contact,
        emergency_fullname,
        emergency_relationship,
        emergency_address,
        emergency_contact_no
    FROM 
		tbl_student_info
	WHERE
		isactive = get_isactive
	AND
		student_id= get_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_userpass` (IN `get_username` VARCHAR(50))   BEGIN
	SELECT 
		employee_id, password
    FROM 
		tbl_employee 
    WHERE 
		username = get_username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_payment` (IN `get_pay` DECIMAL(8,2), IN `get_student_id` INT(12), IN `get_admin_id` INT(12))   BEGIN
    INSERT INTO tbl_payment (pay, student_id, admin_id, timestamp)
    VALUES (get_pay, get_student_id, get_admin_id, NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_registration_tbl_student_info` (IN `get_last_name` VARCHAR(100), IN `get_first_name` VARCHAR(100), IN `get_middle_name` VARCHAR(100), IN `get_address` TEXT, IN `get_birthdate` DATE, IN `get_sex` VARCHAR(50), IN `get_parent1` VARCHAR(100), IN `get_parent1_contact` VARCHAR(20), IN `get_parent2` VARCHAR(100), IN `get_parent2_contact` VARCHAR(20), IN `get_emergency_fullname` VARCHAR(100), IN `get_emergency_relationship` VARCHAR(50), IN `get_emergency_address` TEXT, IN `get_emergency_contact_no` VARCHAR(20), IN `get_created_by` INT)   BEGIN
    INSERT INTO tbl_student_info (
		enroll_category,
        schoolyear,
        last_name, 
        first_name,
        middle_name, 
        address, 
        birthdate, 
        sex, 
        parent1, 
        parent1_contact, 
        parent2, 
        parent2_contact, 
        emergency_fullname, 
        emergency_relationship, 
        emergency_address, 
        emergency_contact_no, 
        created_by,
        date_created, 
        isactive
    ) 
    VALUES (
		NULL,
		NULL,
        get_last_name, 
        get_first_name, 
        get_middle_name, 
        get_address, 
        get_birthdate, 
        get_sex, 
        get_parent1,
        get_parent1_contact, 
        get_parent2, 
        get_parent2_contact, 
        get_emergency_fullname,
        get_emergency_relationship, 
        get_emergency_address, 
        get_emergency_contact_no, 
        get_created_by, 
        NOW(), 
        1
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tbl_employee` (IN `insert_employee_position` VARCHAR(50), IN `insert_username` VARCHAR(12), IN `insert_password` VARCHAR(255), IN `insert_last_name` VARCHAR(50), IN `insert_first_name` VARCHAR(50), IN `insert_middle_name` VARCHAR(50), IN `insert_verify_pass` VARCHAR(12))   BEGIN
	INSERT INTO tbl_employee(
    employee_position,
	username,
    password,
	last_name,
    first_name,
    middle_name,
    verify_pass,
    timestamp
    )
    VALUES(
    insert_employee_position,
	insert_username,
    insert_password,
	insert_last_name,
    insert_first_name,
    insert_middle_name,
    insert_verify_pass,
    NOW()
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tbl_payment_add` (IN `get_student_id` INT)   BEGIN
    INSERT INTO tbl_payment 
		(student_id, date_created, status)
    VALUES(
		get_student_id, 
        NOW(),
        1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tbl_schoolyear` (IN `get_name` VARCHAR(12), IN `get_fee_price` DECIMAL(11,2), IN `get_effective_year` YEAR(4), IN `get_end_year` YEAR(4))   BEGIN
    INSERT INTO tbl_schoolyear (
        name, fee_price, effective_year, end_year, timestamp
    ) 
    VALUES (
        get_name, get_fee_price, get_effective_year, get_end_year, NOW()
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tbl_student_info` (IN `get_enroll_category` VARCHAR(50), IN `get_schoolyear` VARCHAR(10), IN `get_last_name` VARCHAR(100), IN `get_first_name` VARCHAR(100), IN `get_middle_name` VARCHAR(10), IN `get_address` TEXT, IN `get_birthdate` DATE, IN `get_sex` VARCHAR(50), IN `get_parent1` VARCHAR(100), IN `get_parent1_contact` VARCHAR(20), IN `get_parent2` VARCHAR(100), IN `get_parent2_contact` VARCHAR(20), IN `get_emergency_fullname` VARCHAR(100), IN `get_emergency_relationship` VARCHAR(50), IN `get_emergency_address` TEXT, IN `get_emergency_contact_no` VARCHAR(20), IN `get_created_by` INT)   BEGIN
    INSERT INTO tbl_student_info (
        enroll_category, 
        schoolyear, 
        last_name, 
        first_name,
        middle_name, 
        address, 
        birthdate, 
        sex, 
        parent1, 
        parent1_contact, 
        parent2, 
        parent2_contact, 
        emergency_fullname, 
        emergency_relationship, 
        emergency_address, 
        emergency_contact_no, 
        created_by,
        date_created, 
        isactive
    ) 
    VALUES (
        get_enroll_category, 
        get_schoolyear, 
        get_last_name, 
        get_first_name, 
        get_middle_name, 
        get_address, 
        get_birthdate, 
        get_sex, 
        get_parent1,
        get_parent1_contact, 
        get_parent2, 
        get_parent2_contact, 
        get_emergency_fullname,
        get_emergency_relationship, 
        get_emergency_address, 
        get_emergency_contact_no, 
        get_created_by, 
        NOW(), 
        1
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nquery_kindergarten_2_list` ()   BEGIN
	SELECT
		student_id,
        first_name,
        middle_name,
        last_name,
        enroll_category,
        date_created,
        date_updated
	FROM
		tbl_student_info
	WHERE
		enroll_category = Kindergarten_2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `query_kindergarten_1_list` ()   BEGIN
	SELECT
		student_id,
        first_name,
        middle_name,
        last_name
	FROM
		tbl_student_info
	WHERE
		enroll_category = 'Kindergarten_1';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `query_kindergarten_2_list` ()   BEGIN
	SELECT
		student_id,
        first_name,
        middle_name,
        last_name
	FROM
		tbl_student_info
	WHERE
		enroll_category = 'Kindergarten_2';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `query_nursery_list` ()   BEGIN
	SELECT
		student_id,
        first_name,
        middle_name,
        last_name
	FROM
		tbl_student_info
	WHERE
		enroll_category ='Nursery';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `query_student_id_register` (IN `get_last_name` VARCHAR(100), IN `get_first_name` VARCHAR(80), IN `get_middle_name` VARCHAR(50))   BEGIN
	SELECT 
		student_id FROM tbl_student_info 
	WHERE 
		last_name = get_last_name 
        AND 
        first_name = get_first_name 
        AND 
        middle_name = get_middle_name 
        ORDER BY student_id DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `query_tbl_student_info` ()   BEGIN
	SELECT
		student_id,
        first_name,
        middle_name,
        last_name,
        enroll_category,
        date_created,
        date_updated
	FROM
		tbl_student_info
	WHERE
		isactive = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_tbl_student_info` (IN `get_student_id` INT)   BEGIN
    UPDATE 
		tbl_student_info
    SET 
		isactive = 0
    WHERE 
		student_id = get_student_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_enrollment_tbl_student_info` (IN `get_student_id` INT, IN `get_enroll_category` VARCHAR(50), IN `get_schoolyear` VARCHAR(50))   BEGIN
    UPDATE 
		tbl_student_info
	SET
		enroll_category = get_enroll_category, 
        schoolyear = get_schoolyear,
        date_updated = NOW() 
	WHERE
		student_id = get_student_id;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tbl_student_info` (IN `get_student_id` INT, IN `get_enrollment_info` VARCHAR(50), IN `get_schoolyear` VARCHAR(50), IN `get_last_name` VARCHAR(50), IN `get_first_name` VARCHAR(100), IN `get_middle_name` VARCHAR(50), IN `get_address` TEXT, IN `get_birthdate` DATE, IN `get_sex` VARCHAR(10), IN `get_parent1` VARCHAR(100), IN `get_parent1_contact` VARCHAR(20), IN `get_parent2` VARCHAR(100), IN `get_parent2_contact` VARCHAR(20), IN `get_emergency_fullname` VARCHAR(50), IN `get_emergency_relationship` VARCHAR(50), IN `get_emergency_address` TEXT, IN `get_emergency_contact_no` VARCHAR(20), IN `get_updated_by` INT, IN `get_isactive` TINYINT(1))   BEGIN
	UPDATE
		tbl_student_info
	SET
		enroll_category = get_enrollment_info,
        schoolyear = get_schoolyear,
        last_name = get_last_name,
        first_name = get_first_name,
        middle_name = get_middle_name,
        address = get_address,
        birthdate = get_birthdate,
        sex = get_sex,
        parent1 = get_parent1,
        parent1_contact = get_parent1_contact,
        parent2 = get_parent2,
        parent2_contact = get_parent1_contact,
        emergency_fullname = get_emergency_fullname,
        emergency_relationship = get_emergency_fullname,
        emergency_address = get_emergency_fullname,
        emergency_contact_no = get_emergency_fullname,
        updated_by = get_updated_by,
        date_updated = NOW(),
        isactive = get_isactive
    WHERE
		student_id = get_student_id;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL PRIMARY KEY,
  `employee_position` enum('Administrator','Cashier','Admission') NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `verify_pass` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isactive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `employee_position`, `username`, `password`, `last_name`, `first_name`, `middle_name`, `verify_pass`, `timestamp`, `isactive`) VALUES
(7, 'Administrator', 'jam04241', '$2y$10$.RfmVG9yII.hoc7x/VSreuLOqFSvwIFkEJUbJf1jPN4.NLcxQ8e/W', 'Magcalas', 'Josh Andrei', 'Mosqueda', '123', '2025-03-10 05:08:30', 1),
(8, 'Admission', 'Inday123', '$2y$10$CRyWaHpS3VHwnlbm5R1qW.YTdIZ1rUcz1lINhTW5Ai/WeqJZlxQpO', 'Inday', 'Charlize Jane', 'Secret', '123', '2025-03-10 05:08:35', 1),
(9, 'Cashier', 'lloyd123', '$2y$10$3WZrPj3QZy81tZihgQsAxe20oHGl5X1Ke4OTthNVZuRrePpHXurwi', 'Girozaga', 'John Lloyd', 'Secret', '123', '2025-03-10 05:08:39', 1),
(10, 'Administrator', 'sherjay123', '$2y$10$GkpbDOCNHa.IXEWCEHr1m.5yTHGGhA4DEgpDtkZfFNFZgPkIX68ti', 'Pasayloon', 'Sherjay', 'Buhat', '123', '2025-03-11 00:19:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_no` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `pay` decimal(5,2) DEFAULT NULL,
  `total` decimal(5,2) DEFAULT NULL,
  `balance` decimal(5,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `date_updated` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_no`, `student_id`, `pay`, `total`, `balance`, `created_by`, `date_created`, `updated_by`, `date_updated`, `status`) VALUES
(0, 34, NULL, NULL, NULL, 0, '2025-03-11 01:55:46', 0, '2025-03-11 01:55:46', 1),
(1, 16, NULL, NULL, NULL, 9876, '2025-03-10 06:54:06', 0, '2025-03-10 06:54:06', 1);

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
(1, 'Registration_Fee', 3000.00, '2025', '2026', '2025-03-09 08:26:26'),
(2, 'Books', 3050.00, '2025', '2026', '2025-03-09 08:26:32'),
(3, 'Tuition', 1700.00, '2025', '2026', '2025-03-09 08:26:39'),
(4, 'ID', 100.00, '2025', '2026', '2025-03-09 08:26:44'),
(5, 'School_kit', 1050.00, '2025', '2026', '2025-03-09 08:26:50'),
(6, 'PE_Uniform', 650.00, '2025', '2026', '2025-03-09 08:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_info`
--

CREATE TABLE `tbl_student_info` (
  `student_id` int(11) NOT NULL,
  `enroll_category` enum('Nursery','Kindergarten_1','Kindergarten_2','Tutor') DEFAULT NULL,
  `schoolyear` varchar(10) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `parent1` varchar(50) DEFAULT NULL,
  `parent1_contact` int(12) DEFAULT NULL,
  `parent2` varchar(50) DEFAULT NULL,
  `parent2_contact` int(12) DEFAULT NULL,
  `emergency_fullname` varchar(50) NOT NULL,
  `emergency_relationship` varchar(50) NOT NULL,
  `emergency_address` text NOT NULL,
  `emergency_contact_no` int(12) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`student_id`, `enroll_category`, `schoolyear`, `last_name`, `first_name`, `middle_name`, `address`, `birthdate`, `sex`, `parent1`, `parent1_contact`, `parent2`, `parent2_contact`, `emergency_fullname`, `emergency_relationship`, `emergency_address`, `emergency_contact_no`, `created_by`, `date_created`, `updated_by`, `date_updated`, `isactive`) VALUES
(1, 'Nursery', '2025-2026', 'Girozaga', 'John Doe', 'wew', 'ADSADSADS', '2025-03-01', 'Male', 'fghfghn', 34567, 'ghmnf', 34567, 'ghj', 'ghj', 'ghj', 0, NULL, '2025-03-10 10:22:24', 342, '2025-03-10 10:22:24', 1),
(2, 'Kindergarten_1', '', 'Magcalas', 'Josh Andrei', 'Mosqueda', 'Purok 20, San Roque, New Loon, Davao City', '2004-06-04', 'Male', 'Maria Betsy M. Magalas', 954364521, 'Jonas B. Magcalas', 954364521, 'Maria Betsy M. Magcalas', 'Maria Betsy M. Magcalas', 'Maria Betsy M. Magcalas', 0, NULL, '2025-03-10 10:18:28', 342, '2025-03-10 10:18:28', 1),
(3, 'Kindergarten_2', '2025-2026', 'ADSADS', 'Josh Andrei', 'Mosqueda', 'ADSADSADS', '2025-03-08', 'Female', 'DASDASDSADAS', 566745, 'BVBCVXBCFVX', 566745, 'BCVBCNVXBNVC', 'BCVBCNVXBNVC', 'BCVBCNVXBNVC', 0, NULL, '2025-03-10 04:59:57', 342, '2025-03-09 08:23:02', 1),
(4, 'Tutor', '2025-2026', 'ADS', 'ADS', 'adsD', 'ADS', '2025-03-14', 'Female', 'DS', 954364521, 'ADS', 954364521, 'ACDSFSV', 'DFSW', 'DFSV', 234, NULL, '2025-03-10 05:00:27', NULL, '2025-03-08 22:12:41', 1),
(5, 'Nursery', '2025-2026', 'Inday', 'Charlize Jane', 'Secret', 'Bangkal, Davao City', '2025-03-09', 'Female', 'Papa Lloyd', 2147483647, 'Mama Lloyd', 2147483647, 'Tita Lloyd', 'Tita Lloyd', 'Tita Lloyd', 0, NULL, '2025-03-10 11:08:43', 342, '2025-03-10 11:08:43', 1),
(13, 'Tutor', '2025-2026', 'fwdfds', 'bdfgdfgb', 'fgbbfv', 'fghdfghd', '2025-03-09', 'Female', 'hfgdfghd', 566745, 'fghfghddfgh', 566745, 'fgdhdfgh', 'hgdfgh', 'fghddfgh', 423, NULL, '2025-03-09 08:55:35', NULL, '2025-03-09 08:55:35', 1),
(16, 'Nursery', '2025-2026', 'QWE', 'QWE', 'QWE', 'UYTUT', '2025-03-10', 'Male', 'GHGFHF', 98765, 'CVBBVCB', 98765, 'ASDSAD', 'KISS', 'ASDASDSADASDSA', 23456, NULL, '2025-03-10 06:53:56', NULL, '2025-03-10 06:53:56', 1),
(17, 'Kindergarten_1', 'DASDAS', 'ds', 'sad', 'dssa', 'Purok 20, San Roque New Loon,Mintal', '0000-00-00', 'Male', 'BVBCVXBCFVX', 346, 'SDFCVN', 346, 'ZCVB ', 'ZCVB ', 'ZCVB ', 0, NULL, '2025-03-10 11:05:55', 342, '2025-03-10 11:05:55', 1),
(23, 'Nursery', 'GIL', 'G', 'MINTAL', '2025-04-01', 'male', '2025-03-25', 'Male', 'J', 566745, 'F', 566745, 'SSS', 'SSS', 'SSS', 0, NULL, '2025-03-10 11:05:36', 342, '2025-03-10 11:05:36', 1),
(24, 'Nursery', '2025-2026', 'dasd', 'asddsa', 'asdsda', 'dsasda', '2025-03-06', 'Female', 'jhgfds', 2134255, 'jhgfds', 2134255, 'hgfd', 'hgfd', 'hgfd', 0, NULL, '2025-03-11 02:01:14', 342, '2025-03-11 02:01:14', 1),
(28, NULL, NULL, 'Tayao', 'Miguel', 'Robles', 'yagaa', '2025-03-29', 'Female', 'vladimir', 123456, 'mother', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 7, '2025-03-11 01:42:29', NULL, '2025-03-11 01:42:29', 1),
(29, NULL, NULL, 'Tayao', 'Miguel', 'Robles', 'yagaa', '2025-03-29', 'Female', 'vladimir', 123456, 'mother', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 8, '2025-03-11 01:45:00', NULL, '2025-03-11 01:45:00', 1),
(30, NULL, NULL, 'Tayao', 'Miguel', 'Robles', 'yagaa', '2025-03-29', 'Female', 'vladimir', 123456, 'mother', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 8, '2025-03-11 01:46:57', NULL, '2025-03-11 01:46:57', 1),
(31, NULL, NULL, 'Tayao', 'Miguel', 'Robles', 'yagaa', '2025-03-29', 'Female', 'vladimir', 123456, 'mother', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 8, '2025-03-11 01:47:03', NULL, '2025-03-11 01:47:03', 1),
(32, NULL, NULL, 'Tayao', 'Miguel', 'Robles', 'yagaa', '2025-03-29', 'Female', 'vladimir', 123456, 'mother', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 8, '2025-03-11 01:48:09', NULL, '2025-03-11 01:48:09', 1),
(33, NULL, NULL, 'Francisco', 'Janrel', 'oten', 'yagaa', '2025-03-29', 'Male', 'vladimir', 123456, 'mother vlad', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 8, '2025-03-11 01:52:16', NULL, '2025-03-11 01:52:16', 1),
(34, NULL, NULL, 'Francisco', 'Janrel', 'oten', 'yagaa', '2025-03-29', 'Male', 'vladimir', 123456, 'mother vlad', 34566, 'wdscvghhfgcv', 'eee', 'qweehgf', 21345, 8, '2025-03-11 01:55:40', NULL, '2025-03-11 01:55:40', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_no`),
  ADD UNIQUE KEY `admin_id` (`created_by`),
  ADD UNIQUE KEY `student_id` (`student_id`);

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
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  ADD CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `tbl_employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
