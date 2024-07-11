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
-- Bază de date: `fermddgw_chat`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `datames` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Eliminarea datelor din tabel `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `datames`) VALUES
(1, 56, 48, 'salut', '2024-07-07 19:45:03'),
(2, 16, 48, 'ce faci?', '2024-07-07 19:45:25'),
(3, 48, 16, 'Bine tu?', '2024-07-07 20:02:08'),
(4, 48, 48, 'salut', '2024-07-08 17:38:50'),
(5, 14, 48, 'salut', '2024-07-08 18:05:29'),
(6, 15, 16, 'salut', '2024-07-08 21:21:29'),
(7, 16, 15, 'salut', '2024-07-08 21:27:19'),
(8, 15, 16, 'da', '2024-07-08 21:37:15'),
(9, 15, 16, 'da', '2024-07-08 21:38:37'),
(10, 15, 16, 'cat ti-a luat?', '2024-07-08 22:26:00'),
(11, 16, 48, 'Esti online))?', '2024-07-08 22:28:10'),
(12, 16, 15, 'Destul de mult:))', '2024-07-08 22:30:36'),
(88, 15, 16, 'mergee', '2024-07-09 20:45:29'),
(87, 15, 16, 'salut', '2024-07-09 20:43:19'),
(85, 15, 16, 'sss', '2024-07-09 20:12:28'),
(84, 14, 16, 'salut', '2024-07-09 20:11:40'),
(86, 14, 16, 'ddd', '2024-07-09 20:17:42');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
