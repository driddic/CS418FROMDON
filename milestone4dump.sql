-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 09:39 PM
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
  `grpid` int(11) NOT NULL,
  `grpname` varchar(20) NOT NULL,
  `owner` varchar(25) DEFAULT NULL,
  `access` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grpid`, `grpname`, `owner`, `access`) VALUES
(1, 'Basketball', NULL, 'public'),
(5, 'Football', NULL, 'public'),
(6, 'SportsCenter', NULL, 'public'),
(7, 'testgrp', '', 'public'),
(8, 'practice squad', '', 'public'),
(9, 'practice crew', '@doc', 'private'),
(10, 'bench warmers', '@doc', 'public'),
(11, 'Fav Five', '@doc', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `grpid` int(11) NOT NULL,
  `userid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`grpid`, `userid`) VALUES
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 9),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 9);

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
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 9),
(1, 1),
(1, 4),
(5, 1),
(5, 3),
(6, 23),
(6, 24);

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
  `userid` varchar(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `grpid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messageroom`
--

INSERT INTO `messageroom` (`commentID`, `message`, `timestamp`, `userid`, `uname`, `grpid`) VALUES
(1, 'yes\r\n', '2018-11-24 00:29:49', '', '', 0),
(2, 'do it again', '2018-11-24 00:43:22', '', '', 0),
(3, 'hello', '2018-11-24 01:00:35', 'admin', '', 0),
(4, 'dance', '2018-11-24 15:50:58', '', '', 0),
(5, 'dance', '2018-11-24 15:50:58', '', '', 0),
(6, 'dance', '2018-11-24 15:50:58', '', '', 0),
(7, 'dance', '2018-11-24 15:50:58', '', '', 0),
(8, 'dance', '2018-11-24 15:50:58', '', '', 0),
(9, 'dance', '2018-11-24 15:50:58', '', '', 0),
(10, 'dance', '2018-11-24 15:50:58', '', '', 0),
(11, 'dance', '2018-11-24 15:50:58', '', '', 0),
(12, 'hola', '2018-11-24 20:17:38', '9', '', 0),
(13, 'hola 2', '2018-11-24 20:21:46', '9', '', 0),
(14, 'hola times two', '2018-11-24 20:31:01', '9', '', 0),
(15, 'hola times two', '2018-11-24 20:31:01', '9', '', 0),
(16, 'hello', '2018-11-24 20:33:55', '9', '', 0),
(17, 'newest', '2018-11-24 20:43:30', '9', '', 0),
(18, 'newest', '2018-11-24 20:43:38', '9', '', 0),
(19, 'sc test', '2018-11-25 06:53:20', '1', '', 6),
(20, 'sc test 2', '2018-11-25 06:53:32', '1', '', 6),
(21, 'sc test 3', '2018-11-25 06:55:24', '9', '', 6),
(22, '', '2018-11-27 04:34:59', '9', '', 6),
(23, '', '2018-11-27 04:55:42', '9', '', 6),
(24, '', '2018-11-27 04:55:42', '9', '', 6),
(25, '', '2018-11-27 04:55:42', '9', '', 6),
(26, '', '2018-11-27 04:55:42', '9', '', 6),
(27, '', '2018-11-27 04:55:42', '9', '', 6),
(28, '', '2018-11-27 04:55:42', '9', '', 6),
(29, 'grp 1 test', '2018-11-27 19:33:34', '1', '', 0),
(30, 'grp 1 test', '2018-11-27 19:33:34', '1', '', 0),
(31, 'grp 1 post test', '2018-11-27 19:35:55', '1', '', 1),
(32, 'grp 1 post test', '2018-11-27 19:35:55', '1', '', 1),
(33, 'grp 1 post test', '2018-11-27 19:35:55', '1', '', 1),
(34, 'grp 1 post test', '2018-11-27 19:35:55', '1', '', 1),
(35, 'grp 1 post test', '2018-11-27 19:35:55', '1', '', 1),
(36, 'grp 1 post test', '2018-11-27 19:35:55', '1', '', 1),
(37, 'grp 5 post test', '2018-11-27 19:36:23', '1', '', 5),
(38, 'grp 5 post test', '2018-11-27 19:36:23', '1', '', 5),
(39, 'grp 5 post test', '2018-11-27 19:36:23', '1', '', 5),
(40, 'grp 5 post test', '2018-11-27 19:36:23', '1', '', 5),
(41, 'grp 5 post test', '2018-11-27 19:36:23', '1', '', 5),
(42, 'grp 5 post test', '2018-11-27 19:36:23', '1', '', 5);

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
(22, 'Dons', 'mom', 'mom', 'dt@polo.com', 'hp'),
(23, 'don', 'google', '@google', 'don@google.com', 'test'),
(24, 'don', 'hey', '@hey', 'don@hey.io', 'don');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`grpid`);

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
  MODIFY `grpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messageroom`
--
ALTER TABLE `messageroom`
  MODIFY `commentID` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `picid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
