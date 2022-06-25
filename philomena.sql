-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 jun 2022 om 14:28
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `philomena`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `behandeling_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `time`, `status`, `user_id`, `med_id`, `behandeling_id`) VALUES
(1, '2022-06-22', '11:20:00', 0, 10, 22, 11),
(2, '2022-06-01', '23:20:00', 0, 10, 35, 10),
(3, '2022-06-01', '23:21:00', 0, 8, 35, 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `treatments`
--

CREATE TABLE `treatments` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `treatments`
--

INSERT INTO `treatments` (`id`, `type`, `category`, `name`, `price`) VALUES
(1, 'Nagels', 'Nieuwe set', 'Naturel : Gel /powergel / acryl', 50),
(2, 'Nagels', 'Nieuwe set', 'French manicure : gel / powergel/ acryl ', 55),
(3, 'Nagels', 'Nieuwe set', 'Gelpolish : gel/powergel/acryl ', 57.5),
(4, 'Nagels', 'Nabehandeling ', 'Naturel: gel / powergel/ acryl ', 32.5),
(5, 'Nagels', 'Nabehandeling ', 'French manicure: gel/powergel/acryl ', 35),
(6, 'Nagels', 'Nabehandeling ', 'Gelpolish: gel/powergel/acryl ', 37.5),
(7, 'Nagels', 'Nabehandeling ', 'Kunstnagels verwijderen ', 25),
(8, 'Nagels', 'Nabehandeling ', 'Gel op natuurlijke nagels ', 30),
(9, 'Nagels', 'Nabehandeling ', 'Gelpolish op natuurlijke nagels ', 25),
(10, 'Nagels', 'Handen', 'Manicure 30 min ', 17.5),
(11, 'Nagels', 'Handen', 'Gelpolish op natuurlijke nagels ', 25),
(12, 'Nagels', 'Handen', 'Manicure incl. gelpolish ', 35),
(13, 'Nagels', 'Voeten', 'Spa pedicure: eelt verwijderen en verzorging 30 min. ', 27.5),
(14, 'Nagels', 'Voeten', 'Gelpolish op tenen nagels ', 25),
(15, 'Nagels', 'Voeten', 'Gel met French manicure op teen nagels ', 35),
(16, 'Nagels', 'Voeten', 'Spa pedicure incl. Gelpolish ', 40),
(17, 'Haar', 'Dames', 'Knippen', 25),
(18, 'Haar', 'Dames', 'Knippen / drogen / zonder product', 28),
(19, 'Haar', 'Dames', 'Knippen / modelleren', 32),
(20, 'Haar', 'Dames', 'Wassen / knippen', 28),
(21, 'Haar', 'Dames', 'Wassen / knippen / drogen / zonder product', 31),
(22, 'Haar', 'Dames', 'Wassen / knippen / modelleren', 35),
(23, 'Haar', 'Heren', 'Knippen', 25),
(24, 'Haar', 'Heren', 'Wassen / knippen', 27.5),
(25, 'Haar', 'Kinderen t/m 11 jaar', 'Knippen', 18.5),
(26, 'Haar', 'Kinderen t/m 11 jaar', 'Wassen / knippen', 21.5),
(30, 'Haar', 'Kinderen t/m 11 jaar', 'Wassen / knippen', 24.5),
(31, 'Haar', 'Kinderen t/m 11 jaar', 'Wassen / knippen / drogen', 21.5),
(32, 'Haar', 'Kinderen 12 t/m 15 jaar', 'Knippen', 21.5),
(33, 'Haar', 'Kinderen 12 t/m 15 jaar', 'Wassen / knippen', 23.5),
(34, 'Haar', 'Kinderen 12 t/m 15 jaar', 'Wassen / knippen / drogen', 26.5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `living_place` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL DEFAULT current_timestamp(),
  `worker` int(1) NOT NULL DEFAULT 0,
  `login_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `street`, `postal_code`, `living_place`, `email`, `password`, `create_date`, `update_date`, `worker`, `login_token`) VALUES
(1, 'firstname', 'lastname', '', '', '', 'email', 'password', '2022-06-03 21:27:40', '2022-06-03 23:27:40', 0, 'logintoken'),
(2, 'firstname', 'lastname', '', '', '', 'email', 'password', '2022-06-03 21:40:11', '2022-06-03 23:40:11', 0, 'logintoken'),
(3, 'firstname', 'lastname', '', '', '', 'email', 'password', '2022-06-03 21:47:37', '2022-06-03 23:47:37', 0, 'logintoken'),
(8, 'asdniojufasbui', 'bnoujfsdbufds', '', '', '', 'jaco@jaco.jaco', '$2y$10$krIA6eHDbSELPNU4PAGjeudtqqv6vApncoTJssLJxtrbkVjog5E.O', '2022-06-04 01:06:22', '2022-06-24 11:06:02', 0, '$2y$10$UTu1QmSmbs5TYBFAiPLAeeXZbuPOUrd3euCqyx5NeEkXf7ynASPWi'),
(9, 'bihasdfiy', 'vyuvyygvu', '', '', '', 'mborijnland@rijnland.nl', '$2y$10$NqTzBDMeMlRAVB5wMaMUpu6bKQVxZNoKfQ3NzsDDWqwavD.McC8y6', '2022-06-04 01:06:46', '2022-06-23 11:06:53', 0, NULL),
(14, 'sdfbih', 'ibygh', '', '', '', 'bih@fdsdsfg.ff', '$2y$10$MXKDGAbviLOMKUyJDYtkt.VCPfzOX4gWJKbKaz/6r6KqgifAfr.ue', '2022-06-04 01:06:08', '2022-06-04 01:06:08', 0, NULL),
(15, 'sfdgdf', 'bbhu', '', '', '', 'bisfd@hdfhd.hg', '$2y$10$w4UsmpuBItwDBs0zur4KROzNEgzkRR7w3Ovxh6KQE8S2plwPdZnSi', '2022-06-04 01:06:24', '2022-06-04 01:06:24', 0, NULL),
(16, 'dgfgdf', 'uvygvtfyftyc', '', '', '', 'yutfv@bihbiysfd.fff', '$2y$10$Jhfnwn4/gY5hOgsA2AGLieJfSqIYAYHWGEAhGQJt/cE6RlJzVk.rm', '2022-06-04 01:06:00', '2022-06-04 01:06:00', 0, NULL),
(17, 'dgfhhfdg', 'biyhuhviby', '', '', '', 'biuibu@fgds.ghrd', '$2y$10$rg0wesdjzxwUFbAhwE3ZMub2hQdJWddLPQyWh8jNdtKU2fO9fIEIO', '2022-06-04 01:06:43', '2022-06-04 01:06:43', 0, NULL),
(18, 'sdfgfd', 'uvhgguy', '', '', '', 'ibbih@bibi.habibi', '$2y$10$CCKKMP0HVoBW73JPmd4dwe21eezE3Df3m/Y.e3dUSHIxv7wHI2glO', '2022-06-04 01:06:14', '2022-06-04 01:06:14', 0, NULL),
(19, 'sdfgfd', 'uvhgguy', '', '', '', 'dddwa@dawd.dd', '$2y$10$OMj0zGf2NRlCSAW7O8/b3OGQ11Eo3uKANK4AKG8jXv/sbKPMGKaiG', '2022-06-04 01:06:08', '2022-06-04 01:06:08', 0, NULL),
(20, 'sdfgfd', 'uvhgguy', '', '', '', 'dddwa@dagwd.dd', '$2y$10$oGLSCj7SEybvSTJVbGBHG.FJ7gWJI10/YfLMtiB2/P2IMTsgiF1oi', '2022-06-04 01:06:56', '2022-06-04 01:06:56', 0, NULL),
(21, 'sfdgfsd', 'gdsfgds', '', '', '', 'hfgd@jaco.jaco', '$2y$10$dLlQ1XQHX81NSt9gkdokrOJLwE0T/llCkDTb3nsgJMOw9aALKExTm', '2022-06-08 03:06:16', '2022-06-08 03:06:16', 0, NULL),
(22, 'dasdas', 'dasasfd', '', '', '', 'dasdf@fsafd.ff', '$2y$10$Y.7xagkd/Vs157iTLP6wQu6jWOpdda6sh3IrCKIy4uHsaUZv8ekCG', '2022-06-08 04:06:39', '2022-06-08 04:06:39', 0, NULL),
(23, 'dasdas', 'dasasfd', '', '', '', 'ghdfdfhhfgf@fsafd.ff', '$2y$10$i56YXhnzlmy3l/gwAaHtkeSHDg./SqpLciQbV6QTJKI0Crb4hEnEG', '2022-06-08 04:06:00', '2022-06-08 04:06:00', 0, NULL),
(24, 'fsdfgds', 'dhfgsdf', '', '', '', 'aswd@gfds.sdf', '$2y$10$6ZcKZhWHFhiZgzfMbJP8HOX7tqQ6SqFcGzYh.jxPzERlP2u1uzruy', '2022-06-08 05:06:40', '2022-06-08 05:06:40', 0, NULL),
(25, 'hvcdfgh', 'fssfd', '', '', '', '2r2@gmg.gg', '$2y$10$2PZqFwNpX5plv.UpdpEMw.JfGeGb5ikINBZQ979FocBvukR8HoyAO', '2022-06-08 05:06:52', '2022-06-08 05:06:52', 0, NULL),
(26, 'alert', 'csadsfsda', '', '', '', 'fasdsedgf@fwgfd.dgfd', '$2y$10$6Emj/GJQ23NM6YnLvdC5T.r8//byvNIni6MbbEaT3AIZ.HmGdO8Du', '2022-06-08 06:06:47', '2022-06-08 06:06:47', 0, NULL),
(27, 'eerstenaam', 'twedenam', 'strasse', 'fdfdfd', 'woonplaats', 'email@email.email', '$2y$10$n.Y2ByG1P0dVnu094HFC9.DEhYwFbAFppSbklXuFUFhOj6xbX3PIC', '2022-06-10 10:06:33', '2022-06-10 10:06:33', 0, NULL),
(28, 'dyctufsftd', 'GHFDGFH', 'gdfg', '2935XJ', 'fygtuftyui', 'guihy@fds.fds', '$2y$10$S1Rj9DcC0snGXz1FIrEKtOX8fbhT3PTqWrBJI.jDYySBO4vfaUW6G', '2022-06-10 11:06:54', '2022-06-10 02:06:32', 0, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
