-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 05:35 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
-- Table structure for table `appointments`
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

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`id`, `type`, `category`, `name`, `price`) VALUES
(1, 'Nagels', 'Nieuwe set', 'Naturel : Gel /powergel / acryl', '50'),
(2, 'Nagels', 'Nieuwe set', 'French manicure : gel / powergel/ acryl ', '55'),
(3, 'Nagels', 'Nieuwe set', 'Gelpolish : gel/powergel/acryl ', '58'),
(4, 'Nagels', 'Nabehandeling ', 'Naturel: gel / powergel/ acryl ', '33'),
(5, 'Nagels', 'Nabehandeling ', 'French manicure: gel/powergel/acryl ', '35'),
(6, 'Nagels', 'Nabehandeling ', 'Gelpolish: gel/powergel/acryl ', '38'),
(7, 'Nagels', 'Nabehandeling ', 'Kunstnagels verwijderen ', '25'),
(8, 'Nagels', 'Nabehandeling ', 'Gel op natuurlijke nagels ', '30'),
(9, 'Nagels', 'Nabehandeling ', 'Gelpolish op natuurlijke nagels ', '25'),
(10, 'Nagels', 'Handen', 'Manicure 30 min ', '18'),
(11, 'Nagels', 'Handen', 'Gelpolish op natuurlijke nagels ', '25'),
(12, 'Nagels', 'Handen', 'Manicure incl. gelpolish ', '35'),
(13, 'Nagels', 'Voeten', 'Spa pedicure: eelt verwijderen en verzorging 30 min. ', '28'),
(14, 'Nagels', 'Voeten', 'Gelpolish op tenen nagels ', '25'),
(15, 'Nagels', 'Voeten', 'Gel met French manicure op teen nagels ', '35'),
(16, 'Nagels', 'Voeten', 'Spa pedicure incl. Gelpolish ', '40'),
(17, 'Haar', 'Dames', 'Knippen', '25'),
(18, 'Haar', 'Dames', 'Knippen / drogen / zonder product', '28'),
(19, 'Haar', 'Dames', 'Knippen / modelleren', '32'),
(20, 'Haar', 'Dames', 'Wassen / knippen', '28'),
(21, 'Haar', 'Dames', 'Wassen / knippen / drogen / zonder product', '31'),
(22, 'Haar', 'Dames', 'Wassen / knippen / modelleren', '35'),
(23, 'Haar', 'Heren', 'Knippen', '25'),
(24, 'Haar', 'Heren', 'Wassen / knippen', '28'),
(25, 'Haar', 'Kinderen t/m 11 jaar', 'Knippen', '19'),
(26, 'Haar', 'Kinderen t/m 11 jaar', 'Wassen / knippen', '22'),
(30, 'Haar', 'Kinderen t/m 11 jaar', 'Wassen / knippen', '25'),
(31, 'Haar', 'Kinderen t/m 11 jaar', 'Wassen / knippen / drogen', '22'),
(32, 'Haar', 'Kinderen 12 t/m 15 jaar', 'Knippen', '22'),
(33, 'Haar', 'Kinderen 12 t/m 15 jaar', 'Wassen / knippen', '24'),
(34, 'Haar', 'Kinderen 12 t/m 15 jaar', 'Wassen / knippen / drogen', '27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `street`, `postal_code`, `living_place`, `email`, `password`, `create_date`, `update_date`, `worker`, `login_token`) VALUES
(17, 'dgfhhfdg', 'biyhuhviby', '', '', '', 'biuibu@fgds.ghrd', '$2y$10$rg0wesdjzxwUFbAhwE3ZMub2hQdJWddLPQyWh8jNdtKU2fO9fIEIO', '2022-06-04 01:06:43', '2022-06-04 01:06:43', 0, NULL),
(26, 'worker3', 'csadsfsda', '', '', '', 'fasdsedgf@fwgfd.dgfd', '$2y$10$6Emj/GJQ23NM6YnLvdC5T.r8//byvNIni6MbbEaT3AIZ.HmGdO8Du', '2022-06-08 06:06:47', '2022-06-08 06:06:47', 1, NULL),
(27, 'worker2', 'twedenam', 'strasse', 'fdfdfd', 'woonplaats', 'email@email.email', '$2y$10$n.Y2ByG1P0dVnu094HFC9.DEhYwFbAFppSbklXuFUFhOj6xbX3PIC', '2022-06-10 10:06:33', '2022-06-29 05:06:01', 1, NULL),
(28, 'worker1', 'GHFDGFH', 'gdfg', '2935XJ', 'fygtuftyui', 'guihy@fds.fds', '$2y$10$S1Rj9DcC0snGXz1FIrEKtOX8fbhT3PTqWrBJI.jDYySBO4vfaUW6G', '2022-06-10 11:06:54', '2022-06-10 02:06:32', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
