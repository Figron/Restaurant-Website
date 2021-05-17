-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurant
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `order_has_dish`
--

DROP TABLE IF EXISTS `order_has_dish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `order_has_dish` (
  `idorder_has_dish` int(11) NOT NULL AUTO_INCREMENT,
  `idOrder` int(11) NOT NULL,
  `idDishes` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`idorder_has_dish`,`idDishes`,`idOrder`),
  KEY `idOrder_idx` (`idOrder`),
  KEY `idDishes_idx` (`idDishes`),
  CONSTRAINT `idDishes` FOREIGN KEY (`idDishes`) REFERENCES `dishes` (`idDishes`),
  CONSTRAINT `idOrder` FOREIGN KEY (`idOrder`) REFERENCES `orders` (`idOrders`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_has_dish`
--

LOCK TABLES `order_has_dish` WRITE;
/*!40000 ALTER TABLE `order_has_dish` DISABLE KEYS */;
INSERT INTO `order_has_dish` VALUES (14,19,4,3),(14,19,9,1),(15,20,6,1),(15,20,7,2),(16,21,2,5),(16,21,6,1),(16,21,7,9),(17,22,3,3),(17,22,9,1),(18,23,6,50),(18,23,9,1),(19,22,1,1),(19,22,2,1),(20,25,6,1),(20,25,9,7),(21,22,1,43),(22,27,1,2);
/*!40000 ALTER TABLE `order_has_dish` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-16 11:27:21
