/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.16 : Database - ayudaresfacil
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`ayudaresfacil` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `ayudaresfacil`;

/*Table structure for table `action` */

DROP TABLE IF EXISTS `action`;

CREATE TABLE `action` (
  `action_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`action_id`),
  UNIQUE KEY `UQ_SocialNetwork_Action_description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `action` */

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
  CONSTRAINT `FK_Donated_Object_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`),
  CONSTRAINT `FK_Donated_Object_Donation` FOREIGN KEY (`donation_id`) REFERENCES `donation` (`donation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `donated_object` */

/*Table structure for table `donation` */

DROP TABLE IF EXISTS `donation`;

CREATE TABLE `donation` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `donation_date` datetime NOT NULL,
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

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` mediumint(9) NOT NULL,
  `user_id_to` mediumint(9) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  `first_message_id` int(11) DEFAULT NULL,
  `FAQ` tinyint(1) DEFAULT '0',
  `common_state_id` char(1) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `publication_id` (`publication_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `user_id_from` (`user_id_from`),
  KEY `user_id_to` (`user_id_to`),
  CONSTRAINT `FK_Message_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Message_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  CONSTRAINT `FK_Message_User_From` FOREIGN KEY (`user_id_from`) REFERENCES `user` (`user_id`),
  CONSTRAINT `FK_Message_User_To` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `message` */

insert  into `message`(`message_id`,`user_id_from`,`user_id_to`,`publication_id`,`first_message_id`,`FAQ`,`common_state_id`,`subject`,`text`,`create_date`,`update_date`,`delete_date`) values (1,4,4,0,0,0,'N','testing','Nuevo mensaje','2014-05-04 03:52:11','2014-05-04 04:05:49','2014-05-04 04:08:01'),(2,4,4,0,0,0,'N',NULL,'Nuevo mensaje','2014-05-04 03:52:34',NULL,NULL),(3,4,4,0,0,0,'N','asunto prueba','Nuevo mensaje','2014-05-04 03:55:29','2014-05-04 04:01:59',NULL),(4,4,4,0,0,0,'N','asunto prueba','Nuevo mensaje','2014-05-04 03:58:54',NULL,NULL);

/*Table structure for table `object` */

DROP TABLE IF EXISTS `object`;

CREATE TABLE `object` (
  `object_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `object` */

insert  into `object`(`object_id`,`description`,`created_date`) values (1,'DINERO','2014-06-09 00:00:00'), (2,'MESA','2014-06-09 00:00:00'), (3,'LIBROS','2014-06-09 00:00:00');

/*Table structure for table `offer_type` */

DROP TABLE IF EXISTS `offer_type`;

CREATE TABLE `offer_type` (
  `offer_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`offer_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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

insert  into `process_state`(`process_state_id`,`description`) values ('C','CERRADO'),('P','PAUSADO'),('V','VIGENTE'),('B','BORRADO');

/*Table structure for table `publication` */

DROP TABLE IF EXISTS `publication`;

CREATE TABLE `publication` (
  `publication_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) NOT NULL,
  `publication_type_id` tinyint(4) DEFAULT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `expiration_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `category_id` tinyint(4) DEFAULT NULL,
  `subcategory_id` tinyint(4) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `process_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `category_id` (`category_id`),
  KEY `process_state_id` (`process_state_id`),
  KEY `category_id_2` (`category_id`,`subcategory_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Publication_Publication_Category` FOREIGN KEY (`category_id`) REFERENCES `publication_category` (`category_id`),
  CONSTRAINT `FK_Publication_Process_state` FOREIGN KEY (`process_state_id`) REFERENCES `process_state` (`process_state_id`),
  CONSTRAINT `FK_Publication_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `publication` */

insert  into `publication`(`publication_id`,`user_id`,`publication_type_id`,`creation_date`,`title`,`description`,`expiration_date`,`category_id`,`subcategory_id`,`views`,`process_state_id`) values (0,4,NULL,'0000-00-00 00:00:00','','',NULL,NULL,NULL,NULL,NULL),(1,1,1,'2014-06-09 00:00:00','Prueba de Ofrecimiento','Este es un registro de prueba para ver si se puede obtener un ofrecimiento','2014-12-30 00:00:00',1,1,100,'V');

/*Table structure for table `publication_category` */

DROP TABLE IF EXISTS `publication_category`;

CREATE TABLE `publication_category` (
  `category_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(70) NOT NULL,
  `common_state_id` char(1) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_id` (`category_id`),
  KEY `common_state_id` (`common_state_id`),
  CONSTRAINT `FK_Category_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `publication_category` */

insert  into `publication_category`(`category_id`,`description`,`common_state_id`) values (1,'Muebles','A'),(2,'Salud','A');

/*Table structure for table `publication_favorite` */

DROP TABLE IF EXISTS `publication_favorite`;

CREATE TABLE `publication_favorite` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favorite_id`,`publication_id`,`user_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Publication_Favourite_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Publication_Favourite_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `publication_favorite` */

insert  into `publication_favorite`(`favorite_id`,`publication_id`,`user_id`,`start_date`) values (2,1,1,'2014-06-09 15:03:30');

/*Table structure for table `publication_object` */

DROP TABLE IF EXISTS `publication_object`;

CREATE TABLE `publication_object` (
  `publication_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `quantity` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`publication_id`,`object_id`),
  KEY `object_id` (`object_id`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `FK_Publication_Object_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`),
  CONSTRAINT `FK_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publication_object` */

/*Table structure for table `publication_offer` */

DROP TABLE IF EXISTS `publication_offer`;

CREATE TABLE `publication_offer` (
  `publication_id` int(11) NOT NULL,
  `process_state_offer` char(1) DEFAULT NULL,
  `offer_type_id` tinyint(4) DEFAULT NULL,
  `quantity_users_to_paused` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `offer_type_id` (`offer_type_id`),
  KEY `process_state_offer` (`process_state_offer`),
  KEY `publication_id` (`publication_id`),
  CONSTRAINT `FK_Offer_Offer_Type` FOREIGN KEY (`offer_type_id`) REFERENCES `offer_type` (`offer_type_id`),
  CONSTRAINT `FK_Offer_Process_state` FOREIGN KEY (`process_state_offer`) REFERENCES `process_state` (`process_state_id`),
  CONSTRAINT `FK_Offer_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publication_offer` */

insert  into `publication_offer`(`publication_id`,`process_state_offer`,`offer_type_id`,`quantity_users_to_paused`) values (1,'V',1,20);

/*Table structure for table `publication_socialnetwork_activity` */

DROP TABLE IF EXISTS `publication_socialnetwork_activity`;

CREATE TABLE `publication_socialnetwork_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `action_id` tinyint(4) DEFAULT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `publication_id` (`publication_id`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_Publication_SocialNetwork_Activity_SocialNetwork_Action` FOREIGN KEY (`action_id`) REFERENCES `action` (`action_id`),
  CONSTRAINT `FK_Publication_SocialNetwork_Activity_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  CONSTRAINT `FK_Publication_SocialNetwork_Activity_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publication_socialnetwork_activity` */

/*Table structure for table `publication_sponsor` */

DROP TABLE IF EXISTS `publication_sponsor`;

CREATE TABLE `publication_sponsor` (
  `sponsor_id` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `common_state_id` char(1) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`,`publication_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `sponsor_id` (`sponsor_id`),
  CONSTRAINT `FK_Publication_Sponsor_Sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`sponsor_id`),
  CONSTRAINT `FK_Publication_Sponsor_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  CONSTRAINT `FK_Publication_Sponsor_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publication_sponsor` */

/*Table structure for table `publication_subcategory` */

DROP TABLE IF EXISTS `publication_subcategory`;

CREATE TABLE `publication_subcategory` (
  `category_id` tinyint(4) NOT NULL,
  `subcategory_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `category_id` (`category_id`),
  KEY `common_state_id` (`common_state_id`),
  CONSTRAINT `FK_Publication_Subcategory_Category` FOREIGN KEY (`category_id`) REFERENCES `publication_category` (`category_id`),
  CONSTRAINT `FK_Subcategory_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `publication_subcategory` */

insert  into `publication_subcategory`(`category_id`,`subcategory_id`,`description`,`common_state_id`) values (1,1,'Habitacion','A'),(2,2,'Utilitarios','A');

/*Table structure for table `publication_type` */

DROP TABLE IF EXISTS `publication_type`;

CREATE TABLE `publication_type` (
  `publication_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`publication_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `publication_type` */

insert  into `publication_type`(`publication_type_id`,`name`,`description`) values (1,'Ofrecimiento',NULL),(2,'Pedido Monetario',NULL),(3,'Pedido de Objetos',NULL);

/*Table structure for table `sponsor` */

DROP TABLE IF EXISTS `sponsor`;

CREATE TABLE `sponsor` (
  `sponsor_id` mediumint(9) NOT NULL AUTO_INCREMENT,
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
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `last_login` date DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UQ_User_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`email`,`password`,`last_login`,`enabled`,`deleted`) values (1,'perezsebastianm@gmail.com','601f1889667efaebb33b8c12572835da3f027f78',NULL,1,0),(2,'sabriancasado@gmail.com','da39a3ee5e6b4b0d3255bfef95601890afd80709',NULL,1,0),(4,'sergio_areco@hotmail.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220',NULL,0,0);

/*Table structure for table `user_address` */

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `number` decimal(8,0) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `floor` varchar(4) DEFAULT NULL,
  `apartment` varchar(4) DEFAULT NULL,
  `principal` char(1) DEFAULT NULL,
  PRIMARY KEY (`address_id`,`user_id`),
  KEY `city_id` (`city_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_User_Address_City` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `FK_User_Address_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_address` */

insert  into `user_address`(`address_id`,`user_id`,`street`,`number`,`postal_code`,`city_id`,`floor`,`apartment`,`principal`) values (1,1,'Santa Juana de Arco','3767','1702',207,'0','1','1');

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

insert  into `user_data`(`user_id`,`name`,`last_name`,`birthday_date`,`description`) values (1,'Sebastian','Perez','1989-05-17 00:00:00','Soy el mejor!'),(2,NULL,NULL,NULL,NULL),(4,'Sergio',NULL,NULL,NULL);

/*Table structure for table `user_phone` */

DROP TABLE IF EXISTS `user_phone`;

CREATE TABLE `user_phone` (
  `user_id` mediumint(9) NOT NULL,
  `phone_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) DEFAULT NULL,
  `type_phone_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`phone_id`),
  UNIQUE KEY `phone_id_2` (`phone_id`),
  KEY `type_phone_id` (`type_phone_id`),
  KEY `user_id` (`user_id`),
  KEY `phone_id` (`phone_id`),
  CONSTRAINT `FK_User_Phone_Type_Phone` FOREIGN KEY (`type_phone_id`) REFERENCES `type_phone` (`type_phone_id`),
  CONSTRAINT `FK_User_Phone_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `user_phone` */

insert  into `user_phone`(`user_id`,`phone_id`,`number`,`type_phone_id`) values (1,1,'4455556666',3),(1,2,'0000000000',3);

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
  KEY `user_id` (`user_id`)
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
