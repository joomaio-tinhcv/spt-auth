-- Adminer 4.8.1 MySQL 8.0.34 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `auth_posts`;
CREATE TABLE `auth_posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int unsigned NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_posts` (`id`, `title`, `description`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1,	'test 1',	'Test 1',	'2024-06-08 17:20:59',	1,	'2024-06-08 17:20:59',	1),
(2,	'test 2',	'Test 2',	'2024-06-08 17:21:34',	1,	'2024-06-08 17:21:34',	1),
(3,	'test 3',	'Test 3',	'2024-06-08 17:29:01',	2,	'2024-06-08 17:29:01',	2);

DROP TABLE IF EXISTS `auth_spt_sessions`;
CREATE TABLE `auth_spt_sessions` (
  `session_id` varbinary(192) NOT NULL,
  `created_at` int unsigned NOT NULL,
  `modified_at` int unsigned NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `auth_user_groups`;
CREATE TABLE `auth_user_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` tinyint unsigned NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_user_groups` (`id`, `name`, `description`, `access`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1,	'Super',	'Super Group',	'[\"user_manager\",\"user_read\",\"user_create\",\"user_update\",\"user_delete\",\"user_profile\",\"usergroup_manager\",\"usergroup_read\",\"usergroup_create\",\"usergroup_update\",\"usergroup_delete\",\"post_manager\"]',	1,	'2023-10-29 11:35:07',	0,	'2024-06-08 17:13:11',	1),
(2,	'Creator',	'',	'[\"post_creator\"]',	1,	'2024-06-08 17:26:14',	1,	'2024-06-08 17:26:14',	1);

DROP TABLE IF EXISTS `auth_user_usergroup_map`;
CREATE TABLE `auth_user_usergroup_map` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `group_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_user_usergroup_map` (`id`, `user_id`, `group_id`) VALUES
(1,	1,	1),
(2,	2,	2);

DROP TABLE IF EXISTS `auth_users`;
CREATE TABLE `auth_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int unsigned NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_users` (`id`, `name`, `username`, `password`, `email`, `access_token`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1,	'Administrator',	'admin',	'4297f44b13955235245b2497399d7a93',	'admin@g.com',	'2ieDh4IfHERrlygqb8K3REbKDhPUPYSMjyQz0wQCOq4koGOOmcilb96xgWjceI55',	1,	'2023-10-29 11:35:07',	0,	'2023-10-29 11:35:07',	0),
(2,	'creator',	'tester1',	'4297f44b13955235245b2497399d7a93',	'test1@t.t',	'',	1,	'2024-06-08 17:26:40',	1,	'2024-06-08 17:26:40',	1);

-- 2024-06-08 17:41:45
