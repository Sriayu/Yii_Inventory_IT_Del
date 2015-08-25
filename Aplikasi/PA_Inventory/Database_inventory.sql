/*
SQLyog Community v11.24 (32 bit)
MySQL - 5.5.27 : Database - app_inventory2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`app_inventory2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `app_inventory2`;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `image` varchar(32) DEFAULT NULL,
  `is_staff` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `account` */

insert  into `account`(`id`,`username`,`password`,`name`,`email`,`image`,`is_staff`) values (1,'admin','admin','lasma','lasma','business_proses.png',1),(5,'lasma','sri','lasma silalahi','silalahilasma@gmail.com','Koala.jpg',NULL),(6,'sri','lasma','sriayu manalu','sakura94fourless@gmail.com',NULL,NULL);

/*Table structure for table `categorie` */

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `categorie` */

insert  into `categorie`(`id`,`name`) values (2,'Benda Tajam'),(3,'Benda Tetap'),(4,'Benda Pinjam'),(5,'Barang Cuci'),(7,'ATK'),(11,'huy'),(12,'Peralatan Guest House'),(13,'Benda Kantor'),(14,'Baru Kategori');

/*Table structure for table `damaged_inventory` */

DROP TABLE IF EXISTS `damaged_inventory`;

CREATE TABLE `damaged_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `code_inventory` varchar(32) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status_repair` tinyint(4) DEFAULT NULL,
  `Quantity_demage` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `date_submition` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_user` (`id_user`),
  KEY `ref_codeinventory` (`code_inventory`),
  CONSTRAINT `ref_codeinventory` FOREIGN KEY (`code_inventory`) REFERENCES `inventory` (`code_inventory`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_user` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `damaged_inventory` */

insert  into `damaged_inventory`(`id`,`id_user`,`code_inventory`,`description`,`status_repair`,`Quantity_demage`,`image`,`date_submition`) values (9,5,'Del/ASPA.B5.560/11/14','Rusak',1,1,NULL,'2014-06-11'),(10,5,'Del/ASPA.B5.560/11/14','Rusak',1,3,'','2014-06-11'),(11,5,'Del/ASPA.B5.560/11/14','Rusak',1,5,'Koala.jpg','2014-06-11'),(12,5,'Del/ASPA.B5.560/11/14','Rusak',1,1,'Jellyfish.jpg','2014-06-12'),(13,5,'Del/ASPA.B5.560/11/14','Sayayayayayay',1,2,'Penguins.jpg','2014-06-15'),(14,5,'Del/ASPA.B5.560/11/14','Sayayayayayay',NULL,2,'Penguins.jpg','2014-06-15'),(15,5,'Del/ASPA.B5.560/11/14','Rusak sekali.',NULL,1,'Penguins.jpg','2014-06-16');

/*Table structure for table `export_inventory` */

DROP TABLE IF EXISTS `export_inventory`;

CREATE TABLE `export_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_inventory` varchar(100) NOT NULL,
  `id_locationFirst` int(32) NOT NULL,
  `id_locationLast` int(32) NOT NULL,
  `date_export` date NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `export_inventory` */

insert  into `export_inventory`(`id`,`code_inventory`,`id_locationFirst`,`id_locationLast`,`date_export`,`quantity`) values (7,'Del/ASPA.B5.560/11/14',13,21,'2014-06-11',9),(8,'Del/ASPA.B5.560/11/14',13,5,'2014-06-11',5),(13,'Del/CR.B5.519/11/14',10,5,'2014-06-11',1),(14,'Del/LPPM.D6./11/14',8,5,'2014-06-12',1),(15,'23411',9,12,'2014-06-13',1);

/*Table structure for table `import_inventory` */

DROP TABLE IF EXISTS `import_inventory`;

CREATE TABLE `import_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_inventory` varchar(100) NOT NULL,
  `name_inventory` varchar(200) DEFAULT NULL,
  `id_location` int(11) NOT NULL,
  `id_category` int(32) NOT NULL,
  `id_type` int(11) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `supplier` varchar(32) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(32) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `date_import` date NOT NULL,
  `description` tinytext,
  PRIMARY KEY (`id`),
  KEY `ref_inventori` (`code_inventory`),
  KEY `ref_location` (`id_location`),
  KEY `ref_type` (`id_type`),
  KEY `ref_categori` (`id_category`),
  CONSTRAINT `ref_categori` FOREIGN KEY (`id_category`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_inventori` FOREIGN KEY (`code_inventory`) REFERENCES `inventory` (`code_inventory`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_location` FOREIGN KEY (`id_location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `import_inventory` */

insert  into `import_inventory`(`id`,`code_inventory`,`name_inventory`,`id_location`,`id_category`,`id_type`,`unit`,`supplier`,`quantity`,`price`,`total_price`,`image`,`date_import`,`description`) values (5,'23411','Meja Panjang Merah',9,3,6,'Buah','Manalu',12,1200000,NULL,'Chrysanthemum.jpg','2014-06-11','DI ruang rapat '),(6,'Del/LPPM.D6./11/14','Meja Panjang Kuning',8,3,2,'Buah','Manalu',90,1200000,NULL,'Desert.jpg','2014-06-11','kkokoko'),(7,'Del/ASPA.B5.560/11/14','Lampu Asrama',13,4,4,'Buah','Toko Bagus',6,600000,NULL,'Penguins.jpg','2014-06-18','Bagus - Bagus Semuanya ya'),(8,'Del/CR.B5.519/11/14','Lampu Hias',10,3,4,'Biji','Sahala',23,200000,4600000,'Penguins.jpg','2014-06-11','Lampu Hias'),(9,'Del/GBK1.G14.106/12/14','Del-cobacoba',15,3,6,'buah','Sriayu',12,120000,1440000,'Desert.jpg','2014-06-12','beauty'),(10,'Del/Sek.B5.312/13/14','Lampu Kamar',9,3,4,'Buah','Manalu',23,10000,230000,'Jellyfish.jpg','2014-06-13','Lampu ASP dan ASPI.'),(11,'Del/MR.D6.483/16/14','Kursi',11,3,2,'Buah','Lasma',40,120000,4800000,'Jellyfish.jpg','2014-06-16','Berada di ruangan meeting.'),(12,'Del/EH.B5.021/16/14','Lampu Kantor ',12,3,4,'Buah','Septika',23,10000,230000,'Chrysanthemum.jpg','2014-06-16','Lampu yang berada di Entrance Hall ');

/*Table structure for table `inventory` */

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_inventory` varchar(100) NOT NULL,
  `name_inventory` varchar(200) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_location` int(11) NOT NULL,
  `satuan_barang` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `quantity_demaged` int(11) DEFAULT NULL,
  `description` text,
  `image` varchar(200) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`code_inventory`),
  KEY `ref_tpe` (`id_type`),
  KEY `ref_kategori` (`id_category`),
  KEY `ref_locate` (`id_location`),
  KEY `id` (`id`),
  CONSTRAINT `ref_kategori` FOREIGN KEY (`id_category`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_locate` FOREIGN KEY (`id_location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_tpe` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `inventory` */

insert  into `inventory`(`id`,`code_inventory`,`name_inventory`,`id_type`,`id_category`,`id_location`,`satuan_barang`,`quantity`,`quantity_demaged`,`description`,`image`,`unit`) values (8,'23411','Meja Panjang Merah',6,3,9,'',6,NULL,'DI ruang rapat ','Chrysanthemum.jpg','Buah'),(10,'Del/ASPA.B5.560/11/14','Lampu Asrama',4,4,13,'',20,-3,'Bagus - Bagus Semuanya ya','Penguins.jpg','Buah'),(11,'Del/CR.B5.519/11/14','Lampu Hias',4,3,10,'',23,NULL,'Lampu Hias','Penguins.jpg','Biji'),(15,'Del/EH.B5.021/16/14','Lampu Kantor ',4,3,12,'',23,NULL,'Lampu yang berada di Entrance Hall ','Chrysanthemum.jpg','Buah'),(12,'Del/GBK1.G14.106/12/14','Del-cobacoba',6,3,15,'',12,NULL,'beauty','Desert.jpg','buah'),(9,'Del/LPPM.D6./11/14','Meja Panjang Kuning',2,3,8,'',180,NULL,'kkokoko','Chrysanthemum.jpg','Buah'),(14,'Del/MR.D6.483/16/14','Kursi',2,3,11,'',40,NULL,'Berada di ruangan meeting.','Jellyfish.jpg','Buah'),(13,'Del/Sek.B5.312/13/14','Lampu Kamar',4,3,9,'',23,NULL,'Lampu ASP dan ASPI.','Jellyfish.jpg','Buah');

/*Table structure for table `loan` */

DROP TABLE IF EXISTS `loan`;

CREATE TABLE `loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `code_inventory` varchar(32) NOT NULL,
  `id_location` int(11) NOT NULL,
  `date_loan` date DEFAULT NULL,
  `date_return` date DEFAULT NULL,
  `quantity_loan` int(11) NOT NULL,
  `quantity_demaged` int(11) DEFAULT NULL,
  `status_apporval` tinyint(4) DEFAULT NULL,
  `status_loan` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_codeinventori` (`code_inventory`),
  KEY `ref_peminjam` (`id_user`),
  KEY `ref_temppat` (`id_location`),
  CONSTRAINT `ref_codeinventori` FOREIGN KEY (`code_inventory`) REFERENCES `inventory` (`code_inventory`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_peminjam` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_temppat` FOREIGN KEY (`id_location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `loan` */

insert  into `loan`(`id`,`id_user`,`code_inventory`,`id_location`,`date_loan`,`date_return`,`quantity_loan`,`quantity_demaged`,`status_apporval`,`status_loan`) values (24,5,'Del/ASPA.B5.560/11/14',13,'2014-06-11','2014-06-18',3,1,1,1),(26,5,'Del/ASPA.B5.560/11/14',13,'2014-06-13','2014-06-13',2,NULL,1,1),(29,5,'Del/ASPA.B5.560/11/14',13,'2014-06-18',NULL,1,NULL,1,NULL),(30,5,'Del/ASPA.B5.560/11/14',13,NULL,NULL,1,NULL,NULL,NULL),(31,5,'Del/ASPA.B5.560/11/14',13,NULL,NULL,28,NULL,NULL,NULL),(32,5,'Del/ASPA.B5.560/11/14',13,NULL,NULL,1,NULL,NULL,NULL);

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_location` varchar(50) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`id`,`code_location`,`name`,`description`) values (5,'RR','REKTOR',NULL),(8,'LPPM','LPPM',NULL),(9,'Sek','Sekretariat',NULL),(10,'CR','COMMONROOM',NULL),(11,'MR','MEETINGROOM',NULL),(12,'EH','ENTRANCE',NULL),(13,'ASPA','ASPA',NULL),(14,'ASPI','ASPI',NULL),(15,'GBK1','GBK1',NULL),(16,'GBK2','GBK2',NULL),(17,'GD511','GD511',NULL),(18,'GD512','GD512',NULL),(19,'GD513','GD513',NULL),(20,'GD514','GD514',NULL),(21,'GD516','GD516',NULL),(22,'GD521','GD521',NULL),(23,'GD522','GD522',NULL),(24,'GD523','GD523',NULL),(25,'GD524','GD524',NULL),(26,'GD526','GD526',NULL),(27,'GD711','GD711',NULL),(28,'GD712','GD712',NULL),(29,'GD713','GD713',NULL),(30,'GD721','GD721',NULL),(31,'GD722','GD722',NULL),(32,'GHA','GHA',NULL),(33,'GBH','GBH',NULL),(34,'GHC','GHC',NULL),(35,'GHE','GHE',NULL),(36,'GHD','GHD',NULL),(37,'GHF','GHF',NULL),(38,'RDSAS','RDSAS',NULL),(39,'RDA','RDA',NULL),(40,'RDC','RDC',NULL),(41,'RDD','RDD',NULL),(42,'RDE','RDE',NULL),(43,'RDF','RDF',NULL),(44,'S1.1','ST11',NULL),(45,'S1.2','ST12',NULL),(46,'S1.3','ST13',NULL),(47,'S1.4','ST14',NULL),(48,'S1.5','ST15',NULL),(49,'S1.6','ST16',NULL),(50,'S1.7','ST17',NULL),(51,'S2.1','ST21',NULL),(52,'S2.2','ST22',NULL),(53,'S2.3','ST23',NULL),(54,'S2.4','ST24',NULL),(55,'S2.5','ST25',NULL),(56,'S2.6','ST26',NULL),(57,'S2.7','ST27',NULL),(58,'S2.8','ST28',NULL),(59,'M101','M101',NULL),(60,'M102','M102',NULL),(61,'M103','M103',NULL),(62,'M201','M201',NULL),(63,'M202','M202',NULL),(64,'M203','M203',NULL),(65,'M204','M204',NULL),(66,'TH01','TH01',NULL),(67,'TH02','TH02',NULL),(68,'TH03','TH03',NULL),(69,'TH04','TH04',NULL),(70,'TH05','TH05',NULL),(71,'TH06','TH06',NULL),(72,'TH07','TH07',NULL),(73,'TH08','TH08',NULL),(74,'DS','DOSENSTAFF(LantaiAtas)',NULL),(75,'DS','DOSENSTAFF(Teras)',NULL),(76,'DS','DOSENSTAFF(LantaiBawah)',NULL),(77,'Perpus','PERPUSTAKAAN(RuangBacaTenang)',NULL),(78,'Perpus','PERPUSTAKAAN(RuangDiskusi)',NULL),(79,'Perpus','PERPUSTAKAAN(RuangAudioVisual)',NULL),(80,'Perpus','PERPUSTAKAAN(RuangRefrensi)',NULL),(81,'Perpus','PERPUSTAKAAN(RuangPengolahan)',NULL),(82,'Perpus','PERPUSTAKAAN(RuangSirkulasi)',NULL),(83,'Perpus','PERPUSTAKAAN(Lantai II)',NULL),(84,'Perpus','PERPUSTAKAAN(RuangHeadLibrarian)',NULL),(85,'Perpus','PERPUSTAKAAN(LuarPerpustakaan)',NULL);

/*Table structure for table `type` */

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_type` varchar(100) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `type` */

insert  into `type`(`id`,`code_type`,`name`) values (2,'D6','Kursi Biasa'),(3,'D15','Kursi Roda'),(4,'B5','Lampu'),(5,'G26','Meja Bulat'),(6,'G14','Meja Panjang'),(7,'G4','Meja Komputer'),(8,'B14','Telepon'),(9,'A7','Keranjang Sampah'),(10,'B12','Jam Dinding'),(11,'H5','Papan Tulis Kecil '),(12,'O1','Peta'),(13,'O2','Lukisan'),(14,'E3','Lemari Arsip'),(15,'B15','Fotocopi'),(16,'E6','Lemari Besar '),(17,'E9','Lemari Kecil ');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
