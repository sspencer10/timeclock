-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2015 at 01:22 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=690 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `firstname`, `lastname`) VALUES
(640, 'Palmer', 'Capasso'),
(641, 'Rosamaria', 'Guilford'),
(642, 'Mabelle', 'Casias'),
(643, 'Gigi', 'Mouser'),
(644, 'Wilhelmina', 'Taber'),
(645, 'Henrietta', 'June'),
(646, 'Sherlene', 'Faye'),
(647, 'Tam', 'Paoletti'),
(648, 'Kraig', 'Santillanes'),
(649, 'Jacelyn', 'Traina'),
(650, 'Augustus', 'Minear'),
(651, 'Nadene', 'Farago'),
(652, 'Michal', 'Eatman'),
(653, 'Hollis', 'Seman'),
(654, 'Rena', 'Brannum'),
(655, 'Luanne', 'Milford'),
(656, 'Manual', 'Oros'),
(657, 'Roscoe', 'Dimaio'),
(658, 'Meaghan', 'Fogel'),
(659, 'Rachel', 'Doris'),
(660, 'Elidia', 'Beaman'),
(661, 'Sharla', 'Nally'),
(662, 'Saul', 'Yeung'),
(663, 'Pablo', 'Kite'),
(664, 'Serena', 'Guajardo'),
(665, 'Na', 'Abdalla'),
(666, 'Junita', 'Hoyt'),
(667, 'Jeannine', 'Mcclard'),
(668, 'Tynisha', 'Stegman'),
(669, 'Bernard', 'Petree'),
(670, 'Bronwyn', 'Eastburn'),
(671, 'Kati', 'Corning'),
(672, 'Adriana', 'Polin'),
(673, 'Danille', 'Hertlein'),
(674, 'Dara', 'Montaluo'),
(675, 'Fae', 'Petry'),
(676, 'Claretta', 'Buteau'),
(677, 'Mallory', 'Dark'),
(678, 'Norris', 'Budd'),
(679, 'Michael', 'Lovingood'),
(680, 'Lenita', 'Wolfson'),
(681, 'Ailene', 'Reina'),
(682, 'Deja', 'Mason'),
(683, 'Huong', 'Hoskin'),
(684, 'Song', 'Tarkington'),
(685, 'Collette', 'Nitz'),
(686, 'Tamala', 'Lazard'),
(687, 'Sherise', 'Cissell'),
(688, 'Jaimee', 'Ryland'),
(689, 'Roselee', 'Salazar');

-- --------------------------------------------------------

--
-- Table structure for table `time_entries`
--

CREATE TABLE IF NOT EXISTS `time_entries` (
  `id` int(12) NOT NULL,
  `user_id` int(6) NOT NULL,
  `timeIn` int(16) NOT NULL,
  `timeOut` int(16) NOT NULL,
  `comments` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_entries`
--

INSERT INTO `time_entries` (`id`, `user_id`, `timeIn`, `timeOut`, `comments`) VALUES
(90, 8, 1435255980, 1435266780, 'Quick test comment here. I\\''m liking the way this is beginning to turn out!'),
(91, 8, 1435263180, 1435274520, ''),
(92, 8, 1435256760, 1435260360, ''),
(93, 8, 1435258020, 1435258080, ''),
(94, 8, 1435258257, 1435258437, ''),
(95, 30, 1434048960, 1434066960, ''),
(96, 30, 1435258639, 1435258664, ''),
(97, 8, 1435258693, 1435258699, ''),
(98, 8, 1435258774, 1435258790, ''),
(99, 8, 1435258850, 1435259001, ''),
(100, 8, 1080253249, 1080256249, ''),
(101, 8, 1435270860, 1435285260, '');

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
  `payRate` varchar(6) NOT NULL,
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

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `address`, `city`, `state`, `zip`, `country`, `currentSupervisor`, `payRate`, `company`, `department`, `phone`, `lastLogin`, `activated`, `canReactivate`, `isAdmin`) VALUES
(8, 'matheson', 'Bryce', 'Matheson', '29a41d68fee2587e66df81fd4e40a2a4', 'brycematheson@gmail.com', '1838 W 7225 S', 'West Jordan', 'UT', 84084, 'United States', 'Kraig Santillanes', '25.23', 'Intermountain Healthcare', 'Information Technologies', '123-456-7890', '1435271607', 1, 0, 1),
(15, 'test', 'Testey', 'Test', '098f6bcd4621d373cade4e832627b4f6', 'testsd', '', '', '', 11223, '', 'Palmer Capasso', '0.00', 'Intermountain', 'Information Technologies', '801-442-6502', '1435079726', 1, 0, 0),
(30, 'jack', 'Jack', 'Daniels', 'cc03e747a6afbbcbf8be7668acfebee5', 'jackdaniels@test.com', '7232 Nowhere Lane', 'Richland', 'WA', 99352, 'USA', 'Sherise Cissell', '14.00', '', 'Accounting', '123', '1435271555', 1, 0, 0),
(31, 'testaccount', 'Test', 'Test', '0efffc51d5e228e69bec75545457b977', 'thisisatest@test.com', '', '', '', 0, '', 'Danille Hertlein', '0.00', '', 'Human Resources', '', '', 0, 1, 0);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=690;
--
-- AUTO_INCREMENT for table `time_entries`
--
ALTER TABLE `time_entries`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
