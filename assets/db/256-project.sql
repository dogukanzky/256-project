-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2023 at 11:10 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `256-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `created_at`) VALUES
(11, 'teest', 11, 12, '2023-06-08 10:41:20'),
(14, 'wefwefwef', 10, 12, '2023-06-08 10:48:48'),
(15, 'brebbrt', 10, 12, '2023-06-08 10:49:00'),
(16, 'wqdqwdqwd4235345345', 10, 12, '2023-06-08 11:13:11'),
(17, 'hello', 19, 62, '2023-06-08 13:15:28'),
(18, '<b>hello</b>', 19, 62, '2023-06-08 13:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `inviter_id` int NOT NULL,
  `invited_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`inviter_id`,`invited_id`),
  KEY `inviter_id` (`inviter_id`),
  KEY `invited_id` (`invited_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`inviter_id`, `invited_id`, `status`) VALUES
(10, 11, 1),
(10, 16, 1),
(10, 19, 1),
(13, 10, 1),
(14, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `refer_to` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `text`, `created_at`, `is_seen`, `refer_to`) VALUES
(1, 10, 'cwewcwece', '2023-06-08 11:40:36', 1, '/profile.php'),
(2, 10, 'qwdqwd hgvhgvgh has removed you from friends!', '2023-06-08 12:21:24', 1, '/profile.php?id=16'),
(3, 16, 'Baturalp S&ouml;nmez has sent you friend request!', '2023-06-08 12:25:43', 1, '/profile.php?id=10'),
(4, 19, 'Baturalp S&ouml;nmez has sent you friend request!', '2023-06-08 13:14:28', 1, '/profile.php?id=10');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `text`, `image`, `user_id`, `created_at`) VALUES
(2, 'teteaaawd', '/uploads/5c5fc69aecc866374e689e5e2f0c72cf.jpeg', 10, '2023-06-07 03:49:04'),
(11, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 15, '2023-06-08 00:34:11'),
(12, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 14, '2023-06-08 00:34:11'),
(13, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 13, '2023-06-08 00:34:11'),
(14, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 12, '2023-06-08 00:34:11'),
(15, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 11, '2023-06-08 00:34:11'),
(16, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 10, '2023-06-08 00:34:11'),
(17, 'Lorem ipsum dolor sit amet.', '/uploads/0acab3941e725fbb18122791eea93945.png', 2, '2023-06-08 00:34:11'),
(18, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 15, '2023-06-08 00:34:11'),
(19, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 14, '2023-06-08 00:34:11'),
(20, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 13, '2023-06-08 00:34:11'),
(21, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 12, '2023-06-08 00:34:11'),
(22, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 11, '2023-06-08 00:34:11'),
(23, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 10, '2023-06-08 00:34:11'),
(24, 'Lorem ipsum dolor sit amet.', '/uploads/18e1b41bd86221f4fd4deb3a811e65fe.png', 2, '2023-06-08 00:34:11'),
(25, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 15, '2023-06-08 00:34:11'),
(26, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 14, '2023-06-08 00:34:11'),
(27, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 13, '2023-06-08 00:34:11'),
(28, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 12, '2023-06-08 00:34:11'),
(29, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 11, '2023-06-08 00:34:11'),
(30, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 10, '2023-06-08 00:34:11'),
(31, 'Lorem ipsum dolor sit amet.', '/uploads/1b7c188f9718a7a309661b742c31d1ca.png', 2, '2023-06-08 00:34:11'),
(32, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 15, '2023-06-08 00:34:11'),
(33, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 14, '2023-06-08 00:34:11'),
(34, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 13, '2023-06-08 00:34:11'),
(35, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 12, '2023-06-08 00:34:11'),
(36, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 11, '2023-06-08 00:34:11'),
(37, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 10, '2023-06-08 00:34:11'),
(38, 'Lorem ipsum dolor sit amet.', '/uploads/2b5a45156f7acd3dc0534298f5b4cd6f.jpeg', 2, '2023-06-08 00:34:11'),
(39, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 15, '2023-06-08 00:34:11'),
(40, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 14, '2023-06-08 00:34:11'),
(41, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 13, '2023-06-08 00:34:11'),
(42, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 12, '2023-06-08 00:34:11'),
(43, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 11, '2023-06-08 00:34:11'),
(44, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 10, '2023-06-08 00:34:11'),
(45, 'Lorem ipsum dolor sit amet.', '/uploads/3759a0228f0fb546b58e8324fa724ec1.jpeg', 2, '2023-06-08 00:34:11'),
(46, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 15, '2023-06-08 00:34:11'),
(47, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 14, '2023-06-08 00:34:11'),
(48, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 13, '2023-06-08 00:34:11'),
(49, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 12, '2023-06-08 00:34:11'),
(50, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 11, '2023-06-08 00:34:11'),
(51, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 10, '2023-06-08 00:34:11'),
(52, 'Lorem ipsum dolor sit amet.', '/uploads/48e0153cc5b5a4a02b2e9d1fbe5d1470.png', 2, '2023-06-08 00:34:11'),
(53, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 15, '2023-06-08 00:34:11'),
(54, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 14, '2023-06-08 00:34:11'),
(55, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 13, '2023-06-08 00:34:11'),
(56, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 12, '2023-06-08 00:34:11'),
(57, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 11, '2023-06-08 00:34:11'),
(58, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 10, '2023-06-08 00:34:11'),
(59, 'Lorem ipsum dolor sit amet.', '/uploads/4993a7fde693e85db9ce3c18c522fc29.png', 2, '2023-06-08 00:34:11'),
(60, 'wqdqwdqwd', '', 10, '2023-06-08 11:44:27'),
(61, 'helo world', '', 19, '2023-06-08 13:14:54'),
(62, 'helo world', '/uploads/d0da1898d38a67acd99a0ce3e3ce8afa.jpeg', 19, '2023-06-08 13:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
CREATE TABLE IF NOT EXISTS `post_likes` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`user_id`, `post_id`) VALUES
(10, 2),
(10, 13),
(10, 14),
(10, 15),
(10, 17),
(10, 22),
(10, 23),
(19, 62);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `picture` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `bio` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `birth_date`, `picture`, `password`, `bio`) VALUES
(2, 'John', 'Doe', 'john.aadoe@example.com', '1990-01-01', 'profile.jpg', 'password123', NULL),
(10, 'Baturalp', 'Sönmez', 'baturalpsonmez@gmail.com', '0000-00-00', '/uploads/ded1c67ad023f951ca31e4e55042da9c.jpeg', '$2y$10$dWpatQST.j0eugF.aES89uQ25TN8ItbuD0VZFnr8TKai5E8tbFJoi', 'qwdqwdqwdqwd'),
(11, 'Baturalp', 'Sönmez', 'baturalpsoawdnmez@gmail.com', '0000-00-00', '', '$2y$10$RHNPbjvxWksizqfcdNMUkOKbCX/gUD/Y9hIKzJFpD6cUVpdxsEKLe', NULL),
(12, 'Baturalp', 'Sönmez', 'baturalpsonqwdqwdqwdmez@gmail.com', '0000-00-00', '', '$2y$10$kFDUKMFvDjZI9LiiaUPXm.coguQ3J9m2f2ehZnd2FpTjQfskowtPG', NULL),
(13, 'BA***** SÖ*****', 'Sönmez', 'zort@ug.bilkent.edqdwdu.tr', '0000-00-00', '', '$2y$10$RYAmfjopeaWABQp7dAT7zOOEZDWVVeeeFGrzK1aPWPKbEjXByb02m', NULL),
(14, 'BA***** SÖ*****', 'Sönmez', 'baqwdqwtqwduralp.sonmez@ug.bilkenwdt.edqdwduq.tr', '0000-00-00', '/uploads/ded1c67ad023f951ca31e4e55042da9c.jpeg', '$2y$10$DEsB1sJ6JMeGkbOrAtyh2u/dnWTERPPEcXmKx1jVtKOfL9WG7zu9u', NULL),
(15, 'BA***** SÖ*****', 'Sönmez', 'baturalp.sonmez@ug.bqwilkent.edu.qwd', '0000-00-00', '', '$2y$10$5fSQrac3SOBnVHgOIStfCucLFXWRP1TyR5jDVqv3ziF/Zq.89S5Va', NULL),
(16, 'qwdqwd', 'hgvhgvgh', 'qwe@qwe.com', NULL, NULL, '$2y$10$vmZiYNi9oA6v4Z8EE6MCr.Z3aU7J6tBfJfSPw0Cm/OHO1nGcS3rLG', NULL),
(17, 'Baturalp', 'Sönmez', 'baturalp6556655sonmez@gmail.com', NULL, NULL, '$2y$10$CamNWUGuJK9uYaxlBvKcRuIbxyxIX6YjUIIN2rGt7gFSYIo.koHcW', NULL),
(18, 'Baturalp', 'Sönmez', 'baturalpsonmez2002@gmail.com', NULL, NULL, '$2y$10$VA4h.JsRddnK7nG4n8LDGOYmYnKv043P3GxqQqjcqBABAhTSmK5pq', NULL),
(19, 'Serkan', 'Genç', 'serkangenc1@gmail.com', NULL, NULL, '$2y$10$dWpatQST.j0eugF.aES89uQ25TN8ItbuD0VZFnr8TKai5E8tbFJoi', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`inviter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`invited_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
