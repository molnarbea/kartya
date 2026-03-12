-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 14. 08:36
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `magyarkartya`
--
CREATE DATABASE IF NOT EXISTS `magyarkartya` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `magyarkartya`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `forma`
--

DROP TABLE IF EXISTS `forma`;
CREATE TABLE IF NOT EXISTS `forma` (
  `formaAzon` int(11) NOT NULL AUTO_INCREMENT,
  `ertek` int(11) NOT NULL,
  `szoveg` varchar(20) NOT NULL,
  PRIMARY KEY (`formaAzon`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `forma`
--

INSERT INTO `forma` (`formaAzon`, `ertek`, `szoveg`) VALUES
(1, 7, '7'),
(2, 8, '8'),
(3, 9, '9'),
(4, 10, '10'),
(5, 2, 'alsó'),
(6, 3, 'felső'),
(7, 4, 'király'),
(8, 11, 'ász');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kartya`
--

DROP TABLE IF EXISTS `kartya`;
CREATE TABLE IF NOT EXISTS `kartya` (
  `formaAzon` int(11) NOT NULL,
  `szinAzon` int(11) NOT NULL,
  PRIMARY KEY (`formaAzon`,`szinAzon`),
  KEY `formaAzon` (`formaAzon`),
  KEY `szinAzon` (`szinAzon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kartya`
--

INSERT INTO `kartya` (`formaAzon`, `szinAzon`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(8, 1),
(8, 2),
(8, 3),
(8, 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szin`
--

DROP TABLE IF EXISTS `szin`;
CREATE TABLE IF NOT EXISTS `szin` (
  `szinAzon` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(20) NOT NULL,
  `kep` varchar(20) NOT NULL,
  PRIMARY KEY (`szinAzon`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szin`
--

INSERT INTO `szin` (`szinAzon`, `nev`, `kep`) VALUES
(1, 'piros', 'piros.png'),
(2, 'tök', 'tok.png'),
(3, 'makk', 'makk.png'),
(4, 'zöld', 'zold.png');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kartya`
--
ALTER TABLE `kartya`
  ADD CONSTRAINT `kartya_ibfk_1` FOREIGN KEY (`szinAzon`) REFERENCES `szin` (`szinAzon`),
  ADD CONSTRAINT `kartya_ibfk_2` FOREIGN KEY (`formaAzon`) REFERENCES `forma` (`formaAzon`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
