-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 juil. 2024 à 16:25
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

DROP TABLE IF EXISTS `taches`;
CREATE TABLE IF NOT EXISTS `taches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `action` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_taches` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id`, `user_id`, `titre`, `action`, `date`, `updated_at`) VALUES
(39, 23, 'Tâche1', 1, '2024-07-23 22:00:00', '2024-07-22 14:04:01'),
(12, 20, 'SQL modifiée 1', 1, '2024-07-23 22:00:00', '2024-07-22 09:10:21'),
(11, 20, 'Evaluation', 1, NULL, '2024-07-16 10:24:11'),
(30, 13, 'Jouer au foot', 1, '2024-07-25 22:00:00', '2024-07-21 21:54:01'),
(8, 8, 'Courses', 0, '2024-07-17 22:00:00', '2024-07-16 05:44:36'),
(41, 23, 'Tâche3', 0, '2024-07-16 22:00:00', '2024-07-22 14:04:56'),
(14, 20, 'Symfony', 1, '2024-07-16 22:00:00', '2024-07-16 10:29:14'),
(15, 20, 'Linux', 0, '2024-07-06 22:00:00', '2024-07-16 10:29:56'),
(17, 20, 'SQL2', 1, '2024-07-10 22:00:00', '2024-07-16 10:30:57'),
(18, 20, 'test', 1, '2024-07-16 22:00:00', '2024-07-16 19:35:40'),
(19, 20, 'test', 1, '2024-07-16 22:00:00', '2024-07-16 19:36:05'),
(20, 20, 'test', 1, '2024-07-16 22:00:00', '2024-07-16 19:39:43'),
(21, 20, 'Bonjour', 1, '2024-07-29 22:00:00', '2024-07-19 14:51:50'),
(22, 20, 'test 3', 0, '2024-07-17 22:00:00', '2024-07-16 19:41:02'),
(23, 20, 'Voyager', 1, '2024-07-27 22:00:00', '2024-07-16 19:45:11'),
(24, 20, 'Foot', 0, '2024-07-16 22:00:00', '2024-07-16 19:58:44'),
(25, 13, 'Faire du basket', 1, '2024-07-20 22:00:00', '2024-07-18 19:27:51'),
(26, 13, 'Faire du SQL', 0, '2024-06-30 22:00:00', '2024-07-18 19:28:39'),
(28, 20, 'Sport ', 1, '2024-07-22 22:00:00', '2024-07-22 07:04:56'),
(38, 20, 'faire un tour', 0, '2024-07-25 22:00:00', '2024-07-22 12:19:20'),
(32, 13, 'Faire du menage', 1, '2024-07-23 22:00:00', '2024-07-22 07:00:12'),
(40, 23, 'Tâche2', 1, '2024-07-22 22:00:00', '2024-07-22 14:04:39'),
(35, 13, 'Javascript', 1, '2024-07-22 22:00:00', '2024-07-22 06:58:56'),
(42, 23, 'Tâche4', 0, '2024-07-29 22:00:00', '2024-07-22 14:05:32'),
(43, 23, 'Tâche5', 1, '2024-07-26 22:00:00', '2024-07-22 14:05:49'),
(44, 23, 'Tâche6', 0, '2024-07-28 22:00:00', '2024-07-22 14:06:05'),
(45, 28, 'Tache1', 1, '2024-07-23 22:00:00', '2024-07-22 20:16:15'),
(46, 28, 'Tache2', 1, '2024-07-25 22:00:00', '2024-07-22 20:16:42'),
(47, 28, 'Tache3', 0, '2024-07-16 22:00:00', '2024-07-22 20:17:17'),
(48, 28, 'Tache4', 0, '2024-07-28 22:00:00', '2024-07-22 20:17:41'),
(49, 28, 'Tache5', 0, '2024-07-27 22:00:00', '2024-07-22 20:18:06'),
(51, 22, 'EvaluationA', 1, '2024-07-24 22:00:00', '2024-07-23 08:17:44'),
(52, 22, 'EVAL PHP', 1, '2024-07-24 22:00:00', '2024-07-23 07:17:23'),
(55, 22, 'Test', 0, '2024-07-25 22:00:00', '2024-07-23 07:28:55'),
(66, 22, NULL, 0, NULL, '2024-07-23 11:38:41'),
(60, 22, NULL, 0, NULL, '2024-07-23 10:10:52'),
(61, 22, NULL, 0, NULL, '2024-07-23 10:11:08'),
(62, 22, NULL, 0, NULL, '2024-07-23 10:11:12'),
(63, 22, NULL, 0, NULL, '2024-07-23 10:11:58'),
(64, 22, NULL, 0, NULL, '2024-07-23 10:13:41'),
(65, 22, NULL, 0, NULL, '2024-07-23 10:13:44'),
(67, 22, NULL, 0, NULL, '2024-07-23 11:41:29'),
(68, 22, NULL, 0, NULL, '2024-07-23 11:41:39'),
(69, 22, NULL, 0, NULL, '2024-07-23 11:41:45'),
(71, 30, 'gdfghjk', 1, '2024-07-25 22:00:00', '2024-07-23 12:11:00'),
(72, 31, 'dfghjkl', 1, '2024-07-27 22:00:00', '2024-07-23 14:22:24'),
(73, 32, 'dfvb', 1, '2024-07-25 22:00:00', '2024-07-24 09:16:51'),
(74, 35, 'Bonj', 1, '2024-07-24 22:00:00', '2024-07-24 12:12:09');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `password`, `created_at`, `updated_at`) VALUES
(31, 'A', 'ab@a.com', '$2y$10$GaXq5Yg09WA..9T4cgf5m.c7QHBwiAcyb2uER4anideoJ0V6dSRqq', '2024-07-23 12:41:16', '2024-07-23 12:41:16'),
(32, 'A', 'aissa@a.fr', '$2y$10$idND3sgQHhiE3C5wl9o46uAp8DZhzjiG1vi3GY4OlRHPCE.xJAMEi', '2024-07-24 08:24:02', '2024-07-24 08:24:02'),
(21, 'Mariama', 'mari@hotmail.fr', '$2y$10$4WaGP7rQP0w/lWzlUvH3j.uckKmAmaWdml4ozbYAdJh0YhBL..eKq', '2024-07-18 19:23:16', '2024-07-18 19:23:16'),
(11, 'Hiba', 'hi@gmail.com', '$2y$10$wSfAol9JJlJ4eKF7lEvdEuwovl6CGabjs07dslvvC12qNuEVdhQvy', '2024-07-16 07:11:31', '2024-07-16 07:11:31'),
(33, 'az', 'az@a.com', '$2y$10$likcAhwgCfBrfP4e5mpBm.I330DDkERMS2MKk9X0F.z.d5oSZiPLK', '2024-07-24 08:51:14', '2024-07-24 08:51:14'),
(15, 'Mari', 'mari@hotmail.fr', '$2y$10$xE.iTbQzd0TgK3t7ig5Jk.l0OUsBfvC2CU.AmOun8Ro1yGyMS37e.', '2024-07-16 07:18:32', '2024-07-16 07:18:32'),
(16, 'Mari', 'mari@hotmail.fr', '$2y$10$HsVZaHuzWTGrw7k4f7TX4OT/611.ZxnDiOryIuGzcurYiiCfXWPMy', '2024-07-16 07:18:50', '2024-07-16 07:18:50'),
(17, 'Maria', 'maria@hotmail.com', '$2y$10$ULPALNCsXAq15.sXUaOrCOVl.on3mE9Z6U7/SGeNMQ.UvpjmarI22', '2024-07-16 07:20:47', '2024-07-16 07:20:47'),
(38, 'A', 'aissa@a.fr', '$2y$10$bv8NkQmlEVT5OwuQXRBwNOLkpuLIGLeHHIIhZMxgzpmOqICadqnLW', '2024-07-24 13:06:27', '2024-07-24 13:06:27'),
(26, 'test', 'te@m.c', '$2y$10$n.78VGmaC0BcJUWaO69XX.4JoElwfQzqQPMkBXVOjdZQsjwwhknJW', '2024-07-22 14:37:36', '2024-07-22 14:37:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;