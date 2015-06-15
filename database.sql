-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2015 at 04:13 PM
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
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `id` int(5) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=508 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `firstname`, `lastname`) VALUES
(502, 'bryce', 'matheson'),
(503, 'test', 'name'),
(504, 'last', 'name'),
(505, 'craig', 'pulley'),
(506, 'matt', 'jones'),
(507, 'john', 'smith');

-- --------------------------------------------------------

--
-- Table structure for table `time_entries`
--

CREATE TABLE IF NOT EXISTS `time_entries` (
  `id` int(12) NOT NULL,
  `user_id` int(6) NOT NULL,
  `date` int(32) NOT NULL,
  `hoursWorked` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `address`, `city`, `state`, `zip`, `country`, `currentSupervisor`, `company`, `department`, `phone`, `lastLogin`, `activated`, `canReactivate`, `isAdmin`) VALUES
(8, 'matheson', 'Bryce', 'Matheson', '29a41d68fee2587e66df81fd4e40a2a4', 'brycematheson@gmail.com', '1838 W 7225 S', 'West Jordan', 'UT', 84084, 'United States', 'Craig Pulley', 'Intermountain Healthcare', 'Information Technologies (IT)', '', '1434061995', 1, 0, 1),
(15, 'test', 'Testey', 'Test', '098f6bcd4621d373cade4e832627b4f6', 'testsd', '', '', '', 11223, '', 'Craig Pulley', 'Intermountain', 'IT', '801-442-6502', '1434037950', 1, 0, 0),
(30, 'jack', 'Jack', 'Daniels', 'cc03e747a6afbbcbf8be7668acfebee5', 'jackdaniels@test.com', '', '', '', 0, '', 'Last Name', '', 'IT', '123', '1434053223', 1, 0, 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=508;
--
-- AUTO_INCREMENT for table `time_entries`
--
ALTER TABLE `time_entries`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
