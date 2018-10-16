-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 11:00 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `idKey` int(11) NOT NULL,
  `uname` tinytext NOT NULL,
  `fname` tinytext NOT NULL,
  `lname` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pword` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` varchar(20) NOT NULL,
  `EventName` varchar(20) NOT NULL,
  `EventDate` date NOT NULL,
  `GRPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `GRPID` int(11) NOT NULL,
  `FNAME` varchar(20) NOT NULL,
  `LNAME` varchar(20) NOT NULL,
  `EMAIL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MESSAGEId` int(11) NOT NULL,
  `MESSAGE` text NOT NULL,
  `Date` date NOT NULL,
  `GRPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Name`, `Email`) VALUES
('Jackson', 'jackson@odu.edu'),
('Bisi', 'bisi28ade@gmail.com'),
('Bisi', '#'),
('Bisi', 'femlajoe@yahoo.com'),
('Bisi', 'femlajoe@yahoo.com'),
('', ''),
('besi', 'kkkk'),
('besi', 'kkkk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fname` char(25) NOT NULL,
  `lname` char(25) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pword` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `uname`, `email`, `pword`) VALUES
(1, 'Doc', 'Hudson', '@doc', 'hornet@rsprings.gov', 'dhudson'),
(2, 'Finn', 'McMissile', '@mcmissile', 'topsercet@agent.org', 'fmcmissile'),
(3, 'Lightning', 'McQueen', '@mcqueen', 'kachow@rusteze.com', 'lmcqueen'),
(4, 'Sally', 'Carrera', '@sally', 'porsche@rsprings.gov', 'sallyc'),
(5, 'Tom', 'Mater', '@mater', 'mater@rsprings.gov', 'matert');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`idKey`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`(10)),
  ADD KEY `GRPID` (`GRPID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`GRPID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MESSAGEId`),
  ADD KEY `GRPID` (`GRPID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `idKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `EVENT_ibfk_1` FOREIGN KEY (`GRPID`) REFERENCES `members` (`GRPID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`GRPID`) REFERENCES `members` (`GRPID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
