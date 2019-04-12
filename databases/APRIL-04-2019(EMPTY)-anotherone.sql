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
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` enum('Admin','Barista','Chef','Customer') NOT NULL,
  `account_username` varchar(45) NOT NULL,
  `account_password` char(64) NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'Admin','manager','manager',0),(2,'Customer','customer','customer',0),(3,'Barista','barista','barista',0),(4,'Chef','chef','chef',0);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addons` (
  `ao_id` int(11) NOT NULL AUTO_INCREMENT,
  `ao_name` varchar(45) NOT NULL,
  `ao_category` enum('Drink','Food','Others') NOT NULL,
  `ao_price` double NOT NULL DEFAULT '0',
  `ao_status` enum('enabled','disabled') NOT NULL,
  PRIMARY KEY (`ao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
INSERT INTO `addons` VALUES (1,'milk','Drink',20,'enabled'),(2,'Extra shot','Drink',20,'enabled');
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ao_spoil`
--

DROP TABLE IF EXISTS `ao_spoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ao_spoil` (
  `s_id` int(11) NOT NULL,
  `ao_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `addon_idx` (`ao_id`),
  CONSTRAINT `addon` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON UPDATE CASCADE,
  CONSTRAINT `spoilage` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ao_spoil`
--

LOCK TABLES `ao_spoil` WRITE;
/*!40000 ALTER TABLE `ao_spoil` DISABLE KEYS */;
/*!40000 ALTER TABLE `ao_spoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `supcat_id` int(11) DEFAULT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_type` enum('menu','inventory') NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `maincat_idx` (`supcat_id`),
  CONSTRAINT `maincat` FOREIGN KEY (`supcat_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Meals','menu'),(2,NULL,'Drinks','menu'),(3,NULL,'Desserts','menu'),(4,1,'Ala Cart','menu'),(5,2,'Brewed','menu'),(8,2,'Frappe','menu'),(9,2,'Tea','menu'),(10,2,'Espresso based','menu'),(11,NULL,'Sauce','inventory'),(12,NULL,'Syrup','inventory'),(13,NULL,'Powder','inventory'),(14,NULL,'Beans','inventory'),(15,NULL,'Tea','inventory'),(16,NULL,'Bottled Beverages','inventory'),(17,NULL,'Dairy','inventory'),(18,NULL,'Cake','inventory'),(19,NULL,'Meat','inventory'),(20,NULL,'Pasta','inventory');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `promo_id` int(11) NOT NULL,
  `dc_name` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`),
  CONSTRAINT `d_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,'- 20%'),(5,'- 20%');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freebie`
--

DROP TABLE IF EXISTS `freebie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freebie` (
  `promo_id` int(11) NOT NULL,
  `freebie_name` varchar(45) NOT NULL,
  `elective` enum('0','1') NOT NULL,
  PRIMARY KEY (`promo_id`),
  CONSTRAINT `freebie_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freebie`
--

LOCK TABLES `freebie` WRITE;
/*!40000 ALTER TABLE `freebie` DISABLE KEYS */;
INSERT INTO `freebie` VALUES (4,'Buy 1 Take 1','1'),(5,'Buy 1 Take 1','0');
/*!40000 ALTER TABLE `freebie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemadd`
--

DROP TABLE IF EXISTS `itemadd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemadd` (
  `menu_id` int(11) NOT NULL,
  `ao_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`ao_id`),
  KEY `additem_idx` (`ao_id`),
  CONSTRAINT `additem` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `itemadd` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemadd`
--

LOCK TABLES `itemadd` WRITE;
/*!40000 ALTER TABLE `itemadd` DISABLE KEYS */;
INSERT INTO `itemadd` VALUES (8,1),(12,2);
/*!40000 ALTER TABLE `itemadd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `log_qty` int(11) NOT NULL,
  `log_type` enum('restock','destock') NOT NULL,
  `log_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`log_id`),
  KEY `transaction_idx` (`trans_id`),
  KEY `logStockItem_idx` (`stock_id`),
  CONSTRAINT `logStockItem` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE,
  CONSTRAINT `transaction` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `menu_name` varchar(64) NOT NULL,
  `menu_description` longtext,
  `menu_availability` enum('available','temp unavailable','unavailable') NOT NULL DEFAULT 'available',
  `menu_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `category_idx` (`category_id`),
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (8,5,'Benguet','Brewed Benguet coffee beans (menu w/ size)','available',NULL),(9,4,'Animal Fries','Potato Fries','available',NULL),(10,9,'Pakpakyaw (Butterfly) Pea','tea siya (menu w/ temparature and different price)','available',NULL),(11,8,'Matcha','Matcha Frappe','available',NULL),(12,10,'Americano','americano espresso (menu w/ temperature)','available',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_discount`
--

DROP TABLE IF EXISTS `menu_discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_discount` (
  `promo_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `dc_amt` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`,`pref_id`),
  KEY `md_pref_id_idx` (`pref_id`),
  CONSTRAINT `md_pref_id` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `md_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_discount`
--

LOCK TABLES `menu_discount` WRITE;
/*!40000 ALTER TABLE `menu_discount` DISABLE KEYS */;
INSERT INTO `menu_discount` VALUES (1,15,'16'),(1,16,'16'),(5,19,'20');
/*!40000 ALTER TABLE `menu_discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_freebie`
--

DROP TABLE IF EXISTS `menu_freebie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_freebie` (
  `promo_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `fb_qty` int(11) NOT NULL,
  `fb_price` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`,`pref_id`),
  KEY `mn_pref_id_idx` (`pref_id`),
  CONSTRAINT `mf_pref_id` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mf_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_freebie`
--

LOCK TABLES `menu_freebie` WRITE;
/*!40000 ALTER TABLE `menu_freebie` DISABLE KEYS */;
INSERT INTO `menu_freebie` VALUES (4,19,1,'0'),(4,20,1,'0'),(5,19,1,'0');
/*!40000 ALTER TABLE `menu_freebie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuspoil`
--

DROP TABLE IF EXISTS `menuspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuspoil` (
  `s_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `menu_item_idx` (`menu_id`),
  CONSTRAINT `menu_item` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE,
  CONSTRAINT `menuspoilage` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE
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
-- Table structure for table `orderadd`
--

DROP TABLE IF EXISTS `orderadd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderadd` (
  `order_item_id` int(11) NOT NULL,
  `ao_id` int(11) NOT NULL,
  `ao_qty` int(11) NOT NULL,
  `ao_total` double NOT NULL,
  PRIMARY KEY (`order_item_id`,`ao_id`),
  KEY `addon_idx` (`ao_id`),
  CONSTRAINT `itemaddon` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON UPDATE CASCADE,
  CONSTRAINT `orderitemforaddon` FOREIGN KEY (`order_item_id`) REFERENCES `orderlist` (`order_item_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderadd`
--

LOCK TABLES `orderadd` WRITE;
/*!40000 ALTER TABLE `orderadd` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderadd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderlist`
--

DROP TABLE IF EXISTS `orderlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderlist` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `order_desc` varchar(50) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `item_status` enum('pending','ongoing','done','served') NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`order_item_id`),
  KEY `orderslip_idx` (`order_id`),
  KEY `preferences_idx` (`pref_id`),
  CONSTRAINT `orderslip` FOREIGN KEY (`order_id`) REFERENCES `orderslip` (`order_id`) ON UPDATE CASCADE,
  CONSTRAINT `preferences` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderlist`
--

LOCK TABLES `orderlist` WRITE;
/*!40000 ALTER TABLE `orderlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderslip`
--

DROP TABLE IF EXISTS `orderslip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderslip` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_code` varchar(5) DEFAULT NULL,
  `cust_name` varchar(45) DEFAULT NULL,
  `total` double NOT NULL,
  `order_date` date NOT NULL,
  `pay_date_time` datetime DEFAULT NULL,
  `date_recorded` date NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `table_idx` (`table_code`),
  CONSTRAINT `table` FOREIGN KEY (`table_code`) REFERENCES `tables` (`table_code`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderslip`
--

LOCK TABLES `orderslip` WRITE;
/*!40000 ALTER TABLE `orderslip` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderslip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_items`
--

DROP TABLE IF EXISTS `po_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po_items` (
  `po_id` int(11) NOT NULL,
  `item_name` varchar(45) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_unit` varchar(45) NOT NULL,
  `item_price` double NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`po_id`,`item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_items`
--

LOCK TABLES `po_items` WRITE;
/*!40000 ALTER TABLE `po_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `po_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferences` (
  `pref_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `size_name` varchar(45) NOT NULL DEFAULT 'Normal',
  `size_status` enum('enabled','disabled') NOT NULL,
  `temp` enum('h','c') DEFAULT NULL,
  `pref_price` double NOT NULL,
  PRIMARY KEY (`pref_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `item` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (13,8,'Solo','enabled',NULL,60),(14,8,'Jumbo','enabled',NULL,110),(15,12,'Normal','enabled','h',80),(16,12,'Normal','enabled','c',80),(17,10,'Normal','enabled','h',110),(18,10,'Normal','enabled','c',110),(19,9,'Normal','enabled',NULL,100),(20,11,'Normal','enabled',NULL,140);
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_name` varchar(45) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` VALUES (1,'March Promo','2019-03-01 00:00:00','2019-03-30 00:00:00','y',NULL,'enabled'),(4,'Graduation Promo','2019-03-22 00:00:00','2019-03-30 00:00:00',NULL,'y','enabled'),(5,'Panagbenga Promo','2019-03-01 00:00:00','2019-03-04 00:00:00','y','y','enabled');
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_cons`
--

DROP TABLE IF EXISTS `promo_cons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_cons` (
  `promo_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `pc_type` enum('f','d','fd') NOT NULL,
  `pc_qty` int(11) NOT NULL,
  PRIMARY KEY (`promo_id`,`pref_id`),
  KEY `pc_menu_id_idx` (`pref_id`),
  CONSTRAINT `pc_pref_id` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pc_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_cons`
--

LOCK TABLES `promo_cons` WRITE;
/*!40000 ALTER TABLE `promo_cons` DISABLE KEYS */;
INSERT INTO `promo_cons` VALUES (1,15,'d',1),(1,16,'d',1),(4,13,'f',1),(4,14,'f',1),(5,19,'fd',1);
/*!40000 ALTER TABLE `promo_cons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_orders` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `ed_date` date DEFAULT NULL,
  `po_status` enum('pending','delivered') NOT NULL DEFAULT 'pending',
  `po_amt_payable` double NOT NULL,
  PRIMARY KEY (`po_id`),
  KEY `supplier_idx` (`source_id`),
  CONSTRAINT `supplier` FOREIGN KEY (`source_id`) REFERENCES `sources` (`source_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `returns` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `date_recorded` date NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `return_transaction_idx` (`trans_id`),
  KEY `returnedStock_idx` (`stock_id`),
  CONSTRAINT `return_transaction` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON UPDATE CASCADE,
  CONSTRAINT `returnedStock` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returns`
--

LOCK TABLES `returns` WRITE;
/*!40000 ALTER TABLE `returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sources`
--

DROP TABLE IF EXISTS `sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sources` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(45) NOT NULL,
  `contact_num` varchar(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sources`
--

LOCK TABLES `sources` WRITE;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;
/*!40000 ALTER TABLE `sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spoilage`
--

DROP TABLE IF EXISTS `spoilage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoilage` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_type` enum('a','m','s') NOT NULL,
  `s_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `s_qty` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoilage`
--

LOCK TABLES `spoilage` WRITE;
/*!40000 ALTER TABLE `spoilage` DISABLE KEYS */;
/*!40000 ALTER TABLE `spoilage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockitems` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `stock_name` varchar(45) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `stock_unit` varchar(10) NOT NULL,
  `stock_minimum` int(11) DEFAULT NULL,
  `stock_status` enum('available','temp unavailable','unavailable') NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `categoryid_idx` (`category_id`),
  CONSTRAINT `categoryid` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockitems`
--

LOCK TABLES `stockitems` WRITE;
/*!40000 ALTER TABLE `stockitems` DISABLE KEYS */;
INSERT INTO `stockitems` VALUES (1,11,'Chocolate',0,'Bottle',0,'temp unavailable'),(2,11,'Caramel',0,'Bottle',0,'temp unavailable'),(3,11,'Strawberry',0,'Bottle',0,'temp unavailable'),(4,12,'Hazelnut',0,'Bottle',0,'temp unavailable'),(5,12,'Vanilla',0,'Bottle',0,'temp unavailable'),(6,13,'Matcha',0,'Bag',0,'temp unavailable'),(7,14,'Espresso',0,'Bag (kg.)',0,'temp unavailable'),(8,14,'Benguet',0,'Bag (kg.)',0,'temp unavailable'),(9,14,'Kalinga',0,'Bag (kg.)',0,'temp unavailable'),(10,14,'Sagada',0,'Bag (kg.)',0,'temp unavailable'),(11,14,'Cordillera City (Medium) Roast',0,'Bag (kg.)',0,'temp unavailable'),(12,14,'Vienna (Dark) Roast',0,'Bag (kg.)',0,'temp unavailable'),(13,15,'Honey-Coated Lemon',0,'Bag',0,'temp unavailable'),(14,15,'Chamomile',0,'Bag',0,'temp unavailable'),(15,15,'Pakpakyaw (Butterfly) Pea',0,'Bag',0,'temp unavailable'),(16,16,'Mango',0,'Bottle',0,'temp unavailable'),(17,16,'Pineapple',0,'Bottle',0,'temp unavailable'),(18,16,'Water',0,'Bottle',0,'temp unavailable'),(19,16,'Coke',0,'Bottle',0,'temp unavailable'),(20,16,'Sprite',0,'Bottle',0,'temp unavailable'),(21,16,'Royal',0,'Bottle',0,'temp unavailable'),(22,17,'Whipped Cream',0,'Bottle',0,'temp unavailable'),(23,17,'Milk',0,'Carton',0,'temp unavailable'),(24,11,'Pesto',0,'Pack',0,'temp unavailable'),(25,11,'Carbonara',0,'Pack',0,'temp unavailable'),(26,11,'Italian',0,'Pack',0,'temp unavailable'),(27,19,'Baby Back',0,'Piece',0,'temp unavailable'),(28,19,'Chicken',0,'Piece',0,'temp unavailable'),(29,19,'Chicken Wings',0,'Piece',0,'temp unavailable'),(30,19,'Burger Patty',0,'Piece',0,'temp unavailable'),(31,20,'Fettuccine',0,'Pack',0,'temp unavailable'),(32,20,'Linguine',0,'Pack',0,'temp unavailable'),(33,20,'Sphagetti',0,'Pack',0,'temp unavailable');
/*!40000 ALTER TABLE `stockitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockspoil`
--

DROP TABLE IF EXISTS `stockspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockspoil` (
  `s_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `stockspoil_idx` (`stock_id`),
  CONSTRAINT `spoilagereference` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoiledstock` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE
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
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables` (
  `table_code` varchar(5) NOT NULL,
  PRIMARY KEY (`table_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES ('T1');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `receipt_no` varchar(45) NOT NULL,
  `total` double NOT NULL,
  `trans_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`trans_id`),
  KEY `source_idx` (`source_id`),
  CONSTRAINT `source` FOREIGN KEY (`source_id`) REFERENCES `sources` (`source_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transitems` (
  `trans_id` int(11) NOT NULL,
  `item_name` varchar(45) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_unit` varchar(45) NOT NULL,
  `item_price` double NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`trans_id`,`item_name`),
  CONSTRAINT `trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transitems`
--

LOCK TABLES `transitems` WRITE;
/*!40000 ALTER TABLE `transitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `transitems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-11 15:56:37
