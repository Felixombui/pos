/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.0.45-community-nt : Database - pos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pos`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(50) default NULL,
  `item` varchar(50) default NULL,
  `unitcost` double default NULL,
  `quantity` double default NULL,
  `totalcost` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `cart` */

insert  into `cart`(`id`,`user`,`item`,`unitcost`,`quantity`,`totalcost`) values 
(17,'Mandela','Scissors',150,1,150),
(18,'Mandela','Amazon Fast Charger',350,1,350);

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(50) default NULL,
  `image` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category`,`image`) values 
(1,'Books','categories/books.jpg'),
(2,'Stationery','categories/stationery.jpg'),
(3,'Chargers','categories/charger.JPG');

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) NOT NULL auto_increment,
  `itemname` varchar(50) default NULL,
  `unitofmeasure` varchar(20) default NULL,
  `unitamount` double default NULL,
  `buyingprice` double default NULL,
  `sellingprice` double default NULL,
  `category` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `items` */

insert  into `items`(`id`,`itemname`,`unitofmeasure`,`unitamount`,`buyingprice`,`sellingprice`,`category`) values 
(1,'Sound and Read','1',1,200,350,'Books'),
(2,'Scissors','1',1,100,150,'Stationery'),
(3,'Amazon Fast Charger','1',1,200,350,'Chargers'),
(4,'Encyclopedia PP1','1',1,490,560,'Books');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL auto_increment,
  `salesid` int(11) default NULL,
  `customer` varchar(50) default NULL,
  `amountpayable` double default NULL,
  `amountpaid` double default NULL,
  `balance` double default NULL,
  `date_time` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `payments` */

insert  into `payments`(`id`,`salesid`,`customer`,`amountpayable`,`amountpaid`,`balance`,`date_time`) values 
(1,2,'Mandela',150,450,50,'2021-09-17 00:00:00'),
(2,6,'Mandela',750,450,50,'2021-09-17 09:23:31'),
(3,7,'Gakindu Dairy',900,450,50,'2021-09-17 11:31:16'),
(4,7,'Gakindu Dairy',900,450,50,'2021-09-17 11:31:16'),
(5,7,'Gakindu Dairy',900,450,50,'2021-09-17 11:31:16'),
(6,8,'Mary',500,450,50,'2021-09-17 12:08:36'),
(7,8,'Mary',500,450,50,'2021-09-17 12:08:36'),
(8,9,'Mandela',1060,1060,0,'2021-09-17 02:38:54'),
(9,9,'Mandela',1060,1060,0,'2021-09-17 02:38:54'),
(10,9,'Mandela',1060,1060,0,'2021-09-17 02:38:54');

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int(11) NOT NULL auto_increment,
  `salesid` int(11) default NULL,
  `itemname` varchar(50) default NULL,
  `unitcost` double default NULL,
  `quantity` double default NULL,
  `totalcost` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `sales` */

insert  into `sales`(`id`,`salesid`,`itemname`,`unitcost`,`quantity`,`totalcost`) values 
(1,1,'0',10,2,20),
(2,1,'Scissors',150,1,25),
(3,1,'Scissors',150,2,25),
(4,1,'Scissors',150,1,150),
(5,1,'Scissors',150,1,150),
(6,6,'Scissors',150,5,750),
(7,7,'Scissors',150,2,300),
(8,7,'Scissors',150,3,450),
(9,7,'Scissors',150,1,150),
(10,8,'Scissors',150,1,150),
(11,8,'Amazon Fast Charger',350,1,350),
(12,9,'Encyclopedia PP1',560,1,560),
(13,9,'Amazon Fast Charger',350,1,350),
(14,9,'Scissors',150,1,150);

/*Table structure for table `salesid` */

DROP TABLE IF EXISTS `salesid`;

CREATE TABLE `salesid` (
  `id` int(11) NOT NULL auto_increment,
  `customer` varchar(50) default NULL,
  `salesamount` double default NULL,
  `salesdate` datetime default NULL,
  `status` varchar(20) default 'Pending',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `salesid` */

insert  into `salesid`(`id`,`customer`,`salesamount`,`salesdate`,`status`) values 
(2,'Mandela',150,'2021-09-17 00:00:00','Pending'),
(6,'Mandela',750,'2021-09-17 09:23:31','Pending'),
(7,'Gakindu Dairy',900,'2021-09-17 11:31:16','Pending'),
(8,'Mary',500,'2021-09-17 12:08:36','Pending'),
(9,'Mandela',1060,'2021-09-17 02:38:54','Pending');

/*Table structure for table `stocks` */

DROP TABLE IF EXISTS `stocks`;

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL auto_increment,
  `itemname` varchar(50) default NULL,
  `previousstock` double default NULL,
  `newstock` double default NULL,
  `stockbalance` double default NULL,
  `date_time` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `stocks` */

insert  into `stocks`(`id`,`itemname`,`previousstock`,`newstock`,`stockbalance`,`date_time`) values 
(1,'Scissors',0,10,10,'16-09-2021 09:19:12'),
(2,'Scissors',10,15,25,'16-09-2021 09:32:40'),
(3,'0',0,-2,-2,'16-09-2021'),
(4,'Scissors',25,-1,24,'16-09-2021'),
(5,'Scissors',24,-2,22,'16-09-2021'),
(6,'Scissors',22,-1,21,'16-09-2021'),
(7,'Scissors',21,-1,20,'2021-09-17'),
(8,'Scissors',20,-5,15,'2021-09-17 09:23:31'),
(9,'Scissors',15,-2,13,'2021-09-17 11:31:16'),
(10,'Scissors',13,-3,10,'2021-09-17 11:31:16'),
(11,'Scissors',10,-1,9,'2021-09-17 11:31:16'),
(12,'Amazon Fast Charger',0,5,5,'17-09-2021 12:07:35'),
(13,'Scissors',9,-1,8,'2021-09-17 12:08:36'),
(14,'Amazon Fast Charger',5,-1,4,'2021-09-17 12:08:36'),
(15,'Encyclopedia PP1',0,8,8,'17-09-2021 02:29:01'),
(16,'Encyclopedia PP1',8,8,16,'17-09-2021 02:29:52'),
(17,'Encyclopedia PP1',16,-1,15,'2021-09-17 02:38:54'),
(18,'Amazon Fast Charger',4,-1,3,'2021-09-17 02:38:54'),
(19,'Scissors',8,-1,7,'2021-09-17 02:38:54');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `fullnames` varchar(50) default NULL,
  `phonenumber` varchar(15) default NULL,
  `username` varchar(20) default NULL,
  `password` varchar(200) default NULL,
  `status` varchar(20) default 'Active',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`fullnames`,`phonenumber`,`username`,`password`,`status`) values 
(1,'Raphael Machoka','0708138498','Mandela','2da97dab4f354ad89290d08b60c7193f','Active'),
(2,'Selina Wachira','0719431811','Selina','3ffa92a02778cd00286025c8385f5322','Active');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
