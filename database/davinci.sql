-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/04/2025 às 23:50
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `davinci`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bancos`
--

DROP TABLE IF EXISTS `bancos`;
CREATE TABLE IF NOT EXISTS `bancos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `codigo_febraban` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL,
  `site` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Despejando dados para a tabela `bancos`
--

INSERT INTO `bancos` (`id`, `nome`, `codigo_febraban`, `site`) VALUES
(1, 'Banco do Brasil', '001', 'https://www.bb.cpm.br/'),
(2, 'Caixa Econômica Federal', '104', 'https://www.caixa.gov.br/'),
(3, 'Banco Santander (Brasil) S.A.', '033', 'https://www.santander.com.br/'),
(4, 'Banco C6 Consignado S.A.', '626', 'https://www.c6consig.com.br/');

-- --------------------------------------------------------

--
-- Estrutura para tabela `zdk_profiles`
--

DROP TABLE IF EXISTS `zdk_profiles`;
CREATE TABLE IF NOT EXISTS `zdk_profiles` (
  `profile_id` int NOT NULL AUTO_INCREMENT COMMENT 'Profile ID',
  `profile_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Profile name',
  `profile_description` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'Profile description',
  PRIMARY KEY (`profile_id`),
  UNIQUE KEY `profile_name` (`profile_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Profiles';

--
-- Despejando dados para a tabela `zdk_profiles`
--

INSERT INTO `zdk_profiles` (`profile_id`, `profile_name`, `profile_description`) VALUES
(1, 'Administrador', 'Administrador do sistema');

-- --------------------------------------------------------

--
-- Estrutura para tabela `zdk_profile_menus`
--

DROP TABLE IF EXISTS `zdk_profile_menus`;
CREATE TABLE IF NOT EXISTS `zdk_profile_menus` (
  `profile_menus_id` int NOT NULL AUTO_INCREMENT COMMENT 'Profile menus ID',
  `profile_id` int NOT NULL COMMENT 'Profile ID attached to the menu item',
  `menu_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Menu item ID',
  PRIMARY KEY (`profile_menus_id`),
  UNIQUE KEY `profile_menu_id` (`profile_id`,`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Menus allowed for each profile';

--
-- Despejando dados para a tabela `zdk_profile_menus`
--

INSERT INTO `zdk_profile_menus` (`profile_menus_id`, `profile_id`, `menu_id`) VALUES
(4, 1, '_authorization'),
(1, 1, 'check_connection'),
(3, 1, 'check_widgets'),
(6, 1, 'profiles'),
(2, 1, 'try_themes'),
(5, 1, 'users');

-- --------------------------------------------------------

--
-- Estrutura para tabela `zdk_profile_rows`
--

DROP TABLE IF EXISTS `zdk_profile_rows`;
CREATE TABLE IF NOT EXISTS `zdk_profile_rows` (
  `profile_rows_id` int NOT NULL AUTO_INCREMENT COMMENT 'Technical identifier of the table row',
  `profile_id` int NOT NULL COMMENT 'Identifier of the profile associated to the table row',
  `table_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Table name of the row associated to a profile',
  `row_id` int NOT NULL COMMENT 'Identifier of the row associated to the profile',
  PRIMARY KEY (`profile_rows_id`),
  UNIQUE KEY `PROFILE_ROWS_UK` (`profile_id`,`table_name`,`row_id`),
  KEY `PROFILE_ROWS_IDX` (`table_name`,`row_id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table rows associated to a ZnetDK profile';

-- --------------------------------------------------------

--
-- Estrutura para tabela `zdk_users`
--

DROP TABLE IF EXISTS `zdk_users`;
CREATE TABLE IF NOT EXISTS `zdk_users` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'Internal User id',
  `login_name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Login',
  `login_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Password',
  `expiration_date` date NOT NULL COMMENT 'Expiration date of the password',
  `user_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'User name',
  `user_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'Email',
  `user_phone` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'Phone number',
  `notes` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'Notes',
  `full_menu_access` tinyint(1) NOT NULL COMMENT 'Does user have access to the full menu?',
  `user_enabled` tinyint(1) NOT NULL COMMENT 'Is user enabled ? enabled (true), disabled (false))',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login_name` (`login_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of users';

--
-- Despejando dados para a tabela `zdk_users`
--

INSERT INTO `zdk_users` (`user_id`, `login_name`, `login_password`, `expiration_date`, `user_name`, `user_email`, `user_phone`, `notes`, `full_menu_access`, `user_enabled`) VALUES
(1, 'fsantos', '$2y$10$DpIqbRj8Gq3jUq/Bh.osZ.kbpJ4U9V6AT4S7cgWqUciMlsxZV6V/.', '2025-10-01', 'Francisco', 'francisco.santos9988@gmail.com', '+5551989545074', 'Administrador', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `zdk_user_profiles`
--

DROP TABLE IF EXISTS `zdk_user_profiles`;
CREATE TABLE IF NOT EXISTS `zdk_user_profiles` (
  `user_profile_id` int NOT NULL AUTO_INCREMENT COMMENT 'User profile row ID',
  `user_id` int NOT NULL COMMENT 'User id of the profile',
  `profile_id` int NOT NULL COMMENT 'Profile ID attached to the user',
  PRIMARY KEY (`user_profile_id`),
  UNIQUE KEY `USER_PROFILES_UK` (`profile_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='User profiles';

--
-- Despejando dados para a tabela `zdk_user_profiles`
--

INSERT INTO `zdk_user_profiles` (`user_profile_id`, `user_id`, `profile_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `zdk_user_pwd_resets`
--

DROP TABLE IF EXISTS `zdk_user_pwd_resets`;
CREATE TABLE IF NOT EXISTS `zdk_user_pwd_resets` (
  `email` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Email address',
  `request_date_time` datetime NOT NULL COMMENT 'Request date time',
  `reset_key` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Reset key',
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Password reset';

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `zdk_profile_menus`
--
ALTER TABLE `zdk_profile_menus`
  ADD CONSTRAINT `zdk_profile_menus_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `zdk_profiles` (`profile_id`);

--
-- Restrições para tabelas `zdk_profile_rows`
--
ALTER TABLE `zdk_profile_rows`
  ADD CONSTRAINT `zdk_profile_rows_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `zdk_profiles` (`profile_id`);

--
-- Restrições para tabelas `zdk_user_profiles`
--
ALTER TABLE `zdk_user_profiles`
  ADD CONSTRAINT `zdk_user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `zdk_users` (`user_id`),
  ADD CONSTRAINT `zdk_user_profiles_ibfk_2` FOREIGN KEY (`profile_id`) REFERENCES `zdk_profiles` (`profile_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
