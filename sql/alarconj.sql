-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2019 at 01:21 PM
-- Server version: 5.5.47-0+deb8u1
-- PHP Version: 7.0.4-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alarconj`
--

-- --------------------------------------------------------

--
-- Table structure for table `Benevole`
--

CREATE TABLE `Benevole` (
  `IDBenevole` int(4) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `dateNaiss` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `numTelephone` varchar(10) NOT NULL,
  `nonce` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Benevole`
--

INSERT INTO `Benevole` (`IDBenevole`, `login`, `password`, `nom`, `prenom`, `dateNaiss`, `email`, `numTelephone`, `nonce`) VALUES
(1, 'oui', 'd38bffad84fcaaba4f2ba9807220b5aa48ac8c56111795eac6d176b4f7e65c62', 'oui', 'oui', '2019-01-02', 'tanguy.cadieux@laposte.net', '55', ''),
(3, 'celia', '3421f0b5602b598e8a532fb84574a1f4188a2140baead8458b6ec75d972812b9', 'grosch', 'célia', '1999-03-03', 'celia.grosch@gmail.com', '123456789', ''),
(5, 'celia2', '6642c297fa66d5dfef5524f13be5ce12e8418b1035d0e79b5eca755ad085c0a0', 'grosch', 'célia', '1999-03-03', 'celia.grosch@gmail.com', '0123456789', ''),
(8, 'celia3', 'a3a3909c8d217c44be5389428c7543c377d7cfaf74a3d2e354b5b22990558a61', 'grosch', 'celia', '1999-03-03', 'celia.grosch@gmail.com', '123', ''),
(15, 'oh', 'e434df276c6666191ca0acfe8bd467770a3790dc4fbf6964181122175f872820', 'oh', 'oh', '2019-01-02', 'tanguycad@gmail.com', '888', ''),
(16, 'hello', '367cf98dc5a36f2e1344063782c828e2991ee47e9ab712894ccac72081a2691a', 'Emarre', 'Jean', '2019-01-01', 'celia.grosch@gmail.com', '0123', ''),
(18, 'mimiche', '1596426eca17bac0962040e093e19b6ad9d65e8085da09985111a28abfdd4fc2', 'Dupond', 'Michel', '1973-10-04', 'michel.dupond@yopmail.com', '0601020304', ''),
(19, 'bobby', 'ca91a037cdc4645d137b59090c5d298dedd1f0805543658de22acb09a94a4f26', 'Marshall', 'Bob', '1968-05-22', 'bob.marchall@yopmail.com', '0724589610', ''),
(20, 'abc', 'a25f6795858d5a762f8f0f15b76b2ae70f06b177df6d058d7aa8af006c6b231e', 'abc', 'abc', '1236-01-01', 'celia.grosch@gmail.com', '46546', ''),
(24, 'samsyn', 'a6697e9581aea7fa645dbbb334e5889ba3e86c22bce41bfca6699d80012afeec', 'younesy', 'samira', '1998-03-10', 'samira.younesy@gmail.com', '0698990978', ''),
(25, 'tanguy', 'd38bffad84fcaaba4f2ba9807220b5aa48ac8c56111795eac6d176b4f7e65c62', 'cadieux', 'tanguy', '2019-01-13', 'tanguyc34@yopmail.com', '0778342305', ''),
(26, 'non', '7ead08fb4531b262830e715b8400dee7b843d971545b539cfb2aedeab02e3706', 'non', 'non', '2019-01-13', 'tanguyc@yopmail.com', '888888', '8c5d418bace3c4e7a07c9e68defdca27'),
(31, 'Julian', 'f4fbec2b0702796d98771f8641f5e0223ca7c96bfd6cc0255e343ebcce77cb06', 'Alarcon', 'Julian', '1997-05-08', 'julianc34@yopmail.com', '0658487815', ''),
(32, 't', 'ec656bb368bb0aac73a10109f972bc328b633cf4ae2fae8b614f8144e3d1330d', 't', 't', '2019-01-01', 'tanguyc50@yopmail.com', '55', ''),
(33, 'remi.coletta@gmail.c', 'a25f6795858d5a762f8f0f15b76b2ae70f06b177df6d058d7aa8af006c6b231e', 'coletta', 'remi', '1978-02-02', 'remi.coletta@gmail.com', '0700000000', ''),
(35, 't2', 'ec656bb368bb0aac73a10109f972bc328b633cf4ae2fae8b614f8144e3d1330d', 't', 't', '2019-01-01', 'tanguyc61@yopmail.com', '0077834230', ''),
(36, 'thomas', '233d08eef1e2f2ad620fb6a6e26676ab14d9d04da1931f2a9e0782806f7e36d4', 'sanz', 'thomas', '2019-02-01', 'titolo@gmail.com', '0106467952', 'f87c2086ab941b0541104c76137c7ac8'),
(41, 'azerty', '233d08eef1e2f2ad620fb6a6e26676ab14d9d04da1931f2a9e0782806f7e36d4', 'azerty', 'azerty', '2019-02-14', 'thomas@yopmail.com', '0102030405', ''),
(42, 'compte1', '233d08eef1e2f2ad620fb6a6e26676ab14d9d04da1931f2a9e0782806f7e36d4', 'compte1', 'compte1', '2019-03-15', 'thomas@yopmail.com', '4681684894', 'eef28ee6a3fb7527620302bb6fa16bb8'),
(43, 'compte2', '233d08eef1e2f2ad620fb6a6e26676ab14d9d04da1931f2a9e0782806f7e36d4', 'compte2', 'compte2', '2009-02-15', 'thomas@yopmail.com', 'errtyyupo', 'abd249c397d8220efc6ac8eb4c02dd75');

-- --------------------------------------------------------

--
-- Table structure for table `Creneaux`
--

CREATE TABLE `Creneaux` (
  `IDCreneau` int(11) NOT NULL,
  `idPoste` int(11) NOT NULL,
  `debutCreneau` date NOT NULL,
  `heureDebutCreneau` time NOT NULL,
  `heureFinCreneau` time NOT NULL,
  `nbBenevoles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lié à planning et à une liste de bénévoles, nbBenevoles = pr';

--
-- Dumping data for table `Creneaux`
--

INSERT INTO `Creneaux` (`IDCreneau`, `idPoste`, `debutCreneau`, `heureDebutCreneau`, `heureFinCreneau`, `nbBenevoles`) VALUES
(22, 74, '2019-01-19', '08:00:00', '10:00:00', 0),
(23, 78, '2019-01-16', '12:00:00', '15:00:00', 2),
(24, 81, '2019-01-16', '08:00:00', '10:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Disponibilites`
--

CREATE TABLE `Disponibilites` (
  `IDDisponibilites` int(10) NOT NULL,
  `idBenevole` int(11) NOT NULL,
  `debutDispo` date NOT NULL,
  `heureDebutDispo` time NOT NULL,
  `heureFinDispo` time NOT NULL,
  `indisponible` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Disponibilites`
--

INSERT INTO `Disponibilites` (`IDDisponibilites`, `idBenevole`, `debutDispo`, `heureDebutDispo`, `heureFinDispo`, `indisponible`) VALUES
(76, 31, '2019-01-16', '20:00:00', '23:00:00', 1),
(77, 3, '2019-01-16', '08:00:00', '12:00:00', 0),
(78, 31, '2019-01-16', '08:00:00', '12:00:00', 1),
(79, 35, '2019-01-16', '08:00:00', '12:00:00', 1),
(80, 41, '2019-02-22', '00:45:00', '15:36:00', 0),
(81, 41, '2019-03-07', '07:08:00', '08:09:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Festival`
--

CREATE TABLE `Festival` (
  `IDFestival` int(11) NOT NULL,
  `nomFestival` varchar(40) NOT NULL,
  `lieuFestival` varchar(255) NOT NULL,
  `dateDebutF` date NOT NULL,
  `dateFinF` date NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Festival`
--

INSERT INTO `Festival` (`IDFestival`, `nomFestival`, `lieuFestival`, `dateDebutF`, `dateFinF`, `description`) VALUES
(1, 'Les Vielles Charrues', 'Bizensac', '2019-01-24', '2019-01-26', 'L\'un des plus célèbres festivals de bretagne, découvrez le folklore local!'),
(2, 'Marsatack', 'Marseille', '2019-01-02', '2019-01-30', 'Festival marseillais depuis 1998, venez fêter les 21 ans du festival!'),
(39, 'Summer Ending', 'Agde', '2019-09-21', '2019-09-21', 'Venez fêter la fin de l\'été avec nous et accueillir à bras ouvert l\'automne lors de ce festival electro/rock !'),
(63, 'Goatchella', 'Rochegude', '2019-05-17', '2019-05-19', 'Goatchella, c\'est comme Coachella mais avec des chèvres, et dans la belle ville de Rochegude dans le Gard. Nous serons heureux de vous accueillir sur ces 3 jours sans répis, avec dégustation de fromage et de vin à volonté. 15€ l\'entrée pour toute la durée du festival.'),
(65, 'Les Vendanges de Septembre', 'St Christol', '2019-09-21', '2019-09-22', 'Venez recueillir des grappes de raisins sur notre domaine, nous produirons alors votre vin en direct ! 5€ par personne par jour puis 5€ les 10 kg de raisins'),
(66, 'Rock', 'Montpellier', '2019-01-15', '2019-01-18', 'Venez découvrir le monde du rocknroll !!!'),
(68, 'Let s Begin', 'Montpellier', '2019-05-06', '2019-05-08', 'Let s Begin est un festival de musique folk.'),
(70, 'Festival', 'montpellier', '2019-01-16', '2019-01-17', 'Une description'),
(72, 'festival', 'loin', '2019-02-14', '2019-02-21', 'trop bien');

-- --------------------------------------------------------

--
-- Table structure for table `link_AffecterCreneauBenevole`
--

CREATE TABLE `link_AffecterCreneauBenevole` (
  `idCreneaux` int(11) NOT NULL,
  `idBenevole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_AffecterCreneauBenevole`
--

INSERT INTO `link_AffecterCreneauBenevole` (`idCreneaux`, `idBenevole`) VALUES
(24, 31),
(24, 35);

-- --------------------------------------------------------

--
-- Table structure for table `link_BenevoleParticipeFestival`
--

CREATE TABLE `link_BenevoleParticipeFestival` (
  `IDFestival` int(11) NOT NULL,
  `IDBenevole` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `isOrganisateur` tinyint(1) NOT NULL,
  `candidat` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_BenevoleParticipeFestival`
--

INSERT INTO `link_BenevoleParticipeFestival` (`IDFestival`, `IDBenevole`, `valide`, `isOrganisateur`, `candidat`) VALUES
(1, 15, 0, 0, 0),
(1, 16, 0, 0, 0),
(1, 41, 0, 0, 0),
(2, 1, 1, 1, NULL),
(2, 3, 1, 0, NULL),
(2, 15, 1, 0, 0),
(2, 33, 0, 0, 0),
(39, 1, 0, 0, 0),
(39, 3, 1, 1, NULL),
(39, 16, 1, 0, 0),
(63, 1, 1, 1, 1),
(63, 16, 1, 1, 0),
(65, 18, 1, 1, 0),
(65, 19, 1, 0, 1),
(65, 24, 0, 0, 0),
(66, 3, 1, 0, 0),
(66, 24, 1, 1, 0),
(68, 31, 1, 1, 0),
(70, 31, 1, 0, 0),
(70, 33, 1, 0, 0),
(70, 35, 1, 1, 0),
(72, 41, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `link_PostesParFestival`
--

CREATE TABLE `link_PostesParFestival` (
  `IDFestival` int(11) NOT NULL,
  `IDPoste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_PostesParFestival`
--

INSERT INTO `link_PostesParFestival` (`IDFestival`, `IDPoste`) VALUES
(2, 46),
(2, 69),
(39, 71),
(39, 72),
(39, 73),
(39, 74),
(65, 75),
(65, 76),
(66, 77),
(68, 78),
(68, 79),
(70, 81);

-- --------------------------------------------------------

--
-- Table structure for table `link_PreferenceBenevolePostes`
--

CREATE TABLE `link_PreferenceBenevolePostes` (
  `IDBenevole` int(11) NOT NULL,
  `IDPoste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_PreferenceBenevolePostes`
--

INSERT INTO `link_PreferenceBenevolePostes` (`IDBenevole`, `IDPoste`) VALUES
(1, 46),
(35, 81);

-- --------------------------------------------------------

--
-- Table structure for table `Poste`
--

CREATE TABLE `Poste` (
  `IDPoste` int(11) NOT NULL,
  `nomPoste` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Poste`
--

INSERT INTO `Poste` (`IDPoste`, `nomPoste`) VALUES
(46, 'chauffeur'),
(69, 'cxztyx'),
(70, 'Barman'),
(71, 'Barman'),
(72, 'Sécurité'),
(73, 'Sécurité'),
(74, 'Sécurité'),
(75, 'Accueil'),
(76, 'Photographe'),
(77, 'accueil'),
(78, 'Accueil'),
(79, 'Sécurité'),
(81, 'Barman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Benevole`
--
ALTER TABLE `Benevole`
  ADD PRIMARY KEY (`IDBenevole`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indexes for table `Creneaux`
--
ALTER TABLE `Creneaux`
  ADD PRIMARY KEY (`IDCreneau`,`idPoste`,`debutCreneau`,`heureDebutCreneau`,`heureFinCreneau`),
  ADD KEY `idPoste` (`idPoste`);

--
-- Indexes for table `Disponibilites`
--
ALTER TABLE `Disponibilites`
  ADD PRIMARY KEY (`IDDisponibilites`,`idBenevole`,`debutDispo`,`heureDebutDispo`,`heureFinDispo`),
  ADD KEY `idBenevole` (`idBenevole`);

--
-- Indexes for table `Festival`
--
ALTER TABLE `Festival`
  ADD PRIMARY KEY (`IDFestival`);

--
-- Indexes for table `link_AffecterCreneauBenevole`
--
ALTER TABLE `link_AffecterCreneauBenevole`
  ADD PRIMARY KEY (`idCreneaux`,`idBenevole`),
  ADD KEY `idCreneaux` (`idCreneaux`),
  ADD KEY `idBenevole` (`idBenevole`);

--
-- Indexes for table `link_BenevoleParticipeFestival`
--
ALTER TABLE `link_BenevoleParticipeFestival`
  ADD PRIMARY KEY (`IDFestival`,`IDBenevole`),
  ADD KEY `IDFestival` (`IDFestival`),
  ADD KEY `IDBenevole` (`IDBenevole`);

--
-- Indexes for table `link_PostesParFestival`
--
ALTER TABLE `link_PostesParFestival`
  ADD PRIMARY KEY (`IDFestival`,`IDPoste`),
  ADD KEY `IDFestival` (`IDFestival`),
  ADD KEY `IDPoste` (`IDPoste`);

--
-- Indexes for table `link_PreferenceBenevolePostes`
--
ALTER TABLE `link_PreferenceBenevolePostes`
  ADD PRIMARY KEY (`IDBenevole`,`IDPoste`),
  ADD KEY `IDPoste` (`IDPoste`),
  ADD KEY `IDBenevole` (`IDBenevole`);

--
-- Indexes for table `Poste`
--
ALTER TABLE `Poste`
  ADD PRIMARY KEY (`IDPoste`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Benevole`
--
ALTER TABLE `Benevole`
  MODIFY `IDBenevole` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `Creneaux`
--
ALTER TABLE `Creneaux`
  MODIFY `IDCreneau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `Disponibilites`
--
ALTER TABLE `Disponibilites`
  MODIFY `IDDisponibilites` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `Festival`
--
ALTER TABLE `Festival`
  MODIFY `IDFestival` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `Poste`
--
ALTER TABLE `Poste`
  MODIFY `IDPoste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Creneaux`
--
ALTER TABLE `Creneaux`
  ADD CONSTRAINT `Creneaux_ibfk_1` FOREIGN KEY (`idPoste`) REFERENCES `Poste` (`IDPoste`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Disponibilites`
--
ALTER TABLE `Disponibilites`
  ADD CONSTRAINT `Disponibilites_ibfk_1` FOREIGN KEY (`idBenevole`) REFERENCES `Benevole` (`IDBenevole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link_AffecterCreneauBenevole`
--
ALTER TABLE `link_AffecterCreneauBenevole`
  ADD CONSTRAINT `link_AffecterCreneauBenevole_ibfk_1` FOREIGN KEY (`idBenevole`) REFERENCES `Benevole` (`IDBenevole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_AffecterCreneauBenevole_ibfk_2` FOREIGN KEY (`idCreneaux`) REFERENCES `Creneaux` (`IDCreneau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link_BenevoleParticipeFestival`
--
ALTER TABLE `link_BenevoleParticipeFestival`
  ADD CONSTRAINT `frk_link_festivale_benevole1` FOREIGN KEY (`IDFestival`) REFERENCES `Festival` (`IDFestival`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frk_link_festivale_benevole2` FOREIGN KEY (`IDBenevole`) REFERENCES `Benevole` (`IDBenevole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link_PostesParFestival`
--
ALTER TABLE `link_PostesParFestival`
  ADD CONSTRAINT `link_PostesParFestival_ibfk_1` FOREIGN KEY (`IDFestival`) REFERENCES `Festival` (`IDFestival`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_PostesParFestival_ibfk_2` FOREIGN KEY (`IDPoste`) REFERENCES `Poste` (`IDPoste`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link_PreferenceBenevolePostes`
--
ALTER TABLE `link_PreferenceBenevolePostes`
  ADD CONSTRAINT `link_PreferenceBenevolePostes_ibfk_1` FOREIGN KEY (`IDBenevole`) REFERENCES `Benevole` (`IDBenevole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_PreferenceBenevolePostes_ibfk_2` FOREIGN KEY (`IDPoste`) REFERENCES `Poste` (`IDPoste`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
