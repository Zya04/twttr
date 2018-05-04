-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 04 mai 2018 à 15:27
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
  `id` int(10) NOT NULL,
  `id_follower` int(10) NOT NULL,
  `id_following` int(10) NOT NULL
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
(19, 'zya', 'salut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2018-05-04 12:20:45'),
(20, 'zya', ' salut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasalut ca vaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2018-05-04 12:20:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1, 'kevin', 'badinca', 'kainister', 'kevin.badinca@supinternet.fr', '$2y$10$ywRSYdWJ2ytlnd1NWZ1Rb.UhKBuM8P7OVX/RWeTMBpXJksHMBizUq'),
(2, 'kkkkkkkkkk', 'kkkkkkkkk', 'kkkkkkkk', 'kkk@kk.con', '$2y$10$J7v7V3k0E/YDm/5rVtuzT.TPwyP6VVCGkbPQbYt/dmRcoFCDKtWgO'),
(3, 'zya', 'zya', 'zya', 'zya@zya.fr', '$2y$10$3obifcsYDJ4LnL08Fc3XbeotcrkSLy/ggmt9SwGx2i2SJXf7PmfCO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
