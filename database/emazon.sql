-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: emazon
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
-- Current Database: `emazon`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `emazon` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `emazon`;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` int(20) DEFAULT NULL,
  `product_id` int(20) DEFAULT NULL,
  `quantity` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (20000,10000,3),(20000,10001,3);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `product_id` int(20) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (20000,1,10000,3,'2018-04-20 13:44:14'),(20000,1,10001,3,'2018-04-20 13:44:39'),(20001,1,10001,3,'2018-05-01 19:54:08'),(1,1,10000,1,'2018-05-01 21:54:51'),(2,1,10001,6,'2018-05-01 23:09:13'),(2,1,10000,2,'2018-05-01 23:09:14'),(3,1,10000,3,'2018-05-01 23:37:08'),(3,1,10001,1,'2018-05-01 23:37:08'),(4,1,10000,19,'2018-05-02 00:16:06'),(4,1,10001,1,'2018-05-02 00:16:06'),(5,1,10000,4,'2018-05-02 08:45:31'),(5,1,10001,1,'2018-05-02 08:45:31'),(7,2,10003,1,'2018-05-02 11:30:59'),(8,2,10000,3,'2018-05-02 11:31:55'),(8,2,10011,2,'2018-05-02 11:31:55');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `category` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10019 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (10000,'Hammer','Use to hammer something',8.99,'Tools'),(10001,'Screw Driver','Screw stuff',5.99,'Tools'),(10002,'Pliers','They are use to get stuff',6.99,'Tools'),(10003,'Drill','The new and very efficient drill',29.99,'Tools'),(10004,'Chips','A collection of some of the best chips!',6.99,'Food'),(10005,'Energy Bar','Start your day with this delicious energy bar',6.99,'Food'),(10006,'Water','Drink 2L of water every day',0.99,'Food'),(10007,'Gum','Share this gum with your friends and they will love you',2.99,'Food'),(10008,'Candy','Perfect for kids',0.99,'Food'),(10009,'Screws','Get this pack of screws for an incredible price',3.99,'Hardware'),(10010,'Nails','You will need a hammer to use this item!',2.99,'Hardware'),(10011,'Pipe','A very durable pipe',2.99,'Hardware'),(10012,'Valve','This valve is very useful, so buy it',5.99,'Hardware'),(10013,'Door Knob','Your hand will love this door knob',9.99,'Hardware'),(10014,'Phone Protector','The best protection for your phone',7.99,'Phone Accessories'),(10015,'Tempered Glass','Protect your phone screens!',6.99,'Phone Accessories'),(10016,'Stand','This item facilitates the way the phone stands',2.99,'Phone Accessories'),(10017,'Charger','Never run out of battery!',5.99,'Phone Accessories'),(10018,'Earphones','Listen to your favorite music privately',8.99,'Phone Accessories');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `cart_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Alexis','$2y$10$bMskF8VBafpNe0XHb5kO8.17HOryOIs6s0rFyUAZhd.e.pvPy6mge',6),(2,'Alexis1','$2y$10$xqE9Z1YGIAALcfjsY/z6TeGw7/vH8xK3JA.GjNySoAA.JsFsa9Lku',9);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-02 11:35:55
