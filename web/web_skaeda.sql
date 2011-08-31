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

(50,  'inici', 'portada', 3, 1),
(100, 'overview', 'sup_overview', 3, 0),
-- (128, 'general_behavior', 'sup_tour', 3, 0),
-- (129, 'social_sharing',   'sup_tour', 3, 0),
-- (130, 'real_time',        'sup_tour', 3, 0),
-- (131, 'import_export',    'sup_tour', 3, 0),
(150, 'common_queries',       'sup_tour', 3, 0),
(151, 'bookmarks_management', 'sup_tour', 3, 0),
(152, 'tags_and_groups',      'sup_tour', 3, 0),
(153, 'import_bookmarks',     'sup_tour', 3, 0),
(154, 'social_sharing',       'sup_tour', 3, 0),
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
(250, 'pricing', 'sup_pricing', 3, 0),
(300, 'faqs',            'sup_support', 3, 0),
(301, 'use_bookmarklet', 'sup_support', 3, 0),
(302, 'forum',           'sup_support', 3, 0),
(350, 'login', 'sup_login', 3, 0),
(400, 'company', 'sup_company', 3, 0),
(401, 'blog', '', 3, 0),
(402, 'about',   'company', 3, 0),
(403, 'contact', 'company', 3, 0),
(404, 'press',   'company', 3, 0),
(405, 'security',       '', 3, 0),
(406, 'privacy_policy', '', 3, 0),
(407, 'terms_service',  '', 3, 0);

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
(5000, 50, 'en', NULL, NULL, '/'),
(5001, 50, 'ca', NULL, NULL, 'inici'),
(5002, 50, 'es', NULL, NULL, 'inicio'),
(10000, 100, 'en', NULL, NULL, 'overview'),
(10001, 100, 'ca', NULL, NULL, 'introduccio'),
(10002, 100, 'es', NULL, NULL, 'introduccion'),
-- (702, 128, 'en', NULL, NULL, 'general-behavior'),
-- (703, 128, 'ca', NULL, NULL, 'comportament-general'),
-- (704, 128, 'es', NULL, NULL, 'comportamiento-general'),
-- (705, 129, 'en', NULL, NULL, 'social-sharing'),
-- (706, 129, 'ca', NULL, NULL, 'comparteix'),
-- (707, 129, 'es', NULL, NULL, 'compartir'),
-- (708, 130, 'en', NULL, NULL, 'real-time-sync'),
-- (709, 130, 'ca', NULL, NULL, 'sincronitzacio-temps-real'),
-- (710, 130, 'es', NULL, NULL, 'sincronizacion-tiempo-real'),
-- (711, 131, 'en', NULL, NULL, 'imports-and-exports'),
-- (712, 131, 'ca', NULL, NULL, 'importar-i-exportar'),
-- (713, 131, 'es', NULL, NULL, 'importar-y-exportar'),
(15000, 150, 'en', NULL, NULL, 'common-queries'),
(15001, 150, 'ca', NULL, NULL, 'common-queries-ca'),
(15002, 150, 'es', NULL, NULL, 'common-queries-es'),
(15100, 151, 'en', NULL, NULL, 'bookmarks-management'),
(15101, 151, 'ca', NULL, NULL, 'bookmarks-management-ca'),
(15102, 151, 'es', NULL, NULL, 'bookmarks-management-es'),
(15200, 152, 'en', NULL, NULL, 'tags-and-groups'),
(15201, 152, 'ca', NULL, NULL, 'tags-and-groups-ca'),
(15202, 152, 'es', NULL, NULL, 'tags-and-groups-es'),
(15300, 153, 'en', NULL, NULL, 'import-bookmarks'),
(15301, 153, 'ca', NULL, NULL, 'import-bookmarks-ca'),
(15302, 153, 'es', NULL, NULL, 'import-bookmarks-es'),
(15400, 154, 'en', NULL, NULL, 'social-sharing'),
(15401, 154, 'ca', NULL, NULL, 'social-sharing-ca'),
(15402, 154, 'es', NULL, NULL, 'social-sharing-es'),
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
(25000, 250, 'en', NULL, NULL, 'pricing'),
(25001, 250, 'ca', NULL, NULL, 'preus'),
(25002, 250, 'es', NULL, NULL, 'precios'),
(30000, 300, 'en', NULL, NULL, 'faqs'),
(30001, 300, 'ca', NULL, NULL, 'preguntes-frequents'),
(30002, 300, 'es', NULL, NULL, 'preguntas-frecuentes'),
(30100, 301, 'en', NULL, NULL, 'use-of-bookmarlet'),
(30101, 301, 'ca', NULL, NULL, 'us-del-bookmarklet'),
(30102, 301, 'es', NULL, NULL, 'uso-del-bookmarklet'),
(30200, 302, 'en', NULL, NULL, 'forum'),
(30201, 302, 'ca', NULL, NULL, 'forum-ca'),
(30202, 302, 'es', NULL, NULL, 'foro'),
(35000, 350, 'en', NULL, NULL, 'login'),
(35001, 350, 'ca', NULL, NULL, 'entra'),
(35002, 350, 'es', NULL, NULL, 'entrar'),
(40000, 400, 'en', NULL, NULL, 'company'),
(40001, 400, 'ca', NULL, NULL, 'empresa-ca'),
(40002, 400, 'es', NULL, NULL, 'empresa'),
(40100, 401, 'en', NULL, NULL, 'blog'),
(40101, 401, 'ca', NULL, NULL, 'bloc'),
(40102, 401, 'es', NULL, NULL, 'blog-es'),
(40200, 402, 'en', NULL, NULL, 'about-us'),
(40201, 402, 'ca', NULL, NULL, 'sobre-nosaltres'),
(40202, 402, 'es', NULL, NULL, 'sobre-nosotros'),
(40300, 403, 'en', NULL, NULL, 'contact'),
(40301, 403, 'ca', NULL, NULL, 'contacte'),
(40302, 403, 'es', NULL, NULL, 'contacto'),
(40400, 404, 'en', NULL, NULL, 'press'),
(40401, 404, 'ca', NULL, NULL, 'premsa'),
(40402, 404, 'es', NULL, NULL, 'prensa'),
(40500, 405, 'en', NULL, NULL, 'security'),
(40501, 405, 'ca', NULL, NULL, 'seguretat'),
(40502, 405, 'es', NULL, NULL, 'seguridad'),
(40600, 406, 'en', NULL, NULL, 'privacy-policy'),
(40601, 406, 'ca', NULL, NULL, 'politica-de-privacitat'),
(40602, 406, 'es', NULL, NULL, 'politica-de-privacidad'),
(40700, 407, 'en', NULL, NULL, 'terms-of-service'),
(40701, 407, 'ca', NULL, NULL, 'termes-del-servei'),
(40702, 407, 'es', NULL, NULL, 'condiciones-del-servicio');

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
