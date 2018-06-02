CREATE DATABASE  IF NOT EXISTS `swims` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `swims`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: swims
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) unsigned NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Power','power hardware'),(2,'Software','computer programs'),(3,'Circuit Card','for electric works'),(4,'Switch','turning things on and off'),(5,'Brackets','idk'),(6,'Line Capacity Software','idk'),(7,'IP Port Software','software'),(8,'Application Software','app software'),(9,'Camera','camera'),(10,'Programming','prog'),(11,'Computer Parts','parts'),(12,'UPS','uninterruptible power supply'),(13,'Battery','battery');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `invoice_no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` int(10) unsigned NOT NULL,
  PRIMARY KEY (`invoice_no`,`order_no`),
  KEY `order_no_idx` (`order_no`),
  KEY `ordno_idx` (`order_no`),
  CONSTRAINT `ords` FOREIGN KEY (`order_no`) REFERENCES `orders` (`order_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `official_receipts`
--

DROP TABLE IF EXISTS `official_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `official_receipts` (
  `order_no` int(10) unsigned NOT NULL,
  `official_receipt_no` varchar(10) NOT NULL,
  `date_generated` date DEFAULT NULL,
  PRIMARY KEY (`order_no`,`official_receipt_no`),
  CONSTRAINT `orderid` FOREIGN KEY (`order_no`) REFERENCES `orders` (`order_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `official_receipts`
--

LOCK TABLES `official_receipts` WRITE;
/*!40000 ALTER TABLE `official_receipts` DISABLE KEYS */;
INSERT INTO `official_receipts` VALUES (1,'OR-49335','2017-07-24'),(2,'OR-29740','2017-07-24'),(5,'OR-55011','2017-07-24');
/*!40000 ALTER TABLE `official_receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `order_no` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`order_no`,`product_id`),
  KEY `product_no_idx` (`product_id`),
  CONSTRAINT `order_no` FOREIGN KEY (`order_no`) REFERENCES `orders` (`order_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_no` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (1,2,2,8000.00),(1,9,32,20000.00),(2,9,123,20000.00),(3,2,2,8000.00),(4,1,2,5000.00),(5,10,2,50000.00);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(10) NOT NULL,
  `delivery_receipt_no` varchar(10) DEFAULT NULL,
  `required_date` date NOT NULL,
  `shipped_date` date DEFAULT NULL,
  `date_created` date NOT NULL,
  `terms` varchar(45) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `ship_to` mediumtext NOT NULL,
  `status` varchar(45) NOT NULL,
  `username` varchar(15) NOT NULL,
  PRIMARY KEY (`order_no`),
  UNIQUE KEY `invoice_no_UNIQUE` (`invoice_no`),
  UNIQUE KEY `delivery_receipt_no_UNIQUE` (`delivery_receipt_no`),
  KEY `username_idx` (`username`),
  CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'I-48701','DR-61868','2017-07-26','2017-07-23','2017-07-23','Check','Gabriel','OLCA','Taal','Completed','jmlontoc'),(2,'I-7324','DR-63267','2017-07-26','2017-07-23','2017-07-23','Cash','Bruno Mars','Manhattan','US','Completed','jmlontoc'),(3,'I-61383','DR-46553','2017-07-26','2017-07-23','2017-07-23','Cash','Paolo','LRT2','Santolan','Completed','jmlontoc'),(4,'I-35050','DR-63743','2017-07-26','2017-07-23','2017-07-23','Cash','xzc','xzc','xzc','Completed','jmlontoc'),(5,'I-55223','DR-25102','2017-07-27','2017-07-24','2017-07-24','Cash','Nikko Aguila','Home','Paranaque','Completed','jmlontoc');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_items`
--

DROP TABLE IF EXISTS `package_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_items` (
  `product_id` int(10) unsigned NOT NULL,
  `package_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`package_id`),
  KEY `package_id_idx` (`package_id`),
  CONSTRAINT `idprod` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `package_id` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_items`
--

LOCK TABLES `package_items` WRITE;
/*!40000 ALTER TABLE `package_items` DISABLE KEYS */;
INSERT INTO `package_items` VALUES (1,0),(2,0),(3,0),(9,0),(10,0);
/*!40000 ALTER TABLE `package_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `package_id` int(10) unsigned NOT NULL,
  `package_name` varchar(45) NOT NULL,
  `package_description` mediumtext NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (0,'No Package','Product is independent'),(1,'PBX','Telephone system'),(2,'CCTV','Security Package'),(3,'Networking ','a subpackage of the cctv package. It contains routers, modems, etc');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_warehouse`
--

DROP TABLE IF EXISTS `product_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_warehouse` (
  `product_id` int(10) unsigned NOT NULL,
  `warehouse_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`warehouse_id`),
  KEY `warehouse_Id_idx` (`warehouse_id`),
  CONSTRAINT `prwr` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `warehouse_Id` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_warehouse`
--

LOCK TABLES `product_warehouse` WRITE;
/*!40000 ALTER TABLE `product_warehouse` DISABLE KEYS */;
INSERT INTO `product_warehouse` VALUES (1,1),(2,2),(3,1),(9,3),(10,4);
/*!40000 ALTER TABLE `product_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `category_no` int(11) unsigned NOT NULL,
  `quantity_in_stock` int(11) unsigned NOT NULL,
  `product_description` mediumtext,
  `buy_price` decimal(10,2) unsigned NOT NULL,
  `reorder_level` int(11) unsigned NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `cat_idx` (`category_no`),
  KEY `category_no` (`category_no`),
  CONSTRAINT `category` FOREIGN KEY (`category_no`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Hard Drive (2TB)',11,41,'2 TB',5000.00,10),(2,'DSLR Camera',9,16,'photography',8000.00,20),(3,'Router (5 ports)',11,99,'router',5000.00,30),(9,'iPad',1,923,'apple',20000.00,30),(10,'iPhone 6S',13,0,'apple',50000.00,5);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pull_out_slips`
--

DROP TABLE IF EXISTS `pull_out_slips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pull_out_slips` (
  `order_no` int(10) unsigned NOT NULL,
  `pull_out_slip_no` varchar(10) NOT NULL,
  `create_date` date DEFAULT NULL,
  PRIMARY KEY (`order_no`,`pull_out_slip_no`),
  UNIQUE KEY `pull_out_slip_no_UNIQUE` (`pull_out_slip_no`),
  CONSTRAINT `ox` FOREIGN KEY (`order_no`) REFERENCES `orders` (`order_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pull_out_slips`
--

LOCK TABLES `pull_out_slips` WRITE;
/*!40000 ALTER TABLE `pull_out_slips` DISABLE KEYS */;
INSERT INTO `pull_out_slips` VALUES (1,'PS-14202','2017-07-23'),(1,'PS-99263','2017-07-23'),(2,'PS-50301','2017-07-23'),(3,'PS-79761','2017-07-23'),(4,'PS-44298','2017-07-23'),(5,'PS-18553','2017-07-24');
/*!40000 ALTER TABLE `pull_out_slips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `supplier_id` int(10) unsigned NOT NULL,
  `supplier_name` varchar(45) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'NEC','091233214354','Manila','Manila','Philippines','nec@nec.ph'),(2,'Nexans','09002315642','Quezon City','Quezon City','Philippiines','nexans@nex.ph'),(3,'Ruckus Wireless','09021436801','Batangas','Batangas','Philippines','rw.ruckus@ruck.us'),(4,'Toppan','1234567','Ortigas','Pasig','Philippines','toppan@gangam.style'),(5,'Dell','04321412','Paranaque','Paranaque','Philippines','Dell@dell.com'),(6,'GeoVision','2142779','Diliman','Quezon City','Philippines','geo@vision.com'),(7,'Converged Solutions','4312322','Fairview','Quezon City','Philippines','convergedsolutions@yahoo.com'),(8,'JuruData Services','2142458','Cebu','Cebu','Philippines','juru@data.com'),(9,'Cansoc Systems LTD','0002321','Tondo','Manila','Philippines','cansoc@yahoo.com'),(10,'HDL Companies','09431325412','Taft','Manila','Philippines','hdl_company@google.com'),(11,'Spok','11111111','Tagaytay','Cavite','Philippines','spok@yahoo.com'),(12,'Brickom','09056723142','Sta. Rosa','Laguna','Philippines','brickom@brix.com'),(13,'HP','1233211','Makati','Makati','Philippines','hewlett.packard@gmail.com'),(14,'Cisco','5133521','Bonifacio Global City','Taguig','Philippines','cisco@gg.com'),(15,'Digiview','09122121121','Cebu','Cebu','Philippines','digiview@gmail.com');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplies`
--

DROP TABLE IF EXISTS `supplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplies` (
  `supplier_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`supplier_id`,`product_id`),
  KEY `product_id_idx` (`product_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplies`
--

LOCK TABLES `supplies` WRITE;
/*!40000 ALTER TABLE `supplies` DISABLE KEYS */;
INSERT INTO `supplies` VALUES (1,1),(1,3),(1,9),(1,10),(5,2);
/*!40000 ALTER TABLE `supplies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `position_no` tinyint(1) NOT NULL,
  `position` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email_address_UNIQUE` (`email_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('jmlontoc','Lontoc','JM','jose_maria_lontoc@dlsu.edu.ph',1,'Admin','2f5f86f06a34a2bfbe0bebdcc91b60df7a1d878501b6655122ce586d187e7bbe','0fb'),('myadmin','Lontoc','JM','jmlontoc4@gmail.com',1,'Admin','98a36c1c0c591c3489b1ca3ee9640e63ad244710f7354420a7b295b7b356217d','c89');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `warehouse_id` int(10) unsigned NOT NULL,
  `warehouse_name` varchar(45) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(45) NOT NULL,
  `contact_person_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES (1,'Warehouse A','Quezon City','Quezon City',1),(2,'Warehouse B','Manila','Manila',2),(3,'Warehouse C','Batangas','Batangas',3),(4,'Warehouse D','Laguna','Laguna',4);
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-24 12:39:42
