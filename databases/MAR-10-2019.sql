-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 09, 2019 at 03:24 PM
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
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` enum('Admin','Barista','Chef','Customer') NOT NULL,
  `account_username` varchar(45) NOT NULL,
  `account_password` varchar(45) NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_type`, `account_username`, `account_password`, `is_online`) VALUES
(1, 'Admin', 'admin', 'admin', 0),
(2, 'Barista', 'barista', 'barista', 0),
(3, 'Chef', 'chef', 'chef', 0),
(4, 'Customer', 'customer', 'customer', 0);

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
  `ao_status` enum('enabled','disabled') NOT NULL,
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
  `supcat_id` int(11) DEFAULT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_type` enum('menu','inventory') NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `maincat_idx` (`supcat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `supcat_id`, `category_name`, `category_type`) VALUES
(1, NULL, 'main', 'menu'),
(2, 1, 'sub', 'menu');

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
  `stock_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `log_qty` int(11) NOT NULL,
  `log_type` enum('restock','destock') NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`log_id`),
  KEY `transaction_idx` (`trans_id`),
  KEY `logStockItem_idx` (`stock_id`)
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
  `temp` enum('h','c','hc') DEFAULT NULL,
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
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `po_items`
--

DROP TABLE IF EXISTS `po_items`;
CREATE TABLE IF NOT EXISTS `po_items` (
  `po_id` int(11) NOT NULL,
  `item_name` varchar(45) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_unit` varchar(45) NOT NULL,
  `item_price` double NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`po_id`,`item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `ed_date` date DEFAULT NULL,
  `po_status` enum('pending','delivered') NOT NULL DEFAULT 'pending',
  `po_amt_payable` double NOT NULL,
  PRIMARY KEY (`po_id`),
  KEY `supplier_idx` (`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE IF NOT EXISTS `returns` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `date_recorded` date NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `return_transaction_idx` (`trans_id`),
  KEY `returnedStock_idx` (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `menu_id` int(11) NOT NULL,
  `size_name` varchar(45) NOT NULL DEFAULT 'Default',
  `size_price` double NOT NULL,
  `size_status` enum('enabled','disabled') NOT NULL,
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
  `s_qty` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
CREATE TABLE IF NOT EXISTS `stockitems` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
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
  KEY `stockspoil_idx` (`stock_id`)
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
  `receipt_no` varchar(45) NOT NULL,
  `trans_amt` double NOT NULL,
  `trans_date` date NOT NULL,
  `date_recorded` date NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`trans_id`),
  KEY `source_idx` (`source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `source_id`, `receipt_no`, `trans_amt`, `trans_date`, `date_recorded`, `remarks`) VALUES
(1, NULL, '1100', 100, '2019-01-02', '2019-01-02', NULL),
(2, NULL, '1200', 200, '2019-02-02', '2019-02-02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
CREATE TABLE IF NOT EXISTS `transitems` (
  `trans_id` int(11) NOT NULL,
  `item_name` varchar(45) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_unit` varchar(45) NOT NULL,
  `item_price` double NOT NULL,
  PRIMARY KEY (`trans_id`,`item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transitems`
--

INSERT INTO `transitems` (`trans_id`, `item_name`, `item_qty`, `item_unit`, `item_price`) VALUES
(1, 'goodbye', 2, 'pack', 10),
(1, 'hello', 2, 'pack', 10),
(1, 'nevermind', 2, 'pack', 10),
(1, 'peanut', 2, 'pack', 20);

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
  ADD CONSTRAINT `maincat` FOREIGN KEY (`supcat_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `logStockItem` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `orderitemforaddon` FOREIGN KEY (`order_item_id`) REFERENCES `orderlist` (`order_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `supplier` FOREIGN KEY (`source_id`) REFERENCES `sources` (`source_id`) ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `return_transaction` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`trans_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `returnedStock` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `spoilagereference` FOREIGN KEY (`s_id`) REFERENCES `spoilage` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spoiledstock` FOREIGN KEY (`stock_id`) REFERENCES `stockitems` (`stock_id`) ON UPDATE CASCADE;

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
