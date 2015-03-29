-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Mars 2015 à 17:56
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `date` varchar(10) NOT NULL,
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
  `town` varchar(250) NOT NULL,
  `department` varchar(250) NOT NULL,
  `locality` varchar(200) NOT NULL,
  `sex` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_observations`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

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
