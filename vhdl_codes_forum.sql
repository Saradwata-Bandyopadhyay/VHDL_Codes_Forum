-- Adminer 4.16.0 MySQL 8.4.3 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `tags` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `question` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `answer` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `codelink` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `softwarelink` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ts` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `codeid` int NOT NULL,
  `commentid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `username` varchar(100) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `comment` varchar(500) NOT NULL,
  `ts` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentid`),
  KEY `codeid` (`codeid`),
  KEY `userid` (`userid`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`codeid`) REFERENCES `codes` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `emailid` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `ts` timestamp NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;


-- 2025-02-25 07:49:23