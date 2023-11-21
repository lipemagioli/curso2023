-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2018 at 12:34 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controleestoque`
--

-- --------------------------------------------------------

--
-- Table structure for table `grupo_produto`
--

DROP TABLE IF EXISTS `grupo_produto`;
CREATE TABLE IF NOT EXISTS `grupo_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupo_produto`
--

INSERT INTO `grupo_produto` (`id`, `nome`, `descricao`) VALUES
(1, 'Grupo 1', 'grupo 1 teste');

-- --------------------------------------------------------

--
-- Table structure for table `movimentacao`
--

DROP TABLE IF EXISTS `movimentacao`;
CREATE TABLE IF NOT EXISTS `movimentacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_secao` int(11) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_secao` (`id_secao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movimentacao`
--

INSERT INTO `movimentacao` (`id`, `id_secao`, `descricao`) VALUES
(1, 1, 'Teste');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `id_grupo`) VALUES
(1, 'Teste Produto', 'Teste prod', 1),
(2, 'Teste 2 prod', 'nada', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produto_movimentacao`
--

DROP TABLE IF EXISTS `produto_movimentacao`;
CREATE TABLE IF NOT EXISTS `produto_movimentacao` (
  `produto_id` int(11) NOT NULL,
  `movimentacao_id` int(11) NOT NULL,
  PRIMARY KEY (`produto_id`,`movimentacao_id`),
  KEY `fk_produto_movimentacao_movimentacao_id` (`movimentacao_id`),
  KEY `fk_produto_movimentacao_produto_id` (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produto_movimentacao`
--

INSERT INTO `produto_movimentacao` (`produto_id`, `movimentacao_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `secao`
--

DROP TABLE IF EXISTS `secao`;
CREATE TABLE IF NOT EXISTS `secao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `secao`
--

INSERT INTO `secao` (`id`, `nome`, `descricao`) VALUES
(1, 'Secao 1', 'Teste secao 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Tabela de Usuários';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'fred', 'fred@email.com', 'user', '570a90bfbf8c7eab5dc5d4e26832d5b1'),
(8, 'anna', 'anna@email.com', 'user', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'urubu', 'urubu@enasi.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(10, '', 'annalara1426@gmail.com', 'user', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produto_movimentacao`
--
ALTER TABLE `produto_movimentacao`
  ADD CONSTRAINT `fk_produto_movimentacao_movimentacao_id` FOREIGN KEY (`movimentacao_id`) REFERENCES `movimentacao` (`id`),
  ADD CONSTRAINT `fk_produto_movimentacao_produto_id` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
