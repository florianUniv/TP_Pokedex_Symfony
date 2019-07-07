-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 07 juil. 2019 à 19:44
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `elementary_type`
--

DROP TABLE IF EXISTS `elementary_type`;
CREATE TABLE IF NOT EXISTS `elementary_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `elementary_type`
--

INSERT INTO `elementary_type` (`id`, `libelle`) VALUES
(1, 'acier'),
(2, 'combat'),
(3, 'dragon'),
(4, 'eau'),
(5, 'electrik'),
(6, 'feu'),
(7, 'glace'),
(8, 'insecte'),
(9, 'normal'),
(10, 'plante'),
(11, 'poison'),
(12, 'psy'),
(13, 'roche'),
(14, 'sol'),
(15, 'spectre'),
(16, 'vol'),
(17, 'fée'),
(18, 'Aucun');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190707172243', '2019-07-07 17:22:53');

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_pokemon_id` int(11) NOT NULL,
  `dresseur_id` int(11) NOT NULL,
  `sexe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xp` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `a_vendre` tinyint(1) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_dernier_entrainement` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_62DC90F32922F320` (`ref_pokemon_id`),
  KEY `IDX_62DC90F3A1A01CBE` (`dresseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pokemon`
--

INSERT INTO `pokemon` (`id`, `ref_pokemon_id`, `dresseur_id`, `sexe`, `xp`, `niveau`, `a_vendre`, `prix`, `date_dernier_entrainement`) VALUES
(3, 1, 11, 'M', 764, 5, 1, 4888, '2019-07-07 18:30:42'),
(4, 4, 12, 'F', 0, 5, 0, 0, '2019-07-07 14:53:35'),
(5, 1, 11, 'M', 0, 5, 0, 0, '2019-07-07 18:09:26'),
(6, 1, 11, 'M', 0, 5, 0, 0, '2019-07-07 18:09:50'),
(7, 1, 11, 'F', 0, 5, 0, 4500, '2019-07-07 18:10:31'),
(8, 2, 11, 'M', 0, 5, 0, 0, '2019-07-07 18:11:09'),
(9, 5, 11, 'F', 0, 5, 0, 0, '2019-07-07 18:14:42'),
(10, 4, 11, 'M', 0, 5, 0, 0, '2019-07-07 18:27:49'),
(11, 1, 11, 'F', 0, 5, 1, 5001, '2019-07-07 18:27:57'),
(12, 2, 11, 'M', 0, 5, 0, 0, '2019-07-07 18:30:42');

-- --------------------------------------------------------

--
-- Structure de la table `ref_pokemon`
--

DROP TABLE IF EXISTS `ref_pokemon`;
CREATE TABLE IF NOT EXISTS `ref_pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evolution` tinyint(1) NOT NULL,
  `starter` tinyint(1) NOT NULL,
  `type_courbe_niveau` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_1_id` int(11) NOT NULL,
  `type_2_id` int(11) NOT NULL,
  `terrain_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A6C8C32327DC99F2` (`type_1_id`),
  KEY `IDX_A6C8C3233569361C` (`type_2_id`),
  KEY `IDX_A6C8C3238A2D8B41` (`terrain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ref_pokemon`
--

INSERT INTO `ref_pokemon` (`id`, `nom`, `evolution`, `starter`, `type_courbe_niveau`, `type_1_id`, `type_2_id`, `terrain_id`) VALUES
(1, 'Bulbizarre', 0, 1, 'P', 10, 11, 1),
(2, 'Herbizarre', 1, 0, 'P', 10, 11, 2),
(3, 'Florizarre', 1, 0, 'P', 10, 11, 3),
(4, 'Salamèche', 0, 1, 'P', 6, 18, 4),
(5, 'Reptincel', 1, 0, 'P', 6, 18, 5),
(6, 'Dracaufeu', 1, 0, 'P', 6, 16, 1),
(7, 'Carapuce', 0, 1, 'P', 4, 18, 2),
(8, 'Carabaffe', 1, 0, 'P', 4, 18, 3),
(9, 'Tortank', 1, 0, 'P', 4, 18, 4),
(10, 'Barpeau', 0, 1, 'P', 6, 7, 5);

-- --------------------------------------------------------

--
-- Structure de la table `terrain`
--

DROP TABLE IF EXISTS `terrain`;
CREATE TABLE IF NOT EXISTS `terrain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `terrain`
--

INSERT INTO `terrain` (`id`, `nom`) VALUES
(1, 'montage'),
(2, 'plage'),
(3, 'prairie'),
(4, 'ville'),
(5, 'désert');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starter_id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `nb_pieces` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  KEY `IDX_8D93D649AD5A66CC` (`starter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `starter_id`, `email`, `roles`, `password`, `username`, `is_active`, `nb_pieces`) VALUES
(11, 1, 'florian@free.fr', '[]', 'florian', 'Florian', 1, 500),
(12, 4, 'joe@free.fr', '[]', 'joe', 'joe', 1, 4501);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `FK_62DC90F32922F320` FOREIGN KEY (`ref_pokemon_id`) REFERENCES `ref_pokemon` (`id`),
  ADD CONSTRAINT `FK_62DC90F3A1A01CBE` FOREIGN KEY (`dresseur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `ref_pokemon`
--
ALTER TABLE `ref_pokemon`
  ADD CONSTRAINT `FK_A6C8C32327DC99F2` FOREIGN KEY (`type_1_id`) REFERENCES `elementary_type` (`id`),
  ADD CONSTRAINT `FK_A6C8C3233569361C` FOREIGN KEY (`type_2_id`) REFERENCES `elementary_type` (`id`),
  ADD CONSTRAINT `FK_A6C8C3238A2D8B41` FOREIGN KEY (`terrain_id`) REFERENCES `terrain` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649AD5A66CC` FOREIGN KEY (`starter_id`) REFERENCES `ref_pokemon` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
