-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Mars 2018 à 17:00
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ogm`
--

-- --------------------------------------------------------

--
-- Structure de la table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(11) NOT NULL,
  `name_contract` varchar(80) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `supplier_id` int(4) NOT NULL,
  `purchase_type_id` int(3) NOT NULL,
  `maintenance_type_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `renewal_date` date NOT NULL,
  `business_unit_id` int(11) NOT NULL,
  `paid_by_id` int(11) NOT NULL,
  `comments` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contracts`
--

INSERT INTO `contracts` (`id`, `name_contract`, `reference`, `supplier_id`, `purchase_type_id`, `maintenance_type_id`, `purchase_date`, `renewal_date`, `business_unit_id`, `paid_by_id`, `comments`) VALUES
(4, 'ABAQUS', '', 2, 2, 1, '2012-06-15', '2018-07-01', 2, 3, ''),
(5, 'suse', '', 8, 1, 1, '0000-00-00', '0000-00-00', 1, 4, ''),
(6, 'Contrat CES', '', 9, 1, 2, '0000-00-00', '0000-00-00', 1, 5, ''),
(7, 'Panorame eÂ²', '', 3, 1, 1, '0000-00-00', '0000-00-00', 1, 3, ''),
(8, 'Idol', '', 10, 1, 1, '0000-00-00', '2017-11-14', 1, 3, ''),
(9, 'contrat', 'sans', 2, 2, 1, '0000-00-00', '2018-01-02', 2, 3, ''),
(10, 'test', '', 5, 1, 1, '0000-00-00', '2015-05-16', 2, 3, ''),
(12, 'deux', '', 8, 2, 2, '0000-00-00', '2019-01-01', 1, 4, '');

-- --------------------------------------------------------

--
-- Structure de la table `entites_prescriptrices`
--

CREATE TABLE IF NOT EXISTS `entites_prescriptrices` (
  `id` int(11) NOT NULL,
  `acronym` varchar(10) NOT NULL,
  `nameBU` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `entites_prescriptrices`
--

INSERT INTO `entites_prescriptrices` (`id`, `acronym`, `nameBU`) VALUES
(1, 'INFRA', 'Infrastructure (CAST et ITRS)'),
(2, 'RDMS', 'Recherche et DÃ©veloppement'),
(3, 'BPF', 'Banque PSA Finance'),
(5, 'OPEL', 'OPEL');

-- --------------------------------------------------------

--
-- Structure de la table `familles_achat`
--

CREATE TABLE IF NOT EXISTS `familles_achat` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `familles_achat`
--

INSERT INTO `familles_achat` (`id`, `code`, `designation`) VALUES
(1, 'T04', 'Logiciels R&D'),
(2, 'T06', 'Logiciels Infrastructure'),
(3, 'B87', 'Logiciels hors R&D et Infrastructure'),
(4, 'L73', 'Reprographie');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(4) NOT NULL,
  `nom_usuel` varchar(60) NOT NULL,
  `cofor` varchar(10) NOT NULL,
  `groupe_id` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom_usuel`, `cofor`, `groupe_id`) VALUES
(2, 'DASSAULT SYSTEME', '36534K  01', 3),
(3, 'CODRA', '26929V  01', 2),
(5, 'EB Soft', '98989J  06', 2),
(6, 'gameforge', '123b5 01', 2),
(7, 'ubisoft', '87654  06', 2),
(8, 'SCC', '85520W  01', 2),
(9, 'ibm', '12260Y  06', 4),
(10, 'HPe France', '17508E  01', 5);

-- --------------------------------------------------------

--
-- Structure de la table `groupes_fournisseurs`
--

CREATE TABLE IF NOT EXISTS `groupes_fournisseurs` (
  `id` int(10) NOT NULL,
  `groupe` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupes_fournisseurs`
--

INSERT INTO `groupes_fournisseurs` (`id`, `groupe`) VALUES
(2, 'Autres'),
(3, 'Dassault'),
(4, 'IBM'),
(5, 'HP');

-- --------------------------------------------------------

--
-- Structure de la table `lignes_de_maintenance_evolutions`
--

CREATE TABLE IF NOT EXISTS `lignes_de_maintenance_evolutions` (
  `id` int(11) NOT NULL,
  `période_id` int(11) NOT NULL,
  `montant` double NOT NULL,
  `catégorie_id` int(11) NOT NULL,
  `commentaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignes_de_maintenance_gestion`
--

CREATE TABLE IF NOT EXISTS `lignes_de_maintenance_gestion` (
  `id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignes_de_maintenance_periode`
--

CREATE TABLE IF NOT EXISTS `lignes_de_maintenance_periode` (
  `id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `date_debut_periode` date NOT NULL,
  `date_fin_periode` date NOT NULL,
  `montant_global` double NOT NULL,
  `etat_workflow_id` int(11) NOT NULL,
  `date_init_workflow` date NOT NULL,
  `commentaire_periode` mediumtext NOT NULL,
  `offre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `lignes_de_maintenance_periode`
--

INSERT INTO `lignes_de_maintenance_periode` (`id`, `contrat_id`, `date_debut_periode`, `date_fin_periode`, `montant_global`, `etat_workflow_id`, `date_init_workflow`, `commentaire_periode`, `offre_id`) VALUES
(1, 1, '2017-06-30', '2018-06-29', 79246.42, 2, '2017-10-06', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE IF NOT EXISTS `offres` (
  `id` int(11) NOT NULL,
  `url_docinfogroupe` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `offres`
--

INSERT INTO `offres` (`id`, `url_docinfogroupe`, `etat`) VALUES
(1, 'http://docinfogroupe.inetpsa.com/ead/doc/ref.20531_17_01195/v.vc/pj', 2);

-- --------------------------------------------------------

--
-- Structure de la table `paid_by`
--

CREATE TABLE IF NOT EXISTS `paid_by` (
  `id` int(4) NOT NULL,
  `paid_by_entity` varchar(15) CHARACTER SET utf8 NOT NULL,
  `long_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=ascii;

--
-- Contenu de la table `paid_by`
--

INSERT INTO `paid_by` (`id`, `paid_by_entity`, `long_name`) VALUES
(3, 'CENTRAL', 'paiement DDCE France'),
(4, 'Chine', 'Refacturation Ã  la Chine'),
(5, 'AmLat', 'Refacturation Ã  l''amÃ©rique latine');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `end_of_support` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `product`, `description`, `end_of_support`) VALUES
(1, 'Catia', 'PLM', NULL),
(2, 'Enovia V6', 'plm', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `purchase_type`
--

CREATE TABLE IF NOT EXISTS `purchase_type` (
  `id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ascii;

--
-- Contenu de la table `purchase_type`
--

INSERT INTO `purchase_type` (`id`, `type`) VALUES
(1, 'Achat'),
(2, 'Location');

-- --------------------------------------------------------

--
-- Structure de la table `renewal_life_cycle`
--

CREATE TABLE IF NOT EXISTS `renewal_life_cycle` (
  `id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `order` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `renewal_life_cycle`
--

INSERT INTO `renewal_life_cycle` (`id`, `status`, `order`) VALUES
(1, 'Non lancé', 0),
(2, 'En cours', 30),
(3, 'Validé', 40),
(4, 'Refusé', 50),
(5, 'Offre demandée', 10),
(6, 'Offre reçue', 20),
(7, 'Bloqué', 60);

-- --------------------------------------------------------

--
-- Structure de la table `types_evolutions`
--

CREATE TABLE IF NOT EXISTS `types_evolutions` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `types_evolutions`
--

INSERT INTO `types_evolutions` (`id`, `type`) VALUES
(1, 'Hausse de pÃ©rimÃ¨tre'),
(2, 'Baisse de pÃ©rimÃ¨tre'),
(3, 'Ajustement tarifaire'),
(4, 'ArrÃªt de la maintenance');

-- --------------------------------------------------------

--
-- Structure de la table `types_maintenance`
--

CREATE TABLE IF NOT EXISTS `types_maintenance` (
  `id` int(11) NOT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `types_maintenance`
--

INSERT INTO `types_maintenance` (`id`, `type`) VALUES
(1, 'Logiciel'),
(2, 'Materiel');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `maintenance_type_id` (`maintenance_type_id`);

--
-- Index pour la table `entites_prescriptrices`
--
ALTER TABLE `entites_prescriptrices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `familles_achat`
--
ALTER TABLE `familles_achat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupe_id` (`groupe_id`);

--
-- Index pour la table `groupes_fournisseurs`
--
ALTER TABLE `groupes_fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignes_de_maintenance_evolutions`
--
ALTER TABLE `lignes_de_maintenance_evolutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catégorie_id` (`catégorie_id`);

--
-- Index pour la table `lignes_de_maintenance_gestion`
--
ALTER TABLE `lignes_de_maintenance_gestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignes_de_maintenance_periode`
--
ALTER TABLE `lignes_de_maintenance_periode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paid_by`
--
ALTER TABLE `paid_by`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `purchase_type`
--
ALTER TABLE `purchase_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `renewal_life_cycle`
--
ALTER TABLE `renewal_life_cycle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types_evolutions`
--
ALTER TABLE `types_evolutions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types_maintenance`
--
ALTER TABLE `types_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `entites_prescriptrices`
--
ALTER TABLE `entites_prescriptrices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `familles_achat`
--
ALTER TABLE `familles_achat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `groupes_fournisseurs`
--
ALTER TABLE `groupes_fournisseurs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `lignes_de_maintenance_evolutions`
--
ALTER TABLE `lignes_de_maintenance_evolutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lignes_de_maintenance_gestion`
--
ALTER TABLE `lignes_de_maintenance_gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lignes_de_maintenance_periode`
--
ALTER TABLE `lignes_de_maintenance_periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `paid_by`
--
ALTER TABLE `paid_by`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `purchase_type`
--
ALTER TABLE `purchase_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `renewal_life_cycle`
--
ALTER TABLE `renewal_life_cycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `types_evolutions`
--
ALTER TABLE `types_evolutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `types_maintenance`
--
ALTER TABLE `types_maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
