/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.4.27-MariaDB : Database - reservation
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`reservation` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;

USE `reservation`;

/*Table structure for table `classroom` */

DROP TABLE IF EXISTS `classroom`;

CREATE TABLE `classroom` (
  `classID` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `className` tinytext NOT NULL,
  `people` tinytext DEFAULT NULL,
  `zone` tinytext DEFAULT NULL,
  `location` tinytext DEFAULT NULL,
  `cdate` tinytext DEFAULT NULL,
  `ctime` bigint(10) unsigned DEFAULT 9,
  `duration` bigint(10) unsigned DEFAULT 1,
  `booker` bigint(10) unsigned DEFAULT 0,
  PRIMARY KEY (`classID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `classroom` */

insert  into `classroom`(`classID`,`className`,`people`,`zone`,`location`,`cdate`,`ctime`,`duration`,`booker`) values (1,'a','b','c','d','2024-06-25',7,4,5),(2,'TEST','te','sss','ffd','2024-06-03',12,4,0),(4,'tww','wetw','ewrw','rwerw','2024-06-29',5,1,0),(5,'wqe','wqe','ewq','wqew','2024-06-04',3,4,0),(6,'wer','wer','wer','wer','2024-06-05',3,2,0),(7,'ew','ew','e','ew','2024-06-30',1,3,16),(8,'TEST','eqwe','eqwe','eqwe','2024-05-27',3,5,0);

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contact` */

insert  into `contact`(`id`,`name`,`email`,`subject`,`message`) values (1,'Ajay','ajay@gmail.com','qdeeas','dsgffhgjhmhjm');

/*Table structure for table `general_settings` */

DROP TABLE IF EXISTS `general_settings`;

CREATE TABLE `general_settings` (
  `ID` bigint(10) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Address_line1` text NOT NULL,
  `Address_line2` text NOT NULL,
  `City` varchar(10) NOT NULL,
  `State` varchar(10) NOT NULL,
  `Country` varchar(10) NOT NULL,
  `Zip_code` bigint(10) NOT NULL,
  `Email` text NOT NULL,
  `Phone_number` bigint(10) NOT NULL,
  `Telephone_number` bigint(10) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `general_settings` */

insert  into `general_settings`(`ID`,`Name`,`Address_line1`,`Address_line2`,`City`,`State`,`Country`,`Zip_code`,`Email`,`Phone_number`,`Telephone_number`,`Description`) values (1,'Class Reservation','','','','','',0,'',0,0,'');

/*Table structure for table `reserved` */

DROP TABLE IF EXISTS `reserved`;

CREATE TABLE `reserved` (
  `bookID` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `classID` bigint(10) unsigned DEFAULT NULL,
  `userID` bigint(10) unsigned DEFAULT NULL,
  `RDate` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `reserved` */

insert  into `reserved`(`bookID`,`classID`,`userID`,`RDate`,`Status`) values (1,1,5,'2024-06-20','Reserved'),(14,7,16,'2024-06-27','Reserved'),(15,4,16,'2024-06-28','Cancelled');

/*Table structure for table `users_details` */

DROP TABLE IF EXISTS `users_details`;

CREATE TABLE `users_details` (
  `UserId` bigint(10) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` text NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Credit` bigint(10) NOT NULL DEFAULT 0,
  `ProfileImage` text NOT NULL DEFAULT 'user.png',
  `Status` enum('active','in-active') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users_details` */

insert  into `users_details`(`UserId`,`FirstName`,`LastName`,`Email`,`Password`,`Address`,`Credit`,`ProfileImage`,`Status`) values (2,'admin','kumar','admin@gmail.com','123','ssss',0,'image-1719109283168.png','in-active'),(5,'Rajesh','K S','raju@gmail.com','123','TET',150,'image-1718755244664.jpg','active'),(11,'kamesh','K S','kamesh@gmail.com','123','9636636363',0,'images.jpg','active'),(15,'Rakesh','Balu','rakesh@gmail.com','1234','8563526352',0,'4.jpg','active'),(16,'John','Smith','john@email.com','123','TEST ADDRESS',0,'image-1716648460352.jpg','active'),(17,'te','tet','te@email.com','123','tet',100,'image-1716649062449.jpg','active');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
