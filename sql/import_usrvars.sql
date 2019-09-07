-- MySQL dump 10.13  Distrib 5.7.21, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: oneems
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `import_usrvars`
--

DROP TABLE IF EXISTS `import_usrvars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `import_usrvars` (
  `usrvarid` int(11) NOT NULL AUTO_INCREMENT,
  `usrvarname` text,
  `usrvarval` text,
  `deviceseries` text,
  `templname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usrvarid`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `import_usrvars`
--

LOCK TABLES `import_usrvars` WRITE;
/*!40000 ALTER TABLE `import_usrvars` DISABLE KEYS */;
INSERT INTO `import_usrvars` VALUES (1,'Vlan(Odd)','Vlan(Odd)','CSR','N','kesavsr'),(2,'Odd Vlan IP','Odd Vlan IP','CSR','N','kesavsr'),(3,'Vlan(Even)','Vlan(Even)','CSR','N','kesavsr'),(4,'Even Vlan IP','Even Vlan IP','CSR','N','kesavsr'),(5,'Bandwidth (Mbps)','Bandwidth (Mbps)','CSR','N','kesavsr'),(6,'Bandwidth Type','Bandwidth Type','CSR','N','kesavsr'),(7,'Enable Secret','Enable Secret','CSR','N','kesavsr'),(8,'Loopback0 IPv4 Address','Loopback0 IPv4 Address','CSR','N','kesavsr'),(9,'Loopback300 IPv4 Address','Loopback300 IPv4 Address','CSR','N','kesavsr'),(10,'Loopback300 IPv6 Address','Loopback300 IPv6 Address','CSR','N','kesavsr'),(11,'Loopback400 IPv6 Address','Loopback400 IPv6 Address','CSR','N','kesavsr'),(12,'BDI 300 IPv6 Address','BDI 300 IPv6 Address','CSR','N','kesavsr'),(13,'BDI 400 LTE IPv6 Address','BDI 400 LTE IPv6 Address','CSR','N','kesavsr'),(14,'Time Zone','Time Zone','CSR','N','kesavsr'),(15,'MTU','MTU','CSR','N','kesavsr'),(16,'eNodeB_ID','eNodeB_ID','CSR','N','kesavsr'),(17,'Bearer Vlan IPv6','Bearer Vlan IPv6','CSR','N','kesavsr'),(18,'Telco Interface-ASR9010-Odd','Telco Interface-ASR9010-Odd','ASR9010-Odd','N','kesavsr'),(19,'Telco Interface-ASR9010-Even','Telco Interface-ASR9010-Even','ASR9010-Even','N','kesavsr'),(20,'BV3000 Interface-ASR9010-Odd','BV3000 Interface-ASR9010-Odd','ASR9010-Odd','N','kesavsr'),(21,'BV3000 Interface-ASR9010-Even','BV3000 Interface-ASR9010-Even','ASR9010-Even','N','kesavsr'),(22,'P2P (IPv4)-ASR9010-Odd','P2P (IPv4)-ASR9010-Odd','ASR9010-Odd','N','kesavsr'),(23,'P2P (IPv4)-ASR9010-Even','P2P (IPv4)-ASR9010-Even','ASR9010-Even','N','kesavsr'),(24,'BW -- Bandwidth(Mbps)','BW -- Bandwidth(Mbps)','Bandwidth','N','kesavsr'),(25,'BW -- Bandwidth Type(6/8)','BW -- Bandwidth Type(6/8)','Bandwidth','N','kesavsr'),(26,'BW -- Telco Interface-ASR9010-Odd','BW -- Telco Interface-ASR9010-Odd','Bandwidth','N','kesavsr'),(27,'BW -- Telco Interface-ASR9010-Even','BW -- Telco Interface-ASR9010-Even','Bandwidth','N','kesavsr'),(28,'1st NCS540 Interface','1st NCS540 Interface','CSR','N','kesavsr'),(29,'1st NCS540 Interface Circuit ID','1st NCS540 Interface Circuit ID','CSR','N','kesavsr'),(30,'2nd NCS540 Interface','2nd NCS540 Interface','CSR','N','kesavsr'),(31,'2nd NCS540 Interface Circuit ID','2nd NCS540 Interface Circuit ID','CSR','N','kesavsr'),(32,'2nd NCS5501 Hostname','2nd NCS5501 Hostname','CSR','N','kesavsr'),(33,'2nd NCS5501 Site Description','2nd NCS5501 Site Description','CSR','N','kesavsr'),(34,'Backhaul Interface','Backhaul Interface','CSR','N','kesavsr'),(35,'BVI LTE Interace IPv6 Address','BVI LTE Interace IPv6 Address','CSR','N','kesavsr'),(37,'BVI OAM Vlan IPv4 Address','BVI OAM Vlan IPv4 Address','CSR','N','kesavsr'),(38,'BVI OAM Vlan IPv6 Address','BVI OAM Vlan IPv6 Address','CSR','N','kesavsr'),(39,'CELL_MGMT Vlan IPv6 Address to 1st NCS540','CELL_MGMT Vlan IPv6 Address to 1st NCS540','CSR','N','kesavsr'),(40,'CELL_MGMT Vlan IPv6 Address to 2nd NCS540','CELL_MGMT Vlan IPv6 Address to 2nd NCS540','CSR','N','kesavsr'),(41,'CELL_MGMT Vlan to 1st NCS540','CELL_MGMT Vlan to 1st NCS540','CSR','N','kesavsr'),(43,'Enode B Interface','Enode B Interface','CSR','N','kesavsr'),(44,'Even Vlan IP-1','Even Vlan IP-1','CSR','N','kesavsr'),(45,'Loopback0 of the 2nd NCS5501','Loopback0 of the 2nd NCS5501','CSR','N','kesavsr'),(46,'Loopback400 IPv4 Address','Loopback400 IPv4 Address','CSR','N','kesavsr'),(47,'LTE Vlan IPv6 Address 1st NCS540','LTE Vlan IPv6 Address 1st NCS540','CSR','N','kesavsr'),(48,'LTE Vlan IPv6 Address 2nd NCS540','LTE Vlan IPv6 Address 2nd NCS540','CSR','N','kesavsr'),(49,'LTE Vlan to 1st NCS540','LTE Vlan to 1st NCS540','CSR','N','kesavsr'),(50,'LTE Vlan to 2nd NCS540','LTE Vlan to 2nd NCS540','CSR','N','kesavsr'),(51,'NCS5500 Backhaul Fo/Hu Interface','NCS5500 Backhaul Fo/Hu Interface','CSR','N','kesavsr'),(52,'NCS5500 Backhaul TE Interface','NCS5500 Backhaul TE Interface','CSR','N','kesavsr'),(53,'Odd Vlan IP-1','Odd Vlan IP-1','CSR','N','kesavsr'),(54,'Site Description','Site Description','CSR','N','kesavsr'),(55,'VRRP IP','VRRP IP','CSR','N','kesavsr'),(57,'Interchassis Link','Interchassis Link','CSR','N','kesavsr'),(58,'CELL_MGMT Vlan to 1st NCS540','CELL_MGMT Vlan to 1st NCS540','CSR','N','kesavsr');
/*!40000 ALTER TABLE `import_usrvars` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-07 15:49:52
