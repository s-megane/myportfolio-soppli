-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: soppli
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `event_id` bigint(20) unsigned NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_user_id_event_id_unique` (`user_id`,`event_id`),
  KEY `attendances_event_id_foreign` (`event_id`),
  CONSTRAINT `attendances_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (6,18,13,1,'2021-02-01 05:31:00','2021-02-01 05:31:00'),(7,11,13,1,'2021-02-01 05:44:10','2021-02-01 05:44:10');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluation_target`
--

DROP TABLE IF EXISTS `evaluation_target`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluation_target` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluation_id` bigint(20) unsigned NOT NULL,
  `target_id` bigint(20) unsigned NOT NULL,
  `meet` bigint(20) unsigned NOT NULL,
  `power` bigint(20) unsigned NOT NULL,
  `run` bigint(20) unsigned NOT NULL,
  `defense` bigint(20) unsigned NOT NULL,
  `shoulder` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `evaluation_target_evaluation_id_target_id_unique` (`evaluation_id`,`target_id`),
  KEY `evaluation_target_target_id_foreign` (`target_id`),
  CONSTRAINT `evaluation_target_evaluation_id_foreign` FOREIGN KEY (`evaluation_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evaluation_target_target_id_foreign` FOREIGN KEY (`target_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluation_target`
--

LOCK TABLES `evaluation_target` WRITE;
/*!40000 ALTER TABLE `evaluation_target` DISABLE KEYS */;
INSERT INTO `evaluation_target` VALUES (4,16,16,4,8,2,4,2,'2021-01-16 17:28:48','2021-01-18 18:38:00'),(5,11,16,2,4,1,3,4,'2021-01-16 17:37:25','2021-01-20 19:14:11'),(6,11,11,2,3,3,3,4,'2021-01-16 18:24:23','2021-02-01 02:01:34'),(7,16,11,3,3,3,3,3,'2021-01-16 18:25:30','2021-01-16 18:25:30'),(10,11,17,4,5,3,5,5,'2021-01-17 22:45:11','2021-01-20 19:09:33'),(11,16,18,3,6,8,5,3,'2021-01-18 18:36:15','2021-01-18 18:36:15'),(12,11,18,6,4,4,5,3,'2021-01-18 18:41:17','2021-01-20 19:12:48'),(13,18,16,2,5,2,4,4,'2021-02-01 03:20:05','2021-02-01 03:20:05');
/*!40000 ALTER TABLE `evaluation_target` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eventdate` date NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meetingtime` time NOT NULL,
  `deadlinedate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (13,'2021-05-23','大会1','喜久田スポーツ広場','07:00:00','2021-05-16','2021-02-01 05:28:41','2021-02-01 05:28:41');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) unsigned NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opponent` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `myscore` bigint(20) unsigned DEFAULT NULL,
  `oppscore` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `games_event_id_foreign` (`event_id`),
  CONSTRAINT `games_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (17,13,'第1試合','ペインターズ',4,3,'2021-02-01 05:28:41','2021-02-01 08:09:52'),(18,13,'第2試合','Gファイターズ',2,10,'2021-02-01 05:28:41','2021-02-01 08:10:03');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (21,'2014_10_12_000000_create_users_table',1),(22,'2014_10_12_100000_create_password_resets_table',1),(23,'2019_08_19_000000_create_failed_jobs_table',1),(24,'2020_10_15_205445_create_events_table',1),(27,'2020_10_27_010915_create_attendances_table',2),(29,'2021_01_16_020731_create_evaluation_target',3),(32,'2021_01_18_215615_create_games_table',4),(35,'2021_01_21_153737_create_users_games_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mynum` int(11) DEFAULT NULL,
  `dominant_def` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dominant_bat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'田牧成奈','nihonniegaowo@outlook.jp',NULL,'$2y$10$qc92xvEIfOYxwb49n6bt2eWUE/3O5ST.N3cvPLQgcTcd1girpFht.',1,NULL,'1989-05-24',30,'左','左','2021-01-09 01:28:26','2021-01-30 02:21:19'),(16,'田牧泉','test@test.com',NULL,'$2y$10$DSpY9QgPAiVAg9N2/GP.8OpvzwNlrr3pvBCYesohRkMHdCSdo4Lz6',3,NULL,'1966-09-09',37,'右','右','2021-01-16 17:23:38','2021-01-18 15:37:25'),(17,'たかき','aaaa@aa.jp',NULL,'$2y$10$Y39IFCNFjSvHUTaiPa3p3.rvrDiMunRf4170VNG.SlJqXGaeGHvEm',3,NULL,NULL,NULL,NULL,NULL,'2021-01-17 22:14:42','2021-01-17 22:14:42'),(18,'たくみ（サンプル）','tttt@tt.jp',NULL,'$2y$10$8TB4U3KKigzMiYSGi6Po7eLqh2KC4s0jHZE/vw/P5rhoQ.9nzuoo.',2,NULL,'1989-12-13',1,'右','両','2021-01-18 17:02:25','2021-02-01 03:05:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_games`
--

DROP TABLE IF EXISTS `users_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `at_bat` bigint(20) unsigned DEFAULT NULL,
  `hits` bigint(20) unsigned DEFAULT NULL,
  `hr` bigint(20) unsigned DEFAULT NULL,
  `rbi` bigint(20) unsigned DEFAULT NULL,
  `steal` bigint(20) unsigned DEFAULT NULL,
  `winlose` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `innings` bigint(20) unsigned DEFAULT NULL,
  `conceded` bigint(20) unsigned DEFAULT NULL,
  `strikeout` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_games_user_id_game_id_unique` (`user_id`,`game_id`),
  KEY `users_games_game_id_foreign` (`game_id`),
  CONSTRAINT `users_games_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_games_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_games`
--

LOCK TABLES `users_games` WRITE;
/*!40000 ALTER TABLE `users_games` DISABLE KEYS */;
INSERT INTO `users_games` VALUES (13,18,17,3,2,1,3,1,NULL,NULL,NULL,NULL,'2021-02-01 05:40:18','2021-02-01 05:40:26'),(14,18,18,2,1,0,0,0,NULL,NULL,NULL,NULL,'2021-02-01 05:43:29','2021-02-01 05:43:29'),(15,11,17,2,1,0,0,0,NULL,NULL,NULL,NULL,'2021-02-01 05:44:59','2021-02-01 05:44:59'),(16,11,18,2,1,0,0,0,NULL,NULL,NULL,NULL,'2021-02-01 05:46:55','2021-02-01 05:46:55');
/*!40000 ALTER TABLE `users_games` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-02 11:51:35
