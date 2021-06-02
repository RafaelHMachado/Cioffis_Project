-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2019 at 06:13 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cioffis`
--
--CREATE DATABASE IF NOT EXISTS `cioffis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `id11172360_cioffis`;

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `AreaID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(50) NOT NULL,
  PRIMARY KEY (`AreaID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`AreaID`, `Description`) VALUES
(1, 'North Shore'),
(2, 'South Burnaby/New West'),
(3, 'Coal Harbour');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `CityID` int(11) NOT NULL AUTO_INCREMENT,
  `City` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL,
  PRIMARY KEY (`CityID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityID`, `City`, `Province`) VALUES
(1, 'North Vancouver', 'BC'),
(2, 'West Vancouver', 'BC'),
(3, 'Burnaby', 'BC');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountNumber` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `SalesRepID` int(10) NOT NULL,
  `CityID` int(10) NOT NULL,
  `AreaID` int(10) NOT NULL,
  `InstructionID` int(10) NOT NULL,
  `ReceivingTimeID` int(10) NOT NULL,
  `ExtraInfoID` int(10) NOT NULL,
  PRIMARY KEY (`CustomerID`),
  KEY `SalesRepID` (`SalesRepID`),
  KEY `CityID` (`CityID`),
  KEY `AreaID` (`AreaID`),
  KEY `InstructionID` (`InstructionID`),
  KEY `ReceivingTimeID` (`ReceivingTimeID`),
  KEY `ExtraInfoID` (`ExtraInfoID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `AccountNumber`, `Name`, `SalesRepID`, `CityID`, `AreaID`, `InstructionID`, `ReceivingTimeID`, `ExtraInfoID`) VALUES
(1, 1175, 'FALESCA IMPORTING', 1, 1, 1, 1, 1, 1),
(2, 1932, 'CAPILANO GOLF & COUNTRY CLUB', 2, 2, 1, 2, 3, 1),
(3, 1302, 'HART HOUSE', 3, 3, 2, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EmpID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `User` varchar(50) NOT NULL,
  `Pass` varchar(250) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Active` int(1) NOT NULL,
  PRIMARY KEY (`EmpID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `Name`, `Phone`, `Email`, `User`, `Pass`, `Position`, `Active`) VALUES
(1, 'Rafael Machado', '(778) 251-1089', 'rafael_henriquemachado@hotmail.com', 'RafaMachado', '$2y$10$t6w8kiVBNRb6R4reeWOuauGxBMElMXSVTE4RKq3s2yLk9.1z4QQaS', 'Web Developer', 1),
(2, 'Pamela Toledo', '(xxx) xxx-xxxx', 'manager@cioffisgroup.com', 'PamToledo', '$2y$10$8lJ2pSkx3MhOK.NpKTCWb.fnwXh9cNckbeyvRYYdj2noIK9FgemWC', 'Manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `extrainfo`
--

DROP TABLE IF EXISTS `extrainfo`;
CREATE TABLE IF NOT EXISTS `extrainfo` (
  `ExtraInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Phone` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Title` varchar(250) NOT NULL,
  PRIMARY KEY (`ExtraInfoID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extrainfo`
--

INSERT INTO `extrainfo` (`ExtraInfoID`, `Name`, `Phone`, `Email`, `Title`) VALUES
(1, 'NAME_HERE', '(xxx)xxx-xxxx', 'email@email.com', 'TITLE_HERE');

-- --------------------------------------------------------

--
-- Table structure for table `instruction`
--

DROP TABLE IF EXISTS `instruction`;
CREATE TABLE IF NOT EXISTS `instruction` (
  `InstructionID` int(11) NOT NULL AUTO_INCREMENT,
  `Timing` varchar(250) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Special` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`InstructionID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instruction`
--

INSERT INTO `instruction` (`InstructionID`, `Timing`, `Description`, `Special`) VALUES
(1, '', 'Back Door', ''),
(2, '', 'Side Door', ''),
(3, 'Tuesday Early; Other days midday', 'Side door, left of main door', 'Closed monday');

-- --------------------------------------------------------

--
-- Table structure for table `receivingtime`
--

DROP TABLE IF EXISTS `receivingtime`;
CREATE TABLE IF NOT EXISTS `receivingtime` (
  `ReceivingTimeID` int(11) NOT NULL AUTO_INCREMENT,
  `Early` varchar(10) NOT NULL,
  `Mid` varchar(10) NOT NULL,
  `Afternoon` varchar(10) NOT NULL,
  PRIMARY KEY (`ReceivingTimeID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receivingtime`
--

INSERT INTO `receivingtime` (`ReceivingTimeID`, `Early`, `Mid`, `Afternoon`) VALUES
(1, 'EARLY', 'N/A', 'PM'),
(2, 'EARLY', 'MID', 'PM'),
(3, 'EARLY', 'MID', 'N/A'),
(4, 'EARLY', 'N/A', 'N/A'),
(5, 'N/A', 'MID', 'N/A'),
(6, 'N/A', 'MID', 'PM'),
(7, 'N/A', 'N/A', 'PM');

-- --------------------------------------------------------

--
-- Table structure for table `salesrep`
--

DROP TABLE IF EXISTS `salesrep`;
CREATE TABLE IF NOT EXISTS `salesrep` (
  `SalesRepID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` char(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`SalesRepID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesrep`
--

INSERT INTO `salesrep` (`SalesRepID`, `Name`, `Phone`, `Email`) VALUES
(1, 'Sales1', '(xxx)xxx-xxxx', 'sales1@cioffisgroup.com'),
(2, 'Sales2', '(xxx)xxx-xxxx', 'sales2@cioffisgroup.com'),
(3, 'Sales3', '(xxx)xxx-xxxx', 'sales3@cioffisgroup.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
