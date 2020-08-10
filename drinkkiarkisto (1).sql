-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29.01.2019 klo 09:15
-- Palvelimen versio: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drinkkiarkisto`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `ainesosat`
--

CREATE TABLE `ainesosat` (
  `ID_auto` int(11) NOT NULL,
  `ainesosa` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `ainesosat`
--

INSERT INTO `ainesosat` (`ID_auto`, `ainesosa`) VALUES
(1, 'sokeri'),
(2, 'sokeri'),
(3, 'Vesi'),
(4, 'Ananasmehu'),
(5, 'Vodka'),
(6, 'Campari');

-- --------------------------------------------------------

--
-- Rakenne taululle `reseptit`
--

CREATE TABLE `reseptit` (
  `drinkkiID_auto` int(11) NOT NULL,
  `nimi` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `kuvaus` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `juomalaji` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `ohje` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `tarkistus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `reseptit`
--

INSERT INTO `reseptit` (`drinkkiID_auto`, `nimi`, `kuvaus`, `juomalaji`, `ohje`, `tarkistus`) VALUES
(1, 'vodka', 'mieto', 'vodka', '', NULL),
(2, 'vodka', 'mieto', 'vodka', 'sekoita', NULL);

-- --------------------------------------------------------

--
-- Rakenne taululle `rs_aines`
--

CREATE TABLE `rs_aines` (
  `ID` int(11) NOT NULL,
  `drinkkiID_auto` int(11) DEFAULT NULL,
  `Ainesosa` int(11) DEFAULT NULL,
  `Määrä` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `rs_aines`
--

INSERT INTO `rs_aines` (`ID`, `drinkkiID_auto`, `Ainesosa`, `Määrä`) VALUES
(1, 1, 2, '2'),
(2, 1, 4, '1'),
(3, 2, 2, '2'),
(4, 2, 4, '1');

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `Tunnus` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `Salasana` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `Sähköposti` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `Rooli` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`Tunnus`, `Salasana`, `Sähköposti`, `Rooli`) VALUES
('Kevin', 'benkonokevin@gmail.com', 'benkonokevin@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ainesosat`
--
ALTER TABLE `ainesosat`
  ADD PRIMARY KEY (`ID_auto`);

--
-- Indexes for table `reseptit`
--
ALTER TABLE `reseptit`
  ADD PRIMARY KEY (`drinkkiID_auto`);

--
-- Indexes for table `rs_aines`
--
ALTER TABLE `rs_aines`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `drinkkiID_auto` (`drinkkiID_auto`),
  ADD KEY `Ainesosa` (`Ainesosa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Tunnus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ainesosat`
--
ALTER TABLE `ainesosat`
  MODIFY `ID_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reseptit`
--
ALTER TABLE `reseptit`
  MODIFY `drinkkiID_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rs_aines`
--
ALTER TABLE `rs_aines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `rs_aines`
--
ALTER TABLE `rs_aines`
  ADD CONSTRAINT `rs_aines_ibfk_1` FOREIGN KEY (`drinkkiID_auto`) REFERENCES `reseptit` (`drinkkiID_auto`),
  ADD CONSTRAINT `rs_aines_ibfk_2` FOREIGN KEY (`Ainesosa`) REFERENCES `ainesosat` (`ID_auto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
