-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 11 juin 2019 à 20:37
-- Version du serveur :  5.7.25
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `kirbyland_yf`
--

-- --------------------------------------------------------

--
-- Structure de la table `Amis`
--

CREATE TABLE `Amis` (
  `id` int(11) NOT NULL,
  `ami1` int(11) NOT NULL,
  `ami2` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Amis`
--

INSERT INTO `Amis` (`id`, `ami1`, `ami2`, `Date`) VALUES
(38, 5, 6, '2019-05-06 08:54:02'),
(39, 6, 5, '2019-05-09 12:00:38'),
(40, 6, 7, '2019-05-09 12:02:29'),
(42, 18, 7, '2019-05-17 11:33:47'),
(43, 18, 6, '2019-05-17 11:34:05'),
(44, 18, 5, '2019-05-17 11:34:15');

-- --------------------------------------------------------

--
-- Structure de la table `Chat`
--

CREATE TABLE `Chat` (
  `Id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `Date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Chat`
--

INSERT INTO `Chat` (`Id`, `pseudo`, `message`, `Date`) VALUES
(4, 'Fabien', 'bonjour !!!', '2019-04-05 11:04:37'),
(19, 'fabien', 'Salut\r\n', '2019-04-05 11:04:37'),
(1255, 'yousra', 'gfdgdfgdfg', '2019-04-05 11:04:37'),
(1259, 'fabien', 'dsld', '2019-04-05 11:04:37'),
(1262, 'fabien', 'cccc', '2019-04-05 11:04:37'),
(1263, 'fabien', 'sss', '2019-04-05 11:04:37'),
(1264, 'fabien', 'sss', '2019-04-05 11:04:37'),
(1265, 'fabien', 'qqq', '2019-04-05 11:04:37'),
(1266, 'fabien', 'qqq', '2019-04-05 11:04:37'),
(1267, 'fabien', 'csqc', '2019-04-05 11:04:37'),
(1268, 'fabien', 'csqc', '2019-04-05 11:04:37'),
(1269, 'fabien', 'sxsx', '2019-04-05 11:04:37'),
(1270, 'fabien', 'sxsx', '2019-04-05 11:04:37'),
(1271, 'fabien', 'sud', '2019-04-05 11:04:37'),
(1272, 'fabien', 'bonjour', '2019-04-05 11:04:37'),
(1273, 'fabien', 'fifre', '2019-04-05 11:04:37'),
(1274, 'yousra', 'f;jhsdvfjhdf', '2019-04-05 11:04:37'),
(1275, 'fabien', 'dsqd', '2019-04-05 11:04:37'),
(1276, 'yousra', 'dsfdsf', '2019-04-05 11:04:37'),
(1277, 'fabien', ';hbdsfhjs', '2019-04-05 11:04:37'),
(1278, 'fabien', 'ngff', '2019-04-05 11:04:37'),
(1279, 'yousra', 'gnfdsf', '2019-04-05 11:04:37'),
(1280, 'yousra', 'dsqd', '2019-04-05 11:04:37'),
(1281, 'yousra', 'bonjour', '2019-04-05 11:04:37'),
(1282, 'fabien', 'cava', '2019-04-05 11:04:37'),
(1283, 'yousra', 'oui', '2019-04-05 11:04:37'),
(1284, 'fabien', 'des', '2019-04-05 11:04:37'),
(1285, 'fabien', 'des', '2019-04-05 11:04:37'),
(1286, 'yousra', 'fdezfze', '2019-04-05 11:04:37'),
(1287, 'yousra', 'salut', '2019-04-12 09:07:00'),
(1288, 'yousra', 'yo', '2019-04-12 09:07:22'),
(1289, 'noxjzz', 'ushviushvur', '2019-04-12 09:08:24'),
(1291, 'Nico', 'noxjzztument', '2019-04-12 09:14:59'),
(1292, 'Nico', 'jesuisnul', '2019-04-12 09:15:40'),
(1293, 'Nico', 'rttg', '2019-04-12 10:06:48'),
(1294, 'fabien', 'dsldqsdsqdqs', '2019-04-19 11:35:24'),
(1295, 'fabien', 'ok', '2019-04-26 15:33:00'),
(1296, 'fabien', '.', '2019-04-26 15:33:16'),
(1297, 'fabien', 'bonjour', '2019-05-06 08:53:13');

-- --------------------------------------------------------

--
-- Structure de la table `Compte`
--

CREATE TABLE `Compte` (
  `ID` int(4) NOT NULL,
  `Pseudo` varchar(20) DEFAULT NULL,
  `Mail` varchar(20) DEFAULT NULL,
  `image` varchar(1000) DEFAULT 'assets/ImageProfil/DBZ2.png',
  `motdepasse` varchar(20) DEFAULT NULL,
  `codepostal` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Compte`
--

INSERT INTO `Compte` (`ID`, `Pseudo`, `Mail`, `image`, `motdepasse`, `codepostal`, `ville`, `adresse`, `pays`) VALUES
(5, 'Yousra', 'yousra@gmail.com', 'assets/ImageProfil/peachprofile.png', 'yousra', 75015, 'Paris', '', 'france'),
(6, 'fabien', 'fabien@gmail.com', 'assets/ImageProfil/DBZ.png', 'fabien', 0, '', '', ''),
(7, 'nico', 'dsqdq@mail.fr', 'assets/ImageProfil/DBZ1.png', 'aze', 91320, 'dsfsdfs', '', 'france'),
(18, '', '', 'assets/ImageProfil/DBZ1.png', 'yoyoyo', 94290, '', '', 'france');

-- --------------------------------------------------------

--
-- Structure de la table `Score`
--

CREATE TABLE `Score` (
  `id` int(4) NOT NULL,
  `point` int(4) NOT NULL,
  `ID_compte` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Score`
--

INSERT INTO `Score` (`id`, `point`, `ID_compte`) VALUES
(1, 10000, 6),
(2, 50, 5),
(3, 5000, 7),
(17, 9999, 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Amis`
--
ALTER TABLE `Amis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ami1` (`ami1`),
  ADD KEY `ami2` (`ami2`);

--
-- Index pour la table `Chat`
--
ALTER TABLE `Chat`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ID_compte` (`ID_compte`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Amis`
--
ALTER TABLE `Amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `Chat`
--
ALTER TABLE `Chat`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1298;

--
-- AUTO_INCREMENT pour la table `Compte`
--
ALTER TABLE `Compte`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Score`
--
ALTER TABLE `Score`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Amis`
--
ALTER TABLE `Amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`ami1`) REFERENCES `Compte` (`ID`),
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`ami2`) REFERENCES `Compte` (`ID`);

--
-- Contraintes pour la table `Score`
--
ALTER TABLE `Score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`ID_compte`) REFERENCES `Compte` (`ID`);
