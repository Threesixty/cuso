-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 nov. 2023 à 13:33
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cuso`
--

-- --------------------------------------------------------

--
-- Structure de la table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_role` int(11) DEFAULT 0,
  `reccurence` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_redirect` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_embed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_parent_id` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cms`
--

INSERT INTO `cms` (`id`, `type`, `title`, `url`, `url_redirect`, `template`, `tags`, `photo_id`, `youtube_embed`, `youtube_on`, `meta_title`, `meta_description`, `summary`, `content`, `status`, `start_date`, `end_date`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(1, 'cms', 'Accueil', 'accueil', '', 'index', 'null', '[]', '', '0', 'Accueil', '', '', '[]', 1, 1697061600, 0, 'fr', NULL, 1, 1697106833);

-- --------------------------------------------------------

--
-- Structure de la table `community`
--

CREATE TABLE `community` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_line1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity_area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public` int(11) DEFAULT 0,
  `size` int(11) NOT NULL,
  `licenses_count` int(11) NOT NULL,
  `membership_end` int(11) NOT NULL,
  `is_sponsor` int(11) DEFAULT 0,
  `main_contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_contact_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_platform` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `cms_id` int(11) NOT NULL,
  `start_datetime` int(11) DEFAULT NULL,
  `end_datetime` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `synthesis` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `prospect` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `legend` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fr',
  `lang_parent_id` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1605009323),
('m130524_201442_init', 1605009325),
('m190124_110200_add_verification_token_column_to_user_table', 1605009325),
('m201116_232640_create_cms_table', 1605795654),
('m201125_175159_create_media_table', 1606327144),
('m201126_082914_create_option_table', 1606392915),
('m201211_081019_update_user_table', 1607674639),
('m201214_102628_create_update_table', 1607941891),
('m231018_102537_update_cms_table', 1697625000),
('m231025_213504_create_event_table', 1699877440),
('m231113_105518_create_company_table', 1699877440),
('m231113_115419_create_model_relations_table', 1699877440),
('m231113_115635_create_forum_table', 1699877440),
('m231113_115643_create_chatbot_table', 1699877440),
('m231113_120632_create_community_table', 1699877440),
('m231113_122341_update_user_table', 1699878683);

-- --------------------------------------------------------

--
-- Structure de la table `model_relations`
--

CREATE TABLE `model_relations` (
  `id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `type_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `options_contents` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_parent_id` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `option`
--

INSERT INTO `option` (`id`, `title`, `name`, `description`, `options`, `options_contents`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(1, 'Catégories CMS', 'cms-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Défaut\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Défaut\",\"content\":[{\"slug\":\"option_value\",\"value\":\"default\"}]}]', 'fr', NULL, 1, 1616515487),
(2, 'Modèles de page', 'cms-template', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Accueil\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Contactez-nous\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Accueil\",\"content\":[{\"slug\":\"option_value\",\"value\":\"index\"}]},{\"id\":\"j1_5\",\"name\":\"Contactez-nous\",\"content\":[{\"slug\":\"option_value\",\"value\":\"form/contact-us\"}]}]', 'fr', NULL, 1, 1616515552),
(3, 'Étiquettes CMS', 'cms-tags', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_14\",\"text\":\"Formulaire de contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_14\",\"name\":\"Formulaire de contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"contact-form\"}]}]', 'fr', NULL, 1, 1616515606),
(5, 'Configuration des menus front-office', '_menus_', 'SPECIAL', '[{\"id\":\"j1_1\",\"text\":\"Menus\",\"state\":{\"opened\":true},\"data\":{},\"children\":[{\"id\":\"j1_5\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_4\",\"text\":\"Accueil\",\"state\":{\"opened\":true},\"data\":{\"id\":\"1\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_47\",\"text\":\"MENU FOOTER - Contact\",\"state\":{\"opened\":true},\"data\":[],\"children\":[],\"type\":\"default\"}],\"type\":\"default\"}]', '[]', 'fr', NULL, 1, 1619700894),
(6, 'Menus', 'menus', 'Liste des menus de navigation front', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"MENU FOOTER - Contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Menu principal\",\"content\":[{\"slug\":\"option_value\",\"value\":\"main-menu\"}]},{\"id\":\"j1_13\",\"name\":\"MENU FOOTER - Contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"0\"}]}]', 'fr', NULL, 1, 1620824065),
(20, 'Catégorie événement', 'event-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[]}]', '[]', 'fr', NULL, 1, 1698320336),
(21, 'Type d\'événements', 'event-types', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Atelier\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Commission\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Groupe de travail\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Evénements Oracle\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Webinar\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698320365),
(22, 'Produits utilisés', 'products', 'Produits utilisés par un membre', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"AUFO\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_3\",\"text\":\"Base de Données, Middleware, Operating Systemes\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Business Intelligence – OBIEE – Endeca\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Customer Experience (CXM) – Siebel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Engineered systems\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Financials, Procurement, Governance &amp; Risk – eBusiness Suite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Financials, Procurement, Governance &amp; Risk – Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Human Capital Management (HCM) – Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Human Capital Management (HCM) – Taleo\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Hyperion &amp; EPM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Outils de développement – Autres\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_17\",\"text\":\"utils de développement – JAVA\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_18\",\"text\":\"Project Management &amp; Primavera\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_19\",\"text\":\"Supply Chain &amp; Manufacturing – eBusiness Suite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_20\",\"text\":\"Supply Chain &amp; Manufacturing – Fusion\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_21\",\"text\":\"JD Edwards\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_22\",\"text\":\"J.D.Edwards Enterprise One 7.33\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_23\",\"text\":\"J.D.Edwards Enterprise One 8.12\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_24\",\"text\":\"J.D.Edwards Enterprise One 9.0\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_25\",\"text\":\"J.D.Edwards Enterprise One 9.1\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_26\",\"text\":\"J.D.Edwards Enterprise One 9.2\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_27\",\"text\":\"J.D.Edwards World\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_28\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_29\",\"text\":\"PeopleSoft\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_30\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_31\",\"text\":\"Peoplesoft CRM (Customer Relationship Management)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_32\",\"text\":\"Peoplesoft FSCM (Financials)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_33\",\"text\":\"Peoplesoft HCM (Human Capital Management)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_34\",\"text\":\"Peoplesoft PeopleTools\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_35\",\"text\":\"Peoplesoft Portal\",\"state\":{\"opened\":true},\"children\":[]}]}]}]', '[]', 'fr', NULL, 1, 1698320541),
(23, 'Centres d\'intérêts', 'interests', 'Centres d\'intérêts d\'un membre', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Achat / Supply Distribution\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Cloud : Saas, Iaas &amp; Paas\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Finance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Gestion de la relation client\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Matériel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Mobilité et Géolocalisation\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Pilotage de Projet et Gouvernance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Production\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Ressources Humaines\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Techno : Administration des applications\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Techno : Middleware / Base de Données\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Techno : Développement et Optimisation Technique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"Utilisation des Applications / Paramétrages / Cas d’usage\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Vente / Commercial / Marketing\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698320576),
(24, 'Périmètre décisionnel', 'decision-scope', 'Périmètre décisionnel d\'un membre', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Direction Générale\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Pilotage SI/ Architecture/ Roadmap/ Gouvernance SI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Pilotage de Projet/ Déploiement/ Gestion Changement\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Administration Fonctionnelle / Evolution &amp; Maintenance / Support Fonctionnel / Usage\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Technique &amp; Systèmes\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Autres\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698699624),
(25, 'Catégories forum', 'forum-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Emploi\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698703522);

-- --------------------------------------------------------

--
-- Structure de la table `update`
--

CREATE TABLE `update` (
  `id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `update`
--

INSERT INTO `update` (`id`, `model`, `model_id`, `action`, `date`, `author`) VALUES
(1, 'user', 1, 'update', 1697113559, 1),
(2, 'user', 1, 'update', 1697113634, 1),
(3, 'option', 3, 'update', 1697115194, 1),
(4, 'media', 1, 'new', 1697116680, 1),
(5, 'media', 1, 'delete', 1697117118, 1),
(6, 'media', 2, 'new', 1697192222, 1),
(7, 'media', 2, 'delete', 1697192230, 1),
(8, 'menus', 5, 'update', 1697192254, 1),
(9, 'menus', 5, 'update', 1697192259, 1),
(10, 'option', 20, 'new', 1698320336, 1),
(11, 'option', 21, 'new', 1698320366, 1),
(12, 'option', 21, 'update', 1698320442, 1),
(13, 'option', 1, 'update', 1698320502, 1),
(14, 'option', 22, 'new', 1698320541, 1),
(15, 'option', 23, 'new', 1698320576, 1),
(16, 'option', 23, 'update', 1698320596, 1),
(17, 'option', 23, 'update', 1698320776, 1),
(18, 'option', 23, 'update', 1698320796, 1),
(19, 'option', 22, 'update', 1698321108, 1),
(20, 'media', 3, 'new', 1698323975, 1),
(21, 'menus', 5, 'update', 1698324012, 1),
(22, 'media', 3, 'delete', 1698685628, 1),
(23, 'option', 23, 'update', 1698699338, 1),
(24, 'option', 22, 'update', 1698699363, 1),
(25, 'option', 24, 'new', 1698699624, 1),
(26, 'option', 24, 'update', 1698700392, 1),
(27, 'option', 25, 'new', 1698703523, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `is_speaker` int(11) DEFAULT 0,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `function` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decision_scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT 0,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `photo_id`, `gender`, `firstname`, `lastname`, `company_id`, `is_speaker`, `phone`, `mobile`, `department`, `function`, `decision_scope`, `role`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'michael.convergence@gmail.com', 'vzOTuHgr6qCV7nCuvo5Ls4SPL4SBtlfH', '$2y$13$D/tdMxWY30CKGPvBlMxH2.Q6ihMwRGeZkRO8lRo46jjIqp3jPqvmi', 'UoB28i32eum5zOaWgxhGGUM3mJql1STx_1606321467', 'michael.convergence@gmail.com', NULL, 'Mr', 'Michael', 'THOMAS', 0, 0, NULL, NULL, NULL, NULL, NULL, 5, 10, 1605009349, 1697113634, 'mJd519zaQzC8rJpXyD_N2r01txIIKdAy_1605009349');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-cms-photo` (`photo_id`),
  ADD KEY `idx-cms-lang_parent` (`lang_parent_id`),
  ADD KEY `idx-cms-author` (`author`),
  ADD KEY `idx-company-photo` (`photo_id`);

--
-- Index pour la table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `model_relations`
--
ALTER TABLE `model_relations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-update-model_id` (`model_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `community`
--
ALTER TABLE `community`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `model_relations`
--
ALTER TABLE `model_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `update`
--
ALTER TABLE `update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cms`
--
ALTER TABLE `cms`
  ADD CONSTRAINT `fk-cms-author` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `fk-cms-parent_lang` FOREIGN KEY (`lang_parent_id`) REFERENCES `cms` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
