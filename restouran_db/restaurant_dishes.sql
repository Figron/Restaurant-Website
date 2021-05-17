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
-- Table structure for table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `dishes` (
  `idDishes` int(11) NOT NULL AUTO_INCREMENT,
  `idCategory` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Code` varchar(45) NOT NULL,
  `Image` text NOT NULL,
  `Price` double(10,2) NOT NULL,
  PRIMARY KEY (`idDishes`,`idCategory`),
  KEY `idCategory_idx` (`idCategory`),
  CONSTRAINT `idCategory` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Has info about dishes.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dishes`
--

LOCK TABLES `dishes` WRITE;
/*!40000 ALTER TABLE `dishes` DISABLE KEYS */;
INSERT INTO `dishes` VALUES (1,2,'Ukrainian Borscht','borscht','objects/dishes_images/borscht.jpg',73.00),(2,4,'Veal salad with cep mushroom sauce','veal_mushroom','objects/dishes_images/veal_mushroom.webp',170.00),(3,4,'Fresh tomato salad with Burrata cheese','tomato_cheese','objects/dishes_images/BurrataTomato.jpg',180.00),(4,2,'White mushroom cream soup with smoked oyster mushroom and truffle oil','cream_oyster','objects/dishes_images/CreamMushroom.jpg',90.00),(5,3,'Conchilioni in a creamy sauce with salmon and paddlefish caviar','Conchilioni_salmon','objects/dishes_images/SmokedSalmon.jpg',260.00),(6,3,'Burger with marble veal, fried mushrooms and bacon','burger_veal','objects/dishes_images/burger_veal.jpg',200.00),(7,8,'Salad with pickled shiitake, cucumbers and fried tofu','Salad_shiitake','objects/dishes_images/Salad_shiitake.jpg',110.00),(8,2,'Bean soup with mushroom broth','Bean_soup','objects/dishes_images/Bean_soup.jpg',70.00),(9,7,'Hot chocolate','hot_chocolate','objects/dishes_images/hot_chocolate.jpg',75.00),(10,6,'Chocolate cake','chocolate_cake','objects/dishes_images/chocolate_cake.jpg',110.00);
/*!40000 ALTER TABLE `dishes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-16 11:27:20
