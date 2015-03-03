-- phpMyAdmin SQL Dump 
-- version 4.1.14 
-- http://www.phpmyadmin.net 
-- 
-- Client :  127.0.0.1 
-- Généré le :  Mar 03 Mars 2015 à 10:41 
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
     `id`           INT(11) NOT NULL auto_increment, 
     `year`         YEAR(4) DEFAULT NULL, 
     `banding_year` YEAR(4) DEFAULT NULL, 
     `action`       VARCHAR(10) DEFAULT NULL, 
     `metal_ring`   VARCHAR(10) DEFAULT NULL, 
     `number`       VARCHAR(3) DEFAULT NULL, 
     `color`        VARCHAR(20) DEFAULT NULL, 
     `sex`          VARCHAR(2) DEFAULT NULL, 
     `age`          VARCHAR(3) DEFAULT NULL, 
     `date`         VARCHAR(10) DEFAULT NULL, 
     `banding_time` VARCHAR(5) DEFAULT NULL, 
     `town`         VARCHAR(27) DEFAULT NULL, 
     `department`   VARCHAR(2) DEFAULT NULL, 
     `locality`     VARCHAR(100) DEFAULT NULL, 
     `bander`       VARCHAR(5) DEFAULT NULL, 
     `observer`     VARCHAR(30) DEFAULT NULL, 
     PRIMARY KEY (`id`) 
  ) 
engine=innodb 
DEFAULT charset=utf8 
auto_increment=797; 