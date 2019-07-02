-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 05:37 PM
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
(12, 'Free Rides', '@sally', 'public', 0),
(13, 'players', '@doc', 'public', 0),
(14, 'Test Group', 'admin', 'public', 0),
(15, 'Another Test', '', 'public', 0),
(16, 'Project', 'admin', 'public', 0),
(17, 'Project Two', 'admin', 'private', 0);

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
(94, './upload/862.jpg', ''),
(95, './upload/918.jpg', ''),
(96, './upload/470.jpg', ''),
(97, './upload/881.jpg', ''),
(98, './upload/125.txt', ''),
(99, './upload/745.txt', ''),
(100, './upload/226.png', ''),
(101, './upload/290.jpg', ''),
(102, './upload/429.jpg', ''),
(103, './upload/576.txt', '');

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
(5, 4, '@sally', 0),
(1, 9, 'admin', 0),
(5, 9, 'admin', 0),
(6, 9, 'admin', 0),
(12, 9, 'admin', 0),
(13, 1, '@doc', 0),
(1, 1, '@doc', 0),
(14, 9, 'admin', 0),
(14, 9, 'admin', 0),
(15, 9, 'admin', 0),
(16, 9, 'admin', 0),
(16, 9, 'admin', 0),
(17, 9, 'admin', 0),
(12, 2, '@mcmissile', 0),
(12, 1, '@doc', 0),
(13, 2, '@mcmissile', 0),
(6, 10, '', 0),
(6, 11, '', 0),
(6, 12, '', 0),
(6, 12, 'fireman', 1),
(6, 4, '@sally', 1),
(6, 12, 'fireman', 1),
(6, 12, 'fireman', 1),
(6, 4, '@sally', 1),
(6, 12, 'fireman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messagecontrol`
--

CREATE TABLE `messagecontrol` (
  `threadId` int(11) NOT NULL,
  `userOne` varchar(225) NOT NULL,
  `userTwo` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagecontrol`
--

INSERT INTO `messagecontrol` (`threadId`, `userOne`, `userTwo`) VALUES
(551, '@sally', '@doc'),
(551, '@sally', '@doc'),
(858, '@mcqueen', '@sally'),
(42, '@doc', 'admin'),
(761, '@doc', '@mater'),
(858, '@mcqueen', '@sally'),
(42, '@doc', 'admin'),
(761, '@doc', '@mater'),
(726, '@mcqueen', '@doc');

-- --------------------------------------------------------

--
-- Table structure for table `messageroom`
--

CREATE TABLE `messageroom` (
  `commentID` int(111) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `senderID` int(25) NOT NULL,
  `fromUser` varchar(225) NOT NULL,
  `threadID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messageroom`
--

INSERT INTO `messageroom` (`commentID`, `message`, `timestamp`, `senderID`, `fromUser`, `threadID`) VALUES
(43, 'testing', '2019-05-21 17:26:10', 1, '@doc', 551),
(48, 'got it', '2019-05-21 17:26:10', 4, '@sally', 551),
(49, 'hello sir', '2019-05-21 17:26:10', 4, '@sally', 858),
(50, 'what are you doing test', '2019-05-21 17:26:10', 9, 'admin', 42),
(51, 'testing', '2019-05-21 17:26:11', 1, '@doc', 42),
(52, 'sdfnmdsf ', '2019-05-21 17:26:11', 1, '@doc', 761),
(53, 'should you reply, im testing', '2019-05-21 17:59:36', 1, '1', 761),
(54, 'this too', '2019-05-21 18:01:54', 1, '@doc', 551),
(55, 'bam', '2019-05-23 15:44:48', 1, '@doc', 551),
(56, 'yo', '2019-05-23 15:59:10', 1, '@doc', 145),
(57, 'final', '2019-05-23 16:00:21', 1, '@doc', 726),
(58, 'still testing', '2019-05-24 14:39:33', 1, '@doc', 42),
(59, 'can you recommend me some groups', '2019-06-20 14:45:05', 5, '@mater', 761);

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
(1, 'assets/profile1818.jpg', 1, 0, 1),
(2, 'assets/profile.png', 2, 1, 0),
(3, 'assets/profile.png', 3, 1, 0),
(4, 'assets/profile.png', 4, 1, 0),
(5, 'assets/profile.png', 5, 1, 0),
(6, 'https://www.gravatar.com/avatar/38ece33ee8899b9cd585b4bbebb02755?d=assets%2Fprofile9618.jpg&s=180', 9, 0, 0),
(7, 'assets/profile.png', 10, 0, 1),
(8, 'assets/profile.png', 11, 1, 0),
(9, 'assets/profile.png', 12, 1, 0);

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
(71, 0, 'win', '', 1, '@doc', '2019-05-10 02:57:49', 5, 1, 0, 0),
(72, 0, 'does this work', '', 9, 'admin', '2019-05-06 20:17:49', 6, 0, 0, 0),
(73, 0, 'it does', '', 9, 'admin', '2019-05-06 20:18:30', 6, 0, 0, 0),
(74, 0, 'hello world', '', 9, 'admin', '2019-05-06 21:59:43', 6, 0, 0, 1),
(75, 0, 'look at this picture', '', 9, 'admin', '2019-05-10 10:20:15', 5, 2, -1, 0),
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
(97, 0, '', './upload/862.jpg', 9, 'admin', '2019-05-10 10:17:00', 5, -1, 2, 0),
(98, 0, '', 'upload/url355.jpg', 9, 'admin', '2019-05-08 23:44:27', 1, 0, 0, 0),
(99, 0, '', 'upload/url679.jpg', 9, 'admin', '2019-05-09 01:09:30', 1, 0, 0, 0),
(100, 0, '', './upload/918.jpg', 9, 'admin', '2019-05-10 11:07:53', 6, 0, 2, 0),
(101, 0, '', 'upload/url867.jpg', 9, 'admin', '2019-05-09 01:33:29', 1, 0, 0, 0),
(102, 0, '     1', '', 9, 'admin', '2019-05-09 01:40:25', 1, 0, 0, 0),
(103, 0, '     2', '', 9, 'admin', '2019-05-09 01:40:28', 1, 0, 0, 0),
(104, 0, '     3', '', 9, 'admin', '2019-05-09 01:40:32', 1, 0, 0, 0),
(105, 0, '     4', '', 9, 'admin', '2019-05-09 01:40:36', 1, 0, 0, 0),
(106, 0, '     5', '', 9, 'admin', '2019-05-09 01:40:42', 1, 0, 0, 0),
(107, 0, '     6', '', 9, 'admin', '2019-05-09 01:40:45', 1, 0, 0, 0),
(108, 0, '     7', '', 9, 'admin', '2019-05-09 01:40:49', 1, 0, 0, 0),
(109, 0, '     turned into 3 pages after 7', '', 9, 'admin', '2019-05-09 01:41:16', 1, 0, 0, 0),
(110, 109, '     yes', '', 9, 'admin', '2019-05-09 01:41:43', 1, 0, 0, 0),
(111, 0, '     hi', '', 9, 'admin', '2019-05-09 23:39:25', 1, 0, 0, 0),
(112, 111, '     you', '', 9, 'admin', '2019-05-09 23:39:36', 1, 0, 0, 0),
(113, 0, '     hello world;', '', 9, 'admin', '2019-05-09 23:40:06', 1, 0, 0, 1),
(114, 0, '     hello world', '', 9, 'admin', '2019-05-09 23:40:16', 1, 0, 0, 0),
(115, 0, '', './upload/470.jpg', 9, 'admin', '2019-05-09 23:42:24', 1, 0, 0, 0),
(116, 0, '', 'upload/url322.png', 9, 'admin', '2019-05-10 02:53:58', 1, 7, 0, 0),
(117, 0, '     showing you', '', 1, '@doc', '2019-05-11 21:17:26', 5, 0, 0, 0),
(118, 0, '     showing you', '', 1, '@doc', '2019-05-11 21:18:18', 5, 0, 0, 1),
(119, 0, '', 'upload/url650.jpg', 1, '@doc', '2019-05-11 21:20:20', 5, 0, 0, 0),
(120, 0, '', './upload/881.jpg', 1, '@doc', '2019-05-11 21:21:00', 5, 0, 0, 0),
(121, 0, '     what does <!-- mean', '', 1, '@doc', '2019-05-30 17:35:25', 5, 0, 0, 0),
(122, 0, '     what does <!-- mean', '', 1, '@doc', '2019-05-30 17:40:47', 5, 0, 0, 0),
(123, 0, '     what does <!-- do ', '', 1, '@doc', '2019-05-30 17:46:00', 5, 0, 0, 0),
(124, 0, '     What does <!-- do', '', 1, '@doc', '2019-05-30 17:47:25', 5, 0, 0, 0),
(125, 0, '     what does <!-- do', '', 1, '@doc', '2019-05-30 17:54:57', 1, 0, 0, 1),
(126, 0, '     <?php\r\n\r\n$connect = mysqli_connect(\"localhost\", \"root\", \"\") or die(\"Could not connect to server!\");\r\nmysqli_select_db($connect, \"php_forum\") or die(\"Could not connect to database!\");\r\n\r\n?>', '', 9, 'admin', '2019-05-31 17:53:36', 1, 0, 0, 1),
(127, 0, '     <!DOCTYPE HTML>\r\n<html>\r\n    <head>\r\n        <title>Register</title>\r\n    </head>\r\n    <body>\r\n        <form action=\"register.php\" method=\"POST\">\r\n            Username: <input type=\"text\" name=\"username\">\r\n            <br/>\r\n            Password: <input type=\"password\" name=\"password\">\r\n            <br/>\r\n            Confirm Password: <input type=\"password\" name=\"confirmPassword\">\r\n            <br/>\r\n            Email: <input type=\"text\" name=\"email\">\r\n            <br/>\r\n            <input type=\"submit\" name=\"submit\" value=\"Register\"> or <a href=\"login.php\">Log in</a>\r\n        </form>\r\n    </body>\r\n</html>', '', 9, 'admin', '2019-05-31 18:06:25', 1, 0, 0, 1),
(128, 0, '     Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. ', '', 9, 'admin', '2019-05-31 18:07:28', 1, 0, 0, 0),
(129, 0, '', './upload/125.txt', 1, '@doc', '2019-06-05 16:06:51', 6, 0, 0, 0),
(130, 0, '', './upload/745.txt', 1, '@doc', '2019-06-05 16:56:48', 6, 0, 0, 0),
(131, 0, '', './upload/226.png', 1, '@doc', '2019-06-05 16:57:04', 6, 0, 0, 0),
(132, 0, '', './upload/290.jpg', 1, '@doc', '2019-06-05 16:57:43', 6, 0, 0, 0),
(133, 0, '', './upload/429.jpg', 1, '@doc', '2019-06-05 16:59:20', 6, 0, 0, 0),
(134, 0, '', './upload/576.txt', 1, '@doc', '2019-06-05 16:59:36', 6, 0, 0, 0),
(135, 0, 'hi', '', 1, '@doc', '2019-06-13 21:26:37', 6, 0, 0, 0),
(136, 0, '/fire', '', 1, '@doc', '2019-06-13 21:27:56', 6, 0, 0, 0),
(137, 0, '/who', '', 1, '@doc', '2019-06-14 14:22:37', 6, 0, 0, 0),
(138, 0, '/who', '', 1, '@doc', '2019-06-14 14:26:52', 6, 0, 0, 0),
(139, 0, 'who', '', 1, '@doc', '2019-06-14 14:46:36', 6, 0, 0, 0),
(140, 0, '/msg @dan', '', 1, '@doc', '2019-06-14 14:54:45', 6, 0, 0, 0),
(141, 0, '/archive', '', 1, '@doc', '2019-06-14 15:21:07', 6, 0, 0, 0),
(142, 0, 'archive', '', 1, '@doc', '2019-06-14 15:21:26', 6, 0, 0, 0),
(143, 0, '/invite @fireman', '', 1, '@doc', '2019-06-14 15:52:10', 6, 0, 0, 0),
(144, 0, '/invite fireman', '', 1, '@doc', '2019-06-14 15:53:11', 6, 0, 0, 0),
(145, 0, '/invite @sally', '', 1, '@doc', '2019-06-14 17:35:21', 6, 0, 0, 0),
(146, 0, '/invite fireman', '', 1, '@doc', '2019-06-14 17:40:31', 6, 0, 0, 0),
(147, 0, '/who', '', 2, '@mcmissile', '2019-06-14 17:54:03', 13, 0, 0, 0),
(148, 0, '/invite @sally', '', 2, '@mcmissile', '2019-06-14 17:54:20', 13, 0, 0, 0),
(149, 0, '/invite @sally', '', 2, '@mcmissile', '2019-06-14 17:56:27', 13, 0, 0, 0),
(150, 0, '/msg fireman', '', 4, '@sally', '2019-06-14 18:23:40', 6, 0, 0, 0);

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
(10, 'Justin', 'Bee', '@justin', 'jfbrunel@odu.edu', 'justin'),
(11, 'Don', 'Letssee', '@dtesty', 'justaemail@email.com', 'testman'),
(12, 'Mister', 'Fire', 'fireman', 'fireman@fire.com', 'fireman');

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `up` int(11) NOT NULL,
  `down` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`id`, `userid`, `commentid`, `up`, `down`) VALUES
(1, 6, 400, 0, 0),
(2, 9, 38, 0, 0),
(3, 9, 44, 0, 0),
(4, 9, 116, 0, 0),
(5, 9, 44, 0, 0),
(6, 9, 116, 0, 0),
(7, 9, 116, 0, 0),
(8, 9, 116, 0, 0),
(9, 9, 116, 0, 0),
(10, 9, 116, 0, 0),
(11, 9, 116, 0, 0),
(12, 9, 71, 0, 0),
(13, 1, 97, -1, 2),
(14, 1, 75, 2, -1),
(15, 1, 100, 0, 1),
(16, 9, 100, 0, 0);

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
  MODIFY `grpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `messageroom`
--
ALTER TABLE `messageroom`
  MODIFY `commentID` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `picid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
