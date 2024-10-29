-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 29 oct. 2024 à 14:48
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
-- Base de données : `clubs_oracle`
--

-- --------------------------------------------------------

--
-- Structure de la table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `user_role` int(11) DEFAULT 0,
  `reccurence` varchar(255) DEFAULT NULL,
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
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `url_redirect` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `community` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `photo_id` varchar(255) DEFAULT NULL,
  `youtube_embed` varchar(255) DEFAULT NULL,
  `youtube_on` varchar(255) DEFAULT '0',
  `meta_title` varchar(255) NOT NULL,
  `meta_description` longtext DEFAULT NULL,
  `summary` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) DEFAULT NULL,
  `lang` varchar(255) NOT NULL,
  `lang_parent_id` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cms`
--

INSERT INTO `cms` (`id`, `type`, `title`, `url`, `url_redirect`, `template`, `community`, `tags`, `photo_id`, `youtube_embed`, `youtube_on`, `meta_title`, `meta_description`, `summary`, `content`, `status`, `start_date`, `end_date`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(1, 'cms', 'Accueil', 'accueil', '', 'index', '', 'null', '[]', '', '0', 'Accueil', '', '', '[{\"position\":1,\"block\":\"next-events\",\"value\":{\"link\":\"evenements\",\"button\":\"Les évènements du Club\"}}]', 1, 1697061600, 0, 'fr', NULL, 1, 1697106833),
(30, 'cms', 'Événements', 'evenements', '', '', '', 'null', '[]', NULL, '0', 'Evénements', '', '', '[{\"position\":1,\"block\":\"all-events\",\"value\":{}}]', 1, 1722117600, 0, 'fr', NULL, 1, 1722182021),
(31, 'cms', 'Actualités', 'actualites', '', '', '', 'null', '[]', NULL, '0', 'Actualités', '', '', '[{\"position\":1,\"block\":\"all-news\",\"value\":{}}]', 1, 1722117600, 0, 'fr', NULL, 1, 1722182047),
(32, 'cms', 'Contact', 'contact', '', 'contact', '', 'null', '[]', NULL, '0', 'Contact', '', '', '[]', 1, 1722117600, 0, 'fr', NULL, 1, 1722182063),
(37, 'cms', 'Mot de passe oublié', 'mot-de-passe-oublie', '', 'requestPasswordResetToken', '', 'null', '[]', NULL, '0', 'Mot de passe oublié', '', '', '[]', 1, 1722290400, 0, 'fr', NULL, 1, 1722349018),
(38, 'cms', 'Réinitialiser mon mot de passe', 'reinitialiser-mon-mot-de-passe', '', 'resetPassword', '', 'null', '[]', NULL, '0', 'Réinitialiser mon mot de passe', '', '', '[]', 1, 1722290400, 0, 'fr', NULL, 1, 1722349041),
(39, 'cms', 'Mon compte', 'mon-compte', '', 'myAccount', '', 'null', '[]', NULL, '0', 'Mon compte', '', '', '[]', 1, 1722349071, 0, 'fr', NULL, 1, 1722349071),
(40, 'cms', 'Connexion', 'connexion', '', 'login', '', 'null', '[]', NULL, '0', 'Connexion', '', '', '[]', 1, 1722349135, 0, 'fr', NULL, 1, 1722349135),
(41, 'cms', 'Inscription', 'inscription', '', 'register', '', 'null', '[]', NULL, '0', 'Inscription', '', '', '[]', 1, 1722364274, 0, 'fr', NULL, 1, 1722364274),
(42, 'cms', 'Forum', 'forum', '', 'forum', '', 'null', '[]', NULL, '0', 'Forum', 'Posez toutes vos questions et échangez avec vos pairs à propos de l\'utilisation de vos solutions d\'interactions CX !', 'Posez toutes vos questions et échangez avec vos pairs à propos de l\'utilisation de vos solutions d\'interactions CX !', '[{\"position\":1,\"block\":\"big-title\",\"value\":{\"photo\":\"[]\",\"title\":\"Forum\"}}]', 1, 1722376800, 0, 'fr', NULL, 20, 1722413329),
(44, 'cms', 'Mentions légales', 'mentions-legales', '', '', '', 'null', '[]', NULL, '0', 'Mentions légales', '', '', '[]', 1, 1722430525, 0, 'fr', NULL, 1, 1722430525),
(45, 'cms', 'Crédits', 'credits', '', '', '', 'null', '[]', NULL, '0', 'Crédits', '', '', '[]', 1, 1722430533, 0, 'fr', NULL, 1, 1722430533),
(46, 'cms', 'Annuaire des membres', 'annuaire-des-membres', '', 'members', '', 'null', '[]', NULL, '0', 'Annuaire des membres', '', '', '[{\"position\":1,\"block\":\"big-title\",\"value\":{\"photo\":\"[]\",\"title\":\"Annuaire des membres\"}}]', 1, 1723500000, 0, 'fr', NULL, 1, 1723501291),
(48, 'cms', 'Conditions générales d\'inscription', 'conditions-generales-d-inscription', '', '', '', '[\"cgi\"]', '[]', NULL, '0', 'Conditions générales d\'inscription', '', '', '[{\"position\":1,\"block\":\"big-title\",\"value\":{\"photo\":\"[]\",\"title\":\"Conditions générales d\'inscription\"}}]', 1, 1723500000, 0, 'fr', NULL, 1, 1723568319),
(49, 'cms', 'Les clubs', 'les-clubs', '', '', '', 'null', '[]', NULL, '0', 'Les clubs', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend pretium lectus, a aliquet felis imperdiet sed.', '[]', 1, 1730070000, 0, 'fr', NULL, 1, 1730122757),
(50, 'cms', 'Les communautés', 'les-communautes', '', '', '', 'null', '[]', NULL, '0', 'Les communautés', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend pretium lectus, a aliquet felis imperdiet sed.', '[]', 1, 1730070000, 0, 'fr', NULL, 1, 1730122795),
(52, 'cms', 'AUFO', 'aufo', '', '', '', 'null', '[]', NULL, '0', 'AUFO', '', '', '[]', 1, 1730070000, 0, 'fr', NULL, 1, 1730123590),
(53, 'cms', 'J.D. Edwards', 'j-d--edwards', '', '', '', 'null', '[]', NULL, '0', 'J.D. Edwards', '', '', '[]', 1, 1730123605, 0, 'fr', NULL, 1, 1730123605),
(54, 'cms', 'ERP Cloud', 'erp-cloud', '', '', 'ERP Cloud', 'null', '[]', NULL, '0', 'ERP Cloud', '', '', '[{\"position\":1,\"block\":\"simple-text\",\"value\":{\"content\":\"<div class=\\\"post-text clearfix\\\">\\n\\t\\t\\t\\t\\t\\t\\t<p>La communauté Finance Cloud, créée en novembre 2018, a pour \\nobjectif d’être un espace d’échanges d’expériences et de partages de \\nbonnes pratiques dédié aux utilisateurs des solutions Oracle.<br>\\nQue vous soyez utilisateur de solutions Finance Cloud ou que nous \\nenvisagiez une évolution de votre solution On-Premise vers le Cloud, \\ncette communauté est la vôtre.<br>\\nPlus de 15 rendez-vous ont été organisés depuis sa création sur un \\nrythme de réunions trimestrielles. Lors de ces rencontres, Oracle vous \\nprésente les nouveautés livrées dans la prochaine version afin que vous \\npuissiez exploiter tout le potentiel des innovations et détaille les \\nsolutions pour répondre à des sujets liés d’actualité à la demande des \\nutilisateurs (E-Invoicing, RSE, …). Une grande partie de la réunion est \\nensuite consacrée aux échanges informels et confidentiels entre \\nutilisateurs.</p>\\n<p>La communauté est pilotée par un de vos pairs et la Délégation \\nGénérale du Club Utilisateurs Oracle est le garant de l’organisation et \\ndu suivi de ces rencontres. En fonction des sujets traités, elle \\nsollicitera les intervenants Oracle les plus pertinents. Afin que la \\nparole soit totalement libre, certaines réunions pourront être \\norganisées uniquement entre utilisateurs.</p>\\n<p>Cette page centralise toutes les informations liées à la communauté.</p>\\n<p>Les événements à venir sont accessibles en bas de page pour consulter le programme et vous inscrire.<br>\\nVous pourrez également accéder* aux présentations, questions/réponses, \\nliens replay des précédentes réunions en cliquant en bas de page : \\nEvénements/Evénements passés<br>\\n*Accès réservé aux adhérents</p>\\n\\t\\t\\t\\t\\t\\t</div><p></p>\",\"width\":\"\"}}]', 1, 1730070000, 0, 'fr', NULL, 1, 1730125752),
(55, 'cms', 'La délégation', 'la-delegation', '', '', '', '[\"\"]', '[]', NULL, '0', 'La délégation', '', '', '[]', 1, 1730126220, 0, 'fr', NULL, 1, 1730126220),
(56, 'cms', 'Les trophées', 'les-trophees', '', '', '', 'null', '[]', NULL, '0', 'Les trophées', '', '', '[]', 1, 1730070000, 0, 'fr', NULL, 1, 1730126946),
(57, 'cms', 'Eloqua', 'eloqua', '', '', 'Eloqua', 'null', '[]', NULL, '0', 'Eloqua', '', '', '[{\"position\":1,\"block\":\"simple-text\",\"value\":{\"content\":\"<div class=\\\"post-text clearfix\\\">\\n\\t\\t\\t\\t\\t\\t\\t<p>Cette Communauté créée en 2021 sous l’impulsion de <strong>Yamna\\n AMRAOUI, CX Program Manager d’ALD AUTOMOTIVE qui avait remporté en 2020\\n le Trophée Expérience Utilisateurs pour la mise en œuvre d’Oracle \\nEloqua dans 30 pays.</strong></p>\\n<p>Depuis mi 2022, la communauté est pilotée par Aurélie PROU, Consultante Eloqua, SMARTSKILLS</p>\\n<p>Cette page centralise toutes les informations liées à la communauté.</p>\\n<p>Les événements à venir sont accessibles en bas de page pour consulter le programme et vous inscrire.<br>\\nVous pourrez également accéder* aux présentations, questions/réponses, \\nliens replay des précédentes réunions en cliquant en bas de page : \\nEvénements/Evénements passés<br>\\n*Accès réservé aux adhérents</p>\\n\\t\\t\\t\\t\\t\\t</div><p></p>\",\"width\":\"\"}}]', 1, 1730070000, 0, 'fr', NULL, 1, 1730127224),
(58, 'cms', 'HCM', 'hcm', '', '', 'HCM', 'null', '[]', NULL, '0', 'HCM', '', '', '[{\"position\":1,\"block\":\"simple-text\",\"value\":{\"content\":\"<div class=\\\"post-text clearfix\\\">\\n\\t\\t\\t\\t\\t\\t\\t<p>Offrir une expérience utilisateurs dynamique, apporter de \\nl’innovation aux processus RH, encourager la collaboration via des \\nfonctions intégrées, autant de propositions novatrices promises par les \\nsolutions HCM (Human Capital Management).</p>\\n<p>Dans ce contexte, la communauté HCM au sein des clubs francophones \\nOracle a pour objectif de proposer aux utilisateurs un lieu d’échanges \\nd’expériences et de collaborations. Les utilisateurs pourront aborder \\nensemble les différentes problématiques rencontrées dans le cadre de la \\nmise en place des projets de transformation RH à l’aide la plateforme \\nOracle Cloud HCM.</p>\\n<p>Selon les attentes des utilisateurs, différents sujets peuvent être abordés sur plusieurs thèmes :</p>\\n<ul><li>Enjeux de transformation : comment le SIRH peut soutenir l’ambition \\nRH d’une organisation, l’adoption par les différents métiers dans une \\ndémarche de transformation digitale, …</li><li>Réglementaire : RGPD, réglementations locales en matière de données dans le cadre d’une approche SaaS, souveraineté, …</li><li>Métier RH : hauts potentiels, entretiens annuels, formations, recrutement, ….</li><li>Trajectoire SIRH : déploiement des modules (méthodologie, perspective, …), design workshop, …</li></ul>\\n<p>&nbsp;</p>\\n<p>Les équipes Oracle et/ou des partenaires pourront participer à ces \\néchanges selon la volonté des utilisateurs, pour apporter \\nretours&nbsp;d’expériences&nbsp;et expertises.</p>\\n<p>Cette page centralise toutes les informations liées à la communauté.</p>\\n<p>Les événements à venir sont accessibles en bas de page pour consulter le programme et vous inscrire.<br>\\nVous pourrez également accéder* aux présentations, questions/réponses, \\nliens replay des précédentes réunions en cliquant en bas de page : \\nEvénements/Evénements passés<br>\\n*Accès réservé aux adhérents</p>\\n\\t\\t\\t\\t\\t\\t</div><p></p>\",\"width\":\"\"}}]', 1, 1730070000, 0, 'fr', NULL, 1, 1730130282),
(59, 'cms', 'OCI', 'oci', '', '', 'OCI', 'null', '[]', NULL, '0', 'OCI', '', '', '[{\"position\":1,\"block\":\"simple-text\",\"value\":{\"content\":\"<p><strong>Créée mi 2022 à l’initiative de Jacques Orsini, DSI des \\nfonctions support à la SNCF, la Communauté OCI (Oracle Cloud \\nInfrastructure) est un espace libre et indépendant pour échanger entre \\nutilisateurs. </strong></p>\\n<p>Dorénavant pilotée par Eric Grasset, DSI des fonctions Support à la SNCF, elle permettra à ses membres de :</p>\\n<ul><li>Partager les cas d’usages et les bonnes pratiques</li><li>Bénéficier d’un accès privilégié aux experts Oracle et de l’écosystème</li></ul>\\n<p><strong>Plusieurs sujets pourront être abordés au sein de cette Communauté tels que&nbsp; :&nbsp;</strong></p>\\n<ul><li>La migration des applications critiques d’entreprise</li><li>Comment développer des applications cloud natives dans OCI&nbsp;?</li><li>Quel intérêt aux services autonomes&nbsp;?</li><li>Cloud Public ? Cloud Privé ? Quelle est la bonne stratégie ?</li><li>Est-ce que le cloud public impose des compromis en matière de sécurité ?</li><li>Move to cloud … à quel prix&nbsp;?</li></ul>\\n<p><em>Les événements à venir sont accessibles en bas de page pour consulter le programme et vous inscrire.</em><br>\\n<em>Vous pourrez également accéder* aux présentations, \\nquestions/réponses, liens replay des précédentes réunions en cliquant en\\n bas de page : Evénements/Evénements passés</em><br>\\n<em>*Accès réservé aux adhérents</em></p><p></p>\",\"width\":\"\"}}]', 1, 1730130336, 0, 'fr', NULL, 1, 1730130336);

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo_id` varchar(255) DEFAULT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `activity_area` varchar(255) NOT NULL,
  `public` int(11) DEFAULT 0,
  `size` varchar(255) NOT NULL,
  `licenses_count` int(11) NOT NULL,
  `membership_end` int(11) NOT NULL,
  `is_sponsor` int(11) DEFAULT 0,
  `main_contact_name` varchar(255) NOT NULL,
  `main_contact_email` varchar(255) NOT NULL,
  `main_contact_phone` varchar(255) NOT NULL,
  `billing_contact_name` varchar(255) DEFAULT NULL,
  `billing_contact_email` varchar(255) DEFAULT NULL,
  `billing_contact_phone` varchar(255) DEFAULT NULL,
  `billing_platform` varchar(255) DEFAULT NULL,
  `informations` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `name`, `photo_id`, `address_line1`, `address_line2`, `postal_code`, `city`, `country`, `activity_area`, `public`, `size`, `licenses_count`, `membership_end`, `is_sponsor`, `main_contact_name`, `main_contact_email`, `main_contact_phone`, `billing_contact_name`, `billing_contact_email`, `billing_contact_phone`, `billing_platform`, `informations`, `status`, `author`, `created_at`) VALUES
(1, 'Nux Digital', '[6]', '170 rue Pierre Gilles de Gennes', '', '83210', 'La Farlède', 'FR', 'Services Informatique', 0, '- de 1000 salariés', 2, 1715983200, 1, 'Michael Thomas', 'michael.convergence@gmail.com', '0652140011', 'Nicolas Morant', 'mthomas@nux-digital.com', '0652140011', 'https://secure.tiime-ae.fr/', NULL, 1, 1, 1704897658),
(2, 'OCONNECTION', '[13]', '41 Rue de Villiers', '', '92200', 'Neuilly-sur-Seine', 'FR', 'Communication - Marketing - Pub', 0, '- de 1000 salariés', 1, 1753912800, 0, 'Delphine GINGREAU', 'dgingreau@oconnection.com', '0643495661', '', '', '', '', NULL, 1, 1, 1720430254);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `cms_id` int(11) NOT NULL,
  `start_datetime` int(11) DEFAULT NULL,
  `end_datetime` int(11) DEFAULT NULL,
  `event_type` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `address_detail` varchar(255) DEFAULT NULL,
  `presentation` longtext DEFAULT NULL,
  `program` longtext DEFAULT NULL,
  `synthesis` longtext DEFAULT NULL,
  `presential` int(11) NOT NULL DEFAULT 0,
  `distance` int(11) NOT NULL DEFAULT 1,
  `registerable` int(11) NOT NULL DEFAULT 1,
  `prospect` int(11) NOT NULL DEFAULT 0,
  `documents` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `cms_id`, `start_datetime`, `end_datetime`, `event_type`, `address`, `street_number`, `route`, `postal_code`, `locality`, `address_detail`, `presentation`, `program`, `synthesis`, `presential`, `distance`, `registerable`, `prospect`, `documents`) VALUES
(1, 23, 1700134620, 1700153580, 'Groupe de travail', '170 rue Pierre Gilles de Gennes', NULL, NULL, NULL, NULL, '<p>Accès </p>', '', '<p>Programme<br></p>', '', 0, 0, 1, 1, '[5]');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id`, `title`, `content`, `parent_id`, `status`, `author`, `created_at`) VALUES
(1, 'Informations générales', '<p>Description </p>', 0, 1, 1, 1704986101);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `legend` longtext DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `lang` varchar(255) NOT NULL DEFAULT 'fr',
  `lang_parent_id` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `title`, `alt`, `legend`, `path`, `tags`, `link`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(6, 'logo-nux-digital', NULL, NULL, '1704897551_logo-nux-digital.png', NULL, NULL, 'fr', NULL, 1, 1704897551),
(7, 'Avatar_poe84it', NULL, NULL, '1705058799_avatar_poe84it.png', NULL, NULL, 'fr', NULL, 1, 1705058799);

-- --------------------------------------------------------

--
-- Structure de la table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
('m231113_115635_create_forum_table', 1704973991),
('m231113_115643_create_chatbot_table', 1699877440),
('m231113_122341_update_user_table', 1699878683),
('m240513_080631_update_event_table', 1718190323),
('m240728_124130_update_event_table', 1722524201),
('m240802_172450_create_participant_table', 1724055304),
('m240811_141027_update_user_table', 1724055304),
('m240817_123120_update_company_table', 1724055304),
('m241028_152419_update_cms_table', 1730129140);

-- --------------------------------------------------------

--
-- Structure de la table `model_relations`
--

CREATE TABLE `model_relations` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `type_id` varchar(255) NOT NULL
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
(185, 'forum', 1, 'option', 'interests', 'Achat / Supply Distribution '),
(186, 'forum', 1, 'option', 'products', 'Base de Données, Middleware, Operating Systemes'),
(187, 'forum', 1, 'community', NULL, 'ERP Cloud'),
(188, 'forum', 1, 'community', NULL, 'EPM'),
(219, 'event', 23, 'option', 'interests', 'Achat / Supply Distribution '),
(220, 'event', 23, 'option', 'interests', 'Techno : Développement et Optimisation Technique'),
(221, 'event', 23, 'option', 'products', 'Base de Données, Middleware, Operating Systemes'),
(222, 'event', 23, 'option', 'products', 'Business Intelligence – OBIEE – Endeca'),
(223, 'event', 23, 'community', NULL, 'EPM'),
(224, 'event', 23, 'speakers', NULL, '1'),
(229, 'user', 1, 'option', 'interests', 'Achat / Supply Distribution '),
(230, 'user', 1, 'option', 'products', 'Base de Données, Middleware, Operating Systemes'),
(231, 'user', 1, 'community', NULL, 'ERP Cloud'),
(232, 'user', 1, 'community', NULL, 'EPM'),
(233, 'cms', 54, 'community', NULL, 'ERP Cloud'),
(234, 'cms', 54, 'community', NULL, 'ERP Cloud');

-- --------------------------------------------------------

--
-- Structure de la table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `options_contents` longtext DEFAULT NULL,
  `lang` varchar(255) NOT NULL,
  `lang_parent_id` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `option`
--

INSERT INTO `option` (`id`, `title`, `name`, `description`, `options`, `options_contents`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(0, 'Configuration des menus front-office', '_menus_', 'SPECIAL', '[{\"id\":\"j1_1\",\"text\":\"Menus\",\"state\":{\"opened\":true},\"data\":{},\"children\":[{\"id\":\"j1_5\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_21\",\"text\":\"Les clubs\",\"state\":{\"opened\":true},\"data\":{\"id\":\"49\"},\"children\":[{\"id\":\"j1_25\",\"text\":\"AUFO\",\"state\":{\"opened\":true},\"data\":{\"id\":\"52\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_24\",\"text\":\"J.D. Edwards\",\"state\":{\"opened\":true},\"data\":{\"id\":\"53\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_28\",\"text\":\"La délégation\",\"state\":{\"opened\":true},\"data\":{\"id\":\"55\"},\"children\":[],\"type\":\"file\"}],\"type\":\"file\"},{\"id\":\"j1_22\",\"text\":\"Les communautés\",\"state\":{\"opened\":true},\"data\":{\"id\":\"50\"},\"children\":[{\"id\":\"j1_35\",\"text\":\"Gestion intégrée\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_37\",\"text\":\"ERP Cloud\",\"state\":{\"opened\":true},\"data\":{\"id\":\"54\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_40\",\"text\":\"Logistique\",\"state\":{\"opened\":true},\"data\":[],\"children\":[],\"type\":\"default\"},{\"id\":\"j1_38\",\"text\":\"CRM\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_39\",\"text\":\"Eloqua\",\"state\":{\"opened\":true},\"data\":{\"id\":\"57\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_41\",\"text\":\"Data / IA\",\"state\":{\"opened\":true},\"data\":[],\"children\":[],\"type\":\"default\"},{\"id\":\"j1_42\",\"text\":\"Gestion RH\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_49\",\"text\":\"HCM\",\"state\":{\"opened\":true},\"data\":{\"id\":\"58\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_43\",\"text\":\"Tech / Cloud\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_48\",\"text\":\"OCI\",\"state\":{\"opened\":true},\"data\":{\"id\":\"59\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"}],\"type\":\"file\"},{\"id\":\"j1_8\",\"text\":\"Evénements\",\"state\":{\"opened\":true},\"data\":{\"id\":\"30\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_9\",\"text\":\"Actualités\",\"state\":{\"opened\":true},\"data\":{\"id\":\"31\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_47\",\"text\":\"Menu bas de page\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_13\",\"text\":\"Mentions légales\",\"state\":{\"opened\":true},\"data\":{\"id\":\"44\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_11\",\"text\":\"Crédits\",\"state\":{\"opened\":true},\"data\":{\"id\":\"45\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_15\",\"text\":\"Menu membres\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_16\",\"text\":\"Mon compte\",\"state\":{\"opened\":true},\"data\":{\"id\":\"39\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_17\",\"text\":\"Annuaire des membres\",\"state\":{\"opened\":true},\"data\":{\"id\":\"46\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_19\",\"text\":\"Forum\",\"state\":{\"opened\":true},\"data\":{\"id\":\"42\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_18\",\"text\":\"Forum\",\"state\":{\"opened\":true},\"data\":{\"id\":\"47\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_26\",\"text\":\"Menu footer 1\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_36\",\"text\":\"Les clubs\",\"state\":{\"opened\":true},\"data\":{\"id\":\"49\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_30\",\"text\":\"J.D. Edwards\",\"state\":{\"opened\":true},\"data\":{\"id\":\"53\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_31\",\"text\":\"AUFO\",\"state\":{\"opened\":true},\"data\":{\"id\":\"52\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"},{\"id\":\"j1_27\",\"text\":\"Menu footer 2\",\"state\":{\"opened\":true},\"data\":[],\"children\":[{\"id\":\"j1_29\",\"text\":\"La délégation\",\"state\":{\"opened\":true},\"data\":{\"id\":\"55\"},\"children\":[],\"type\":\"file\"},{\"id\":\"j1_32\",\"text\":\"Les communautés\",\"state\":{\"opened\":true},\"data\":{\"id\":\"50\"},\"children\":[],\"type\":\"file\"}],\"type\":\"default\"}],\"type\":\"default\"}]', '[]', 'fr', NULL, 1, 1698320186),
(1, 'Mega menu', 'megamenu', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"clubs\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"communities\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"clubs\",\"content\":[{\"slug\":\"option_value\",\"value\":\"49\"}]},{\"id\":\"j1_3\",\"name\":\"communities\",\"content\":[{\"slug\":\"option_value\",\"value\":\"50\"}]}]', 'fr', NULL, 1, 1730122707),
(2, 'Modèles de page', 'cms-template', 'CMS', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Accueil\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Contactez-nous\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Connexion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Inscription\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Mot de passe oublié\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Réinitialiser mon mot de passe\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Mon compte\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Annuaire\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Forum\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Accueil\",\"content\":[{\"slug\":\"option_value\",\"value\":\"index\"}]},{\"id\":\"j1_5\",\"name\":\"Contactez-nous\",\"content\":[{\"slug\":\"option_value\",\"value\":\"contact\"}]},{\"id\":\"j1_4\",\"name\":\"Connexion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"login\"}]},{\"id\":\"j1_6\",\"name\":\"Mot de passe oublié\",\"content\":[{\"slug\":\"option_value\",\"value\":\"requestPasswordResetToken\"}]},{\"id\":\"j1_7\",\"name\":\"Réinitialiser mon mot de passe\",\"content\":[{\"slug\":\"option_value\",\"value\":\"resetPassword\"}]},{\"id\":\"j1_8\",\"name\":\"Mon compte\",\"content\":[{\"slug\":\"option_value\",\"value\":\"myAccount\"}]},{\"id\":\"j1_9\",\"name\":\"Inscription\",\"content\":[{\"slug\":\"option_value\",\"value\":\"register\"}]},{\"id\":\"j1_11\",\"name\":\"Annuaire\",\"content\":[{\"slug\":\"option_value\",\"value\":\"members\"}]},{\"id\":\"j1_12\",\"name\":\"Forum\",\"content\":[{\"slug\":\"option_value\",\"value\":\"forum\"}]}]', 'fr', NULL, 1, 1698320200),
(3, 'Étiquettes CMS', 'cms-tags', 'CMS', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_14\",\"text\":\"Formulaire de contact\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Conditions générales d\'inscription\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_14\",\"name\":\"Formulaire de contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"contact-form\"}]},{\"id\":\"j1_3\",\"name\":\"Conditions générales d\'inscription\",\"content\":[{\"slug\":\"option_value\",\"value\":\"cgi\"}]}]', 'fr', NULL, 1, 1698320236),
(4, 'Catégories CMS', 'cms-categories', 'CMS', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Défaut\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Défaut\",\"content\":[{\"slug\":\"option_value\",\"value\":\"default\"}]}]', 'fr', NULL, 1, 1698320266),
(5, 'Menus', 'menus', 'Liste des menus de navigation front', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Menu membres\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Menu footer 1\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Menu footer 2\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Menu bas de page\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Menu principal\",\"content\":[{\"slug\":\"option_value\",\"value\":\"main-menu\"}]},{\"id\":\"j1_13\",\"name\":\"Menu bas de page\",\"content\":[{\"slug\":\"option_value\",\"value\":\"footer-menu\"}]},{\"id\":\"j1_4\",\"name\":\"Menu membres\",\"content\":[{\"slug\":\"option_value\",\"value\":\"members-menu\"}]}]', 'fr', NULL, 1, 1698320306),
(6, 'Communautés', 'communities', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_4\",\"text\":\"Gestion intégrée\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"ERP Cloud\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"    EPM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"JDE\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"PeopleSoft\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"EBS\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"HFM/Hyperion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_36\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_9\",\"text\":\"Ressources humaines\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_10\",\"text\":\"HCM\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_12\",\"text\":\"CRM\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_13\",\"text\":\"Eloqua\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Siebel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"Services/Marketing\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_20\",\"text\":\"CX\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_16\",\"text\":\"Data\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_17\",\"text\":\"BI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_18\",\"text\":\"OAC\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_19\",\"text\":\"OBIEE\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_22\",\"text\":\"Logistique\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_21\",\"text\":\"SCM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_23\",\"text\":\"OTM\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_24\",\"text\":\"Tech\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_25\",\"text\":\"OCI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_26\",\"text\":\"Java\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_27\",\"text\":\"SQL\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_32\",\"text\":\"IA\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_33\",\"text\":\"SAAS\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_28\",\"text\":\"Gouvernance SI\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_30\",\"text\":\"Gestion de projet\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_31\",\"text\":\"TMA\",\"state\":{\"opened\":true},\"children\":[]}]}]}]', '[{\"id\":\"j1_4\",\"name\":\"Gestion intégrée\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Gestion intégrée\"}]},{\"id\":\"j1_2\",\"name\":\"ERP Cloud\",\"content\":[{\"slug\":\"option_value\",\"value\":\"ERP Cloud\"}]},{\"id\":\"j1_3\",\"name\":\" EPM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"EPM\"}]},{\"id\":\"j1_5\",\"name\":\"JDE\",\"content\":[{\"slug\":\"option_value\",\"value\":\"JD Edwards\"}]},{\"id\":\"j1_6\",\"name\":\"PeopleSoft\",\"content\":[{\"slug\":\"option_value\",\"value\":\"PeopleSoft\"}]},{\"id\":\"j1_7\",\"name\":\"EBS\",\"content\":[{\"slug\":\"option_value\",\"value\":\"EBS\"}]},{\"id\":\"j1_8\",\"name\":\"HFM/Hyperion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"HFM/Hyperion\"}]},{\"id\":\"j1_9\",\"name\":\"Ressources humaines\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Ressources humaines\"}]},{\"id\":\"j1_10\",\"name\":\"HCM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"HCM\"}]},{\"id\":\"j1_21\",\"name\":\"SCM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"SCM\"}]},{\"id\":\"j1_12\",\"name\":\"CRM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"CRM\"}]},{\"id\":\"j1_14\",\"name\":\"Siebel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Siebel\"}]},{\"id\":\"j1_13\",\"name\":\"Eloqua\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Eloqua\"}]},{\"id\":\"j1_15\",\"name\":\"Services/Marketing\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Services/Marketing\"}]},{\"id\":\"j1_20\",\"name\":\"CX\",\"content\":[{\"slug\":\"option_value\",\"value\":\"CX\"}]},{\"id\":\"j1_16\",\"name\":\"Data\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Data\"}]},{\"id\":\"j1_17\",\"name\":\"BI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"BI\"}]},{\"id\":\"j1_19\",\"name\":\"OBIEE\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OBIEE\"}]},{\"id\":\"j1_18\",\"name\":\"OAC\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OAC\"}]},{\"id\":\"j1_22\",\"name\":\"Logistique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Logistique\"}]},{\"id\":\"j1_24\",\"name\":\"Tech\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Tech\"}]},{\"id\":\"j1_23\",\"name\":\"OTM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OTM\"}]},{\"id\":\"j1_25\",\"name\":\"OCI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"OCI\"}]},{\"id\":\"j1_26\",\"name\":\"Java\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Java\"}]},{\"id\":\"j1_27\",\"name\":\"SQL\",\"content\":[{\"slug\":\"option_value\",\"value\":\"SQL\"}]},{\"id\":\"j1_28\",\"name\":\"Gouvernance SI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Gouvernance SI\"}]},{\"id\":\"j1_30\",\"name\":\"Gestion de projet\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Gestion de projet\"}]},{\"id\":\"j1_31\",\"name\":\"TMA\",\"content\":[{\"slug\":\"option_value\",\"value\":\"TMA\"}]},{\"id\":\"j1_32\",\"name\":\"IA\",\"content\":[{\"slug\":\"option_value\",\"value\":\"IA\"}]},{\"id\":\"j1_33\",\"name\":\"SAAS\",\"content\":[{\"slug\":\"option_value\",\"value\":\"SAAS\"}]},{\"id\":\"j1_36\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"NetSuite\"}]}]', 'fr', NULL, 1, 1703883221),
(7, 'Catégories événement', 'event-categories', 'Événement', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Webinar\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Webinar\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Webinar\"}]}]', 'fr', NULL, 1, 1698320336),
(8, 'Type d\'événements', 'event-types', 'Événement', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Atelier\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Commission\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Groupe de travail\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Webinar\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Atelier\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Atelier\"}]},{\"id\":\"j1_3\",\"name\":\"Commission\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Commission\"}]},{\"id\":\"j1_4\",\"name\":\"Groupe de travail\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Groupe de travail\"}]},{\"id\":\"j1_6\",\"name\":\"Webinar\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Webinar\"}]}]', 'fr', NULL, 1, 1698320365),
(9, 'Produits utilisés', 'products', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"AUFO\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_3\",\"text\":\"Base de Données, Middleware, Operating Systemes\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Business Intelligence – OBIEE – Endeca\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Customer Experience (CXM) – Siebel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Engineered systems\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Financials, Procurement, Governance &amp; Risk – eBusiness Suite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Financials, Procurement, Governance &amp; Risk – Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Human Capital Management (HCM) – Fusion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Human Capital Management (HCM) – Taleo\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Hyperion &amp; EPM\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Outils de développement – Autres\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_17\",\"text\":\"Outils de développement – JAVA\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_18\",\"text\":\"Project Management &amp; Primavera\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_19\",\"text\":\"Supply Chain and Manufacturing – eBusiness Suite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_20\",\"text\":\"Supply Chain and Manufacturing – Fusion\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_21\",\"text\":\"JD Edwards\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_22\",\"text\":\"J.D.Edwards Enterprise One 7.33\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_23\",\"text\":\"J.D.Edwards Enterprise One 8.12\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_24\",\"text\":\"J.D.Edwards Enterprise One 9.0\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_25\",\"text\":\"J.D.Edwards Enterprise One 9.1\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_26\",\"text\":\"J.D.Edwards Enterprise One 9.2\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_27\",\"text\":\"J.D.Edwards World\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_28\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]}]},{\"id\":\"j1_29\",\"text\":\"PeopleSoft\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_30\",\"text\":\"NetSuite\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_31\",\"text\":\"Peoplesoft CRM (Customer Relationship Management)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_32\",\"text\":\"Peoplesoft FSCM (Financials)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_33\",\"text\":\"Peoplesoft HCM (Human Capital Management)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_34\",\"text\":\"Peoplesoft PeopleTools\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_35\",\"text\":\"Peoplesoft Portal\",\"state\":{\"opened\":true},\"children\":[]}]}]}]', '[{\"id\":\"j1_3\",\"name\":\"Base de Données, Middleware, Operating Systemes\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Base de Données, Middleware, Operating Systemes\"}]},{\"id\":\"j1_4\",\"name\":\"Business Intelligence – OBIEE – Endeca\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Business Intelligence – OBIEE – Endeca\"}]},{\"id\":\"j1_5\",\"name\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Marketing et Social Cloud (Eloqua, Responsys, Oracle social cloud)\"}]},{\"id\":\"j1_6\",\"name\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Sales Cloud, Oracle CRM On Demand (OCOD)\"}]},{\"id\":\"j1_7\",\"name\":\"Customer Experience (CXM) – Siebel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Siebel\"}]},{\"id\":\"j1_8\",\"name\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Customer Experience (CXM) – Service Cloud (Rightnow, Endeca)\"}]},{\"id\":\"j1_9\",\"name\":\"Engineered systems\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Engineered systems\"}]},{\"id\":\"j1_10\",\"name\":\"Financials, Procurement, Governance & Risk – eBusiness Suite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Financials, Procurement, Governance & Risk – eBusiness Suite\"}]},{\"id\":\"j1_11\",\"name\":\"Financials, Procurement, Governance & Risk – Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Financials, Procurement, Governance & Risk – Fusion\"}]},{\"id\":\"j1_12\",\"name\":\"Human Capital Management (HCM) – Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Human Capital Management (HCM) – Fusion\"}]},{\"id\":\"j1_13\",\"name\":\"Human Capital Management (HCM) – Taleo\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Human Capital Management (HCM) – Taleo\"}]},{\"id\":\"j1_14\",\"name\":\"Hyperion & EPM\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Hyperion & EPM\"}]},{\"id\":\"j1_15\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"AUFO NetSuite\"}]},{\"id\":\"j1_16\",\"name\":\"Outils de développement – Autres\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Outils de développement – Autres\"}]},{\"id\":\"j1_17\",\"name\":\"utils de développement – JAVA\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Outils de développement – JAVA\"}]},{\"id\":\"j1_18\",\"name\":\"Project Management & Primavera\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Project Management & Primavera\"}]},{\"id\":\"j1_20\",\"name\":\"Supply Chain and Manufacturing – Fusion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Project Management and Primavera\"}]},{\"id\":\"j1_19\",\"name\":\"Supply Chain and Manufacturing – eBusiness Suite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Supply Chain and Manufacturing – eBusiness Suite\"}]},{\"id\":\"j1_22\",\"name\":\"J.D.Edwards Enterprise One 7.33\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 7.33\"}]},{\"id\":\"j1_23\",\"name\":\"J.D.Edwards Enterprise One 8.12\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 8.12\"}]},{\"id\":\"j1_25\",\"name\":\"J.D.Edwards Enterprise One 9.1\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 9.1\"}]},{\"id\":\"j1_24\",\"name\":\"J.D.Edwards Enterprise One 9.0\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 9.0\"}]},{\"id\":\"j1_26\",\"name\":\"J.D.Edwards Enterprise One 9.2\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards Enterprise One 9.2\"}]},{\"id\":\"j1_27\",\"name\":\"J.D.Edwards World\",\"content\":[{\"slug\":\"option_value\",\"value\":\"J.D.Edwards World\"}]},{\"id\":\"j1_28\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"JD Edwards NetSuite\"}]},{\"id\":\"j1_30\",\"name\":\"NetSuite\",\"content\":[{\"slug\":\"option_value\",\"value\":\"PeopleSoft NetSuite\"}]},{\"id\":\"j1_31\",\"name\":\"Peoplesoft CRM (Customer Relationship Management)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft CRM (Customer Relationship Management)\"}]},{\"id\":\"j1_32\",\"name\":\"Peoplesoft FSCM (Financials)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft FSCM (Financials)\"}]},{\"id\":\"j1_33\",\"name\":\"Peoplesoft HCM (Human Capital Management)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft HCM (Human Capital Management)\"}]},{\"id\":\"j1_34\",\"name\":\"Peoplesoft PeopleTools\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft PeopleTools\"}]},{\"id\":\"j1_35\",\"name\":\"Peoplesoft Portal\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Peoplesoft Portal\"}]}]', 'fr', NULL, 1, 1698320541),
(10, 'Centres d\'intérêts', 'interests', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Achat / Supply Distribution\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Cloud : Saas, Iaas &amp; Paas\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Finance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Gestion de la relation client\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Matériel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Mobilité et Géolocalisation\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Pilotage de Projet et Gouvernance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Production\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Ressources Humaines\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Techno : Administration des applications\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Techno : Middleware / Base de Données\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Techno : Développement et Optimisation Technique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"Utilisation des Applications / Paramétrages / Cas d’usage\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Vente / Commercial / Marketing\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Achat / Supply Distribution\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Achat / Supply Distribution \"}]},{\"id\":\"j1_3\",\"name\":\"Cloud : Saas, Iaas & Paas\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Cloud : Saas, Iaas & Paas \"}]},{\"id\":\"j1_4\",\"name\":\"Finance\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Finance\"}]},{\"id\":\"j1_5\",\"name\":\"Gestion de la relation client\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Gestion de la relation client \"}]},{\"id\":\"j1_6\",\"name\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Informatique décisionnel / Pilotage / Planification / Tableaux de bord\"}]},{\"id\":\"j1_7\",\"name\":\"Matériel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Matériel\"}]},{\"id\":\"j1_8\",\"name\":\"Mobilité et Géolocalisation\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Mobilité et Géolocalisation \"}]},{\"id\":\"j1_9\",\"name\":\"Pilotage de Projet et Gouvernance\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Pilotage de Projet et Gouvernance\"}]},{\"id\":\"j1_10\",\"name\":\"Production\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Production\"}]},{\"id\":\"j1_12\",\"name\":\"Techno : Administration des applications\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Techno : Administration des applications\"}]},{\"id\":\"j1_11\",\"name\":\"Ressources Humaines\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Ressources Humaines\"}]},{\"id\":\"j1_13\",\"name\":\"Techno : Middleware / Base de Données\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Techno : Middleware / Base de Données\"}]},{\"id\":\"j1_14\",\"name\":\"Techno : Développement et Optimisation Technique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Techno : Développement et Optimisation Technique\"}]},{\"id\":\"j1_15\",\"name\":\"Utilisation des Applications / Paramétrages / Cas d’usage\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Utilisation des Applications / Paramétrages / Cas d’usage\"}]},{\"id\":\"j1_16\",\"name\":\"Vente / Commercial / Marketing\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Vente / Commercial / Marketing\"}]}]', 'fr', NULL, 1, 1698320576),
(11, 'Secteur d\'activités', 'activity-areas', 'Société', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Agriculture\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Armée, sécurité\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Art, Design\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Audiovisuel - Spectacle\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Audit, gestion\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Automobile\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Banque, assurance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Bois (filière)\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"BTP, architecture\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Chimie, pharmacie\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Commerce, distribution\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Communication - Marketing - Pub\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_14\",\"text\":\"Conseil Informatique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_15\",\"text\":\"Construction aéronautique, ferroviaire et navale\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_16\",\"text\":\"Culture - Artisanat d\'art\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_17\",\"text\":\"Droit, justice\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_18\",\"text\":\"Éditeur de logiciel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_19\",\"text\":\"Edition, Journalisme\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_20\",\"text\":\"Électronique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_21\",\"text\":\"Énergie\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_22\",\"text\":\"Enseignement\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_23\",\"text\":\"Environnement\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_24\",\"text\":\"Fonction publique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_25\",\"text\":\"Hôtellerie, restauration\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_26\",\"text\":\"Industrie alimentaire\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_27\",\"text\":\"Informatique et télécoms\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_28\",\"text\":\"Logistique, transport\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_29\",\"text\":\"Maintenance, entretien\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_30\",\"text\":\"Mécanique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_31\",\"text\":\"Mode, industrie textile\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_32\",\"text\":\"Recherche\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_33\",\"text\":\"Santé\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_34\",\"text\":\"Services Informatique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_35\",\"text\":\"Service aux entreprises/particuliers\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_36\",\"text\":\"Social\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_37\",\"text\":\"Sport, loisirs – Tourisme\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_38\",\"text\":\"Traduction - interprétariat\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_39\",\"text\":\"Verre, béton, céramique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_40\",\"text\":\"Mutuelle\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_41\",\"text\":\"Banque et assurance\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Agriculture\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Agriculture\"}]},{\"id\":\"j1_3\",\"name\":\"Armée, sécurité\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Armée, sécurité\"}]},{\"id\":\"j1_4\",\"name\":\"Art, Design\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Art, Design\"}]},{\"id\":\"j1_5\",\"name\":\"Audiovisuel - Spectacle\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Audiovisuel - Spectacle\"}]},{\"id\":\"j1_6\",\"name\":\"Audit, gestion\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Audit, gestion\"}]},{\"id\":\"j1_7\",\"name\":\"Automobile\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Automobile\"}]},{\"id\":\"j1_9\",\"name\":\"Bois (filière)\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Bois (filière)\"}]},{\"id\":\"j1_11\",\"name\":\"Chimie, pharmacie\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Chimie, pharmacie\"}]},{\"id\":\"j1_10\",\"name\":\"BTP, architecture\",\"content\":[{\"slug\":\"option_value\",\"value\":\"BTP, architecture\"}]},{\"id\":\"j1_12\",\"name\":\"Commerce, distribution\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Commerce, distribution\"}]},{\"id\":\"j1_13\",\"name\":\"Communication - Marketing - Pub\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Communication - Marketing - Pub\"}]},{\"id\":\"j1_14\",\"name\":\"Conseil Informatique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Conseil Informatique\"}]},{\"id\":\"j1_15\",\"name\":\"Construction aéronautique, ferroviaire et navale\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Construction aéronautique, ferroviaire et navale\"}]},{\"id\":\"j1_16\",\"name\":\"Culture - Artisanat d\'art\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Culture - Artisanat d\'art\"}]},{\"id\":\"j1_17\",\"name\":\"Droit, justice\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Droit, justice\"}]},{\"id\":\"j1_18\",\"name\":\"Éditeur de logiciel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Éditeur de logiciel\"}]},{\"id\":\"j1_19\",\"name\":\"Edition, Journalisme\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Edition, Journalisme\"}]},{\"id\":\"j1_20\",\"name\":\"Électronique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Électronique\"}]},{\"id\":\"j1_21\",\"name\":\"Énergie\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Énergie\"}]},{\"id\":\"j1_22\",\"name\":\"Enseignement\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Enseignement\"}]},{\"id\":\"j1_23\",\"name\":\"Environnement\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Environnement\"}]},{\"id\":\"j1_24\",\"name\":\"Fonction publique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Fonction publique\"}]},{\"id\":\"j1_25\",\"name\":\"Hôtellerie, restauration\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Hôtellerie, restauration\"}]},{\"id\":\"j1_26\",\"name\":\"Industrie alimentaire\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Industrie alimentaire\"}]},{\"id\":\"j1_27\",\"name\":\"Informatique et télécoms\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Informatique et télécoms\"}]},{\"id\":\"j1_28\",\"name\":\"Logistique, transport\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Logistique, transport\"}]},{\"id\":\"j1_29\",\"name\":\"Maintenance, entretien\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Maintenance, entretien\"}]},{\"id\":\"j1_30\",\"name\":\"Mécanique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Mécanique\"}]},{\"id\":\"j1_31\",\"name\":\"Mode, industrie textile\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Mode, industrie textile\"}]},{\"id\":\"j1_32\",\"name\":\"Recherche\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Recherche\"}]},{\"id\":\"j1_33\",\"name\":\"Santé\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Santé\"}]},{\"id\":\"j1_34\",\"name\":\"Services Informatique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Services Informatique\"}]},{\"id\":\"j1_35\",\"name\":\"Service aux entreprises/particuliers\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Service aux entreprises/particuliers\"}]},{\"id\":\"j1_36\",\"name\":\"Social\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Social\"}]},{\"id\":\"j1_37\",\"name\":\"Sport, loisirs – Tourisme\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Sport, loisirs – Tourisme\"}]},{\"id\":\"j1_38\",\"name\":\"Traduction - interprétariat\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Traduction - interprétariat\"}]},{\"id\":\"j1_39\",\"name\":\"Verre, béton, céramique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Verre, béton, céramique\"}]}]', 'fr', NULL, 1, 1704886376),
(12, 'Périmètre décisionnel', 'user-decision-scope', 'Utilisateur', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Direction Générale\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Pilotage SI/ Architecture/ Roadmap/ Gouvernance SI\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Pilotage de Projet/ Déploiement/ Gestion Changement\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Administration Fonctionnelle / Evolution &amp; Maintenance / Support Fonctionnel / Usage\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Technique et Systèmes\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Autres\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Direction Générale\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Direction Générale\"}]},{\"id\":\"j1_3\",\"name\":\"Pilotage SI/ Architecture/ Roadmap/ Gouvernance SI\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Pilotage SI/ Architecture/ Roadmap/ Gouvernance SI\"}]},{\"id\":\"j1_5\",\"name\":\"Administration Fonctionnelle / Evolution & Maintenance / Support Fonctionnel / Usage\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Administration Fonctionnelle / Evolution & Maintenance / Support Fonctionnel / Usage\"}]},{\"id\":\"j1_4\",\"name\":\"Pilotage de Projet/ Déploiement/ Gestion Changement\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Pilotage de Projet/ Déploiement/ Gestion Changement\"}]},{\"id\":\"j1_6\",\"name\":\"Technique et Systèmes\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Technique et Systèmes\"}]},{\"id\":\"j1_7\",\"name\":\"Autres\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Autres\"}]}]', 'fr', NULL, 1, 1698699624),
(13, 'Département / Service', 'user-departments', 'Utilisateur', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Achat\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Finance\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Informatique - Direction\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Informatique - Fonctionnel\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_6\",\"text\":\"Informatique - Technique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_12\",\"text\":\"Juridique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_11\",\"text\":\"Logistique\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_7\",\"text\":\"Marketing / Communication\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_8\",\"text\":\"Production\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_9\",\"text\":\"Ressources Humaines\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_10\",\"text\":\"Vente / Distribution\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"Autres\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Achat\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Achat\"}]},{\"id\":\"j1_3\",\"name\":\"Finance\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Finance\"}]},{\"id\":\"j1_4\",\"name\":\"Informatique - Direction\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Informatique - Direction\"}]},{\"id\":\"j1_5\",\"name\":\"Informatique - Fonctionnel\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Informatique - Fonctionnel\"}]},{\"id\":\"j1_6\",\"name\":\"Informatique - Technique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Informatique - Technique\"}]},{\"id\":\"j1_12\",\"name\":\"Juridique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Juridique\"}]},{\"id\":\"j1_11\",\"name\":\"Logistique\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Logistique\"}]},{\"id\":\"j1_7\",\"name\":\"Marketing / Communication\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Marketing / Communication\"}]},{\"id\":\"j1_8\",\"name\":\"Production\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Production\"}]},{\"id\":\"j1_10\",\"name\":\"Vente / Distribution\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Vente / Distribution\"}]},{\"id\":\"j1_9\",\"name\":\"Ressources Humaines\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Ressources Humaines\"}]},{\"id\":\"j1_13\",\"name\":\"Autres\",\"content\":[{\"slug\":\"option_value\",\"value\":\"Autres\"}]}]', 'fr', NULL, 1, 1705062081),
(14, 'Catégories forum', 'forum-categories', 'Forum', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Emploi\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1698703522);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registered` int(11) DEFAULT 0,
  `came` int(11) DEFAULT 0,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `update`
--

CREATE TABLE `update` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
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
(30, 'event', 23, 'update', 1704792622, 1),
(31, 'option', 26, 'update', 1704880687, 1),
(32, 'option', 26, 'update', 1704882611, 1),
(33, 'option', 26, 'update', 1704882652, 1),
(34, 'option', 26, 'update', 1704882716, 1),
(35, 'option', 26, 'update', 1704883066, 1),
(36, 'option', 26, 'update', 1704883084, 1),
(37, 'user', 18, 'delete', 1704883312, 1),
(38, 'option', 27, 'new', 1704886376, 1),
(39, 'option', 27, 'update', 1704886479, 1),
(40, 'option', 27, 'update', 1704886707, 1),
(41, 'option', 27, 'update', 1704888646, 1),
(42, 'option', 27, 'update', 1704889325, 1),
(43, 'media', 6, 'new', 1704897551, 1),
(44, 'company', 1, 'new', 1704897658, 1),
(45, 'company', 1, 'update', 1704897673, 1),
(46, 'company', 1, 'update', 1704897786, 1),
(47, 'company', 1, 'update', 1704897796, 1),
(48, 'company', 1, 'update', 1704897855, 1),
(49, 'company', 1, 'update', 1704897862, 1),
(50, 'company', 1, 'update', 1704897932, 1),
(51, 'company', 1, 'update', 1704897975, 1),
(52, 'company', 1, 'update', 1704898461, 1),
(53, 'company', 1, 'update', 1704898899, 1),
(54, 'company', 1, 'update', 1704900145, 1),
(55, 'company', 1, 'update', 1704900151, 1),
(56, 'company', 1, 'update', 1704900169, 1),
(57, 'media', 7, 'new', 1705058799, 1),
(58, 'user', 1, 'update', 1705059154, 1),
(59, 'user', 1, 'update', 1705059345, 1),
(60, 'user', 1, 'update', 1705060979, 1),
(61, 'option', 10, 'update', 1705061727, 1),
(62, 'option', 10, 'update', 1705061749, 1),
(63, 'option', 28, 'new', 1705062081, 1),
(64, 'option', 12, 'update', 1705062125, 1),
(65, 'option', 13, 'update', 1705062175, 1),
(66, 'option', 14, 'update', 1705062191, 1),
(67, 'option', 10, 'update', 1705062204, 1),
(68, 'option', 10, 'update', 1705062215, 1),
(69, 'option', 9, 'update', 1705062224, 1),
(70, 'option', 8, 'update', 1705062234, 1),
(71, 'option', 8, 'update', 1705062241, 1),
(72, 'option', 7, 'update', 1705062246, 1),
(73, 'option', 4, 'update', 1705062262, 1),
(74, 'option', 3, 'update', 1705062268, 1),
(75, 'option', 2, 'update', 1705062273, 1),
(76, 'option', 13, 'update', 1705062351, 1),
(77, 'option', 13, 'update', 1705062443, 1),
(78, 'user', 1, 'update', 1705062563, 1),
(79, 'user', 1, 'update', 1705062974, 1),
(80, 'user', 1, 'update', 1705062991, 1),
(81, 'option', 8, 'update', 1720511521, 1),
(82, 'event', 23, 'update', 1724080766, 1),
(83, 'event', 23, 'update', 1724080785, 1),
(84, 'user', 1, 'update', 1724081430, 1),
(85, 'user', 1, 'update', 1724081613, 1),
(86, 'option', 29, 'new', 1730122707, 1),
(87, 'cms', 49, 'new', 1730122757, 1),
(88, 'cms', 49, 'update', 1730122763, 1),
(89, 'cms', 50, 'new', 1730122795, 1),
(90, 'menus', 0, 'update', 1730122821, 1),
(91, 'cms', 30, 'update', 1730122872, 1),
(92, 'menus', 0, 'update', 1730122885, 1),
(93, 'option', 1, 'update', 1730122902, 1),
(94, 'option', 1, 'update', 1730122919, 1),
(95, 'cms', 51, 'new', 1730123378, 1),
(96, 'cms', 51, 'update', 1730123387, 1),
(97, 'menus', 0, 'update', 1730123399, 1),
(98, 'cms', 52, 'new', 1730123590, 1),
(99, 'cms', 52, 'update', 1730123594, 1),
(100, 'cms', 53, 'new', 1730123605, 1),
(101, 'menus', 0, 'update', 1730123615, 1),
(102, 'cms', 49, 'update', 1730123891, 1),
(103, 'cms', 50, 'update', 1730123929, 1),
(104, 'cms', 54, 'new', 1730125752, 1),
(105, 'cms', 1, 'update', 1730125922, 1),
(106, 'option', 5, 'update', 1730126167, 1),
(107, 'cms', 54, 'update', 1730126196, 1),
(108, 'cms', 55, 'new', 1730126220, 1),
(109, 'menus', 0, 'update', 1730126318, 1),
(110, 'menus', 0, 'update', 1730126400, 1),
(111, 'cms', 30, 'update', 1730126726, 1),
(112, 'cms', 31, 'update', 1730126736, 1),
(113, 'cms', 31, 'update', 1730126743, 1),
(114, 'menus', 0, 'update', 1730126763, 1),
(115, 'menus', 0, 'update', 1730126887, 1),
(116, 'cms', 51, 'delete', 1730126891, 1),
(117, 'menus', 0, 'update', 1730126906, 1),
(118, 'cms', 56, 'new', 1730126947, 1),
(119, 'cms', 56, 'update', 1730126954, 1),
(120, 'cms', 56, 'update', 1730126959, 1),
(121, 'cms', 56, 'update', 1730126999, 1),
(122, 'cms', 56, 'update', 1730127034, 1),
(123, 'cms', 56, 'update', 1730127037, 1),
(124, 'menus', 0, 'update', 1730127186, 1),
(125, 'cms', 57, 'new', 1730127224, 1),
(126, 'menus', 0, 'update', 1730127251, 1),
(127, 'cms', 54, 'update', 1730128895, 1),
(128, 'cms', 54, 'update', 1730128949, 1),
(129, 'cms', 54, 'update', 1730129038, 1),
(130, 'cms', 54, 'update', 1730129197, 1),
(131, 'cms', 57, 'update', 1730129593, 1),
(132, 'menus', 0, 'update', 1730130214, 1),
(133, 'cms', 58, 'new', 1730130282, 1),
(134, 'cms', 59, 'new', 1730130336, 1),
(135, 'cms', 58, 'update', 1730130358, 1),
(136, 'menus', 0, 'update', 1730130382, 1),
(137, 'cms', 57, 'update', 1730132092, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `photo_id` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `is_speaker` int(11) DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `decision_scope` varchar(255) DEFAULT NULL,
  `presentation` longtext DEFAULT NULL,
  `role` int(11) DEFAULT 0,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `photo_id`, `gender`, `firstname`, `lastname`, `company_id`, `is_speaker`, `phone`, `mobile`, `department`, `function`, `decision_scope`, `presentation`, `role`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'michael.convergence@gmail.com', 'mJjev8CLQgZck8l20y2ZwPeCV4rz4xlY', '$2y$13$Mlt67N36IopAQZhmcJFYReVEktKxoAswMBsR12SiJ0FOwG3GKvcSu', 'UoB28i32eum5zOaWgxhGGUM3mJql1STx_1606321467', 'michael.convergence@gmail.com', '[7]', 'Mr', 'Michael', 'THOMAS', 1, 1, '0101010101', '0652140011', 'Achat', 'Manager', 'Direction Générale', '', 5, 10, 1605009349, 1724081613, 'mJd519zaQzC8rJpXyD_N2r01txIIKdAy_1605009349');

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
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `model_relations`
--
ALTER TABLE `model_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT pour la table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `update`
--
ALTER TABLE `update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

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
