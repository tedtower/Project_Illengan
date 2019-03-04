-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 27, 2019 at 02:14 AM
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
-- Database: `illengan`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` enum('Admin','Barista','Chef','Customer') NOT NULL,
  `account_username` varchar(45) NOT NULL,
  `account_password` varchar(45) NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE IF NOT EXISTS `addons` (
  `ao_id` int(11) NOT NULL AUTO_INCREMENT,
  `ao_name` varchar(45) NOT NULL,
  `ao_category` enum('Drink','Food') NOT NULL,
  `ao_price` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ao_spoil`
--

DROP TABLE IF EXISTS `ao_spoil`;
CREATE TABLE IF NOT EXISTS `ao_spoil` (
  `s_id` int(11) NOT NULL,
  `ao_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `addon_idx` (`ao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcat_id` int(11) DEFAULT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_type` enum('menu','inventory') NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `maincat_idx` (`subcat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `dc_id` int(11) NOT NULL AUTO_INCREMENT,
  `dc_percentage` double NOT NULL DEFAULT '0',
  `dc_name` varchar(45) NOT NULL,
  PRIMARY KEY (`dc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemadd`
--

DROP TABLE IF EXISTS `itemadd`;
CREATE TABLE IF NOT EXISTS `itemadd` (
  `menu_id` int(11) NOT NULL,
  `ao_id` int(11) NOT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  PRIMARY KEY (`menu_id`,`ao_id`),
  KEY `additem_idx` (`ao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemdis`
--

DROP TABLE IF EXISTS `itemdis`;
CREATE TABLE IF NOT EXISTS `itemdis` (
  `dc_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  PRIMARY KEY (`dc_id`,`menu_id`),
  KEY `menuitemdis_idx` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `log_qty` int(11) NOT NULL,
  `log_type` enum('restock','destock') NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`log_id`),
  KEY `stockitem_idx` (`stock_id`),
  KEY `transaction_idx` (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `menu_name` varchar(45) NOT NULL,
  `menu_description` longtext,
  `menu_availability` enum('available','temp unavailable','unavailable') NOT NULL DEFAULT 'unavailable',
  `menu_image` varchar(50) DEFAULT NULL,
  `temp` enum('h','c','hc') NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `category_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menuspoil`
--

DROP TABLE IF EXISTS `menuspoil`;
CREATE TABLE IF NOT EXISTS `menuspoil` (
  `s_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `menu_item_idx` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderadd`
--

DROP TABLE IF EXISTS `orderadd`;
CREATE TABLE IF NOT EXISTS `orderadd` (
  `order_item_id` int(11) NOT NULL,
  `ao_id` int(11) NOT NULL,
  `ao_qty` int(11) NOT NULL,
  `ao_total` double NOT NULL,
  PRIMARY KEY (`order_item_id`,`ao_id`),
  KEY `addon_idx` (`ao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

DROP TABLE IF EXISTS `orderlist`;
CREATE TABLE IF NOT EXISTS `orderlist` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_total` double NOT NULL,
  `item_status` enum('pending','ongoing','done','served') NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`order_item_id`),
  KEY `orderslip_idx` (`order_id`),
  KEY `menu_idx` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderslip`
--

DROP TABLE IF EXISTS `orderslip`;
CREATE TABLE IF NOT EXISTS `orderslip` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_code` varchar(5) DEFAULT NULL,
  `cust_name` varchar(45) DEFAULT NULL,
  `order_payable` double NOT NULL,
  `order_date` date NOT NULL,
  `pay_date_time` datetime DEFAULT NULL,
  `date_recorded` date NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `table_idx` (`table_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE IF NOT EXISTS `returns` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `return_qty` double NOT NULL,
  `return_unit` varchar(10) NOT NULL,
  `return_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `stock_idx` (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `menu_id` int(11) NOT NULL,
  `size_name` varchar(45) NOT NULL,
  `size_price` double NOT NULL,
  PRIMARY KEY (`menu_id`,`size_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

DROP TABLE IF EXISTS `sources`;
CREATE TABLE IF NOT EXISTS `sources` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(45) NOT NULL,
  `contact_num` varchar(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spoilage`
--

DROP TABLE IF EXISTS `spoilage`;
CREATE TABLE IF NOT EXISTS `spoilage` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_type` enum('a','m','s') NOT NULL,
  `s_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
CREATE TABLE IF NOT EXISTS `stockitems` (
  `stock_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock_name` varchar(45) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `stock_unit` varchar(10) NOT NULL,
  `stock_minimum` int(11) DEFAULT NULL,
  `stock_status` enum('available','temp unavailable','unavailable') NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `categoryid_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockspoil`
--

DROP TABLE IF EXISTS `stockspoil`;
CREATE TABLE IF NOT EXISTS `stockspoil` (
  `s_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `stock_idx` (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `table_code` varchar(5) NOT NULL,
  PRIMARY KEY (`table_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `receipt_no` varchar(45) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `total_amount` double NOT NULL,
  `status` enum('pending','delivered') NOT NULL DEFAULT 'pending',
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`trans_id`),
  KEY `source_idx` (`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
CREATE TABLE IF NOT EXISTS `transitems` (
  `trans_id` int(11) NOT NULL,
  `unit_name` varchar(45) NOT NULL,
  `unit_qty` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_price` double NOT NULL,
  PRIMARY KEY (`trans_id`,`unit_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ao_spoil`
--
ALTER TABLE `ao_spoil`
  ADD CONSTRAINT `addon` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `spoilage` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `maincat` FOREIGN KEY (`subcat_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `itemadd`
--
ALTER TABLE `itemadd`
  ADD CONSTRAINT `additem` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemadd` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `itemdis`
--
ALTER TABLE `itemdis`
  ADD CONSTRAINT `discount` FOREIGN KEY (`dc_id`) REFERENCES `discounts` (`dc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menuitemdis` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `stockitem` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `menuspoil`
--
ALTER TABLE `menuspoil`
  ADD CONSTRAINT `menu_item` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `menuspoilage` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderadd`
--
ALTER TABLE `orderadd`
  ADD CONSTRAINT `itemaddon` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderitem` FOREIGN KEY (`order_item_id`) REFERENCES `orderlist` (`order_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderslip` FOREIGN KEY (`order_id`) REFERENCES `orderslip` (`order_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orderslip`
--
ALTER TABLE `orderslip`
  ADD CONSTRAINT `table` FOREIGN KEY (`table_code`) REFERENCES `tables` (`table_code`) ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `stockreturn` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `item` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `stockitems`
--
ALTER TABLE `stockitems`
  ADD CONSTRAINT `categoryid` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `stockspoil`
--
ALTER TABLE `stockspoil`
  ADD CONSTRAINT `stock` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stockspoil` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `source` FOREIGN KEY (`source_id`) REFERENCES `sources` (`source_id`) ON UPDATE CASCADE;

--
-- Constraints for table `transitems`
--
ALTER TABLE `transitems`
  ADD CONSTRAINT `trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;