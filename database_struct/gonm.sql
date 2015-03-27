-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 27 Mars 2015 à 03:34
-- Version du serveur: 5.5.41
-- Version de PHP: 5.4.36-0+deb7u3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gonm`
--

-- --------------------------------------------------------

--
-- Structure de la table `kentish_plover`
--

CREATE TABLE IF NOT EXISTS `kentish_plover` (
  `id_kentish_plover` int(11) NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `banding_year` year(4) NOT NULL,
  `action` varchar(10) NOT NULL,
  `metal_ring` varchar(20) NOT NULL,
  `number` int(11) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `sex` varchar(1) NOT NULL,
  `age` varchar(3) NOT NULL,
  `Date` varchar(10) NOT NULL,
  `banding_time` varchar(5) DEFAULT NULL,
  `town` varchar(27) NOT NULL,
  `department` varchar(2) NOT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `bander` varchar(5) NOT NULL,
  `observer` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_kentish_plover`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=797 ;

-- --------------------------------------------------------

--
-- Structure de la table `observations`
--

CREATE TABLE IF NOT EXISTS `observations` (
  `id_observations` int(11) NOT NULL AUTO_INCREMENT,
  `fk_plover` int(11) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `town` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `locality` varchar(200) NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_observations`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
