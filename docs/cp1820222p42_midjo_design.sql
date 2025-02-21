-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 20 fév. 2025 à 08:49
-- Version du serveur : 10.6.20-MariaDB-cll-lve
-- Version de PHP : 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cp1820222p42_midjo_design`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offre_abonnement_id` bigint(20) UNSIGNED NOT NULL,
  `date_debut` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_fin` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `montant` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonnements`
--

INSERT INTO `abonnements` (`id`, `offre_abonnement_id`, `date_debut`, `date_fin`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `montant`) VALUES
(1, 1, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-04-21 17:04:15', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(2, 2, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-04-22 12:38:23', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(3, 1, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-04-22 17:33:38', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(6, 1, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-05-18 11:28:48', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(7, 2, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-05-18 14:03:15', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(8, 1, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-06-03 09:00:58', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(9, 1, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-06-03 09:40:34', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(10, 1, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-06-03 14:11:26', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL),
(11, 2, '2025-01-02 09:13:26', '2025-12-31 23:00:00', 1, '2024-06-23 15:22:20', '2025-01-01 23:00:03', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `abonnement_entreprise`
--

CREATE TABLE `abonnement_entreprise` (
  `abonnement_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `abonnement_entreprise`
--

INSERT INTO `abonnement_entreprise` (`abonnement_id`, `entreprise_id`) VALUES
(1, 4),
(2, 6),
(3, 7),
(6, 11),
(6, 11),
(7, 12),
(7, 12),
(8, 13),
(8, 13),
(9, 13),
(9, 13),
(10, 14),
(10, 14),
(11, 15),
(11, 15);

-- --------------------------------------------------------

--
-- Structure de la table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_validite` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `annonceable_id` bigint(20) UNSIGNED NOT NULL,
  `annonceable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `ville_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quartier` varchar(255) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `titre`, `slug`, `type`, `description`, `date_validite`, `is_active`, `entreprise_id`, `annonceable_id`, `annonceable_type`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `image`, `ville_id`, `quartier`, `longitude`, `latitude`) VALUES
(1, '2 février', '2-fevrier', 'Auberge', NULL, '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\Auberge', '2023-12-12 13:27:24', '2024-02-03 21:15:40', NULL, 1, 2, NULL, 50, NULL, NULL, NULL, NULL),
(2, 'Onomo', 'onomo', 'Hôtel', NULL, '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\Hotel', '2023-12-12 13:28:07', '2024-03-24 10:51:35', NULL, 1, 1, NULL, 49, NULL, NULL, NULL, NULL),
(3, '907', '907', 'Boite de nuit', NULL, '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\BoiteDeNuit', '2023-12-12 13:29:36', '2024-02-03 21:11:30', NULL, 1, 2, NULL, 48, NULL, NULL, NULL, NULL),
(4, 'Le fleuron Tours', 'le-fleuron-tours', 'Hôtel', 'Étape incontournable, le business plan est le dossier de référence qui décrit les aspects clés d’un projet de création d’entreprise. Il fixe les objectifs de l’entreprise, les différentes stratégies de marketing mix, les ressources nécessaires et les étapes à suivre pour faire fructifier le projet.', '2025-12-31 00:00:00', 1, 15, 2, 'App\\Models\\Hotel', '2023-12-12 13:39:52', '2024-02-03 21:35:22', NULL, 1, 2, NULL, 36, NULL, NULL, NULL, NULL),
(5, 'Avanza', 'avanza', 'Location de véhicule', 'Quas molestias Nam t', '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\LocationVehicule', '2023-12-12 14:06:30', '2024-02-03 21:10:40', NULL, 1, 2, NULL, 47, NULL, NULL, NULL, NULL),
(6, 'Résidence Léandre', 'residence-leandre', 'Location meublée', 'Aperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui etAperiam nulla qui et', '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\LocationMeublee', '2023-12-12 14:35:41', '2024-03-25 16:03:09', NULL, 1, 2, NULL, 46, NULL, NULL, NULL, NULL),
(7, 'Patisserie God is Good', 'patisserie-god-is-good', 'Patisserie', 'Étape incontournable, le business plan est le dossier de référence qui décrit les aspects clés d’un projet de création d’entreprise. Il fixe les objectifs de l’entreprise, les différentes stratégies de marketing mix, les ressources nécessaires et les étapes à suivre pour faire fructifier le projet.', '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\Patisserie', '2023-12-31 15:29:45', '2024-03-25 16:01:50', NULL, 1, 2, NULL, 43, NULL, NULL, NULL, NULL),
(8, 'Toyota Yaris', 'toyota-yaris', 'Location de véhicule', 'Test de description', '2025-12-31 00:00:00', 1, 15, 2, 'App\\Models\\LocationVehicule', '2024-01-05 10:50:37', '2024-02-03 21:06:46', NULL, 2, 2, NULL, 44, NULL, NULL, NULL, NULL),
(9, 'Villa Dopio', 'villa-dopio', 'Location meublée', 'Cillum eos porro adi', '2025-12-31 00:00:00', 1, 15, 2, 'App\\Models\\LocationMeublee', '2024-01-20 10:11:00', '2024-02-03 21:08:13', NULL, 2, 2, NULL, 45, NULL, NULL, NULL, NULL),
(10, 'Akif', 'akif', 'Fast-Food', 'Venir manger comme à Mac Do', '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\FastFood', '2024-02-03 21:17:32', '2024-04-07 08:36:25', NULL, 2, 2, NULL, 36, NULL, NULL, NULL, NULL),
(11, 'Opium', 'opium', 'Bar', 'Test de description ici', '2025-12-31 00:00:00', 1, 15, 1, 'App\\Models\\Bar', '2024-02-03 21:24:28', '2024-02-03 21:24:28', NULL, 2, 2, NULL, 51, NULL, NULL, NULL, NULL),
(12, 'Monte Christo', 'monte-christo', 'Boite de nuit', NULL, '2025-12-31 00:00:00', 1, 15, 2, 'App\\Models\\BoiteDeNuit', '2024-02-03 21:26:01', '2024-03-09 20:00:06', NULL, 2, 1, NULL, 52, NULL, NULL, NULL, NULL),
(13, 'Location de véhicules ', 'location-de-vehicules', 'Location de véhicule', 'Ceci est un petit descriptif de l\'annonce', '2024-05-25 00:00:00', 0, 15, 3, 'App\\Models\\LocationVehicule', '2024-05-18 11:45:29', '2025-02-19 23:00:04', NULL, 7, 7, NULL, 78, NULL, NULL, NULL, NULL),
(14, 'Yaris', 'yaris', 'Location de véhicule', 'Texte de description....Texte de description....Texte de description....Texte de description....Texte de description....Texte de description....V', '2024-12-12 00:00:00', 0, 15, 4, 'App\\Models\\LocationVehicule', '2024-06-23 15:30:13', '2025-02-19 23:00:04', NULL, 15, 15, NULL, 81, NULL, NULL, NULL, NULL),
(15, 'Villa Léandre', 'villa-leandre', 'Location meublée', 'Texte de description...Texte de description...Texte de description...Texte de description...', '2024-12-12 00:00:00', 0, 15, 3, 'App\\Models\\LocationMeublee', '2024-06-23 15:33:43', '2025-02-19 23:00:04', NULL, 15, 15, NULL, 84, NULL, NULL, NULL, NULL),
(16, 'Resto 1', 'resto-1', 'Restaurant', 'Hic nesciunt molest', '2024-11-29 00:00:00', 0, 15, 1, 'App\\Models\\Restaurant', '2024-08-27 17:26:39', '2025-02-19 23:00:04', NULL, 1, 15, NULL, 94, NULL, NULL, NULL, NULL),
(17, 'Restaurant', 'restaurant', 'Restaurant', NULL, '2026-02-16 00:00:00', 1, 15, 2, 'App\\Models\\Restaurant', '2024-11-16 16:27:57', '2024-11-16 16:29:19', NULL, 21, 21, NULL, 98, NULL, NULL, NULL, NULL),
(18, 'Test', 'test', 'Auberge', 'Mon auberge test', '2025-01-02 00:00:00', 0, 1, 2, 'App\\Models\\Auberge', '2024-12-30 12:29:51', '2025-02-19 23:00:04', NULL, 21, 21, NULL, 99, NULL, NULL, NULL, NULL),
(19, 'Test 2', 'test-2', 'Auberge', 'Mon test auberge', '2025-01-05 00:00:00', 0, 2, 3, 'App\\Models\\Auberge', '2024-12-30 12:43:11', '2025-02-19 23:00:04', NULL, 21, 21, NULL, 106, NULL, NULL, NULL, NULL),
(20, 'Test 3', 'test-3', 'Auberge', 'Ma desctription', '2025-01-05 00:00:00', 0, 15, 4, 'App\\Models\\Auberge', '2024-12-30 12:46:41', '2025-02-19 23:00:04', NULL, 21, 21, NULL, 114, NULL, NULL, NULL, NULL),
(21, 'Villa bord de mer', 'villa-bord-de-mer', 'Location meublée', 'Magnifique villa de 170m2 avec vue sur mer. \n', '2025-03-30 00:00:00', 1, 15, 4, 'App\\Models\\LocationMeublee', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL, 121, NULL, NULL, NULL, NULL),
(22, 'Kobina', 'kobina', 'Boite de nuit', 'Viens danser !', '2025-08-29 00:00:00', 1, 15, 3, 'App\\Models\\BoiteDeNuit', '2024-12-30 17:09:47', '2024-12-30 17:09:47', NULL, 21, 21, NULL, 128, NULL, NULL, NULL, NULL),
(23, 'Oganou\'kéa', 'oganoukea', 'Auberge', 'Un auberge très discret...', '2025-04-13 00:00:00', 1, 12, 5, 'App\\Models\\Auberge', '2025-01-21 07:20:15', '2025-01-21 07:20:15', NULL, 21, 21, NULL, 134, NULL, NULL, NULL, NULL),
(24, 'Voluptatem est volup', 'voluptatem-est-volup', 'Fast-Food', '<p>Description de l\'annonce</p>', '2025-02-22 00:00:00', 1, 11, 2, 'App\\Models\\FastFood', '2025-01-22 11:34:55', '2025-01-22 11:34:55', NULL, 1, 1, NULL, 137, 1, NULL, NULL, NULL),
(25, 'Aspernatur eligendi ', 'aspernatur-eligendi', 'Restaurant', NULL, '2025-02-07 00:00:00', 0, 15, 3, 'App\\Models\\Restaurant', '2025-01-22 13:19:58', '2025-02-19 23:00:04', NULL, 1, 1, NULL, 138, 1, NULL, NULL, NULL),
(26, 'Velit non autem dolo', 'velit-non-autem-dolo', 'Restaurant', NULL, '2025-05-15 00:00:00', 1, 15, 4, 'App\\Models\\Restaurant', '2025-01-25 16:21:47', '2025-01-25 16:21:47', NULL, 1, 1, NULL, 142, 5, NULL, 1.50011444, 6.58855807),
(27, 'Ipsa quidem nesciun', 'ipsa-quidem-nesciun', 'Location de véhicule', '<p><br></p>', '2025-04-09 00:00:00', 1, 13, 5, 'App\\Models\\LocationVehicule', '2025-02-06 20:32:53', '2025-02-06 20:32:53', NULL, 1, 1, NULL, 143, 13, NULL, 1.28564930, 6.17946333),
(28, 'Et beatae quos ab no', 'et-beatae-quos-ab-no', 'Location de véhicule', '<p><br></p>', '2025-05-09 00:00:00', 1, 15, 6, 'App\\Models\\LocationVehicule', '2025-02-06 20:35:15', '2025-02-06 20:35:15', NULL, 1, 1, NULL, 144, 1, NULL, 1.24572945, 6.19611560),
(29, 'Ut incidunt aliquip', 'ut-incidunt-aliquip', 'Fast-Food', 'Quos voluptatibus ne', '2025-04-17 00:00:00', 1, 15, 3, 'App\\Models\\FastFood', '2025-02-16 07:40:17', '2025-02-16 11:14:10', NULL, 1, 1, NULL, 147, 1, 'Zanguéra', 1.32604977, 6.27161806);

-- --------------------------------------------------------

--
-- Structure de la table `annonce_fichier`
--

CREATE TABLE `annonce_fichier` (
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `fichier_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonce_fichier`
--

INSERT INTO `annonce_fichier` (`annonce_id`, `fichier_id`) VALUES
(1, 7),
(2, 9),
(2, 10),
(3, 11),
(5, 13),
(6, 14),
(6, 15),
(8, 30),
(9, 32),
(9, 33),
(4, 41),
(4, 42),
(7, 53),
(7, 54),
(7, 55),
(7, 56),
(7, 57),
(7, 58),
(12, 59),
(12, 60),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(13, 79),
(13, 80),
(14, 82),
(14, 83),
(15, 85),
(15, 86),
(15, 87),
(16, 95),
(16, 96),
(16, 97),
(18, 100),
(18, 101),
(18, 102),
(18, 103),
(18, 104),
(18, 105),
(19, 107),
(19, 108),
(19, 109),
(19, 110),
(19, 111),
(19, 112),
(19, 113),
(20, 115),
(20, 116),
(20, 117),
(20, 118),
(20, 119),
(20, 120),
(21, 122),
(21, 123),
(21, 124),
(21, 125),
(21, 126),
(21, 127),
(22, 129),
(22, 130),
(22, 131),
(22, 132),
(22, 133),
(23, 135),
(23, 136),
(29, 149);

-- --------------------------------------------------------

--
-- Structure de la table `annonce_reference_valeur`
--

CREATE TABLE `annonce_reference_valeur` (
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `reference_valeur_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonce_reference_valeur`
--

INSERT INTO `annonce_reference_valeur` (`titre`, `slug`, `annonce_id`, `reference_valeur_id`) VALUES
('Types de lit', 'types-de-lit', 23, 11),
('Commodités hébergement', 'commodites-hebergement', 23, 2),
('Commodités hébergement', 'commodites-hebergement', 23, 4),
('Commodités hébergement', 'commodites-hebergement', 23, 5),
('Services proposés', 'services-proposes', 23, 6),
('Services proposés', 'services-proposes', 23, 7),
('Equipements hébergement', 'equipements-hebergement', 23, 16),
('Equipements hébergement', 'equipements-hebergement', 23, 19),
('Equipements salle de bain', 'equipements-salle-de-bain', 23, 32),
('Equipements salle de bain', 'equipements-salle-de-bain', 23, 33),
('Equipements salle de bain', 'equipements-salle-de-bain', 23, 36),
('Equipements salle de bain', 'equipements-salle-de-bain', 23, 39),
('Equipements salle de bain', 'equipements-salle-de-bain', 23, 40),
('Equipements salle de bain', 'equipements-salle-de-bain', 23, 41),
('Accessoires de cuisines', 'accessoires-de-cuisines', 23, 46),
('Accessoires de cuisines', 'accessoires-de-cuisines', 23, 47),
('Accessoires de cuisines', 'accessoires-de-cuisines', 23, 48),
('Types hébergement', 'types-hebergement', 23, 59),
('Services proposés', 'services-proposes', 25, 126),
('Services proposés', 'services-proposes', 25, 127),
('Services proposés', 'services-proposes', 25, 128),
('Services proposés', 'services-proposes', 25, 130),
('Services', 'services', 26, 126),
('Services', 'services', 26, 128),
('Services', 'services', 26, 129),
('Services', 'services', 26, 130),
('Types de voiture', 'types-de-voiture', 27, 66),
('Options et accessoires', 'options-et-accessoires', 27, 77),
('Conditions de location', 'conditions-de-location', 27, 93),
('Types de voiture', 'types-de-voiture', 28, 69),
('Options et accessoires', 'options-et-accessoires', 28, 73),
('Conditions de location', 'conditions-de-location', 28, 93),
('Services', 'services', 29, 125),
('Services', 'services', 29, 128),
('Services', 'services', 29, 130);

-- --------------------------------------------------------

--
-- Structure de la table `auberges`
--

CREATE TABLE `auberges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_chambre` int(11) NOT NULL,
  `nombre_personne` int(11) DEFAULT NULL,
  `nombre_salles_bain` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `prix_min` int(11) DEFAULT NULL,
  `prix_max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auberges`
--

INSERT INTO `auberges` (`id`, `nombre_chambre`, `nombre_personne`, `nombre_salles_bain`, `superficie`, `prix_min`, `prix_max`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 2, 3, 2, 20000, 10000, 100000, '2023-12-12 13:27:24', '2024-02-03 21:15:40', NULL, 1, 2, NULL),
(2, 65, 5, 6, 102, 12, 15, '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(3, 8, NULL, NULL, NULL, NULL, NULL, '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(4, 6, NULL, NULL, NULL, NULL, NULL, '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(5, 12, 2, 3, NULL, 10000, 250000, '2025-01-21 07:20:14', '2025-01-21 07:20:14', NULL, 21, 21, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bars`
--

CREATE TABLE `bars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_bar` varchar(255) DEFAULT NULL,
  `type_musique` varchar(255) DEFAULT NULL,
  `capacite_accueil` varchar(255) DEFAULT NULL,
  `prix_min` int(11) DEFAULT NULL,
  `prix_max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bars`
--

INSERT INTO `bars` (`id`, `type_bar`, `type_musique`, `capacite_accueil`, `prix_min`, `prix_max`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, NULL, NULL, NULL, 10000, 110000, '2024-02-03 21:24:28', '2024-02-03 21:24:28', NULL, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `boite_de_nuits`
--

CREATE TABLE `boite_de_nuits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boite_de_nuits`
--

INSERT INTO `boite_de_nuits` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, '2023-12-12 13:29:36', '2023-12-12 13:29:36', NULL, 1, 1, NULL),
(2, '2024-02-03 21:26:01', '2024-02-03 21:26:01', NULL, 2, 2, NULL),
(3, '2024-12-30 17:09:47', '2024-12-30 17:09:47', NULL, 21, 21, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` double NOT NULL DEFAULT 0,
  `contenu` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `note`, `contenu`, `user_id`, `parent_id`, `annonce_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Permier commentaire', 2, NULL, 1, '2024-02-03 18:54:52', '2024-02-03 18:54:52', NULL),
(2, 0, 'deuxieme commentaire', 2, NULL, 2, '2024-02-03 18:54:52', '2024-02-03 18:54:52', NULL),
(3, 0, '3e commentaire', 2, NULL, 6, '2024-02-03 18:54:52', '2024-02-03 18:54:52', NULL),
(4, 4, 'Troisième commentaire', 1, NULL, 2, '2024-03-24 10:38:41', '2024-03-24 10:38:41', NULL),
(5, 5, 'What is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, NULL, 2, '2024-03-24 10:41:09', '2024-03-24 10:41:09', NULL),
(6, 2, 'Where can I get some?\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1, NULL, 2, '2024-03-24 10:42:32', '2024-03-24 10:42:32', NULL),
(7, 4, 'Bonjour, Un très bon établissement. Je recommande.', 2, NULL, 1, '2024-03-25 07:27:25', '2024-03-25 07:27:25', NULL),
(8, 4, 'Un très bon véhicules', 2, NULL, 5, '2024-03-25 07:30:26', '2024-03-25 07:30:26', NULL),
(9, 4, 'Test de commentaire', 2, NULL, 2, '2024-03-26 20:11:32', '2024-03-26 20:11:32', NULL),
(10, 4, 'CoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCoolCool', 2, NULL, 3, '2024-04-07 18:43:33', '2024-04-07 18:43:33', NULL),
(11, 4, 'Un très bon établissement....', 15, NULL, 15, '2024-06-23 15:38:32', '2024-06-23 15:38:32', NULL),
(12, 3, 'first comment', 1, NULL, 16, '2024-11-15 15:53:30', '2024-11-15 15:53:30', NULL),
(13, 5, 'Très bon restaurant!', 15, NULL, 17, '2024-11-17 09:45:32', '2024-11-17 09:45:32', NULL),
(14, 5, 'Très bon restaurant', 21, NULL, 17, '2024-11-19 19:15:37', '2024-11-19 19:15:37', NULL),
(15, 5, 'Test réussi ;)', 21, NULL, 20, '2024-12-30 12:49:39', '2024-12-30 12:49:39', NULL),
(16, 5, 'J\'adore !\n', 21, NULL, 21, '2024-12-30 16:26:17', '2024-12-30 16:26:17', NULL),
(17, 4, 'Ambiance de folie !', 21, NULL, 22, '2024-12-30 17:10:44', '2024-12-30 17:10:44', NULL),
(18, 5, 'Un très bon auberge...', 21, NULL, 23, '2025-01-21 07:32:45', '2025-01-21 07:32:45', NULL),
(19, 5, 'Bonjour, \nJe recommande.', 23, NULL, 28, '2025-02-11 08:28:16', '2025-02-11 08:28:16', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT 'slug',
  `description` text DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `quartier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `slug`, `description`, `site_web`, `email`, `telephone`, `instagram`, `facebook`, `whatsapp`, `logo`, `quartier_id`, `longitude`, `latitude`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Entreprise 1', 'entreprise-1', '', 'https://midjo.numrod.fr/', 'entreprise@gmail.com', '98 45 65 76', '', '', '90 64 34 64', '', 1, '1.153564453125', '8.6997077023509', '2023-12-12 08:38:49', '2024-02-03 21:41:26', NULL, 1, 2, NULL),
(2, 'Entreprise 2', 'entreprise-2', '', 'https://midjo.numrod.fr/', 'ab@a.sj', '98 75 45 45', 'https://www.instagram.com/Micode/?hl=fr', 'https://www.facebook.com/micodeyt/?locale=fr_FR', '98 75 75 75', '', 2, '0.72143577039242', '9.6757766943938', '2023-12-12 08:48:44', '2024-04-07 08:41:28', NULL, 1, 1, NULL),
(3, 'Dicta voluptatem Ni', 'dicta-voluptatem-ni', 'Cupidatat sit nihil ', 'Quia molestiae conse', 'hovaz@mailinator.com', '87 43 21 34', 'At aliquam et optio', 'Earum ad qui labore ', '90 90 87 65', '', 2, '1.197509765625', '7.9242542475044', '2024-02-06 21:32:10', '2024-02-06 21:32:10', NULL, 1, 1, NULL),
(4, 'Non', 'non', NULL, NULL, NULL, '90 90 90 90', NULL, NULL, '90 90 90 90', NULL, NULL, NULL, NULL, '2024-04-21 17:04:15', '2024-04-21 17:04:15', NULL, 3, 3, NULL),
(6, 'Proident ut sit ven', 'proident-ut-sit-ven', NULL, NULL, NULL, '+1 (911) 797-7161', NULL, NULL, 'Modi repudiandae bla', NULL, NULL, NULL, NULL, '2024-04-22 12:38:23', '2024-04-22 12:38:23', NULL, 4, 4, NULL),
(7, 'Afinon ETS', 'afinon-ets', NULL, NULL, NULL, '+22899897689', NULL, NULL, '+22899897689', NULL, NULL, NULL, NULL, '2024-04-22 17:33:38', '2024-04-22 17:33:38', NULL, 5, 5, NULL),
(11, 'Nemo irure perferend', 'nemo-irure-perferend', NULL, NULL, 'billson@gmail.com', '12 62 97 45', NULL, NULL, '46 54 65 46', NULL, 1, '1.033005310527', '7.5890399487676', '2024-05-18 11:28:48', '2024-05-18 11:33:29', NULL, NULL, 7, NULL),
(12, 'Midjoyi', 'midjoyi', 'Ici, c\'est la description de mon entreprise.', 'www.auberge.fr', 'matyanika@gmail.com', '+228 93 67 35 76', NULL, NULL, '+228 93 67 35 76', NULL, 2, '1.207838963333', '6.1888646926957', '2024-05-18 14:03:15', '2025-01-21 07:28:00', NULL, NULL, 21, NULL),
(13, 'Entreprise 90', 'entreprise-90', NULL, NULL, NULL, '93 67 35 77', NULL, NULL, '98 94 94 98', NULL, NULL, NULL, NULL, '2024-06-03 09:00:58', '2024-06-03 09:00:58', NULL, NULL, NULL, NULL),
(14, 'Entreprise 19', 'entreprise-19', NULL, NULL, NULL, '98 65 32 12', NULL, NULL, '97 85 63 21', NULL, NULL, NULL, NULL, '2024-06-03 14:11:26', '2024-06-03 14:11:26', NULL, NULL, NULL, NULL),
(15, 'NUMROD', 'numrod', 'Texte de description ', 'www.midjo.fr', 'koko@decathlon.fr', '90 37 74 13', NULL, 'facebook.com', '90 37 74 13', NULL, 1, '1.2222167893454', '6.374261323941', '2024-06-23 15:22:20', '2025-02-16 12:24:18', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise_user`
--

CREATE TABLE `entreprise_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_debut` timestamp NULL DEFAULT NULL,
  `date_fin` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise_user`
--

INSERT INTO `entreprise_user` (`id`, `entreprise_id`, `user_id`, `is_admin`, `is_active`, `date_debut`, `date_fin`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 4, 3, 1, 1, '2024-04-21 17:04:15', NULL, '2024-04-21 17:04:15', '2024-04-21 17:04:15', NULL, NULL, NULL, NULL),
(2, 6, 4, 1, 1, '2024-04-22 12:38:23', NULL, '2024-04-22 12:38:23', '2024-04-22 12:38:23', NULL, NULL, NULL, NULL),
(3, 7, 5, 1, 1, '2024-04-22 17:33:38', NULL, '2024-04-22 17:33:38', '2024-04-22 17:33:38', NULL, NULL, NULL, NULL),
(7, 11, 7, 1, 1, '2024-05-18 11:28:48', NULL, '2024-05-18 11:28:48', '2024-05-18 11:28:48', NULL, NULL, NULL, NULL),
(8, 12, 9, 1, 1, '2024-05-18 14:03:15', NULL, '2024-05-18 14:03:15', '2024-05-18 14:03:15', NULL, NULL, NULL, NULL),
(9, 13, 12, 1, 1, '2024-06-03 09:00:58', NULL, '2024-06-03 09:00:58', '2024-06-03 09:00:58', NULL, NULL, NULL, NULL),
(10, 14, 13, 1, 1, '2024-06-03 14:11:26', NULL, '2024-06-03 14:11:26', '2024-06-03 14:11:26', NULL, NULL, NULL, NULL),
(11, 15, 15, 1, 1, '2024-06-23 15:22:20', NULL, '2024-06-23 15:22:20', '2024-06-23 15:22:20', NULL, NULL, NULL, NULL),
(12, 15, 1, 1, 1, '2025-01-25 16:24:28', NULL, '2025-01-25 16:24:28', '2025-01-25 16:24:28', NULL, 1, 1, 1),
(13, 15, 1, 9, 1, '2025-01-25 16:24:28', NULL, '2025-01-25 16:24:28', '2025-01-25 16:24:28', NULL, 1, 1, 1),
(14, 15, 1, 21, 1, '2025-01-25 16:24:28', NULL, '2025-01-25 16:24:28', '2025-01-25 16:24:28', NULL, 1, 1, 1),
(15, 15, 2, 1, 1, '2025-01-25 16:24:28', NULL, '2025-01-25 16:24:28', '2025-01-25 16:24:28', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fast_foods`
--

CREATE TABLE `fast_foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `nom_produit` varchar(255) DEFAULT NULL,
  `accompagnement_produit` varchar(255) DEFAULT NULL,
  `prix_produit` varchar(255) DEFAULT NULL,
  `image_produit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fast_foods`
--

INSERT INTO `fast_foods` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `nom_produit`, `accompagnement_produit`, `prix_produit`, `image_produit`) VALUES
(1, '2024-02-03 21:17:32', '2024-02-03 21:17:32', NULL, 2, 2, NULL, NULL, NULL, NULL, NULL),
(2, '2025-01-22 11:34:55', '2025-01-22 11:34:55', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(3, '2025-02-16 07:40:17', '2025-02-16 11:10:41', NULL, 1, 1, NULL, 'Produit 1|||Second produit|||Produit 3|||', 'Acmp 1, Acmp 2|||Les accompagnements du produit|||Accompagnements liste|||', '1500|||2500|||3500|||', '145,146,150,');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `user_id`, `annonce_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-01-28 19:28:17', '2024-01-28 19:28:17'),
(2, 1, 2, '2024-01-28 19:28:22', '2024-01-28 19:28:22'),
(3, 2, 1, '2024-01-29 20:24:05', '2024-02-03 20:50:59'),
(4, 2, 2, '2024-01-29 20:24:07', '2024-02-03 20:52:45'),
(5, 2, 5, '2024-01-29 20:24:09', '2024-01-29 20:24:09'),
(6, 2, 7, '2024-02-02 16:43:13', '2024-02-02 16:43:13'),
(9, 2, 1, '2024-02-03 20:51:01', '2024-02-03 20:51:01'),
(10, 2, 2, '2024-02-03 20:52:46', '2024-02-03 20:52:46'),
(11, 2, 4, '2024-02-03 21:40:12', '2024-02-03 21:40:12'),
(12, 15, 15, '2024-06-23 15:35:15', '2024-06-23 15:35:40'),
(14, 1, 15, '2024-07-11 13:55:38', '2024-07-11 13:55:38'),
(15, 1, 8, '2024-07-11 13:55:49', '2024-07-11 13:55:49'),
(16, 1, 14, '2024-07-20 12:19:12', '2024-07-20 12:19:12'),
(17, 16, 15, '2024-07-20 12:28:27', '2024-07-20 12:28:27'),
(18, 21, 8, '2024-11-17 09:39:23', '2024-11-17 09:39:23'),
(20, 1, 9, '2024-12-21 21:00:31', '2024-12-21 21:00:31'),
(22, 21, 9, '2024-12-27 20:57:44', '2024-12-27 20:57:44'),
(23, 21, 12, '2024-12-28 11:00:24', '2024-12-28 11:00:24'),
(24, 21, 4, '2024-12-29 21:51:00', '2024-12-29 21:51:00'),
(25, 21, 5, '2024-12-30 08:58:05', '2024-12-30 08:58:05'),
(26, 21, 20, '2024-12-30 12:53:54', '2024-12-30 12:53:54'),
(29, 21, 21, '2025-01-03 16:58:42', '2025-01-03 16:58:42'),
(30, 21, 23, '2025-01-21 07:33:35', '2025-01-21 07:33:35');

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE `fichiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fichiers`
--

INSERT INTO `fichiers` (`id`, `nom`, `chemin`, `extension`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, '6hGHKftV69BAnmhMdPzSaY7rBdyMLmslm0iZ56LF.jpg', 'annonces/6hGHKftV69BAnmhMdPzSaY7rBdyMLmslm0iZ56LF.jpg', 'jpg', '2023-12-12 13:27:24', '2023-12-12 13:27:24', NULL, 1, 1, NULL),
(2, 'Qd4PChYOGe1bVM4H0I5IDC5hMHyeE7JvC4RZ1S9T.jpg', 'hotels/Qd4PChYOGe1bVM4H0I5IDC5hMHyeE7JvC4RZ1S9T.jpg', 'jpg', '2023-12-12 13:28:07', '2023-12-12 13:28:07', NULL, 1, 1, NULL),
(3, 'dqQfmjU4uyXOklBTeKv5qxTlFGPBfyAxtxrXvrCt.jpg', 'boite-de-nuits/dqQfmjU4uyXOklBTeKv5qxTlFGPBfyAxtxrXvrCt.jpg', 'jpg', '2023-12-12 13:29:36', '2023-12-12 13:29:36', NULL, 1, 1, NULL),
(4, 'Vp0rdoUqgVHjylVlQD4WRqmmWyLctUiIiDgZW3UI.jpg', 'boite-de-nuits/Vp0rdoUqgVHjylVlQD4WRqmmWyLctUiIiDgZW3UI.jpg', 'jpg', '2023-12-12 13:29:36', '2023-12-12 13:29:36', NULL, 1, 1, NULL),
(5, '4AXx4khx0YaZVXAE3FvxPAeBfYwvdtxN2ytQkK38.jpg', 'hotels/4AXx4khx0YaZVXAE3FvxPAeBfYwvdtxN2ytQkK38.jpg', 'jpg', '2023-12-12 13:39:52', '2023-12-12 13:39:52', NULL, 1, 1, NULL),
(6, 'xHjmUeM6qCDwAohqaApaZYSETQMpiD1TBqmTkcv6.jpg', 'location-vehicules/xHjmUeM6qCDwAohqaApaZYSETQMpiD1TBqmTkcv6.jpg', 'jpg', '2023-12-12 14:06:30', '2023-12-12 14:06:30', NULL, 1, 1, NULL),
(7, 'aCV1DKrymngeDGY0YfBSmRSYBBWmhjN1paNSGfAb.jpg', 'annonces/aCV1DKrymngeDGY0YfBSmRSYBBWmhjN1paNSGfAb.jpg', 'jpg', '2023-12-12 14:18:06', '2023-12-12 14:18:06', NULL, 1, 1, NULL),
(8, 'tI6rMKO1yv3LDX6zMQgu47hTf625WnGcXAMoDqyV.jpg', 'hotels/tI6rMKO1yv3LDX6zMQgu47hTf625WnGcXAMoDqyV.jpg', 'jpg', '2023-12-12 14:19:01', '2023-12-12 14:19:01', NULL, 1, 1, NULL),
(9, 'i0VbIRAvslwBBCJk1HcE506s3eVIhtbcp0zfmMxc.jpg', 'hotels/i0VbIRAvslwBBCJk1HcE506s3eVIhtbcp0zfmMxc.jpg', 'jpg', '2023-12-12 14:19:33', '2023-12-12 14:19:33', NULL, 1, 1, NULL),
(10, 'GxpjmNIAFC8Rb2JQJaAoHA8u2hNTT1O2BzpkIwPx.jpg', 'hotels/GxpjmNIAFC8Rb2JQJaAoHA8u2hNTT1O2BzpkIwPx.jpg', 'jpg', '2023-12-12 14:19:33', '2023-12-12 14:19:33', NULL, 1, 1, NULL),
(11, 'PBiPZvsvzsn5tUDX849o9CgdyME0HzxCShyZwPl4.jpg', 'boite-de-nuits/PBiPZvsvzsn5tUDX849o9CgdyME0HzxCShyZwPl4.jpg', 'jpg', '2023-12-12 14:20:10', '2023-12-12 14:20:10', NULL, 1, 1, NULL),
(12, 'LPJLgbBokQvm9b9VIKKCxtmyVN1ixnjSEhqqTGDr.png', 'hotels/LPJLgbBokQvm9b9VIKKCxtmyVN1ixnjSEhqqTGDr.png', 'png', '2023-12-12 14:20:48', '2023-12-12 14:20:48', NULL, 1, 1, NULL),
(13, '96eJPfRE17H5N6kdLX2VZCzX3zyHM6rwvYnBLg0K.png', 'location-vehicules/96eJPfRE17H5N6kdLX2VZCzX3zyHM6rwvYnBLg0K.png', 'png', '2023-12-12 14:22:14', '2023-12-12 14:22:14', NULL, 1, 1, NULL),
(14, 'DOlLyHR0KpUBmSzJ9UFPq2drMHG998V1F6E5Xc6e.jpg', 'location-meublees/DOlLyHR0KpUBmSzJ9UFPq2drMHG998V1F6E5Xc6e.jpg', 'jpg', '2023-12-12 14:35:41', '2023-12-12 14:35:41', NULL, 1, 1, NULL),
(15, 'fT4WNuoXUku8PuNQjL8LCH8iN9zdAdgDZLO1FKxH.jpg', 'location-meublees/fT4WNuoXUku8PuNQjL8LCH8iN9zdAdgDZLO1FKxH.jpg', 'jpg', '2023-12-12 14:35:41', '2023-12-12 14:35:41', NULL, 1, 1, NULL),
(16, 'd47bAB2sUZPowXosjXW3Oy6hz2FUFjYxgX081uem.svg', 'patisseries/d47bAB2sUZPowXosjXW3Oy6hz2FUFjYxgX081uem.svg', 'svg', '2023-12-31 15:29:45', '2023-12-31 15:29:45', NULL, 1, 1, NULL),
(17, 'fv9C1Wka0sWPzbC3a1cImybkWNYcnc22RGd79Pb4.png', 'patisseries/fv9C1Wka0sWPzbC3a1cImybkWNYcnc22RGd79Pb4.png', 'png', '2023-12-31 15:33:27', '2023-12-31 15:33:27', NULL, 1, 1, NULL),
(18, 'd0wxaCAgelsFBDVUSDiuYUIn16VtJ81SN0sJhmlT.png', 'patisseries/d0wxaCAgelsFBDVUSDiuYUIn16VtJ81SN0sJhmlT.png', 'png', '2023-12-31 16:52:57', '2023-12-31 16:52:57', NULL, 1, 1, NULL),
(19, 'alJFRCqPint02jleXj7oBXV9qbMbRfmmUnYjOMo6.jpg', 'patisseries/alJFRCqPint02jleXj7oBXV9qbMbRfmmUnYjOMo6.jpg', 'jpg', '2024-01-05 10:46:30', '2024-01-05 10:46:30', NULL, 2, 2, NULL),
(20, 'afrLhUFiS5lsBWp7GAh02guhwHdK7Q5fU26FtKXy.jpg', 'LocationMeublees/afrLhUFiS5lsBWp7GAh02guhwHdK7Q5fU26FtKXy.jpg', 'jpg', '2024-01-20 10:03:23', '2024-01-20 10:03:23', NULL, 2, 2, NULL),
(21, 'ogSegXjxbf8q7OlzIrYx4J8Eyl87x7lkWTSCUzET.jpg', 'hotels/ogSegXjxbf8q7OlzIrYx4J8Eyl87x7lkWTSCUzET.jpg', 'jpg', '2024-01-20 10:07:00', '2024-01-20 10:07:00', NULL, 2, 2, NULL),
(22, 'KINj8jDebiygd1HNvWQN3I4RAFBlTOVCo7ic38Om.jpg', 'location-vehicules/KINj8jDebiygd1HNvWQN3I4RAFBlTOVCo7ic38Om.jpg', 'jpg', '2024-01-20 10:07:26', '2024-01-20 10:07:26', NULL, 2, 2, NULL),
(23, 'qXadycAlI3QykKpQBgOJUHkQ4xI18PFzHtTvdBq9.webp', 'location-meublees/qXadycAlI3QykKpQBgOJUHkQ4xI18PFzHtTvdBq9.webp', 'webp', '2024-01-20 10:11:00', '2024-01-20 10:11:00', NULL, 2, 2, NULL),
(24, 'IHZLHMzIwYBEAotMw9YpDZbPKDSX87cbzseIf2im.jpg', 'location-meublees/IHZLHMzIwYBEAotMw9YpDZbPKDSX87cbzseIf2im.jpg', 'jpg', '2024-01-20 10:11:00', '2024-01-20 10:11:00', NULL, 2, 2, NULL),
(25, 'pbZEuGO2TKsLaylgWb94YhJTayH5yLM45432I4h8.webp', 'location-meublees/pbZEuGO2TKsLaylgWb94YhJTayH5yLM45432I4h8.webp', 'webp', '2024-01-20 10:11:01', '2024-01-20 10:11:01', NULL, 2, 2, NULL),
(26, 'iQA9Tt24oEOcbE9NenwnMsK9G9ceZRcx5NXxtWWb.jpg', 'LocationMeublees/iQA9Tt24oEOcbE9NenwnMsK9G9ceZRcx5NXxtWWb.jpg', 'jpg', '2024-01-20 10:23:46', '2024-01-20 10:23:46', NULL, 1, 1, NULL),
(27, 'MquztY4Se1PrEbczQbrICf6jCU1ViCrFXwjhxewH.jpg', 'LocationMeublees/MquztY4Se1PrEbczQbrICf6jCU1ViCrFXwjhxewH.jpg', 'jpg', '2024-01-20 10:23:46', '2024-01-20 10:23:46', NULL, 1, 1, NULL),
(28, 'x0bTP1K1Sl6Vw4u0XjJolp5nwBWg3Sjnnps2IsGW.jpg', 'LocationMeublees/x0bTP1K1Sl6Vw4u0XjJolp5nwBWg3Sjnnps2IsGW.jpg', 'jpg', '2024-01-20 10:23:46', '2024-01-20 10:23:46', NULL, 1, 1, NULL),
(29, 'mJQ7hY8duvLk9Id65AqefxwFoFX4DclV3mzclD5L.jpg', 'location-vehicules/mJQ7hY8duvLk9Id65AqefxwFoFX4DclV3mzclD5L.jpg', 'jpg', '2024-01-20 10:25:38', '2024-01-20 10:25:38', NULL, 1, 1, NULL),
(30, '9c9hGu2V2LpPzIQnItb3vu0fMLeTIc18REfvIXvt.jpg', 'location-vehicules/9c9hGu2V2LpPzIQnItb3vu0fMLeTIc18REfvIXvt.jpg', 'jpg', '2024-01-20 10:25:38', '2024-01-20 10:25:38', NULL, 1, 1, NULL),
(31, 'ig05jaNVPimmqy4kDAIO17gK9E3IEgiIpzWngCkc.jpg', 'location-meublees/ig05jaNVPimmqy4kDAIO17gK9E3IEgiIpzWngCkc.jpg', 'jpg', '2024-01-20 10:36:30', '2024-01-20 10:36:30', NULL, 1, 1, NULL),
(32, 'hl99Jvg1cuGQRNaiN8Fa0kc9FPwxnSdthERXkg8E.jpg', 'location-meublees/hl99Jvg1cuGQRNaiN8Fa0kc9FPwxnSdthERXkg8E.jpg', 'jpg', '2024-01-20 10:36:30', '2024-01-20 10:36:30', NULL, 1, 1, NULL),
(33, 'HyJyNkCdiw5eW9kZefUBbgx9bQytfiTgqUjG1fxa.jpg', 'location-meublees/HyJyNkCdiw5eW9kZefUBbgx9bQytfiTgqUjG1fxa.jpg', 'jpg', '2024-01-20 10:36:30', '2024-01-20 10:36:30', NULL, 1, 1, NULL),
(34, 'TIY8tunBU9qd3Wm6jjPUyiYeO6sH38HkRgO1YnrG.jpg', 'location-vehicules/TIY8tunBU9qd3Wm6jjPUyiYeO6sH38HkRgO1YnrG.jpg', 'jpg', '2024-01-20 10:44:40', '2024-01-20 10:44:40', NULL, 1, 1, NULL),
(35, 'BJAaNRIC0dQ0zuLNaX4Yw25dR3YC0JpyerKveMnj.jpg', 'location-meublees/BJAaNRIC0dQ0zuLNaX4Yw25dR3YC0JpyerKveMnj.jpg', 'jpg', '2024-01-20 10:45:44', '2024-01-20 10:45:44', NULL, 1, 1, NULL),
(36, 'VnjhHvLIkpq1LLfdIV4Wbp3iuvkEqhEmGrlfdhGW.jpg', 'hotels/VnjhHvLIkpq1LLfdIV4Wbp3iuvkEqhEmGrlfdhGW.jpg', 'jpg', '2024-01-20 10:46:40', '2024-01-20 10:46:40', NULL, 1, 1, NULL),
(37, 'er1vlmuGXpevgaSyFgZFrDTwvdIdQZSVtu5yfq73.jpg', 'patisseries/er1vlmuGXpevgaSyFgZFrDTwvdIdQZSVtu5yfq73.jpg', 'jpg', '2024-01-20 20:25:13', '2024-01-20 20:25:13', NULL, 2, 2, NULL),
(38, 'fqXUNsTx2OSa3uPZp4j5JCA3vh0hjjsV1wr93RXS.jpg', 'patisseries/fqXUNsTx2OSa3uPZp4j5JCA3vh0hjjsV1wr93RXS.jpg', 'jpg', '2024-01-20 20:25:13', '2024-01-20 20:25:13', NULL, 2, 2, NULL),
(39, 'LGBNZJyeUMlJurvORN9mWp086YdOQlwNWN00BRwL.jpg', 'patisseries/LGBNZJyeUMlJurvORN9mWp086YdOQlwNWN00BRwL.jpg', 'jpg', '2024-01-20 20:37:37', '2024-01-20 20:37:37', NULL, 2, 2, NULL),
(40, 'bY3vO8ZElRcAtZkOaxib7VOT5wwjGaEhDzb7y0No.jpg', 'patisseries/bY3vO8ZElRcAtZkOaxib7VOT5wwjGaEhDzb7y0No.jpg', 'jpg', '2024-01-20 20:37:37', '2024-01-20 20:37:37', NULL, 2, 2, NULL),
(41, '8BmR4NPwjludsy0QHvtV1FokeYNzxCmNDnt9tfLL.jpg', 'hotels/8BmR4NPwjludsy0QHvtV1FokeYNzxCmNDnt9tfLL.jpg', 'jpg', '2024-01-20 20:41:36', '2024-01-20 20:41:36', NULL, 2, 2, NULL),
(42, '0fy4a7pbuj8kCfdouhOH1gIlDCPJ88w9skL7iB8Q.jpg', 'hotels/0fy4a7pbuj8kCfdouhOH1gIlDCPJ88w9skL7iB8Q.jpg', 'jpg', '2024-01-20 20:41:36', '2024-01-20 20:41:36', NULL, 2, 2, NULL),
(43, 'bMymhGz5ZtY7lQPXlcAbMgddQzHDD3Q7DAN7T1yS.jpg', 'patisseries/bMymhGz5ZtY7lQPXlcAbMgddQzHDD3Q7DAN7T1yS.jpg', 'jpg', '2024-02-03 16:16:20', '2024-02-03 16:16:20', NULL, 1, 1, NULL),
(44, 'g5IUHuPBcEPrS29FzxtiPK8Fwm2zoFixsyRDdTG4.jpg', 'location-vehicules/g5IUHuPBcEPrS29FzxtiPK8Fwm2zoFixsyRDdTG4.jpg', 'jpg', '2024-02-03 21:06:46', '2024-02-03 21:06:46', NULL, 2, 2, NULL),
(45, 'q1qV9M7PankCOseEpKqqNrQTAcwoAwRT5f2CvKaL.jpg', 'location-meublees/q1qV9M7PankCOseEpKqqNrQTAcwoAwRT5f2CvKaL.jpg', 'jpg', '2024-02-03 21:08:13', '2024-02-03 21:08:13', NULL, 2, 2, NULL),
(46, 'e2aL2axKtZW2hQZyixvyFynCaySzgFD3tVbteFs4.jpg', 'location-meublees/e2aL2axKtZW2hQZyixvyFynCaySzgFD3tVbteFs4.jpg', 'jpg', '2024-02-03 21:08:57', '2024-02-03 21:08:57', NULL, 2, 2, NULL),
(47, 'mgLwyzY2FihahK3Vka0CNiG5Ak1wkb5sknXbgM5C.jpg', 'location-vehicules/mgLwyzY2FihahK3Vka0CNiG5Ak1wkb5sknXbgM5C.jpg', 'jpg', '2024-02-03 21:10:40', '2024-02-03 21:10:40', NULL, 2, 2, NULL),
(48, 'o4DU6DG8C6QdAGktKmTeXfzj8zgvedhgHpHIkEdM.jpg', 'boite-de-nuits/o4DU6DG8C6QdAGktKmTeXfzj8zgvedhgHpHIkEdM.jpg', 'jpg', '2024-02-03 21:11:30', '2024-02-03 21:11:30', NULL, 2, 2, NULL),
(49, 'FUuLxRtle4amikvR7b9yLiDuRdqeWyUlssVGCtnV.jpg', 'hotels/FUuLxRtle4amikvR7b9yLiDuRdqeWyUlssVGCtnV.jpg', 'jpg', '2024-02-03 21:14:22', '2024-02-03 21:14:22', NULL, 2, 2, NULL),
(50, 'BW4UWcYP2iq0c1BGWKpxvKQoiNL9BHdrEEFw3yjt.jpg', 'annonces/BW4UWcYP2iq0c1BGWKpxvKQoiNL9BHdrEEFw3yjt.jpg', 'jpg', '2024-02-03 21:15:40', '2024-02-03 21:15:40', NULL, 2, 2, NULL),
(51, '0i85mw7N8oA0kROcktGUVP3oG1itFxaF0CBQhjIs.jpg', 'bars/0i85mw7N8oA0kROcktGUVP3oG1itFxaF0CBQhjIs.jpg', 'jpg', '2024-02-03 21:24:28', '2024-02-03 21:24:28', NULL, 2, 2, NULL),
(52, 'e51NBm1vNedJjwwcATKPVsEvrgMiLdmyAlTnk0k2.jpg', 'boite-de-nuits/e51NBm1vNedJjwwcATKPVsEvrgMiLdmyAlTnk0k2.jpg', 'jpg', '2024-02-03 21:26:01', '2024-02-03 21:26:01', NULL, 2, 2, NULL),
(53, 'ge9AkKnHRseIMLLlrkYKxunzGZHWN3Nqm68yRmn5.jpg', 'patisseries/ge9AkKnHRseIMLLlrkYKxunzGZHWN3Nqm68yRmn5.jpg', 'jpg', '2024-03-09 19:51:47', '2024-03-09 19:51:47', NULL, 1, 1, NULL),
(54, 'AOMF83XR9qDoeVVhFtt4RQIaDE1HvtaDDkJXhAyP.jpg', 'patisseries/AOMF83XR9qDoeVVhFtt4RQIaDE1HvtaDDkJXhAyP.jpg', 'jpg', '2024-03-09 19:51:47', '2024-03-09 19:51:47', NULL, 1, 1, NULL),
(55, 'FylTSo0UdysGbqOCCQkopqeRi0eGF73BrTFJPK9q.jpg', 'patisseries/FylTSo0UdysGbqOCCQkopqeRi0eGF73BrTFJPK9q.jpg', 'jpg', '2024-03-09 19:51:47', '2024-03-09 19:51:47', NULL, 1, 1, NULL),
(56, 'djSckh68nQuwpJ4zumYBF7TAIovO4YA9FAsq3A4n.jpg', 'patisseries/djSckh68nQuwpJ4zumYBF7TAIovO4YA9FAsq3A4n.jpg', 'jpg', '2024-03-09 19:51:47', '2024-03-09 19:51:47', NULL, 1, 1, NULL),
(57, 'OTU1CTmMxrZSVzHf9lyoPQN7XlAUF8zwTxq8cEEG.jpg', 'patisseries/OTU1CTmMxrZSVzHf9lyoPQN7XlAUF8zwTxq8cEEG.jpg', 'jpg', '2024-03-09 19:51:47', '2024-03-09 19:51:47', NULL, 1, 1, NULL),
(58, 'TtnKqTtAv4BLJDGwXwtTkQ2ZbY942uMFylAMnfxK.jpg', 'patisseries/TtnKqTtAv4BLJDGwXwtTkQ2ZbY942uMFylAMnfxK.jpg', 'jpg', '2024-03-09 19:51:47', '2024-03-09 19:51:47', NULL, 1, 1, NULL),
(59, 'wR6tf5w43VIdr0mq0XWQotaxk8dGaLRiLLBKfcWL.jpg', 'boite-de-nuits/wR6tf5w43VIdr0mq0XWQotaxk8dGaLRiLLBKfcWL.jpg', 'jpg', '2024-03-09 19:59:03', '2024-03-09 19:59:03', NULL, 1, 1, NULL),
(60, 'K0PiIUWiCWoonONVXxtBmwuheyZaxjtZZyIel8gO.jpg', 'boite-de-nuits/K0PiIUWiCWoonONVXxtBmwuheyZaxjtZZyIel8gO.jpg', 'jpg', '2024-03-09 19:59:03', '2024-03-09 19:59:03', NULL, 1, 1, NULL),
(61, 'BGFvdYBAAKJWqwlLjyPUukObeH2b7fJj5vGDspPG.jpg', 'boite-de-nuits/BGFvdYBAAKJWqwlLjyPUukObeH2b7fJj5vGDspPG.jpg', 'jpg', '2024-03-09 19:59:03', '2024-03-09 19:59:03', NULL, 1, 1, NULL),
(62, 'ejuGAwaejHoF9VqZDIUdMPsO47EhKz1AfvNGmUVL.jpg', 'hotels/ejuGAwaejHoF9VqZDIUdMPsO47EhKz1AfvNGmUVL.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(63, 'PcLbz93g9mcJjarmA2bzUHPl69tZunPTSYUJgZwh.jpg', 'hotels/PcLbz93g9mcJjarmA2bzUHPl69tZunPTSYUJgZwh.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(64, 'Zdllw6hJajkx5UZhWn7j2RZRC5msyXFngRJIJS47.jpg', 'hotels/Zdllw6hJajkx5UZhWn7j2RZRC5msyXFngRJIJS47.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(65, 'M2jhwBFPcX1mRywNSh8mMRwzmgxf9V1hcbBgmFgQ.jpg', 'hotels/M2jhwBFPcX1mRywNSh8mMRwzmgxf9V1hcbBgmFgQ.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(66, 'T2U8aUsF37y9C9oRRlbo8FhBDXv9kG9UFPQizd9R.jpg', 'hotels/T2U8aUsF37y9C9oRRlbo8FhBDXv9kG9UFPQizd9R.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(67, 'bHiNcBQN4lgKDV2InaT5Yc5AzMJWOfFAPB8HtPzh.jpg', 'hotels/bHiNcBQN4lgKDV2InaT5Yc5AzMJWOfFAPB8HtPzh.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(68, 'yotORONauTdZVbVhqcYPXyHQQBkDMYe5HHEF7mZH.jpg', 'hotels/yotORONauTdZVbVhqcYPXyHQQBkDMYe5HHEF7mZH.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(69, 'ApvyAl0idhNXDOnXOTkvLsLSH4QSKTVMOK1JXaV9.jpg', 'hotels/ApvyAl0idhNXDOnXOTkvLsLSH4QSKTVMOK1JXaV9.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(70, 'zo3YYshbW8He8bT5va9hnlZsD7acsCULaqZpcuKi.jpg', 'hotels/zo3YYshbW8He8bT5va9hnlZsD7acsCULaqZpcuKi.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(71, 'KVmzUmcOA5WQLf8ybSGw7rdSJZ4pf3Hq6knMZdsJ.jpg', 'hotels/KVmzUmcOA5WQLf8ybSGw7rdSJZ4pf3Hq6knMZdsJ.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(72, 'QA0TytYEuQnsY4szLCJNsJia278drBusyCve23mo.jpg', 'hotels/QA0TytYEuQnsY4szLCJNsJia278drBusyCve23mo.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(73, 'jKuObcMKHPC4ZAJI8NXjp6vASdw6EIyaW4veXeJx.jpg', 'hotels/jKuObcMKHPC4ZAJI8NXjp6vASdw6EIyaW4veXeJx.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(74, 'MRdgvGWItmix1feaZT7vhZ9K25t0KjyKF5jLWrD9.jpg', 'hotels/MRdgvGWItmix1feaZT7vhZ9K25t0KjyKF5jLWrD9.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(75, 'WyK0xFjWOQfqrxfLGVzsDFz7o3c5fttCs7hPlleF.jpg', 'hotels/WyK0xFjWOQfqrxfLGVzsDFz7o3c5fttCs7hPlleF.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(76, 'eIuSFFNBX4dz8FEfL0M7GKknfHT50f0MQc9TJtpD.jpg', 'hotels/eIuSFFNBX4dz8FEfL0M7GKknfHT50f0MQc9TJtpD.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(77, 'eBbUoYlUnZ95r1fdP3AXEZfm40FHXdlFWFv1PVRQ.jpg', 'hotels/eBbUoYlUnZ95r1fdP3AXEZfm40FHXdlFWFv1PVRQ.jpg', 'jpg', '2024-03-24 10:51:35', '2024-03-24 10:51:35', NULL, 1, 1, NULL),
(78, 'FLi7p85pvREoNwV6g8Ak9kdn5C6HEZMx4zYRYNFF.jpg', 'location-vehicules/FLi7p85pvREoNwV6g8Ak9kdn5C6HEZMx4zYRYNFF.jpg', 'jpg', '2024-05-18 11:45:29', '2024-05-18 11:45:29', NULL, 7, 7, NULL),
(79, 'KOgIShufQRhbP4Ilay6F4qo290zXWo1NmpnmQuOQ.jpg', 'location-vehicules/KOgIShufQRhbP4Ilay6F4qo290zXWo1NmpnmQuOQ.jpg', 'jpg', '2024-05-18 11:45:29', '2024-05-18 11:45:29', NULL, 7, 7, NULL),
(80, 'zAQnt5dtrc9Uwl8CeNL3tyZbhDLBD0vdBEpDJuFx.jpg', 'location-vehicules/zAQnt5dtrc9Uwl8CeNL3tyZbhDLBD0vdBEpDJuFx.jpg', 'jpg', '2024-05-18 11:45:29', '2024-05-18 11:45:29', NULL, 7, 7, NULL),
(81, 'OIWpllrAwkdckISGHDfsDwYcqAxWb3KxiEJDLayq.jpg', 'location-vehicules/OIWpllrAwkdckISGHDfsDwYcqAxWb3KxiEJDLayq.jpg', 'jpg', '2024-06-23 15:30:13', '2024-06-23 15:30:13', NULL, 15, 15, NULL),
(82, '3oPgXQ4wWYST4TSc78vy9KLGJxR6OnjgB2OOrjzE.jpg', 'location-vehicules/3oPgXQ4wWYST4TSc78vy9KLGJxR6OnjgB2OOrjzE.jpg', 'jpg', '2024-06-23 15:30:13', '2024-06-23 15:30:13', NULL, 15, 15, NULL),
(83, 'KCKZuQII8r6PU1y6tvUE6t3Op9SZdsguNxBHykIG.jpg', 'location-vehicules/KCKZuQII8r6PU1y6tvUE6t3Op9SZdsguNxBHykIG.jpg', 'jpg', '2024-06-23 15:30:13', '2024-06-23 15:30:13', NULL, 15, 15, NULL),
(84, 'CJq5ZqN25hBnwcrjp4Lx38zp9iEWBJiv2ggYvdKf.jpg', 'location-meublees/CJq5ZqN25hBnwcrjp4Lx38zp9iEWBJiv2ggYvdKf.jpg', 'jpg', '2024-06-23 15:33:43', '2024-06-23 15:33:43', NULL, 15, 15, NULL),
(85, 'QSFA0Z0AuEbnmDaeBpKkk57JAk0JSAPRLr5exdZs.jpg', 'location-meublees/QSFA0Z0AuEbnmDaeBpKkk57JAk0JSAPRLr5exdZs.jpg', 'jpg', '2024-06-23 15:33:43', '2024-06-23 15:33:43', NULL, 15, 15, NULL),
(86, 'TbphPhDxI7fwBUBwvhYNnQax1h4fKMhCBnRe22kA.jpg', 'location-meublees/TbphPhDxI7fwBUBwvhYNnQax1h4fKMhCBnRe22kA.jpg', 'jpg', '2024-06-23 15:33:43', '2024-06-23 15:33:43', NULL, 15, 15, NULL),
(87, 'CcfDzc4hQiNeMG42Q0Ii83pd9Xy5eXUijnHLBq2M.jpg', 'location-meublees/CcfDzc4hQiNeMG42Q0Ii83pd9Xy5eXUijnHLBq2M.jpg', 'jpg', '2024-06-23 15:33:43', '2024-06-23 15:33:43', NULL, 15, 15, NULL),
(88, '13SLu2ikXtJPV2jz2bu0Awha20YR6w0EExlDpqTT.png', 'restaurants/13SLu2ikXtJPV2jz2bu0Awha20YR6w0EExlDpqTT.png', 'png', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL),
(89, 'S379j6DkRW0zYsEp0wOOdTwrAb2vQYoHRpX6tpF5.png', 'restaurants/S379j6DkRW0zYsEp0wOOdTwrAb2vQYoHRpX6tpF5.png', 'png', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL),
(90, '1ehsq39Rx6zUs3VDbjMDHSYAr0zobLGvyglXZSmP.png', 'restaurants/1ehsq39Rx6zUs3VDbjMDHSYAr0zobLGvyglXZSmP.png', 'png', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL),
(91, 'y6nCLhcUhItqnRahkQm8VZEqq54kLBET6DMbEWbU.png', 'restaurants/y6nCLhcUhItqnRahkQm8VZEqq54kLBET6DMbEWbU.png', 'png', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL),
(92, 'GfOsY8G9ufNv5p2v2kKb0LWLYUNApvB02GwDbOUh.png', 'restaurants/GfOsY8G9ufNv5p2v2kKb0LWLYUNApvB02GwDbOUh.png', 'png', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL),
(93, 'orGfNHXaTvi8Lpjazcwz6UpmOAO7HjJZcih1TorY.png', 'restaurants/orGfNHXaTvi8Lpjazcwz6UpmOAO7HjJZcih1TorY.png', 'png', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL),
(94, '2TifnNSQX5DFeMeeJw2KspBwW8Ys9tGFqLDGpMuj.png', 'restaurants/2TifnNSQX5DFeMeeJw2KspBwW8Ys9tGFqLDGpMuj.png', 'png', '2024-08-27 17:29:46', '2024-08-27 17:29:46', NULL, 1, 1, NULL),
(95, 'p8nhtbmaL3ThgUGcbwrR8cFreb4q6iG3xCTYVasZ.png', 'restaurants/p8nhtbmaL3ThgUGcbwrR8cFreb4q6iG3xCTYVasZ.png', 'png', '2024-08-27 17:29:46', '2024-08-27 17:29:46', NULL, 1, 1, NULL),
(96, 'HtmDOAfg3BKAtYWuv2wuNhVnqFmh3JdUtSsFAiNd.png', 'restaurants/HtmDOAfg3BKAtYWuv2wuNhVnqFmh3JdUtSsFAiNd.png', 'png', '2024-08-27 17:29:46', '2024-08-27 17:29:46', NULL, 1, 1, NULL),
(97, '6asZeDqn1nsorMfa7Psvjk9EohgZhlRfA21E0GCf.png', 'restaurants/6asZeDqn1nsorMfa7Psvjk9EohgZhlRfA21E0GCf.png', 'png', '2024-08-27 17:29:46', '2024-08-27 17:29:46', NULL, 1, 1, NULL),
(98, 'j397vCHp1LCauQZR0hMb2gNt3mj5gXRywOUeuk3N.jpg', 'restaurants/j397vCHp1LCauQZR0hMb2gNt3mj5gXRywOUeuk3N.jpg', 'jpg', '2024-11-16 16:27:57', '2024-11-16 16:27:57', NULL, 21, 21, NULL),
(99, 'CgdpVT02fZUVRUchc5Ou1AM0gcvKRGCGob3FjSOD.png', 'annonces/CgdpVT02fZUVRUchc5Ou1AM0gcvKRGCGob3FjSOD.png', 'png', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(100, 'eCb6lOiCjFYLGYBHtxbmwZOTEZyIlKLhHmNWuFf8.jpg', 'annonces/eCb6lOiCjFYLGYBHtxbmwZOTEZyIlKLhHmNWuFf8.jpg', 'jpg', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(101, 'EkFjNnDJiL8I6URVGrRLbTlrPk7gyIAJZjg1JdJt.svg', 'annonces/EkFjNnDJiL8I6URVGrRLbTlrPk7gyIAJZjg1JdJt.svg', 'svg', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(102, 'sYfydlxasZdoK2CYmywlGVEDDbLcgP3x4lAky54j.svg', 'annonces/sYfydlxasZdoK2CYmywlGVEDDbLcgP3x4lAky54j.svg', 'svg', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(103, 'Qvqt1vQvOniQjAHYEURPOL6oJno3tQ3sZ5Vf1jxp.svg', 'annonces/Qvqt1vQvOniQjAHYEURPOL6oJno3tQ3sZ5Vf1jxp.svg', 'svg', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(104, 'EFwYonPBSWNVa09BgCgueyWqzthvivxZnBaNWfcX.svg', 'annonces/EFwYonPBSWNVa09BgCgueyWqzthvivxZnBaNWfcX.svg', 'svg', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(105, 'uSGabM8xeLWvPLZ4TKhMTCmnX8vnMBWvVeFlcb9J.svg', 'annonces/uSGabM8xeLWvPLZ4TKhMTCmnX8vnMBWvVeFlcb9J.svg', 'svg', '2024-12-30 12:29:51', '2024-12-30 12:29:51', NULL, 21, 21, NULL),
(106, '0gXHgX3gDLAn1JcphuvGIphwowrQ67vlj1gQn0IK.svg', 'annonces/0gXHgX3gDLAn1JcphuvGIphwowrQ67vlj1gQn0IK.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(107, 'rDDRSJ1vWZ0OXmGItK5OURiRRpRrcaR3XTRekCoR.svg', 'annonces/rDDRSJ1vWZ0OXmGItK5OURiRRpRrcaR3XTRekCoR.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(108, 'GESxOQBQfPlEd3AuNSxRhYDaQrBrGBzvpsK3fVmy.svg', 'annonces/GESxOQBQfPlEd3AuNSxRhYDaQrBrGBzvpsK3fVmy.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(109, 'AM4xv51natPLfOeBPJckX4GwBFGdkDQOlho3QXwP.svg', 'annonces/AM4xv51natPLfOeBPJckX4GwBFGdkDQOlho3QXwP.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(110, 'VqE5OQXZMlXYDmFliiH7Jiae7Hb9Hu73w79yZHil.svg', 'annonces/VqE5OQXZMlXYDmFliiH7Jiae7Hb9Hu73w79yZHil.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(111, 'grvICyF8haGSemR355jP25rfomJf8xhaT5v8mw7R.svg', 'annonces/grvICyF8haGSemR355jP25rfomJf8xhaT5v8mw7R.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(112, 'RGMUvqAFCuqnlNnB9DfZSzonSJltzrGAQpvoQ1As.jpg', 'annonces/RGMUvqAFCuqnlNnB9DfZSzonSJltzrGAQpvoQ1As.jpg', 'jpg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(113, 'GgbA9Qi3EdkMewjdbAhQX97JwN2bEyLt1m8fDec4.svg', 'annonces/GgbA9Qi3EdkMewjdbAhQX97JwN2bEyLt1m8fDec4.svg', 'svg', '2024-12-30 12:43:11', '2024-12-30 12:43:11', NULL, 21, 21, NULL),
(114, 'xrz57MiX2K76Lo9F829lYustQgpkdZWFletvPVdS.svg', 'annonces/xrz57MiX2K76Lo9F829lYustQgpkdZWFletvPVdS.svg', 'svg', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(115, 'Vfl8hW2vywYkDn5NHm3yGWArPJFZoag8gomwTqGb.svg', 'annonces/Vfl8hW2vywYkDn5NHm3yGWArPJFZoag8gomwTqGb.svg', 'svg', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(116, 'gsZk13jRtpPQSuzSXWD0BWz3Qd4L7VCUAkBUlUHu.svg', 'annonces/gsZk13jRtpPQSuzSXWD0BWz3Qd4L7VCUAkBUlUHu.svg', 'svg', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(117, 'far2ehLize03hrME2efOF9AIgEtLe3hsJrjcwO3O.svg', 'annonces/far2ehLize03hrME2efOF9AIgEtLe3hsJrjcwO3O.svg', 'svg', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(118, 'O46aaAn0Ptes03dLIXuIg0nqPd9HRRkycbVb55Il.jpg', 'annonces/O46aaAn0Ptes03dLIXuIg0nqPd9HRRkycbVb55Il.jpg', 'jpg', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(119, 'enPqr3pogDnajLtCPWk9o2qOM1Agbm83TpOwwniR.svg', 'annonces/enPqr3pogDnajLtCPWk9o2qOM1Agbm83TpOwwniR.svg', 'svg', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(120, '5Q11R0kWNJStdyKCun4VbQpvBMjhD3CHcaxingMw.png', 'annonces/5Q11R0kWNJStdyKCun4VbQpvBMjhD3CHcaxingMw.png', 'png', '2024-12-30 12:46:41', '2024-12-30 12:46:41', NULL, 21, 21, NULL),
(121, '0xVhQsf54JQ1Fg6hWVvIxiqGFWM3y7DhDfo7l7MO.jpg', 'location-meublees/0xVhQsf54JQ1Fg6hWVvIxiqGFWM3y7DhDfo7l7MO.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(122, 'gMLdoVVMInXw9czTKFzbbsSE7T9oCoXFblNbA3gn.jpg', 'location-meublees/gMLdoVVMInXw9czTKFzbbsSE7T9oCoXFblNbA3gn.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(123, 'K69eJf6KLiDXa6HedELuPnsvIk1yzl7Y2LpSmpDd.jpg', 'location-meublees/K69eJf6KLiDXa6HedELuPnsvIk1yzl7Y2LpSmpDd.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(124, '1DWWk6GI4JEflTy8oFtq1zxQhTRCf6U47nSg6T9b.jpg', 'location-meublees/1DWWk6GI4JEflTy8oFtq1zxQhTRCf6U47nSg6T9b.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(125, 'B9lQhJomHyxoeYdGC3gsD9pCbZD6r1zEAtj5wW63.jpg', 'location-meublees/B9lQhJomHyxoeYdGC3gsD9pCbZD6r1zEAtj5wW63.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(126, 'SPELrUMEFQ5VaB01Xx7gpNFk3kxAu0U9iW15FnNs.jpg', 'location-meublees/SPELrUMEFQ5VaB01Xx7gpNFk3kxAu0U9iW15FnNs.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(127, 'bFHyV0olhUho31dw9xjS2vGOBWS8yE9nndYJmul8.jpg', 'location-meublees/bFHyV0olhUho31dw9xjS2vGOBWS8yE9nndYJmul8.jpg', 'jpg', '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL),
(128, 'W0NLN0aSyUln2MTYSsxVPDhaUzTDmwMWSqIECHZE.jpg', 'boite-de-nuits/W0NLN0aSyUln2MTYSsxVPDhaUzTDmwMWSqIECHZE.jpg', 'jpg', '2024-12-30 17:09:47', '2024-12-30 17:09:47', NULL, 21, 21, NULL),
(129, '3ou9u3uWCZqMnPZETcSjJ6kDD8zCGZWVrprezvpg.jpg', 'boite-de-nuits/3ou9u3uWCZqMnPZETcSjJ6kDD8zCGZWVrprezvpg.jpg', 'jpg', '2024-12-30 17:09:48', '2024-12-30 17:09:48', NULL, 21, 21, NULL),
(130, 'aMqMz7J5O0HdOWOKsFu2grvKx0fsEj3zTtCL7988.jpg', 'boite-de-nuits/aMqMz7J5O0HdOWOKsFu2grvKx0fsEj3zTtCL7988.jpg', 'jpg', '2024-12-30 17:09:48', '2024-12-30 17:09:48', NULL, 21, 21, NULL),
(131, 'gepCZMvsOoH7UxL5rD4aLBgYvQAttdbaqhI5Dlsb.jpg', 'boite-de-nuits/gepCZMvsOoH7UxL5rD4aLBgYvQAttdbaqhI5Dlsb.jpg', 'jpg', '2024-12-30 17:09:48', '2024-12-30 17:09:48', NULL, 21, 21, NULL),
(132, 'wUP2x1xrLFxAQWq0qPDiXuI2xbzdZq2FayY1rjoC.jpg', 'boite-de-nuits/wUP2x1xrLFxAQWq0qPDiXuI2xbzdZq2FayY1rjoC.jpg', 'jpg', '2024-12-30 17:09:48', '2024-12-30 17:09:48', NULL, 21, 21, NULL),
(133, 'GxRyxaLsZFJW3T0VPFi10JsQk8lutJtXcSf8HqKY.jpg', 'boite-de-nuits/GxRyxaLsZFJW3T0VPFi10JsQk8lutJtXcSf8HqKY.jpg', 'jpg', '2024-12-30 17:09:48', '2024-12-30 17:09:48', NULL, 21, 21, NULL),
(134, 'lrBvIw2Q0xfYFuPCXsubTbJrgUe0ysm88uy69dvo.webp', 'annonces/lrBvIw2Q0xfYFuPCXsubTbJrgUe0ysm88uy69dvo.webp', 'webp', '2025-01-21 07:20:15', '2025-01-21 07:20:15', NULL, 21, 21, NULL),
(135, 'a4C4IpcDleGQ8py7tt1sjOwj1vxy20RG0ZQWYKoj.jpg', 'annonces/a4C4IpcDleGQ8py7tt1sjOwj1vxy20RG0ZQWYKoj.jpg', 'jpg', '2025-01-21 07:20:15', '2025-01-21 07:20:15', NULL, 21, 21, NULL),
(136, 'kyKligloGnpQOkN6o06TD44ER0a0vLFl36AgHz7o.jpg', 'annonces/kyKligloGnpQOkN6o06TD44ER0a0vLFl36AgHz7o.jpg', 'jpg', '2025-01-21 07:20:15', '2025-01-21 07:20:15', NULL, 21, 21, NULL),
(137, 'LfPhsqXyrvYTNc4qMkJ6wKqv6yf8YeqBKte88vOw.jpg', 'fast-foods/LfPhsqXyrvYTNc4qMkJ6wKqv6yf8YeqBKte88vOw.jpg', 'jpg', '2025-01-22 11:34:55', '2025-01-22 11:34:55', NULL, 1, 1, NULL),
(138, 'IezObmRIbjc8Q47fFkB1GTfuBCmb2TMe5DRqjEj9.jpg', 'restaurants/IezObmRIbjc8Q47fFkB1GTfuBCmb2TMe5DRqjEj9.jpg', 'jpg', '2025-01-22 13:19:58', '2025-01-22 13:19:58', NULL, 1, 1, NULL),
(139, '2w4J6ABtJ9UwJQ9ztnj8SOkh4pKWP5KS6ia37hvo.jpg', 'restaurants/2w4J6ABtJ9UwJQ9ztnj8SOkh4pKWP5KS6ia37hvo.jpg', 'jpg', '2025-01-25 16:21:47', '2025-01-25 16:21:47', NULL, 1, 1, NULL),
(140, 'BC9H9brDabZA8yLTfcAl8spRwMGp7aWMWHWWlCss.jpg', 'restaurants/BC9H9brDabZA8yLTfcAl8spRwMGp7aWMWHWWlCss.jpg', 'jpg', '2025-01-25 16:21:47', '2025-01-25 16:21:47', NULL, 1, 1, NULL),
(141, '25URPrcuY8gFBivWnmfEPdTU6Az2wChouxsPMHxL.jpg', 'restaurants/25URPrcuY8gFBivWnmfEPdTU6Az2wChouxsPMHxL.jpg', 'jpg', '2025-01-25 16:21:47', '2025-01-25 16:21:47', NULL, 1, 1, NULL),
(142, 'MrDntfnsETclYrEwKTVbTU41zVfbLIQ0SxHeuZ00.jpg', 'restaurants/MrDntfnsETclYrEwKTVbTU41zVfbLIQ0SxHeuZ00.jpg', 'jpg', '2025-01-25 16:21:47', '2025-01-25 16:21:47', NULL, 1, 1, NULL),
(143, '9pX41gxzxa2gt2HMWEGPwh27oqY48VNfb9Y25TlZ.jpg', 'location-vehicules/9pX41gxzxa2gt2HMWEGPwh27oqY48VNfb9Y25TlZ.jpg', 'jpg', '2025-02-06 20:32:53', '2025-02-06 20:32:53', NULL, 1, 1, NULL),
(144, 'iQbFsedhBhgJwNdLPtpUdsxPtbG2b4aMUtQTaMvm.jpg', 'location-vehicules/iQbFsedhBhgJwNdLPtpUdsxPtbG2b4aMUtQTaMvm.jpg', 'jpg', '2025-02-06 20:35:15', '2025-02-06 20:35:15', NULL, 1, 1, NULL),
(145, 'iXDW6PRLCIBuxmS7xI9eVsj9kyB2FktdvQGafDP5.jpg', 'fast-foods/iXDW6PRLCIBuxmS7xI9eVsj9kyB2FktdvQGafDP5.jpg', 'jpg', '2025-02-16 07:40:17', '2025-02-16 07:40:17', NULL, 1, 1, NULL),
(146, 'sn5EczqFoE827rufjfCDmnWcnRyBnj1SrJb8ZVn4.jpg', 'fast-foods/sn5EczqFoE827rufjfCDmnWcnRyBnj1SrJb8ZVn4.jpg', 'jpg', '2025-02-16 07:40:17', '2025-02-16 07:40:17', NULL, 1, 1, NULL),
(147, 'kQ8c7x9qMBkxZ30udn4u0c9lJ6RFlDZBOcN0jcY1.jpg', 'fast-foods/kQ8c7x9qMBkxZ30udn4u0c9lJ6RFlDZBOcN0jcY1.jpg', 'jpg', '2025-02-16 07:40:17', '2025-02-16 07:40:17', NULL, 1, 1, NULL),
(148, 'IcsgbLibWp3xEwj5uGup2hQ7JVO11FCEj2Ov43ot.jpg', 'fast-foods/IcsgbLibWp3xEwj5uGup2hQ7JVO11FCEj2Ov43ot.jpg', 'jpg', '2025-02-16 07:40:17', '2025-02-16 07:40:17', NULL, 1, 1, NULL),
(149, 'bhWYqgXudGl8ezf6CPr74uMl6aZGBSVGcWHBnAt9.jpg', 'fast-foods/bhWYqgXudGl8ezf6CPr74uMl6aZGBSVGcWHBnAt9.jpg', 'jpg', '2025-02-16 07:40:17', '2025-02-16 07:40:17', NULL, 1, 1, NULL),
(150, 'O90Z7VPop1MilJOZEf9HPrWOPUQT5i5ns7krPMwy.jpg', 'fast-foods/O90Z7VPop1MilJOZEf9HPrWOPUQT5i5ns7krPMwy.jpg', 'jpg', '2025-02-16 11:10:41', '2025-02-16 11:10:41', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `heure_ouvertures`
--

CREATE TABLE `heure_ouvertures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jour` varchar(255) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `heure_ouvertures`
--

INSERT INTO `heure_ouvertures` (`id`, `jour`, `heure_debut`, `heure_fin`, `entreprise_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Lundi', '06:34:00', '13:21:00', 3, '2024-02-06 21:32:10', '2024-02-06 21:32:10', NULL, 1, 1, NULL),
(2, 'Tous les jours', '10:38:00', '22:38:00', 1, '2023-12-12 08:38:49', '2023-12-12 08:38:49', NULL, 1, 1, NULL),
(3, 'Lundi', '10:48:00', '22:48:00', 2, '2023-12-12 08:48:44', '2023-12-23 21:54:29', '2023-12-23 21:54:29', 1, 1, NULL),
(4, 'Mardi', '10:48:00', '22:48:00', 2, '2023-12-12 08:48:44', '2023-12-23 21:54:29', '2023-12-23 21:54:29', 1, 1, NULL),
(5, 'Lundi', '10:48:00', '22:48:00', 2, '2023-12-23 21:54:29', '2023-12-23 22:27:46', '2023-12-23 22:27:46', 1, 1, NULL),
(6, 'Mardi', '10:48:00', '22:48:00', 2, '2023-12-23 21:54:29', '2023-12-23 22:27:46', '2023-12-23 22:27:46', 1, 1, NULL),
(7, 'Lundi', '10:48:00', '22:48:00', 2, '2023-12-23 22:27:46', '2023-12-26 15:56:34', '2023-12-26 15:56:34', 1, 1, NULL),
(8, 'Mardi', '10:48:00', '22:48:00', 2, '2023-12-23 22:27:46', '2023-12-26 15:56:34', '2023-12-26 15:56:34', 1, 1, NULL),
(9, 'Samedi', '22:54:00', '23:59:00', 2, '2023-12-23 22:27:46', '2023-12-26 15:56:34', '2023-12-26 15:56:34', 1, 1, NULL),
(10, 'Lundi', '10:48:00', '22:48:00', 2, '2023-12-26 15:56:34', '2024-02-10 04:25:03', '2024-02-10 04:25:03', 1, 1, NULL),
(11, 'Mardi', '10:48:00', '10:50:00', 2, '2023-12-26 15:56:34', '2024-02-10 04:25:03', '2024-02-10 04:25:03', 1, 1, NULL),
(12, 'Samedi', '22:54:00', '23:59:00', 2, '2023-12-26 15:56:34', '2024-02-10 04:25:03', '2024-02-10 04:25:03', 1, 1, NULL),
(13, 'Lundi', '10:48:00', '22:48:00', 2, '2024-02-10 04:25:03', '2024-02-12 10:05:54', '2024-02-12 10:05:54', 1, 1, NULL),
(14, 'Mardi', '10:48:00', '10:50:00', 2, '2024-02-10 04:25:03', '2024-02-12 10:05:54', '2024-02-12 10:05:54', 1, 1, NULL),
(15, 'Samedi', '22:54:00', '23:59:00', 2, '2024-02-10 04:25:04', '2024-02-12 10:05:54', '2024-02-12 10:05:54', 1, 1, NULL),
(16, 'Lundi', '10:48:00', '22:48:00', 2, '2024-02-12 10:05:54', '2024-04-07 08:41:28', '2024-04-07 08:41:28', 1, 1, NULL),
(17, 'Mardi', '10:48:00', '10:50:00', 2, '2024-02-12 10:05:54', '2024-04-07 08:41:28', '2024-04-07 08:41:28', 1, 1, NULL),
(18, 'Samedi', '22:54:00', '23:59:00', 2, '2024-02-12 10:05:54', '2024-04-07 08:41:28', '2024-04-07 08:41:28', 1, 1, NULL),
(19, 'Lundi', '10:48:00', '22:48:00', 2, '2024-04-07 08:41:28', '2024-04-07 08:41:28', NULL, 1, 1, NULL),
(20, 'Mardi', '10:48:00', '10:50:00', 2, '2024-04-07 08:41:28', '2024-04-07 08:41:28', NULL, 1, 1, NULL),
(21, 'Samedi', '22:54:00', '23:59:00', 2, '2024-04-07 08:41:28', '2024-04-07 08:41:28', NULL, 1, 1, NULL),
(22, 'Tous les jours', '01:33:00', '13:33:00', 11, '2024-05-18 11:33:29', '2024-05-18 11:33:29', NULL, 7, 7, NULL),
(23, 'Lundi', '10:12:00', '12:58:00', 15, '2024-06-23 15:25:08', '2025-02-16 12:24:18', '2025-02-16 12:24:18', 15, 15, NULL),
(24, 'Jeudi', '05:02:00', '18:08:00', 15, '2024-06-23 15:25:08', '2025-02-16 12:24:18', '2025-02-16 12:24:18', 15, 15, NULL),
(25, 'Lundi', '08:00:00', '17:00:00', 12, '2025-01-21 07:28:00', '2025-01-21 07:28:00', NULL, 21, 21, NULL),
(26, 'Mardi', '08:00:00', '17:00:00', 12, '2025-01-21 07:28:00', '2025-01-21 07:28:00', NULL, 21, 21, NULL),
(27, 'Lundi', '10:12:00', '12:58:00', 15, '2025-02-16 12:24:18', '2025-02-16 12:24:18', NULL, 1, 1, NULL),
(28, 'Jeudi', '05:02:00', '18:08:00', 15, '2025-02-16 12:24:18', '2025-02-16 12:24:18', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_chambre` int(11) NOT NULL,
  `nombre_personne` int(11) DEFAULT NULL,
  `nombre_salles_bain` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `prix_min` int(11) DEFAULT NULL,
  `prix_max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `nombre_chambre`, `nombre_personne`, `nombre_salles_bain`, `superficie`, `prix_min`, `prix_max`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 2, 4, 3, 14, NULL, 20000, '2023-12-12 13:28:07', '2024-02-03 21:14:22', NULL, 1, 2, NULL),
(2, 52, 22, 7, 40, 82, 654, '2023-12-12 13:39:52', '2024-02-03 21:07:33', NULL, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"b38fb4d6-3df7-4c10-bc31-007d63e45c3f\",\"displayName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\SendPasswordResetEmail\\\":2:{s:37:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:42:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000resetLink\\\";s:136:\\\"http:\\/\\/127.0.0.1\\/password\\/reset?token=bc567daab4fd099269b278133c926276c3ac3e2aa7c53ae3de01f2228297541c&email=billalisonhouin%40gmail.com\\\";}\"}}', 0, NULL, 1729085354, 1729085354),
(2, 'default', '{\"uuid\":\"67abae11-3322-419c-88e3-b4f544020b86\",\"displayName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\SendPasswordResetEmail\\\":2:{s:37:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:42:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000resetLink\\\";s:136:\\\"http:\\/\\/127.0.0.1\\/password\\/reset?token=cf7f846c619c9fea2ba7f26db3d60939fdfd0b5d3b0fc720793ddc5c34bc318b&email=billalisonhouin%40gmail.com\\\";}\"}}', 0, NULL, 1729085520, 1729085520),
(3, 'default', '{\"uuid\":\"18137012-88fa-489f-9eb3-b16eae0310c3\",\"displayName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\SendPasswordResetEmail\\\":2:{s:37:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:42:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000resetLink\\\";s:136:\\\"http:\\/\\/127.0.0.1\\/password\\/reset?token=e8249d7710b3536f3f7784ef10327cb81ca845c45022f447f6cdabbd24d95fe8&email=billalisonhouin%40gmail.com\\\";}\"}}', 0, NULL, 1729086035, 1729086035),
(4, 'default', '{\"uuid\":\"2f51f7a2-afa9-4355-b90e-c67344ac155c\",\"displayName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\SendPasswordResetEmail\\\":2:{s:37:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:42:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000resetLink\\\";s:136:\\\"http:\\/\\/127.0.0.1\\/password\\/reset?token=a765d2460c8f0eb753d909ab1333fbac0b8910cf3784878e5a087e85ecbed2c2&email=billalisonhouin%40gmail.com\\\";}\"}}', 0, NULL, 1729088674, 1729088674),
(5, 'default', '{\"uuid\":\"b5954eb2-2000-4e9c-b060-de749c45f3f6\",\"displayName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\SendPasswordResetEmail\\\":2:{s:37:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:21;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:42:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000resetLink\\\";s:136:\\\"http:\\/\\/127.0.0.1\\/password\\/reset?token=b78676292ab2d912350cd6307310f3accb41aed2670182acab633ed45eb92cff&email=sylviane.vieira%40gmail.com\\\";}\"}}', 0, NULL, 1729879753, 1729879753),
(6, 'default', '{\"uuid\":\"b1dbe97a-2030-4bf3-ac16-0285c5d5b3c5\",\"displayName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendPasswordResetEmail\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\SendPasswordResetEmail\\\":2:{s:37:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:42:\\\"\\u0000App\\\\Jobs\\\\SendPasswordResetEmail\\u0000resetLink\\\";s:130:\\\"http:\\/\\/127.0.0.1\\/password\\/reset?token=69aa782d2406e3cd8f35b7184b6923561600da539528a65190a95dcc44a2db4b&email=matyanika%40gmail.com\\\";}\"}}', 0, NULL, 1737536047, 1737536047);

-- --------------------------------------------------------

--
-- Structure de la table `location_meublees`
--

CREATE TABLE `location_meublees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_chambre` int(11) NOT NULL,
  `nombre_personne` int(11) DEFAULT NULL,
  `nombre_salles_bain` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `prix_min` int(11) DEFAULT NULL,
  `prix_max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `location_meublees`
--

INSERT INTO `location_meublees` (`id`, `nombre_chambre`, `nombre_personne`, `nombre_salles_bain`, `superficie`, `prix_min`, `prix_max`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 2, 2, 92, 39, 15000, 20000, '2023-12-12 14:35:41', '2023-12-12 14:35:41', NULL, 1, 1, NULL),
(2, 58, 87, 9, 65, 5, 90, '2024-01-20 10:11:00', '2024-01-20 10:11:00', NULL, 2, 2, NULL),
(3, 3, 2, 2, 21, 150000, 250000, '2024-06-23 15:33:43', '2024-06-23 15:33:43', NULL, 15, 15, NULL),
(4, 3, 6, 2, NULL, 400, 600, '2024-12-30 16:24:24', '2024-12-30 16:24:24', NULL, 21, 21, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `location_vehicules`
--

CREATE TABLE `location_vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `annee` varchar(255) DEFAULT NULL,
  `carburant` varchar(255) DEFAULT NULL,
  `kilometrage` varchar(255) DEFAULT NULL,
  `boite_vitesse` varchar(255) DEFAULT NULL,
  `nombre_portes` int(11) DEFAULT NULL,
  `nombre_places` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modele_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `location_vehicules`
--

INSERT INTO `location_vehicules` (`id`, `annee`, `carburant`, `kilometrage`, `boite_vitesse`, `nombre_portes`, `nombre_places`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `modele_id`) VALUES
(1, '1900', 'Essence sans plomb ', '94', 'Automatique ', 4, 4, '2023-12-12 14:06:30', '2023-12-12 14:06:30', NULL, 1, 1, NULL, NULL),
(2, '2016', 'Essence sans plomb ', '99999', 'Manuelle', 5, 5, '2024-01-05 10:50:37', '2024-01-05 10:50:37', NULL, 2, 2, NULL, NULL),
(3, NULL, 'Essence sans plomb ', NULL, 'Manuelle', 4, 2, '2024-05-18 11:45:29', '2024-05-18 11:45:29', NULL, 7, 7, NULL, NULL),
(4, '2012', 'Essence sans plomb ', '128000', 'Manuelle', 5, 5, '2024-06-23 15:30:13', '2024-06-23 15:30:13', NULL, 15, 15, NULL, NULL),
(5, '2009', 'Essence', '77', 'Manuelle', 2, 1, '2025-02-06 20:32:53', '2025-02-06 20:32:53', NULL, 1, 1, NULL, 2),
(6, '2006', 'Essence', '68', 'Manuelle', 4, 5, '2025-02-06 20:35:15', '2025-02-06 20:35:15', NULL, 1, 1, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `nom`, `slug`, `description`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'Fiat', 'fiat', NULL, 1, '2025-02-04 20:41:14', '2025-02-04 20:41:14', 1, 1),
(3, 'Toyota', 'toyota', NULL, 1, '2025-02-07 10:15:21', '2025-02-07 10:15:21', 1, 1),
(4, 'Hyundai', 'hyundai', NULL, 1, '2025-02-07 10:15:21', '2025-02-07 10:15:21', 1, 1),
(5, 'Nissan', 'nissan', NULL, 1, '2025-02-07 10:15:21', '2025-02-07 10:15:21', 1, 1),
(6, 'Mazda', 'mazda', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(7, 'BMW', 'bmw', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(8, 'Mercedes-Benz', 'mercedes-benz', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(9, 'Volkswagen', 'volkswagen', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(10, 'Kia', 'kia', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(11, 'Renault', 'renault', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(12, 'Peugeot', 'peugeot', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(13, 'Mitsubishi', 'mitsubishi', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(14, 'Ford', 'ford', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(15, 'Land Rover', 'land-rover', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(16, 'Opel', 'opel', NULL, 1, '2025-02-07 10:15:22', '2025-02-07 10:15:22', 1, 1),
(17, 'Suzuki', 'suzuki', NULL, 1, '2025-02-07 12:40:03', '2025-02-07 12:40:03', 1, 1),
(18, 'Skoda', 'skoda', NULL, 1, '2025-02-07 12:40:03', '2025-02-07 12:40:03', 1, 1),
(19, 'Citroën', 'citroen', NULL, 1, '2025-02-07 12:40:03', '2025-02-07 12:40:03', 1, 1),
(20, 'Dacia', 'dacia', NULL, 1, '2025-02-07 12:40:03', '2025-02-07 12:40:03', 1, 1),
(21, 'Honda', 'honda', NULL, 1, '2025-02-07 12:40:03', '2025-02-07 12:40:03', 1, 1),
(22, 'Audi', 'audi', NULL, 1, '2025-02-07 12:40:03', '2025-02-07 12:40:03', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_10_10_092830_create_pays_table', 1),
(3, '2023_10_10_093142_create_villes_table', 1),
(4, '2023_10_10_093154_create_quartiers_table', 1),
(5, '2023_10_10_095820_create_entreprises_table', 1),
(6, '2023_10_10_095900_create_users_table', 1),
(7, '2023_10_10_100000_create_password_reset_tokens_table', 1),
(8, '2023_10_10_102003_create_failed_jobs_table', 1),
(9, '2023_10_10_164750_create_permission_tables', 1),
(10, '2023_10_11_093249_create_references_table', 1),
(11, '2023_10_11_093255_create_reference_valeurs_table', 1),
(12, '2023_10_26_090451_create_heure_ouvertures_table', 1),
(13, '2023_11_04_161228_create_annonces_table', 1),
(14, '2023_11_05_062648_create_fichiers_table', 1),
(15, '2023_11_05_071713_create_auberges_table', 1),
(16, '2023_11_05_113150_annonce_fichier', 1),
(17, '2023_11_11_144721_create_annonce_reference_valeur_table', 1),
(18, '2023_11_25_115458_create_hotels_table', 1),
(19, '2023_12_09_151543_create_location_vehicules_table', 1),
(20, '2023_12_10_202138_create_location_meublees_table', 1),
(21, '2023_12_11_071133_create_boite_de_nuits_table', 1),
(22, '2023_12_28_162438_create_fast_foods_table', 2),
(23, '2023_12_29_091952_create_restaurants_table', 2),
(24, '2023_12_29_092008_create_patisseries_table', 2),
(25, '2023_12_29_092048_create_bars_table', 2),
(26, '2023_12_23_232518_add_slug_to_entreprises', 3),
(27, '2023_12_25_195817_add_slug_to_annonces', 4),
(28, '2024_01_10_075447_create_commentaires_table', 4),
(29, '2024_01_10_081229_create_favoris_table', 4),
(30, '2024_01_10_081819_create_notations_table', 4),
(31, '2024_01_10_085751_create_statistique_annonces_table', 4),
(32, '2024_01_11_160012_change_note_type_from_int_to_float_on_notations', 4),
(33, '2024_01_11_161311_add_column_nb_notation_to_statistique_annonces', 4),
(34, '2024_01_12_085126_add_image_to_annonces', 4),
(35, '2024_02_03_180603_add_soft_delete_to_favoris_and_comments', 5),
(36, '2024_03_23_053338_add_note_to_commentaires', 6),
(37, '2024_04_11_085646_create_offre_abonnements_table', 7),
(38, '2024_04_11_085701_create_abonnements_table', 7),
(39, '2024_04_11_091335_create_entreprise_user_table', 7),
(40, '2024_04_11_094128_create_activity_logs_table', 7),
(41, '2024_04_11_103457_add_icon_to_offre_abonnements', 7),
(42, '2024_04_12_100423_remove_required_to_attributes_in_entreprises', 7),
(43, '2024_04_14_092726_remove_entreprise_id_from_abonnements', 7),
(44, '2024_04_14_093035_create_abonnement_entreprise_table', 7),
(45, '2024_04_21_165417_add_index_on_annonces_table', 7),
(46, '2024_04_30_115538_create_transactions_table', 8),
(47, '2024_05_01_170631_add_slug_to_offre_abonnements_table', 8),
(48, '2024_05_11_124152_add_entreprise_to_transactions_table', 8),
(49, '2024_05_12_180853_add_offre_id_to_transactions_table', 8),
(50, '2024_05_13_124841_remove_abonnement_id_from_transactions_table', 8),
(51, '2024_05_18_125712_add_unique_constraint_to_transactions_table', 9),
(52, '2024_05_23_093116_add_entreprise_id_to_transactions_table', 9),
(53, '2024_05_23_093809_add_montant_to_abonnements_table', 9),
(54, '2024_07_11_155627_remove_softdelete_from_favoris', 10),
(55, '2024_07_28_083652_add_p_accompagnements_to_restaurants_table', 11),
(56, '2024_07_28_145027_change_prix_type_from_restaurants_table', 11),
(57, '2024_08_04_130708_remove_all_restaurant', 11),
(58, '2024_08_09_233021_create_jobs_table', 11),
(59, '2024_11_15_152809_create_views_table', 12),
(60, '2024_11_15_160758_remove_statistique_annonces_table', 12),
(61, '2025_01_06_105044_update_fields_in_restaurants_table', 13),
(62, '2025_01_16_081953_add_quartier_id_column_to_annonces_table', 14),
(63, '2025_01_16_082842_add_location_information_column_to_annonces_table', 14),
(64, '2025_02_03_222106_create_marques_table', 15),
(65, '2025_02_03_222243_create_modeles_table', 15),
(66, '2025_02_06_080051_add_modele_id_to_location_vehicules_table', 16),
(67, '2025_02_10_215446_add_some_columns_to_fast_foods_table', 17),
(68, '2025_02_11_150313_add_change_quartier_type_from_annonces', 17),
(69, '2025_02_18_081316_update_columns_from_patisseries_table', 18),
(70, '2025_02_18_084351_remove_unuseful_references_from_references_table', 18);

-- --------------------------------------------------------

--
-- Structure de la table `modeles`
--

CREATE TABLE `modeles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `marque_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modeles`
--

INSERT INTO `modeles` (`id`, `nom`, `slug`, `description`, `is_active`, `marque_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'Bravo', 'bravo', NULL, 1, 2, '2025-02-04 20:41:27', '2025-02-04 20:41:27', 1, 1),
(4, 'Picanto', 'picanto', NULL, 1, 2, '2025-02-04 20:41:59', '2025-02-04 20:41:59', 1, 1),
(5, 'Corolla', 'corolla', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(6, 'Avensis', 'avensis', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(7, 'Yaris', 'yaris', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(8, 'Camry', 'camry', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(9, 'Vitz', 'vitz', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(10, 'RAV4', 'rav4', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(11, 'Fortuner', 'fortuner', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(12, 'Land Cruiser Prado', 'land-cruiser-prado', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(13, 'Land Cruiser 70', 'land-cruiser-70', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(14, 'Land Cruiser V8', 'land-cruiser-v8', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(15, 'Hilux', 'hilux', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(16, 'Tacoma', 'tacoma', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(17, 'Tundra', 'tundra', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(18, 'HiAce', 'hiace', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(19, 'Coaster', 'coaster', NULL, 1, 3, '2025-02-07 12:40:38', '2025-02-07 12:40:38', 1, 1),
(20, 'i10', 'i10', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(21, 'i20', 'i20', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(22, 'i30', 'i30', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(23, 'Elantra', 'elantra', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(24, 'Sonata', 'sonata', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(25, 'Tucson', 'tucson', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(26, 'Santa Fe', 'santa-fe', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(27, 'Creta', 'creta', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(28, 'Palisade', 'palisade', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(29, 'H-100', 'h-100', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(30, 'Porter II', 'porter-ii', NULL, 1, 4, '2025-02-07 12:40:57', '2025-02-07 12:40:57', 1, 1),
(31, 'Sunny', 'sunny', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(32, 'Almera', 'almera', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(33, 'Sentra', 'sentra', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(34, 'Maxima', 'maxima', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(35, 'Qashqai', 'qashqai', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(36, 'X-Trail', 'x-trail', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(37, 'Pathfinder', 'pathfinder', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(38, 'Patrol', 'patrol', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(39, 'Terrano', 'terrano', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(40, 'Navara', 'navara', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(41, 'Frontier', 'frontier', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(42, 'Hardbody', 'hardbody', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(43, 'Urvan', 'urvan', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(44, 'Caravan', 'caravan', NULL, 1, 5, '2025-02-07 12:41:14', '2025-02-07 12:41:14', 1, 1),
(45, 'Mazda 323', 'mazda-323', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(46, 'Mazda2', 'mazda2', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(47, 'Mazda3', 'mazda3', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(48, 'Mazda6', 'mazda6', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(49, 'CX-3', 'cx-3', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(50, 'CX-5', 'cx-5', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(51, 'CX-9', 'cx-9', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(52, 'BT-50', 'bt-50', NULL, 1, 6, '2025-02-07 12:41:36', '2025-02-07 12:41:36', 1, 1),
(53, 'Série 1', 'serie-1', NULL, 1, 7, '2025-02-07 12:41:52', '2025-02-07 12:41:52', 1, 1),
(54, 'Série 3', 'serie-3', NULL, 1, 7, '2025-02-07 12:41:52', '2025-02-07 12:41:52', 1, 1),
(55, 'Série 5', 'serie-5', NULL, 1, 7, '2025-02-07 12:41:52', '2025-02-07 12:41:52', 1, 1),
(56, 'Série 7', 'serie-7', NULL, 1, 7, '2025-02-07 12:41:52', '2025-02-07 12:41:52', 1, 1),
(57, 'X1', 'x1', NULL, 1, 7, '2025-02-07 12:41:53', '2025-02-07 12:41:53', 1, 1),
(58, 'X3', 'x3', NULL, 1, 7, '2025-02-07 12:41:53', '2025-02-07 12:41:53', 1, 1),
(59, 'X5', 'x5', NULL, 1, 7, '2025-02-07 12:41:53', '2025-02-07 12:41:53', 1, 1),
(60, 'X6', 'x6', NULL, 1, 7, '2025-02-07 12:41:53', '2025-02-07 12:41:53', 1, 1),
(61, 'Classe A', 'classe-a', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(62, 'Classe C', 'classe-c', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(63, 'Classe E', 'classe-e', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(64, 'Classe S', 'classe-s', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(65, 'GLA', 'gla', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(66, 'GLC', 'glc', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(67, 'GLE', 'gle', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(68, 'GLS', 'gls', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(69, 'Classe G', 'classe-g', NULL, 1, 8, '2025-02-07 12:42:16', '2025-02-07 12:42:16', 1, 1),
(70, 'Polo', 'polo', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(71, 'Golf', 'golf', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(72, 'Passat', 'passat', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(73, 'Jetta', 'jetta', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(74, 'Tiguan', 'tiguan', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(75, 'Touareg', 'touareg', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(76, 'T-Roc', 't-roc', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(77, 'Transporter', 'transporter', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(78, 'Amarok', 'amarok', NULL, 1, 9, '2025-02-07 12:42:31', '2025-02-07 12:42:31', 1, 1),
(79, 'Picanto', 'picanto', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(80, 'Rio', 'rio', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(81, 'Ceed', 'ceed', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(82, 'Forte', 'forte', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(83, 'Sportage', 'sportage', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(84, 'Sorento', 'sorento', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(85, 'Seltos', 'seltos', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(86, 'K2700', 'k2700', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(87, 'K2500', 'k2500', NULL, 1, 10, '2025-02-07 12:42:45', '2025-02-07 12:42:45', 1, 1),
(88, 'Clio', 'clio', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(89, 'Logan', 'logan', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(90, 'Symbol', 'symbol', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(91, 'Duster', 'duster', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(92, 'Koleos', 'koleos', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(93, 'Captur', 'captur', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(94, 'Trafic', 'trafic', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(95, 'Master', 'master', NULL, 1, 11, '2025-02-07 12:43:01', '2025-02-07 12:43:01', 1, 1),
(96, '206', '206', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(97, '207', '207', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(98, '208', '208', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(99, '301', '301', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(100, '308', '308', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(101, '508', '508', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(102, '2008', '2008', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(103, '3008', '3008', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(104, '5008', '5008', NULL, 1, 12, '2025-02-07 12:43:15', '2025-02-07 12:43:15', 1, 1),
(105, 'Pajero', 'pajero', NULL, 1, 13, '2025-02-07 12:43:30', '2025-02-07 12:43:30', 1, 1),
(106, 'Montero', 'montero', NULL, 1, 13, '2025-02-07 12:43:30', '2025-02-07 12:43:30', 1, 1),
(107, 'Outlander', 'outlander', NULL, 1, 13, '2025-02-07 12:43:30', '2025-02-07 12:43:30', 1, 1),
(108, 'L200', 'l200', NULL, 1, 13, '2025-02-07 12:43:30', '2025-02-07 12:43:30', 1, 1),
(109, 'Triton', 'triton', NULL, 1, 13, '2025-02-07 12:43:31', '2025-02-07 12:43:31', 1, 1),
(110, 'Canter', 'canter', NULL, 1, 13, '2025-02-07 12:43:31', '2025-02-07 12:43:31', 1, 1),
(111, 'Fiesta', 'fiesta', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(112, 'Focus', 'focus', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(113, 'Fusion', 'fusion', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(114, 'Escape', 'escape', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(115, 'Explorer', 'explorer', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(116, 'Edge', 'edge', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(117, 'Ranger', 'ranger', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(118, 'F-150', 'f-150', NULL, 1, 14, '2025-02-07 12:43:45', '2025-02-07 12:43:45', 1, 1),
(119, 'Range Rover', 'range-rover', NULL, 1, 15, '2025-02-07 12:43:58', '2025-02-07 12:43:58', 1, 1),
(120, 'Range Rover Sport', 'range-rover-sport', NULL, 1, 15, '2025-02-07 12:43:58', '2025-02-07 12:43:58', 1, 1),
(121, 'Discovery', 'discovery', NULL, 1, 15, '2025-02-07 12:43:58', '2025-02-07 12:43:58', 1, 1),
(122, 'Defender', 'defender', NULL, 1, 15, '2025-02-07 12:43:58', '2025-02-07 12:43:58', 1, 1),
(123, 'Corsa', 'corsa', NULL, 1, 16, '2025-02-07 12:44:12', '2025-02-07 12:44:12', 1, 1),
(124, 'Astra', 'astra', NULL, 1, 16, '2025-02-07 12:44:12', '2025-02-07 12:44:12', 1, 1),
(125, 'Insignia', 'insignia', NULL, 1, 16, '2025-02-07 12:44:12', '2025-02-07 12:44:12', 1, 1),
(126, 'Mokka', 'mokka', NULL, 1, 16, '2025-02-07 12:44:12', '2025-02-07 12:44:12', 1, 1),
(127, 'Grandland X', 'grandland-x', NULL, 1, 16, '2025-02-07 12:44:12', '2025-02-07 12:44:12', 1, 1),
(128, 'Swift', 'swift', NULL, 1, 17, '2025-02-07 12:44:25', '2025-02-07 12:44:25', 1, 1),
(129, 'Vitara', 'vitara', NULL, 1, 17, '2025-02-07 12:44:25', '2025-02-07 12:44:25', 1, 1),
(130, 'Jimny', 'jimny', NULL, 1, 17, '2025-02-07 12:44:25', '2025-02-07 12:44:25', 1, 1),
(131, 'S-Cross', 's-cross', NULL, 1, 17, '2025-02-07 12:44:25', '2025-02-07 12:44:25', 1, 1),
(132, 'Ignis', 'ignis', NULL, 1, 17, '2025-02-07 12:44:25', '2025-02-07 12:44:25', 1, 1),
(133, 'Octavia', 'octavia', NULL, 1, 18, '2025-02-07 12:44:40', '2025-02-07 12:44:40', 1, 1),
(134, 'Superb', 'superb', NULL, 1, 18, '2025-02-07 12:44:40', '2025-02-07 12:44:40', 1, 1),
(135, 'Kodiaq', 'kodiaq', NULL, 1, 18, '2025-02-07 12:44:40', '2025-02-07 12:44:40', 1, 1),
(136, 'Karoq', 'karoq', NULL, 1, 18, '2025-02-07 12:44:40', '2025-02-07 12:44:40', 1, 1),
(137, 'Fabia', 'fabia', NULL, 1, 18, '2025-02-07 12:44:40', '2025-02-07 12:44:40', 1, 1),
(138, 'C3', 'c3', NULL, 1, 19, '2025-02-07 12:45:09', '2025-02-07 12:45:09', 1, 1),
(139, 'C4', 'c4', NULL, 1, 19, '2025-02-07 12:45:09', '2025-02-07 12:45:09', 1, 1),
(140, 'C5 Aircross', 'c5-aircross', NULL, 1, 19, '2025-02-07 12:45:09', '2025-02-07 12:45:09', 1, 1),
(141, 'Berlingo', 'berlingo', NULL, 1, 19, '2025-02-07 12:45:09', '2025-02-07 12:45:09', 1, 1),
(142, 'ë-C4', 'e-c4', NULL, 1, 19, '2025-02-07 12:45:09', '2025-02-07 12:45:09', 1, 1),
(143, 'Sandero', 'sandero', NULL, 1, 20, '2025-02-07 12:45:22', '2025-02-07 12:45:22', 1, 1),
(144, 'Duster', 'duster', NULL, 1, 20, '2025-02-07 12:45:22', '2025-02-07 12:45:22', 1, 1),
(145, 'Logan', 'logan', NULL, 1, 20, '2025-02-07 12:45:22', '2025-02-07 12:45:22', 1, 1),
(146, 'Spring', 'spring', NULL, 1, 20, '2025-02-07 12:45:22', '2025-02-07 12:45:22', 1, 1),
(147, 'Civic', 'civic', NULL, 1, 21, '2025-02-07 12:45:33', '2025-02-07 12:45:33', 1, 1),
(148, 'Accord', 'accord', NULL, 1, 21, '2025-02-07 12:45:33', '2025-02-07 12:45:33', 1, 1),
(149, 'CR-V', 'cr-v', NULL, 1, 21, '2025-02-07 12:45:33', '2025-02-07 12:45:33', 1, 1),
(150, 'HR-V', 'hr-v', NULL, 1, 21, '2025-02-07 12:45:33', '2025-02-07 12:45:33', 1, 1),
(151, 'Jazz', 'jazz', NULL, 1, 21, '2025-02-07 12:45:33', '2025-02-07 12:45:33', 1, 1),
(152, 'NSX', 'nsx', NULL, 1, 21, '2025-02-07 12:45:33', '2025-02-07 12:45:33', 1, 1),
(153, 'A4', 'a4', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1),
(154, 'A6', 'a6', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1),
(155, 'Q5', 'q5', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1),
(156, 'Q7', 'q7', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1),
(157, 'TT', 'tt', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1),
(158, 'R8', 'r8', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1),
(159, 'e-tron', 'e-tron', NULL, 1, 22, '2025-02-07 12:45:44', '2025-02-07 12:45:44', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23);

-- --------------------------------------------------------

--
-- Structure de la table `notations`
--

CREATE TABLE `notations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` double(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre_abonnements`
--

CREATE TABLE `offre_abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offre_abonnements`
--

INSERT INTO `offre_abonnements` (`id`, `libelle`, `description`, `duree`, `prix`, `is_active`, `options`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `icon`) VALUES
(1, 'Offre 1', 'Offre 1', 1, 150.00, 1, NULL, '2024-04-21 17:03:42', '2024-04-21 17:03:42', NULL, NULL, NULL, NULL, NULL),
(2, 'Offre 2', 'Offre 2', 2, 200.00, 1, NULL, '2024-04-21 17:03:42', '2024-04-21 17:03:42', NULL, NULL, NULL, NULL, NULL),
(3, 'Offre 3', 'Offre 3', 3, 35000.00, 1, NULL, '2024-04-21 17:03:42', '2024-04-21 17:03:42', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('billalisonhouin@gmail.com', '$2y$10$O8ZPZcyQOn0S/MBoZuMNIucv1eXdJQWPrSqhmD66O1Wc0fOBh/FKi', '2024-10-16 12:24:34'),
('matyanika@gmail.com', '$2y$10$IcXV8zG.j0hiEs127RK5OOrfDp5W/xI6v1AWoZJoBo8JMTbUFE/uW', '2025-01-22 07:54:07'),
('sylviane.vieira@gmail.com', '$2y$10$sC9QT65XMWNm8oECgDSX8.LtYFz0RblugQajttwzYAuwceiaxFW2a', '2024-10-25 16:09:13');

-- --------------------------------------------------------

--
-- Structure de la table `patisseries`
--

CREATE TABLE `patisseries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `nom_produit` varchar(255) DEFAULT NULL,
  `accompagnement_produit` varchar(255) DEFAULT NULL,
  `prix_produit` varchar(255) DEFAULT NULL,
  `image_produit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patisseries`
--

INSERT INTO `patisseries` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `nom_produit`, `accompagnement_produit`, `prix_produit`, `image_produit`) VALUES
(1, '2023-12-31 15:29:45', '2024-01-20 20:37:37', NULL, 1, 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `indicatif` varchar(255) NOT NULL,
  `langue` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `nom`, `slug`, `code`, `indicatif`, `langue`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Togo', 'togo', 'TG', '+228', 'Français', '2023-12-12 13:12:42', '2025-02-08 14:08:45', NULL, 1, 1, NULL),
(2, 'France', 'france', 'FR', '+33', 'Français', '2025-02-03 20:30:03', '2025-02-03 20:31:23', '2025-02-03 20:31:23', 1, 1, 1),
(3, 'Bénin', 'benin', 'BJ', '+229', 'Français', '2025-02-08 14:03:37', '2025-02-08 14:03:37', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quartiers`
--

CREATE TABLE `quartiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ville_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quartiers`
--

INSERT INTO `quartiers` (`id`, `nom`, `slug`, `ville_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Avedji', 'avedji', 1, '2023-12-12 13:12:42', '2023-12-12 13:12:42', NULL, 1, 1, NULL),
(2, 'Adidogomé', 'adidogome', 1, '2024-02-03 21:32:57', '2024-02-03 21:32:57', NULL, 2, 2, NULL),
(3, 'Soviépé', 'soviepe', 1, '2024-02-03 21:33:12', '2024-02-03 21:33:12', NULL, 2, 2, NULL),
(4, 'Soviépé, Totsi', 'soviepe-totsi', 1, '2024-12-09 16:31:19', '2024-12-09 16:31:19', NULL, 21, 21, NULL),
(5, 'q1', 'q1', 67, '2025-02-03 20:31:06', '2025-02-03 20:31:23', '2025-02-03 20:31:23', 1, 1, 1),
(6, 'q2', 'q2', 67, '2025-02-03 20:31:06', '2025-02-03 20:31:23', '2025-02-03 20:31:23', 1, 1, 1),
(7, 'Zanguéra', 'zanguera', 1, '2025-02-16 07:40:17', '2025-02-16 07:40:17', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `references`
--

CREATE TABLE `references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `slug_type` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug_nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `references`
--

INSERT INTO `references` (`id`, `type`, `slug_type`, `nom`, `slug_nom`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Hébergement', 'hebergement', 'Commodités hébergement', 'commodites-hebergement', '2024-11-20 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(2, 'Hébergement', 'hebergement', 'Services proposés', 'services-proposes', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(3, 'Hébergement', 'hebergement', 'Types de lit', 'types-de-lit', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(4, 'Hébergement', 'hebergement', 'Equipements hébergement', 'equipements-hebergement', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(5, 'Hébergement', 'hebergement', 'Equipements salle de bain', 'equipements-salle-de-bain', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(6, 'Hébergement', 'hebergement', 'Accessoires de cuisines', 'accessoires-cuisine', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(7, 'Hébergement', 'hebergement', 'Types hebergement', 'types-hebergement', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(8, 'Location de véhicule', 'location-de-vehicule', 'Type de voiture', 'types-de-voiture', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(9, 'Location de véhicule', 'location-de-vehicule', 'Options et accesoires', 'options-accessoires', '2024-11-22 07:43:32', '2024-11-22 07:43:32', NULL, 1, 1, NULL),
(10, 'Restauration', 'restauration', 'Boissons disponibles', 'boissons-disponibles', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(11, 'Location de véhicule', 'location-de-vehicule', 'Boite de vitesses', 'boite-de-vitesses', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(12, 'Location de véhicule', 'location-de-vehicule', 'Conditions de location', 'conditions-de-location', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(13, 'Marque', 'marque', 'Marques de véhicule', 'marques-de-vehicule', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(14, 'Restauration', 'restauration', 'Equipements restauration', 'equipements-restauration', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(15, 'Restauration', 'restauration', 'Equipements patisserie', 'equipements-patisserie', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(16, 'Restauration', 'restauration', 'Produits fast-food', 'produits-fast-food', '2024-11-22 07:43:33', '2025-02-20 06:39:22', '2025-02-20 06:39:22', 1, 1, NULL),
(17, 'Restauration', 'restauration', 'Produits patissiers', 'produits-patissiers', '2024-11-22 07:43:33', '2025-02-20 06:39:22', '2025-02-20 06:39:22', 1, 1, NULL),
(18, 'Location de véhicule', 'location-de-vehicule', 'Type de moteur', 'types-moteur', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(19, 'Vie nocturne', 'vie-nocturne', 'Types de musique', 'types-de-musique', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(20, 'Vie nocturne', 'vie-nocturne', 'Commodités vie nocturne', 'commodites-vie-nocturne', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(21, 'Vie nocturne', 'vie-nocturne', 'Equipements vie nocturne', 'equipements-vie-nocturne', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(22, 'Restauration', 'restauration', 'Types de cuisine', 'types-cuisine', '2024-11-22 07:43:33', '2024-11-22 07:43:33', NULL, 1, 1, NULL),
(23, 'Vie nocturne', 'vie-nocturne', 'Services', 'services', '2024-12-23 08:52:13', '2024-12-23 08:52:18', NULL, 1, 1, NULL),
(24, 'Restauration', 'restauration', 'Services proposés', 'services-proposes', '2024-12-23 09:06:05', '2024-12-23 09:06:07', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reference_valeurs`
--

CREATE TABLE `reference_valeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `valeur` varchar(255) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reference_valeurs`
--

INSERT INTO `reference_valeurs` (`id`, `valeur`, `reference_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Piscine', 1, '2024-11-21 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(2, 'Salle de sport', 1, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(3, 'Balcon/terrasse', 1, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(4, 'Jardin ou barbecue', 1, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(5, 'Jeux et divertissements', 1, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(6, 'Nettoyage d\'entrée/sortie', 2, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(7, 'Conciergerie', 2, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(8, 'Gardiennage', 2, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(9, 'Petit déjeuner compris', 2, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(10, 'Lit simple', 3, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(11, 'Lit double', 3, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(12, 'Queen size', 3, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(13, 'Lit bébé', 3, '2024-11-22 07:59:53', '2024-12-11 08:06:38', '2024-12-11 08:06:38', 1, 1, 1),
(14, 'Lits superposés', 3, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(15, 'Placards, commodes, armoires', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(16, 'Système de sécurité (caméras, alarmes)', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(17, 'Connexion internet', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(18, 'Détecteurs de fumée et de monoxyde de carbone', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(19, 'Aspirateur ', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(20, 'Multiprises et chargeurs', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(21, 'Canapé', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(22, 'Lave-linge.', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(23, 'Sèche-linge (ou étendoir)', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(24, 'Table et fer à repasser', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(25, 'Kit de premiers secours', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(26, 'Jeux ou jouets', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(27, 'Climatisée', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(28, 'Ventilée', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(29, 'Téléviseur', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(30, 'Imprimante', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(31, 'Ordinateur', 4, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(32, 'Lavabo ou Vasque', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(33, 'Cabine de douche', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(34, 'Baignoire', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(35, 'WC intégré salle de bain', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(36, 'WC séparé', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(37, 'Panier à linge', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(38, 'Armoire de toilette', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(39, 'Colonnes de rangement', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(40, 'Eau chaude', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(41, 'Tapis de bain', 5, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(42, 'Four', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(43, 'Plaques de cuissons', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(44, 'Plan de travail', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(45, 'Réfrigérateur', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(46, 'Lave-vaisselle', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(47, 'Hotte aspirante', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(48, 'Poubelle intégrée', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(49, 'Micro-ondes', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(50, 'Bouilloire', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(51, 'Blendeur/mixeur', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(52, 'Machine à café', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(53, 'Grille-pain', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(54, 'Friteuse', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(55, 'Verres à vin', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(56, 'Couverts', 6, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(57, 'Maison T4 (3 chambres salon)', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(58, 'Maison T3 (2 chambres salon)', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(59, 'Maison T2 (chambre salon)', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(60, 'T1 ou Studio', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(61, 'Appartement T4 (3 chambres)', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(62, 'Appartement T3 (2 chambres)', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(63, 'Appartement T2 (Chambre salon)', 7, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(64, 'Utilitaire ( Camion )', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(65, 'Citadine', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(66, 'Berline', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(67, 'Familiale ( 7 places ) ', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(68, '4x4', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(69, 'SUV', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(70, 'Minibus', 8, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(71, 'Climatisation', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(72, 'Sièges réglables ', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(73, 'Accoudoir central', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(74, 'Pare-soleil avec miroir éclairé', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(75, 'Airbags (frontaux, latéraux, rideaux)', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(76, 'Caméra de recul', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(77, 'Freinage automatique d’urgence', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(78, 'Navigation GPS', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(79, 'Commandes vocales', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(80, 'Connectivité Bluetooth et USB', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(81, 'Apple CarPlay / Android Auto', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(82, 'Pare-soleil intégrés', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(83, 'Régulateur de vitesse', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(84, 'Limiteur de vitesse', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(85, 'Caméra 360°', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(86, 'Toit ouvrant ou panoramique', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(87, 'Feux antibrouillard', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(88, 'Siège bébé ou fixation ISOFIX', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(89, 'Espace de rangement sous le coffre', 9, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(90, 'Minimum 3 jours', 12, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(91, '18 ans minimum', 12, '2024-11-22 07:59:53', '2024-12-02 14:39:02', NULL, 1, 1, NULL),
(92, 'Ancienneté de 2 ans de permis', 12, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(93, 'Ancienneté de plus de 3 ans de permis', 12, '2024-11-22 07:59:53', '2024-12-02 14:33:34', NULL, 1, 1, NULL),
(94, 'Ne doit pas traverser une frontière', 12, '2024-11-22 07:59:53', '2024-11-22 07:59:53', NULL, 1, 1, NULL),
(95, 'Spe1', 22, '2024-11-22 08:57:27', '2024-11-22 12:48:59', '2024-11-22 12:48:59', 1, 1, 1),
(96, 'cwe', 6, '2024-11-22 12:26:54', '2024-11-22 12:48:52', '2024-11-22 12:48:52', 1, 1, 1),
(97, 'fgbgbgb', 6, '2024-11-22 12:52:59', '2024-11-22 12:53:51', '2024-11-22 12:53:51', 1, 1, 1),
(98, 'frfefefre', 1, '2024-11-22 13:01:10', '2024-11-22 13:01:48', '2024-11-22 13:01:48', 1, 1, 1),
(99, 'cwecwcece', 6, '2024-11-22 13:05:02', '2024-11-22 13:21:01', '2024-11-22 13:21:01', 1, 1, 1),
(100, 'cwececwe', 20, '2024-11-22 13:05:09', '2024-11-22 13:20:53', '2024-11-22 13:20:53', 1, 1, 1),
(101, 'ecwece', 4, '2024-11-22 13:05:51', '2024-11-22 13:20:48', '2024-11-22 13:20:48', 1, 1, 1),
(102, 'dwdwedew', 6, '2024-11-22 13:06:03', '2024-11-22 13:20:45', '2024-11-22 13:20:45', 1, 1, 1),
(103, 'eerfrer', 1, '2024-11-22 13:11:51', '2024-11-22 13:20:41', '2024-11-22 13:20:41', 1, 1, 1),
(104, 'cdcdcfc', 6, '2024-11-22 13:12:27', '2024-11-22 13:20:37', '2024-11-22 13:20:37', 1, 1, 1),
(105, 'efrferfer', 12, '2024-11-22 13:12:48', '2024-11-22 13:20:31', '2024-11-22 13:20:31', 1, 1, 1),
(106, 'scdscsd', 1, '2024-11-22 13:18:08', '2024-11-22 13:19:04', '2024-11-22 13:19:04', 1, 1, 1),
(107, 'Commodité test 2', 1, '2024-11-23 18:39:48', '2024-11-23 18:40:08', '2024-11-23 18:40:08', 1, 1, 1),
(108, 'TOYOTA', 13, '2024-11-23 20:03:54', '2024-11-23 20:03:54', NULL, 1, 1, NULL),
(109, 'Ras', 6, '2024-11-23 20:05:59', '2024-12-02 12:51:28', '2024-12-02 12:51:28', 1, 1, 1),
(110, 'dwede', 1, '2024-11-23 20:08:28', '2024-12-02 12:51:23', '2024-12-02 12:51:23', 1, 1, 1),
(111, 'dwde', 1, '2024-11-23 20:09:50', '2024-12-02 12:51:19', '2024-12-02 12:51:19', 1, 1, 1),
(112, 'dewedw', 12, '2024-11-23 20:10:53', '2024-12-02 12:51:13', '2024-12-02 12:51:13', 1, 1, 1),
(113, 'OPEL', 13, '2024-12-19 14:27:26', '2024-12-19 14:27:26', NULL, 1, 1, NULL),
(114, 'AUDI', 13, '2024-12-19 14:27:40', '2024-12-19 14:27:40', NULL, 1, 1, NULL),
(115, 'MAZDA', 13, '2024-12-19 14:29:01', '2024-12-19 14:29:01', NULL, 1, 1, NULL),
(116, ' ', 13, '2024-12-19 14:29:01', '2024-12-19 14:31:50', '2024-12-19 14:31:50', 1, 1, 1),
(117, 'BMW', 13, '2024-12-19 14:29:01', '2024-12-19 14:29:01', NULL, 1, 1, NULL),
(118, 'ABe', 13, '2024-12-19 14:31:41', '2024-12-23 09:10:52', '2024-12-23 09:10:52', 1, 1, 1),
(119, 'QS', 13, '2024-12-19 14:31:41', '2024-12-19 14:39:32', '2024-12-19 14:39:32', 1, 1, 1),
(120, 'QSR,bf,bf', 13, '2024-12-19 14:31:41', '2024-12-19 14:39:24', '2024-12-19 14:39:24', 1, 1, 1),
(121, 'TEST 12378787', 13, '2024-12-19 14:36:23', '2024-12-19 14:39:19', '2024-12-19 14:39:19', 1, 1, 1),
(122, 'QSR', 13, '2024-12-19 14:36:44', '2024-12-19 14:39:28', '2024-12-19 14:39:28', 1, 1, 1),
(123, 'TEST 123', 13, '2024-12-19 14:36:58', '2024-12-19 14:39:05', '2024-12-19 14:39:05', 1, 1, 1),
(124, 'TESTA 1237', 13, '2024-12-19 14:37:04', '2024-12-19 14:39:01', '2024-12-19 14:39:01', 1, 1, 1),
(125, 'Dîner sur place', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(126, 'à emporter', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(127, 'livraison', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(128, 'Wifi disponible', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(129, 'Réservation obligatoire', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(130, 'Parking', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(131, 'organisation d\'événement', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(132, 'payement par carte bancaire', 24, '2024-12-23 09:07:57', '2024-12-23 09:07:57', NULL, 1, 1, NULL),
(133, 'Test 123', 20, '2024-12-23 14:03:07', '2024-12-23 14:04:23', '2024-12-23 14:04:23', 1, 1, 1),
(134, 'Eq vie noc', 21, '2024-12-23 14:03:35', '2024-12-23 14:04:19', '2024-12-23 14:04:19', 1, 1, 1),
(135, 'test', 12, '2024-12-26 13:41:51', '2024-12-26 13:41:57', '2024-12-26 13:41:57', 1, 1, 1),
(136, 'Manuelle', 11, '2024-12-26 14:45:42', '2024-12-26 14:45:42', NULL, 1, 1, NULL),
(137, 'type1', 8, '2024-12-26 14:47:14', '2024-12-30 20:33:15', '2024-12-30 20:33:15', 1, 1, 1),
(138, 'type2', 8, '2024-12-26 14:47:49', '2024-12-30 20:33:11', '2024-12-30 20:33:11', 1, 1, 1),
(139, 'type3', 8, '2024-12-26 14:47:49', '2024-12-30 20:33:07', '2024-12-30 20:33:07', 1, 1, 1),
(140, 'moteur1', 18, '2024-12-26 14:55:28', '2024-12-30 20:33:03', '2024-12-30 20:33:03', 1, 1, 1),
(141, 'Coca-cola', 10, '2025-01-25 18:36:26', '2025-01-25 18:36:26', NULL, 21, 21, NULL),
(142, 'QWQ', 14, '2025-02-03 20:32:44', '2025-02-03 20:36:17', '2025-02-03 20:36:17', 1, 1, 1),
(143, 'ty1', 18, '2025-02-03 20:35:55', '2025-02-03 20:36:12', '2025-02-03 20:36:12', 1, 1, 1),
(144, 't2', 18, '2025-02-03 20:35:56', '2025-02-03 20:36:08', '2025-02-03 20:36:08', 1, 1, 1),
(145, 't1', 19, '2025-02-03 20:37:37', '2025-02-03 20:38:37', '2025-02-03 20:38:37', 1, 1, 1),
(146, 't2', 19, '2025-02-03 20:37:37', '2025-02-03 20:38:33', '2025-02-03 20:38:33', 1, 1, 1),
(147, 'e1', 21, '2025-02-03 20:37:55', '2025-02-03 20:38:29', '2025-02-03 20:38:29', 1, 1, 1),
(148, 'qw', 16, '2025-02-03 20:39:10', '2025-02-03 20:40:04', '2025-02-03 20:40:04', 1, 1, 1),
(149, 'qwqw', 14, '2025-02-03 20:39:28', '2025-02-03 20:40:02', '2025-02-03 20:40:02', 1, 1, 1),
(150, 'p1', 17, '2025-02-03 20:40:20', '2025-02-03 20:41:22', '2025-02-03 20:41:22', 1, 1, 1),
(151, 'e1', 14, '2025-02-03 20:40:33', '2025-02-03 20:41:19', '2025-02-03 20:41:19', 1, 1, 1),
(152, 'tr', 15, '2025-02-03 20:40:51', '2025-02-03 20:41:15', '2025-02-03 20:41:15', 1, 1, 1),
(153, 'qw', 21, '2025-02-03 20:41:45', '2025-02-03 20:42:17', '2025-02-03 20:42:17', 1, 1, 1),
(154, 'crer', 20, '2025-02-03 20:42:00', '2025-02-03 20:42:13', '2025-02-03 20:42:13', 1, 1, 1),
(155, 'Essence', 18, '2025-02-06 20:31:24', '2025-02-06 20:31:24', NULL, 1, 1, NULL),
(156, 'Gas-oil', 18, '2025-02-06 20:31:24', '2025-02-06 20:31:24', NULL, 1, 1, NULL),
(157, 'Hybride', 18, '2025-02-06 20:31:24', '2025-02-06 20:31:24', NULL, 1, 1, NULL),
(158, 'Équipements restauration 1', 14, '2025-02-16 07:37:04', '2025-02-16 07:37:04', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `e_nom` varchar(255) NOT NULL,
  `e_slug` varchar(255) NOT NULL,
  `e_ingredients` text DEFAULT NULL,
  `e_prix_min` varchar(255) NOT NULL,
  `e_prix_max` varchar(255) NOT NULL,
  `p_nom` varchar(255) NOT NULL,
  `p_slug` varchar(255) NOT NULL,
  `p_ingredients` text DEFAULT NULL,
  `p_prix_min` varchar(255) NOT NULL,
  `p_prix_max` varchar(255) NOT NULL,
  `d_nom` varchar(255) NOT NULL,
  `d_slug` varchar(255) NOT NULL,
  `d_ingredients` text DEFAULT NULL,
  `d_prix_min` varchar(255) NOT NULL,
  `d_prix_max` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `p_accompagnements` varchar(255) DEFAULT NULL,
  `e_image` varchar(255) DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `d_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurants`
--

INSERT INTO `restaurants` (`id`, `e_nom`, `e_slug`, `e_ingredients`, `e_prix_min`, `e_prix_max`, `p_nom`, `p_slug`, `p_ingredients`, `p_prix_min`, `p_prix_max`, `d_nom`, `d_slug`, `d_ingredients`, `d_prix_min`, `d_prix_max`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `p_accompagnements`, `e_image`, `p_image`, `d_image`) VALUES
(1, 'Sit amet quod archi|||Aute velit illo ad |||Non natus magni duci|||', 'sit-amet-quod-archiaute-velit-illo-ad-non-natus-magni-duci', 'Sint quia eveniet |||Animi ea repellendu|||Velit dignissimos vo|||', '028|||45|||72|||', '022|||43|||66|||', 'Quis eligendi delect|||', 'quis-eligendi-delect', 'Laborum Incidunt d|||', '02|||', '024|||', 'Rerum blanditiis mol|||Error omnis itaque s|||', 'rerum-blanditiis-molerror-omnis-itaque-s', 'Sunt nostrud necessi|||Hic quia eveniet eu|||', '039|||62|||', '083|||374|||', '2024-08-27 17:26:39', '2024-08-27 17:26:39', NULL, 1, 1, NULL, 'Veritatis eos aut e|||', NULL, NULL, NULL),
(2, 'Soupe au chou |||Toasts chèvre|||', 'soupe-au-chou-toasts-chevre', 'Choux, carottes, pommes de terres|||Fromage de chèvre|||', '06|||12|||', '012|||18|||', 'Gratin de chou fleur|||', 'gratin-de-chou-fleur', 'Pomme de terre, chou fleur, fromage|||', '09|||', '09|||', 'Fondant au chocolat|||', 'fondant-au-chocolat', 'Chocolat, oeufs, beurre, maizena|||', '05|||', '05|||', '2024-11-16 16:27:57', '2024-11-16 16:27:57', NULL, 21, 21, NULL, 'Frites|||', NULL, NULL, NULL),
(3, 'Entrée 1|||', 'entree-1', 'En 1|||', '12000|||', '12000|||', 'Plat 2|||', 'plat-2', 'En 2|||', '150000|||', '150000|||', 'Dessert 1|||', 'dessert-1', 'EN 3|||', '180000|||', '180000|||', '2025-01-22 13:19:58', '2025-01-22 13:19:58', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(4, '121212|||', '121212', '121212|||', '0121212|||', '0121212|||', '323232|||', '323232', '323232|||', '032323|||', '032323|||', 'Dessert|||', 'dessert', 'Dessert|||', '02300|||', '02300|||', '2025-01-25 16:21:47', '2025-01-25 16:21:47', NULL, 1, 1, NULL, '|||', '139,', '140,', '141,');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', 'web', '2023-12-12 13:12:42', '2023-12-12 13:12:42'),
(2, 'Professionnel', 'web', '2023-12-12 13:12:42', '2023-12-12 13:12:42'),
(3, 'Usager', 'web', '2023-12-12 13:12:42', '2023-12-12 13:12:42');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `montant` double DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `pay_id` varchar(255) DEFAULT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `trans_status` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `error_message` varchar(255) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `numero_whatsapp` varchar(255) DEFAULT NULL,
  `offre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entreprise_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `montant`, `trans_id`, `method`, `pay_id`, `buyer_name`, `trans_status`, `signature`, `phone`, `error_message`, `statut`, `date_paiement`, `created_at`, `updated_at`, `entreprise`, `numero`, `numero_whatsapp`, `offre_id`, `entreprise_id`) VALUES
(1, 7, 200, '44157817160345572496', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', '80a288d0ba83c882802da596835f9c72e5028affbfb1ac24c80e9b12eadf6711', '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 10:15:58', '2024-05-18 10:15:58', 'VAMIYI', '84 94 94 94', '98 94 94 94', 2, NULL),
(2, 7, 100, '47358217160377586273', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:09:18', '2024-05-18 11:09:18', 'In qui illum et eli', '12 35 81 97', '88', 1, NULL),
(3, 7, 100, '47358817160377585065', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:09:19', '2024-05-18 11:09:19', 'In qui illum et eli', '12 35 81 97', '88 87 8', 1, NULL),
(4, 7, 100, '47359417160377593817', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:09:20', '2024-05-18 11:09:20', 'In qui illum et eli', '12 35 81 97', '88 87 87 87', 1, NULL),
(5, 7, 100, '47360017160377604266', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:09:20', '2024-05-18 11:09:20', 'In qui illum et eli', '12 35 81 97', '88 87 8', 1, NULL),
(6, 7, 100, '47361817160377611889', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:09:22', '2024-05-18 11:09:22', 'In qui illum et eli', '12 35 81 97', '88 87 87 87', 1, NULL),
(7, 7, 100, '47362917160377624119', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:09:23', '2024-05-18 11:09:23', 'In qui illum et eli', '12 35 81 97', '88 87 87 87', 1, NULL),
(8, 7, 150, '47445617160378455289', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:10:46', '2024-05-18 11:10:46', 'In qui illum et eli', '12 35 81 97', '88 87 87 87', 1, NULL),
(9, 7, 150, '47586517160379869256', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:13:07', '2024-05-18 11:13:07', 'Suscipit doloribus r', '15 71 18 85', '13 15 16 51', 1, NULL),
(10, 7, 150, '4793691716038336151', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:18:57', '2024-05-18 11:18:57', 'Velit ullamco id e', '17 79 38 47', '97 87 97 98', 1, NULL),
(11, 7, 150, '48290517160386904069', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 11:24:51', '2024-05-18 11:24:51', 'Quia quis ea exercit', '13 26 35 77', '46 54 65 46', 1, NULL),
(12, 7, 150, '48487017160388872181', 'MOBILE_MONEY,CREDIT_CARD', '', 'Billali SONHOUIN', 'ACCEPTED', '0a82ccbe425404b65721ab202392094e6dd7460fa4cc9e28cbc732bda973a15b427573', '90 90 90 90', 'SUCCES', '1', '2024-05-18 13:28:07', '2024-05-18 11:28:07', '2024-05-18 11:28:48', 'Nemo irure perferend', '12 62 97 45', '46 54 65 46', 1, NULL),
(13, 9, 200, '57585217160479856533', 'MOBILE_MONEY,CREDIT_CARD', '', 'KOAMIVI ANIKA', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-18 13:59:45', '2024-05-18 13:59:45', 'Matyanika', '93 67 35 76', '93 67 35 76', 2, NULL),
(14, 9, 200, '57756317160481565665', 'MOBILE_MONEY,CREDIT_CARD', '', 'KOAMIVI ANIKA', 'ACCEPTED', '7082d5a2c63c65a54820a452fd888413fa57ec656238d729efc71d342d10e1cb427573', '90 90 90 90', 'SUCCES', '1', '2024-05-18 16:02:36', '2024-05-18 14:02:37', '2024-05-18 14:03:15', 'Midjoyi', '93 67 35 76', '93 67 35 76', 2, NULL),
(15, 10, 150, '37450517162870501989', 'MOBILE_MONEY,CREDIT_CARD', '', 'Odio nulla distincti Consequat Optio ea', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-21 08:24:11', '2024-05-21 08:24:11', 'BIILSON', '93 67 35 76', '93 67 35 76', 1, NULL),
(16, 10, 150, '38319317162879196425', 'MOBILE_MONEY,CREDIT_CARD', '', 'Odio nulla distincti Consequat Optio ea', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-21 08:38:40', '2024-05-21 08:38:40', 'Quis et voluptatem e', '14 12 78 49', '46 45 65 46', 1, NULL),
(17, 10, 150, '38622517162882223886', 'MOBILE_MONEY,CREDIT_CARD', '', 'Odio nulla distincti Consequat Optio ea', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-21 08:43:43', '2024-05-21 08:43:43', 'Expedita ad mollitia', '15 22 59 84', '15 22 59 84', 1, NULL),
(18, 11, 200, '45990317162955903360', 'MOBILE_MONEY,CREDIT_CARD', '', 'Kokovi Kokovi', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-21 10:46:32', '2024-05-21 10:46:32', 'Rainbow', '96 46 96 24', '96 46 96 24', 2, NULL),
(19, 11, 200, '46431817162960318109', 'MOBILE_MONEY,CREDIT_CARD', '', 'Kokovi Kokovi', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-21 10:53:52', '2024-05-21 10:53:52', 'Rainbow', '96 46 96 24', '96 46 96 24', 2, NULL),
(20, 11, 200, '46597817162961977063', 'MOBILE_MONEY,CREDIT_CARD', '', 'Kokovi Kokovi', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-05-21 10:56:38', '2024-05-21 10:56:38', 'Rainbow', '96 46 96 24', '96 46 96 24', 2, NULL),
(21, 12, 150, '39513517174123134127', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Qui aut numquam dolo Irure commodi sunt e', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-06-03 08:58:35', '2024-06-03 08:58:35', 'Entreprise 90', '96 54 52 66', '95 65 32 12', 1, NULL),
(22, 12, 150, '39629317174124294165', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Qui aut numquam dolo Irure commodi sunt e', 'ACCEPTED', '7d15c176baafd790ea35b3d52b4727c3091aa63647d3195e431b9440afd7e7f1427573', '90 90 90 90', 'SUCCES', '1', '2024-06-03 11:00:29', '2024-06-03 09:00:30', '2024-06-03 09:00:58', 'Entreprise 90', '93 67 35 77', '98 94 94 98', 1, NULL),
(23, 12, 150, '39713217174125133029', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Qui aut numquam dolo Irure commodi sunt e', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-06-03 09:01:53', '2024-06-03 09:01:53', NULL, NULL, NULL, 1, 13),
(24, 12, 150, '41998117174147981293', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Qui aut numquam dolo Irure commodi sunt e', 'ACCEPTED', 'c21847bc9d2641e76b37bcd00ae9e3af19d2361acf7d71a10bd5ad668b772fe2427573', '90 90 90 90', 'SUCCES', '1', '2024-06-03 11:39:58', '2024-06-03 09:39:58', '2024-06-03 09:40:34', NULL, NULL, NULL, 1, 13),
(25, 13, 150, '58252117174310521362', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Perferendis est quo  Et atque optio repe', 'ACCEPTED', 'c63ceb886fc4358f714329dfe1df548f1e7f3aad7d7e8211b8d1dc321ae2fe11427573', '90 90 90 90', 'SUCCES', '1', '2024-06-03 16:10:52', '2024-06-03 14:10:52', '2024-06-03 14:11:26', 'Entreprise 19', '98 65 32 12', '97 85 63 21', 1, NULL),
(26, 14, 150, '70414517176160144640', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Reprehenderit elit  Quasi dignissimos ea', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-06-05 17:33:35', '2024-06-05 17:33:35', 'Sit sapiente rerum', '13 92 41 86', '49 89 79 87', 1, NULL),
(27, 15, 200, '61667217191624676835', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Koko22 Koko22', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-06-23 15:07:47', '2024-06-23 15:07:47', 'Decathlon', '90 12 12 45', '01 24 78 59', 2, NULL),
(28, 15, 200, '62297117191630979107', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Koko22 Koko22', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-06-23 15:18:17', '2024-06-23 15:18:17', 'Decathlon', '02 14 55 45', '12 15 78 86', 2, NULL),
(29, 15, 200, '6241511719163215397', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Koko22 Koko22', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-06-23 15:20:15', '2024-06-23 15:20:15', 'Decathlon', '85 66 25 54', '20 12 45 23', 2, NULL),
(30, 15, 200, '62510917191633103351', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Koko22 Koko22', 'ACCEPTED', '83d7719e1c05d6febc57e03fee0bc61aea794ef84d9db368d869cec2c3b11b37427573', '90 90 90 90', 'SUCCES', '1', '2024-06-23 17:21:51', '2024-06-23 15:21:51', '2024-06-23 15:22:20', 'Decathlon', '90 37 74 13', '90 37 74 13', 2, NULL),
(31, 18, 150, '24442617245684424061', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Aaa Aaa', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-08-25 04:47:23', '2024-08-25 04:47:23', 'Test', '93 69 63 63', '96 36 63 96', 1, NULL),
(32, 19, 150, '83979817260103798295', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Elise MORE', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-09-10 21:19:40', '2024-09-10 21:19:40', 'Restaurant Au Bizet', '07 66 29 91', '07 66 29 91', 1, NULL),
(33, 19, 150, '84185117260105859598', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Elise MORE', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-09-10 21:23:05', '2024-09-10 21:23:05', 'Restaurant Au Bizet', '71 01 65 59', '71 01 65 59', 1, NULL),
(34, 20, 150, '28528617260413283649', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Vel earum ea anim re Sit cumque omnis omn', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-09-11 05:55:29', '2024-09-11 05:55:29', 'Eum officia cillum l', '96 96 96 96', '96 96 96 96', 1, NULL),
(35, 22, 150, '65061717306570615514', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Koamivi ANIKA', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-11-03 17:04:22', '2024-11-03 17:04:22', 'Numrod', '90 37 74 13', '90 37 74 13', 1, NULL),
(36, 22, 150, '65260617306572604497', 'MOBILE_MONEY,CREDIT_CARD', NULL, 'Koamivi ANIKA', 'PENDING', NULL, '90 90 90 90', 'WAITING_CUSTOMER_PAYMENT', '0', NULL, '2024-11-03 17:07:41', '2024-11-03 17:07:41', 'Numrod', '90 37 74 13', '90 37 74 13', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `username`, `email`, `telephone`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'bill', 'bill', 'bill', 'billalisonhouin@gmail.com', '90 90 90 90', NULL, '$2y$10$KX3kc8Ju6OSea6PBL0FCbuDC098r/xaUc.mMitp5e8PYryCJc8yGW', 1, 'XW0vFtv7ZX75YIFCNtpts3eY6czMTh1jPNbGzqG7GXdrqYW3PaCz303VSugT', '2023-12-12 13:12:42', '2024-01-28 19:07:01', NULL, NULL, 1, NULL),
(2, 'Numdoc', 'martin', 'martin', 'afinonk@gmail.com', '90 90 90 87', NULL, '$2y$10$cZUO/pYBYWXY5BVCeiZe0ey8I8bCjodL.JgfJwwGfw.Xipa5B1/0K', 1, 'w3GHpRJJ06T0vjADtCDpnkzlTQCASL8w81dKiT48nHftkM2R5FthAYZQsSSx', '2023-12-12 13:12:42', '2024-03-25 07:25:38', NULL, NULL, 2, NULL),
(3, 'Sit aute sit odio d', 'Totam cillum at aliq', 'kenom', 'futiti@mailinator.com', NULL, NULL, '$2y$10$9rpbpN1YgyagIGFY1Eg/rOSs//BfjS1D0yrwo5hRnuLu.aD8gBuuC', 1, NULL, '2024-04-21 17:00:58', '2024-04-21 17:00:58', NULL, NULL, NULL, NULL),
(4, 'Ea libero occaecat r', 'Do excepteur et face', 'kapepi', 'tedofesuto@mailinator.com', NULL, NULL, '$2y$10$DStgbj0W.sEFEZFVqL7hQupu5j9af6StXswqsYSAUX927lUrJAcP6', 1, NULL, '2024-04-22 12:36:55', '2024-04-22 12:36:55', NULL, NULL, NULL, NULL),
(5, 'Leandre', 'Leandra', 'Leandre', 'matyanika@gmail.com', NULL, NULL, '$2y$10$gZ1pthehXwD1yW4e5muTaOfYVgS0JCZi0MewmR0IJBt5E6qpcvxlC', 1, NULL, '2024-04-22 17:23:44', '2024-04-22 17:23:44', NULL, NULL, NULL, NULL),
(6, 'Leandre', 'Leandra', 'Leandre22', 'matyanika1@gmail.com', NULL, NULL, '$2y$10$CErY0B/bCztN3SaS3g4ymORy3ZaI1azL6bv43.AB6g8ZG.1Xih3Ye', 1, NULL, '2024-04-22 17:24:19', '2024-04-22 17:24:19', NULL, 5, 5, NULL),
(7, 'SONHOUIN', 'Billali', 'gihyruwe', 'hokusyzeb@mailinator.com', NULL, NULL, '$2y$10$dqU9iBIQdQt0diwHfwFb3.jpX1OqDikOhDaqtvSxGiOSmft2vADPq', 1, 'hOYWYLamy1wfuuU7EpdoSpxMtVv3rWquJ2J6lDk9PLaWidZpWOCTZg39GLNx', '2024-05-18 07:51:10', '2024-05-18 07:51:10', NULL, NULL, 7, NULL),
(8, 'Dolor ullam error cu', 'Qui ipsum ducimus c', 'kaliqo', 'pucywiqema@mailinator.com', NULL, NULL, '$2y$10$ZDC5lfe/EEqQK4a3CWyHyu5MXBrLjfXd18V.RX57Lsk0O54puu9em', 1, 'DEFmwHsCm0qU8ZYxj1I8nRrGSjXitkTAkPXjAoQC3wSz4xfe7sWfYqAD8u99', '2024-05-18 09:59:10', '2024-05-18 09:59:10', NULL, NULL, 8, NULL),
(9, 'ANIKA', 'KOAMIVI', 'KOKO22', 'k.anika@archimed.fr', NULL, NULL, '$2y$10$29.TaeIXhvmoVjnJoHZZ.OxwARG/2KP3apDpKvWBHT3Ch96E9UHJ2', 1, 'Im5aco7gCZDlVvfqueiQO3U8N5P3YcS5K0fVEIA7bznvP4hFnfGyDIB8RShr', '2024-05-18 13:58:05', '2024-05-18 13:58:05', NULL, NULL, 9, NULL),
(10, 'Consequat Optio ea', 'Odio nulla distincti', 'jivydajex', 'cygezatydy@mailinator.com', NULL, NULL, '$2y$10$roFeaWGl58utdjU4xlIjYeFK//RnqrPdsPE2SB3yiehUCQF64UWJ6', 1, 'eZLvezxvyF2x0jhYJMtr73v2ioCo30nFQ6qEFOvZrYlKSeVixGyUsyNIoj1x', '2024-05-21 08:23:27', '2024-05-21 08:23:27', NULL, NULL, 10, NULL),
(11, 'Kokovi', 'Kokovi', 'Kokovi', 'afinonkD@gmail.com', NULL, NULL, '$2y$10$y2gp6nn6ddnLfWtdC3wIheii8lp5yBxEb1o4rzzGVW.rU0rSKxvrq', 1, '0bYuv8hLjNIg4mJeaKW8uJP6yuabc7OyI6ZfRf4vhXY1q6PVP0jZc9DNWXT2', '2024-05-21 10:44:29', '2024-05-21 10:44:29', NULL, NULL, 11, NULL),
(12, 'Irure commodi sunt e', 'Qui aut numquam dolo', 'seviqi', 'zygemil@mailinator.com', NULL, NULL, '$2y$10$docpAeX0nCUDPsskbXlT1uFtgr3AOJaws6FSF82oYWD.K6fyjs0yG', 1, 'd4gZTYmE0comdpKjiK3MFK6KFS1etaUTLyBC6Y4qRiHyQYuxvib4eZ4HZOdl', '2024-06-03 08:57:58', '2024-06-03 08:57:58', NULL, NULL, 12, NULL),
(13, 'Et atque optio repe', 'Perferendis est quo ', 'woqys', 'rimevat@mailinator.com', NULL, NULL, '$2y$10$lcq3HTPu1.cvnkez5aayJuzhaAPh2vWQcQ/7yohVhNAKgOPHKNjmG', 1, 'QcBd2PgiuYQGV60CzjJcWu7Y3jVneqGGNCxla1GaeNettQXWrM8IOWHUsSwl', '2024-06-03 14:06:45', '2024-06-03 14:06:45', NULL, NULL, 13, NULL),
(14, 'Quasi dignissimos ea', 'Reprehenderit elit ', 'vexijon', 'nycad@mailinator.com', NULL, NULL, '$2y$10$agGSU6iHJVxUBKQTfFxyJ.4nRbrNVeYF5WAxC89yGC8axy5mIg4sK', 1, 'ekH1rKKKXQP6IGmi1e9XvG8OBfa48EK0BVTTyGBzQxrWC3hwTx3V41eXoQIP', '2024-06-05 17:33:02', '2024-06-05 17:33:02', NULL, NULL, 14, NULL),
(15, 'Koko22', 'Koko22', 'koko@gmail.com', 'koko@gmail.com', NULL, NULL, '$2y$10$encvwot/FkWOsZyikMuxp.cmm5acDWKrycdNtp5kQRwyr46P48nmy', 1, 'qEH5CGSywqtv7oThMpmUleR4RiQesiTixVWr6Fx2WGy4HVRZ0QSbmjzXbjwf', '2024-06-23 14:36:52', '2024-06-23 14:36:52', NULL, NULL, 15, NULL),
(16, 'Sapiente incidunt d', 'Fugiat officia magn', 'rokofybe', 'paqot@mailinator.com', NULL, NULL, '$2y$10$azevEsTrurjy6v9yBEAxLu/0KT7bsrOMiS8Lw3l5fpjGoQ816OID2', 1, 'XGulktbCXGs0n3S3t4wWLj94Lk5KV2GCNrFboX4pbKNX86nIT8r6rj74zAtb', '2024-07-20 12:24:58', '2024-07-20 12:24:58', NULL, NULL, 16, NULL),
(17, 'Qui laboris laborum', 'Mollit est et nobis', 'test1', 'huresyp@mailinator.com', NULL, NULL, '$2y$10$he/pabQT4sbPfr7LOfq.Z.vG2fnPrEC7bnVwbqK2OQBQrg/2jHWA6', 1, 'QHLR41QSFUatIClXljPqvAAOl0rfQTzzAAUBsOyE7ebOYzqGOHQ9B34zmjR8', '2024-08-04 16:18:20', '2024-08-04 19:08:36', NULL, NULL, 17, NULL),
(18, 'Aaa', 'Aaa', 'aas', 'aaa@gmsai.com', NULL, NULL, '$2y$10$1ScLSXCuG69XJq8RUeDz7OwfW5Ibyi2wGHhihdrLjNbeApTnvYZZO', 1, 'BugbqC4wOzY158dchSOT2jTS0le78oOyPUS297RrxfWhdKMWsZF5xFo1hyXn', '2024-08-25 04:46:10', '2024-08-25 04:46:10', NULL, NULL, 18, NULL),
(19, 'MORE', 'Elise', 'emore', 'elise.more@laposte.net', NULL, NULL, '$2y$10$5enBC.dbyFxbjXtNy4Fs9uuBifuAvWSgy6/qvLLuLey.wNy9Y4Ece', 1, 'MvbsmMGZNRMi9YysUJuhZmSNjbtU4JgYK75SLdjHE2NdVQObZKMSLby82Kbx', '2024-09-10 21:13:51', '2024-09-10 21:13:51', NULL, NULL, 19, NULL),
(20, 'Sit cumque omnis omn', 'Vel earum ea anim re', 'qafinujex', 'test1@mailinator.com', NULL, NULL, '$2y$10$BahBK8JFLasb/JcI2qPG7eAhBhRUh4539WWwr/FQR5knYBw9e7A.u', 1, '8jY5f414Gz7HnNPzdetN9TbpwkjMycRcYfxb91ShGIpuqjq4bBs0VPFJX3pD', '2024-09-11 05:54:55', '2024-09-11 06:02:39', NULL, NULL, 20, NULL),
(21, 'Design', 'Design', 'sylviane', 'sylviane.vieira@gmail.com', '93587632', NULL, '$2y$10$xgfTs5DbzhFJJYUE0ZHQteSI1kj9EB3uqC2YSKVnjEzx.xpNRdFeS', 1, '3mQlM7pcSbV6QwqK0ehghvEwkfYpB2HkHbIauMizlX1ncavMpMUdU362vbNk', '2024-10-16 08:55:39', '2024-10-16 12:20:46', NULL, 1, 21, NULL),
(22, 'ANIKA', 'Koamivi', 'Koko', 'cursus.univ@gmail.com', NULL, NULL, '$2y$10$HGv8O4jnkWHchltSGZX6QeVZaf53bkO92O1K4xDrKFUtCb3lmKCoC', 1, 'NwgW0vdM022ybiVQNjJuZE7ZNuCbZTcfC7YE2Cb0ac6cImbINks9RvRDt5Ev', '2024-11-03 16:51:21', '2024-11-03 16:51:21', NULL, NULL, 22, NULL),
(23, 'Tino', 'Tino', 'Tino', 'Tino@gmail.com', NULL, NULL, '$2y$10$e0lCbdulfdsV5OYcWSGieOjgjo0p0w0ll05R5C9tFDQGhIHwEU6ve', 1, '9kpt7FS6LT1BdRQ5sppiVfroo97nn9Y481nbIyM2JJ1tvwNLXi0An49cVqT7', '2024-11-26 10:04:38', '2024-11-26 10:04:38', NULL, NULL, 23, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `views`
--

CREATE TABLE `views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `annonce_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `views`
--

INSERT INTO `views` (`id`, `annonce_id`, `user_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 'd61c1034c9036916ea2e1f39bf5302a5381a7cf66c12c4ff7740ecf1684ab2b0', '2024-11-15 15:53:12', '2024-11-15 15:53:12'),
(2, 17, 15, 'da062439056f79971e732853e830676270a8feb70288755642f013d3b608c10d', '2024-11-17 09:29:14', '2024-11-17 09:29:14'),
(3, 15, 15, 'da062439056f79971e732853e830676270a8feb70288755642f013d3b608c10d', '2024-11-17 09:39:08', '2024-11-17 09:39:08'),
(4, 8, 21, '9a6d1599a01ccd623e68d0beb21eca36847f464d74af91f744e405bc613e1455', '2024-11-17 09:39:20', '2024-11-17 09:39:20'),
(5, 7, 21, '9a6d1599a01ccd623e68d0beb21eca36847f464d74af91f744e405bc613e1455', '2024-11-17 09:55:35', '2024-11-17 09:55:35'),
(6, 17, 21, '3c22db7548881b9eb158fe8ecff87f1b76e20b3af32fa3c5c54f1de89f099173', '2024-11-17 14:00:42', '2024-11-17 14:00:42'),
(7, 16, 21, '3c22db7548881b9eb158fe8ecff87f1b76e20b3af32fa3c5c54f1de89f099173', '2024-11-17 14:02:22', '2024-11-17 14:02:22'),
(8, 17, NULL, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2024-11-17 21:10:54', '2024-11-17 21:10:54'),
(9, 1, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2024-11-18 12:21:34', '2024-11-18 12:21:34'),
(10, 17, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2024-11-19 19:15:23', '2024-11-19 19:15:23'),
(11, 5, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2024-12-06 15:13:08', '2024-12-06 15:13:08'),
(12, 4, NULL, 'b72c02140cb3991bfb49b05f0c012e527dd07b3c738632406c05ef0f88932824', '2024-12-08 13:57:04', '2024-12-08 13:57:04'),
(13, 5, 21, '4635a4a822d8d148d5bb7dc2217347f2e084530a72c7bb641c023e1a723953f8', '2024-12-16 08:50:10', '2024-12-16 08:50:10'),
(14, 17, 1, 'b311022fee1b7bb36fc8af956a9d5f9ca40e675fe27413c15bfbb7e9fc62a3b4', '2024-12-16 19:28:49', '2024-12-16 19:28:49'),
(15, 17, 1, '476f9c6d87271b02d3f0a25e8b20d07838971037d24936e6b8c13699c8447dcc', '2024-12-17 20:29:48', '2024-12-17 20:29:48'),
(16, 9, 1, '219072534479a94ee0880dcf92e50e7c7ab08bf0e7f56bce7c2cedd9ef79cd29', '2024-12-21 21:00:10', '2024-12-21 21:00:10'),
(17, 17, 21, '871affe6c30dba293e703ea0a65964cbc1273b64033909d619e287b437e89d9f', '2024-12-22 15:02:30', '2024-12-22 15:02:30'),
(18, 7, 21, '871affe6c30dba293e703ea0a65964cbc1273b64033909d619e287b437e89d9f', '2024-12-22 15:19:29', '2024-12-22 15:19:29'),
(19, 8, 21, '871affe6c30dba293e703ea0a65964cbc1273b64033909d619e287b437e89d9f', '2024-12-22 15:58:12', '2024-12-22 15:58:12'),
(20, 17, 21, '871affe6c30dba293e703ea0a65964cbc1273b64033909d619e287b437e89d9f', '2024-12-22 17:32:43', '2024-12-22 17:32:43'),
(21, 5, 21, '871affe6c30dba293e703ea0a65964cbc1273b64033909d619e287b437e89d9f', '2024-12-22 18:01:54', '2024-12-22 18:01:54'),
(22, 9, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-27 10:28:38', '2024-12-27 10:28:38'),
(23, 12, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-27 10:32:32', '2024-12-27 10:32:32'),
(24, 12, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 10:40:29', '2024-12-27 10:40:29'),
(25, 12, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 11:41:52', '2024-12-27 11:41:52'),
(26, 12, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 12:43:31', '2024-12-27 12:43:31'),
(27, 12, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:15:22', '2024-12-27 15:15:22'),
(28, 7, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:16:10', '2024-12-27 15:16:10'),
(29, 17, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:16:57', '2024-12-27 15:16:57'),
(30, 2, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:17:38', '2024-12-27 15:17:38'),
(31, 8, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:20:14', '2024-12-27 15:20:14'),
(32, 11, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:27:36', '2024-12-27 15:27:36'),
(33, 6, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:28:01', '2024-12-27 15:28:01'),
(34, 9, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:47:01', '2024-12-27 15:47:01'),
(35, 1, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:55:29', '2024-12-27 15:55:29'),
(36, 10, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 15:56:07', '2024-12-27 15:56:07'),
(37, 6, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 16:28:46', '2024-12-27 16:28:46'),
(38, 6, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 17:40:24', '2024-12-27 17:40:24'),
(39, 8, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 18:02:09', '2024-12-27 18:02:09'),
(40, 6, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 18:40:52', '2024-12-27 18:40:52'),
(41, 9, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 18:49:59', '2024-12-27 18:49:59'),
(42, 9, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 19:51:02', '2024-12-27 19:51:02'),
(43, 6, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 20:33:37', '2024-12-27 20:33:37'),
(44, 17, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 20:41:18', '2024-12-27 20:41:18'),
(45, 12, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 20:41:44', '2024-12-27 20:41:44'),
(46, 9, 21, 'e4d0e0ab87ba6eb3136ac4820cddaba2b93654bcdd96d1c37e6c7965b7965db5', '2024-12-27 20:54:07', '2024-12-27 20:54:07'),
(47, 9, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 09:49:04', '2024-12-28 09:49:04'),
(48, 17, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 09:56:19', '2024-12-28 09:56:19'),
(49, 12, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 09:56:54', '2024-12-28 09:56:54'),
(50, 12, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 10:58:13', '2024-12-28 10:58:13'),
(51, 17, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:09:30', '2024-12-28 11:09:30'),
(52, 11, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:17:50', '2024-12-28 11:17:50'),
(53, 10, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:17:53', '2024-12-28 11:17:53'),
(54, 9, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:17:57', '2024-12-28 11:17:57'),
(55, 8, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:01', '2024-12-28 11:18:01'),
(56, 7, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:03', '2024-12-28 11:18:03'),
(57, 6, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:08', '2024-12-28 11:18:08'),
(58, 5, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:12', '2024-12-28 11:18:12'),
(59, 4, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:22', '2024-12-28 11:18:22'),
(60, 3, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:36', '2024-12-28 11:18:36'),
(61, 2, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 11:18:42', '2024-12-28 11:18:42'),
(62, 17, 1, 'bf4cde09886a1b2150ebffb7b835c14ce574125cee361ac3665a049668955c1f', '2024-12-28 11:25:21', '2024-12-28 11:25:21'),
(63, 17, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2024-12-28 11:55:03', '2024-12-28 11:55:03'),
(64, 2, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 12:22:51', '2024-12-28 12:22:51'),
(65, 17, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 12:41:29', '2024-12-28 12:41:29'),
(66, 11, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 12:41:38', '2024-12-28 12:41:38'),
(67, 17, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 13:46:18', '2024-12-28 13:46:18'),
(68, 6, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:31:29', '2024-12-28 14:31:29'),
(69, 12, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:35:58', '2024-12-28 14:35:58'),
(70, 11, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:36:15', '2024-12-28 14:36:15'),
(71, 10, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:36:23', '2024-12-28 14:36:23'),
(72, 9, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:36:29', '2024-12-28 14:36:29'),
(73, 8, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:40:12', '2024-12-28 14:40:12'),
(74, 7, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:40:17', '2024-12-28 14:40:17'),
(75, 5, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:58:41', '2024-12-28 14:58:41'),
(76, 4, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 14:58:58', '2024-12-28 14:58:58'),
(77, 3, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 15:38:42', '2024-12-28 15:38:42'),
(78, 2, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 15:38:46', '2024-12-28 15:38:46'),
(79, 1, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 15:38:51', '2024-12-28 15:38:51'),
(80, 12, 21, 'ec9699fbe34c99b0dd108ccd3eae97757f47f0c47475624c7a54c7637d67006a', '2024-12-28 16:07:04', '2024-12-28 16:07:04'),
(81, 8, NULL, '3c4936a26ccb4f2821b4d77f7da6e2bc33b4b7353822ea1ea81b8059aed14fe5', '2024-12-28 16:39:58', '2024-12-28 16:39:58'),
(82, 8, NULL, 'e5cc5175c8efad4ecba85052e55b7edccc6b8a9b870bfd194c0bc3b3fee66d07', '2024-12-28 16:40:02', '2024-12-28 16:40:02'),
(83, 8, NULL, 'b823d4abcea5accdcff004a89a39e667d6d33287ca698429fd9d4d7c9ca851b3', '2024-12-28 16:40:03', '2024-12-28 16:40:03'),
(84, 17, 21, '59dc1dcaac172c7c8132beabad51b5b0e445c001dd8cb44336ac0bee4e2e883a', '2024-12-28 17:21:52', '2024-12-28 17:21:52'),
(85, 17, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2024-12-28 20:43:12', '2024-12-28 20:43:12'),
(86, 17, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 17:35:52', '2024-12-29 17:35:52'),
(87, 12, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 17:35:56', '2024-12-29 17:35:56'),
(88, 17, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 19:54:03', '2024-12-29 19:54:03'),
(89, 3, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 20:51:41', '2024-12-29 20:51:41'),
(90, 17, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:13:53', '2024-12-29 21:13:53'),
(91, 12, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:14:06', '2024-12-29 21:14:06'),
(92, 17, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-29 21:18:45', '2024-12-29 21:18:45'),
(93, 11, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:48:16', '2024-12-29 21:48:16'),
(94, 10, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:48:19', '2024-12-29 21:48:19'),
(95, 9, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:48:20', '2024-12-29 21:48:20'),
(96, 8, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:48:34', '2024-12-29 21:48:34'),
(97, 7, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:48:41', '2024-12-29 21:48:41'),
(98, 6, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:50:04', '2024-12-29 21:50:04'),
(99, 5, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:50:20', '2024-12-29 21:50:20'),
(100, 4, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 21:50:46', '2024-12-29 21:50:46'),
(101, 17, 21, '75bd3f782dd86a4c9fdf5d197c658bedf61ab0aca53b56d3d0e8fadf1c745812', '2024-12-29 22:14:00', '2024-12-29 22:14:00'),
(102, 5, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 08:57:52', '2024-12-30 08:57:52'),
(103, 17, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:11:27', '2024-12-30 09:11:27'),
(104, 12, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:13:21', '2024-12-30 09:13:21'),
(105, 11, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:29:10', '2024-12-30 09:29:10'),
(106, 10, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:29:12', '2024-12-30 09:29:12'),
(107, 9, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:29:13', '2024-12-30 09:29:13'),
(108, 8, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:29:14', '2024-12-30 09:29:14'),
(109, 7, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:29:15', '2024-12-30 09:29:15'),
(110, 6, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 09:29:17', '2024-12-30 09:29:17'),
(111, 5, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 10:12:19', '2024-12-30 10:12:19'),
(112, 17, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 10:15:27', '2024-12-30 10:15:27'),
(113, 2, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 10:23:47', '2024-12-30 10:23:47'),
(114, 1, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 12:30:51', '2024-12-30 12:30:51'),
(115, 20, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 12:47:11', '2024-12-30 12:47:11'),
(116, 20, 21, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2024-12-30 13:10:17', '2024-12-30 13:10:17'),
(117, 8, 21, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2024-12-30 13:17:05', '2024-12-30 13:17:05'),
(118, 20, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:01:25', '2024-12-30 15:01:25'),
(119, 12, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:02', '2024-12-30 15:12:02'),
(120, 11, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:11', '2024-12-30 15:12:11'),
(121, 10, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:14', '2024-12-30 15:12:14'),
(122, 9, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:17', '2024-12-30 15:12:17'),
(123, 8, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:19', '2024-12-30 15:12:19'),
(124, 7, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:24', '2024-12-30 15:12:24'),
(125, 6, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:25', '2024-12-30 15:12:25'),
(126, 5, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:27', '2024-12-30 15:12:27'),
(127, 4, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:29', '2024-12-30 15:12:29'),
(128, 3, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:31', '2024-12-30 15:12:31'),
(129, 2, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:34', '2024-12-30 15:12:34'),
(130, 1, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:12:35', '2024-12-30 15:12:35'),
(131, 17, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 15:15:20', '2024-12-30 15:15:20'),
(132, 21, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 16:24:51', '2024-12-30 16:24:51'),
(133, 22, 21, '8c91f9475137dbbac91e4e7b6d765ed2ebcefa60dee5686102ab6fba48e4948f', '2024-12-30 17:10:24', '2024-12-30 17:10:24'),
(134, 22, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:37:09', '2024-12-30 20:37:09'),
(135, 21, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:37:37', '2024-12-30 20:37:37'),
(136, 20, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:37:39', '2024-12-30 20:37:39'),
(137, 17, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:38:21', '2024-12-30 20:38:21'),
(138, 12, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:38:23', '2024-12-30 20:38:23'),
(139, 11, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:38:25', '2024-12-30 20:38:25'),
(140, 10, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:38:27', '2024-12-30 20:38:27'),
(141, 9, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:38:29', '2024-12-30 20:38:29'),
(142, 8, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2024-12-30 20:38:30', '2024-12-30 20:38:30'),
(143, 20, 1, 'a04b4b808eff0e19117b07266fab1a8db261ea624f7db16e2bcf0e91bcd09924', '2024-12-30 20:42:01', '2024-12-30 20:42:01'),
(144, 21, 1, 'd61c1034c9036916ea2e1f39bf5302a5381a7cf66c12c4ff7740ecf1684ab2b0', '2024-12-31 09:12:29', '2024-12-31 09:12:29'),
(145, 22, 1, 'd61c1034c9036916ea2e1f39bf5302a5381a7cf66c12c4ff7740ecf1684ab2b0', '2024-12-31 09:14:45', '2024-12-31 09:14:45'),
(146, 21, 21, '62395ea3426e86751c9a7567c87b8ad60465f841bacdf0d5b3603ded3ac68b7e', '2025-01-02 08:20:12', '2025-01-02 08:20:12'),
(147, 17, 1, 'd61c1034c9036916ea2e1f39bf5302a5381a7cf66c12c4ff7740ecf1684ab2b0', '2025-01-02 14:11:32', '2025-01-02 14:11:32'),
(148, 22, NULL, '254bdab927b8f201f616bed26f29556e881084a5b4eda81c33f3e5fa25ee3eae', '2025-01-02 16:32:55', '2025-01-02 16:32:55'),
(149, 22, NULL, '87bf2bf90405692952ead65713cd5e5924ef9dc9573a3322bae8959d140c8f2b', '2025-01-02 16:33:02', '2025-01-02 16:33:02'),
(150, 22, NULL, '4230ca286335e4f2ce2ccd893c3334127948f8530f3d12219cff02c701d63b91', '2025-01-02 16:33:03', '2025-01-02 16:33:03'),
(151, 22, NULL, 'f40e9feeef4db28278afc24713c65188708cc72dcf96429218d24d8ffac9e3ce', '2025-01-02 16:33:03', '2025-01-02 16:33:03'),
(152, 21, NULL, '254bdab927b8f201f616bed26f29556e881084a5b4eda81c33f3e5fa25ee3eae', '2025-01-02 16:33:39', '2025-01-02 16:33:39'),
(153, 21, NULL, '87bf2bf90405692952ead65713cd5e5924ef9dc9573a3322bae8959d140c8f2b', '2025-01-02 16:33:44', '2025-01-02 16:33:44'),
(154, 21, NULL, '5a26c92594920478838d048cb6113bb6df8efe23d87369befa181e20233e3d15', '2025-01-02 16:33:44', '2025-01-02 16:33:44'),
(155, 21, NULL, '4230ca286335e4f2ce2ccd893c3334127948f8530f3d12219cff02c701d63b91', '2025-01-02 16:33:44', '2025-01-02 16:33:44'),
(156, 5, NULL, '254bdab927b8f201f616bed26f29556e881084a5b4eda81c33f3e5fa25ee3eae', '2025-01-02 16:34:22', '2025-01-02 16:34:22'),
(157, 5, NULL, '87bf2bf90405692952ead65713cd5e5924ef9dc9573a3322bae8959d140c8f2b', '2025-01-02 16:34:26', '2025-01-02 16:34:26'),
(158, 5, NULL, 'f40e9feeef4db28278afc24713c65188708cc72dcf96429218d24d8ffac9e3ce', '2025-01-02 16:34:26', '2025-01-02 16:34:26'),
(159, 5, NULL, '5a26c92594920478838d048cb6113bb6df8efe23d87369befa181e20233e3d15', '2025-01-02 16:34:26', '2025-01-02 16:34:26'),
(160, 22, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2025-01-02 19:40:46', '2025-01-02 19:40:46'),
(161, 21, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2025-01-02 19:41:18', '2025-01-02 19:41:18'),
(162, 21, 21, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2025-01-03 16:58:24', '2025-01-03 16:58:24'),
(163, 22, 21, '7cc957469fc8a8ea266599c1b3667b4190c18a33c9dfbbd9786e3821849f4bca', '2025-01-03 18:17:05', '2025-01-03 18:17:05'),
(164, 17, 21, '7cc957469fc8a8ea266599c1b3667b4190c18a33c9dfbbd9786e3821849f4bca', '2025-01-03 18:17:30', '2025-01-03 18:17:30'),
(165, 12, 21, '7cc957469fc8a8ea266599c1b3667b4190c18a33c9dfbbd9786e3821849f4bca', '2025-01-03 18:18:15', '2025-01-03 18:18:15'),
(166, 22, 21, '7cc957469fc8a8ea266599c1b3667b4190c18a33c9dfbbd9786e3821849f4bca', '2025-01-03 19:20:56', '2025-01-03 19:20:56'),
(167, 17, 21, '7cc957469fc8a8ea266599c1b3667b4190c18a33c9dfbbd9786e3821849f4bca', '2025-01-03 19:35:13', '2025-01-03 19:35:13'),
(168, 17, 21, '9a42c491dfb5aec6bf1befdbd232a3122b5428d4a926262d1dd5b03f8a811641', '2025-01-05 09:30:25', '2025-01-05 09:30:25'),
(169, 22, 21, '5b27e2f2d4bbd26e0597c72662300d363cd02e8ea7be9d0868240a2d2253f1a9', '2025-01-06 07:11:18', '2025-01-06 07:11:18'),
(170, 21, 1, 'a04b4b808eff0e19117b07266fab1a8db261ea624f7db16e2bcf0e91bcd09924', '2025-01-08 21:00:29', '2025-01-08 21:00:29'),
(171, 22, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-13 08:37:33', '2025-01-13 08:37:33'),
(172, 22, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:19:55', '2025-01-16 08:19:55'),
(173, 21, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:20:18', '2025-01-16 08:20:18'),
(174, 9, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:21:14', '2025-01-16 08:21:14'),
(175, 1, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:21:32', '2025-01-16 08:21:32'),
(176, 17, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:22:08', '2025-01-16 08:22:08'),
(177, 5, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:23:41', '2025-01-16 08:23:41'),
(178, 4, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:23:57', '2025-01-16 08:23:57'),
(179, 3, 21, '928828a33497712935a9f155f9e7a5ddbd718792c641ebd3f1905dd4453b7b9a', '2025-01-16 08:24:09', '2025-01-16 08:24:09'),
(180, 23, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-21 07:24:00', '2025-01-21 07:24:00'),
(181, 23, 1, '16af400ca8751f18e21d60ec452a79ce6e74589fc0ab58349ba45ecc103017cc', '2025-01-21 20:52:16', '2025-01-21 20:52:16'),
(182, 21, 1, '16af400ca8751f18e21d60ec452a79ce6e74589fc0ab58349ba45ecc103017cc', '2025-01-21 20:53:23', '2025-01-21 20:53:23'),
(183, 23, NULL, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 07:38:38', '2025-01-22 07:38:38'),
(184, 8, 21, '2b1a23672cd1e0130695619cf64df98e2c2be00f9841103f2cce3798dcca4dd0', '2025-01-22 07:52:34', '2025-01-22 07:52:34'),
(185, 21, 21, 'e3167475ee843028c7f04f78a1ff3118afbb52f6ed85db5485a5fbcc266ce574', '2025-01-22 07:52:55', '2025-01-22 07:52:55'),
(186, 1, NULL, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 08:22:29', '2025-01-22 08:22:29'),
(187, 17, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:46:23', '2025-01-22 08:46:23'),
(188, 23, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:51:51', '2025-01-22 08:51:51'),
(189, 11, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:52:08', '2025-01-22 08:52:08'),
(190, 9, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:52:22', '2025-01-22 08:52:22'),
(191, 6, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:52:28', '2025-01-22 08:52:28'),
(192, 4, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:52:30', '2025-01-22 08:52:30'),
(193, 2, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:52:36', '2025-01-22 08:52:36'),
(194, 12, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:56:05', '2025-01-22 08:56:05'),
(195, 10, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:56:37', '2025-01-22 08:56:37'),
(196, 8, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:57:15', '2025-01-22 08:57:15'),
(197, 7, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:57:19', '2025-01-22 08:57:19'),
(198, 5, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:59:13', '2025-01-22 08:59:13'),
(199, 3, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:59:25', '2025-01-22 08:59:25'),
(200, 1, 21, '6b587291aa8522ab6311a134f0b62025838494d303399dc52cb4eb65f03399fe', '2025-01-22 08:59:38', '2025-01-22 08:59:38'),
(201, 1, 21, '2b1a23672cd1e0130695619cf64df98e2c2be00f9841103f2cce3798dcca4dd0', '2025-01-22 09:12:15', '2025-01-22 09:12:15'),
(202, 21, 21, '2b1a23672cd1e0130695619cf64df98e2c2be00f9841103f2cce3798dcca4dd0', '2025-01-22 09:12:34', '2025-01-22 09:12:34'),
(203, 22, 21, '2b1a23672cd1e0130695619cf64df98e2c2be00f9841103f2cce3798dcca4dd0', '2025-01-22 09:21:02', '2025-01-22 09:21:02'),
(204, 23, 21, '2b1a23672cd1e0130695619cf64df98e2c2be00f9841103f2cce3798dcca4dd0', '2025-01-22 09:48:32', '2025-01-22 09:48:32'),
(205, 23, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 10:23:40', '2025-01-22 10:23:40'),
(206, 24, 1, 'd61c1034c9036916ea2e1f39bf5302a5381a7cf66c12c4ff7740ecf1684ab2b0', '2025-01-22 11:40:02', '2025-01-22 11:40:02'),
(207, 17, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 12:19:35', '2025-01-22 12:19:35'),
(208, 7, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 13:07:49', '2025-01-22 13:07:49'),
(209, 17, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 14:48:57', '2025-01-22 14:48:57'),
(210, 23, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-22 15:06:03', '2025-01-22 15:06:03'),
(211, 25, NULL, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2025-01-22 19:28:03', '2025-01-22 19:28:03'),
(212, 24, NULL, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2025-01-22 19:31:36', '2025-01-22 19:31:36'),
(213, 23, NULL, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2025-01-22 19:31:38', '2025-01-22 19:31:38'),
(214, 12, 21, 'c309f79a7e1ce6c04578ea9917ce8157c0a9865f9a10aed5d8f499b9df24a8ed', '2025-01-23 07:33:41', '2025-01-23 07:33:41'),
(215, 2, NULL, 'fd0f1095f0e8bfe0cff33b3725198dd1de70d2044c14dc7c33f347251bcf881c', '2025-01-23 07:34:23', '2025-01-23 07:34:23'),
(216, 22, 21, 'c309f79a7e1ce6c04578ea9917ce8157c0a9865f9a10aed5d8f499b9df24a8ed', '2025-01-23 07:34:57', '2025-01-23 07:34:57'),
(217, 22, NULL, '05c46482d23c059c3f8b844dcb94e966bcd0c4ef9a5ff6fa15037bb29ad8d684', '2025-01-23 07:35:49', '2025-01-23 07:35:49'),
(218, 22, NULL, 'f670d163ac28ccd4bd0762326512c480c40975e55dd0bb541f63713a87134d5e', '2025-01-23 07:35:49', '2025-01-23 07:35:49'),
(219, 3, NULL, 'fd0f1095f0e8bfe0cff33b3725198dd1de70d2044c14dc7c33f347251bcf881c', '2025-01-23 07:36:52', '2025-01-23 07:36:52'),
(220, 22, NULL, 'fd0f1095f0e8bfe0cff33b3725198dd1de70d2044c14dc7c33f347251bcf881c', '2025-01-23 07:37:46', '2025-01-23 07:37:46'),
(221, 8, 21, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-23 08:28:51', '2025-01-23 08:28:51'),
(222, 26, NULL, '3e4ee76be8f7a1bea1d74e6510d78dea155938c2ae194c24c7c6d16c4faf41a9', '2025-01-25 16:31:57', '2025-01-25 16:31:57'),
(223, 21, NULL, 'b8af233e5ff978333030730f68e538a0f17e915fd29ee516ccd82f6b2e0a18f6', '2025-01-25 18:31:45', '2025-01-25 18:31:45'),
(224, 26, 1, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-29 13:44:06', '2025-01-29 13:44:06'),
(225, 26, 1, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-01-30 16:29:36', '2025-01-30 16:29:36'),
(226, 11, NULL, '02ae229bd1f885f7c3ef1953c585edc732b72f6792764161e994c8f03b2743e5', '2025-02-05 21:44:14', '2025-02-05 21:44:14'),
(227, 26, 1, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-02-06 12:59:22', '2025-02-06 12:59:22'),
(228, 21, NULL, '3b784f581e703739555f88e410d3d35bff9997d2a3aa02a726e0cddea1748573', '2025-02-06 15:53:40', '2025-02-06 15:53:40'),
(229, 21, NULL, '0b64759320fcc7e0b66b53b43abd371c63a7be98e5cc2189e97a57b56db0168b', '2025-02-06 15:53:44', '2025-02-06 15:53:44'),
(230, 21, NULL, '4230ca286335e4f2ce2ccd893c3334127948f8530f3d12219cff02c701d63b91', '2025-02-06 15:53:44', '2025-02-06 15:53:44'),
(231, 21, NULL, '41e96ad7376bd3139dde2558d6ce43b22669a74f860d41dd05571ee9a8b135ff', '2025-02-06 20:00:34', '2025-02-06 20:00:34'),
(232, 4, 1, '74f3a6fe7ac59507c3938473e88c7b144e8617512cd0a2010ea8163ac8a7f0ab', '2025-02-06 20:34:01', '2025-02-06 20:34:01'),
(233, 28, 1, '74f3a6fe7ac59507c3938473e88c7b144e8617512cd0a2010ea8163ac8a7f0ab', '2025-02-06 20:35:21', '2025-02-06 20:35:21'),
(234, 28, 1, 'd61c1034c9036916ea2e1f39bf5302a5381a7cf66c12c4ff7740ecf1684ab2b0', '2025-02-07 06:55:09', '2025-02-07 06:55:09'),
(235, 28, 23, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-02-11 08:27:36', '2025-02-11 08:27:36'),
(236, 27, 23, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-02-11 14:08:27', '2025-02-11 14:08:27'),
(237, 28, 1, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-02-11 14:09:53', '2025-02-11 14:09:53'),
(238, 2, 1, '19fb966ba194dc6a45dabaa013a72aa5e576489ff06ae5ca75bc09c0aa6bc8ba', '2025-02-11 14:11:18', '2025-02-11 14:11:18'),
(239, 29, 1, 'c8ef2f38734db8cfd58985e7d3a047f54e020a1d4e8ce2cd93de88520a79c3aa', '2025-02-16 07:43:24', '2025-02-16 07:43:24'),
(240, 29, NULL, 'c8ef2f38734db8cfd58985e7d3a047f54e020a1d4e8ce2cd93de88520a79c3aa', '2025-02-16 11:11:30', '2025-02-16 11:11:30'),
(241, 21, 1, '4dcc43e9a2bcfd943d94eb08180df800462d31ebec94ed9c0d659af550e90f9b', '2025-02-16 12:14:24', '2025-02-16 12:14:24'),
(242, 26, 1, '4dcc43e9a2bcfd943d94eb08180df800462d31ebec94ed9c0d659af550e90f9b', '2025-02-16 12:19:05', '2025-02-16 12:19:05'),
(243, 28, NULL, 'c5e6da0a9e7762b8fba61519713ad46b1e30cf9f4761b5b4774071e662db986c', '2025-02-19 10:47:50', '2025-02-19 10:47:50'),
(244, 28, NULL, '0b64759320fcc7e0b66b53b43abd371c63a7be98e5cc2189e97a57b56db0168b', '2025-02-19 10:47:54', '2025-02-19 10:47:54'),
(245, 28, NULL, '5a26c92594920478838d048cb6113bb6df8efe23d87369befa181e20233e3d15', '2025-02-19 10:47:55', '2025-02-19 10:47:55');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pays_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `nom`, `slug`, `pays_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Lomé', 'lome', 1, '2023-12-12 13:12:42', '2023-12-12 13:12:42', NULL, 1, 1, NULL),
(2, 'Tsévié', 'tsevie', 1, '2025-01-21 09:24:43', '2025-01-21 09:24:43', NULL, 21, 21, NULL),
(3, 'Sokodé', 'sokode', 1, '2025-01-21 09:24:43', '2025-01-21 09:24:43', NULL, 21, 21, NULL),
(4, 'Aného', 'aneho', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(5, 'Tabligbo', 'tabligbo', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(6, 'Kévé', 'keve', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(7, 'Vogan', 'vogan', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(8, 'Baguida', 'baguida', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(9, 'Aflao Gakli', 'aflao-gakli', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(10, 'Agbodrafo', 'agbodrafo', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(11, 'Avépozo', 'avepozo', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(12, 'Togoville', 'togoville', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(13, 'Zanguéra', 'zanguera', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(14, 'Glidji', 'glidji', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(15, 'Mission Tové', 'mission-tove', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(16, 'Djagblé', 'djagble', 1, '2025-01-21 09:31:37', '2025-01-21 09:31:37', NULL, 21, 21, NULL),
(17, 'Adétikopé', 'adetikope', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(18, 'Atakpamé', 'atakpame', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(19, 'Kpalimé', 'kpalime', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(20, 'Badou', 'badou', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(21, 'Notsé', 'notse', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(22, 'Amlamé', 'amlame', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(23, 'Agou', 'agou', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(24, 'Danyi', 'danyi', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(25, 'Amou Oblo', 'amou-oblo', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(26, 'Kébo', 'kebo', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(27, 'Akloa', 'akloa', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(28, 'Kougnohou', 'kougnohou', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(29, 'Gboto', 'gboto', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(30, 'Glei', 'glei', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(31, 'Hihéatro', 'hiheatro', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(32, 'Tohoun', 'tohoun', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(33, 'Tchamba', 'tchamba', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(34, 'Blitta', 'blitta', 1, '2025-01-21 09:31:50', '2025-01-21 09:31:50', NULL, 21, 21, NULL),
(35, 'Sotouboua', 'sotouboua', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(36, 'Alédjo-Kadara', 'aledjo-kadara', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(37, 'Kri-Kri', 'kri-kri', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(38, 'Défalé', 'defale', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(39, 'Adjengré', 'adjengre', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(40, 'Langabou', 'langabou', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(41, 'Tcharé', 'tchare', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(42, 'Fazao', 'fazao', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(43, 'Kara', 'kara', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(44, 'Bafilo', 'bafilo', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(45, 'Bassar', 'bassar', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(46, 'Niamtougou', 'niamtougou', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(47, 'Pagouda', 'pagouda', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(48, 'Kandé', 'kande', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(49, 'Kétao', 'ketao', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(50, 'Koutammakou', 'koutammakou', 1, '2025-01-21 09:32:14', '2025-01-21 09:32:14', NULL, 21, 21, NULL),
(51, 'Kabou', 'kabou', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(52, 'Guérin Kouka', 'guerin-kouka', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(53, 'Pya', 'pya', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(54, 'Tchitchao', 'tchitchao', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(55, 'Boufalé', 'boufale', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(56, 'Dapaong', 'dapaong', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(57, 'Cinkassé', 'cinkasse', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(58, 'Mango', 'mango', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(59, 'Tandjouaré', 'tandjouare', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(60, 'Mandouri', 'mandouri', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(61, 'Korbongou', 'korbongou', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(62, 'Bogou', 'bogou', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(63, 'Gando', 'gando', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(64, 'Tami', 'tami', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(65, 'Barkoissi', 'barkoissi', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(66, 'Namoundjoga', 'namoundjoga', 1, '2025-01-21 09:32:28', '2025-01-21 09:32:28', NULL, 21, 21, NULL),
(67, 'Paris', 'paris', 2, '2025-02-03 20:30:19', '2025-02-03 20:31:23', '2025-02-03 20:31:23', 1, 1, 1),
(68, 'Abomey Agbangnizoun Bohicon Covè Djidja Ouinhi Za-Kpota Zogbodomey Ifangni Kétou Pobè Sakété Adja-Ouèrè Adjarra Adjohoun', 'abomey-agbangnizoun-bohicon-cove-djidja-ouinhi-za-kpota-zogbodomey-ifangni-ketou-pobe-sakete-adja-ouere-adjarra-adjohoun', 3, '2025-02-08 14:22:32', '2025-02-08 14:23:12', '2025-02-08 14:23:12', 1, 1, 1),
(69, 'Abomey', 'abomey', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(70, 'Abomey-Calavi', 'abomey-calavi', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(71, 'Adja-Ouèrè', 'adja-ouere', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(72, 'Adjarra', 'adjarra', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(73, 'Adjohoun', 'adjohoun', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(74, 'Aguégués', 'aguegues', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(75, 'Akpro-Missérété', 'akpro-misserete', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(76, 'Allada', 'allada', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(77, 'Aplahoué', 'aplahoue', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(78, 'Athiémé', 'athieme', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(79, 'Avrankou', 'avrankou', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(80, 'Banikoara', 'banikoara', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(81, 'Bassila', 'bassila', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(82, 'Bembéréké', 'bembereke', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(83, 'Bohicon', 'bohicon', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(84, 'Bopa', 'bopa', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(85, 'Bonou', 'bonou', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(86, 'Boukombé', 'boukombe', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(87, 'Cobly', 'cobly', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(88, 'Comé', 'come', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(89, 'Copargo', 'copargo', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(90, 'Cotonou', 'cotonou', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(91, 'Covè', 'cove', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(92, 'Dangbo', 'dangbo', 3, '2025-02-08 14:24:36', '2025-02-08 14:24:36', NULL, 1, 1, NULL),
(93, 'Dassa-Zoumè', 'dassa-zoume', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(94, 'Djakotomey', 'djakotomey', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(95, 'Djidja', 'djidja', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(96, 'Djougou', 'djougou', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(97, 'Dogbo', 'dogbo', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(98, 'Gogounou', 'gogounou', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(99, 'Glazoué', 'glazoue', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(100, 'Grand-Popo', 'grand-popo', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(101, 'Houéyogbé', 'houeyogbe', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(102, 'Ifangni', 'ifangni', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(103, 'Kalalé', 'kalale', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(104, 'Kandi', 'kandi', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(105, 'Karimama', 'karimama', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(106, 'Kérou', 'kerou', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(107, 'Kétou', 'ketou', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(108, 'Klouékanmè', 'klouekanme', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(109, 'Kouandé', 'kouande', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(110, 'Kpomassè', 'kpomasse', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(111, 'Lalo', 'lalo', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(112, 'Lokossa', 'lokossa', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(113, 'Malanville', 'malanville', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(114, 'Matéri', 'materi', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(115, 'N\'Dali', 'ndali', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(116, 'Natitingou', 'natitingou', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(117, 'Nikki', 'nikki', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(118, 'Ouinhi', 'ouinhi', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(119, 'Ouaké', 'ouake', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(120, 'Ouèssè', 'ouesse', 3, '2025-02-08 14:24:57', '2025-02-08 14:24:57', NULL, 1, 1, NULL),
(121, 'Ouidah', 'ouidah', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(122, 'Péhunco', 'pehunco', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(123, 'Parakou', 'parakou', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(124, 'Pèrèrè', 'perere', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(125, 'Pobè', 'pobe', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(126, 'Porto-Novo', 'porto-novo', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(127, 'Sakété', 'sakete', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(128, 'Savalou', 'savalou', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(129, 'Savè', 'save', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(130, 'Ségbana', 'segbana', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(131, 'Sèmè-Kpodji', 'seme-kpodji', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(132, 'Sinendé', 'sinende', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(133, 'Sô-Ava', 'so-ava', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(134, 'Tanguiéta', 'tanguieta', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(135, 'Tchaourou', 'tchaourou', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(136, 'Toffo', 'toffo', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(137, 'Toribossito', 'toribossito', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(138, 'Toucountouna', 'toucountouna', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(139, 'Toviklin', 'toviklin', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(140, 'Zè', 'ze', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(141, 'Za-Kpota', 'za-kpota', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL),
(142, 'Zogbodomey', 'zogbodomey', 3, '2025-02-08 14:25:13', '2025-02-08 14:25:13', NULL, 1, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abonnements_offre_abonnement_id_foreign` (`offre_abonnement_id`);

--
-- Index pour la table `abonnement_entreprise`
--
ALTER TABLE `abonnement_entreprise`
  ADD KEY `abonnement_entreprise_abonnement_id_foreign` (`abonnement_id`),
  ADD KEY `abonnement_entreprise_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `annonces_entreprise_id_foreign` (`entreprise_id`),
  ADD KEY `annonces_image_foreign` (`image`),
  ADD KEY `annonces_titre_index` (`titre`),
  ADD KEY `annonces_type_index` (`type`),
  ADD KEY `annonces_description_index` (`description`(768)),
  ADD KEY `annonces_created_at_index` (`created_at`),
  ADD KEY `annonces_ville_id_foreign` (`ville_id`);

--
-- Index pour la table `annonce_fichier`
--
ALTER TABLE `annonce_fichier`
  ADD KEY `annonce_fichier_annonce_id_foreign` (`annonce_id`),
  ADD KEY `annonce_fichier_fichier_id_foreign` (`fichier_id`);

--
-- Index pour la table `annonce_reference_valeur`
--
ALTER TABLE `annonce_reference_valeur`
  ADD KEY `annonce_reference_valeur_annonce_id_foreign` (`annonce_id`),
  ADD KEY `annonce_reference_valeur_reference_valeur_id_foreign` (`reference_valeur_id`);

--
-- Index pour la table `auberges`
--
ALTER TABLE `auberges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bars`
--
ALTER TABLE `bars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boite_de_nuits`
--
ALTER TABLE `boite_de_nuits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_user_id_foreign` (`user_id`),
  ADD KEY `commentaires_parent_id_foreign` (`parent_id`),
  ADD KEY `commentaires_annonce_id_foreign` (`annonce_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entreprises_nom_unique` (`nom`),
  ADD UNIQUE KEY `entreprises_telephone_unique` (`telephone`),
  ADD UNIQUE KEY `entreprises_email_unique` (`email`),
  ADD KEY `entreprises_quartier_id_foreign` (`quartier_id`);

--
-- Index pour la table `entreprise_user`
--
ALTER TABLE `entreprise_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entreprise_user_entreprise_id_foreign` (`entreprise_id`),
  ADD KEY `entreprise_user_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fast_foods`
--
ALTER TABLE `fast_foods`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favoris_user_id_foreign` (`user_id`),
  ADD KEY `favoris_annonce_id_foreign` (`annonce_id`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `heure_ouvertures`
--
ALTER TABLE `heure_ouvertures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `heure_ouvertures_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `location_meublees`
--
ALTER TABLE `location_meublees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `location_vehicules`
--
ALTER TABLE `location_vehicules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `marques_nom_unique` (`nom`),
  ADD UNIQUE KEY `marques_slug_unique` (`slug`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modeles_nom_marque_id_unique` (`nom`,`marque_id`),
  ADD KEY `modeles_marque_id_foreign` (`marque_id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `notations`
--
ALTER TABLE `notations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notations_user_id_foreign` (`user_id`),
  ADD KEY `notations_annonce_id_foreign` (`annonce_id`);

--
-- Index pour la table `offre_abonnements`
--
ALTER TABLE `offre_abonnements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `patisseries`
--
ALTER TABLE `patisseries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pays_nom_unique` (`nom`),
  ADD UNIQUE KEY `pays_slug_unique` (`slug`),
  ADD UNIQUE KEY `pays_code_unique` (`code`),
  ADD UNIQUE KEY `pays_indicatif_unique` (`indicatif`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `quartiers`
--
ALTER TABLE `quartiers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quartiers_nom_ville_id_unique` (`nom`,`ville_id`),
  ADD KEY `quartiers_ville_id_foreign` (`ville_id`);

--
-- Index pour la table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `references_type_nom_unique` (`type`,`nom`);

--
-- Index pour la table `reference_valeurs`
--
ALTER TABLE `reference_valeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_valeurs_reference_id_foreign` (`reference_id`);

--
-- Index pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_trans_id_unique` (`trans_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_offre_id_foreign` (`offre_id`),
  ADD KEY `transactions_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_telephone_unique` (`telephone`);

--
-- Index pour la table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_annonce_id_foreign` (`annonce_id`),
  ADD KEY `views_user_id_foreign` (`user_id`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `villes_nom_pays_id_unique` (`nom`,`pays_id`),
  ADD KEY `villes_pays_id_foreign` (`pays_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnements`
--
ALTER TABLE `abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `auberges`
--
ALTER TABLE `auberges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `bars`
--
ALTER TABLE `bars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `boite_de_nuits`
--
ALTER TABLE `boite_de_nuits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `entreprise_user`
--
ALTER TABLE `entreprise_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fast_foods`
--
ALTER TABLE `fast_foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT pour la table `heure_ouvertures`
--
ALTER TABLE `heure_ouvertures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `location_meublees`
--
ALTER TABLE `location_meublees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `location_vehicules`
--
ALTER TABLE `location_vehicules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT pour la table `notations`
--
ALTER TABLE `notations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offre_abonnements`
--
ALTER TABLE `offre_abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `patisseries`
--
ALTER TABLE `patisseries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quartiers`
--
ALTER TABLE `quartiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `references`
--
ALTER TABLE `references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `reference_valeurs`
--
ALTER TABLE `reference_valeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT pour la table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD CONSTRAINT `abonnements_offre_abonnement_id_foreign` FOREIGN KEY (`offre_abonnement_id`) REFERENCES `offre_abonnements` (`id`);

--
-- Contraintes pour la table `abonnement_entreprise`
--
ALTER TABLE `abonnement_entreprise`
  ADD CONSTRAINT `abonnement_entreprise_abonnement_id_foreign` FOREIGN KEY (`abonnement_id`) REFERENCES `abonnements` (`id`),
  ADD CONSTRAINT `abonnement_entreprise_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `annonces_image_foreign` FOREIGN KEY (`image`) REFERENCES `fichiers` (`id`),
  ADD CONSTRAINT `annonces_ville_id_foreign` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `annonce_fichier`
--
ALTER TABLE `annonce_fichier`
  ADD CONSTRAINT `annonce_fichier_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`),
  ADD CONSTRAINT `annonce_fichier_fichier_id_foreign` FOREIGN KEY (`fichier_id`) REFERENCES `fichiers` (`id`);

--
-- Contraintes pour la table `annonce_reference_valeur`
--
ALTER TABLE `annonce_reference_valeur`
  ADD CONSTRAINT `annonce_reference_valeur_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`),
  ADD CONSTRAINT `annonce_reference_valeur_reference_valeur_id_foreign` FOREIGN KEY (`reference_valeur_id`) REFERENCES `reference_valeurs` (`id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`),
  ADD CONSTRAINT `commentaires_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `commentaires` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_quartier_id_foreign` FOREIGN KEY (`quartier_id`) REFERENCES `quartiers` (`id`);

--
-- Contraintes pour la table `entreprise_user`
--
ALTER TABLE `entreprise_user`
  ADD CONSTRAINT `entreprise_user_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `entreprise_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`),
  ADD CONSTRAINT `favoris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `heure_ouvertures`
--
ALTER TABLE `heure_ouvertures`
  ADD CONSTRAINT `heure_ouvertures_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD CONSTRAINT `modeles_marque_id_foreign` FOREIGN KEY (`marque_id`) REFERENCES `marques` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notations`
--
ALTER TABLE `notations`
  ADD CONSTRAINT `notations_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`),
  ADD CONSTRAINT `notations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `quartiers`
--
ALTER TABLE `quartiers`
  ADD CONSTRAINT `quartiers_ville_id_foreign` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Contraintes pour la table `reference_valeurs`
--
ALTER TABLE `reference_valeurs`
  ADD CONSTRAINT `reference_valeurs_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `references` (`id`);

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `transactions_offre_id_foreign` FOREIGN KEY (`offre_id`) REFERENCES `offre_abonnements` (`id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_annonce_id_foreign` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `villes_pays_id_foreign` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
