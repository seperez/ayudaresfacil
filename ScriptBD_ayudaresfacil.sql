-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2014 a las 13:09:24
-- Versión del servidor: 5.5.37-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ayudaresfacil`
--
CREATE DATABASE IF NOT EXISTS `ayudaresfacil` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `ayudaresfacil`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `action_id` decimal(2,0) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`action_id`),
  UNIQUE KEY `UQ_SocialNetwork_Action_description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `common_state`
--

CREATE TABLE IF NOT EXISTS `common_state` (
  `common_state_id` char(1) NOT NULL,
  `description` varchar(50) NOT NULL,
  `comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `common_state`
--

INSERT INTO `common_state` (`common_state_id`, `description`, `comments`) VALUES
('A', 'ACTIVO', NULL),
('B', 'BAJA', NULL),
('L', 'LEIDO', NULL),
('N', 'NUEVO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donated_object`
--

CREATE TABLE IF NOT EXISTS `donated_object` (
  `donation_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `quantity` decimal(3,0) NOT NULL,
  PRIMARY KEY (`donation_id`,`object_id`),
  KEY `donation_id` (`donation_id`),
  KEY `object_id` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donation`
--

CREATE TABLE IF NOT EXISTS `donation` (
  `donation_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `donation_date` datetime NOT NULL,
  `process_state_id` char(1) NOT NULL,
  PRIMARY KEY (`donation_id`),
  KEY `process_state_id` (`process_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE IF NOT EXISTS `message` (
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
  KEY `user_id_to` (`user_id_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`message_id`, `user_id_from`, `user_id_to`, `publication_id`, `first_message_id`, `FAQ`, `common_state_id`, `subject`, `text`, `create_date`, `update_date`, `delete_date`) VALUES
(1, 4, 4, 0, 0, 0, 'N', 'testing', 'Nuevo mensaje', '2014-05-04 03:52:11', '2014-05-04 04:05:49', '2014-05-04 04:08:01'),
(2, 4, 4, 0, 0, 0, 'N', NULL, 'Nuevo mensaje', '2014-05-04 03:52:34', NULL, NULL),
(3, 4, 4, 0, 0, 0, 'N', 'asunto prueba', 'Nuevo mensaje', '2014-05-04 03:55:29', '2014-05-04 04:01:59', NULL),
(4, 4, 4, 0, 0, 0, 'N', 'asunto prueba', 'Nuevo mensaje', '2014-05-04 03:58:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `object`
--

CREATE TABLE IF NOT EXISTS `object` (
  `object_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offer_type`
--

CREATE TABLE IF NOT EXISTS `offer_type` (
  `offer_type_id` tinyint(4) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`offer_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `offer_type`
--

INSERT INTO `offer_type` (`offer_type_id`, `description`, `comments`) VALUES
(1, 'AL PRIMER POSTOR', 'EL PRIMERO QUE SOLICITE LA PUBLICACION, SE HACE PROPIETARIO DE LA MISMA.'),
(2, 'ELECCION ENTRE CANDIDATOS', 'SE ESTABLECE UN NUMERO DE POSIBLES PROPIETARIOS. UNA VEZ ALCANZADOS, SE PAUSA LA PUBLICACION Y SE EVALUA ALGUNA (O NINGUNA) DE LAS OPCIONES.'),
(3, 'EVALUACION UNO A UNO', 'CADA VEZ QUE ALGUIEN SOLICITA LO OFRECIDO, SE PAUSA LA PUBLICACION Y SE EVALUA SI ES (O NO) INDICADO PARA RECIBIR EL OFRECIMIENTO.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `process_state`
--

CREATE TABLE IF NOT EXISTS `process_state` (
  `process_state_id` char(1) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`process_state_id`),
  UNIQUE KEY `UQ_Process_state_description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `process_state`
--

INSERT INTO `process_state` (`process_state_id`, `description`) VALUES
('C', 'CERRADO'),
('P', 'PAUSADO'),
('V', 'VIGENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `province_id` decimal(2,0) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication`
--

CREATE TABLE IF NOT EXISTS `publication` (
  `publication_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) NOT NULL,
  `publication_type_id` tinyint(4) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `title` varchar(50) NOT NULL,
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
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `publication`
--

INSERT INTO `publication` (`publication_id`, `user_id`, `publication_type_id`, `creation_date`, `title`, `description`, `expiration_date`, `category_id`, `subcategory_id`, `views`, `process_state_id`) VALUES
(0, 4, NULL, '0000-00-00 00:00:00', '', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_category`
--

CREATE TABLE IF NOT EXISTS `publication_category` (
  `category_id` tinyint(4) NOT NULL,
  `description` varchar(70) NOT NULL,
  `common_state_id` char(1) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `common_state_id` (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_favourite`
--

CREATE TABLE IF NOT EXISTS `publication_favourite` (
  `favourite_id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favourite_id`,`publication_id`,`user_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_object`
--

CREATE TABLE IF NOT EXISTS `publication_object` (
  `publication_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `quantity` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`publication_id`,`object_id`),
  KEY `object_id` (`object_id`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_offer`
--

CREATE TABLE IF NOT EXISTS `publication_offer` (
  `publication_id` int(11) NOT NULL,
  `process_state_offer` char(1) DEFAULT NULL,
  `offer_type_id` tinyint(4) DEFAULT NULL,
  `quantity_users_to_paused` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `offer_type_id` (`offer_type_id`),
  KEY `process_state_offer` (`process_state_offer`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_socialnetwork_activity`
--

CREATE TABLE IF NOT EXISTS `publication_socialnetwork_activity` (
  `publication_id` int(11) NOT NULL,
  `action_id` decimal(2,0) DEFAULT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_id` (`publication_id`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_sponsor`
--

CREATE TABLE IF NOT EXISTS `publication_sponsor` (
  `sponsor_id` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `common_state_id` char(1) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`,`publication_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `sponsor_id` (`sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_subcategory`
--

CREATE TABLE IF NOT EXISTS `publication_subcategory` (
  `category_id` tinyint(4) NOT NULL,
  `subcategory_id` tinyint(4) NOT NULL,
  `description` varchar(50) NOT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`category_id`,`subcategory_id`),
  KEY `category_id` (`category_id`),
  KEY `common_state_id` (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_type`
--

CREATE TABLE IF NOT EXISTS `publication_type` (
  `publication_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`publication_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `publication_type`
--

INSERT INTO `publication_type` (`publication_type_id`, `name`, `description`) VALUES
(1, 'Ofrecimiento', NULL),
(2, 'Pedido Monetario', NULL),
(3, 'Pedido de Objetos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `sponsor_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `social_network_id` int(11) DEFAULT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`),
  UNIQUE KEY `UQ_Sponsor_social_network_id` (`social_network_id`),
  KEY `common_state_id` (`common_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_phone`
--

CREATE TABLE IF NOT EXISTS `type_phone` (
  `type_phone_id` tinyint(4) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`type_phone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `type_phone`
--

INSERT INTO `type_phone` (`type_phone_id`, `description`) VALUES
(1, 'PARTICULAR'),
(2, 'CELULAR'),
(3, 'LABORAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `last_login` date DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UQ_User_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `last_login`, `enabled`, `deleted`) VALUES
(1, 'perezsebastianm@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', NULL, 1, 0),
(2, 'sabriancasado@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, 1, 0),
(4, 'sergio_areco@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
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
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_address`
--

INSERT INTO `user_address` (`address_id`, `user_id`, `street`, `number`, `postal_code`, `province_id`, `city_id`, `floor`, `department`, `principal`) VALUES
(1, 1, 'Santa Juana de Arco', 3767, '1702', NULL, NULL, '0', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `user_id` mediumint(9) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday_date` datetime DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_data`
--

INSERT INTO `user_data` (`user_id`, `name`, `last_name`, `birthday_date`, `description`) VALUES
(1, 'Sebastian', 'Perez', '1989-05-17 00:00:00', 'Soy el mejor!'),
(2, NULL, NULL, NULL, NULL),
(4, 'Sergio', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_phone`
--

CREATE TABLE IF NOT EXISTS `user_phone` (
  `user_id` mediumint(9) NOT NULL,
  `phone_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) DEFAULT NULL,
  `type_phone_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`phone_id`),
  UNIQUE KEY `phone_id_2` (`phone_id`),
  KEY `type_phone_id` (`type_phone_id`),
  KEY `user_id` (`user_id`),
  KEY `phone_id` (`phone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user_phone`
--

INSERT INTO `user_phone` (`user_id`, `phone_id`, `number`, `type_phone_id`) VALUES
(1, 1, '1135754594', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_request`
--

CREATE TABLE IF NOT EXISTS `user_request` (
  `publication_id` int(11) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `request_date` datetime DEFAULT NULL,
  `common_state_id` char(1) DEFAULT NULL,
  PRIMARY KEY (`publication_id`,`user_id`),
  KEY `common_state_id` (`common_state_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_score`
--

CREATE TABLE IF NOT EXISTS `user_score` (
  `user_id_from` mediumint(9) NOT NULL,
  `user_id_to` mediumint(9) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `score` decimal(1,0) DEFAULT NULL,
  `scoring_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id_from`,`user_id_to`,`publication_id`),
  KEY `publication_id` (`publication_id`),
  KEY `user_id_from` (`user_id_from`),
  KEY `user_id_to` (`user_id_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `donated_object`
--
ALTER TABLE `donated_object`
  ADD CONSTRAINT `FK_Donated_Object_Donation` FOREIGN KEY (`donation_id`) REFERENCES `donation` (`donation_id`),
  ADD CONSTRAINT `FK_Donated_Object_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`);

--
-- Filtros para la tabla `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `FK_Donation_Process_state` FOREIGN KEY (`process_state_id`) REFERENCES `process_state` (`process_state_id`),
  ADD CONSTRAINT `FK_Donation_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `FK_Donation_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_Message_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `FK_Message_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  ADD CONSTRAINT `FK_Message_User_From` FOREIGN KEY (`user_id_from`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_Message_User_To` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_Publication_Category` FOREIGN KEY (`category_id`) REFERENCES `publication_category` (`category_id`),
  ADD CONSTRAINT `FK_Publication_Process_state` FOREIGN KEY (`process_state_id`) REFERENCES `process_state` (`process_state_id`),
  ADD CONSTRAINT `FK_Publication_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `publication_category`
--
ALTER TABLE `publication_category`
  ADD CONSTRAINT `FK_Category_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`);

--
-- Filtros para la tabla `publication_favourite`
--
ALTER TABLE `publication_favourite`
  ADD CONSTRAINT `FK_Publication_Favourite_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `FK_Publication_Favourite_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `publication_object`
--
ALTER TABLE `publication_object`
  ADD CONSTRAINT `FK_Object` FOREIGN KEY (`object_id`) REFERENCES `object` (`object_id`),
  ADD CONSTRAINT `FK_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`);

--
-- Filtros para la tabla `publication_offer`
--
ALTER TABLE `publication_offer`
  ADD CONSTRAINT `FK_Offer_Offer_Type` FOREIGN KEY (`offer_type_id`) REFERENCES `offer_type` (`offer_type_id`),
  ADD CONSTRAINT `FK_Offer_Process_state` FOREIGN KEY (`process_state_offer`) REFERENCES `process_state` (`process_state_id`),
  ADD CONSTRAINT `FK_Offer_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`);

--
-- Filtros para la tabla `publication_socialnetwork_activity`
--
ALTER TABLE `publication_socialnetwork_activity`
  ADD CONSTRAINT `FK_Publication_SocialNetwork_Activity_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `FK_Publication_SocialNetwork_Activity_SocialNetwork_Action` FOREIGN KEY (`action_id`) REFERENCES `action` (`action_id`),
  ADD CONSTRAINT `FK_Publication_SocialNetwork_Activity_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `publication_sponsor`
--
ALTER TABLE `publication_sponsor`
  ADD CONSTRAINT `FK_Publication_Sponsor_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  ADD CONSTRAINT `FK_Publication_Sponsor_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `FK_Publication_Sponsor_Sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`sponsor_id`);

--
-- Filtros para la tabla `publication_subcategory`
--
ALTER TABLE `publication_subcategory`
  ADD CONSTRAINT `FK_Subcategory_Category` FOREIGN KEY (`category_id`) REFERENCES `publication_category` (`category_id`),
  ADD CONSTRAINT `FK_Subcategory_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`);

--
-- Filtros para la tabla `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `FK_Sponsor_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`);

--
-- Filtros para la tabla `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `FK_User_Address_City` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `FK_User_Address_Province` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`),
  ADD CONSTRAINT `FK_User_Address_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `FK_User_Data_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `user_phone`
--
ALTER TABLE `user_phone`
  ADD CONSTRAINT `FK_User_Phone_Type_Phone` FOREIGN KEY (`type_phone_id`) REFERENCES `type_phone` (`type_phone_id`),
  ADD CONSTRAINT `FK_User_Phone_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `user_request`
--
ALTER TABLE `user_request`
  ADD CONSTRAINT `FK_User_Request_Common_State` FOREIGN KEY (`common_state_id`) REFERENCES `common_state` (`common_state_id`),
  ADD CONSTRAINT `FK_User_Request_Offer` FOREIGN KEY (`publication_id`) REFERENCES `offer` (`publication_id`),
  ADD CONSTRAINT `FK_User_Request_User` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `user_score`
--
ALTER TABLE `user_score`
  ADD CONSTRAINT `FK_User_Score_Publication` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`publication_id`),
  ADD CONSTRAINT `FK_User_Score_User_From` FOREIGN KEY (`user_id_from`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_User_Score_User_To` FOREIGN KEY (`user_id_to`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
