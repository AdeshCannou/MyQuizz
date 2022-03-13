-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2022 at 07:24 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_8ADC54D5853CD175` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`, `reponse`, `image`, `created_at`) VALUES
(25, 25, 'A qui appartient ce logo ?', 'Twitch', 'telechargement-1-622e444d67496749110551.png', '2022-03-13 19:21:49'),
(26, 25, 'A qui appartient ce logo ?', 'GitHub', '25231-622e444d7f81f189525751.png', '2022-03-13 19:21:49'),
(27, 25, 'A qui appartient ce logo ?', 'PowerShell', '38a12fe9c0-450-622e444d80672494448229.png', '2022-03-13 19:21:49'),
(28, 25, 'A qui appartient ce logo ?', 'PlayStation', 'telechargement-2-622e444d816aa052941176.png', '2022-03-13 19:21:49'),
(29, 25, 'A qui appartient ce logo ?', 'McDonalds', 'telechargement-622e444d8241f918774420.png', '2022-03-13 19:21:49'),
(30, 26, '25*25', '625', NULL, '2022-03-13 19:23:50'),
(31, 26, '13*9', '117', NULL, '2022-03-13 19:23:50'),
(32, 26, '75*6', '450', NULL, '2022-03-13 19:23:50'),
(33, 26, '38*4', '152', NULL, '2022-03-13 19:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_A412FA92B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `created_by_id`, `title`, `description`, `created_at`) VALUES
(25, 2, 'Logo', 'Testé vous sur les logos du monde entier', '2022-03-13 19:21:49'),
(26, 1, 'Multiplication rapide', 'Testé votre capacité à résoudre des calculs en très peu de temps', '2022-03-13 19:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `family_name`, `email`, `password`) VALUES
(1, 'adesh91', 'adesh', 'cannou', 'adeshca156@gmail.com', '$2y$13$rkBYXClnmMzrbmq0nbb54uHcJU7kSmCWlA.oYG0v58EyCgOzs94jO'),
(2, 'Admin', 'Admin', 'Admin', 'root@root.fr', '$2y$13$wDIggwoibmyySMDIjNol7uTrQaK29yeiQhVXetnlK5oPcRaHUVUD.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_8ADC54D5853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `FK_A412FA92B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
