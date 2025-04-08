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
-- Table structure for table `langileak`
--

DROP TABLE IF EXISTS `langileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `langileak` (
  `idLangile` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) DEFAULT NULL,
  `abizena` varchar(50) DEFAULT NULL,
  `erabiltzaileIzena` varchar(60) NOT NULL,
  `pasahitza` varchar(60) NOT NULL,
  `erabiltzaileMota` varchar(70) NOT NULL,
  PRIMARY KEY (`idLangile`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langileak`
--

LOCK TABLES `langileak` WRITE;
/*!40000 ALTER TABLE `langileak` DISABLE KEYS */;
INSERT INTO `langileak` VALUES (1,'Aitor','Agirre','AitoA','AITagr123','Administratzailea'),(2,'Iker','Etxeberria','IkerE','IKEetx123','Harreragilea'),(3,'Mikel','Mendizabal','MikeM','MIKmen123','Garbitzailea'),(4,'Jon','Zubizarreta','JonZ','JONzub123','Sukaldaria'),(5,'Unai','Goikoetxea','UnaiG','UNAgoi123','Monitorea'),(6,'Ander','Aranburu','AndeA','ANDara123','Informatikaria'),(7,'Gorka','Etxaniz','GorkE','GORetx123','Administratzailea'),(8,'Oier','Lertxundi','OierL','OIEler123','Harreragilea'),(9,'Xabier','Urrutia','XabiU','XABurr123','Garbitzailea'),(10,'Ane','Zabaleta','AneZ','ANEzab123','Sukaldaria'),(11,'Maite','Lizarraga','MaitL','MAIliz123','Monitorea'),(12,'Nahia','Iraola','NahiI','NAHira123','Informatikaria'),(13,'Leire','Bengoetxea','LeirB','LEIben123','Administratzailea'),(14,'June','Altuna','JuneA','JUNalt123','Harreragilea'),(15,'Eneko','Errekalde','EnekE','ENEerr123','Garbitzailea'),(16,'Olatz','Sarasola','OlatS','OLAara123','Sukaldaria'),(17,'Lierni','Urresti','LierU','LIEurr123','Monitorea'),(18,'Hodei','Otxoa','HodeO','HODotx123','Informatikaria'),(19,'Ibai','Zubia','IbaiZ','IBAzub123','Administratzailea'),(20,'Miren','Azurmendi','MireA','MIRazu123','Harreragilea'),(21,'Uxue','Gabilondo','UxueG','UXUgab123','Garbitzailea'),(22,'Ekain','Zugasti','EkaiZ','EKAzug123','Sukaldaria'),(23,'Beñat','Odriozola','BeñaO','BEÑodr123','Monitorea'),(24,'Manex','Sagastibeltza','ManeS','MANsag123','Informatikaria'),(25,'Jose','Fernandez','JoseF','JOSfer123','Administratzailea'),(26,'Carlos','Gonzalez','CarlG','CARgon123','Harreragilea'),(27,'Antonio','Martinez','AntoM','ANTmar123','Garbitzailea'),(28,'David','Rodriguez','DaviR','DAVrod123','Sukaldaria'),(29,'Sergio','Lopez','SergL','SERlop123','Monitorea'),(30,'Raul','Perez','RaulP','RAUper123','Informatikaria');
/*!40000 ALTER TABLE `langileak` ENABLE KEYS */;
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
