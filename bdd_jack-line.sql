-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 oct. 2024 à 18:55
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_jack-line`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `texte` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `texte`) VALUES
(3, 6, 'Ceci est un avis test');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4C62E638A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `numero`, `nom`, `prenom`, `user_id`) VALUES
(4, '01 02 03 04 05', 'Line', 'Jack', 6);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241015090412', '2024-10-15 09:04:25', 176),
('DoctrineMigrations\\Version20241018113840', '2024-10-18 11:40:15', 195),
('DoctrineMigrations\\Version20241018115330', '2024-10-18 11:53:41', 51),
('DoctrineMigrations\\Version20241018115634', '2024-10-18 11:56:39', 34),
('DoctrineMigrations\\Version20241018131454', '2024-10-18 13:14:58', 29),
('DoctrineMigrations\\Version20241018142209', '2024-10-18 14:22:14', 41),
('DoctrineMigrations\\Version20241021080406', '2024-10-21 08:05:14', 145),
('DoctrineMigrations\\Version20241021100358', '2024-10-21 10:04:16', 81),
('DoctrineMigrations\\Version20241021131208', '2024-10-21 13:12:16', 102),
('DoctrineMigrations\\Version20241021132531', '2024-10-21 13:25:36', 49),
('DoctrineMigrations\\Version20241021143320', '2024-10-21 14:33:26', 19),
('DoctrineMigrations\\Version20241021161300', '2024-10-21 16:13:05', 106),
('DoctrineMigrations\\Version20241021161819', '2024-10-21 16:18:22', 92),
('DoctrineMigrations\\Version20241021163458', '2024-10-21 16:35:01', 15);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

DROP TABLE IF EXISTS `presentation`;
CREATE TABLE IF NOT EXISTS `presentation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `presentation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `presentation`
--

INSERT INTO `presentation` (`id`, `presentation`) VALUES
(1, 'Bonjour, le site est en désordre... nous somme désolé pour la gêne occasionnel mais notre meilleur développeur (M.Bert) est sur le coup !');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
CREATE TABLE IF NOT EXISTS `prestation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `categorie` int NOT NULL,
  `categorie_img` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id`, `libelle`, `prix`, `categorie`, `categorie_img`) VALUES
(1, 'Épilation du maillot', 15, 1, 1),
(2, 'Épilation du dos', 10, 1, 2),
(3, 'Épilation du torse', 10, 1, 3),
(4, 'Épilation des bras', 7, 1, 4),
(5, 'Épilation du maillot', 15, 2, 1),
(6, 'Cire diamant sublime', 20, 2, 5),
(7, 'Soin exfoliant', 15, 2, 6),
(8, 'Épilation sourcils et visage', 10, 2, 8),
(9, 'Épilation aisselles et bras', 10, 2, 9),
(10, 'Épilation jambes et cuisses', 10, 2, 10),
(11, 'Soins Calluspeeling', 25, 3, 7),
(12, 'Soins mains et pieds', 10, 3, 1),
(13, 'Vernis semi-permanant', 15, 3, 5),
(14, 'Ongles en gel', 30, 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'user1@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$zf9mk2ShT.mdOI50tcZOoOmmtpXQcLiz7RSrabvMq3GYy05uxlvKO'),
(6, 'user2@gmail.com', '[\"ROLE_USER\"]', '$2y$13$bPCnnktDsWTtn3TggwSQbu950F.xBEM.KaUZxV/f2/RodfZtplqQq');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
