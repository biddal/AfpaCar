-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 04:46 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afpacar`
--

-- --------------------------------------------------------

--
-- Table structure for table `carpooling`
--

CREATE TABLE `carpooling` (
  `id` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `establishment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `establishment`
--

CREATE TABLE `establishment` (
  `ID` int(11) NOT NULL,
  `region` varchar(128) CHARACTER SET utf8 NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `address` varchar(512) CHARACTER SET utf8 NOT NULL,
  `postal` int(5) NOT NULL,
  `city` varchar(128) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `establishment`
--

INSERT INTO `establishment` (`ID`, `region`, `name`, `address`, `postal`, `city`) VALUES
(1, 'Bretagne', 'Centre de Brest', '15 rue du Petit Spernot ', 29200, 'BREST'),
(2, 'Bretagne', 'Centre d\'Auray Saint Goustan', '12 rue de la promenade de Stanguy ', 56400, 'AURAY'),
(3, 'Bretagne', 'Centre d\'Auray Kervhal en Brech', 'Kervalh', 56400, 'AURAY'),
(4, 'Bretagne', 'Centre de Saint-Malo', '75 boulevard Gambetta ', 35400, 'ST MALO'),
(5, 'Bretagne', 'Centre de Saint-Brieuc Cote d\'Emeraude', '29 rue des Madieres ', 22360, 'LES GREVES LANGUEUX'),
(6, 'Bretagne', 'Centre de Rennes', '6 avenue du Haut Sance', 35000, 'RENNES'),
(7, 'Bretagne', 'Centre de Quimper', '25 27 rue de Saint Alor ', 29337, 'QUIMPER'),
(8, 'Bretagne', 'Centre de Morlaix', '39 rue de la Madeleine ', 29600, 'MORLAIX'),
(9, 'Bretagne', 'Centre de Loudeac', 'rue Chateaubriand', 22600, 'LOUEDAC'),
(10, 'Bretagne', 'Centre de Lorient', '32 rue René Lote', 56100, 'LORIENT'),
(11, 'Basse Normandie', 'Centre de Coutances', '83 avenue de la Republique', 50200, 'COUTANCES'),
(12, 'Basse Normandie', 'Centre de Cherbourg', 'rue Paul Nicolle', 50100, 'CHERBOURG EN COTENTIN');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `etablishment` int(11) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `telephone` int(10) DEFAULT NULL,
  `formation` int(11) DEFAULT NULL,
  `mail` varchar(256) DEFAULT NULL,
  `expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `etablishment`, `username`, `firstname`, `lastname`, `password`, `telephone`, `formation`, `mail`, `expire`) VALUES
(1, 8, 'Benjamin', 'Benjamin', 'GIRAUD', 'coucou', 0, 0, 'benjamingiraud29@hotmail.fr', '2017-07-04'),
(2, NULL, 'Alex', NULL, NULL, 'admin', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carpooling`
--
ALTER TABLE `carpooling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_establishmentID` (`establishment`),
  ADD KEY `FK_userID` (`user`);

--
-- Indexes for table `establishment`
--
ALTER TABLE `establishment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_etablishmentID` (`etablishment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carpooling`
--
ALTER TABLE `carpooling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `establishment`
--
ALTER TABLE `establishment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carpooling`
--
ALTER TABLE `carpooling`
  ADD CONSTRAINT `FK_establishmentID` FOREIGN KEY (`establishment`) REFERENCES `establishment` (`ID`),
  ADD CONSTRAINT `FK_userID` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_etablishmentID` FOREIGN KEY (`etablishment`) REFERENCES `establishment` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
