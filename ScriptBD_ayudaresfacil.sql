/*
SQLyog Trial v11.4 (32 bit)
MySQL - 5.6.16 : Database - ayudaresfacil
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ayudaresfacil` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `ayudaresfacil`;

/*Table structure for table `action` */

DROP TABLE IF EXISTS `action`;

CREATE TABLE `action` (
  `action_id` decimal(2,0) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`action_id`),
  UNIQUE KEY `UQ_SocialNetwork_Action_description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `action` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` tinyint(4) NOT NULL,
  `description` varchar(70) NOT NULL,
  `common_state_id` char(1) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `common_state_id` (`common_state_id`),
  CONSTRAINT `FK_Category_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `category` */

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `city` */

/*Table structure for table `common_state` */

DROP TABLE IF EXISTS `common_state`;

CREATE TABLE `common_state` (
  `common_state_id` char(1) NOT NULL,
  `description` varchar(50) NOT NULL,
  `comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `common_state` */

insert  into `common_state`(`common_state_id`,`description`,`comments`) values ('A','ACTIVO',NULL),('B','BAJA',NULL),('L','LEIDO',NULL),('N','NUEVO',NULL);

/*Table structure for table `donated_object` */

DROP TABLE IF EXISTS `donated_object`;

CREATE TABLE `donated_object` (
  `donation_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `quantity` decimal(3,0) NOT NULL,
  PRIMARY KEY (`donation_id`,`object_id`),
  KEY `donation_id` (`donation_id`),
  KEY `object_id` (`object_id`),
  CONSTRAINT `FK_Donated_Object_Donation` FOREIGN KEY (`donation_id`) REFERENCES `donation` (`donation_id`),
  CONSTRAINT `FK_Donated_Object_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `donated_object` */

/*Table structure for table `donation` */

DROP TABLE IF EXISTS `donation`;

CREATE TABLE `donation` (
  `donation_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `donation_date` datetime NOT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `process_state_id` char(1) NOT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `process_state_id` (`process_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Donation_Process_state` FOREIGN KEY (`process_state_id`) REFERENCES `process_state` (`process_state_id`),
  CONSTRAINT `FK_Donation_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Donation_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `donation` */

/*Table structure for table `favourite_publication` */

DROP TABLE IF EXISTS `favourite_publication`;

CREATE TABLE `favourite_publication` (
  `favourite_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favourite_id`,`publication_id`,`user_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Favourite_Publication_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Favourite_Publication_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `favourite_publication` */

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `user_id_from` mediumint(9) NOT NULL,
  `user_id_to` mediumint(9) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  `first_message_id` int(11) DEFAULT NULL,
  `FAQ` tinyint(1) DEFAULT '0',
  `common_state_id` char(1) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `publication_id` (`publication_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `user_id_from` (`user_id_from`),
  KEY `user_id_to` (`user_id_to`),
  CONSTRAINT `FK_Message_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Message_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  CONSTRAINT `FK_Message_User_From` FOREIGN KEY (`user_id_from`) REFERENCES `user` (`user_id`),
  CONSTRAINT `FK_Message_User_To` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `message` */

/*Table structure for table `monetary_order` */

DROP TABLE IF EXISTS `monetary_order`;

CREATE TABLE `monetary_order` (
  `publication_id` int(11) NOT NULL,
  `total_amount` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `FK_Monetary_Order_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `monetary_order` */

/*Table structure for table `nonmonetary_order` */

DROP TABLE IF EXISTS `nonmonetary_order`;

CREATE TABLE `nonmonetary_order` (
  `publication_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `quantity` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`publication_id`,`object_id`),
  KEY `object_id` (`object_id`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `FK_NonMonetary_Order_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`),
  CONSTRAINT `FK_NonMonetary_Order_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `nonmonetary_order` */

/*Table structure for table `object` */

DROP TABLE IF EXISTS `object`;

CREATE TABLE `object` (
  `object_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `object` */

/*Table structure for table `offer` */

DROP TABLE IF EXISTS `offer`;

CREATE TABLE `offer` (
  `publication_id` int(11) NOT NULL,
  `process_state_id` char(1) DEFAULT NULL,
  `offer_type_id` tinyint(4) DEFAULT NULL,
  `quantity_users_to_paused` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `offer_type_id` (`offer_type_id`),
  KEY `process_state_id` (`process_state_id`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `FK_Offer_Offer_Type` FOREIGN KEY (`offer_type_id`) REFERENCES `offer_type` (`offer_type_id`),
  CONSTRAINT `FK_Offer_Process_state` FOREIGN KEY (`process_state_id`) REFERENCES `process_state` (`process_state_id`),
  CONSTRAINT `FK_Offer_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `offer` */

/*Table structure for table `offer_object` */

DROP TABLE IF EXISTS `offer_object`;

CREATE TABLE `offer_object` (
  `publication_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`publication_id`,`object_id`),
  KEY `object_id` (`object_id`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `FK_Offer_Object_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`),
  CONSTRAINT `FK_Offer_Object_Offer` FOREIGN KEY (`publication_id`) REFERENCES `offer` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `offer_object` */

/*Table structure for table `offer_type` */

DROP TABLE IF EXISTS `offer_type`;

CREATE TABLE `offer_type` (
  `offer_type_id` tinyint(4) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`offer_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `offer_type` */

insert  into `offer_type`(`offer_type_id`,`description`,`comments`) values (1,'AL PRIMER POSTOR','EL PRIMERO QUE SOLICITE LA PUBLICACION, SE HACE PROPIETARIO DE LA MISMA.'),(2,'ELECCION ENTRE CANDIDATOS','SE ESTABLECE UN NUMERO DE POSIBLES PROPIETARIOS. UNA VEZ ALCANZADOS, SE PAUSA LA PUBLICACION Y SE EVALUA ALGUNA (O NINGUNA) DE LAS OPCIONES.'),(3,'EVALUACION UNO A UNO','CADA VEZ QUE ALGUIEN SOLICITA LO OFRECIDO, SE PAUSA LA PUBLICACION Y SE EVALUA SI ES (O NO) INDICADO PARA RECIBIR EL OFRECIMIENTO.');

/*Table structure for table `process_state` */

DROP TABLE IF EXISTS `process_state`;

CREATE TABLE `process_state` (
  `process_state_id` char(1) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`process_state_id`),
  UNIQUE KEY `UQ_Process_state_description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `process_state` */

insert  into `process_state`(`process_state_id`,`description`) values ('C','CERRADO'),('P','PAUSADO'),('V','VIGENTE');

/*Table structure for table `province` */

DROP TABLE IF EXISTS `province`;

CREATE TABLE `province` (
  `province_id` decimal(2,0) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `province` */

/*Table structure for table `publication` */

DROP TABLE IF EXISTS `publication`;

CREATE TABLE `publication` (
  `publication_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `creation_date` datetime NOT NULL,
  `tittle` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `category_id` tinyint(4) DEFAULT NULL,
  `subcategory_id` tinyint(4) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `process_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `category_id` (`category_id`),
  KEY `process_state_id` (`process_state_id`),
  KEY `category_id_2` (`category_id`,`subcategory_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Publication_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `FK_Publication_Process_state` FOREIGN KEY (`process_state_id`) REFERENCES `process_state` (`process_state_id`),
  CONSTRAINT `FK_Publication_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publication` */

/*Table structure for table `publication_socialnetwork_activity` */

DROP TABLE IF EXISTS `publication_socialnetwork_activity`;

CREATE TABLE `publication_socialnetwork_activity` (
  `publication_id` int(11) NOT NULL,
  `action_id` decimal(2,0) DEFAULT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_id` (`publication_id`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Publication_SocialNetwork_Activity_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Publication_SocialNetwork_Activity_SocialNetwork_Action` FOREIGN KEY (`action_id`) REFERENCES `action` (`action_id`),
  CONSTRAINT `FK_Publication_SocialNetwork_Activity_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publication_socialnetwork_activity` */

/*Table structure for table `sponsor` */

DROP TABLE IF EXISTS `sponsor`;

CREATE TABLE `sponsor` (
  `sponsor_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `social_network_id` int(11) DEFAULT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`),
  UNIQUE KEY `UQ_Sponsor_social_network_id` (`social_network_id`),
  KEY `common_state_id` (`common_state_id`),
  CONSTRAINT `FK_Sponsor_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sponsor` */

/*Table structure for table `sponsor_publication` */

DROP TABLE IF EXISTS `sponsor_publication`;

CREATE TABLE `sponsor_publication` (
  `sponsor_id` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `common_state_id` char(1) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`,`publication_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `sponsor_id` (`sponsor_id`),
  CONSTRAINT `FK_Sponsor_Publication_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  CONSTRAINT `FK_Sponsor_Publication_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Sponsor_Publication_Sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sponsor_publication` */

/*Table structure for table `subcategory` */

DROP TABLE IF EXISTS `subcategory`;

CREATE TABLE `subcategory` (
  `category_id` tinyint(4) NOT NULL,
  `subcategory_id` tinyint(4) NOT NULL,
  `description` varchar(50) NOT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`category_id`,`subcategory_id`),
  KEY `category_id` (`category_id`),
  KEY `common_state_id` (`common_state_id`),
  CONSTRAINT `FK_Subcategory_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `FK_Subcategory_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `subcategory` */

/*Table structure for table `type_phone` */

DROP TABLE IF EXISTS `type_phone`;

CREATE TABLE `type_phone` (
  `type_phone_id` tinyint(4) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`type_phone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `type_phone` */

insert  into `type_phone`(`type_phone_id`,`description`) values (1,'PARTICULAR'),(2,'CELULAR'),(3,'LABORAL');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` mediumint(9) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `last_login` date DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UQ_User_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user` */

/*Table structure for table `user_address` */

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `number` decimal(8,0) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `province_id` decimal(3,0) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `floor` varchar(4) DEFAULT NULL,
  `department` varchar(4) DEFAULT NULL,
  `principal` char(1) DEFAULT NULL,
  PRIMARY KEY (`address_id`,`user_id`),
  KEY `city_id` (`city_id`),
  KEY `province_id` (`province_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_User_Address_City` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `FK_User_Address_Province` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`),
  CONSTRAINT `FK_User_Address_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_address` */

/*Table structure for table `user_data` */

DROP TABLE IF EXISTS `user_data`;

CREATE TABLE `user_data` (
  `user_id` mediumint(9) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday_date` datetime DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_User_Data_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_data` */

/*Table structure for table `user_phone` */

DROP TABLE IF EXISTS `user_phone`;

CREATE TABLE `user_phone` (
  `user_id` mediumint(9) NOT NULL,
  `phone_id` mediumint(9) NOT NULL,
  `number` varchar(25) DEFAULT NULL,
  `type_phone_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`phone_id`),
  KEY `type_phone_id` (`type_phone_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_User_Phone_Type_Phone` FOREIGN KEY (`type_phone_id`) REFERENCES `type_phone` (`type_phone_id`),
  CONSTRAINT `FK_User_Phone_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_phone` */

/*Table structure for table `user_request` */

DROP TABLE IF EXISTS `user_request`;

CREATE TABLE `user_request` (
  `publication_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `request_date` datetime DEFAULT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`publication_id`,`user_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_User_Request_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  CONSTRAINT `FK_User_Request_Offer` FOREIGN KEY (`publication_id`) REFERENCES `offer` (`publication_id`),
  CONSTRAINT `FK_User_Request_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_request` */

/*Table structure for table `user_score` */

DROP TABLE IF EXISTS `user_score`;

CREATE TABLE `user_score` (
  `user_id_from` mediumint(9) NOT NULL,
  `user_id_to` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `score` decimal(1,0) DEFAULT NULL,
  `scoring_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id_from`,`user_id_to`,`publication_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id_from` (`user_id_from`),
  KEY `user_id_to` (`user_id_to`),
  CONSTRAINT `FK_User_Score_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_User_Score_User_From` FOREIGN KEY (`user_id_from`) REFERENCES `user` (`user_id`),
  CONSTRAINT `FK_User_Score_User_To` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_score` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
