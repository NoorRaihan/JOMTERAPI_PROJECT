/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.24 : Database - mbsadmin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mbsadmin` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mbsadmin`;

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL DEFAULT '0',
  `lastname` varchar(50) DEFAULT '0',
  `sex` int(1) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `pic` varchar(255) DEFAULT '''https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png''',
  `u_id` int(50) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK__users` (`u_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `members` */

insert  into `members`(`id`,`firstname`,`lastname`,`sex`,`phone`,`pic`,`u_id`) values 
(1,'NOOR RAIHAN BIN','RAHIM',1,'177387782','\'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png\'',4),
(2,'ali','mamak',1,'015527151','\'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png\'',5),
(3,'alia','aisyah',1,'0197651234','\'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png\'',6),
(4,'muhd','ahmad',1,'1111111111','\'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png\'',7);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `roles` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`id`,`roles`) values 
(1,'Admin'),
(2,'User');

/*Table structure for table `sexes` */

DROP TABLE IF EXISTS `sexes`;

CREATE TABLE `sexes` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sexes` */

insert  into `sexes`(`id`,`name`) values 
(1,'MALE'),
(2,'FEMALE');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL DEFAULT '',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `roles` int(1) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`passwords`,`created_at`,`email`,`updated_at`,`created_by`,`roles`,`updated_by`) values 
(1,'NOOR RAIHAN','12345','2021-03-12 22:33:49','','2021-03-13 15:51:11','admin',1,'admin'),
(4,'tester','12345','2021-03-12 23:43:43','blazerred71@gmail.com','2021-03-12 23:43:43','tester',0,'tester'),
(5,'vchans','123456789','2021-03-13 12:10:44','ali@gmail.com','2021-03-13 12:10:44','vchans',0,'vchans'),
(6,'alia001','$argon2i$v=19$m=1024,t=2,p=2$VTdyRnlGLk50T3FzRTBlUQ$kYzO6GMj/07dRSA1SEDAz9CiPvxz10f0IuLrxX1ZSb4','2021-03-13 12:17:49','alia@yahoo.com','2021-03-13 12:17:49','alia001',0,'alia001'),
(7,'ahmad123','$argon2i$v=19$m=2048,t=4,p=2$clY2dlguRjY5L3M0TzlVZA$r7Ho5nkC0LTqQI9fbKgmgynx0743n84CHtp2exT1Pys','2021-03-13 13:40:36','ahmad@gmail.com','2021-03-13 13:40:36','ahmad123',0,'ahmad123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
