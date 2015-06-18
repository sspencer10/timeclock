-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2015 at 12:10 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `loginregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` text NOT NULL,
  `id_post` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `id_post`, `date`) VALUES
(1, 'Test', 'test@test.com', 'test', 1, '2015-06-15 20:49:31'),
(2, 'Janine', 'janine@janine.com', 'Another comment.', 1, '2015-06-15 20:58:10'),
(3, 'sd', '', 'sd', 1, '2015-06-15 21:05:16'),
(4, 'sef', '', 'sef', 1, '2015-06-15 21:05:35'),
(5, 'test', '', 'test', 1, '2015-06-15 21:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `id` int(5) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=640 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `firstname`, `lastname`) VALUES
(590, 'Palmer', 'Capasso'),
(591, 'Rosamaria', 'Guilford'),
(592, 'Mabelle', 'Casias'),
(593, 'Gigi', 'Mouser'),
(594, 'Wilhelmina', 'Taber'),
(595, 'Henrietta', 'June'),
(596, 'Sherlene', 'Faye'),
(597, 'Tam', 'Paoletti'),
(598, 'Kraig', 'Santillanes'),
(599, 'Jacelyn', 'Traina'),
(600, 'Augustus', 'Minear'),
(601, 'Nadene', 'Farago'),
(602, 'Michal', 'Eatman'),
(603, 'Hollis', 'Seman'),
(604, 'Rena', 'Brannum'),
(605, 'Luanne', 'Milford'),
(606, 'Manual', 'Oros'),
(607, 'Roscoe', 'Dimaio'),
(608, 'Meaghan', 'Fogel'),
(609, 'Rachel', 'Doris'),
(610, 'Elidia', 'Beaman'),
(611, 'Sharla', 'Nally'),
(612, 'Saul', 'Yeung'),
(613, 'Pablo', 'Kite'),
(614, 'Serena', 'Guajardo'),
(616, 'Junita', 'Hoyt'),
(617, 'Jeannine', 'Mcclard'),
(618, 'Tynisha', 'Stegman'),
(619, 'Bernard', 'Petree'),
(620, 'Bronwyn', 'Eastburn'),
(622, 'Adriana', 'Polin'),
(623, 'Danille', 'Hertlein'),
(624, 'Dara', 'Montaluo'),
(625, 'Fae', 'Petry'),
(626, 'Claretta', 'Buteau'),
(627, 'Mallory', 'Dark'),
(628, 'Norris', 'Budd'),
(629, 'Michael', 'Lovingood'),
(630, 'Lenita', 'Wolfson'),
(631, 'Ailene', 'Reina'),
(632, 'Deja', 'Mason'),
(633, 'Huong', 'Hoskin'),
(634, 'Song', 'Tarkington'),
(635, 'Collette', 'Nitz'),
(636, 'Tamala', 'Lazard'),
(637, 'Sherise', 'Cissell'),
(638, 'Jaimee', 'Ryland'),
(639, 'Roselee', 'Salazar');

-- --------------------------------------------------------

--
-- Table structure for table `time_entries`
--

CREATE TABLE IF NOT EXISTS `time_entries` (
  `id` int(12) NOT NULL,
  `user_id` int(6) NOT NULL,
  `timeIn` int(16) NOT NULL,
  `timeOut` int(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_entries`
--

INSERT INTO `time_entries` (`id`, `user_id`, `timeIn`, `timeOut`) VALUES
(48, 8, 1434653180, 1434653186),
(49, 8, 1434657982, 1434657985),
(52, 8, 1434657993, 1434657994),
(53, 8, 1434657998, 1434658467),
(54, 8, 1434658765, 1434658771),
(55, 8, 1434658777, 1434658779),
(56, 8, 1434658779, 1434658781),
(57, 8, 1434659259, 1434659261),
(58, 8, 1434659265, 1434659270),
(59, 8, 1434659434, 1434659966),
(60, 8, 1434659969, 1434660169),
(61, 8, 1434660233, 1434660244),
(62, 8, 1434661137, 1434662461);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(7) NOT NULL,
  `username` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(5) NOT NULL,
  `country` varchar(32) NOT NULL,
  `currentSupervisor` varchar(64) NOT NULL,
  `company` varchar(32) NOT NULL,
  `department` varchar(32) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `lastLogin` varchar(32) NOT NULL,
  `activated` int(1) NOT NULL,
  `canReactivate` int(1) NOT NULL DEFAULT '1',
  `isAdmin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `address`, `city`, `state`, `zip`, `country`, `currentSupervisor`, `company`, `department`, `phone`, `lastLogin`, `activated`, `canReactivate`, `isAdmin`) VALUES
(8, 'matheson', 'Bryce', 'Matheson', '29a41d68fee2587e66df81fd4e40a2a4', 'brycematheson@gmail.com', '1838 W 7225 S', 'West Jordan', 'UT', 84084, 'United States', 'Adriana Polin', 'Intermountain Healthcare', 'Information Technologies', '123-456-7890', '1434657674', 1, 0, 1),
(15, 'test', 'Testey', 'Test', '098f6bcd4621d373cade4e832627b4f6', 'testsd', '', '', '', 11223, '', 'Jacelyn Traina', 'Intermountain', 'IT', '801-442-6502', '1434037950', 1, 0, 0),
(30, 'jack', 'Jack', 'Daniels', 'cc03e747a6afbbcbf8be7668acfebee5', 'jackdaniels@test.com', '', '', '', 0, '', 'Michael Lovingood', '', 'IT', '123', '1434578550', 1, 0, 0),
(31, 'testaccount', 'Test', 'Test', '0efffc51d5e228e69bec75545457b977', 'thisisatest@test.com', '', '', '', 0, '', 'Jacelyn Traina', '', '', '', '', 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_entries`
--
ALTER TABLE `time_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=640;
--
-- AUTO_INCREMENT for table `time_entries`
--
ALTER TABLE `time_entries`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
