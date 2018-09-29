-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2018 at 03:54 PM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `University`
--
CREATE DATABASE IF NOT EXISTS `University` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `University`;

-- --------------------------------------------------------

--
-- Table structure for table `EVENT`
--

DROP TABLE IF EXISTS `EVENT`;
CREATE TABLE IF NOT EXISTS `EVENT` (
  `EventID` varchar(20) NOT NULL,
  `EventName` varchar(20) NOT NULL,
  `EventDate` date NOT NULL,
  `GRPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

DROP TABLE IF EXISTS `Members`;
CREATE TABLE IF NOT EXISTS `Members` (
  `GRPID` int(11) NOT NULL,
  `FNAME` varchar(20) NOT NULL,
  `LNAME` varchar(20) NOT NULL,
  `EMAIL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGE`
--

DROP TABLE IF EXISTS `MESSAGE`;
CREATE TABLE IF NOT EXISTS `MESSAGE` (
  `MESSAGEId` int(11) NOT NULL,
  `MESSAGE` text NOT NULL,
  `Date` date NOT NULL,
  `GRPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
CREATE TABLE IF NOT EXISTS `Student` (
  `Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`Name`, `Email`) VALUES
('Jackson', 'jackson@odu.edu'),
('Bisi', 'bisi28ade@gmail.com'),
('Bisi', '#'),
('Bisi', 'femlajoe@yahoo.com'),
('Bisi', 'femlajoe@yahoo.com'),
('', ''),
('besi', 'kkkk'),
('besi', 'kkkk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EVENT`
--
ALTER TABLE `EVENT`
  ADD PRIMARY KEY (`EventID`(10)),
  ADD KEY `GRPID` (`GRPID`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`GRPID`);

--
-- Indexes for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`MESSAGEId`),
  ADD KEY `GRPID` (`GRPID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `EVENT`
--
ALTER TABLE `EVENT`
  ADD CONSTRAINT `EVENT_ibfk_1` FOREIGN KEY (`GRPID`) REFERENCES `Members` (`GRPID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`GRPID`) REFERENCES `Members` (`GRPID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
