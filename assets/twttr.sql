-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 mai 2018 à 21:00
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `twttr`
--

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `follow_id` int(10) NOT NULL AUTO_INCREMENT,
  `id_follower` int(10) NOT NULL,
  `id_followed` int(10) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message_id`, `username`, `message`, `creation`) VALUES
(1, 'kainister', 'Salut tout le monde', '2018-04-28 21:07:11'),
(10, 'zya', 'salut c\'est zya', '2018-04-30 14:20:06'),
(11, 'zya', 'salut c\'est zya', '2018-04-30 14:26:56'),
(12, 'zya', 'bonjour', '2018-05-02 14:22:27'),
(13, 'zya', 'salut ca va ', '2018-05-02 16:52:12'),
(14, 'zya', 'dee', '2018-05-03 10:18:27'),
(15, 'zya', 'salut ceci est un test\r\n', '2018-05-03 12:33:17'),
(16, 'zya', 'dee', '2018-05-03 12:33:19'),
(17, 'zya', 'dede', '2018-05-03 14:08:00'),
(18, 'zya', 'salut', '2018-05-03 14:41:53'),
(21, 'zya2', 'salut \r\n', '2018-05-09 14:23:13'),
(22, 'zya', 'de', '2018-05-14 12:47:00'),
(23, 'zya', '   ', '2018-05-14 13:12:55'),
(24, 'zya', 'xxx', '2018-05-14 13:12:58'),
(25, 'zya', 'fzeiumjh\n', '2018-05-14 13:17:52'),
(26, 'zya', 'cool\n', '2018-05-14 16:19:38'),
(35, 'zya', 'Salut', '2018-05-15 15:07:47'),
(36, 'zya', 'salututututut', '2018-05-16 15:05:35'),
(37, 'zya', 'je peux envoyer un tweet ?', '2018-05-16 15:22:57'),
(38, 'zya', 'salsalut\n\n\n', '2018-05-16 15:49:20'),
(39, 'zya', 'coucou lilian et wassim', '2018-05-16 15:53:07');

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

DROP TABLE IF EXISTS `tweet`;
CREATE TABLE IF NOT EXISTS `tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` set('rt','fav') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1, 'kevin', 'badinca', 'kainister', 'kevin.badinca@supinternet.fr', '$2y$10$ywRSYdWJ2ytlnd1NWZ1Rb.UhKBuM8P7OVX/RWeTMBpXJksHMBizUq'),
(2, 'kkkkkkkkkk', 'kkkkkkkkk', 'kkkkkkkk', 'kkk@kk.con', '$2y$10$J7v7V3k0E/YDm/5rVtuzT.TPwyP6VVCGkbPQbYt/dmRcoFCDKtWgO'),
(3, 'zya', 'zya', 'zya', 'zya@zya.fr', '$2y$10$3obifcsYDJ4LnL08Fc3XbeotcrkSLy/ggmt9SwGx2i2SJXf7PmfCO'),
(4, 'zya2', 'zya2', 'zya2', 'zya@zya.fr', '$2y$10$VYmUZbnnqaqEnQK5uW5XeesTmWkpgys0CsglDLRUas.NOuDCEvFsW'),
(5, '', '', '', '', '$2y$10$3g4uHCzzzPExROeBxYEnGu0Ig391egimSPEUNmFoRwYTzPpJ69bmS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
