-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.29-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных algorithms_and_data
CREATE DATABASE IF NOT EXISTS `algorithms_and_data` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `algorithms_and_data`;

-- Дамп структуры для таблица algorithms_and_data.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id_category` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы algorithms_and_data.categories: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id_category`, `category_name`) VALUES
	(1, 'Каталог'),
	(2, 'Одежда'),
	(3, 'Продукты'),
	(4, 'Верхняя одежда'),
	(5, 'Молочные продуткы');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Дамп структуры для таблица algorithms_and_data.category_links
CREATE TABLE IF NOT EXISTS `category_links` (
  `parent_id` int(11) unsigned NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы algorithms_and_data.category_links: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `category_links` DISABLE KEYS */;
INSERT INTO `category_links` (`parent_id`, `child_id`, `level`) VALUES
	(1, 1, 0),
	(1, 2, 1),
	(1, 3, 1),
	(1, 4, 2),
	(1, 5, 2),
	(2, 2, 1),
	(2, 4, 2),
	(3, 3, 1),
	(3, 5, 2);
/*!40000 ALTER TABLE `category_links` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
