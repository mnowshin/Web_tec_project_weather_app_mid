-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: weather_app
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `emergency_contacts`
--

DROP TABLE IF EXISTS `emergency_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergency_contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `organization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_category_location` (`category`,`location`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_contacts`
--

LOCK TABLES `emergency_contacts` WRITE;
/*!40000 ALTER TABLE `emergency_contacts` DISABLE KEYS */;
INSERT INTO `emergency_contacts` VALUES (1,'Port Authority','Chittagong Port Authority','Port Control Room','+880-31-2510869','+880-31-2510889',NULL,'www.cpa.gov.bd','Chittagong','2025-05-25 06:09:58'),(2,'Port Authority','Mongla Port Authority','Emergency Control','+880-4658-75333',NULL,NULL,'www.mpa.gov.bd','Mongla','2025-05-25 06:09:58'),(3,'Weather Services','Bangladesh Meteorological Department','Storm Warning Center','+880-2-48122558','1090',NULL,'www.bmd.gov.bd','Dhaka','2025-05-25 06:09:58'),(4,'Weather Services','Flood Forecasting and Warning Centre','Flood Warning','+880-2-9552118','1090','ffwc@ffwc.gov.bd','www.ffwc.gov.bd','Dhaka','2025-05-25 06:09:58'),(5,'Regional Emergency','Cox\'s Bazar Control Room','District Control Room','+880-341-63470',NULL,NULL,NULL,'Cox\'s Bazar','2025-05-25 06:09:58'),(6,'Regional Emergency','Chittagong Emergency','Control Room','+880-31-630066',NULL,NULL,NULL,'Chittagong','2025-05-25 06:09:58'),(7,'Regional Emergency','Chittagong Emergency','Maritime Rescue','16517',NULL,NULL,NULL,'Chittagong','2025-05-25 06:09:58'),(8,'Regional Emergency','Chittagong Emergency','Ambulance','+880-31-630555',NULL,NULL,NULL,'Chittagong','2025-05-25 06:09:58'),(9,'National Emergency','National Emergency Service','Police','999',NULL,NULL,NULL,'Nationwide','2025-05-25 06:09:58'),(10,'National Emergency','National Emergency Service','Fire Service','16163',NULL,NULL,NULL,'Nationwide','2025-05-25 06:09:58'),(11,'National Emergency','National Emergency Service','Ambulance','999',NULL,NULL,NULL,'Nationwide','2025-05-25 06:09:58'),(12,'National Emergency','National Emergency Service','Disaster Management','1090',NULL,NULL,NULL,'Nationwide','2025-05-25 06:09:58'),(13,'National Emergency','Bangladesh Red Crescent Society','Emergency Medical Team','+880-2-9355995','+880-2-9333433',NULL,'www.bdrcs.org','Dhaka','2025-05-25 06:09:58'),(14,'Cyclone Warning','Maritime Port Warning Signals','Storm Warning','1090',NULL,NULL,NULL,'Nationwide','2025-05-25 06:09:58'),(15,'Cyclone Warning','Cyclone Preparedness Programme','Head Office','+880-2-55058730','+880-1714-069186',NULL,'www.cpp.gov.bd','Dhaka','2025-05-25 06:09:58'),(16,'Flood Warning','Bangladesh Water Development Board','Flood Forecasting Center','+880-2-9552118',NULL,'ffwc@ffwc.gov.bd','www.ffwc.gov.bd','Dhaka','2025-05-25 06:09:58'),(17,'Flood Warning','Bangladesh Inland Water Transport Authority','BIWTA Control Room','+880-2-9557188','16113',NULL,'www.biwta.gov.bd','Dhaka','2025-05-25 06:09:58'),(18,'Coastal District Emergency','Khulna Division Control','District Control Room','+880-41-760001',NULL,NULL,NULL,'Khulna','2025-05-25 06:09:58'),(19,'Coastal District Emergency','Barisal Division Control','District Emergency','+880-431-64987',NULL,NULL,NULL,'Barisal','2025-05-25 06:09:58'),(20,'Disaster Management','Disaster Management Information','SMS Alert Service','1090',NULL,NULL,NULL,'Nationwide','2025-05-25 06:09:58'),(21,'Disaster Management','Disaster Management Information','Emergency Shelters','109','+880-1730-327729',NULL,NULL,'Nationwide','2025-05-25 06:09:58');
/*!40000 ALTER TABLE `emergency_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,'rainy','2025-05-12 22:58:14',0);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saved_locations`
--

DROP TABLE IF EXISTS `saved_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saved_locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_city` (`user_id`,`city`),
  CONSTRAINT `saved_locations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_locations`
--

LOCK TABLES `saved_locations` WRITE;
/*!40000 ALTER TABLE `saved_locations` DISABLE KEYS */;
INSERT INTO `saved_locations` VALUES (4,1,'Dhaka, Bangladesh',23.810300,90.412500,'2025-05-25 05:14:18'),(6,1,'Khulna, Bangladesh',22.845600,89.540300,'2025-05-25 05:27:12');
/*!40000 ALTER TABLE `saved_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `number` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mayesha','mayesha','mnowshin217@gmail.com','$2y$10$huR.R/6icNUW632JpMHfJeCRR/6pnm3.Y2EdqAGaZWYny/SX1qq/6','0123456789','Dhaka, Bangladesh');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weather_info`
--

DROP TABLE IF EXISTS `weather_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weather_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `weather_condition` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wind_speed` decimal(5,2) DEFAULT NULL,
  `rain_chance` int DEFAULT NULL,
  `pressure` int DEFAULT NULL,
  `uv_index` decimal(4,2) DEFAULT NULL,
  `sunrise` time DEFAULT NULL,
  `sunset` time DEFAULT NULL,
  `forecast_date` date DEFAULT NULL,
  `recorded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_city_date` (`city`,`forecast_date`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weather_info`
--

LOCK TABLES `weather_info` WRITE;
/*!40000 ALTER TABLE `weather_info` DISABLE KEYS */;
INSERT INTO `weather_info` VALUES (50,'Dhaka, Bangladesh',23.810300,90.412500,29.80,'Rainy',9.50,65,1004,6.20,'05:15:00','18:30:00','2025-05-26','2025-06-01 02:00:00'),(51,'Dhaka, Bangladesh',23.810300,90.412500,30.20,'Partly Cloudy',7.80,30,1005,6.80,'05:15:00','18:30:00','2025-05-27','2025-06-01 02:00:00'),(52,'Dhaka, Bangladesh',23.810300,90.412500,31.00,'Sunny',6.80,15,1006,7.30,'05:15:00','18:30:00','2025-05-28','2025-06-01 02:00:00'),(53,'Dhaka, Bangladesh',23.810300,90.412500,28.70,'Thunderstorm',10.50,75,1003,5.40,'05:15:00','18:30:00','2025-05-29','2025-06-01 02:00:00'),(54,'Dhaka, Bangladesh',23.810300,90.412500,29.50,'Cloudy',8.90,50,1004,6.00,'05:15:00','18:30:00','2025-05-30','2025-06-01 02:00:00'),(55,'Dhaka, Bangladesh',23.810300,90.412500,30.00,'Partly Cloudy',7.50,25,1005,6.70,'05:15:00','18:30:00','2025-05-31','2025-06-01 02:00:00'),(56,'Dhaka, Bangladesh',23.810300,90.412500,29.20,'Rainy',9.80,70,1003,5.80,'05:15:00','18:30:00','2025-06-01','2025-06-01 02:00:00'),(57,'Dhaka, Bangladesh',23.810300,90.412500,28.50,'Thunderstorm',11.00,80,1002,5.20,'05:15:00','18:30:00','2025-06-02','2025-06-01 02:00:00'),(58,'Dhaka, Bangladesh',23.810300,90.412500,29.90,'Partly Cloudy',8.20,35,1005,6.50,'05:15:00','18:30:00','2025-06-03','2025-06-01 02:00:00'),(59,'Dhaka, Bangladesh',23.810300,90.412500,30.50,'Sunny',7.00,20,1006,7.20,'05:15:00','18:30:00','2025-06-04','2025-06-01 02:00:00'),(60,'Dhaka, Bangladesh',23.810300,90.412500,28.80,'Cloudy',9.00,45,1004,5.90,'05:15:00','18:30:00','2025-06-05','2025-06-01 02:00:00'),(61,'Dhaka, Bangladesh',23.810300,90.412500,29.30,'Rainy',10.20,60,1003,5.70,'05:15:00','18:30:00','2025-06-06','2025-06-01 02:00:00'),(62,'Dhaka, Bangladesh',23.810300,90.412500,30.10,'Partly Cloudy',7.90,30,1005,6.60,'05:15:00','18:30:00','2025-06-07','2025-06-01 02:00:00'),(63,'Dhaka, Bangladesh',23.810300,90.412500,29.00,'Thunderstorm',10.80,75,1002,5.30,'05:15:00','18:30:00','2025-06-08','2025-06-01 02:00:00'),(64,'Dhaka, Bangladesh',23.810300,90.412500,29.70,'Cloudy',8.70,50,1004,6.10,'05:15:00','18:30:00','2025-06-09','2025-06-01 02:00:00'),(65,'Dhaka, Bangladesh',23.810300,90.412500,30.30,'Sunny',7.20,15,1006,7.10,'05:15:00','18:30:00','2025-06-10','2025-06-01 02:00:00'),(66,'Chittagong, Bangladesh',22.356900,91.783200,28.90,'Rainy',10.80,70,1003,5.60,'05:10:00','18:25:00','2025-05-26','2025-06-01 02:00:00'),(67,'Chittagong, Bangladesh',22.356900,91.783200,29.20,'Partly Cloudy',8.50,35,1005,6.40,'05:10:00','18:25:00','2025-05-27','2025-06-01 02:00:00'),(68,'Chittagong, Bangladesh',22.356900,91.783200,29.80,'Sunny',7.50,20,1006,7.00,'05:10:00','18:25:00','2025-05-28','2025-06-01 02:00:00'),(69,'Chittagong, Bangladesh',22.356900,91.783200,27.80,'Thunderstorm',11.50,80,1002,5.20,'05:10:00','18:25:00','2025-05-29','2025-06-01 02:00:00'),(70,'Chittagong, Bangladesh',22.356900,91.783200,28.50,'Cloudy',9.20,55,1004,5.80,'05:10:00','18:25:00','2025-05-30','2025-06-01 02:00:00'),(71,'Chittagong, Bangladesh',22.356900,91.783200,29.00,'Partly Cloudy',8.00,30,1005,6.50,'05:10:00','18:25:00','2025-05-31','2025-06-01 02:00:00'),(72,'Chittagong, Bangladesh',22.356900,91.783200,28.20,'Rainy',10.50,65,1003,5.70,'05:10:00','18:25:00','2025-06-01','2025-06-01 02:00:00'),(73,'Chittagong, Bangladesh',22.356900,91.783200,27.90,'Thunderstorm',11.80,75,1002,5.30,'05:10:00','18:25:00','2025-06-02','2025-06-01 02:00:00'),(74,'Chittagong, Bangladesh',22.356900,91.783200,29.30,'Partly Cloudy',8.30,30,1005,6.60,'05:10:00','18:25:00','2025-06-03','2025-06-01 02:00:00'),(75,'Chittagong, Bangladesh',22.356900,91.783200,29.90,'Sunny',7.20,15,1006,7.10,'05:10:00','18:25:00','2025-06-04','2025-06-01 02:00:00'),(76,'Chittagong, Bangladesh',22.356900,91.783200,28.00,'Cloudy',9.50,50,1004,5.90,'05:10:00','18:25:00','2025-06-05','2025-06-01 02:00:00'),(77,'Chittagong, Bangladesh',22.356900,91.783200,28.70,'Rainy',10.20,60,1003,5.60,'05:10:00','18:25:00','2025-06-06','2025-06-01 02:00:00'),(78,'Chittagong, Bangladesh',22.356900,91.783200,29.50,'Partly Cloudy',8.00,25,1005,6.70,'05:10:00','18:25:00','2025-06-07','2025-06-01 02:00:00'),(79,'Chittagong, Bangladesh',22.356900,91.783200,28.10,'Thunderstorm',11.00,70,1002,5.40,'05:10:00','18:25:00','2025-06-08','2025-06-01 02:00:00'),(80,'Chittagong, Bangladesh',22.356900,91.783200,28.80,'Cloudy',9.00,45,1004,6.00,'05:10:00','18:25:00','2025-06-09','2025-06-01 02:00:00'),(81,'Chittagong, Bangladesh',22.356900,91.783200,29.70,'Sunny',7.50,20,1006,7.20,'05:10:00','18:25:00','2025-06-10','2025-06-01 02:00:00'),(82,'Rajshahi, Bangladesh',24.374500,88.604200,30.80,'Sunny',6.80,15,1006,7.30,'05:20:00','18:35:00','2025-05-26','2025-06-01 02:00:00'),(83,'Rajshahi, Bangladesh',24.374500,88.604200,31.20,'Partly Cloudy',7.50,25,1005,7.00,'05:20:00','18:35:00','2025-05-27','2025-06-01 02:00:00'),(84,'Rajshahi, Bangladesh',24.374500,88.604200,29.70,'Cloudy',8.80,40,1004,6.20,'05:20:00','18:35:00','2025-05-28','2025-06-01 02:00:00'),(85,'Rajshahi, Bangladesh',24.374500,88.604200,30.20,'Sunny',6.50,10,1006,7.40,'05:20:00','18:35:00','2025-05-29','2025-06-01 02:00:00'),(86,'Rajshahi, Bangladesh',24.374500,88.604200,31.00,'Partly Cloudy',7.80,20,1005,7.10,'05:20:00','18:35:00','2025-05-30','2025-06-01 02:00:00'),(87,'Rajshahi, Bangladesh',24.374500,88.604200,29.20,'Rainy',9.50,55,1004,6.00,'05:20:00','18:35:00','2025-05-31','2025-06-01 02:00:00'),(88,'Rajshahi, Bangladesh',24.374500,88.604200,30.50,'Sunny',6.70,15,1006,7.20,'05:20:00','18:35:00','2025-06-01','2025-06-01 02:00:00'),(89,'Rajshahi, Bangladesh',24.374500,88.604200,29.00,'Cloudy',8.90,45,1004,6.10,'05:20:00','18:35:00','2025-06-02','2025-06-01 02:00:00'),(90,'Rajshahi, Bangladesh',24.374500,88.604200,30.30,'Partly Cloudy',7.60,25,1005,6.80,'05:20:00','18:35:00','2025-06-03','2025-06-01 02:00:00'),(91,'Rajshahi, Bangladesh',24.374500,88.604200,29.80,'Rainy',9.20,60,1003,5.90,'05:20:00','18:35:00','2025-06-04','2025-06-01 02:00:00'),(92,'Rajshahi, Bangladesh',24.374500,88.604200,30.70,'Sunny',6.60,10,1006,7.30,'05:20:00','18:35:00','2025-06-05','2025-06-01 02:00:00'),(93,'Rajshahi, Bangladesh',24.374500,88.604200,29.50,'Partly Cloudy',7.90,30,1005,6.70,'05:20:00','18:35:00','2025-06-06','2025-06-01 02:00:00'),(94,'Rajshahi, Bangladesh',24.374500,88.604200,28.90,'Cloudy',8.70,50,1004,6.00,'05:20:00','18:35:00','2025-06-07','2025-06-01 02:00:00'),(95,'Rajshahi, Bangladesh',24.374500,88.604200,30.20,'Sunny',6.50,15,1006,7.20,'05:20:00','18:35:00','2025-06-08','2025-06-01 02:00:00'),(96,'Rajshahi, Bangladesh',24.374500,88.604200,31.10,'Partly Cloudy',7.70,20,1005,7.00,'05:20:00','18:35:00','2025-06-09','2025-06-01 02:00:00'),(97,'Rajshahi, Bangladesh',24.374500,88.604200,29.30,'Rainy',9.00,55,1004,6.10,'05:20:00','18:35:00','2025-06-10','2025-06-01 02:00:00'),(98,'Khulna, Bangladesh',22.845600,89.540300,29.20,'Cloudy',9.50,50,1004,6.00,'05:15:00','18:30:00','2025-05-26','2025-06-01 02:00:00'),(99,'Khulna, Bangladesh',22.845600,89.540300,28.80,'Rainy',10.80,65,1003,5.70,'05:15:00','18:30:00','2025-05-27','2025-06-01 02:00:00'),(100,'Khulna, Bangladesh',22.845600,89.540300,29.70,'Thunderstorm',11.20,75,1002,5.40,'05:15:00','18:30:00','2025-05-28','2025-06-01 02:00:00'),(101,'Khulna, Bangladesh',22.845600,89.540300,30.20,'Partly Cloudy',8.30,30,1005,6.80,'05:15:00','18:30:00','2025-05-29','2025-06-01 02:00:00'),(102,'Khulna, Bangladesh',22.845600,89.540300,28.50,'Cloudy',9.80,55,1004,5.90,'05:15:00','18:30:00','2025-05-30','2025-06-01 02:00:00'),(103,'Khulna, Bangladesh',22.845600,89.540300,29.90,'Sunny',7.50,20,1006,7.10,'05:15:00','18:30:00','2025-05-31','2025-06-01 02:00:00'),(104,'Khulna, Bangladesh',22.845600,89.540300,28.30,'Rainy',10.50,70,1003,5.60,'05:15:00','18:30:00','2025-06-01','2025-06-01 02:00:00'),(105,'Khulna, Bangladesh',22.845600,89.540300,29.00,'Thunderstorm',11.50,80,1002,5.30,'05:15:00','18:30:00','2025-06-02','2025-06-01 02:00:00'),(106,'Khulna, Bangladesh',22.845600,89.540300,29.80,'Partly Cloudy',8.00,25,1005,6.70,'05:15:00','18:30:00','2025-06-03','2025-06-01 02:00:00'),(107,'Khulna, Bangladesh',22.845600,89.540300,30.30,'Sunny',7.20,15,1006,7.20,'05:15:00','18:30:00','2025-06-04','2025-06-01 02:00:00'),(108,'Khulna, Bangladesh',22.845600,89.540300,28.70,'Cloudy',9.50,50,1004,6.00,'05:15:00','18:30:00','2025-06-05','2025-06-01 02:00:00'),(109,'Khulna, Bangladesh',22.845600,89.540300,29.20,'Rainy',10.20,65,1003,5.70,'05:15:00','18:30:00','2025-06-06','2025-06-01 02:00:00'),(110,'Khulna, Bangladesh',22.845600,89.540300,29.90,'Partly Cloudy',8.00,30,1005,6.60,'05:15:00','18:30:00','2025-06-07','2025-06-01 02:00:00'),(111,'Khulna, Bangladesh',22.845600,89.540300,28.50,'Thunderstorm',11.00,75,1002,5.40,'05:15:00','18:30:00','2025-06-08','2025-06-01 02:00:00'),(112,'Khulna, Bangladesh',22.845600,89.540300,29.30,'Cloudy',9.20,45,1004,6.10,'05:15:00','18:30:00','2025-06-09','2025-06-01 02:00:00'),(113,'Khulna, Bangladesh',22.845600,89.540300,30.00,'Sunny',7.50,20,1006,7.10,'05:15:00','18:30:00','2025-06-10','2025-06-01 02:00:00'),(114,'Sylhet, Bangladesh',24.894900,91.868700,28.20,'Rainy',10.50,65,1003,5.70,'05:05:00','18:20:00','2025-05-26','2025-06-01 02:00:00'),(115,'Sylhet, Bangladesh',24.894900,91.868700,28.80,'Thunderstorm',11.50,75,1002,5.40,'05:05:00','18:20:00','2025-05-27','2025-06-01 02:00:00'),(116,'Sylhet, Bangladesh',24.894900,91.868700,27.90,'Cloudy',9.50,50,1004,6.00,'05:05:00','18:20:00','2025-05-28','2025-06-01 02:00:00'),(117,'Sylhet, Bangladesh',24.894900,91.868700,29.20,'Partly Cloudy',8.20,30,1005,6.60,'05:05:00','18:20:00','2025-05-29','2025-06-01 02:00:00'),(118,'Sylhet, Bangladesh',24.894900,91.868700,29.80,'Sunny',7.50,15,1006,7.10,'05:05:00','18:20:00','2025-05-30','2025-06-01 02:00:00'),(119,'Sylhet, Bangladesh',24.894900,91.868700,28.00,'Rainy',10.80,70,1003,5.60,'05:05:00','18:20:00','2025-05-31','2025-06-01 02:00:00'),(120,'Sylhet, Bangladesh',24.894900,91.868700,28.50,'Thunderstorm',11.20,80,1002,5.30,'05:05:00','18:20:00','2025-06-01','2025-06-01 02:00:00'),(121,'Sylhet, Bangladesh',24.894900,91.868700,29.00,'Partly Cloudy',8.00,25,1005,6.70,'05:05:00','18:20:00','2025-06-02','2025-06-01 02:00:00'),(122,'Sylhet, Bangladesh',24.894900,91.868700,29.50,'Sunny',7.20,20,1006,7.20,'05:05:00','18:20:00','2025-06-03','2025-06-01 02:00:00'),(123,'Sylhet, Bangladesh',24.894900,91.868700,28.20,'Cloudy',9.50,50,1004,6.00,'05:05:00','18:20:00','2025-06-04','2025-06-01 02:00:00'),(124,'Sylhet, Bangladesh',24.894900,91.868700,28.80,'Rainy',10.20,65,1003,5.70,'05:05:00','18:20:00','2025-06-05','2025-06-01 02:00:00'),(125,'Sylhet, Bangladesh',24.894900,91.868700,29.30,'Partly Cloudy',8.00,30,1005,6.60,'05:05:00','18:20:00','2025-06-06','2025-06-01 02:00:00'),(126,'Sylhet, Bangladesh',24.894900,91.868700,28.00,'Thunderstorm',11.00,75,1002,5.40,'05:05:00','18:20:00','2025-06-07','2025-06-01 02:00:00'),(127,'Sylhet, Bangladesh',24.894900,91.868700,28.70,'Cloudy',9.20,45,1004,6.10,'05:05:00','18:20:00','2025-06-08','2025-06-01 02:00:00'),(128,'Sylhet, Bangladesh',24.894900,91.868700,29.90,'Sunny',7.50,20,1006,7.10,'05:05:00','18:20:00','2025-06-09','2025-06-01 02:00:00'),(129,'Sylhet, Bangladesh',24.894900,91.868700,28.50,'Rainy',10.50,65,1003,5.80,'05:05:00','18:20:00','2025-06-10','2025-06-01 02:00:00'),(130,'Dhaka, Bangladesh',23.810300,90.412500,29.80,'Cloudy',8.70,50,1004,6.30,'05:15:00','18:30:00','2025-05-25','2025-05-25 04:05:00'),(131,'Rajshahi, Bangladesh',24.374500,88.604200,30.80,'Sunny',6.80,15,1006,7.20,'05:20:00','18:35:00','2025-05-25','2025-05-25 04:05:00'),(132,'Khulna, Bangladesh',22.845600,89.540300,29.30,'Partly Cloudy',8.50,30,1005,6.60,'05:15:00','18:30:00','2025-05-25','2025-05-25 04:05:00'),(133,'Sylhet, Bangladesh',24.894900,91.868700,28.50,'Rainy',10.20,65,1003,5.80,'05:05:00','18:20:00','2025-05-25','2025-05-25 04:05:00');
/*!40000 ALTER TABLE `weather_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-25 12:17:03
