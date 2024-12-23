-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: annonce3
-- ------------------------------------------------------
-- Server version	8.0.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `references`
--

DROP TABLE IF EXISTS `references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `references` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `references_type_nom_unique` (`type`,`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `references`
--

/*!40000 ALTER TABLE `references` DISABLE KEYS */;
INSERT INTO `references` VALUES (1,'Hébergement','hebergement','Commodités hébergement','commodites-hebergement','2024-11-20 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(2,'Hébergement','hebergement','Services proposés','services-proposees','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(3,'Hébergement','hebergement','Types de lit','types-de-lit','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(4,'Hébergement','hebergement','Equipements hébergement','equipements-hebergement','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(5,'Hébergement','hebergement','Equipements salle de bain','equipements-salle-de-bain','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(6,'Hébergement','hebergement','Accessoires de cuisines','accessoires-cuisine','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(7,'Hébergement','hebergement','Types hebergement','types-hebergement','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(8,'Location de véhicule','location-de-vehicule','Type de voiture','types-de-voiture','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(9,'Location de véhicule','location-de-vehicule','Options et accesoires','options-accessoires','2024-11-22 08:43:32','2024-11-22 08:43:32',NULL,1,1,NULL),(10,'Restauration','restauration','Boissons disponibles','boissons-disponibles','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(11,'Location de véhicule','location-de-vehicule','Boite de vitesses','boite-de-vitesses','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(12,'Location de véhicule','location-de-vehicule','Conditions de location','conditions-de-location','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(13,'Marque','marque','Marques de véhicule','marques-de-vehicule','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(14,'Restauration','restauration','Equipements restauration','equipements-restauration','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(15,'Restauration','restauration','Equipements patisserie','equipements-patisserie','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(16,'Restauration','restauration','Produits fast-food','produits-fast-food','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(17,'Restauration','restauration','Produits patissiers','produits-patissiers','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(18,'Location de véhicule','location-de-vehicule','Types de moteur','types-moteur','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(19,'Vie nocturne','vie-nocturne','Types de musique','types-de-musique','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(20,'Vie nocturne','vie-nocturne','Commodités vie nocturne','commodites-vie-nocturne','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(21,'Vie nocturne','vie-nocturne','Equipements vie nocturne','equipements-vie-nocturne','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(22,'Restauration','restauration','Types de cuisine','types-cuisine','2024-11-22 08:43:33','2024-11-22 08:43:33',NULL,1,1,NULL),(23,'Vie nocture','vie-nocturne','Services','services','2024-12-23 09:52:13','2024-12-23 09:52:18',NULL,1,1,NULL),(24,'Restauration','restauration','Services proposés','services-proposes','2024-12-23 10:06:05','2024-12-23 10:06:07',NULL,1,1,NULL);
/*!40000 ALTER TABLE `references` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-23 10:11:57
