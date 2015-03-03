-- phpMyAdmin SQL Dump 
-- version 4.1.14 
-- http://www.phpmyadmin.net 
-- 
-- Client :  127.0.0.1 
-- Généré le :  Mar 03 Mars 2015 à 13:55 
-- Version du serveur :  5.6.17 
-- Version de PHP :  5.5.12 
SET sql_mode = "NO_AUTO_VALUE_ON_ZERO"; 

SET time_zone = "+00:00"; 

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */; 
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */; 
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */; 
/*!40101 SET NAMES utf8 */; 
-- 
-- Base de données :  `gonm` 
-- 
-- -------------------------------------------------------- 
-- 
-- Structure de la table `kentish_plover` 
-- 
CREATE TABLE IF NOT EXISTS `kentish_plover` 
  ( 
     `id_kentish_plover` INT(11) NOT NULL auto_increment, 
     `year`              YEAR(4) NOT NULL, 
     `banding_year`      YEAR(4) NOT NULL, 
     `action`            VARCHAR(10) NOT NULL, 
     `metal_ring`        VARCHAR(20) NOT NULL, 
     `number`            INT(11) NOT NULL, 
     `color`             VARCHAR(20) DEFAULT NULL, 
     `sex`               VARCHAR(1) NOT NULL, 
     `age`               VARCHAR(3) NOT NULL, 
     `date`              VARCHAR(10) NOT NULL, 
     `banding_time`      VARCHAR(5) DEFAULT NULL, 
     `town`              VARCHAR(27) NOT NULL, 
     `department`        VARCHAR(2) NOT NULL, 
     `locality`          VARCHAR(100) DEFAULT NULL, 
     `bander`            VARCHAR(5) NOT NULL, 
     `observer`          VARCHAR(30) DEFAULT NULL, 
     PRIMARY KEY (`id_kentish_plover`) 
  ) 
engine=innodb 
DEFAULT charset=utf8 
auto_increment=797; 

-- -------------------------------------------------------- 
-- 
-- Structure de la table `observations` 
-- 
CREATE TABLE IF NOT EXISTS `observations` 
  ( 
     `id_observations` INT(11) NOT NULL auto_increment, 
     `fk_plover`       INT(11) NOT NULL, 
     `last_name`       VARCHAR(200) NOT NULL, 
     `first_name`      VARCHAR(200) NOT NULL, 
     `date`            DATE NOT NULL, 
     `town`            INT(11) NOT NULL, 
     `department`      INT(11) NOT NULL, 
     `locality`        VARCHAR(200) NOT NULL, 
     `sex`             TINYINT(1) DEFAULT NULL, 
     PRIMARY KEY (`id_observations`) 
  ) 
engine=innodb 
DEFAULT charset=utf8 
auto_increment=1; 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */; 
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */; 
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */; 