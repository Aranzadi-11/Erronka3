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
-- Table structure for table `bezeroak`
--

DROP TABLE IF EXISTS `bezeroak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bezeroak` (
  `idBezeroa` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) DEFAULT NULL,
  `abizena` varchar(50) DEFAULT NULL,
  `erabiltzaileIzena` varchar(60) NOT NULL,
  `pasahitza` varchar(60) NOT NULL,
  `jaiotzeEguna` date NOT NULL,
  `emaila` varchar(85) NOT NULL,
  PRIMARY KEY (`idBezeroa`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bezeroak`
--

LOCK TABLES `bezeroak` WRITE;
/*!40000 ALTER TABLE `bezeroak` DISABLE KEYS */;
INSERT INTO `bezeroak` VALUES (1,'Aritz','Arrieta','AritA','ARIarr123','1990-03-14','aritza.arrieta@gmail.com'),(2,'Iratxe','Urrutia','IratU','IRAurr123','1985-07-22','iratxe.urrutia@gmail.com'),(3,'Nerea','Zabaleta','NereZ','NERzab123','1993-09-11','nerea.zabaleta@gmail.com'),(4,'Mikel','Zaragoza','MikeZ','MIKzar123','1994-12-05','mikel.zaragoza@gmail.com'),(5,'Eneko','Goikoetxea','EnekG','ENEgoi123','1991-01-02','eneko.goikoetxea@gmail.com'),(6,'Amaia','Mendizabal','AmaiM','AMAmen123','1987-11-18','amaia.mendizabal@gmail.com'),(7,'Ane','Gomez','AneG','ANEgom123','1996-05-08','ane.gomez@gmail.com'),(8,'Lander','Arozena','LandA','LANaro123','1992-08-27','lander.arozena@gmail.com'),(9,'Beñat','Urrutia','BenaU','BENurr123','1990-04-13','benat.urrutia@gmail.com'),(10,'Leire','Altuna','LeirA','LEIalt123','1993-10-30','leire.altuna@gmail.com'),(11,'Jon','Odriozola','JonO','JONodr123','1988-03-05','jon.odriozola@gmail.com'),(12,'Unai','Gabilondo','UnaiG','UNAgab123','1991-02-15','unai.gabilondo@gmail.com'),(13,'Jone','Aizpuru','JoneA','JONaiz123','1992-06-17','jone.aizpuru@gmail.com'),(14,'Igone','Murueta','IgonM','IGOmur123','1994-04-19','igone.murueta@gmail.com'),(15,'Oier','Sarasola','OierS','OIEsar123','1990-10-24','oier.sarasola@gmail.com'),(16,'Pedro','Hernandez','PedrH','PEDher123','1992-02-03','pedro.hernandez@gmail.com'),(17,'Raul','Martinez','RaulM','RAUmar123','1991-12-29','raul.martinez@gmail.com'),(18,'Xabier','Otxoa','XabiO','XABotx123','1989-01-07','xabier.otxoa@gmail.com'),(19,'Marta','Lopez','MartL','MARlop123','1986-11-20','marta.lopez@gmail.com'),(20,'Javier','Fernandez','JaviF','JAVfer123','1988-08-12','javier.fernandez@gmail.com'),(21,'Bea','Ramos','BeaR','BEAram123','1993-06-23','bea.ramos@gmail.com'),(22,'Ana','Perez','AnaP','ANApel123','1992-04-30','ana.perez@gmail.com'),(23,'David','Ruiz','DaviR','DAVrui123','1990-10-17','david.ruiz@gmail.com'),(24,'Carla','Gonzalez','CarlG','CARgon123','1991-03-02','carla.gonzalez@gmail.com'),(25,'Iker','Fernandez','IkerF','IKEfer123','1994-02-14','iker.fernandez@gmail.com'),(26,'Alba','Diaz','AlbaD','ALBdia123','1996-01-22','alba.diaz@gmail.com'),(27,'Lucas','Sánchez','LucaS','LUCsan123','1989-09-10','lucas.sanchez@gmail.com'),(28,'Cristina','Gomez','CrstG','CRIgom123','1992-07-05','cristina.gomez@gmail.com'),(29,'Laura','Martín','LaurM','LAUmar123','1990-12-25','laura.martin@gmail.com'),(30,'Oscar','Herrera','OscaH','OSCher123','1988-04-22','oscar.herrera@gmail.com'),(31,'Sara','Vazquez','SaraV','SARvaz123','1995-11-11','sara.vazquez@gmail.com'),(32,'Beñat','Aranzadi Durán','Aran_11','$2y$10$XvjQFL8uB2XTv20fNiIjBOsOY84eUds9L31oom7sSpGU/WdoJk2Xq','2001-03-06','Aranzadi99@gmail.com'),(33,'aa','aa','aa','aa','2000-05-25','aa'),(35,'a','a','a','$2y$10$y0KAn0I.bVtmssgaQwJXrOYySyaJ0ndOz394V.YbNf/KeQZSCTgRC','1999-03-20','a@gmail.com');
/*!40000 ALTER TABLE `bezeroak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-08 12:07:00
