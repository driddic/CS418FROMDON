-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2019 at 05:53 PM
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
  `access` varchar(11) NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grpid`, `grpname`, `owner`, `access`, `archive`) VALUES
(1, 'Basketball', 'admin', 'public', 0),
(5, 'Football', 'admin', 'public', 0),
(6, 'SportsCenter', 'admin', 'public', 0),
(12, 'Free Rides', '@sally', 'public', 0);

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
  `userid` int(11) NOT NULL,
  `uname` tinytext NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`grpid`, `userid`, `uname`, `active`) VALUES
(6, 1, '@doc', 0),
(6, 2, '@mcmissile', 0),
(6, 3, '@mcqueen', 0),
(6, 4, '@sally', 0),
(6, 5, '@mater', 0),
(1, 4, '@sally', 0),
(5, 1, '@doc', 0),
(5, 3, '@mcqueen', 0),
(6, 23, '@google', 0),
(6, 24, '@hey', 0),
(12, 4, '@sally', 0),
(5, 4, '@sally', 0),
(1, 9, 'admin', 0),
(5, 9, 'admin', 0),
(6, 9, 'admin', 0),
(12, 9, 'admin', 0);

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
  `recip` int(11) NOT NULL,
  `sender` int(25) NOT NULL,
  `threadID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messageroom`
--

INSERT INTO `messageroom` (`commentID`, `message`, `timestamp`, `recip`, `sender`, `threadID`) VALUES
(43, 'testing', '2019-04-01 22:02:16', 4, 1, 551),
(48, 'got it', '2019-04-01 23:54:17', 1, 4, 551),
(49, 'hello sir', '2019-04-02 00:25:56', 3, 4, 858),
(50, 'what are you doing test', '2019-04-11 15:37:06', 1, 9, 42),
(51, 'testing', '2019-04-11 15:37:57', 9, 1, 42);

-- --------------------------------------------------------

--
-- Table structure for table `profileimage`
--

CREATE TABLE `profileimage` (
  `picid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `keep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profileimage`
--

INSERT INTO `profileimage` (`picid`, `userid`, `status`, `keep`) VALUES
(1, 1, 0, 0),
(2, 2, 1, 0),
(3, 3, 1, 0),
(4, 4, 1, 0),
(5, 5, 1, 0),
(6, 9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `uid` int(11) NOT NULL,
  `comment_sender_name` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grpid` int(11) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `parent_comment_id`, `message`, `uid`, `comment_sender_name`, `date`, `grpid`, `vote`) VALUES
(3, 0, 'test', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(4, 0, 'test', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(5, 0, 'testing 123', 1, '@doc', '2019-04-08 21:36:54', 6, 0),
(6, 0, 'TEST FROM FORM', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(7, 0, 'TEST FROM myadmin', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(8, 0, 'test from page', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(9, 0, 'tet', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(10, 0, 'hey', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(11, 0, 'hey', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(12, 0, 'hey peoples', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(13, 0, 'hey peoples', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(14, 0, 'explain your code', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(15, 0, 'test rep', 1, '@doc', '2019-04-05 19:50:00', 6, 0),
(16, 15, 'test reply though', 1, '@doc', '2019-04-08 21:36:38', 6, 0),
(17, 15, 'test reply though', 1, '@doc', '2019-04-08 21:36:38', 6, 0),
(19, 0, 'hello group', 4, '@sally', '2019-04-05 19:50:26', 6, 0),
(20, 0, 'hello group', 4, '@sally', '2019-04-05 19:50:26', 6, 0),
(21, 0, 'what', 4, '@sally', '2019-04-05 19:50:26', 6, 0),
(22, 21, 'I understand the js ajax thing', 4, '@sally', '2019-04-08 22:07:38', 6, 0),
(23, 21, 'I understand the js ajax thing', 4, '@sally', '2019-04-08 22:07:21', 6, 0),
(24, 21, 'me too', 6, '@peach', '2019-04-08 22:07:21', 6, 0),
(25, 20, 'hi', 0, '@peach', '2019-04-08 22:13:28', 6, 0),
(26, 21, 'test final', 0, '@sally', '2019-04-08 22:54:59', 6, 0),
(27, 4, 'test final', 0, '@sally', '2019-04-08 22:55:14', 6, 0),
(28, 6, 'uno', 0, '@peach', '2019-04-08 23:08:53', 6, 0),
(29, 6, 'no guilt', 0, '@peach', '2019-04-08 23:13:40', 6, 0),
(30, 0, 'hello for once', 1, '@doc', '2019-04-09 15:18:21', 6, 0),
(31, 0, 'hello for twice', 30, '@doc', '2019-04-09 15:21:32', 6, 0),
(32, 0, 'new pic', 9, 'admin', '2019-04-10 23:04:39', 1, 0),
(33, 0, 'new design', 9, 'admin', '2019-04-10 23:04:52', 6, 0);

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
(9, 'Dontavus', 'Riddick', 'admin', 'dridd013@odu.edu', 'admin');

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
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

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
  MODIFY `grpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messageroom`
--
ALTER TABLE `messageroom`
  MODIFY `commentID` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `picid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
