-- Adminer 4.8.1 MySQL 10.9.2-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `cross`;
CREATE DATABASE `cross` /*!40100 DEFAULT CHARACTER SET utf8mb3 */;
USE `cross`;

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text DEFAULT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

INSERT INTO `images` (`id`, `text`, `img`) VALUES
(19,	NULL,	'https://content-images.carmax.com/qeontfmijmzv/MY19MKj0XutK084z874jt/9632621fd8464b5c0e54a9dee64ad4e5/tesla.jpg'),
(20,	NULL,	'https://www.chevrolet.com/content/dam/chevrolet/na/us/english/portable-nav/small-vehicle-jellies/2022-corvette-3lt-gkz-colorizer.jpg?imwidth=960'),
(21,	NULL,	'https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=1200'),
(22,	NULL,	'https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=1200'),
(23,	NULL,	'https://www.chevrolet.com/content/dam/chevrolet/na/us/english/portable-nav/small-vehicle-jellies/2022-corvette-3lt-gkz-colorizer.jpg?imwidth=960'),
(24,	'Hyundai i30N',	'https://www.hyundai.sk/application/web/gfx/responsive-design/models/main-banner/main_car_i20n_2021_mobile_supersmall.jpg');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(30) DEFAULT NULL,
  `nadpis` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `clanok` text NOT NULL,
  `obrazok` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

INSERT INTO `posts` (`id`, `autor`, `nadpis`, `datum`, `clanok`, `obrazok`) VALUES
(9,	'ľš',	'ľšľ',	'2022-11-21',	'šľšľ',	''),
(10,	'ľš',	'ľšľ',	'2022-11-21',	'šľšľľšľ',	'https://www.google.sk'),
(11,	'Martin',	'Predám Lenovo IdeaPad Y700-15ISK',	'2022-11-21',	'Vyhral',	''),
(12,	'',	'Hronec',	'2022-11-21',	'Vyhral',	'https://cdn2.jysk.com/getimage/wd2.medium/85172');

-- 2022-11-21 12:36:31
