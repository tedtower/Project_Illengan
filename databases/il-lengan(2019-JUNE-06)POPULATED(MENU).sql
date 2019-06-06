CREATE DATABASE  IF NOT EXISTS `il-lengan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `il-lengan`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: il-lengan
-- ------------------------------------------------------
-- Server version	5.7.23

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
  `aStatus` enum('active','inactive','archived') NOT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'admin','manager','manager','0','active'),(2,'barista','barista','barista','0','active'),(3,'chef','chef','chef','0','active'),(4,'customer','customer','customer','0','active');
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
  `alType` enum('add','update','archived') NOT NULL,
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
  `aoStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`aoID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
INSERT INTO `addons` VALUES (15,'Milk','drinks',20,'archived'),(16,'Sugar','drinks',20,'available'),(17,'Extra Rice','food',20,'available'),(18,'Extra Shot','drinks',20,'available'),(19,'Creamer','drinks',15,'available');
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
  KEY `addons aosID_idx` (`aosID`),
  CONSTRAINT `addons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON UPDATE CASCADE,
  CONSTRAINT `addons aosID` FOREIGN KEY (`aosID`) REFERENCES `aospoil` (`aosID`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aospoil`
--

LOCK TABLES `aospoil` WRITE;
/*!40000 ALTER TABLE `aospoil` DISABLE KEYS */;
INSERT INTO `aospoil` VALUES (1,'2019-04-29 10:00:00'),(2,'2019-04-29 16:17:00'),(3,'2019-04-30 00:00:00'),(4,'2019-04-30 00:00:00'),(5,'2019-05-08 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Meals','menu'),(2,NULL,'Drinks','menu'),(3,NULL,'Desserts','menu'),(4,1,'Pasta','menu'),(5,1,'Ala Carte','menu'),(6,1,'Combo (w/ Rice, Buttered Veggie & Egg)','menu'),(7,1,'Tamtaman (Samplers)','menu'),(8,1,'Gagay-yem (Barkada Meals)','menu'),(9,2,'Frappe','menu'),(10,2,'Espresso','menu'),(11,2,'French-Pressed (Brewed)','menu'),(12,2,'Hot and Cold Drinks','menu'),(13,NULL,'Sauce','inventory'),(14,NULL,'Syrup','inventory'),(15,NULL,'Powder','inventory'),(16,NULL,'Bean','inventory'),(17,NULL,'Tea','inventory'),(18,NULL,'Refreshment','inventory'),(19,18,'Soda','inventory'),(20,18,'Water','inventory'),(21,18,'Juice','inventory'),(22,NULL,'Meat','inventory'),(23,NULL,'Pasta','inventory'),(24,NULL,'Condiments','inventory'),(25,NULL,'Bago','menu'),(26,25,'Very Bago','menu');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
INSERT INTO `discounts` VALUES (1,'less 20%'),(3,'less 20%');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
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
INSERT INTO `freebies` VALUES (2,'Buy 1 take 1','0'),(3,'Buy 1 take 1','0');
/*!40000 ALTER TABLE `freebies` ENABLE KEYS */;
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
  `mName` varchar(64) NOT NULL,
  `mDesc` varchar(120) DEFAULT NULL,
  `mAvailability` enum('available','unavailable','archived') NOT NULL,
  `mImage` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`mID`),
  KEY `menu ctID_idx` (`ctID`),
  CONSTRAINT `menu ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (4,8,'Clubhouse, Fries, Nachos & Onion Rings',NULL,'available','Sandwich.png'),(5,8,'6pcs. Fried Chicken w/ Mojos',NULL,'unavailable',NULL),(6,8,'3pcs. Fried Chicken & 3pcs. Buffalo Chicken w/ Mojos',NULL,'available',NULL),(9,6,'2pc. Fried Chicken',NULL,'available',NULL),(10,6,'2pc. Buffalo Chicken',NULL,'available','Buffalo.jpg'),(16,5,'Animal Fries','fires that is fried to look like animal','available','Animal.jpg'),(26,5,'Carbonara Pasta',NULL,'available','Carbonara.jpg'),(42,9,'Matcha Frappe',NULL,'available','MatchaIced.jpg'),(44,10,'Americano',NULL,'available','Coffee.jpg'),(50,11,'Benguet Coffee',NULL,'available','Black.jpg'),(57,12,'Coca Cola',NULL,'unavailable','Coke.jpeg');
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
INSERT INTO `menuaddons` VALUES (10,17),(44,16),(50,16);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuspoil`
--

LOCK TABLES `menuspoil` WRITE;
/*!40000 ALTER TABLE `menuspoil` DISABLE KEYS */;
INSERT INTO `menuspoil` VALUES (1,'2019-04-30 00:00:00');
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
  `olDesc` varchar(120) NOT NULL,
  `olQty` int(11) NOT NULL,
  `olSubtotal` double NOT NULL,
  `olStatus` enum('pending','served') NOT NULL,
  `olRemarks` longtext,
  `olPrice` double DEFAULT '0',
  `olDiscount` double DEFAULT '0',
  PRIMARY KEY (`olID`),
  KEY `orderlists prID_idx` (`prID`),
  KEY `orderlists osID_idx` (`osID`),
  CONSTRAINT `orderlists osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderlists prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
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
  `custName` varchar(45) DEFAULT NULL,
  `osTotal` double NOT NULL,
  `payStatus` enum('paid','unpaid') NOT NULL,
  `osDateTime` datetime NOT NULL,
  `osPayDateTime` datetime NOT NULL,
  `osDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`osID`),
  KEY `ordertableCode_idx` (`tableCode`),
  CONSTRAINT `ordertableCode` FOREIGN KEY (`tableCode`) REFERENCES `tables` (`tableCode`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderslips`
--

LOCK TABLES `orderslips` WRITE;
/*!40000 ALTER TABLE `orderslips` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderslips` ENABLE KEYS */;
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
  `prName` varchar(64) NOT NULL,
  `mTemp` enum('h','c','hc') DEFAULT NULL,
  `prPrice` double NOT NULL,
  `prStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`prID`),
  KEY `preferences mID_idx` (`mID`),
  CONSTRAINT `preferences mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (1,16,'Normal',NULL,180,'available'),(2,26,'Normal',NULL,180,'available'),(3,42,'Normal',NULL,110,'available'),(4,44,'Solo','hc',85,'available'),(5,44,'Jumbo','hc',150,'available'),(6,50,'Solo',NULL,65,'available'),(7,50,'Jumbo',NULL,130,'available'),(8,57,'Normal',NULL,25,'available'),(9,4,'Normal',NULL,125,'available'),(10,10,'Normal',NULL,125,'available');
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
  `pmName` varchar(64) NOT NULL,
  `pmStartDate` date NOT NULL,
  `pmEndDate` date NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled','archived') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promos`
--

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;
INSERT INTO `promos` VALUES (1,'Graduation Promo','2019-04-30','2019-05-01',NULL,'y','enabled'),(2,'Valentines Promo','2019-02-14','2019-02-15','y',NULL,'disabled'),(3,'Christmas Promo','2019-12-24','2019-12-25','y','y','disabled');
/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
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
  KEY `spoiledmenuMsID_idx` (`msID`),
  CONSTRAINT `spoiledmenuMsID` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoiledmenuPrID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `spoiledstock`
--

DROP TABLE IF EXISTS `spoiledstock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoiledstock` (
  `ssID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `ssQty` int(11) NOT NULL,
  `ssDate` date NOT NULL,
  `ssRemarks` longtext,
  PRIMARY KEY (`ssID`,`stID`),
  KEY `spoiledmenuSID_idx` (`stID`),
  CONSTRAINT `spoiledmenuSID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoiledmenuSsiD` FOREIGN KEY (`ssID`) REFERENCES `stockspoil` (`ssID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoiledstock`
--

LOCK TABLES `spoiledstock` WRITE;
/*!40000 ALTER TABLE `spoiledstock` DISABLE KEYS */;
/*!40000 ALTER TABLE `spoiledstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockitems` (
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
  KEY `stockUomID_idx` (`uomID`),
  CONSTRAINT `stockCategoryID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON UPDATE CASCADE,
  CONSTRAINT `stockUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockitems`
--

LOCK TABLES `stockitems` WRITE;
/*!40000 ALTER TABLE `stockitems` DISABLE KEYS */;
INSERT INTO `stockitems` VALUES (1,21,3,'Chocolate Sauce',10,5,'1000ml','stockroom','available',10,'liquid'),(2,13,3,'Caramel Sauce 1000 ml',10,5,'0','stockroom','available',10,'liquid'),(3,14,3,'Strawberry Syrup 500 ml',5,5,'0','stockroom','available',5,'liquid'),(4,14,3,'Vanilla Syrup 500 ml',0,5,'0','stockroom','unavailable',0,'liquid'),(5,22,10,'Chicken Wings',15,10,'0','kitchen','available',15,'solid'),(6,24,4,'Milk 1 l',16,5,'0','stockroom','available',6,'liquid'),(7,19,6,'Coca Cola Solo 250 ml',1,1,'0','stockroom','available',1,'liquid'),(8,21,3,'Strawberry Milk Syrup',7,3,'500ml','kitchen','available',0,'liquid'),(9,21,3,'Strawberry Milk Syrup',7,3,'560ml','kitchen','available',0,'liquid'),(10,19,8,'Matcha Powder',11,2,'800mg','kitchen','unavailable',0,'solid'),(11,21,3,'new',4,2,'500l','stockroom','available',0,'liquid');
/*!40000 ALTER TABLE `stockitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocklog`
--

DROP TABLE IF EXISTS `stocklog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocklog` (
  `slID` int(11) NOT NULL AUTO_INCREMENT,
  `stID` int(11) NOT NULL,
  `tID` int(11) DEFAULT NULL,
  `slType` enum('consumed','restock','spoilage','return','other') NOT NULL,
  `slDateTime` datetime NOT NULL,
  `dateRecorded` datetime NOT NULL,
  `slQty` int(11) NOT NULL,
  `slRemarks` longtext,
  PRIMARY KEY (`slID`),
  KEY `stocklogStID_idx` (`stID`),
  KEY `stocklogTID_idx` (`tID`),
  CONSTRAINT `stocklogStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON UPDATE CASCADE,
  CONSTRAINT `stocklogTID` FOREIGN KEY (`tID`) REFERENCES `transactions` (`tID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocklog`
--

LOCK TABLES `stocklog` WRITE;
/*!40000 ALTER TABLE `stocklog` DISABLE KEYS */;
INSERT INTO `stocklog` VALUES (1,11,2,'restock','2019-06-03 08:00:00','2019-06-04 00:00:00',10,'None');
/*!40000 ALTER TABLE `stocklog` ENABLE KEYS */;
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
  `spName` varchar(45) NOT NULL,
  `spContactNum` varchar(20) NOT NULL,
  `spEmail` varchar(45) DEFAULT NULL,
  `spStatus` enum('active','inactive','archived') NOT NULL,
  `spAddress` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Coca Cola Inc.','09709052911','cocacola@email.com','active',NULL),(2,'Tiongsan','09454218542',NULL,'active','Latrinidad, Benguet'),(3,'Miya','09709052911',NULL,'active','Latrinidad, Benguet'),(4,'Roger','09709052911',NULL,'inactive','Bulacan');
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
  `spID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `spmName` varchar(45) NOT NULL,
  `spmActualQty` int(11) NOT NULL,
  `spmPrice` double NOT NULL,
  PRIMARY KEY (`spmID`),
  KEY `suppliermerchandiseSpID_idx` (`spID`),
  KEY `suppliermerchandiseStID_idx` (`stID`),
  KEY `suppliermerchandiseUomID_idx` (`uomID`),
  CONSTRAINT `suppliermerchandiseSpID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON UPDATE CASCADE,
  CONSTRAINT `suppliermerchandiseStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `suppliermerchandiseUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE
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
INSERT INTO `tables` VALUES ('t1'),('t2'),('t3'),('t4'),('t5'),('t6'),('v10'),('v11'),('v12'),('v7'),('v8'),('v9');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_items`
--

DROP TABLE IF EXISTS `trans_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_items` (
  `tiID` int(11) NOT NULL,
  `tID` int(11) NOT NULL,
  `tiQty` int(11) NOT NULL,
  `tiSubtotal` double NOT NULL,
  `tiActualQty` int(11) NOT NULL,
  PRIMARY KEY (`tiID`,`tID`),
  KEY `trans_itemsTID_idx` (`tID`),
  CONSTRAINT `trans_itemsTID` FOREIGN KEY (`tID`) REFERENCES `transactions` (`tID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_itemsTiID` FOREIGN KEY (`tiID`) REFERENCES `transitems` (`tiID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_items`
--

LOCK TABLES `trans_items` WRITE;
/*!40000 ALTER TABLE `trans_items` DISABLE KEYS */;
INSERT INTO `trans_items` VALUES (1,1,0,0,0),(2,2,0,0,0),(4,10,10,1200,3),(5,11,5,100,3),(6,12,5,250,3),(7,13,5,300,1),(8,14,5,300,1),(9,15,10,1000,2);
/*!40000 ALTER TABLE `trans_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `tID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) DEFAULT NULL,
  `tNum` varchar(64) NOT NULL,
  `tDate` date NOT NULL,
  `tType` enum('delivery receipt','purchase order','official receipt') NOT NULL,
  `dateRecorded` datetime NOT NULL,
  `tRemarks` longtext,
  PRIMARY KEY (`tID`),
  KEY `transactionsSpID_idx` (`spID`),
  CONSTRAINT `transactionsSpID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,'123434566','2019-05-27','delivery receipt','2019-05-27 00:00:00',NULL),(2,3,'02345532','2019-05-27','official receipt','2019-05-27 00:00:00',NULL),(3,1,'12','2019-06-02','purchase order','2019-06-03 00:00:00',NULL),(4,1,'1234','2019-06-03','delivery receipt','2019-06-05 00:00:00','none'),(5,1,'1234','2019-06-04','delivery receipt','2019-06-05 00:00:00','None'),(6,1,'1234','2019-06-05','delivery receipt','2019-06-06 00:00:00',' None'),(7,1,'12345','2019-06-05','delivery receipt','2019-06-06 00:00:00','NOne'),(8,1,'1234','2019-06-05','delivery receipt','2019-06-06 00:00:00','None'),(9,1,'12345','2019-06-05','delivery receipt','2019-06-06 00:00:00','None'),(10,1,'12345','2019-06-06','delivery receipt','2019-06-06 00:00:00','None'),(11,1,'1234556','2019-06-05','delivery receipt','2019-06-06 00:00:00','None'),(12,1,'1234556','2019-06-05','delivery receipt','2019-06-06 00:00:00','njhvj'),(13,1,'12345','2019-06-04','delivery receipt','2019-06-06 00:00:00','ouho'),(14,1,'12345','2019-06-04','delivery receipt','2019-06-06 00:00:00','ouho'),(15,4,'12345','2019-06-07','delivery receipt','2019-06-06 00:00:00','None');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transitems` (
  `tiID` int(11) NOT NULL AUTO_INCREMENT,
  `uomID` int(11) NOT NULL,
  `stID` int(11) DEFAULT NULL,
  `tiName` varchar(45) NOT NULL,
  `tiPrice` double NOT NULL DEFAULT '0',
  `tiDiscount` double DEFAULT '0',
  `tiStatus` enum('pending','partially delivered','delivered','paid') DEFAULT NULL,
  PRIMARY KEY (`tiID`),
  KEY `transitemsUomID_idx` (`uomID`),
  KEY `transitemsStID_idx` (`stID`),
  CONSTRAINT `transitemsStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON UPDATE CASCADE,
  CONSTRAINT `transitemsUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transitems`
--

LOCK TABLES `transitems` WRITE;
/*!40000 ALTER TABLE `transitems` DISABLE KEYS */;
INSERT INTO `transitems` VALUES (1,6,7,'Coca Cola Solo 250 ml',850,NULL,NULL),(2,4,6,'Nestle Milk 1 l',100,NULL,NULL),(3,6,2,'New Merchandise',10,NULL,'delivered'),(4,6,3,'Coffee Beans',120,NULL,'delivered'),(5,6,1,'New Merchandise',20,NULL,'delivered'),(6,5,3,'New Merchandise',50,NULL,'delivered'),(7,4,6,'Milk',60,NULL,'delivered'),(8,4,6,'Milk',60,NULL,'delivered'),(9,5,6,'Nestle Milk 1000ml',100,NULL,'delivered');
/*!40000 ALTER TABLE `transitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uom`
--

DROP TABLE IF EXISTS `uom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uom` (
  `uomID` int(11) NOT NULL AUTO_INCREMENT,
  `uomName` varchar(45) NOT NULL,
  `uomAbbreviation` varchar(45) NOT NULL,
  `uomVariant` enum('liquid','solid') DEFAULT NULL,
  `uomStore` enum('single','set') DEFAULT NULL,
  PRIMARY KEY (`uomID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uom`
--

LOCK TABLES `uom` WRITE;
/*!40000 ALTER TABLE `uom` DISABLE KEYS */;
INSERT INTO `uom` VALUES (1,'mililiter','ml','liquid',NULL),(2,'liter','l','liquid',NULL),(3,'bottle','bt',NULL,'single'),(4,'carton','ct',NULL,'set'),(5,'box','bx',NULL,'set'),(6,'case','cs',NULL,'set'),(7,'bag','bg',NULL,'single'),(8,'pack','pck',NULL,'single'),(9,'slice','sc',NULL,'single'),(10,'piece','pc',NULL,'single'),(11,'miligrams','mg','solid',NULL),(12,'kilograms','kg','solid',NULL);
/*!40000 ALTER TABLE `uom` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-06 11:14:42
