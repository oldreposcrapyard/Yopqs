-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2011 at 04:28 PM
-- Server version: 5.0.91
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `YOPQS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answers`
--

DROP TABLE IF EXISTS `Answers`;
CREATE TABLE IF NOT EXISTS `Answers` (
  `ID` smallint(6) NOT NULL auto_increment,
  `ID_lvl` smallint(6) NOT NULL,
  `Answer` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `Answers`
--

INSERT INTO `Answers` VALUES(1, 1, '6');
INSERT INTO `Answers` VALUES(2, 2, 'kałasznikow');
INSERT INTO `Answers` VALUES(3, 2, 'Kałasznikow');
INSERT INTO `Answers` VALUES(4, 3, 'Avatar');
INSERT INTO `Answers` VALUES(5, 3, 'avatar');
INSERT INTO `Answers` VALUES(6, 4, 'gogol');
INSERT INTO `Answers` VALUES(7, 4, 'Gogol');
INSERT INTO `Answers` VALUES(8, 5, 'Samochodzik');
INSERT INTO `Answers` VALUES(9, 6, '16');
INSERT INTO `Answers` VALUES(10, 7, 'PLE');
INSERT INTO `Answers` VALUES(11, 7, 'ple');
INSERT INTO `Answers` VALUES(12, 8, 'Sun Zi');
INSERT INTO `Answers` VALUES(13, 8, 'sun zi');
INSERT INTO `Answers` VALUES(14, 8, 'Sun zi');

-- --------------------------------------------------------

--
-- Table structure for table `Levels`
--

DROP TABLE IF EXISTS `Levels`;
CREATE TABLE IF NOT EXISTS `Levels` (
  `ID` smallint(6) NOT NULL auto_increment,
  `ID_lvl` smallint(6) NOT NULL,
  `Question` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `Levels`
--

INSERT INTO `Levels` VALUES(1, 1, 'Najpierw sprawdzimy czy nie jesteś idiotą. 
Pytanie brzmi: 2+2*2 jest?');
INSERT INTO `Levels` VALUES(2, 2, 'Jak nazywa się konstruktor tego karabinu?\r\n [img]http://ttg.webuda.com/lvl2/aks.PNG[/img]');
INSERT INTO `Levels` VALUES(3, 3, 'Najbardziej dochodowy film w historii?\r\n');
INSERT INTO `Levels` VALUES(4, 4, 'Od jakiego słowa pochodzi nazwa "Google"?\r\n');
INSERT INTO `Levels` VALUES(5, 5, '0101001101100001011011010110111101100011011010000110111101100100011110100110100101101011\r\n');
INSERT INTO `Levels` VALUES(6, 6, 'Ile grodzi wodoszczelnych miał RMS Titanic?[img]http://ttg.webuda.com/lvl6/tytanik.PNG[/img]\r\n');
INSERT INTO `Levels` VALUES(7, 7, 'Jaką tablicę mają Tworzanice?(Chodzi o pierwsze trzy litery)[img]http://ttg.webuda.com/lvl7/tab.png[/img]\r\n');
INSERT INTO `Levels` VALUES(8, 8, 'Jak [b]naprawdę[/b] nazywa się autor [i]Sztuki Wojennej[/i]?
[youtube]iB5IYI1o6AU[/youtube]\r\n');

