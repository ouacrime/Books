-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 11:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `adherent`
--

CREATE TABLE `adherent` (
  `idherent` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adherent`
--


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(47, 'Ayoub', 'ayoub07chater@gmail.com', '12345678'),
(53, 'Okabe', 'okabe.rintarou08@outlook.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `auteur`
--

CREATE TABLE `auteur` (
  `IdAuteur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nombreOeuvre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auteur`
--

INSERT INTO `auteur` (`IdAuteur`, `nom`, `prenom`, `nombreOeuvre`) VALUES
(121, 'othman', 'ouacrime', 3),
(122, 'Bertus', 'Aafjes', 2),
(123, 'Aakhus', 'Patricia', 1),
-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `noEmprunt` int(11) NOT NULL,
  `noExemplaire` int(11) NOT NULL,
  `dateRetour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emprunt`
--

CREATE TABLE `emprunt` (
  `noEmprunt` int(11) NOT NULL,
  `dateEmprunt` date DEFAULT NULL,
  `datePaiment` date DEFAULT NULL,
  `idherent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exemplaire`
--

CREATE TABLE `exemplaire` (
  `noExemplaire` int(11) NOT NULL,
  `dateAchat` date DEFAULT NULL,
  `pu` varchar(50) DEFAULT NULL,
  `noOeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exemplaire`
--

INSERT INTO `exemplaire` (`noExemplaire`, `dateAchat`, `pu`, `noOeuvre`) VALUES
(23, '2022-07-16', 'Relentless', 55),
(24, '2022-05-16', 'The Bench', 56),
(25, '2019-07-16', 'Odisha Itihaas', 58),
(31, '2022-07-28', 'Suparipalana', 60),
(32, '2022-07-16', 'Relentless', 55),
(33, '2022-07-16', 'Relentless', 55),
(34, '2022-07-16', 'Relentless', 55),
(35, '2022-07-16', 'Relentless', 55);

-- --------------------------------------------------------

--
-- Table structure for table `oeuvre`
--

CREATE TABLE `oeuvre` (
  `noOeuvre` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `dateParution` date DEFAULT NULL,
  `IdAuteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oeuvre`
--

INSERT INTO `oeuvre` (`noOeuvre`, `titre`, `dateParution`, `IdAuteur`) VALUES
(55, 'Lal Salam', '2022-07-14', 121),
(56, 'Queen of Fire', '2010-07-14', 122),
(57, 'The Maverick Effect', '2010-09-14', 123),
(58, 'Hear Yourself', '2019-09-29', 124),
(59, 'Tomb of Sand', '2017-09-23', 125),
(60, 'Monsoon', '2020-09-23', 121),
(61, 'Operation', '2020-09-23', 130),
(62, 'Operation', '2020-09-23', 130),
(63, 'Vahana Masterclass', '2020-10-23', 131),
(64, 'Vahana Masterclass', '2020-10-23', 131),
(65, 'Suparipalana', '2017-10-24', 134),
(66, 'Odisha Itihaas', '2012-06-24', 137),
(67, 'The Bench', '2022-07-09', 137),
(68, 'The Bench', '2022-07-09', 138),
(69, 'Relentless', '2021-07-09', 129),
(70, 'Relentless', '2021-07-09', 129),
(71, 'Relentless', '2022-07-21', 122),
(72, 'Relentless', '2022-07-21', 127);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`idherent`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`IdAuteur`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`noEmprunt`,`noExemplaire`),
  ADD KEY `noExemplaire` (`noExemplaire`);

--
-- Indexes for table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`noEmprunt`),
  ADD KEY `idherent` (`idherent`);

--
-- Indexes for table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD PRIMARY KEY (`noExemplaire`),
  ADD KEY `noOeuvre` (`noOeuvre`);

--
-- Indexes for table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD PRIMARY KEY (`noOeuvre`),
  ADD KEY `IdAuteur` (`IdAuteur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `idherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `IdAuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `noEmprunt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exemplaire`
--
ALTER TABLE `exemplaire`
  MODIFY `noExemplaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `oeuvre`
--
ALTER TABLE `oeuvre`
  MODIFY `noOeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`noEmprunt`) REFERENCES `emprunt` (`noEmprunt`),
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`noExemplaire`) REFERENCES `exemplaire` (`noExemplaire`);

--
-- Constraints for table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`idherent`) REFERENCES `adherent` (`idherent`);

--
-- Constraints for table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD CONSTRAINT `exemplaire_ibfk_1` FOREIGN KEY (`noOeuvre`) REFERENCES `oeuvre` (`noOeuvre`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `oeuvre`
--
ALTER TABLE `oeuvre`
  ADD CONSTRAINT `oeuvre_ibfk_1` FOREIGN KEY (`IdAuteur`) REFERENCES `auteur` (`IdAuteur`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
