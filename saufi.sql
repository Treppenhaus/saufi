-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: saufi
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

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
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `gameid` varchar(10) DEFAULT NULL,
  `admincode` varchar(8) DEFAULT NULL,
  `repeating` tinyint(1) DEFAULT NULL,
  `nsfw` tinyint(1) DEFAULT 0,
  `multiplicator` double DEFAULT 1,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` mediumtext DEFAULT NULL,
  `latest_activity` mediumtext DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES ('1-gtxtb','6f5894da',1,0,1,23,'1692415447','1692415447',3);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `dare` varchar(400) DEFAULT NULL,
  `timestamp` mediumtext DEFAULT NULL,
  `gameid` varchar(10) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES ('Der Besitzer des Handys muss 3 Schlücke trinken.','1692408798','1-5zu56',54),('Alle, die gerne einen Partner hätten, trinken 2 Schlücke.','1692408799','1-5zu56',55),('Die Person, die am höchsten hüpfen kann, darf 4 Schlücke verteilen.','1692408800','1-5zu56',56),('Die Person, die als nächstes lacht, trinkt 2 Schlücke.','1692408801','1-5zu56',57),('Die Person mit den coolsten Haaren verteilt 1 Schluck.','1692408803','1-5zu56',58),('Die Person, die heute als letztes aufgestanden ist, verteilt 3 Schlücke.','1692408803','1-5zu56',59),('fadfadf redet die nächsten 4 Runden nur noch mit der Person die er/sie am dümmsten findet.','1692408804','1-5zu56',60),('adfadf macht eine rolle oder trinkt 2 Schlücke.','1692408812','1-5zu56',61),('Jeder, der vergeben ist, trinkt 1 Schluck.','1692408895','1-uy5ux',62),('Alle, die kein Bier mögen, trinken 2 Schlücke.','1692408939','1-uy5ux',63),('Alle braunhaarigen trinken.','1692408941','1-uy5ux',64),('Alle, die ein J im Vornamen haben trinken 4 Schlücke.','1692408945','1-uy5ux',65),('piipi darf so viele Schlücke verteilen, wie er/sie selbst trinkt','1692408948','1-uy5ux',66),('Der/Die Sportlichste trinkt 2 Schlücke.','1692408949','1-uy5ux',67),('Alle Blondinen trinken','1692408951','1-uy5ux',68),('Alle, die heute zu spät kamen, müssen ihr Glas exen.','1692408954','1-uy5ux',69),('piipi sucht sich ein Wort aus, das man die nächsten 4 Runden nicht nennen darf.','1692409423','1-uy5ux',70),('Die Person mit dem vollsten Glas darf etwas in das leerste Glas am Tisch kippen.','1692409427','1-uy5ux',71),('Alle, die schonmal Fallschirmspringen waren, trinken 3 Schlücke.','1692409432','1-uy5ux',72),('Trinkt 2 Schlücke, wenn ihr Pleite seid.','1692409439','1-uy5ux',73),('Alle Blondinen trinken','1692409765','1-uy5ux',74),('dfadfadf muss sich 6 Runden auf seinen/ihren rechten Nebensitzer setzen','1692409768','1-uy5ux',75),('Alle, die eine Ausbildung machen, trinken 3 Schlücke.','1692410221','1-uy5ux',76),('Jeder, dessen Eltern getrennt leben darf 1 Schluck verteilen.','1692410221','1-uy5ux',77),('piipi entscheidet, mit welcher anwesenden Person er/sie am liebsten Sex hätte. Die Person muss 2 Schlücke trinken.','1692410233','1-uy5ux',78),('Diejenigen, die gern klugscheißern, trinken 5 Schlücke.','1692410237','1-uy5ux',79),('Xbox-Fans trinken.','1692410797','1-2xset',80),('sfg darf das nächste Lied entscheiden. Wem es nicht gefällt trinkt einen Schluck.','1692410797','1-2xset',81),('Die Frauen trinken ihre Körbchengröße in Schlücken. (A=1,B=2,D=4,...)','1692410797','1-2xset',82),('Alle, die gerne einen Partner hätten, trinken 2 Schlücke.','1692410797','1-2xset',83),('Xbox-Fans trinken.','1692410797','1-2xset',84),('Alle Tätowierten trinken.','1692410798','1-2xset',85),('sfgsdf darf 2 Schlücke verteilen','1692410798','1-2xset',86),('Alle, die kein Bier mögen, trinken 2 Schlücke.','1692410799','1-2xset',87),('sfgsdf muss die nächsten 3 Runden auf einem Bein stehen.','1692410800','1-2xset',88),('Die Bitchigste Person trinkt 2 Schlücke','1692410801','1-2xset',89),('sfg muss 3 Schlücke trinken.','1692410801','1-2xset',90),('Jungs trinken so viel wie hübsche Mädchen mitspielen','1692410802','1-2xset',91),('Ihr dürft die nächsten 7 runden keine Namen mehr nennen. Für jede Namensnennung 2 Schlücke.','1692410803','1-2xset',92),('Alle singen zusammen ein Lied, welches sfg entscheidet. Wer nicht mitsingt muss 3 Schlücke trinken.','1692410804','1-2xset',93),('Der/Die Sportlichste trinkt 2 Schlücke.','1692415449','1-gtxtb',94),('Xbox-Fans trinken.','1692415453','1-gtxtb',95),('Georg trinkt einen Schluck für jeden, der Mitspielt.','1692415455','1-gtxtb',96),('Alle stimmen ab wer 4 Schlücke nimmt.','1692415467','1-gtxtb',97),('Emma trinkt die nächsten 2 Runden für seinen Nebensitzer','1692415469','1-gtxtb',98),('Alle Singles trinken 2 Schlücke.','1692415472','1-gtxtb',99);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `nickname` varchar(30) DEFAULT NULL,
  `gameid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES ('Mo','1-gtxtb'),('Rubin','1-gtxtb'),('Georg','1-gtxtb'),('Emma','1-gtxtb');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `nickname` varchar(20) DEFAULT NULL,
  `password_hash` varchar(256) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `permission` int(11) DEFAULT 0,
  `registered` mediumtext DEFAULT NULL,
  `last_online` mediumtext DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','x','admin@saufi.giveme.pizza',0,'1692394799','1692394799',2),('georg','x','haidgeorg9@gmail.com',2,'1692395005','1692395005',3),('test','x','test@test.de',0,'1692414534','1692414534',5);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-19  5:25:46
