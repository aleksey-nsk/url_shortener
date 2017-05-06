-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Хост: sql210.byethost24.com
-- Время создания: Май 06 2017 г., 15:19
-- Версия сервера: 5.6.35-81.0
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `b24_20062583_shortener`
--

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `short_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `url`, `code`, `short_url`) VALUES
(37, 'http://news.ngs.ru/more/50387801/', '37iCSO', 'http://short.byethost24.com/37iCSO'),
(33, 'http://htmlbook.ru/html/input/formaction', '33kHUO', 'http://short.byethost24.com/33kHUO'),
(34, 'http://htmlbook.ru/html/type/deprecated', '34MT0i', 'http://short.byethost24.com/34MT0i'),
(35, 'http://php.net/manual/en/install.windows.recommended.php', '35Zpcq', 'http://short.byethost24.com/35Zpcq'),
(36, 'http://www.karamzina53.ru/page-vibor-kvartiri-1k.html', '36ToyH', 'http://short.byethost24.com/36ToyH');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
