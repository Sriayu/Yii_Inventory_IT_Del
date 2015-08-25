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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `damaged_inventory` */

insert  into `damaged_inventory`(`id`,`id_user`,`code_inventory`,`description`,`status_repair`,`Quantity_demage`,`image`,`date_submition`) values (9,5,'Del/ASPA.B5.560/11/14','Rusak',1,1,NULL,'2014-06-11'),(10,5,'Del/ASPA.B5.560/11/14','Rusak',1,3,'','2014-06-11'),(11,5,'Del/ASPA.B5.560/11/14','Rusak',1,5,'Koala.jpg','2014-06-11'),(12,5,'Del/ASPA.B5.560/11/14','Rusak',1,1,'Jellyfish.jpg','2014-06-12'),(13,5,'Del/ASPA.B5.560/11/14','Sayayayayayay',1,2,'Penguins.jpg','2014-06-15'),(14,5,'Del/ASPA.B5.560/11/14','Sayayayayayay',1,2,'Penguins.jpg','2014-06-15'),(15,5,'Del/ASPA.B5.560/11/14','Rusak sekali.',NULL,1,'Penguins.jpg','2014-06-16'),(16,5,'Del/ASPA.B5.560/11/14','terbakar',NULL,3,'','2014-06-20');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `export_inventory` */

insert  into `export_inventory`(`id`,`code_inventory`,`id_locationFirst`,`id_locationLast`,`date_export`,`quantity`) values (7,'Del/ASPA.B5.560/11/14',13,21,'2014-06-11',9),(8,'Del/ASPA.B5.560/11/14',13,5,'2014-06-11',5),(13,'Del/CR.B5.519/11/14',10,5,'2014-06-11',1),(14,'Del/LPPM.D6./11/14',8,5,'2014-06-12',1),(15,'23411',9,12,'2014-06-13',1),(16,'Del/GD512.G14.128/20/14',18,19,'2014-06-20',2),(17,'23411',9,5,'2014-06-20',2),(18,'23411',9,5,'2014-06-20',2),(20,'Del/Perpus.D6.751/20/14',77,13,'2014-06-01',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `import_inventory` */

insert  into `import_inventory`(`id`,`code_inventory`,`name_inventory`,`id_location`,`id_category`,`id_type`,`unit`,`supplier`,`quantity`,`price`,`total_price`,`image`,`date_import`,`description`) values (6,'Del/LPPM.D6./11/14','Meja Panjang Kuning',8,3,2,'Buah','Manalu',90,1200000,NULL,'Desert.jpg','2014-06-11','kkokoko'),(7,'Del/ASPA.B5.560/11/14','Lampu Asrama',13,4,4,'Buah','Toko Bagus',6,600000,NULL,'Penguins.jpg','2014-06-18','Bagus - Bagus Semuanya ya'),(8,'Del/CR.B5.519/11/14','Lampu Hias',10,3,4,'Biji','Sahala',23,200000,4600000,'Penguins.jpg','2014-06-11','Lampu Hias'),(9,'Del/GBK1.G14.106/12/14','Del-cobacoba',15,3,6,'buah','Sriayu',12,120000,1440000,'Desert.jpg','2014-06-12','beauty'),(10,'Del/Sek.B5.312/13/14','Lampu Kamar',9,3,4,'Buah','Manalu',23,10000,230000,'Jellyfish.jpg','2014-06-13','Lampu ASP dan ASPI.'),(11,'Del/MR.D6.483/16/14','Kursi',11,3,2,'Buah','Lasma',40,120000,4800000,'Jellyfish.jpg','2014-06-16','Berada di ruangan meeting.'),(12,'Del/EH.B5.021/16/14','Lampu Kantor ',12,3,4,'Buah','Septika',23,10000,230000,'Chrysanthemum.jpg','2014-06-16','Lampu yang berada di Entrance Hall '),(18,'Del/Perpus.E6.569/20/14','Lemari buku/koran',77,3,16,'Buah','Meli',3,1000000,3000000,'atk1.jpg','2014-06-20','Lemari buku'),(19,'Del/Perpus.D6.378/20/14','Kursi biasa kain',77,3,2,'Buah','Sri',10,500000,5000000,'20140619_080043.jpg','2014-06-20','Kursi '),(20,'Del/Perpus.E6.984/20/14','Lemari besar 3 laci',77,3,16,'Buah','lasma',10,2000000,20000000,'asset.jpg','2014-06-20','lemari'),(21,'Del/Perpus.G14.801/20/14','Meja baca kayu',78,3,6,'Buah','aldi',5,400000,2000000,'Inventory.jpg','2014-06-20','meja'),(22,'Del/Perpus.H5.546/20/14','Papan tulis kecil tidak berbingkai',79,3,11,'Buah','Sahala',3,100000,300000,'atk.jpg','2014-06-20','tulis'),(23,'Del/DOSENSTAFF.D15.760/20/14','Kursi roda merah high point',86,3,3,'Buah','rendi',20,200000,4000000,'20140619_080043.jpg','2014-06-20','kursi roda'),(24,'Del/DOSENSTAFF.B14.375/20/14','Telepon',86,3,8,'buah','koper',10,20000,200000,'atk1.jpg','2014-06-20','telepon'),(25,'Del/LPPM.D6.568/20/14','keranjang sampah berjaring',8,3,2,'Buah','lala',2,10000,20000,'Inventory.jpg','2014-06-20','keranjang'),(26,'Del/LPPM.D15.235/20/14','kursi roda achigama merah',8,3,3,'Buah','meli',10,100000,1000000,'atk.jpg','2014-06-20','kursi roda'),(27,'Del/Sek.G4.076/20/14','Meja computer biasa',9,3,7,'Buah','elisa',10,100000,1000000,'header.png','2014-06-20','meja'),(28,'Del/Sek.B12.623/20/14','Jam dinding',9,3,10,'buah','lal',10,50000,500000,'asset.jpg','2014-06-20','jam'),(29,'Del/CR.sf.470/20/14','Sofa besar ',10,3,19,'buah','septian',4,600000,2400000,'headerajah.jpg','2014-06-20','sofa'),(30,'Del/CR.dp.508/20/14','Dispenser besar',10,3,20,'buah','clara',1,200000,200000,'atk.jpg','2014-06-20','dispenser'),(31,'Del/CR.G14.108/20/14','Meja makan kayu jumbo',10,4,6,'buah','septian',2,1000000,2000000,'atk.jpg','2014-06-20','meja makan'),(32,'Del/MR.Ti.507/20/14','Tirai plastic biru 2 nako',11,3,21,'buah','llaa',10,100000,1000000,'header.jpg','2014-06-20','tirai'),(33,'Del/MR.E6.395/20/14','Lemari Besar 4 Pintu',11,3,16,'BUAH','Sri',1,2000000,2000000,'headerajah.jpg','2014-06-20','LEMARI BESAR'),(34,'Del/EH.TV.839/20/14','Televisi',12,3,22,'Buah','seses',1,3000000,3000000,'asset.jpg','2014-06-20','TV'),(35,'Del/EH.G26.410/20/14','Meja jepara kecil (pendek)',12,3,5,'Buah','Sri',1,1000000,1000000,'headerajah.jpg','2014-06-20','meja'),(36,'Del/ASPA.A7.342/20/14','Keranjang sampah bertutup jumbo',13,4,9,'Buah','derseli',4,200000,800000,'header_copy.jpg','2014-06-20','buah'),(37,'Del/GD512.G14.128/20/14','Meja Kelas',18,3,6,'Buah','IT Del',23,120000,2760000,'20140619_080043.jpg','2014-06-20','Meja Kelas GD512'),(38,'Del/GD713.G14.341/20/14','Meja Gambar',29,5,6,'buah','samsung',30,500,15000,'esgr.jpg','2014-06-20','jfasf');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `inventory` */

insert  into `inventory`(`id`,`code_inventory`,`name_inventory`,`id_type`,`id_category`,`id_location`,`satuan_barang`,`quantity`,`quantity_demaged`,`description`,`image`,`unit`) values (44,'Del/ASPA.A7.342/20/14','Keranjang sampah bertutup jumbo',9,4,13,'',4,NULL,'buah','header_copy.jpg','Buah'),(10,'Del/ASPA.B5.560/11/14','Lampu Asrama',4,4,13,'',21,-2,'Bagus - Bagus Semuanya ya','Penguins.jpg','Buah'),(11,'Del/CR.B5.519/11/14','Lampu Hias',4,3,10,'',23,NULL,'Lampu Hias','Penguins.jpg','Biji'),(38,'Del/CR.dp.508/20/14','Dispenser besar',20,3,10,'',1,NULL,'dispenser','atk.jpg','buah'),(39,'Del/CR.G14.108/20/14','Meja makan kayu jumbo',6,4,10,'',2,NULL,'meja makan','atk.jpg','buah'),(37,'Del/CR.sf.470/20/14','Sofa besar ',19,3,10,'',4,NULL,'sofa','headerajah.jpg','buah'),(30,'Del/DOSENSTAFF.B14.375/20/14','Telepon',8,3,86,'',10,NULL,'telepon','atk1.jpg','buah'),(28,'Del/DOSENSTAFF.D15.029/20/14','Kursi roda merah high point',3,3,86,'',20,NULL,'kursi roda',NULL,'Buah'),(27,'Del/DOSENSTAFF.D15.651/20/14','Kursi roda merah high point',3,3,86,'',20,NULL,'kursi roda','20140619_080057.jpg','Buah'),(29,'Del/DOSENSTAFF.D15.760/20/14','Kursi roda merah high point',3,3,86,'',20,NULL,'kursi roda','20140619_080043.jpg','Buah'),(15,'Del/EH.B5.021/16/14','Lampu Kantor ',4,3,12,'',23,NULL,'Lampu yang berada di Entrance Hall ','Chrysanthemum.jpg','Buah'),(43,'Del/EH.G26.410/20/14','Meja jepara kecil (pendek)',5,3,12,'',1,NULL,'meja','headerajah.jpg','Buah'),(42,'Del/EH.TV.839/20/14','Televisi',22,3,12,'',1,NULL,'TV','asset.jpg','Buah'),(12,'Del/GBK1.G14.106/12/14','Del-cobacoba',6,3,15,'',12,NULL,'beauty','Desert.jpg','buah'),(46,'Del/GD512.G14.128/20/14','Meja Kelas',6,3,18,'',23,NULL,'Meja Kelas GD512','20140619_080043.jpg','Buah'),(45,'Del/GD512.G14.719/20/14','Meja Kelas',6,3,18,'',23,NULL,'Meja Kelas GD512','20140619_075117.jpg','Buah'),(48,'Del/GD713.G14.341/20/14','Meja Gambar',6,5,29,'',30,NULL,'jfasf','esgr.jpg','buah'),(47,'Del/GD713.G14.510/20/14','Meja Gambar',6,5,29,'',30,NULL,'jfasf','20140619_080130.jpg','buah'),(34,'Del/LPPM.D15.235/20/14','kursi roda achigama merah',3,3,8,'',10,NULL,'kursi roda','atk.jpg','Buah'),(32,'Del/LPPM.D15.481/20/14','kursi roda achigama merah',3,3,8,'',10,NULL,'kursi roda','20140619_080057.jpg','Buah'),(33,'Del/LPPM.D15.806/20/14','kursi roda achigama merah',3,3,8,'',10,NULL,'kursi roda','20140619_075117.jpg','Buah'),(9,'Del/LPPM.D6./11/14','Meja Panjang Kuning',2,3,8,'',180,NULL,'kkokoko','Chrysanthemum.jpg','Buah'),(31,'Del/LPPM.D6.568/20/14','keranjang sampah berjaring',2,3,8,'',2,NULL,'keranjang','Inventory.jpg','Buah'),(14,'Del/MR.D6.483/16/14','Kursi',2,3,11,'',40,NULL,'Berada di ruangan meeting.','Jellyfish.jpg','Buah'),(41,'Del/MR.E6.395/20/14','Lemari Besar 4 Pintu',16,3,11,'',1,NULL,'LEMARI BESAR','headerajah.jpg','BUAH'),(40,'Del/MR.Ti.507/20/14','Tirai plastic biru 2 nako',21,3,11,'',10,NULL,'tirai','header.jpg','buah'),(17,'Del/Perpus.D6.170/20/14','Kursi biasa kain',2,3,77,'',10,NULL,'Kursi ','20140619_080130.jpg','Buah'),(20,'Del/Perpus.D6.378/20/14','Kursi biasa kain',2,3,77,'',10,NULL,'Kursi ','20140619_080043.jpg','Buah'),(19,'Del/Perpus.D6.458/20/14','Kursi biasa kain',2,3,77,'',10,NULL,'Kursi ','20140619_075117.jpg','Buah'),(18,'Del/Perpus.D6.751/20/14','Kursi biasa kain',2,3,77,'',9,NULL,'Kursi ','20140619_080125.jpg','Buah'),(16,'Del/Perpus.E6.569/20/14','Lemari buku/koran',16,3,77,'',3,NULL,'Lemari buku','atk1.jpg','Buah'),(21,'Del/Perpus.E6.950/20/14','Lemari besar 3 laci',16,3,77,'',10,NULL,'lemari','20140619_080115.jpg','Buah'),(22,'Del/Perpus.E6.984/20/14','Lemari besar 3 laci',16,3,77,'',10,NULL,'lemari','asset.jpg','Buah'),(23,'Del/Perpus.G14.617/20/14','Meja baca kayu',6,3,78,'',5,NULL,'meja','20140619_075117.jpg','Buah'),(24,'Del/Perpus.G14.801/20/14','Meja baca kayu',6,3,78,'',5,NULL,'meja','Inventory.jpg','Buah'),(25,'Del/Perpus.H5.436/20/14','Papan tulis kecil tidak berbingkai',11,3,79,'',3,NULL,'tulis','20140619_075318.jpg','Buah'),(26,'Del/Perpus.H5.546/20/14','Papan tulis kecil tidak berbingkai',11,3,79,'',3,NULL,'tulis','atk.jpg','Buah'),(36,'Del/Sek.B12.623/20/14','Jam dinding',10,3,9,'',10,NULL,'jam','asset.jpg','buah'),(13,'Del/Sek.B5.312/13/14','Lampu Kamar',4,3,9,'',23,NULL,'Lampu ASP dan ASPI.','Jellyfish.jpg','Buah'),(35,'Del/Sek.G4.076/20/14','Meja computer biasa',7,3,9,'',10,NULL,'meja','header.png','Buah');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `loan` */

insert  into `loan`(`id`,`id_user`,`code_inventory`,`id_location`,`date_loan`,`date_return`,`quantity_loan`,`quantity_demaged`,`status_apporval`,`status_loan`) values (24,5,'Del/ASPA.B5.560/11/14',13,'2014-06-11','2014-06-18',3,3,1,1),(26,5,'Del/ASPA.B5.560/11/14',13,'2014-06-13','2014-06-13',2,NULL,1,1),(29,5,'Del/ASPA.B5.560/11/14',13,'2014-06-18',NULL,1,NULL,1,NULL),(31,5,'Del/ASPA.B5.560/11/14',13,NULL,NULL,28,NULL,NULL,NULL),(32,5,'Del/ASPA.B5.560/11/14',13,'2014-06-20',NULL,1,NULL,1,NULL),(33,5,'Del/ASPA.B5.560/11/14',13,NULL,NULL,2,NULL,NULL,NULL),(34,5,'Del/ASPA.A7.342/20/14',13,NULL,NULL,4,NULL,NULL,NULL),(35,1,'Del/ASPA.B5.560/11/14',13,NULL,NULL,4,NULL,NULL,NULL);

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_location` varchar(50) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`id`,`code_location`,`name`,`description`) values (5,'RR','REKTOR',NULL),(8,'LPPM','LPPM',NULL),(9,'Sek','Sekretariat',NULL),(10,'CR','COMMONROOM',NULL),(11,'MR','MEETINGROOM',NULL),(12,'EH','ENTRANCE',NULL),(13,'ASPA','ASPA',NULL),(14,'ASPI','ASPI',NULL),(15,'GBK1','GBK1',NULL),(16,'GBK2','GBK2',NULL),(17,'GD511','GD511',NULL),(18,'GD512','GD512',NULL),(19,'GD513','GD513',NULL),(20,'GD514','GD514',NULL),(21,'GD516','GD516',NULL),(22,'GD521','GD521',NULL),(23,'GD522','GD522',NULL),(24,'GD523','GD523',NULL),(25,'GD524','GD524',NULL),(26,'GD526','GD526',NULL),(27,'GD711','GD711',NULL),(28,'GD712','GD712',NULL),(29,'GD713','GD713',NULL),(30,'GD721','GD721',NULL),(31,'GD722','GD722',NULL),(32,'GHA','GHA',NULL),(33,'GBH','GBH',NULL),(34,'GHC','GHC',NULL),(35,'GHE','GHE',NULL),(36,'GHD','GHD',NULL),(37,'GHF','GHF',NULL),(38,'RDSAS','RDSAS',NULL),(39,'RDA','RDA',NULL),(40,'RDC','RDC',NULL),(41,'RDD','RDD',NULL),(42,'RDE','RDE',NULL),(43,'RDF','RDF',NULL),(44,'S1.1','ST11',NULL),(45,'S1.2','ST12',NULL),(46,'S1.3','ST13',NULL),(47,'S1.4','ST14',NULL),(48,'S1.5','ST15',NULL),(49,'S1.6','ST16',NULL),(50,'S1.7','ST17',NULL),(51,'S2.1','ST21',NULL),(52,'S2.2','ST22',NULL),(53,'S2.3','ST23',NULL),(54,'S2.4','ST24',NULL),(55,'S2.5','ST25',NULL),(56,'S2.6','ST26',NULL),(57,'S2.7','ST27',NULL),(58,'S2.8','ST28',NULL),(59,'M101','M101',NULL),(60,'M102','M102',NULL),(61,'M103','M103',NULL),(62,'M201','M201',NULL),(63,'M202','M202',NULL),(64,'M203','M203',NULL),(65,'M204','M204',NULL),(66,'TH01','TH01',NULL),(67,'TH02','TH02',NULL),(68,'TH03','TH03',NULL),(69,'TH04','TH04',NULL),(70,'TH05','TH05',NULL),(71,'TH06','TH06',NULL),(72,'TH07','TH07',NULL),(73,'TH08','TH08',NULL),(74,'DS','DOSENSTAFF(LantaiAtas)',NULL),(75,'DS','DOSENSTAFF(Teras)',NULL),(76,'DS','DOSENSTAFF(LantaiBawah)',NULL),(77,'Perpus','PERPUSTAKAAN(RuangBacaTenang)',NULL),(78,'Perpus','PERPUSTAKAAN(RuangDiskusi)',NULL),(79,'Perpus','PERPUSTAKAAN(RuangAudioVisual)',NULL),(80,'Perpus','PERPUSTAKAAN(RuangRefrensi)',NULL),(81,'Perpus','PERPUSTAKAAN(RuangPengolahan)',NULL),(82,'Perpus','PERPUSTAKAAN(RuangSirkulasi)',NULL),(83,'Perpus','PERPUSTAKAAN(Lantai II)',NULL),(84,'Perpus','PERPUSTAKAAN(RuangHeadLibrarian)',NULL),(85,'Perpus','PERPUSTAKAAN(LuarPerpustakaan)',NULL),(86,'DOSENSTAFF','DOSENSTAFF',NULL);

/*Table structure for table `type` */

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_type` varchar(100) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `type` */

insert  into `type`(`id`,`code_type`,`name`) values (2,'D6','Kursi Biasa'),(3,'D15','Kursi Roda'),(4,'B5','Lampu'),(5,'G26','Meja Bulat'),(6,'G14','Meja Panjang'),(7,'G4','Meja Komputer'),(8,'B14','Telepon'),(9,'A7','Keranjang Sampah'),(10,'B12','Jam Dinding'),(11,'H5','Papan Tulis Kecil '),(12,'O1','Peta'),(13,'O2','Lukisan'),(14,'E3','Lemari Arsip'),(15,'B15','Fotocopi'),(16,'E6','Lemari Besar '),(17,'E9','Lemari Kecil '),(18,'H5','Papan tulis'),(19,'sf','SOfa'),(20,'dp','Dispenser'),(21,'Ti','Tirai'),(22,'TV','Televisi');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
