-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 16 Mai 2016 à 23:04
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Site`
--

-- --------------------------------------------------------

--
-- Structure de la table `Compte`
--

CREATE TABLE `Compte` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motDePass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `argent` float(11,2) NOT NULL,
  `validation_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Compte`
--

INSERT INTO `Compte` (`id`, `pseudo`, `nom`, `prenom`, `email`, `motDePass`, `argent`, `validation_mail`, `validation_date`) VALUES
(13, 'z', 'ok', 'v', 'y', '58007911bf9f66711ef65e807b26c396a2d6fb464f4381520c5d4a575dbb81510f79d35e349604128a771acf2a117a2afdedc012d83b0eb822668aee0def4747', 1679.52, NULL, NULL),
(14, 'Tak', 'Gre', 'Pau', 'pau.gre@tak.com', '1f40fc92da241694750979ee6cf582f2d5d7d28e18335de05abc54d0560e0f5302860c652bf08d560252aa5e74210546f369fbbbce8c12cfc7957b2652fe9a75', 50.00, NULL, NULL),
(47, 'paul', 'a', 'a', 'paul.gressier@yahoo.fr', '1f40fc92da241694750979ee6cf582f2d5d7d28e18335de05abc54d0560e0f5302860c652bf08d560252aa5e74210546f369fbbbce8c12cfc7957b2652fe9a75', 99.00, NULL, '2016-05-12'),
(48, 'o', 'o', 'o', 'grijol.guillaume@gmail.com', '121b4774a759924a2929c4a412fb6e31b9aaa746466840efcc4a76d69a94149e2364e3983d646feafaa1b511785e5c9e90aedc30da6a6bead5520ecc99c6626a', 9.00, NULL, '2016-05-12');

-- --------------------------------------------------------

--
-- Structure de la table `Matchs`
--

CREATE TABLE `Matchs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equipe1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equipe2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fini` tinyint(1) NOT NULL,
  `gagnant` int(11) NOT NULL,
  `coteEq1` float NOT NULL,
  `coteNull` float NOT NULL,
  `coteEq2` float NOT NULL,
  `dateFin` date NOT NULL,
  `coteEq1ini` float NOT NULL,
  `coteNullini` float NOT NULL,
  `coteEq2ini` float NOT NULL,
  `nbParieurEq1` int(11) NOT NULL,
  `nbParieurNull` int(11) NOT NULL,
  `nbParieurEq2` int(11) NOT NULL,
  `nbparieurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Matchs`
--

INSERT INTO `Matchs` (`id`, `nom`, `equipe1`, `equipe2`, `fini`, `gagnant`, `coteEq1`, `coteNull`, `coteEq2`, `dateFin`, `coteEq1ini`, `coteNullini`, `coteEq2ini`, `nbParieurEq1`, `nbParieurNull`, `nbParieurEq2`, `nbparieurs`) VALUES
(4, 'Bordeaux Vs Paris', 'Bordeaux', 'Paris', 1, 1, 6.41667, 6.95238, 6.72727, '2016-05-30', 5, 5, 9, 8, 7, 11, 26),
(5, 'Toulouse Vs Lyon', 'TFC', 'Lyon', 1, 1, 1.33333, 3, 2, '2016-05-31', 1, 3, 2, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Paris`
--

CREATE TABLE `Paris` (
  `idPari` int(11) NOT NULL,
  `idMatch` int(11) NOT NULL,
  `idParieur` int(11) NOT NULL,
  `montant` float(11,2) NOT NULL,
  `equipe` int(11) NOT NULL,
  `cote` float NOT NULL,
  `datePari` datetime NOT NULL,
  `gagne` tinyint(1) NOT NULL,
  `fini` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Paris`
--

INSERT INTO `Paris` (`idPari`, `idMatch`, `idParieur`, `montant`, `equipe`, `cote`, `datePari`, `gagne`, `fini`) VALUES
(23, 4, 13, 20.00, 1, 6.47619, '2016-05-16 23:00:10', 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Paris`
--
ALTER TABLE `Paris`
  ADD PRIMARY KEY (`idPari`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Compte`
--
ALTER TABLE `Compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Paris`
--
ALTER TABLE `Paris`
  MODIFY `idPari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
