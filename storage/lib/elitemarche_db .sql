-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.26 - MySQL Community Server (GPL)
-- SE du serveur:                Win32
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table elitemarche_db. besoins
CREATE TABLE IF NOT EXISTS `besoins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_besoin` date DEFAULT NULL,
  `demandeur` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee_gestion` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valider` tinyint(1) DEFAULT '0',
  `date_validation` datetime DEFAULT NULL,
  `services_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `besoins_services_id_foreign` (`services_id`),
  CONSTRAINT `besoins_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.besoins : ~0 rows (environ)
/*!40000 ALTER TABLE `besoins` DISABLE KEYS */;
/*!40000 ALTER TABLE `besoins` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. etablissements
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `matricule_fiscale` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'جامعة  جندوبة',
  `email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsable` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entete` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_pa` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'PA0001',
  `code_consult` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'CO0001',
  `code_ao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'PA0001',
  `ajouter_annee` tinyint(1) DEFAULT '1',
  `reset_code` tinyint(1) DEFAULT '1',
  `notif_validation_besoins` tinyint(1) DEFAULT NULL,
  `notif_pa` tinyint(1) DEFAULT NULL,
  `notif_duree_pa` int(11) DEFAULT NULL,
  `notif_publication_achat` tinyint(1) DEFAULT NULL,
  `notif_duree_publication` int(11) DEFAULT NULL,
  `notif_session_op` tinyint(1) DEFAULT NULL,
  `notif_duree_session_op` int(11) DEFAULT NULL,
  `notif_date_caution_final` tinyint(1) DEFAULT NULL,
  `notif_duree_caution_final` int(11) DEFAULT NULL,
  `notif_delais_rp` tinyint(1) DEFAULT NULL,
  `notif_duree_rp` int(11) DEFAULT NULL,
  `notif_delais_rd` tinyint(1) DEFAULT NULL,
  `notif_duree_rd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.etablissements : ~0 rows (environ)
/*!40000 ALTER TABLE `etablissements` DISABLE KEYS */;
/*!40000 ALTER TABLE `etablissements` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. ligne_besoins
CREATE TABLE IF NOT EXISTS `ligne_besoins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qte_demande` int(11) DEFAULT NULL,
  `qte_valide` int(11) DEFAULT NULL,
  `cout_unite_ttc` decimal(12,3) DEFAULT NULL,
  `cout_total_ttc` decimal(12,3) DEFAULT NULL,
  `type_demande` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `besoins_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ligne_besoins_besoins_id_foreign` (`besoins_id`),
  CONSTRAINT `ligne_besoins_besoins_id_foreign` FOREIGN KEY (`besoins_id`) REFERENCES `besoins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.ligne_besoins : ~0 rows (environ)
/*!40000 ALTER TABLE `ligne_besoins` DISABLE KEYS */;
/*!40000 ALTER TABLE `ligne_besoins` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. ligne_projets
CREATE TABLE IF NOT EXISTS `ligne_projets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_lot` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `cout_unite_ttc` decimal(12,3) DEFAULT NULL,
  `cout_total_ttc` decimal(12,3) DEFAULT NULL,
  `projets_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ligne_projets_projets_id_foreign` (`projets_id`),
  CONSTRAINT `ligne_projets_projets_id_foreign` FOREIGN KEY (`projets_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.ligne_projets : ~0 rows (environ)
/*!40000 ALTER TABLE `ligne_projets` DISABLE KEYS */;
/*!40000 ALTER TABLE `ligne_projets` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.migrations : ~11 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_02_17_195336_create_services_table', 1),
	(6, '2022_03_07_221151_create_soumissionnaires_table', 1),
	(7, '2022_03_10_183415_create_besoins_table', 1),
	(8, '2022_03_15_163610_create_ligne_besoins_table', 1),
	(9, '2022_03_25_194535_create_etablissements_table', 1),
	(10, '2022_04_08_092749_create_projets_table', 1),
	(11, '2022_04_12_141718_create_ligne_projets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.personal_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. projets
CREATE TABLE IF NOT EXISTS `projets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code_pa` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_projet` date DEFAULT NULL,
  `libelle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_action_prevu` date DEFAULT NULL,
  `objet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_demande` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_passation` enum('CONSULTATION','AOS','AON','AOGREGRE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cout_total_pro` decimal(12,3) DEFAULT NULL,
  `annee_gestion` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services_id` bigint(20) unsigned NOT NULL,
  `besoins_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projets_services_id_foreign` (`services_id`),
  KEY `projets_besoins_id_foreign` (`besoins_id`),
  CONSTRAINT `projets_besoins_id_foreign` FOREIGN KEY (`besoins_id`) REFERENCES `besoins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `projets_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.projets : ~0 rows (environ)
/*!40000 ALTER TABLE `projets` DISABLE KEYS */;
/*!40000 ALTER TABLE `projets` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsable` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.services : ~0 rows (environ)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. soumissionnaires
CREATE TABLE IF NOT EXISTS `soumissionnaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_fax` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule_fiscale` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.soumissionnaires : ~0 rows (environ)
/*!40000 ALTER TABLE `soumissionnaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `soumissionnaires` ENABLE KEYS */;

-- Listage de la structure de la table elitemarche_db. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table elitemarche_db.users : ~0 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
