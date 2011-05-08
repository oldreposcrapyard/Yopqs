--dump of tables and example data in polish for YOPQS 1.0
--hosted on github.com

DROP TABLE IF EXISTS `Answers`;
CREATE TABLE IF NOT EXISTS `Answers` (
  `ID_lvl` smallint(6) NOT NULL,
  `Answer` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `Answers` (`ID_lvl`, `Answer`) VALUES
(1, '6'),
(2, 'kałasznikow'),
(3, 'avatar'),
(4, 'gogol'),
(5, 'samochodzik'),
(6, '16'),
(7, 'ple'),
(8, 'sun zi'),
(9, 'e');

DROP TABLE IF EXISTS `Levels`;
CREATE TABLE IF NOT EXISTS `Levels` (
  `ID_lvl` smallint(6) NOT NULL,
  `Question` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `Levels` (`ID_lvl`, `Question`) VALUES
(1, 'Najpierw sprawdzimy czy nie jesteś idiotą. \nPytanie brzmi: 2+2*2 jest?'),
(2, 'Jak nazywa się konstruktor tego karabinu?\r\n [img]http://ttg.webuda.com/lvl2/aks.PNG[/img]'),
(3, 'Najbardziej dochodowy film w historii?\r\n'),
(4, 'Od jakiego słowa pochodzi nazwa "Google"?\r\n'),
(5, '0101001101100001011011010110111101100011011010000110111101100100011110100110100101101011\r\n'),
(6, 'Ile grodzi wodoszczelnych miał RMS Titanic?\r\n[img]http://ttg.webuda.com/lvl6/tytanik.PNG[/img]\r\n'),
(7, 'Jaką tablicę mają Tworzanice?(Chodzi o pierwsze trzy litery)\r\n[img]http://ttg.webuda.com/lvl7/tab.png[/img]\n'),
(8, 'Jak [b]naprawdę[/b] nazywa się autor [i]Sztuki Wojennej[/i]?\r\n\r\n[youtube]http://www.youtube.com/watch?v=wtaja8lkEdk[/youtube]\r\n'),
(9, 'Jaka litera jest na szczysie tzw."Tablicy Snellena"?\r\n\r\n[img]http://www.ttg.webuda.com/lvl10/snellen.PNG[/img]');
