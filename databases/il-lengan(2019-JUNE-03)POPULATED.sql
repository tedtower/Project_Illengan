-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2019 at 05:05 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `il-lengan`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `aID` int(11) NOT NULL AUTO_INCREMENT,
  `aType` enum('admin','barista','chef','customer') NOT NULL,
  `aUsername` varchar(25) NOT NULL,
  `aPassword` char(64) NOT NULL,
  `aIsOnline` enum('1','0') NOT NULL,
  `aStatus` enum('active','inactive','archived') NOT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`aID`, `aType`, `aUsername`, `aPassword`, `aIsOnline`, `aStatus`) VALUES
(1, 'admin', 'manager', 'manager', '0', 'active'),
(2, 'barista', 'barista', 'barista', '0', 'active'),
(3, 'chef', 'chef', 'chef', '0', 'active'),
(4, 'customer', 'customer', 'customer', '0', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

DROP TABLE IF EXISTS `activitylog`;
CREATE TABLE IF NOT EXISTS `activitylog` (
  `alID` int(11) NOT NULL AUTO_INCREMENT,
  `aID` int(11) NOT NULL,
  `alDate` datetime NOT NULL,
  `alDesc` varchar(120) NOT NULL,
  `alType` enum('add','update','archived') NOT NULL,
  `additionalRemarks` longtext,
  PRIMARY KEY (`alID`),
  KEY `activity log aID_idx` (`aID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE IF NOT EXISTS `addons` (
  `aoID` int(11) NOT NULL AUTO_INCREMENT,
  `aoName` varchar(45) NOT NULL,
  `aoCategory` enum('food','drinks') NOT NULL,
  `aoPrice` double NOT NULL,
  `aoStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`aoID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`aoID`, `aoName`, `aoCategory`, `aoPrice`, `aoStatus`) VALUES
(15, 'Milk', 'drinks', 20, 'archived'),
(16, 'Sugar', 'drinks', 20, 'available'),
(17, 'Extra Rice', 'food', 20, 'available'),
(18, 'Extra Shot', 'drinks', 20, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `addonspoil`
--

DROP TABLE IF EXISTS `addonspoil`;
CREATE TABLE IF NOT EXISTS `addonspoil` (
  `aoID` int(11) NOT NULL,
  `aosID` int(11) NOT NULL,
  `aosQty` int(11) NOT NULL,
  `aosDate` date NOT NULL,
  `aosRemarks` longtext,
  PRIMARY KEY (`aoID`,`aosID`),
  KEY `addonspoil aoID_idx` (`aoID`),
  KEY `addons aosID_idx` (`aosID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aospoil`
--

DROP TABLE IF EXISTS `aospoil`;
CREATE TABLE IF NOT EXISTS `aospoil` (
  `aosID` int(11) NOT NULL AUTO_INCREMENT,
  `aosDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`aosID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aospoil`
--

INSERT INTO `aospoil` (`aosID`, `aosDateRecorded`) VALUES
(1, '2019-04-29 10:00:00'),
(2, '2019-04-29 16:17:00'),
(3, '2019-04-30 00:00:00'),
(4, '2019-04-30 00:00:00'),
(5, '2019-05-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ctID` int(11) NOT NULL AUTO_INCREMENT,
  `supcatID` int(11) DEFAULT NULL,
  `ctName` varchar(45) NOT NULL,
  `ctType` enum('menu','inventory') NOT NULL,
  PRIMARY KEY (`ctID`),
  KEY `super category_idx` (`supcatID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ctID`, `supcatID`, `ctName`, `ctType`) VALUES
(1, NULL, 'Meals', 'menu'),
(2, NULL, 'Drinks', 'menu'),
(3, NULL, 'Desserts', 'menu'),
(4, 1, 'Pasta', 'menu'),
(5, 1, 'Ala Carte', 'menu'),
(6, 1, 'Combo (w/ Rice, Buttered Veggie & Egg)', 'menu'),
(7, 1, 'Tamtaman (Samplers)', 'menu'),
(8, 1, 'Gagay-yem (Barkada Meals)', 'menu'),
(9, 2, 'Frappe', 'menu'),
(10, 2, 'Espresso', 'menu'),
(11, 2, 'French-Pressed (Brewed)', 'menu'),
(12, 2, 'Hot and Cold Drinks', 'menu'),
(13, NULL, 'Sauce', 'inventory'),
(14, NULL, 'Syrup', 'inventory'),
(15, NULL, 'Powder', 'inventory'),
(16, NULL, 'Bean', 'inventory'),
(17, NULL, 'Tea', 'inventory'),
(18, NULL, 'Refreshment', 'inventory'),
(19, 18, 'Soda', 'inventory'),
(20, 18, 'Water', 'inventory'),
(21, 18, 'Juice', 'inventory'),
(22, NULL, 'Meat', 'inventory'),
(23, NULL, 'Pasta', 'inventory'),
(24, NULL, 'Condiments', 'inventory'),
(25, NULL, 'Bago', 'menu'),
(26, 25, 'Very Bago', 'menu');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `pmID` int(11) NOT NULL,
  `dcName` varchar(45) NOT NULL,
  PRIMARY KEY (`pmID`),
  KEY `index2` (`pmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`pmID`, `dcName`) VALUES
(1, 'less 20%'),
(3, 'less 20%');

-- --------------------------------------------------------

--
-- Table structure for table `freebies`
--

DROP TABLE IF EXISTS `freebies`;
CREATE TABLE IF NOT EXISTS `freebies` (
  `pmID` int(11) NOT NULL,
  `fbName` varchar(45) NOT NULL,
  `isElective` enum('0','1') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freebies`
--

INSERT INTO `freebies` (`pmID`, `fbName`, `isElective`) VALUES
(2, 'Buy 1 take 1', '0'),
(3, 'Buy 1 take 1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `mID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `mName` varchar(64) NOT NULL,
  `mDesc` varchar(120) DEFAULT NULL,
  `mAvailability` enum('available','unavailable','archived') NOT NULL,
  `mImage` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`mID`),
  KEY `menu ctID_idx` (`ctID`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`mID`, `ctID`, `mName`, `mDesc`, `mAvailability`, `mImage`) VALUES
(4, 8, 'Clubhouse, Fries, Nachos & Onion Rings', NULL, 'available', NULL),
(5, 8, '6pcs. Fried Chicken w/ Mojos', NULL, 'unavailable', NULL),
(6, 8, '3pcs. Fried Chicken & 3pcs. Buffalo Chicken w/ Mojos', NULL, 'available', NULL),
(9, 6, '2pc. Fried Chicken', NULL, 'available', NULL),
(10, 6, '2pc. Buffalo Chicken', NULL, 'available', NULL),
(16, 5, 'Animal Fries', 'fires that is fried to look like animal', 'available', 'Animal.jpg'),
(26, 5, 'Carbonara Pasta', NULL, 'available', NULL),
(42, 9, 'Matcha Frappe', NULL, 'available', 'Matcha.jpg'),
(44, 10, 'Americano', NULL, 'available', 'Coffee.jpg'),
(50, 11, 'Benguet Coffee', NULL, 'available', 'Black.jpg'),
(57, 12, 'Coca Cola', NULL, 'unavailable', 'cocacola.jpg'),
(75, 6, ' new', 'awab', 'available', '273572.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menuaddons`
--

DROP TABLE IF EXISTS `menuaddons`;
CREATE TABLE IF NOT EXISTS `menuaddons` (
  `mID` int(11) NOT NULL,
  `aoID` int(11) NOT NULL,
  PRIMARY KEY (`mID`,`aoID`),
  KEY `menuaddons mID_idx` (`mID`),
  KEY `menuaddons aoID_idx` (`aoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menudiscount`
--

DROP TABLE IF EXISTS `menudiscount`;
CREATE TABLE IF NOT EXISTS `menudiscount` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `dcAmount` double NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menudiscount prID_idx` (`prID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menufreebie`
--

DROP TABLE IF EXISTS `menufreebie`;
CREATE TABLE IF NOT EXISTS `menufreebie` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `fbQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menufreebie prID_idx` (`prID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menuspoil`
--

DROP TABLE IF EXISTS `menuspoil`;
CREATE TABLE IF NOT EXISTS `menuspoil` (
  `msID` int(11) NOT NULL AUTO_INCREMENT,
  `msDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`msID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuspoil`
--

INSERT INTO `menuspoil` (`msID`, `msDateRecorded`) VALUES
(1, '2019-04-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderaddons`
--

DROP TABLE IF EXISTS `orderaddons`;
CREATE TABLE IF NOT EXISTS `orderaddons` (
  `aoID` int(11) NOT NULL,
  `olID` int(11) NOT NULL,
  `aoQty` int(11) NOT NULL,
  `aoTotal` double NOT NULL,
  PRIMARY KEY (`aoID`,`olID`),
  KEY `orderaddons aoID_idx` (`aoID`),
  KEY `orderaddons olID_idx` (`olID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderlists`
--

DROP TABLE IF EXISTS `orderlists`;
CREATE TABLE IF NOT EXISTS `orderlists` (
  `olID` int(11) NOT NULL AUTO_INCREMENT,
  `prID` int(11) NOT NULL,
  `osID` int(11) NOT NULL,
  `olDesc` varchar(120) NOT NULL,
  `olQty` int(11) NOT NULL,
  `olSubtotal` double NOT NULL,
  `olStatus` enum('pending','served') NOT NULL,
  `olRemarks` longtext,
  PRIMARY KEY (`olID`),
  KEY `orderlists prID_idx` (`prID`),
  KEY `orderlists osID_idx` (`osID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderslips`
--

DROP TABLE IF EXISTS `orderslips`;
CREATE TABLE IF NOT EXISTS `orderslips` (
  `osID` int(11) NOT NULL AUTO_INCREMENT,
  `tableCode` varchar(11) NOT NULL,
  `custName` varchar(45) DEFAULT NULL,
  `osTotal` double NOT NULL,
  `payStatus` enum('paid','unpaid') NOT NULL,
  `osDateTime` datetime NOT NULL,
  `osPayDateTime` datetime NOT NULL,
  `osDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`osID`),
  KEY `ordertableCode_idx` (`tableCode`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderslips`
--

INSERT INTO `orderslips` (`osID`, `tableCode`, `custName`, `osTotal`, `payStatus`, `osDateTime`, `osPayDateTime`, `osDateRecorded`) VALUES
(1, 't1', 'Lala', 145, 'paid', '2019-01-14 00:00:00', '2019-01-14 00:00:00', '2019-01-15 00:00:00'),
(2, 't2', 'Roxanne', 200, 'paid', '2019-01-14 00:00:00', '2019-01-14 00:00:00', '2019-01-14 00:00:00'),
(3, 't3', 'Carla', 255, 'paid', '2019-01-18 00:00:00', '2019-01-18 00:00:00', '2019-01-20 00:00:00'),
(4, 't4', 'Carl', 300, 'paid', '2019-02-19 00:00:00', '2019-02-19 00:00:00', '2019-02-19 00:00:00'),
(5, 't5', 'Pedro', 600, 'paid', '2019-03-24 00:00:00', '2019-03-24 00:00:00', '2019-03-25 00:00:00'),
(6, 't6', 'Melissa', 125, 'paid', '2019-03-24 00:00:00', '2019-03-24 00:00:00', '2019-03-24 00:00:00'),
(7, 'v7', 'Marvin', 85, 'paid', '2019-04-01 00:00:00', '2019-04-01 00:00:00', '2019-04-01 00:00:00'),
(8, 'v8', 'Jess', 190, 'paid', '2019-02-09 00:00:00', '2019-02-09 00:00:00', '2019-02-09 00:00:00'),
(9, 'v9', 'Jhen', 160, 'paid', '2019-01-27 00:00:00', '2019-01-27 00:00:00', '2019-01-27 00:00:00'),
(10, 'v10', 'Dodge', 180, 'paid', '2019-02-14 00:00:00', '2019-02-14 00:00:00', '2019-02-14 00:00:00'),
(11, 'v11', 'Tatum', 300, 'paid', '2019-02-01 00:00:00', '2019-02-01 00:00:00', '2019-02-01 00:00:00'),
(12, 'v12', 'Eiffel', 250, 'paid', '2019-01-25 00:00:00', '2019-01-25 00:00:00', '2019-01-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `prID` int(11) NOT NULL AUTO_INCREMENT,
  `mID` int(11) NOT NULL,
  `prName` varchar(64) NOT NULL,
  `mTemp` enum('h','c','hc') DEFAULT NULL,
  `prPrice` double NOT NULL,
  `prStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`prID`),
  KEY `preferences mID_idx` (`mID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promoconstraint`
--

DROP TABLE IF EXISTS `promoconstraint`;
CREATE TABLE IF NOT EXISTS `promoconstraint` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `pcType` enum('f','d','fd') NOT NULL,
  `pcQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `promocons pmID_idx` (`pmID`),
  KEY `promocons mID_idx` (`prID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
  `pmID` int(11) NOT NULL AUTO_INCREMENT,
  `pmName` varchar(64) NOT NULL,
  `pmStartDate` date NOT NULL,
  `pmEndDate` date NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled','archived') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`pmID`, `pmName`, `pmStartDate`, `pmEndDate`, `freebie`, `discount`, `status`) VALUES
(1, 'Graduation Promo', '2019-04-30', '2019-05-01', NULL, 'y', 'enabled'),
(2, 'Valentines Promo', '2019-02-14', '2019-02-15', 'y', NULL, 'disabled'),
(3, 'Christmas Promo', '2019-12-24', '2019-12-25', 'y', 'y', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `spoiledmenu`
--

DROP TABLE IF EXISTS `spoiledmenu`;
CREATE TABLE IF NOT EXISTS `spoiledmenu` (
  `prID` int(11) NOT NULL,
  `msID` int(11) NOT NULL,
  `msQty` int(11) NOT NULL,
  `msDate` date NOT NULL,
  `msRemarks` longtext NOT NULL,
  PRIMARY KEY (`prID`,`msID`),
  KEY `spoiledmenuMsID_idx` (`msID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spoiledstock`
--

DROP TABLE IF EXISTS `spoiledstock`;
CREATE TABLE IF NOT EXISTS `spoiledstock` (
  `ssID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `ssQty` int(11) NOT NULL,
  `ssDate` date NOT NULL,
  `ssRemarks` longtext,
  PRIMARY KEY (`ssID`,`stID`),
  KEY `spoiledmenuSID_idx` (`stID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
CREATE TABLE IF NOT EXISTS `stockitems` (
  `stID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `stName` varchar(64) NOT NULL,
  `stQty` int(11) NOT NULL,
  `stMin` int(11) NOT NULL,
  `stSize` varchar(24) NOT NULL,
  `stLocation` enum('kitchen','stockroom') NOT NULL,
  `stStatus` enum('available','unavailable','archived') NOT NULL,
  `stBqty` int(11) NOT NULL,
  `stType` enum('liquid','solid') NOT NULL,
  PRIMARY KEY (`stID`),
  KEY `stockCategoryID_idx` (`ctID`),
  KEY `stockUomID_idx` (`uomID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`stID`, `ctID`, `uomID`, `stName`, `stQty`, `stMin`, `stSize`, `stLocation`, `stStatus`, `stBqty`, `stType`) VALUES
(1, 13, 3, 'Chocolate Sauce 1000 ml', 10, 5, '0', 'stockroom', 'available', 10, 'liquid'),
(2, 13, 3, 'Caramel Sauce 1000 ml', 10, 5, '0', 'stockroom', 'available', 10, 'liquid'),
(3, 14, 3, 'Strawberry Syrup 500 ml', 5, 5, '0', 'stockroom', 'available', 5, 'liquid'),
(4, 14, 3, 'Vanilla Syrup 500 ml', 0, 5, '0', 'stockroom', 'unavailable', 0, 'liquid'),
(5, 22, 10, 'Chicken Wings', 15, 10, '0', 'kitchen', 'available', 15, 'solid'),
(6, 24, 4, 'Milk 1 l', 6, 5, '0', 'stockroom', 'available', 6, 'liquid'),
(7, 19, 6, 'Coca Cola Solo 250 ml', 1, 1, '0', 'stockroom', 'available', 1, 'liquid'),
(8, 21, 3, 'Strawberry Milk Syrup', 7, 3, '500ml', 'kitchen', 'available', 0, 'liquid'),
(9, 21, 3, 'Strawberry Milk Syrup', 7, 3, '560ml', 'kitchen', 'available', 0, 'liquid'),
(10, 19, 8, 'Matcha Powder', 11, 2, '800mg', 'kitchen', 'unavailable', 0, 'solid'),
(11, 21, 3, 'new', 4, 2, '500l', 'stockroom', 'available', 0, 'liquid');

-- --------------------------------------------------------

--
-- Table structure for table `stocklog`
--

DROP TABLE IF EXISTS `stocklog`;
CREATE TABLE IF NOT EXISTS `stocklog` (
  `slID` int(11) NOT NULL AUTO_INCREMENT,
  `stID` int(11) NOT NULL,
  `tID` int(11) NOT NULL,
  `slType` enum('consumed','restock','spoilage','return','other') NOT NULL,
  `slDateTime` datetime NOT NULL,
  `dateRecorded` datetime NOT NULL,
  `slQty` int(11) NOT NULL,
  `slRemarks` longtext,
  PRIMARY KEY (`slID`),
  KEY `stocklogStID_idx` (`stID`),
  KEY `stocklogTID_idx` (`tID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockspoil`
--

DROP TABLE IF EXISTS `stockspoil`;
CREATE TABLE IF NOT EXISTS `stockspoil` (
  `ssID` int(11) NOT NULL AUTO_INCREMENT,
  `ssDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`ssID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `spID` int(11) NOT NULL AUTO_INCREMENT,
  `spName` varchar(45) NOT NULL,
  `spContactNum` varchar(20) NOT NULL,
  `spEmail` varchar(45) DEFAULT NULL,
  `spStatus` enum('active','inactive','archived') NOT NULL,
  `spAddress` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`spID`, `spName`, `spContactNum`, `spEmail`, `spStatus`, `spAddress`) VALUES
(1, 'Coca Cola Inc.', '09709052911', 'cocacola@email.com', 'active', NULL),
(2, 'Tiongsan', '09454218542', NULL, 'active', 'Latrinidad, Benguet'),
(3, 'Miya', '09709052911', NULL, 'active', 'Latrinidad, Benguet'),
(4, 'Roger', '09709052911', NULL, 'inactive', 'Bulacan');

-- --------------------------------------------------------

--
-- Table structure for table `suppliermerchandise`
--

DROP TABLE IF EXISTS `suppliermerchandise`;
CREATE TABLE IF NOT EXISTS `suppliermerchandise` (
  `spmID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `spmName` varchar(45) NOT NULL,
  `spmActualQty` int(11) NOT NULL,
  `spmPrice` double NOT NULL,
  PRIMARY KEY (`spmID`),
  KEY `suppliermerchandiseSpID_idx` (`spID`),
  KEY `suppliermerchandiseStID_idx` (`stID`),
  KEY `suppliermerchandiseUomID_idx` (`uomID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `tableCode` varchar(11) NOT NULL,
  PRIMARY KEY (`tableCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tableCode`) VALUES
('t1'),
('t2'),
('t3'),
('t4'),
('t5'),
('t6'),
('v10'),
('v11'),
('v12'),
('v7'),
('v8'),
('v9');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `tID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) DEFAULT NULL,
  `tNum` varchar(64) NOT NULL,
  `tDate` date NOT NULL,
  `tType` enum('delivery receipt','purchase order','official receipt') NOT NULL,
  `dateRecorded` datetime NOT NULL,
  `tRemarks` longtext,
  PRIMARY KEY (`tID`),
  KEY `transactionsSpID_idx` (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`tID`, `spID`, `tNum`, `tDate`, `tType`, `dateRecorded`, `tRemarks`) VALUES
(1, 1, '123434566', '2019-05-27', 'delivery receipt', '2019-05-27 00:00:00', NULL),
(2, 3, '02345532', '2019-05-27', 'official receipt', '2019-05-27 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
CREATE TABLE IF NOT EXISTS `transitems` (
  `tiID` int(11) NOT NULL AUTO_INCREMENT,
  `uomID` int(11) NOT NULL,
  `stID` int(11) DEFAULT NULL,
  `tiName` varchar(45) NOT NULL,
  `tiPrice` double NOT NULL,
  `tiDiscount` varchar(45) DEFAULT NULL,
  `tiStatus` enum('partially delivered','delivered','paid') DEFAULT NULL,
  PRIMARY KEY (`tiID`),
  KEY `transitemsUomID_idx` (`uomID`),
  KEY `transitemsStID_idx` (`stID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transitems`
--

INSERT INTO `transitems` (`tiID`, `uomID`, `stID`, `tiName`, `tiPrice`, `tiDiscount`, `tiStatus`) VALUES
(1, 6, 7, 'Coca Cola Solo 250 ml', 850, NULL, NULL),
(2, 4, 6, 'Nestle Milk 1 l', 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trans_items`
--

DROP TABLE IF EXISTS `trans_items`;
CREATE TABLE IF NOT EXISTS `trans_items` (
  `tiID` int(11) NOT NULL,
  `tID` int(11) NOT NULL,
  `tiQty` int(11) NOT NULL,
  `tiSubtotal` double NOT NULL,
  PRIMARY KEY (`tiID`,`tID`),
  KEY `trans_itemsTID_idx` (`tID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trans_items`
--

INSERT INTO `trans_items` (`tiID`, `tID`, `tiQty`, `tiSubtotal`) VALUES
(1, 1, 0, 0),
(2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

DROP TABLE IF EXISTS `uom`;
CREATE TABLE IF NOT EXISTS `uom` (
  `uomID` int(11) NOT NULL AUTO_INCREMENT,
  `uomName` varchar(45) NOT NULL,
  `uomAbbreviation` varchar(45) NOT NULL,
  `uomVariant` enum('liquid','solid') DEFAULT NULL,
  `uomStore` enum('single','set') DEFAULT NULL,
  PRIMARY KEY (`uomID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`uomID`, `uomName`, `uomAbbreviation`, `uomVariant`, `uomStore`) VALUES
(1, 'mililiter', 'ml', 'liquid', NULL),
(2, 'liter', 'l', 'liquid', NULL),
(3, 'bottle', 'bt', NULL, 'single'),
(4, 'carton', 'ct', NULL, 'set'),
(5, 'box', 'bx', NULL, 'set'),
(6, 'case', 'cs', NULL, 'set'),
(7, 'bag', 'bg', NULL, 'single'),
(8, 'pack', 'pck', NULL, 'single'),
(9, 'slice', 'sc', NULL, 'single'),
(10, 'piece', 'pc', NULL, 'single'),
(11, 'miligrams', 'mg', 'solid', NULL),
(12, 'kilograms', 'kg', 'solid', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `activity log aID` FOREIGN KEY (`aID`) REFERENCES `accounts` (`aID`) ON UPDATE CASCADE;

--
-- Constraints for table `addonspoil`
--
ALTER TABLE `addonspoil`
  ADD CONSTRAINT `addons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `addons aosID` FOREIGN KEY (`aosID`) REFERENCES `aospoil` (`aosID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `super category` FOREIGN KEY (`supcatID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freebies`
--
ALTER TABLE `freebies`
  ADD CONSTRAINT `freebies pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menuaddons`
--
ALTER TABLE `menuaddons`
  ADD CONSTRAINT `menuaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menuaddons mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menudiscount`
--
ALTER TABLE `menudiscount`
  ADD CONSTRAINT `menudiscount pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menudiscount prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menufreebie`
--
ALTER TABLE `menufreebie`
  ADD CONSTRAINT `menufreebie pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menufreebie prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderaddons`
--
ALTER TABLE `orderaddons`
  ADD CONSTRAINT `orderaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderaddons olID` FOREIGN KEY (`olID`) REFERENCES `orderlists` (`olID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderlists`
--
ALTER TABLE `orderlists`
  ADD CONSTRAINT `orderlists osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderlists prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON UPDATE CASCADE;

--
-- Constraints for table `orderslips`
--
ALTER TABLE `orderslips`
  ADD CONSTRAINT `ordertableCode` FOREIGN KEY (`tableCode`) REFERENCES `tables` (`tableCode`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promoconstraint`
--
ALTER TABLE `promoconstraint`
  ADD CONSTRAINT `promoconstraint priD` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promocontraint pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spoiledmenu`
--
ALTER TABLE `spoiledmenu`
  ADD CONSTRAINT `spoiledmenuMsID` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spoiledmenuPrID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spoiledstock`
--
ALTER TABLE `spoiledstock`
  ADD CONSTRAINT `spoiledmenuSID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spoiledmenuSsiD` FOREIGN KEY (`ssID`) REFERENCES `stockspoil` (`ssID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockitems`
--
ALTER TABLE `stockitems`
  ADD CONSTRAINT `stockCategoryID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stockUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE;

--
-- Constraints for table `stocklog`
--
ALTER TABLE `stocklog`
  ADD CONSTRAINT `stocklogStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stocklogTID` FOREIGN KEY (`tID`) REFERENCES `transactions` (`tID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliermerchandise`
--
ALTER TABLE `suppliermerchandise`
  ADD CONSTRAINT `suppliermerchandiseSpID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `suppliermerchandiseStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suppliermerchandiseUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactionsSpID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON UPDATE CASCADE;

--
-- Constraints for table `transitems`
--
ALTER TABLE `transitems`
  ADD CONSTRAINT `transitemsStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transitemsUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE;

--
-- Constraints for table `trans_items`
--
ALTER TABLE `trans_items`
  ADD CONSTRAINT `trans_itemsTID` FOREIGN KEY (`tID`) REFERENCES `transactions` (`tID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_itemsTiID` FOREIGN KEY (`tiID`) REFERENCES `transitems` (`tiID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
