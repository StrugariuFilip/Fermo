-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:3306
-- Timp de generare: iul. 11, 2024 la 04:57 AM
-- Versiune server: 10.6.18-MariaDB-cll-lve-log
-- Versiune PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `fermddgw_Oferte`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `oferte`
--

CREATE TABLE `oferte` (
  `id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `categorie` varchar(22) NOT NULL,
  `judet` varchar(22) NOT NULL,
  `address` varchar(50) NOT NULL,
  `imagine` longblob NOT NULL,
  `pret` varchar(22) NOT NULL,
  `cantitate` varchar(22) NOT NULL,
  `nume_utilizator` varchar(22) NOT NULL,
  `descriere` varchar(500) NOT NULL,
  `data` datetime NOT NULL,
  `email` varchar(40) NOT NULL,
  `number` varchar(22) NOT NULL,
  `report_count` int(11) DEFAULT 0,
  `report_users` text DEFAULT '[]',
  `rating_total` int(11) DEFAULT 0,
  `rating_count` int(11) DEFAULT 0,
  `rating_users` text DEFAULT '[]',
  `user_ratings` longtext DEFAULT NULL,
  `favorite` text DEFAULT '[]'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Indexuri pentru tabele `oferte`
--
ALTER TABLE `oferte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `oferte`
--
ALTER TABLE `oferte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
