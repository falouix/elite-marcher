-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.6.50-log - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table lawfirm_db. cases
DROP TABLE IF EXISTS `cases`;
CREATE TABLE IF NOT EXISTS `cases` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `case_date` date DEFAULT NULL,
  `case_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `case_type_id` bigint(20) DEFAULT NULL,
  `case_status_id` bigint(20) DEFAULT NULL,
  `court_id` bigint(20) DEFAULT NULL,
  `court_num` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) unsigned NOT NULL,
  `clients_id` bigint(20) unsigned NOT NULL,
  `client_types_id` bigint(20) unsigned DEFAULT NULL,
  `case_stages_id` bigint(20) unsigned DEFAULT NULL,
  `category` enum('QuatariCases','ArbitrationCases','MediationCases') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'QuatariCases',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cases_users1_idx` (`user_id`),
  KEY `fk_cases_clients1_idx` (`clients_id`),
  KEY `fk_case_status1` (`case_status_id`),
  CONSTRAINT `fk_case_status1` FOREIGN KEY (`case_status_id`) REFERENCES `case_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cases_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cases_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.cases : ~3 rows (environ)
/*!40000 ALTER TABLE `cases` DISABLE KEYS */;
INSERT INTO `cases` (`id`, `case_date`, `case_code`, `case_num`, `case_type_id`, `case_status_id`, `court_id`, `court_num`, `description`, `user_id`, `clients_id`, `client_types_id`, `case_stages_id`, `category`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, '2021-10-01', '00010/2021', '2', 1, 3, 1, 2, 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', 1, 6, 2, 7, 'QuatariCases', '2021-10-01 22:44:10', NULL, 1, NULL),
	(3, '2021-10-02', '00011/2021', '2015/4150', 7, 6, 1, 1, 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', 1, 1, 2, 9, 'MediationCases', '2021-10-01 22:44:10', '2021-11-23 20:59:42', 1, NULL),
	(12, '2021-12-01', '00012/2021', NULL, 7, 6, 1, 2, 's<dsdhdshsdfhsdfhdsfh', 1, 6, 3, 8, 'QuatariCases', '2021-11-23 15:48:56', '2021-11-23 15:48:56', 1, NULL),
	(13, '2021-11-26', '00013/2021', NULL, 7, 6, 1, 2, 'ggggg', 1, 1, 12, 9, 'QuatariCases', '2021-11-23 15:49:55', '2021-11-23 15:49:55', 1, NULL),
	(14, '2021-12-02', '00014/2021', NULL, NULL, 4, NULL, 2, NULL, 1, 1, 12, NULL, 'QuatariCases', '2021-11-23 15:51:12', '2021-11-23 15:51:12', 1, NULL),
	(15, '2021-12-02', '00015/2021', NULL, 7, 3, 1, 2, 'dyeqryeyetyeyeryeryery', 1, 1, 11, 8, 'ArbitrationCases', '2021-12-02 13:23:58', '2021-12-02 13:23:58', 1, NULL);
/*!40000 ALTER TABLE `cases` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. case_docuements
DROP TABLE IF EXISTS `case_docuements`;
CREATE TABLE IF NOT EXISTS `case_docuements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cases_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_case_docuements_cases1_idx` (`cases_id`),
  CONSTRAINT `fk_case_docuements_cases1` FOREIGN KEY (`cases_id`) REFERENCES `cases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.case_docuements : ~0 rows (environ)
/*!40000 ALTER TABLE `case_docuements` DISABLE KEYS */;
INSERT INTO `case_docuements` (`id`, `file_name`, `path`, `cases_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(21, 'بطاقة شخصية', 'app/documents/case_documents/3//case_doc_1636365243.png', 3, '2021-11-08 09:54:03', '2021-11-08 09:54:03', 1, NULL),
	(22, 'QDQQDQDQD', 'app/documents/case_documents/1/case_doc_1639791159.pdf', 1, '2021-12-18 01:32:39', '2021-12-18 01:32:39', 7, NULL);
/*!40000 ALTER TABLE `case_docuements` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. case_parties
DROP TABLE IF EXISTS `case_parties`;
CREATE TABLE IF NOT EXISTS `case_parties` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `client_type_id` bigint(20) DEFAULT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_adress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_details` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_party` tinyint(4) DEFAULT NULL COMMENT '1  if is other party ',
  `cases_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_case_parties_cases1_idx` (`cases_id`) USING BTREE,
  CONSTRAINT `fk_case_parties_cases10` FOREIGN KEY (`cases_id`) REFERENCES `cases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.case_parties : ~0 rows (environ)
/*!40000 ALTER TABLE `case_parties` DISABLE KEYS */;
INSERT INTO `case_parties` (`id`, `client_id`, `client_type_id`, `client_name`, `party_name`, `party_adress`, `party_phone`, `client_details`, `client_party`, `cases_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(11, NULL, NULL, NULL, 'fffff', 'qrgretertrtrtrt', 'fdhgjdfgj', 'efgjdfgjdfj', 1, 1, '2021-12-01 23:11:42', '2021-12-07 21:17:14', 1, 1),
	(16, NULL, NULL, NULL, 'fffff', 'rryry', '99999', 'ryrryry', 0, 15, '2021-12-02 13:23:58', '2021-12-02 13:23:58', 1, NULL),
	(17, NULL, NULL, NULL, 'fffff', NULL, '94740770', 'ststst', 1, 12, '2021-12-02 15:16:26', '2021-12-02 15:16:26', 1, NULL);
/*!40000 ALTER TABLE `case_parties` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. case_sessions
DROP TABLE IF EXISTS `case_sessions`;
CREATE TABLE IF NOT EXISTS `case_sessions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session_date` datetime DEFAULT NULL,
  `session_libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_status_id` bigint(20) DEFAULT NULL,
  `session_second_date` datetime DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `postpone_reason` text COLLATE utf8mb4_unicode_ci,
  `is_mediation` tinyint(4) DEFAULT NULL,
  `cases_id` bigint(20) NOT NULL,
  `attending_parties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_case_sessions_cases1_idx` (`cases_id`),
  CONSTRAINT `fk_case_sessions_cases1` FOREIGN KEY (`cases_id`) REFERENCES `cases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.case_sessions : ~11 rows (environ)
/*!40000 ALTER TABLE `case_sessions` DISABLE KEYS */;
INSERT INTO `case_sessions` (`id`, `session_date`, `session_libelle`, `session_status_id`, `session_second_date`, `description`, `postpone_reason`, `is_mediation`, `cases_id`, `attending_parties`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(2, '2021-09-30 00:00:00', 'جلسة عدد 02', 2, '2021-09-30 00:00:00', 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', NULL, 0, 1, NULL, '2021-10-01 21:07:41', '2021-09-30 21:07:44', 1, 1),
	(3, '2021-09-30 00:00:00', 'جلسة عدد 03-----', 3, '2021-09-30 00:00:00', 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', NULL, 0, 1, NULL, '2021-01-01 21:07:41', '2021-12-08 16:02:03', 1, 1),
	(10, '2021-10-14 00:00:00', 'جلسة تجريبية', 1, NULL, 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', NULL, NULL, 1, NULL, '2021-10-14 16:46:51', '2021-10-14 16:46:51', 1, NULL),
	(11, '2021-11-03 00:00:00', 'dfhdfhdhdhf', 2, NULL, NULL, NULL, NULL, 1, NULL, '2021-11-03 21:57:29', '2021-11-03 21:57:29', 1, NULL),
	(12, '2021-11-18 00:00:00', 'dfhdhdfhdfh', 3, NULL, NULL, NULL, NULL, 1, NULL, '2021-11-03 21:57:50', '2021-11-03 21:57:50', 1, NULL),
	(13, '2021-11-27 00:00:00', '<sfQ>SfQFQ', 1, NULL, NULL, NULL, NULL, 1, NULL, '2021-11-03 21:58:05', '2021-11-03 21:58:05', 1, NULL),
	(16, '2021-11-27 00:00:00', 'جلسة مؤجلة', 1, '2021-12-09 02:00:00', 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', 'خلافاَ للاعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، بل إن له جذور في الأدب اللاتيني الكلاسيكي منذ العام 45 قبل الميلاد، مما يجعله أكثر من عام في القدم', NULL, 3, NULL, '2021-11-08 09:53:26', '2021-12-09 16:56:16', 1, 1),
	(19, '2021-12-08 00:00:00', 's<dgsdgdsg', 1, NULL, 'sdgsdgsdg', NULL, NULL, 15, NULL, '2021-12-08 00:08:52', '2021-12-08 00:08:52', 1, NULL),
	(23, '2021-12-08 00:00:00', 'جلسة', 2, NULL, 'تجربة تعديل تفصيل جلسة', NULL, NULL, 15, NULL, '2021-12-08 01:07:29', '2021-12-08 01:25:59', 1, 1),
	(24, '2021-12-11 09:00:00', 'جلسة تاتست', 2, NULL, 'تفصيل تاست', NULL, NULL, 15, NULL, '2021-12-08 01:11:28', '2021-12-08 01:36:06', 1, 1),
	(25, '2021-12-08 00:00:00', 's<dgsdgdsg', 2, NULL, 'sdgsdgsdgsdfsdfdfdf', NULL, NULL, 15, NULL, '2021-12-08 01:12:10', '2021-12-08 01:12:10', 1, NULL);
/*!40000 ALTER TABLE `case_sessions` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. case_stages
DROP TABLE IF EXISTS `case_stages`;
CREATE TABLE IF NOT EXISTS `case_stages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- Listage des données de la table lawfirm_db.case_stages : ~0 rows (environ)
/*!40000 ALTER TABLE `case_stages` DISABLE KEYS */;
INSERT INTO `case_stages` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(7, 'إبتدائي', '2021-11-06 10:42:31', '2021-11-06 10:42:31'),
	(8, 'إستئناف', '2021-11-06 10:44:11', '2021-12-16 10:54:13'),
	(9, 'قضية منظورة سابقا', '2021-11-06 10:44:41', '2021-11-06 10:44:41');
/*!40000 ALTER TABLE `case_stages` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. case_status
DROP TABLE IF EXISTS `case_status`;
CREATE TABLE IF NOT EXISTS `case_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.case_status : ~0 rows (environ)
/*!40000 ALTER TABLE `case_status` DISABLE KEYS */;
INSERT INTO `case_status` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(3, 'نشطة', '2021-09-10 01:38:01', '2021-09-10 01:38:01'),
	(4, 'أرشيف', '2021-09-10 01:39:08', '2021-09-10 01:39:08'),
	(6, 'الحكم', '2021-09-10 12:37:46', '2021-12-17 11:11:02');
/*!40000 ALTER TABLE `case_status` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. case_types
DROP TABLE IF EXISTS `case_types`;
CREATE TABLE IF NOT EXISTS `case_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.case_types : ~0 rows (environ)
/*!40000 ALTER TABLE `case_types` DISABLE KEYS */;
INSERT INTO `case_types` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(1, 'تجارية', '2021-09-09 00:32:45', '2021-09-09 00:32:45'),
	(7, 'جنائية', '2021-09-28 15:41:02', '2021-12-17 11:35:44'),
	(8, 'شرعية', '2021-09-28 15:43:11', '2021-09-28 15:43:11');
/*!40000 ALTER TABLE `case_types` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. ch_favorites
DROP TABLE IF EXISTS `ch_favorites`;
CREATE TABLE IF NOT EXISTS `ch_favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.ch_favorites : ~0 rows (environ)
/*!40000 ALTER TABLE `ch_favorites` DISABLE KEYS */;
INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
	(33665143, 2, 1, '2021-10-14 10:55:45', '2021-10-14 10:55:45'),
	(72184972, 1, 2, '2021-10-14 10:55:49', '2021-10-14 10:55:49');
/*!40000 ALTER TABLE `ch_favorites` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. ch_messages
DROP TABLE IF EXISTS `ch_messages`;
CREATE TABLE IF NOT EXISTS `ch_messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.ch_messages : ~1 rows (environ)
/*!40000 ALTER TABLE `ch_messages` DISABLE KEYS */;
INSERT INTO `ch_messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
	(1642136777, 'user', 2, 2, 'hfxkfhikwx', NULL, 1, '2021-10-14 10:22:23', '2021-10-14 10:22:43'),
	(1676575835, 'user', 1, 1, '', '{"new_name":"7f0e85ef-2f43-4c70-8c7d-3866a00df06e.txt","old_name":"gpl.txt"}', 1, '2021-11-14 18:42:24', '2021-11-14 18:42:25'),
	(1823278936, 'user', 1, 2, '', '{"new_name":"5bc5e10f-1a11-4db3-a1b7-74f15b1cc1b7.png","old_name":"213278752_813960182425614_7053504412415916231_n.png"}', 1, '2021-10-14 17:08:41', '2021-10-15 08:52:59'),
	(1902989786, 'user', 1, 1, '', '{"new_name":"76f25eab-1d6b-4a36-8abc-3174e0f98710.png","old_name":"add_client_offer_1.png"}', 1, '2021-11-14 18:42:43', '2021-11-14 18:42:45'),
	(1908602886, 'user', 1, 2, '\\سيل\\سشيللي', NULL, 1, '2021-10-14 10:55:33', '2021-10-14 10:55:34'),
	(2034260710, 'user', 1, 2, '&lt;script&gt;alert(&#039;hello&#039;)&lt;/script&gt;', NULL, 1, '2021-10-14 17:10:26', '2021-10-15 08:52:59'),
	(2244453712, 'user', 1, 2, 'sefgsqqee', NULL, 1, '2021-10-16 16:56:10', '2021-10-16 16:56:12'),
	(2282652326, 'user', 2, 1, 'dgyuuikdtyiy', NULL, 1, '2021-10-16 17:05:29', '2021-10-16 17:05:30'),
	(2311991394, 'user', 1, 1, 'Hello Shahed', NULL, 1, '2021-11-14 18:38:33', '2021-11-14 18:38:34'),
	(2449338587, 'user', 1, 2, 'Hello Miss shahed', NULL, 1, '2021-10-16 16:56:29', '2021-10-16 16:56:30'),
	(2609572519, 'user', 1, 2, 'dqfhqdfhdqsf', NULL, 1, '2021-10-16 17:05:22', '2021-10-16 17:05:23');
/*!40000 ALTER TABLE `ch_messages` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Person name or Company name',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` text COLLATE utf8mb4_unicode_ci,
  `phone_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qin` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Qatari Indetification Number',
  `passport` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `client_type` int(11) NOT NULL COMMENT 'Company or person',
  `nationality` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_registration` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_phone_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_adress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_contact_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_contact_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_contact_email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_contact_position` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `qin_UNIQUE` (`qin`),
  UNIQUE KEY `passport_UNIQUE` (`passport`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.clients : ~3 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `code`, `full_name`, `email`, `contact`, `phone_num`, `qin`, `passport`, `active`, `client_type`, `nationality`, `cp_registration`, `cp_phone_num`, `cp_adress`, `cp_contact_name`, `cp_contact_num`, `cp_contact_email`, `cp_contact_position`, `description`, `password`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, 'CLT00003/2021', 'CDF CENTER', 'cdfdhajali@gmail.com', 'الدوحة,قطر ص.ب 2035', '29492766', '12345678', 'H012345', 1, 1, 'tunisian', '1454254', '29492766', 'kasserine 1200', 'ahmed', '29492766', 'ahmed.godbani.96@gmail.com', 'kasserine', 'هنا نكتب ملاحظات للعميل', '$2y$10$j9cjO0o4PEm/1zshDfRaWe0DNc1jqbmieV6H6l0CWIa5brBl7GPOK', '2021-10-01 00:07:40', '2021-12-06 18:01:59', NULL, 1),
	(5, 'CLT00002/2021', 'السيدة شهد لوباني', 'shahedl1998@hotmail.com', 'الدوحة,قطر ص.ب 2035', '94740770', '123', '454545', 1, 0, 'قطري', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'هنا نكتب ملاحظات للعميل', '$2y$10$FNA2h4GwU9Ei/0yXkTQkVudbMqp9Pb6E8EwcW9ej6QhvdoIa/0rli', '2021-10-01 12:43:20', '2021-12-30 00:06:27', 1, 7),
	(6, 'CLT00001/2021', 'الشادلي الحاج علي', 'echedli1@gmail.com', 'الدوحة,قطر ص.ب 2035', '94740770', '09966822', '518224', 1, 0, 'قطري', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'هنا نكتب ملاحظات للعميل', '$2y$10$Wvi2SmrCwzqojb.j/QUj4.VFgwlEZsWne4HjORLh6of0PRyC.0Mle', '2021-11-07 21:04:13', '2021-11-08 16:28:32', 1, 1),
	(15, 'CLT00004/2021', 'إبراهيم الزهيري', 'cdfdhffajali@gmail.com', NULL, '94740770', '099h66822', '147852', 1, 0, 'قطري', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ffffffff', NULL, '2021-12-06 18:30:53', '2021-12-06 18:30:53', 1, 1),
	(16, 'CLT00005/2021', 'ؤاسي', 'chedli@cdfcenter.com', NULL, '94740770', NULL, NULL, 1, 1, NULL, '123', NULL, '\\لش\\سبيلشسليشسليشسل', NULL, NULL, NULL, NULL, NULL, '$2y$10$elpKhyKBWRdj1ClACDUTkeM4a/Nk4S8yy5RuK1inaE1KiQjMPQM2e', '2021-12-29 10:36:32', '2021-12-30 00:05:42', 7, 7);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. client_offers
DROP TABLE IF EXISTS `client_offers`;
CREATE TABLE IF NOT EXISTS `client_offers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `offer_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `send_date` timestamp NULL DEFAULT NULL,
  `offer_amount` decimal(10,2) DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `offer_from` enum('Consultation','Case','Prosecution') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `clients_id` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_offers_clients1_idx` (`clients_id`),
  CONSTRAINT `fk_client_offers_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.client_offers : ~2 rows (environ)
/*!40000 ALTER TABLE `client_offers` DISABLE KEYS */;
INSERT INTO `client_offers` (`id`, `offer_date`, `send_date`, `offer_amount`, `description`, `offer_from`, `status`, `created_at`, `updated_at`, `clients_id`, `created_by`, `updated_by`) VALUES
	(1, '2021-11-23 00:00:00', '2021-11-01 10:13:16', 120.53, 'تعديل أنواع القضايا', 'Case', 0, '2021-11-01 10:13:25', '2021-12-30 00:07:05', 1, 1, 7);
/*!40000 ALTER TABLE `client_offers` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. client_payements
DROP TABLE IF EXISTS `client_payements`;
CREATE TABLE IF NOT EXISTS `client_payements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `payement_date` date DEFAULT NULL,
  `payement_status_id` bigint(20) DEFAULT NULL COMMENT 'Payement Method (cash,...)',
  `payement_amount` decimal(10,2) DEFAULT NULL,
  `payement_libele` varchar(191) DEFAULT NULL,
  `pay_file_name` varchar(191) DEFAULT NULL,
  `pay_file_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `revenues_id` bigint(20) NOT NULL,
  `clients_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_payements_revenues1_idx` (`revenues_id`),
  CONSTRAINT `fk_client_payements_revenues1` FOREIGN KEY (`revenues_id`) REFERENCES `incomes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table lawfirm_db.client_payements : ~1 rows (environ)
/*!40000 ALTER TABLE `client_payements` DISABLE KEYS */;
INSERT INTO `client_payements` (`id`, `payement_date`, `payement_status_id`, `payement_amount`, `payement_libele`, `pay_file_name`, `pay_file_path`, `created_at`, `updated_at`, `created_by`, `updated_by`, `revenues_id`, `clients_id`) VALUES
	(1, '2021-12-18', 1, 70.00, 'hhhh', NULL, NULL, '2021-12-18 01:07:02', NULL, 1, NULL, 7, 6);
/*!40000 ALTER TABLE `client_payements` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. client_types
DROP TABLE IF EXISTS `client_types`;
CREATE TABLE IF NOT EXISTS `client_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.client_types : ~4 rows (environ)
/*!40000 ALTER TABLE `client_types` DISABLE KEYS */;
INSERT INTO `client_types` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(2, 'مدعى عليه', '2021-09-09 00:20:43', NULL),
	(3, 'مدعى', '2021-09-09 00:13:45', '2021-09-09 00:13:45'),
	(12, 'جدول أعمال', '2021-09-21 22:19:24', '2021-09-21 22:19:24'),
	(13, 'مجني', '2021-12-29 10:36:10', '2021-12-29 10:36:10');
/*!40000 ALTER TABLE `client_types` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. consultations
DROP TABLE IF EXISTS `consultations`;
CREATE TABLE IF NOT EXISTS `consultations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `conslt_date` timestamp NULL DEFAULT NULL,
  `offer_amount` decimal(10,2) DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `offer_from` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Case, Consultation, prosecution...',
  `offer_from_id` bigint(20) DEFAULT NULL,
  `clients_id` bigint(20) unsigned NOT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_offers_clients1_idx` (`clients_id`),
  KEY `fk_consultations_users1_idx` (`users_id`),
  CONSTRAINT `fk_client_offers_clients10` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultations_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.consultations : ~2 rows (environ)
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;
INSERT INTO `consultations` (`id`, `conslt_date`, `offer_amount`, `description`, `offer_from`, `offer_from_id`, `clients_id`, `users_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, '2021-10-25 00:00:00', 200.00, ' يجوز للعامل وصاحب العمل إذا نشأ بينهما نزاع يتعلق بتطبيق أحكام قانون العمل المشار إليه أن يعرضا نزاع\r\n هما على إدارة العمل. وتتخذ إدارة العمل الإجراءات اللازمة لتسوية النزاع ودياً. فإذا لم تتم التسوية، و', 'cases', 1, 6, 1, '2021-09-23 10:56:44', '2021-09-23 10:56:46', 1, NULL),
	(5, '2021-10-27 00:00:00', 150.00, 'يجوز للعامل وصاحب العمل إذا نشأ بينهما نزاع يتعلق بتطبيق أحكام قانون العمل المشار إليه أن يعرضا نزاع\n هما على إدارة العمل. وتتخذ إدارة العمل الإجراءات اللازمة لتسوية النزاع ودياً. فإذا لم تتم التسوية، وfff', NULL, NULL, 6, 1, '2021-10-26 20:39:53', '2021-11-06 11:25:00', NULL, NULL);
/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. courts
DROP TABLE IF EXISTS `courts`;
CREATE TABLE IF NOT EXISTS `courts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `court_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `court_type` tinyint(4) DEFAULT NULL COMMENT 'court or circle (0,1)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.courts : ~2 rows (environ)
/*!40000 ALTER TABLE `courts` DISABLE KEYS */;
INSERT INTO `courts` (`id`, `libelle`, `court_num`, `court_type`, `created_at`, `updated_at`) VALUES
	(1, 'محكمة قطر', '548', 0, '2021-10-12 10:10:45', '2021-12-16 15:28:01'),
	(2, 'دائرة الدوحة', '548-1', 1, '2021-10-12 10:11:07', NULL);
/*!40000 ALTER TABLE `courts` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. events
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_allDay` tinyint(4) DEFAULT NULL,
  `recurrence_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_rule` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_exception` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_table` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Case, Consultation, prosecution...',
  `from_table_id` bigint(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT 'Task , appointement // status',
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `textColor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_appointement_tasks_users1_idx` (`user_id`),
  CONSTRAINT `fk_appointement_tasks_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.events : ~4 rows (environ)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `title`, `start_at`, `end_at`, `timezone`, `is_allDay`, `recurrence_id`, `recurrence_rule`, `recurrence_exception`, `from_table`, `from_table_id`, `type`, `color`, `textColor`, `user_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(2, 'gggggggg', '2021-12-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#f7f7f7', 4, '2021-10-01 09:16:58', '2021-12-20 00:57:21', NULL, 7),
	(3, 'جلسة عدد 02', '2021-10-12 11:00:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#e66465', '#f6b73c', 1, '2021-10-01 09:17:04', '2021-09-30 09:17:04', NULL, NULL),
	(8, 'إجتماع مجلس الإدارة', '2021-10-05 12:00:00', '2021-10-01 14:31:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#f7f7f7', 1, '2021-10-01 13:30:44', '2021-10-01 13:30:44', NULL, NULL),
	(16, 'جلسة تجريبية', '2021-10-20 21:04:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#fff', 1, '2021-10-14 16:59:22', '2021-10-14 16:59:22', 1, NULL),
	(17, 'جلسة عدد 03', '2021-11-08 22:57:00', NULL, NULL, NULL, NULL, NULL, NULL, 'sessions', 11, 1, '#7425d4', '#fff', 1, '2021-11-08 21:57:29', '2021-11-03 21:57:29', 1, NULL),
	(18, 'إجتماع مجلس الإدارة', '2021-11-18 10:57:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 12, 1, '#7425d4', '#f7f7f7', 1, '2021-11-18 11:57:50', '2021-11-03 21:57:50', 1, NULL),
	(19, 'جلسة عدد 02', '2021-11-27 10:59:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 13, 1, '#7425d4', '#fff', 1, '2021-11-27 21:58:05', '2021-11-03 21:58:05', 1, NULL),
	(22, 'eeetetet', '2021-11-27 10:53:00', NULL, NULL, NULL, NULL, NULL, NULL, '', 16, 1, '#7425d4', '#fff', 1, '2021-11-08 09:53:26', '2021-11-08 09:53:26', 1, NULL),
	(24, 'تجربة', '2021-11-23 00:00:00', '2021-11-23 23:00:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#f7f7f7', 1, '2021-11-16 21:00:29', '2021-11-16 21:00:29', NULL, NULL),
	(25, 'ZQAFdSDGG', '2021-11-29 22:30:00', '2021-11-30 23:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#f7f7f7', 1, '2021-11-16 21:04:58', '2021-11-16 21:07:58', NULL, NULL),
	(26, 'dfsgwdfgdfgdfgdfg', '2021-11-30 00:00:00', '2021-12-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#f7f7f7', 4, '2021-11-16 21:13:43', '2021-11-16 21:13:43', NULL, NULL),
	(28, 'xxxx', '2021-12-07 00:00:00', '2021-12-08 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#422366', '#f7f7f7', 1, '2021-11-16 22:38:42', '2021-11-16 22:38:42', NULL, NULL),
	(29, 'rrr', '2021-11-18 00:30:00', '2021-11-17 00:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '#7425d4', '#f7f7f7', 1, '2021-11-16 23:30:24', '2021-11-16 23:30:24', NULL, NULL),
	(32, 's<dgsdgdsg', '2021-12-08 01:08:00', NULL, NULL, NULL, NULL, NULL, NULL, 'sessions', 19, NULL, '#7425d4', '#fff', 1, '2021-12-08 00:08:52', '2021-12-08 00:08:52', 1, NULL),
	(36, 'جلسة', '2021-12-08 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'sessions', 23, NULL, '#7425d4', '#fff', 1, '2021-12-08 01:07:29', '2021-12-08 01:25:59', 1, 1),
	(37, 'جلسة تاتست', '2021-12-11 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'sessions', 24, NULL, '#7425d4', '#fff', 1, '2021-12-08 01:11:28', '2021-12-08 01:36:06', 1, 1),
	(38, 's<dgsdgdsg', '2021-12-08 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 'sessions', 25, NULL, '#7425d4', '#fff', 1, '2021-12-08 01:12:11', '2021-12-08 01:12:11', 1, NULL),
	(39, 'shzteyzry', '2021-12-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '#7425d4', '#f7f7f7', 1, '2021-12-20 00:33:52', '2021-12-20 00:33:52', 7, NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. event_docuements
DROP TABLE IF EXISTS `event_docuements`;
CREATE TABLE IF NOT EXISTS `event_docuements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `event_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event_docuements_events1_idx` (`event_id`),
  CONSTRAINT `fk_event_docuements_events1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.event_docuements : ~0 rows (environ)
/*!40000 ALTER TABLE `event_docuements` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_docuements` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. expenses
DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `expense_date` date DEFAULT NULL,
  `expense_amount` decimal(10,2) DEFAULT NULL,
  `expense_libele` varchar(191) DEFAULT NULL,
  `expense_description` text,
  `expense_types_id` bigint(20) NOT NULL,
  `users_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_due_payements_payement_types1_idx` (`expense_types_id`),
  KEY `fk_due_payements_users1_idx` (`users_id`),
  CONSTRAINT `fk_due_payements_payement_types1` FOREIGN KEY (`expense_types_id`) REFERENCES `expense_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_due_payements_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table lawfirm_db.expenses : ~1 rows (environ)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` (`id`, `expense_date`, `expense_amount`, `expense_libele`, `expense_description`, `expense_types_id`, `users_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, '2022-01-01', 120.00, 'راتب', 'راتب فولان', 2, 1, '2021-11-20 11:00:07', NULL, 1, NULL),
	(3, '2022-01-07', 5215.00, 'راتب فولان', 'راتب فولان', 3, NULL, '2022-01-07 17:22:43', '2022-01-07 17:22:43', 14, NULL),
	(4, '2022-01-07', 5215.00, 'راتب فولان', 'راتب فولان', 3, NULL, '2022-01-07 17:23:06', '2022-01-07 17:23:06', 14, NULL),
	(5, '2022-01-08', 200.00, 'راتب فولان', 'راتب فولان', 4, NULL, '2022-01-08 16:33:39', '2022-01-08 16:33:39', 14, NULL),
	(6, '2022-01-08', 245.00, 'fdgqsdfgsqg', 'راتب bgtggzaqeryaezryeary', 5, NULL, '2022-01-08 16:35:00', '2022-01-08 21:30:43', 14, 14),
	(7, '2022-01-08', 20.00, 'eeeee', 'eee', 5, NULL, '2022-01-08 22:10:45', '2022-01-08 22:10:45', 14, NULL);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. expense_payements
DROP TABLE IF EXISTS `expense_payements`;
CREATE TABLE IF NOT EXISTS `expense_payements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `payement_date` date DEFAULT NULL,
  `payement_status_id` bigint(20) DEFAULT NULL COMMENT 'Payement Method (cash,...)',
  `payement_amount` decimal(10,2) DEFAULT NULL,
  `payement_libele` varchar(191) DEFAULT NULL,
  `pay_file_name` varchar(191) DEFAULT NULL,
  `pay_file_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `expenses_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_expense_payements_expenses1_idx` (`expenses_id`),
  CONSTRAINT `fk_expense_payements_expenses1` FOREIGN KEY (`expenses_id`) REFERENCES `expenses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table lawfirm_db.expense_payements : ~0 rows (environ)
/*!40000 ALTER TABLE `expense_payements` DISABLE KEYS */;
INSERT INTO `expense_payements` (`id`, `payement_date`, `payement_status_id`, `payement_amount`, `payement_libele`, `pay_file_name`, `pay_file_path`, `created_at`, `updated_at`, `created_by`, `updated_by`, `expenses_id`) VALUES
	(1, '2021-11-20', 1, 70.00, 'ff', 'fff', 'fff', '2021-11-20 11:40:44', NULL, 1, NULL, 1),
	(2, '2021-11-20', 1, 50.00, 'ff', 'fff', 'fff', '2021-11-20 11:40:44', NULL, 1, NULL, 1);
/*!40000 ALTER TABLE `expense_payements` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. expense_types
DROP TABLE IF EXISTS `expense_types`;
CREATE TABLE IF NOT EXISTS `expense_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table lawfirm_db.expense_types : ~0 rows (environ)
/*!40000 ALTER TABLE `expense_types` DISABLE KEYS */;
INSERT INTO `expense_types` (`id`, `libelle`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(2, 'رواتب الموظفين', '2021-11-01 13:44:16', '2021-11-01 13:44:16', NULL, NULL),
	(3, 'دفعات من قبل المحامي', '2021-11-01 13:48:26', '2021-11-01 13:48:26', NULL, NULL),
	(4, 'دفعات من قبل المكتب', '2021-11-01 13:48:41', '2021-11-01 13:48:41', NULL, NULL),
	(5, 'مصروفات الضيافة', '2021-11-01 14:00:24', '2021-11-01 14:00:24', NULL, NULL),
	(8, 'مصروفات الضيافة1', '2022-01-07 12:07:43', '2022-01-07 12:07:43', 14, NULL);
/*!40000 ALTER TABLE `expense_types` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. incomes
DROP TABLE IF EXISTS `incomes`;
CREATE TABLE IF NOT EXISTS `incomes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `payement_date` timestamp NULL DEFAULT NULL,
  `revenue_from_table` varchar(45) DEFAULT NULL,
  `incomes_from_id` bigint(20) DEFAULT NULL,
  `offer_id` bigint(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `clients_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table lawfirm_db.incomes : ~1 rows (environ)
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` (`id`, `payement_date`, `revenue_from_table`, `incomes_from_id`, `offer_id`, `amount`, `clients_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(7, '2021-11-23 21:41:22', 'cases', 1, 3, 140.00, 6, '2021-11-23 21:38:37', '2021-11-23 21:48:57', 1, 1);
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. legal_links
DROP TABLE IF EXISTS `legal_links`;
CREATE TABLE IF NOT EXISTS `legal_links` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.legal_links : ~2 rows (environ)
/*!40000 ALTER TABLE `legal_links` DISABLE KEYS */;
INSERT INTO `legal_links` (`id`, `libelle`, `description`, `url`, `created_at`, `updated_at`) VALUES
	(3, 'عقد قضية', 'عقد أساسي للتعديل1', 'app/documents/legal_links/legal_doc_1640772758.png', '2021-12-28 16:04:49', '2021-12-29 10:12:38');
/*!40000 ALTER TABLE `legal_links` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.migrations : ~60 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_08_19_000000_create_failed_jobs_table', 1),
	(2, '2021_09_03_172114_create_case_docuements_table', 1),
	(3, '2021_09_03_172114_create_case_parties_table', 1),
	(4, '2021_09_03_172114_create_case_sessions_table', 1),
	(5, '2021_09_03_172114_create_case_status_table', 1),
	(6, '2021_09_03_172114_create_case_types_table', 1),
	(7, '2021_09_03_172114_create_cases_table', 1),
	(8, '2021_09_03_172114_create_client_offers_table', 1),
	(9, '2021_09_03_172114_create_client_types_table', 1),
	(10, '2021_09_03_172114_create_clients_table', 1),
	(12, '2021_09_03_172114_create_consultations_table', 1),
	(13, '2021_09_03_172114_create_courts_table', 1),
	(15, '2021_09_03_172114_create_event_docuements_table', 1),
	(16, '2021_09_03_172114_create_events_table', 1),
	(17, '2021_09_03_172114_create_legal_links_table', 1),
	(18, '2021_09_03_172114_create_password_resets_table', 1),
	(19, '2021_09_03_172114_create_payement_status_table', 1),
	(21, '2021_09_03_172114_create_permission_tables', 1),
	(22, '2021_09_03_172114_create_poa_parties_table', 1),
	(23, '2021_09_03_172114_create_poas_table', 1),
	(24, '2021_09_03_172114_create_pris_table', 1),
	(25, '2021_09_03_172114_create_prosecution_docuements_table', 1),
	(26, '2021_09_03_172114_create_prosecution_parties_table', 1),
	(27, '2021_09_03_172114_create_prosecution_status_table', 1),
	(28, '2021_09_03_172114_create_prosecutions_table', 1),
	(29, '2021_09_03_172114_create_session_docuements_table', 1),
	(30, '2021_09_03_172114_create_session_status_table', 1),
	(31, '2021_09_03_172114_create_settings_table', 1),
	(32, '2021_09_03_172114_create_user_docuements_table', 1),
	(33, '2021_09_03_172114_create_users_table', 1),
	(34, '2021_09_03_172119_add_foreign_keys_to_case_docuements_table', 1),
	(35, '2021_09_03_172119_add_foreign_keys_to_case_parties_table', 1),
	(36, '2021_09_03_172119_add_foreign_keys_to_case_sessions_table', 1),
	(37, '2021_09_03_172119_add_foreign_keys_to_cases_table', 1),
	(38, '2021_09_03_172119_add_foreign_keys_to_client_offers_table', 1),
	(40, '2021_09_03_172119_add_foreign_keys_to_consultations_table', 1),
	(42, '2021_09_03_172119_add_foreign_keys_to_event_docuements_table', 1),
	(43, '2021_09_03_172119_add_foreign_keys_to_events_table', 1),
	(44, '2021_09_03_172119_add_foreign_keys_to_poa_parties_table', 1),
	(45, '2021_09_03_172119_add_foreign_keys_to_poas_table', 1),
	(46, '2021_09_03_172119_add_foreign_keys_to_prosecution_docuements_table', 1),
	(47, '2021_09_03_172119_add_foreign_keys_to_prosecution_parties_table', 1),
	(48, '2021_09_03_172119_add_foreign_keys_to_prosecutions_table', 1),
	(49, '2021_09_03_172119_add_foreign_keys_to_session_docuements_table', 1),
	(50, '2021_09_03_172119_add_foreign_keys_to_user_docuements_table', 1),
	(52, '2019_09_22_192348_create_messages_table', 2),
	(53, '2019_10_16_211433_create_favorites_table', 2),
	(54, '2019_10_18_223259_add_avatar_to_users', 2),
	(55, '2019_10_20_211056_add_messenger_color_to_users', 2),
	(56, '2019_10_22_000539_add_dark_mode_to_users', 2),
	(57, '2019_10_25_214038_add_active_status_to_users', 2),
	(58, '2021_10_19_104047_create_expense_types_table', 3),
	(60, '2021_10_19_104047_create_incomes_table', 3),
	(61, '2021_10_19_104047_create_client_payements_table', 3),
	(63, '2021_10_19_104048_add_foreign_keys_to_client_payements_table', 3),
	(65, '2021_10_19_104456_create_expenses_table', 3),
	(66, '2021_10_19_104456_create_expense_payements_table', 3),
	(67, '2021_10_19_104457_add_foreign_keys_to_expenses_table', 3),
	(68, '2021_10_19_104457_add_foreign_keys_to_expense_payements_table', 3),
	(69, '2021_12_09_013014_create_notifs_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.model_has_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.model_has_roles : ~2 rows (environ)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(6, 'App\\Models\\User', 14);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. notifs
DROP TABLE IF EXISTS `notifs`;
CREATE TABLE IF NOT EXISTS `notifs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notif_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notif_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_table` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_table_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 : unread, 1:read, 2:archived',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.notifs : ~0 rows (environ)
/*!40000 ALTER TABLE `notifs` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifs` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.password_resets : ~1 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('echedli1@gmail.com', '$2y$10$np1/kGgKjZr6hx8uSqiKHeX0XSdj/BqvfPdpp1UYSwZcEovXAO3Ky', '2022-01-18 14:50:32');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. payement_status
DROP TABLE IF EXISTS `payement_status`;
CREATE TABLE IF NOT EXISTS `payement_status` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.payement_status : ~0 rows (environ)
/*!40000 ALTER TABLE `payement_status` DISABLE KEYS */;
INSERT INTO `payement_status` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(1, 'كاش', '2022-01-16 23:25:42', '2022-01-16 23:25:43');
/*!40000 ALTER TABLE `payement_status` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. payement_types
DROP TABLE IF EXISTS `payement_types`;
CREATE TABLE IF NOT EXISTS `payement_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.payement_types : ~0 rows (environ)
/*!40000 ALTER TABLE `payement_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `payement_types` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `name_en`, `name_ar`, `guard_name`, `table_name_en`, `table_name_ar`, `created_at`, `updated_at`) VALUES
	(86, 'dashboard-list', 'Dashboard', 'الرئيسية', 'web', 'Dashboard', 'الرئيسية', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(87, 'appointement-list', 'Dashboard - Events', ' الإطلاع على المواعيد', 'web', 'Dashboard', 'الرئيسية', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(88, 'statistic-list', 'Dashboard', 'الإطلاع على الإحصائيات', 'web', 'Dashboard', 'الرئيسية', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(89, 'client-list', 'Client List', 'قائمة العملاء', 'web', 'ِClients', 'العملاء', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(90, 'client-view', 'Client view', 'عرض تفاصيل عميل', 'web', 'ِClients', 'العملاء', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(91, 'client-create', 'Client Create', 'إضافة عميل', 'web', 'ِClients', 'العملاء', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(92, 'client-edit', 'Client Edit', 'تعديل عميل', 'web', 'ِClients', 'العملاء', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(93, 'client-delete', 'Client Delete', 'حذف عميل', 'web', 'ِClients', 'العملاء', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(94, 'client-offer-list', 'Client offers List', 'قائمة عروض الاتعاب', 'web', 'ِِClient offers', 'عروض الأتعاب', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(95, 'client-offer-create', 'Client offers List', 'إضافة عروض الاتعاب', 'web', 'ِِClient offers', 'عروض الأتعاب', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(96, 'client-offer-edit', 'Client offers Edit', 'تعديل عرض الاتعاب', 'web', 'Client offers', 'عروض الأتعاب', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(97, 'client-offer-delete', 'Client offers Delete', 'حذف عروض الاتعاب', 'web', 'Client offers', 'عروض الأتعاب', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(98, 'consultation-list', 'Consultations List', 'قائمة الإستشارات', 'web', 'Consultations', 'الإستشارات', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(99, 'consultation-view', 'Consultations View', ' عرض تفاصيل الإستشارة', 'web', 'Consultations', 'الإستشارات', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(100, 'consultation-create', 'Client offers Create', 'إضافة إستشارة', 'web', 'Consultations', 'الإستشارات', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(101, 'consultation-edit', 'Client offers Edit', 'تعديل إستشارة', 'web', 'Consultations', 'الإستشارات', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(102, 'consultation-delete', 'Client offers Delete', 'حذف إستشارة', 'web', 'Consultations', 'الإستشارات', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(103, 'poa-list', 'Power Of Attorney List', 'قائمة التوكيلات', 'web', 'Power Of Attorney', 'الوكالة', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(104, 'poa-view', 'Power Of Attorney View', ' عرض تفاصيل الوكالة', 'web', 'Power Of Attorney', 'الوكالة', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(105, 'poa-create', 'Power Of Attorney Create', 'إضافة وكالة', 'web', 'Power Of Attorney', 'الوكالة', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(106, 'poa-edit', 'Power Of Attorney Edit', 'تعديل وكالة', 'web', 'Power Of Attorney', 'الوكالة', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(107, 'poa-delete', 'Power Of Attorney Delete', 'حذف وكالة', 'web', 'Power Of Attorney', 'الوكالة', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(108, 'contract-list', 'Standard Contracts List', 'قائمة العقود الأساسية', 'web', 'Standard Contracts', 'العقود الأساسية للتعديل', '2022-01-04 09:51:34', '2022-01-04 09:51:34'),
	(109, 'contract-view', 'Standard Contracts View', ' عرض تفاصيل العقود الأساسية', 'web', 'Standard Contracts', 'العقود الأساسية للتعديل', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(110, 'contract-create', 'Standard Contracts Create', 'إضافة عقد أساسي للتعديل', 'web', 'Standard Contracts', 'العقود الأساسية للتعديل', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(111, 'contract-edit', 'Standard Contracts Edit', 'تعديل عقد أساسي', 'web', 'Standard Contracts', 'العقود الأساسية للتعديل', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(112, 'contract-delete', 'Standard Contracts Delete', 'حذف عقد أساسي للتعديل', 'web', 'Standard Contracts', 'العقود الأساسية للتعديل', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(113, 'case-list', 'Case List', 'قائمة القضايا', 'web', 'ِCase', 'القضايا', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(114, 'case-view', 'Case View', ' عرض تفاصيل القضايا', 'web', 'ِCase', 'القضايا', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(115, 'case-create', 'Case Create', 'إضافة القضايا', 'web', 'ِCase', 'القضايا', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(116, 'case-edit', 'Case Edit', 'تعديل القضايا', 'web', 'ِCase', 'القضايا', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(117, 'case-delete', 'Case Delete', 'حذف القضايا', 'web', 'ِCase Types', 'القضايا', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(118, 'prosecution-list', 'Prosecution List', 'قائمة النيابة العامة', 'web', 'Prosecution', 'النيابة العامة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(119, 'prosecution-view', 'Prosecution View', ' عرض تفاصيل النيابة العامة', 'web', 'Prosecution', 'النيابة العامة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(120, 'prosecution-create', 'Prosecution Create', 'إضافة النيابة العامة', 'web', 'Prosecution', 'النيابة العامة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(121, 'prosecution-edit', 'Prosecution Edit', 'تعديل النيابة العامة', 'web', 'Prosecution', 'النيابة العامة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(122, 'prosecution-delete', 'Prosecution Delete', 'حذف النيابة العامة', 'web', 'Prosecution', 'النيابة العامة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(123, 'expense-list', 'Expense List', 'قائمة المصروفات المستحقة', 'web', 'Expenses', 'المصروفات المستحقة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(124, 'expense-create', 'Expense Create', 'إضافة المصروفات المستحقة', 'web', 'Expenses', 'المصروفات المستحقة', '2022-01-04 09:51:35', '2022-01-04 09:51:35'),
	(125, 'expense-edit', 'Expense Edit', 'تعديل المصروفات المستحقة', 'web', 'Expenses', 'المصروفات المستحقة', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(126, 'expense-delete', 'Expense Delete', 'حذف المصروفات المستحقة', 'web', 'Expenses', 'المصروفات المستحقة', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(127, 'expense-payement-list', 'Expense payement List', 'قائمة المصروفات المنجزة', 'web', 'Expenses payement', 'المصروفات المنجزة', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(128, 'expense-payement-create', 'Expense payement Create', 'إضافة المصروفات المنجزة', 'web', 'Expenses payement', 'المصروفات المنجزة', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(129, 'expense-payement-edit', 'Expense payement Edit', 'تعديل المصروفات المنجزة', 'web', 'Expenses payement', 'المصروفات المنجزة', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(130, 'expense-payement-delete', 'Expense payement Delete', 'حذف المصروفات المنجزة', 'web', 'Expenses payement', 'المصروفات المنجزة', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(131, 'expense-type-list', 'Expense type List', 'قائمة أقسام المصروفات', 'web', 'Expenses type', 'أقسام المصروفات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(132, 'expense-type-create', 'Expense type Create', 'إضافة أقسام المصروفات', 'web', 'Expenses type', 'أقسام المصروفات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(133, 'expense-type-edit', 'Expense type Edit', 'تعديل أقسام المصروفات', 'web', 'Expenses type', 'أقسام المصروفات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(134, 'expense-type-delete', 'Expense type Delete', 'حذف أقسام المصروفات', 'web', 'Expenses type', 'أقسام المصروفات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(135, 'client-payement-list', 'Client payement List', 'قائمة المدفوعات', 'web', 'Expenses type', 'المدفوعات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(136, 'client-payement-create', 'Client payement Create', 'إضافة المدفوعات', 'web', 'Expenses type', 'المدفوعات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(137, 'client-payement-edit', 'Client payement Edit', 'تعديل المدفوعات', 'web', 'Expenses type', 'المدفوعات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(138, 'client-payement-delete', 'Client payement Delete', 'حذف المدفوعات', 'web', 'Expenses type', 'المدفوعات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(139, 'event-list', 'EventS Control', 'التحكم في المواعيد', 'web', 'Events', 'المواعيد', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(140, 'settings-general', 'Settings Control', 'إعدادات النظام', 'web', 'Settings', 'التحكم في في منطقة الإعدادات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(141, 'settings-update', 'Settings Control', 'ظبط إعدادات النظام', 'web', 'Settings', 'إعدادات النظام', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(142, 'user-list', 'User List', 'قائمة المستخدمين', 'web', 'Users', 'المستخدمين', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(143, 'user-view', 'User View', ' عرض تفاصيل المستخدم', 'web', 'Users', 'المستخدمين', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(144, 'user-create', 'User Create', 'إضافة المستخدمين', 'web', 'Users', 'المستخدمين', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(145, 'user-edit', 'User Edit', 'تعديل المستخدمين', 'web', 'Users', 'المستخدمين', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(146, 'user-delete', 'User Delete', 'حذف المستخدمين', 'web', 'Users', 'المستخدمين', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(147, 'role-list', 'Role List', 'قائمة الصلاحيات', 'web', 'Roles', 'الصلاحيات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(148, 'role-create', 'Role create', 'إضافة صلاحيات', 'web', 'Roles', 'الصلاحيات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(149, 'role-edit', 'Role Edit', 'تعديل الصلاحيات', 'web', 'Roles', 'الصلاحيات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(150, 'role-delete', 'Role Delete', 'حذف الصلاحيات', 'web', 'Roles', 'الصلاحيات', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(151, 'case-type-list', 'Case Type List', 'قائمة أنواع القضايا', 'web', 'Case Types', 'إعدادات القضايا', '2022-01-04 09:51:36', '2022-01-04 09:51:36'),
	(152, 'case-type-create', 'Case Type Create', 'إضافة أنواع القضايا', 'web', 'Case Types', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(153, 'case-type-edit', 'Case Type Edit', 'تعديل أنواع القضايا', 'web', 'Case Types', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(154, 'case-type-delete', 'Case Type Delete', 'حذف أنواع القضايا', 'web', 'Case Types', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(155, 'case-status-list', 'Case Status List', 'قائمة حالات القضايا', 'web', 'ِCase Types', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(156, 'case-status-create', 'Case Status Create', 'إضافة حالات القضايا', 'web', 'ِCase Status', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(157, 'case-status-edit', 'Case Status Edit', 'تعديل حالات القضايا', 'web', 'ِCase Status', 'إعدادات  القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(158, 'case-status-delete', 'Case Status Delete', 'حذف حالات القضايا', 'web', 'ِCase Status', ' إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(159, 'case-stage-list', 'Case stage List', 'قائمة مراحل التقاضي', 'web', 'Case Types', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(160, 'case-stage-create', 'Case stage Create', 'إضافة مراحل التقاضي', 'web', 'Case stage', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(161, 'case-stage-edit', 'Case stage Edit', 'تعديل مراحل التقاضي', 'web', 'ِCase stage', 'إعدادات  القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(162, 'case-stage-delete', 'Case stage Delete', 'حذف مراحل التقاضي', 'web', 'ِCase stage', ' إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(163, 'court-list', 'Court/Circle List', 'قائمة محكمة/دائرة', 'web', 'Case Types', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(164, 'court-create', 'Court/Circle Create', 'إضافة محكمة/دائرة', 'web', 'Court/Circle', 'إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(165, 'court-edit', 'Court/Circle Edit', 'تعديل محكمة/دائرة', 'web', 'ِCourt/Circle', 'إعدادات  القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(166, 'court-delete', 'Court/Circle Delete', 'حذف محكمة/دائرة', 'web', 'ِCourt/Circle', ' إعدادات القضايا', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(167, 'client-type-list', 'Client Type List', 'قائمة أنواع العملاء', 'web', 'ِClients Types', 'إعدادات العملاء', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(168, 'client-type-create', 'Client Type Create', 'إضافة أنواع العملاء', 'web', 'ِClients Types', 'إعدادات العملاء', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(169, 'client-type-edit', 'Client Type Edit', 'تعديل أنواع العملاء', 'web', 'ِClients Types', 'إعدادات العملاء', '2022-01-04 09:51:37', '2022-01-04 09:51:37'),
	(170, 'client-type-delete', 'Client Type Delete', 'حذف أنواع العملاء', 'web', 'ِClients Types', 'إعدادات العملاء', '2022-01-04 09:51:37', '2022-01-04 09:51:37');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. poas
DROP TABLE IF EXISTS `poas`;
CREATE TABLE IF NOT EXISTS `poas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Power Of Attorney',
  `poa_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poa_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poa_type` tinyint(4) DEFAULT NULL COMMENT 'Limited POA, General',
  `poa_expiry_date` date DEFAULT NULL,
  `poa_file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poa_file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `clients_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_poas_clients1_idx` (`clients_id`) USING BTREE,
  CONSTRAINT `fk_poas_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.poas : ~2 rows (environ)
/*!40000 ALTER TABLE `poas` DISABLE KEYS */;
INSERT INTO `poas` (`id`, `poa_title`, `poa_code`, `poa_type`, `poa_expiry_date`, `poa_file_name`, `poa_file_path`, `created_at`, `updated_at`, `created_by`, `updated_by`, `clients_id`) VALUES
	(3, '1POA TITLEwwfwfsf', 'POA00001/2021', 0, '2021-12-14', 'ttytytytytytytytytyyt', 'app/documents/poa_docuements/15/poa_doc_1638836704.png', '2021-12-07 00:25:04', '2021-12-07 00:25:04', 1, 1, 15),
	(4, 'QSfdqsdqsdqsd', 'POA00002/2021', 1, '2021-12-23', 'ssssss', 'app/documents/poa_docuements/15/poa_doc_1639665263.pdf', '2021-12-16 14:34:23', '2021-12-16 14:34:23', 1, 1, 15),
	(5, 'dfQERazerfeazrf', 'POA00003/2021', 0, '2021-12-30', 'eeeeeee', 'app/documents/poa_docuements/6/poa_doc_1639665350.pdf', '2021-12-16 14:35:50', '2021-12-16 14:35:50', 1, 1, 6);
/*!40000 ALTER TABLE `poas` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. poa_parties
DROP TABLE IF EXISTS `poa_parties`;
CREATE TABLE IF NOT EXISTS `poa_parties` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `client_type_id` bigint(20) DEFAULT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_details` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_party` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `poas_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_poa_parties_poas1_idx` (`poas_id`),
  CONSTRAINT `fk_poa_parties_poas1` FOREIGN KEY (`poas_id`) REFERENCES `poas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.poa_parties : ~0 rows (environ)
/*!40000 ALTER TABLE `poa_parties` DISABLE KEYS */;
/*!40000 ALTER TABLE `poa_parties` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. pris
DROP TABLE IF EXISTS `pris`;
CREATE TABLE IF NOT EXISTS `pris` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Public relation informations',
  `pr_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_mail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_adress` text COLLATE utf8mb4_unicode_ci,
  `pr_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pr_description` text COLLATE utf8mb4_unicode_ci,
  `pr_client_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.pris : ~0 rows (environ)
/*!40000 ALTER TABLE `pris` DISABLE KEYS */;
INSERT INTO `pris` (`id`, `pr_name`, `pr_phone`, `pr_mail`, `pr_adress`, `pr_num`, `pr_position`, `pr_description`, `pr_client_id`, `created_at`, `updated_at`) VALUES
	(1, 'ElhajAli Dhaou', '94740770', 'cdfdhajali@gmail.com', 'gggggkikkkkkk', 'ggggg', 'gggg', 'gggggkikkkkkk', 1, '2021-11-10 11:14:22', '2021-12-06 17:52:54'),
	(2, 'jiujuj', 'jjj', 'cdfdhaja1li@gmail.com', NULL, NULL, NULL, NULL, 16, '2021-12-29 23:59:15', '2021-12-29 23:59:15');
/*!40000 ALTER TABLE `pris` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. prosecutions
DROP TABLE IF EXISTS `prosecutions`;
CREATE TABLE IF NOT EXISTS `prosecutions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `submission_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `court_id` bigint(20) DEFAULT NULL,
  `court_date` date DEFAULT NULL,
  `prosec_status_id` bigint(20) NOT NULL,
  `prosec_type` bigint(20) NOT NULL,
  `case_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clients_id` bigint(20) unsigned NOT NULL,
  `client_type_id` bigint(20) NOT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prosecutions_clients1_idx` (`clients_id`),
  KEY `fk_prosecutions_users1_idx` (`users_id`),
  CONSTRAINT `fk_prosecutions_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prosecutions_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.prosecutions : ~0 rows (environ)
/*!40000 ALTER TABLE `prosecutions` DISABLE KEYS */;
/*!40000 ALTER TABLE `prosecutions` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. prosecution_docuements
DROP TABLE IF EXISTS `prosecution_docuements`;
CREATE TABLE IF NOT EXISTS `prosecution_docuements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prosecutions_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prosecution_docuements_prosecutions1_idx` (`prosecutions_id`),
  CONSTRAINT `fk_prosecution_docuements_prosecutions1` FOREIGN KEY (`prosecutions_id`) REFERENCES `prosecutions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.prosecution_docuements : ~0 rows (environ)
/*!40000 ALTER TABLE `prosecution_docuements` DISABLE KEYS */;
/*!40000 ALTER TABLE `prosecution_docuements` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. prosecution_parties
DROP TABLE IF EXISTS `prosecution_parties`;
CREATE TABLE IF NOT EXISTS `prosecution_parties` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `client_type_id` bigint(20) DEFAULT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_details` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prosecutions_id` bigint(20) NOT NULL,
  `client_party` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prosecution_parties_prosecutions1_idx` (`prosecutions_id`),
  CONSTRAINT `fk_prosecution_parties_prosecutions1` FOREIGN KEY (`prosecutions_id`) REFERENCES `prosecutions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.prosecution_parties : ~0 rows (environ)
/*!40000 ALTER TABLE `prosecution_parties` DISABLE KEYS */;
/*!40000 ALTER TABLE `prosecution_parties` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. prosecution_status
DROP TABLE IF EXISTS `prosecution_status`;
CREATE TABLE IF NOT EXISTS `prosecution_status` (
  `id` int(11) NOT NULL,
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfert_case` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.prosecution_status : ~0 rows (environ)
/*!40000 ALTER TABLE `prosecution_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `prosecution_status` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.roles : ~0 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `name_ar`, `guard_name`, `created_at`, `updated_at`) VALUES
	(2, 'Lawyer', 'محامي', 'web', '2021-11-08 22:49:22', '2021-11-08 22:49:22'),
	(6, 'chairman', 'مشرف عام', 'web', '2022-01-04 11:24:59', '2022-01-04 11:24:59');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.role_has_permissions : ~85 rows (environ)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(86, 6),
	(87, 6),
	(88, 6),
	(89, 6),
	(90, 6),
	(91, 6),
	(92, 6),
	(93, 6),
	(94, 6),
	(95, 6),
	(96, 6),
	(97, 6),
	(98, 6),
	(99, 6),
	(100, 6),
	(101, 6),
	(102, 6),
	(103, 6),
	(104, 6),
	(105, 6),
	(106, 6),
	(107, 6),
	(108, 6),
	(109, 6),
	(110, 6),
	(111, 6),
	(112, 6),
	(113, 6),
	(114, 6),
	(115, 6),
	(116, 6),
	(117, 6),
	(118, 6),
	(119, 6),
	(120, 6),
	(121, 6),
	(122, 6),
	(123, 6),
	(124, 6),
	(125, 6),
	(126, 6),
	(127, 6),
	(128, 6),
	(129, 6),
	(130, 6),
	(131, 6),
	(132, 6),
	(133, 6),
	(134, 6),
	(135, 6),
	(136, 6),
	(137, 6),
	(138, 6),
	(139, 6),
	(140, 6),
	(141, 6),
	(142, 6),
	(143, 6),
	(144, 6),
	(145, 6),
	(146, 6),
	(147, 6),
	(148, 6),
	(149, 6),
	(150, 6),
	(151, 6),
	(152, 6),
	(153, 6),
	(154, 6),
	(155, 6),
	(156, 6),
	(157, 6),
	(158, 6),
	(159, 6),
	(160, 6),
	(161, 6),
	(162, 6),
	(163, 6),
	(164, 6),
	(165, 6),
	(166, 6),
	(167, 6),
	(168, 6),
	(169, 6),
	(170, 6);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. session_docuements
DROP TABLE IF EXISTS `session_docuements`;
CREATE TABLE IF NOT EXISTS `session_docuements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provided_other_party` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `case_sessions_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_docuements_case_sessions1_idx` (`case_sessions_id`),
  CONSTRAINT `fk_session_docuements_case_sessions1` FOREIGN KEY (`case_sessions_id`) REFERENCES `case_sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.session_docuements : ~0 rows (environ)
/*!40000 ALTER TABLE `session_docuements` DISABLE KEYS */;
INSERT INTO `session_docuements` (`id`, `file_name`, `path`, `provided_other_party`, `created_at`, `updated_at`, `created_by`, `updated_by`, `case_sessions_id`) VALUES
	(1, 'fsdgsfgsg', 'app/documents/case_documents/3//case_doc_1636365243.png', NULL, '2021-12-08 02:58:44', '2021-12-08 02:58:45', 1, NULL, 16),
	(2, 'QDQQDQDQD', 'app/documents/case_documents//3/session_doc_1639012198.png', NULL, '2021-12-09 01:09:58', '2021-12-09 01:09:58', 1, NULL, 3),
	(3, 'ssssss', 'app/documents/case_documents/1/3/session_doc_1639012586.png', NULL, '2021-12-09 01:16:26', '2021-12-09 01:16:26', 1, NULL, 3);
/*!40000 ALTER TABLE `session_docuements` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. session_status
DROP TABLE IF EXISTS `session_status`;
CREATE TABLE IF NOT EXISTS `session_status` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `libelle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.session_status : ~3 rows (environ)
/*!40000 ALTER TABLE `session_status` DISABLE KEYS */;
INSERT INTO `session_status` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
	(1, 'مؤجلة', '2021-10-14 13:37:06', '2021-10-14 13:37:07'),
	(2, 'منتهية', '2021-10-14 13:37:28', NULL),
	(3, 'نشطة', '2021-10-14 23:07:09', NULL);
/*!40000 ALTER TABLE `session_status` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cp_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_page_header` text COLLATE utf8mb4_unicode_ci,
  `cp_registration` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_tax` int(11) DEFAULT NULL,
  `cp_page_footer` text COLLATE utf8mb4_unicode_ci,
  `cp_image_footer` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_image_header` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_adress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_contact` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_website` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_head_customer_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_text_customer_account` text COLLATE utf8mb4_unicode_ci,
  `calendar_default_view` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hidden_days` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calendar_min_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calendar_max_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filter_event_per_user` tinyint(4) DEFAULT NULL,
  `seo_meta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.settings : ~0 rows (environ)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `cp_name`, `cp_logo`, `cp_page_header`, `cp_registration`, `cp_tax`, `cp_page_footer`, `cp_image_footer`, `cp_image_header`, `cp_email`, `cp_adress`, `cp_contact`, `cp_website`, `email_head_customer_account`, `email_text_customer_account`, `calendar_default_view`, `hidden_days`, `calendar_min_time`, `calendar_max_time`, `filter_event_per_user`, `seo_meta`, `seo_keywords`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'month', '4,5', '08:00:00', '18:30:00', NULL, 'Legal Aid-Law Firm System', 'Legal,Aid, Quatar', '2022-01-19 00:47:03', NULL, NULL, NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` text COLLATE utf8mb4_unicode_ci,
  `phone_num` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qin` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `user_type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `messenger_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `qin_UNIQUE` (`qin`),
  UNIQUE KEY `passport_UNIQUE` (`passport`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.users : ~3 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `full_name`, `email`, `password`, `adress`, `phone_num`, `qin`, `passport`, `active`, `user_type`, `start_date`, `end_date`, `description`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `created_by`, `updated_by`, `avatar`, `messenger_color`, `dark_mode`, `active_status`) VALUES
	(1, 'fffff', 'ffff', 'echedli2@gmail.com', '$2y$10$Wvi2SmrCwzqojb.j/QUj4.VFgwlEZsWne4HjORLh6of0PRyC.0Mle', '', '94740770', '123', '123', 1, 'lawyer', '2021-12-17', '2021-12-17', 'xcxcbxb', NULL, 'wFy8QTcT7m78cLci3ZLH3NdkNQnSkNDteR7hUuuUr7zE2qpdI4qFsw1AP0Cq', '2021-09-07 11:44:24', '2021-12-17 11:44:17', NULL, 1, 'ffc83d67-d41b-4f8e-8f86-9cfffd38cf4d.png', '#2196F3', 1, 0),
	(4, 'ايمان سالم', 'fffffff', 'cdfdhajali@gmail.com', '$2y$10$QDs3pyNA6RIyBMx8ogP1aepmqXL9Cu5fpwiD2.lqV0RQ9Qps33hmO', 'ssssssss', '94740770', '09966822', '147852', 1, 'chairman', '2021-11-08', '2021-11-08', 'sssssssssssssssssssssssssssssss', NULL, NULL, '2021-11-08 21:47:25', '2021-11-08 22:39:22', 1, 1, 'avatar.png', '#2180f3', 0, 0),
	(14, 'السيدة شهد لوباني', 'السيدة شهد لوباني', 'echedli1@gmail.com', '$2y$10$LcGssuzgF1hMmUilCZnFLez/4WQQqXQDe.PWOcisyzin6WU5jV5wu', NULL, NULL, NULL, NULL, 1, 'chairman', NULL, NULL, NULL, NULL, 'D3wejEjKeDuevbyOX9ot0SnsJlRWNpSVAzwY1vLI8mEWwyFgwRdQvvm75951', '2022-01-04 11:24:59', '2022-01-04 11:24:59', NULL, 14, 'avatar.png', '#2180f3', 0, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table lawfirm_db. user_docuements
DROP TABLE IF EXISTS `user_docuements`;
CREATE TABLE IF NOT EXISTS `user_docuements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_docuements_users1_idx` (`user_id`),
  CONSTRAINT `fk_user_docuements_users10` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table lawfirm_db.user_docuements : ~0 rows (environ)
/*!40000 ALTER TABLE `user_docuements` DISABLE KEYS */;
INSERT INTO `user_docuements` (`id`, `file_name`, `path`, `created_at`, `updated_at`, `user_id`, `created_by`, `updated_by`) VALUES
	(1, '1632866748.png', 'file', '2021-09-28 22:05:48', '2021-09-28 22:05:48', 1, NULL, NULL),
	(2, '1632866885.png', 'file', '2021-09-28 22:08:05', '2021-09-28 22:08:05', 1, NULL, NULL),
	(3, '1632866950.png', 'user_documents/1', '2021-09-28 22:09:10', '2021-09-28 22:09:10', 1, NULL, NULL),
	(4, '1632867384.png', 'user_documents/1', '2021-09-28 22:16:24', '2021-09-28 22:16:24', 1, NULL, NULL),
	(5, '1632867412.png', 'user_documents/1', '2021-09-28 22:16:52', '2021-09-28 22:16:52', 1, NULL, NULL),
	(6, '1632868450.txt', 'user_documents/1', '2021-09-28 22:34:10', '2021-09-28 22:34:10', 1, NULL, NULL),
	(7, '1632869055.txt', 'user_documents/1', '2021-09-28 22:44:15', '2021-09-28 22:44:15', 1, NULL, NULL),
	(8, '1632904747.png', 'user_documents/1', '2021-09-29 08:39:07', '2021-09-29 08:39:07', 1, NULL, NULL);
/*!40000 ALTER TABLE `user_docuements` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
