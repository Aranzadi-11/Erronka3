-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 172.16.237.120    Database: erronka3
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `erreserbak`
--

DROP TABLE IF EXISTS `erreserbak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `erreserbak` (
  `idErreserba` int NOT NULL AUTO_INCREMENT,
  `idLogela` int NOT NULL,
  `idBezeroa` int NOT NULL,
  `erreserbaEguna` date NOT NULL,
  `sarreraEguna` date NOT NULL,
  `irteeraEguna` date NOT NULL,
  `sarreraOrdua` datetime DEFAULT NULL,
  `irteeraOrdua` datetime DEFAULT NULL,
  `iruzkina` varchar(255) DEFAULT NULL,
  `prezioa` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idErreserba`),
  KEY `fk_Erreserbak_Bezeroak` (`idBezeroa`),
  KEY `fk_Erreserbak_Logelak` (`idLogela`),
  CONSTRAINT `fk_Erreserbak_Bezeroak` FOREIGN KEY (`idBezeroa`) REFERENCES `bezeroak` (`idBezeroa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Erreserbak_Logelak` FOREIGN KEY (`idLogela`) REFERENCES `logelak` (`idLogela`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erreserbak`
--

LOCK TABLES `erreserbak` WRITE;
/*!40000 ALTER TABLE `erreserbak` DISABLE KEYS */;
INSERT INTO `erreserbak` VALUES (63,1,1,'2025-03-20','2025-07-22','2025-07-25','2025-07-22 17:00:00','2025-07-25 11:00:00',NULL,150.00),(78,1,35,'2025-04-07','2025-04-07','2025-04-10','2025-04-07 16:00:00','2025-04-10 11:00:00','',150.00),(79,1,35,'2025-04-07','2025-04-13','2025-04-22','2025-04-13 16:00:00','2025-04-22 11:00:00','',450.00),(80,1,35,'2025-04-07','2025-04-23','2025-04-25','2025-04-23 16:00:00','2025-04-25 11:00:00','',100.00),(81,1,35,'2025-04-07','2025-04-27','2025-04-30','2025-04-27 16:00:00','2025-04-30 11:00:00','',150.00);
/*!40000 ALTER TABLE `erreserbak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-08 12:06:59
