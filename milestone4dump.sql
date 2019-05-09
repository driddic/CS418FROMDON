-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2019 at 03:14 AM
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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `image_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `image_text`) VALUES
(1, '8a31b1fa02004f2209245c740e87772f.jpg', 'look'),
(2, '', 'hi'),
(3, '', 'supp'),
(4, '', 'yo\r\n'),
(5, '100-websites-rule-internet-768x692.jpg', 'internet facts'),
(6, '', 'with test'),
(7, '100-websites-rule-internet-768x692.jpg', 'cool though'),
(8, '100-websites-rule-internet-768x692.jpg', 'cool though'),
(9, 'WIN_20180302_06_37_05_Pro.jpg', 'fire'),
(10, 'WIN_20181219_19_48_44_Pro.jpg', 'phone'),
(11, '', ''),
(12, '', ''),
(13, '', ''),
(14, '', ''),
(15, '', 'look its work'),
(16, '', ''),
(17, '', ''),
(18, '', ''),
(19, '', ''),
(20, '', ''),
(21, '', ''),
(22, 'WIN_20181219_19_28_22_Pro.jpg', 'pic'),
(23, '', ''),
(24, '', ''),
(25, '', ''),
(44, '', 'look\r\n'),
(45, '', 'look\r\n'),
(46, '', 'look\r\n'),
(47, '', 'look\r\n'),
(48, '', 'look\r\n'),
(49, '', 'look\r\n'),
(50, '', ''),
(51, '', ''),
(52, '', ''),
(53, '', ''),
(54, '', ''),
(55, '', ''),
(56, '', ''),
(57, '', ''),
(58, '', ''),
(59, '', ''),
(60, '', ''),
(61, '', ''),
(62, '', ''),
(63, '', ''),
(64, '', ''),
(65, '', ''),
(66, '', ''),
(67, '', ''),
(68, '', ''),
(69, '', ''),
(70, '', ''),
(71, '', ''),
(72, '', 'high five'),
(73, '', 'high five'),
(74, '', 'hola'),
(75, '', 'hola'),
(76, '', 'hola'),
(77, './upload/870.jpg', ''),
(78, './upload/650.jpg', ''),
(79, './upload/217.jpg', ''),
(80, './upload/415.jpg', ''),
(81, './upload/507.jpg', ''),
(82, './upload/572.jpg', ''),
(83, './upload/938.jpg', ''),
(84, './upload/527.jpg', ''),
(85, './upload/523.jpg', ''),
(86, './upload/193.jpg', ''),
(87, './upload/690.jpg', ''),
(88, './upload/564.jpg', ''),
(89, './upload/772.jpg', ''),
(90, './upload/348.jpg', ''),
(91, './upload/417.jpg', ''),
(92, './upload/137.jpg', ''),
(93, './upload/703.jpg', ''),
(94, './upload/862.jpg', '');

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
  `locate` varchar(225) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `keep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profileimage`
--

INSERT INTO `profileimage` (`picid`, `locate`, `userid`, `status`, `keep`) VALUES
(1, 'assets/profile1.png', 1, 0, 1),
(2, 'assets/profile.png', 2, 1, 0),
(3, 'assets/profile.png', 3, 1, 0),
(4, 'assets/profile.png', 4, 1, 0),
(5, 'assets/profile.png', 5, 1, 0),
(6, 'assets/profile9792.jpg', 9, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(200) CHARACTER SET latin1 NOT NULL,
  `uid` int(11) NOT NULL,
  `comment_sender_name` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grpid` int(11) NOT NULL,
  `voteup` int(11) NOT NULL,
  `votedown` int(11) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `parent_comment_id`, `message`, `image`, `uid`, `comment_sender_name`, `date`, `grpid`, `voteup`, `votedown`, `code`) VALUES
(3, 0, 'test', '0', 1, '@doc', '2019-04-29 00:48:12', 6, 2, 0, 0),
(4, 0, 'test', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(5, 0, 'testing 123', '0', 1, '@doc', '2019-04-08 21:36:54', 6, 0, 0, 0),
(6, 0, 'TEST FROM FORM', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(7, 0, 'TEST FROM myadmin', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(8, 0, 'test from page', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(9, 0, 'tet', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(10, 0, 'hey', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(11, 0, 'hey', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(12, 0, 'hey peoples', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(13, 0, 'hey peoples', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(14, 0, 'explain your code', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(15, 0, 'test rep', '0', 1, '@doc', '2019-04-05 19:50:00', 6, 0, 0, 0),
(16, 15, 'test reply though', '0', 1, '@doc', '2019-04-08 21:36:38', 6, 0, 0, 0),
(17, 15, 'test reply though', '0', 1, '@doc', '2019-04-08 21:36:38', 6, 0, 0, 0),
(19, 0, 'hello group', '0', 4, '@sally', '2019-04-05 19:50:26', 6, 0, 0, 0),
(20, 0, 'hello group', '0', 4, '@sally', '2019-04-05 19:50:26', 6, 0, 0, 0),
(21, 0, 'what', '0', 4, '@sally', '2019-04-05 19:50:26', 6, 0, 0, 0),
(22, 21, 'I understand the js ajax thing', '0', 4, '@sally', '2019-04-08 22:07:38', 6, 0, 0, 0),
(23, 21, 'I understand the js ajax thing', '0', 4, '@sally', '2019-04-08 22:07:21', 6, 0, 0, 0),
(24, 21, 'me too', '0', 6, '@peach', '2019-04-08 22:07:21', 6, 0, 0, 0),
(25, 20, 'hi', '0', 0, '@peach', '2019-04-08 22:13:28', 6, 0, 0, 0),
(26, 21, 'test final', '0', 0, '@sally', '2019-04-08 22:54:59', 6, 0, 0, 0),
(27, 4, 'test final', '0', 0, '@sally', '2019-04-08 22:55:14', 6, 0, 0, 0),
(28, 6, 'uno', '0', 0, '@peach', '2019-04-08 23:08:53', 6, 0, 0, 0),
(29, 6, 'no guilt', '0', 0, '@peach', '2019-04-08 23:13:40', 6, 0, 0, 0),
(30, 0, 'hello for once', '0', 1, '@doc', '2019-04-09 15:18:21', 6, 0, 0, 0),
(31, 0, 'hello for twice', '0', 30, '@doc', '2019-04-09 15:21:32', 6, 0, 0, 0),
(32, 0, 'new pic', '0', 9, 'admin', '2019-04-10 23:04:39', 1, 0, 0, 0),
(33, 0, 'new design', '0', 9, 'admin', '2019-04-10 23:04:52', 6, 0, 0, 0),
(34, 0, 'whats happening', '0', 1, '@doc', '2019-04-20 14:59:16', 6, 0, 0, 0),
(35, 0, 'I think it works now', '0', 1, '@doc', '2019-04-20 15:00:13', 6, 0, 0, 0),
(36, 35, 'replies should too', '0', 4, '@sally', '2019-04-20 15:09:19', 6, 0, 0, 0),
(37, 34, 'it does work', '0', 4, '@sally', '2019-04-20 15:11:59', 6, 0, 0, 0),
(38, 32, 'what pic?', '0', 4, '@sally', '2019-04-29 01:12:31', 1, 1, 0, 0),
(39, 32, 'What pic?', '0', 4, '@sally', '2019-04-20 15:15:18', 1, 0, 0, 0),
(40, 32, 'huh?', '0', 4, '@sally', '2019-04-20 15:17:59', 1, 0, 0, 0),
(41, 32, 'testing', '0', 4, '@sally', '2019-04-20 15:21:34', 1, 0, 0, 0),
(42, 35, 'are you sure', '0', 9, 'admin', '2019-04-20 15:48:54', 6, 0, 0, 0),
(43, 0, 'what about now', '0', 9, 'admin', '2019-04-20 16:31:30', 6, 0, 0, 0),
(44, 0, 'i think so', '0', 9, 'admin', '2019-04-29 10:47:10', 6, 1, 1, 0),
(45, 32, 'Ill post it soon', '0', 9, 'admin', '2019-04-20 16:32:48', 1, 0, 0, 0),
(46, 0, 'hello anyone', '0', 9, 'admin', '2019-04-21 20:19:52', 5, 0, 0, 0),
(47, 0, 'hello\r\n', '', 4, '@sally', '2019-04-27 22:50:32', 12, 0, 0, 0),
(48, 0, 'who is driving\r\n', '', 4, '@sally', '2019-04-27 22:50:50', 12, 0, 0, 0),
(49, 0, 'look', ' ', 4, '@sally', '2019-04-27 23:37:46', 12, 0, 0, 0),
(50, 0, 'interesting\r\n', ' ', 4, '@sally', '2019-04-27 23:41:38', 12, 0, 0, 0),
(51, 0, 'hi', ' ', 4, '@sally', '2019-04-27 23:47:14', 12, 0, 0, 0),
(52, 0, 'who', '', 4, '@sally', '2019-04-28 00:29:09', 12, 0, 0, 0),
(53, 0, 'what happens now\r\n', '', 1, '@doc', '2019-04-28 20:11:02', 5, 0, 0, 0),
(54, 0, 'what happens then', '', 1, '@doc', '2019-04-28 20:11:37', 5, 0, 0, 0),
(55, 0, 'pic post', '', 1, '@doc', '2019-04-28 20:15:07', 5, 0, 0, 0),
(56, 0, 'hola', '', 1, '@doc', '2019-04-28 20:18:12', 5, 0, 0, 0),
(57, 0, 'attempt', '', 1, '@doc', '2019-04-28 20:20:04', 5, 0, 0, 0),
(58, 0, 'lol', '', 1, '@doc', '2019-04-28 20:20:17', 5, 0, 0, 0),
(59, 0, 'work', '', 1, '@doc', '2019-04-28 20:23:01', 5, 0, 0, 0),
(60, 0, 'please', '', 1, '@doc', '2019-04-28 20:24:16', 5, 0, 0, 0),
(61, 0, 'check', '', 1, '@doc', '2019-04-28 20:27:12', 5, 0, 0, 0),
(62, 61, 'square', '', 1, '@doc', '2019-04-28 20:27:46', 5, 0, 0, 0),
(63, 0, 'now add comment', '', 1, '@doc', '2019-04-28 20:51:20', 5, 0, 0, 0),
(64, 0, 'watch', '', 1, '@doc', '2019-04-28 21:17:20', 5, 0, 0, 0),
(65, 0, 'look', '', 1, '@doc', '2019-04-28 21:17:48', 5, 0, 0, 0),
(66, 0, 'football', '', 1, '@doc', '2019-04-28 23:30:48', 5, 0, 0, 0),
(67, 0, 'so', '', 1, '@doc', '2019-04-28 23:46:49', 5, 0, 0, 0),
(68, 0, 'hello', '', 1, '@doc', '2019-04-29 00:25:10', 5, 0, 0, 0),
(69, 0, 'work', '', 1, '@doc', '2019-04-30 02:02:10', 5, 0, 0, 0),
(70, 0, 'work', '', 1, '@doc', '2019-04-30 02:02:41', 5, 0, 0, 0),
(71, 0, 'win', '', 1, '@doc', '2019-04-30 02:50:28', 5, 0, 0, 0),
(72, 0, 'does this work', '', 9, 'admin', '2019-05-06 20:17:49', 6, 0, 0, 0),
(73, 0, 'it does', '', 9, 'admin', '2019-05-06 20:18:30', 6, 0, 0, 0),
(74, 0, 'hello world', '', 9, 'admin', '2019-05-06 21:59:43', 6, 0, 0, 1),
(75, 0, 'look at this picture', '', 9, 'admin', '2019-05-06 22:57:46', 5, 0, 0, 0),
(76, 0, 'look pic', '', 9, 'admin', '2019-05-06 23:11:22', 1, 0, 0, 0),
(77, 0, 'see', '', 9, 'admin', '2019-05-06 23:24:32', 1, 0, 0, 0),
(78, 0, '     helo', '', 9, 'admin', '2019-05-08 14:01:01', 6, 0, 0, 0),
(79, 0, '     bonus', '', 9, 'admin', '2019-05-08 14:03:10', 6, 0, 0, 1),
(80, 0, '     bet', '', 9, 'admin', '2019-05-08 14:28:10', 1, 0, 0, 1),
(81, NULL, '', './upload/650.jpg', 9, 'admin', '2019-05-08 17:54:15', 0, 0, 0, 0),
(82, 0, '', './upload/217.jpg', 9, 'admin', '2019-05-08 17:58:39', 0, 0, 0, 0),
(83, 0, '', './upload/415.jpg', 9, 'admin', '2019-05-08 18:02:08', 0, 0, 0, 0),
(84, 0, '', './upload/507.jpg', 9, 'admin', '2019-05-08 18:27:17', 1, 0, 0, 0),
(85, 0, '', './upload/572.jpg', 9, 'admin', '2019-05-08 18:22:06', 0, 0, 0, 0),
(86, 0, '', './upload/938.jpg', 9, 'admin', '2019-05-08 18:23:06', 0, 0, 0, 0),
(87, 0, '', './upload/527.jpg', 9, 'admin', '2019-05-08 18:26:47', 0, 0, 0, 0),
(88, 0, '', './upload/523.jpg', 9, 'admin', '2019-05-08 18:41:02', 0, 0, 0, 0),
(89, 0, '', './upload/193.jpg', 9, 'admin', '2019-05-08 18:43:51', 0, 0, 0, 0),
(90, 0, '', './upload/690.jpg', 9, 'admin', '2019-05-08 19:00:38', 0, 0, 0, 0),
(91, 0, '', './upload/564.jpg', 9, 'admin', '2019-05-08 19:08:39', 0, 0, 0, 0),
(92, 0, '', './upload/772.jpg', 9, 'admin', '2019-05-08 19:12:19', 0, 0, 0, 0),
(93, 0, '', './upload/348.jpg', 9, 'admin', '2019-05-08 20:09:23', 0, 0, 0, 0),
(94, 0, '', './upload/417.jpg', 9, 'admin', '2019-05-08 20:10:37', 0, 0, 0, 0),
(95, 0, '', './upload/137.jpg', 9, 'admin', '2019-05-08 20:20:26', 0, 0, 0, 0),
(96, 0, '', './upload/703.jpg', 9, 'admin', '2019-05-08 21:12:57', 1, 0, 0, 0),
(97, 0, '', './upload/862.jpg', 9, 'admin', '2019-05-08 21:17:50', 5, 0, 0, 0),
(98, 0, '', 'upload/url355.jpg', 9, 'admin', '2019-05-08 23:44:27', 1, 0, 0, 0),
(99, 0, '', 'upload/url679.jpg', 9, 'admin', '2019-05-09 01:09:30', 1, 0, 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`id`, `userid`, `commentid`) VALUES
(1, 6, 400),
(2, 9, 38),
(3, 9, 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`grpid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

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
ALTER TABLE `tbl_comment` ADD FULLTEXT KEY `message` (`message`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `grpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
