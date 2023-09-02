-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 25 juin 2023 à 18:43
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `elitehomes`
--

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `reservations_id` int(11) DEFAULT NULL,
  `statut_checklist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_id` (`properties_id`),
  KEY `reservations_id` (`reservations_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `maintenance_checklist`
--

DROP TABLE IF EXISTS `maintenance_checklist`;
CREATE TABLE IF NOT EXISTS `maintenance_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservations_id` int(11) DEFAULT NULL,
  `properties_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `cleaning` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pressing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_field` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Properties_id` (`properties_id`),
  KEY `Reservations_id` (`reservations_id`)
) ENGINE=MyISAM AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `maintenance_checklist`
--

INSERT INTO `maintenance_checklist` (`id`, `reservations_id`, `properties_id`, `note`, `cleaning`, `pressing`, `verification`, `inventary`, `status`, `date_field`) VALUES
(113, 37, 3, 'travaux sol', 'on', 'on', 'on', 'on', 'En cours', '2023-06-13 21:17:53'),
(119, 42, 1, 'travaux', 'on', 'on', 'on', 'on', 'En cours', '2023-06-14 13:12:46'),
(118, 43, 2, 'travaux plafond', 'on', 'on', 'on', 'on', 'En cours', '2023-06-14 09:45:11'),
(146, 78, 6, ' tuygkjgytftyhjilhjj', 'on', 'on', 'on', 'on', 'En cours', '2023-06-25 09:15:22'),
(145, 74, 6, 'jkbhfvbhjdbvjkddnkjsdnc', 'on', 'on', 'on', 'on', 'Ã€ faire', '2023-06-24 15:21:56'),
(144, 75, 7, 'travaux plafond', 'on', 'on', 'on', 'on', 'En cours', '2023-06-24 13:09:08'),
(143, 75, 7, 'travaux plafond', 'on', 'on', 'on', 'on', 'En cours', '2023-06-24 13:08:24'),
(142, 69, NULL, NULL, NULL, NULL, NULL, NULL, 'TerminÃ©', '2023-06-23 12:40:42'),
(139, 67, 1, 'travaux', 'on', 'on', 'on', 'on', 'Ã€ faire', '2023-06-21 08:18:22'),
(140, 69, 4, 'vbgfj,yyuitrye(toiuop', 'on', 'on', 'on', 'on', 'En cours', '2023-06-22 10:06:46'),
(141, 69, 6, 'travaux', 'on', 'on', 'on', 'on', 'En cours', '2023-06-23 08:01:15');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expeditor_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sending_date` date DEFAULT NULL,
  `reservations_id` int(11) DEFAULT NULL,
  `discr` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expeditor_id` (`expeditor_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `reservations_id` (`reservations_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `expeditor_id`, `receiver_id`, `content`, `sending_date`, `reservations_id`, `discr`) VALUES
(1, NULL, 9, NULL, NULL, NULL, 1),
(2, 5, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_id` (`properties_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id`, `properties_id`, `profil`, `description1`, `description2`, `description3`, `description4`) VALUES
(6, 6, 'paris1.jpg', 'paris1.jpg', 'paris1.jpg', 'paris1.jpg', 'paris1.jpg'),
(7, 7, 'paris2.jpg', 'paris2.jpg', 'paris2.jpg', 'paris2.jpg', 'paris2.jpg'),
(8, 8, 'paris3.jpg', 'paris3.jpg', 'paris3.jpg', 'paris3.jpg', 'paris3.jpg'),
(9, 9, 'paris4.jpg', 'paris4.jpg', 'paris4.jpg', 'paris4.jpg', 'paris4.jpg'),
(10, 10, 'paris5.jpg', 'paris5.jpg', 'paris5.jpg', 'paris5.jpg', 'paris5.jpg'),
(11, 11, 'paris6.jpg', 'paris6.jpg', 'paris6.jpg', 'paris6.jpg', 'paris6.jpg'),
(12, 12, 'paris7.jpg', 'paris7.jpg', 'paris7.jpg', 'paris7.jpg', 'paris7.jpg'),
(13, 13, 'paris8.jpg', 'paris8.jpg', 'paris8.jpg', 'paris8.jpg', 'paris8.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `includedServices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `availability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caracteristique` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surface` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `properties`
--

INSERT INTO `properties` (`id`, `name`, `position`, `district`, `capacity`, `includedServices`, `price`, `availability`, `category`, `caracteristique`, `surface`) VALUES
(12, 'Les Jardins Du Luxembourg', '5 Impasse Royer-Collard', '5', 10, 'conciergerie', '1300.00', 'free', 'couple', NULL, '40.00'),
(10, 'La Demeure Montaigne', '18 Rue Clément Marot', '8', 10, 'conciergerie', '1300.00', 'free', 'familial', NULL, '80.00'),
(13, 'Melia Paris Champs Elysées', '102 Avenue Victor Hugo', '16', 30, 'conciergerie', '1800.00', 'availability', 'familial', NULL, '80.00'),
(6, 'Le leopole', '56, boulevard Malesherbes, 75008', '8', 6, 'conciergerie', '5230.00', 'available', 'art contemporain ', '', '160.00'),
(7, 'Bollinger', '116 rue de Grenelle 75340 Paris Cedex 7', '7', 7, 'conciergerie', '5800.00', 'available', 'Antiquite', '', '237.00'),
(8, 'Le malinois', '78, rue Bonaparte 75270 Paris Cedex 6', '6', 2, 'conciergerie', '5800.00', 'available', 'Romantique', '', '150.00'),
(9, 'Le Rosier', '17 Rue Michel-Ange, 75016 Paris\n', '16', 8, 'conciergerie', '5800.00', 'available', 'famille', '', '123.00'),
(11, 'Drawing House', '21 Rue Vercingétorix,', '14', 20, 'chauffeur,aide ', '1500.00', 'availability', 'familial', NULL, '53.00');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `starts_at` date DEFAULT NULL,
  `ends_at` date DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passenger` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_id` (`properties_id`),
  KEY `users_id` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `properties_id`, `users_id`, `starts_at`, `ends_at`, `type`, `properties_name`, `passenger`, `option`) VALUES
(72, 6, 5, '2023-08-23', '2024-07-23', NULL, 'Le raciste', '15', 'ElitehomesESSENTIEL'),
(78, 9, 19, '2025-05-25', '2025-12-30', NULL, 'Le Rosier', '4', 'ElitehomesESSENTIEL'),
(77, 9, 19, '2023-06-24', '2023-06-24', NULL, 'Le Rosier', '5', 'ElitehomesESSENTIEL'),
(76, 4, 19, '2023-01-12', '2023-01-19', NULL, 'La louve  rouge', '1', 'ElitehomesPASS'),
(75, 4, 19, '2023-06-20', '2023-06-25', NULL, 'La louve  rouge', '5', 'ElitehomesPASS'),
(73, 4, 19, '2023-07-20', '2023-07-30', NULL, 'La louve  rouge', '4', 'ElitehomesVIP'),
(74, 6, 19, '2023-06-30', '2023-07-08', NULL, 'Le leopole', '1', 'ElitehomesESSENTIEL');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(50) NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('client','entretien','admin','superadmin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `birthday` date DEFAULT NULL,
  `status` enum('activé','désactivé') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activé',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `mail`, `password`, `phone`, `gender`, `roles`, `birthday`, `status`) VALUES
(19, 'joel', 'jeol', 'joel@gmail.com', '$2y$10$twicKP3pIzG2hJIioVpObemQat4t9BEscbHOnUoFCygIYxTcdcFZ2', 667195688, 'Male', 'client', '2005-06-11', 'activé'),
(18, 'KALLOGA', 'Sira', 'sira@gmail.com', '$2y$10$bYp0lUvgUblxFnffmSMQW.xFd7F.mrHOXSmjJC23RlNSGELkymqlC', 667195688, 'Female', 'superadmin', '2005-06-09', 'activé'),
(17, 'VOLATAHINDRAZANA', 'felicia', 'lahila@gmail.com', '$2y$10$YkJ28YQVh3gQg4alh0Hie.QEHSgE919HEPI4a5Hh98ytsTN2W.jVO', 667195688, 'Female', 'entretien', '2005-06-18', 'activé');

-- --------------------------------------------------------

--
-- Structure de la table `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `evidence` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_id` (`properties_id`),
  KEY `users_id` (`users_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
