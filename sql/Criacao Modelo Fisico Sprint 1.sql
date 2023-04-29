-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: bdwheymarket
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(140) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'admin@admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cadastro_tipo`
--

DROP TABLE IF EXISTS `cadastro_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro_tipo` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro_tipo`
--

LOCK TABLES `cadastro_tipo` WRITE;
/*!40000 ALTER TABLE `cadastro_tipo` DISABLE KEYS */;
INSERT INTO `cadastro_tipo` VALUES (1,'Lojista'),(2,'Consumidor'),(3,'Administrador');
/*!40000 ALTER TABLE `cadastro_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_produto`
--

DROP TABLE IF EXISTS `categoria_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_produto` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_produto`
--

LOCK TABLES `categoria_produto` WRITE;
/*!40000 ALTER TABLE `categoria_produto` DISABLE KEYS */;
INSERT INTO `categoria_produto` VALUES (1,'Termogênicos'),(2,'Aminoácidos'),(3,'Acessórios');
/*!40000 ALTER TABLE `categoria_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumidor`
--

DROP TABLE IF EXISTS `consumidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consumidor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `CPF` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_cadastro_tipo` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cadastro_tipo` (`id_cadastro_tipo`),
  CONSTRAINT `consumidor_ibfk_1` FOREIGN KEY (`id_cadastro_tipo`) REFERENCES `cadastro_tipo` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumidor`
--

LOCK TABLES `consumidor` WRITE;
/*!40000 ALTER TABLE `consumidor` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos`
--

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lojista`
--

DROP TABLE IF EXISTS `lojista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lojista` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CNPJ` char(14) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` char(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fk_Cadastro_Tipo_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CNPJ` (`CNPJ`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_Lojista_2` (`fk_Cadastro_Tipo_ID`),
  CONSTRAINT `FK_Lojista_2` FOREIGN KEY (`fk_Cadastro_Tipo_ID`) REFERENCES `cadastro_tipo` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lojista`
--

LOCK TABLES `lojista` WRITE;
/*!40000 ALTER TABLE `lojista` DISABLE KEYS */;
INSERT INTO `lojista` VALUES (1,'15625548000147','fernando@gmail.com','Fernando Souza','aa1bf4646de67fd9086cf6c79007026c',1),(2,'85425548000102','flavia@gmail.com','Flavia lopes','aa1bf4646de67fd9086cf6c79007026c',1),(3,'65487458000165','maria@gmail.com','Maria oliveira','aa1bf4646de67fd9086cf6c79007026c',1),(4,'15632236000178','pedro@gmail.com','Pedro alcantara','aa1bf4646de67fd9086cf6c79007026c',1),(5,'8915753000157','julio@gmail.com','Julio lins','aa1bf4646de67fd9086cf6c79007026c',1),(10,'12345678901234','eduardo@moura.com','Loja CSGO','aa1bf4646de67fd9086cf6c79007026c',1),(19,'12345634523414','nova@loja.com','Loja teste','81dc9bdb52d04dc20036dbd8313ed055',1);
/*!40000 ALTER TABLE `lojista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto` (
  `SKU` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_Lojista_ID` int NOT NULL,
  `fk_Categoria_Produto_ID` int DEFAULT NULL,
  `Nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Preco` float DEFAULT NULL,
  `Quantidade` int DEFAULT NULL,
  `Peso` float DEFAULT NULL,
  `Foto` blob,
  `Descricao` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_foto` int DEFAULT NULL,
  PRIMARY KEY (`fk_Lojista_ID`,`SKU`),
  KEY `FK_Produto_2` (`fk_Categoria_Produto_ID`),
  KEY `id_foto` (`id_foto`),
  CONSTRAINT `FK_Produto_2` FOREIGN KEY (`fk_Categoria_Produto_ID`) REFERENCES `categoria_produto` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `FK_Produto_3` FOREIGN KEY (`fk_Lojista_ID`) REFERENCES `lojista` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_foto`) REFERENCES `fotos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES ('25fa',1,2,'Creatina',150,85,500,NULL,NULL,NULL),('38fd',2,2,'Glutamina',75,50,250,NULL,NULL,NULL),('df10',3,1,'Cafeína em Pó',50,100,80,NULL,NULL,NULL),('e23f',4,3,'Coqueteleira',70,150,NULL,NULL,NULL,NULL),('85d63',5,3,'Strep',30,200,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-29 15:48:37
