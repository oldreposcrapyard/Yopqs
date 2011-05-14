DROP TABLE IF EXISTS `Answers`;
CREATE TABLE IF NOT EXISTS `Answers` (
  `ID_lvl` smallint(6) NOT NULL,
  `Answer` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `Levels`;
CREATE TABLE IF NOT EXISTS `Levels` (
  `ID_lvl` smallint(6) NOT NULL,
  `Question` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
