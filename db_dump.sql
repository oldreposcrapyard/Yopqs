-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: 10.194.111.8
-- Generation Time: Apr 10, 2011 at 08:57 PM
-- Server version: 5.1.50
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_45b9cf5d`
--
DROP DATABASE `db_45b9cf5d`;
CREATE DATABASE `db_45b9cf5d` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_45b9cf5d`;

-- --------------------------------------------------------

--
-- Table structure for table `Answers`
--

CREATE TABLE IF NOT EXISTS `Answers` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `ID_lvl` smallint(6) NOT NULL,
  `Answer` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `Answers`
--

INSERT INTO `Answers` (`ID`, `ID_lvl`, `Answer`) VALUES
(1, 1, '6'),
(2, 2, 'kałasznikow'),
(3, 2, 'Kałasznikow'),
(4, 3, 'Avatar'),
(5, 3, 'avatar'),
(6, 4, 'gogol'),
(7, 4, 'Gogol'),
(8, 5, 'Samochodzik'),
(9, 6, '16'),
(10, 7, 'PLE'),
(11, 7, 'ple'),
(12, 8, 'Sun Zi'),
(13, 8, 'sun zi'),
(14, 8, 'Sun zi');

-- --------------------------------------------------------

--
-- Table structure for table `Levels`
--

CREATE TABLE IF NOT EXISTS `Levels` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `ID_lvl` smallint(6) NOT NULL,
  `Question` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `Levels`
--

INSERT INTO `Levels` (`ID`, `ID_lvl`, `Question`) VALUES
(1, 1, 'Najpierw sprawdzimy czy nie jesteś idiotą. \nPytanie brzmi: 2+2*2 jest?'),
(2, 2, 'Jak nazywa się konstruktor tego karabinu?\r\n [img]http://ttg.webuda.com/lvl2/aks.PNG[/img]'),
(3, 3, 'Najbardziej dochodowy film w historii?\r\n'),
(4, 4, 'Od jakiego słowa pochodzi nazwa "Google"?\r\n'),
(5, 5, '0101001101100001011011010110111101100011011010000110111101100100011110100110100101101011\r\n'),
(6, 6, 'Ile grodzi wodoszczelnych miał RMS Titanic?\r\n[img]http://ttg.webuda.com/lvl6/tytanik.PNG[/img]\r\n'),
(7, 7, 'Jaką tablicę mają Tworzanice?(Chodzi o pierwsze trzy litery)\r\n[img]http://ttg.webuda.com/lvl7/tab.png[/img]\n'),
(8, 8, 'Jak [b]naprawdę[/b] nazywa się autor [i]Sztuki Wojennej[/i]?\r\n\r\n[youtube]http://www.youtube.com/watch?v=wtaja8lkEdk[/youtube]\r\n');

