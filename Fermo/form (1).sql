-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: localhost:3306
-- Timp de generare: mai 30, 2024 la 01:54 PM
-- Versiune server: 10.6.17-MariaDB-cll-lve-log
-- Versiune PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `fermddgw_register`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `form`
--

CREATE TABLE `form` (
  `id` int(22) NOT NULL,
  `address` varchar(22) NOT NULL,
  `name` varchar(22) NOT NULL,
  `email` varchar(40) NOT NULL,
  `number` varchar(22) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `descriere` varchar(500) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `form`
--

INSERT INTO `form` (`id`, `address`, `name`, `email`, `number`, `pass`, `descriere`, `data`) VALUES
(14, 'Caras-Severin', 'Daniel', 'strufilip12@gmail.com', '0721732543', '$2y$10$pEIh7NdDE7v6NRjpfVsjW.0pHSJlx4ercvXrDKbs5C8Gch6YrKXGG', 'Ma numesc Daniel si vreau sa vand produse.', '2024-04-25'),
(15, 'Suceava', 'FILIP', 'ffcont2t@gmail.com', '1212121212', '$2y$10$pEIh7NdDE7v6NRjpfVsjW.0pHSJlx4ercvXrDKbs5C8Gch6YrKXGG', 'Ma numesc Filip si sunt fermier , am o ferma in Suceava.', '2024-04-28'),
(16, 'Sibiu', 'Amiel', 'Amiel@gmail.com', '0723434534', '$2y$10$pEIh7NdDE7v6NRjpfVsjW.0pHSJlx4ercvXrDKbs5C8Gch6YrKXGG', 'Ma numesc Amiel  si am o ferma mica. M-am alaturat acestui site pentru a imi putea vinde produsele.', '2024-05-01'),
(18, 'Teleorman', 'bacriti', 'bacriti@gmail.com', '0753826408', '$2y$10$pEIh7NdDE7v6NRjpfVsjW.0pHSJlx4ercvXrDKbs5C8Gch6YrKXGG', 'Salut sunt Stefan si vreau sa imi vand produsele de la ferma.', '2024-05-02'),
(19, 'Botosani', 'marcel', 'marcel@gmail.com', '0789546756', '$2y$10$pEIh7NdDE7v6NRjpfVsjW.0pHSJlx4ercvXrDKbs5C8Gch6YrKXGG', 'Ma cheama Marcel si as vrea sa gasesc cumparatorii pentru produsele mele.', '2024-05-04'),
(24, 'Braila', 'Robert', 'robbert1234@gmail.com', '0746325558', '$2y$10$ggIJT6aNm8x5iHjctC5zsu29NU0.Z1EQwBlOHzGuAiKcxfNd2YNd6', '', '2024-05-10'),
(26, 'Suceava', 'Adrian', 'natyman2003444@gmail.com', '0742038804', '$2y$10$GCE6gFTahKZHASBPngN4hOp7XdTk3MjIOpueE8FXGiKQjZSZk3o8m', '', '2024-05-10'),
(28, 'Bihor', 'Ion', 'ionionelionut@gmail.com', '0725648997', '$2y$10$jnVRifcXQ7Ld7qCH.N.B7ud2n1x7O3UILEvFK3otbGvpBaKCpUNJy', '', '2024-05-23'),
(46, 'Suceava', 'EliasLpc', 'lupancu.elias@ctradauti.ro', '0712345678', '$2y$10$DN0LhXDsRZ3Z7zjAl5eRz.BhSttKwgTFHXTSWYpLBx72x..LYd5xu', 'Fain site,I like it', '2024-05-30'),
(47, 'Galati', 'Lica Samadaul', 'licasamadaul.business@gmail.com', '0990348764', '$2y$10$VX.29U45FePaPDwB75sG9uwCIfwAKioLLLEf2KTDXABldO5Vm0tR.', 'Vand porci', '2024-05-30');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `form`
--
ALTER TABLE `form`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
