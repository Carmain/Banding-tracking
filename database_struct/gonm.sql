-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 23 Avril 2015 à 14:34
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
  `year` int(11) DEFAULT NULL,
  `banding_year` int(11) DEFAULT NULL,
  `action` varchar(6) DEFAULT NULL,
  `metal_ring` varchar(12) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `color` varchar(12) DEFAULT NULL,
  `sex` varchar(4) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `banding_time` varchar(5) DEFAULT NULL,
  `town` varchar(27) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `locality` varchar(30) DEFAULT NULL,
  `bander` varchar(7) DEFAULT NULL,
  `observer` varchar(13) DEFAULT NULL,
  `first_name_observer` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id_kentish_plover`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=799 ;

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
  `town` varchar(250) NOT NULL,
  `department` int(11) NOT NULL,
  `locality` varchar(200) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_observations`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4318 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
