-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: job_portal
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT '../images/default_profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` varchar(50) NOT NULL DEFAULT 'admin',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `verification_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'PDAO','One','admin1@gmail.com','1234567890','$2y$10$cA7f2wFqyjLdoPN34cncXeub66hFSoB0lwL.wI.PvUDEYmc7.GGC.','../uploads/1745470882_bg6.jpg','2025-03-12 13:47:23','2025-04-27 10:30:29','admin','active',NULL),(5,'Admin','Two','admin2@gmail.com','','$2y$10$40BZuRcOatSCWCTyqy4bxuZrjzwIuSRFY7IthKmebw4HCbZqM1i.K','../images/default_profile.jpg','2025-03-21 23:33:19','2025-03-22 06:33:19','admin','active',''),(6,'PDAO','One','pdao1@gmail.com','','$2y$10$T56imAciYtkl9zXmquFHiOgH2tcTYdoK772K6dIjqlTjqiaK7KTIe','../images/default_profile.jpg','2025-04-26 23:25:00','2025-04-27 05:25:00','admin','active',NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usertype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
INSERT INTO `audit_log` VALUES (338,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-24 08:08:12','staff'),(339,1,'Sample Staff','Create','Company \'PWD Job Portal Solutions Inc.\' created','::1','2025-04-24 08:09:24','staff'),(340,1,'Sample Staff','Archieve','Company \'PWD Job Portal Solutions Inc.\' soft deleted','::1','2025-04-24 08:09:37','staff'),(341,1,'Sample Staff','Restore','Company \'PWD Job Portal Solutions Inc.\' restored','::1','2025-04-24 08:09:40','staff'),(342,1,'Sample Staff','Archieve','Company \'PWD Job Portal Solutions Inc.\' soft deleted','::1','2025-04-24 08:09:53','staff'),(343,1,'Sample Staff','Restore','Company \'PWD Job Portal Solutions Inc.\' restored','::1','2025-04-24 08:09:56','staff'),(344,1,'Sample Staff','Logout','User logged out.','::1','2025-04-24 08:10:21','staff'),(345,1,'Admin User','Login','Admin logged in successfully','::1','2025-04-24 08:10:35','admin'),(346,1,'Admin User','Logout','User logged out.','::1','2025-04-24 08:10:44','admin'),(347,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-25 05:21:57','staff'),(348,1,'Sample Staff','Job Posting','Job posted: Engineer at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:22:13','staff'),(349,1,'Sample Staff','Job Posting','Job posted: Engineer at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:24:45','staff'),(350,1,'Sample Staff','Job Posting','Job posted: a at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:26:40','staff'),(351,1,'Sample Staff','Job Posting','Job posted: a at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:28:16','staff'),(352,1,'Sample Staff','Job Posting','Job posted: as at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:29:03','staff'),(353,1,'Sample Staff','Job Posting','Job posted: a at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:52:36','staff'),(354,1,'Sample Staff','Job Posting','Job posted: asd at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:58:19','staff'),(355,1,'Sample Staff','Job Posting','Job posted: asaa at PWD Job Portal Solutions Inc. by Sample Staff','::1','2025-04-25 05:59:37','staff'),(356,1,'Sample Staff','Logout','User logged out.','::1','2025-04-25 06:01:50','staff'),(357,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-25 06:09:23','staff'),(358,1,'Sample Staff','Logout','User logged out.','::1','2025-04-25 06:49:09','staff'),(359,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-25 06:49:20','staff'),(360,1,'Sample Staff','Archieve','Company \'PWD Job Portal Solutions Inc.\' soft deleted','::1','2025-04-25 06:53:07','staff'),(361,1,'Sample Staff','Restore','Company \'PWD Job Portal Solutions Inc.\' restored','::1','2025-04-25 06:53:09','staff'),(362,1,'Sample Staff','Logout','User logged out.','::1','2025-04-25 07:03:03','staff'),(363,1,'Admin User','Login','Admin logged in successfully','::1','2025-04-25 07:03:11','admin'),(364,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'For Release\' by Admin User','::1','2025-04-25 07:11:02','admin'),(365,1,'Admin User','Logout','User logged out.','::1','2025-04-25 07:31:36','admin'),(366,1,'Supers Admin','Login','Super Admin logged in successfully','::1','2025-04-25 07:32:05','super_admin'),(367,1,'Admin User','Login','Admin logged in successfully','::1','2025-04-25 07:33:37','admin'),(368,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-25 07:37:38','admin'),(369,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-25 07:37:44','admin'),(370,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-25 07:40:03','admin'),(371,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-25 07:40:37','admin'),(372,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Approved\' by Admin User','::1','2025-04-25 07:45:47','admin'),(373,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-25 07:46:33','admin'),(374,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-25 07:47:28','admin'),(375,1,'Admin User','Logout','User logged out.','::1','2025-04-25 08:05:59','admin'),(376,1,'Admin User','Login','Admin logged in successfully','::1','2025-04-26 11:56:11','admin'),(377,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Approved\' by Admin User','::1','2025-04-26 11:56:49','admin'),(378,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User','::1','2025-04-26 12:03:30','admin'),(379,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Approved\' by Admin User','::1','2025-04-26 12:04:05','admin'),(380,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-26 12:26:06','staff'),(381,1,'Sample Staff','Create','Company \'Concetrix\' created','::1','2025-04-26 12:26:28','staff'),(382,1,'Sample Staff','Job Posting','Job posted: as at Concetrix by Sample Staff','::1','2025-04-26 12:26:45','staff'),(383,1,'Sample Staff','Logout','User logged out.','::1','2025-04-26 12:45:56','staff'),(384,1,'Supers Admin','Login','Super Admin logged in successfully','::1','2025-04-26 12:46:09','super_admin'),(385,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-27 04:45:29','staff'),(386,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 04:47:02','staff'),(387,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 04:53:16','staff'),(388,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 04:56:04','staff'),(389,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 05:00:06','staff'),(390,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 05:00:38','staff'),(391,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 05:05:21','staff'),(392,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 05:08:59','staff'),(393,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 05:17:05','staff'),(394,1,'Supers Admin','Login','Super Admin logged in successfully','::1','2025-04-27 05:24:39','super_admin'),(395,1,'Supers Admin','Create','Admin \'PDAO One\' added','::1','2025-04-27 05:25:00','super_admin'),(396,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-27 05:27:18','staff'),(397,1,'Sample Staff','Logout','User logged out.','::1','2025-04-27 06:39:37','staff'),(398,1,'Admin User','Login','Admin logged in successfully','::1','2025-04-27 06:39:46','admin'),(399,1,'Admin User','PWD Status Update','Status for PWD \'John Doe\' updated to \'Released\' by Admin User','::1','2025-04-27 06:56:52','admin'),(400,1,'PDAO One','Update','Admin profile updated: First Name, Last Name','::1','2025-04-27 07:04:36','admin'),(401,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-27 07:19:23','staff'),(402,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 07:23:08','staff'),(403,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 07:24:41','staff'),(404,1,'Sample Staff','Job Posting','Job posted: as at Concetrix by Sample Staff','::1','2025-04-27 07:26:27','staff'),(405,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 07:27:36','staff'),(406,1,'PDAO One','Login','Admin logged in successfully','::1','2025-04-27 10:30:11','admin'),(407,1,'PDAO One','Logout','User logged out.','::1','2025-04-27 10:30:31','admin'),(408,1,'PDAO One','Login','Admin logged in successfully','::1','2025-04-27 10:30:42','admin'),(409,1,'PDAO One','Logout','User logged out.','::1','2025-04-27 10:32:16','admin'),(410,1,'Sample Staff','Login','User logged in successfully','::1','2025-04-27 14:54:15','staff'),(411,1,'Sample Staff','Job Posting','Job posted: aa at Concetrix by Sample Staff','::1','2025-04-27 14:54:37','staff'),(412,1,'Sample Staff','Job Posting','Job posted: aa at Concetrix by Sample Staff','::1','2025-04-27 14:54:43','staff'),(413,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 14:56:24','staff'),(414,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 15:04:39','staff'),(415,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 15:26:51','staff'),(416,1,'Sample Staff','Job Posting','Job posted: asd at Concetrix by Sample Staff','::1','2025-04-27 15:29:05','staff'),(417,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 15:53:36','staff'),(418,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 15:55:26','staff'),(419,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 15:56:42','staff'),(420,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 15:59:09','staff'),(421,1,'Sample Staff','Job Posting','Job posted: asdasdasdasd at Concetrix by Sample Staff','::1','2025-04-27 16:00:57','staff'),(422,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 16:02:11','staff'),(423,1,'Sample Staff','Job Posting','Job posted: Engineer at Concetrix by Sample Staff','::1','2025-04-27 16:04:12','staff'),(424,1,'Sample Staff','Job Posting','Job posted: asd at Concetrix by Sample Staff','::1','2025-04-27 16:06:32','staff'),(425,1,'Sample Staff','Job Posting','Job posted: a at Concetrix by Sample Staff','::1','2025-04-27 16:08:10','staff'),(426,1,'Supers Admin','Login','Super Admin logged in successfully','::1','2025-04-28 05:34:11','super_admin');
/*!40000 ALTER TABLE `audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (25,'Concetrix','../uploads/1745670388_ts3.jpg','Taytay','a','2025-04-26 14:26:28','2025-04-26 12:26:28',0,NULL);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Open','Closed','Archived') NOT NULL DEFAULT 'Open',
  `posted_date` datetime DEFAULT current_timestamp(),
  `staff_id` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `job_type` enum('Full-time','Part-time','Contract','Freelance') NOT NULL,
  `location` varchar(255) NOT NULL,
  `archived_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (65,25,'Concetrix','../uploads/1745670388_ts3.jpg','as','a','Archived','2025-04-26 14:26:43',1,'2',2.00,'Contract','Taytay','2025-04-27 14:29:23'),(66,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Archived','2025-04-27 06:47:00',1,'a',2.00,'Part-time','Taytay','2025-04-27 14:29:25'),(67,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Archived','2025-04-27 06:53:14',1,'aa',2.00,'Part-time','Taytay','2025-04-27 14:29:29'),(68,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 06:56:01',1,'a',2.00,'Part-time','Taytay','2025-04-27 14:16:26'),(69,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Archived','2025-04-27 07:00:04',1,'aa',2.00,'Part-time','Taytay','2025-04-27 14:16:24'),(70,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 07:00:35',1,'a',2.00,'Part-time','Taytay',NULL),(71,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 07:05:18',1,'a',2.00,'Part-time','Taytay',NULL),(72,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Archived','2025-04-27 07:08:56',1,'2',2.00,'Part-time','Taytay','2025-04-27 14:16:21'),(73,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Archived','2025-04-27 07:17:02',1,'a',2.00,'Contract','Taytay','2025-04-27 14:16:05'),(74,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 09:23:08',1,'2',2.00,'Part-time','Taytay',NULL),(75,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 09:24:41',1,'a',2.00,'Part-time','Taytay',NULL),(76,25,'Concetrix','../uploads/1745670388_ts3.jpg','as','a','Open','2025-04-27 09:26:27',1,'a',2.00,'Part-time','Taytay',NULL),(77,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 09:27:36',1,'a',2.00,'Part-time','Taytay',NULL),(78,25,'Concetrix','../uploads/1745670388_ts3.jpg','aa','a','Open','2025-04-27 16:54:36',1,'aa',2.00,'Contract','Taytay',NULL),(79,25,'Concetrix','../uploads/1745670388_ts3.jpg','aa','a','Open','2025-04-27 16:54:43',1,'aa',2.00,'Contract','Taytay',NULL),(80,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','as','Open','2025-04-27 16:56:24',1,'aa',2.00,'Part-time','Taytay',NULL),(81,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Open','2025-04-27 17:04:39',1,'a',2.00,'Part-time','Taytay',NULL),(82,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','a','Open','2025-04-27 17:26:47',1,'a',2.00,'Part-time','Taytay',NULL),(83,25,'Concetrix','../uploads/1745670388_ts3.jpg','asd','a','Open','2025-04-27 17:29:01',1,'a',2.00,'Part-time','Taytay',NULL),(84,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Open','2025-04-27 17:53:32',1,'2a',2.00,'Part-time','Taytay',NULL),(85,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Open','2025-04-27 17:55:22',1,'2',2.00,'Contract','Taytay',NULL),(86,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Open','2025-04-27 17:56:38',1,'a',2.00,'Part-time','Taytay',NULL),(87,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Open','2025-04-27 17:59:05',1,'a',2.00,'Part-time','Taytay',NULL),(88,25,'Concetrix','../uploads/1745670388_ts3.jpg','asdasdasdasd','asdasdasdasda','Open','2025-04-27 18:00:53',1,'asdasdasdasd',2.00,'Part-time','Taytay',NULL),(89,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','ENG','Open','2025-04-27 18:02:08',1,'ENG',222.00,'Part-time','Taytay',NULL),(90,25,'Concetrix','../uploads/1745670388_ts3.jpg','Engineer','asd','Open','2025-04-27 18:04:07',1,'aaaa',2.00,'Part-time','Taytay',NULL),(91,25,'Concetrix','../uploads/1745670388_ts3.jpg','asd','a','Open','2025-04-27 18:06:28',1,'2',2.00,'Part-time','Taytay',NULL),(92,25,'Concetrix','../uploads/1745670388_ts3.jpg','a','a','Open','2025-04-27 18:08:09',1,'2',2.00,'Full-time','Taytay',NULL);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_admin`
--

DROP TABLE IF EXISTS `notification_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_admin` (
  `notification_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `seen` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`notification_id`,`admin_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `notification_admin_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`notification_id`) ON DELETE CASCADE,
  CONSTRAINT `notification_admin_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_admin`
--

LOCK TABLES `notification_admin` WRITE;
/*!40000 ALTER TABLE `notification_admin` DISABLE KEYS */;
INSERT INTO `notification_admin` VALUES (9,1,1,'2025-03-21 11:50:15'),(10,1,1,'2025-03-22 06:38:29'),(10,5,0,'2025-03-22 06:38:29'),(11,1,1,'2025-03-22 06:39:55'),(11,5,0,'2025-03-22 06:39:55'),(12,1,1,'2025-03-22 06:44:11'),(12,5,0,'2025-03-22 06:44:11'),(13,1,1,'2025-04-23 11:35:13'),(13,5,0,'2025-04-23 11:35:13'),(14,1,1,'2025-04-23 11:45:28'),(14,5,0,'2025-04-23 11:45:28'),(15,1,1,'2025-04-23 11:48:46'),(15,5,0,'2025-04-23 11:48:46'),(16,1,1,'2025-04-23 11:54:10'),(16,5,0,'2025-04-23 11:54:11'),(17,1,1,'2025-04-23 12:05:28'),(17,5,0,'2025-04-23 12:05:28'),(18,1,1,'2025-04-23 13:25:56'),(18,5,0,'2025-04-23 13:25:56'),(19,1,1,'2025-04-23 13:38:39'),(19,5,0,'2025-04-23 13:38:39'),(20,1,1,'2025-04-23 13:39:24'),(20,5,0,'2025-04-23 13:39:24'),(21,1,1,'2025-04-23 13:39:42'),(21,5,0,'2025-04-23 13:39:42'),(22,1,1,'2025-04-25 05:12:53'),(22,5,0,'2025-04-25 05:12:53'),(23,1,1,'2025-04-25 07:09:32'),(23,5,0,'2025-04-25 07:09:32'),(24,1,1,'2025-04-25 08:00:17'),(24,5,0,'2025-04-25 08:00:17'),(25,1,1,'2025-04-26 11:56:38'),(25,5,0,'2025-04-26 11:56:38'),(26,1,1,'2025-04-27 06:56:23'),(26,5,0,'2025-04-27 06:56:23'),(26,6,0,'2025-04-27 06:56:23');
/*!40000 ALTER TABLE `notification_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'New PWD registration from John Doe (Application ID: APP_5943144B)','2025-03-21 11:26:38'),(2,'New PWD registration from John Doe (Application ID: APP_B96301E1)','2025-03-21 11:30:43'),(3,'New PWD registration from John Doe (Application ID: APP_3D58E069)','2025-03-21 11:31:28'),(4,'New PWD registration from John Doe (Application ID: APP_6A4E0323)','2025-03-21 11:33:28'),(5,'New PWD registration from John Doe (Application ID: APP_E26DEB9D)','2025-03-21 11:35:34'),(6,'New PWD registration from John Doe (Application ID: APP_E7C29543)','2025-03-21 11:38:27'),(7,'New PWD registration from red (Application ID: APP_59133B7D)','2025-03-21 11:43:47'),(8,'New PWD registration from John Doe (Application ID: APP_14D35EDF)','2025-03-21 11:47:22'),(9,'New PWD registration from John Doe','2025-03-21 11:50:15'),(10,'New PWD registration from John Doe','2025-03-22 06:38:29'),(11,'New PWD registration from red','2025-03-22 06:39:55'),(12,'New PWD registration from John Doe','2025-03-22 06:44:11'),(13,'New PWD registration from John Doe','2025-04-23 11:35:13'),(14,'New PWD registration from John Doe','2025-04-23 11:45:28'),(15,'New PWD registration from John Doe','2025-04-23 11:48:46'),(16,'New PWD registration from John Doe','2025-04-23 11:54:10'),(17,'New PWD registration from John Doe','2025-04-23 12:05:28'),(18,'New PWD registration from John Doe','2025-04-23 13:25:56'),(19,'New PWD registration from John Doe','2025-04-23 13:38:39'),(20,'New PWD registration from red','2025-04-23 13:39:24'),(21,'New PWD registration from John Doe','2025-04-23 13:39:42'),(22,'New PWD registration from John Doe','2025-04-25 05:12:53'),(23,'New PWD registration from John Doe','2025-04-25 07:09:32'),(24,'New PWD registration from John Doe','2025-04-25 08:00:17'),(25,'New PWD registration from John Doe','2025-04-26 11:56:38'),(26,'New PWD registration from red','2025-04-27 06:56:23');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pwd_registration`
--

DROP TABLE IF EXISTS `pwd_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pwd_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `disability_type` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `proof_of_pwd` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Pending','Approved','For Printing','For Release','Released','Rejected') NOT NULL DEFAULT 'Pending',
  `seen` int(11) DEFAULT 0,
  `notification_id` int(11) DEFAULT NULL,
  `valid_id_back` varchar(255) NOT NULL,
  `valid_id_type` varchar(255) NOT NULL,
  `reason` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `application_id` (`application_id`),
  KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pwd_registration`
--

LOCK TABLES `pwd_registration` WRITE;
/*!40000 ALTER TABLE `pwd_registration` DISABLE KEYS */;
INSERT INTO `pwd_registration` VALUES (124,'John Doe','2025-04-04','psychosocial','a','+639519629526','jv.aragones1414@gmail.com','APP_5240C5D2','../applications/1745668598_image_2025-04-26_195632328.png','../applications/1745668598_image_2025-04-26_195635492.png','2025-04-26 11:56:38','2025-04-27 15:29:58','Released',0,NULL,'../applications/1745668598_image_2025-04-26_195636822.png','PhilHealth',''),(125,'red','2025-04-05','hearing','aa','+639071559721','staff1@gmail.coma','APP_1F83C021','../applications/1745736983_ts2.jpg','../applications/1745736983_moa2.jpg','2025-04-27 06:56:23','2025-04-27 06:56:23','Pending',0,NULL,'../applications/1745736983_moa2.jpg','Barangay',NULL);
/*!40000 ALTER TABLE `pwd_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registered_pwd`
--

DROP TABLE IF EXISTS `registered_pwd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registered_pwd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered_pwd`
--

LOCK TABLES `registered_pwd` WRITE;
/*!40000 ALTER TABLE `registered_pwd` DISABLE KEYS */;
INSERT INTO `registered_pwd` VALUES (8,'John Doe','a','+639071559721','admin1@gmail.com','2025-04-04','psychosocial','2025-04-27 06:56:52','Active');
/*!40000 ALTER TABLE `registered_pwd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT '../images/default_profile.jpg',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `usertype` varchar(50) NOT NULL DEFAULT 'staff',
  `verification_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Sample','Staff','staff1@gmail.com','09123456789','$2y$10$IiihPl49MrDrLS8ZwwtckuE9M8lmf7J1mFMprLji1FZ/VJRlwBSd2','2025-03-12 16:32:02','../uploads/1742448535_bg6.jpg','active','staff',NULL),(12,'Staff','two','staff2@gmail.com',NULL,'$2y$10$OzJjEXo9bWv/GDFUy7PdwuqsoE6FyJ3Z7Mrh9WxBrZoheye1IwDO.','2025-03-21 23:33:03','../images/default_profile.jpg','active','staff',NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `super_admin`
--

DROP TABLE IF EXISTS `super_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `super_admin` (
  `super_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT '../images/default-profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` enum('super_admin') DEFAULT 'super_admin',
  `verification_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`super_admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `super_admin`
--

LOCK TABLES `super_admin` WRITE;
/*!40000 ALTER TABLE `super_admin` DISABLE KEYS */;
INSERT INTO `super_admin` VALUES (1,'Supers','Admin','superadmin1@gmail.com','09123456789','$2y$10$RjJGXdJqoSoesbKd3.E6mOnsv4AMpdO8OwwXLzl7qjXTOs.jecQEi','../uploads/1742623076_bg6.jpg','2025-03-21 06:03:46','2025-04-24 08:05:41','super_admin',NULL);
/*!40000 ALTER TABLE `super_admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-28 13:39:02
