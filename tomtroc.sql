-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 03 juin 2026 à 22:30
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--
CREATE DATABASE IF NOT EXISTS `tomtroc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tomtroc`;

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_picture` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `author` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `fk_Id_User` int(11) NOT NULL,
  `status` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Id_User` (`fk_Id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `books`:
--   `fk_Id_User`
--       `users` -> `user_id`
--

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `cover_picture`, `title`, `author`, `description`, `fk_Id_User`, `status`) VALUES
(36, '1780516409_The Kinfolk Table.png', 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.           ', 24, 'disponible'),
(37, '1780516574_Esther.png', 'livre de test', 'testeur', 'qfqfvfqsdvs', 25, 'disponible'),
(38, 'livresVector.svg', 'test2', 'test2', '                        test222222222222222222', 25, 'disponible'),
(39, 'livresVector.svg', 'qzfqf', 'qzegv', '                   qvgqgv     ', 25, 'disponible'),
(40, 'livresVector.svg', 'qsegqzegqahhqe', 'qhzezghqeh', '                        qhehhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 25, 'disponible'),
(41, '1780517668_orgueil.jpg', 'Orgueil et préjugés', 'Jane Austen', '                        qsbgeqseg                        ', 24, 'disponible'),
(43, 'newBook.png', 'teste image defaut', 'test image defaut', '                       qgqegqs ', 24, 'disponible');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(255) NOT NULL,
  `message_date` datetime NOT NULL,
  `message_text` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `recipient_Id` (`recipient_id`),
  KEY `sender_Id` (`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `messages`:
--   `recipient_id`
--       `users` -> `user_id`
--   `sender_id`
--       `users` -> `user_id`
--

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `message_date`, `message_text`, `is_read`) VALUES
(71, 25, 24, '2026-06-03 21:57:26', 'Bonjour, il a l\'air bien ce livre vous l\'avez lu ?', 0),
(72, 25, 24, '2026-06-03 22:13:23', 'qsgesegsg', 0),
(73, 25, 24, '2026-06-03 22:13:26', 'egsg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `picture` varchar(256) NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `users`:
--

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `pseudo`, `email`, `password`, `picture`, `date_creation`) VALUES
(24, 'Alexlecture', 'Alexlecture@tomtroc.com', '$2y$10$E1NZOZ5wMeOrwvsHqoHBYecinorydd4NHcixuGywETP9MoLzL/lBi', 'defaultUser.png', '2026-06-03 21:51:53'),
(25, 'Nathalire', 'Nathalire@tomtroc.com', '$2y$10$JM3FDyteHxcYZm5rw/hYluK6dOAd9Fo9jzAFhkGJf3cCxDh1xBkgW', 'defaultUser.png', '2026-06-03 21:54:33');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_Id_User` FOREIGN KEY (`fk_Id_User`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `recipient_Id` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sender_Id` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
