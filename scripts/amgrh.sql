-- MySQL dump 10.13  Distrib 5.6.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: amgrh
-- ------------------------------------------------------
-- Server version	5.6.37-1~dotdeb+7.1

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
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departements` (
  `sid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departements`
--

LOCK TABLES `departements` WRITE;
/*!40000 ALTER TABLE `departements` DISABLE KEYS */;
INSERT INTO `departements` VALUES (1,'Division des Archives des Administrations Centrales et des Etablissements Publics','DAACEP',NULL),(2,'Division des Affaires Administratives et Financières','DAAF',NULL),(3,'Division de la Communication et de la Diffusion','DCD',NULL),(4,'Division de la Collecte et Traitement','DCT',NULL),(5,'Service des Archives des Administrations Centrales ','SAAC',1),(6,'Service des Archives des Etablissements publics','SAEP',1),(7,'Service de Gestion des Ressources humaines','SGRH',2),(8,'Service du Budget et Comptabilité','SBC',2),(9,'Service Production et Développement Informatique','SPDI',2),(10,'Service de Recherche Documentaire et Consultation','SRDC',3),(11,'Service de Publication et Edition','SPE',3),(12,'Service des Activités Culturelles et Scientifiques','SACS',3),(13,'Service des Méthodes et Normalisation','SMN',4),(14,'Service de la Collecte','SC',4),(15,'Service du Traitement','ST',4);
/*!40000 ALTER TABLE `departements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employes`
--

DROP TABLE IF EXISTS `employes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employes` (
  `sid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `grade` tinyint(4) NOT NULL,
  `indice` tinyint(4) DEFAULT NULL,
  `departement` tinyint(4) NOT NULL,
  `matricule` int(11) DEFAULT NULL,
  `dateRecrute` date DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employes`
--

LOCK TABLES `employes` WRITE;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `sid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `echelle` int(20) DEFAULT NULL,
  `Cadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (1,'Professeurs de l\'enseignement suppérieur',NULL,NULL),(2,'Administrateurs',NULL,NULL),(3,'Ingénieurs d\'etat',NULL,NULL),(4,'Techniciens',NULL,NULL),(5,'Assistants techniques',NULL,NULL),(6,'Assistants administratifs',NULL,NULL),(7,'Professeurs de l\'enseignement suppérieur grade C',99,1),(8,'Professeurs de l\'enseignement suppérieur grade B',99,1),(9,'Professeurs de l\'enseignement suppérieur grade A',99,1),(10,'Administrateur 1er grade',99,2),(11,'Administrateur 2ème grade',11,2),(12,'Administrateur 3ème grade',10,2),(13,'Ingénieur d\'etat principal',11,3),(14,'Ingénieur d\'etat 1er grade',11,3),(15,'Technicien 1er grade',11,4),(16,'Technicien 2ème grade',10,4),(17,'Technicien 3ème grade',9,4),(18,'Technicien 4ème grade',8,4),(19,'Assistant technique 1er  grade',8,5),(20,'Assistant technique 2ème  grade',7,5),(21,'Assistant technique 3ème  grade',6,5),(22,'Assistant administratif 1er  grade',8,6),(23,'Assistant administratif 2ème  grade',7,6),(24,'Assistant administratif 3ème  grade',6,6);
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indiceEchellon`
--

DROP TABLE IF EXISTS `indiceEchellon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indiceEchellon` (
  `sid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `indice` int(11) DEFAULT NULL,
  `echellon` int(11) DEFAULT NULL,
  `grade` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indiceEchellon`
--

LOCK TABLES `indiceEchellon` WRITE;
/*!40000 ALTER TABLE `indiceEchellon` DISABLE KEYS */;
INSERT INTO `indiceEchellon` VALUES (1,975,1,7),(2,1005,2,7),(3,1035,3,7),(4,1065,4,7),(5,1095,5,7),(6,860,1,8),(7,885,2,8),(8,915,3,8),(9,945,4,8),(10,760,1,9),(11,785,2,9),(12,810,3,9),(13,835,4,9),(14,704,1,10),(15,746,2,10),(16,779,3,10),(17,812,4,10),(18,840,5,10),(19,870,6,10),(20,336,1,11),(21,369,2,11),(22,403,3,11),(23,436,4,11),(24,472,5,11),(25,509,6,11),(26,542,7,11),(27,574,8,11),(28,606,9,11),(29,639,10,11),(30,704,11,11),(31,275,1,12),(32,300,2,12),(33,326,3,12),(34,351,4,12),(35,377,5,12),(36,402,6,12),(37,428,7,12),(38,456,8,12),(39,484,9,12),(40,512,10,12),(41,564,11,12),(42,509,1,13),(43,542,2,13),(44,574,3,13),(45,606,4,13),(46,639,5,13),(47,704,6,13),(48,336,1,14),(49,369,2,14),(50,403,3,14),(51,436,4,14),(52,472,5,14),(53,336,1,15),(54,369,2,15),(55,403,3,15),(56,436,4,15),(57,472,5,15),(58,509,6,15),(59,542,7,15),(60,574,8,15),(61,606,9,15),(62,639,10,15),(63,675,11,15),(64,690,12,15),(65,704,13,15),(66,275,1,16),(67,300,2,16),(68,326,3,16),(69,351,4,16),(70,377,5,16),(71,402,6,16),(72,428,7,16),(73,456,8,16),(74,484,9,16),(75,512,10,16),(76,564,11,16),(77,235,1,17),(78,253,2,17),(79,274,3,17),(80,296,4,17),(81,317,5,17),(82,339,6,17),(83,361,7,17),(84,382,8,17),(85,404,9,17),(86,438,10,17),(87,207,1,18),(88,224,2,18),(89,241,3,18),(90,259,4,18),(91,276,5,18),(92,293,6,18),(93,311,7,18),(94,332,8,18),(95,353,9,18),(96,373,10,18),(97,207,1,19),(98,224,2,19),(99,241,3,19),(100,259,4,19),(101,276,5,19),(102,293,6,19),(103,311,7,19),(104,332,8,19),(105,353,9,19),(106,373,10,19),(107,177,1,20),(108,193,2,20),(109,208,3,20),(110,225,4,20),(111,242,5,20),(112,260,6,20),(113,277,7,20),(114,291,8,20),(115,305,9,20),(116,318,10,20),(117,153,1,21),(118,161,2,21),(119,173,3,21),(120,185,4,21),(121,197,5,21),(122,209,6,21),(123,222,7,21),(124,236,8,21),(125,249,9,21),(126,262,10,21),(127,207,1,22),(128,224,2,22),(129,241,3,22),(130,259,4,22),(131,276,5,22),(132,293,6,22),(133,311,7,22),(134,332,8,22),(135,353,9,22),(136,373,10,22),(137,177,1,23),(138,193,2,23),(139,208,3,23),(140,225,4,23),(141,242,5,23),(142,260,6,23),(143,277,7,23),(144,291,8,23),(145,305,9,23),(146,318,10,23),(147,153,1,24),(148,161,2,24),(149,173,3,24),(150,185,4,24),(151,197,5,24),(152,209,6,24),(153,222,7,24),(154,236,8,24),(155,249,9,24),(156,262,10,24);
/*!40000 ALTER TABLE `indiceEchellon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'amgrh'
--

--
-- Dumping routines for database 'amgrh'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-02 15:30:44
