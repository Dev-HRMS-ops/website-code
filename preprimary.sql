-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2025 at 12:14 PM
-- Server version: 8.0.42
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fgeicggov_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `teacher_strength` int DEFAULT NULL,
  `student_strength` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `region_id` int NOT NULL,
  `is_college` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inst_code` varchar(50) DEFAULT NULL,
  `shift` enum('morning','evening') NOT NULL DEFAULT 'morning',
  `city` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`) VALUES
(391),
(394),
(395),
(396),
(399),
(400),
(401),
(414),
(420),
(427),
(231),
(232),
(233),
(237),
(239),
(240),
(241),
(242),
(243),
(247),
(248),
(249),
(250),
(255),
(257),
(258),
(259),
(261),
(262),
(263),
(264),
(265),
(266),
(268),
(270),
(273),
(364),
(365),
(367),
(371),
(377),
(165),
(166),
(167),
(169),
(185),
(190),
(192),
(193),
(194),
(206),
(207),
(208),
(209),
(214),
(218),
(219),
(220),
(221),
(224),
(379),
(380),
(381),
(387),
(388),
(389),
(9),
(12),
(13),
(14),
(18),
(23),
(31),
(87),
(89),
(90),
(92),
(94),
(100),
(108),
(155),
(156),
(158),
(159),
(160),
(49),
(51),
(52),
(56),
(57),
(59),
(60),
(61),
(66),
(68),
(135),
(137),
(138),
(142),
(143),
(144),
(145),
(146),
(147),
(149),
(151),
(153),
(154),
(116),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(34),
(38),
(39),
(41),
(42),
(43),
(112);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `institutions`
--
ALTER TABLE `institutions`
  ADD CONSTRAINT `institutions_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
