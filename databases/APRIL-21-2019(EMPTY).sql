CREATE DATABASE  IF NOT EXISTS `il-lengan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `il-lengan`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: il-lengan
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `aID` int(11) NOT NULL AUTO_INCREMENT,
  `aType` enum('admin','barista','chef','customer') NOT NULL,
  `aUsername` varchar(25) NOT NULL,
  `aPassword` char(64) NOT NULL,
  `aIsOnline` enum('1','0') NOT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activitylog`
--

DROP TABLE IF EXISTS `activitylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activitylog` (
  `alID` int(11) NOT NULL AUTO_INCREMENT,
  `aID` int(11) NOT NULL,
  `alDate` datetime NOT NULL,
  `alDesc` varchar(120) NOT NULL,
  `alType` enum('add','update','delete') NOT NULL,
  `additionalRemarks` longtext,
  PRIMARY KEY (`alID`),
  KEY `activity log aID_idx` (`aID`),
  CONSTRAINT `activity log aID` FOREIGN KEY (`aID`) REFERENCES `accounts` (`aID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activitylog`
--

LOCK TABLES `activitylog` WRITE;
/*!40000 ALTER TABLE `activitylog` DISABLE KEYS */;
/*!40000 ALTER TABLE `activitylog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addons` (
  `aoID` int(11) NOT NULL AUTO_INCREMENT,
  `aoName` varchar(45) NOT NULL,
  `aoCategory` enum('food','drinks') NOT NULL,
  `aoPrice` double NOT NULL,
  `aoStatus` enum('availabe','unavailable','deleted') NOT NULL,
  PRIMARY KEY (`aoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addonspoil`
--

DROP TABLE IF EXISTS `addonspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addonspoil` (
  `aoID` int(11) NOT NULL,
  `aosID` int(11) NOT NULL,
  `aosQty` int(11) NOT NULL,
  `aosDate` date NOT NULL,
  `aosRemarks` longtext,
  PRIMARY KEY (`aoID`,`aosID`),
  KEY `addonspoil aoID_idx` (`aoID`),
  KEY `addonspoil aosID_idx` (`aosID`),
  CONSTRAINT `addons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON UPDATE CASCADE,
  CONSTRAINT `addons aosID` FOREIGN KEY (`aosID`) REFERENCES `addonspoil` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addonspoil`
--

LOCK TABLES `addonspoil` WRITE;
/*!40000 ALTER TABLE `addonspoil` DISABLE KEYS */;
/*!40000 ALTER TABLE `addonspoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aospoil`
--

DROP TABLE IF EXISTS `aospoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aospoil` (
  `aosID` int(11) NOT NULL AUTO_INCREMENT,
  `aosDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`aosID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aospoil`
--

LOCK TABLES `aospoil` WRITE;
/*!40000 ALTER TABLE `aospoil` DISABLE KEYS */;
/*!40000 ALTER TABLE `aospoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `ctID` int(11) NOT NULL AUTO_INCREMENT,
  `supcatID` int(11) DEFAULT NULL,
  `ctName` varchar(45) NOT NULL,
  `ctType` enum('menu','inventory') NOT NULL,
  PRIMARY KEY (`ctID`),
  KEY `super category_idx` (`supcatID`),
  CONSTRAINT `super category` FOREIGN KEY (`supcatID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumption`
--

DROP TABLE IF EXISTS `consumption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumption` (
  `cnID` int(11) NOT NULL AUTO_INCREMENT,
  `cnDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`cnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumption`
--

LOCK TABLES `consumption` WRITE;
/*!40000 ALTER TABLE `consumption` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `pmID` int(11) NOT NULL,
  `dcName` varchar(45) NOT NULL,
  PRIMARY KEY (`pmID`),
  KEY `index2` (`pmID`),
  CONSTRAINT `discounts` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expiration`
--

DROP TABLE IF EXISTS `expiration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expiration` (
  `expID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `expDate` date DEFAULT NULL,
  `expQty` int(11) NOT NULL,
  `expMaxTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`expID`),
  KEY `expiration vID_idx` (`vID`),
  CONSTRAINT `expiration vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expiration`
--

LOCK TABLES `expiration` WRITE;
/*!40000 ALTER TABLE `expiration` DISABLE KEYS */;
/*!40000 ALTER TABLE `expiration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freebies`
--

DROP TABLE IF EXISTS `freebies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freebies` (
  `pmID` int(11) NOT NULL,
  `fbName` varchar(45) NOT NULL,
  `isElective` enum('0','1') NOT NULL,
  PRIMARY KEY (`pmID`),
  CONSTRAINT `freebies pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freebies`
--

LOCK TABLES `freebies` WRITE;
/*!40000 ALTER TABLE `freebies` DISABLE KEYS */;
/*!40000 ALTER TABLE `freebies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
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
  KEY `invoice spID_idx` (`spID`),
  CONSTRAINT `invoice spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoiceitems`
--

DROP TABLE IF EXISTS `invoiceitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoiceitems` (
  `iItemID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `iID` int(11) NOT NULL,
  `iName` varchar(45) NOT NULL,
  `iQty` int(11) NOT NULL,
  `iPrice` double NOT NULL,
  `iUnit` varchar(45) NOT NULL,
  `iSubTotal` double NOT NULL,
  PRIMARY KEY (`iItemID`),
  KEY `invoiceitems iID_idx` (`iID`),
  KEY `vID_idx` (`vID`),
  CONSTRAINT `invoiceitems iID` FOREIGN KEY (`iID`) REFERENCES `invoice` (`iID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoiceitems vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoiceitems`
--

LOCK TABLES `invoiceitems` WRITE;
/*!40000 ALTER TABLE `invoiceitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoiceitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicepo`
--

DROP TABLE IF EXISTS `invoicepo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicepo` (
  `iID` int(11) NOT NULL,
  `poID` int(11) NOT NULL,
  PRIMARY KEY (`iID`,`poID`),
  KEY `invoicepo iItemID_idx` (`iID`),
  KEY `invoicepo poiID_idx` (`poID`),
  CONSTRAINT `invoicepo iItemID` FOREIGN KEY (`iID`) REFERENCES `invoice` (`iID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoicepo poiID` FOREIGN KEY (`poID`) REFERENCES `purchaseorder` (`poID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicepo`
--

LOCK TABLES `invoicepo` WRITE;
/*!40000 ALTER TABLE `invoicepo` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoicepo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `mID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `mName` varchar(45) NOT NULL,
  `mDesc` varchar(45) NOT NULL,
  `mAvailability` enum('available','unavailable','deleted') NOT NULL,
  `mImage` varchar(64) NOT NULL,
  PRIMARY KEY (`mID`),
  KEY `menu ctID_idx` (`ctID`),
  CONSTRAINT `menu ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuaddons`
--

DROP TABLE IF EXISTS `menuaddons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuaddons` (
  `mID` int(11) NOT NULL,
  `aoID` int(11) NOT NULL,
  PRIMARY KEY (`mID`,`aoID`),
  KEY `menuaddons mID_idx` (`mID`),
  KEY `menuaddons aoID_idx` (`aoID`),
  CONSTRAINT `menuaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menuaddons mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuaddons`
--

LOCK TABLES `menuaddons` WRITE;
/*!40000 ALTER TABLE `menuaddons` DISABLE KEYS */;
/*!40000 ALTER TABLE `menuaddons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menudiscount`
--

DROP TABLE IF EXISTS `menudiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudiscount` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `dcAmount` double NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menudiscount prID_idx` (`prID`),
  CONSTRAINT `menudiscount pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menudiscount prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menudiscount`
--

LOCK TABLES `menudiscount` WRITE;
/*!40000 ALTER TABLE `menudiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `menudiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menufreebie`
--

DROP TABLE IF EXISTS `menufreebie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menufreebie` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `fbQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menufreebie prID_idx` (`prID`),
  CONSTRAINT `menufreebie pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menufreebie prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menufreebie`
--

LOCK TABLES `menufreebie` WRITE;
/*!40000 ALTER TABLE `menufreebie` DISABLE KEYS */;
/*!40000 ALTER TABLE `menufreebie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuspoil`
--

DROP TABLE IF EXISTS `menuspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuspoil` (
  `msID` int(11) NOT NULL AUTO_INCREMENT,
  `msDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`msID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuspoil`
--

LOCK TABLES `menuspoil` WRITE;
/*!40000 ALTER TABLE `menuspoil` DISABLE KEYS */;
/*!40000 ALTER TABLE `menuspoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderaddons`
--

DROP TABLE IF EXISTS `orderaddons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderaddons` (
  `aoID` int(11) NOT NULL,
  `olID` int(11) NOT NULL,
  `aoQty` int(11) NOT NULL,
  `aoTotal` double NOT NULL,
  PRIMARY KEY (`aoID`,`olID`),
  KEY `orderaddons aoID_idx` (`aoID`),
  KEY `orderaddons olID_idx` (`olID`),
  CONSTRAINT `orderaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderaddons olID` FOREIGN KEY (`olID`) REFERENCES `orderlists` (`olID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderaddons`
--

LOCK TABLES `orderaddons` WRITE;
/*!40000 ALTER TABLE `orderaddons` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderaddons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderlists`
--

DROP TABLE IF EXISTS `orderlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderlists` (
  `olID` int(11) NOT NULL AUTO_INCREMENT,
  `prID` int(11) NOT NULL,
  `osID` int(11) NOT NULL,
  `olDesc` varchar(45) NOT NULL,
  `olQty` int(11) NOT NULL,
  `olSubtotal` double NOT NULL,
  `olStatus` enum('pending','done','served') NOT NULL,
  `olRemarks` longtext,
  PRIMARY KEY (`olID`),
  KEY `orderlists prID_idx` (`prID`),
  KEY `orderlists osID_idx` (`osID`),
  CONSTRAINT `orderlists osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderlists prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderlists`
--

LOCK TABLES `orderlists` WRITE;
/*!40000 ALTER TABLE `orderlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderslips`
--

DROP TABLE IF EXISTS `orderslips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderslips` (
  `osID` int(11) NOT NULL AUTO_INCREMENT,
  `tableCode` varchar(11) NOT NULL,
  `custName` varchar(45) NOT NULL,
  `osTotal` double NOT NULL,
  `osDate` date NOT NULL,
  `osPayDate` date NOT NULL,
  `osDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`osID`),
  KEY `orderslips tableCode_idx` (`tableCode`),
  CONSTRAINT `orderslips tableCode` FOREIGN KEY (`tableCode`) REFERENCES `tables` (`tableCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderslips`
--

LOCK TABLES `orderslips` WRITE;
/*!40000 ALTER TABLE `orderslips` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderslips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poitems`
--

DROP TABLE IF EXISTS `poitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poitems` (
  `poiID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `poID` int(11) NOT NULL,
  `poiQty` int(11) NOT NULL,
  `poiUnit` varchar(45) NOT NULL,
  `poiPrice` double NOT NULL,
  `poiRemarks` longtext NOT NULL,
  `poiStatus` enum('pending','delivered','partially delivered','deleted') NOT NULL,
  PRIMARY KEY (`poiID`),
  KEY `poitems poID_idx` (`poID`),
  KEY `poitems vID_idx` (`vID`),
  CONSTRAINT `poitems poID` FOREIGN KEY (`poID`) REFERENCES `purchaseorder` (`poID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `poitems vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poitems`
--

LOCK TABLES `poitems` WRITE;
/*!40000 ALTER TABLE `poitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `poitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferences` (
  `prID` int(11) NOT NULL AUTO_INCREMENT,
  `mID` int(11) NOT NULL,
  `prName` varchar(45) NOT NULL,
  `mTemp` enum('h','c') DEFAULT NULL,
  `prPrice` double NOT NULL,
  PRIMARY KEY (`prID`),
  KEY `preferences mID_idx` (`mID`),
  CONSTRAINT `preferences mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promoconstraint`
--

DROP TABLE IF EXISTS `promoconstraint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promoconstraint` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `pcType` enum('f','d','fd') NOT NULL,
  `pcQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `promocons pmID_idx` (`pmID`),
  KEY `promocons mID_idx` (`prID`),
  CONSTRAINT `promoconstraint priD` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `promocontraint pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promoconstraint`
--

LOCK TABLES `promoconstraint` WRITE;
/*!40000 ALTER TABLE `promoconstraint` DISABLE KEYS */;
/*!40000 ALTER TABLE `promoconstraint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promos` (
  `pmID` int(11) NOT NULL AUTO_INCREMENT,
  `pmName` varchar(45) NOT NULL,
  `pmStartDate` date NOT NULL,
  `pmEndDate` date NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled','deleted') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promos`
--

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;
/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorder`
--

DROP TABLE IF EXISTS `purchaseorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaseorder` (
  `poID` int(11) NOT NULL AUTO_INCREMENT,
  `poDate` date NOT NULL,
  `edDate` date NOT NULL,
  `poTotal` double NOT NULL,
  `poDateRecorded` datetime NOT NULL,
  `poStatus` enum('pending','delivered','partially delivered','deleted') DEFAULT NULL,
  `spID` int(11) NOT NULL,
  PRIMARY KEY (`poID`),
  KEY `purchaseorder spID_idx` (`spID`),
  CONSTRAINT `purchaseorder spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorder`
--

LOCK TABLES `purchaseorder` WRITE;
/*!40000 ALTER TABLE `purchaseorder` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchaseorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spoiledmenu`
--

DROP TABLE IF EXISTS `spoiledmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoiledmenu` (
  `prID` int(11) NOT NULL,
  `msID` int(11) NOT NULL,
  `msQty` int(11) NOT NULL,
  `msDate` date NOT NULL,
  `msRemarks` longtext NOT NULL,
  PRIMARY KEY (`prID`,`msID`),
  KEY `spoiledmenu mID_idx` (`prID`),
  KEY `spoiledmenu msID_idx` (`msID`),
  CONSTRAINT `spoiledmenu msiD` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoiledmenu priD` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoiledmenu`
--

LOCK TABLES `spoiledmenu` WRITE;
/*!40000 ALTER TABLE `spoiledmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `spoiledmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockitems` (
  `stID` int(11) NOT NULL AUTO_INCREMENT,
  `stName` varchar(45) NOT NULL,
  `stStatus` enum('available','unavalable','temporary unavailable','deleted') NOT NULL,
  `stType` enum('Liquid','Solid') NOT NULL,
  `ctID` int(11) NOT NULL,
  PRIMARY KEY (`stID`),
  KEY `stockitems ctID_idx` (`ctID`),
  CONSTRAINT `stockitems ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockitems`
--

LOCK TABLES `stockitems` WRITE;
/*!40000 ALTER TABLE `stockitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `stockitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockspoil`
--

DROP TABLE IF EXISTS `stockspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockspoil` (
  `ssID` int(11) NOT NULL AUTO_INCREMENT,
  `ssDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`ssID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockspoil`
--

LOCK TABLES `stockspoil` WRITE;
/*!40000 ALTER TABLE `stockspoil` DISABLE KEYS */;
/*!40000 ALTER TABLE `stockspoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `spID` int(11) NOT NULL AUTO_INCREMENT,
  `spName` varchar(64) NOT NULL,
  `spContactNum` varchar(13) NOT NULL,
  `spEmail` varchar(45) NOT NULL,
  `spStatus` enum('active','inactive','deleted') NOT NULL,
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliermerchandise`
--

DROP TABLE IF EXISTS `suppliermerchandise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliermerchandise` (
  `spmID` int(11) NOT NULL AUTO_INCREMENT,
  `vID` int(11) NOT NULL,
  `spID` int(11) NOT NULL,
  `spmDesc` varchar(45) NOT NULL,
  `spmUnit` varchar(45) NOT NULL,
  `spmPrice` double NOT NULL,
  PRIMARY KEY (`spmID`),
  KEY `suppliermerchandise vID_idx` (`vID`),
  KEY `suppliermerchandise spID_idx` (`spID`),
  CONSTRAINT `suppliermerchandise spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `suppliermerchandise vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliermerchandise`
--

LOCK TABLES `suppliermerchandise` WRITE;
/*!40000 ALTER TABLE `suppliermerchandise` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliermerchandise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables` (
  `tableCode` varchar(11) NOT NULL,
  PRIMARY KEY (`tableCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `varconsumptionitems`
--

DROP TABLE IF EXISTS `varconsumptionitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `varconsumptionitems` (
  `cnID` int(11) NOT NULL,
  `vID` int(11) NOT NULL,
  `cnQty` int(11) NOT NULL,
  `cnDate` int(11) NOT NULL,
  PRIMARY KEY (`cnID`,`vID`),
  KEY `vct cnID_idx` (`cnID`),
  KEY `vct vID_idx` (`vID`),
  CONSTRAINT `vct cnID` FOREIGN KEY (`cnID`) REFERENCES `consumption` (`cnID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vct vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `varconsumptionitems`
--

LOCK TABLES `varconsumptionitems` WRITE;
/*!40000 ALTER TABLE `varconsumptionitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `varconsumptionitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variance`
--

DROP TABLE IF EXISTS `variance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variance` (
  `vID` int(11) NOT NULL AUTO_INCREMENT,
  `stID` int(11) NOT NULL,
  `vUnit` varchar(24) NOT NULL,
  `vSize` varchar(24) NOT NULL,
  `vMin` int(11) NOT NULL,
  `vQty` int(11) NOT NULL,
  `bQTy` int(11) NOT NULL,
  `vStatus` enum('available','unavailable','temp unavailable','deleted') NOT NULL,
  PRIMARY KEY (`vID`),
  KEY `variance stID_idx` (`stID`),
  CONSTRAINT `variance stID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variance`
--

LOCK TABLES `variance` WRITE;
/*!40000 ALTER TABLE `variance` DISABLE KEYS */;
/*!40000 ALTER TABLE `variance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `varspoilitems`
--

DROP TABLE IF EXISTS `varspoilitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `varspoilitems` (
  `ssID` int(11) NOT NULL,
  `vID` int(11) NOT NULL,
  `ssQty` int(11) NOT NULL,
  `ssDate` date NOT NULL,
  `ssRemarks` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ssID`,`vID`),
  KEY `varspoilitems vID_idx` (`vID`),
  KEY `varspoilitems ssID_idx` (`ssID`),
  CONSTRAINT `varspoilitems ssID` FOREIGN KEY (`ssID`) REFERENCES `stockspoil` (`ssID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `varspoilitems vID` FOREIGN KEY (`vID`) REFERENCES `variance` (`vID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `varspoilitems`
--

LOCK TABLES `varspoilitems` WRITE;
/*!40000 ALTER TABLE `varspoilitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `varspoilitems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-21 22:24:19
