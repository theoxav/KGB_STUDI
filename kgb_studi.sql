-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 22 fév. 2022 à 20:39
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kgb_studi`
--
-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `last_name`, `first_name`, `roles`, `password`, `created_at`, `updated_at`) VALUES
(2, 'johndoe@admin.com', 'Doe', 'John', '[\"ROLE_ADMIN\"]', '$2y$13$j3vEhEzAthLvbLVZqbNFy.w4.ll2klWyVdUQygdLKgVHJVSe5Y/Ca', '2022-02-20 09:05:02', '2022-02-20 09:05:02');

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `code_name`, `first_name`, `last_name`, `birthday`, `nationality`, `image_name`, `created_at`, `updated_at`) VALUES
(1, '007', 'James', 'Bond', '2022-02-20', 'England', NULL, '2022-02-20 09:03:33', '2022-02-22 15:26:39'),
(2, 'Captain America', 'Steve', 'Rogers', '2022-01-20', 'United-States', 'captain-america.jpg', '2022-02-20 09:03:33', '2022-02-22 15:27:00'),
(3, 'SanGoku', 'Kakarot', 'Goku', '2022-02-20', 'Japan', 'sangoku.png', '2022-02-20 09:03:33', '2022-02-22 15:26:22'),
(4, 'Wolverine', 'Hugh', 'Jackman', '2022-02-20', 'France', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33');

-- --------------------------------------------------------

--
-- Structure de la table `agent_skill`
--

CREATE TABLE `agent_skill` (
  `agent_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agent_skill`
--

INSERT INTO `agent_skill` (`agent_id`, `skill_id`) VALUES
(1, 2),
(1, 5),
(2, 1),
(2, 4),
(3, 1),
(3, 4),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `alias`, `first_name`, `last_name`, `birthday`, `nationality`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 'The Mole', 'Jean', 'Mark', '2022-02-20', 'France', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(2, 'L\'Americain', 'Kyle', 'Uper', '2022-02-20', 'United-States', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(3, 'l\'Anglais', 'Will', 'Nothing', '2022-02-20', 'England', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(4, 'Le Français', 'Mike', 'Paris', '2022-02-20', 'France', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'France', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(2, 'England', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(3, 'United-States', '2022-02-20 09:03:33', '2022-02-20 09:03:33');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220219130804', '2022-02-19 13:08:11', 444);

-- --------------------------------------------------------

--
-- Structure de la table `hideout`
--

CREATE TABLE `hideout` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hideout`
--

INSERT INTO `hideout` (`id`, `country_id`, `type_id`, `code`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Red', '16 rue des Coudriers Paris', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(2, 2, 2, 'Dark', 'Jenaer Strasse 82 Mulheim', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(3, 3, 3, 'Blue', '3660 Patterson Street Houston', '2022-02-20 09:03:33', '2022-02-20 09:03:33');

-- --------------------------------------------------------

--
-- Structure de la table `hideout_type`
--

CREATE TABLE `hideout_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hideout_type`
--

INSERT INTO `hideout_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Building', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(2, 'House', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(3, 'Villa', '2022-02-20 09:03:33', '2022-02-20 09:03:33');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `skills_id` int(11) NOT NULL,
  `hideout_id` int(11) NOT NULL,
  `mission_gender_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `country_id`, `skills_id`, `hideout_id`, `mission_gender_id`, `title`, `description`, `code_name`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 1, 1, 2, 'Teacher of Darkness', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lacinia eget nisl et aliquam. Pellentesque est tellus, vehicula sed posuere eu, ornare vel turpis. Sed vel ex venenatis, elementum nunc id, porta nunc. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus porttitor tincidunt venenatis. Praesent id tellus tellus. Nam tincidunt nunc sed justo tristique dictum. Cras a enim tellus. Etiam hendrerit nisi magna, quis iaculis sem consequat sit amet. Quisque faucibus dignissim ullamcorper. Ut venenatis elit ut aliquet porta. Vestibulum in augue sed libero vehicula porta. Donec venenatis odio a commodo hendrerit.', 'Blue', '2022-02-22', '2022-03-22', 'preparation');

-- --------------------------------------------------------

--
-- Structure de la table `mission_agent`
--

CREATE TABLE `mission_agent` (
  `mission_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission_agent`
--

INSERT INTO `mission_agent` (`mission_id`, `agent_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mission_contact`
--

CREATE TABLE `mission_contact` (
  `mission_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission_contact`
--

INSERT INTO `mission_contact` (`mission_id`, `contact_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `mission_gender`
--

CREATE TABLE `mission_gender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission_gender`
--

INSERT INTO `mission_gender` (`id`, `name`) VALUES
(1, 'Infiltration'),
(2, 'Assassination'),
(3, 'Monitoring'),
(4, 'Protection');

-- --------------------------------------------------------

--
-- Structure de la table `mission_target`
--

CREATE TABLE `mission_target` (
  `mission_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission_target`
--

INSERT INTO `mission_target` (`mission_id`, `target_id`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'fight', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(2, 'Kung-fu', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(3, 'precision', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(4, 'Speed', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(5, 'Thai-Shi', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(6, 'Thief', '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(7, 'Strength', '2022-02-20 09:03:33', '2022-02-20 09:03:33');

-- --------------------------------------------------------

--
-- Structure de la table `target`
--

CREATE TABLE `target` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `target`
--

INSERT INTO `target` (`id`, `alias`, `first_name`, `last_name`, `birthday`, `nationality`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 'The Joker', 'Joey', 'Kerr', '2022-02-20', 'United-States', 'jocker.png', '2022-02-20 09:03:33', '2022-02-22 15:18:37'),
(2, 'The Torche', 'Boby', 'Brown', '2022-02-20', 'England', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33'),
(3, 'Magneto', 'Jean', 'Pierre', '2022-02-20', 'France', NULL, '2022-02-20 09:03:33', '2022-02-20 09:03:33');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`);

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agent_skill`
--
ALTER TABLE `agent_skill`
  ADD PRIMARY KEY (`agent_id`,`skill_id`),
  ADD KEY `IDX_6793CC0F3414710B` (`agent_id`),
  ADD KEY `IDX_6793CC0F5585C142` (`skill_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `hideout`
--
ALTER TABLE `hideout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2C2FE159F92F3E70` (`country_id`),
  ADD KEY `IDX_2C2FE159C54C8C93` (`type_id`);

--
-- Index pour la table `hideout_type`
--
ALTER TABLE `hideout_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9067F23CF92F3E70` (`country_id`),
  ADD KEY `IDX_9067F23C7FF61858` (`skills_id`),
  ADD KEY `IDX_9067F23CE9982FD7` (`hideout_id`),
  ADD KEY `IDX_9067F23CB5BD57C9` (`mission_gender_id`);

--
-- Index pour la table `mission_agent`
--
ALTER TABLE `mission_agent`
  ADD PRIMARY KEY (`mission_id`,`agent_id`),
  ADD KEY `IDX_B61DC3A0BE6CAE90` (`mission_id`),
  ADD KEY `IDX_B61DC3A03414710B` (`agent_id`);

--
-- Index pour la table `mission_contact`
--
ALTER TABLE `mission_contact`
  ADD PRIMARY KEY (`mission_id`,`contact_id`),
  ADD KEY `IDX_DD5E7275BE6CAE90` (`mission_id`),
  ADD KEY `IDX_DD5E7275E7A1254A` (`contact_id`);

--
-- Index pour la table `mission_gender`
--
ALTER TABLE `mission_gender`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission_target`
--
ALTER TABLE `mission_target`
  ADD PRIMARY KEY (`mission_id`,`target_id`),
  ADD KEY `IDX_1E97F5B2BE6CAE90` (`mission_id`),
  ADD KEY `IDX_1E97F5B2158E0B66` (`target_id`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `hideout`
--
ALTER TABLE `hideout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `hideout_type`
--
ALTER TABLE `hideout_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `mission_gender`
--
ALTER TABLE `mission_gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent_skill`
--
ALTER TABLE `agent_skill`
  ADD CONSTRAINT `FK_6793CC0F3414710B` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6793CC0F5585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `hideout`
--
ALTER TABLE `hideout`
  ADD CONSTRAINT `FK_2C2FE159C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `hideout_type` (`id`),
  ADD CONSTRAINT `FK_2C2FE159F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `FK_9067F23C7FF61858` FOREIGN KEY (`skills_id`) REFERENCES `skill` (`id`),
  ADD CONSTRAINT `FK_9067F23CB5BD57C9` FOREIGN KEY (`mission_gender_id`) REFERENCES `mission_gender` (`id`),
  ADD CONSTRAINT `FK_9067F23CE9982FD7` FOREIGN KEY (`hideout_id`) REFERENCES `hideout` (`id`),
  ADD CONSTRAINT `FK_9067F23CF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `mission_agent`
--
ALTER TABLE `mission_agent`
  ADD CONSTRAINT `FK_B61DC3A03414710B` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B61DC3A0BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mission_contact`
--
ALTER TABLE `mission_contact`
  ADD CONSTRAINT `FK_DD5E7275BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DD5E7275E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mission_target`
--
ALTER TABLE `mission_target`
  ADD CONSTRAINT `FK_1E97F5B2158E0B66` FOREIGN KEY (`target_id`) REFERENCES `target` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1E97F5B2BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
