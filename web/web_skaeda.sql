-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 04-08-2011 a les 17:04:23
-- Versió del servidor: 5.1.30
-- PHP versió: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `web_skaeda`
--

CREATE DATABASE skaedaweb;
USE skaedaweb;
CREATE USER userskaedaweb IDENTIFIED BY '4ndr01d3';
GRANT ALL PRIVILEGES ON skaedaweb.* TO userskaedaweb;

-- --------------------------------------------------------

--
-- Estructura de la taula `controllers`
--

CREATE TABLE `controllers` (
  `controllers_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `controllers_nom` varchar(30) DEFAULT NULL                   COMMENT 'nom del controlador',
  `controllers_folder` varchar(50) DEFAULT NULL                COMMENT 'carpeta on actua el controlador',
  `controllers__idioma_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`controllers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Bolcant dades de la taula `controllers`
--

INSERT INTO `controllers` (`controllers_id`, `controllers_nom`, `controllers_folder`, `controllers__idioma_id`) VALUES (3, 'public', 'public', NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `idioma`
--

CREATE TABLE `idioma` (
  `idioma_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT    COMMENT 'Id de la llengua de atribut',
  `idioma_abr` varchar(5) NOT NULL                            COMMENT 'Abreviatura de la llengua \r\n(per exemple: ca=català, fr=fran',
  `idioma_nom` text NOT NULL                                  COMMENT 'Nom de la llengua',
  `idioma__estat_id` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'llengua activada si/no',
  `idioma_ordre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idioma_id`,`idioma_abr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `idioma`
--

INSERT INTO `idioma` (`idioma_id`, `idioma_abr`, `idioma_nom`, `idioma__estat_id`, `idioma_ordre`) VALUES
(1, 'ca', 'Català',    1, 2),
(2, 'es', 'Español',   1, 3),
(3, 'en', 'English',   1, 1),
(4, 'fr', 'Française', 1, 4),
(5, 'it', 'Italiano',  1, 5);

-- --------------------------------------------------------

--
-- Estructura de la taula `pags`
--

CREATE TABLE `pags` (
  `pags_id` int(11) NOT NULL AUTO_INCREMENT,
  `pags_codi` varchar(50) DEFAULT NULL                    COMMENT 'codi de la pagina (independent de idioma)',
  `pags_parent` varchar(50) DEFAULT NULL                  COMMENT 'menu principal d''on penja',
  `pags__controllers_id` int(10) unsigned DEFAULT NULL    COMMENT 'controllador al que pertany la pàgina',
  `pags_start` tinyint(3) unsigned DEFAULT '0'            COMMENT 'és la pàgina inicial del controlador?',
  PRIMARY KEY (`pags_id`),
  KEY `pags__controllers_id` (`pags__controllers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

--
-- Bolcant dades de la taula `pags`
--

INSERT INTO `pags` (`pags_id`, `pags_codi`, `pags_parent`, `pags__controllers_id`, `pags_start`) VALUES
(88,  'inici', 'portada', 3, 1),
(100, 'overview', 'sup_overview', 3, 0),
(128, 'general_behavior', 'sup_tour', 3, 0),
(129, 'social_sharing',   'sup_tour', 3, 0),
(130, 'real_time',        'sup_tour', 3, 0),
(131, 'import_export',    'sup_tour', 3, 0),
(200, 'what_is_skaeda',            'sup_features', 3, 0),
(201, 'general_structure',         'sup_features', 3, 0),
(202, 'smart_manual_groups',       'sup_features', 3, 0),
(203, 'social_tagging',            'sup_features', 3, 0),
(204, 'bookmark_management',       'sup_features', 3, 0),
(205, 'quick_search',              'sup_features', 3, 0),
(206, 'import_and_export',         'sup_features', 3, 0),
(207, 'bookmarklet',               'sup_features', 3, 0),
(208, 'instant_synchronization',   'sup_features', 3, 0),
(209, 'subscriptions_invitations', 'sup_features', 3, 0),
(149, 'pricing', 'sup_pricing', 3, 0),
(140, 'faqs',            'sup_support', 3, 0),
(141, 'use_bookmarklet', 'sup_support', 3, 0),
(142, 'forum',           'sup_support', 3, 0),
(143, 'login', 'sup_login', 3, 0),
(144, 'company', 'sup_company', 3, 0),
(145, 'blog', '', 3, 0),
(146, 'about',   'company', 3, 0),
(147, 'contact', 'company', 3, 0),
(148, 'press',   'company', 3, 0),
(150, 'security',       '', 3, 0),
(151, 'privacy_policy', '', 3, 0),
(152, 'terms_service',  '', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `pags_at`
--

CREATE TABLE `pags_at` (
  `pags_at_id` int(11) NOT NULL AUTO_INCREMENT,
  `pags_at__pags_id` int(11) DEFAULT NULL,
  `pags_at_idioma` varchar(5) DEFAULT NULL,
  `pags_at_text` varchar(50) DEFAULT NULL,
  `pags_at_titol` varchar(50) DEFAULT NULL,
  `pags_at_codi` varchar(50) DEFAULT NULL COMMENT 'url de la pàgina',
  PRIMARY KEY (`pags_at_id`),
  KEY `fk_pags_at__pags_id` (`pags_at__pags_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=837 ;

--
-- Bolcant dades de la taula `pags_at`
--

INSERT INTO `pags_at` (`pags_at_id`, `pags_at__pags_id`, `pags_at_idioma`, `pags_at_text`, `pags_at_titol`, `pags_at_codi`) VALUES
(687, 88, 'en', NULL, NULL, '/'),
(688, 88, 'ca', NULL, NULL, 'inici'),
(689, 88, 'es', NULL, NULL, 'inicio'),
(10000, 100, 'en', NULL, NULL, 'overview'),
(10001, 100, 'ca', NULL, NULL, 'introduccio'),
(10002, 100, 'es', NULL, NULL, 'introduccion'),
(702, 128, 'en', NULL, NULL, 'general-behavior'),
(703, 128, 'ca', NULL, NULL, 'comportament-general'),
(704, 128, 'es', NULL, NULL, 'comportamiento-general'),
(705, 129, 'en', NULL, NULL, 'social-sharing'),
(706, 129, 'ca', NULL, NULL, 'comparteix'),
(707, 129, 'es', NULL, NULL, 'compartir'),
(708, 130, 'en', NULL, NULL, 'real-time-sync'),
(709, 130, 'ca', NULL, NULL, 'sincronitzacio-temps-real'),
(710, 130, 'es', NULL, NULL, 'sincronizacion-tiempo-real'),
(711, 131, 'en', NULL, NULL, 'imports-and-exports'),
(712, 131, 'ca', NULL, NULL, 'importar-i-exportar'),
(713, 131, 'es', NULL, NULL, 'importar-y-exportar'),
(20000, 200, 'en', NULL, NULL, 'what-is-skaeda'),
(20001, 200, 'ca', NULL, NULL, 'que-es-skaeda-ca'),
(20002, 200, 'es', NULL, NULL, 'que-es-skaeda'),
(20100, 201, 'en', NULL, NULL, 'general-structure'),
(20101, 201, 'ca', NULL, NULL, 'estructura-general-ca'),
(20102, 201, 'es', NULL, NULL, 'estructura-general'),
(20200, 202, 'en', NULL, NULL, 'smart-and-manual-groups'),
(20201, 202, 'ca', NULL, NULL, 'grups-automatics-i-manuals'),
(20202, 202, 'es', NULL, NULL, 'grupos-automaticos-y-manuales'),
(20300, 203, 'en', NULL, NULL, 'social-tagging'),
(20301, 203, 'ca', NULL, NULL, 'etiquetatge-social'),
(20302, 203, 'es', NULL, NULL, 'etiquetaje-social'),
(20400, 204, 'en', NULL, NULL, 'bookmark-management'),
(20401, 204, 'ca', NULL, NULL, 'gestio-de-marcadors'),
(20402, 204, 'es', NULL, NULL, 'gestion-de-marcadores'),
(20500, 205, 'en', NULL, NULL, 'quick-search'),
(20501, 205, 'ca', NULL, NULL, 'cerca-rapida'),
(20502, 205, 'es', NULL, NULL, 'busqueda-rapida'),
(20600, 206, 'en', NULL, NULL, 'import-and-export'),
(20601, 206, 'ca', NULL, NULL, 'importacio-i-exportacio'),
(20602, 206, 'es', NULL, NULL, 'importacion-y-exportacion'),
(20700, 207, 'en', NULL, NULL, 'bookmarklet'),
(20701, 207, 'ca', NULL, NULL, 'bookmarklet-ca'),
(20702, 207, 'es', NULL, NULL, 'bookmarklet-es'),
(20800, 208, 'en', NULL, NULL, 'instant-synchronization'),
(20801, 208, 'ca', NULL, NULL, 'sincronitzacio-instantanea'),
(20802, 208, 'es', NULL, NULL, 'sincronizacion-instantanea'),
(20900, 209, 'en', NULL, NULL, 'subscriptions-and-invitations'),
(20901, 209, 'ca', NULL, NULL, 'subscripcions-i-invitacions'),
(20902, 209, 'es', NULL, NULL, 'subscripciones-e-invitaciones'),
(750, 140, 'en', NULL, NULL, 'faqs'),
(751, 140, 'ca', NULL, NULL, 'preguntes-frequents'),
(752, 140, 'es', NULL, NULL, 'preguntas-frecuentes'),
(762, 141, 'en', NULL, NULL, 'use-of-bookmarlet'),
(763, 141, 'ca', NULL, NULL, 'us-del-bookmarklet'),
(764, 141, 'es', NULL, NULL, 'uso-del-bookmarklet'),
(765, 142, 'en', NULL, NULL, 'forum'),
(766, 142, 'ca', NULL, NULL, 'forum-ca'),
(767, 142, 'es', NULL, NULL, 'foro'),
(768, 143, 'en', NULL, NULL, 'login'),
(769, 143, 'ca', NULL, NULL, 'entra'),
(770, 143, 'es', NULL, NULL, 'entrar'),
(774, 145, 'en', NULL, NULL, 'blog'),
(775, 145, 'ca', NULL, NULL, 'bloc'),
(776, 145, 'es', NULL, NULL, 'blog-es'),
(780, 144, 'en', NULL, NULL, 'company'),
(781, 144, 'ca', NULL, NULL, 'empresa-ca'),
(782, 144, 'es', NULL, NULL, 'empresa'),
(783, 146, 'en', NULL, NULL, 'about-us'),
(784, 146, 'ca', NULL, NULL, 'sobre-nosaltres'),
(785, 146, 'es', NULL, NULL, 'sobre-nosotros'),
(786, 147, 'en', NULL, NULL, 'contact'),
(787, 147, 'ca', NULL, NULL, 'contacte'),
(788, 147, 'es', NULL, NULL, 'contacto'),
(789, 148, 'en', NULL, NULL, 'press'),
(790, 148, 'ca', NULL, NULL, 'premsa'),
(791, 148, 'es', NULL, NULL, 'prensa'),
(792, 149, 'en', NULL, NULL, 'pricing'),
(793, 149, 'ca', NULL, NULL, 'preus'),
(794, 149, 'es', NULL, NULL, 'precios'),
(798, 151, 'en', NULL, NULL, 'privacy-policy'),
(799, 151, 'ca', NULL, NULL, 'politica-de-privacitat'),
(800, 151, 'es', NULL, NULL, 'politica-de-privacidad'),
(801, 152, 'en', NULL, NULL, 'terms-of-service'),
(802, 152, 'ca', NULL, NULL, 'termes-del-servei'),
(803, 152, 'es', NULL, NULL, 'condiciones-del-servicio'),
(813, 150, 'en', NULL, NULL, 'security'),
(814, 150, 'ca', NULL, NULL, 'seguretat'),
(815, 150, 'es', NULL, NULL, 'seguridad');

-- --------------------------------------------------------

--
-- Stand-in estructura per a vista `v_pags`
--
CREATE TABLE `v_pags` (
`pags_id` int(11)
,`pags_codi` varchar(50)
,`pags_parent` varchar(50)
,`pags__controllers_id` int(10) unsigned
,`pags_start` tinyint(3) unsigned
,`pags_at_id` int(11)
,`pags_at__pags_id` int(11)
,`pags_at_idioma` varchar(5)
,`pags_at_text` varchar(50)
,`pags_at_titol` varchar(50)
,`pags_at_codi` varchar(50)
,`controllers_id` int(10) unsigned
,`controllers_nom` varchar(30)
,`controllers_folder` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura per a vista `v_pags`
--
DROP TABLE IF EXISTS `v_pags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`userskaedaweb`@`%` SQL SECURITY DEFINER VIEW `v_pags` AS select `pags`.`pags_id` AS `pags_id`,`pags`.`pags_codi` AS `pags_codi`,`pags`.`pags_parent` AS `pags_parent`,`pags`.`pags__controllers_id` AS `pags__controllers_id`,`pags`.`pags_start` AS `pags_start`,`pags_at`.`pags_at_id` AS `pags_at_id`,`pags_at`.`pags_at__pags_id` AS `pags_at__pags_id`,`pags_at`.`pags_at_idioma` AS `pags_at_idioma`,`pags_at`.`pags_at_text` AS `pags_at_text`,`pags_at`.`pags_at_titol` AS `pags_at_titol`,`pags_at`.`pags_at_codi` AS `pags_at_codi`,`controllers`.`controllers_id` AS `controllers_id`,`controllers`.`controllers_nom` AS `controllers_nom`,`controllers`.`controllers_folder` AS `controllers_folder` from ((`pags` join `pags_at` on((`pags`.`pags_id` = `pags_at`.`pags_at__pags_id`))) join `controllers` on((`pags`.`pags__controllers_id` = `controllers`.`controllers_id`))) order by `pags`.`pags_parent` desc,`pags_at`.`pags_at_codi`;

--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `pags_at`
--
ALTER TABLE `pags_at`
  ADD CONSTRAINT `pags_id__frg` FOREIGN KEY (`pags_at__pags_id`) REFERENCES `pags` (`pags_id`) ON DELETE CASCADE;
