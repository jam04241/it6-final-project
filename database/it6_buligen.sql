-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 06:02 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_store_tbl_employees` (IN `get_type` ENUM('Administrator','Cashier','Admission'), IN `get_lastname` VARCHAR(100), IN `get_first_name` VARCHAR(100), IN `get_middle_name` VARCHAR(100), IN `get_username` VARCHAR(50), IN `get_password_hashed` VARCHAR(255), IN `get_verify_pass` VARCHAR(255))   BEGIN
    INSERT INTO tbl_employees (
        type, lastname, first_name, Middle_name, username, password_hashed, verify_pass, timestamp
    ) 
    VALUES (
        get_type, get_lastname, get_first_name, get_middle_name, 
        get_username, get_password_hashed, get_verify_pass, NOW()
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_schoolyear` (IN `get_name` VARCHAR(12), IN `get_fee_price` DECIMAL(11,2), IN `get_effective_year` YEAR(4), IN `get_end_year` YEAR(4))   BEGIN
    INSERT INTO tbl_schoolyear (
        name, fee_price, effective_year, end_year, timestamp
    ) 
    VALUES (
        get_name, get_fee_price, get_effective_year, get_end_year, NOW()
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tbl_student_info` (IN `get_enroll_category` ENUM('Nursery','Kindergarten 1','Kindergarten 2','Tutor'), IN `get_last_name` VARCHAR(100), IN `get_first_name` VARCHAR(100), IN `get_middle_initial` VARCHAR(10), IN `get_address` TEXT, IN `get_birthdate` DATE, IN `get_sex` ENUM('Male','Female'), IN `get_parent1` VARCHAR(100), IN `get_parent1_contact` VARCHAR(20), IN `get_parent2` VARCHAR(100), IN `get_parent2_contact` VARCHAR(20), IN `get_emergency_fullname` VARCHAR(100), IN `get_emergency_relationship` VARCHAR(50), IN `get_emergency_address` TEXT, IN `get_emergency_contact_no` VARCHAR(20), IN `get_admission_id` INT, IN `get_isactive` TINYINT)   BEGIN
    INSERT INTO tbl_student_info (
        enroll_category, last_name, first_name, middle_inital, 
        address, birthdate, sex, parent1, parent1_contact, parent2, parent2_contact, 
        emergency_fullname, emergency_relationship, emergency_address, emergency_contact_no, 
        admission_id, timestamp, isactive
    ) 
    VALUES (
        get_student_id, get_enroll_category, get_last_name, get_first_name, get_middle_initial, 
        get_address, get_birthdate, get_sex, get_parent1, get_parent1_contact, get_parent2, get_parent2_contact, 
        get_emergency_fullname, get_emergency_relationship, get_emergency_address, get_emergency_contact_no, 
        get_admission_id, NOW(), get_isactive
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Student_Info` (IN `get_enroll_category` ENUM('Nursery','Kindergarten 1','Kindergarten 2','Tutor'), IN `get_last_name` VARCHAR(100), IN `get_first_name` VARCHAR(100), IN `get_middle_initial` VARCHAR(10), IN `get_address` TEXT, IN `get_birthdate` DATE, IN `get_sex` ENUM('Male','Female'), IN `get_parent1` VARCHAR(100), IN `get_parent1_contact` VARCHAR(20), IN `get_parent2` VARCHAR(100), IN `get_parent2_contact` VARCHAR(20), IN `get_emergency_fullname` VARCHAR(100), IN `get_emergency_relationship` VARCHAR(50), IN `get_emergency_address` TEXT, IN `get_emergency_contact_no` VARCHAR(20), IN `get_admission_id` INT, IN `get_isactive` TINYINT)   BEGIN
    INSERT INTO tbl_student_info (
        enroll_category, last_name, first_name, middle_inital, 
        address, birthdate, sex, parent1, parent1_contact, parent2, parent2_contact, 
        emergency_fullname, emergency_relationship, emergency_address, emergency_contact_no, 
        admission_id, timestamp, isactive
    ) 
    VALUES (
        get_student_id, get_enroll_category, get_last_name, get_first_name, get_middle_initial, 
        get_address, get_birthdate, get_sex, get_parent1, get_parent1_contact, get_parent2, get_parent2_contact, 
        get_emergency_fullname, get_emergency_relationship, get_emergency_address, get_emergency_contact_no, 
        get_admission_id, NOW(), get_isactive
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(11) NOT NULL,
  `type` enum('Admin','Cashier','Admission') NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `Middle_name` varchar(50) NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `password_hashed` varchar(255) DEFAULT NULL,
  `verify_pass` varchar(16) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `admin_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(1, 'Registration_Fee', 3000.00, '0000', '0000', '2025-03-05 16:35:40'),
(2, 'Books', 3050.00, '0000', '0000', '2025-03-05 16:35:40'),
(3, 'Tuition', 1700.00, '0000', '0000', '2025-03-05 16:35:40'),
(4, 'ID', 100.00, '0000', '0000', '2025-03-05 16:35:40'),
(5, 'School_kit', 1050.00, '0000', '0000', '2025-03-05 16:35:40'),
(6, 'PE_Uniform', 650.00, '0000', '0000', '2025-03-05 16:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_info`
--

CREATE TABLE `tbl_student_info` (
  `student_id` int(11) NOT NULL,
  `enroll_category` enum('Nursery','Kindergarten 1','Kindergarten 2','Tutor') NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_inital` varchar(50) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `parent1` varchar(50) DEFAULT NULL,
  `parent1_contact` int(12) DEFAULT NULL,
  `parent2` varchar(50) DEFAULT NULL,
  `parent2_contact` int(12) DEFAULT NULL,
  `emergency_fullname` varchar(50) NOT NULL,
  `emergency_relationship` varchar(50) NOT NULL,
  `emergency_address` varchar(50) NOT NULL,
  `emergency_contact_no` int(12) NOT NULL,
  `admission_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_info`
--

INSERT INTO `tbl_student_info` (`student_id`, `enroll_category`, `last_name`, `first_name`, `middle_inital`, `address`, `birthdate`, `sex`, `parent1`, `parent1_contact`, `parent2`, `parent2_contact`, `emergency_fullname`, `emergency_relationship`, `emergency_address`, `emergency_contact_no`, `admission_id`, `timestamp`, `isactive`) VALUES
(1, 'Nursery', 'Magcalas', 'Josh Andrei', 'Mosqueda', 'Purok 20, San Roque, New Loon, Davao City', '2004-06-04', 'Male', 'Maria Betsy M. Magalas', 954364521, 'Jonas B. Magcalas', 954364521, 'Maria Betsy M. Magcalas', 'Biological Mother', 'Purok 20, San Roque, New Loon, Davao City', 932143221, 0, '2025-03-04 08:52:09', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_no`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

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
  ADD UNIQUE KEY `admin_id` (`admission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_student_info`
--
ALTER TABLE `tbl_student_info`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
