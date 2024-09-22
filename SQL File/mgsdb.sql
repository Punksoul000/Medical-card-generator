-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 04:19 PM
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
-- Database: `mgsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 1234567891, 'adminuser@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2020-04-14 06:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Kiran', 'kran@gmail.com', 'cost of volvo place pritampura to dwarka', '2021-07-05 07:26:24', 1),
(2, 'Anuj', 'AKKK@GMAIL.COM', 'This is for testing.', '2021-07-11 08:55:16', 1),
(3, 'Rajat Mehta', 'raj@gmail.com', 'Test test', '2024-07-10 05:07:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalcard`
--

CREATE TABLE `tblmedicalcard` (
  `ID` int(5) NOT NULL,
  `RefNumber` int(10) DEFAULT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `ProfileImage` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(11) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `BloodGroup` varchar(100) DEFAULT NULL,
  `Age` int(5) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `MedicalCond` mediumtext DEFAULT NULL,
  `IssuedDate` varchar(200) DEFAULT NULL,
  `ValidDate` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmedicalcard`
--

INSERT INTO `tblmedicalcard` (`ID`, `RefNumber`, `FullName`, `ProfileImage`, `ContactNumber`, `Email`, `BloodGroup`, `Age`, `Gender`, `Address`, `MedicalCond`, `IssuedDate`, `ValidDate`, `CreationDate`) VALUES
(1, 687246123, 'Rakesh Sharma', '0fb5a987e05a6111b74ae387b75156eb1720505897.jpg', 7987778798, 'rakesh@gmail.com', 'A+', 36, 'Male', 'O-908, GHU, Block-7', 'Hypertension ', '2024-07-08', '2025-11-01', '2024-07-09 05:35:29'),
(2, 478706795, 'Tanu Sharma', 'f5242be7eb83b9317fbcda90ba789e0e1720503525.png', 4654654654, 'tanu@gmail.com', 'AB-', 26, 'Female', 'P-808, Narayan Vihar, Delhi', 'Type 1 diabetes', '2024-07-08', '2024-09-30', '2024-07-09 05:38:45'),
(3, 152951869, 'Komal Singh', '1d2f3a0345533d64f2f1f45fbb6a56841720589759.jpg', 7986454987, 'komal@gmail.com', 'AB-', 36, 'Female', 'K-900, J&K Block Laxmi Nagar New Delhi', 'No', '2024-07-09', '2025-03-01', '2024-07-10 05:35:59'),
(5, 708669375, 'John Doe', '6e8024ec26c292f258ec30f01e0392dc1720874593.png', 1414256321, 'test@test.com', 'A-', 35, 'Male', 'Test Address', 'NA', '2024-07-15', '2024-11-30', '2024-07-13 12:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About us', '<font color=\"#747474\" face=\"Roboto, sans-serif, arial\"><span style=\"font-size: 13px;\"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</b></span></font><br>', NULL, NULL, '2021-07-11 08:54:33'),
(2, 'contactus', 'Contact Us', '                #890 CFG Apartment, Mayur Vihar, Delhi-India.', 'infotest@gmail.com', 4654789799, '2021-07-11 08:54:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblmedicalcard`
--
ALTER TABLE `tblmedicalcard`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblmedicalcard`
--
ALTER TABLE `tblmedicalcard`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
