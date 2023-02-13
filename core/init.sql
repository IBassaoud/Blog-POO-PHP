CREATE DATABASE IF NOT EXISTS `blog_db`;

USE `blog_db`;

CREATE TABLE IF NOT EXISTS `USERS` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `prenom_user` varchar(255) NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `pseudo_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `role_user` enum('Admin','User','Moderator') NOT NULL DEFAULT 'User',
  `pw_user` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_logged_user` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `POSTS` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `fk_id_user` int NOT NULL,
  `title_post` varchar(255) NOT NULL,
  `description_post` text NOT NULL,
  `views_post` int DEFAULT NULL,
  `image_post` varchar(255) NOT NULL,
  `body_post` text NOT NULL,
  `published_post` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  FOREIGN KEY (`fk_id_user`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `COMMENTS` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `fk_id_user` int NOT NULL,
  `fk_id_post` int NOT NULL,
  `body_comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`),
  FOREIGN KEY (`fk_id_user`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE,
  FOREIGN KEY (`fk_id_post`) REFERENCES `POSTS` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `TAGS` (
  `id_tag` int NOT NULL AUTO_INCREMENT,
  `name_tag` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `POST_TAG` (
  `fk_id_post` int NOT NULL,
  `fk_id_tag` int NOT NULL,
  PRIMARY KEY (`fk_id_post`, `fk_id_tag`),
  FOREIGN KEY (`fk_id_post`) REFERENCES `POSTS`(`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`fk_id_tag`) REFERENCES `TAGS`(`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
