-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2019 at 01:20 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

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
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`aID`, `aType`, `aUsername`, `aPassword`, `aIsOnline`) VALUES
(1, 'admin', 'manager', 'manager', '1');

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
  `alType` enum('add','update','delete') NOT NULL,
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
  `aoStatus` enum('availabe','unavailable','deleted') NOT NULL,
  PRIMARY KEY (`aoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  KEY `addonspoil aosID_idx` (`aosID`)
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ctID`, `supcatID`, `ctName`, `ctType`) VALUES
(1, NULL, 'Cake', 'inventory');

-- --------------------------------------------------------

--
-- Table structure for table `consumption`
--

DROP TABLE IF EXISTS `consumption`;
CREATE TABLE IF NOT EXISTS `consumption` (
  `cnID` int(11) NOT NULL AUTO_INCREMENT,
  `cnDate` date NOT NULL,
  `cnDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`cnID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumption`
--

INSERT INTO `consumption` (`cnID`, `cnDate`, `cnDateRecorded`) VALUES
(1, '2019-05-26', '2019-05-26 10:00:59');

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

-- --------------------------------------------------------

--
-- Table structure for table `expiration`
--

DROP TABLE IF EXISTS `expiration`;
CREATE TABLE IF NOT EXISTS `expiration` (
  `expID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `expDate` date DEFAULT NULL,
  `expQty` int(11) NOT NULL,
  `expMaxTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`expID`),
  KEY `expiration vID_idx` (`vID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `iID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) NOT NULL,
  `iDate` date NOT NULL,
  `iDateRecorded` datetime NOT NULL,
  `iNumber` varchar(45) DEFAULT NULL,
  `iTotal` double NOT NULL,
  `iRemarks` longtext,
  `iType` enum('purchase','return','delivery') NOT NULL,
  `resolvedStatus` enum('pending','partially resolved','resolved') NOT NULL,
  PRIMARY KEY (`iID`),
  KEY `invoice spID_idx` (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`iID`, `spID`, `iDate`, `iDateRecorded`, `iNumber`, `iTotal`, `iRemarks`, `iType`, `resolvedStatus`) VALUES
(1, 1, '2019-05-25', '2019-05-25 15:21:10', '2154632', 1000, NULL, 'purchase', 'resolved');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitems`
--

DROP TABLE IF EXISTS `invoiceitems`;
CREATE TABLE IF NOT EXISTS `invoiceitems` (
  `iItemID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `iID` int(11) NOT NULL,
  `iName` varchar(64) NOT NULL,
  `iQty` int(11) NOT NULL,
  `iPrice` double NOT NULL,
  `iUnit` varchar(24) NOT NULL,
  `iSubTotal` double NOT NULL,
  PRIMARY KEY (`iItemID`),
  KEY `invoiceitems iID_idx` (`iID`),
  KEY `vID_idx` (`vID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoiceitems`
--

INSERT INTO `invoiceitems` (`iItemID`, `vID`, `iID`, `iName`, `iQty`, `iPrice`, `iUnit`, `iSubTotal`) VALUES
(1, 1, 1, 'Alaska Milk', 1, 500, 'bag', 500),
(2, 2, 1, 'Bearbrand Gatas Na Choco', 1, 300, 'bag', 300),
(3, 3, 1, 'Plantain', 1, 200, 'box', 200);

-- --------------------------------------------------------

--
-- Table structure for table `invoicepo`
--

DROP TABLE IF EXISTS `invoicepo`;
CREATE TABLE IF NOT EXISTS `invoicepo` (
  `iID` int(11) NOT NULL,
  `poID` int(11) NOT NULL,
  PRIMARY KEY (`iID`,`poID`),
  KEY `invoicepo iItemID_idx` (`iID`),
  KEY `invoicepo poiID_idx` (`poID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicepo`
--

INSERT INTO `invoicepo` (`iID`, `poID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `mID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `mName` varchar(64) NOT NULL,
  `mDesc` varchar(120) NOT NULL,
  `mAvailability` enum('available','unavailable','deleted') NOT NULL,
  `mImage` varchar(64) NOT NULL,
  PRIMARY KEY (`mID`),
  KEY `menu ctID_idx` (`ctID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `olStatus` enum('pending','done','served') NOT NULL,
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
  `custName` varchar(45) NOT NULL,
  `osTotal` double NOT NULL,
  `osDate` date NOT NULL,
  `osPayDate` date NOT NULL,
  `osDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`osID`),
  KEY `orderslips tableCode_idx` (`tableCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poitems`
--

DROP TABLE IF EXISTS `poitems`;
CREATE TABLE IF NOT EXISTS `poitems` (
  `poiID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `poID` int(11) NOT NULL,
  `poiQty` int(11) NOT NULL,
  `poiUnit` varchar(24) NOT NULL,
  `poiPrice` double NOT NULL,
  `poiStatus` enum('pending','delivered','partially delivered','deleted') NOT NULL,
  PRIMARY KEY (`poiID`),
  KEY `poitems poID_idx` (`poID`),
  KEY `poitems vID_idx` (`vID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poitems`
--

INSERT INTO `poitems` (`poiID`, `vID`, `poID`, `poiQty`, `poiUnit`, `poiPrice`, `poiStatus`) VALUES
(1, 1, 1, 1, 'bag', 500, 'delivered'),
(2, 2, 1, 1, 'bag', 300, 'delivered'),
(3, 3, 1, 1, 'box', 200, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `prID` int(11) NOT NULL AUTO_INCREMENT,
  `mID` int(11) NOT NULL,
  `prName` varchar(64) NOT NULL,
  `mTemp` enum('h','c') DEFAULT NULL,
  `prPrice` double NOT NULL,
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
  `status` enum('enabled','disabled','deleted') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

DROP TABLE IF EXISTS `purchaseorder`;
CREATE TABLE IF NOT EXISTS `purchaseorder` (
  `poID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) NOT NULL,
  `poDate` date NOT NULL,
  `edDate` date NOT NULL,
  `poTotal` double NOT NULL,
  `poDateRecorded` datetime NOT NULL,
  `poRemarks` longtext,
  `poStatus` enum('pending','delivered','partially delivered','deleted') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`poID`),
  KEY `purchaseorder spID_idx` (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseorder`
--

INSERT INTO `purchaseorder` (`poID`, `spID`, `poDate`, `edDate`, `poTotal`, `poDateRecorded`, `poRemarks`, `poStatus`) VALUES
(1, 1, '2019-05-15', '2019-05-25', 1000, '2019-05-15 18:15:35', NULL, 'delivered');

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
  KEY `spoiledmenu mID_idx` (`prID`),
  KEY `spoiledmenu msID_idx` (`msID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
CREATE TABLE IF NOT EXISTS `stockitems` (
  `stID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `stName` varchar(64) NOT NULL,
  `stStatus` enum('available','unavailable','temp unavailable','deleted') NOT NULL,
  `stType` enum('liquid','solid') NOT NULL,
  PRIMARY KEY (`stID`),
  KEY `stockitems ctID_idx` (`ctID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`stID`, `ctID`, `stName`, `stStatus`, `stType`) VALUES
(1, 1, 'Milk Powder', 'available', 'solid'),
(2, 1, 'Banana', 'available', 'solid');

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
  `spName` varchar(64) NOT NULL,
  `spContactNum` varchar(13) NOT NULL,
  `spEmail` varchar(45) NOT NULL,
  `spStatus` enum('active','inactive','deleted') NOT NULL,
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`spID`, `spName`, `spContactNum`, `spEmail`, `spStatus`) VALUES
(1, 'Example Inc.', '+639179354463', 'example@ex.com', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `suppliermerchandise`
--

DROP TABLE IF EXISTS `suppliermerchandise`;
CREATE TABLE IF NOT EXISTS `suppliermerchandise` (
  `spmID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `spID` int(11) NOT NULL,
  `spmDesc` varchar(120) NOT NULL,
  `spmUnit` varchar(24) NOT NULL,
  `spmPrice` double NOT NULL,
  PRIMARY KEY (`spmID`),
  KEY `suppliermerchandise vID_idx` (`vID`),
  KEY `suppliermerchandise spID_idx` (`spID`)
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

-- --------------------------------------------------------

--
-- Table structure for table `varconsumptionitems`
--

DROP TABLE IF EXISTS `varconsumptionitems`;
CREATE TABLE IF NOT EXISTS `varconsumptionitems` (
  `cnID` int(11) NOT NULL,
  `vID` int(11) NOT NULL,
  `cnQty` int(11) NOT NULL,
  `remainingQty` int(11) NOT NULL,
  PRIMARY KEY (`cnID`,`vID`),
  KEY `vct cnID_idx` (`cnID`),
  KEY `vct vID_idx` (`vID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `varconsumptionitems`
--

INSERT INTO `varconsumptionitems` (`cnID`, `vID`, `cnQty`, `remainingQty`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `variance`
--

DROP TABLE IF EXISTS `variance`;
CREATE TABLE IF NOT EXISTS `variance` (
  `vID` int(11) NOT NULL AUTO_INCREMENT,
  `stID` int(11) NOT NULL,
  `vUnit` varchar(24) NOT NULL,
  `vSize` varchar(24) NOT NULL,
  `vMin` int(11) NOT NULL,
  `vQty` int(11) NOT NULL,
  `bQTy` int(11) NOT NULL,
  `vStatus` enum('available','unavailable','temp unavailable','deleted') NOT NULL,
  PRIMARY KEY (`vID`),
  KEY `variance stID_idx` (`stID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variance`
--

INSERT INTO `variance` (`vID`, `stID`, `vUnit`, `vSize`, `vMin`, `vQty`, `bQTy`, `vStatus`) VALUES
(1, 1, 'bag', '1 kg', 1, 1, 1, 'available'),
(2, 1, 'bag', '500 g', 1, 1, 1, 'available'),
(3, 2, 'box', '12 pcs', 1, 1, 1, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `varspoilitems`
--

DROP TABLE IF EXISTS `varspoilitems`;
CREATE TABLE IF NOT EXISTS `varspoilitems` (
  `ssID` int(11) NOT NULL,
  `vID` int(11) NOT NULL,
  `ssQty` int(11) NOT NULL,
  `ssDate` date NOT NULL,
  `ssRemarks` longtext,
  PRIMARY KEY (`ssID`,`vID`),
  KEY `varspoilitems vID_idx` (`vID`),
  KEY `varspoilitems ssID_idx` (`ssID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD CONSTRAINT `addons aosID` FOREIGN KEY (`aosID`) REFERENCES `addonspoil` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `expiration`
--
ALTER TABLE `expiration`
  ADD CONSTRAINT `expiration vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freebies`
--
ALTER TABLE `freebies`
  ADD CONSTRAINT `freebies pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  ADD CONSTRAINT `invoiceitems iID` FOREIGN KEY (`iID`) REFERENCES `invoice` (`iID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoiceitems vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoicepo`
--
ALTER TABLE `invoicepo`
  ADD CONSTRAINT `invoicepo iItemID` FOREIGN KEY (`iID`) REFERENCES `invoice` (`iID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoicepo poiID` FOREIGN KEY (`poID`) REFERENCES `purchaseorder` (`poID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orderlists prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderslips`
--
ALTER TABLE `orderslips`
  ADD CONSTRAINT `orderslips tableCode` FOREIGN KEY (`tableCode`) REFERENCES `tables` (`tableCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `poitems`
--
ALTER TABLE `poitems`
  ADD CONSTRAINT `poitems poID` FOREIGN KEY (`poID`) REFERENCES `purchaseorder` (`poID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poitems vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD CONSTRAINT `purchaseorder spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spoiledmenu`
--
ALTER TABLE `spoiledmenu`
  ADD CONSTRAINT `spoiledmenu msiD` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spoiledmenu priD` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockitems`
--
ALTER TABLE `stockitems`
  ADD CONSTRAINT `stockitems ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliermerchandise`
--
ALTER TABLE `suppliermerchandise`
  ADD CONSTRAINT `suppliermerchandise spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suppliermerchandise vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `varconsumptionitems`
--
ALTER TABLE `varconsumptionitems`
  ADD CONSTRAINT `vct cnID` FOREIGN KEY (`cnID`) REFERENCES `consumption` (`cnID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vct vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variance`
--
ALTER TABLE `variance`
  ADD CONSTRAINT `variance stID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `varspoilitems`
--
ALTER TABLE `varspoilitems`
  ADD CONSTRAINT `varspoilitems ssID` FOREIGN KEY (`ssID`) REFERENCES `stockspoil` (`ssID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `varspoilitems vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
