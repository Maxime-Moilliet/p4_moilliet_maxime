-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table p4_moilliet_maxime. location
DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `postal_code` int(11) DEFAULT NULL,
    `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `user_id` int(10) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `user_location_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=5842 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. order
DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `priceht` decimal(5,2) DEFAULT NULL,
    `tva` int(11) DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '0',
    `is_paid` tinyint(1) NOT NULL DEFAULT '0',
    `user_id` int(10) unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `shipping_address_id` int(10) unsigned DEFAULT NULL,
    `Colonne 10` int(10) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `client_id` (`user_id`),
    KEY `shipping_address_id_foreign` (`shipping_address_id`),
    CONSTRAINT `shipping_address_id_foreign` FOREIGN KEY (`shipping_address_id`) REFERENCES `shipping_address` (`id`) ON DELETE SET NULL,
    CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=1322 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. order_item
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `quantity` int(11) DEFAULT NULL,
    `product_id` int(10) unsigned DEFAULT NULL,
    `order_id` int(10) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `product_id` (`product_id`),
    KEY `order_id` (`order_id`),
    CONSTRAINT `order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE SET NULL,
    CONSTRAINT `order_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=902 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `description` text COLLATE utf8_unicode_ci,
    `price` decimal(5,2) DEFAULT NULL,
    `product_type_id` int(10) unsigned DEFAULT NULL,
    `user_id` int(10) unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `product_type_id` (`product_type_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`) ON DELETE SET NULL,
    CONSTRAINT `user_product_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=3403 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. product_type
DROP TABLE IF EXISTS `product_type`;
CREATE TABLE IF NOT EXISTS `product_type` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=830 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. shipping_address
DROP TABLE IF EXISTS `shipping_address`;
CREATE TABLE IF NOT EXISTS `shipping_address` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `postal_code` int(11) unsigned DEFAULT NULL,
    `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table p4_moilliet_maxime. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `role_id` int(10) unsigned DEFAULT NULL,
    `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `phone` int(11) DEFAULT NULL,
    `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `role_id` (`role_id`),
    CONSTRAINT `user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=2185 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
