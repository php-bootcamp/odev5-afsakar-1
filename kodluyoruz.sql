-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 25 Şub 2021, 19:04:45
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kodluyoruz`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
('603539b085b7a', 'Category 1'),
('603539b085b7b', 'Category 2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `category` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `content`, `category`) VALUES
('4b3403665fea6', 'Product-1', 98.55, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet nisl porttitor nunc efficitur egestas ac sed elit. Vestibulum velit diam, viverra a vestibulum sit amet, euismod eu dui.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '{\"uniqid\":\"603539b085b7a\",\"name\":\"Category 1\"}'),
('603539c7c4758', 'Product-2', 99.55, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet nisl porttitor nunc efficitur egestas ac sed elit. Vestibulum velit diam, viverra a vestibulum sit amet, euismod eu dui.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '{\"uniqid\":\"603539b085b7b\",\"name\":\"Category 2\"}'),
('603539ffb7ff5', 'Product-3', 100.55, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet nisl porttitor nunc efficitur egestas ac sed elit. Vestibulum velit diam, viverra a vestibulum sit amet, euismod eu dui.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '{\"uniqid\":\"603539b085b7a\",\"name\":\"Category 1\"}'),
('603539ffb3fg6', 'Product-4', 124.55, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet nisl porttitor nunc efficitur egestas ac sed elit. Vestibulum velit diam, viverra a vestibulum sit amet, euismod eu dui.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '{\"uniqid\":\"603539b085b7a\",\"name\":\"Category 1\"}');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `isActive`) VALUES
(12, 'superadmin@example.com', 'superadmin', '$2y$10$58TzdLkn6yOKKlo6wh6LWuzSBRNlbtze9BzqH6pzY6uH8Lj/oHKLW', 1),
(11, 'admin@example.com', 'admin', '$2y$10$Z.emfq.qYtrkPr3aj8Pqk.D.Ea1.evRvk29JWZiMLtYu8Z2vqczeC', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
