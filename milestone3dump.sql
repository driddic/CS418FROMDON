-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 08:27 PM
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
CREATE DATABASE IF NOT EXISTS `university` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `university`;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `grpID` int(11) NOT NULL,
  `grpname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `grpID` int(11) NOT NULL,
  `userid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messID` int(11) NOT NULL,
  `text` text NOT NULL,
  `Date` date NOT NULL,
  `grpID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(100) NOT NULL,
  `fname` char(25) NOT NULL,
  `lname` char(25) NOT NULL,
  `uname` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pword` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fname`, `lname`, `uname`, `email`, `pword`) VALUES
(1, 'Doc', 'Hudson', '@doc', 'hornet@rsprings.gov', 'dhudson'),
(2, 'Finn', 'McMissile', '@mcmissile', 'topsercet@agent.org', 'fmcmissile'),
(3, 'Lightning', 'McQueen', '@mcqueen', 'kachow@rusteze.com', 'lmcqueen'),
(4, 'Sally', 'Carrera', '@sally', 'porsche@rsprings.gov', 'sallyc'),
(5, 'Tom', 'Mater', '@mater', 'mater@rsprings.gov', 'matert'),
(6, 'don', 'test', '@peach', 'test@test.org', '$2y$10$SUK/ZDny.ERn7bZqmSa.KOKjozZRMUn3.CK1ooVDWZLRnLupyQGoe'),
(9, 'Dontavus', 'Riddick', 'admin', 'dridd013@odu.edu', 'admin'),
(10, 'Don', 'Now', 'tello', 'you@now.org', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`grpID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`grpID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messID`),
  ADD KEY `GRPID` (`grpID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `grpID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`GRPID`) REFERENCES `members` (`GRPID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
