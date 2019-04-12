-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 12, 2019 at 06:26 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

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
  `account_password` char(64) NOT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_type`, `account_username`, `account_password`, `is_online`) VALUES
(1, 'Admin', 'manager', 'manager', 0),
(2, 'Customer', 'customer', 'customer', 0),
(3, 'Barista', 'barista', 'barista', 0),
(4, 'Chef', 'chef', 'chef', 0);

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE IF NOT EXISTS `addons` (
  `ao_id` int(11) NOT NULL AUTO_INCREMENT,
  `ao_name` varchar(45) NOT NULL,
  `ao_category` enum('Drink','Food','Others') NOT NULL,
  `ao_price` double NOT NULL DEFAULT '0',
  `ao_status` enum('enabled','disabled') NOT NULL,
  PRIMARY KEY (`ao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`ao_id`, `ao_name`, `ao_category`, `ao_price`, `ao_status`) VALUES
(1, 'milk', 'Drink', 20, 'enabled'),
(2, 'Extra shot', 'Drink', 20, 'enabled');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `supcat_id`, `category_name`, `category_type`) VALUES
(1, NULL, 'Meals', 'menu'),
(2, NULL, 'Drinks', 'menu'),
(3, NULL, 'Desserts', 'menu'),
(4, 1, 'Ala Cart', 'menu'),
(5, 2, 'Brewed', 'menu'),
(8, 2, 'Frappe', 'menu'),
(9, 2, 'Tea', 'menu'),
(10, 2, 'Espresso based', 'menu'),
(11, NULL, 'Sauce', 'inventory'),
(12, NULL, 'Syrup', 'inventory'),
(13, NULL, 'Powder', 'inventory'),
(14, NULL, 'Beans', 'inventory'),
(15, NULL, 'Tea', 'inventory'),
(16, NULL, 'Bottled Beverages', 'inventory'),
(17, NULL, 'Dairy', 'inventory'),
(18, NULL, 'Cake', 'inventory'),
(19, NULL, 'Meat', 'inventory'),
(20, NULL, 'Pasta', 'inventory');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `promo_id` int(11) NOT NULL,
  `dc_name` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`promo_id`, `dc_name`) VALUES
(1, '- 20%'),
(5, '- 20%');

-- --------------------------------------------------------

--
-- Table structure for table `freebie`
--

DROP TABLE IF EXISTS `freebie`;
CREATE TABLE IF NOT EXISTS `freebie` (
  `promo_id` int(11) NOT NULL,
  `freebie_name` varchar(45) NOT NULL,
  `elective` enum('0','1') NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freebie`
--

INSERT INTO `freebie` (`promo_id`, `freebie_name`, `elective`) VALUES
(4, 'Buy 1 Take 1', '1'),
(5, 'Buy 1 Take 1', '0');

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

--
-- Dumping data for table `itemadd`
--

INSERT INTO `itemadd` (`menu_id`, `ao_id`) VALUES
(8, 1),
(12, 2);

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
  `log_date` date NOT NULL,
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
  `menu_name` varchar(64) NOT NULL,
  `menu_description` longtext,
  `menu_availability` enum('available','temp unavailable','unavailable') NOT NULL DEFAULT 'available',
  `menu_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `category_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `category_id`, `menu_name`, `menu_description`, `menu_availability`, `menu_image`) VALUES
(8, 5, 'Benguet', 'Brewed Benguet coffee beans (menu w/ size)', 'available', NULL),
(9, 4, 'Animal Fries', 'Potato Fries', 'available', NULL),
(10, 9, 'Pakpakyaw (Butterfly) Pea', 'tea siya (menu w/ temparature and different price)', 'available', NULL),
(11, 8, 'Matcha', 'Matcha Frappe', 'available', NULL),
(12, 10, 'Americano', 'americano espresso (menu w/ temperature)', 'available', NULL);

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
-- Table structure for table `menu_discount`
--

DROP TABLE IF EXISTS `menu_discount`;
CREATE TABLE IF NOT EXISTS `menu_discount` (
  `promo_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `dc_amt` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`,`pref_id`),
  KEY `md_pref_id_idx` (`pref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_discount`
--

INSERT INTO `menu_discount` (`promo_id`, `pref_id`, `dc_amt`) VALUES
(1, 15, '16'),
(1, 16, '16'),
(5, 19, '20');

-- --------------------------------------------------------

--
-- Table structure for table `menu_freebie`
--

DROP TABLE IF EXISTS `menu_freebie`;
CREATE TABLE IF NOT EXISTS `menu_freebie` (
  `promo_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `fb_qty` int(11) NOT NULL,
  `fb_price` varchar(45) NOT NULL,
  PRIMARY KEY (`promo_id`,`pref_id`),
  KEY `mn_pref_id_idx` (`pref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_freebie`
--

INSERT INTO `menu_freebie` (`promo_id`, `pref_id`, `fb_qty`, `fb_price`) VALUES
(4, 19, 1, '0'),
(4, 20, 1, '0'),
(5, 19, 1, '0');

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
  `pref_id` int(11) NOT NULL,
  `order_desc` varchar(50) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `item_status` enum('pending','ongoing','done','served') NOT NULL,
  `remarks` longtext,
  PRIMARY KEY (`order_item_id`),
  KEY `orderslip_idx` (`order_id`),
  KEY `preferences_idx` (`pref_id`)
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
  `total` double NOT NULL,
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

--
-- Dumping data for table `po_items`
--

INSERT INTO `po_items` (`po_id`, `item_name`, `item_qty`, `item_unit`, `item_price`, `remarks`) VALUES
(1, 'Strawberry syrup', 10, 'bottle', 100, NULL),
(2, 'Benguet coffee beans', 5, 'bag', 200, NULL),
(2, 'Sagada coffee beans', 2, 'bag', 250, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `pref_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `size_name` varchar(45) NOT NULL DEFAULT 'Normal',
  `size_status` enum('enabled','disabled') NOT NULL,
  `temp` enum('h','c') DEFAULT NULL,
  `pref_price` double NOT NULL,
  PRIMARY KEY (`pref_id`) USING BTREE,
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`pref_id`, `menu_id`, `size_name`, `size_status`, `temp`, `pref_price`) VALUES
(13, 8, 'Solo', 'enabled', NULL, 60),
(14, 8, 'Jumbo', 'enabled', NULL, 110),
(15, 12, 'Normal', 'enabled', 'h', 80),
(16, 12, 'Normal', 'enabled', 'c', 80),
(17, 10, 'Normal', 'enabled', 'h', 110),
(18, 10, 'Normal', 'enabled', 'c', 110),
(19, 9, 'Normal', 'enabled', NULL, 100),
(20, 11, 'Normal', 'enabled', NULL, 140);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_name` varchar(45) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_id`, `promo_name`, `start_date`, `end_date`, `freebie`, `discount`, `status`) VALUES
(1, 'March Promo', '2019-03-01 00:00:00', '2019-03-30 00:00:00', 'y', NULL, 'enabled'),
(4, 'Graduation Promo', '2019-03-22 00:00:00', '2019-03-30 00:00:00', NULL, 'y', 'enabled'),
(5, 'Panagbenga Promo', '2019-03-01 00:00:00', '2019-03-04 00:00:00', 'y', 'y', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `promo_cons`
--

DROP TABLE IF EXISTS `promo_cons`;
CREATE TABLE IF NOT EXISTS `promo_cons` (
  `promo_id` int(11) NOT NULL,
  `pref_id` int(11) NOT NULL,
  `pc_type` enum('f','d','fd') NOT NULL,
  `pc_qty` int(11) NOT NULL,
  PRIMARY KEY (`promo_id`,`pref_id`),
  KEY `pc_menu_id_idx` (`pref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_cons`
--

INSERT INTO `promo_cons` (`promo_id`, `pref_id`, `pc_type`, `pc_qty`) VALUES
(1, 15, 'd', 1),
(1, 16, 'd', 1),
(4, 13, 'f', 1),
(4, 14, 'f', 1),
(5, 19, 'fd', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`po_id`, `source_id`, `po_date`, `ed_date`, `po_status`, `po_amt_payable`) VALUES
(1, 1, '2019-04-12', '2019-04-14', 'pending', 1000),
(2, 2, '2019-04-12', '2019-04-15', 'pending', 1500);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`source_id`, `source_name`, `contact_num`, `email`, `status`) VALUES
(1, 'Tiongsan', '09997090529', 'tiongsan@mail.com', 'active'),
(2, 'Tatum', '09454218542', 'tatum@mail.com', 'active');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`stock_id`, `category_id`, `stock_name`, `stock_quantity`, `stock_unit`, `stock_minimum`, `stock_status`) VALUES
(1, 14, 'Chocolate', 0, 'Bottle', 0, 'available'),
(2, 11, 'Caramel', 0, 'Bottle', 0, 'temp unavailable'),
(3, 11, 'Strawberry', 0, 'Bottle', 0, 'temp unavailable'),
(4, 12, 'Hazelnut', 0, 'Bottle', 0, 'temp unavailable'),
(5, 12, 'Vanilla', 0, 'Bottle', 0, 'temp unavailable'),
(6, 13, 'Matcha', 0, 'Bag', 0, 'temp unavailable'),
(7, 14, 'Espresso', 0, 'Bag (kg.)', 0, 'temp unavailable'),
(8, 14, 'Benguet', 0, 'Bag (kg.)', 0, 'temp unavailable'),
(9, 14, 'Kalinga', 0, 'Bag (kg.)', 0, 'temp unavailable'),
(10, 14, 'Sagada', 0, 'Bag (kg.)', 0, 'temp unavailable'),
(11, 14, 'Cordillera City (Medium) Roast', 0, 'Bag (kg.)', 0, 'temp unavailable'),
(12, 14, 'Vienna (Dark) Roast', 0, 'Bag (kg.)', 0, 'temp unavailable'),
(13, 15, 'Honey-Coated Lemon', 0, 'Bag', 0, 'temp unavailable'),
(14, 15, 'Chamomile', 0, 'Bag', 0, 'temp unavailable'),
(15, 15, 'Pakpakyaw (Butterfly) Pea', 0, 'Bag', 0, 'temp unavailable'),
(16, 16, 'Mango', 0, 'Bottle', 0, 'temp unavailable'),
(17, 16, 'Pineapple', 0, 'Bottle', 0, 'temp unavailable'),
(18, 16, 'Water', 0, 'Bottle', 0, 'temp unavailable'),
(19, 16, 'Coke', 0, 'Bottle', 0, 'temp unavailable'),
(20, 16, 'Sprite', 0, 'Bottle', 0, 'temp unavailable'),
(21, 16, 'Royal', 0, 'Bottle', 0, 'temp unavailable'),
(22, 17, 'Whipped Cream', 0, 'Bottle', 0, 'temp unavailable'),
(23, 17, 'Milk', 0, 'Carton', 0, 'temp unavailable'),
(24, 11, 'Pesto', 0, 'Pack', 0, 'temp unavailable'),
(25, 11, 'Carbonara', 0, 'Pack', 0, 'temp unavailable'),
(26, 11, 'Italian', 0, 'Pack', 0, 'temp unavailable'),
(27, 19, 'Baby Back', 0, 'Piece', 0, 'temp unavailable'),
(28, 19, 'Chicken', 0, 'Piece', 0, 'temp unavailable'),
(29, 19, 'Chicken Wings', 0, 'Piece', 0, 'temp unavailable'),
(30, 19, 'Burger Patty', 0, 'Piece', 0, 'temp unavailable'),
(31, 20, 'Fettuccine', 0, 'Pack', 0, 'temp unavailable'),
(32, 20, 'Linguine', 0, 'Pack', 0, 'temp unavailable'),
(33, 20, 'Sphagetti', 0, 'Pack', 0, 'temp unavailable');

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

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_code`) VALUES
('T1');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) DEFAULT NULL,
  `receipt_no` varchar(45) NOT NULL,
  `total` double NOT NULL,
  `trans_date` date NOT NULL,
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
  `item_name` varchar(45) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_unit` varchar(45) NOT NULL,
  `item_price` double NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`trans_id`,`item_name`)
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
  ADD CONSTRAINT `maincat` FOREIGN KEY (`supcat_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `d_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freebie`
--
ALTER TABLE `freebie`
  ADD CONSTRAINT `freebie_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemadd`
--
ALTER TABLE `itemadd`
  ADD CONSTRAINT `additem` FOREIGN KEY (`ao_id`) REFERENCES `addons` (`ao_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemadd` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE;

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
-- Constraints for table `menu_discount`
--
ALTER TABLE `menu_discount`
  ADD CONSTRAINT `md_pref_id` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `md_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_freebie`
--
ALTER TABLE `menu_freebie`
  ADD CONSTRAINT `mf_pref_id` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mf_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orderslip` FOREIGN KEY (`order_id`) REFERENCES `orderslip` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `preferences` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orderslip`
--
ALTER TABLE `orderslip`
  ADD CONSTRAINT `table` FOREIGN KEY (`table_code`) REFERENCES `tables` (`table_code`) ON UPDATE CASCADE;

--
-- Constraints for table `po_items`
--
ALTER TABLE `po_items`
  ADD CONSTRAINT `purchase order` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `item` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_cons`
--
ALTER TABLE `promo_cons`
  ADD CONSTRAINT `pc_pref_id` FOREIGN KEY (`pref_id`) REFERENCES `preferences` (`pref_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_promo_id` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
