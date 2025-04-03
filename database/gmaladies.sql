-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 avr. 2025 à 00:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gmaladies`
--

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `cne` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` enum('Homme','Femme') NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`cne`, `nom`, `prenom`, `date_naissance`, `sexe`, `adresse`, `telephone`, `user_id`) VALUES
('E234442', 'ilyass', 'ahmimi', '2004-03-21', 'Homme', 'rue mhamid 9', '047383932', 26),
('ED4000', 'Larbi', 'Larbi', '1977-01-01', 'Homme', 'jmaa lfna', '', 37),
('EE171717', 'badr', 'rafia', '2005-01-09', 'Femme', 'mhamid 7', '3456789', 32),
('EE178233', 'mohamed', 'jalim', '1989-09-01', 'Homme', 'askejour lot haha', '0639415941', 36),
('EE200', 'saadia', 'lok', '1992-03-13', 'Femme', 'inknow', '222222222', 35),
('EE202020', 'anass', 'awida', '2002-06-05', 'Homme', 'takotat mrrakech', '0765432567', 31),
('EE238754E', 'ayoub', 'amara', '2001-02-28', 'Homme', 'mhamid 9', '454768', 28),
('EE24242', 'badr', 'badr', '2006-03-28', 'Homme', 'rue massira', '65377986', 27),
('EE40234', 'abdo', 'abdo', '2012-02-01', 'Homme', 'mhamid', '456789', 30),
('EE73263', 'mohamad', 'sendopi', '2002-11-01', 'Homme', 'Rue lwidan', '063819372', 25),
('EEH34H4', 'habiba', 'homaiti', '2006-01-12', 'Femme', 'Rue massria', '0653929347', 23);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('patient','doctor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(21, 'mohamad@gmail.com', '$2y$10$v/Rqif6NAa5N3IVjyV3/FOqPfeAcGIt1Tp.cMMS5/pSShZXrIi54e', 'doctor'),
(23, 'habiba@gmail.com', '$2y$10$3K1eJlCkt2THd.rOuAzn1u0hAshhAygq/0CyvqFon1rQt2S3ioS7K', 'patient'),
(25, 'sendopi@gmail.com', '$2y$10$2rLBpkCZDBEeYR09iEqVj.iRkR.5vwkwLQYHQjPTwmSzGo98QDrTC', 'patient'),
(26, 'iyass@gmail.com', '$2y$10$/rbnOtqQ80VEw8.FcQih5OYz/Nd5f.AEOisj.qNgpRgJ3FqJvGwou', 'patient'),
(27, 'badr@gmail.com', '$2y$10$8m5b31tLP6bQhxb8r98xx.Fxg1gtJTORDtFkRaDpRbddqmaSA1OH.', 'patient'),
(28, 'ayoub@gmail.com', '$2y$10$/ReHRvOdvLOKtAH5uMZHuOdu8zCEbNgp0pluAl/FB3fln6beigRYS', 'patient'),
(30, 'abdo@gmail.com', '$2y$10$6nj55EwV7ZaS/GOTNmxE4uYBZmBXlV8MekBE4I5P34F3l3sN9DhO2', 'patient'),
(31, 'anass@gmail.com', '$2y$10$cR8aSRf.taePL610PekKQuAJ9gA.r18TED4xXDaUVmhUTgTGcae6y', 'patient'),
(32, 'rafia@gmail.com', '$2y$10$P0883oGCiUqzXaP.NBdHW.tjo/vD3Skn/MqyVl4XBdFwQoGpR8wsq', 'patient'),
(33, 'lamin@gmail.com', '$2y$10$3hXvvE1mdmwPgl9CzsinVuq/3ab8FJXyrCHRAV1SZGLe2.X1oNjyi', 'patient'),
(34, 'mohamadjalim05@gmail.com', '$2y$10$zjwk7Sci/s1a8QYeJTlOku2y7XW4Gtdm/b9IHHW.e8LCZUhwSy.eK', 'patient'),
(35, 'saadialok@gmail.Com', '$2y$10$TD3fESndGIOeBbyeBedy5erLw3oYm.iSj4IUlj8HYdFBtbnuinyq2', 'patient'),
(36, 'mohamadjalim50@gmail.com', '$2y$10$Hbv3A4PTsOffKhY741kFmO1Sn7oIbfXDYLSCO3pfOxR/ydOkhSZvS', 'patient'),
(37, 'Larbi@gmail.com', '$2y$10$ZGarMq7TGq6H9r32qw/LLedYnQMRURhyOTjp8ymCvm/8pkmuhLvrK', 'patient');

-- --------------------------------------------------------

--
-- Structure de la table `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(11) NOT NULL,
  `cne` varchar(20) DEFAULT NULL,
  `date_visite` date NOT NULL,
  `symptomes` text NOT NULL,
  `diagnostic` text NOT NULL,
  `traitement` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`cne`),
  ADD UNIQUE KEY `unique_user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `cne` (`cne`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`cne`) REFERENCES `patients` (`cne`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
