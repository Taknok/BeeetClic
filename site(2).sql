-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 17 Mai 2016 à 19:20
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motDePass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `argent` float(11,2) NOT NULL,
  `validation_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validation_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`id`, `pseudo`, `nom`, `prenom`, `email`, `motDePass`, `argent`, `validation_mail`, `validation_date`) VALUES
(13, 'z', 'ok', 'v', 'y', '58007911bf9f66711ef65e807b26c396a2d6fb464f4381520c5d4a575dbb81510f79d35e349604128a771acf2a117a2afdedc012d83b0eb822668aee0def4747', 1576.93, NULL, NULL),
(14, 'Tak', 'Gre', 'Pau', 'pau.gre@tak.com', '1f40fc92da241694750979ee6cf582f2d5d7d28e18335de05abc54d0560e0f5302860c652bf08d560252aa5e74210546f369fbbbce8c12cfc7957b2652fe9a75', 50.00, NULL, NULL),
(47, 'paul', 'a', 'a', 'paul.gressier@yahoo.fr', '1f40fc92da241694750979ee6cf582f2d5d7d28e18335de05abc54d0560e0f5302860c652bf08d560252aa5e74210546f369fbbbce8c12cfc7957b2652fe9a75', 99.00, NULL, '2016-05-12'),
(50, 'aze', 'rty', 'ui', 'grijol.guillaume@gmail.com', '64fcc6f6bc7a815041b4db51f00f4bea8e51c13b27f422da0a8522c94641c7e483c3f17b28d0a59add0c8a44a4e4fc1dd3a9ea48bad8cf5b707ac0f44a5f3536', 20.00, 'sgyewcuasphmfclibgqvwtlrjpyvwcurjpyvftdibpheftlispyvnkdijphentuispqmnkurjgyvnklijxqvwcuajghmnklrjxhvncurjxymftdasxqmfkdrbphmwtdrbxqvnklrsghvfcdrjxheftuabxyewclajxhefkdijpyenkuijpymntuajgyvwcdabphvftdajxhmnklrsghefcdibpymncurjgqvntursxqmnklasxqmftuijpqefcd', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

DROP TABLE IF EXISTS `matchs`;
CREATE TABLE IF NOT EXISTS `matchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
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
  `nbparieurs` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `matchs`
--

INSERT INTO `matchs` (`id`, `categorie`, `nom`, `equipe1`, `equipe2`, `fini`, `gagnant`, `coteEq1`, `coteNull`, `coteEq2`, `dateFin`, `coteEq1ini`, `coteNullini`, `coteEq2ini`, `nbParieurEq1`, `nbParieurNull`, `nbParieurEq2`, `nbparieurs`) VALUES
(4, 'foot', 'Bordeaux Vs Paris', 'Bordeaux', 'Paris', 0, 1, 5.69697, 8.38095, 9.45455, '2016-05-30', 5, 5, 9, 11, 7, 11, 33),
(5, 'foot', 'Toulouse Vs Lyon', 'TFC', 'Lyon', 0, 0, 1.83333, 6, 1, '2016-05-31', 1, 3, 2, 2, 1, 0, 7),
(6, 'hand', 'Sheepy Vs Lion', 'Sheepy', 'Lion', 0, 0, 1, 5, 3, '2016-05-26', 1, 5, 3, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paris`
--

DROP TABLE IF EXISTS `paris`;
CREATE TABLE IF NOT EXISTS `paris` (
  `idPari` int(11) NOT NULL AUTO_INCREMENT,
  `idMatch` int(11) NOT NULL,
  `idParieur` int(11) NOT NULL,
  `montant` float(11,2) NOT NULL,
  `equipe` int(11) NOT NULL,
  `cote` float NOT NULL,
  `datePari` datetime NOT NULL,
  `gagne` tinyint(1) NOT NULL,
  `fini` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPari`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `paris`
--

INSERT INTO `paris` (`idPari`, `idMatch`, `idParieur`, `montant`, `equipe`, `cote`, `datePari`, `gagne`, `fini`) VALUES
(26, 4, 13, 1.00, 1, 5.66667, '2016-05-17 18:23:43', 0, 0),
(28, 5, 13, 50.00, 1, 1.66667, '2016-05-17 20:37:22', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
