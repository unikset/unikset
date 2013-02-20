-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Фев 19 2013 г., 11:17
-- Версия сервера: 5.1.67-0ubuntu0.10.04.1
-- Версия PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `unikset`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `city`, `country_id`, `region_id`, `lang`) VALUES
(4, 'München', 56, 4, 'en'),
(5, 'Erlangen', 56, 4, 'en'),
(6, 'Jena', 56, 5, 'en'),
(7, 'Hamburg', 56, 6, 'en'),
(8, 'Berlin', 56, 7, 'en'),
(9, 'Dresden', 56, 8, 'en'),
(10, 'Frankfurt am Main', 56, 9, 'en'),
(11, 'Halle', 56, 10, 'en'),
(12, 'Cambridge', 57, 18, 'en'),
(13, 'Moscow', 58, 19, 'en'),
(14, 'Kyiv', 59, 20, 'en');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(1000) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `lang` char(2) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`, `lang`) VALUES
(56, 'Germany', 'en'),
(57, 'USA', 'en'),
(58, 'Russia', 'en'),
(59, 'Ukraine', 'en');

-- --------------------------------------------------------

--
-- Структура таблицы `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `lang` char(2) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `discipline`
--

INSERT INTO `discipline` (`id`, `title`, `lang`) VALUES
(5, 'mathematics', 'en'),
(6, 'physics', 'en'),
(7, 'informatics', 'en'),
(8, 'economics', 'en'),
(9, 'biology', 'en');

-- --------------------------------------------------------

--
-- Структура таблицы `discipline_documents`
--

CREATE TABLE IF NOT EXISTS `discipline_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipline_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discipline_id` (`discipline_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `author_name` varchar(255) NOT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_ip` varchar(255) NOT NULL,
  `is_university_document` tinyint(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Структура таблицы `document_comments`
--

CREATE TABLE IF NOT EXISTS `document_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `document_comments`
--
DROP TRIGGER IF EXISTS `TrDeleteComment`;
DELIMITER //
CREATE TRIGGER `TrDeleteComment` BEFORE DELETE ON `document_comments`
 FOR EACH ROW delete from comments where comments.id = OLD.comment_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `document_lecturers`
--

CREATE TABLE IF NOT EXISTS `document_lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `document_id` (`document_id`),
  KEY `lecturer_id` (`lecturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Структура таблицы `document_raitings`
--

CREATE TABLE IF NOT EXISTS `document_raitings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raiting_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `raiting_id` (`raiting_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `document_raitings`
--
DROP TRIGGER IF EXISTS `TrDeleteRaitingOfDoc`;
DELIMITER //
CREATE TRIGGER `TrDeleteRaitingOfDoc` AFTER DELETE ON `document_raitings`
 FOR EACH ROW delete from raitings where raitings.id = OLD.raiting_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `document_tags`
--

CREATE TABLE IF NOT EXISTS `document_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10486 ;

-- --------------------------------------------------------

--
-- Структура таблицы `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(4) NOT NULL DEFAULT '2',
  `lang` char(2) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Структура таблицы `raitings`
--

CREATE TABLE IF NOT EXISTS `raitings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raiting_value` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `region`, `country_id`, `lang`) VALUES
(4, 'Bayern', 56, 'en'),
(5, 'Thüringen', 56, 'en'),
(6, 'Hamburg', 56, 'en'),
(7, 'Berlin', 56, 'en'),
(8, 'Sachsen', 56, 'en'),
(9, 'Hessen', 56, 'en'),
(10, 'Sachsen-Anhalt', 56, 'en'),
(18, 'Massachusetts', 57, 'en'),
(19, 'Moscow', 58, 'en'),
(20, 'Kyiv', 59, 'en');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`) VALUES
(1, 'user', 'Authenicated user'),
(2, 'moderator', 'User moderator'),
(3, 'admin', 'Is SuperAdministrator has a unlimited authority');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2869 ;

-- --------------------------------------------------------

--
-- Структура таблицы `universities`
--

CREATE TABLE IF NOT EXISTS `universities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title_short` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Дамп данных таблицы `universities`
--

INSERT INTO `universities` (`id`, `title`, `title_short`, `description`, `location_id`) VALUES
(93, 'Friedrich-Alexander-Universität Erlangen-Nürnberg', 'FAU', '', 5),
(94, 'Ludwig-Maximilians-Universität München', 'LMU', '', 4),
(97, 'Friedrich-Schiller-Universität Jena', 'Uni Jena', '', 6),
(98, 'Universität Hamburg', 'Uni Hamburg', '', 7),
(99, 'Humboldt-Universität zu Berlin', 'HU Berlin', '', 8),
(100, 'Technische Universität Dresden', 'TUD', '', 9),
(101, 'Goethe-Universität Frankfurt am Main', 'Goethe-Uni Frankfurt', '', 10),
(102, 'Martin-Luther-Universität Halle-Wittenberg', 'MLU Halle-Wittenberg', '', 11),
(103, 'Massachusetts Institute of Technology', 'MIT', '', 12),
(104, 'Lomonosov Moscow State University', 'MSU', '', 13),
(105, 'Kyiv Polytechnic Institute', 'KPI', '', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `university_comments`
--

CREATE TABLE IF NOT EXISTS `university_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`),
  KEY `university_id` (`university_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `university_comments`
--
DROP TRIGGER IF EXISTS `TrDeleteCommentOfUniversity`;
DELIMITER //
CREATE TRIGGER `TrDeleteCommentOfUniversity` AFTER DELETE ON `university_comments`
 FOR EACH ROW delete from comments where comments.id = OLD.comment_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `university_documents`
--

CREATE TABLE IF NOT EXISTS `university_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `document_id` (`document_id`),
  KEY `university_id` (`university_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Структура таблицы `university_raitings`
--

CREATE TABLE IF NOT EXISTS `university_raitings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raiting_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `raiting_id` (`raiting_id`),
  KEY `university_id` (`university_id`),
  KEY `raiting_id_2` (`raiting_id`),
  KEY `university_id_2` (`university_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `university_raitings`
--
DROP TRIGGER IF EXISTS `TrDeleteRaitingOfUniversity`;
DELIMITER //
CREATE TRIGGER `TrDeleteRaitingOfUniversity` AFTER DELETE ON `university_raitings`
 FOR EACH ROW delete from raitings where raitings.id = OLD.raiting_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `activkey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `id_role` int(4) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_role` (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `activkey`, `email`, `id_role`, `token`) VALUES
(1, 'admin', '1f6aa354cb81fcd5020d73c0917c7d69', '509c1bcddbcc92.55853703', 'd41d8cd98f00b204e9800998ecf8427e', 'admin@admin.com', 3, '509d34ed9db273.58757732'),
(3, 'user', 'b57a5ab366da55390ef5485369dbb525', '509c2eb2d29316.89536932', '509cf72e547fd3.26088769', 'asdasdasdasda@mail.ru', 2, ''),
(4, 'demo', 'fcc9c2ec719e9f66689d2ef58f307649', '509cf7c4eb8ad6.91653647', '509cf7c4eb8e13.07396668', 'demo@unikset.de', 1, '509d56d99db7d7.13581774');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cities_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `discipline_documents`
--
ALTER TABLE `discipline_documents`
  ADD CONSTRAINT `discipline_documents_ibfk_1` FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discipline_documents_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `document_comments`
--
ALTER TABLE `document_comments`
  ADD CONSTRAINT `document_comments_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_comments_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `document_lecturers`
--
ALTER TABLE `document_lecturers`
  ADD CONSTRAINT `document_lecturers_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_lecturers_ibfk_2` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `document_raitings`
--
ALTER TABLE `document_raitings`
  ADD CONSTRAINT `document_raitings_ibfk_1` FOREIGN KEY (`raiting_id`) REFERENCES `raitings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_raitings_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `document_tags`
--
ALTER TABLE `document_tags`
  ADD CONSTRAINT `document_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_tags_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `universities`
--
ALTER TABLE `universities`
  ADD CONSTRAINT `universities_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `university_comments`
--
ALTER TABLE `university_comments`
  ADD CONSTRAINT `university_comments_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `university_comments_ibfk_2` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `university_documents`
--
ALTER TABLE `university_documents`
  ADD CONSTRAINT `university_documents_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `university_documents_ibfk_2` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `university_raitings`
--
ALTER TABLE `university_raitings`
  ADD CONSTRAINT `university_raitings_ibfk_1` FOREIGN KEY (`raiting_id`) REFERENCES `raitings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `university_raitings_ibfk_2` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
