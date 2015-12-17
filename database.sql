-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: timeclock
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` text NOT NULL,
  `id_post` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Test','test@test.com','test',1,'2015-06-15 20:49:31'),(2,'Janine','janine@janine.com','Another comment.',1,'2015-06-15 20:58:10'),(3,'sd','','sd',1,'2015-06-15 21:05:16'),(4,'sef','','sef',1,'2015-06-15 21:05:35'),(5,'test','','test',1,'2015-06-15 21:07:25');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_entries`
--

DROP TABLE IF EXISTS `time_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_entries` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) NOT NULL,
  `timeIn` int(16) NOT NULL,
  `timeOut` int(16) NOT NULL,
  `comments` varchar(150) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_entries`
--

LOCK TABLES `time_entries` WRITE;
/*!40000 ALTER TABLE `time_entries` DISABLE KEYS */;
INSERT INTO `time_entries` VALUES (90,8,1435255980,1435266780,'Quick test comment here. I\\\'m liking the way this is beginning to turn out!',2),(91,8,1435263180,1435274520,'',2),(92,8,1435256760,1435260360,'',1),(94,8,1435258257,1435258437,'',1),(95,30,1434048960,1434066960,'',0),(96,30,1435258639,1435258664,'',0),(97,8,1435258693,1435258699,'',2),(98,8,1435258774,1435258790,'',1),(99,8,1435258850,1435259001,'',1),(100,8,1080253249,1080256249,'',0),(101,8,1435270860,1435285260,'',2),(102,8,1450384049,1450384053,'',2),(103,8,1450384076,1450384435,'',2),(104,8,1450385218,1450385220,'',2),(105,8,1450385888,1450385891,'',2),(106,8,1450385892,1450385892,'',2),(107,8,1450385893,1450385893,'',2),(108,8,1450385894,1450385894,'',2),(109,8,1450385895,1450385896,'',2),(110,8,1450385896,1450385897,'',2),(111,8,1450385897,1450385897,'',2),(112,8,1450385898,1450385898,'',2),(113,8,1450385898,1450385899,'',2),(114,8,1450385880,1450393080,'Oh, you know.',2),(145,8,1450386000,1450393380,'Test',2),(146,15,1450388130,1450388256,'',0),(147,8,1450388220,1450388340,'test',0);
/*!40000 ALTER TABLE `time_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(5) NOT NULL,
  `country` varchar(32) NOT NULL,
  `currentSupervisor` varchar(64) NOT NULL,
  `payRate` varchar(6) NOT NULL,
  `department` varchar(32) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `lastLogin` varchar(32) NOT NULL,
  `activated` int(1) NOT NULL,
  `canReactivate` int(1) NOT NULL DEFAULT '1',
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `registerDate` int(12) DEFAULT NULL,
  `isSupervisor` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (32,'admin','Admin','User','cc03e747a6afbbcbf8be7668acfebee5','test@test.com','7232 Nowhere Lane','Idaho Falls','ID',83401,'United States','Admin User','32.50','IT','123-456-7789','1450391091',1,0,1,1450391019,1);
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

-- Dump completed on 2015-12-17 15:59:18
