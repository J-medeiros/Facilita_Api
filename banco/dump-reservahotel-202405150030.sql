-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: reservahotel
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `_migration`
--

DROP TABLE IF EXISTS `_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `_migration` (
  `id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_migration`
--

LOCK TABLES `_migration` WRITE;
/*!40000 ALTER TABLE `_migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `informacao_hotel` varchar(200) NOT NULL,
  `image` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` VALUES (8,'Montanha Lodge','Campos do Jordão','São Paulo','Serra da Mantiqueira','Refúgio aconchegante nas montanhas, ideal para quem busca tranquilidade.','https://cf.bstatic.com/xdata/images/hotel/max1280x900/278028283.jpg?k=f9af05b0f007635fbbe6b3fa60c37a626174e635c856b64baff82355486663cd&o=&hp=1'),(7,'Praia Resort','Rio de Janeiro','Rio de Janeiro','Copacabana','Hotel de frente para a praia, com piscina e serviço de spa.','https://cf.bstatic.com/xdata/images/hotel/max1280x900/507251888.jpg?k=a78fe8d5aa6e6cadf2d8c71072a3987044a13ad0109ba7856751b7f7418950b0&o=&hp=1'),(6,'Hotel Central','São Paulo','São Paulo','Centro','Localizado no coração da cidade, próximo a várias atrações turísticas.','https://cf.bstatic.com/xdata/images/hotel/max1280x900/46882143.jpg?k=ca2245829a2b777f96ef83199e9a27c47d6e825308f0a5e8906825efd372525c&o=&hp=1'),(9,'Marina Resort','Porto Seguro','Bahia','Beira-mar','Resort all-inclusive com acesso exclusivo à praia e atividades aquáticas.','https://cf.bstatic.com/xdata/images/hotel/max1024x768/185423688.jpg?k=73d5a1ae9973261cb205dca2fd41043d3e3da500df7a52a2aba60db855696a28&o=&hp=1'),(10,'Chalés da Serra','Gramado','Rio Grande do Sul','Serra Gaúcha','Chalés charmosos em meio à natureza, com lareira e vista panorâmica.','https://cf.bstatic.com/xdata/images/hotel/square600/173186640.webp?k=a95babb024b12dff97489bf7d10a27f5fc4d9dd08be2e01324ca50f87bceb997&o=');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quarto`
--

DROP TABLE IF EXISTS `quarto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quarto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_hotel` int NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `andar` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `info_quarto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quarto`
--

LOCK TABLES `quarto` WRITE;
/*!40000 ALTER TABLE `quarto` DISABLE KEYS */;
INSERT INTO `quarto` VALUES (1,1,'Standard','1º Andar','Disponível','Quarto padrão com decoração moderna e vista para a cidade.'),(2,2,'Luxo','2º Andar','Disponível','Quarto de luxo no 2º andar. Equipado com uma banheira de hidromassagem, TV de tela grande, e varanda'),(3,3,'Suite','3º Andar','Disponível','Suíte espaçosa com área de estar separada, cama king-size e vista panorâmica para a montanha.'),(4,4,'Econômico','4º Andar','Disponível','Quarto econômico no 4º andar. Ideal para viajantes com orçamento limitado, com todas as comodidades '),(5,5,'Família','5º Andar','Disponível','Quarto familiar no 5º andar. Perfeito para famílias, com beliches para as crianças e uma área de jog'),(6,1,'Standard','1º Andar','Disponível','Quarto padrão com decoração moderna e vista para a cidade.'),(7,1,'Luxo','2º Andar','Disponível','Quarto de luxo no 2º andar. Equipado com uma banheira de hidromassagem, TV de tela grande, e varanda'),(8,1,'Suite','3º Andar','Disponível','Suíte espaçosa com área de estar separada, cama king-size e vista panorâmica para a montanha.'),(9,1,'Econômico','4º Andar','Disponível','Quarto econômico no 4º andar. Ideal para viajantes com orçamento limitado, com todas as comodidades '),(10,1,'Família','5º Andar','Disponível','Quarto familiar no 5º andar. Perfeito para famílias, com beliches para as crianças e uma área de jog');
/*!40000 ALTER TABLE `quarto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_hospede` varchar(45) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `id_quarto` int NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quarto` (`id_quarto`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES (1,'Joaodasdas','joaovitor.m581@gmail.com','051.568.056-78',4,'2024-05-15','2024-05-15'),(2,'Joaodasdas','joao.v.m.s.jacinto@academico.unirv.edu.br','051.568.056-78',4,'2024-05-15','2024-05-15');
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'reservahotel'
--

--
-- Dumping routines for database 'reservahotel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-15  0:30:18
