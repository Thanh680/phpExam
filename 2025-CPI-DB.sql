-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 jan. 2025 à 15:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `2024-slam-php`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id_ticket` varchar(3) NOT NULL,
  `id_prestation` int NOT NULL,
  `nombre` int NOT NULL,
  PRIMARY KEY (`id_ticket`,`id_prestation`),
  KEY `id_prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`id_ticket`, `id_prestation`, `nombre`) VALUES
('T01', 1, 1),
('T01', 7, 2),
('T02', 1, 1),
('T02', 4, 2),
('T02', 9, 3),
('T03', 6, 1),
('T03', 8, 1),
('T04', 1, 1),
('T04', 4, 2),
('T04', 7, 1),
('T05', 6, 3),
('T06', 3, 1),
('T07', 2, 3),
('T08', 1, 2),
('T08', 7, 3),
('T09', 1, 1),
('T09', 5, 2),
('T09', 8, 3),
('T10', 1, 1),
('T10', 9, 4),
('T11', 3, 1),
('T11', 7, 2),
('T12', 1, 2),
('T12', 4, 3),
('T13', 9, 4),
('T14', 6, 4),
('T15', 2, 1),
('T15', 7, 3),
('T15', 8, 2),
('T16', 2, 1),
('T16', 9, 2),
('T17', 6, 2),
('T18', 6, 1),
('T19', 1, 2),
('T19', 9, 4),
('T20', 6, 2),
('T21', 1, 3),
('T21', 8, 3),
('T22', 2, 1),
('T22', 7, 1),
('T23', 6, 2),
('T24', 1, 3),
('T25', 3, 2),
('T25', 9, 2),
('T26', 6, 1),
('T27', 2, 1),
('T27', 7, 2),
('T28', 6, 4),
('T29', 3, 3),
('T29', 9, 3),
('T30', 1, 1),
('T30', 7, 1),
('T30', 9, 1),
('T31', 6, 1),
('T32', 2, 1),
('T33', 3, 2),
('T34', 6, 1),
('T34', 7, 1),
('T35', 3, 1),
('T35', 7, 2),
('T36', 6, 1),
('T37', 3, 1),
('T37', 8, 2),
('T38', 2, 1),
('T38', 7, 1),
('T39', 1, 1),
('T39', 5, 2),
('T40', 1, 3),
('T40', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `libelle_categorie` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `libelle_categorie`) VALUES
(1, 'Petits revenus'),
(2, 'Revenus moyens'),
(3, 'Gros revenus'),
(4, 'Visiteurs');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id_carte` varchar(3) NOT NULL,
  `date_depot` date NOT NULL,
  `montant` int NOT NULL,
  PRIMARY KEY (`id_carte`,`date_depot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`id_carte`, `date_depot`, `montant`) VALUES
('C1', '2022-09-01', 5),
('C1', '2022-10-13', 30),
('C10', '2022-08-18', 5),
('C10', '2022-09-01', 25),
('C10', '2022-09-14', 30),
('C10', '2022-10-14', 25),
('C12', '2022-09-14', 80),
('C12', '2022-09-16', 30),
('C13', '2022-09-23', 40),
('C13', '2022-10-01', 20),
('C14', '2022-08-17', 20),
('C14', '2022-09-14', 30),
('C15', '2022-08-18', 30),
('C15', '2022-09-23', 30),
('C15', '2022-12-01', 45),
('C2', '2022-09-05', 20),
('C2', '2022-09-07', 30),
('C2', '2022-11-03', 15),
('C3', '2022-09-10', 40),
('C4', '2022-09-12', 20),
('C4', '2022-10-03', 30),
('C6', '2022-09-23', 60),
('C7', '2022-09-14', 5),
('C7', '2022-10-05', 20),
('C7', '2022-11-14', 30),
('C8', '2022-09-22', 20),
('C8', '2022-09-30', 30),
('C9', '2022-08-20', 5),
('C9', '2022-09-02', 20);

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id_droits` int NOT NULL AUTO_INCREMENT,
  `libelle_droits` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_droits`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id_droits`, `libelle_droits`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
CREATE TABLE IF NOT EXISTS `prestation` (
  `id_prestation` int NOT NULL AUTO_INCREMENT,
  `type_prestation` varchar(50) NOT NULL,
  PRIMARY KEY (`id_prestation`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id_prestation`, `type_prestation`) VALUES
(1, 'Plat principal'),
(2, 'Plat + Dessert'),
(3, 'Entrée + Plat'),
(4, 'Supplément Entrée'),
(5, 'Supplément dessert'),
(6, 'Repas complet'),
(7, 'Alcool'),
(8, 'Apéritif'),
(9, 'Soda');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_prestation` int NOT NULL,
  `id_categorie` int NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_prestation`,`id_categorie`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_prestation`, `id_categorie`, `prix`) VALUES
(1, 1, 2.5),
(1, 2, 2.7),
(1, 3, 3.1),
(1, 4, 5),
(2, 1, 3.1),
(2, 2, 3.8),
(2, 3, 4.5),
(2, 4, 7),
(3, 1, 2.9),
(3, 2, 3.1),
(3, 3, 3.7),
(3, 4, 6.5),
(4, 1, 0.2),
(4, 2, 0.4),
(4, 3, 0.9),
(4, 4, 1.2),
(5, 1, 0.15),
(5, 2, 0.3),
(5, 3, 0.7),
(5, 4, 1.1),
(6, 1, 3.8),
(6, 2, 4),
(6, 3, 4.3),
(6, 4, 9),
(7, 1, 1.2),
(7, 2, 1.3),
(7, 3, 1.5),
(7, 4, 2),
(8, 1, 1.3),
(8, 2, 1.4),
(8, 3, 1.6),
(8, 4, 2.1),
(9, 1, 0.8),
(9, 2, 0.9),
(9, 3, 1),
(9, 4, 1.3);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` varchar(3) NOT NULL,
  `id_carte` varchar(3) NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `id_carte` (`id_carte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_carte`, `date_achat`) VALUES
('T01', 'C1', '2022-10-03'),
('T02', 'C1', '2022-10-05'),
('T03', 'C1', '2022-10-10'),
('T04', 'C1', '2022-10-11'),
('T05', 'C1', '2022-11-02'),
('T06', 'C2', '2022-10-11'),
('T07', 'C2', '2022-10-13'),
('T08', 'C2', '2022-11-02'),
('T09', 'C2', '2022-11-10'),
('T10', 'C2', '2022-11-14'),
('T11', 'C3', '2022-10-11'),
('T12', 'C3', '2022-10-20'),
('T13', 'C3', '2022-10-24'),
('T14', 'C4', '2022-11-02'),
('T15', 'C4', '2022-11-15'),
('T16', 'C4', '2022-11-24'),
('T17', 'C4', '2022-12-12'),
('T18', 'C6', '2022-12-27'),
('T19', 'C6', '2022-11-14'),
('T20', 'C7', '2022-12-19'),
('T21', 'C7', '2022-11-22'),
('T22', 'C7', '2022-11-10'),
('T23', 'C7', '2022-11-08'),
('T24', 'C7', '2022-10-12'),
('T25', 'C8', '2022-11-22'),
('T26', 'C8', '2022-10-18'),
('T27', 'C9', '2022-12-19'),
('T28', 'C9', '2022-11-22'),
('T29', 'C10', '2022-10-20'),
('T30', 'C10', '2022-10-17'),
('T31', 'C10', '2022-10-14'),
('T32', 'C12', '2022-12-08'),
('T33', 'C12', '2022-11-23'),
('T34', 'C12', '2022-11-21'),
('T35', 'C12', '2022-10-19'),
('T36', 'C13', '2022-11-23'),
('T37', 'C13', '2022-11-15'),
('T38', 'C14', '2022-10-12'),
('T39', 'C14', '2022-09-21'),
('T40', 'C15', '2022-09-01');

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `id_carte` varchar(3) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_categorie` int NOT NULL,
  `montant_caution` int NOT NULL,
  `date_carte` date NOT NULL,
  PRIMARY KEY (`id_carte`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `usager`
--

INSERT INTO `usager` (`id_carte`, `nom`, `id_categorie`, `montant_caution`, `date_carte`) VALUES
('C1', 'Nina Mcdowell', 3, 6, '2022-08-27'),
('C10', 'Francesca Briggs', 2, 9, '2022-08-16'),
('C11', 'Abdul Weiss', 2, 9, '2022-09-19'),
('C12', 'Rinah Reilly', 1, 8, '2022-09-11'),
('C13', 'Kimberley Bryan', 1, 9, '2022-09-17'),
('C14', 'Galena Keller', 1, 7, '2022-08-16'),
('C15', 'Francesca Briggs', 1, 9, '2022-08-16'),
('C2', 'Murphy Lane', 2, 9, '2022-08-15'),
('C3', 'Hillary Garza', 2, 7, '2022-09-07'),
('C4', 'Ciaran Ball', 3, 6, '2022-09-11'),
('C5', 'Kirsten Norton', 3, 7, '2022-09-28'),
('C6', 'Abdul Weiss', 3, 9, '2022-09-19'),
('C7', 'Rinah Reilly', 1, 8, '2022-09-11'),
('C8', 'Kimberley Bryan', 3, 9, '2022-09-17'),
('C9', 'Galena Keller', 4, 7, '2022-08-16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `droits` int NOT NULL,
  PRIMARY KEY (`id_users`),
  KEY `droits` (`droits`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `nom`, `prenom`, `mail`, `password`, `avatar`, `droits`) VALUES
(2, 'Atreides', 'Leto', 'leto.atreides@dune.fr', '$2y$10$1ucT3UIoy8ia9CxvQ.HbX.vSGCGFg518n3Nu3R/HJqQwZPUplAw6S', NULL, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `achat_ibfk_1` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id_prestation`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `achat_ibfk_2` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `depot_ibfk_1` FOREIGN KEY (`id_carte`) REFERENCES `usager` (`id_carte`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id_prestation`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_carte`) REFERENCES `usager` (`id_carte`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `usager`
--
ALTER TABLE `usager`
  ADD CONSTRAINT `usager_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`droits`) REFERENCES `droits` (`id_droits`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
