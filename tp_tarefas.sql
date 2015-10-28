CREATE DATABASE  IF NOT EXISTS `tp_tarefas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tp_tarefas`;
-- MySQL dump 10.13  Distrib 5.6.19, for Win64 (x86_64)
--
-- Host: localhost    Database: tp_tarefas
-- ------------------------------------------------------
-- Server version	5.6.21-enterprise-commercial-advanced

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
-- Table structure for table `configuracao_usuario`
--

DROP TABLE IF EXISTS `configuracao_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracao_usuario` (
  `CodCon_Usu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CodUsuCon_Usu` int(11) UNSIGNED NOT NULL,
  `AviAntIniMinCon_Usu` int(11) UNSIGNED NOT NULL,
  `AviAntIniHrsCon_Usu` int(11) UNSIGNED NOT NULL,
  `AviAntIniDiaCon_Usu` int(11) UNSIGNED NOT NULL,
  `TpoAvi` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CodCon_Usu`),
  KEY `idx_fk_con_usu_usu` (`CodUsuCon_Usu`),
  CONSTRAINT `fk_con_usu_usu` FOREIGN KEY (`CodUsuCon_Usu`) REFERENCES `usuario` (`CodUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pontuacao_usuario`
--

DROP TABLE IF EXISTS `pontuacao_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pontuacao_usuario` (
  `CodTarPon` int(11) UNSIGNED NOT NULL,
  `CodUsuPon` int(11) UNSIGNED NOT NULL,
  `TotPts` int(11) UNSIGNED DEFAULT NULL,
  KEY `idx_fk_pon_usu_TabTar` (`CodTarPon`),
  KEY `idx_fk_pon_usu_TabUsu` (`CodUsuPon`),
  CONSTRAINT `fk_pon_usu_TabUsu` FOREIGN KEY (`CodUsuPon`) REFERENCES `usuario` (`CodUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarefa` (
  `CodTar` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CodUsu_Tar` int(11) UNSIGNED NOT NULL,
  `NomTar` varchar(45) DEFAULT NULL COMMENT 'Nome da tarefa',
  `DesTar` varchar(200) NOT NULL COMMENT 'Descrição da tarefa',
  `DatIniTar` datetime NOT NULL COMMENT 'Data inicial da tarefa',
  `DatTerTar` datetime DEFAULT NULL COMMENT 'data de termino da tarefa',
  `TepTar` time DEFAULT NULL COMMENT 'Tempo de conclusão da tarefa',
  `PonTar` int(11) DEFAULT NULL COMMENT 'Pontuação',
  `ConTar` ENUM('S', 'N') NOT NULL DEFAULT 'N' COMMENT 'Flag tarefa concluída',
  PRIMARY KEY (`CodTar`),
  KEY `fk_Tarefa_Usuario1_idx` (`CodUsu_Tar`),
  CONSTRAINT `fk_Tar_TabUsu` FOREIGN KEY (`CodUsu_Tar`) REFERENCES `usuario` (`CodUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `CodUsu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NomUsu` varchar(60) NOT NULL,
  `DatNasUsu` date NOT NULL,
  `SenUsu` varchar(32) NOT NULL,
  `EmaUsu` varchar(100) DEFAULT NULL,
  `AvaUsu` blob,
  PRIMARY KEY (`CodUsu`),
  KEY `idx_usu_CodUsu` (`CodUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'tp_tarefas'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-12 21:29:30
