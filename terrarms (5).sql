-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 04:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terrarms`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation_log`
--

CREATE TABLE `allocation_log` (
  `id` int(11) NOT NULL,
  `allocation_type` enum('budget','crop','equipment','fertilizer','labor') NOT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `allocation_land` float DEFAULT NULL,
  `allocation_water` float DEFAULT NULL,
  `allocation_ferti` float DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `allocation_qty` float DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  `allocation_date` date NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `allocation_task` varchar(255) DEFAULT NULL,
  `work_hrs` float DEFAULT NULL,
  `prod_rate` int(11) DEFAULT NULL,
  `expenses_cat` text DEFAULT NULL,
  `amnt_budgeted` float DEFAULT NULL,
  `amnt_actual` float DEFAULT NULL,
  `amnt_remaining` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allocation_log`
--

INSERT INTO `allocation_log` (`id`, `allocation_type`, `crop_id`, `allocation_land`, `allocation_water`, `allocation_ferti`, `start_date`, `end_date`, `equipment_id`, `field_id`, `item_id`, `quantity`, `allocation_qty`, `percentage`, `allocation_date`, `employee_id`, `allocation_task`, `work_hrs`, `prod_rate`, `expenses_cat`, `amnt_budgeted`, `amnt_actual`, `amnt_remaining`) VALUES
(1, 'crop', 1, 1200, 2500, 60, '2023-02-01', '2023-06-30', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(2, 'crop', 2, 800, 1800, 40, '2023-03-01', '2023-07-31', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(3, 'crop', 3, 1000, 2000, 50, '2023-01-15', '2023-06-15', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(4, 'crop', 4, 1500, 3000, 75, '2023-02-15', '2023-07-31', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(5, 'crop', 5, 900, 1900, 45, '2023-03-15', '2023-08-15', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(6, 'equipment', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', 1, 1, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(7, 'equipment', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', 2, 2, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(8, 'equipment', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', 3, 3, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(9, 'equipment', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', 4, 4, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(10, 'equipment', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', 5, 5, NULL, 0, 0, 0, '0000-00-00', NULL, '', 0, 0, '0', 0, 0, 0),
(12, 'fertilizer', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, 38, 750, 60, 8, '2024-10-14', NULL, '', 0, 0, '0', 0, 0, 0),
(13, 'fertilizer', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, 39, 300, 25, 8, '2024-10-14', NULL, '', 0, 0, '0', 0, 0, 0),
(14, 'labor', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', 2, 'Harvesting Rice', 48, 4, '0', 0, 0, 0),
(15, 'labor', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', 3, 'Daily Check-up and Maintenance', 40, 4, '0', 0, 0, 0),
(16, 'labor', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', 1, 'Planting Corn', 48, 4, '0', 0, 0, 0),
(17, 'labor', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', 4, 'Irrigation Set-up /\nOperator for Tractors', 48, 4, '0', 0, 0, 0),
(18, 'labor', NULL, 0, 0, 0, '0000-00-00', '0000-00-00', NULL, NULL, NULL, 0, 0, 0, '0000-00-00', 8, 'In-charge on Piggery', 48, 4, '0', 0, 0, 0),
(21, 'budget', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, 'Wala lang, gastador eh', 500, 123, 377);

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `id` int(11) NOT NULL,
  `crop_nm` varchar(255) NOT NULL,
  `est_yield` int(11) DEFAULT NULL,
  `planting_dt` date DEFAULT NULL,
  `harvest_dt` date DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`id`, `crop_nm`, `est_yield`, `planting_dt`, `harvest_dt`, `field_id`) VALUES
(1, 'Carrots', 4000, '2024-08-01', '2024-12-01', 1),
(2, 'Yellow Corn', 3500, '2024-07-15', '2024-11-15', 4),
(3, 'Lakatan', 600, '2024-03-01', '2025-05-01', 7),
(4, 'Qn Victoria Pineapple', 1200, '2024-03-01', '2025-03-01', 2),
(5, 'Cherry Tomato', 300, '2024-02-01', '2024-05-01', 5);

-- --------------------------------------------------------

--
-- Table structure for table `crop_log`
--

CREATE TABLE `crop_log` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `record_type` enum('fertilization','pest control','harvest') NOT NULL,
  `dt_applied` date DEFAULT NULL,
  `fertilizer_type` text DEFAULT NULL,
  `treatment` varchar(255) DEFAULT NULL,
  `harvest_dt_act` date DEFAULT NULL,
  `harvest_oc` enum('Pending','Harvested','Failed') DEFAULT NULL,
  `act_yield` int(11) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_log`
--

INSERT INTO `crop_log` (`id`, `crop_id`, `record_type`, `dt_applied`, `fertilizer_type`, `treatment`, `harvest_dt_act`, `harvest_oc`, `act_yield`, `notes`, `employee_id`) VALUES
(1, 1, 'pest control', '2024-07-05', '', 'Organic Spray', '0000-00-00', 'Pending', 0, 'Applied neem oil', 3),
(2, 2, 'pest control', '2024-06-25', '', 'Organic Pesticide', '0000-00-00', 'Pending', 0, 'Used organic neem-based pesticide', 3),
(3, 3, 'pest control', '2024-04-15', '', 'Biopesticide', '0000-00-00', 'Pending', 0, 'Applied biopesticide from compost', 3),
(4, 4, 'pest control', '2024-05-25', '', 'Organic Insecticide', '0000-00-00', 'Pending', 0, 'Used organic insecticide spray', 3),
(5, 5, 'pest control', '2024-02-20', '', 'Neem Oil', '0000-00-00', 'Pending', 0, 'Applied neem oil for pest control', 3),
(6, 1, 'fertilization', '2024-07-01', 'Organic Nitrogen', '', '0000-00-00', 'Pending', 0, 'Initial fertilization after planting', 3),
(7, 2, 'fertilization', '2024-06-25', 'Organic Phosphorus', '', '0000-00-00', 'Pending', 0, 'First application during early growth', 3),
(8, 3, 'fertilization', '2024-04-15', 'Organic Potassium', '', '0000-00-00', 'Pending', 0, 'Supplemental potassium for fruiting', 3),
(9, 4, 'fertilization', '2024-05-25', 'Organic Micronutrients', '', '0000-00-00', 'Pending', 0, 'Micronutrient boost for healthy growth', 3),
(10, 5, 'fertilization', '2024-02-20', 'Organic Compost', '', '0000-00-00', 'Pending', 0, 'Incorporation of compost before planting', 3),
(12, 2, 'harvest', '1899-12-31', '', NULL, '2024-11-15', 'Harvested', 3400, '', 3),
(13, 3, 'harvest', '0000-00-00', '', NULL, '2024-11-23', 'Pending', 23, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `last_nm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_nm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_num` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emerg_num` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_dt` date NOT NULL,
  `student_img1` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_img2` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_ss` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_pagibig` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_philhealth` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_tin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_lvl` enum('Admin','Employee') COLLATE utf8mb4_unicode_ci NOT NULL,
  `wage_daily` float NOT NULL,
  `wage_ot` float NOT NULL,
  `rt_ss` float NOT NULL,
  `rt_pagibig` float NOT NULL,
  `rt_philhealth` float NOT NULL,
  `date_regis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `last_nm`, `first_nm`, `birthdate`, `address`, `phone_num`, `email`, `emerg_name`, `emerg_num`, `department`, `position`, `employee_dt`, `student_img1`, `student_img2`, `num_ss`, `num_pagibig`, `num_philhealth`, `num_tin`, `username`, `password`, `user_lvl`, `wage_daily`, `wage_ot`, `rt_ss`, `rt_pagibig`, `rt_philhealth`, `date_regis`) VALUES
(1, 'ABARQUEZ', 'MARK DAVE', '1998-03-18', 'STO. DOMINGO, STA. ROSA, LAGUNA', '+639204578906', 'abarquezmarkdave@gmail.com', 'MELANIE CANEN', '09970696044', 'Operation', 'FARMER', '2017-08-17', '', '', '03-2404131-3', '124382296647', '12-123415136-5', '434-044-284-000', 'Dave', 'Dave317', 'Employee', 1500, 0, 0, 0, 0, '0000-00-00'),
(2, 'BORLAZA', 'RICK', '1980-03-24', 'TIMBAO, BINAN, LAGUNA', '09999222218', 'dickborlaza@gmail.com', 'RICKY BORLAZA', '09204356185', 'OPERATION', 'FARM DIRECTOR', '2017-08-17', '', '', '03-2404131-3', '124382296647', '12-123415136-5', '434-044-284-000', 'Rick', 'Admin1', 'Admin', 1500, 0, 0, 0, 0, '0000-00-00'),
(3, 'TENOR', 'RAYMOND', '2002-07-12', 'DELAPAZ, BINAN CITY, LAGUNA', '09999222219', 'tenorray@gmail.com', 'KRISTINE TENOR', '09204356186', 'OPERATION', 'FARMER', '2023-06-10', '', '', '05-4404441-4', '129992296647', '01-564825313-6', '434-044-285-000', 'Tenor', 'Farm01', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(4, 'SALVADOR', 'DIOSOS', '1973-01-30', 'TIMBAO, BINAN CITY, LAGUNA', '09999222220', 'diosos30@gmail.com', 'ALLAN SALVADOR', '09204356187', 'OPERATION', 'FARMER', '2017-08-17', '', '', '08-2404131-5', '142215141631', '01-781363877-1', '434-044-286-000', 'Salvador', 'Farm02', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(5, 'MARQUINNA', 'FERDINAND', '1969-08-08', 'TIMBAO, BINAN CITY, LAGUNA', '09999222221', 'ferdie08@gmail.com', 'CYRUZ MARQUINNA', '09204356188', 'OPERATION', 'FARMER', '2017-08-17', '', '', '08-8840411-6', '325141628830', '09-172553441-6', '434-044-287-000', 'Ferdinand', 'Farm03', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(6, 'TECSON', 'JESUS', '1957-06-20', 'TIMBAO, BINAN CITY, LAGUNA', '09999222222', 'imajesus@gmail.com', 'BENJIE TECSON', '09204356189', 'OPERATION', 'FARMER', '2017-08-17', '', '', '07-2405531-7', '986645116677', '06-736913753-2', '434-044-288-000', 'Tecson', 'Farm04', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(7, 'TANON', 'GREGORIO', '1986-10-02', 'TIMBAO, BINAN CITY, LAGUNA', '09999222223', 'tanon02@gmail.com', 'GERICA TANON', '09204356190', 'OPERATION', 'FARMER', '2017-08-17', '', '', '02-6604131-8', '288999910000', '08-964417333-7', '434-044-289-000', 'Tanon', 'Farm05', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(8, 'GALVAN', 'CHRISTALINE', '1992-12-15', 'DELAPAZ, BINAN CITY, LAGUNA', '09999222224', 'galvan@gmail.com', 'CHRISTIAN DALE GALVAN', '09204356191', 'OPERATION', 'FARMER', '2017-08-17', '', '', '09-2116543-9', '166177777779', '09-836543773-1', '434-044-290-000', 'Galvan', 'Farm06', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(9, 'MANIKAN', 'MARC VINCENT', '0000-00-00', '', '', 'marc17@gmail.com', '', '', '', '', '0000-00-00', '', '', '', '', '', '', 'Manikan', 'Farm07', 'Employee', 0, 0, 0, 0, 0, '0000-00-00'),
(10, 'ALVARA', 'ALVEN', '1981-09-10', 'DELAPAZ, BINAN CITY, LAGUNA', '09999222226', 'thealven@gmail.com', 'IVAN ALVARA', '09204356193', 'OPERATION', 'FARMER', '2017-08-17', '', '', '03-9904154-11', '123563629999', '02-142718396-7', '434-044-292-000', 'Alvara', 'Farm08', '', 479, 0, 0, 0, 0, '0000-00-00'),
(11, 'REYES', 'LUIS', '1969-04-16', 'DELAPAZ, BINAN CITY, LAGUNA', '09999222227', 'luisreyes@gmail.com', 'RICO REYES', '09204356194', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704155-12', '173112222222', '03-654246211-9', '434-044-293-000', 'Reyes', 'Farm09', '', 479, 0, 0, 0, 0, '0000-00-00'),
(12, 'OMILES', 'ERICK', '1985-08-29', 'DELAPAZ, BINAN CITY, LAGUNA', '09999222228', 'erick29@gmail.com', 'ERICKA OMILES', '09204356195', 'OPERATION', 'FARM MANAGER', '2024-06-01', '', '', '05-8704155-11', '126735333333', '03-654246211-10', '434-044-294-000', 'Omiles', 'Admin2', '', 1000, 0, 0, 0, 0, '0000-00-00'),
(13, 'MANIKAN', 'JUSTINE', '1991-01-26', 'DELAPAZ, BINAN CITY, LAGUNA', '09999222229', 'tinekoi26@gmail.com', 'CHRISTOPHER MANAIG', '09204356196', 'Admin', 'ADMIN STAFF', '2017-08-17', '', '', '05-8704156-09', '213176123133', '03-654246211-11', '434-044-295-000', 'Justine', 'Admin3', '', 800, 0, 0, 0, 0, '0000-00-00'),
(14, 'MASILANG', 'PATRICK', '1975-08-28', 'CANLALAY, BINAN CITY, LAGUNA', '09999222230', 'thepatrick@gmail.com', 'JASMIN MASILANG', '09204356197', 'Admin', 'ADMIN STAFF', '2017-08-17', '', '', '05-8704156-10', '213176123134', '03-654246211-12', '434-044-296-000', 'Masilang', 'Admin4', '', 800, 0, 0, 0, 0, '0000-00-00'),
(15, 'ROSALES', 'ROMMEL', '1970-02-15', 'CANLALAY, BINAN CITY, LAGUNA', '09999222231', 'rommel15@gmail.com', 'ROSE MARIE ROSALES', '09204356198', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-11', '125648826638', '03-654246211-13', '434-044-297-000', 'Rosales', 'Farm10', '', 479, 0, 0, 0, 0, '0000-00-00'),
(16, 'MENDOZA', 'JERICK', '1980-03-10', 'LANGKIWA, BINAN CITY, LAGUNA', '09999222232', 'jerick@gmail.com', 'ERIK MENDOZA', '09204356199', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-12', '129863551441', '03-654246211-14', '434-044-298-000', 'Mendoza', 'Farm11', '', 479, 0, 0, 0, 0, '0000-00-00'),
(17, 'CANDAVA', 'MARK JOSEPH', '1976-05-01', 'MAMPLASAN, BINAN CITY, LAGUNA', '09999222233', 'mjoseph01@gmail.com', 'ANGELICA CANDAVA', '09204356200', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-13', '129883633333', '03-654246211-15', '434-044-299-000', 'Candava', 'Farm12', '', 479, 0, 0, 0, 0, '0000-00-00'),
(18, 'VELASCO', 'MARLON', '1982-09-10', 'LANGKIWA, BINAN CITY, LAGUNA', '09999222234', 'velasco10@gmail.com', 'MA. CHRISTINA VELASCO', '09204356201', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-14', '129865441111', '03-654246211-16', '434-044-300-000', 'Velasco', 'Farm13', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(19, 'LLANDELAR', 'JONARD', '1972-07-03', 'MAMPLASAN, BINAN CITY, LAGUNA', '09999222235', 'jonardpogi@gmail.com', 'JOY LLANDELAR', '09204356202', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-15', '196453136513', '03-654246211-17', '434-044-301-000', 'Llandelar', 'Farm14', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(20, 'DE TORRES', 'ARMAN', '1969-09-09', 'SAN ANTONIO, BINAN CITY, LAGUNA', '09999222236', 'arman09@gmail.com', 'PATRICIA DE TORRES', '09204356203', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-16', '127652333613', '03-654246211-18', '434-044-302-000', 'De Torres', 'Farm15', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(21, 'LIZADA', 'ROBERT', '1978-07-30', 'MAMPLASAN, BINAN CITY, LAGUNA', '09999222237', 'robert30@gmail.com', 'JEFFREY LIZADA', '09204356204', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-17', '127689933242', '03-654246211-19', '434-044-303-000', 'Lizada', 'Farm16', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(22, 'MARQUEZ', 'RYAN JAY', '1970-06-20', 'CANLALAY, BINAN CITY, LAGUNA', '09999222238', 'rjmarquez@gmail.com', 'IRVING MARQUEZ', '09204356205', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-18', '128764525984', '03-654246211-20', '434-044-304-000', 'Marquez', 'Farm17', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(23, 'TOLENTINO', 'TADEUZ', '1983-01-29', 'CANLALAY, BINAN CITY, LAGUNA', '09999222239', 'tadeyo29@gmail.com', 'KENNETH TOLENTINO', '09204356206', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-19', '129003833302', '03-654246211-21', '434-044-305-000', 'Tolentino', 'Farm18', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(24, 'BRIONES', 'SAMUEL', '1981-05-30', 'TIMBAO, BINAN CITY, LAGUNA', '09999222240', 'iamsam@gmail.com', 'JUNNEL BRIONES', '09204356207', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-20', '129834127777', '03-654246211-22', '434-044-306-000', 'Briones', 'Farm19', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(25, 'QUIBIN', 'WARREN', '1975-11-16', 'LANGKIWA, BINAN CITY, LAGUNA', '09999222241', 'warren16@gmail.com', 'JERRY QUIBIN', '09204356208', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-21', '125566333322', '03-654246211-23', '434-044-307-000', 'Quibin', 'Farm20', 'Employee', 479, 0, 0, 0, 0, '0000-00-00'),
(26, 'DE GUZMAN', 'CARLO', '1981-11-03', 'LANGKIWA, BINAN CITY, LAGUNA', '09999222242', 'carlo03@gmail.com', 'MANUEL DE GUZMAN', '09204356209', 'OPERATION', 'FARMER', '2017-08-17', '', '', '05-8704156-22', '128988884444', '03-654246211-24', '434-044-308-000', 'De Guzman', 'Farm21', '', 479, 0, 0, 0, 0, '0000-00-00'),
(39, 'CATAPANG', 'RUSSELLE', '1988-10-31', '', '+639204578906', 'russelle.catapang@gmail.com', '', '', '', '', '0000-00-00', 'CATAPANG_RUSSELLE_image1.png', 'CATAPANG_RUSSELLE_image2.png', '', '', '', '', 'Russelle', 'russ31', '', 0, 0, 0, 0, 0, '2024-11-09'),
(40, 'SASA', 'SASA', '2024-11-20', '', '', '', '', '', '', '', '0000-00-00', 'SASA_SASA_image1.png', 'SASA_SASA_image2.png', '', '', '', '', 'SASA', 'sasa20', '', 0, 0, 0, 0, 0, '2024-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `employee_log`
--

CREATE TABLE `employee_log` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `shift_st` time NOT NULL,
  `shift_ed` time NOT NULL,
  `task` text NOT NULL,
  `clock_in` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `hrs_worked` float DEFAULT NULL,
  `days_worked` float DEFAULT NULL,
  `hrs_late` float DEFAULT NULL,
  `hrs_ot` float DEFAULT NULL,
  `hrs_ut` float DEFAULT NULL,
  `file_ticket` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_log`
--

INSERT INTO `employee_log` (`id`, `employee_id`, `log_date`, `shift_st`, `shift_ed`, `task`, `clock_in`, `clock_out`, `hrs_worked`, `days_worked`, `hrs_late`, `hrs_ot`, `hrs_ut`, `file_ticket`) VALUES
(1, 1, '2024-11-01', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101001'),
(2, 1, '2024-11-02', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102001'),
(3, 1, '2024-11-03', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103001'),
(4, 1, '2024-11-04', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104001'),
(5, 1, '2024-11-05', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105001'),
(6, 1, '2024-11-06', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106001'),
(7, 1, '2024-11-07', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107001'),
(8, 1, '2024-11-08', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108001'),
(9, 1, '2024-11-09', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109001'),
(10, 1, '2024-11-10', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110001'),
(11, 1, '2024-11-11', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111001'),
(12, 1, '2024-11-12', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112001'),
(13, 1, '2024-11-13', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113001'),
(14, 1, '2024-11-14', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114001'),
(15, 1, '2024-11-15', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115001'),
(16, 2, '2024-11-01', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101002'),
(17, 2, '2024-11-02', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102002'),
(18, 2, '2024-11-03', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103002'),
(19, 2, '2024-11-04', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104002'),
(20, 2, '2024-11-05', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105002'),
(21, 2, '2024-11-06', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106002'),
(22, 2, '2024-11-07', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107002'),
(23, 2, '2024-11-08', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108002'),
(24, 2, '2024-11-09', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109002'),
(25, 2, '2024-11-10', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110002'),
(26, 2, '2024-11-11', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111002'),
(27, 2, '2024-11-12', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112002'),
(28, 2, '2024-11-13', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113002'),
(29, 2, '2024-11-14', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114002'),
(30, 2, '2024-11-15', '05:00:00', '14:00:00', 'Team Leader', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115002'),
(31, 3, '2024-11-01', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101003'),
(32, 3, '2024-11-02', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102003'),
(33, 3, '2024-11-03', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103003'),
(34, 3, '2024-11-04', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104003'),
(35, 3, '2024-11-05', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105003'),
(36, 3, '2024-11-06', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106003'),
(37, 3, '2024-11-07', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107003'),
(38, 3, '2024-11-08', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108003'),
(39, 3, '2024-11-09', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109003'),
(40, 3, '2024-11-10', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110003'),
(41, 3, '2024-11-11', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111003'),
(42, 3, '2024-11-12', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112003'),
(43, 3, '2024-11-13', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113003'),
(44, 3, '2024-11-14', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114003'),
(45, 3, '2024-11-15', '05:00:00', '14:00:00', 'Livestock Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115003'),
(46, 4, '2024-11-01', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101004'),
(47, 4, '2024-11-02', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102004'),
(48, 4, '2024-11-03', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103004'),
(49, 4, '2024-11-04', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104004'),
(50, 4, '2024-11-05', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105004'),
(51, 4, '2024-11-06', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106004'),
(52, 4, '2024-11-07', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107004'),
(53, 4, '2024-11-08', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108004'),
(54, 4, '2024-11-09', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109004'),
(55, 4, '2024-11-10', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110004'),
(56, 4, '2024-11-11', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111004'),
(57, 4, '2024-11-12', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112004'),
(58, 4, '2024-11-13', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113004'),
(59, 4, '2024-11-14', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114004'),
(60, 4, '2024-11-15', '13:00:00', '22:00:00', 'Livestock Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115004'),
(61, 5, '2024-11-01', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101005'),
(62, 5, '2024-11-02', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102005'),
(63, 5, '2024-11-03', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103005'),
(64, 5, '2024-11-04', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104005'),
(65, 5, '2024-11-05', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105005'),
(66, 5, '2024-11-06', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106005'),
(67, 5, '2024-11-07', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107005'),
(68, 5, '2024-11-08', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108005'),
(69, 5, '2024-11-09', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109005'),
(70, 5, '2024-11-10', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110005'),
(71, 5, '2024-11-11', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111005'),
(72, 5, '2024-11-12', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112005'),
(73, 5, '2024-11-13', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113005'),
(74, 5, '2024-11-14', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114005'),
(75, 5, '2024-11-15', '05:00:00', '14:00:00', 'Feeds Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115005'),
(76, 6, '2024-11-01', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101006'),
(77, 6, '2024-11-02', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102006'),
(78, 6, '2024-11-03', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103006'),
(79, 6, '2024-11-04', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104006'),
(80, 6, '2024-11-05', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105006'),
(81, 6, '2024-11-06', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106006'),
(82, 6, '2024-11-07', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107006'),
(83, 6, '2024-11-08', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108006'),
(84, 6, '2024-11-09', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109006'),
(85, 6, '2024-11-10', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110006'),
(86, 6, '2024-11-11', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111006'),
(87, 6, '2024-11-12', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112006'),
(88, 6, '2024-11-13', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113006'),
(89, 6, '2024-11-14', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114006'),
(90, 6, '2024-11-15', '13:00:00', '22:00:00', 'Feeds Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115006'),
(91, 7, '2024-11-01', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101007'),
(92, 7, '2024-11-02', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102007'),
(93, 7, '2024-11-03', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103007'),
(94, 7, '2024-11-04', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104007'),
(95, 7, '2024-11-05', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105007'),
(96, 7, '2024-11-06', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106007'),
(97, 7, '2024-11-07', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107007'),
(98, 7, '2024-11-08', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108007'),
(99, 7, '2024-11-09', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109007'),
(100, 7, '2024-11-10', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110007'),
(101, 7, '2024-11-11', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111007'),
(102, 7, '2024-11-12', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112007'),
(103, 7, '2024-11-13', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113007'),
(104, 7, '2024-11-14', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114007'),
(105, 7, '2024-11-15', '05:00:00', '14:00:00', 'Fertilizer Production', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115007'),
(106, 8, '2024-11-01', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101008'),
(107, 8, '2024-11-02', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102008'),
(108, 8, '2024-11-03', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103008'),
(109, 8, '2024-11-04', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104008'),
(110, 8, '2024-11-05', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105008'),
(111, 8, '2024-11-06', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106008'),
(112, 8, '2024-11-07', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107008'),
(113, 8, '2024-11-08', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108008'),
(114, 8, '2024-11-09', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109008'),
(115, 8, '2024-11-10', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110008'),
(116, 8, '2024-11-11', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111008'),
(117, 8, '2024-11-12', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112008'),
(118, 8, '2024-11-13', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113008'),
(119, 8, '2024-11-14', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114008'),
(120, 8, '2024-11-15', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115008'),
(121, 9, '2024-11-01', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101009'),
(122, 9, '2024-11-02', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102009'),
(123, 9, '2024-11-03', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103009'),
(124, 9, '2024-11-04', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104009'),
(125, 9, '2024-11-05', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105009'),
(126, 9, '2024-11-06', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106009'),
(127, 9, '2024-11-07', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107009'),
(128, 9, '2024-11-08', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108009'),
(129, 9, '2024-11-09', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109009'),
(130, 9, '2024-11-10', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110009'),
(131, 9, '2024-11-11', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111009'),
(132, 9, '2024-11-12', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112009'),
(133, 9, '2024-11-13', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113009'),
(134, 9, '2024-11-14', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114009'),
(135, 9, '2024-11-15', '13:00:00', '22:00:00', 'Fertilizer Production', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115009'),
(136, 10, '2024-11-01', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101010'),
(137, 10, '2024-11-02', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102010'),
(138, 10, '2024-11-03', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103010'),
(139, 10, '2024-11-04', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104010'),
(140, 10, '2024-11-05', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105010'),
(141, 10, '2024-11-06', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106010'),
(142, 10, '2024-11-07', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107010'),
(143, 10, '2024-11-08', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108010'),
(144, 10, '2024-11-09', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109010'),
(145, 10, '2024-11-10', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110010'),
(146, 10, '2024-11-11', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111010'),
(147, 10, '2024-11-12', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112010'),
(148, 10, '2024-11-13', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113010'),
(149, 10, '2024-11-14', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114010'),
(150, 10, '2024-11-15', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115010'),
(151, 11, '2024-11-01', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101011'),
(152, 11, '2024-11-02', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102011'),
(153, 11, '2024-11-03', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103011'),
(154, 11, '2024-11-04', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104011'),
(155, 11, '2024-11-05', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105011'),
(156, 11, '2024-11-06', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106011'),
(157, 11, '2024-11-07', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107011'),
(158, 11, '2024-11-08', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108011'),
(159, 11, '2024-11-09', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109011'),
(160, 11, '2024-11-10', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110011'),
(161, 11, '2024-11-11', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111011'),
(162, 11, '2024-11-12', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112011'),
(163, 11, '2024-11-13', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113011'),
(164, 11, '2024-11-14', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114011'),
(165, 11, '2024-11-15', '05:00:00', '14:00:00', 'Rabbitry', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115011'),
(166, 12, '2024-11-01', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101012'),
(167, 12, '2024-11-02', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102012'),
(168, 12, '2024-11-03', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103012'),
(169, 12, '2024-11-04', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104012'),
(170, 12, '2024-11-05', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105012'),
(171, 12, '2024-11-06', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106012'),
(172, 12, '2024-11-07', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107012'),
(173, 12, '2024-11-08', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108012'),
(174, 12, '2024-11-09', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109012'),
(175, 12, '2024-11-10', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110012'),
(176, 12, '2024-11-11', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111012'),
(177, 12, '2024-11-12', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112012'),
(178, 12, '2024-11-13', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113012'),
(179, 12, '2024-11-14', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114012'),
(180, 12, '2024-11-15', '13:00:00', '22:00:00', 'Team Leader', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115012'),
(181, 13, '2024-11-01', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101013'),
(182, 13, '2024-11-02', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102013'),
(183, 13, '2024-11-03', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103013'),
(184, 13, '2024-11-04', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104013'),
(185, 13, '2024-11-05', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105013'),
(186, 13, '2024-11-06', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106013'),
(187, 13, '2024-11-07', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107013'),
(188, 13, '2024-11-08', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108013'),
(189, 13, '2024-11-09', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109013'),
(190, 13, '2024-11-10', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110013'),
(191, 13, '2024-11-11', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111013'),
(192, 13, '2024-11-12', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112013'),
(193, 13, '2024-11-13', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113013'),
(194, 13, '2024-11-14', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114013'),
(195, 13, '2024-11-15', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115013'),
(196, 14, '2024-11-01', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101014'),
(197, 14, '2024-11-02', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102014'),
(198, 14, '2024-11-03', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103014'),
(199, 14, '2024-11-04', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104014'),
(200, 14, '2024-11-05', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105014'),
(201, 14, '2024-11-06', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106014'),
(202, 14, '2024-11-07', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107014'),
(203, 14, '2024-11-08', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108014'),
(204, 14, '2024-11-09', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109014'),
(205, 14, '2024-11-10', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110014'),
(206, 14, '2024-11-11', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111014'),
(207, 14, '2024-11-12', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112014'),
(208, 14, '2024-11-13', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113014'),
(209, 14, '2024-11-14', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114014'),
(210, 14, '2024-11-15', '13:00:00', '22:00:00', 'Admin Office', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115014'),
(211, 15, '2024-11-01', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101015'),
(212, 15, '2024-11-02', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102015'),
(213, 15, '2024-11-03', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103015'),
(214, 15, '2024-11-04', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104015'),
(215, 15, '2024-11-05', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105015'),
(216, 15, '2024-11-06', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106015'),
(217, 15, '2024-11-07', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107015'),
(218, 15, '2024-11-08', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108015'),
(219, 15, '2024-11-09', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109015'),
(220, 15, '2024-11-10', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110015'),
(221, 15, '2024-11-11', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111015'),
(222, 15, '2024-11-12', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112015'),
(223, 15, '2024-11-13', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113015'),
(224, 15, '2024-11-14', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114015'),
(225, 15, '2024-11-15', '05:00:00', '14:00:00', 'Nursery', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115015'),
(226, 16, '2024-11-01', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101016'),
(227, 16, '2024-11-02', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102016'),
(228, 16, '2024-11-03', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103016'),
(229, 16, '2024-11-04', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104016'),
(230, 16, '2024-11-05', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105016'),
(231, 16, '2024-11-06', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106016'),
(232, 16, '2024-11-07', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107016'),
(233, 16, '2024-11-08', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108016'),
(234, 16, '2024-11-09', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109016'),
(235, 16, '2024-11-10', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110016'),
(236, 16, '2024-11-11', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111016'),
(237, 16, '2024-11-12', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112016'),
(238, 16, '2024-11-13', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113016'),
(239, 16, '2024-11-14', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114016'),
(240, 16, '2024-11-15', '13:00:00', '22:00:00', 'Nursery', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115016'),
(241, 17, '2024-11-01', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101017'),
(242, 17, '2024-11-02', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102017'),
(243, 17, '2024-11-03', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103017'),
(244, 17, '2024-11-04', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104017'),
(245, 17, '2024-11-05', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105017'),
(246, 17, '2024-11-06', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106017'),
(247, 17, '2024-11-07', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107017'),
(248, 17, '2024-11-08', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108017'),
(249, 17, '2024-11-09', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109017'),
(250, 17, '2024-11-10', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110017'),
(251, 17, '2024-11-11', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111017'),
(252, 17, '2024-11-12', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112017'),
(253, 17, '2024-11-13', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113017'),
(254, 17, '2024-11-14', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114017'),
(255, 17, '2024-11-15', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115017'),
(256, 18, '2024-11-01', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101018'),
(257, 18, '2024-11-02', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102018'),
(258, 18, '2024-11-03', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103018'),
(259, 18, '2024-11-04', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104018'),
(260, 18, '2024-11-05', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105018'),
(261, 18, '2024-11-06', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106018'),
(262, 18, '2024-11-07', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107018'),
(263, 18, '2024-11-08', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108018'),
(264, 18, '2024-11-09', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109018'),
(265, 18, '2024-11-10', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110018'),
(266, 18, '2024-11-11', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111018'),
(267, 18, '2024-11-12', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112018'),
(268, 18, '2024-11-13', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113018'),
(269, 18, '2024-11-14', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114018'),
(270, 18, '2024-11-15', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115018'),
(271, 19, '2024-11-01', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101019'),
(272, 19, '2024-11-02', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102019'),
(273, 19, '2024-11-03', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103019'),
(274, 19, '2024-11-04', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104019'),
(275, 19, '2024-11-05', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105019'),
(276, 19, '2024-11-06', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106019'),
(277, 19, '2024-11-07', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107019'),
(278, 19, '2024-11-08', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108019'),
(279, 19, '2024-11-09', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109019'),
(280, 19, '2024-11-10', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110019'),
(281, 19, '2024-11-11', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111019'),
(282, 19, '2024-11-12', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112019'),
(283, 19, '2024-11-13', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113019'),
(284, 19, '2024-11-14', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114019'),
(285, 19, '2024-11-15', '05:00:00', '14:00:00', 'Garden', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115019'),
(286, 20, '2024-11-01', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101020'),
(287, 20, '2024-11-02', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102020'),
(288, 20, '2024-11-03', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103020'),
(289, 20, '2024-11-04', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104020'),
(290, 20, '2024-11-05', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105020'),
(291, 20, '2024-11-06', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106020'),
(292, 20, '2024-11-07', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107020'),
(293, 20, '2024-11-08', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108020'),
(294, 20, '2024-11-09', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109020'),
(295, 20, '2024-11-10', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110020'),
(296, 20, '2024-11-11', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111020'),
(297, 20, '2024-11-12', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112020'),
(298, 20, '2024-11-13', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113020'),
(299, 20, '2024-11-14', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114020'),
(300, 20, '2024-11-15', '13:00:00', '22:00:00', 'Garden', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115020'),
(301, 21, '2024-11-01', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101021'),
(302, 21, '2024-11-02', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102021'),
(303, 21, '2024-11-03', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103021'),
(304, 21, '2024-11-04', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104021'),
(305, 21, '2024-11-05', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105021'),
(306, 21, '2024-11-06', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106021'),
(307, 21, '2024-11-07', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107021'),
(308, 21, '2024-11-08', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108021'),
(309, 21, '2024-11-09', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109021'),
(310, 21, '2024-11-10', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110021'),
(311, 21, '2024-11-11', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111021'),
(312, 21, '2024-11-12', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112021'),
(313, 21, '2024-11-13', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113021'),
(314, 21, '2024-11-14', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114021'),
(315, 21, '2024-11-15', '05:00:00', '14:00:00', 'Crops Trimming', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115021'),
(316, 22, '2024-11-01', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101022'),
(317, 22, '2024-11-02', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102022'),
(318, 22, '2024-11-03', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103022'),
(319, 22, '2024-11-04', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104022'),
(320, 22, '2024-11-05', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105022'),
(321, 22, '2024-11-06', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106022'),
(322, 22, '2024-11-07', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107022'),
(323, 22, '2024-11-08', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108022'),
(324, 22, '2024-11-09', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109022'),
(325, 22, '2024-11-10', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110022'),
(326, 22, '2024-11-11', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111022'),
(327, 22, '2024-11-12', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112022'),
(328, 22, '2024-11-13', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113022'),
(329, 22, '2024-11-14', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114022'),
(330, 22, '2024-11-15', '13:00:00', '22:00:00', 'Crops Trimming', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115022'),
(331, 23, '2024-11-01', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101023'),
(332, 23, '2024-11-02', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102023'),
(333, 23, '2024-11-03', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103023'),
(334, 23, '2024-11-04', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104023'),
(335, 23, '2024-11-05', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105023'),
(336, 23, '2024-11-06', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106023'),
(337, 23, '2024-11-07', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107023'),
(338, 23, '2024-11-08', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108023'),
(339, 23, '2024-11-09', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109023'),
(340, 23, '2024-11-10', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110023'),
(341, 23, '2024-11-11', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111023'),
(342, 23, '2024-11-12', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112023'),
(343, 23, '2024-11-13', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113023'),
(344, 23, '2024-11-14', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114023'),
(345, 23, '2024-11-15', '05:00:00', '14:00:00', 'Driver', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115023'),
(346, 24, '2024-11-01', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101024'),
(347, 24, '2024-11-02', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102024'),
(348, 24, '2024-11-03', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103024'),
(349, 24, '2024-11-04', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104024'),
(350, 24, '2024-11-05', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105024'),
(351, 24, '2024-11-06', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106024'),
(352, 24, '2024-11-07', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107024'),
(353, 24, '2024-11-08', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108024'),
(354, 24, '2024-11-09', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109024'),
(355, 24, '2024-11-10', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110024'),
(356, 24, '2024-11-11', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111024'),
(357, 24, '2024-11-12', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112024'),
(358, 24, '2024-11-13', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113024'),
(359, 24, '2024-11-14', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114024'),
(360, 24, '2024-11-15', '13:00:00', '22:00:00', 'Driver', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115024'),
(361, 25, '2024-11-01', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241101025'),
(362, 25, '2024-11-02', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241102025'),
(363, 25, '2024-11-03', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241103025'),
(364, 25, '2024-11-04', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241104025'),
(365, 25, '2024-11-05', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241105025'),
(366, 25, '2024-11-06', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241106025'),
(367, 25, '2024-11-07', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241107025'),
(368, 25, '2024-11-08', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241108025'),
(369, 25, '2024-11-09', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241109025'),
(370, 25, '2024-11-10', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241110025'),
(371, 25, '2024-11-11', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241111025'),
(372, 25, '2024-11-12', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241112025'),
(373, 25, '2024-11-13', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241113025'),
(374, 25, '2024-11-14', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241114025'),
(375, 25, '2024-11-15', '13:00:00', '22:00:00', 'Forage', '13:00:00', '22:00:00', 9, 1, NULL, NULL, NULL, '241115025'),
(376, 26, '2024-11-01', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101026'),
(377, 26, '2024-11-02', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102026'),
(378, 26, '2024-11-03', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103026'),
(379, 26, '2024-11-04', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104026'),
(380, 26, '2024-11-05', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105026'),
(381, 26, '2024-11-06', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106026'),
(382, 26, '2024-11-07', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107026'),
(383, 26, '2024-11-08', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108026'),
(384, 26, '2024-11-09', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109026'),
(385, 26, '2024-11-10', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110026'),
(386, 26, '2024-11-11', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111026'),
(387, 26, '2024-11-12', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112026'),
(388, 26, '2024-11-13', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113026'),
(389, 26, '2024-11-14', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114026'),
(390, 26, '2024-11-15', '05:00:00', '14:00:00', 'Forage', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115026'),
(391, 39, '2024-11-01', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241101039'),
(392, 39, '2024-11-02', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241102039'),
(393, 39, '2024-11-03', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241103039'),
(394, 39, '2024-11-04', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241104039'),
(395, 39, '2024-11-05', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241105039'),
(396, 39, '2024-11-06', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241106039'),
(397, 39, '2024-11-07', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241107039'),
(398, 39, '2024-11-08', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241108039'),
(399, 39, '2024-11-09', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241109039'),
(400, 39, '2024-11-10', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241110039'),
(401, 39, '2024-11-11', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241111039'),
(402, 39, '2024-11-12', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241112039'),
(403, 39, '2024-11-13', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241113039'),
(404, 39, '2024-11-14', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241114039'),
(405, 39, '2024-11-15', '05:00:00', '14:00:00', 'Admin Office', '05:00:00', '14:00:00', 9, 1, NULL, NULL, NULL, '241115039'),
(406, 40, '2024-11-01', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241101040');
INSERT INTO `employee_log` (`id`, `employee_id`, `log_date`, `shift_st`, `shift_ed`, `task`, `clock_in`, `clock_out`, `hrs_worked`, `days_worked`, `hrs_late`, `hrs_ot`, `hrs_ut`, `file_ticket`) VALUES
(407, 40, '2024-11-02', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241102040'),
(408, 40, '2024-11-03', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241103040'),
(409, 40, '2024-11-04', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241104040'),
(410, 40, '2024-11-05', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241105040'),
(411, 40, '2024-11-06', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241106040'),
(412, 40, '2024-11-07', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241107040'),
(413, 40, '2024-11-08', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241108040'),
(414, 40, '2024-11-09', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241109040'),
(415, 40, '2024-11-10', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241110040'),
(416, 40, '2024-11-11', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241111040'),
(417, 40, '2024-11-12', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241112040'),
(418, 40, '2024-11-13', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241113040'),
(419, 40, '2024-11-14', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241114040'),
(420, 40, '2024-11-15', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241115040'),
(421, 1, '2024-11-16', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116001'),
(422, 1, '2024-11-17', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117001'),
(423, 1, '2024-11-18', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118001'),
(424, 1, '2024-11-19', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119001'),
(425, 1, '2024-11-20', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120001'),
(426, 1, '2024-11-21', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121001'),
(427, 1, '2024-11-22', '13:00:00', '22:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122001'),
(428, 1, '2024-11-23', '13:00:00', '22:00:00', 'Livestock Production', '13:30:20', '13:31:09', 0, 0, 0.5, 0, 8.46667, '241123001'),
(429, 2, '2024-11-16', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116002'),
(430, 2, '2024-11-17', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117002'),
(431, 2, '2024-11-18', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118002'),
(432, 2, '2024-11-19', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119002'),
(433, 2, '2024-11-20', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120002'),
(434, 2, '2024-11-21', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121002'),
(435, 2, '2024-11-22', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122002'),
(436, 2, '2024-11-23', '13:00:00', '22:00:00', 'Team Leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123002'),
(437, 3, '2024-11-16', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116003'),
(438, 3, '2024-11-17', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117003'),
(439, 3, '2024-11-18', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118003'),
(440, 3, '2024-11-19', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119003'),
(441, 3, '2024-11-20', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120003'),
(442, 3, '2024-11-21', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121003'),
(443, 3, '2024-11-22', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122003'),
(444, 3, '2024-11-23', '05:00:00', '14:00:00', 'Livestock Production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123003'),
(445, 4, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116004'),
(446, 4, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117004'),
(447, 4, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118004'),
(448, 4, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119004'),
(449, 4, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120004'),
(450, 4, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121004'),
(451, 4, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122004'),
(452, 4, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123004'),
(453, 5, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116005'),
(454, 5, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117005'),
(455, 5, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118005'),
(456, 5, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119005'),
(457, 5, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120005'),
(458, 5, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121005'),
(459, 5, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122005'),
(460, 5, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123005'),
(461, 6, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116006'),
(462, 6, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117006'),
(463, 6, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118006'),
(464, 6, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119006'),
(465, 6, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120006'),
(466, 6, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121006'),
(467, 6, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122006'),
(468, 6, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123006'),
(469, 7, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116007'),
(470, 7, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117007'),
(471, 7, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118007'),
(472, 7, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119007'),
(473, 7, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120007'),
(474, 7, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121007'),
(475, 7, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122007'),
(476, 7, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123007'),
(477, 8, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116008'),
(478, 8, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117008'),
(479, 8, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118008'),
(480, 8, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119008'),
(481, 8, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120008'),
(482, 8, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121008'),
(483, 8, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122008'),
(484, 8, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123008'),
(485, 9, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116009'),
(486, 9, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117009'),
(487, 9, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118009'),
(488, 9, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119009'),
(489, 9, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120009'),
(490, 9, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121009'),
(491, 9, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122009'),
(492, 9, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123009'),
(493, 10, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116010'),
(494, 10, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117010'),
(495, 10, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118010'),
(496, 10, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119010'),
(497, 10, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120010'),
(498, 10, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121010'),
(499, 10, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122010'),
(500, 10, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123010'),
(501, 11, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116011'),
(502, 11, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117011'),
(503, 11, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118011'),
(504, 11, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119011'),
(505, 11, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120011'),
(506, 11, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121011'),
(507, 11, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122011'),
(508, 11, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123011'),
(509, 12, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116012'),
(510, 12, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117012'),
(511, 12, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118012'),
(512, 12, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119012'),
(513, 12, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120012'),
(514, 12, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121012'),
(515, 12, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122012'),
(516, 12, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123012'),
(517, 13, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116013'),
(518, 13, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117013'),
(519, 13, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118013'),
(520, 13, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119013'),
(521, 13, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120013'),
(522, 13, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121013'),
(523, 13, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122013'),
(524, 13, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123013'),
(525, 14, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116014'),
(526, 14, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117014'),
(527, 14, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118014'),
(528, 14, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119014'),
(529, 14, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120014'),
(530, 14, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121014'),
(531, 14, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122014'),
(532, 14, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123014'),
(533, 15, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116015'),
(534, 15, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117015'),
(535, 15, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118015'),
(536, 15, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119015'),
(537, 15, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120015'),
(538, 15, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121015'),
(539, 15, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122015'),
(540, 15, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123015'),
(541, 16, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116016'),
(542, 16, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117016'),
(543, 16, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118016'),
(544, 16, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119016'),
(545, 16, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120016'),
(546, 16, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121016'),
(547, 16, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122016'),
(548, 16, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123016'),
(549, 17, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116017'),
(550, 17, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117017'),
(551, 17, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118017'),
(552, 17, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119017'),
(553, 17, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120017'),
(554, 17, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121017'),
(555, 17, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122017'),
(556, 17, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123017'),
(557, 18, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116018'),
(558, 18, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117018'),
(559, 18, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118018'),
(560, 18, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119018'),
(561, 18, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120018'),
(562, 18, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121018'),
(563, 18, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122018'),
(564, 18, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123018'),
(565, 19, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116019'),
(566, 19, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117019'),
(567, 19, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118019'),
(568, 19, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119019'),
(569, 19, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120019'),
(570, 19, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121019'),
(571, 19, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122019'),
(572, 19, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123019'),
(573, 20, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116020'),
(574, 20, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117020'),
(575, 20, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118020'),
(576, 20, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119020'),
(577, 20, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120020'),
(578, 20, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121020'),
(579, 20, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122020'),
(580, 20, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123020'),
(581, 21, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116021'),
(582, 21, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117021'),
(583, 21, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118021'),
(584, 21, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119021'),
(585, 21, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120021'),
(586, 21, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121021'),
(587, 21, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122021'),
(588, 21, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123021'),
(589, 22, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116022'),
(590, 22, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117022'),
(591, 22, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118022'),
(592, 22, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119022'),
(593, 22, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120022'),
(594, 22, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121022'),
(595, 22, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122022'),
(596, 22, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123022'),
(597, 23, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116023'),
(598, 23, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117023'),
(599, 23, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118023'),
(600, 23, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119023'),
(601, 23, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120023'),
(602, 23, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121023'),
(603, 23, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122023'),
(604, 23, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123023'),
(605, 24, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116024'),
(606, 24, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117024'),
(607, 24, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118024'),
(608, 24, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119024'),
(609, 24, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120024'),
(610, 24, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121024'),
(611, 24, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122024'),
(612, 24, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123024'),
(613, 25, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116025'),
(614, 25, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117025'),
(615, 25, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118025'),
(616, 25, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119025'),
(617, 25, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120025'),
(618, 25, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121025'),
(619, 25, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122025'),
(620, 25, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123025'),
(621, 26, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116026'),
(622, 26, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117026'),
(623, 26, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118026'),
(624, 26, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119026'),
(625, 26, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120026'),
(626, 26, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121026'),
(627, 26, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122026'),
(628, 26, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123026'),
(629, 39, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116039'),
(630, 39, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117039'),
(631, 39, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118039'),
(632, 39, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119039'),
(633, 39, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120039'),
(634, 39, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121039'),
(635, 39, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122039'),
(636, 39, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123039'),
(637, 40, '2024-11-16', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241116040'),
(638, 40, '2024-11-17', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241117040'),
(639, 40, '2024-11-18', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241118040'),
(640, 40, '2024-11-19', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241119040'),
(641, 40, '2024-11-20', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241120040'),
(642, 40, '2024-11-21', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241121040'),
(643, 40, '2024-11-22', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241122040'),
(644, 40, '2024-11-23', '00:00:00', '00:00:00', 'Select task', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241123040');

-- --------------------------------------------------------

--
-- Table structure for table `employee_record`
--

CREATE TABLE `employee_record` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `record_type` enum('Leave','Overtime','Undertime') NOT NULL,
  `date_filed` date NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `start_dt` date DEFAULT NULL,
  `end_dt` date DEFAULT NULL,
  `reason` longtext DEFAULT NULL,
  `status` enum('Approved','Denied','Pending') NOT NULL,
  `remarks` longtext NOT NULL,
  `file_ticket` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_record`
--

INSERT INTO `employee_record` (`id`, `employee_id`, `record_type`, `date_filed`, `leave_type`, `start_dt`, `end_dt`, `reason`, `status`, `remarks`, `file_ticket`) VALUES
(1, 1, 'Overtime', '2024-10-29', NULL, NULL, NULL, 'Testing.', 'Approved', '', '231204001'),
(2, 1, 'Overtime', '2024-10-29', NULL, NULL, NULL, 'Harvest season extension', 'Pending', '', '231205001'),
(3, 1, 'Overtime', '2024-10-29', NULL, NULL, NULL, 'Harvest season extension', 'Denied', 'Not working during normal working hours', '231206001'),
(4, 1, 'Overtime', '2024-10-29', NULL, NULL, NULL, 'Animal health emergencies', 'Approved', '', '231207001'),
(7, 1, 'Overtime', '2024-10-29', NULL, NULL, NULL, 'Vaccination', 'Pending', '', '231208001'),
(9, 1, 'Leave', '2024-10-29', 'Vacation Leave', '2024-10-31', '2024-11-03', 'Personal wellness retreat', 'Pending', ' ', '0'),
(10, 1, 'Overtime', '2024-10-29', NULL, NULL, NULL, 'Animal shelter maintenance', 'Pending', '', '231211001'),
(12, 1, 'Overtime', '2024-11-07', NULL, NULL, NULL, 'Converting waste into organic fertilizer', 'Approved', '', '241104001'),
(13, 1, 'Overtime', '2024-11-13', NULL, NULL, NULL, 'The quick', 'Pending', '', '241105001');

-- --------------------------------------------------------

--
-- Table structure for table `equipm`
--

CREATE TABLE `equipm` (
  `id` int(11) NOT NULL,
  `equipment_nm` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `purchase_dt` date NOT NULL,
  `warranty_end` date NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipm`
--

INSERT INTO `equipm` (`id`, `equipment_nm`, `model`, `manufacturer`, `purchase_dt`, `warranty_end`, `field_id`) VALUES
(1, 'Hand Tractor', 'HAN-0522', 'AgriMach Equipments Inc.', '2022-05-15', '2024-05-15', 1),
(2, 'Drip Irrigation System', 'DRI-0622', 'AgriTech', '2022-06-25', '2024-06-25', 2),
(3, 'Bolo', 'BOL-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 3),
(4, 'Broomstick', 'BRO-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 4),
(5, 'Plastic Pail 10 Liter', 'PLA-0917', 'AgriMach Equipments Inc.', '2017-09-05', '2024-10-10', 5),
(6, 'Knapsack sprayer', 'KNA-1017', 'AgriMach Equipments Inc.', '2017-10-10', '2024-10-10', 6),
(7, 'Storage Container 15 Liter', 'STO-1117', 'AgriMach Equipments Inc.', '2017-11-05', '2024-10-10', 7),
(8, 'Weighing scale 2 Kilos', 'WE2-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 1),
(9, 'Weighing scale 25 Kilos', 'W25-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 2),
(10, 'Shovel', 'SHO-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 3),
(11, 'Knife', 'KNI-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 4),
(12, 'Sprinkles 5 Liters', 'SPR-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 5),
(13, 'Step Ladder 6ft.', 'STE-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 6),
(14, 'Storage Tools/Cabinet', 'STO-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 7),
(15, 'Feeding trough', 'FEE-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 1),
(16, 'Waterer/drinker 1 Liter', 'WAT-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 2),
(17, 'Rain coat', 'RAI-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 3),
(18, 'Cart', 'CAR-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 4),
(19, 'Wheel barrow', 'WHE-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 5),
(20, 'Digging Blade', 'DIG-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 6),
(21, 'Digging Bar', 'DIG-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 7),
(22, 'Pruning Shear', 'PRU-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 1),
(23, 'Petri Dish', 'PET-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 2),
(24, 'Spike Tooth Horrow', 'SPI-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 3),
(25, 'Carbonizer', 'CAR-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 4),
(26, 'Soil Thermometer', 'SOI-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 5),
(27, 'PH meter', 'PH -0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 6),
(28, 'Spade', 'SPA-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 7),
(29, 'Spading Fork', 'SPA-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 1),
(30, 'Hoe', 'HOE-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 2),
(31, 'Rake', 'RAK-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 3),
(32, 'Moisture meter', 'MOI-0817', 'AgriMach Equipments Inc.', '2017-08-20', '2024-10-10', 4),
(33, 'Tractor', 'AG-1200', 'AgriManu Inc', '2022-02-15', '2027-02-15', 2),
(37, 'Shovel', 'SHO-1111', 'Agrimarch Inc.', '2024-11-01', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `equipm_log`
--

CREATE TABLE `equipm_log` (
  `id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `log_type` enum('Availability','Maintenance') NOT NULL,
  `log_date` date NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `borrowed_qty` int(11) DEFAULT NULL,
  `maint_type` varchar(255) DEFAULT NULL,
  `maint_sched_dt` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipm_log`
--

INSERT INTO `equipm_log` (`id`, `equipment_id`, `log_type`, `log_date`, `status`, `borrowed_qty`, `maint_type`, `maint_sched_dt`, `employee_id`) VALUES
(1, 1, 'Availability', '2023-11-12', 'In Use', NULL, '', '0000-00-00', 2),
(2, 2, 'Availability', '2023-11-15', 'In Use', NULL, '', '0000-00-00', 4),
(3, 3, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 4),
(4, 4, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 5),
(5, 5, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 8),
(6, 6, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 9),
(7, 7, 'Availability', '2024-12-01', 'Returned', NULL, '', '0000-00-00', 1),
(8, 8, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 11),
(9, 9, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 8),
(10, 10, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 10),
(11, 11, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 9),
(12, 12, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 15),
(13, 13, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 21),
(14, 14, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 15),
(15, 15, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 22),
(16, 18, 'Availability', '2017-08-20', 'In Maintenance', NULL, '', '0000-00-00', 22),
(17, 20, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 23),
(18, 21, 'Availability', '2017-08-20', 'Returned', NULL, '', '0000-00-00', 9),
(19, 19, 'Availability', '2017-08-20', 'Returned', NULL, '', '0000-00-00', 9),
(20, 3, 'Availability', '2024-08-20', 'Returned', NULL, '', '0000-00-00', 9),
(21, 23, 'Availability', '2017-08-20', 'In Use', NULL, '', '0000-00-00', 2),
(22, 16, 'Availability', '2017-08-20', 'In Maintenance', NULL, '', '0000-00-00', 2),
(23, 26, 'Availability', '2017-08-20', 'Returned', NULL, '', '0000-00-00', 9),
(24, 18, 'Availability', '2017-08-20', 'Returned', NULL, '', '0000-00-00', 9),
(25, 27, 'Availability', '2017-08-20', 'Returned', NULL, '', '0000-00-00', 9),
(26, 1, 'Maintenance', '2023-11-12', 'Completed', NULL, 'Regular Inspection', '2023-05-01', 2),
(27, 2, 'Maintenance', '2023-11-15', 'Completed', NULL, 'System Checkup', '2023-12-10', 4),
(29, 21, 'Availability', '2024-11-23', 'Returned', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL,
  `field_nm` text NOT NULL,
  `area` int(11) NOT NULL,
  `soil_type` enum('Loam','Clay','Sandy Loam','Loamy Sand','Silt') NOT NULL,
  `irrigation` enum('Sprinkler','Furrow','Deep Irrigation','Drip Irrigation') NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `field_nm`, `area`, `soil_type`, `irrigation`, `date_added`) VALUES
(1, 'Farm Block A1', 1200, 'Loam', 'Sprinkler', '2024-10-10'),
(2, 'Farm Block A2', 800, 'Clay', 'Furrow', '2024-10-10'),
(3, 'Farm Block A3', 1000, 'Sandy Loam', 'Deep Irrigation', '2024-10-10'),
(4, 'Farm Block B1', 1500, 'Loamy Sand', 'Sprinkler', '2024-10-10'),
(5, 'Farm Block B2', 1000, 'Silt', 'Furrow', '2024-10-10'),
(6, 'Farm Block B3', 1000, 'Loam', 'Drip Irrigation', '2024-10-10'),
(7, 'Greenhouse 1', 750, 'Loam', 'Drip Irrigation', '2024-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `finance_log`
--

CREATE TABLE `finance_log` (
  `id` int(11) NOT NULL,
  `transaction_type` enum('budget','expense','profit','revenue') NOT NULL,
  `year` int(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL,
  `notes` longtext DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `planned_budget` float DEFAULT NULL,
  `expenses_cat` varchar(255) DEFAULT NULL,
  `amount_spent` float DEFAULT NULL,
  `net_profit` float DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `revenue_cat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance_log`
--

INSERT INTO `finance_log` (`id`, `transaction_type`, `year`, `date`, `department`, `amount`, `notes`, `attachment`, `planned_budget`, `expenses_cat`, `amount_spent`, `net_profit`, `source`, `revenue_cat`) VALUES
(1, 'budget', 2024, NULL, 'Operations', 100000, 'Planned budget for purchasing seeds', '', NULL, 'Seed Purchase', NULL, NULL, NULL, NULL),
(2, 'expense', NULL, '2024-11-10', 'Operations', 95000, 'Purchase of seeds', '', NULL, 'Seed Purchase', NULL, NULL, NULL, NULL),
(3, 'revenue', NULL, '2024-11-15', NULL, 150000, 'Revenue from the sale of crops', '', NULL, NULL, NULL, NULL, 'Sales', 'Crop Sales'),
(4, 'profit', 2023, NULL, 'Operations', 60000, 'Net profit from agricultural operations', '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category` enum('Supplies','Tools and Equipment','Equipment','Fertilizer','Livestock') NOT NULL,
  `item_name` text NOT NULL,
  `description` longtext NOT NULL,
  `unit` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty_instock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category`, `item_name`, `description`, `unit`, `price`, `qty_instock`) VALUES
(2, 'Supplies', 'Pest Control Spray', 'Natural pest repellent', 'bottle', '150.00', 15),
(3, 'Tools and Equipment', 'Hand Tractor', 'Manual plowing equipment', 'unit', '15.00', 5),
(4, 'Livestock', 'Free-Range Chicken', 'Organic, cage-free chicken', 'each', '250.00', 50),
(5, 'Supplies', 'Tomato Seeds', 'Non-GMO seeds', 'packet', '50.00', 10),
(6, 'Livestock', 'Organic Pig', 'Naturally raised pig', 'pig', '3.00', 50),
(7, 'Tools and Equipment', 'Drip Irrigation System', 'Efficient water irrigation', 'set', '8.00', 3),
(8, 'Tools and Equipment', 'Bolo', 'Multi-purpose farming knife used for cutting vegetation.', 'pcs.', '200.00', 20),
(9, 'Supplies', 'Broomstick', 'Tool for sweeping debris or dirt.', 'pcs.', '50.00', 10),
(10, 'Tools and Equipment', 'Plastic Pail 10 Liter', 'Container for holding liquids or materials.', 'pcs.', '100.00', 20),
(11, 'Supplies', 'Knapsack sprayer', 'Portable sprayer for distributing liquids such as pesticides or fertilizers.', 'pcs.', '1.00', 20),
(12, 'Tools and Equipment', 'Storage Container 15 Liter', 'Medium-sized container for storing tools or materials.', 'unit', '500.00', 5),
(13, 'Tools and Equipment', 'Weighing scale 2 Kilos', 'Small scale for measuring up to 2 kilograms.', 'unit', '1.00', 5),
(14, 'Tools and Equipment', 'Weighing scale 25 Kilos', 'Larger scale for measuring up to 25 kilograms.', 'unit', '3.00', 5),
(15, 'Tools and Equipment', 'Shovel', 'Tool used for digging and moving soil or materials.', 'pcs.', '600.00', 15),
(16, 'Tools and Equipment', 'Knife', 'Cutting tool used for various tasks in farming.', 'pcs.', '300.00', 30),
(17, 'Supplies', 'Sprinkles 5 Liters', 'Watering tool for gently dispersing water over plants.', 'pcs.', '250.00', 30),
(18, 'Tools and Equipment', 'Step Ladder 6ft.', 'Ladder for reaching elevated areas, 6 feet in height.', 'unit', '5.00', 10),
(19, 'Tools and Equipment', 'Storage Tools/Cabinet', 'Cabinet for organizing and storing farming tools.', 'unit', '10.00', 5),
(20, 'Tools and Equipment', 'Feeding trough', 'Container for feeding livestock.', 'unit', '1.00', 10),
(21, 'Tools and Equipment', 'Waterer/drinker 1 Liter', 'Container for holding water for animals.', 'unit', '300.00', 10),
(22, 'Supplies', 'Rain coat', 'Waterproof coat for protection from rain.', 'pcs.', '200.00', 30),
(23, 'Tools and Equipment', 'Cart', 'Two-wheeled vehicle for transporting materials.', 'unit', '5.00', 10),
(24, 'Tools and Equipment', 'Wheel barrow', 'Single-wheeled vehicle for carrying loads.', 'unit', '3.00', 10),
(25, 'Tools and Equipment', 'Digging Blade', 'Blade used for cutting into soil.', 'unit', '1.00', 15),
(26, 'Tools and Equipment', 'Digging Bar', 'Metal bar used for digging or prying.', 'unit', '1.00', 15),
(27, 'Tools and Equipment', 'Pruning Shear', 'Tool used for trimming and cutting plants or branches.', 'unit', '1.00', 30),
(28, 'Tools and Equipment', 'Petri Dish', 'Small, shallow dish used for holding specimens in agricultural research.', 'unit', '200.00', 30),
(29, 'Tools and Equipment', 'Spike Tooth Horrow', 'Agricultural tool used to break up soil and remove weeds.', 'unit', '25.00', 2),
(30, 'Tools and Equipment', 'Carbonizer', 'Device for turning organic materials into charcoal.', 'unit', '15.00', 2),
(31, 'Tools and Equipment', 'Soil Thermometer', 'Tool for measuring soil temperature.', 'unit', '1.00', 5),
(32, 'Tools and Equipment', 'PH meter', 'Tool for measuring the acidity or alkalinity of soil.', 'unit', '3.00', 5),
(33, 'Tools and Equipment', 'Spade', 'Sharp-edged tool used for digging or cutting soil.', 'unit', '500.00', 15),
(34, 'Tools and Equipment', 'Spading Fork', 'Fork-shaped tool for turning soil or compost.', 'unit', '1.00', 15),
(35, 'Tools and Equipment', 'Hoe', 'Tool used for weeding, cultivating, and shaping soil.', 'unit', '800.00', 15),
(36, 'Tools and Equipment', 'Rake', 'Tool for gathering leaves, hay, or smoothing soil.', 'unit', '1.00', 15),
(37, 'Tools and Equipment', 'Moisture meter', 'Device for measuring soil moisture content.', 'unit', '3.00', 5),
(38, 'Fertilizer', 'Organic Nitrogen', 'A natural nitrogen source to enhance plant growth and promote leafy vegetation.', 'kg', '200.00', 5),
(39, 'Fertilizer', 'Organic Phosphorus', 'Essential for root development and flowering, promoting healthy plant growth.', 'kg', '250.00', 3),
(40, 'Fertilizer', 'Organic Potassium', 'Improves fruiting, flowering, and overall plant resistance.', 'kg', '180.00', 4),
(41, 'Fertilizer', 'Organic Micronutrients', 'A blend of essential trace elements for optimal plant nutrition and growth.', 'kg', '350.00', 2),
(42, 'Fertilizer', 'Organic Compost', 'Rich in organic matter, enhancing soil fertility and plant growth.', 'sack (25 kg)', '500.00', 2),
(45, 'Supplies', 'Organic Neem Oil', 'Natural pesticide and fungicide', 'liter', '25.00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE `livestock` (
  `id` int(11) NOT NULL,
  `livestock_nm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `livestock_type` enum('Goat','Cow','Chicken','Duck','Pig','Sheep') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livestock`
--

INSERT INTO `livestock` (`id`, `livestock_nm`, `livestock_type`, `quantity`, `birthdate`) VALUES
(1, 'Holstein Cow  CO-0523', 'Cow', 5, '2023-05-01'),
(2, 'Broiler Chicken  CH-0223', 'Chicken', 12, '2023-02-15'),
(3, 'Berkshire Pig  PI-0822', 'Duck', 12, '2022-08-10'),
(4, 'Saanen Goat  GO-1122', 'Goat', 4, '2022-11-20'),
(5, 'Peking Duck   DU-0322', 'Duck', 10, '2022-03-05'),
(6, 'Leghorn Chicken  CH-0123', 'Chicken', 10, '2023-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_log`
--

CREATE TABLE `livestock_log` (
  `id` int(11) NOT NULL,
  `livestock_id` int(11) NOT NULL,
  `record_type` enum('vaccination','feed plan') NOT NULL,
  `record_dt` date NOT NULL,
  `vaccine_type` text DEFAULT NULL,
  `feed_start_dt` date DEFAULT NULL,
  `feed_end_dt` date DEFAULT NULL,
  `feed_type` text NOT NULL,
  `feed_qty` int(11) DEFAULT NULL,
  `notes` longtext NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `livestock_log`
--

INSERT INTO `livestock_log` (`id`, `livestock_id`, `record_type`, `record_dt`, `vaccine_type`, `feed_start_dt`, `feed_end_dt`, `feed_type`, `feed_qty`, `notes`, `employee_id`) VALUES
(1, 2, 'vaccination', '2023-08-05', 'Poultry Respiratory Vaccine', NULL, NULL, '', NULL, 'Protect against respiratory diseases', 7),
(2, 3, 'vaccination', '2024-11-01', 'Swine Flu Vaccine', NULL, NULL, '', NULL, 'Vaccinated to prevent swine flufff', 7),
(3, 4, 'vaccination', '2024-11-01', 'Caprine Brucellosis Vaccine', NULL, NULL, '', NULL, 'Protect against brucellosis in goats', 7),
(7, 4, 'feed plan', '2023-11-20', '', '2023-11-20', '2024-02-20', 'Goat Milk', 0, 'Primer', 7),
(8, 4, 'feed plan', '2024-02-21', '', '2024-02-21', '2024-05-21', 'Lactation Feed', 350, '', 7),
(9, 4, 'feed plan', '2024-05-22', '', '2024-05-22', '2024-08-22', 'Maintenance Feed', 350, '', 7),
(10, 4, 'feed plan', '2024-08-23', '', '2024-08-23', '2024-12-31', 'Maintenance Feed', 300, 'Ensuring consistent nutrition for goats', 7),
(13, 2, 'feed plan', '2024-11-01', NULL, '2024-11-01', '2025-01-23', 'Feeds', 3000, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_data`
--

CREATE TABLE `payroll_data` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay_period_st` date NOT NULL,
  `pay_period_ed` date NOT NULL,
  `gross_pay` decimal(10,2) NOT NULL,
  `total_deductions` decimal(10,2) NOT NULL,
  `take_home_pay` decimal(10,2) NOT NULL,
  `wage_daily` decimal(10,2) DEFAULT NULL,
  `wage_ot` decimal(10,2) DEFAULT NULL,
  `total_days_worked` int(11) DEFAULT NULL,
  `total_overtime_hours` decimal(10,2) DEFAULT NULL,
  `sss` decimal(10,2) DEFAULT NULL,
  `pagibig` decimal(10,2) DEFAULT NULL,
  `philhealth` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_data`
--

INSERT INTO `payroll_data` (`id`, `employee_id`, `pay_period_st`, `pay_period_ed`, `gross_pay`, `total_deductions`, `take_home_pay`, `wage_daily`, `wage_ot`, `total_days_worked`, `total_overtime_hours`, `sss`, `pagibig`, `philhealth`, `created_at`) VALUES
(29, 1, '2024-11-01', '2024-11-15', '9871.20', '2415.00', '7456.20', '1500.00', '234.00', 5, '10.00', '945.00', '420.00', '1050.00', '2024-11-14 12:11:44'),
(30, 2, '2024-11-01', '2024-11-15', '0.00', '2415.00', '-2415.00', '1500.00', '0.00', 0, '3.00', '945.00', '420.00', '1050.00', '2024-11-14 12:11:44'),
(31, 3, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '3.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(32, 4, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '3.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(33, 5, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(34, 6, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(35, 7, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(36, 8, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(37, 9, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(38, 10, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(39, 11, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(40, 12, '2024-11-01', '2024-11-15', '0.00', '1610.00', '-1610.00', '1000.00', '0.00', 0, '0.00', '630.00', '280.00', '700.00', '2024-11-14 12:11:44'),
(41, 13, '2024-11-01', '2024-11-15', '0.00', '1288.00', '-1288.00', '800.00', '0.00', 0, '0.00', '504.00', '224.00', '560.00', '2024-11-14 12:11:44'),
(42, 14, '2024-11-01', '2024-11-15', '0.00', '1288.00', '-1288.00', '800.00', '0.00', 0, '0.00', '504.00', '224.00', '560.00', '2024-11-14 12:11:44'),
(43, 15, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(44, 16, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(45, 17, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(46, 18, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(47, 19, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(48, 20, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(49, 21, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(50, 22, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(51, 23, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(52, 24, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(53, 25, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(54, 26, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-14 12:11:44'),
(55, 39, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-14 12:11:44'),
(56, 40, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-14 12:11:44'),
(57, 1, '2024-11-01', '2024-11-15', '9400.00', '2415.00', '6985.00', '1500.00', '187.50', 5, '10.00', '945.00', '420.00', '1050.00', '2024-11-21 17:34:31'),
(58, 2, '2024-11-01', '2024-11-15', '0.00', '2415.00', '-2415.00', '1500.00', '0.00', 0, '3.00', '945.00', '420.00', '1050.00', '2024-11-21 17:34:31'),
(59, 3, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '3.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(60, 4, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '3.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(61, 5, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(62, 6, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(63, 7, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(64, 8, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(65, 9, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(66, 10, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(67, 11, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(68, 12, '2024-11-01', '2024-11-15', '0.00', '1610.00', '-1610.00', '1000.00', '0.00', 0, '0.00', '630.00', '280.00', '700.00', '2024-11-21 17:34:31'),
(69, 13, '2024-11-01', '2024-11-15', '0.00', '1288.00', '-1288.00', '800.00', '0.00', 0, '0.00', '504.00', '224.00', '560.00', '2024-11-21 17:34:31'),
(70, 14, '2024-11-01', '2024-11-15', '0.00', '1288.00', '-1288.00', '800.00', '0.00', 0, '0.00', '504.00', '224.00', '560.00', '2024-11-21 17:34:31'),
(71, 15, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(72, 16, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(73, 17, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(74, 18, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(75, 19, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(76, 20, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(77, 21, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(78, 22, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(79, 23, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(80, 24, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(81, 25, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(82, 26, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '0.00', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-21 17:34:31'),
(83, 39, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-21 17:34:31'),
(84, 40, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-21 17:34:31'),
(85, 1, '2024-11-01', '2024-11-15', '9562.50', '2415.00', '7147.50', '1500.00', '187.50', 5, '11.00', '945.00', '420.00', '1050.00', '2024-11-23 03:30:23'),
(86, 2, '2024-11-01', '2024-11-15', '562.50', '2415.00', '-1852.50', '1500.00', '187.50', 0, '3.00', '945.00', '420.00', '1050.00', '2024-11-23 03:30:23'),
(87, 3, '2024-11-01', '2024-11-15', '179.63', '771.19', '-591.57', '479.00', '59.88', 0, '3.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(88, 4, '2024-11-01', '2024-11-15', '239.50', '771.19', '-531.69', '479.00', '59.88', 0, '4.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(89, 5, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(90, 6, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(91, 7, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(92, 8, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(93, 9, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-23 03:30:23'),
(94, 10, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(95, 11, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(96, 12, '2024-11-01', '2024-11-15', '0.00', '1610.00', '-1610.00', '1000.00', '125.00', 0, '0.00', '630.00', '280.00', '700.00', '2024-11-23 03:30:23'),
(97, 13, '2024-11-01', '2024-11-15', '0.00', '1288.00', '-1288.00', '800.00', '100.00', 0, '0.00', '504.00', '224.00', '560.00', '2024-11-23 03:30:23'),
(98, 14, '2024-11-01', '2024-11-15', '0.00', '1288.00', '-1288.00', '800.00', '100.00', 0, '0.00', '504.00', '224.00', '560.00', '2024-11-23 03:30:23'),
(99, 15, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(100, 16, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(101, 17, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(102, 18, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(103, 19, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(104, 20, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(105, 21, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(106, 22, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(107, 23, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(108, 24, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(109, 25, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(110, 26, '2024-11-01', '2024-11-15', '0.00', '771.19', '-771.19', '479.00', '59.88', 0, '0.00', '301.77', '134.12', '335.30', '2024-11-23 03:30:23'),
(111, 39, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-23 03:30:23'),
(112, 40, '2024-11-01', '2024-11-15', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', '0.00', '2024-11-23 03:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `sc_distribution`
--

CREATE TABLE `sc_distribution` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL,
  `product_nm` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `unit_prc` float NOT NULL,
  `total_prc` float NOT NULL,
  `destination` varchar(100) NOT NULL,
  `status` enum('Pending','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_distribution`
--

INSERT INTO `sc_distribution` (`id`, `date`, `employee_id`, `product_nm`, `quantity`, `unit`, `unit_prc`, `total_prc`, `destination`, `status`, `remarks`) VALUES
(0, '2024-11-15', 1, 'test', 1, '2', 3, 3, '5', 'Pending', '21sa');

-- --------------------------------------------------------

--
-- Table structure for table `sc_purchases`
--

CREATE TABLE `sc_purchases` (
  `id` int(11) NOT NULL,
  `date_filed` date NOT NULL DEFAULT current_timestamp(),
  `employee_id` int(11) DEFAULT NULL,
  `product_nm` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `status` enum('Pending','Denied','Approved') NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sc_purchases`
--

INSERT INTO `sc_purchases` (`id`, `date_filed`, `employee_id`, `product_nm`, `quantity`, `unit`, `notes`, `status`, `remarks`) VALUES
(1, '2024-11-15', 1, 'Testing', 12, 'kg', '', 'Pending', ''),
(2, '2024-11-15', 1, 'Tesrt', 21, 'kd', '', 'Pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation_log`
--
ALTER TABLE `allocation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_crop_id` (`crop_id`),
  ADD KEY `fk_employee_id` (`employee_id`),
  ADD KEY `fk_field_id` (`field_id`),
  ADD KEY `fk_equipm_id` (`equipment_id`),
  ADD KEY `fk_items_id` (`item_id`);

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`field_id`);

--
-- Indexes for table `crop_log`
--
ALTER TABLE `crop_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`),
  ADD KEY `fk_employee` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_ticket` (`file_ticket`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `file_ticket_2` (`file_ticket`);

--
-- Indexes for table `employee_record`
--
ALTER TABLE `employee_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `fk_file_ticket` (`file_ticket`);

--
-- Indexes for table `equipm`
--
ALTER TABLE `equipm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipm_log`
--
ALTER TABLE `equipm_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `fk_equipment` (`equipment_id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_log`
--
ALTER TABLE `finance_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD UNIQUE KEY `resource-items-id` (`id`);

--
-- Indexes for table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestock_log`
--
ALTER TABLE `livestock_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livestock_id` (`livestock_id`);

--
-- Indexes for table `payroll_data`
--
ALTER TABLE `payroll_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sc_distribution`
--
ALTER TABLE `sc_distribution`
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `sc_purchases`
--
ALTER TABLE `sc_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocation_log`
--
ALTER TABLE `allocation_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `crop`
--
ALTER TABLE `crop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `crop_log`
--
ALTER TABLE `crop_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `employee_log`
--
ALTER TABLE `employee_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646;

--
-- AUTO_INCREMENT for table `employee_record`
--
ALTER TABLE `employee_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `equipm`
--
ALTER TABLE `equipm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `equipm_log`
--
ALTER TABLE `equipm_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `finance_log`
--
ALTER TABLE `finance_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `livestock_log`
--
ALTER TABLE `livestock_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payroll_data`
--
ALTER TABLE `payroll_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `sc_purchases`
--
ALTER TABLE `sc_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation_log`
--
ALTER TABLE `allocation_log`
  ADD CONSTRAINT `fk_crop_id` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipm_id` FOREIGN KEY (`equipment_id`) REFERENCES `equipm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_field_id` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `crop`
--
ALTER TABLE `crop`
  ADD CONSTRAINT `crop_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `crop_log`
--
ALTER TABLE `crop_log`
  ADD CONSTRAINT `crop_log_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `employee_log`
--
ALTER TABLE `employee_log`
  ADD CONSTRAINT `employee_log_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `employee_record`
--
ALTER TABLE `employee_record`
  ADD CONSTRAINT `employee_record_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `equipm_log`
--
ALTER TABLE `equipm_log`
  ADD CONSTRAINT `equipm_log_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `livestock_log`
--
ALTER TABLE `livestock_log`
  ADD CONSTRAINT `fk_employee_id2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livestock_log_ibfk_1` FOREIGN KEY (`livestock_id`) REFERENCES `livestock` (`id`);

--
-- Constraints for table `sc_distribution`
--
ALTER TABLE `sc_distribution`
  ADD CONSTRAINT `sc_distribution_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `sc_purchases`
--
ALTER TABLE `sc_purchases`
  ADD CONSTRAINT `sc_purchases_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
