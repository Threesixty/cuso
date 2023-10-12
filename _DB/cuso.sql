-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 oct. 2023 à 15:58
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
-- Structure de la table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
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

INSERT INTO `cms` (`id`, `title`, `url`, `url_redirect`, `template`, `tags`, `photo_id`, `youtube_embed`, `youtube_on`, `meta_title`, `meta_description`, `summary`, `content`, `status`, `start_date`, `end_date`, `lang`, `lang_parent_id`, `author`, `created_at`) VALUES
(1, 'Accueil', 'accueil', '', 'index', 'null', '[]', '', '0', 'Accueil', '', '', '[]', 1, 1697061600, 0, 'fr', NULL, 1, 1697106833);

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
('m201214_102628_create_update_table', 1607941891);

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
(1, 'Catégories CMS', 'cms-categories', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Défaut\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_3\",\"text\":\"Lien externe\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_4\",\"text\":\"Popin\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Défaut\",\"content\":[{\"slug\":\"option_value\",\"value\":\"default\"}]}]', 'fr', NULL, 1, 1616515487),
(2, 'Modèles de page', 'cms-template', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Accueil\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_5\",\"text\":\"Contactez-nous\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Accueil\",\"content\":[{\"slug\":\"option_value\",\"value\":\"index\"}]},{\"id\":\"j1_5\",\"name\":\"Contactez-nous\",\"content\":[{\"slug\":\"option_value\",\"value\":\"form/contact-us\"}]}]', 'fr', NULL, 1, 1616515552),
(3, 'Étiquettes CMS', 'cms-tags', '', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_14\",\"text\":\"Formulaire de contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_14\",\"name\":\"Formulaire de contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"contact-form\"}]}]', 'fr', NULL, 1, 1616515606),
(5, 'Configuration des menus front-office', '_menus_', 'SPECIAL', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_5\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_47\",\"text\":\"MENU FOOTER - Contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[]', 'fr', NULL, 1, 1619700894),
(6, 'Menus', 'menus', 'Liste des menus de navigation front', '[{\"id\":\"j1_1\",\"text\":\"Option\",\"state\":{\"opened\":true},\"children\":[{\"id\":\"j1_2\",\"text\":\"Menu principal\",\"state\":{\"opened\":true},\"children\":[]},{\"id\":\"j1_13\",\"text\":\"MENU FOOTER - Contact\",\"state\":{\"opened\":true},\"children\":[]}]}]', '[{\"id\":\"j1_2\",\"name\":\"Menu principal\",\"content\":[{\"slug\":\"option_value\",\"value\":\"main-menu\"}]},{\"id\":\"j1_13\",\"name\":\"MENU FOOTER - Contact\",\"content\":[{\"slug\":\"option_value\",\"value\":\"0\"}]}]', 'fr', NULL, 1, 1620824065);

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
(5, 'media', 1, 'delete', 1697117118, 1);

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
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) DEFAULT 0,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `gender`, `firstname`, `lastname`, `role`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'michael.convergence@gmail.com', 'vzOTuHgr6qCV7nCuvo5Ls4SPL4SBtlfH', '$2y$13$D/tdMxWY30CKGPvBlMxH2.Q6ihMwRGeZkRO8lRo46jjIqp3jPqvmi', 'UoB28i32eum5zOaWgxhGGUM3mJql1STx_1606321467', 'michael.convergence@gmail.com', 'Mr', 'Michael', 'THOMAS', 5, 10, 1605009349, 1697113634, 'mJd519zaQzC8rJpXyD_N2r01txIIKdAy_1605009349');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-cms-photo` (`photo_id`),
  ADD KEY `idx-cms-lang_parent` (`lang_parent_id`),
  ADD KEY `idx-cms-author` (`author`);

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
-- AUTO_INCREMENT pour la table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `option`
--
ALTER TABLE `option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `update`
--
ALTER TABLE `update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
