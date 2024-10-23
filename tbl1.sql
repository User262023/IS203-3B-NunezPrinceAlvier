-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 04:06 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl1`
--

CREATE TABLE `tbl1` (
  `ID` int(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl1`
--

INSERT INTO `tbl1` (`ID`, `FirstName`, `MiddleName`, `LastName`, `Username`, `Email`, `Password`, `Role`, `user_id`) VALUES
(5, 'c', 'c', 'c', 'c', 'c@gmail.com', '$2y$10$9fxYZnUScmH6jVkn2h0Nke8xXE/F3S1rlpcPZhOGWhi9XZNmGFkwe', '', 0),
(6, 'b', 'b', 'b', 'b', 'b@gmail.com', '$2y$10$SobUZGtIHNavAFsC0mHRtOY59ji7IG/lR5KiO7o.ONCPda4kt29JW', '', 0),
(9, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$cgdna4u1N.hVag3VWZGWE..iAcp/0dexngGnTiJl2g2SF/PYbCsXC', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl1`
--
ALTER TABLE `tbl1`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl1`
--
ALTER TABLE `tbl1`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
