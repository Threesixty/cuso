-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 jan. 2024 à 17:14
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
(1, 'cms', 'Accueil', 'accueil', '', 'index', 'null', '[]', '', '0', 'Accueil', '', '', '[]', 1, 1697061600, 0, 'fr', NULL, 1, 1697106833),
(23, 'event', 'Event', 'event', '', NULL, 'null', '[]', NULL, '0', 'Test', '', '', '[]', 1, 1700089200, 0, 'fr', NULL, 1, 1700134631),
(24, 'news', 'Actu', 'actu', '', NULL, 'null', '[]', NULL, '0', 'Titre', '', ' Description', '[{\"position\":1,\"block\":\"simple-title\",\"value\":{\"title\":\"Rencontrez les fabricants !\",\"subtitle\":\"\",\"color\":\"\",\"alignment\":\"\"}}]', 0, 1700262000, 0, 'fr', NULL, 1, 1700333636);

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `author` int(11) NOT NULL,
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
  `event_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `synthesis` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerable` int(11) NOT NULL DEFAULT 1,
  `prospect` int(11) NOT NULL DEFAULT 0,
  `documents` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `cms_id`, `start_datetime`, `end_datetime`, `event_type`, `address`, `street_number`, `route`, `postal_code`, `locality`, `address_detail`, `program`, `synthesis`, `registerable`, `prospect`, `documents`) VALUES
(1, 23, 1700134620, 1700153580, 'Groupe de travail', '170 rue Pierre Gilles de Gennes', NULL, NULL, NULL, NULL, '<p>Accès </p>', '<p>Programme<br></p>', '', 1, 1, '[5]');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
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

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `title`, `alt`, `legend`, `path`, `tags`, `link`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(5, 'Évolution portail CUSO', NULL, NULL, '1700176423_evolution-portail-cuso.pdf', NULL, NULL, 'fr', NULL, 1, 1700176423);

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
('m231025_213504_create_event_table', 1699975924),
('m231113_105518_create_company_table', 1704793447),
('m231113_115419_create_model_relations_table', 1699877440),
('m231113_115635_create_forum_table', 1704793691),
('m231113_115643_create_chatbot_table', 1699877440),
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
  `type_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `model_relations`
--

INSERT INTO `model_relations` (`id`, `model`, `model_id`, `type`, `type_name`, `type_id`) VALUES
(155, 'news', 24, 'option', 'interests', 'Achat / Supply Distribution '),
(156, 'news', 24, 'option', 'interests', 'Techno : Middleware / Base de Données'),
(157, 'news', 24, 'option', 'products', 'Business Intelligence – OBIEE – Endeca'),
(158, 'news', 24, 'option', 'products', 'Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)'),
(159, 'news', 24, 'community', NULL, 'ERP Cloud / Fusion'),
(160, 'news', 24, 'community', NULL, 'EPM'),
(161, 'event', 23, 'option', 'interests', 'Achat / Supply Distribution '),
(162, 'event', 23, 'option', 'interests', 'Techno : Développement et Optimisation Technique'),
(163, 'event', 23, 'option', 'products', 'Base de Données, Middleware, Operating Systemes'),
(164, 'event', 23, 'option', 'products', 'Business Intelligence – OBIEE – Endeca'),
(165, 'event', 23, 'community', NULL, 'ERP Cloud / Fusion'),
(166, 'event', 23, 'community', NULL, 'EPM'),
(167, 'event', 23, 'speakers', NULL, '1'),
(168, 'event', 23, 'speakers', NULL, '18');

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
(1, 'Configuration des menus front-office', '_menus_', 'SPECIAL', '[{\"id\":\"j1_1\",\"text\":\"Menus\",\"state\":{\"opened\":true},\"data\":{},\"children\":[{\"id\":\"j1_5\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_4\",\"text\":\"Accueil\",\"state\":{\"opened\":true},\"data\":{\"id\":\"1\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_47\",\"text\":\"MENU FOOTER - Contact\",\"state\":{\"opened\":true},\"data\":[],\"children\":[],\"type\":\"default\"}],\"type\":\"default\"}]', '[]', 'fr', NULL, 1, 1698320186),
(2, 'Modèles de page', 'cms-template', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Accueil\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Contactez-nous\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Accueil\",\"content\":[{\"slug\":\"option_value\",\"value\":\"index\"}]},{\"id\":\"j1_5\",\"name\":\"Contactez-nous\",\"content\":[{\"slug\":\"option_value\",\"value\":\"form/contact-us\"}]}]', 'fr', NULL, 1, 1698320200),
(3, 'Étiquettes CMS', 'cms-tags', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_14\",\"text\":\"Formulaire de contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_14\",\"name\":\"Formulaire de contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"contact-form\"}]}]', 'fr', NULL, 1, 1698320236),
(4, 'Catégories CMS', 'cms-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Défaut\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Défaut\",\"content\":[{\"slug\":\"option_value\",\"value\":\"default\"}]}]', 'fr', NULL, 1, 1698320266),
(5, 'Menus', 'menus', 'Liste des menus de navigation front', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"MENU FOOTER - Contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Menu principal\",\"content\":[{\"slug\":\"option_value\",\"value\":\"main-menu\"}]},{\"id\":\"j1_13\",\"name\":\"MENU FOOTER - Contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"0\"}]}]', 'fr', NULL, 1, 1698320306),
(6, 'Catégories événement', 'event-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Webinar\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Webinar\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Webinar\"}]}]', 'fr', NULL, 1, 1698320336),
(7, 'Type d\'événements', 'event-types', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Atelier\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Commission\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Groupe de travail\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Evénements Oracle\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Webinar\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Atelier\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Atelier\"}]},{\"id\":\"j1_3\",\"name\":\"Commission\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Commission\"}]},{\"id\":\"j1_4\",\"name\":\"Groupe de travail\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Groupe de travail\"}]},{\"id\":\"j1_5\",\"name\":\"Evénements Oracle\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Evénements Oracle\"}]},{\"id\":\"j1_6\",\"name\":\"Webinar\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Webinar\"}]}]', 'fr', NULL, 1, 1698320365),
(8, 'Produits utilisés', 'products', 'Produits utilisés par un membre', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"AUFO\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_3\",\"text\":\"Base de Données, Middleware, Operating Systemes\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Business Intelligence – OBIEE – Endeca\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Customer Experience (CXM) – Siebel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Engineered systems\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Financials, Procurement, Governance &amp; Risk – eBusiness Suite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Financials, Procurement, Governance &amp; Risk – Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Human Capital Management (HCM) – Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Human Capital Management (HCM) – Taleo\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Hyperion &amp; EPM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Outils de développement – Autres\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_17\",\"text\":\"Outils de développement – JAVA\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_18\",\"text\":\"Project Management &amp; Primavera\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_19\",\"text\":\"Supply Chain and Manufacturing – eBusiness Suite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_20\",\"text\":\"Supply Chain and Manufacturing – Fusion\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_21\",\"text\":\"JD Edwards\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_22\",\"text\":\"J.D.Edwards Enterprise One 7.33\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_23\",\"text\":\"J.D.Edwards Enterprise One 8.12\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_24\",\"text\":\"J.D.Edwards Enterprise One 9.0\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_25\",\"text\":\"J.D.Edwards Enterprise One 9.1\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_26\",\"text\":\"J.D.Edwards Enterprise One 9.2\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_27\",\"text\":\"J.D.Edwards World\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_28\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_29\",\"text\":\"PeopleSoft\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_30\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_31\",\"text\":\"Peoplesoft CRM (Customer Relationship Management)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_32\",\"text\":\"Peoplesoft FSCM (Financials)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_33\",\"text\":\"Peoplesoft HCM (Human Capital Management)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_34\",\"text\":\"Peoplesoft PeopleTools\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_35\",\"text\":\"Peoplesoft Portal\",\"state\":{\"opened\":true},\"children\":[]}]}]}]', '[{\"id\":\"j1_3\",\"name\":\"Base de Données, Middleware, Operating Systemes\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Base de Données, Middleware, Operating Systemes\"}]},{\"id\":\"j1_4\",\"name\":\"Business Intelligence – OBIEE – Endeca\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Business Intelligence – OBIEE – Endeca\"}]},{\"id\":\"j1_5\",\"name\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\"}]},{\"id\":\"j1_6\",\"name\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\"}]},{\"id\":\"j1_7\",\"name\":\"Customer Experience (CXM) – Siebel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Siebel\"}]},{\"id\":\"j1_8\",\"name\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\"}]},{\"id\":\"j1_9\",\"name\":\"Engineered systems\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Engineered systems\"}]},{\"id\":\"j1_10\",\"name\":\"Financials, Procurement, Governance & Risk – eBusiness Suite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Financials, Procurement, Governance & Risk – eBusiness Suite\"}]},{\"id\":\"j1_11\",\"name\":\"Financials, Procurement, Governance & Risk – Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Financials, Procurement, Governance & Risk – Fusion\"}]},{\"id\":\"j1_12\",\"name\":\"Human Capital Management (HCM) – Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Human Capital Management (HCM) – Fusion\"}]},{\"id\":\"j1_13\",\"name\":\"Human Capital Management (HCM) – Taleo\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Human Capital Management (HCM) – Taleo\"}]},{\"id\":\"j1_14\",\"name\":\"Hyperion & EPM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Hyperion & EPM\"}]},{\"id\":\"j1_15\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"AUFO NetSuite\"}]},{\"id\":\"j1_16\",\"name\":\"Outils de développement – Autres\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Outils de développement – Autres\"}]},{\"id\":\"j1_17\",\"name\":\"utils de développement – JAVA\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Outils de développement – JAVA\"}]},{\"id\":\"j1_18\",\"name\":\"Project Management & Primavera\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Project Management & Primavera\"}]},{\"id\":\"j1_20\",\"name\":\"Supply Chain and Manufacturing – Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Project Management and Primavera\"}]},{\"id\":\"j1_19\",\"name\":\"Supply Chain and Manufacturing – eBusiness Suite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Supply Chain and Manufacturing – eBusiness Suite\"}]},{\"id\":\"j1_22\",\"name\":\"J.D.Edwards Enterprise One 7.33\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 7.33\"}]},{\"id\":\"j1_23\",\"name\":\"J.D.Edwards Enterprise One 8.12\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 8.12\"}]},{\"id\":\"j1_25\",\"name\":\"J.D.Edwards Enterprise One 9.1\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 9.1\"}]},{\"id\":\"j1_24\",\"name\":\"J.D.Edwards Enterprise One 9.0\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 9.0\"}]},{\"id\":\"j1_26\",\"name\":\"J.D.Edwards Enterprise One 9.2\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 9.2\"}]},{\"id\":\"j1_27\",\"name\":\"J.D.Edwards World\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards World\"}]},{\"id\":\"j1_28\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"JD Edwards NetSuite\"}]},{\"id\":\"j1_30\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"PeopleSoft NetSuite\"}]},{\"id\":\"j1_31\",\"name\":\"Peoplesoft CRM (Customer Relationship Management)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft CRM (Customer Relationship Management)\"}]},{\"id\":\"j1_32\",\"name\":\"Peoplesoft FSCM (Financials)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft FSCM (Financials)\"}]},{\"id\":\"j1_33\",\"name\":\"Peoplesoft HCM (Human Capital Management)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft HCM (Human Capital Management)\"}]},{\"id\":\"j1_34\",\"name\":\"Peoplesoft PeopleTools\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft PeopleTools\"}]},{\"id\":\"j1_35\",\"name\":\"Peoplesoft Portal\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft Portal\"}]}]', 'fr', NULL, 1, 1698320541),
(9, 'Centres d\'intérêts', 'interests', 'Centres d\'intérêts d\'un membre', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Achat / Supply Distribution\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Cloud : Saas, Iaas &amp; Paas\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Finance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Gestion de la relation client\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Matériel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Mobilité et Géolocalisation\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Pilotage de Projet et Gouvernance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Production\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Ressources Humaines\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Techno : Administration des applications\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Techno : Middleware / Base de Données\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Techno : Développement et Optimisation Technique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"Utilisation des Applications / Paramétrages / Cas d’usage\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Vente / Commercial / Marketing\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Achat / Supply Distribution\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Achat / Supply Distribution \"}]},{\"id\":\"j1_3\",\"name\":\"Cloud : Saas, Iaas & Paas\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Cloud : Saas, Iaas & Paas \"}]},{\"id\":\"j1_4\",\"name\":\"Finance\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Finance\"}]},{\"id\":\"j1_5\",\"name\":\"Gestion de la relation client\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Gestion de la relation client \"}]},{\"id\":\"j1_6\",\"name\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\"}]},{\"id\":\"j1_7\",\"name\":\"Matériel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Matériel\"}]},{\"id\":\"j1_8\",\"name\":\"Mobilité et Géolocalisation\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Mobilité et Géolocalisation \"}]},{\"id\":\"j1_9\",\"name\":\"Pilotage de Projet et Gouvernance\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Pilotage de Projet et Gouvernance\"}]},{\"id\":\"j1_10\",\"name\":\"Production\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Production\"}]},{\"id\":\"j1_12\",\"name\":\"Techno : Administration des applications\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Techno : Administration des applications\"}]},{\"id\":\"j1_11\",\"name\":\"Ressources Humaines\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Ressources Humaines\"}]},{\"id\":\"j1_13\",\"name\":\"Techno : Middleware / Base de Données\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Techno : Middleware / Base de Données\"}]},{\"id\":\"j1_14\",\"name\":\"Techno : Développement et Optimisation Technique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Techno : Développement et Optimisation Technique\"}]},{\"id\":\"j1_15\",\"name\":\"Utilisation des Applications / Paramétrages / Cas d’usage\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Utilisation des Applications / Paramétrages / Cas d’usage\"}]},{\"id\":\"j1_16\",\"name\":\"Vente / Commercial / Marketing\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Vente / Commercial / Marketing\"}]}]', 'fr', NULL, 1, 1698320576),
(10, 'Périmètre décisionnel', 'decision-scope', 'Périmètre décisionnel d\'un membre', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Direction Générale\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Pilotage SI/ Architecture/ Roadmap/ Gouvernance SI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Pilotage de Projet/ Déploiement/ Gestion Changement\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Administration Fonctionnelle / Evolution &amp; Maintenance / Support Fonctionnel / Usage\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Technique &amp; Systèmes\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Autres\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698699624),
(11, 'Catégories forum', 'forum-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Emploi\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698703522),
(26, 'Communautés', 'communities', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_4\",\"text\":\"Finance\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"ERP Cloud / Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"    EPM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"JD Edwards\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"PeopleSoft\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"EBS\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"HFM Hyperion\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_9\",\"text\":\"SCM\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_10\",\"text\":\"HCM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_21\",\"text\":\"SCM\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_12\",\"text\":\"CRM\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_13\",\"text\":\"Eloqua\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Siebel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_20\",\"text\":\"CX\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_16\",\"text\":\"Data/IA\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_17\",\"text\":\"BI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_18\",\"text\":\"OAC\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_19\",\"text\":\"OBIEE\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_22\",\"text\":\"Transport\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_23\",\"text\":\"OTM\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_24\",\"text\":\"Tech/Cloud\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_25\",\"text\":\"OCI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_26\",\"text\":\"Java\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_27\",\"text\":\"SQL\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_28\",\"text\":\"Gouvernance SI\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_4\",\"name\":\"Finance\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Finance\"}]},{\"id\":\"j1_2\",\"name\":\"ERP Cloud / Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"ERP Cloud / Fusion\"}]},{\"id\":\"j1_3\",\"name\":\" EPM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"EPM\"}]},{\"id\":\"j1_5\",\"name\":\"JD Edwards\",\"content\":[{\"slug\":\"option_value\",\"value\":\"JD Edwards\"}]},{\"id\":\"j1_6\",\"name\":\"PeopleSoft\",\"content\":[{\"slug\":\"option_value\",\"value\":\"PeopleSoft\"}]},{\"id\":\"j1_7\",\"name\":\"EBS\",\"content\":[{\"slug\":\"option_value\",\"value\":\"EBS\"}]},{\"id\":\"j1_8\",\"name\":\"HFM Hyperion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"HFM Hyperion\"}]},{\"id\":\"j1_9\",\"name\":\"SCM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"SCM\"}]},{\"id\":\"j1_10\",\"name\":\"HCM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"HCM\"}]},{\"id\":\"j1_21\",\"name\":\"SCM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"SCM\"}]},{\"id\":\"j1_12\",\"name\":\"CRM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"CRM\"}]},{\"id\":\"j1_14\",\"name\":\"Siebel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Siebel\"}]},{\"id\":\"j1_13\",\"name\":\"Eloqua\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Eloqua\"}]},{\"id\":\"j1_15\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"NetSuite\"}]},{\"id\":\"j1_20\",\"name\":\"CX\",\"content\":[{\"slug\":\"option_value\",\"value\":\"CX\"}]},{\"id\":\"j1_16\",\"name\":\"Data/IA\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Data/IA\"}]},{\"id\":\"j1_17\",\"name\":\"BI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"BI\"}]},{\"id\":\"j1_19\",\"name\":\"OBIEE\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OBIEE\"}]},{\"id\":\"j1_18\",\"name\":\"OAC\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OAC\"}]},{\"id\":\"j1_22\",\"name\":\"Transport\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Transport\"}]},{\"id\":\"j1_24\",\"name\":\"Tech/Cloud\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Tech/Cloud\"}]},{\"id\":\"j1_23\",\"name\":\"OTM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OTM\"}]},{\"id\":\"j1_25\",\"name\":\"OCI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OCI\"}]},{\"id\":\"j1_26\",\"name\":\"Java\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Java\"}]},{\"id\":\"j1_27\",\"name\":\"SQL\",\"content\":[{\"slug\":\"option_value\",\"value\":\"SQL\"}]},{\"id\":\"j1_28\",\"name\":\"Gouvernance SI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Gouvernance SI\"}]}]', 'fr', NULL, 1, 1703883221);

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
(1, 'event', 23, 'update', 1700150780, 1),
(2, 'event', 23, 'update', 1700151412, 1),
(3, 'event', 23, 'update', 1700151419, 1),
(4, 'event', 23, 'update', 1700151441, 1),
(5, 'event', 23, 'update', 1700151472, 1),
(6, 'event', 23, 'update', 1700151876, 1),
(7, 'media', 4, 'delete', 1700151880, 1),
(8, 'event', 23, 'update', 1700151886, 1),
(9, 'event', 23, 'update', 1700151892, 1),
(10, 'event', 23, 'update', 1700152007, 1),
(11, 'event', 23, 'update', 1700152041, 1),
(12, 'user', 1, 'update', 1700152062, 1),
(13, 'user', 18, 'update', 1700152078, 1),
(14, 'user', 18, 'update', 1700152083, 1),
(15, 'cms', 1, 'update', 1700175524, 1),
(16, 'media', 5, 'new', 1700176423, 1),
(17, 'event', 23, 'update', 1700176950, 1),
(18, 'news', 25, 'new', 1700333960, 1),
(19, 'news', 26, 'new', 1700334120, 1),
(20, 'news', 24, 'update', 1700334526, 1),
(21, 'event', 23, 'update', 1700334539, 1),
(22, 'news', 24, 'update', 1700334574, 1),
(23, 'news', 24, 'update', 1700335459, 1),
(24, 'cms', 27, 'new', 1700520213, 1),
(25, 'cms', 27, 'delete', 1700524115, 1),
(26, 'option', 26, 'new', 1703883221, 1),
(27, 'option', 26, 'update', 1703883397, 1),
(28, 'news', 24, 'update', 1703883615, 1),
(29, 'news', 24, 'update', 1703883636, 1),
(30, 'event', 23, 'update', 1704792622, 1);

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
  `photo_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
(1, 'michael.convergence@gmail.com', 'vfZYLvc7nnPWkoyWlzUGaF0bgTMZYIkl', '$2y$13$9SAXbuKxddZeIdFozolJIebsevqLpmxeVpWEXR7f..uicaEp6F6iO', 'UoB28i32eum5zOaWgxhGGUM3mJql1STx_1606321467', 'michael.convergence@gmail.com', '[]', 'Mr', 'Michael', 'THOMAS', 0, 1, NULL, NULL, NULL, NULL, NULL, 5, 10, 1605009349, 1700152062, 'mJd519zaQzC8rJpXyD_N2r01txIIKdAy_1605009349'),
(18, 'nmorant@nux-digital.com', 'vRfHi61AkoXmmgnpo_hk2pudBF0IETZ1', '$2y$13$7FdJ/P4Pgkfe50lEtlzcfejuK8GtohvxObdPObP98V5/ZNYTA.BWy', NULL, 'nmorant@nux-digital.com', '[]', 'Mr', 'Nicoals', 'Morant', 0, 1, NULL, NULL, NULL, NULL, NULL, 5, 10, 1700046777, 1700152083, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-chatbot-author` (`author`);

--
-- Index pour la table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-cms-photo` (`photo_id`),
  ADD KEY `idx-cms-lang_parent` (`lang_parent_id`),
  ADD KEY `idx-cms-author` (`author`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-company-author` (`author`),
  ADD KEY `idx-company-photo_id` (`photo_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-forum-author` (`author`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-option-author` (`author`);

--
-- Index pour la table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-update-model_id` (`model_id`),
  ADD KEY `idx-update-author` (`author`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `idx-user-photo_id` (`photo_id`),
  ADD KEY `idx-user-company_id` (`company_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `model_relations`
--
ALTER TABLE `model_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT pour la table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `update`
--
ALTER TABLE `update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
