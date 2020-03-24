-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 24 avr. 2019 à 13:43
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `2019_projet4_pizza`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `statut` enum('preparation','livraison','terminee','') NOT NULL DEFAULT 'preparation',
  PRIMARY KEY (`cid`),
  KEY `uid` (`uid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`cid`, `ref`, `uid`, `rid`, `date`, `statut`) VALUES
(1, 'AZ17YT', 2, 1, '2017-05-01 11:48:00', 'terminee'),
(3, 'YT65RQ', 4, 2, '2017-05-02 13:00:00', 'livraison'),
(4, 'YHGT5', 3, 3, '2017-05-16 14:28:00', 'livraison'),
(5, 'QW34BN', 5, 1, '2017-05-09 12:00:00', 'preparation'),
(6, '6G7FE', 2, 1, '2019-04-24 15:17:03', 'terminee');

-- --------------------------------------------------------

--
-- Structure de la table `extras`
--

DROP TABLE IF EXISTS `extras`;
CREATE TABLE IF NOT EXISTS `extras` (
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`cid`,`sid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `extras`
--

INSERT INTO `extras` (`cid`, `sid`) VALUES
(6, 1),
(5, 3),
(3, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

DROP TABLE IF EXISTS `recettes`;
CREATE TABLE IF NOT EXISTS `recettes` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prix` float UNSIGNED NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`rid`, `nom`, `prix`) VALUES
(1, 'Margherita	', 9),
(2, 'Regina', 10.5),
(3, 'Napoletana', 11.5),
(5, '4 Fromages', 10.5),
(6, 'Peperoni', 11.75),
(7, 'Vegetarienne', 11);

-- --------------------------------------------------------

--
-- Structure de la table `supplements`
--

DROP TABLE IF EXISTS `supplements`;
CREATE TABLE IF NOT EXISTS `supplements` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prix` float UNSIGNED NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `supplements`
--

INSERT INTO `supplements` (`sid`, `nom`, `prix`) VALUES
(1, 'Fromage', 0.5),
(2, 'Anchois', 0.75),
(3, 'Jambon', 1),
(4, 'Boisson', 2),
(5, 'Frites', 2.5),
(7, 'Mergez', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`uid`, `nom`, `prenom`, `login`, `mdp`, `role`) VALUES
(1, 'admin', 'user', 'admin', '$2y$10$WUXmfWOTO3gf.QIwxuHH0ecG51cmEsgW5YmHbQaAHcYL6wV11GgOm', 'admin'),
(2, 'Test', 'test_user', 'test', '$2y$10$rwE2jgPjPrw1i8DBi5xgY.aZuqV..6w9ZEFQmiYAy1G3slnJpKFVy', 'user'),
(3, 'Dupont', 'Jean', 'jean', '$2y$10$uCA3FR6xf6b1SvEXedZ3ju5/qae4wQvIaRN6LnrbVwml1bta.6Gbm', 'user'),
(4, 'Monin', 'Michel', 'michel', '$2y$10$BwrkqA3/Snps08LSYwttyOPUGp/8eaGDslq9Zv3aoDUEFqjtM7QmW', 'user'),
(5, NULL, NULL, 'anne', '$2y$10$Y7YSA5gcMB/It.Azzz.SBumneYSwOInCSUI9.JPdneltcNH3UC2JC', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `recettes` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `extras`
--
ALTER TABLE `extras`
  ADD CONSTRAINT `extras_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `supplements` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `extras_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `commandes` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
