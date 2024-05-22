-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2023 at 03:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reg_veh`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `STATUS` (IN `v_no` CHAR(10) CHARSET utf8, IN `vdate` DATE, IN `u_id` INT(11))   BEGIN 
UPDATE insurance SET insurance.insurance_status=
(CASE WHEN vdate > CURDATE() 
 THEN 'ACTIVE'
 ELSE 'EXPIRED'
 END)
 WHERE insurance.user_id = u_id AND insurance.veh_no = v_no ; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `STATUS_PUC` (IN `u_id` INT(11), IN `vtill` DATE, IN `v_no` CHAR(10) CHARSET utf8)   BEGIN 
UPDATE puc SET puc.status=
(CASE WHEN vtill > CURDATE() 
 THEN 'ACTIVE'
 ELSE 'EXPIRED'
 END)
 WHERE puc.user_id = u_id AND puc.veh_no = v_no; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_unique` (IN `u_id` INT(11), IN `v_no` CHAR(10) CHARSET utf8)   BEGIN
    DECLARE random_value INT(10);
    SET random_value = FLOOR(1 + RAND() * (1000000 - 1));

    UPDATE stolen_reports SET REPORT_ID = random_value
    WHERE USER_ID = u_id AND VEH_NO = v_no
    AND NOT EXISTS (SELECT * FROM stolen_reports WHERE REPORT_ID = random_value)
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_unique_random` (IN `u_id` INT(11), IN `v_no` CHAR(10) CHARSET utf8)   BEGIN
    DECLARE random_value INT(11);
    SET random_value = FLOOR(1 + RAND() * (1000000 - 1));

    UPDATE puc SET puc_no = random_value
    WHERE user_id = u_id AND veh_no = v_no
    AND NOT EXISTS (SELECT * FROM puc WHERE puc_no = random_value)
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_unique_random_value` (IN `u_id` INT(11), IN `v_no` CHAR(10) CHARSET utf8)   BEGIN
    DECLARE random_value INT(11);
    SET random_value = FLOOR(1 + RAND() * (1000000 - 1));

    UPDATE insurance SET insurance_no = random_value
    WHERE user_id = u_id AND veh_no = v_no
    AND NOT EXISTS (SELECT * FROM insurance WHERE insurance_no = random_value)
    LIMIT 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `challan_details`
--

CREATE TABLE `challan_details` (
  `VEH_NO` char(10) NOT NULL,
  `CHALLAN_NO` bigint(20) NOT NULL,
  `AMOUNT` int(11) DEFAULT NULL,
  `OFFENCE_TYPE` varchar(25) DEFAULT NULL,
  `OFFENCE_DATE` date DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challan_details`
--

INSERT INTO `challan_details` (`VEH_NO`, `CHALLAN_NO`, `AMOUNT`, `OFFENCE_TYPE`, `OFFENCE_DATE`, `STATUS`) VALUES
('KA02HR1234', 98754, 1500, 'ONE_WAY', '2022-03-22', 'ACTIVE'),
('KA03RT7856', 24354, 1000, 'NO HELMET', '2022-03-30', 'ACTIVE'),
('KA34EY8098', 87557, 2000, 'NO INSURANCE', '2022-02-18', 'ACTIVE'),
('KA94NR4533', 78555, 1000, 'NO HELMET', '2022-02-14', 'ACTIVE'),
('KL56HV4324', 25622, 2000, 'NO SEATBELT', '2021-12-28', 'ACTIVE'),
('TN23VH2134', 65333, 500, 'NO PUC', '2021-10-30', 'ACTIVE'),
('TN34RY5134', 24355, 4500, 'NO LICENSE', '2021-05-15', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `veh_no` char(10) NOT NULL,
  `rc_no` char(10) DEFAULT NULL,
  `insurance_no` bigint(20) DEFAULT NULL,
  `puc_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`veh_no`, `rc_no`, `insurance_no`, `puc_no`) VALUES
('HR12TH1432', 'HR12TH1432', 3476355, '9UT43098'),
('KA02HR1234', 'KA02HR1234', 1234567, '1AB09231'),
('KA03RT7856', 'KA03RT7856', 399846, '379300'),
('KA03VT4324', 'KA03VT4324', 7946532, '3RT78942'),
('KA21VH4321', 'KA21VH4321', 4545678, '5RTW4245'),
('KA34EY8098', 'KA34EY8098', 2745354, '2JK34524'),
('KA94NR4533', 'KA94NR4533', 3950635, '2YT32456'),
('KA97HR9987', 'KA97HR9987', 9876242, '478400'),
('KA98HA9873', 'KA98HA9873', 3895372, '2ERT2346'),
('KL56HV4324', 'KL56HV4324', 8765454, '4HG34285'),
('MH43VR0291', 'MH43VR0291', 136687, '195213'),
('MH43VR0297', 'MH43VR0297', 9876234, '9WD24113'),
('TN23VH2134', 'TN23VH2134', 3456712, '3WE09872'),
('TN34RY5134', 'TN34RY5134', 4583295, '6YU2234R');

-- --------------------------------------------------------

--
-- Table structure for table `fitness`
--

CREATE TABLE `fitness` (
  `VEH_NO` char(10) NOT NULL,
  `VALIDITY` varchar(10) DEFAULT NULL,
  `NEXT_DUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fitness`
--

INSERT INTO `fitness` (`VEH_NO`, `VALIDITY`, `NEXT_DUE_DATE`) VALUES
('HR12TH1432', 'ACTIVE', '2024-03-23'),
('KA02HR1234', 'ACTIVE', '2027-03-23'),
('KA03RT7856', 'ACTIVE', '2023-10-26'),
('KA03VT4324', 'ACTIVE', '2029-04-13'),
('KA21VH4321', 'ACTIVE', '2027-03-12'),
('KA34EY8098', 'ACTIVE', '2035-03-14'),
('KA94NR4533', 'ACTIVE', '2027-06-24'),
('KA98HA9873', 'EXPIRED', '2022-11-04'),
('KL56HV4324', 'ACTIVE', '2030-07-23'),
('MH43VR0297', 'ACTIVE', '2031-05-17'),
('TN23VH2134', 'ACTIVE', '2027-07-30'),
('TN34RY5134', 'ACTIVE', '2025-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `user_id` int(11) NOT NULL,
  `insurance_no` bigint(20) DEFAULT NULL,
  `veh_no` char(10) NOT NULL,
  `chassis_no` int(11) DEFAULT NULL,
  `owner_name` varchar(25) DEFAULT NULL,
  `maker` varchar(15) DEFAULT NULL,
  `model` varchar(15) DEFAULT NULL,
  `insurance_status` varchar(15) DEFAULT NULL,
  `insurance_expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`user_id`, `insurance_no`, `veh_no`, `chassis_no`, `owner_name`, `maker`, `model`, `insurance_status`, `insurance_expiry`) VALUES
(1234, 1234567, 'KA02HR1234', 12345, 'RAMESH KUMAR', 'BAJAJ', 'PULSAR', 'ACTIVE', '2023-12-11'),
(2452, 3895372, 'KA98HA9873', 5134, 'KARTIK GOWDA', 'HYABUSA', 'AE650', 'EXPIRED', '2020-01-29'),
(3452, 3476355, 'HR12TH1432', 134123, 'SUMAN KUMAR', 'HONDA', 'CIVIC', 'ACTIVE', '2024-08-19'),
(4123, 399846, 'KA03RT7856', 34211, 'ATIF KHAN', 'TVS', 'JUPITER', 'ACTIVE', '2023-02-21'),
(4311, 9876234, 'MH43VR0297', 67809, 'GALADA SAIT', 'HONDA', 'ACTIVA', 'ACTIVE', '2025-04-25'),
(5678, 4545678, 'KA21VH4321', 34454, 'SURESH GOWDA', 'YAMAHA', 'R15', 'ACTIVE', '2023-11-24'),
(6754, 2745354, 'KA34EY8098', 452221, 'FARDIN KHAN', 'TATA', 'NEXON', 'ACTIVE', '2025-07-20'),
(7424, 49055, 'KA94NR4533', 8933, 'RAPATI MANU', 'BMV', 'X10', 'EXPIRED', '2022-07-18'),
(7424, 136687, 'MH43VR0291', 67819, 'RAPATI MANU', 'LAMBORGHINI', 'AVENTADOR', 'ACTIVE', '2023-02-21'),
(7432, 8765454, 'KL56HV4324', 124341, 'JAKE PAUL', 'MG', 'HECTOR', 'ACTIVE', '2023-05-20'),
(7567, 7946532, 'KA03VT4324', 54223, 'SAIF KHALIL', 'TVS', 'APACHE', 'EXPIRED', '2019-05-16'),
(7648, 4583295, 'TN34RY5134', 543252, 'ASLAM BASHA', 'FORD', 'MUSTANG', 'ACTIVE', '2023-02-26'),
(9012, 3456712, 'TN23VH2134', 56789, 'MUNISWAMY IYER', 'TVS', 'STAR CITY', 'EXPIRED', '2017-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `user_id` int(11) NOT NULL,
  `owner_name` varchar(25) DEFAULT NULL,
  `veh_no` char(10) NOT NULL,
  `owner_ph` bigint(20) DEFAULT NULL,
  `dl_no` varchar(15) DEFAULT NULL,
  `purchased_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`user_id`, `owner_name`, `veh_no`, `owner_ph`, `dl_no`, `purchased_year`) VALUES
(1234, 'RAMESH KUMAR', 'KA02HR1234', 1234567890, 'MH12 02123643', 2016),
(1235, 'MOTALAL', 'MH43VR0297', 2087358083, 'MH34 234987342', 2014),
(2452, 'KARTIK GOWDA', 'KA98HA9873', 1234467477, 'MP54 35823648', 2013),
(3452, 'SUMAN KUMAR', 'HR12TH1432', 1356658458, 'KA24 364583276', 2018),
(4123, 'ATIF KHAN', 'KA03RT7856', 1122334455, 'UP27 344534776', 2009),
(4311, 'GALADA SAIT', 'MH43VR0297', 1234325433, 'GJ24 2548234689', 2001),
(5678, 'SURESH GOWDA', 'KA21VH4321', 1987654321, 'AP26 2035585764', 2016),
(6754, 'FARDIN KHAN', 'KA34EY8098', 1239067564, 'GJ23 635483695', 2010),
(7424, 'RAPATI MANU', 'KA94NR4533', 1567478744, 'HJ33 356546674', 2020),
(7432, 'JAKE PAUL', 'KL56HV4324', 1247683568, 'UP43 435876289', 2019),
(7567, 'SAIF KHALIL', 'KA03VT4324', 1445674577, 'AP26 567482364', 2021),
(7648, 'ASLAM BASHA', 'TN34RY5134', 1278548643, 'KA23 354864253', 2017),
(9012, 'MUNISWAMY IYER', 'TN23VH2134', 1236549871, 'MP37 374236482', 2011);

-- --------------------------------------------------------

--
-- Table structure for table `puc`
--

CREATE TABLE `puc` (
  `user_id` int(11) NOT NULL,
  `puc_no` int(10) DEFAULT NULL,
  `veh_no` char(10) NOT NULL,
  `maker` varchar(15) DEFAULT NULL,
  `model` varchar(15) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `valid_till` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `puc`
--

INSERT INTO `puc` (`user_id`, `puc_no`, `veh_no`, `maker`, `model`, `status`, `valid_till`) VALUES
(1234, 754746, 'KA02HR1234', 'BAJAJ', 'PULSAR', 'ACTIVE', '2023-04-23'),
(1235, 183786, 'KA98HA9873', 'HYABUSA', 'AE650', 'EXPIRED', '2022-09-14'),
(3452, 559234, 'HR12TH1432', 'HONDA', 'CIVIC', 'ACTIVE', '2023-05-30'),
(4123, 379300, 'KA03RT7856', 'TVS', 'JUPITER', 'ACTIVE', '2023-02-07'),
(4311, 342373, 'MH43VR0297', 'HONDA', 'ACTIVA', 'EXPIRED', '2022-10-05'),
(5678, 757050, 'KA21VH4321', 'YAMAHA', 'R15', 'EXPIRED', '2022-07-14'),
(6754, 953282, 'KA34EY8098', 'TATA', 'NEXON', 'EXPIRED', '2022-11-23'),
(7424, 384563, 'KA94NR4533', 'BMV', 'X10', 'ACTIVE', '2023-06-30'),
(7424, 478400, 'KA97HR9987', 'BUGATTI', 'VEYRON', 'EXPIRED', '2021-02-01'),
(7424, 195213, 'MH43VR0291', 'LAMBORGHINI', 'AVENTADOR', 'EXPIRED', '2021-02-01'),
(7432, 517108, 'KL56HV4324', 'MG', 'HECTOR', 'ACTIVE', '2023-04-29'),
(7567, 624082, 'KA03VT4324', 'TVS', 'APACHE', 'ACTIVE', '2023-01-29'),
(7648, 105132, 'TN34RY5134', 'FORD', 'MUSTANG', 'ACTIVE', '2023-06-27'),
(9012, 356193, 'TN23VH2134', 'TVS', 'STAR CITY', 'EXPIRED', '2022-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `registered_vehicle`
--

CREATE TABLE `registered_vehicle` (
  `user_id` int(11) NOT NULL,
  `veh_id` int(10) NOT NULL,
  `veh_no` char(10) NOT NULL,
  `maker` varchar(15) DEFAULT NULL,
  `model` varchar(15) DEFAULT NULL,
  `veh_type` varchar(10) DEFAULT NULL,
  `engine_cc` int(11) DEFAULT NULL,
  `chassis_no` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registered_vehicle`
--

INSERT INTO `registered_vehicle` (`user_id`, `veh_id`, `veh_no`, `maker`, `model`, `veh_type`, `engine_cc`, `chassis_no`) VALUES
(1234, 2, 'KA02HR1234', 'BAJAJ', 'PULSAR', '2 WHEELER', 150, 12345),
(1235, 8, 'KA98HA9873', 'HYABUSA', 'AE650', '2 WHEELER', 650, 5134),
(1235, 17, 'MH43VR0299', 'HONDA', 'ACTIVA', '2 WHEELER', 110, 67819),
(3452, 1, 'HR12TH1432', 'HONDA', 'CIVIC', '4 WHEELER', 1200, 134123),
(4123, 3, 'KA03RT7856', 'TVS', 'JUPITER', '2 WHEELER', 115, 34211),
(4311, 10, 'MH43VR0297', 'HONDA', 'ACTIVA', '2 WHEELER', 110, 67809),
(5678, 5, 'KA21VH4321', 'YAMAHA', 'R15', '2 WHEELER', 220, 34454),
(6754, 6, 'KA34EY8098', 'TATA', 'NEXON', '4 WHEELER', 1500, 452221),
(7424, 7, 'KA94NR4533', 'BMW', 'X10', '2 WHEELER', 310, 8933),
(7424, 18, 'KA97HR9987', 'BUGATTI', 'VEYRON', '4 WHEELER', 3500, 123456),
(7424, 36, 'MH43VR0291', 'LAMBORGHINI', 'AVENTADOR', '4 WHEELER', 3000, 67819),
(7432, 9, 'KL56HV4324', 'MG', 'HECTOR', '4 WHEELER', 1800, 124341),
(7567, 4, 'KA03VT4324', 'TVS', 'APACHE', '2 WHEELER', 180, 54223),
(7648, 12, 'TN34RY5134', 'FORD', 'MUSTANG', '4 WHEELER', 1000, 543252),
(9012, 11, 'TN23VH2134', 'TVS', 'STAR CITY', '2 WHEELER', 110, 56789);

-- --------------------------------------------------------

--
-- Table structure for table `reg_certificate`
--

CREATE TABLE `reg_certificate` (
  `rc_no` char(10) NOT NULL,
  `veh_type` varchar(10) DEFAULT NULL,
  `veh_no` char(10) DEFAULT NULL,
  `owner_name` varchar(25) DEFAULT NULL,
  `date_of_reg` date DEFAULT NULL,
  `reg_validity` date DEFAULT NULL,
  `engine_no` bigint(20) DEFAULT NULL,
  `chassis_no` int(11) DEFAULT NULL,
  `rto_name` varchar(25) DEFAULT NULL,
  `fuel_type` varchar(10) DEFAULT NULL,
  `emission_norms` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reg_certificate`
--

INSERT INTO `reg_certificate` (`rc_no`, `veh_type`, `veh_no`, `owner_name`, `date_of_reg`, `reg_validity`, `engine_no`, `chassis_no`, `rto_name`, `fuel_type`, `emission_norms`) VALUES
('HR12TH1432', '4 WHEELER', 'HR12TH1432', 'SUMAN KUMAR', '2022-12-23', '2024-03-23', 78979865, 134123, 'CHANDIGARH', 'DIESEL', 'BSVI'),
('KA02HR1234', '2 WHEELER', 'KA02HR1234', 'RAMESH KUMAR', '2014-05-12', '2027-03-23', 328947, 12345, 'KASTURI NAGAR', 'PETROL', 'BSIV'),
('KA03RT7856', '2 WHEELER', 'KA03RT7856', 'ATIF KHAN', '2003-10-14', '2023-10-26', 646546, 34211, 'CHITRADURGA', 'PETROL', 'BSVI'),
('KA03VT4324', '2 WHEELER', 'KA03VT4324', 'SAIF KHALIL', '2014-10-30', '2029-04-13', 31165466, 54223, 'BELLARI', 'PETROL', 'BSVI'),
('KA21VH4321', '2 WHEELER', 'KA21VH4321', 'SURESH GOWDA', '2002-02-06', '2027-03-12', 984578, 34454, 'KR PURAM', 'PETROL', 'BSIV'),
('KA34EY8098', '4 WHEELER', 'KA34EY8098', 'FARDIN KHAN', '2022-02-12', '2035-03-14', 65416565, 452221, 'KR PURAM', 'PETROL', 'BSVI'),
('KA86CY5390', '2 WHEELER', 'KA86CY5390', 'RAPATI MANU', '2002-03-19', '2023-04-20', 12314, 67819, 'KASTURINAGAR', 'PETROL', 'BSIV'),
('KA94NR4533', '2 WHEELER', 'KA94NR4533', 'RAPATI MANU', '2011-03-19', '2027-06-24', 65541651, 8933, 'SHIVAMOGGA', 'PETROL', 'BSIV'),
('KA97HR9987', '4 WHEELER', 'KA97HR9987', 'RAPATI MANU', '2002-03-19', '2023-04-20', 12314, 67819, 'KASTURINAGAR', 'DIESEL', 'BSIV'),
('KA98HA9873', '2 WHEELER', 'KA98HA9873', 'KARTIK GOWDA', '2001-02-24', '2022-11-04', 6546653, 5134, 'SHIVAMOGGA', 'PETROL', 'BSIV'),
('KL56HV4324', '4 WHEELER', 'KL56HV4324', 'JAKE PAUL', '2021-03-21', '2030-07-23', 6545646, 124341, 'TRIVANDRUM', 'DIESEL', 'BSIV'),
('MH43VR0291', '4 WHEELER', 'MH43VR0291', 'RAPATI MANU', '2002-03-19', '2023-04-20', 12314, 67819, 'KASTURINAGAR', 'PETROL', 'BSIV'),
('MH43VR0297', '2 WHEELER', 'MH43VR0297', 'GALADA SAIT', '2003-02-20', '2031-05-17', 6546846, 67809, 'THANE ', 'PETROL', 'BSIV'),
('TN23VH2134', '2 WHEELER', 'TN23VH2134', 'MUNISWAMY IYER', '2007-06-23', '2027-07-30', 87423535, 56789, 'CHENNAI CENTRAL', 'PETROL', 'BSIV'),
('TN34RY5134', '4 WHEELER', 'TN34RY5134', 'ASLAM BASHA', '2009-04-28', '2025-04-21', 6516511, 543252, 'VELLORE DIST.', 'DIESEL', 'BSVI');

-- --------------------------------------------------------

--
-- Table structure for table `stolen_reports`
--

CREATE TABLE `stolen_reports` (
  `USER_ID` int(11) NOT NULL,
  `REPORT_ID` int(10) NOT NULL,
  `VEH_NO` char(10) NOT NULL,
  `DATE_OF_REPORT` date DEFAULT NULL,
  `AREA_OF_LAST_SEEN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stolen_reports`
--

INSERT INTO `stolen_reports` (`USER_ID`, `REPORT_ID`, `VEH_NO`, `DATE_OF_REPORT`, `AREA_OF_LAST_SEEN`) VALUES
(1235, 246829, 'KA98HA9873', '2022-09-22', 'BANGALORE'),
(7424, 490316, 'KA97HR9987', '2023-02-06', 'In YouTube');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `password`, `fname`, `lname`, `email`, `username`) VALUES
(1234, 'ADMIN', '1243vas', 'RAMESH', 'KUMAR', 'ramesha123@dummy.com', 'ramesh123'),
(1235, 'USER', 'asdasda', 'MOTALAL', NULL, 'motalal123@gmail.com', 'motalaltin'),
(2452, 'USER', 'rt54tfwre', 'KARTHIK', 'GOWDA', 'gowdakarthik@gmail.com', 'karthikgo123'),
(3452, 'USER', '5243t3', 'SUMAN', 'KUMAR', 'sumannk342@gmail.com', 'sumankumar123'),
(4123, 'USER', '24rfweg', 'ATIF', 'KHAN', 'itsatif123@abc.com', 'atifkhan134'),
(4311, 'USER', 'dt34sdf', 'GALADA', 'SAIT', 'saitgalada@gmail.com', 'galadasait314'),
(5678, 'USER', '4235fda', 'SURESH', 'GOWDA', 'gowdru@gmail.com', 'gowdanice'),
(6754, 'USER', 'rwetwt', 'FARDIN', 'KHAN', 'khanfardin345@yahoo.com', 'khanfardin'),
(7424, 'USER', 'gwrt45', 'RAPATI', 'MANU', 'nitishrapati@gmail.com', 'rapati'),
(7432, 'USER', 'FKJKNAS', 'JAKE', 'PAUL', 'paul34@abc.com', 'jakepirate'),
(7567, 'USER', 't34erf', 'SAIF', 'KHALIL', 'itskhalil@nice.com', 'khalil007'),
(7648, 'USER', 'tw534wg', 'ASLAM', 'BASHA', 'aslambash1123@gmail.com', 'aslam123'),
(9012, 'USER', 'agse2534', 'MUNISWAMY', 'IYER', 'swamymuni@haha.com', 'samemuni23'),
(9017, 'USER', '123456', 'aaaa', 'sasa', 'mdswwws@gmail.com', 'saaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challan_details`
--
ALTER TABLE `challan_details`
  ADD PRIMARY KEY (`VEH_NO`,`CHALLAN_NO`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`veh_no`),
  ADD KEY `rc_no_idx` (`rc_no`),
  ADD KEY `insurance_no_idx` (`insurance_no`);

--
-- Indexes for table `fitness`
--
ALTER TABLE `fitness`
  ADD PRIMARY KEY (`VEH_NO`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`user_id`,`veh_no`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `puc`
--
ALTER TABLE `puc`
  ADD PRIMARY KEY (`user_id`,`veh_no`);

--
-- Indexes for table `registered_vehicle`
--
ALTER TABLE `registered_vehicle`
  ADD PRIMARY KEY (`user_id`,`veh_no`),
  ADD UNIQUE KEY `veh_id` (`veh_id`) USING BTREE;

--
-- Indexes for table `reg_certificate`
--
ALTER TABLE `reg_certificate`
  ADD PRIMARY KEY (`rc_no`);

--
-- Indexes for table `stolen_reports`
--
ALTER TABLE `stolen_reports`
  ADD PRIMARY KEY (`REPORT_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registered_vehicle`
--
ALTER TABLE `registered_vehicle`
  MODIFY `veh_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `stolen_reports`
--
ALTER TABLE `stolen_reports`
  MODIFY `REPORT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=490318;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9018;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `challan_details`
--
ALTER TABLE `challan_details`
  ADD CONSTRAINT `F` FOREIGN KEY (`VEH_NO`) REFERENCES `registered_vehicle` (`veh_no`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `rc_no` FOREIGN KEY (`rc_no`) REFERENCES `reg_certificate` (`rc_no`);

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `puc`
--
ALTER TABLE `puc`
  ADD CONSTRAINT `puc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `puc_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `registered_vehicle`
--
ALTER TABLE `registered_vehicle`
  ADD CONSTRAINT `registered_vehicle_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `stolen_reports`
--
ALTER TABLE `stolen_reports`
  ADD CONSTRAINT `stolen_reports_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `uid_sr` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
