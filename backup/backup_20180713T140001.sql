-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cantina
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

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
-- Table structure for table `ANALISI`
--

DROP TABLE IF EXISTS `ANALISI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ANALISI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_VINI` int(11) NOT NULL,
  `ID_LABORATORIO` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `TITOLO_ALCOLOMETRICO_VOLUMICO` float NOT NULL,
  `TITOLO_ALCOLOMETRICO_VOLUMICO_UM` varchar(6) NOT NULL,
  `TITOLO_ALCOLOMETRICO_VOLUMICO_METODO` varchar(200) NOT NULL,
  `ACIDITA_TOTALE` float NOT NULL,
  `ACIDITA_TOTALE_UM` varchar(6) NOT NULL,
  `ACIDITA_TOTALE_METODO` varchar(200) NOT NULL,
  `ACIDITA_VOLATILE` float NOT NULL,
  `ACIDITA_VOLATILE_UM` varchar(6) NOT NULL,
  `ACIDITA_VOLATILE_METODO` varchar(200) NOT NULL,
  `ANIDIRIDE_SOLFOROSA_TOTALE` float NOT NULL,
  `ANIDIRIDE_SOLFOROSA_TOTALE_UM` varchar(6) NOT NULL,
  `ANIDIRIDE_SOLFOROSA_TOTALE_METODO` varchar(200) NOT NULL,
  `PH` float NOT NULL,
  `PH_METODO` varchar(200) NOT NULL,
  `ACIDO_L_MALICO` float NOT NULL,
  `ACIDO_L_MALICO_UM` varchar(6) NOT NULL,
  `ACIDO_L_MALICO_METODO` varchar(200) NOT NULL,
  `ACIDO_L_LATTICO` float NOT NULL,
  `ACIDO_L_LATTICO_UM` varchar(6) NOT NULL,
  `ACIDO_L_LATTICO_METODO` varchar(200) NOT NULL,
  `TRATTAMENTO_CONSIGLIATO` text NOT NULL,
  `NOTE` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_VINI` (`ID_VINI`),
  KEY `ID_LABORATORIO` (`ID_LABORATORIO`),
  CONSTRAINT `ANALISI_ibfk_1` FOREIGN KEY (`ID_VINI`) REFERENCES `VINI` (`ID`),
  CONSTRAINT `ANALISI_ibfk_2` FOREIGN KEY (`ID_LABORATORIO`) REFERENCES `LABORATORI` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ANALISI`
--

LOCK TABLES `ANALISI` WRITE;
/*!40000 ALTER TABLE `ANALISI` DISABLE KEYS */;
INSERT INTO `ANALISI` VALUES (5,9,1,'2018-07-28',12.32,'% V/V','2 Reg CEE 2676/1990 17/09/1990 GU CEE L272 03/10/1990 All p.to 3par 5.2(bilancia idrostatica) Reg CE 128/2004 23/01/2004 GU CE L19/3 27/01/2004 All 4bis Reg CE 355/2005 28/02/2005 GU L056/3 02/03/2005',5.78,'g/l','Reg CEE 2676/1990 17/09/1990 GU CEE L272 03/10/1990 All p.to 13',0.21,'g/l','Metodo Iuffmann',6,'mg/l','Reg CEE 2676/1990 17/09/1990 GU CEE L272 03/10/1990 All p.to 25 par 2.3',3.3,'Reg. CEE 2676/1990 17/09/1990 GU CEE L272 03/10/1990 All p.to 24',0,'','',0,'','','Metabisolfito 5\r\nAl successivo travaso aggiungere ancora:\r\nMetabisolfito 8\r\nVino di colore rosso rubino intenso dai caratteristici sentori di frutta rossa,\r\nciliegia, amarena; dotato di una buona aciditÃ  totale, ancora acerbo.','');
/*!40000 ALTER TABLE `ANALISI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GEN_AMB_TEMP_UMI`
--

DROP TABLE IF EXISTS `GEN_AMB_TEMP_UMI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GEN_AMB_TEMP_UMI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TEMPERATURE` int(11) NOT NULL,
  `UMIDITY` int(11) NOT NULL,
  `TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GEN_AMB_TEMP_UMI`
--

LOCK TABLES `GEN_AMB_TEMP_UMI` WRITE;
/*!40000 ALTER TABLE `GEN_AMB_TEMP_UMI` DISABLE KEYS */;
INSERT INTO `GEN_AMB_TEMP_UMI` VALUES (1,44,55,'2018-03-02 17:34:55'),(2,33,2,'2018-03-03 17:34:55'),(3,33,43,'2018-03-04 17:03:20'),(4,22,33,'2018-03-05 17:03:20'),(5,15,52,'2018-03-06 00:00:00'),(6,34,35,'2018-03-07 00:00:00'),(7,24,50,'2018-03-20 11:24:01'),(8,24,50,'2018-03-20 11:24:01'),(9,25,44,'2018-03-20 12:03:01'),(10,25,44,'2018-03-20 12:03:01'),(11,25,43,'2018-03-20 12:09:01'),(12,25,43,'2018-03-20 12:09:01'),(13,25,41,'2018-03-20 12:33:01'),(14,25,41,'2018-03-20 12:33:01'),(15,25,38,'2018-03-20 13:17:01'),(16,25,37,'2018-03-20 13:27:01'),(17,25,37,'2018-03-20 13:27:01'),(18,25,35,'2018-03-20 13:47:01'),(19,24,35,'2018-03-20 13:57:01'),(20,24,35,'2018-03-20 13:57:01'),(21,24,34,'2018-03-20 14:09:01'),(22,24,34,'2018-03-20 14:09:01'),(23,24,34,'2018-03-20 14:11:01'),(24,24,33,'2018-03-20 14:14:01'),(25,25,33,'2018-03-20 14:19:01'),(26,24,32,'2018-03-20 14:29:01'),(27,25,32,'2018-03-20 14:58:01'),(28,25,31,'2018-03-20 15:19:01'),(29,25,31,'2018-03-20 15:31:01'),(30,25,30,'2018-03-20 15:47:01'),(31,25,30,'2018-03-20 16:09:01'),(32,25,30,'2018-03-20 16:09:01'),(33,25,30,'2018-03-20 16:23:01'),(34,19,44,'2018-03-21 09:37:01'),(35,22,40,'2018-03-21 10:06:01'),(36,22,40,'2018-03-21 10:06:01'),(37,23,39,'2018-03-21 10:17:01'),(38,23,38,'2018-03-21 10:37:01'),(39,24,37,'2018-03-21 10:47:01'),(40,24,36,'2018-03-21 11:03:01'),(41,24,36,'2018-03-21 11:03:01'),(42,24,34,'2018-03-21 11:19:01'),(43,24,34,'2018-03-21 11:21:01'),(44,24,34,'2018-03-21 11:21:01'),(45,24,33,'2018-03-21 11:30:01'),(46,24,33,'2018-03-21 11:30:01'),(47,24,32,'2018-03-21 11:47:01'),(48,25,32,'2018-03-21 11:52:01'),(49,25,31,'2018-03-21 12:13:01'),(50,25,30,'2018-03-21 12:29:01'),(51,25,27,'2018-03-21 13:55:01'),(52,25,26,'2018-03-21 14:51:01'),(53,25,26,'2018-03-21 14:51:01'),(54,25,21,'2018-03-23 14:29:02'),(55,25,20,'2018-03-23 14:40:01'),(56,25,20,'2018-03-23 14:47:01'),(57,26,20,'2018-03-23 15:27:01'),(58,26,20,'2018-03-23 15:27:01'),(59,26,20,'2018-03-23 15:31:01'),(60,27,19,'2018-03-23 15:57:01'),(61,27,19,'2018-03-23 15:57:01'),(62,27,19,'2018-03-23 16:03:01'),(63,27,19,'2018-03-23 16:03:01'),(64,27,18,'2018-03-23 16:11:01'),(65,26,18,'2018-03-23 16:28:01'),(66,26,17,'2018-03-23 16:41:01'),(67,26,17,'2018-03-23 16:47:01');
/*!40000 ALTER TABLE `GEN_AMB_TEMP_UMI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LABORATORI`
--

DROP TABLE IF EXISTS `LABORATORI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LABORATORI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NOTE` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LABORATORI`
--

LOCK TABLES `LABORATORI` WRITE;
/*!40000 ALTER TABLE `LABORATORI` DISABLE KEYS */;
INSERT INTO `LABORATORI` VALUES (1,'LABORATORIO  DI  CHIMICA  AGRARIA','','');
/*!40000 ALTER TABLE `LABORATORI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RABBOCCHI`
--

DROP TABLE IF EXISTS `RABBOCCHI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RABBOCCHI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_VINI` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `NOTE` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_VINI` (`ID_VINI`),
  CONSTRAINT `RABBOCCHI_ibfk_1` FOREIGN KEY (`ID_VINI`) REFERENCES `VINI` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RABBOCCHI`
--

LOCK TABLES `RABBOCCHI` WRITE;
/*!40000 ALTER TABLE `RABBOCCHI` DISABLE KEYS */;
INSERT INTO `RABBOCCHI` VALUES (9,11,'2018-07-03','eee');
/*!40000 ALTER TABLE `RABBOCCHI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VENDEMMIE`
--

DROP TABLE IF EXISTS `VENDEMMIE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VENDEMMIE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATA` date NOT NULL,
  `LUOGO` varchar(100) NOT NULL,
  `COSTO` float(10,0) NOT NULL,
  `DETTAGLI` text NOT NULL,
  `NOTE` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VENDEMMIE`
--

LOCK TABLES `VENDEMMIE` WRITE;
/*!40000 ALTER TABLE `VENDEMMIE` DISABLE KEYS */;
INSERT INTO `VENDEMMIE` VALUES (6,'2018-07-04','Fontana Murata',0,'                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ',''),(7,'2016-09-24','Fontana Murata',350,'Uva cottabos San giovese e montepulciano 7 q                                                                                                                                                                                                                                                                                                ',''),(8,'2016-10-01','Vetralla',200,'Uva San Giovese Vetralla',''),(9,'2017-09-22','Fontana Murata',650,'Uva vendemmia 2017 2 fillari sangiovese e 1 merlot. Totale 13 q	','');
/*!40000 ALTER TABLE `VENDEMMIE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VINI`
--

DROP TABLE IF EXISTS `VINI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VINI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_VENDEMMIE` int(11) NOT NULL,
  `ANNATA` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `DATA_IMBOTTIGLIAMENTO` date NOT NULL,
  `NOTE` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_VENDEMMIE` (`ID_VENDEMMIE`),
  CONSTRAINT `VINI_ibfk_1` FOREIGN KEY (`ID_VENDEMMIE`) REFERENCES `VENDEMMIE` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VINI`
--

LOCK TABLES `VINI` WRITE;
/*!40000 ALTER TABLE `VINI` DISABLE KEYS */;
INSERT INTO `VINI` VALUES (9,6,2018,'Khottabos','0000-00-00',' '),(10,7,2016,'Khottabos','0000-00-00',''),(11,7,2016,'Khottabos Barrique','0000-00-00',''),(12,8,2016,'Arone','2018-07-03','');
/*!40000 ALTER TABLE `VINI` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-13 16:00:01
