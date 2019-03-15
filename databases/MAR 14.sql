-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: illengan2
-- ------------------------------------------------------
-- Server version	5.7.19

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
  `account_password` varchar(45) NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'Admin','admin','admin',0),(2,'Barista','barista','barista',0),(3,'Chef','chef','chef',0),(4,'Customer','customer','customer',0);
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
  `ao_category` enum('Drink','Food') NOT NULL,
  `ao_price` double NOT NULL DEFAULT '0',
  `ao_status` enum('enabled','disabled') NOT NULL,
  PRIMARY KEY (`ao_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'main','menu'),(2,1,'sub','menu');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `dc_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `dc_percentage` double NOT NULL DEFAULT '0',
  `dc_name` varchar(45) NOT NULL,
  PRIMARY KEY (`dc_id`),
  UNIQUE KEY `promo_id` (`promo_id`)
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
-- Table structure for table `freebie`
--

DROP TABLE IF EXISTS `freebie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freebie` (
  `promo_id` int(11) NOT NULL,
  `freebie_name` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freebie`
--

LOCK TABLES `freebie` WRITE;
/*!40000 ALTER TABLE `freebie` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `itemadd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemdis`
--

DROP TABLE IF EXISTS `itemdis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemdis` (
  `dc_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  PRIMARY KEY (`dc_id`,`menu_id`),
  KEY `menuitemdis_idx` (`menu_id`),
  CONSTRAINT `discount` FOREIGN KEY (`dc_id`) REFERENCES `discounts` (`dc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menuitemdis` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemdis`
--

LOCK TABLES `itemdis` WRITE;
/*!40000 ALTER TABLE `itemdis` DISABLE KEYS */;
/*!40000 ALTER TABLE `itemdis` ENABLE KEYS */;
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
  `menu_name` varchar(45) NOT NULL,
  `menu_description` longtext,
  `menu_availability` enum('available','temp unavailable','unavailable') NOT NULL DEFAULT 'unavailable',
  `menu_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `category_idx` (`category_id`),
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,1,'Hazelnut Frappe','This is a hazelnut frappe','available','Coffee2.jpg'),(2,1,'Caramel Espresso','This is a Caramel Espresso','available','coffee.jpg'),(3,1,'Benguet French-Pressed (Brewed)','This is a Benguet French-Pressed (Brewed)','available','coffee.jpg'),(4,1,'Hot Choco','This is a hot choco','unavailable','coffee.jpg'),(5,1,'Wicked Oreos','This is a Wicked Oreo','temp unavailable','food.jpg'),(6,1,'Buffalo Wings','This is Buffalo Wings','temp unavailable',NULL);
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
  `menu_id` int(11) NOT NULL,
  `dc_amt` double NOT NULL,
  PRIMARY KEY (`promo_id`,`menu_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_discount`
--

LOCK TABLES `menu_discount` WRITE;
/*!40000 ALTER TABLE `menu_discount` DISABLE KEYS */;
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
  `menu_id` int(11) NOT NULL,
  `fb_qty` int(11) NOT NULL,
  `fb_price` double NOT NULL,
  PRIMARY KEY (`promo_id`,`menu_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_freebie`
--

LOCK TABLES `menu_freebie` WRITE;
/*!40000 ALTER TABLE `menu_freebie` DISABLE KEYS */;
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
  `menu_id` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_total` double NOT NULL,
  `item_status` enum('pending','ongoing','done','served') NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`order_item_id`),
  KEY `orderslip_idx` (`order_id`),
  KEY `menu_idx` (`menu_id`),
  CONSTRAINT `menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE,
  CONSTRAINT `orderslip` FOREIGN KEY (`order_id`) REFERENCES `orderslip` (`order_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderlist`
--

LOCK TABLES `orderlist` WRITE;
/*!40000 ALTER TABLE `orderlist` DISABLE KEYS */;
INSERT INTO `orderlist` VALUES (1,1117,1,2,260,'served','less sugar'),(2,1118,3,2,260,'served',NULL),(3,1119,2,3,390,'served',NULL),(4,1120,2,1,130,'served',NULL),(5,1121,2,3,390,'served','less sugar'),(6,1122,1,1,130,'served','more sugar');
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
  `order_payable` double NOT NULL,
  `order_date` date NOT NULL,
  `pay_date_time` datetime DEFAULT NULL,
  `date_recorded` date NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `table_idx` (`table_code`),
  CONSTRAINT `table` FOREIGN KEY (`table_code`) REFERENCES `tables` (`table_code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1123 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderslip`
--

LOCK TABLES `orderslip` WRITE;
/*!40000 ALTER TABLE `orderslip` DISABLE KEYS */;
INSERT INTO `orderslip` VALUES (1117,'v1','Krystal',260,'2019-02-28','2019-02-28 12:30:25','2019-02-28'),(1118,'v2','Anne',260,'2019-02-15','2019-02-15 01:20:10','2019-02-15'),(1119,'t1','Justin',390,'2019-02-20','2019-02-20 03:15:05','2019-02-20'),(1120,'t2','Erika',130,'2019-03-01','2019-03-01 11:32:44','2019-03-01'),(1121,'t1','anne',390,'2019-03-05','2019-03-05 04:00:00','2019-03-05'),(1122,'t3','Jared',130,'2019-03-11','2019-03-11 02:45:00','2019-03-11');
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
  `pref_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `size_name` varchar(45) NOT NULL DEFAULT 'Default',
  `size_price` double NOT NULL,
  `size_status` enum('enabled','disabled') NOT NULL,
  `temp` enum('h','o') DEFAULT NULL,
  `pref_price` double NOT NULL,
  PRIMARY KEY (`pref_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `item` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE
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
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo` (
  `promo_id` int(11) NOT NULL,
  `promo_name` varchar(45) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `freebie` enum('y','n') NOT NULL,
  `discount` enum('y','n') NOT NULL,
  `status` enum('enabled','disabled') NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
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
  `menu_id` int(11) NOT NULL,
  `pc_type` enum('discount','freebie') NOT NULL,
  `pc_qty` int(11) NOT NULL,
  PRIMARY KEY (`promo_id`,`menu_id`,`pc_type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_cons`
--

LOCK TABLES `promo_cons` WRITE;
/*!40000 ALTER TABLE `promo_cons` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockitems`
--

LOCK TABLES `stockitems` WRITE;
/*!40000 ALTER TABLE `stockitems` DISABLE KEYS */;
INSERT INTO `stockitems` VALUES (1,1,'Hazelnut Syrup',3,'per bottle',1,'available'),(2,1,'Matcha Powder',3,'per bag',2,'available'),(3,1,'Milk',5,'per carton',3,'available'),(4,1,'Coke Soda',5,'per bottle',5,'temp unavailable'),(5,1,'Benguet Beans',3,'per bag',2,'unavailable'),(6,1,'Kalinga Beans',3,'per bag',2,'temp unavailable');
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
INSERT INTO `tables` VALUES ('t1'),('t2'),('t3'),('v1'),('v2');
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
  `trans_amt` double NOT NULL,
  `trans_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`trans_id`),
  KEY `source_idx` (`source_id`),
  CONSTRAINT `source` FOREIGN KEY (`source_id`) REFERENCES `sources` (`source_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,NULL,'1100',100,'2019-01-02','2019-01-02',NULL),(2,NULL,'1200',200,'2019-02-02','2019-02-02',NULL);
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
  PRIMARY KEY (`trans_id`,`item_name`),
  CONSTRAINT `trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transitems`
--

LOCK TABLES `transitems` WRITE;
/*!40000 ALTER TABLE `transitems` DISABLE KEYS */;
INSERT INTO `transitems` VALUES (1,'goodbye',2,'pack',10),(1,'hello',2,'pack',10),(1,'nevermind',2,'pack',10),(1,'peanut',2,'pack',20);
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

-- Dump completed on 2019-03-14 23:16:56
