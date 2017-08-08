-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2013 at 10:34 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cpr_opentok`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE IF NOT EXISTS `tbl_appointment` (
  `appointmentId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Appointment auto incriment id',
  `appointmentToken` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT 'Appointed User id',
  `doctorId` bigint(20) NOT NULL COMMENT 'Appointment for Doctor',
  `title` varchar(255) NOT NULL COMMENT 'Appointment Title',
  `description` text NOT NULL COMMENT 'Appointment Description',
  `fee` double NOT NULL,
  `appointmentDate` bigint(20) NOT NULL COMMENT 'Appointment Added Date',
  `startTime` bigint(20) NOT NULL COMMENT 'Appointment Start Time',
  `endTime` bigint(20) NOT NULL COMMENT 'Appointment End Time',
  `staffId` bigint(20) NOT NULL COMMENT 'Appointment Added By Staff',
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Active, 2=Time Over, 3=Complete',
  `patientStatus` set('1','0') NOT NULL DEFAULT '0' COMMENT '1= present, 0 - not present',
  `userLogged` int(11) NOT NULL COMMENT '1 = logged in , 0 = not logged',
  `userSessionString` varchar(250) NOT NULL,
  `isAdminConnected` int(11) NOT NULL,
  PRIMARY KEY (`appointmentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`appointmentId`, `appointmentToken`, `username`, `doctorId`, `title`, `description`, `fee`, `appointmentDate`, `startTime`, `endTime`, `staffId`, `status`, `patientStatus`, `userLogged`, `userSessionString`, `isAdminConnected`) VALUES
(49, '5383610', 'A', 1, '', '', 12, 1370350500, 0, 0, 0, '0', '0', 0, '', 0),
(50, '5260120', 'A', 1, '', '', 12, 1370350740, 0, 0, 0, '0', '0', 0, '', 0),
(51, '1835020', 'Admin', 1, '', '', 12321, 1370364960, 0, 0, 0, '0', '0', 0, '', 0),
(52, '6067160', 'classified', 1, '', '', 123, 1370424600, 0, 0, 0, '1', '0', 0, ' ', 0),
(53, '1448520', 'A', 1, '', '', 1, 1370524620, 0, 0, 0, '0', '0', 0, '', 0),
(54, '5181030', 'A', 1, '', '', 1, 1370429940, 0, 0, 0, '0', '0', 0, '', 0),
(55, '6071860', 'A', 1, '', '', 12, 1370430000, 0, 0, 0, '0', '0', 0, '', 0),
(56, '3273400', 'A', 1, '', '', 1, 1370430240, 0, 0, 0, '0', '0', 0, '', 0),
(57, '4913400', 'A', 1, '', '', 1, 1370433540, 0, 0, 0, '1', '0', 0, ' ', 0),
(58, '6370690', 'A', 1, '', '', 1, 1370436540, 0, 0, 0, '0', '0', 0, '', 0),
(59, '3763010', 'admin', 1, '', '', 35, 1371715380, 0, 0, 0, '1', '1', 1, '2875b27bbaa1c889e21a284a7d7d8f10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor`
--

CREATE TABLE IF NOT EXISTS `tbl_doctor` (
  `doctorId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Doctor Auto incriment id',
  `username` varchar(255) NOT NULL COMMENT 'Doctor login username',
  `password` varchar(255) NOT NULL COMMENT 'Doctor login password',
  `doctorName` varchar(255) NOT NULL COMMENT 'Doctor Full Name',
  `address` text NOT NULL COMMENT 'Doctor Address',
  `designation` varchar(500) NOT NULL COMMENT 'Doctor designation',
  `addedDate` datetime NOT NULL COMMENT 'Doctor added date',
  `isActive` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active, 2=Block',
  PRIMARY KEY (`doctorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_doctor`
--

INSERT INTO `tbl_doctor` (`doctorId`, `username`, `password`, `doctorName`, `address`, `designation`, `addedDate`, `isActive`) VALUES
(1, 'mdoctor', '62d476e6efaec7d50ebe9d0e16f0a811', 'Md Doctor', 'Doctor', 'mdoctor', '2013-05-20 03:08:58', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opentok_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_opentok_settings` (
  `apiKey` varchar(255) NOT NULL,
  `sessionId` mediumtext NOT NULL,
  `token` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_opentok_settings`
--

INSERT INTO `tbl_opentok_settings` (`apiKey`, `sessionId`, `token`) VALUES
('29025882', '2_MX4yOTAyNTg4Mn4xMjcuMC4wLjF-U3VuIEp1biAxNiAwMDo1MjowNiBQRFQgMjAxM34wLjQ1NjgwODV-', 'T1==cGFydG5lcl9pZD0yOTAyNTg4MiZzZGtfdmVyc2lvbj10YnJ1YnktdGJyYi12MC45MS4yMDExLTAyLTE3JnNpZz1iNjRkNzc4OTUxMjQwNzdiZDA5MTk1OGZjZmJjYTY4MTJkNjNjNGE4OnJvbGU9cHVibGlzaGVyJnNlc3Npb25faWQ9Ml9NWDR5T1RBeU5UZzRNbjR4TWpjdU1DNHdMakYtVTNWdUlFcDFiaUF4TmlBd01EbzFNam93TmlCUVJGUWdNakF4TTM0d0xqUTFOamd3T0RWLSZjcmVhdGVfdGltZT0xMzcxMzY5MTM0Jm5vbmNlPTAuNzIyNjQ0NDAyNjk0MDA1NSZleHBpcmVfdGltZT0xMzcxNDU1NTMzJmNvbm5lY3Rpb25fZGF0YT0=');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `timezone` varchar(200) NOT NULL DEFAULT 'UTC'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`timezone`) VALUES
('Asia/Amman');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `staffId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Staff Auto Incriment Id',
  `username` varchar(255) NOT NULL COMMENT 'Staff login user name',
  `password` varchar(255) NOT NULL COMMENT 'Staff login password',
  `staffName` varchar(255) NOT NULL COMMENT 'Staff Full Name',
  `isActive` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`staffId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staffId`, `username`, `password`, `staffName`, `isActive`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'Test Staff', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `userId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'User Auto Incriment Id',
  `username` varchar(255) NOT NULL COMMENT 'user login username',
  `password` varchar(255) NOT NULL COMMENT 'user login password',
  `name` varchar(255) NOT NULL COMMENT 'user full name',
  `address` text NOT NULL COMMENT 'user address',
  `addedDate` datetime NOT NULL COMMENT 'user added date',
  `lastAppointmentDate` datetime NOT NULL COMMENT 'user last appointment date',
  `isActive` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `username`, `password`, `name`, `address`, `addedDate`, `lastAppointmentDate`, `isActive`) VALUES
(1, 'test1', '098f6bcd4621d373cade4e832627b4f6', 'Mr. Test', 'mdoctor', '2013-05-20 03:10:07', '0000-00-00 00:00:00', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
