-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2015 at 04:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvc_thuan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employeetype`
--

CREATE TABLE IF NOT EXISTS `tbl_employeetype` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_employeetype`
--

INSERT INTO `tbl_employeetype` (`id`, `name`) VALUES
(1, 'Normal Employee'),
(2, 'Hourly Employee'),
(3, 'Sale Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id` int(11) NOT NULL,
  `employeetype_id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `isaccountant` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `employeetype_id`, `username`, `password`, `lastname`, `firstname`, `name`, `phone`, `email`, `address`, `isaccountant`) VALUES
(1, 1, 'hieu', 'afc8e16842061ea3dbb023bf5f08d1bc3a728429313fab0cba30f60954ff9064', 'Hieu', 'Nguyen', '', '', '', '', 1),
(2, 1, 'long', 'fc66f021c67d064c1490a12b5a4d4d2f5167ca692a16ca12f1', 'Long', 'Tran', '', '', '', '', 0),
(3, 2, 'hung', 'c4410f72e4467dfe7d9cd78edbb2f5786bdccaa54a6010782b', 'Hung', 'Nguyen', '', '', '', '', 0),
(4, 3, 'lan', '094a367b026246fb64649c4f868a45d8187821d16a97314143', 'Lan', 'Pham', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_weeklysalary`
--

CREATE TABLE IF NOT EXISTS `tbl_weeklysalary` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `worked_hour` int(11) DEFAULT NULL,
  `gross_sale` int(11) DEFAULT NULL,
  `commission_rate` float DEFAULT NULL,
  `gross_salary` int(11) NOT NULL,
  `net_salary` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_weeklysalary`
--

INSERT INTO `tbl_weeklysalary` (`id`, `user_id`, `basic_salary`, `worked_hour`, `gross_sale`, `commission_rate`, `gross_salary`, `net_salary`, `created_date`, `comment`) VALUES
(1, 1, 200, NULL, NULL, NULL, 200, 180, '2015-01-22 09:08:15', 'Gross < 2000 and BeforeTax < 5000'),
(2, 1, 3000, NULL, NULL, NULL, 3000, 2664, '2015-01-22 09:09:26', '2000 <= Gross < 6000 and BeforeTax < 5000'),
(3, 1, 7000, NULL, NULL, NULL, 7000, 5827, '2015-01-22 09:10:48', '6000 <= Gross < 10000 and 5000 <= BeforeTax < 10000'),
(4, 1, 12000, NULL, NULL, NULL, 12000, 10200, '2015-01-22 09:19:23', 'Gross >= 10000 and 10000 <= BeforeTax < 20000'),
(5, 1, 21000, NULL, NULL, NULL, 21000, 21000, '2015-01-22 09:20:21', 'Gross >= 10000 and BeforeTax >= 20000'),
(6, 4, 150, NULL, 5000, 0.05, 400, 361, '2015-01-22 09:32:19', 'Gross < 2000 and BeforeTax < 5000'),
(7, 4, 2000, NULL, 10000, 0.05, 2500, 2220, '2015-01-22 09:37:13', '2000 <= Gross < 6000 and BeforeTax < 5000'),
(8, 4, 6000, NULL, 5000, 0.05, 6250, 5202, '2015-01-22 09:41:19', '6000 <= Gross < 10000 and BeforeTax < 5000'),
(9, 4, 7000, NULL, 5000, 0.05, 7250, 6035, '2015-01-22 09:42:53', '6000 <= Gross < 10000 and 5000 <= BeforeTax < 10000'),
(10, 4, 11000, NULL, 5000, 0.05, 11250, 9562, '2015-01-22 09:43:33', 'Gross >= 10000 and 5000 <= BeforeTax < 10000'),
(11, 4, 14000, NULL, 5000, 0.05, 14250, 12112, '2015-01-22 09:44:24', 'Gross >= 10000 and 10000 <= BeforeTax < 20000'),
(12, 4, 25000, NULL, 5000, 0.05, 25250, 25250, '2015-01-22 09:44:54', 'Gross >= 10000 and BeforeTax >= 20000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employeetype`
--
ALTER TABLE `tbl_employeetype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_weeklysalary`
--
ALTER TABLE `tbl_weeklysalary`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_employeetype`
--
ALTER TABLE `tbl_employeetype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_weeklysalary`
--
ALTER TABLE `tbl_weeklysalary`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
