-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 07 sep. 2017 à 22:39
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `date_time_publication` datetime NOT NULL,
  `content` text NOT NULL,
  `illustration` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `sub_title`, `autor`, `date_time_publication`, `content`, `illustration`, `category`) VALUES
(44, 'Le positionnement en HTLM', 'Les différents type de positionnement dans une page web', 'Guillaume DUCLOS', '2017-09-07 21:34:18', 'Le positionnement en HTML est un élément important à maîtriser pour créer au mieux ses pages web. Il y\'a dans un premier temps le positionnement relative, celui-ci est le type de positionnement par défaut des balises HTML. Le positionnement absolute, qui permet de faire sortir un élément HTML du flux de la page. On s\'en sert pour positionner un élément de manière arbitraire au sein d\'un élément de la page sans se soucier des éléments frères par exemple. Le positionnement fixed est très proche du positionnement absolute mais laisse l\'élément fixe dans la page. Le positionnement flex est un type de positionnement récent qui permet de positionner ses éléments de manière responsive dans une page. Ce dernier ce place sur l’élément parent contrairement au autre type de positionnement. ', '212-ie6-missing-ap-elements-screen.png', 'code'),
(42, 'Mon alternance chez Wareega', 'Article sur mon alternance chez le magasin Wareega', 'Guillaume DUCLOS', '2017-09-07 21:17:13', 'Lors de mon alternance chez le magasin Wareega (magasin de vélo), j\'ai été amené accompagner mon collègue développeur au développement du site côté front-end et back-end.', 'wareega-logo-1455185221.jpg', 'code'),
(43, 'Le flux HTML', 'Comprendre le flux HTML', 'Guillaume DUCLOS', '2017-09-07 21:25:34', 'Le flux HTML correspond à &quot;l’écoulement&quot; des informations dans une page web. Il s\'agit des différents éléments qui constituent la page. Ces éléments sont lus par le navigateur de haut en bas. Ceci est lié au DOM HTML de la page. Cependant, certain élément sorte du flux de la page. Il s\'agit notamment des éléments positionnés en absolute ou en fixed.', 'flux-10-638.jpg', 'code');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
