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
-- Table structure for table `zerbitzuak`
--

DROP TABLE IF EXISTS `zerbitzuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zerbitzuak` (
  `idZerbitzua` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(50) NOT NULL,
  `deskribapena` varchar(255) NOT NULL,
  `prezioa` decimal(10,2) NOT NULL,
  `argazkia` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idZerbitzua`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zerbitzuak`
--

LOCK TABLES `zerbitzuak` WRITE;
/*!40000 ALTER TABLE `zerbitzuak` DISABLE KEYS */;
INSERT INTO `zerbitzuak` VALUES (1,'Gosaria Buffet','Goizeko 7:00etatik 10:30era buffet gosari osoa, aukera osasuntsu eta gozoekin.',15.99,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvWGgW1Mu6vA7CwwnZB0K0dWa7wTV9DhQqqw&s'),(2,'Afaria Buffet','Iluntzeko 19:00etatik 22:00etara buffet afaria, haragi, arrain eta postre aukera zabala barne.',22.99,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS745Vxd-f93Yn_HqBWvNgmftWv7VEIL2GFow&s'),(3,'Gela Garbiketa','Eguneroko garbiketa zerbitzua, oheak egitea, bainugela garbitzea eta toallak aldatzea barne.',0.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT28wTQj0371_ERb5jCm-XjXnPtQDGgazDwqQ&s'),(4,'WiFi Premium','Interneterako abiadura handiko konexioa, streaming eta bideodeiak inolako etenik gabe.',5.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ934q3W1t6JlYf2xEbvS069RTXH0aCZL65YA&s'),(5,'Parking Pribatua','Hotelaren azpian aparkaleku pribatua, segurtasun kamerak eta 24/7 sarbidea.',12.00,'https://www.blindabeep.com/wp-content/uploads/2018/04/seguridad-parking.jpg'),(6,'SPA eta Bainuetxea','Erlaxazio gunea, sauna, lurrun bainua eta masaje zerbitzuak eskaintzen dira.',35.00,'https://balneariocazorla.com/wp-content/uploads/2022/02/slider1-4.jpg'),(7,'Igerileku Estalia','Urte osoan erabili daitekeen igerileku klimatizatua eta bainuontzi beroa.',10.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMXaWB3ehc9QHm7n6Kz2TBzvwhm2sFdxXbfw&s'),(8,'Kanpoko Igerilekua','Eguzkia eta aire zabalean erlaxatzeko aukera duen kanpoko igerilekua.',8.00,'https://cf.bstatic.com/xdata/images/hotel/max500/243973134.jpg?k=9d04c52a4dfe8e8cc6b1afbc109ea4878ebe0fb6442b4ae9e6e8dbf6ff69b5af&o='),(9,'Gimnasioa','Makina berrienak dituen gimnasioa, fitness klase eta entrenatzaile pertsonalekin.',0.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-pSMJzHGYy9E-RvpOVR3RKD7XK5H6FYcGMQ&s'),(10,'Haurtzaindegi Zerbitzua','Haurtxoentzako eta umeentzako zaintza zerbitzua langile espezializatuekin.',20.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2xpX3E2E6XI3XlFTfI_px28N5e6u2XnYUTw&s'),(11,'Logelako Zerbitzua','Jangela zerbitzua gelara eramateko aukera 24/7, plater bero eta edariz hornitua.',7.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShtYZciveNUtFQFyvr4K1ZhxTN-hCNZfSB4Q&s'),(12,'Arropa Garbiketa','Jantziak garbitu, lehortu eta plantxatzeko zerbitzua.',10.00,'https://antayjesus.com/wp-content/uploads/2021/05/hotel-5.jpg.webp'),(13,'Garraio Zerbitzua','Aireportura eta hiriko puntu nagusietara transferentziak eta taxien erreserba.',25.00,'https://cdn-images.motor.es/image/m/1320w/fotos-diccionario/2023/08//taxi_1693240769.jpg'),(14,'Mendiko Ibilaldi Gidatuak','Gidari profesionalekin inguruko mendietara txango gidatuak.',30.00,'https://www.sansebastianturismoa.eus/images/ssturismo/camino-santiago.jpg'),(15,'Bizikleten Alokairua','Bizikleta ekologikoen alokairua hiri zehar eroso mugitzeko.',12.00,'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpequenosplanes.com%2Fmonte-del-pilar-majadahonda%2F&psig=AOvVaw0nVa9c2VFNPBxREQN1NlXd&ust=1743763412128000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCIiIzIjXu4wDFQAAAAAdAAAAABAS'),(16,'Motorren Alokairua','Motoen alokairua distantzia luzeak azkar egin ahal izateko.',45.00,'https://www.bankinter.com/file_source/blog/Contents/A-Imagenes/Motosharing.jpg'),(17,'Autoren Alokairua','Autoen alokairua egun oso baterako, aseguruarekin eta kilometro mugagabearekin.',60.00,'https://www.ocu.org/-/media/ocu/images/home/consumo%20y%20familia/viajes%20y%20vacaciones/alquiler%20coches/coches_alquiler_1600x900.jpg?rev=f3066397-b5a9-4f06-a9fe-8892cda95a7d&mw=660&hash=CB8C35FE0F065380FE0A4743049C6F3F'),(18,'Zinema Gaua','Gaueko zinema saioak hoteleko gune berezi batean, palomitak barne.',5.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScWlQKptXSBQ4pXtUGo-Xk9Ltl6LimGg_VaA&s'),(19,'Musika Emanaldiak','Zuzeneko musika emanaldiak iluntzean, tokiko artistak eta taldeak gonbidatuta.',0.00,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThePWkmW9zBt2p0ITFdUlQAABaFxUhzzoWkw&s'),(20,'Yoga eta Erlaxazio Klaseak','Egunero yoga eta meditazio klaseak aire zabalean edo gela berezietan.',15.00,'https://hips.hearstapps.com/hmg-prod/images/yoga-outdoor-class-in-new-york-royalty-free-image-1672156728.jpg?crop=1.00xw:0.925xh;0,0.0753xh&resize=980:*'),(21,'Cocktail Zerbitzua','Hoteleko tabernan espezialitatezko koktelak eta edari freskagarriak.',10.00,'https://cdcgourmet.com/storage/2023/04/elegir-mejor-catering-coctel.jpg'),(22,'Gourmet Afari Berezia','Afari berezi bat sukaldari profesionalekin, menu esklusiboekin.',50.00,'https://i.pinimg.com/736x/7d/73/ae/7d73aea5b792632932a64eba401a6e6c.jpg'),(23,'Golf Zelai Erreserbak','Inguruko golf zelaietan erreserba kudeaketa eta transferentzia.',40.00,'https://econaturaworld.com/wp-content/uploads/2024/04/cesped-artificial-cartagena-1.jpg'),(24,'Bulego Zerbitzuak','Ordenagailu, inprimagailu eta bilera-gelen erabilgarritasuna enpresentzat.',0.00,'https://www.instalacionestorrejon.com/wp-content/uploads/2020/04/IMG-0146-1080x675.jpg'),(25,'Pet Friendly Zerbitzua','Txakurrak eta bestelako maskotak ongi etorriak dira, ohe eta jaki bereziekin.',10.00,'https://biodog.es/wp-content/uploads/2019/04/Pet-friendly-biodog-barf.jpg'),(26,'Ardo Dastaketa','Bertako eta nazioarteko ardo dastaketak enologo adituekin.',30.00,'https://vinoselcielo.com/cdn/shop/articles/todo-lo-que-tienes-que-saber-acerca-de-la-cata-de-vinos-173211_900x.jpg?v=1727293932'),(27,'Eski Erreserbak','Neguko denboraldian eski erreserbak eta transferentzia eski estazioetara.',50.00,'https://www.hotelkandahar.com/assets/cache/uploads/esqui/620x501/esqui-snowboard-forfait-grandvalira-ordino-hotel-kandahar-andorra.webp?from=jpg'),(28,'Itsas Paseoak','Ontzi pribatuan paseo bat itsasoan, edari eta janari aukera batzuekin.',80.00,'https://okdiario.com/coolthelifestyle/img/2021/05/19/174212478_753161258731122_6510004539120850790_n.jpg'),(29,'Helikoptero Ibilaldiak','Helikoptero bidezko bidaia ikusgarriak inguruko paisaiak ezagutzeko.',150.00,'https://c1.staticflickr.com/5/4495/37557258421_324bd79f6d_z.jpg'),(30,'Gela Dekorazio Berezia','Eskaera bereziak logelan dekorazio erromantiko edo jai girokoa.',25.00,'https://cdn0.uncomo.com/es/posts/1/9/2/detalles_en_las_habitaciones_47291_11_600.webp');
/*!40000 ALTER TABLE `zerbitzuak` ENABLE KEYS */;
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
