-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2018 at 02:05 AM
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

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grpID`, `grpname`) VALUES
(1, 'Basketball'),
(5, 'football'),
(6, 'Sportscenter');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `grpid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`grpid`, `userid`) VALUES
(1, 1),
(1, 4),
(5, 1),
(5, 3),
(6, 0),
(6, 0),
(6, 0),
(6, 21),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 22);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messID` int(11) NOT NULL,
  `parent_commentID` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `grpID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messageroom`
--

CREATE TABLE `messageroom` (
  `commentID` int(111) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messageroom`
--

INSERT INTO `messageroom` (`commentID`, `message`, `timestamp`, `username`) VALUES
(1, 'yes\r\n', '2018-11-24 00:29:49', ''),
(2, 'do it again', '2018-11-24 00:43:22', ''),
(3, 'hello', '2018-11-24 01:00:35', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `profileimage`
--

CREATE TABLE `profileimage` (
  `picid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL
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
(10, 'Don', 'Now', 'tello', 'you@now.org', 'test'),
(11, 'fine', 'testboy', 'testboy', 'testboy@yes.org', 'test'),
(12, 'fine', 'testboy', 'testboy2', 'testboy@yes.org', 'hi'),
(13, 'hola', 'hola', 'hola', 'hola@hola.com', 'hola'),
(14, 'blah', 'man', 'blah', 'blah@blah.com', 'blah'),
(15, 'member', 'member', 'member', 'members@only.com', 'yes'),
(16, 'member', 'member', 'member2', 'members@only.co', 'yes'),
(17, 'keep', 'on', 'keepon', 'test@go.org', 'test'),
(18, 'first', 'member', 'first', 'hey@first.com', 'hey'),
(19, 'blah', 'again', 'again', 'blah@test.org', 'test'),
(20, 'hustle', 'man', 'hustle', 'bro@brobro.com', 'man'),
(21, 'auto', 'matic', 'auto', 'auto@matic.co', 'auto'),
(22, 'Dons', 'mom', 'mom', 'dt@polo.com', 'hp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`grpID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messID`),
  ADD KEY `GRPID` (`grpID`);

--
-- Indexes for table `messageroom`
--
ALTER TABLE `messageroom`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `profileimage`
--
ALTER TABLE `profileimage`
  ADD PRIMARY KEY (`picid`);

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
  MODIFY `grpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messageroom`
--
ALTER TABLE `messageroom`
  MODIFY `commentID` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `picid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
