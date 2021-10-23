-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/01/2020 às 20:44
-- Versão do servidor: 5.6.41-84.1
-- Versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `minerand_bd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pesquisa`
--

CREATE TABLE `pesquisa` (
  `id` int(11) NOT NULL,
  `string` text COLLATE utf8_unicode_ci NOT NULL,
  `uid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `pesquisa`
--

INSERT INTO `pesquisa` (`id`, `string`, `uid`, `data`, `hora`) VALUES
(11, 'cuiabá', '3065852607', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tuite`
--

CREATE TABLE `tuite` (
  `id` int(11) NOT NULL,
  `id_tuite` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_pesquisa` int(11) NOT NULL,
  `tuite` text COLLATE utf8_unicode_ci NOT NULL,
  `classificado` int(1) NOT NULL DEFAULT '0',
  `emocao` text COLLATE utf8_unicode_ci NOT NULL,
  `porcentagem` double(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_twitter`
--

CREATE TABLE `users_twitter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `twitter_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `users_twitter`
--

INSERT INTO `users_twitter` (`id`, `name`, `twitter_id`) VALUES
(1, 'Rodrigo Severo', '3065852607');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `pesquisa`
--
ALTER TABLE `pesquisa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tuite`
--
ALTER TABLE `tuite`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users_twitter`
--
ALTER TABLE `users_twitter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `pesquisa`
--
ALTER TABLE `pesquisa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tuite`
--
ALTER TABLE `tuite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users_twitter`
--
ALTER TABLE `users_twitter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
